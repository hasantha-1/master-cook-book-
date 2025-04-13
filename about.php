<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>About Us - Flavor Fusion</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&family=Pacifico&display=swap" rel="stylesheet">
    <!-- Custom CSS -->
    <link href="css/home.css" rel="stylesheet">
    <style>
        .team-member img {
            width: 150px;
            height: 150px;
            object-fit: cover;
            border-radius: 50%;
        }
        
        .timeline {
            position: relative;
            max-width: 1200px;
            margin: 0 auto;
        }
        
        .timeline::after {
            content: '';
            position: absolute;
            width: 6px;
            background-color: var(--primary-color);
            top: 0;
            bottom: 0;
            left: 50%;
            margin-left: -3px;
        }
        
        .timeline-container {
            padding: 10px 40px;
            position: relative;
            background-color: inherit;
            width: 50%;
        }
        
        .timeline-container::after {
            content: '';
            position: absolute;
            width: 25px;
            height: 25px;
            right: -13px;
            background-color: white;
            border: 4px solid var(--primary-color);
            top: 15px;
            border-radius: 50%;
            z-index: 1;
        }
        
        .left {
            left: 0;
        }
        
        .right {
            left: 50%;
        }
        
        .left::before {
            content: " ";
            height: 0;
            position: absolute;
            top: 22px;
            width: 0;
            z-index: 1;
            right: 30px;
            border: medium solid var(--light-bg);
            border-width: 10px 0 10px 10px;
            border-color: transparent transparent transparent var(--light-bg);
        }
        
        .right::before {
            content: " ";
            height: 0;
            position: absolute;
            top: 22px;
            width: 0;
            z-index: 1;
            left: 30px;
            border: medium solid var(--light-bg);
            border-width: 10px 10px 10px 0;
            border-color: transparent var(--light-bg) transparent transparent;
        }
        
        .right::after {
            left: -12px;
        }
        
        .timeline-content {
            padding: 20px 30px;
            background-color: var(--light-bg);
            position: relative;
            border-radius: 6px;
        }
        
        @media screen and (max-width: 600px) {
            .timeline::after {
                left: 31px;
            }
            
            .timeline-container {
                width: 100%;
                padding-left: 70px;
                padding-right: 25px;
            }
            
            .timeline-container::before {
                left: 60px;
                border: medium solid var(--light-bg);
                border-width: 10px 10px 10px 0;
                border-color: transparent var(--light-bg) transparent transparent;
            }
            
            .left::after, .right::after {
                left: 18px;
            }
            
            .right {
                left: 0%;
            }
        }
        
        .mission-vision-card {
            height: 100%;
            transition: transform 0.3s;
        }
        
        .mission-vision-card:hover {
            transform: translateY(-5px);
        }
        
        .testimonial-card {
            background-color: #fff;
            border-radius: 10px;
            padding: 30px;
            box-shadow: 0 5px 15px rgba(0,0,0,0.05);
            margin-bottom: 20px;
        }
        
        .testimonial-card img {
            width: 70px;
            height: 70px;
            border-radius: 50%;
            object-fit: cover;
        }
        
        :root {
            --primary-color: #FF6B6B;
            --secondary-color: #4ECDC4;
            --accent-color: #FFD166;
            --dark-bg: #2A363B;
            --light-bg: #F7F9FB;
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
                        <a class="nav-link active" href="about.php">About Us</a>
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
    <div class="container py-5">
        <div class="row align-items-center">
            <div class="col-lg-6">
                <h1 class="display-4 fw-bold mb-4">Our Story</h1>
                <p class="lead mb-4">Flavor Fusion began with a simple idea: make cooking accessible, enjoyable, and delicious for everyone.</p>
                <p class="mb-4">Founded in 2022 by a group of food enthusiasts with a passion for culinary exploration, Flavor Fusion has grown into a vibrant community of home cooks, professional chefs, and food lovers from around the world.</p>
                <p>Our mission is to inspire people to discover new flavors, techniques, and cuisines, while providing a platform to share their own culinary creations with others who share their passion for good food.</p>
            </div>
            <div class="col-lg-6">
                <img src="https://foodtank.com/wp-content/uploads/2021/07/alfons-morales-YLSwjSy7stw-unsplash.jpg" alt="Cooking together" class="img-fluid rounded shadow-sm">
            </div>
        </div>
    </div>

    <!-- Mission & Vision -->
    <div class="container py-5">
        <div class="text-center mb-5">
            <h2 class="fw-bold">Our Mission & Vision</h2>
            <p class="text-muted">What drives us forward</p>
        </div>
        <div class="row g-4">
            <div class="col-md-6">
                <div class="card mission-vision-card h-100 border-0 shadow-sm">
                    <div class="card-body p-4">
                        <div class="text-center mb-3">
                            <i class="fas fa-bullseye fa-3x" style="color: var(--primary-color);"></i>
                        </div>
                        <h3 class="card-title text-center mb-3">Our Mission</h3>
                        <p class="card-text">To empower people to cook confidently by providing accessible, reliable recipes and building a supportive community where culinary knowledge and passion can be shared freely.</p>
                        <p class="card-text">We believe that good food brings people together, and our platform aims to make cooking an enjoyable and rewarding experience for everyone, regardless of their skill level.</p>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card mission-vision-card h-100 border-0 shadow-sm">
                    <div class="card-body p-4">
                        <div class="text-center mb-3">
                            <i class="fas fa-eye fa-3x" style="color: var(--secondary-color);"></i>
                        </div>
                        <h3 class="card-title text-center mb-3">Our Vision</h3>
                        <p class="card-text">To become the world's most trusted and diverse recipe platform where every cuisine and cooking style is represented authentically, and where cultural culinary traditions are preserved and celebrated.</p>
                        <p class="card-text">We envision a global cooking community that transcends borders, bringing together food lovers from different backgrounds to share their unique perspectives and recipes.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Our Journey -->
    <div class="container py-5">
        <div class="text-center mb-5">
            <h2 class="fw-bold">Our Journey</h2>
            <p class="text-muted">How Flavor Fusion evolved over time</p>
        </div>
        <div class="timeline">
            <div class="timeline-container left">
                <div class="timeline-content">
                    <h3>2022</h3>
                    <p>Flavor Fusion was founded by three friends with a shared passion for cooking and technology.</p>
                </div>
            </div>
            <div class="timeline-container right">
                <div class="timeline-content">
                    <h3>2023</h3>
                    <p>Launched our first version with 500 recipes and attracted our first 10,000 users.</p>
                </div>
            </div>
            <div class="timeline-container left">
                <div class="timeline-content">
                    <h3>2024</h3>
                    <p>Expanded our team and reached 100,000 monthly users with a library of over 5,000 recipes.</p>
                </div>
            </div>
            <div class="timeline-container right">
                <div class="timeline-content">
                    <h3>2025</h3>
                    <p>Redesigned our platform with new features and expanded to include recipes from 50+ global cuisines.</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Meet the Team -->
    <div class="container py-5">
        <div class="text-center mb-5">
            <h2 class="fw-bold">Meet Our Team</h2>
            <p class="text-muted">The passionate people behind Flavor Fusion</p>
        </div>
        <div class="row g-4 justify-content-center text-center">
            <div class="col-md-4 col-lg-3">
                <div class="team-member mb-4">
                    <img src="https://images.unsplash.com/photo-1580489944761-15a19d654956?q=80&w=1000&auto=format&fit=crop&ixlib=rb-4.0.3" alt="Sarah Johnson" class="mb-3 mx-auto d-block shadow">
                    <h4>Sarah Johnson</h4>
                    <p class="text-muted">Founder & CEO</p>
                    <p class="small">Former chef with a passion for making cooking accessible to everyone.</p>
                    <div class="social-icons">
                        <a href="#" class="text-muted me-2"><i class="fab fa-linkedin"></i></a>
                        <a href="#" class="text-muted"><i class="fab fa-twitter"></i></a>
                    </div>
                </div>
            </div>
            <div class="col-md-4 col-lg-3">
                <div class="team-member mb-4">
                    <img src="https://images.unsplash.com/photo-1633332755192-727a05c4013d?q=80&w=1000&auto=format&fit=crop&ixlib=rb-4.0.3" alt="Michael Chen" class="mb-3 mx-auto d-block shadow">
                    <h4>Michael Chen</h4>
                    <p class="text-muted">CTO</p>
                    <p class="small">Tech enthusiast who believes in the power of digital platforms to transform cooking.</p>
                    <div class="social-icons">
                        <a href="#" class="text-muted me-2"><i class="fab fa-linkedin"></i></a>
                        <a href="#" class="text-muted"><i class="fab fa-github"></i></a>
                    </div>
                </div>
            </div>
            <div class="col-md-4 col-lg-3">
                <div class="team-member mb-4">
                    <img src="https://images.unsplash.com/photo-1494790108377-be9c29b29330?q=80&w=1000&auto=format&fit=crop&ixlib=rb-4.0.3" alt="Elena Rodriguez" class="mb-3 mx-auto d-block shadow">
                    <h4>Elena Rodriguez</h4>
                    <p class="text-muted">Head of Content</p>
                    <p class="small">Culinary school graduate with experience in food journalism and recipe development.</p>
                    <div class="social-icons">
                        <a href="#" class="text-muted me-2"><i class="fab fa-linkedin"></i></a>
                        <a href="#" class="text-muted"><i class="fab fa-instagram"></i></a>
                    </div>
                </div>
            </div>
            <div class="col-md-4 col-lg-3">
                <div class="team-member mb-4">
                    <img src="https://images.unsplash.com/photo-1507003211169-0a1dd7228f2d?q=80&w=1000&auto=format&fit=crop&ixlib=rb-4.0.3" alt="David Patel" class="mb-3 mx-auto d-block shadow">
                    <h4>David Patel</h4>
                    <p class="text-muted">UX Designer</p>
                    <p class="small">Creating intuitive and beautiful experiences for home cooks of all levels.</p>
                    <div class="social-icons">
                        <a href="#" class="text-muted me-2"><i class="fab fa-linkedin"></i></a>
                        <a href="#" class="text-muted"><i class="fab fa-dribbble"></i></a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Testimonials -->
    <div class="container py-5">
        <div class="text-center mb-5">
            <h2 class="fw-bold">What Our Users Say</h2>
            <p class="text-muted">Hear from the Flavor Fusion community</p>
        </div>
        <div class="row g-4">
            <div class="col-md-6">
                <div class="testimonial-card">
                    <div class="d-flex mb-3 align-items-center">
                        <img src="https://images.unsplash.com/photo-1599566150163-29194dcaad36?q=80&w=1000&auto=format&fit=crop&ixlib=rb-4.0.3" alt="User avatar" class="me-3">
                        <div>
                            <h5 class="mb-0">James Wilson</h5>
                            <p class="text-muted mb-0">Home Cook</p>
                        </div>
                    </div>
                    <div class="mb-2">
                        <i class="fas fa-star" style="color: #FFD700;"></i>
                        <i class="fas fa-star" style="color: #FFD700;"></i>
                        <i class="fas fa-star" style="color: #FFD700;"></i>
                        <i class="fas fa-star" style="color: #FFD700;"></i>
                        <i class="fas fa-star" style="color: #FFD700;"></i>
                    </div>
                    <p>"Flavor Fusion has completely transformed my cooking. I've discovered so many new recipes and techniques that I never would have tried otherwise. The step-by-step instructions make even complex dishes approachable."</p>
                </div>
            </div>
            <div class="col-md-6">
                <div class="testimonial-card">
                    <div class="d-flex mb-3 align-items-center">
                        <img src="https://images.unsplash.com/photo-1438761681033-6461ffad8d80?q=80&w=1000&auto=format&fit=crop&ixlib=rb-4.0.3" alt="User avatar" class="me-3">
                        <div>
                            <h5 class="mb-0">Maria Garcia</h5>
                            <p class="text-muted mb-0">Food Blogger</p>
                        </div>
                    </div>
                    <div class="mb-2">
                        <i class="fas fa-star" style="color: #FFD700;"></i>
                        <i class="fas fa-star" style="color: #FFD700;"></i>
                        <i class="fas fa-star" style="color: #FFD700;"></i>
                        <i class="fas fa-star" style="color: #FFD700;"></i>
                        <i class="fas fa-star-half-alt" style="color: #FFD700;"></i>
                    </div>
                    <p>"As a food blogger, I appreciate the community aspect of Flavor Fusion. Being able to share my own recipes and get feedback from other food enthusiasts has been invaluable. The platform is user-friendly and beautifully designed."</p>
                </div>
            </div>
            <div class="col-md-6">
                <div class="testimonial-card">
                    <div class="d-flex mb-3 align-items-center">
                        <img src="https://images.unsplash.com/photo-1552058544-f2b08422138a?q=80&w=1000&auto=format&fit=crop&ixlib=rb-4.0.3" alt="User avatar" class="me-3">
                        <div>
                            <h5 class="mb-0">Robert Kim</h5>
                            <p class="text-muted mb-0">Culinary Student</p>
                        </div>
                    </div>
                    <div class="mb-2">
                        <i class="fas fa-star" style="color: #FFD700;"></i>
                        <i class="fas fa-star" style="color: #FFD700;"></i>
                        <i class="fas fa-star" style="color: #FFD700;"></i>
                        <i class="fas fa-star" style="color: #FFD700;"></i>
                        <i class="far fa-star" style="color: #FFD700;"></i>
                    </div>
                    <p>"Flavor Fusion has been an incredible resource during my culinary studies. The diverse range of recipes from different cultures has expanded my culinary knowledge beyond what I learn in school."</p>
                </div>
            </div>
            <div class="col-md-6">
                <div class="testimonial-card">
                    <div class="d-flex mb-3 align-items-center">
                        <img src="https://images.unsplash.com/photo-1544005313-94ddf0286df2?q=80&w=1000&auto=format&fit=crop&ixlib=rb-4.0.3" alt="User avatar" class="me-3">
                        <div>
                            <h5 class="mb-0">Emily Thompson</h5>
                            <p class="text-muted mb-0">Busy Parent</p>
                        </div>
                    </div>
                    <div class="mb-2">
                        <i class="fas fa-star" style="color: #FFD700;"></i>
                        <i class="fas fa-star" style="color: #FFD700;"></i>
                        <i class="fas fa-star" style="color: #FFD700;"></i>
                        <i class="fas fa-star" style="color: #FFD700;"></i>
                        <i class="fas fa-star" style="color: #FFD700;"></i>
                    </div>
                    <p>"As a parent of three, I rely on Flavor Fusion for quick, healthy meal ideas. The meal planning feature has been a game changer for our busy household, and my kids love helping me choose new recipes to try."</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Values Section -->
    <div class="container py-5">
        <div class="text-center mb-5">
            <h2 class="fw-bold">Our Values</h2>
            <p class="text-muted">The principles that guide everything we do</p>
        </div>
        <div class="row g-4">
            <div class="col-md-4">
                <div class="card h-100 border-0 shadow-sm">
                    <div class="card-body p-4 text-center">
                        <div class="mb-3">
                            <i class="fas fa-users fa-3x" style="color: var(--primary-color);"></i>
                        </div>
                        <h3 class="card-title">Community</h3>
                        <p class="card-text">We believe in the power of community to inspire, teach, and support. Our platform is built to connect people through their shared love of food.</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card h-100 border-0 shadow-sm">
                    <div class="card-body p-4 text-center">
                        <div class="mb-3">
                            <i class="fas fa-globe fa-3x" style="color: var(--secondary-color);"></i>
                        </div>
                        <h3 class="card-title">Diversity</h3>
                        <p class="card-text">We celebrate the rich tapestry of global cuisines and cooking traditions, ensuring that our platform represents culinary voices from around the world.</p>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card h-100 border-0 shadow-sm">
                    <div class="card-body p-4 text-center">
                        <div class="mb-3">
                            <i class="fas fa-leaf fa-3x" style="color: var(--accent-color);"></i>
                        </div>
                        <h3 class="card-title">Sustainability</h3>
                        <p class="card-text">We're committed to promoting sustainable cooking practices, reducing food waste, and highlighting seasonal, local ingredients.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Join Us Call to Action -->
    <div class="container py-5">
        <div class="card border-0 p-5 text-center" style="background-color: var(--light-bg); border-radius: 15px;">
            <h2 class="fw-bold mb-3">Join Our Culinary Community</h2>
            <p class="lead mb-4">Share your recipes, discover new dishes, and connect with food lovers from around the world.</p>
            <div class="d-flex justify-content-center gap-3">
                <a href="login.php" class="btn btn-custom-primary btn-lg px-4">Sign Up</a>
                <a href="contact.php" class="btn btn-outline-secondary btn-lg px-4">Contact Us</a>
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
</body>
</html>