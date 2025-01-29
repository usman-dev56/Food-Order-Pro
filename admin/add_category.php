

<?php
 ob_start();
 include('index.php') ?>

<div class="admin-panel">
<div class="main-content">
    
        <header>
        <div class="headings">
            <h1>Add New Category</h1>
            <p>Fill in the details below to add a new category.</p>
            
            <div id="messages">
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
    </div>
        </header>


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
        <div class="form-section">
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
            <label>Available:</label>
            <div class="radio-group">
            <label><input type="radio" name="available" value="Yes" required> Yes</label>
            <label><input type="radio" name="available" value="No"> No</label>
            </div>
        </div>

        <div class="form-group">
            <label>Highlighted:</label>
            <div class="radio-group">
            <label><input type="radio" name="highlighted" value="Yes" required> Yes</label>
            <label><input type="radio" name="highlighted" value="No"> No</label>
            </div>
        </div>

        <div class="form-group">
            <input type="submit" name="submit" value="Add Category" class="btn-submit">
        </div>
    </form>
    </div>

<!-- Main content section end -->
<?php
    if (isset($_POST['submit'])) {
        $title = $_POST['title'];
        $available = $_POST['available'];
        $highlighted = $_POST['highlighted'];

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
                header("location:" . SITEURL . 'admin/add_category.php');
                die();
            }
        } else {
            $image_name = "";
        }
      

        // insert data into database
        $sql = "INSERT INTO tbl_category SET
            title='$title',
            image_name='$image_name',
            available='$available',
            highlighted='$highlighted'";

        $res = mysqli_query($conn, $sql);

        if ($res == true) {
            $_SESSION['category_add'] = "Category added successfully";
            header("location:" . SITEURL . 'admin/categories.php');
        } else {
            $_SESSION['category_not_add'] = "Failed to add Category";
            header("location:" . SITEURL . 'admin/add_category.php');
        }
    }
    
    ob_end_flush();
    ?>

      
    </div>
</div>

