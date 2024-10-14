<?php
include 'settings.php';

if (isset($_GET['id'])) {
    $orderID = $_GET['id'];

    // Check if the order is pending before deleting
    $stmt = $conn->prepare("SELECT order_status FROM orders WHERE order_id = ?");
    $stmt->bind_param("i", $orderID); // Assuming order_id is an integer
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();

        if ($row['order_status'] === 'PENDING') {
            // Prepare the DELETE statement
            $stmt = $conn->prepare("DELETE FROM orders WHERE order_id = ?");
            $stmt->bind_param("i", $orderID);

            if ($stmt->execute()) {
                echo "Order cancelled successfully.";
            } else {
                echo "Error cancelling order: " . $stmt->error;
            }
        } else {
            echo "Only pending orders can be cancelled.";
        }
    } else {
        echo "Order not found.";
    }

    $stmt->close();
}

$conn->close();
?>
<a href="manager.php">Back to Manager Page</a>
