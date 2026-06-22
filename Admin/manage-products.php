<?php
session_start();
require_once '../php/db_connect.php';
require_once '../php/functions.php';

// Check if user is logged in
if (!isAdminLoggedIn()) {
    header("Location: login.php");
    exit();
}

// Initialize variables
$action = isset($_GET['action']) ? $_GET['action'] : '';
$productId = isset($_GET['id']) ? (int)$_GET['id'] : 0;
$message = '';
$messageType = '';

// Process product deletion
if ($action === 'delete' && $productId > 0) {
    // Get product image path to delete the file
    $sql = "SELECT image_url FROM products WHERE id = $productId";
    $result = $conn->query($sql);
    if ($result && $result->num_rows > 0) {
        $product = $result->fetch_assoc();
        $imagePath = '../' . $product['image_url'];
        if (file_exists($imagePath) && strpos($product['image_url'], 'img/uploads/') === 0) {
            unlink($imagePath);
        }
    }
    
    $sql = "DELETE FROM products WHERE id = $productId";
    if ($conn->query($sql) === TRUE) {
        $message = 'Product deleted successfully';
        $messageType = 'success';
    } else {
        $message = 'Error deleting product: ' . $conn->error;
        $messageType = 'danger';
    }
    $action = ''; // Reset action after deletion
}

// Process form submission for add/edit
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get form data
    $name = sanitizeInput($_POST['name']);
    $brand = sanitizeInput($_POST['brand']);
    $category = sanitizeInput($_POST['category']);
    $price = (float)$_POST['price'];
    $specs = sanitizeInput($_POST['specs']);
    $availability = isset($_POST['availability']) ? 1 : 0;
    
    // Handle image upload
    $imageUrl = '';
    $uploadError = '';
    
    if (isset($_FILES['product_image']) && $_FILES['product_image']['error'] == 0) {
        $uploadDir = '../img/uploads/';
        
        // Create uploads directory if it doesn't exist
        if (!file_exists($uploadDir)) {
            mkdir($uploadDir, 0777, true);
        }
        
        $fileName = $_FILES['product_image']['name'];
        $fileSize = $_FILES['product_image']['size'];
        $fileTmpName = $_FILES['product_image']['tmp_name'];
        $fileType = $_FILES['product_image']['type'];
        $fileExt = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));
        
        // Allowed extensions
        $allowedExtensions = ['jpg', 'jpeg', 'png', 'gif', 'webp'];
        
        if (in_array($fileExt, $allowedExtensions)) {
            if ($fileSize < 5000000) { // 5MB limit
                $newFileName = uniqid() . '.' . $fileExt;
                $uploadPath = $uploadDir . $newFileName;
                
                if (move_uploaded_file($fileTmpName, $uploadPath)) {
                    $imageUrl = 'img/uploads/' . $newFileName;
                } else {
                    $uploadError = 'Failed to upload image';
                }
            } else {
                $uploadError = 'Image size too large (max 5MB)';
            }
        } else {
            $uploadError = 'Invalid file type. Allowed: jpg, jpeg, png, gif, webp';
        }
    } else if ($_POST['form_action'] === 'edit' && isset($_POST['product_id'])) {
        // For edit, keep existing image if no new image uploaded
        $productId = (int)$_POST['product_id'];
        $sql = "SELECT image_url FROM products WHERE id = $productId";
        $result = $conn->query($sql);
        if ($result && $result->num_rows > 0) {
            $existingProduct = $result->fetch_assoc();
            $imageUrl = $existingProduct['image_url'];
        }
    }
    
    // Validate form data
    if (empty($name) || empty($brand) || empty($category) || $price <= 0) {
        $message = 'Please fill in all required fields';
        $messageType = 'danger';
    } else if ($_POST['form_action'] === 'add' && empty($imageUrl) && empty($uploadError)) {
        $message = 'Please upload a product image';
        $messageType = 'danger';
    } else if (!empty($uploadError)) {
        $message = $uploadError;
        $messageType = 'danger';
    } else {
        if ($_POST['form_action'] === 'add') {
            // Insert new product
            $sql = "INSERT INTO products (name, brand, category, price, specs, image_url, availability) VALUES ('$name', '$brand', '$category', $price, '$specs', '$imageUrl', $availability)";
            
            if ($conn->query($sql) === TRUE) {
                $message = 'Product added successfully';
                $messageType = 'success';
                $action = ''; // Reset action after successful addition
            } else {
                $message = 'Error adding product: ' . $conn->error;
                $messageType = 'danger';
            }
        } else if ($_POST['form_action'] === 'edit' && isset($_POST['product_id'])) {
            // Update existing product
            $productId = (int)$_POST['product_id'];
            $sql = "UPDATE products SET name='$name', brand='$brand', category='$category', price=$price, specs='$specs', image_url='$imageUrl', availability=$availability WHERE id=$productId";
            
            if ($conn->query($sql) === TRUE) {
                $message = 'Product updated successfully';
                $messageType = 'success';
                $action = ''; // Reset action after successful update
            } else {
                $message = 'Error updating product: ' . $conn->error;
                $messageType = 'danger';
            }
        }
    }
}

// Load product data for editing
$product = null;
if ($action === 'edit' && $productId > 0) {
    $sql = "SELECT * FROM products WHERE id = $productId";
    $result = $conn->query($sql);
    
    if ($result && $result->num_rows > 0) {
        $product = $result->fetch_assoc();
    } else {
        $message = 'Product not found';
        $messageType = 'danger';
        $action = '';
    }
}

// Get all products for listing
$products = [];
if (empty($action)) {
    $sql = "SELECT * FROM products ORDER BY name ASC";
    $result = $conn->query($sql);
    
    if ($result && $result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            $products[] = $row;
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Products - Nepali E-Market Finder</title>
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
                <nav>
                    <ul class="nav-menu">
                        <li><a href="../index.html">Home</a></li>
                        <li><a href="../products.php">Products</a></li>
                        <li><a href="../contact.php">Contact</a></li>
                        <li><a href="dashboard.php" class="active">Admin</a></li>
                    </ul>
                </nav>
            </div>
        </div>
    </header>

    <!-- Admin Dashboard -->
    <section>
        <div class="container">
            <div class="admin-container">
                <!-- Admin Sidebar -->
                <div class="admin-sidebar">
                    <h3>Admin Panel</h3>
                    <ul>
                        <li><a href="dashboard.php">Dashboard</a></li>
                        <li><a href="manage-products.php" class="active">Manage Products</a></li>
                        <li><a href="logout.php">Logout</a></li>
                    </ul>
                </div>
                
                <!-- Admin Content -->
                <div class="admin-content">
                    <?php if (!empty($message)): ?>
                    <div class="alert alert-<?php echo $messageType; ?>">
                        <?php echo $message; ?>
                    </div>
                    <?php endif; ?>
                    
                    <?php if ($action === 'add' || $action === 'edit'): ?>
                    <!-- Add/Edit Product Form -->
                    <div class="admin-header">
                        <h2><?php echo $action === 'add' ? 'Add New Product' : 'Edit Product'; ?></h2>
                    </div>
                    
                    <form method="post" action="manage-products.php" enctype="multipart/form-data">
                        <input type="hidden" name="form_action" value="<?php echo $action; ?>">
                        <?php if ($action === 'edit'): ?>
                        <input type="hidden" name="product_id" value="<?php echo $productId; ?>">
                        <?php endif; ?>
                        
                        <div class="form-group">
                            <label for="name">Product Name*</label>
                            <input type="text" id="name" name="name" value="<?php echo $action === 'edit' ? htmlspecialchars($product['name']) : ''; ?>" required>
                        </div>
                        
                        <div class="form-group">
                            <label for="brand">Brand*</label>
                            <input type="text" id="brand" name="brand" value="<?php echo $action === 'edit' ? htmlspecialchars($product['brand']) : ''; ?>" required>
                        </div>
                        
                        <div class="form-group">
                            <label for="category">Category*</label>
                            <select id="category" name="category" required>
                                <option value="">Select Category</option>
                                <option value="phone" <?php echo $action === 'edit' && $product['category'] === 'phone' ? 'selected' : ''; ?>>Phone</option>
                                <option value="laptop" <?php echo $action === 'edit' && $product['category'] === 'laptop' ? 'selected' : ''; ?>>Laptop</option>
                                <option value="tablet" <?php echo $action === 'edit' && $product['category'] === 'tablet' ? 'selected' : ''; ?>>Tablet</option>
                                <option value="accessory" <?php echo $action === 'edit' && $product['category'] === 'accessory' ? 'selected' : ''; ?>>Accessory</option>
                                <option value="other" <?php echo $action === 'edit' && $product['category'] === 'other' ? 'selected' : ''; ?>>Other</option>
                            </select>
                        </div>
                        
                        <div class="form-group">
                            <label for="price">Price (NPR)*</label>
                            <input type="number" id="price" name="price" min="0" step="0.01" value="<?php echo $action === 'edit' ? $product['price'] : ''; ?>" required>
                        </div>
                        
                        <div class="form-group">
                            <label for="product_image">Product Image*</label>
                            <input type="file" id="product_image" name="product_image" accept="image/*" <?php echo $action === 'add' ? 'required' : ''; ?>>
                            <p style="font-size: 0.9rem; color: var(--gray); margin-top: 0.5rem;">
                                Upload an image file (JPG, PNG, GIF, WebP). Maximum size: 5MB.
                            </p>
                            <?php if ($action === 'edit' && !empty($product['image_url'])): ?>
                            <div style="margin-top: 0.5rem;">
                                <p style="font-size: 0.9rem;">Current image:</p>
                                <img src="../<?php echo htmlspecialchars($product['image_url']); ?>" alt="Current Product Image" style="max-width: 200px; max-height: 150px; border: 1px solid #ddd; border-radius: 4px;">
                            </div>
                            <?php endif; ?>
                        </div>
                        
                        <div class="form-group">
                            <label for="specs">Specifications</label>
                            <textarea id="specs" name="specs" rows="7" placeholder="Enter product specifications (e.g. Processor: Intel i5, RAM: 8GB)"><?php echo $action === 'edit' ? htmlspecialchars($product['specs']) : ''; ?></textarea>
                            <p style="font-size: 0.9rem; color: var(--gray); margin-top: 0.5rem;">Enter each specification on a new line, preferably with a colon separator (e.g. "RAM: 8GB").</p>
                        </div>
                        
                        <div class="form-group">
                            <label>
                                <input type="checkbox" name="availability" <?php echo $action !== 'edit' || ($action === 'edit' && $product['availability']) ? 'checked' : ''; ?>>
                                Available in Stock
                            </label>
                        </div>
                        
                        <div style="display: flex; justify-content: space-between;">
                            <a href="manage-products.php" class="btn btn-outline">Cancel</a>
                            <button type="submit" class="btn btn-primary"><?php echo $action === 'add' ? 'Add Product' : 'Update Product'; ?></button>
                        </div>
                    </form>
                    
                    <?php else: ?>
                    <!-- Product Listing -->
                    <div class="admin-header">
                        <h2>Manage Products</h2>
                        <div>
                            <a href="manage-products.php?action=add" class="btn btn-primary">Add New Product</a>
                        </div>
                    </div>
                    
                    <?php if (empty($products)): ?>
                    <div style="text-align: center; padding: 2rem;">
                        <p>No products found. Add your first product.</p>
                    </div>
                    <?php else: ?>
                    <div style="overflow-x: auto;">
                        <table class="admin-table">
                            <thead>
                                <tr>
                                    <th style="width: 50px;">#</th>
                                    <th>Image</th>
                                    <th>Name</th>
                                    <th>Brand</th>
                                    <th>Category</th>
                                    <th>Price</th>
                                    <th>Availability</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php foreach($products as $index => $p): ?>
                                <tr>
                                    <td><?php echo $index + 1; ?></td>
                                    <td>
                                        <img src="../<?php echo htmlspecialchars($p['image_url']); ?>" alt="<?php echo htmlspecialchars($p['name']); ?>" style="width: 50px; height: 50px; object-fit: cover; border-radius: 4px;">
                                    </td>
                                    <td><?php echo htmlspecialchars($p['name']); ?></td>
                                    <td><?php echo htmlspecialchars($p['brand']); ?></td>
                                    <td><?php echo htmlspecialchars(ucfirst($p['category'])); ?></td>
                                    <td><?php echo formatPrice($p['price']); ?></td>
                                    <td><?php echo $p['availability'] ? '<span style="color: var(--success);">In Stock</span>' : '<span style="color: var(--danger);">Out of Stock</span>'; ?></td>
                                    <td>
                                        <div class="action-buttons">
                                            <a href="manage-products.php?action=edit&id=<?php echo $p['id']; ?>" class="btn btn-sm btn-edit">
                                                <i class="fas fa-edit"></i> Edit
                                            </a>
                                            <a href="manage-products.php?action=delete&id=<?php echo $p['id']; ?>" class="btn btn-sm btn-delete">
                                                <i class="fas fa-trash"></i> Delete
                                            </a>
                                        </div>
                                    </td>
                                </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                    <?php endif; ?>
                    
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer>
        <div class="container">
            <div class="copyright">
                <p>&copy; 2025 Nepali Tech. All rights reserved.</p>
            </div>
        </div>
    </footer>

    <script src="../js/script.js"></script>
</body>
</html>
