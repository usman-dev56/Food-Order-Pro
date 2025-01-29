<?php 




// Authorization Access Control
if (!isset($_SESSION['user'])) {
    // If user is not logged in, redirect to login page with message

    $_SESSION['no-login-msg'] = "Please login first to access the Admin panel!";
    unset($_SESSION['user']);
    header("location:" . SITEURL . 'admin/login.php');
   
    // header("location:" . SITEURL . 'admin/');

}
?>