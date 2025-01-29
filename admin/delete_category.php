<?php
 ob_start();
include('../config/const.php'); 

if (isset($_GET['id']) && isset($_GET['image_name'])) {

    $id = $_GET['id'];
    $image_name = $_GET['image_name'];

    if ($image_name != "") {
        //Ensure there are no hidden spaces or characters in the $image_name variable. You can use trim() to clean it up:
        $image_name = trim($_GET['image_name']);
        $path = "../images/category/" . $image_name;

        // Check if the file exists before attempting to delete
        if (file_exists($path)) {
            $remove = unlink($path);

            if ($remove == false) {
                $_SESSION['remove'] = "Failed to remove image";
                header("location:" . SITEURL . 'admin/categories.php');
                die();
            }
        } else {
            $_SESSION['remove'] = "File does not exist";
            header("location:" . SITEURL . 'admin/categories.php');
            die();
        }
    }

    $sql = "DELETE FROM tbl_category WHERE id=$id";
    $res = mysqli_query($conn, $sql);

    if ($res == true) {
        $_SESSION['delete_category'] = "Category deleted successfully";
        header("location:" . SITEURL . 'admin/categories.php');
    } else {
        $_SESSION['fail_delete_category'] = "Failed to delete category";
        header("location:" . SITEURL . 'admin/categories.php');
    }

} else {
    $_SESSION['fail_delete_category'] = "Failed to delete category";
    header("location:" . SITEURL . 'admin/categories.php');
}
ob_end_flush();
?>
