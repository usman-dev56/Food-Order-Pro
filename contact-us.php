<?php
ob_start(); // Start buffering
include('config/const.php'); ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contac-Us</title>

    <link href="https://fonts.googleapis.com/css2?family=Kaushan+Script&family=Poppins&display=swap" rel="stylesheet">

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css"
    integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg=="
    crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="css/header1.css">
    <link rel="stylesheet" href="css/contact.css">
   
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


<!-- Main container -->
<
    <!-- Main container -->
    <div class="container">
        <h1>Get in Touch</h1>
        <p>Fill up the form to get in touch with us. </p>

            
    <?php
        // Display success or error messages 

        

        if (isset($_SESSION['message_sent'])) {
            echo "<div class='success-message' >" . $_SESSION['message_sent'] . "</div>";
            unset($_SESSION['message_sent']);
        }
        if (isset($_SESSION['fail_to_sent'])) {
            echo "<div class='error-message'>" . $_SESSION['fail_to_sent'] . "</div>";
            unset($_SESSION['fail_to_sent']);
         }
         ?>

        <!-- Contact form section -->
        <div class="contact-box">
            <!-- Left side of the form -->
            <div class="container-left">
                <h3>Fill the Form*</h3>
                <!-- Form -->
                <form  action="" method="post"  id="contactForm">
                    <div class="input-row">
                        <div class="input-group">
                            <label>Name*</label>
                            <input type="text" id="full-name" name="full-name" placeholder="Enter your Name" class="input-responsive" required>
                            
                        </div>

                        <div class="input-group">
                            <label>Phone*</label>
                            <input type="tel" name="contact" id="contact" placeholder="+92 3005678901" class="input-responsive" required>
                            
                           
                        </div>
                    </div>

                    <!-- Input row for Email and Subject -->
                    <div class="input-row">
                        <div class="input-group">
                            <label>Email*</label>
                            <input type="email" name="email"  id="email" placeholder="youremail@gmail.com" class="input-responsive" required>
                           

                        </div>

                        <div class="input-group">
                            <label>Subject</label>
                            <input type="text" name="subject" id="subject" placeholder="Inquiry" class="input-responsive">
                        </div>
                    </div>

                    <!-- Label for Message textarea -->
                    <div class="input-group">
                        <label>Message*</label>
                        <textarea rows="10"  name="message" id="message"  placeholder="Enter your Message" class="input-responsive" required></textarea>
                        <button type="submit" name="submit">SEND MESSAGE</button>
                    </div>
                </form>
                <?php 
            if(isset($_POST['submit'])) {
                // Get All the Values from Form
               
                $contact_date = date("Y-m-d h:i:sa");
                $status = "Unread";

                $customer_name = mysqli_real_escape_string($conn, $_POST['full-name']);
                $customer_contact = mysqli_real_escape_string($conn, $_POST['contact']);
                $customer_email = mysqli_real_escape_string($conn, $_POST['email']);
                $subject = mysqli_real_escape_string($conn, $_POST['subject']);
                $message = mysqli_real_escape_string($conn, $_POST['message']);

               

                // Insert the order into the database
                $sql2 = "INSERT INTO tbl_contact_us SET 
                    
                    contact_date='$contact_date',
                    status = '$status',
                    sender_name = '$customer_name',
                    phone_number = '$customer_contact',
                    email = '$customer_email',
                    subject = '$subject',
                     message = '$message'
                    ";

                $res2 = mysqli_query($conn, $sql2);

                if($res2 == true) {
    
                    $_SESSION['message_sent'] = "<div class='successive'>Message sent Successfully.</div>";
                    header('Location: ' . SITEURL . 'contact-us.php');
                    exit;
                } else {
                    $_SESSION['fail_to_sent'] = "<div class='error'>Failed to send the message.</div>";
                    header('Location: ' . SITEURL . 'contact-us.php');
                    exit;
                }
            }
            ?>

            </div>
            <!-- Right side with contact information -->
            <div class="container-right">
                <h3>Reach Us</h3>
                <!-- Table for contact information -->
                <table>
                    <tr>
                        <td>Email: </td>
                        <td>contact@foodpro.com</td>
                    </tr>

                    <tr>
                        <td>Phone: </td>
                        <td>+92 321-45656183</td>
                    </tr>

                    <tr>
                        <td>Address: </td>
                        <td>GC University <br>
                            Chiniot Campus, <br>
                            Punjab - 32000, Pakistan</td>
                    </tr>
                </table>

                <!-- Map section -->
                <div class="map">
                    <!-- Google Map iframe -->
                    <iframe
                        src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3394.6155908747423!2d72.97829519999999!3d31.699075200000003!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x39223b393440c273%3A0x2f49d1f55e3d7457!2sGCUF%20Chiniot%20Campus!5e0!3m2!1sen!2s!4v1733051410134!5m2!1sen!2s"
                        width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy"
                        referrerpolicy="no-referrer-when-downgrade"></iframe>
                </div>
            </div>
        </div>
    </div>
    <!-- JavaScript file -->
    <script src="assets/js/script.js"></script>

    <!-- Footer Section -->
    <footer class="footer">
            <p>&copy; 2024 FoodOrderPro. All Rights Reserved.</p>
    </footer>

</body>
<script src="js/toggle.js"></script>
</html>

<?php
ob_end_flush(); // End buffering
?>