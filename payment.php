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