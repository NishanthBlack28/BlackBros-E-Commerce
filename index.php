<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Black E-commerce website</title>
        
        <link rel="stylesheet" href="style.css">
    </head>

    <body>
      
        <section id="header">
          <a href="#"><img src="img/black.png" class="logo"/></a>
          
          <div>
            <ul id="nav-bar">
              <li><a class="active"href="index.html">Home</a></li>
              <li><a href="shop.html">Shop</a></li>
              <li><a href="blog.html">Blog</a></li>
              <li><a href="about.html">About</a></li>
              <li><a href="contact.html">Contactus</a></li>
              <li id="lg-bag"><a href="cart.html"><i class="fa-solid fa-cart-shopping fa-shake"></i></a></li>
              <a href="#" id="close"><i class="fa-solid fa-xmark"></i></a>
            </ul>
          </div>
          <div id="mobile">
            <a href="cart.html"><i class="fa-solid fa-cart-shopping "></i></a>
            <i id="bar" class="fa-solid fa-bars"></i>
          </div>
        </section>
        
        <section id="hero">
          <h4>Trade-in-offer</h4>
          <h2>Super value deals</h2>
          <h1>on all Products</h1>
          <p>save more with coupon & up to 70% off</p>
          <button>Shop now</button>
        </section>
        
        <section id="feature" class="section-p1">
          <div class="fe-box">
            <img src="img/features/f1.png" alt="">
            <h6>Free Shipping</h6>
          </div>
          <div class="fe-box">
            <img src="img/features/f2.png" alt="">
            <h6>Online Order</h6>
          </div>
          <div class="fe-box">
            <img src="img/features/f3.png" alt="">
            <h6>Save Money</h6>
          </div>
          <div class="fe-box">
            <img src="img/features/f4.png" alt="">
            <h6>Promotions</h6>
          </div>
          <div class="fe-box">
            <img src="img/features/f5.png" alt="">
            <h6>Happy Sell</h6>
          </div>
          <div class="fe-box">
            <img src="img/features/f6.png" alt="">
            <h6>24/7 Support</h6>
          </div>
        </section>
        <?php
          include("con-db.php");
          ?>

        <section id="Product1" class="section-p1">
          <h2>Featured Products</h2>
          <p>Summer Collection New modern design</p>
          <div class="pro-container">
          <?php
          $sql = "SELECT * FROM products";
          $result = mysqli_query($conn, $sql);
          
          if (mysqli_num_rows($result) > 0) {
              while($row = mysqli_fetch_assoc($result)){    
                echo '            
            <div class="pro" onclick="window.location.href=\'sproduct.php?id=' . $row["id"] . '\'">
              <img src="data:image/jpeg;base64,' . $row["img1"] . '" alt=""/>
              <div class="dis">
                <span>' . $row["brand"] . '</span>
                <h5>' . $row["name"] . '</h5>';
                echo '<div class="star">';
                $i = 1;
                while ($i <= 5) {
                    echo '<i class="fas fa-star" style="color: ' . ($i <= $row["rating"] ? '#edb808' : '#dae2e4bc') . ';"></i>';
                    ++$i;
                }
                echo '</div>';

                echo '<h4>&#8377; ' . $row["price"] . '</h4>
              </div>
              <form method="post">
                  <input name="product_id" value="' . $row["id"] . '" type="hidden">
                  <button style="background:transparent; border:none; outline:none;" type="submit" name="product_add_cart" value="" class="hidden"><a><i class="fa-solid fa-cart-shopping cart"></i></a></a></button>
              </form>              
              
            </div>';
              }
            }
          ?>            
          </div>
        </section>
        
        <section id="banner" class="section-m1">
          <h4>Repair Service</h4>
          <h2>Up to <span>70% off</span> - All dress and accessories</h2>
          <button class="normal">Explore More</button>
        </section>
        
        <section id="Product1" class="section-p1">
          <h2>New Arrivals</h2>
          <p>Summer Collection New modern design</p>
          <div class="pro-container">
            <div class="pro">
              <img src="img/products/n1.jpg" alt=""/>
              <div class="dis">
                <span>Noro</span>
                <h5>Formal buley-white shirt </h5>
                <div class="star">
                  <i class="fas fa-star" style="color: #edb808"></i>
                 <i class="fas fa-star" style="color:#edb808"></i>
                 <i class="fas fa-star" style="color:#edb808"></i>
                 <i class="fas fa-star" style="color:#edb808"></i>
                 <i class="fas fa-star" style="color:#dae2e4bc"></i>
                </div>
                <h4>$6.01</h4>
              </div>
              <a href=""><i class="fa-solid fa-cart-shopping cart"></i></a></a>
            </div>
            <div class="pro">
              <img src="img/products/n2.jpg" alt=""/>
              <div class="dis">
                <span>Manoto</span>
                <h5>Formal dirty gray shirt </h5>
                <div class="star">
                  <i class="fas fa-star" style="color: #edb808"></i>
                 <i class="fas fa-star" style="color:#edb808"></i>
                 <i class="fas fa-star" style="color:#dae2e4bc"></i>
                 <i class="fas fa-star" style="color:#dae2e4bc"></i>
                 <i class="fas fa-star" style="color:#dae2e4bc"></i>
                </div>
                <h4>$12.34</h4>
              </div>
              <a href=""><i class="fa-solid fa-cart-shopping cart"></i></a></a>
            </div>
            <div class="pro">
              <img src="img/products/n3.jpg" alt=""/>
              <div class="dis">
                <span>Jokees</span>
                <h5>Formal white shirt</h5>
                <div class="star">
                  <i class="fas fa-star" style="color: #edb808"></i>
                 <i class="fas fa-star" style="color:#edb808"></i>
                 <i class="fas fa-star" style="color:#edb808"></i>
                 <i class="fas fa-star" style="color:#edb808"></i>
                 <i class="fas fa-star" style="color:#dae2e4bc"></i>
                </div>
                <h4>$4.96</h4>
              </div>
              <a href=""><i class="fa-solid fa-cart-shopping cart"></i></a></a>
            </div>
            <div class="pro">
              <img src="img/products/n4.jpg" alt=""/>
              <div class="dis">
                <span>Mortal's</span>
                <h5>casual cursive shirt </h5>
                <div class="star">
                  <i class="fas fa-star" style="color: #edb808"></i>
                 <i class="fas fa-star" style="color:#edb808"></i>
                 <i class="fas fa-star" style="color:#edb808"></i>
                 <i class="fas fa-star" style="color:#dae2e4bc"></i>
                 <i class="fas fa-star" style="color:#dae2e4bc"></i>
                </div>
                <h4>$9.4</h4>
              </div>
              <a href=""><i class="fa-solid fa-cart-shopping cart"></i></a></a>
            </div>
            <div class="pro">
              <img src="img/products/n5.jpg" alt=""/>
              <div class="dis">
                <span>Nole'os</span>
                <h5>dirty buleies gray shirt</h5>
                <div class="star">
                  <i class="fas fa-star" style="color: #edb808"></i>
                 <i class="fas fa-star" style="color:#edb808"></i>
                 <i class="fas fa-star" style="color:#edb808"></i>
                 <i class="fas fa-star" style="color:#dae2e4bc"></i>
                 <i class="fas fa-star" style="color:#dae2e4bc"></i>
                </div>
                <h4>$2.33</h4>
              </div>
              <a href=""><i class="fa-solid fa-cart-shopping cart"></i></a></a>
            </div>
            <div class="pro">
              <img src="img/products/n6.jpg" alt=""/>
              <div class="dis">
                <span>cartoll's</span>
                <h5>masive half phands</h5>
                <div class="star">
                  <i class="fas fa-star" style="color: #edb808"></i>
                 <i class="fas fa-star" style="color:#edb808"></i>
                 <i class="fas fa-star" style="color:#edb808"></i>
                 <i class="fas fa-star" style="color:#edb808"></i>
                 <i class="fas fa-star" style="color:#dae2e4bc"></i>
                </div>
                <h4>$3.94</h4>
              </div>
              <a href=""><i class="fa-solid fa-cart-shopping cart"></i></a></a>
            </div>
            <div class="pro">
              <img src="img/products/n7.jpg" alt=""/>
              <div class="dis">
                <span>Moleaff's</span>
                <h5>Brownies shade shirt</h5>
                <div class="star">
                  <i class="fas fa-star" style="color: #edb808"></i>
                 <i class="fas fa-star" style="color:#edb808"></i>
                 <i class="fas fa-star" style="color:#edb808"></i>
                 <i class="fas fa-star" style="color:#dae2e4bc"></i>
                 <i class="fas fa-star" style="color:#dae2e4bc"></i>
                </div>
                <h4>$4.1</h4>
              </div>
              <a href=""><i class="fa-solid fa-cart-shopping cart"></i></a></a>
            </div>
            <div class="pro">
              <img src="img/products/n8.jpg" alt=""/>
              <div class="dis">
                <span>Jokees</span>
                <h5>attractive black shirt</h5>
                <div class="star">
                  <i class="fas fa-star" style="color: #edb808"></i>
                 <i class="fas fa-star" style
                   ="color:#edb808"></i>
                 <i class="fas fa-star" style="color:#edb808"></i>
                 <i class="fas fa-star" style="color:#edb808"></i>
                 <i class="fas fa-star" style="color:#dae2e4bc"></i>
                </div>
                <h4>$6.89</h4>
              </div>
              <a href=""><i class="fa-solid fa-cart-shopping cart"></i></a></a>
            </div>
            </div>
        </section>
        
        <section id="sm-banner" class="section-m1">
          <div class="banner-box">
            <h4>crazy deals</h4>
            <h2>buy 1 get 1 free</h2>
            <span>The best classic dress is on sale at Black Bro's</span>
            <button class="white">Learn more</button>
          </div>
          <div class="banner-box banner-box2">
            <h4>spring/summer</h4>
            <h2>upcoming season</h2>
            <span>The best collective dress is on sale at Black Bro's</span>
            <button class="white">collection</button>
          </div>
        </section>
        
        <section id="banner3">
          <div class="banner-box">
            <h2>SEASONAL SALE</h2>
            <h3>Winter collection-50% OFF</h3>
          </div>
          <div class="banner-box banner-box2">
            <h2>NEW FOOTWEAR COLLECTION</h2>
            <h3>Spring/Summer-2023</h3>
          </div>
          <div class="banner-box banner-box3">
            <h2>T-Shirt</h2>
            <h3>New Trendy Print's</h3>
          </div>
        </section>
        
        <section id="newsletter" class="section-p1 section-m1">
          <div class="newstext">
            <h4>Sign up for Newsletter</h4>
            <p>Get E-mail updates about our latest shop and <span>Special offers.</span></p>
          </div>
          <div class="form">
            <input type="text" name="e-mail" placeholder="Your E-mail address">
            <button class="normal">Sigh up</button>
          </div>
        </section>
        
        <footer class="section-p1">
          <div class="col">
            <img src="img/black.png" class="logo">
            <h4>Contact</h4>
            <p><strong>Address: </strong>7-RLG-road,Chennai,TamilNadu,India</p>
            <p><strong>Phone: </strong>+1 505-644-2334/+91 61279 14199/+81 90-6569-4205</p>
            <p><strong>Hours: </strong>10:00-18:00 Mon-Sat</p>
            <div class="follow">
              <h4>Follow us</h4>
              <div class="icon">
                <i class="fa-brands fa-facebook"></i>
                <i class="fa-brands fa-twitter"></i>
                <i class="fa-brands fa-instagram"></i>
                <i class="fa-brands fa-linkedin-in"></i>
                <i class="fa-brands fa-youtube"></i>
              </div>
            </div>
          </div>
          <div class="col">
            <h4>About</h4>
            <a href="#">About us</a>
            <a href="#">Deliver Information</a>
            <a href="#">Privacy Policy</a>
            <a href="#">Terms and Conditions</a>
            <a href="#">Contact us</a>
          </div>
          <div class="col">
            <h4>My Account</h4>
            <a href="#">Sign Inc</a>
            <a href="#">View Cart</a>
            <a href="#">My Wishlist</a>
            <a href="#">Track my Order</a>
            <a href="#">Help</a>
          </div>
          <div class="col install">
            <h4>Install App</h4>
            <p>from App Store or Google Play</p>
            <div class="row">
              <img src="img/pay/app.jpg">
              <img src="img/pay/play.jpg">
            </div>
            <p>Secured Payment Gateways</p>
            <img src="img/pay/pay.png">
          </div>
          
          <div class="copyright">
            <p>All copyright reserved under <strong>BlackBro's</strong> ©2023</p>
          </div>
        </footer>
        <script src="script.js"></script>
        <script src="https://kit.fontawesome.com/22bb3b50ca.js"></script>
    </body>
</html>