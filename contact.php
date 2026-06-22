
<?php
session_start();
require_once 'php/db_connect.php';
require_once 'php/functions.php';

$message = '';
$messageType = '';

// Check if form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get form data
    $name = sanitizeInput($_POST['name']);
    $email = sanitizeInput($_POST['email']);
    $content = sanitizeInput($_POST['message']);
    
    // Validate form data
    if (empty($name) || empty($email) || empty($content)) {
        $message = 'Please fill in all fields';
        $messageType = 'danger';
    } else if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $message = 'Please enter a valid email address';
        $messageType = 'danger';
    } else {
        // Save contact message to database
        $sql = "INSERT INTO contact_messages (name, email, message, created_at) VALUES ('$name', '$email', '$content', NOW())";
        
        if ($conn->query($sql) === TRUE) {
            $message = 'Your message has been sent successfully!';
            $messageType = 'success';
        } else {
            $message = 'Error: ' . $conn->error;
            $messageType = 'danger';
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact Us - Nepali E-Market Finder</title>
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
</head>
<body>
    <!-- Header -->
    <header>
        <div class="container">
            <div class="header-inner">
                <div class="logo">
                    <a href="index.html">Nepali<span>Tech</span></a>
                </div>
                <div class="menu-toggle">
                    <i class="fas fa-bars"></i>
                </div>
                <nav>
                    <ul class="nav-menu">
                        <li><a href="index.html">Home</a></li>
                        <li><a href="products.php">Products</a></li>
                        <li><a href="contact.php" class="active">Contact</a></li>
                        <li><a href="admin/login.php">Admin</a></li>
                    </ul>
                </nav>
            </div>
        </div>
    </header>

    <!-- Contact Section -->
    <section>
        <div class="container">
            <div class="section-header">
                <h2>Contact Us</h2>
            </div>
            
            <div style="max-width: 700px; margin: 0 auto;">
                <?php if (!empty($message)): ?>
                <div class="alert alert-<?php echo $messageType; ?>">
                    <?php echo $message; ?>
                </div>
                <?php endif; ?>
                
                <div class="product-detail">
                    <div style="padding: 2rem;">
                        <p style="margin-bottom: 2rem;">Have questions about products or want to suggest new products to add to our database? Fill out the form below and we'll get back to you as soon as possible.</p>
                        
                        <form method="post" action="contact.php">
                            <div class="form-group">
                                <label for="name">Full Name</label>
                                <input type="text" id="name" name="name" required>
                            </div>
                            
                            <div class="form-group">
                                <label for="email">Email Address</label>
                                <input type="email" id="email" name="email" required>
                            </div>
                            
                            <div class="form-group">
                                <label for="message">Message</label>
                                <textarea id="message" name="message" required></textarea>
                            </div>
                            
                            <div style="text-align: center;">
                                <button type="submit" class="btn btn-primary">Send Message</button>
                            </div>
                        </form>
                    </div>
                </div>
                
                <div style="margin-top: 2rem; text-align: center;">
                    <h3>Contact Information</h3>
                    <div style="display: flex; justify-content: center; gap: 2rem; margin-top: 1rem; flex-wrap: wrap;">
                        <div>
                            <div style="font-size: 2rem; color: var(--primary);"><i class="fas fa-map-marker-alt"></i></div>
                            <p>Kathmandu, Nepal</p>
                        </div>
                        
                        <div>
                            <div style="font-size: 2rem; color: var(--primary);"><i class="fas fa-phone"></i></div>
                            <p>+977-1-4123456</p>
                        </div>
                        
                        <div>
                            <div style="font-size: 2rem; color: var(--primary);"><i class="fas fa-envelope"></i></div>
                            <p>info@nepalitech.com</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer>
        <div class="container">
            <div class="footer-columns">
                <div class="footer-column">
                    <h3>NepaliTech</h3>
                    <p>Your go-to place for finding electronic products available in the Nepali market with detailed specifications and availability status.</p>
                </div>
                
                <div class="footer-column">
                    <h3>Quick Links</h3>
                    <ul>
                        <li><a href="index.html">Home</a></li>
                        <li><a href="products.php">Products</a></li>
                        <li><a href="contact.php">Contact</a></li>
                        <li><a href="admin/login.php">Admin</a></li>
                    </ul>
                </div>
                
                <div class="footer-column">
                    <h3>Categories</h3>
                    <ul>
                        <li><a href="products.php?category=phone">Smartphones</a></li>
                        <li><a href="products.php?category=laptop">Laptops</a></li>
                        <li><a href="products.php?category=tablet">Tablets</a></li>
                        <li><a href="products.php">All Products</a></li>
                    </ul>
                </div>
                
                <div class="footer-column">
                    <h3>Contact Us</h3>
                    <ul>
                        <li><i class="fas fa-map-marker-alt"></i> Kathmandu, Nepal</li>
                        <li><i class="fas fa-phone"></i> +977-1-4123456</li>
                        <li><i class="fas fa-envelope"></i> info@nepalitech.com</li>
                    </ul>
                </div>
            </div>
            
            <div class="copyright">
                <p>&copy; 2025 Nepali Tech. All rights reserved.</p>
            </div>
        </div>
    </footer>

    <script src="js/script.js"></script>
</body>
</html>
