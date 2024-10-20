<?php
session_start(); // Start the session

// Check if the user is logged in
if (!isset($_SESSION['logged_in']) || $_SESSION['logged_in'] !== true) {
    header('Location: admin_login.php'); // Redirect to login page if not logged in
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="author" content="Nathakorn Wimonwatwethi">
    <title>Manager Orders</title>
    <link rel="stylesheet" type="text/css" href="./styles/global.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" type="text/css" href="./styles/manager.css">
</head>

<body>
    <?php include 'includes/header.inc'; ?>
    <div class="manager-display">
        <h1>Manage Orders</h1>

        <form method="POST">
            <label for="search-type">Search Orders By:</label><br />
            <div id="menu-sort">
                <div id="sort">
                    <select name="search-type" id="search-type">
                        <option value="all">All Orders</option>
                        <option value="customer">Customer Name</option>
                        <option value="product">Product Name</option>
                        <option value="status">Order Status</option>
                    </select>
                    <input type="text" name="search-query" placeholder="Enter search term" />
                    <input id="btn" type="submit" name="search" value="Search" />
                </div>
                <a id="logout" href="logout.php">Logout</a>
            </div>
        </form>

        <table border="1">
            <tr>
                <?php
                $currentSort = isset($_GET['sort']) ? $_GET['sort'] : 'order_id';
                $currentOrder = isset($_GET['order']) ? $_GET['order'] : 'asc';

                function toggleOrder($order)
                {
                    return $order === 'asc' ? 'desc' : 'asc';
                }
                ?>
                <th>
                    <a href="?sort=order_id&order=<?= toggleOrder($currentOrder) ?>">
                        Order ID
                        <svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" viewBox="0 0 24 24">
                            <path fill="currentColor" d="M6.293 4.293a1 1 0 0 1 1.414 0l4 4a1 1 0 0 1-1.414 1.414L8 7.414V19a1 1 0 1 1-2 0V7.414L3.707 9.707a1 1 0 0 1-1.414-1.414zM16 16.586V5a1 1 0 1 1 2 0v11.586l2.293-2.293a1 1 0 0 1 1.414 1.414l-4 4a1 1 0 0 1-1.414 0l-4-4a1 1 0 0 1 1.414-1.414z" />
                        </svg>
                    </a>
                </th>
                <th>
                    <a href="?sort=order_time&order=<?= toggleOrder($currentOrder) ?>">
                        Order Time
                        <svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" viewBox="0 0 24 24">
                            <path fill="currentColor" d="M6.293 4.293a1 1 0 0 1 1.414 0l4 4a1 1 0 0 1-1.414 1.414L8 7.414V19a1 1 0 1 1-2 0V7.414L3.707 9.707a1 1 0 0 1-1.414-1.414zM16 16.586V5a1 1 0 1 1 2 0v11.586l2.293-2.293a1 1 0 0 1 1.414 1.414l-4 4a1 1 0 0 1-1.414 0l-4-4a1 1 0 0 1 1.414-1.414z" />
                        </svg>
                    </a>
                </th>
                <th>
                    <a href="?sort=product&order=<?= toggleOrder($currentOrder) ?>">
                        Product
                        <svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" viewBox="0 0 24 24">
                            <path fill="currentColor" d="M6.293 4.293a1 1 0 0 1 1.414 0l4 4a1 1 0 0 1-1.414 1.414L8 7.414V19a1 1 0 1 1-2 0V7.414L3.707 9.707a1 1 0 0 1-1.414-1.414zM16 16.586V5a1 1 0 1 1 2 0v11.586l2.293-2.293a1 1 0 0 1 1.414 1.414l-4 4a1 1 0 0 1-1.414 0l-4-4a1 1 0 0 1 1.414-1.414z" />
                        </svg>
                    </a>
                </th>
                <th>
                    <a href="?sort=order_cost&order=<?= toggleOrder($currentOrder) ?>">
                        Total
                        <svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" viewBox="0 0 24 24">
                            <path fill="currentColor" d="M6.293 4.293a1 1 0 0 1 1.414 0l4 4a1 1 0 0 1-1.414 1.414L8 7.414V19a1 1 0 1 1-2 0V7.414L3.707 9.707a1 1 0 0 1-1.414-1.414zM16 16.586V5a1 1 0 1 1 2 0v11.586l2.293-2.293a1 1 0 0 1 1.414 1.414l-4 4a1 1 0 0 1-1.414 0l-4-4a1 1 0 0 1 1.414-1.414z" />
                        </svg>
                    </a>
                </th>
                <th>
                    <a href="?sort=customer&order=<?= toggleOrder($currentOrder) ?>">
                        Customer Name
                        <svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" viewBox="0 0 24 24">
                            <path fill="currentColor" d="M6.293 4.293a1 1 0 0 1 1.414 0l4 4a1 1 0 0 1-1.414 1.414L8 7.414V19a1 1 0 1 1-2 0V7.414L3.707 9.707a1 1 0 0 1-1.414-1.414zM16 16.586V5a1 1 0 1 1 2 0v11.586l2.293-2.293a1 1 0 0 1 1.414 1.414l-4 4a1 1 0 0 1-1.414 0l-4-4a1 1 0 0 1 1.414-1.414z" />
                        </svg>
                    </a>
                </th>
                <th>
                    <a href="?sort=status&order=<?= toggleOrder($currentOrder) ?>">
                        Status
                        <svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" viewBox="0 0 24 24">
                            <path fill="currentColor" d="M6.293 4.293a1 1 0 0 1 1.414 0l4 4a1 1 0 0 1-1.414 1.414L8 7.414V19a1 1 0 1 1-2 0V7.414L3.707 9.707a1 1 0 0 1-1.414-1.414zM16 16.586V5a1 1 0 1 1 2 0v11.586l2.293-2.293a1 1 0 0 1 1.414 1.414l-4 4a1 1 0 0 1-1.414 0l-4-4a1 1 0 0 1 1.414-1.414z" />
                        </svg>
                    </a>
                </th>
                <th>Action</th>
            </tr>

            <?php
            include 'settings.php';
            $sql = "SELECT * FROM orders";

            if (isset($_POST['search'])) {
                $searchType = $_POST['search-type'];
                $searchQuery = $conn->real_escape_string(trim($_POST['search-query']));

                if ($searchType == "customer") {
                    $sql .= " WHERE first_name LIKE '%$searchQuery%' OR last_name LIKE '%$searchQuery%'";
                } elseif ($searchType == "product") {
                    $sql .= " WHERE product LIKE '%$searchQuery%'";
                } elseif ($searchType == "status") {
                    $sql .= " WHERE order_status = '$searchQuery'";
                }
            }

            if (in_array($currentSort, ['order_id', 'order_time', 'product', 'order_cost', 'customer', 'status']) && in_array($currentOrder, ['asc', 'desc'])) {
                if ($currentSort == 'status') {
                    // Custom sort order for status
                    $sql .= " ORDER BY FIELD(order_status, 'pending', 'fulfilled', 'paid', 'archived') $currentOrder";
                } elseif ($currentSort == 'customer') {
                    // Sort by customer name (first and last)
                    $sql .= " ORDER BY CONCAT(first_name, ' ', last_name) $currentOrder";
                } else {
                    $sql .= " ORDER BY $currentSort $currentOrder";
                }
            }

            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    $statusClass = "status-" . strtolower($row['order_status']);
                    echo "<tr>";
                    echo "<td>" . htmlspecialchars($row['order_id']) . "</td>";
                    echo "<td>" . htmlspecialchars($row['order_time']) . "</td>";
                    echo "<td>" . htmlspecialchars($row['product']) . "</td>";
                    echo "<td>$" . number_format($row['order_cost'], 2) . "</td>";
                    echo "<td>" . htmlspecialchars($row['first_name']) . " " . htmlspecialchars($row['last_name']) . "</td>";
                    echo "<td class='$statusClass'>" . htmlspecialchars($row['order_status']) . "</td>";
                    echo "<td class='action-icons'>";
                    // Assuming you want to disable actions for archived orders
                    if ($row['order_status'] != "ARCHIVED") {
                        echo "<i class='fas fa-edit' onclick='openPopup(" . $row['order_id'] . ")'></i>";
                        echo "<i class='fas fa-trash-alt' onclick='window.location.href=\"cancel_order.php?id=" . $row['order_id'] . "\"'></i>";
                    } else {
                        echo "<i id='edit-complete'class='fas fa-edit'></i>";
                        echo "<i id='bin-complete' class='fas fa-trash-alt'></i>";
                    }
                    echo "</td>";

                    echo "</tr>";
                }
            } else {
                echo "<tr><td colspan='7'>No results found</td></tr>";
            }
            ?>
        </table>

        <div class="overlay" id="overlay" onclick="closePopup()"></div>
        <div class="popup" id="popup">
            <span class="close-btn" onclick="closePopup()">&times;</span>
            <h2>Update Order Status</h2>
            <form method="POST" action="update_order.php">
                <input type="hidden" name="order_id" id="order-id">
                <label for="order-status">Select Status:</label>
                <select name="order_status" id="order-status">
                    <option value="pending">Pending</option>
                    <option value="fulfilled">Fulfilled</option>
                    <option value="paid">Paid</option>
                    <option value="archived">Archived</option>
                </select>
                <button type="submit">Okay</button>
            </form>
        </div>

    </div>

    <script>
        function openPopup(orderId) {
            document.getElementById('order-id').value = orderId; // Set order ID in the hidden input
            document.getElementById('popup').style.display = 'block';
            document.getElementById('overlay').style.display = 'block';
        }

        function closePopup() {
            document.getElementById('popup').style.display = 'none';
            document.getElementById('overlay').style.display = 'none';
        }
    </script>
</body>

</html>