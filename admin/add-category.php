<?php include('partial/nav.php'); ?>



    
 

    <!-- Add category form starts here -->
   
<!-- Main content section start -->
<div id="main-content" class="main-section">
    <div class="centered-heading">

    <h1 >Add Category</h1>

    </div>
    

       <!-- Display messages -->
       <?php
        if (isset($_SESSION['category_not_add'])) {
            echo "<div class='error-message'>" . $_SESSION['category_not_add'] . "</div>";
            unset($_SESSION['category_not_add']);
        }

        if (isset($_SESSION['upload_img_fail'])) {
            echo "<div class='error-message'>" . $_SESSION['upload_img_fail'] . "</div>";
            unset($_SESSION['upload_img_fail']);
        }
    ?>

    <!-- Display the current image if available -->
    <form action="" method="post" enctype="multipart/form-data"  class="form-container horizontal-form">
        <div class="form-group">
        <label for="title">Title:</label>
            <input type="text" name="title" id="title" placeholder="Category Title" required>
        </div>


        <div class="form-group">
        <label for="image">Select Image:</label>
        <input type="file" name="image" id="image" required>
        </div>

        <div class="form-group">
            <label>Active:</label>
            <div class="radio-group">
            <label><input type="radio" name="active" value="Yes" required> Yes</label>
            <label><input type="radio" name="active" value="No"> No</label>
            </div>
        </div>

        <div class="form-group">
            <label>Featured:</label>
            <div class="radio-group">
            <label><input type="radio" name="feature" value="Yes" required> Yes</label>
            <label><input type="radio" name="feature" value="No"> No</label>
            </div>
        </div>

        <div class="form-group">
            <input type="submit" name="submit" value="Add Category" class="btn-submit">
        </div>
    </form>

<!-- Main content section end -->

    <!-- Add category form ends here -->

    <?php
    if (isset($_POST['submit'])) {
        $title = $_POST['title'];
        $active = $_POST['active'];
        $feature = $_POST['feature'];

        if (isset($_FILES['image']['name'])) {
            $image_name = $_FILES['image']['name'];


            // Auto rename
            // Get the extension of the image
            // $ext = end(explode('.', $image_name));
            $ext = pathinfo($image_name, PATHINFO_EXTENSION);  // Get file extension

            // Rename image
            $image_name = "food_category" . rand(000, 999) . '.' . $ext;

            $source_path = $_FILES['image']['tmp_name'];
            $destination_path = "../images/category/" . $image_name;

            $upload = move_uploaded_file($source_path, $destination_path);

            if ($upload == false) {
                $_SESSION['upload_img_fail'] = "Failed to upload image";
                header("location:" . SITEURL . 'admin/add-category.php');
                die();
            }
        } else {
            $image_name = "";
        }
      

        // insert data into database
        $sql = "INSERT INTO tbl_category SET
            title='$title',
            image_name='$image_name',
            active='$active',
            feature='$feature'";

        $res = mysqli_query($conn, $sql);

        if ($res == true) {
            $_SESSION['category_add'] = "Category added successfully";
            header("location:" . SITEURL . 'admin/manage-category.php');
        } else {
            $_SESSION['category_not_add'] = "Failed to add Category";
            header("location:" . SITEURL . 'admin/add-category.php');
        }
    }
    ?>
</div>
<!-- Main content section end -->


