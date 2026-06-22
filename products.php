
<?php
session_start();
require_once 'php/db_connect.php';
require_once 'php/functions.php';

// Get filters from URL parameters
$search = isset($_GET['search']) ? sanitizeInput($_GET['search']) : '';
$category = isset($_GET['category']) ? sanitizeInput($_GET['category']) : '';
$brand = isset($_GET['brand']) ? sanitizeInput($_GET['brand']) : '';
$max_price = isset($_GET['max_price']) ? (int)$_GET['max_price'] : getMaxProductPrice();

// Build SQL query based on filters
$sql = "SELECT * FROM products WHERE 1=1";

if (!empty($search)) {
    $sql .= " AND (name LIKE '%$search%' OR brand LIKE '%$search%' OR specs LIKE '%$search%')";
}

if (!empty($category)) {
    $sql .= " AND category = '$category'";
}

if (!empty($brand)) {
    $sql .= " AND brand = '$brand'";
}

$sql .= " AND price <= $max_price ORDER BY name ASC";

// Execute query
$result = $conn->query($sql);

// Get all brands and categories for filter dropdowns
$allBrands = getAllBrands();
$allCategories = getAllCategories();
$maxPrice = getMaxProductPrice();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Products - Nepali E-Market Finder</title>
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

    <!-- Products Section -->
    <section>
        <div class="container">
            <div class="section-header">
                <h2>Browse Products</h2>
            </div>
            
            <!-- Search Bar -->
            <div class="search-bar">
                <form id="search-form">
                    <input type="text" id="search-input" placeholder="Search for products..." value="<?php echo htmlspecialchars($search); ?>">
                    <button type="submit"><i class="fas fa-search"></i></button>
                </form>
            </div>
            
            <div style="display: grid; grid-template-columns: 1fr 3fr; gap: 1.5rem;">
                <!-- Filter Section -->
                <div class="filter-section">
                    <h3>Filter Products</h3>
                    <form id="filter-form">
                        <div class="filter-group">
                            <label for="category">Category:</label>
                            <select id="category" name="category">
                                <option value="">All Categories</option>
                                <?php foreach($allCategories as $cat): ?>
                                <option value="<?php echo htmlspecialchars($cat); ?>" <?php if($category === $cat) echo 'selected'; ?>>
                                    <?php echo htmlspecialchars(ucfirst($cat)); ?>
                                </option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        
                        <div class="filter-group">
                            <label for="brand">Brand:</label>
                            <select id="brand" name="brand">
                                <option value="">All Brands</option>
                                <?php foreach($allBrands as $b): ?>
                                <option value="<?php echo htmlspecialchars($b); ?>" <?php if($brand === $b) echo 'selected'; ?>>
                                    <?php echo htmlspecialchars($b); ?>
                                </option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        
                        <div class="filter-group">
                            <label for="price-range">Max Price:</label>
                            <input type="range" id="price-range" name="price-range" min="0" max="<?php echo $maxPrice; ?>" step="5000" value="<?php echo $max_price; ?>">
                            <div class="price-range">
                                <span>0 NPR</span>
                                <span id="price-output"><?php echo $max_price; ?> NPR</span>
                                <span><?php echo $maxPrice; ?> NPR</span>
                            </div>
                        </div>
                        
                        <div class="filter-buttons">
                            <button type="submit" class="btn btn-primary">Apply Filters</button>
                            <button type="button" id="reset-filters" class="btn btn-outline">Reset</button>
                        </div>
                    </form>
                </div>
                
                <!-- Products Grid -->
                <div>
                    <div class="products-grid">
                        <?php
                        if ($result && $result->num_rows > 0) {
                            while($row = $result->fetch_assoc()) {
                        ?>
                        <a href="product-detail.php?id=<?php echo $row['id']; ?>" class="product-card">
                            <img src="<?php echo htmlspecialchars($row['image_url']); ?>" alt="<?php echo htmlspecialchars($row['name']); ?>" class="product-image">
                            <div class="product-info">
                                <h3 class="product-name"><?php echo htmlspecialchars($row['name']); ?></h3>
                                <div class="product-price"><?php echo formatPrice($row['price']); ?></div>
                                <div class="product-brand"><?php echo htmlspecialchars($row['brand']); ?></div>
                                <div class="product-availability <?php echo $row['availability'] ? 'in-stock' : 'out-of-stock'; ?>">
                                    <?php echo $row['availability'] ? 'In Stock' : 'Out of Stock'; ?>
                                </div>
                            </div>
                        </a>
                        <?php
                            }
                        } else {
                            echo '<div style="grid-column: span 3; text-align: center; padding: 2rem;">';
                            echo '<p>No products found matching your criteria.</p>';
                            echo '</div>';
                        }
                        ?>
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
