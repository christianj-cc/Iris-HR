<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome to Iris HR</title>
    <link rel="stylesheet" href="STYLES/stylesLanding.css">
    <link rel="icon" type="image/x-icon" href="ASSETS/ICONS/site-icon.ico">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@400;600&display=swap" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
</head>

<body>

    <!-- HEADER -->
    <header>
        <div class="logo">
            <a href="index.php"><img src="ASSETS/ICONS/logo-full.png" alt="Iris HR Logo"></a>
        </div>
        <nav>
            <a href="#home">Home</a>
            <a href="#features">Features</a>
            <a href="#clients">Clients</a>
            <a href="#testimonials">Testimonials</a>
            <a href="#contact">Contact</a>
            <a href="login.php" class="btn">Login</a>
        </nav>
    </header>

    <!-- HOME SECTION -->
    <section id="home" class="hero">
        <div class="hero-content">
            <h1>Empower Your Workforce with Iris HR</h1>
            <p>Streamline recruitment, payroll, and employee management in one place.</p>
            <a href="login.php" class="cta-button">Get Started</a>
        </div>
    </section>

    <!-- FEATURES SECTION -->
    <section id="features" class="features">
        <h2>Why Choose Iris HR?</h2>
        <div class="feature-container">
            <div class="feature">
                <i class="fas fa-briefcase"></i>
                <h3>Recruitment & Onboarding</h3>
                <p>Manage job postings, track applicants, and streamline onboarding.</p>
            </div>
            <div class="feature">
                <i class="fas fa-clock"></i>
                <h3>Attendance Tracking</h3>
                <p>Monitor employee attendance and working hours with ease.</p>
            </div>
            <div class="feature">
                <i class="fas fa-dollar-sign"></i>
                <h3>Payroll Management</h3>
                <p>Automate salary processing and deductions effortlessly.</p>
            </div>
        </div>
    </section>

    <!-- CLIENTS SECTION -->
    <section id="clients" class="clients">
        <h2>Our Trusted Clients</h2>
        <div class="client-logos">
            <img src="ASSETS/IMAGES/um logo.png" alt="Client 1">
            <img src="ASSETS/IMAGES/cce logo.jpg" alt="Client 2">
            <img src="ASSETS/IMAGES/cte logo.jpg" alt="Client 3">
        </div>
        <p>Join top businesses that trust Iris HR for efficient workforce management.</p>
    </section>

    <!-- TESTIMONIALS SECTION -->
    <section id="testimonials" class="testimonials">
        <h2>What Our Clients Say</h2>
        <div class="testimonial-container">
            <div class="testimonial">
                <img src="ASSETS/IMAGES/sarah.webp" alt="Client Photo">
                <p>"Iris HR has completely transformed how we manage our employees. Recruitment and payroll are now a breeze!"</p>
                <h3>- Sarah Thompson, HR Manager</h3>
            </div>
            <div class="testimonial">
                <img src="ASSETS/IMAGES/david.webp" alt="Client Photo">
                <p>"A game-changer for our company! The attendance tracking system helps us keep everything organized."</p>
                <h3>- David Lee, Operations Director</h3>
            </div>
            <div class="testimonial">
                <img src="ASSETS/IMAGES/amanda.webp" alt="Client Photo">
                <p>"Seamless and user-friendly. Our employees love the self-service features. Highly recommend!"</p>
                <h3>- Amanda Garcia, CEO</h3>
            </div>
        </div>
    </section>

    <!-- CONTACT SECTION -->
    <section id="contact" class="contact">
        <h2>Contact Us</h2>
        <p>Have questions? Reach out to us through any of the following channels:</p>
        <div class="contact-details">
            <div class="contact-item">
                <i class="fas fa-map-marker-alt"></i>
                <p>A. Pichon St / General Malvar St, <br> Davao City, PH </p>
            </div>
            <div class="contact-item">
                <i class="fas fa-envelope"></i>
                <p>support@irishr.com</p>
            </div>
            <div class="contact-item">
                <i class="fas fa-phone-alt"></i>
                <p>+63 912 345 6789</p>
            </div>
            <div class="contact-item">
                <i class="fas fa-clock"></i>
                <p>Mon - Fri: 9:00 AM - 6:00 PM</p>
            </div>
        </div>
        <div class="social-media">
            <p>Follow Us</p>
            <div class="social-icons">
                <a href="https://www.facebook.com/yourpage" target="_blank" aria-label="Facebook">
                    <i class="fab fa-facebook-f"></i>
                </a>
                <a href="https://twitter.com/yourprofile" target="_blank" aria-label="Twitter">
                    <i class="fab fa-twitter"></i>
                </a>
                <a href="mailto:support@irishr.com" aria-label="Email">
                    <i class="fas fa-envelope"></i>
                </a>
            </div>
        </div>
    </section>


    <!-- FOOTER -->
    <footer>
        <p>&copy; 2025 Iris HR. All rights reserved.</p>
    </footer>

    <!-- Smooth Scrolling -->
    <script>
        $(document).ready(function() {
            // Smooth scrolling for navigation
            $("nav a").on("click", function(event) {
                if (this.hash !== "") {
                    event.preventDefault();
                    var hash = this.hash;
                    $("html, body").animate({
                        scrollTop: $(hash).offset().top
                    }, 800);
                }
            });
        })
    </script>

</body>

</html>