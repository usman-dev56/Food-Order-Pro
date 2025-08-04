<?php include('partial/nav.php'); ?>

<!-- Main content section start -->
<div id="main-content">
    <h1>Manage Foods</h1>
    <?php  
    
    if (isset($_SESSION['food_add'])) {
      echo "<div class='success-message'>" . $_SESSION['food_add'] . "</div>";
      unset($_SESSION['food_add']);
  }
  if (isset($_SESSION['food_not_add'])) {
      echo "<div class='error-message'>" . $_SESSION['food_not_add'] . "</div>";
      unset($_SESSION['food_not_add']);
   }


   if (isset($_SESSION['remove'])) {
    echo "<div class='error-message'>" . $_SESSION['remove'] . "</div>";
    unset($_SESSION['remove']);
 }

   if (isset($_SESSION['delete_food'])) {
    echo "<div class='success-message'>" . $_SESSION['delete_food'] . "</div>";
    unset($_SESSION['delete_food']);
}
if (isset($_SESSION['fail_delete_food'])) {
    echo "<div class='error-message'>" . $_SESSION['fail_delete_food'] . "</div>";
    unset($_SESSION['fail_delete_food']);
 }
  
 if (isset($_SESSION['food_updated'])) {
    echo "<div class='success-message'>" . $_SESSION['food_updated'] . "</div>";
    unset($_SESSION['food_updated']);
}
if (isset($_SESSION['food_not_updated'])) {
    echo "<div class='error-message'>" . $_SESSION['food_not_updated'] . "</div>";
    unset($_SESSION['food_not_updated']);
 }
    
    
    
    
    
    
    
    
    
    
    ?>
    
   

    <div class="btn-add-admin" style="margin-bottom: 20px;">
        <a href="add-food.php">Add Food</a>
    </div>

    <table class="tbl-full">
        <tr>
            <th>S.No</th>
            <th>Title</th>
            <th>Image</th>
            <th>Price</th>
            <th>Featured</th>
            <th>Active</th>
            <th>Action</th>
        </tr>

        <!-- Get data from food table -->
        <?php 
            $sql = 'SELECT * FROM tbl_food';
            $res = mysqli_query($conn, $sql);
            $count = mysqli_num_rows($res);
            $sn = 1; // Serial number

            if ($count > 0) { // We have data
                // Fetch and display data
                while ($rows = mysqli_fetch_assoc($res)) { 
                    $id = $rows['id'];
                    $title = $rows['title'];
                    $price=$rows['price'];
                    $image_name = $rows['image_name'];
                    $feature = $rows['feature'];
                    $active = $rows['active'];
        ?>

        <tr>
            <td><?php echo $sn++; ?>.</td>
            <td><?php echo htmlspecialchars($title); ?></td>
            <td>
                <?php if ($image_name != "") { // Display image ?>
                    <img src="<?php echo SITEURL; ?>images/food/<?php echo htmlspecialchars($image_name); ?>" alt="Food Image" width="100px">
                <?php } else { // Display message ?>
                    <span class="no-image">Image not added</span>
                <?php } ?>
            </td>
            <td> $<?php echo $price; ?></td>
            <td><?php echo htmlspecialchars($feature); ?></td>
            <td><?php echo htmlspecialchars($active); ?></td>
            <td>
                <a class="btn-update-admin" href=" <?php echo SITEURL ?>/admin/update-food.php?id=<?php echo $id ?>">Update Food</a>
            
                <a class="btn-delete-admin" href="<?php echo SITEURL ?>/admin/delete-food.php?id=<?php echo $id ?> &image_name= <?php echo $image_name ?>"  onclick="return confirm('Are you sure you want to delete this food?');">Delete Food</a>
            </td>
        </tr>

        <?php
                }
            } else {
                // No data found
                echo "<tr><td colspan='6' class='no-data'>No Food Found</td></tr>";
            }
        ?>
    </table>
</div>
<!-- Main content section end -->

<?php include('partial/footer.php'); ?>
