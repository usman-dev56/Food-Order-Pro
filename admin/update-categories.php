<?php include('partial/nav.php'); ?>

<?php 
// Ensure the category ID is passed in the URL
if (isset($_GET["id"])) {
    $id = $_GET['id'];

    // Retrieve the category details from the database
    $sql = "SELECT * FROM tbl_category WHERE id = $id";
    $res = mysqli_query($conn, $sql);
    $count = mysqli_num_rows($res);

    if ($count == 1) {
        $row = mysqli_fetch_assoc($res);
        $title = $row['title'];
        $current_image = $row['image_name'];
        $active = $row['active'];
        $feature = $row['feature'];
    } else {
        $_SESSION['no_category_found'] = "Category not found!";
        header("location:" . SITEURL . 'admin/manage-category.php');
        exit;
    }

} else {
    $_SESSION['no_category_found'] = "Category not found!";
    header("location:" . SITEURL . 'admin/manage-category.php');
    exit;
}
?>

<!-- Main content section start -->
<div id="main-content" class="main-section">
<div class="centered-heading">

<h1 >Update Category</h1>

</div>

    <!-- Display any session messages -->
    <?php
    if (isset($_SESSION['upload_img_fail'])) {
        echo "<div class='error-message'>" . $_SESSION['upload_img_fail'] . "</div>";
        unset($_SESSION['upload_img_fail']);
    }
    if (isset($_SESSION['fail_remove'])) {
        echo "<div class='error-message'>" . $_SESSION['fail_remove'] . "</div>";
        unset($_SESSION['fail_remove']);
    }
    ?>

    <!-- Update Category Form -->
    <form action="" method="post" enctype="multipart/form-data" class="form-container horizontal-form">
        <div class="form-group">
            <label for="title">Title:</label>
            <input type="text" name="title" id="title" value="<?php echo htmlspecialchars($title); ?>" required>
        </div>

        <div class="form-group">
            <label>Current Image:</label>
            <?php if ($current_image != ""): ?>
                <div class="image-preview">
                    <img src="<?php echo SITEURL; ?>/images/category/<?php echo htmlspecialchars($current_image); ?>" alt="Category Image" class="preview-img">
                </div>
            <?php else: ?>
                <p class="no-image-text">No image available.</p>
            <?php endif; ?>
        </div>

        <div class="form-group">
            <label for="image">New Image:</label>
            <input type="file" name="image" id="image">
        </div>

        <div class="form-group">
            <label>Active:</label>
            <div class="radio-group">
                <label><input <?php if ($active == "Yes") { echo "checked"; } ?> type="radio" name="active" value="Yes" required> Yes</label>
                <label><input <?php if ($active == "No") { echo "checked"; } ?> type="radio" name="active" value="No"> No</label>
            </div>
        </div>

        <div class="form-group">
            <label>Featured:</label>
            <div class="radio-group">
                <label><input <?php if ($feature == "Yes") { echo "checked"; } ?> type="radio" name="feature" value="Yes" required> Yes</label>
                <label><input <?php if ($feature == "No") { echo "checked"; } ?> type="radio" name="feature" value="No"> No</label>
            </div>
        </div>

        <div class="form-group">
            <input type="hidden" name="current_image" value="<?php echo htmlspecialchars($current_image); ?>">
            <input type="hidden" name="id" value="<?php echo $id; ?>">
            <input type="submit" name="submit" value="Update Category" class="btn-submit">
        </div>
    </form>

    <?php
    // Handle form submission
    if (isset($_POST['submit'])) {
        // Get the form values
        $id = $_POST['id'];
        $title = $_POST['title'];
        $current_image = $_POST['current_image'];
        $active = $_POST['active'];
        $feature = $_POST['feature'];

        // Handle image upload if a new image is selected
        if (isset($_FILES['image']['name']) && $_FILES['image']['name'] != "") {
            
            $image_name = $_FILES['image']['name'];

            $ext = pathinfo($image_name, PATHINFO_EXTENSION);  // Get file extension

            // Generate a new image name
            $image_name = "food_category_" . rand(000, 999) . '.' . $ext;

            // Define the file paths
            $source_path = $_FILES['image']['tmp_name'];
            $destination_path = "../images/category/" . $image_name;

            // Upload the new image
            $upload = move_uploaded_file($source_path, $destination_path);

            if ($upload == false) {
                $_SESSION['upload_img_fail'] = "Failed to upload image";
                header("location:" . SITEURL . 'admin/manage-category.php');
                exit;
            }

            // Remove the old image if it exists
            if ($current_image != "") {
                $remove_path = "../images/category/" . $current_image;
                $remove = unlink($remove_path);

                if ($remove == false) {
                    $_SESSION['fail_remove'] = "Failed to remove the old image";
                    header("location:" . SITEURL . 'admin/manage-category.php');
                    exit;
                }
            }
        } else {
            // If no new image is uploaded, retain the current image
            $image_name = $current_image;
        }

        // Update the category in the database
        $sql2 = "UPDATE tbl_category SET
            title = '$title',
            image_name = '$image_name',
            active = '$active',
            feature = '$feature'
            WHERE id = $id";

        $res2 = mysqli_query($conn, $sql2);

        if ($res2 == true) {
            $_SESSION['category_updated'] = "Category updated successfully";
            header("location:" . SITEURL . 'admin/manage-category.php');
            exit;
        } else {
            $_SESSION['category_not_updated'] = "Failed to update category";
            header("location:" . SITEURL . 'admin/update-category.php?id=' . $id);
            exit;
        }
    }
    ?>

</div>
<!-- Main content section end -->


