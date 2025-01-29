

<?php
 ob_start();
  include('index.php') ?>

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
        $available = $row['available'];
        $highlighted = $row['highlighted'];
    } else {
        $_SESSION['no_category_found'] = "Category not found!";
        header("location:" . SITEURL . 'admin/categories.php');
        exit;
    }

} else {
    $_SESSION['no_category_found'] = "Category not found!";
    header("location:" . SITEURL . 'admin/categories.php');
    exit;
}
?>

<div class="admin-panel">
<div class="main-content">
    
        <header>
        <div class="headings">
            <h1>Edit Category</h1>
            <p>Modify the detail of the selected category.</p>
            </div>
            <div id="messages">
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
    </div>
        </header>


        
     <!-- Update Category Form -->
     <div class="form-section">
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
            <label>Available:</label>
            <div class="radio-group">
                <label><input <?php if ($available == "Yes") { echo "checked"; } ?> type="radio" name="available" value="Yes" required> Yes</label>
                <label><input <?php if ($available == "No") { echo "checked"; } ?> type="radio" name="available" value="No"> No</label>
            </div>
        </div>

        <div class="form-group">
            <label>highlighted:</label>
            <div class="radio-group">
                <label><input <?php if ($highlighted == "Yes") { echo "checked"; } ?> type="radio" name="highlighted" value="Yes" required> Yes</label>
                <label><input <?php if ($highlighted == "No") { echo "checked"; } ?> type="radio" name="highlighted" value="No"> No</label>
            </div>
        </div>

        <div class="form-group">
            <input type="hidden" name="current_image" value="<?php echo htmlspecialchars($current_image); ?>">
            <input type="hidden" name="id" value="<?php echo $id; ?>">
            <input type="submit" name="submit" value="Update Category" class="btn-submit">
        </div>
    </form>
    </div>

<!-- Main content section end -->
<?php
    // Handle form submission
    if (isset($_POST['submit'])) {
        // Get the form values
        $id = $_POST['id'];
        $title = $_POST['title'];
        $current_image = $_POST['current_image'];
        $available = $_POST['available'];
        $highlighted = $_POST['highlighted'];

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
                header("location:" . SITEURL . 'admin/categories.php');
                exit;
            }

            // Remove the old image if it exists
            if ($current_image != "") {
                $remove_path = "../images/category/" . $current_image;
                $remove = unlink($remove_path);

                if ($remove == false) {
                    $_SESSION['fail_remove'] = "Failed to remove the old image";
                    header("location:" . SITEURL . 'admin/categories.php');
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
            available = '$available',
            highlighted = '$highlighted'
            WHERE id = $id";

        $res2 = mysqli_query($conn, $sql2);

        if ($res2 == true) {
            $_SESSION['category_updated'] = "Category updated successfully";
            header("location:" . SITEURL . 'admin/categories.php');
            exit;
        } else {
            $_SESSION['category_not_updated'] = "Failed to update category";
            header("location:" . SITEURL . 'admin/edit-category.php?id=' . $id);
            exit;
        }
    }

    ob_end_flush();
    ?>

    </div>
</div>
</div>

