<?php include('partial/nav.php');
 
 ?>


<!-- Main content section start -->
<div id="main-content">
   <h1>MANAGE ADMINS</h1>

   <!-- Display messages -->
   <?php
      if (isset($_SESSION['add'])) {
         echo "<div class='success-message'>" . $_SESSION['add'] . "</div>";
         unset($_SESSION['add']);
      } 
      if (isset($_SESSION['delete'])) {
         echo "<div class='success-message'>". $_SESSION['delete'] . "</div>";
         unset($_SESSION['delete']);
      }
      if (isset($_SESSION['update'])) {
         echo "<div class='success-message'>" . $_SESSION['update'] . "</div>";
         unset($_SESSION['update']);
      }
   ?>

   <div class="btn-add-admin">
      <a href="add-admin.php">Add Admin</a>
   </div>

   <table class="tbl-full">
      <tr>
         <th>S.No</th>
         <th>Full Name</th>
         <th>Username</th>
         <th>Action</th>
      </tr>

      <!-- Get data from admin table -->
      <?php 
         $sql = 'SELECT * FROM tbl_admin';
         $res = mysqli_query($conn, $sql);
         if ($res == TRUE) {
            $count = mysqli_num_rows($res);
            $sn = 1; // Serial number
            if ($count > 0) {
               // Fetch and display data
               while ($rows = mysqli_fetch_assoc($res)) { 
                  $id = $rows['id'];
                  $full_name = $rows['full_name'];
                  $username = $rows['username'];
                  ?>
                  <tr>
                     <td><?php echo $sn++; ?>.</td>
                     <td><?php echo $full_name; ?></td>
                     <td><?php echo $username; ?></td>
                     <td>
                        <a class="btn-update-admin" href="<?php echo SITEURL ?>/admin/update-admin.php?id=<?php echo $id ?>">Update</a>
                        <a class="btn-delete-admin" href="<?php echo SITEURL ?>/admin/delete-admin.php?id=<?php echo $id ?>">Delete</a>
                     </td>
                  </tr>
                  <?php
               }
            } else {
               echo "<tr><td colspan='4' class='no-data'>No Admins Found</td></tr>";
            }
         }
      ?>
   </table>
</div>
<!-- Main content section end -->
<?php include('partial/footer.php') ?>



    
