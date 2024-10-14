<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="author" content="Nathakorn Wimonwatwethi">
    <title>Manager Orders</title>
    <link rel="stylesheet" type="text/css" href="./styles/global.css">
</head>

<body>

    <?php include 'includes/header.inc'; ?>

    <h1>Manage Orders</h1>

    <!-- Search Form -->
    <form method="POST">
        <label for="search-type">Search Orders By:</label>
        <select name="search-type" id="search-type">
            <option value="all">All Orders</option>
            <option value="customer">Customer Name</option>
            <option value="product">Product Name</option>
            <option value="status">Order Status</option>
        </select>
        <input type="text" name="search-query" placeholder="Enter search term">
        <input type="submit" name="search" value="Search">
    </form>

    <!-- Display Orders in a Table -->
    <table border="1">
        <tr>
            <th>Order ID</th>
            <th>Order Time</th>
            <th>Product</th>
            <th>Total</th>
            <th>Customer Name</th>
            <th>Status</th>
            <th>Update</th>
            <th>Cancle</th>
        </tr>

        <?php
        include 'settings.php'; // Make sure to include your database connection settings

        // Set up the SQL query
        $sql = "SELECT * FROM orders";  // Default query to fetch all orders

        if (isset($_POST['search'])) {
            $searchType = $_POST['search-type'];
            $searchQuery = $conn->real_escape_string(trim($_POST['search-query'])); // Sanitize user input

            // Modify the SQL query based on the search type
            if ($searchType == "customer") {
                $sql .= " WHERE first_name LIKE '%$searchQuery%' OR last_name LIKE '%$searchQuery%'";
            } elseif ($searchType == "product") {
                $sql .= " WHERE product LIKE '%$searchQuery%'";
            } elseif ($searchType == "status") {
                $sql .= " WHERE order_status = '$searchQuery'";
            }
        }

        // Execute the SQL query
        $result = $conn->query($sql);

        // Check if there are results and display them
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                echo "<tr>";
                echo "<td>" . htmlspecialchars($row['order_id']) . "</td>"; // Assuming 'order_id' is the primary key
                echo "<td>" . htmlspecialchars($row['order_time']) . "</td>";
                echo "<td>" . htmlspecialchars($row['product']) . "</td>";
                echo "<td>$" . number_format($row['order_cost'], 2) . "</td>"; // Display cost formatted to 2 decimal places
                echo "<td>" . htmlspecialchars($row['first_name']) . " " . htmlspecialchars($row['last_name']) . "</td>";
                echo "<td>" . htmlspecialchars($row['order_status']) . "</td>";
                echo "<td>";
                if ($row['order_status'] != 'ARCHIVED') {
                    echo "<a href='update_order.php?id=" . htmlspecialchars($row['order_id']) . "&status=pending'>Set Pending</a> | ";
                    echo "<a href='update_order.php?id=" . htmlspecialchars($row['order_id']) . "&status=fulfilled'>Set Fulfilled</a> | ";
                    echo "<a href='update_order.php?id=" . htmlspecialchars($row['order_id']) . "&status=paid'>Set Paid</a> | ";
                    echo "<a href='update_order.php?id=" . htmlspecialchars($row['order_id']) . "&status=archived'>Set Archived</a> | ";
                }
                echo "</td>";
                echo "<td>";
                if ($row['order_status'] == 'PENDING') {
                    echo "<a href='cancel_order.php?id=" . htmlspecialchars($row['order_id']) . "'>Cancel</a>";
                }
                echo "</td>";
                echo "</tr>";
            }
        } else {
            echo "<tr><td colspan='7'>No results found</td></tr>";
        }
        ?>

    </table>

</body>

</html>