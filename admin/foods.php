

<?php include('index.php') ?>


<!-- <div id="categories" class="section"> -->
<div class="main-content">
        <header>
            <div class="headings">
            <h1>Welcome, <?php echo isset($_SESSION['full_name']) ? $_SESSION['full_name'] : 'Admin'; ?> !</h1>
            <p>Manage your food ordering platform</p>
            </div>

    <div id="messages">
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
</div>

        </header>



        
    <h2 id="manage-heading" >Manage Foods</h2>
    <button class="add-btn" onclick="window.location.href='add_food.php'">Add Food</button>
    <div class="table-container">
        <div class="table-fixed">
    <table >
        <thead>
            <tr>
            <th>S.No</th>
            <th>Title</th>
            <th>Image</th>
            <th>Price</th>
            <th>Highlighted</th>
            <th>Availability</th>
            <th>Action</th>
        </tr>
        </thead>
         <!-- Get data from food table -->
         <tbody>
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
                    $highlighted = $rows['highlighted'];
                    $available = $rows['available'];
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
                <td> Rs. <?php echo $price; ?></td>
                <td class="td-available"><?php echo htmlspecialchars($highlighted); ?></td>
                <td class="td-available"><?php echo htmlspecialchars($available); ?></td>
                <td>
                  <a class="btn-edit" href=" <?php echo SITEURL ?>/admin/edit_food.php?id=<?php echo $id ?>">Edit</a>
            
                  <a class="btn-delete" href="<?php echo SITEURL ?>/admin/delete_food.php?id=<?php echo $id ?> &image_name= <?php echo $image_name ?>"  onclick="return confirm('Are you sure you want to delete this category?');">Delete</a>
                </td>
            </tr>
            
        
        <?php
                }
            } else {
                // No data found
                echo "<tr><td colspan='6' class='no-data'>No Food Found</td></tr>";
            }
        ?>
        </tbody>
    </table>
    </div>

</div>
</div>
</div>

