<?php include('index.php') ?>
    <!-- Main Content -->
    <div class="main-content">
        <header >
        <div class="headings">
            <h1>Welcome, <?php echo isset($_SESSION['full_name']) ? $_SESSION['full_name'] : 'Admin'; ?> !</h1>

            <p>Manage your food ordering platform</p>
            </div>
<div id="messages">
            <?php
   if (isset($_SESSION['login'])) {
      echo "<div class='success-message'>" . $_SESSION['login'] . "</div>";
      unset($_SESSION['login']);
   }
   ?>
    </div>
        </header>

        <div class="overview">
        <!-- Existing Dashboard Cards -->
        <div class="card">
            <div class="icon"><i class="fas fa-pizza-slice"></i></div>
            <?php
                     $sql1 = 'SELECT * FROM tbl_food';
                    $res1 = mysqli_query($conn, $sql1);
                    $count1 = mysqli_num_rows($res1);
                    ?>
            <h3>Foods</h3>
            <p><?php echo $count1 ?></p>
        </div>

        <div class="card">
            <div class="icon"><i class="fas fa-list-alt"></i></div>
            <?php
                     $sql2 = 'SELECT * FROM tbl_category';
                    $res2 = mysqli_query($conn, $sql2);
                    $count2 = mysqli_num_rows($res2);
                    ?>
            <h3>Categories</h3>
            <p><?php echo $count2 ?></p>
        </div>

        <div class="card">
        
            <div class="icon"><i class="fas fa-shopping-cart"></i></div> <!-- Changed the icon here -->
            <?php
                     $sql3 = 'SELECT * FROM tbl_order';
                    $res3 = mysqli_query($conn, $sql3);
                    $count3 = mysqli_num_rows($res3);
                    ?>
            <h3>Total Orders</h3>
            <p><?php echo $count3 ?></p>
        </div>

    <!-- New Cards for Order Statuses -->
    <div class="card">
            <div class="icon"><i class="fas fa-times-circle"></i></div>
            <?php
            $sql4 = 'SELECT * FROM tbl_order WHERE status = "Cancelled"';
            $res4 = mysqli_query($conn, $sql4);
            $count4 = mysqli_num_rows($res4);
            ?>
            <h3>Cancelled Orders</h3>
            <p><?php echo $count4 ?></p> <!-- Count of cancelled orders -->
        </div>

        <div class="card">
            <div class="icon"><i class="fas fa-check-circle"></i></div>
            <?php
            $sql5 = 'SELECT * FROM tbl_order WHERE status = "Delivered"';
            $res5 = mysqli_query($conn, $sql5);
            $count5 = mysqli_num_rows($res5);
            ?>
            <h3>Delivered Orders</h3>
            <p><?php echo $count5 ?></p> <!-- Count of delivered orders -->
        </div>

         <div class="card">
            <div class="icon"><i class="fas fa-clock"></i></div>
            <?php
            $sql6 = 'SELECT * FROM tbl_order WHERE status = "On Delivery"';
            $res6 = mysqli_query($conn, $sql6);
            $count6 = mysqli_num_rows($res6);
            ?>
            <h3>Pending Orders</h3>
            <p><?php echo $count6 ?></p> 
        </div> 
        <div class="card">
        <div class="icon"><i class="fas fa-eye"></i></div> 
            <?php
            $sql7 = 'SELECT * FROM tbl_contact_us WHERE status = "Unread"';
            $res7 = mysqli_query($conn, $sql7);
            $count7 = mysqli_num_rows($res7);
            ?>
            <h3>Reviews</h3>
            <p><?php echo $count7 ?></p> 
        </div> 

        <div class="card">
        <div class="icon"><i class="fas fa-wallet"></i></div> <!-- Icon for Cash -->
            <?php
            $sql8 = 'SELECT SUM(total) AS Total FROM tbl_order WHERE status = "Delivered"';
            $res8 = mysqli_query($conn, $sql8);
            $row8 = mysqli_fetch_assoc($res8);
            $revenu=$row8['Total'];
            ?>
            <h3>Total Revenu</h3>
            <p>Rs. <?php echo  $revenu  ?></p> <!-- Count of Revenu -->
        </div>
    </div>


    
</div>

</body>
</html>

