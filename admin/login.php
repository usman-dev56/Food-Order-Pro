



 <?php include('../config/const.php');
 ?> 
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Login - FoodOrderPro</title>
  
    <link rel="stylesheet" href="../css/admin-login.css">
</head>
<body>
    <div class="login-container">
        <div id="logo-container">
        <img src="../images/logo3.png" alt="FoodOrderPro Logo" class="logo">
        </div>
        <h1>Admin Login</h1>
         <?php

    if(isset($_SESSION['fail_login'])){
      echo $_SESSION['fail_login'];
      unset($_SESSION['fail_login']);
     
    } 

   ?>

  <?php

if(isset($_SESSION['no-login-msg'])){
  echo $_SESSION['no-login-msg'];
  unset($_SESSION['no-login-msg']);
 
} 
?> 

        <!-- Placeholder for error message -->
        <div class="error-message" id="error-message">
            Invalid username or password. Please try again.
        </div>
        <form action="" method="post">
            <div class="form-group">
                <label for="username">User Name:</label>
                <input type="text" id="username" name="username" placeholder="Enter User Name">
            </div>
            <div class="form-group">
                <label for="password">Password:</label>
                <input type="password" id="password" name="password" placeholder="Enter Password">
            </div>
            <div class="form-group">
                <input  type="submit" name="submit" value="login"  class="btn-login">
            </div>
        </form>
        <p>Forgot your password? <a href="#">Click here</a></p>
        <div id="powered-by">Powered by FoodOrderPro</div>
    </div>

</body>
</html>




<!-- php Starts here -->
 
<!--Check if the form is submitted -->
 
<?php
if (isset($_POST['submit'])) {
    // Get username and password from form
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);

    // SQL query to check if the user exists
    $sql = "SELECT * FROM tbl_admin WHERE username='$username' AND password='$password'";

    // Execute the query
    $res = mysqli_query($conn, $sql);

    // Check if the query execution was successful
    if ($res) {
        // Check how many rows matched the query
        $count = mysqli_num_rows($res);

        if ($count == 1) {
            // If user exists, set session variables and redirect to admin panel

             // Fetch the result as an associative array
            $row = mysqli_fetch_assoc($res);

            $_SESSION['login'] = "Login Successfully";
            $_SESSION['user'] = $username; // Store username in session
            $_SESSION['full_name'] = $row['full_name']; // Store full name in session

            header("location:" . SITEURL . 'admin/dashboard.php');
            exit(); // Stop script execution after redirecting
        } else {
            // If no user matches, set failure message and redirect to login
            $_SESSION['fail_login'] = "Failed to login. Please check username or password.";
            header("location:" . SITEURL . 'admin/login.php');
            exit(); // Stop script execution after redirecting
        }
    } else {
        // If the query failed, set an error message and redirect to login page
        $_SESSION['fail_login'] = "Error executing query. Please try again later.";
        header("location:" . SITEURL . 'admin/login.php');
        exit();
    }
}
?> 
