<?php
// Start session
session_start();

// Database connection
require_once '../includes/db_connect.php';

// Initialize variables
$name = '';
$email = '';
$password = '';
$confirm_password = '';
$errors = [];

// Process registration form
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get form data and sanitize inputs
    $name = htmlspecialchars(trim($_POST['name']));
    $email = htmlspecialchars(trim($_POST['reg_email']));
    $password = trim($_POST['reg_password']);
    $confirm_password = trim($_POST['confirm_password']);
    $agree_terms = isset($_POST['agree_terms']) ? true : false;

    // Validate inputs
    if (empty($name)) {
        $errors[] = "Full name is required";
    }

    if (empty($email)) {
        $errors[] = "Email address is required";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors[] = "Invalid email format";
    }

    if (empty($password)) {
        $errors[] = "Password is required";
    } elseif (strlen($password) < 8) {
        $errors[] = "Password must be at least 8 characters long";
    }

    if ($password !== $confirm_password) {
        $errors[] = "Passwords do not match";
    }

    if (!$agree_terms) {
        $errors[] = "You must agree to the Terms of Service and Privacy Policy";
    }

    // Check if email already exists
    if (empty($errors)) {
        $stmt = $conn->prepare("SELECT user_id FROM users WHERE email = ?");
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $result = $stmt->get_result();
        
        if ($result->num_rows > 0) {
            $errors[] = "Email address is already registered";
        }
        $stmt->close();
    }

    // Register user if no errors
    if (empty($errors)) {
        // Hash the password
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);
        
        // Insert user into database
        $stmt = $conn->prepare("INSERT INTO users (name, email, password) VALUES (?, ?, ?)");
        $stmt->bind_param("sss", $name, $email, $hashed_password);
        
        if ($stmt->execute()) {
            // Registration successful
            $_SESSION['registration_success'] = true;
            $_SESSION['name'] = $name;
            
            // Redirect to login page
            header("Location: ../login.php?registration=success");
            exit();
        } else {
            $errors[] = "Registration failed: " . $conn->error;
        }
        $stmt->close();
    }

    // If there are errors, store them in session and redirect back to login page
    if (!empty($errors)) {
        $_SESSION['registration_errors'] = $errors;
        $_SESSION['reg_name'] = $name;
        $_SESSION['reg_email'] = $email;
        
        header("Location: ../login.php?tab=register");
        exit();
    }
} else {
    // If not a POST request, redirect to login page
    header("Location: ../login.php");
    exit();
}

// Close database connection
$conn->close();
?>