
<?php
ob_start(); // Start buffering

include('config/const.php'); 

if (isset($_GET["food_id"])) {
    $food_id = $_GET['food_id'];

    $sql = "SELECT * FROM tbl_food WHERE id = $food_id";
    $res = mysqli_query($conn, $sql);
    $count = mysqli_num_rows($res);

    if ($count == 1) {
        $row = mysqli_fetch_assoc($res);
        $title = $row['title'];
        $price = $row['price'];
        $image_name = $row['image_name'];
    } else {
        header("Location: " . SITEURL . "index.php");
        exit;
    }
} else {
    header("Location: " . SITEURL . "index.php");
    exit;
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="css/header1.css">
    <link rel="stylesheet" href="css/order2.css">
   
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

  
   <!-- fOOD sEARCH Section Starts Here -->
  <section class="food-search">
    <div class="container">

      <h2 class="text-center text-black">Fill this form to confirm your order!</h2>

      <form action="" method="post" class="order">
                <fieldset>
                    <legend>Selected Food</legend>

                    <div class="food-menu-img">
                        <?php
                        if($image_name==""){
                            echo "image not available";
                        } else {
                            ?>
                            <img src="<?php echo SITEURL; ?>images/food/<?php echo htmlspecialchars($image_name); ?>" alt="Food Image" class="img-responsive img-curve">
                            <?php
                        }
                        ?>
                    </div>
    
                    <div class="food-menu-desc">
                        <h3><?php echo $title?></h3>
                        <input type="hidden" name="food" value="<?php echo $title; ?>">
                        
                        <p class="food-price">$<?php echo $price?></p>
                        <input type="hidden" name="price" value="<?php echo $price; ?>">

                        <div class="order-label">Quantity</div>
                        <input type="number" name="qty" class="input-responsive" required>
                    </div>
                </fieldset>
                
                <fieldset>
                    <legend>Delivery Details</legend>
                    <div class="order-label">Full Name</div>
                    <input type="text" name="full-name" placeholder="E.g. Usman" class="input-responsive" required>

                    <div class="order-label">Phone Number</div>
                    <input type="tel" name="contact" placeholder="E.g. 92307xxxxxx" class="input-responsive" required>

                    <div class="order-label">Email</div>
                    <input type="email" name="email" placeholder="E.g. usman@gmail.com" class="input-responsive" required>

                    <div class="order-label">Address</div>
                    <textarea name="address" rows="10" placeholder="E.g. Street, City, Country" class="input-responsive" required></textarea>

                    <input type="submit" name="submit" value="Confirm Order" class="btn btn-primary">
                </fieldset>
            </form>


            <?php 
            if(isset($_POST['submit'])) {
                // Get All the Values from Form
                $food = $_POST['food'];
                $price = $_POST['price'];
                $qty = $_POST['qty'];

                $total = $price * $qty;
                $order_date = date("Y-m-d h:i:sa");

                $status = "Ordered";

                $customer_name = mysqli_real_escape_string($conn, $_POST['full-name']);
                $customer_contact = mysqli_real_escape_string($conn, $_POST['contact']);
                $customer_email = mysqli_real_escape_string($conn, $_POST['email']);
                $customer_address = mysqli_real_escape_string($conn, $_POST['address']);

                // Insert the order into the database
                $sql2 = "INSERT INTO tbl_order SET 
                    food='$food',
                    price=$price,
                    qty = $qty,
                    total = $total,
                    order_date='$order_date',
                    status = '$status',
                    customer_name = '$customer_name',
                    customer_contact = '$customer_contact',
                    customer_email = '$customer_email',
                    customer_address = '$customer_address'";

                $res2 = mysqli_query($conn, $sql2);

                if($res2 == true) {
                    // Get the inserted order's ID
                    $order_id = mysqli_insert_id($conn);

                    // Redirect to the receipt page with order ID
                    header('Location: ' . SITEURL . 'receipt.php?order_id=' . $order_id);
                    exit;
                } else {
                    $_SESSION['fail_to_order'] = "<div class='error'>Failed to Order.</div>";
                    header('Location: ' . SITEURL . 'index.php');
                    exit;
                }
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

</html>
