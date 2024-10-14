<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <meta name="author" content="Nathakorn Wimonwatwethi" />
  <meta name="keyword" content="HTML, CSS" />
  <meta name="description" content="Enchancements" />
  <title>s1xkyriceBoi</title>
  <link rel="stylesheet" type="text/css" href="./styles/enhancements.css" />
  <link rel="stylesheet" type="text/css" href="./styles/global.css" />
  <script defer src="scripts/part2.js" type="text/javascript"></script>
</head>

<body>
  <?php include 'includes/header.inc'; ?>
  <div class="enhancement">
    <h1 id="title">Enhancements</h1>
    <p id="desc">
      1. I applied a CSS transition (scale() method)to the product box so that
      it increases in size and can change the color when the cursor hovers
      over it.
    </p>
    <a href="https://www.w3schools.com/css/css3_2dtransforms.asp" alt="">Click for visit website</a>
    <h4>example:</h4>
    <div class="box"></div>

    <p id="desc">
      2. I combined CSS transitions with pseudo-elements (::after) and the
      state on the navbar links to create an underline animation that appears
      beneath the text when users hover over the links.
    </p>
    <a href="https://www.w3schools.com/cssref/sel_after.php" alt="">Click for visit website</a>

    <h4>example:</h4>
    <div class="links">
      <a>hover me</a>
    </div>
  </div>
  <?php include 'includes/footer_full.inc'; ?>
  </body>

</html>