<?php
include 'settings.php';

if (isset($_GET['id']) && isset($_GET['status'])) {
    $orderID = $_GET['id'];
    $newStatus = $_GET['status'];  // Get the new status from the URL

    // Prepare the UPDATE statement
    $stmt = $conn->prepare("UPDATE orders SET order_status = ? WHERE order_id = ?");
    $stmt->bind_param("si", $newStatus, $orderID); // Assuming order_id is an integer

    if ($stmt->execute()) {
        echo "Order status updated to " . htmlspecialchars($newStatus) . " successfully.";
    } else {
        echo "Error updating order: " . $stmt->error;
    }

    $stmt->close();
} else {
    echo "Invalid order ID or status.";
}

$conn->close();
?>
<a href="manager.php">Back to Manager Page</a>
