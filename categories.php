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
    <header class="header" >
    <div id="inner-header">
    
        <div class="hero-text">
            <h1>Welcome to All Categories Section</h1>
            <p>Discover delicious food in every category,Click!</p>
            </div>
        </div>
    </header>

   
    

 <!-- Featured Categories Section -->
 <section class="categories">
    <div class="categories-container">
        <h2 class="text-center">Explore Foods</h2>

        <div class="category-container">
            <!-- Fetch dynamic data from the database -->
            <?php 
                $sql = 'SELECT * FROM tbl_category WHERE available="Yes" ';
                $res = mysqli_query($conn, $sql);
                $count = mysqli_num_rows($res);
                
                if ($count > 0) {
                    // Fetch and display data
                    while ($rows = mysqli_fetch_assoc($res)) { 
                        $id = $rows['id'];
                        $title = $rows['title'];
                        $image_name = $rows['image_name'];
                        $feature = $rows['highlighted'];
                        $active = $rows['available'];

                        if ($image_name != "") { // Display image ?>
                            <a href="category-foods.php?category_id=<?php echo urlencode($id);  ?>">
                                <div class="box-3 float-container">
                                    <img src="<?php echo SITEURL; ?>images/category/<?php echo htmlspecialchars($image_name); ?>" alt="Category Image" class="img-responsive img-curve">
                                    <h3 class="float-text text-white"><?php  echo $title;?></h3>
                                    
                                </div>
                            </a>
                        <?php } else { ?>
                            <span class="no-image">Image not added</span>
                        <?php }
                    }
                }
            ?>
        </div> <!-- End of .category-container -->

        <div class="clearfix"></div>
    </div>
</section>

    <!-- Footer Section -->
    <footer class="footer">
        <p>&copy; 2024 FoodOrderPro. All Rights Reserved.</p>
    </footer>
    

</body>

<script src="js/toggle.js"></script>
<script src="js/header-img.js"></script>
</html>
