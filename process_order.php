<?php
include 'settings.php';

// Custom function to sanitize input
function sanitiseInput($data)
{
    // Trim leading and trailing spaces
    $data = trim($data);
    // Remove backslashes
    $data = stripslashes($data);
    // Convert special HTML characters to HTML entities
    $data = htmlspecialchars($data);
    return $data;
}

// Check if form is submitted via POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    // Sanitise and validate inputs
    $fname = sanitiseInput($_POST['fname']); // First name
    $lname = sanitiseInput($_POST['lname']); // Last name
    $email = sanitiseInput($_POST['email']); // Email
    $street = sanitiseInput($_POST['street']); // Street address
    $suburb = sanitiseInput($_POST['suburb']); // Suburb
    $state = sanitiseInput($_POST['state']); // State
    $postcode = sanitiseInput($_POST['postcode']); // Postcode
    $phone = sanitiseInput($_POST['phone']); // Phone number
    $contactMethod = sanitiseInput($_POST['contactMethod']); // Preferred contact method
    $product = sanitiseInput($_POST['product']); // Product
    $quantity = filter_var(sanitiseInput($_POST['quantity']), FILTER_VALIDATE_INT); // Quantity
    $features = sanitiseInput($_POST['features']); // Features
    $comments = sanitiseInput($_POST['comments']); // Comments
    $card_type = sanitiseInput($_POST['card-type']); // Credit card type
    $card_name = sanitiseInput($_POST['card-name']); // Name on card
    $card_number = sanitiseInput($_POST['card-number']); // Card number
    $card_expiry = sanitiseInput($_POST['card-expiry']); // Card expiry
    $card_cvv = sanitiseInput($_POST['card-cvv']); // CVV
    $price = filter_var(sanitiseInput($_POST['price']), FILTER_VALIDATE_FLOAT); // Price

    // Sanitize totalPrice and cast to float
    $totalPrice = sanitiseInput($_POST['totalPrice']);
    $totalPrice = (float)filter_var($totalPrice, FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION); // Explicitly cast to float

    // Validate required fields
    $errors = [];

    // First name validation
    if (strlen($fname) > 25 || empty($fname) || !preg_match("/^[a-zA-Z]*$/", $fname)) {
        $errors[] = "First name must be a maximum of 25 characters and contain only alphabetical characters.";
    }

    // Last name validation
    if (strlen($lname) > 25 || empty($lname) || !preg_match("/^[a-zA-Z]*$/", $lname)) {
        $errors[] = "Last name must be a maximum of 25 characters and contain only alphabetical characters.";
    }

    // Email validation
    if (!$email) {
        $errors[] = "Invalid email address.";
    }

    // Street address validation
    if (strlen($street) > 40) {
        $errors[] = "Street address must be a maximum of 40 characters.";
    }

    // Suburb validation
    if (strlen($suburb) > 20 || !preg_match("/^[a-zA-Z0-9 ]*$/", $suburb)) {
        $errors[] = "Suburb must be a maximum of 20 characters and can include letters, numbers, and spaces.";
    }

    // State validation
    $validStates = ['VIC', 'NSW', 'QLD', 'NT', 'WA', 'SA', 'TAS', 'ACT'];
    if (!in_array($state, $validStates)) {
        $errors[] = "Please select a valid state.";
    }

    // Postcode validation
    if (strlen($postcode) !== 4 || !ctype_digit($postcode)) {
        $errors[] = "Postcode must be exactly 4 digits.";
    }

    // Phone number validation
    if (!is_numeric($phone) || strlen($phone) != 10) {
        $errors[] = "Phone number must be exactly 10 digits.";
    }

    // Preferred contact method validation
    if (!in_array($contactMethod, ['email', 'post', 'phone'])) {
        $errors[] = "Please select a valid preferred contact method.";
    }

    // Product quantity validation
    if (empty($quantity) || $quantity <= 0) {
        $errors[] = "Quantity must be a positive integer.";
    }

    // Credit card type validation
    if (!in_array($card_type, ['Visa', 'MasterCard', 'AmEx'])) {
        $errors[] = "Credit card type must be Visa, MasterCard, or American Express.";
    }

    // Cardholder name validation
    if (strlen($card_name) > 40 || !preg_match("/^[a-zA-Z ]*$/", $card_name)) {
        $errors[] = "Name on the credit card must be a maximum of 40 characters and contain only alphabetical characters and spaces.";
    }

    // Credit card expiry validation
    if (!preg_match("/^\d{2}-\d{2}$/", $card_expiry) || !validateExpiry($card_expiry)) {
        $errors[] = "VCC must be in the format of MM-YY and valid.";
    }

    // CVV validation
    if (!preg_match("/^\d{3}$/", $card_cvv)) {
        $errors[] = "CVV must be exactly 3 digits.";
    }

    // Card number validation
    if (!preg_match("/^\d{15,16}$/", str_replace(' ', '', $card_number)) || !validateCardNumber($card_type, $card_number)) {
        $errors[] = "Card number must be exactly 15 or 16 digits and valid according to the card type.";
    }

    // If there are validation errors, display them
    if (!empty($errors)) {
        foreach ($errors as $error) {
            echo "<p style='color: red;'>$error</p>";
        }
        echo "<p><a href='javascript:history.back()'>Go Back and Correct the Form</a></p>";
        exit;
    }

    // Calculate order_cost 
    $order_cost = $quantity * $price;

    // Insert data into the orders table
    $stmt = $conn->prepare("INSERT INTO orders (first_name, last_name, email, street_address, suburb, state, postcode, phone, contact_method, product, price_ea, quantity, features, comments, order_cost, order_status) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, 'PENDING')");

    // Bind parameters
    $stmt->bind_param("ssssssssssiissd", $fname, $lname, $email, $street, $suburb, $state, $postcode, $phone, $contactMethod, $product, $price, $quantity, $features, $comments, $order_cost);

    if ($stmt->execute()) {
        // Get the last inserted order ID
        $order_id = $stmt->insert_id;

        // Redirect to the receipt page with the order_id
        header("Location: receipt.php?order_id=$order_id");
        exit;
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
    $conn->close();
} else {
    echo "Invalid request.";
}

// Function to validate the expiry date
function validateExpiry($expiry)
{
    $parts = explode('-', $expiry);
    $month = (int)$parts[0];
    $year = (int)$parts[1];

    $currentYear = (int)date('y'); // Get last two digits of current year
    $currentMonth = (int)date('n'); // Get current month

    if ($year < $currentYear || ($year == $currentYear && $month < $currentMonth)) {
        return false; // Expired
    }
    return true; // Valid expiry date
}

// Function to validate card number based on type
function validateCardNumber($cardType, $cardNumber)
{
    $cardNumber = preg_replace('/\s+/', '', $cardNumber); // Remove spaces for validation
    if ($cardType === 'Visa') {
        return preg_match('/^4[0-9]{15}$/', $cardNumber); // 16 digits, starts with 4
    } elseif ($cardType === 'MasterCard') {
        return preg_match('/^5[1-5][0-9]{14}$/', $cardNumber); // 16 digits, starts with 51-55
    } elseif ($cardType === 'AmEx') {
        return preg_match('/^3[47][0-9]{13}$/', $cardNumber); // 15 digits, starts with 34 or 37
    }
    return false; // Invalid card type
}
