<?php
include('../config/const.php'); 

if (isset($_GET['id']) && isset($_GET['image_name'])) {

    $id = $_GET['id'];
    $image_name = $_GET['image_name'];

    if ($image_name != "") {

        //Ensure there are no hidden spaces or characters in the $image_name variable. You can use trim() to clean it up:
        $image_name = trim($_GET['image_name']);
        $path = "../images/food/" . $image_name;

        // Check if the file exists before attempting to delete
        if (file_exists($path)) {
            
            $remove = unlink($path);

            if ($remove == false) {
                $_SESSION['remove'] = "Failed to remove image";
                header("location:" . SITEURL . 'admin/manage-food.php');
                die();
            }
        } else {
            $_SESSION['remove'] = "File does not exist";
            header("location:" . SITEURL . 'admin/manage-food.php');
            die();
        }
    }

    $sql = "DELETE FROM tbl_food WHERE id=$id";
    $res = mysqli_query($conn, $sql);

    if ($res == true) {
        $_SESSION['delete_food'] = "Food deleted successfully";
        header("location:" . SITEURL . 'admin/manage-food.php');
    } else {
        $_SESSION['fail_delete_food'] = "Failed to delete Food";
        header("location:" . SITEURL . 'admin/manage-food.php');
    }

} else {
    $_SESSION['fail_delete_food'] = "Failed to delete Food";
    header("location:" . SITEURL . 'admin/manage-food.php');
}
?>
