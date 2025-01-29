

<?php
 ob_start();
 include('index.php') ?>

<div class="admin-panel">
    <div class="main-content">
    
        <header>
        <div class="headings">
            <h1>Add New Category</h1>
            <p>Fill in the details below to add a new food.</p>
         </div>
            <div id="messages">
         <!-- Display messages -->
         <?php
        

        if (isset($_SESSION['upload_img_fail'])) {
            echo "<div class='error-message'>" . $_SESSION['upload_img_fail'] . "</div>";
            unset($_SESSION['upload_img_fail']);
        }
    ?>

    </div>
        </header>

      
 <!-- Add food form starts here -->
  <div class="form-section">
 <form action="" method="post" enctype="multipart/form-data" class="form-container horizontal-form">
            <div class="form-group">
                <label for="title">Title:</label>
                <input type="text" name="title" id="title" placeholder="Food Title" required>
            </div>

            <div class="form-group">
                <label for="description">Description:</label>
                <textarea name="description" cols="30" rows="5" id="description" placeholder="Description of the food." required></textarea>
            </div>

            <div class="form-group">
                <label for="price">Price:</label>
                <input type="number" name="price" id="price" required>
            </div>

            <div class="form-group">
                <label for="image">Select Image:</label>
                <input type="file" name="image" id="image" required>
            </div>

            <div class="form-group">
                <label for="category">Category:</label>
                <select name="category" id="category">

                <?php
                    
                    //category from database
                    $sql="SELECT *FROM tbl_category WHERE available='Yes'";
                    $res = mysqli_query($conn, $sql);

                    $count= mysqli_num_rows($res);

                    if($count>0){
                        // we have categories
                        while($row= mysqli_fetch_assoc($res)){

                            //get the detail of the category
                            $id=$row['id'];
                            $title=$row['title'];
                            ?>

                            <option value="<?php echo $id;?>"> <?php echo $title; ?> </option>

                            <?php
                        }
                    }else{
                        // don't have category
                        ?>
                        <option value="0">No category found</option>

                        <?php
                    }
                    ?>
                   
                    
                </select>
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
                <input type="submit" name="submit" value="Add Food" class="btn-submit">
            </div>
        </form>
        </div>
        <!-- Add food form ends here -->


 
        
<?php
                    if (isset($_POST['submit'])) {


                            //get the data 
                            $title = $_POST['title'];
                            $price = $_POST['price'];
                            $category=$_POST['category'];
                            $description=$_POST['description'];

                            // check whether the radio button is checked or not

                            if(isset($_POST['highlighted'])){

                            $highlighted=$_POST['highlighted'];
                            }else{
                            $highlighted='No'; // setting default value
                            }

                            
                            if(isset($_POST['available'])){

                            $available=$_POST['available'];
                            }else{
                            $available='No'; // setting default value
                            }



                            if (isset($_FILES['image']['name'])) {

                            $image_name = $_FILES['image']['name'];


                            if($image_name!=""){


                                // Auto rename
                            // Get the extension of the image
                            // $ext = end(explode('.', $image_name));
                            $ext = pathinfo($image_name, PATHINFO_EXTENSION);  // Get file extension

                            // Rename image
                            $image_name = "Food-Name-" . rand(0000, 9999) . '.' . $ext;

                            $src = $_FILES['image']['tmp_name'];
                            $dst = "../images/food/" . $image_name;


                            $upload = move_uploaded_file($src, $dst);

                            if ($upload == false) {
                                $_SESSION['upload_img_fail'] = "Failed to upload image";
                                header("location:" . SITEURL . 'admin/add_food.php');
                                die();
                            }
                            }


                            
                        } else {
                            $image_name = "";
                        }
                            

                        //insert data into database
                        $sql2 = "INSERT INTO tbl_food SET
                        title='$title',
                        description='$description',
                        price= $price,
                        image_name='$image_name',
                        category_id= $category,
                         available='$available',
                         highlighted='$highlighted'";

                    $res2 = mysqli_query($conn, $sql2);

                    if ($res2 == true) {
                        $_SESSION['food_add'] = "Food added successfully";
                        header("location:" . SITEURL . 'admin/foods.php');
                    } else {
                        $_SESSION['food_not_add'] = "Failed to add Food";
                        header("location:" . SITEURL . 'admin/foods.php');
                    }



                        
                    }

      ob_end_flush();

?>

       
    </div>

</div>
