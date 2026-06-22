
<?php
session_start();
require_once 'php/db_connect.php';
require_once 'php/functions.php';

// Get product ID from URL parameter
$product_id = isset($_GET['id']) ? (int)$_GET['id'] : 0;

// Check if product ID is valid
if ($product_id <= 0) {
    header("Location: products.php");
    exit();
}

// Get product details
$sql = "SELECT * FROM products WHERE id = $product_id";
$result = $conn->query($sql);

// Check if product exists
if (!$result || $result->num_rows == 0) {
    header("Location: products.php");
    exit();
}

// Get product data
$product = $result->fetch_assoc();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo htmlspecialchars($product['name']); ?> - Nepali E-Market Finder</title>
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
                        <li><a href="products.php" class="active">Products</a></li>
                        <li><a href="contact.php">Contact</a></li>
                        <li><a href="admin/login.php">Admin</a></li>
                    </ul>
                </nav>
            </div>
        </div>
    </header>

    <!-- Product Detail Section -->
    <section>
        <div class="container">
            <div style="margin: 1rem 0;">
                <a href="products.php" class="btn btn-outline">
                    <i class="fas fa-arrow-left"></i> Back to Products
                </a>
            </div>
            
            <div class="product-detail">
                <div class="product-detail-inner">
                    <div>
                        <img src="<?php echo htmlspecialchars($product['image_url']); ?>" alt="<?php echo htmlspecialchars($product['name']); ?>" class="product-detail-image">
                    </div>
                    
                    <div class="product-detail-info">
                        <div class="product-detail-header">
                            <h1 class="product-detail-name"><?php echo htmlspecialchars($product['name']); ?></h1>
                            <div class="product-detail-brand"><?php echo htmlspecialchars($product['brand']); ?></div>
                            <div class="product-detail-price"><?php echo formatPrice($product['price']); ?></div>
                            <div class="product-detail-availability <?php echo $product['availability'] ? 'in-stock' : 'out-of-stock'; ?>">
                                <?php echo $product['availability'] ? 'In Stock' : 'Out of Stock'; ?>
                            </div>
                        </div>
                        
                        <div class="product-detail-specs">
                            <h3>Specifications</h3>
                            <div class="specs-list">
                                <?php
                                // Parse and display specifications
                                $specs = explode("\n", $product['specs']);
                                foreach ($specs as $spec) {
                                    if (!empty(trim($spec))) {
                                        // Split spec into key and value if they're separated by a colon
                                        $specParts = explode(':', $spec, 2);
                                        if (count($specParts) > 1) {
                                            echo '<li><strong>' . htmlspecialchars(trim($specParts[0])) . ':</strong> ' . htmlspecialchars(trim($specParts[1])) . '</li>';
                                        } else {
                                            echo '<li>' . htmlspecialchars(trim($spec)) . '</li>';
                                        }
                                    }
                                }
                                ?>
                            </div>
                        </div>
                        
                        <div>
                            <h3>Category</h3>
                            <p><?php echo htmlspecialchars(ucfirst($product['category'])); ?></p>
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
