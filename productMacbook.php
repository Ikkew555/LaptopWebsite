<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta name="author" content="Nathakorn Wimonwatwethi" />
    <meta name="keyword" content="HTML, CSS" />
    <meta name="description" content="ProductDetailPage" />
    <link rel="stylesheet" type="text/css" href="./styles/productDetail.css" />
    <link rel="stylesheet" type="text/css" href="./styles/global.css" />
    <script defer src="scripts/part2.js" type="text/javascript"></script>
    <title>s1xkyriceBoi Store Online</title>
  </head>

  <body>
  <?php include 'includes/header.inc'; ?>

    <div class="product-display">
      <div class="product-image-display">
        <a
          href="https://www.costco.com.au/Computers/Laptops/Apple-MacBooks/MacBook-Air-15-Inch-With-M2-Chip-256GB/p/168722"
          alt=""
        >
          <img src="./images/product/MacBookAir15inch.png" alt="" />
        </a>
      </div>
      <aside class="product-detail">
        <div class="product-desc">
          <ul>
            <li id="name">
              <h1>
                Apple MacBook Air 15-inch with M3 chip, 10-core GPU 256GB/8GB
                (Midnight) [2024]
              </h1>
            </li>
            <li id="rating">&starf;&starf;&starf;&starf;&star;</li>
            <li id="prices">$2199</li>
          </ul>
          <hr />
          <p id="desc">
            Lorem ipsum, dolor sit amet consectetur adipisicing elit.
            Perspiciatis mollitia eos, repellat tempore autem facilis ratione
            fugit, debitis ab accusamus sapiente alias cum temporibus saepe
            earum nulla quo deserunt ipsam! Lorem ipsum, dolor sit amet
            consectetur adipisicing elit. Perspiciatis mollitia eos, repellat
            tempore autem facilis ratione fugit, debitis ab accusamus sapiente
            alias cum temporibus saepe earum nulla quo deserunt ipsam!
          </p>
          <hr />
          <h1 id="key-features">Key Features</h1>
          <ol>
            <li>Display: 15.3-inch Liquid Retina display with True Tone²</li>
            <li>Apple M3 Chip 16-core Neural Engine</li>
            <li>18 hours battery life</li>
            <li>4 ports 2x Thunderbolt/USB 4, headphone jack, MagSafe</li>
            <li>1.51 kg Weight</li>
          </ol>
          <hr />
          <ul id="brand-detail">
            <li>Categories: Laptop</li>
            <li>Brand: Apple</li>
          </ul>
          <button id="buy" type="submit">Buy</button>
        </div>
      </aside>
    </div>
    <?php include 'includes/footer_full.inc'; ?>
  </body>
</html>
