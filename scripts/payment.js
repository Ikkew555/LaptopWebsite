"use strict";
console.log("payment.js is running");

document.addEventListener("DOMContentLoaded", () => {
  const formData = JSON.parse(localStorage.getItem("formData"));
  console.log("lc_data", formData);

  const debug = false;

  const expiryInput = document.getElementById("card-expiry");
  const paymentForm = document.getElementById("payment-form");
  const cardNameInput = document.getElementById("card-name");
  const cardTypeSelect = document.getElementById("card-type");
  const cardNumberInput = document.getElementById("card-number");
  const cardCVVInput = document.getElementById("card-cvv");
  const errorMessages = document.getElementById("error-messages");

  if (formData) {
    // Populate hidden fields with formData values
    document.getElementById("fname").value = formData.fname || "";
    document.getElementById("lname").value = formData.lname || "";
    document.getElementById("email").value = formData.email || "";
    document.getElementById("street").value = formData.street || "";
    document.getElementById("suburb").value = formData.suburb || "";
    document.getElementById("state").value = formData.state || "";
    document.getElementById("postcode").value = formData.postcode || "";
    document.getElementById("phone").value = formData.phone || "";
    document.getElementById("contactMethod").value =
      formData.contactMethod || "";
    document.getElementById("product").value = formData.product || "";
    document.getElementById("quantity").value = formData.quantity || "";
    document.getElementById("features").value = formData.features || "";
    document.getElementById("comments").value = formData.comments || "";
    document.getElementById("totalPrice").value = formData.totalPrice || "";
    document.getElementById("price").value = formData.price || "";
  }

  expiryInput.addEventListener("input", formatExpiryDate);
  cardNumberInput.addEventListener("input", formatCardNumber);

  // Format card expiry date
  function formatExpiryDate(event) {
    let value = event.target.value.replace(/\D/g, "");
    if (value.length > 2) {
      value = value.slice(0, 2) + "/" + value.slice(2, 4);
    }
    event.target.value = value;
  }

  // Format card number
  function formatCardNumber(event) {
    let value = event.target.value.replace(/\s+/g, "");
    if (value.length > 16) {
      value = value.slice(0, 16); // Limit input to 16 digits
    }
    let formattedValue = value.replace(/(\d{4})(?=\d)/g, "$1 "); // Add space after every 4 digits
    event.target.value = formattedValue.trim(); // Trim any trailing spaces
  }

  // Validate expiry date
  function validateExpiryDate(expiry) {
    const [month, year] = expiry.split("/").map(Number);
    const currentYear = new Date().getFullYear() % 100;
    const currentMonth = new Date().getMonth() + 1;

    if (month < 1 || month > 12) return false;
    if (year < currentYear || (year === currentYear && month < currentMonth)) {
      return false;
    }
    return true;
  }

  // Validate card number based on card type and length
  function validateCardNumber(cardType, cardNumber) {
    cardNumber = cardNumber.replace(/\s+/g, ""); // remove spaces for validation
    if (cardType === "Visa") {
      return /^4\d{15}$/.test(cardNumber); // 16 digits, starts with 4
    } else if (cardType === "MasterCard") {
      return /^5[1-5]\d{14}$/.test(cardNumber); // 16 digits, starts with 51-55
    } else if (cardType === "AmEx") {
      return /^(34|37)\d{13}$/.test(cardNumber); // 15 digits, starts with 34 or 37
    }
    return false;
  }

  let timeLeft = 60; // 1 minutes

  // Update countdown every second
  let countdown = setInterval(function () {
    timeLeft--;
    document.getElementById(
      "timer"
    ).textContent = `Please process in ${timeLeft} seconds.`;

    if (timeLeft <= 0) {
      clearInterval(countdown);
      alert("Session is expried. Please make payment again");
      window.location.href = "enquire.php";
    }
  }, 1000);

  // Validate the payment form
  function validatePaymentForm() {
    let isValid = true;
    errorMessages.innerHTML = "";

    const alerts = {
      cardType: document.getElementById("cardTypeAlert"),
      cardNumber: document.getElementById("cardNumberAlert"),
      CVV: document.getElementById("cvvAlert"),
      nameOnCard: document.getElementById("nameOnCardAlert"),
      cardExpiry: document.getElementById("cardExpiryAlert"),
    };

    function setError(element, message) {
      element.textContent = message;
      element.style.color = "red";
    }

    Object.values(alerts).forEach((alert) => (alert.textContent = ""));

    if (debug) {
      const nameOnCard = cardNameInput.value.trim();
      if (!nameOnCard) {
        isValid = false;
        setError(alerts.nameOnCard, "Please enter the cardholder name.");
      }

      const cardType = cardTypeSelect.value;
      if (!cardType) {
        isValid = false;
        setError(alerts.cardType, "Please choose a card type.");
      }

      const cardNumber = cardNumberInput.value;
      if (!validateCardNumber(cardType, cardNumber)) {
        isValid = false;
        setError(alerts.cardNumber, "Please enter a valid card number.");
      }

      const cardExpiry = expiryInput.value;
      if (
        !/^\d{2}\/\d{2}$/.test(cardExpiry) ||
        !validateExpiryDate(cardExpiry)
      ) {
        isValid = false;
        setError(
          alerts.cardExpiry,
          "Please enter a valid card expiry date (MM/YY)."
        );
      }

      const cardCVV = cardCVVInput.value;
      if (!/^\d{3}$/.test(cardCVV)) {
        isValid = false;
        setError(alerts.CVV, "Please enter a valid card CVV (3 digits).");
      }
    }
    return isValid;
  }

  // Handle form submit with popup modal
  if (paymentForm) {
    paymentForm.addEventListener("submit", (event) => {
      if (!validatePaymentForm()) {
        event.preventDefault(); // Prevent submission if validation fails
      }
    });
  }

  // Cancel button
  const cancelButton = document.getElementById("cancel-button");
  if (cancelButton) {
    cancelButton.addEventListener("click", () => {
      localStorage.clear(); // Clear all stored data
      window.location.href = "index.php";
    });
  }

  // Display stored form data
  if (formData) {
    const displayElement = document.getElementById("display-info");

    if (displayElement) {
      displayElement.innerHTML = `
        <div id="payment-info">
          <div class="payment-text">
            <p class="topic">Name</p>
            <p>${formData.fname || "-"} ${formData.lname || "-"}</p>
          </div>
          <div class="payment-text">
            <p class="topic">Email</p>
            <p>${formData.email || "-"}</p>
          </div>
          <div class="payment-text">
            <p class="topic">Address</p>
            <p>${formData.street || "-"}</p>
          </div>
          <div class="payment-text">
            <p class="topic">Suburb</p>
            <p>${formData.suburb || "-"}</p>
          </div>
          <div class="payment-text">
            <p class="topic">State</p>
            <p>${formData.state || "-"}</p>
          </div>
          <div class="payment-text">
            <p class="topic">Postcode</p>
            <p>${formData.postcode || "-"}</p>
          </div>
          <div class="payment-text">
            <p class="topic">Phone Number</p>
            <p>${formData.phone || "-"}</p>
          </div>
          <div class="payment-text">
            <p class="topic">Price</p>
            <p>$${formData.price || "0"}</p>
          </div>
          <div class="payment-text">
            <p class="topic">Product</p>
            <p>${formData.product || "-"}</p>
          </div>
          <div class="payment-text">
            <p class="topic">Quantity</p>
            <p>${formData.quantity || "0"}</p>
          </div>
          <div class="payment-text">
            <p class="topic">Comment</p>
            <p>${formData.comments || "-"}</p>
          </div>
          <hr/>
          <div class="payment-text">
            <p class="topic">Total price</p>
            <p>$${formData.totalPrice || "0"}</p>
          </div>
          <hr/>
        </div>
      `;
    }
  }
});
