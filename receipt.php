<?php

// // Start session to ensure session variables can be accessed
// session_start();

// // Check if the user has a valid session or order access
// if (!isset($_SESSION['form_submitted']) || $_SESSION['form_submitted'] !== true) {
//     // Redirect to the home page or display an error
//     header('Location: index.php'); // Change to your main page
//     exit();
// }

// Enable error reporting for debugging
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// Include your settings file
include 'settings.php';

// Check if order_id is passed in the URL
$orderExists = false; // Default to false

if (isset($_GET['order_id'])) {
    $order_id = intval($_GET['order_id']);  // Ensure order_id is an integer for security

    // Fetch the order details from the database
    $sql = "SELECT * FROM orders WHERE order_id = ?";
    $stmt = $conn->prepare($sql);

    if (!$stmt) {
        die("Error preparing statement: " . $conn->error);
    }

    $stmt->bind_param("i", $order_id);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();  // Fetch the order data
        $orderExists = true; // Order found

        // Determine the product image based on the product name
        $imageFilename = 'default.png';  // Default image

        switch (trim($row['product'])) {
            case 'HP Victus 15.6" Full HD 144Hz Gaming Laptop (13th Gen Intel i7)[GeForce RTX 4060]':
                $imageFilename = 'HPVictus.png';
                break;
            case 'MSI Raider GE68HX 16" QHD+ 240Hz Gaming Laptop (13th Gen Intel i7)[GeForce RTX 4070]':
                $imageFilename = 'MSIRaider.png';
                break;
            case 'Apple MacBook Air 15-inch with M3 chip, 10-core GPU 256GB/8GB (Midnight) [2024]':
                $imageFilename = 'MacBookAir15inch.png';
                break;
            case 'Microsoft Surface Pro (11th Edition) Copilot+ PC 13" Snapdragon X Plus/16GB/256GB':
                $imageFilename = 'MicrosoftSurfacePro.png';
                break;
        }
    }

    $stmt->close();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="styles/receipt.css" />
    <link rel="stylesheet" type="text/css" href="styles/global.css" />
    <script defer src="scripts/receipt.js" type="text/javascript"></script>
    <title>Order Receipt</title>
</head>

<body>
    <?php include "includes/header.inc"; ?>
    <div class="receipt">
        <?php if (!$orderExists): ?>
            <p class="error">Order not found.</p>
        <?php else: ?>
            <img id="logo" src="images/logo.png" />
            <h1 id="title">Confirmed the Order!!</h1>
            <br />
            <p class="main-text">
                <strong>Hello, <?= htmlspecialchars($row['first_name']) ?> <?= htmlspecialchars($row['last_name']) ?></strong>
            </p>
            <br />
            <p class="sub-text">
                Your order is successfully accepted and will be shipped in 3-4 days.
            </p>
            <br />
            <div class="contact-info">
                <div class="order-box-30">
                    <p class="sub-text">Contact Method</p>
                    <p class="main-text"><?= htmlspecialchars($row['contact_method']) ?></p>
                </div>
                <div class="order-box-30">
                    <p class="sub-text">Phone</p>
                    <p class="main-text"><?= htmlspecialchars($row['phone']) ?></p>
                </div>
                <div class="order-box-30">
                    <p class="sub-text">Email</p>
                    <p class="main-text"><?= htmlspecialchars($row['email']) ?></p>
                </div>
            </div>

            <div id="line"></div>
            <div class="payment-info">
                <div class="order-box-30">
                    <p class="sub-text">Order Date</p>
                    <p class="main-text"><?= htmlspecialchars($row['order_time']) ?></p>
                </div>
                <div class="order-box-30">
                    <p class="sub-text">Order ID</p>
                    <p class="main-text"><?= htmlspecialchars($row['order_id']) ?></p>
                </div>
                <div class="order-box-40">
                    <p class="sub-text">Address</p>
                    <p class="main-text">
                        <?= htmlspecialchars($row['street_address']) ?>
                        <?= htmlspecialchars($row['suburb']) ?>
                        <?= htmlspecialchars($row['state']) ?>
                        <?= htmlspecialchars($row['postcode']) ?>
                    </p>
                </div>
            </div>

            <div id="line"></div>
            <div class="product-info">
                <div class="product-image">
                    <img src="images/product/<?= htmlspecialchars($imageFilename) ?>" alt="Product Image" />
                </div>
                <div class="product-info-text">
                    <div id="product-title">
                        <div id="product-name">
                            <p class="main-text"><?= htmlspecialchars($row['product']) ?></p>
                        </div>
                        <p class="main-text">$<?= htmlspecialchars($row['price_ea']) ?>.00</p>
                    </div>
                    <p class="sub-text">Quantity: <?= htmlspecialchars($row['quantity']) ?></p>
                    <p class="sub-text">Features: <?= htmlspecialchars($row['features']) ?></p>
                </div>
            </div>

            <div id="line"></div>
            <p>Comments: <?= htmlspecialchars($row['comments']) ?></p>
            <div id="line"></div>

            <?php
            $subtotal = $row['order_cost'];
            $shippingFee = 0.00;
            $tax = $subtotal * 0.00;
            $total = $subtotal + $tax;
            ?>

            <div class="total-container">
                <div class="total">
                    <div class="price-box">
                        <p class="sub-text">Subtotal</p>
                        <p class="main-text">$<?= number_format($subtotal, 2) ?></p>
                    </div>
                    <br />

                    <div class="price-box">
                        <p class="sub-text">Shipping Fee</p>
                        <p class="main-text">$<?= number_format($shippingFee, 2) ?></p>
                    </div>
                    <div id="line-8px"></div>
                    <div class="price-box">
                        <p class="main-text">Total</p>
                        <p class="main-text">$<?= number_format($total, 2) ?></p>
                    </div>
                </div>
            </div>

            <div class="text">
                <p class="sub-text">We will send a confirmation email with shipping details once processed.</p>
                <br />
                <p class="main-text">Thank you for shopping with us!</p>
                <p class="main-text">s1xkyriceBoi Team</p>
            </div>
            <div class="visit-web">
                See our new arrivals! <a href="product.php">s1xkyriceBoi</a>
            </div>
        <?php endif; ?>
    </div>
    <div class="print">
        <button id="print-btn" class="print-btn">🖨️ Print Receipt</button>
    </div>
    <?php include "includes/footer.inc"; ?>
    <?php $conn->close(); ?>
</body>

</html>