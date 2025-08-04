<?php include('partial/nav.php'); ?>

<!-- Main content section start -->
<div id="main-content">
    <h1>Manage Categories</h1>
    
    <?php
        // Display success or error messages 
        if (isset($_SESSION['category_add'])) {
            echo "<div class='success-message'>" . $_SESSION['category_add'] . "</div>";
            unset($_SESSION['category_add']);
        }
        if (isset($_SESSION['remove'])) {
            echo "<div class='error-message'>" . $_SESSION['remove'] . "</div>";
            unset($_SESSION['remove']);
         }
         if (isset($_SESSION['category_updated'])) {
            echo "<div class='success-message'>" . $_SESSION['category_updated'] . "</div>";
            unset($_SESSION['category_updated']);
        }
        if (isset($_SESSION['category_not_updated'])) {
            echo "<div class='success-message'>" . $_SESSION['category_not_updated'] . "</div>";
            unset($_SESSION['category_not_updated']);
        }
         if (isset($_SESSION['delete_category'])) {
            echo "<div class='success-message'>" . $_SESSION['delete_category'] . "</div>";
            unset($_SESSION['delete_category']);
        }
        if (isset($_SESSION['fail_delete_category'])) {
            echo "<div class='error-message'>" . $_SESSION['fail_delete_category'] . "</div>";
            unset($_SESSION['fail_delete_category']);
         }

         if (isset($_SESSION['no_category_found'])) {
            echo "<div class='error-message'>" . $_SESSION['no_category_found'] . "</div>";
            unset($_SESSION['no_category_found']);
         }

         if (isset($_SESSION[' upload_img_fail'])) {
            echo "<div class='error-message'>" . $_SESSION[' upload_img_fail'] . "</div>";
            unset($_SESSION[' upload_img_fail']);
         }
        
         
    ?>

    <div class="btn-add-admin" style="margin-bottom: 20px;">
        <a href="add-category.php">Add Category</a>
    </div>

    <table class="tbl-full">
        <tr>
            <th>S.No</th>
            <th>Title</th>
            <th>Image</th>
            <th>Featured</th>
            <th>Active</th>
            <th>Action</th>
            
        </tr>

        <!-- Get data from category table -->
        <?php 
            $sql = 'SELECT * FROM tbl_category';
            $res = mysqli_query($conn, $sql);
            $count = mysqli_num_rows($res);
            $sn = 1; // Serial number

            if ($count > 0) { // We have data
                // Fetch and display data
                while ($rows = mysqli_fetch_assoc($res)) { 
                    $id = $rows['id'];
                    $title = $rows['title'];
                    $image_name = $rows['image_name'];
                    $feature = $rows['feature'];
                    $active = $rows['active'];
        ?>

        <tr>
            <td><?php echo $sn++; ?>.</td>
            <td><?php echo htmlspecialchars($title); ?></td>
            <td>
                <?php if ($image_name != "") { // Display image ?>
                    <img src="<?php echo SITEURL; ?>images/category/<?php echo htmlspecialchars($image_name); ?>" alt="Category Image" width="100px">
                <?php } else { // Display message ?>
                    <span class="no-image">Image not added</span>
                <?php } ?>
            </td>
            <td><?php echo htmlspecialchars($feature); ?></td>
            <td><?php echo htmlspecialchars($active); ?></td>
            <td>
                <a class="btn-update-admin" href=" <?php echo SITEURL ?>/admin/update-categories.php?id=<?php echo $id ?>">Update Category</a>
            
                <a class="btn-delete-admin" href="<?php echo SITEURL ?>/admin/delete-categories.php?id=<?php echo $id ?> &image_name= <?php echo $image_name ?>"  onclick="return confirm('Are you sure you want to delete this category?');">Delete Category</a>
            </td>
        </tr>

        <?php
                }
            } else {
                // No data found
                echo "<tr><td colspan='6' class='no-data'>No Category Found</td></tr>";
            }
        ?>
    </table>
</div>
<!-- Main content section end -->

<?php include('partial/footer.php'); ?>
