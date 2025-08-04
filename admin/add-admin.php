
<?php include('partial/nav.php');?>


<div id="main-content" class="main-section">
    <div class="form-container">
        <div class="centered-heading"><h1>Add Admin</h1></div>
        
        <form action="" method="post"  class="form-container horizontal-form" >
            <div class="form-group">
                <label for="full_name">Full Name:</label>
                <input type="text" id="full_name" name="full_name" placeholder="Enter Full Name" required>
            </div>
            <div class="form-group">
                <label for="username">Username:</label>
                <input type="text" id="username" name="username" placeholder="Enter Username or Email" required>
            </div>
            <div class="form-group">
                <label for="password">Password:</label>
                <input type="password" id="password" name="password" placeholder="Enter Password" required>
            </div>
            <div class="form-group">
                <input type="submit" name="submit" value="Add Admin" class="btn-submit">
            </div>
        </form>
    </div>
</div>


<!-- saving the data in database -->
<?php 
   
   
   if(isset($_POST['submit'])){
      $full_name= $_POST['full_name'];
      $username=$_POST['username'];
      $password=($_POST['password']);// can add md5 for encryption

      $sql="INSERT INTO tbl_admin SET 
         full_name ='$full_name',
         username='$username',
         password='$password'
      ";
    
    //connect database file
    include('../config/const.php');

       //  save data into data base
       $res=mysqli_query($conn,$sql) or die(mysqli_error());

       if($res==TRUE){
         
         // Session variable to display  msg
         $_SESSION['add']="admin added successfully";
         // Redirect pag to manage admin
         header("location:".SITEURL.'admin/manage-admin.php');
         
       }else{
         
         $_SESSION['add']="Failed to add admin";
         // Redirect pag to add admin
         header("location:".SITEURL.'admin/add-admin.php');
        
      }
      
   } 
   ?>

