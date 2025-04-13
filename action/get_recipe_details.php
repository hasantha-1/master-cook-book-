<?php
// Start session if not already started
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Database connection
require_once 'includes/db_connect.php';

// Set response header
header('Content-Type: application/json');

// Response array
$response = [
    'success' => false,
    'message' => '',
    'recipe' => null
];

// Check if recipe ID is provided
if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    $response['message'] = 'Invalid recipe ID.';
    echo json_encode($response);
    exit();
}

$recipe_id = intval($_GET['id']);

// Get the recipe information
$recipe_query = "SELECT r.*, 
                      c.category_name, c.category_slug,
                      d.level_name as difficulty_name, d.level_slug as difficulty_slug,
                      u.user_id as author_id, u.name as author_name, u.profile_image,
                      (SELECT AVG(rating) FROM reviews WHERE recipe_id = r.recipe_id) as avg_rating,
                      (SELECT COUNT(*) FROM reviews WHERE recipe_id = r.recipe_id) as comment_count
                FROM recipes r
                JOIN recipe_categories c ON r.category_id = c.category_id
                JOIN difficulty_levels d ON r.difficulty_id = d.difficulty_id
                JOIN users u ON r.user_id = u.user_id
                WHERE r.recipe_id = ? AND r.is_approved = TRUE";

$stmt = $conn->prepare($recipe_query);
$stmt->bind_param('i', $recipe_id);
$stmt->execute();
$result = $stmt->get_result();

// Check if recipe exists
if ($result->num_rows === 0) {
    $response['message'] = 'Recipe not found or not published.';
    echo json_encode($response);
    exit();
}

// Fetch recipe data
$recipe = $result->fetch_assoc();

// Get ingredients
$ingredients_query = "SELECT ingredient_id, amount, name
                     FROM ingredients
                     WHERE recipe_id = ?
                     ORDER BY display_order";

$stmt = $conn->prepare($ingredients_query);
$stmt->bind_param('i', $recipe_id);
$stmt->execute();
$ingredients_result = $stmt->get_result();

$ingredients = [];
while ($ingredient = $ingredients_result->fetch_assoc()) {
    $ingredients[] = $ingredient;
}

// Get instructions
$instructions_query = "SELECT instruction_id, step_description as instruction_text
                      FROM instructions
                      WHERE recipe_id = ?
                      ORDER BY step_order";

$stmt = $conn->prepare($instructions_query);
$stmt->bind_param('i', $recipe_id);
$stmt->execute();
$instructions_result = $stmt->get_result();

$instructions = [];
while ($instruction = $instructions_result->fetch_assoc()) {
    $instructions[] = $instruction;
}

// Get tags
$tags_query = "SELECT t.tag_id, t.tag_name, t.tag_slug
               FROM tags t
               JOIN recipe_tags rt ON t.tag_id = rt.tag_id
               WHERE rt.recipe_id = ?";

$stmt = $conn->prepare($tags_query);
$stmt->bind_param('i', $recipe_id);
$stmt->execute();
$tags_result = $stmt->get_result();

$tags = [];
while ($tag = $tags_result->fetch_assoc()) {
    $tags[] = $tag;
}

// Determine if user can comment (must be logged in and not the author)
$user_can_comment = false;
if (isset($_SESSION['user_id'])) {
    // Check if the user has already left a review
    $review_check_query = "SELECT review_id FROM reviews 
                          WHERE recipe_id = ? AND user_id = ?";
    
    $stmt = $conn->prepare($review_check_query);
    $stmt->bind_param('ii', $recipe_id, $_SESSION['user_id']);
    $stmt->execute();
    $review_result = $stmt->get_result();
    
    $user_can_comment = ($review_result->num_rows === 0 && $_SESSION['user_id'] != $recipe['author_id']);
}

// Build the complete recipe object
$recipe_data = [
    'recipe_id' => $recipe['recipe_id'],
    'title' => $recipe['title'],
    'description' => $recipe['description'],
    'category_name' => $recipe['category_name'],
    'category_slug' => $recipe['category_slug'],
    'difficulty_name' => $recipe['difficulty_name'],
    'difficulty_slug' => $recipe['difficulty_slug'],
    'prep_time' => $recipe['prep_time'],
    'cook_time' => $recipe['cook_time'],
    'servings' => $recipe['servings'],
    'calories' => $recipe['calories'],
    'image_path' => $recipe['image_path'],
    'notes' => $recipe['notes'],
    'date_created' => $recipe['date_created'],
    'avg_rating' => is_null($recipe['avg_rating']) ? 0 : (float)$recipe['avg_rating'],
    'comment_count' => (int)$recipe['comment_count'],
    'author' => [
        'user_id' => $recipe['author_id'],
        'name' => $recipe['author_name'],
        'profile_image' => $recipe['profile_image']
    ],
    'ingredients' => $ingredients,
    'instructions' => $instructions,
    'tags' => $tags,
    'user_can_comment' => $user_can_comment
];

// Set success response
$response['success'] = true;
$response['recipe'] = $recipe_data;

// Return JSON response
echo json_encode($response);

// Close the connection
$stmt->close();
$conn->close();
?>