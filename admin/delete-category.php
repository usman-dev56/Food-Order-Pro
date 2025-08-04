<?php

echo "delete page";

// if(isset($_GET['id']) AND isset($_GET['image_name'])){

//     $id=$_GET['id'];
//     $iamge_name=$_GET['image_name'];

//     if(image_name!=""){

//         $path="../images/categories/".$image_name;
//         $remove=unlink($path);

//         if($path==false){
//             $_SESSION['remove']="Failed to remove image";
//             header("location:".SITEURL.'admin/manage-category.php');
//             die();

//         }
//     }


//     $sql= "DELETE FROM tbl_ctegory WHERE id=$id";

//     $res=mysqli_query($conn,$sql);
 
 
//     if($res==true){
          
 
//      // Session variable to display  msg
//      $_SESSION['delete_category']=" Category deleted successfully ";
//      // Redirect pag 
//      header("location:".SITEURL.'admin/manage-category.php');
     
//    }else{
     
//      $_SESSION['fail_delete_category']=" class='msg-error'>Failed to delete Category ";
//      // Redirect pag 
//      header("location:".SITEURL.'admin/manage-category.php');
    
//   }
    


// }else{

//     $_SESSION['fail_delete_category']="Failed to delete category";
//     // Redirect pag to add admin
//     header("location:".SITEURL.'admin/manage-category.php');
// }

?>