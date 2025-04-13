<?php
// Start session if not already started
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Check if user is logged in
if (!isset($_SESSION['user_id'])) {
    // User is not logged in, redirect to login page
    header("Location: login.php");
    exit();
}


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Recipe - Flavor Fusion</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&family=Pacifico&display=swap" rel="stylesheet">
    <!-- Custom CSS -->
    <link href="css/home.css" rel="stylesheet">
    <link href="css/addRecipe.css" rel="stylesheet">
    
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
                        <a class="nav-link active" href="addRecipe.php">Add Recipe</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="about.php">About Us</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="contact.php">Contact Us</a>
                    </li>
                    
                </ul>
            </div>
        </div>
    </nav>

    <!-- Page Header -->
    <div class="container mt-4">
        <div class="row">
            <div class="col-12">
                <h2 class="fw-bold">Add Your Recipe</h2>
                <p class="text-muted">Share your culinary creations with the Flavor Fusion community</p>
                <hr>
            </div>
        </div>
    </div>

    <!-- Add Recipe Form -->
    <div class="container mt-4">
        <div class="recipe-form-container">
            <form id="addRecipeForm" action="process_recipe.php" method="post" enctype="multipart/form-data">
                
                <!-- Basic Info Section -->
                <div class="row mb-4">
                    <div class="col-12">
                        <h4 class="mb-3">Basic Information</h4>
                    </div>
                    
                    <div class="col-md-8 mb-3">
                        <label for="recipeTitle" class="form-label">Recipe Title*</label>
                        <input type="text" class="form-control" id="recipeTitle" name="recipeTitle" placeholder="e.g., Creamy Garlic Parmesan Pasta" required>
                    </div>
                    
                    <div class="col-md-4 mb-3">
                        <label for="recipeCategory" class="form-label">Category*</label>
                        <select class="form-select category-select" id="recipeCategory" name="recipeCategory" required>
                            <option value="" selected disabled>Select a category</option>
                            <option value="main">Main Course</option>
                            <option value="appetizer">Appetizers</option>
                            <option value="dessert">Desserts</option>
                            <option value="drink">Drinks</option>
                            <option value="breakfast">Breakfast</option>
                            <option value="lunch">Lunch</option>
                            <option value="dinner">Dinner</option>
                            <option value="snack">Snacks</option>
                            <option value="salad">Salads</option>
                            <option value="soup">Soups</option>
                            <option value="bread">Breads</option>
                            <option value="other">Other</option>
                        </select>
                    </div>
                    
                    <div class="col-12 mb-3">
                        <label for="recipeDescription" class="form-label">Description*</label>
                        <textarea class="form-control" id="recipeDescription" name="recipeDescription" rows="3" placeholder="Briefly describe your recipe..." required></textarea>
                    </div>
                    
                    <div class="col-md-4 mb-3">
                        <label for="difficultyLevel" class="form-label">Difficulty Level*</label>
                        <select class="form-select" id="difficultyLevel" name="difficultyLevel" required>
                            <option value="" selected disabled>Select difficulty</option>
                            <option value="easy">Easy</option>
                            <option value="medium">Medium</option>
                            <option value="hard">Hard</option>
                        </select>
                    </div>
                    
                    <div class="col-md-4 mb-3">
                        <label for="prepTime" class="form-label">Prep Time (mins)*</label>
                        <input type="number" class="form-control time-input" id="prepTime" name="prepTime" min="1" required>
                    </div>
                    
                    <div class="col-md-4 mb-3">
                        <label for="cookTime" class="form-label">Cook Time (mins)*</label>
                        <input type="number" class="form-control time-input" id="cookTime" name="cookTime" min="1" required>
                    </div>
                    
                    <div class="col-md-6 mb-3">
                        <label for="servings" class="form-label">Servings*</label>
                        <input type="number" class="form-control time-input" id="servings" name="servings" min="1" required>
                    </div>
                    
                    <div class="col-md-6 mb-3">
                        <label for="calories" class="form-label">Calories per serving (optional)</label>
                        <input type="number" class="form-control time-input" id="calories" name="calories" min="1">
                    </div>
                </div>
                
                <!-- Recipe Image -->
                <div class="row mb-4">
                    <div class="col-12">
                        <h4 class="mb-3">Recipe Image</h4>
                    </div>
                    
                    <div class="col-md-12">
                        <div class="image-preview" id="imagePreview">
                            <i class="fas fa-image fa-3x text-muted"></i>
                        </div>
                        <div class="mb-3">
                            <label for="recipeImage" class="form-label">Upload Recipe Image*</label>
                            <input class="form-control" type="file" id="recipeImage" name="recipeImage" accept="image/*" required>
                            <div class="form-text">Upload a high-quality image of your finished dish (Max size: 5MB)</div>
                        </div>
                    </div>
                </div>
                
                <!-- Ingredients Section -->
                <div class="row mb-4">
                    <div class="col-12">
                        <h4 class="mb-3">Ingredients</h4>
                    </div>
                    
                    <div class="col-12">
                        <div id="ingredientsList">
                            <div class="ingredient-row row">
                                <div class="col-md-3 mb-2">
                                    <input type="text" class="form-control" name="ingredientAmount[]" placeholder="Amount (e.g., 2 cups)" required>
                                </div>
                                <div class="col-md-8 mb-2">
                                    <input type="text" class="form-control" name="ingredientName[]" placeholder="Ingredient name (e.g., all-purpose flour)" required>
                                </div>
                                <div class="col-md-1 mb-2">
                                    <button type="button" class="btn btn-outline-danger remove-ingredient"><i class="fas fa-times"></i></button>
                                </div>
                            </div>
                        </div>
                        <button type="button" class="btn btn-outline-primary add-more-btn" id="addIngredient">
                            <i class="fas fa-plus me-1"></i> Add Ingredient
                        </button>
                    </div>
                </div>
                
                <!-- Instructions Section -->
                <div class="row mb-4">
                    <div class="col-12">
                        <h4 class="mb-3">Instructions</h4>
                    </div>
                    
                    <div class="col-12">
                        <div id="instructionsList">
                            <div class="instruction-row row">
                                <div class="col-md-11 mb-2">
                                    <textarea class="form-control" name="instructions[]" rows="2" placeholder="Describe this step..." required></textarea>
                                </div>
                                <div class="col-md-1 mb-2">
                                    <button type="button" class="btn btn-outline-danger remove-instruction"><i class="fas fa-times"></i></button>
                                </div>
                            </div>
                        </div>
                        <button type="button" class="btn btn-outline-primary add-more-btn" id="addInstruction">
                            <i class="fas fa-plus me-1"></i> Add Step
                        </button>
                    </div>
                </div>
                
                <!-- Additional Notes Section -->
                <div class="row mb-4">
                    <div class="col-12">
                        <h4 class="mb-3">Additional Notes (Optional)</h4>
                        <textarea class="form-control" id="notes" name="notes" rows="3" placeholder="Share any tips, variations, or additional information about your recipe..."></textarea>
                    </div>
                </div>
                
                <!-- Tags Section -->
                <div class="row mb-4">
                    <div class="col-12">
                        <h4 class="mb-3">Tags (Optional)</h4>
                        <input type="text" class="form-control" id="tags" name="tags" placeholder="Enter tags separated by commas (e.g., italian, pasta, dinner, quick)">
                        <div class="form-text">Tags help others discover your recipe</div>
                    </div>
                </div>
                
                <!-- Form Actions -->
                <div class="row">
                    <div class="col-12 text-end">
                        <button type="button" class="btn btn-outline-secondary me-2">Cancel</button>
                        <button type="submit" class="btn btn-custom-primary">Submit Recipe</button>
                    </div>
                </div>
            </form>
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
                                <li class="mb-2"><a href="#" class="text-white text-decoration-none">Home</a></li>
                                <li class="mb-2"><a href="#" class="text-white text-decoration-none">Recipes</a></li>
                                <li class="mb-2"><a href="#" class="text-white text-decoration-none">Add Recipies</a></li>
                                <li><a href="#" class="text-white text-decoration-none">Login</a></li>
                            </ul>
                        </div>
                        <div class="col-6 col-md-4">
                            <h5 class="mb-3">About</h5>
                            <ul class="list-unstyled">
                                <li class="mb-2"><a href="#" class="text-white text-decoration-none">About Us</a></li>
                                <li class="mb-2"><a href="#" class="text-white text-decoration-none">Contact Us</a></li>
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
            // Image preview functionality
            const imageInput = document.getElementById('recipeImage');
            const imagePreview = document.getElementById('imagePreview');
            
            imageInput.addEventListener('change', function() {
                const file = this.files[0];
                if (file) {
                    const reader = new FileReader();
                    reader.onload = function(e) {
                        imagePreview.innerHTML = `<img src="${e.target.result}" alt="Recipe preview">`;
                    }
                    reader.readAsDataURL(file);
                } else {
                    imagePreview.innerHTML = `<i class="fas fa-image fa-3x text-muted"></i>`;
                }
            });
            
            // Add more ingredients
            const addIngredientBtn = document.getElementById('addIngredient');
            const ingredientsList = document.getElementById('ingredientsList');
            
            addIngredientBtn.addEventListener('click', function() {
                const newRow = document.createElement('div');
                newRow.className = 'ingredient-row row';
                newRow.innerHTML = `
                    <div class="col-md-3 mb-2">
                        <input type="text" class="form-control" name="ingredientAmount[]" placeholder="Amount (e.g., 2 cups)" required>
                    </div>
                    <div class="col-md-8 mb-2">
                        <input type="text" class="form-control" name="ingredientName[]" placeholder="Ingredient name (e.g., all-purpose flour)" required>
                    </div>
                    <div class="col-md-1 mb-2">
                        <button type="button" class="btn btn-outline-danger remove-ingredient"><i class="fas fa-times"></i></button>
                    </div>
                `;
                ingredientsList.appendChild(newRow);
                
                // Add event listener to the new remove button
                const removeBtn = newRow.querySelector('.remove-ingredient');
                removeBtn.addEventListener('click', function() {
                    ingredientsList.removeChild(newRow);
                });
            });
            
            // Add event listeners to initial remove ingredient buttons
            document.querySelectorAll('.remove-ingredient').forEach(button => {
                button.addEventListener('click', function() {
                    const row = this.closest('.ingredient-row');
                    if (ingredientsList.children.length > 1) {
                        ingredientsList.removeChild(row);
                    } else {
                        alert('You need at least one ingredient!');
                    }
                });
            });
            
            // Add more instructions
            const addInstructionBtn = document.getElementById('addInstruction');
            const instructionsList = document.getElementById('instructionsList');
            
            addInstructionBtn.addEventListener('click', function() {
                const newRow = document.createElement('div');
                newRow.className = 'instruction-row row';
                newRow.innerHTML = `
                    <div class="col-md-11 mb-2">
                        <textarea class="form-control" name="instructions[]" rows="2" placeholder="Describe this step..." required></textarea>
                    </div>
                    <div class="col-md-1 mb-2">
                        <button type="button" class="btn btn-outline-danger remove-instruction"><i class="fas fa-times"></i></button>
                    </div>
                `;
                instructionsList.appendChild(newRow);
                
                // Add event listener to the new remove button
                const removeBtn = newRow.querySelector('.remove-instruction');
                removeBtn.addEventListener('click', function() {
                    instructionsList.removeChild(newRow);
                });
            });
            
            // Add event listeners to initial remove instruction buttons
            document.querySelectorAll('.remove-instruction').forEach(button => {
                button.addEventListener('click', function() {
                    const row = this.closest('.instruction-row');
                    if (instructionsList.children.length > 1) {
                        instructionsList.removeChild(row);
                    } else {
                        alert('You need at least one instruction!');
                    }
                });
            });
            
            
        });
    </script>
</body>
</html>