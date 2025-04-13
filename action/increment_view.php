<?php
// Start session if not already started
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Database connection
require_once 'includes/db_connect.php';

// Set header to return JSON
header('Content-Type: application/json');

// Initialize response array
$response = array(
    'success' => false,
    'message' => ''
);

// Check if the request is POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Validate that recipe_id exists and is numeric
    if (isset($_POST['recipe_id']) && is_numeric($_POST['recipe_id'])) {
        $recipe_id = intval($_POST['recipe_id']);
        
        // Check if the recipe exists
        $check_query = "SELECT recipe_id FROM recipes WHERE recipe_id = ?";
        $stmt = $conn->prepare($check_query);
        $stmt->bind_param('i', $recipe_id);
        $stmt->execute();
        $result = $stmt->get_result();
        
        if ($result->num_rows > 0) {
            // Recipe exists, increment view count
            $increment_query = "UPDATE recipes SET view_count = view_count + 1 WHERE recipe_id = ?";
            $stmt = $conn->prepare($increment_query);
            $stmt->bind_param('i', $recipe_id);
            
            if ($stmt->execute()) {
                $response['success'] = true;
                $response['message'] = 'View count incremented successfully';
            } else {
                $response['message'] = 'Failed to increment view count: ' . $conn->error;
            }
        } else {
            $response['message'] = 'Recipe not found';
        }
        
        $stmt->close();
    } else {
        $response['message'] = 'Invalid recipe ID';
    }
} else {
    $response['message'] = 'Invalid request method';
}

// Return JSON response
echo json_encode($response);

// Close database connection
$conn->close();
?>