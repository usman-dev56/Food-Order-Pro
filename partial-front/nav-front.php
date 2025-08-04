
<?php include('config/const.php'); ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <!-- Important to make website responsive -->
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Restaurant Website</title>

    <!-- Link our CSS file -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="css/style.css">
    <link href="https://fonts.googleapis.com/css2?family=Kaushan+Script&family=Poppins&display=swap" rel="stylesheet">

</head>

<body>
    <!-- Navbar Section Starts Here -->
    <section class="navbar">
        <div class="container">
            <div class="logo">
                <a href="#" title="Logo">
                    <img src="images/foodpro.png" alt="Restaurant Logo" class="img-responsive">
                </a>
            </div>

            <div class="menu text-center">
                <ul>
                    <li>
                        <a href="index.php" class="border" ><i class="fa-solid fa-house"></i>Home</a>
                    </li>
                    <li>
                        <a href=" categories.php" class="border"><i class="fa-solid fa-list"></i>Categories</a>
                    </li>
                    <li>
                        <a href="  foods.php" class="border"><i class="fa-solid fa-burger"></i>Foods</a>
                    </li>
                    <li>
                        <a href="#" class="border"><i class="fa-solid fa-address-book"></i>Contact</a>
                    </li>
                </ul>
            </div>

            <section class="food-search text-center">

                <div class="hero-text">
                    <h1>Food Order Pro</h1>
                    <p>Savor the Flavor, Delivered Fresh!</p>
                </div>

                <div class="container">
                    <form action="food-search.html" method="POST">
                        <input type="search" name="search" placeholder="Search for Food.." required>
                        <input type="submit" name="submit" value="Search" class="btn btn-primary">
                    </form>
        
                </div>
            </section>

            <div class="clearfix"></div>
        </div>
    </section>
    <!-- Navbar Section Ends Here -->