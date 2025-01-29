<?php
include('../config/const.php'); 
include('login-check.php'); 

// Get current page filename
$current_page = basename($_SERVER['PHP_SELF']); 
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="../css/styles.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>
<body>

<div class="admin-panel">
    <!-- Sidebar -->
    <div class="sidebar">
        <h2>Admin Panel</h2>
        <ul>
            <li><a href="dashboard.php" class="<?php echo ($current_page == 'dashboard.php') ? 'active' : ''; ?>">Dashboard</a></li>
            <li><a href="categories.php" class="<?php echo ($current_page == 'categories.php') ? 'active' : ''; ?>">Categories</a></li>
            <li><a href="foods.php" class="<?php echo ($current_page == 'foods.php') ? 'active' : ''; ?>">Foods</a></li>
            <li><a href="orders.php" class="<?php echo ($current_page == 'orders.php') ? 'active' : ''; ?>">Orders</a></li>
            <li><a href="reviews.php" class="<?php echo ($current_page == 'reviews.php') ? 'active' : ''; ?>">Reviews</a></li>
            <li><a href="logout.php" id="logout-btn" class="logout-btn <?php echo ($current_page == 'logout.php') ? 'active' : ''; ?>">Logout</a></li>
        </ul>

        <h4 >Powered by FoodOrderPro</h3>
    </div>

