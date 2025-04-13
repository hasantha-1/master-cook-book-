<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Flavor Fusion - Digital Recipe App</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&family=Pacifico&display=swap" rel="stylesheet">
    <!-- Custom CSS -->
    <link href="css/home.css" rel="stylesheet">

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
                        <a class="nav-link active" href="index.php">Home</a>
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
                        <a class="nav-link" href="login.php">Login</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <div class="container">
        <div class="hero-section d-flex align-items-center">
            <div class="food-pattern"></div>
            <div class="container position-relative z-index-1">
                <div class="row">
                    <div class="col-md-6">
                        <h1 class="display-4 fw-bold mb-3">Discover Delicious Recipes</h1>
                        <p class="lead mb-4">Explore thousands of tasty recipes and become a chef in your own kitchen!</p>
                        <button class="btn btn-light btn-lg px-4">Get Started</button>
                    </div>
                </div>
            </div>
            <img src="https://static.vecteezy.com/system/resources/thumbnails/037/857/842/small/ai-generated-irresistible-food-products-collage-with-white-dividers-beautifully-lit-by-bright-white-light-photo.jpeg" alt="Food collage" class="hero-image d-none d-md-block">
        </div>
    </div>

    <!-- Categories Section -->
    <div class="container mt-5">
        <div class="row mb-4">
            <div class="col">
                <h2 class="fw-bold">Categories</h2>
                <p class="text-muted">Browse recipes by category</p>
            </div>
        </div>
        <div class="row g-4">
            <div class="col-6 col-md-3">
                <div class="card category-card text-center p-4" style="background-color: #FFE0E0;">
                    <div class="card-body">
                        <i class="fa-solid fa-burger category-icon" style="color: var(--primary-color);"></i>
                        <h5 class="card-title">Main Course</h5>
                    </div>
                </div>
            </div>
            <div class="col-6 col-md-3">
                <div class="card category-card text-center p-4" style="background-color: #E0FFF1;">
                    <div class="card-body">
                        <i class="fa-solid fa-bowl-food category-icon" style="color: var(--secondary-color);"></i>
                        <h5 class="card-title">Appetizers</h5>
                    </div>
                </div>
            </div>
            <div class="col-6 col-md-3">
                <div class="card category-card text-center p-4" style="background-color: #FFF8E0;">
                    <div class="card-body">
                        <i class="fa-solid fa-cake-candles category-icon" style="color: var(--accent-color);"></i>
                        <h5 class="card-title">Desserts</h5>
                    </div>
                </div>
            </div>
            <div class="col-6 col-md-3">
                <div class="card category-card text-center p-4" style="background-color: #E0E9FF;">
                    <div class="card-body">
                        <i class="fa-solid fa-martini-glass category-icon" style="color: #5D76C7;"></i>
                        <h5 class="card-title">Drinks</h5>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Featured Recipes -->
    <div class="container mt-5">
        <div class="row mb-4">
            <div class="col d-flex justify-content-between align-items-center">
                <div>
                    <h2 class="fw-bold">Featured Recipes</h2>
                    <p class="text-muted">Handpicked delicious recipes just for you</p>
                </div>
                <button class="btn btn-custom-secondary">View All</button>
            </div>
        </div>
        <div class="row g-4">
            <div class="col-md-4">
                <div class="card recipe-card">
                    <img src="https://getinspiredeveryday.com/wp-content/uploads/2023/04/Garlic-Parmesan-Pasta-Get-Inspired-Everyday.jpg" class="card-img-top recipe-img" alt="Pasta dish">
                    <div class="card-body">
                        <div class="d-flex justify-content-between mb-2">
                            <span class="difficulty easy">Easy</span>
                            <span class="time-info"><i class="far fa-clock me-1"></i> 30 mins</span>
                        </div>
                        <h5 class="card-title">Creamy Garlic Parmesan Pasta</h5>
                        <p class="card-text text-muted">A quick and delicious pasta dish that's perfect for weeknight dinners.</p>
                        <div class="d-flex justify-content-between align-items-center">
                            <div class="ratings">
                                <i class="fas fa-star" style="color: #FFD700;"></i>
                                <i class="fas fa-star" style="color: #FFD700;"></i>
                                <i class="fas fa-star" style="color: #FFD700;"></i>
                                <i class="fas fa-star" style="color: #FFD700;"></i>
                                <i class="fas fa-star-half-alt" style="color: #FFD700;"></i>
                                <span class="ms-1">4.5</span>
                            </div>
                            <a href="search.php"> <button class="btn btn-custom-primary me-2"><i class="fas fa-utensils me-1"></i> View Recipe</button></a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card recipe-card">
                    <img src="https://acouplebites.com/wp-content/uploads/2024/03/Closeup-finished-thai-curry-soup-1024x683.png" class="card-img-top recipe-img" alt="Chicken curry">
                    <div class="card-body">
                        <div class="d-flex justify-content-between mb-2">
                            <span class="difficulty medium">Medium</span>
                            <span class="time-info"><i class="far fa-clock me-1"></i> 45 mins</span>
                        </div>
                        <h5 class="card-title">Spicy Thai Coconut Curry</h5>
                        <p class="card-text text-muted">A flavorful curry with the perfect balance of spicy, sweet, and savory.</p>
                        <div class="d-flex justify-content-between align-items-center">
                            <div class="ratings">
                                <i class="fas fa-star" style="color: #FFD700;"></i>
                                <i class="fas fa-star" style="color: #FFD700;"></i>
                                <i class="fas fa-star" style="color: #FFD700;"></i>
                                <i class="fas fa-star" style="color: #FFD700;"></i>
                                <i class="fas fa-star" style="color: #FFD700;"></i>
                                <span class="ms-1">5.0</span>
                            </div>
                            <a href="search.php"> <button class="btn btn-custom-primary me-2"><i class="fas fa-utensils me-1"></i> View Recipe</button></a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card recipe-card">
                    <img src="https://sugarcovesweets.com/wp-content/uploads/2024/05/IMG_0143-1.jpeg" class="card-img-top recipe-img" alt="Chocolate cake">
                    <div class="card-body">
                        <div class="d-flex justify-content-between mb-2">
                            <span class="difficulty hard">Hard</span>
                            <span class="time-info"><i class="far fa-clock me-1"></i> 90 mins</span>
                        </div>
                        <h5 class="card-title">Triple Chocolate Layer Cake</h5>
                        <p class="card-text text-muted">A decadent chocolate cake with ganache and chocolate frosting.</p>
                        <div class="d-flex justify-content-between align-items-center">
                            <div class="ratings">
                                <i class="fas fa-star" style="color: #FFD700;"></i>
                                <i class="fas fa-star" style="color: #FFD700;"></i>
                                <i class="fas fa-star" style="color: #FFD700;"></i>
                                <i class="fas fa-star" style="color: #FFD700;"></i>
                                <i class="far fa-star" style="color: #FFD700;"></i>
                                <span class="ms-1">4.2</span>
                            </div>
                            <a href="search.php"> <button class="btn btn-custom-primary me-2"><i class="fas fa-utensils me-1"></i> View Recipe</button></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Recipe of the Day -->
    <div class="container mt-5">
        <div class="card border-0 shadow-sm overflow-hidden" style="border-radius: 15px;">
            <div class="row g-0">
                <div class="col-md-6">
                    <img src="https://www.allrecipes.com/thmb/1E9IEpMJDfNE7PhD9SQiF_c3uME=/1500x0/filters:no_upscale():max_bytes(150000):strip_icc()/76763mediterranean-salmonFranceC4x3-d763357f666a44e6b25f9b9fc4441441.jpg" class="img-fluid h-100 w-100" style="object-fit: cover;" alt="Recipe of the day">
                </div>
                <div class="col-md-6">
                    <div class="card-body p-4 p-md-5">
                        <span class="badge bg-danger mb-2">Recipe of the Day</span>
                        <h3 class="card-title fw-bold">Mediterranean Grilled Salmon</h3>
                        <p class="card-text">This Mediterranean-inspired salmon recipe features a flavorful blend of herbs and spices, served with a refreshing cucumber and tomato salad.</p>
                        <div class="mb-3">
                            <div class="d-flex align-items-center mb-2">
                                <i class="fas fa-users me-2" style="color: var(--secondary-color);"></i>
                                <span>4 servings</span>
                            </div>
                            <div class="d-flex align-items-center mb-2">
                                <i class="fas fa-fire-alt me-2" style="color: var(--primary-color);"></i>
                                <span>420 calories per serving</span>
                            </div>
                            <div class="d-flex align-items-center">
                                <i class="far fa-clock me-2" style="color: var(--accent-color);"></i>
                                <span>35 minutes total</span>
                            </div>
                        </div>
                        <a href="search.php"> <button class="btn btn-custom-primary me-2"><i class="fas fa-utensils me-1"></i> View Recipe</button></a>
                        </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Subscribe Section -->
    <div class="container mt-5 mb-5">
        <div class="card border-0 p-4 p-md-5" style="border-radius: 15px; background-color: var(--secondary-color);">
            <div class="row align-items-center">
                <div class="col-md-7 text-white">
                    <h3 class="fw-bold">Never Miss a Recipe!</h3>
                    <p>Subscribe to our newsletter and get weekly recipe updates, cooking tips, and exclusive content.</p>
                </div>
                <div class="col-md-5">
                    <div class="input-group">
                        <input type="email" class="form-control" placeholder="Your email address">
                        <button class="btn btn-custom-primary" type="button">Subscribe</button>
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
        // JavaScript functionality can be added here
        document.addEventListener('DOMContentLoaded', function() {
            // Initialize any JavaScript functionality
            console.log('Recipe App initialized!');
            
            // Example: Add save recipe functionality
            const saveButtons = document.querySelectorAll('.btn-custom-primary');
            saveButtons.forEach(button => {
                if (button.innerHTML.includes('Save')) {
                    button.addEventListener('click', function() {
                        // Toggle saved state
                        const isSaved = button.innerHTML.includes('Save');
                        if (isSaved) {
                            button.innerHTML = '<i class="fas fa-bookmark me-1"></i> Saved';
                        } else {
                            button.innerHTML = '<i class="far fa-bookmark me-1"></i> Save';
                        }
                        
                        // Show a toast or notification
                        alert('Recipe saved to your collection!');
                    });
                }
            });
        });
    </script>
</body>
</html>