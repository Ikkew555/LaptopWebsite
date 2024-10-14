<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta name="author" content="Nathakorn Wimonwatwethi" />
    <meta name="keyword" content="HTML, CSS" />
    <meta name="description" content="Product" />
    <title>s1xkyriceBoi Store Online</title>
    <script defer src="scripts/part2.js"></script>
    <link rel="stylesheet" type="text/css" href="styles/product.css" />
    <link rel="stylesheet" type="text/css" href="styles/global.css" />
  </head>
  <body>
    <?php include 'includes/header.inc'; ?>
    <section>
      <div class="categories">
        <div class="categories-title">
          <h1>Products</h1>
          <h3 style="color: #acacac; font-weight: normal">
            Find the Perfect Device You’ve Been Searching For.
          </h3>
        </div>
        <div class="display-product-categories">
          <a href="productMacbook.php">
            <div class="product-categories-box">
              <img
                src="./images/product/MacBookAir15inch.png"
                alt="MacBookAir"
              />
              <div class="product-categories-content">
                <!-- <div class="product-categories-text">Laptop</div> -->
                <div class="product-categories-title">
                  <p>
                    Apple MacBook Air 15-inch with M3 chip, 10-core GPU
                    256GB/8GB (Midnight) [2024]
                  </p>
                </div>
              </div>
              <div class="product-footer">
                <p>$2199.00</p>
                <!-- <button type="button">View</button> -->
              </div>
            </div>
          </a>
          <a href="productHP.php">
            <div class="product-categories-box">
              <img src="./images/product/HPVictus.png" alt="HPVictus" />
              <div class="product-categories-content">
                <!-- <div class="product-categories-text">Laptop</div> -->
                <div class="product-categories-title">
                  <p>
                    HP Victus 15.6" Full HD 144Hz Gaming Laptop (13th Gen Intel
                    i7)[GeForce RTX 4060]
                  </p>
                </div>
              </div>
              <div class="product-footer">
                <div class="product-price">$1999.00</div>
                <!-- <button type="button">View</button> -->
              </div>
            </div>
          </a>
          <a href="productMSI.php">
            <div class="product-categories-box">
              <img src="./images/product/MSIRaider.png" alt="MSIRaider" />
              <div class="product-categories-content">
                <!-- <div class="product-categories-text">Laptop</div> -->
                <div class="product-categories-title">
                  <p>
                    MSI Raider GE68HX 16" QHD+ 240Hz Gaming Laptop (13th Gen
                    Intel i7)[GeForce RTX 4070]
                  </p>
                </div>
              </div>
              <div class="product-footer">
                <div class="product-price">$3299.00</div>
                <!-- <button type="button">View</button> -->
              </div>
            </div>
          </a>
          <a href="productSurfacePro.php">
            <div class="product-categories-box">
              <img
                src="./images/product/MicrosoftSurfacePro.png"
                alt="CustomBuildGamingPc"
              />
              <div class="product-categories-content">
                <!-- <div class="product-categories-text">2-in-1 devices</div> -->
                <div class="product-categories-title">
                  <p>
                    Microsoft Surface Pro (11th Edition) Copilot+ PC 13"
                    Snapdragon X Plus/16GB/256GB
                  </p>
                </div>
              </div>
              <div class="product-footer">
                <div class="product-price">$1899.00</div>
                <!-- <button type="button">View</button> -->
              </div>
            </div>
          </a>
        </div>
      </div>
    </section>
    <?php include 'includes/footer_full.inc'; ?>
  </body>
</html>
