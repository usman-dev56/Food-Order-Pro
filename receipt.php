<?php
include('config/const.php');

// Check if an order ID is provided in the URL
if (isset($_GET['order_id'])) {
    $order_id = $_GET['order_id'];

    // Retrieve the order details from the database
    $sql = "SELECT * FROM tbl_order WHERE id = $order_id";
    $res = mysqli_query($conn, $sql);

    if (mysqli_num_rows($res) > 0) {
        $order = mysqli_fetch_assoc($res);

        // Extract order details
        $food = $order['food'];
        $price = $order['price'];
        $qty = $order['qty'];
        $total = $order['total'];
        $order_date = $order['order_date'];
        $customer_name = $order['customer_name'];
        $customer_contact = $order['customer_contact'];
        $customer_email = $order['customer_email'];
        $customer_address = $order['customer_address'];
    } else {
        // Order not found, redirect to home page
        header('location:' . SITEURL . 'index.php');
        exit;
    }
} else {
    // No order ID provided, redirect to home page
    header('location:' . SITEURL . 'index.php');
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order Receipt - FoodOrderPro</title>
    <link rel="stylesheet" href="css/receipt.css">
    
</head>
<body>
    <section class="receipt">
        <div class="container">
            <!-- Logo Section -->
            <div class="logo">FoodOrderPro</div>

            <!-- Order Details Header -->
            <h2>Order Receipt</h2>

            <p><strong>Order Date:</strong> <?php echo $order_date; ?></p>
            <p><strong>Customer Name:</strong> <?php echo $customer_name; ?></p>
            <p><strong>Contact:</strong> <?php echo $customer_contact; ?></p>
            <p><strong>Email:</strong> <?php echo $customer_email; ?></p>
            <p><strong>Address:</strong> <?php echo $customer_address; ?></p>

            <!-- Order Details Table -->
            <h3>Order Details</h3>
            <div class="order-details">
                <table>
                    <tr>
                        <th>Food</th>
                        <th>Price</th>
                        <th>Quantity</th>
                        <th>Total</th>
                    </tr>
                    <tr>
                        <td><?php echo $food; ?></td>
                        <td>Rs. <?php echo $price; ?></td>
                        <td><?php echo $qty; ?></td>
                        <td>Ra. <?php echo $total; ?></td>
                    </tr>
                </table>
            </div>

            <h3><strong>Total: Ra. <?php echo $total; ?></strong></h3>

            <!-- Thank You Message -->
            <div class="thank-you">
                Thank you for your order, <?php echo $customer_name; ?>! We hope to serve you again soon.
            </div>

            <!-- Download Button -->
            <a href="download_receipt.php?order_id=<?php echo $order_id; ?>" class="btn-primary">Download Receipt</a>
        </div>
    </section>
</body>
</html>
