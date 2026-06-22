<?php
session_start();
require_once '../php/db_connect.php';
require_once '../php/functions.php';

if (!isAdminLoggedIn()) {
    header("Location: login.php");
    exit();
}

$sqlProducts = "SELECT COUNT(*) as total FROM products";
$resultProducts = $conn->query($sqlProducts);
$totalProducts = ($resultProducts && $resultProducts->num_rows > 0) ? $resultProducts->fetch_assoc()['total'] : 0;

$sqlInStock = "SELECT COUNT(*) as total FROM products WHERE availability = 1";
$resultInStock = $conn->query($sqlInStock);
$inStockProducts = ($resultInStock && $resultInStock->num_rows > 0) ? $resultInStock->fetch_assoc()['total'] : 0;

$outOfStockProducts = $totalProducts - $inStockProducts;

$contactMessages = 0;
$sqlCheckTable = "SHOW TABLES LIKE 'contact_messages'";
$resultCheckTable = $conn->query($sqlCheckTable);
if ($resultCheckTable && $resultCheckTable->num_rows > 0) {
    $sqlMessages = "SELECT COUNT(*) as total FROM contact_messages";
    $resultMessages = $conn->query($sqlMessages);
    if ($resultMessages && $resultMessages->num_rows > 0) {
        $contactMessages = $resultMessages->fetch_assoc()['total'];
    }

    // Fetch messages
    $sqlFetchMessages = "SELECT name, email, message, created_at FROM contact_messages ORDER BY created_at DESC LIMIT 5";
    $messagesResult = $conn->query($sqlFetchMessages);
} else {
    $messagesResult = false;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Admin Dashboard - Nepali E-Market Finder</title>
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
</head>
<body>
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

<section>
    <div class="container">
        <div class="admin-container">
            <div class="admin-sidebar">
                <h3>Admin Panel</h3>
                <ul>
                    <li><a href="dashboard.php" class="active">Dashboard</a></li>
                    <li><a href="manage-products.php">Manage Products</a></li>
                    <li><a href="#messages">Messages</a></li>
                    <li><a href="logout.php">Logout</a></li>
                </ul>
            </div>

            <div class="admin-content">
                <div class="admin-header">
                    <h2>Dashboard</h2>
                    <div>
                        <a href="manage-products.php?action=add" class="btn btn-primary">Add New Product</a>
                    </div>
                </div>

                <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)); gap: 1rem; margin-top: 2rem;">
                    <div style="background-color: #f8f9fa; padding: 1.5rem; border-radius: 8px; text-align: center;">
                        <div style="font-size: 2rem;"><?php echo $totalProducts; ?></div>
                        <div>Total Products</div>
                    </div>
                    <div style="background-color: #d4edda; padding: 1.5rem; border-radius: 8px; text-align: center;">
                        <div style="font-size: 2rem;"><?php echo $inStockProducts; ?></div>
                        <div>In stock</div>
                    </div>
                    <div style="background-color: #f8d7da; padding: 1.5rem; border-radius: 8px; text-align: center;">
                        <div style="font-size: 2rem;"><?php echo $outOfStockProducts; ?></div>
                        <div>Out of stock</div>
                    </div>
                    <div style="background-color: #d1ecf1; padding: 1.5rem; border-radius: 8px; text-align: center;">
                        <div style="font-size: 2rem;"><?php echo $contactMessages; ?></div>
                        <div>Messages</div>
                    </div>
                </div>

                <!-- Recent Products -->
                <div style="margin-top: 2rem;">
                    <h3>Recent Products</h3>
                    <table class="admin-table">
                        <thead>
                        <tr>
                            <th>Name</th>
                            <th>Brand</th>
                            <th>Category</th>
                            <th>Price</th>
                            <th>Availability</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php
                        $sql = "SELECT * FROM products ORDER BY id DESC LIMIT 5";
                        $result = $conn->query($sql);
                        if ($result && $result->num_rows > 0) {
                            while($row = $result->fetch_assoc()) {
                                echo '<tr>';
                                echo '<td>' . htmlspecialchars($row['name']) . '</td>';
                                echo '<td>' . htmlspecialchars($row['brand']) . '</td>';
                                echo '<td>' . htmlspecialchars(ucfirst($row['category'])) . '</td>';
                                echo '<td>' . formatPrice($row['price']) . '</td>';
                                echo '<td>' . ($row['availability'] ? '<span style="color:green;">In Stock</span>' : '<span style="color:red;">Out of Stock</span>') . '</td>';
                                echo '</tr>';
                            }
                        } else {
                            echo '<tr><td colspan="5">No products found</td></tr>';
                        }
                        ?>
                        </tbody>
                    </table>
                </div>

                <!-- Recent Messages -->
                <div id="messages" style="margin-top: 2rem;">
                    <h3>Recent Messages</h3>
                    <?php if ($messagesResult && $messagesResult->num_rows > 0): ?>
                        <table class="admin-table">
                            <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Message</th>
                                    <th>Date</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php while ($msg = $messagesResult->fetch_assoc()): ?>
                                    <tr>
                                        <td><?php echo htmlspecialchars($msg['name']); ?></td>
                                        <td><?php echo htmlspecialchars($msg['email']); ?></td>
                                        <td><?php echo htmlspecialchars($msg['message']); ?></td>
                                        <td><?php echo htmlspecialchars($msg['created_at']); ?></td>
                                    </tr>
                                <?php endwhile; ?>
                            </tbody>
                        </table>
                    <?php else: ?>
                        <p>No messages found.</p>
                    <?php endif; ?>
                </div>

                <div style="margin-top: 2rem; text-align: center;">
                    <a href="manage-products.php" class="btn btn-secondary">Manage All Products</a>
                </div>
            </div>
        </div>
    </div>
</section>

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
