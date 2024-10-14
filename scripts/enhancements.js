// Smooth Scrolling for Navigation
document.querySelectorAll('a[href^="#"]').forEach((anchor) => {
  anchor.addEventListener("click", function (e) {
    e.preventDefault();
    document.querySelector(this.getAttribute("href")).scrollIntoView({
      behavior: "smooth",
    });
  });
});

// Button-Effect functions
document.querySelector(".bounce-btn").addEventListener("click", function (e) {
  const button = e.currentTarget;
  button.classList.add("bounce");
  setTimeout(() => button.classList.remove("bounce"), 300);
});

document.querySelector(".slide-off-btn").addEventListener("click", function () {
  this.classList.add("slide-off");
  setTimeout(() => {
    this.style.display = "none";
  }, 500);
});

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
    }, 300); // Matches the transition duration
  }
};

// Scroll to top when button is clicked
backToTopBtn.addEventListener("click", function () {
  window.scrollTo({
    top: 0,
    behavior: "smooth",
  });
});

let timeLeft = 60; // 1 minutes

// Update countdown every second
let countdown = setInterval(function () {
  timeLeft--;
  document.getElementById(
    "timer"
  ).textContent = `Redirecting in ${timeLeft} seconds...`;

  if (timeLeft <= 0) {
    clearInterval(countdown);
  }
}, 1000);
