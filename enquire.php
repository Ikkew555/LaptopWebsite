<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <meta name="author" content="Nathakorn Wimonwatwethi" />
  <meta name="keyword" content="HTML, CSS" />
  <meta name="description" content="Enquire" />
  <title>s1xkyriceBoi Contact us</title>
  <link rel="stylesheet" type="text/css" href="styles/enquire.css" />
  <link rel="stylesheet" type="text/css" href="styles/global.css" />
  <script defer src="scripts/part2.js" type="text/javascript"></script>
</head>

<body>
  <?php include 'includes/header.inc'; ?>
  <form id="enquiry-form" method="POST" action="payment.php" novalidate="novalidate">
    <section>
      <h1 class="title-text">Personal information</h1>
      <div class="half-half-form">
        <div class="input-text">
          <label for="fname">First name</label>
          <input
            type="text"
            id="fname"
            name="fname"
            maxlength="25"
            pattern="[a-zA-Z\s]+"
            required />
        </div>
        <div class="input-text">
          <label for="lname">Last name</label>
          <input
            type="text"
            id="lname"
            name="lname"
            maxlength="25"
            pattern="[a-zA-Z\s]+"
            required />
        </div>
      </div>
      <div class="input-text">
        <label for="email">Email address</label>
        <input
          type="email"
          id="email"
          name="email"
          placeholder="example@gmail.com"
          pattern="[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.(com|net|org)$"
          required />
      </div>
    </section>
    <section>
      <h1 class="title-text">Address</h1>
      <div class="input-text">
        <label for="street">Street address</label>
        <input
          type="text"
          id="street"
          name="street"
          maxlength="40"
          pattern="[a-zA-Z0-9\s]+"
          required />
      </div>
      <div class="input-text">
        <label for="suburb">Suburb/town</label>
        <input
          type="text"
          id="suburb"
          name="suburb"
          maxlength="20"
          pattern="[a-zA-Z0-9\s]+" />
      </div>
      <div class="half-half-form">
        <div class="input-select">
          <label for="state">State</label>
          <select id="state" name="state" required>
            <option value="">Select your state</option>
            <option value="VIC">VIC</option>
            <option value="NSW">NSW</option>
            <option value="QLD">QLD</option>
            <option value="NT">NT</option>
            <option value="WA">WA</option>
            <option value="SA">SA</option>
            <option value="TAS">TAS</option>
            <option value="ACT">ACT</option>
          </select>
        </div>
        <div class="input-text">
          <label for="postcode">Postcode</label>
          <input
            type="text"
            id="postcode"
            name="postcode"
            maxlength="4"
            pattern="\d{4}"
            title="Please enter a valid 4-digit postcode"
            required />
        </div>
      </div>
      <p id="statePostcodeMessage"></p>
      <div class="input-text">
        <label for="phone">Phone number</label>
        <input
          type="text"
          id="phone"
          name="phone"
          maxlength="10"
          pattern="\d{10}"
          placeholder="Enter your 10-digit phone number"
          required />
      </div>
    </section>
    <section>
      <h1 class="title-text">Preferred contact</h1>
      <label for="contact-email">
        <input
          type="radio"
          id="contact-email"
          name="contact"
          value="email"
          required />
        Email
      </label>
      <label for="contact-post">
        <input
          type="radio"
          id="contact-post"
          name="contact"
          value="post"
          required />
        Post
      </label>
      <label for="contact-phone">
        <input
          type="radio"
          id="contact-phone"
          name="contact"
          value="phone"
          required />
        Phone
      </label>
      <div class="input-select">
        <h1 class="title-text">Product you want to enquire about</h1>
        <label for="product" style="margin: 0px"></label>
        <select id="product" name="product" required>
          <option value="">Select a product</option>
          <option value="2199">
            Apple MacBook Air 15-inch with M3 chip, 10-core GPU 256GB/8GB
            (Midnight) [2024]
          </option>
          <option value="1999">
            HP Victus 15.6-inch Full HD 144Hz Gaming Laptop (13th Gen Intel
            i7)[GeForce RTX 4060]
          </option>
          <option value="3299">
            MSI Raider GE68HX 16-inch QHD+ 240Hz Gaming Laptop (13th Gen Intel
            i7)[GeForce RTX 4070]
          </option>
          <option value="1899">
            Microsoft Surface Pro (11th Edition) Copilot+ PC 13-inch Snapdragon X
            Plus/16GB/256GB
          </option>
        </select>
      </div>
      <div class="displayPrice">
        <h1 class="title-text">Price</h1>
        <div id="price">Please select a product to view the price.</div>
      </div>
      <h1 class="title-text">Quantity</h1>
      <input type="number" id="quantity" name="quantity" min="0" required />
      <div class="input-checkbox">
        <h1 class="title-text">Product Features</h1>
        <label for="feature-performance">
          <input
            type="checkbox"
            id="feature-performance"
            name="features[]"
            value="High Performance" />
          High Performance
        </label>
        <label for="feature-storage">
          <input
            type="checkbox"
            id="feature-storage"
            name="features[]"
            value="Large Storage" />
          Large Storage
        </label>
        <label for="feature-portability">
          <input
            type="checkbox"
            id="feature-portability"
            name="features[]"
            value="Portability" />
          Portability
        </label>
        <label for="feature-gaming">
          <input
            type="checkbox"
            id="feature-gaming"
            name="features[]"
            value="Gaming" />
          Gaming
        </label>
      </div>
      <div class="input-comment">
        <h1 class="title-text">Comments</h1>
        <label for="comments" style="margin: 0px"></label>
        <textarea
          id="comments"
          name="comments"
          placeholder="Specify any particular aspect you are interested in"
          rows="4"></textarea>
      </div>
    </section>
    <div class="button">
      <button id="submit-button" type="submit">Pay Now</button>
    </div>
  </form>
  <button id="backToTopBtn" class="back-to-top-btn">↑ Top</button>

  <?php include 'includes/footer_full.inc'; ?>
</body>

</html>