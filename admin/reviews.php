
<?php include('index.php') ?>
<?php
// Check if the status change is requested
if (isset($_GET['change_status']) && isset($_GET['id'])) {
    $id = $_GET['id'];
    
    // Update the status to 'Read'
    $sql = "UPDATE tbl_contact_us SET status = 'Read' WHERE id = $id";
    $res = mysqli_query($conn, $sql);
    
    if ($res) {
        $_SESSION['status_updated'] = "Status updated to Read.";
    } else {
        $_SESSION['status_not_updated'] = "Failed to update status.";
    }
    
    // Redirect back to the page to see the updated status
    header('Location: ' . $_SERVER['PHP_SELF']);
    exit();
}
?>


<!-- <div id="categories" class="section"> -->
<div class="main-content">
        <header>
        <div class="headings">
        <h1>Welcome, <?php echo isset($_SESSION['full_name']) ? $_SESSION['full_name'] : 'Admin'; ?> !</h1>
            <p>Manage your food ordering platform</p>
            </div>
            <div id="messages">
         
        </header>


<div id="orders" class="section">
    
    <h2 id="manage-heading">Manage Reviews</h2>

    <div class="orders-table-container">
        
    <table class="orders-table" >
        <thead>
            <tr>
            <th>S.N.</th>
                        
                        <th>Sender Name</th>
                        <th>Email</th>
                        <th>Mobile No</th>
                        <th>Subject</th>
                        <th>Message</th>
                        <th>Date</th>
                        <th>Status</th>
                        <th>Actions</th>
            </tr>
        </thead>
        <tbody>
        <?php 
                        //Get all the orders from database
                        $sql = "SELECT * FROM tbl_contact_us ORDER BY id DESC"; // DIsplay the Latest Order at First
                        //Execute Query
                        $res = mysqli_query($conn, $sql);
                        //Count the Rows
                        $count = mysqli_num_rows($res);

                        $sn = 1; //Create a Serial Number and set its initail value as 1

                        if($count>0)
                        {
                            //Order Available
                            while($row=mysqli_fetch_assoc($res))
                            {
                                //Get all the order details
                                $id = $row['id'];
                                $sender_name = $row['sender_name'];
                                $email = $row['email'];
                                $phone_number = $row['phone_number'];
                                $subject = $row['subject'];
                                $message = $row['message'];
                                $contact_date = $row['contact_date'];
                                $status = $row['status'];
                               
                                
                                ?>

        
            <tr>
            <td><?php echo $sn++; ?>. </td>

                                        <td><?php echo $sender_name; ?></td>
                                        <td><?php echo $email; ?></td>
                                        <td><?php echo $phone_number; ?></td>
                                        <td><?php echo $subject; ?></td>
                                        <td><?php echo $message; ?></td>

                                        <td><?php echo $contact_date; ?></td>
                                        <td>
                                            <?php 
                                                // Ordered, On Delivery, Delivered, Cancelled

                                                if($status=="Unread")
                                                {
                                                    echo "<label >$status</label>";
                                                } elseif($status=="Read")
                                                {
                                                    echo "<label style='color: green;'>$status</label>";
                                                }
                                            ?>
                                        </td>

                                        

                                        
                                        <td>
    <?php 
        if ($status == "Unread") {
            // Generate the URL dynamically
            $url = "?change_status&id=" . $id;
        ?>
            <a class="btn-edit" href="<?php echo $url; ?>">Mark as Read</a>
        <?php 
        } else {
            echo "<label style='color: green;'>$status</label>";
        }
    ?>
</td>

            </tr>
            

       

        <?php
                }
            } else {
                // No data found
                echo "<tr><td colspan='6' class='no-data'>No Order Found</td></tr>";
            }
        ?>
         </tbody>
    </table>
    </div>
    </div>
</div>

