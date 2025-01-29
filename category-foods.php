<?php include('config/const.php'); ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="css/header1.css">
    <link rel="stylesheet" href="css/allfoods.css">
    <link rel="stylesheet" href="css/responsive.css">
</head>

<body>

   <!-- Navbar -->
<nav class="navbar">
    <div class="nav-container">
        <div class="logo">
            <a href="#"><img src="images/logo3.png" alt="Logo"></a>
        </div>

        <!-- Hamburger Menu Toggle (visible only on mobile) -->
        <div class="hamburger" id="hamburger">
            <i class="fas fa-bars" id="open-icon"></i>
            <i class="fas fa-times" id="close-icon" style="display: none;"></i> <!-- Initially hidden -->
        </div>

        <!-- Menu (Initially hidden on mobile) -->
        <div class="menu" id="menu">
            <ul>
                <li><a href="index.php"><i class="fas fa-home"></i> Home</a></li>
                <li><a href="categories.php"><i class="fas fa-th-large"></i> Categories</a></li>
                <li><a href="foods.php"><i class="fas fa-utensils"></i> Foods</a></li>
              
                <li><a href="contact-us.php"><i class="fas fa-phone-alt"></i> Contact</a></li>
            </ul>
        </div>
    </div>
</nav>


    <!-- Header Section -->
    <header class="header">

    <div id="inner-header">
        <div class="hero-text">
            <h1>Welcome to Our Restaurant</h1>
            <p>All foods on your selected category</p>
            </div>
        </div>
    </header>

   
    

    <!-- Food Menu Section -->
    <section class="food-menu" id="food-menu">
    <div class="container">
        <h2 id="food-menu-txt">Our Food Menu</h2>

        <div class="food-menu-container">
              
        <?php
            // Check if a category ID is provided
            if (isset($_GET['category_id'])) {
                $category_id = $_GET['category_id'];

                // SQL query to fetch foods for the selected category
                $sql = "SELECT * FROM tbl_food WHERE category_id='$category_id' AND available='Yes'";
            } else {
                // Default query to fetch all active foods
                $sql = "SELECT * FROM tbl_food WHERE available='Yes'";
            }

            $result = mysqli_query($conn, $sql);

            if ($result && mysqli_num_rows($result) > 0) {
                // Loop through the results and display each food item
                while ($row = mysqli_fetch_assoc($result)) {
                    $id = $row['id'];
                    $title = $row['title'];
                    $price = $row['price'];
                    $description = $row['description'];
                    $image_name = $row['image_name'];
            ?>


            <!-- Food Item 1 -->
            <div class="food-menu-box">
                <div class="food-menu-img">
                    
                    <img src="<?php echo SITEURL; ?>images/food/<?php echo htmlspecialchars($image_name); ?>" alt="Food Image">
                </div>
                <div class="food-menu-desc">
                    <h4><?php echo $title;?> </h4>
                    <p class="food-price">$<?php echo $price;?></p>
                    <p class="food-detail">
                    <?php echo $description;?>
                    </p>
                    <a href="order.php?food_id=<?php echo $id; ?>" class="btn-primary">Order Now</a>
                </div>
            </div>

            <?php


}

}else{

    ?>
    <div id="no-food">
       <?php
   echo "Don't have any food ";
   ?>
   </div>
   <?php
}

   ?>

          
   </div>
</section>

    <!-- Footer Section -->
    <footer class="footer">
        <p>&copy; 2024 FoodOrderPro. All Rights Reserved.</p>
    </footer>

</body>

<script src="js/toggle.js"></script>
<script src="js/index.js"></script>

</html>
