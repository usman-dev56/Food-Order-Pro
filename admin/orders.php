
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
        // Display success or error messages 
        if (isset($_SESSION['order_update'])) {
            echo "<div class='success-message'>" . $_SESSION['order_update'] . "</div>";
            unset($_SESSION['order_update']);
        }
        if (isset($_SESSION['fail_to_update'])) {
            echo "<div class='error-message'>" . $_SESSION['fail_to_update'] . "</div>";
            unset($_SESSION['fail_to_update']);
         }
         ?>
</div>
        </header>


<div id="orders" class="section">
    
    <h2 id="manage-heading">Manage Orders</h2>

    <div class="orders-table-container">
        
    <table class="orders-table" >
        <thead>
            <tr>
            <th>S.N.</th>
                        <th>Food</th>
                        <th>Price</th>
                        <th>Qty.</th>
                        <th>Total</th>
                       
                        <th>Customer Name</th>
                        <th>Contact</th>
                        <th>Email</th>
                        <th>Address</th>
                        <th>Order Date</th>
                        <th>Status</th>
                        <th>Actions</th>
            </tr>
        </thead>
        <tbody>
        <?php 
                        //Get all the orders from database
                        $sql = "SELECT * FROM tbl_order ORDER BY id DESC"; // DIsplay the Latest Order at First
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
                                $food = $row['food'];
                                $price = $row['price'];
                                $qty = $row['qty'];
                                $total = $row['total'];
                                $order_date = $row['order_date'];
                                $status = $row['status'];
                                $customer_name = $row['customer_name'];
                                $customer_contact = $row['customer_contact'];
                                $customer_email = $row['customer_email'];
                                $customer_address = $row['customer_address'];
                                
                                ?>

        
            <tr>
            <td><?php echo $sn++; ?>. </td>
                                        <td><?php echo $food; ?></td>
                                        <td>$<?php echo $price; ?></td>
                                        <td><?php echo $qty; ?></td>
                                        <td>$<?php echo $total; ?></td>
                                        
                                        <td><?php echo $customer_name; ?></td>
                                        <td><?php echo $customer_contact; ?></td>
                                        <td><?php echo $customer_email; ?></td>
                                        <td><?php echo $customer_address; ?></td>
                                        <td><?php echo $order_date; ?></td>
                                        <td>
                                            <?php 
                                                // Ordered, On Delivery, Delivered, Cancelled

                                                if($status=="Ordered")
                                                {
                                                    echo "<label >$status</label>";
                                                }
                                                elseif($status=="On Delivery")
                                                {
                                                    echo "<label style='color: orange;'>$status</label>";
                                                }
                                                elseif($status=="Delivered")
                                                {
                                                    echo "<label style='color: green;'>$status</label>";
                                                }
                                                elseif($status=="Cancelled")
                                                {
                                                    echo "<label style='color: red;'>$status</label>";
                                                }
                                            ?>
                                        </td>

                <td><a class="btn-edit" href=" <?php echo SITEURL ?>/admin/edit_order.php?id=<?php echo $id ?>">Edit</a></td>
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

