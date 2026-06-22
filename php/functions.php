<?php
// Helper functions for Nepali E-Market Finder

// Format price with NPR currency
function formatPrice($price) {
    return 'NPR ' . number_format($price, 0, '.', ',');
}

// Sanitize input to prevent SQL injection
function sanitizeInput($input) {
    global $conn;
    return $conn->real_escape_string(trim($input));
}

// Get all unique brands from database
function getAllBrands() {
    global $conn;
    $brands = [];
    
    $sql = "SELECT DISTINCT brand FROM products ORDER BY brand";
    $result = $conn->query($sql);
    
    if ($result && $result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            $brands[] = $row['brand'];
        }
    }
    
    return $brands;
}

// Get all unique categories from database
function getAllCategories() {
    global $conn;
    $categories = [];
    
    $sql = "SELECT DISTINCT category FROM products ORDER BY category";
    $result = $conn->query($sql);
    
    if ($result && $result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            $categories[] = $row['category'];
        }
    }
    
    return $categories;
}

// Get maximum product price from database
function getMaxProductPrice() {
    global $conn;
    
    $sql = "SELECT MAX(price) as max_price FROM products";
    $result = $conn->query($sql);
    
    if ($result && $result->num_rows > 0) {
        $row = $result->fetch_assoc();
        return ceil($row['max_price']);
    }
    
    return 100000; // Default max price if no products
}

// Check if user is logged in as admin
function isAdminLoggedIn() {
    return isset($_SESSION['admin_logged_in']) && $_SESSION['admin_logged_in'] === true;
}

// Redirect to a URL
function redirect($url) {
    header("Location: $url");
    exit();
}

// Display alert message
function showAlert($message, $type = 'info') {
    return '<div class="alert alert-' . $type . '">' . $message . '</div>';
}
?>
