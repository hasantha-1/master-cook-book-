<?php
// Start session if not already started
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

// Check if user is logged in
if (!isset($_SESSION['user_id'])) {
    // Redirect to login page if not logged in
    header("Location: login.php?redirect=add_recipe");
    exit();
}

// Include database connection
require_once 'includes/db_connect.php';

// Check if form was submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get user ID from session
    $user_id = $_SESSION['user_id'];
    
    // Basic recipe information
    $title = trim($_POST['recipeTitle']);
    $slug = createSlug($title);
    $description = trim($_POST['recipeDescription']);
    $category_slug = $_POST['recipeCategory'];
    $difficulty_slug = $_POST['difficultyLevel'];
    $prep_time = (int)$_POST['prepTime'];
    $cook_time = (int)$_POST['cookTime'];
    $servings = (int)$_POST['servings'];
    $calories = !empty($_POST['calories']) ? (int)$_POST['calories'] : null;
    $notes = !empty($_POST['notes']) ? trim($_POST['notes']) : null;
    
    // Validate required fields
    if (empty($title) || empty($description) || empty($category_slug) || 
        empty($difficulty_slug) || $prep_time <= 0 || $cook_time <= 0 || $servings <= 0) {
        $_SESSION['error'] = "Please fill in all required fields.";
        header("Location: add_recipe.php");
        exit();
    }
    
    try {
        // Start transaction using mysqli
        mysqli_autocommit($conn, FALSE);
        
        // Get category_id from category_slug
        $stmt = $conn->prepare("SELECT category_id FROM recipe_categories WHERE category_slug = ?");
        $stmt->bind_param("s", $category_slug);
        $stmt->execute();
        $result = $stmt->get_result();
        $category = $result->fetch_assoc();
        $category_id = $category['category_id'];
        $stmt->close();
        
        // Get difficulty_id from difficulty_slug
        $stmt = $conn->prepare("SELECT difficulty_id FROM difficulty_levels WHERE level_slug = ?");
        $stmt->bind_param("s", $difficulty_slug);
        $stmt->execute();
        $result = $stmt->get_result();
        $difficulty = $result->fetch_assoc();
        $difficulty_id = $difficulty['difficulty_id'];
        $stmt->close();
        
        // Handle image upload
        $image_path = 'default-recipe.jpg'; // Default image
        
        if (isset($_FILES['recipeImage']) && $_FILES['recipeImage']['error'] === UPLOAD_ERR_OK) {
            $upload_dir = 'uploads/recipes/';
            
            // Create directory if it doesn't exist
            if (!file_exists($upload_dir)) {
                mkdir($upload_dir, 0755, true);
            }
            
            // Get file info
            $file_name = $_FILES['recipeImage']['name'];
            $file_tmp = $_FILES['recipeImage']['tmp_name'];
            $file_ext = strtolower(pathinfo($file_name, PATHINFO_EXTENSION));
            
            // Allowed file extensions
            $allowed_extensions = ['jpg', 'jpeg', 'png', 'gif'];
            
            if (in_array($file_ext, $allowed_extensions)) {
                // Generate unique filename
                $new_file_name = $slug . '-' . uniqid() . '.' . $file_ext;
                $upload_path = $upload_dir . $new_file_name;
                
                // Move uploaded file
                if (move_uploaded_file($file_tmp, $upload_path)) {
                    $image_path = $upload_path;
                } else {
                    throw new Exception("Failed to upload image.");
                }
            } else {
                throw new Exception("Invalid file type. Only JPG, JPEG, PNG, and GIF are allowed.");
            }
        }
        
        // Insert recipe
        $stmt = $conn->prepare("
            INSERT INTO recipes (
                user_id, title, slug, description, category_id, difficulty_id,
                prep_time, cook_time, servings, calories, image_path, notes
            ) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)
        ");
        
        $stmt->bind_param(
            "isssiiiiisss", 
            $user_id, $title, $slug, $description, $category_id, $difficulty_id,
            $prep_time, $cook_time, $servings, $calories, $image_path, $notes
        );
        
        $stmt->execute();
        $recipe_id = $conn->insert_id;
        $stmt->close();
        
        // Process ingredients
        if (isset($_POST['ingredientAmount']) && isset($_POST['ingredientName'])) {
            $amounts = $_POST['ingredientAmount'];
            $names = $_POST['ingredientName'];
            
            $stmt = $conn->prepare("
                INSERT INTO ingredients (recipe_id, amount, name, display_order)
                VALUES (?, ?, ?, ?)
            ");
            
            for ($i = 0; $i < count($names); $i++) {
                if (!empty($names[$i]) && !empty($amounts[$i])) {
                    $display_order = $i + 1;
                    $ingredient_name = trim($names[$i]);
                    $ingredient_amount = trim($amounts[$i]);
                    
                    $stmt->bind_param("issi", $recipe_id, $ingredient_amount, $ingredient_name, $display_order);
                    $stmt->execute();
                }
            }
            $stmt->close();
        }
        
        // Process instructions
        if (isset($_POST['instructions'])) {
            $instructions = $_POST['instructions'];
            
            $stmt = $conn->prepare("
                INSERT INTO instructions (recipe_id, step_description, step_order)
                VALUES (?, ?, ?)
            ");
            
            for ($i = 0; $i < count($instructions); $i++) {
                if (!empty($instructions[$i])) {
                    $step_order = $i + 1;
                    $step_description = trim($instructions[$i]);
                    
                    $stmt->bind_param("isi", $recipe_id, $step_description, $step_order);
                    $stmt->execute();
                }
            }
            $stmt->close();
        }
        
        // Process tags
        if (!empty($_POST['tags'])) {
            $tags = explode(',', $_POST['tags']);
            
            foreach ($tags as $tag_name) {
                $tag_name = trim($tag_name);
                if (!empty($tag_name)) {
                    $tag_slug = createSlug($tag_name);
                    
                    // Check if tag exists
                    $stmt = $conn->prepare("SELECT tag_id FROM tags WHERE tag_slug = ?");
                    $stmt->bind_param("s", $tag_slug);
                    $stmt->execute();
                    $result = $stmt->get_result();
                    $tag = $result->fetch_assoc();
                    $stmt->close();
                    
                    if ($tag) {
                        $tag_id = $tag['tag_id'];
                    } else {
                        // Create new tag
                        $stmt = $conn->prepare("INSERT INTO tags (tag_name, tag_slug) VALUES (?, ?)");
                        $stmt->bind_param("ss", $tag_name, $tag_slug);
                        $stmt->execute();
                        $tag_id = $conn->insert_id;
                        $stmt->close();
                    }
                    
                    // Associate tag with recipe
                    $stmt = $conn->prepare("INSERT INTO recipe_tags (recipe_id, tag_id) VALUES (?, ?)");
                    $stmt->bind_param("ii", $recipe_id, $tag_id);
                    $stmt->execute();
                    $stmt->close();
                }
            }
        }
        
        // Commit transaction
        mysqli_commit($conn);
        
        // Set success message
        $_SESSION['success'] = "Your recipe has been submitted successfully!";
        
        // Redirect to the recipe page
        header("Location: search.php");
        exit();
        
    } catch (Exception $e) {
        // Rollback transaction on error
        mysqli_rollback($conn);
        
        $_SESSION['error'] = "An error occurred: " . $e->getMessage();
        header("Location: add_recipe.php");
        exit();
    } finally {
        // Reset autocommit to true
        mysqli_autocommit($conn, TRUE);
    }
} else {
    // If not POST request, redirect to add recipe page
    header("Location: add_recipe.php");
    exit();
}

/**
 * Creates a URL-friendly slug from a string
 *
 * @param string $string The string to convert
 * @return string The slug
 */
function createSlug($string) {
    // Replace spaces with hyphens
    $string = str_replace(' ', '-', $string);
    // Remove special characters
    $string = preg_replace('/[^A-Za-z0-9\-]/', '', $string);
    // Convert to lowercase
    $string = strtolower($string);
    // Remove duplicate hyphens
    $string = preg_replace('/-+/', '-', $string);
    // Trim hyphens from beginning and end
    $string = trim($string, '-');
    
    return $string;
}
?>