<?php
// Start session if not already started
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Include database connection
require_once 'includes/db_connect.php';

// Initialize response array
$response = [
    'success' => false,
    'message' => ''
];

// Check if user is logged in
if (!isset($_SESSION['user_id'])) {
    $response['message'] = 'You must be logged in to submit a review.';
    echo json_encode($response);
    exit;
}

// Check if the request method is POST
if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    $response['message'] = 'Invalid request method.';
    echo json_encode($response);
    exit;
}

// Validate required fields
if (!isset($_POST['recipe_id']) || !isset($_POST['rating']) || !isset($_POST['comment'])) {
    $response['message'] = 'Missing required fields.';
    echo json_encode($response);
    exit;
}

// Get data from POST request
$user_id = $_SESSION['user_id'];
$recipe_id = intval($_POST['recipe_id']);
$rating = intval($_POST['rating']);
$comment = trim($_POST['comment']);

// Validate rating
if ($rating < 1 || $rating > 5) {
    $response['message'] = 'Rating must be between 1 and 5.';
    echo json_encode($response);
    exit;
}

// Validate comment length
if (strlen($comment) < 1) {
    $response['message'] = 'Comment cannot be empty.';
    echo json_encode($response);
    exit;
}

// Validate recipe exists
$check_recipe_sql = "SELECT recipe_id FROM recipes WHERE recipe_id = ?";
$check_recipe_stmt = $conn->prepare($check_recipe_sql);
$check_recipe_stmt->bind_param("i", $recipe_id);
$check_recipe_stmt->execute();
$check_recipe_result = $check_recipe_stmt->get_result();

if ($check_recipe_result->num_rows === 0) {
    $response['message'] = 'Recipe not found.';
    echo json_encode($response);
    exit;
}
$check_recipe_stmt->close();

// Check if user has already reviewed this recipe
$check_review_sql = "SELECT review_id FROM reviews WHERE recipe_id = ? AND user_id = ?";
$check_review_stmt = $conn->prepare($check_review_sql);
$check_review_stmt->bind_param("ii", $recipe_id, $user_id);
$check_review_stmt->execute();
$check_review_result = $check_review_stmt->get_result();

if ($check_review_result->num_rows > 0) {
    // Update existing review
    $update_sql = "UPDATE reviews SET rating = ?, review_text = ?, date_posted = CURRENT_TIMESTAMP WHERE recipe_id = ? AND user_id = ?";
    $update_stmt = $conn->prepare($update_sql);
    $update_stmt->bind_param("isii", $rating, $comment, $recipe_id, $user_id);
    
    if ($update_stmt->execute()) {
        $response['success'] = true;
        $response['message'] = 'Your review has been updated successfully.';
    } else {
        $response['message'] = 'Error updating your review: ' . $conn->error;
    }
    $update_stmt->close();
} else {
    // Insert new review
    $insert_sql = "INSERT INTO reviews (recipe_id, user_id, rating, review_text) VALUES (?, ?, ?, ?)";
    $insert_stmt = $conn->prepare($insert_sql);
    $insert_stmt->bind_param("iiis", $recipe_id, $user_id, $rating, $comment);
    
    if ($insert_stmt->execute()) {
        $response['success'] = true;
        $response['message'] = 'Your review has been submitted successfully.';
    } else {
        $response['message'] = 'Error submitting your review: ' . $conn->error;
    }
    $insert_stmt->close();
}

$check_review_stmt->close();

// Calculate and update average rating for the recipe
$update_avg_sql = "UPDATE recipes r 
                   SET r.avg_rating = (
                       SELECT AVG(rating) 
                       FROM reviews 
                       WHERE recipe_id = ?
                   ) 
                   WHERE r.recipe_id = ?";
$update_avg_stmt = $conn->prepare($update_avg_sql);
$update_avg_stmt->bind_param("ii", $recipe_id, $recipe_id);
$update_avg_stmt->execute();
$update_avg_stmt->close();

// Return response
echo json_encode($response);

// Close database connection
$conn->close();
?>