
<?php include('partial/nav.php'); ?>




<div id="main-content" class="main-section">
   
 <div class="form-container">
 <div class="centered-heading"><h1>Update Admin</h1></div>

        <?php
        $id=$_GET['id'];

        $sql=" SELECT *FROM  tbl_admin WHERE id=$id";

        $res=mysqli_query($conn,$sql);


        if($res==true){
           
            $count= mysqli_num_rows($res) ; //Function to get all the rows in database

              
                       $rows= mysqli_fetch_assoc($res);
                      
                       $full_name=$rows['full_name'];
                       $username= $rows['username'];
                       $password=$rows['password'];


        }


        ?>

        <form action="" method="post"      class="form-container horizontal-form" >
            <div class="form-group">
                <label for="full_name">Full Name:</label>
                <input type="text" id="full_name" name="full_name" value=" <?php echo $full_name;?>" required>
                <input type="hidden" name="id" value="<?php echo $id?>">
            </div>
            <div class="form-group">
                <label for="username">User Name:</label>
                <input type="ema" id="username" name="username"   value=" <?php echo $username;?>" required>
                
            </div>
            <div class="form-group">
                <label for="password">Password:</label>
                <input type="text" id="password" name="password"  value=" <?php echo $password ;?>" required>
            </div>

            <div class="form-group">
                
                <input type="submit" name="submit" value="Update Admin" class="btn-submit">
            </div>
        </form>
    </div>

</div>


<?php

if(isset($_POST['submit'])){
    // echo "button clicked";
         $id=$rows['id'];
      $full_name=$_POST['full_name'];
     $username= $_POST['username'];
     $password=$_POST['password'];


//query to update admin details 

     $sql= "UPDATE tbl_admin  SET 
full_name='$full_name', 
username='$username',
password='$password' WHERE id='$id'";

// // Execute the query
$res=mysqli_query($conn,$sql);


if($res==true){
         
    
    $_SESSION['update']="admin updated  successfully";
    // Redirect pag to manage admin
    header("location:".SITEURL.'admin/manage-admin.php');
     
}else{
    
    $_SESSION['update']="Failed to update admin";
    // Redirect pag to add admin
    header("location:".SITEURL.'admin/update-admin.php');
   
 }
}
 
?>


