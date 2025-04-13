<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact Us - Flavor Fusion</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&family=Pacifico&display=swap" rel="stylesheet">
    <!-- Custom CSS -->
    <link href="css/home.css" rel="stylesheet">
    <style>
        .contact-icon {
            font-size: 2.5rem;
            margin-bottom: 1rem;
            color: var(--primary-color);
        }
        .form-control:focus {
            border-color: var(--primary-color);
            box-shadow: 0 0 0 0.25rem rgba(255, 107, 107, 0.25);
        }
        .contact-card {
            transition: transform 0.3s;
            height: 100%;
        }
        .contact-card:hover {
            transform: translateY(-5px);
        }
        .map-container {
            height: 400px;
            border-radius: 15px;
            overflow: hidden;
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
                        <a class="nav-link active" href="contact.php">Contact Us</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="login.php">Login</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Page Header -->
    <div class="container mt-5">
        <div class="row">
            <div class="col-12 text-center">
                <h1 class="fw-bold mb-3">Contact Us</h1>
                <p class="lead mb-5">Have questions or feedback? We'd love to hear from you!</p>
            </div>
        </div>
    </div>

    <!-- Contact Info Cards -->
    <div class="container mb-5">
        <div class="row g-4">
            <div class="col-md-4">
                <div class="card contact-card text-center p-4 shadow-sm">
                    <div class="card-body">
                        <i class="fas fa-envelope contact-icon"></i>
                        <h5 class="card-title mb-3">Email Us</h5>
                        <p class="card-text">We'll respond to your inquiry within 24 hours</p>
                        <a href="mailto:hello@flavorfusion.com" class="btn btn-outline-primary mt-3">hello@flavorfusion.com</a>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card contact-card text-center p-4 shadow-sm">
                    <div class="card-body">
                        <i class="fas fa-phone-alt contact-icon"></i>
                        <h5 class="card-title mb-3">Call Us</h5>
                        <p class="card-text">Available Monday-Friday from 9am to 5pm</p>
                        <a href="tel:+11234567890" class="btn btn-outline-primary mt-3">+1 (123) 456-7890</a>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card contact-card text-center p-4 shadow-sm">
                    <div class="card-body">
                        <i class="fas fa-map-marker-alt contact-icon"></i>
                        <h5 class="card-title mb-3">Visit Us</h5>
                        <p class="card-text">Come say hello at our office</p>
                        <address class="mt-3">
                            123 Culinary Street<br>
                            Food District, FL 12345<br>
                            United States
                        </address>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Contact Form Section -->
    <div class="container mb-5">
        <div class="card border-0 shadow-sm" style="border-radius: 15px;">
            <div class="card-body p-4 p-md-5">
                <div class="row">
                    <div class="col-lg-6 mb-4 mb-lg-0">
                        <h3 class="fw-bold mb-4">Send Us a Message</h3>
                        <p class="mb-4">Fill out the form and we'll get back to you as soon as possible.</p>
                        
                        <?php
                        // Process form submission
                        if(isset($_POST['submit'])) {
                            $name = htmlspecialchars($_POST['name']);
                            $email = htmlspecialchars($_POST['email']);
                            $subject = htmlspecialchars($_POST['subject']);
                            $message = htmlspecialchars($_POST['message']);
                            
                            // Here you would normally process the form data, such as sending an email
                            // For this example, we'll just display a success message
                            $success = true;
                        }
                        ?>

                        <?php if(isset($success)): ?>
                            <div class="alert alert-success">
                                Thank you for your message! We'll get back to you soon.
                            </div>
                        <?php endif; ?>
                        
                        <form method="post" action="">
                            <div class="mb-3">
                                <label for="name" class="form-label">Your Name</label>
                                <input type="text" class="form-control" id="name" name="name" required>
                            </div>
                            <div class="mb-3">
                                <label for="email" class="form-label">Email Address</label>
                                <input type="email" class="form-control" id="email" name="email" required>
                            </div>
                            <div class="mb-3">
                                <label for="subject" class="form-label">Subject</label>
                                <input type="text" class="form-control" id="subject" name="subject" required>
                            </div>
                            <div class="mb-3">
                                <label for="message" class="form-label">Message</label>
                                <textarea class="form-control" id="message" name="message" rows="5" required></textarea>
                            </div>
                            <button type="submit" name="submit" class="btn btn-custom-primary">Send Message</button>
                        </form>
                    </div>
                    <div class="col-lg-6">
                        <div class="map-container">
                            <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3024.2219901290355!2d-74.00658682312053!3d40.71277839367222!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x89c25a23e28c1191%3A0x49f75d3281df052a!2s123%20Broadway%2C%20New%20York%2C%20NY%2010006%2C%20USA!5e0!3m2!1sen!2sus!4v1679331141564!5m2!1sen!2sus" 
                                width="100%" height="100%" style="border:0;" allowfullscreen="" loading="lazy" 
                                referrerpolicy="no-referrer-when-downgrade"></iframe>
                        </div>
                        <div class="mt-4">
                            <h5 class="fw-bold mb-3">Office Hours</h5>
                            <ul class="list-unstyled">
                                <li class="mb-2"><strong>Monday-Friday:</strong> 9:00 AM - 5:00 PM</li>
                                <li class="mb-2"><strong>Saturday:</strong> 10:00 AM - 2:00 PM</li>
                                <li><strong>Sunday:</strong> Closed</li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- FAQ Section -->
    <div class="container mb-5">
        <div class="row mb-4">
            <div class="col-12 text-center">
                <h2 class="fw-bold">Frequently Asked Questions</h2>
                <p class="text-muted">Find answers to our most commonly asked questions</p>
            </div>
        </div>
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="accordion" id="faqAccordion">
                    <!-- FAQ Item 1 -->
                    <div class="accordion-item border mb-3 rounded shadow-sm">
                        <h2 class="accordion-header" id="headingOne">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                data-bs-target="#collapseOne" aria-expanded="false" aria-controls="collapseOne">
                                How do I submit my own recipe?
                            </button>
                        </h2>
                        <div id="collapseOne" class="accordion-collapse collapse" aria-labelledby="headingOne"
                            data-bs-parent="#faqAccordion">
                            <div class="accordion-body">
                                You can submit your own recipe by navigating to the "Add Recipe" page from the main menu. 
                                Fill out the recipe form with all the required details including ingredients, steps, cooking time, 
                                and photos of your dish. Once submitted, our team will review your recipe before publishing it.
                            </div>
                        </div>
                    </div>
                    <!-- FAQ Item 2 -->
                    <div class="accordion-item border mb-3 rounded shadow-sm">
                        <h2 class="accordion-header" id="headingTwo">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                                How do I save my favorite recipes?
                            </button>
                        </h2>
                        <div id="collapseTwo" class="accordion-collapse collapse" aria-labelledby="headingTwo"
                            data-bs-parent="#faqAccordion">
                            <div class="accordion-body">
                                To save your favorite recipes, you'll need to create an account and log in. Once logged in, 
                                you can click the "Save" button on any recipe page. All saved recipes can be accessed from your 
                                user profile under "My Favorites."
                            </div>
                        </div>
                    </div>
                    <!-- FAQ Item 3 -->
                    <div class="accordion-item border mb-3 rounded shadow-sm">
                        <h2 class="accordion-header" id="headingThree">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                data-bs-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                                Can I modify the serving size of recipes?
                            </button>
                        </h2>
                        <div id="collapseThree" class="accordion-collapse collapse" aria-labelledby="headingThree"
                            data-bs-parent="#faqAccordion">
                            <div class="accordion-body">
                                Yes! On each recipe page, you'll find a serving size adjuster. Simply change the number of 
                                servings, and our system will automatically recalculate all ingredient quantities for you.
                            </div>
                        </div>
                    </div>
                    <!-- FAQ Item 4 -->
                    <div class="accordion-item border mb-3 rounded shadow-sm">
                        <h2 class="accordion-header" id="headingFour">
                            <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                data-bs-target="#collapseFour" aria-expanded="false" aria-controls="collapseFour">
                                How do I subscribe to the newsletter?
                            </button>
                        </h2>
                        <div id="collapseFour" class="accordion-collapse collapse" aria-labelledby="headingFour"
                            data-bs-parent="#faqAccordion">
                            <div class="accordion-body">
                                You can subscribe to our newsletter by entering your email address in the subscription box 
                                at the bottom of our homepage. You'll receive weekly recipe updates, cooking tips, and exclusive content.
                            </div>
                        </div>
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
        document.addEventListener('DOMContentLoaded', function() {
            // Form validation
            const form = document.querySelector('form');
            if (form) {
                form.addEventListener('submit', function(event) {
                    const name = document.getElementById('name');
                    const email = document.getElementById('email');
                    const message = document.getElementById('message');
                    
                    let isValid = true;
                    
                    if (name.value.trim() === '') {
                        isValid = false;
                        name.classList.add('is-invalid');
                    } else {
                        name.classList.remove('is-invalid');
                    }
                    
                    if (email.value.trim() === '' || !isValidEmail(email.value)) {
                        isValid = false;
                        email.classList.add('is-invalid');
                    } else {
                        email.classList.remove('is-invalid');
                    }
                    
                    if (message.value.trim() === '') {
                        isValid = false;
                        message.classList.add('is-invalid');
                    } else {
                        message.classList.remove('is-invalid');
                    }
                    
                    if (!isValid) {
                        event.preventDefault();
                    }
                });
            }
            
            function isValidEmail(email) {
                const regex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
                return regex.test(email);
            }
        });
    </script>
</body>
</html>