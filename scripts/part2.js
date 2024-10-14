"use strict";
console.log("part2.js is running");
const debug = false;

function validateStateAndPostcode() {
  const state = document.getElementById("state").value;
  const postcode = document.getElementById("postcode").value.trim();
  const firstDigit = postcode.charAt(0);
  const statePostcodeMessage = document.getElementById("statePostcodeMessage");
  let isValid = false;

  if (debug) {
    if (state && !postcode) {
      //if state is selected but not input the postcode yet
      statePostcodeMessage.textContent = "Please enter the postcode.";
      statePostcodeMessage.style.color = "#7c7c7c";
      return false;
    }

    switch (state) {
      case "VIC":
        isValid = firstDigit === "3" || firstDigit === "8";
        break;
      case "NSW":
        isValid = firstDigit === "1" || firstDigit === "2";
        break;
      case "QLD":
        isValid = firstDigit === "4" || firstDigit === "9";
        break;
      case "NT":
        isValid = firstDigit === "0";
        break;
      case "WA":
        isValid = firstDigit === "6";
        break;
      case "SA":
        isValid = firstDigit === "5";
        break;
      case "TAS":
        isValid = firstDigit === "7";
        break;
      case "ACT":
        isValid = firstDigit === "0";
        break;
      default:
        isValid = false;
    }

    if (postcode) {
      if (isValid) {
        statePostcodeMessage.textContent = "The state and postcode match."; //display  match postcode and state
        statePostcodeMessage.style.color = "green";
      } else {
        statePostcodeMessage.textContent =
          "The state does not match the postcode."; //display not match postcode and state
        statePostcodeMessage.style.color = "red";
      }
    } else {
      statePostcodeMessage.textContent = ""; // Clear message if no postcode is entered
    }
  }

  return isValid;
}

function displaySelectedProduct() {
  const selectElement = document.getElementById("product");
  const selectedOption = selectElement.options[selectElement.selectedIndex];
  const displayElement = document.getElementById("price");

  if (selectedOption.value) {
    displayElement.textContent = `$${selectedOption.value}`;
  } else {
    displayElement.textContent = "Please select a product to view the price.";
  }
}

function scrollBackTop() {
  const backToTopBtn = document.getElementById("backToTopBtn");

  // Show button when scrolling down
  window.onscroll = function () {
    if (
      document.body.scrollTop > 100 ||
      document.documentElement.scrollTop > 100
    ) {
      backToTopBtn.classList.add("show");
      backToTopBtn.classList.remove("hide");
    } else {
      backToTopBtn.classList.add("hide");
      setTimeout(() => {
        backToTopBtn.classList.remove("show");
      }, 300);
    }

    backToTopBtn.addEventListener("click", function () {
      window.scrollTo({
        top: 0,
        behavior: "smooth",
      });
    });
  };
}

function validatePostCodeMatchState() {
  const postcodeInput = document.getElementById("postcode");
  const stateSelect = document.getElementById("state");

  postcodeInput.addEventListener("input", validateStateAndPostcode);
  stateSelect.addEventListener("change", validateStateAndPostcode);

  const productSelect = document.getElementById("product");
  if (productSelect) {
    productSelect.addEventListener("change", displaySelectedProduct);
  }
}

function onSubmitForm() {
  const form = document.getElementById("enquiry-form");
  if (form) {
    form.addEventListener("submit", function (event) {
      // Prevent the default form submission
      event.preventDefault();

      if (debug) {
        // Validate state and postcode match
        if (!validateStateAndPostcode()) {
          alert("The state and postcode do not match. Please correct them.");
          return;
        }

        // Validate at least one feature checkbox is selected
        const featureCheckboxes = document.querySelectorAll(
          'input[name="features[]"]'
        );
        const isFeatureSelected = Array.from(featureCheckboxes).some(
          (checkbox) => checkbox.checked
        );

        if (!isFeatureSelected) {
          alert("Please select at least one product feature.");
          return;
        }
      }

      // Collect form data into an object
      const formData = {
        fname: document.getElementById("fname").value.trim(),
        lname: document.getElementById("lname").value.trim(),
        email: document.getElementById("email").value.trim(),
        street: document.getElementById("street").value.trim(),
        suburb: document.getElementById("suburb").value.trim(),
        state: document.getElementById("state").value.trim(),
        postcode: document.getElementById("postcode").value.trim(),
        phone: document.getElementById("phone").value.trim(),
        contactMethod:
          document.querySelector('input[name="contact"]:checked')?.value ||
          "No contact method selected",
        product:
          document.getElementById("product").options[
            document.getElementById("product").selectedIndex
          ]?.text || "",
        quantity: document.getElementById("quantity").value.trim(),
        features: Array.from(
          document.querySelectorAll('input[name="features[]"]:checked')
        )
          .map((feature) => feature.value)
          .join(", "),
        comments: document.getElementById("comments").value.trim(),
        totalPrice:
          (document.getElementById("product").options[
            document.getElementById("product").selectedIndex
          ]?.value || 0) *
          (document.getElementById("quantity").value.trim() || 0),
        price:
          document.getElementById("product").options[
            document.getElementById("product").selectedIndex
          ]?.value || 0,
      };

      // Store data in localStorage
      localStorage.setItem("formData", JSON.stringify(formData));

      // Log the saved data for debugging
      console.log("Saved data:", JSON.parse(localStorage.getItem("formData")));

      // Redirect to the payment page
      window.location.href = "payment.php";
    });
  } else {
    console.error("Form element not found!");
  }
}

document.addEventListener("DOMContentLoaded", () => {
  // loadNav(); //navbar
  // loadFooter(); //footer
  scrollBackTop(); //scrollTop
  validatePostCodeMatchState(); //matchingPostcode
  onSubmitForm();
});
