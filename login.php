<?php
// Start the session at the very beginning
session_start();

// Check if user is already logged in
if(isset($_SESSION['user_id'])) {
    // User is already logged in, redirect to addRecipe.php
    header("Location: addRecipe.php");
    exit;
}
?>
<!DOCTYPE html>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Flavor Fusion</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&family=Pacifico&display=swap" rel="stylesheet">
    <!-- Custom CSS -->
    <link href="css/home.css" rel="stylesheet">
    <style>
        .login-container {
            max-width: 450px;
            margin: 0 auto;
        }
        .auth-tabs .nav-link {
            color: #555;
            font-weight: 500;
            padding: 1rem;
            width: 50%;
            text-align: center;
            border-radius: 0;
        }
        .auth-tabs .nav-link.active {
            background-color: transparent;
            border-bottom: 3px solid var(--primary-color);
            color: var(--primary-color);
        }
        .form-control:focus {
            border-color: var(--primary-color);
            box-shadow: 0 0 0 0.25rem rgba(255, 107, 107, 0.25);
        }
        .auth-divider {
            display: flex;
            align-items: center;
            margin: 1.5rem 0;
        }
        .auth-divider::before,
        .auth-divider::after {
            content: "";
            flex: 1;
            border-bottom: 1px solid #dee2e6;
        }
        .auth-divider span {
            padding: 0 10px;
            color: #6c757d;
        }
        .social-login-btn {
            width: 100%;
            padding: 0.5rem;
            margin-bottom: 1rem;
            border-radius: 5px;
            display: flex;
            justify-content: center;
            align-items: center;
            font-weight: 500;
            transition: all 0.3s;
        }
        .social-login-btn:hover {
            opacity: 0.9;
        }
        .page-header {
            padding: 80px 0 30px;
        }
        .auth-banner {
            background-color: var(--secondary-color);
            height: 100%;
            border-radius: 15px;
            padding: 3rem;
            color: white;
            display: flex;
            flex-direction: column;
            justify-content: center;
        }
        .auth-banner img {
            max-width: 80%;
            margin-bottom: 2rem;
        }
    </style>
</head>
<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg sticky-top">
        <div class="container">
            <a class="navbar-brand brand-logo fs-3" href="#">Flavor Fusion</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto me-4">
                    <li class="nav-item">
                        <a class="nav-link" href="index.php">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="search.php">Search Recipies</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="addRecipe.php">Add Recipe</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="about.php">About Us</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="contact.php">Contact Us</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" href="login.php">Login</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Login Section -->
    <div class="container my-5">
        <div class="row g-0">
            <div class="col-lg-6 d-none d-lg-block">
                <div class="auth-banner">
                    <h2 class="fw-bold mb-4">Welcome Back to Flavor Fusion</h2>
                    <p class="mb-4">Log in to access your saved recipes, share your culinary creations, and join our community of food enthusiasts.</p>
                    <div class="mb-4">
                        <div class="d-flex align-items-center mb-3">
                            <i class="fas fa-bookmark me-3"></i>
                            <p class="mb-0">Save your favorite recipes</p>
                        </div>
                        <div class="d-flex align-items-center mb-3">
                            <i class="fas fa-share-alt me-3"></i>
                            <p class="mb-0">Share your own recipes</p>
                        </div>
                        <div class="d-flex align-items-center">
                            <i class="fas fa-comment-alt me-3"></i>
                            <p class="mb-0">Participate in our cooking community</p>
                        </div>
                    </div>
                    <img src="https://cdn.dribbble.com/users/2344801/screenshots/4774578/alphagamma_food_dribbble.png" alt="Cooking illustration" class="img-fluid">
                </div>
            </div>
            <div class="col-lg-6">
                <div class="card border-0 shadow-sm h-100">
                    <div class="card-body p-4 p-lg-5">
                        <!-- Auth Tabs -->
                        <ul class="nav nav-tabs border-0 auth-tabs mb-4" id="authTab" role="tablist">
                            <li class="nav-item" role="presentation">
                                <button class="nav-link active" id="login-tab" data-bs-toggle="tab" data-bs-target="#login" type="button" role="tab" aria-controls="login" aria-selected="true">Login</button>
                            </li>
                            <li class="nav-item" role="presentation">
                                <button class="nav-link" id="register-tab" data-bs-toggle="tab" data-bs-target="#register" type="button" role="tab" aria-controls="register" aria-selected="false">Register</button>
                            </li>
                        </ul>
                        
                        <!-- Tab Content -->
                        <div class="tab-content" id="authTabContent">
                            <!-- Login Tab -->
                            <div class="tab-pane fade show active" id="login" role="tabpanel" aria-labelledby="login-tab">
                                <?php
                                // Process login form
                                if(isset($_POST['login'])) {
                                    $email = htmlspecialchars($_POST['email']);
                                    $password = $_POST['password'];
                                    
                                    // Here you would normally verify the user credentials
                                    // For this example, we'll just show a success message
                                    if($email && $password) {
                                        // Redirect to home page or dashboard
                                        // header("Location: index.php");
                                        // exit;
                                        $login_success = true;
                                    } else {
                                        $login_error = "Invalid email or password.";
                                    }
                                }
                                ?>
                                
                                <?php if(isset($login_success)): ?>
                                    <div class="alert alert-success">
                                        Login successful! Redirecting to your dashboard...
                                    </div>
                                <?php endif; ?>
                                
                                <?php if(isset($login_error)): ?>
                                    <div class="alert alert-danger">
                                        <?php echo $login_error; ?>
                                    </div>
                                <?php endif; ?>
                                
                                <form method="POST" action="auth/login.php">
                                    <div class="mb-3">
                                        <label for="email" class="form-label">Email Address</label>
                                        <input type="email" class="form-control" id="email" name="email" required>
                                    </div>
                                    <div class="mb-3">
                                        <label for="password" class="form-label">Password</label>
                                        <div class="input-group">
                                            <input type="password" class="form-control" id="password" name="password" required>
                                            <button class="btn btn-outline-secondary toggle-password" type="button">
                                                <i class="far fa-eye"></i>
                                            </button>
                                        </div>
                                    </div>
                                    <div class="d-flex justify-content-between mb-4">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" id="rememberMe" name="remember">
                                            <label class="form-check-label" for="rememberMe">Remember me</label>
                                        </div>
                                        <a href="#" class="text-decoration-none">Forgot password?</a>
                                    </div>
                                    <button type="submit" name="login" class="btn btn-custom-primary w-100 py-2">Login</button>
                                </form>
                                
                                <div class="auth-divider">
                                    <span>or continue with</span>
                                </div>
                                
                                <div class="row g-2">
                                    <div class="col-6">
                                        <a href="#" class="btn btn-outline-dark social-login-btn">
                                            <i class="fab fa-google me-2"></i> Google
                                        </a>
                                    </div>
                                    <div class="col-6">
                                        <a href="#" class="btn btn-outline-primary social-login-btn">
                                            <i class="fab fa-facebook-f me-2"></i> Facebook
                                        </a>
                                    </div>
                                </div>
                            </div>
                            
                            <!-- Register Tab -->
                            <div class="tab-pane fade" id="register" role="tabpanel" aria-labelledby="register-tab">
                                <?php
                                // Process registration form
                                if(isset($_POST['register'])) {
                                    $name = htmlspecialchars($_POST['name']);
                                    $reg_email = htmlspecialchars($_POST['reg_email']);
                                    $reg_password = $_POST['reg_password'];
                                    $confirm_password = $_POST['confirm_password'];
                                    
                                    // Basic validation
                                    if($reg_password !== $confirm_password) {
                                        $reg_error = "Passwords do not match.";
                                    } else {
                                        // Here you would normally register the user
                                        $reg_success = true;
                                    }
                                }
                                ?>
                                
                                <?php if(isset($reg_success)): ?>
                                    <div class="alert alert-success">
                                        Registration successful! You can now log in.
                                    </div>
                                <?php endif; ?>
                                
                                <?php if(isset($reg_error)): ?>
                                    <div class="alert alert-danger">
                                        <?php echo $reg_error; ?>
                                    </div>
                                <?php endif; ?>
                                
                                <form method="post" action="auth/register.php">
                                    <div class="mb-3">
                                        <label for="name" class="form-label">Full Name</label>
                                        <input type="text" class="form-control" id="name" name="name" required>
                                    </div>
                                    <div class="mb-3">
                                        <label for="reg_email" class="form-label">Email Address</label>
                                        <input type="email" class="form-control" id="reg_email" name="reg_email" required>
                                    </div>
                                    <div class="mb-3">
                                        <label for="reg_password" class="form-label">Password</label>
                                        <div class="input-group">
                                            <input type="password" class="form-control" id="reg_password" name="reg_password" required>
                                            <button class="btn btn-outline-secondary toggle-password" type="button">
                                                <i class="far fa-eye"></i>
                                            </button>
                                        </div>
                                        <div class="password-strength mt-2"></div>
                                    </div>
                                    <div class="mb-3">
                                        <label for="confirm_password" class="form-label">Confirm Password</label>
                                        <div class="input-group">
                                            <input type="password" class="form-control" id="confirm_password" name="confirm_password" required>
                                            <button class="btn btn-outline-secondary toggle-password" type="button">
                                                <i class="far fa-eye"></i>
                                            </button>
                                        </div>
                                    </div>
                                    <div class="mb-4">
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" id="agreeTerms" name="agree_terms" required>
                                            <label class="form-check-label" for="agreeTerms">
                                                I agree to the <a href="#" class="text-decoration-none">Terms of Service</a> and <a href="#" class="text-decoration-none">Privacy Policy</a>
                                            </label>
                                        </div>
                                    </div>
                                    <button type="submit" name="register" class="btn btn-custom-primary w-100 py-2">Create Account</button>
                                </form>
                                
                                <div class="auth-divider">
                                    <span>or register with</span>
                                </div>
                                
                                <div class="row g-2">
                                    <div class="col-6">
                                        <a href="#" class="btn btn-outline-dark social-login-btn">
                                            <i class="fab fa-google me-2"></i> Google
                                        </a>
                                    </div>
                                    <div class="col-6">
                                        <a href="#" class="btn btn-outline-primary social-login-btn">
                                            <i class="fab fa-facebook-f me-2"></i> Facebook
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Footer -->
    <footer class="mt-5 pt-5 pb-4">
        <div class="container">
            <div class="row g-4">
                <div class="col-md-4">
                    <h3 class="brand-logo mb-3">Flavor Fusion</h3>
                    <p>Discover, cook, and share delicious recipes from around the world. Your digital cooking companion.</p>
                    <div class="social-icons">
                        <a href="#" class="text-white me-3"><i class="fab fa-facebook-f"></i></a>
                        <a href="#" class="text-white me-3"><i class="fab fa-instagram"></i></a>
                        <a href="#" class="text-white me-3"><i class="fab fa-pinterest"></i></a>
                        <a href="#" class="text-white"><i class="fab fa-youtube"></i></a>
                    </div>
                </div>
                <div class="col-md-8">
                    <div class="row">
                        <div class="col-6 col-md-4">
                            <h5 class="mb-3">Explore</h5>
                            <ul class="list-unstyled">
                                <li class="mb-2"><a href="index.php" class="text-white text-decoration-none">Home</a></li>
                                <li class="mb-2"><a href="search.php" class="text-white text-decoration-none">Recipes</a></li>
                                <li class="mb-2"><a href="addRecipe.php" class="text-white text-decoration-none">Add Recipies</a></li>
                                <li><a href="login.php" class="text-white text-decoration-none">Login</a></li>
                            </ul>
                        </div>
                        <div class="col-6 col-md-4">
                            <h5 class="mb-3">About</h5>
                            <ul class="list-unstyled">
                                <li class="mb-2"><a href="about.php" class="text-white text-decoration-none">About Us</a></li>
                                <li class="mb-2"><a href="contact.php" class="text-white text-decoration-none">Contact Us</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <hr class="mt-4 mb-4 bg-light">
            <div class="text-center">
                <p class="mb-0">© 2025 Flavor Fusion. All rights reserved.</p>
            </div>
        </div>
    </footer>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <!-- Custom JS -->
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Toggle password visibility
            const togglePasswordButtons = document.querySelectorAll('.toggle-password');
            togglePasswordButtons.forEach(button => {
                button.addEventListener('click', function() {
                    const input = this.previousElementSibling;
                    const icon = this.querySelector('i');
                    
                    if (input.type === 'password') {
                        input.type = 'text';
                        icon.classList.remove('fa-eye');
                        icon.classList.add('fa-eye-slash');
                    } else {
                        input.type = 'password';
                        icon.classList.remove('fa-eye-slash');
                        icon.classList.add('fa-eye');
                    }
                });
            });
            
            // Password strength indicator
            const passwordInput = document.getElementById('reg_password');
            const strengthIndicator = document.querySelector('.password-strength');
            
            if (passwordInput && strengthIndicator) {
                passwordInput.addEventListener('input', function() {
                    const password = this.value;
                    let strength = 0;
                    let message = '';
                    let color = '';
                    
                    if (password.length >= 8) strength += 1;
                    if (password.match(/[a-z]/) && password.match(/[A-Z]/)) strength += 1;
                    if (password.match(/\d/)) strength += 1;
                    if (password.match(/[^a-zA-Z\d]/)) strength += 1;
                    
                    switch (strength) {
                        case 0:
                            message = 'Very Weak';
                            color = '#dc3545';
                            break;
                        case 1:
                            message = 'Weak';
                            color = '#ffc107';
                            break;
                        case 2:
                            message = 'Fair';
                            color = '#fd7e14';
                            break;
                        case 3:
                            message = 'Good';
                            color = '#20c997';
                            break;
                        case 4:
                            message = 'Strong';
                            color = '#198754';
                            break;
                    }
                    
                    strengthIndicator.innerHTML = `<small style="color: ${color}">Password strength: ${message}</small>`;
                });
            }
            
            // Form validation
            const registerForm = document.querySelector('#register form');
            if (registerForm) {
                registerForm.addEventListener('submit', function(event) {
                    const password = document.getElementById('reg_password').value;
                    const confirmPassword = document.getElementById('confirm_password').value;
                    
                    if (password !== confirmPassword) {
                        event.preventDefault();
                        alert('Passwords do not match!');
                    }
                });
            }
        });
    </script>
</body>
</html>