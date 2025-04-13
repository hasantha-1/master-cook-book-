<?php
// Start session if not already started
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
// Database connection
require_once 'includes/db_connect.php';

// Default query to fetch all recipes
$sql = "SELECT r.recipe_id, r.title, r.description, r.image_path, r.date_created, r.view_count, 
               c.category_name, d.level_name as difficulty_name, d.level_slug as difficulty_slug, u.name as author_name, u.profile_image,
               (SELECT AVG(rating) FROM reviews WHERE recipe_id = r.recipe_id ) as avg_rating,
               (SELECT COUNT(*) FROM reviews WHERE recipe_id = r.recipe_id ) as comment_count
        FROM recipes r
        JOIN recipe_categories c ON r.category_id = c.category_id
        JOIN difficulty_levels d ON r.difficulty_id = d.difficulty_id
        JOIN users u ON r.user_id = u.user_id
        WHERE r.is_approved = TRUE";

// Search functionality
$search_term = "";
$category_filter = "";
$difficulty_filter = "";
$sort_by = "newest";

if ($_SERVER["REQUEST_METHOD"] == "GET") {
    // Search by term
    if (isset($_GET['search']) && !empty($_GET['search'])) {
        $search_term = $conn->real_escape_string($_GET['search']);
        $sql .= " AND (r.title LIKE '%$search_term%' OR r.description LIKE '%$search_term%')";
    }
    
    // Filter by category
    if (isset($_GET['category']) && !empty($_GET['category'])) {
        $category_filter = $conn->real_escape_string($_GET['category']);
        $sql .= " AND c.category_slug = '$category_filter'";
    }
    
    // Filter by difficulty
    if (isset($_GET['difficulty']) && !empty($_GET['difficulty'])) {
        $difficulty_filter = $conn->real_escape_string($_GET['difficulty']);
        $sql .= " AND d.level_slug = '$difficulty_filter'";
    }
    
    // Tag filter
    if (isset($_GET['tag']) && !empty($_GET['tag'])) {
        $tag_filter = $conn->real_escape_string($_GET['tag']);
        $sql .= " AND r.recipe_id IN (SELECT recipe_id FROM recipe_tags WHERE tag_id = (SELECT tag_id FROM tags WHERE tag_slug = '$tag_filter'))";
    }
    
    // Sorting
    if (isset($_GET['sort']) && !empty($_GET['sort'])) {
        $sort_by = $conn->real_escape_string($_GET['sort']);
        
        switch ($sort_by) {
            case 'newest':
                $sql .= " ORDER BY r.date_created DESC";
                break;
            case 'popular':
                $sql .= " ORDER BY r.view_count DESC";
                break;
            case 'rating':
                $sql .= " ORDER BY avg_rating DESC";
                break;
            default:
                $sql .= " ORDER BY r.date_created DESC";
        }
    } else {
        $sql .= " ORDER BY r.date_created DESC";
    }
}

// Execute query
$result = $conn->query($sql);

// Get categories for filter
$categories_query = "SELECT category_name, category_slug FROM recipe_categories ORDER BY category_name";
$categories_result = $conn->query($categories_query);

// Get difficulty levels for filter
$difficulty_query = "SELECT level_name, level_slug FROM difficulty_levels ORDER BY difficulty_id";
$difficulty_result = $conn->query($difficulty_query);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Search Recipes - Flavor Fusion</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&family=Pacifico&display=swap" rel="stylesheet">
    <!-- Custom CSS -->
    <link href="css/home.css" rel="stylesheet">
    
    <style>
        
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
                        <a class="nav-link active" href="search.php">Search Recipes</a>
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
                </ul>
                <div class="d-flex">
                    <?php if(isset($_SESSION['user_id'])): ?>
                        <div class="dropdown">
                            <button class="btn btn-outline-light dropdown-toggle" type="button" id="userDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                                <i class="fas fa-user-circle me-1"></i> Account
                            </button>
                            <ul class="dropdown-menu" aria-labelledby="userDropdown">
                                <li><a class="dropdown-item" href="profile.php">My Profile</a></li>
                                <li><a class="dropdown-item" href="my-recipes.php">My Recipes</a></li>
                                <li><a class="dropdown-item" href="collections.php">My Collections</a></li>
                                <li><hr class="dropdown-divider"></li>
                                <li><a class="dropdown-item" href="logout.php">Logout</a></li>
                            </ul>
                        </div>
                    <?php else: ?>
                        <a href="login.php" class="btn btn-outline-light me-2">Login</a>
                        <a href="register.php" class="btn btn-custom-primary">Sign Up</a>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </nav>

    <!-- Search Section -->
    <div class="container mt-4">
        <div class="search-section p-4">
            <h2 class="mb-4">Find Your Perfect Recipe</h2>
            <form action="search.php" method="GET" class="row g-3">
                <div class="col-md-8">
                    <div class="input-group">
                        <span class="input-group-text"><i class="fas fa-search"></i></span>
                        <input type="text" class="form-control" placeholder="Search recipes, ingredients, or keywords" name="search" value="<?php echo htmlspecialchars($search_term); ?>">
                    </div>
                </div>
                <div class="col-md-4">
                    <button type="submit" class="btn btn-custom-primary w-100">Search Recipes</button>
                </div>
            </form>
        </div>
    </div>

    <!-- Main Content -->
    <div class="container">
        <div class="row">
            <!-- Filters Sidebar -->
            <div class="col-lg-3 mb-4">
                <div class="filters-section">
                    <h4 class="mb-3">Filters</h4>
                    <form action="search.php" method="GET">
                        <?php if(!empty($search_term)): ?>
                            <input type="hidden" name="search" value="<?php echo htmlspecialchars($search_term); ?>">
                        <?php endif; ?>
                        
                        <div class="mb-3">
                            <label class="form-label">Category</label>
                            <select class="form-select" name="category">
                                <option value="">All Categories</option>
                                <?php while($category = $categories_result->fetch_assoc()): ?>
                                    <option value="<?php echo $category['category_slug']; ?>" <?php if($category_filter == $category['category_slug']) echo 'selected'; ?>>
                                        <?php echo $category['category_name']; ?>
                                    </option>
                                <?php endwhile; ?>
                            </select>
                        </div>
                        
                        <div class="mb-3">
                            <label class="form-label">Difficulty</label>
                            <select class="form-select" name="difficulty">
                                <option value="">Any Difficulty</option>
                                <?php while($difficulty = $difficulty_result->fetch_assoc()): ?>
                                    <option value="<?php echo $difficulty['level_slug']; ?>" <?php if($difficulty_filter == $difficulty['level_slug']) echo 'selected'; ?>>
                                        <?php echo $difficulty['level_name']; ?>
                                    </option>
                                <?php endwhile; ?>
                            </select>
                        </div>
                        
                        <div class="mb-3">
                            <label class="form-label">Sort By</label>
                            <select class="form-select" name="sort">
                                <option value="newest" <?php if($sort_by == 'newest') echo 'selected'; ?>>Newest First</option>
                                <option value="popular" <?php if($sort_by == 'popular') echo 'selected'; ?>>Most Popular</option>
                                <option value="rating" <?php if($sort_by == 'rating') echo 'selected'; ?>>Highest Rated</option>
                            </select>
                        </div>
                        
                        <button type="submit" class="btn btn-custom-primary w-100">Apply Filters</button>
                    </form>
                    
                    <hr>
                    
                    <div class="mt-3">
                        <h5>Popular Tags</h5>
                        <div class="d-flex flex-wrap gap-2 mt-2">
                            <?php
                            // Get popular tags
                            $tags_query = "SELECT t.tag_name, t.tag_slug, COUNT(*) as tag_count 
                                          FROM tags t 
                                          JOIN recipe_tags rt ON t.tag_id = rt.tag_id 
                                          GROUP BY t.tag_id 
                                          ORDER BY tag_count DESC 
                                          LIMIT 10";
                            $tags_result = $conn->query($tags_query);
                            
                            while($tag = $tags_result->fetch_assoc()): ?>
                                <a href="search.php?tag=<?php echo $tag['tag_slug']; ?>" class="badge bg-secondary text-decoration-none">
                                    <?php echo $tag['tag_name']; ?>
                                </a>
                            <?php endwhile; ?>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Recipe Grid -->
            <div class="col-lg-9">
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <h3>
                        <?php if(!empty($search_term)): ?>
                            Search Results for "<?php echo htmlspecialchars($search_term); ?>"
                        <?php else: ?>
                            All Recipes
                        <?php endif; ?>
                    </h3>
                    <span class="text-muted"><?php echo $result->num_rows; ?> recipes found</span>
                </div>
                
                <?php if($result->num_rows > 0): ?>
                    <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 g-4">
                        <?php while($recipe = $result->fetch_assoc()): ?>
                            <div class="col">
                                <div class="card recipe-card h-100">
                                    <img src="<?php echo htmlspecialchars($recipe['image_path']); ?>" class="card-img-top recipe-image" alt="<?php echo htmlspecialchars($recipe['title']); ?>">
                                    <span class="badge bg-primary category-badge"><?php echo htmlspecialchars($recipe['category_name']); ?></span>
                                    
                                    <div class="card-body">
                                        <h5 class="card-title"><?php echo htmlspecialchars($recipe['title']); ?></h5>
                                        <p class="card-text text-muted small">
                                            <?php echo substr(htmlspecialchars($recipe['description']), 0, 100) . '...'; ?>
                                        </p>
                                        
                                        <div class="d-flex justify-content-between align-items-center mb-2">
                                            <div class="rating">
                                                <?php 
                                                $avg_rating = $recipe['avg_rating'] ? round($recipe['avg_rating'], 1) : 0;
                                                for($i = 1; $i <= 5; $i++) {
                                                    if($i <= $avg_rating) {
                                                        echo '<i class="fas fa-star"></i>';
                                                    } elseif($i - 0.5 <= $avg_rating) {
                                                        echo '<i class="fas fa-star-half-alt"></i>';
                                                    } else {
                                                        echo '<i class="far fa-star"></i>';
                                                    }
                                                }
                                                ?>
                                                <span class="ms-1 small">(<?php echo $recipe['comment_count']; ?>)</span>
                                            </div>
                                            
                                            <span class="difficulty-<?php echo strtolower($recipe['difficulty_slug']); ?> small">
                                                <i class="fas fa-signal me-1"></i><?php echo $recipe['difficulty_name']; ?>
                                            </span>
                                        </div>
                                        
                                        <div class="author-info small text-muted mb-3">
                                            <img src="<?php echo htmlspecialchars($recipe['profile_image']); ?>" class="author-avatar" alt="Author">
                                            <span><?php echo htmlspecialchars($recipe['author_name']); ?></span>
                                        </div>
                                        
                                        <div class="d-grid">
                                            <button class="btn btn-outline-primary view-recipe" data-recipe-id="<?php echo $recipe['recipe_id']; ?>">
                                                View Recipe
                                            </button>
                                        </div>
                                    </div>
                                    
                                    <div class="card-footer bg-white border-top-0">
                                        <div class="d-flex justify-content-between text-muted small">
                                            <span><i class="far fa-calendar me-1"></i><?php echo date('M d, Y', strtotime($recipe['date_created'])); ?></span>
                                            <span><i class="far fa-eye me-1"></i><?php echo $recipe['view_count']; ?> views</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php endwhile; ?>
                    </div>
                <?php else: ?>
                    <div class="alert alert-info">
                        <i class="fas fa-info-circle me-2"></i> No recipes found matching your search criteria. Try different keywords or filters.
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>

    <!-- Recipe Modal -->
    <div class="modal fade" id="recipeModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-xl modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="recipeModalLabel">Recipe Details</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body" id="recipeModalContent">
                    <div class="d-flex justify-content-center">
                        <div class="spinner-border text-primary" role="status">
                            <span class="visually-hidden">Loading...</span>
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
                                <li class="mb-2"><a href="addRecipe.php" class="text-white text-decoration-none">Add Recipes</a></li>
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
    
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Get all view recipe buttons
            const viewRecipeButtons = document.querySelectorAll('.view-recipe');
            
            // Add click event to all view recipe buttons
            viewRecipeButtons.forEach(button => {
                button.addEventListener('click', function() {
                    const recipeId = this.getAttribute('data-recipe-id');
                    const modal = new bootstrap.Modal(document.getElementById('recipeModal'));
                    
                    // Show the modal
                    modal.show();
                    
                    // Fetch recipe details
                    fetchRecipeDetails(recipeId);
                });
            });
            
            // Function to fetch recipe details
            function fetchRecipeDetails(recipeId) {
                // AJAX request to get recipe details
                fetch('action/get_recipe_details.php?id=' + recipeId)
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            displayRecipeDetails(data.recipe);
                            loadComments(recipeId);
                            
                            // Increment view count
                            incrementViewCount(recipeId);
                        } else {
                            document.getElementById('recipeModalContent').innerHTML = `
                                <div class="alert alert-danger">
                                    <i class="fas fa-exclamation-circle me-2"></i> ${data.message}
                                </div>
                            `;
                        }
                    })
                    .catch(error => {
                        console.error('Error fetching recipe details:', error);
                        document.getElementById('recipeModalContent').innerHTML = `
                            <div class="alert alert-danger">
                                <i class="fas fa-exclamation-circle me-2"></i> Error loading recipe details. Please try again.
                            </div>
                        `;
                    });
            }
            
            // Function to display recipe details in modal
            function displayRecipeDetails(recipe) {
                // Format ingredients
                let ingredientsList = '';
                recipe.ingredients.forEach(ingredient => {
                    ingredientsList += `<li>${ingredient.amount} ${ingredient.name}</li>`;
                });
                
                // Format instructions
                let instructionsList = '';
                recipe.instructions.forEach((instruction, index) => {
                    instructionsList += `
                        <div class="instruction-step">
                            <div class="step-number">${index + 1}</div>
                            <p>${instruction.step_description}</p>
                        </div>
                    `;
                });
                
                // Format tags
                let tagsList = '';
                if (recipe.tags && recipe.tags.length > 0) {
                    recipe.tags.forEach(tag => {
                        tagsList += `<a href="search.php?tag=${tag.tag_slug}" class="badge bg-secondary me-1">${tag.tag_name}</a>`;
                    });
                }
                
                // Calculate average rating
                let ratingStars = '';
                for (let i = 1; i <= a5; i++) {
                    if (i <= recipe.avg_rating) {
                        ratingStars += '<i class="fas fa-star"></i>';
                    } else if (i - 0.5 <= recipe.avg_rating) {
                        ratingStars += '<i class="fas fa-star-half-alt"></i>';
                    } else {
                        ratingStars += '<i class="far fa-star"></i>';
                    }
                }
                
                // Build HTML for recipe details
                const recipeHTML = `
                    <div class="row">
                        <div class="col-md-5">
                            <img src="${recipe.image_path}" class="recipe-detail-image" alt="${recipe.title}">
                            
                            <div class="mt-3">
                                <div class="d-flex justify-content-between align-items-center mb-2">
                                    <div class="rating">
                                        ${ratingStars}
                                        <span class="ms-1">(${recipe.avg_rating ? recipe.avg_rating.toFixed(1) : '0'}) • ${recipe.comment_count} reviews</span>
                                    </div>
                                </div>
                                
                                <div class="author-info mb-3">
                                    <img src="${recipe.author.profile_image}" class="author-avatar" alt="Author">
                                    <span>By ${recipe.author.name}</span>
                                </div>
                            </div>
                            
                            <div class="recipe-meta">
                                <div class="recipe-meta-item">
                                    <i class="fas fa-clock text-muted"></i>
                                    <span>Prep: ${recipe.prep_time} mins</span>
                                </div>
                                <div class="recipe-meta-item">
                                    <i class="fas fa-fire text-muted"></i>
                                    <span>Cook: ${recipe.cook_time} mins</span>
                                </div>
                                <div class="recipe-meta-item">
                                    <i class="fas fa-users text-muted"></i>
                                    <span>Serves: ${recipe.servings}</span>
                                </div>
                                ${recipe.calories ? `
                                <div class="recipe-meta-item">
                                    <i class="fas fa-bolt text-muted"></i>
                                    <span>${recipe.calories} calories</span>
                                </div>` : ''}
                            </div>
                            
                            <div class="mt-3">
                                <span class="badge bg-primary">${recipe.category_name}</span>
                                <span class="badge bg-${recipe.difficulty_slug === 'easy' ? 'success' : (recipe.difficulty_slug === 'medium' ? 'warning' : 'danger')}">
                                    ${recipe.difficulty_name}
                                </span>
                                ${tagsList}
                            </div>
                        </div>
                        
                        <div class="col-md-7">
                            <h3>${recipe.title}</h3>
                            <p>${recipe.description}</p>
                            
                            <div class="card mb-3">
                                <div class="card-header">
                                    <h5 class="mb-0"><i class="fas fa-list-ul me-2"></i>Ingredients</h5>
                                </div>
                                <div class="card-body">
                                    <ul class="ingredients-list">
                                        ${ingredientsList}
                                    </ul>
                                </div>
                            </div>
                            
                            <div class="card mb-3">
                                <div class="card-header">
                                    <h5 class="mb-0"><i class="fas fa-tasks me-2"></i>Instructions</h5>
                                </div>
                                <div class="card-body">
                                    ${instructionsList}
                                </div>
                            </div>
                            
                            ${recipe.notes ? `
                            <div class="card mb-3">
                                <div class="card-header">
                                    <h5 class="mb-0"><i class="fas fa-sticky-note me-2"></i>Notes</h5>
                                </div>
                                <div class="card-body">
                                    <p>${recipe.notes}</p>
                                </div>
                            </div>` : ''}
                        </div>
                </div>
                
                <!-- Comments Section -->
                <div class="row mt-4">
                    <div class="col-12">
                        <h4>Comments and Ratings</h4>
                        <div id="commentsContainer">
                            <div class="text-center">
                                <div class="spinner-border spinner-border-sm" role="status">
                                    <span class="visually-hidden">Loading comments...</span>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Comment form -->
                        ${recipe.user_can_comment ? `
                        <div class="card mt-4">
                            <div class="card-body">
                                <h5>Leave a Review</h5>
                                <form id="commentForm" data-recipe-id="${recipe.recipe_id}">
                                    <div class="mb-3">
                                        <label class="form-label">Your Rating</label>
                                        <div class="rating-input">
                                            <i class="far fa-star" data-rating="1"></i>
                                            <i class="far fa-star" data-rating="2"></i>
                                            <i class="far fa-star" data-rating="3"></i>
                                            <i class="far fa-star" data-rating="4"></i>
                                            <i class="far fa-star" data-rating="5"></i>
                                            <input type="hidden" name="rating" id="ratingInput" value="0">
                                        </div>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label">Your Comment</label>
                                        <textarea class="form-control" id="commentText" rows="3" required></textarea>
                                    </div>
                                    <button type="submit" class="btn btn-custom-primary">Submit Review</button>
                                </form>
                            </div>
                        </div>` : `
                        <div class="alert alert-info mt-4">
                            <i class="fas fa-info-circle me-2"></i> Please <a href="login.php" class="alert-link">log in</a> to leave a review.
                        </div>`}
                    </div>
                </div>
                `;
                
                document.getElementById('recipeModalContent').innerHTML = recipeHTML;
                
                // If user can comment, add event listeners for rating stars
                if (recipe.user_can_comment) {
                    const ratingStars = document.querySelectorAll('.rating-input .fa-star');
                    const ratingInput = document.getElementById('ratingInput');
                    
                    ratingStars.forEach(star => {
                        star.addEventListener('mouseover', function() {
                            const rating = this.getAttribute('data-rating');
                            highlightStars(rating);
                        });
                        
                        star.addEventListener('mouseout', function() {
                            const rating = ratingInput.value;
                            highlightStars(rating);
                        });
                        
                        star.addEventListener('click', function() {
                            const rating = this.getAttribute('data-rating');
                            ratingInput.value = rating;
                            highlightStars(rating);
                        });
                    });
                    // Function to highlight stars
                    function highlightStars(rating) {
                        ratingStars.forEach(star => {
                            const starRating = star.getAttribute('data-rating');
                            if (starRating <= rating) {
                                star.classList.remove('far');
                                star.classList.add('fas');
                            } else {
                                star.classList.remove('fas');
                                star.classList.add('far');
                            }
                        });
                    }
                    
                    // Handle comment form submission
                    const commentForm = document.getElementById('commentForm');
                    commentForm.addEventListener('submit', function(e) {
                        e.preventDefault();
                        
                        const recipeId = this.getAttribute('data-recipe-id');
                        const rating = document.getElementById('ratingInput').value;
                        const comment = document.getElementById('commentText').value;
                        
                        if (rating === '0') {
                            alert('Please select a rating.');
                            return;
                        }
                        
                        submitComment(recipeId, rating, comment);
                    });
                }
            }
            
            // Function to load comments
            function loadComments(recipeId) {
                fetch('action/get_comments.php?recipe_id=' + recipeId)
                    .then(response => response.json())
                    .then(data => {
                        if (data.success && data.comments.length > 0) {
                            let commentsHTML = '';
                            data.comments.forEach(comment => {
                                // Generate stars for rating
                                let stars = '';
                                for (let i = 1; i <= 5; i++) {
                                    if (i <= comment.rating) {
                                        stars += '<i class="fas fa-star text-warning"></i>';
                                    } else {
                                        stars += '<i class="far fa-star text-warning"></i>';
                                    }
                                }
                                
                                commentsHTML += `
                                    <div class="comment mb-3">
                                        <div class="d-flex">
                                            <img src="${comment.profile_image}" class="comment-avatar" alt="User">
                                            <div class="ms-3 w-100">
                                                <div class="d-flex justify-content-between">
                                                    <h6 class="mb-0">${comment.name}</h6>
                                                    <small class="text-muted">${comment.created_at}</small>
                                                </div>
                                                <div class="rating-small mb-2">${stars}</div>
                                                <p class="mb-0">${comment.comment_text}</p>
                                            </div>
                                        </div>
                                    </div>
                                `;
                            });
                            document.getElementById('commentsContainer').innerHTML = commentsHTML;
                        } else {
                            document.getElementById('commentsContainer').innerHTML = `
                                <div class="alert alert-light">
                                    <i class="far fa-comment-alt me-2"></i> No reviews yet. Be the first to review this recipe!
                                </div>
                            `;
                        }
                    })
                    .catch(error => {
                        console.error('Error loading comments:', error);
                        document.getElementById('commentsContainer').innerHTML = `
                            <div class="alert alert-danger">
                                <i class="fas fa-exclamation-circle me-2"></i> Error loading comments. Please try again.
                            </div>
                        `;
                    });
            }
            
            // Function to submit a comment
            function submitComment(recipeId, rating, comment) {
                // Show loading state
                const submitButton = document.querySelector('#commentForm button[type="submit"]');
                const originalButtonText = submitButton.innerHTML;
                submitButton.innerHTML = '<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Submitting...';
                submitButton.disabled = true;
                
                // Create form data
                const formData = new FormData();
                formData.append('recipe_id', recipeId);
                formData.append('rating', rating);
                formData.append('comment', comment);
                
                // Send AJAX request
                fetch('action/submit_comment.php', {
                    method: 'POST',
                    body: formData
                })
                .then(response => response.json())
                .then(data => {
                    // Reset button state
                    submitButton.innerHTML = originalButtonText;
                    submitButton.disabled = false;
                    
                    if (data.success) {
                        // Clear form
                        document.getElementById('ratingInput').value = '0';
                        document.getElementById('commentText').value = '';
                        document.querySelectorAll('.rating-input .fa-star').forEach(star => {
                            star.classList.remove('fas');
                            star.classList.add('far');
                        });
                        
                        // Show success message
                        alert('Your review has been submitted successfully!');
                        
                        // Reload comments
                        loadComments(recipeId);
                    } else {
                        alert(data.message || 'Error submitting your review. Please try again.');
                    }
                })
                .catch(error => {
                    console.error('Error submitting comment:', error);
                    submitButton.innerHTML = originalButtonText;
                    submitButton.disabled = false;
                    alert('An error occurred. Please try again.');
                });
            }
            
            // Function to increment view count
            function incrementViewCount(recipeId) {
                fetch('action/increment_view.php', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/x-www-form-urlencoded',
                    },
                    body: 'recipe_id=' + recipeId
                })
                .catch(error => console.error('Error incrementing view count:', error));
            }
        });
    </script>
</body>
</html>
                        