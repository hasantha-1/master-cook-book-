<?php
// Start session if not already started
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Database connection
require_once 'includes/db_connect.php';

// Set response header to JSON
header('Content-Type: application/json');

// Check if recipe ID is provided
if (!isset($_GET['recipe_id']) || empty($_GET['recipe_id'])) {
    echo json_encode([
        'success' => false,
        'message' => 'Recipe ID is required'
    ]);
    exit;
}

// Get recipe ID and sanitize
$recipe_id = $conn->real_escape_string($_GET['recipe_id']);

// Query to get approved comments with user info
$sql = "SELECT r.review_id, r.user_id, r.rating, r.review_text, 
               r.date_posted, u.name, u.profile_image 
        FROM reviews r
        JOIN users u ON r.user_id = u.user_id
        WHERE r.recipe_id = '$recipe_id'
        ORDER BY r.date_posted DESC";

$result = $conn->query($sql);

if ($result) {
    $comments = [];
    
    while ($row = $result->fetch_assoc()) {
        // Format date
        $date = new DateTime($row['date_posted']);
        $formatted_date = $date->format('M d, Y');
        
        $comments[] = [
            'review_id' => $row['review_id'],
            'user_id' => $row['user_id'],
            'name' => $row['name'],
            'profile_image' => $row['profile_image'],
            'rating' => $row['rating'],
            'comment_text' => $row['review_text'],
            'created_at' => $formatted_date
        ];
    }
    
    echo json_encode([
        'success' => true,
        'comments' => $comments
    ]);
} else {
    echo json_encode([
        'success' => false,
        'message' => 'Error fetching comments: ' . $conn->error
    ]);
}

$conn->close();
?>