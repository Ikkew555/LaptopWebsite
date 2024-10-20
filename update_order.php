<?php
include 'settings.php';

if (isset($_POST['order_id']) && isset($_POST['order_status'])) {
    $orderID = $_POST['order_id'];  // Get order ID from POST
    $newStatus = $_POST['order_status'];  // Get new status from POST

    // Prepare the UPDATE statement
    $stmt = $conn->prepare("UPDATE orders SET order_status = ? WHERE order_id = ?");
    $stmt->bind_param("si", $newStatus, $orderID);  // Assuming order_id is an integer

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
