
<?php
session_start();
require_once '../php/functions.php';

$error = '';

// Check if already logged in
if (isset($_SESSION['admin_logged_in']) && $_SESSION['admin_logged_in'] === true) {
    header("Location: dashboard.php");
    exit();
}

// Check if form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = trim($_POST['username']);
    $password = trim($_POST['password']);
    
    // Hardcoded admin credentials for now
    if ($username === 'admin' && $password === '1234') {
        $_SESSION['admin_logged_in'] = true;
        $_SESSION['admin_username'] = $username;
        header("Location: dashboard.php");
        exit();
    } else {
        $error = 'Invalid username or password';
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login - Nepali E-Market Finder</title>
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
</head>
<body>
    <!-- Header -->
    <header>
        <div class="container">
            <div class="header-inner">
                <div class="logo">
                    <a href="../index.html">Nepali<span>Tech</span></a>
                </div>
                <div class="menu-toggle">
                    <i class="fas fa-bars"></i>
                </div>
                <nav>
                    <ul class="nav-menu">
                        <li><a href="../index.html">Home</a></li>
                        <li><a href="../products.php">Products</a></li>
                        <li><a href="../contact.php">Contact</a></li>
                        <li><a href="login.php" class="active">Admin</a></li>
                    </ul>
                </nav>
            </div>
        </div>
    </header>

    <!-- Login Section -->
    <section>
        <div class="container">
            <div class="login-container">
                <h2>Admin Login</h2>
                
                <?php if (!empty($error)): ?>
                <div class="alert alert-danger">
                    <?php echo $error; ?>
                </div>
                <?php endif; ?>
                
                <form method="post" action="login.php">
                    <div class="form-group">
                        <label for="username">Username</label>
                        <input type="text" id="username" name="username" required>
                    </div>
                    
                    <div class="form-group">
                        <label for="password">Password</label>
                        <input type="password" id="password" name="password" required>
                    </div>
                    
                    <div style="text-align: center;">
                        <button type="submit" class="btn btn-primary">Login</button>
                    </div>
                </form>
                
                <div style="margin-top: 1.5rem; text-align: center;">
                    <p style="color: var(--gray); font-size: 0.9rem;">Demo credentials: username: admin, password: 1234</p>
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
                        <li><a href="../index.html">Home</a></li>
                        <li><a href="../products.php">Products</a></li>
                        <li><a href="../contact.php">Contact</a></li>
                        <li><a href="login.php">Admin</a></li>
                    </ul>
                </div>
                
                <div class="footer-column">
                    <h3>Categories</h3>
                    <ul>
                        <li><a href="../products.php?category=phone">Smartphones</a></li>
                        <li><a href="../products.php?category=laptop">Laptops</a></li>
                        <li><a href="../products.php?category=tablet">Tablets</a></li>
                        <li><a href="../products.php">All Products</a></li>
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

    <script src="../js/script.js"></script>
</body>
</html>