
<?php
session_start();
include('login-check.php'); // Adjust path as needed

?>

<html lang="en">
<head>
   <title>Food Order Website - Admin Panel</title>
   <link rel="stylesheet" href="../css/admin.css">
</head>
<body>
   <nav id="navbar">
      <div id="nav-div-logo">FoodOrderPro Admin</div>
      <ul>
         <li><a href="index.php">Home</a></li>
         <li><a href="manage-admin.php">Admin</a></li>
         <li><a href="manage-category.php">Categories</a></li>
         <li><a href="manage-food.php">Foods</a></li>
         <li><a href="manage-order.php">Orders</a></li>
         <li><a href="logout.php">Logout</a></li>
      </ul>
   </nav>

