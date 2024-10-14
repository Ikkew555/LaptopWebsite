<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta name="author" content="Nathakorn Wimonwatwethi" />
    <meta name="keyword" content="HTML, CSS" />
    <meta name="description" content="Enhancements" />
    <title>s1xkyriceBoi Enhancements2</title>
    <script defer src="scripts/part2.js" type="text/javascript"></script>
    <script defer src="scripts/enhancements.js" type="text/javascript"></script>
    <link rel="stylesheet" type="text/css" href="styles/enhancement2.css" />
    <link rel="stylesheet" type="text/css" href="styles/global.css" />
  </head>
  <body>
    <?php include 'includes/header.inc'; ?>
    <div id="nav">
      <a href="#section1">Enhancement 1</a>
      <a href="#section2">Enhancement 2</a>
      <a href="#section3">Enhancement 3</a>
      <a href="#section4">Enhancement 4</a>
    </div>

    <!-- Section 1 -->
    <section id="section1">
      <h1>Enhancement 1: Scroll Smoothly Between Sections</h1>
      <p>
        When you click on nav links (Enhancement 1, 2, or 3) on top section of
        srceen, it will smoothly scroll the user to that section.
      </p>

      <h2>Code for Scroll Smoothly Between Sections:</h2>
      <pre>
          <code>document.querySelectorAll('a[href^="#"]').forEach(anchor => {
  anchor.addEventListener('click', function(e) {
    e.preventDefault();
    document.querySelector(this.getAttribute('href')).scrollIntoView({
      behavior: 'smooth'
    });
  });
});
          </code>
      </pre>
      <a
        class="source"
        href="https://css-tricks.com/snippets/jquery/smooth-scrolling/"
        >Linked</a
      >
    </section>
    <section id="section2">
      <h1>Enhancement 2: Button Click Event Effect</h1>
      <p>
        When you click on Button will show the effect like Bouncing or Slide-off
        as the example.
      </p>

      <h2>Code for Button Click Event Effect:</h2>
      <pre>
          <code>document.querySelector(".bounce-btn").addEventListener("click", function (e) {
  const button = e.currentTarget;
  button.classList.add("bounce");
  setTimeout(() => button.classList.remove("bounce"), 300);
});
          
document.querySelector('.slide-off-btn').addEventListener('click', function() {
  this.classList.add('slide-off');
  setTimeout(() => {
    this.style.display = 'none';
  }, 500);
});
          </code>
      </pre>
      <button class="bounce-btn">Bounce Me</button>
      <button class="slide-off-btn">Slide Off</button>
      <div class="linked">
        <a
          class="source"
          href="https://developer.mozilla.org/en-US/docs/Web/CSS/CSS_animations/Using_CSS_animations"
          >Linked</a
        >
        <p>#Using animation events section</p>
      </div>
    </section>

    <section id="section3">
      <h1>Enhancement 3: Auto Scroll back to Top</h1>
      <p>
        Navigate back to top of srceen with click the green ↑ Top button that
        floating at bottom-right of th srceen
      </p>
      <h2>Code for Auto Scroll back to Top:</h2>
      <pre>
          <code>const backToTopBtn = document.getElementById('backToTopBtn');
window.onscroll = function() {
  if (document.body.scrollTop > 100 || document.documentElement.scrollTop > 100) {
    backToTopBtn.classList.add('show');
    backToTopBtn.classList.remove('hide');
    } else {
    backToTopBtn.classList.add('hide');
    setTimeout(() => {
      backToTopBtn.classList.remove('show');
    }, 300); // Matches the transition duration
  }
};
            
backToTopBtn.addEventListener('click', function() {
  window.scrollTo({
    top: 0,
    behavior: 'smooth'
  });
});
          </code>
      </pre>
      <a
        class="source"
        href="https://www.w3schools.com/howto/howto_js_scroll_to_top.asp"
        >Linked</a
      >
      <button id="backToTopBtn" class="back-to-top-btn">↑ Top</button>
    </section>
    <section id="section4">
      <h1>Enhancement 4: Timeout</h1>
      <p>
        This feature is enhanced with a JavaScript timeout function, which
        delays certain actions for a specified amount of time. In this case, it
        ensures the button remains visible after a brief delay when the user
        scrolls down the page.
      </p>

      <h2>Code for Time out:</h2>
      <pre>
          <code>let timeLeft = 60; // 1 minutes

let countdown = setInterval(function() {
  timeLeft--;
  document.getElementById('timer').textContent = `Redirecting in ${timeLeft} seconds...`;
  if (timeLeft <= 0) {
    clearInterval(countdown);
    window.location.href = 'payment.html';
  }
}, 1000); // Run every 1 second   
          </code>
      </pre>
      <p id="timer">Redirecting in 60 seconds...</p>
      <a
        class="source"
        href="https://www.w3schools.com/jsref/met_win_settimeout.asp"
        >Linked</a
      >
    </section>

    <?php include 'includes/footer_full.inc'; ?>
  </body>
</html>
