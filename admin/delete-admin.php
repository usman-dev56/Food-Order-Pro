<?php 
include('../config/const.php'); 



    // get the id of the admin to be deleted
    $id= $_GET['id'];



   $sql= "DELETE FROM tbl_admin WHERE id=$id";

   $res=mysqli_query($conn,$sql);


   if($res==true){
         

    // Session variable to display  msg
    $_SESSION['delete']=" admin deleted successfully ";
    // Redirect pag to manage admin
    header("location:".SITEURL.'admin/manage-admin.php');
    
  }else{
    
    $_SESSION['delete']=" class='msg-error'>Failed to delete admin ";
    // Redirect pag to manage  admin
    header("location:".SITEURL.'admin/manage-admin.php');
   
 }
    

 ?>


