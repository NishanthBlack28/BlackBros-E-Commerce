<?php
if (!isset($_GET["id"]) || $_GET["id"] == NULL) {
    header('Location: index.php');
    exit(); // Add exit to prevent further execution
}
$current_url = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";
?>
<?php
$conn = mysqli_connect("0.0.0.0", "root", "root", "ecommerce");
// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Black E-commerce/shop/sproduct</title>


    <link rel="stylesheet" href="style.css">
</head>

<body>
    <section id="header">
        <a href="#"><img src="img/black.png" class="logo" /></a>
        <div>
            <ul id="nav-bar">
                <li><a href="index.html">Home</a></li>
                <li><a class="active" href="shop.html">Shop</a></li>
                <li><a href="blog.html">Blog</a></li>
                <li><a href="about.html">About</a></li>
                <li><a href="contact.html">Contactus</a></li>
                <li id="lg-bag"><a href="cart.html"><i class="fa-solid fa-cart-shopping fa-shake"></i></a></li>
                <a href="#" id="close"><i class="fa-solid fa-xmark"></i></a>
            </ul>
        </div>
        <div id="mobile">
            <a href="cart.html"><i id="shake" class="fa-solid fa-cart-shopping fa-shake"></i></a>
            <i id="bar" class="fa-solid fa-bars"></i>
        </div>
    </section>

    <section id="prodetails" class="section-p1">
        <?php
        $id = $_GET["id"];
        $sanitized_id = mysqli_real_escape_string($conn, $id);
        $sql = "SELECT * FROM products WHERE id='$sanitized_id'";

        $result = mysqli_query($conn, $sql);

        if (mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_assoc($result)) { 
          echo '
              <div class="single-pro-img">
                  <img src="data:image/png;base64,' . $row["img1"] . '" width="100%" id="MainImg">
                  <div class="small-img-group">
                      <div class="small-img-col">
                          <img src="data:image/jpeg;base64,' . $row["img1"] . '" width="100%" class="small-img">
                      </div>';
          
          echo ($row["img2"] != NULL) ? '
                      <div class="small-img-col">
                          <img src="data:image/jpeg;base64,' . $row["img2"] . '" width="100%" class="small-img">
                      </div>' : '';
          
          echo ($row["img3"] != NULL) ? '
                      <div class="small-img-col">
                          <img src="data:image/jpeg;base64,' . $row["img3"] . '" width="100%" class="small-img">
                      </div>' : '';
          
          echo ($row["img4"] != NULL) ? '
                      <div class="small-img-col">
                          <img src="data:image/jpeg;base64,' . $row["img4"] . '" width="100%" class="small-img">
                      </div>' : '';
          
          echo '
                  </div>
              </div>
              <div class="single-pro-details">
                  <h6>'.$row["brand"].'</h6>
                  <h4>'.$row["name"].'</h4>
                  <h2>&#8377;'.$row["price"].'</h2>
                  <select>
                      <option>Select Size</option>
                      <option>S</option>
                      <option>L</option>
                      <option>XL</option>
                      <option>XXL</option>
                  </select>
                  <input type="number" value="1">
                  <button class="normal">Add To Cart</button>
                  <h4>Product Details</h4>
                  <span>'.$row["para"].'</span>
              </div>';
            }
        }
        ?>
    </section>

    <section id="Product1" class="section-p1">
        <h2>Featured Products</h2>
            <p>Summer Collection New modern design</p>
            <div class="pro-container">
                <div class="pro">
                    <img src="img/products/n1.jpg" alt="" />
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
                    <img src="img/products/n2.jpg" alt="" />
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
                    <img src="img/products/n3.jpg" alt="" />
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
                    <img src="img/products/n4.jpg" alt="" />
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

    <script src="https://kit.fontawesome.com/22bb3b50ca.js"></script>
    <script>
        var MainImg = document.getElementById("MainImg");
        var smallimg = document.getElementsByClassName("small-img");
        smallimg[0].onclick = function() {
            MainImg.src = smallimg[0].src;
        };
        smallimg[1].onclick = function() {
            MainImg.src = smallimg[1].src;
        };
        smallimg[2].onclick = function() {
            MainImg.src = smallimg[2].src;
        };
        smallimg[3].onclick = function() {
            MainImg.src = smallimg[3].src;
        };
    </script>
    <script src="script.js"></script>
</body>
</html>
        