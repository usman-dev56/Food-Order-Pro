
<?php
 ob_start();
include('index.php');

if (isset($_GET["id"])) {
    $id = $_GET['id'];

    $sql2 = "SELECT * FROM tbl_food WHERE id = $id";
    // Execute the query
    $res2 = mysqli_query($conn, $sql2);

    $count2 = mysqli_num_rows($res2);

    if ($count2 == 1) {
        $row2 = mysqli_fetch_assoc($res2);
        $title = $row2['title'];
        $description = $row2['description'];
        $price = $row2['price'];
        $current_image = $row2['image_name'];
        $current_category = $row2['category_id'];
        $available = $row2['available'];
        $highlighted = $row2['highlighted'];
    } else {
        header("location:" . SITEURL . 'admin/manage-food.php');
        exit;
    }

} else {
    $_SESSION['no_food_found'] = "Food not found!";
    header("location:" . SITEURL . 'admin/manage-food.php');
    exit;
}
?>

<div class="admin-panel">
<div class="main-content">
    
     

        
      <!-- Update food form starts -->
        <!-- Update food form starts -->
        <div class="edit-form-section">
    <form action="" method="post" enctype="multipart/form-data" class="form-container horizontal-form">
        <div class="form-group">
            <label for="title">Title:</label>
            <input type="text" name="title" id="title" value="<?php echo $title; ?>" required>
        </div>

        <div class="form-group">
            <label for="description">Description:</label>
            <textarea name="description" cols="30" rows="5" id="description" required><?php echo $description; ?></textarea>
        </div>

        <div class="form-group">
            <label for="price">Price:</label>
            <input type="number" name="price" id="price" value="<?php echo $price; ?>" required>
        </div>

        <div class="form-group">
            <label>Current Image:</label>
            <?php if ($current_image != ""): ?>
                <div class="image-preview">
                    <img src="<?php echo SITEURL; ?>/images/food/<?php echo htmlspecialchars($current_image); ?>" alt="Food Image" class="preview-img">
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
            <label for="category">Category:</label>
            <select name="category" id="category">
                <?php
                $sql = "SELECT * FROM tbl_category WHERE available = 'Yes'";
                $res = mysqli_query($conn, $sql);
                $count = mysqli_num_rows($res);
                
                if ($count > 0) {
                    while ($row = mysqli_fetch_assoc($res)) {
                        $category_id = $row['id'];
                        $category_title = $row['title'];
                        ?>
                        <option <?php if ($current_category == $category_id) { echo "Selected"; } ?> value="<?php echo $category_id; ?>"> 
                            <?php echo $category_title; ?> 
                        </option>
                        <?php
                    }
                } else {
                    ?>
                    <option value="0">No Category Available</option>
                    <?php
                }
                ?>
            </select>
        </div>

        <div class="form-group">
            <label>Available:</label>
            <div class="radio-group">
                <label><input <?php if ($available == "Yes") { echo "checked"; } ?> type="radio" name="available" value="Yes" required> Yes</label>
                <label><input <?php if ($available == "No") { echo "checked"; } ?> type="radio" name="available" value="No"> No</label>
            </div>
        </div>

        <div class="form-group">
            <label>Highlighted:</label>
            <div class="radio-group">
                <label><input <?php if ($highlighted == "Yes") { echo "checked"; } ?> type="radio" name="highlighted" value="Yes" required> Yes</label>
                <label><input <?php if ($highlighted == "No") { echo "checked"; } ?> type="radio" name="highlighted" value="No"> No</label>
            </div>
        </div>

        <div class="form-group">
            <input type="hidden" name="current_image" value="<?php echo $current_image; ?>">
            <input type="hidden" name="id" value="<?php echo $id; ?>">
            <input type="submit" name="submit" value="Update Food" class="btn-submit">
        </div>
    </form>
    </div>
    <!-- Update food form ends -->

<!-- Main content section end -->
<?php
    if (isset($_POST['submit'])) {
        // Sanitize inputs
        $id = mysqli_real_escape_string($conn, $_POST['id']);
        $title = mysqli_real_escape_string($conn, $_POST['title']);
        $description = mysqli_real_escape_string($conn, $_POST['description']);
        $price = mysqli_real_escape_string($conn, $_POST['price']);
        $current_image = mysqli_real_escape_string($conn, $_POST['current_image']);
        $category = mysqli_real_escape_string($conn, $_POST['category']);
        $available = mysqli_real_escape_string($conn, $_POST['available']);
        $highlighted = mysqli_real_escape_string($conn, $_POST['highlighted']);
        
        if (isset($_FILES['image']['name']) && $_FILES['image']['name'] != "") {
            // Get new image
            $image_name = $_FILES['image']['name'];
            $ext_arr = explode('.', $image_name);
            $ext = end($ext_arr);

            // Rename image
            $image_name = "Food-Name-" . rand(0000, 9999) . '.' . $ext;

            $source_path = $_FILES['image']['tmp_name'];
            $destination_path = "../images/food/" . $image_name;

            // Upload the image
            $upload = move_uploaded_file($source_path, $destination_path);

            if ($upload == false) {
                $_SESSION['upload_img_fail'] = "Failed to upload image";
                header("location:" . SITEURL . 'admin/foods.php');
                exit;
            }

            // Remove the old image
            $remove_path = "../images/food/" . $current_image;
            if (file_exists($remove_path)) {
                $remove = unlink($remove_path);
                if ($remove == false) {
                    $_SESSION['fail_remove'] = "Failed to remove current image";
                    header("location:" . SITEURL . 'admin/foods.php');
                    exit;
                }
            }
        } else {
            // Keep the old image if no new one is uploaded
            $image_name = $current_image;
        }

        // Update the food record in the database
        $sql3 = "UPDATE tbl_food SET
            title = '$title',
            description = '$description',
            price = $price,
            image_name = '$image_name',
            category_id = '$category',
            available = '$available',
            highlighted = '$highlighted'
            WHERE id = $id";

        // Execute the query
        $res3 = mysqli_query($conn, $sql3);
        
        if ($res3 == true) {
            $_SESSION['food_updated'] = "Food updated successfully";
            header("location:" . SITEURL . 'admin/foods.php');
            exit;
        } else {
            $_SESSION['food_not_updated'] = "Failed to update food";
            header("location:" . SITEURL . 'admin/foods.php?id=' . $id);
            exit;
        }
    }

    ob_end_flush();

    ?>

    </div>
</div>



