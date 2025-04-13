<?php
// Start session
session_start();

// Database connection
require_once '../includes/db_connect.php';

// Initialize variables
$email = '';
$password = '';
$remember = false;
$errors = [];

// Process login form
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get form data and sanitize inputs
    $email = htmlspecialchars(trim($_POST['email']));
    $password = trim($_POST['password']);
    $remember = isset($_POST['remember']) ? true : false;

    // Validate inputs
    if (empty($email)) {
        $errors[] = "Email address is required";
    }

    if (empty($password)) {
        $errors[] = "Password is required";
    }

    // Attempt to authenticate user
    if (empty($errors)) {
        $stmt = $conn->prepare("SELECT user_id, name, email, password, is_admin FROM users WHERE email = ?");
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $result = $stmt->get_result();
        
        if ($result->num_rows == 1) {
            $user = $result->fetch_assoc();
            
            // Verify password
            if (password_verify($password, $user['password'])) {
                // Login successful - set session variables
                $_SESSION['user_id'] = $user['user_id'];
                $_SESSION['name'] = $user['name'];
                $_SESSION['email'] = $user['email'];
                $_SESSION['is_admin'] = $user['is_admin'];
                $_SESSION['logged_in'] = true;
                
                // Set remember-me cookie if requested
                if ($remember) {
                    // Generate a secure token
                    $token = bin2hex(random_bytes(32));
                    $token_hash = hash('sha256', $token);
                    $expiry = time() + (30 * 24 * 60 * 60); // 30 days
                    
                    // Store token in database
                    $stmt_token = $conn->prepare("INSERT INTO user_tokens (user_id, token_hash, expires_at) VALUES (?, ?, FROM_UNIXTIME(?))");
                    $stmt_token->bind_param("isi", $user['user_id'], $token_hash, $expiry);
                    $stmt_token->execute();
                    $stmt_token->close();
                    
                    // Set the cookie
                    setcookie('remember_token', $token, $expiry, '/', '', true, true);
                }
                
                // Redirect to dashboard or home page
                if ($user['is_admin']) {
                    header("Location: ../admin/dashboard.php");
                } else {
                    header("Location: ../addRecipe.php");
                }
                exit();
            } else {
                $errors[] = "Invalid email or password";
            }
        } else {
            $errors[] = "Invalid email or password";
        }
        $stmt->close();
    }

    
    if (!empty($errors)) {
        $_SESSION['login_errors'] = $errors;
        $_SESSION['login_email'] = $email;
        
        header("Location: ../login.php");
        exit();
    }
} else {
  
    header("Location: ../login.php");
    exit();
}

$conn->close();

?>