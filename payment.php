<?php
function sanitiseInput($data)
{
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

  // Sanitise and validate inputs
  $fname = isset($_POST['fname']) ? sanitiseInput($_POST['fname']) : "";
  $lname = isset($_POST['lname']) ? sanitiseInput($_POST['lname']) : "";
  $email = isset($_POST['email']) ? filter_var(sanitiseInput($_POST['email']), FILTER_VALIDATE_EMAIL) : "";
  $street = isset($_POST['street']) ? sanitiseInput($_POST['street']) : "";
  $suburb = isset($_POST['suburb']) ? sanitiseInput($_POST['suburb']) : "";
  $state = isset($_POST['state']) ? sanitiseInput($_POST['state']) : "";
  $postcode = isset($_POST['postcode']) ? sanitiseInput($_POST['postcode']) : "";
  $phone = isset($_POST['phone']) ? sanitiseInput($_POST['phone']) : "";
  $contactMethod = isset($_POST['contact']) ? sanitiseInput($_POST['contact']) : "";
  $product = isset($_POST['product']) ? sanitiseInput($_POST['product']) : "";
  $quantity = isset($_POST['quantity']) ? filter_var(sanitiseInput($_POST['quantity']), FILTER_VALIDATE_INT) : 0;
  $features = isset($_POST['features']) ? implode(", ", $_POST['features']) : "";
  $comments = isset($_POST['comments']) ? sanitiseInput($_POST['comments']) : "";

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

  if (empty($features)) {
    $errors[] = "Please select at least one feature.";
  }

  // Validate state and postcode match
  if ($state && $postcode) {
    $firstDigit = $postcode[0]; // Get the first digit of the postcode
    switch ($state) {
      case "VIC":
        if ($firstDigit !== "3" && $firstDigit !== "8") {
          $errors[] = "Postcode does not match the selected state (VIC).";
        }
        break;
      case "NSW":
        if ($firstDigit !== "1" && $firstDigit !== "2") {
          $errors[] = "Postcode does not match the selected state (NSW).";
        }
        break;
      case "QLD":
        if ($firstDigit !== "4" && $firstDigit !== "9") {
          $errors[] = "Postcode does not match the selected state (QLD).";
        }
        break;
      case "NT":
        if ($firstDigit !== "0") {
          $errors[] = "Postcode does not match the selected state (NT).";
        }
        break;
      case "WA":
        if ($firstDigit !== "6") {
          $errors[] = "Postcode does not match the selected state (WA).";
        }
        break;
      case "SA":
        if ($firstDigit !== "5") {
          $errors[] = "Postcode does not match the selected state (SA).";
        }
        break;
      case "TAS":
        if ($firstDigit !== "7") {
          $errors[] = "Postcode does not match the selected state (TAS).";
        }
        break;
      case "ACT":
        if ($firstDigit !== "0") {
          $errors[] = "Postcode does not match the selected state (ACT).";
        }
        break;
      default:
        $errors[] = "Invalid state provided.";
    }
  }

  // Display errors if any
  if (!empty($errors)) {
    foreach ($errors as $error) {
      echo "<p style='color: red;'>$error</p>";
    }
    echo "<p><a href='javascript:history.back()'>Go Back and Correct the Form</a></p>";
    exit;
  }
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>s1xkyriceBoi Payment detail</title>
  <script defer src="scripts/payment.js"></script>
  <script defer src="scripts/part2.js" type="text/javascript"></script>
  <link rel="stylesheet" type="text/css" href="./styles/payment.css" />
  <link rel="stylesheet" type="text/css" href="./styles/global.css" />
</head>

<body>
  <?php include 'includes/header.inc'; ?>
  <h2 id="payment-title">Payment Detail</h2>
  <div id="display-container">
    <div id="combined-container">
      <div id="display-info">
        <!-- Display Info content goes here -->
      </div>
      <div class="display-payment">
        <form
          id="payment-form"
          action="process_order.php"
          method="post"
          novalidate="novalidate">
          <fieldset>
            <h2 id="form-title">Credit Card Details</h2>
            <div class="card-type">
              <label for="card-type">Card Type</label>
              <select id="card-type" name="card-type">
                <option value="">Select Card Type</option>
                <option value="Visa">Visa</option>
                <option value="MasterCard">MasterCard</option>
                <option value="AmEx">American Express</option>
              </select>
            </div>
            <p id="cardTypeAlert"></p>
            <div class="card-name">
              <label for="card-name">Cardholder name</label>
              <input
                type="text"
                id="card-name"
                name="card-name"
                maxlength="40"
                placeholder="Enter your name" />
            </div>
            <p id="nameOnCardAlert"></p>
            <div class="card-number">
              <label for="card-number">Card Number</label>
              <input
                type="text"
                id="card-number"
                name="card-number"
                maxlength="20"
                placeholder="Card number" />
            </div>
            <p id="cardNumberAlert"></p>
            <div class="card-expiry">
              <label for="card-expiry">Expiry Date (MM/YY)</label>
              <input
                type="text"
                id="card-expiry"
                name="card-expiry"
                placeholder="00/00" />
            </div>
            <p id="cardExpiryAlert"></p>
            <div class="card-cvv">
              <label for="card-cvv">CVV</label>
              <input
                type="text"
                id="card-cvv"
                name="card-cvv"
                maxlength="3"
                placeholder="CVV" />
            </div>
            <p id="cvvAlert"></p>
            <p id="timer">Please process in 60 seconds.</p>
          </fieldset>

          <input type="hidden" name="fname" id="fname" />
          <input type="hidden" name="lname" id="lname" />
          <input type="hidden" name="email" id="email" />
          <input type="hidden" name="street" id="street" />
          <input type="hidden" name="suburb" id="suburb" />
          <input type="hidden" name="state" id="state" />
          <input type="hidden" name="postcode" id="postcode" />
          <input type="hidden" name="phone" id="phone" />
          <input type="hidden" name="contactMethod" id="contactMethod" />
          <input type="hidden" name="product" id="product" />
          <input type="hidden" name="quantity" id="quantity" />
          <input type="hidden" name="features" id="features" />
          <input type="hidden" name="comments" id="comments" />
          <input type="hidden" name="totalPrice" id="totalPrice" />
          <input type="hidden" name="price" id="price" />

          <div id="error-messages" style="color: red"></div>
          <button type="submit" class="btn-submit">Check Out</button>
          <button type="button" id="cancel-button" class="btn-cancel">
            Cancel Order
          </button>
        </form>
      </div>
    </div>
  </div>
  <?php include 'includes/footer_full.inc'; ?>
</body>

</html>