<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Black E-commerce/blog/post</title>
        
        <link rel="stylesheet" href="style.css">
    </head>
    <body>
        <section id="header">
          <a href="#"><img src="img/black.png" class="logo"/></a>
          <div>
            <ul id="nav-bar">
              <li><a href="index.html">Home</a></li>
              <li><a href="shop.html">Shop</a></li>
              <li><a class="active"href="blog.html">Blog</a></li>
              <li><a href="about.html">About</a></li>
              <li><a href="contact.html">Contactus</a></li>
              <li id="lg-bag"><a href="cart.html"><i class="fa-solid fa-cart-shopping fa-shake"></i></a></li>
              <a href="#" id="close"><i class="fa-solid fa-xmark"></i></a>
            </ul>
          </div>
          <div id="mobile">
            <a href="cart.html"><i id="shake" class="fa-solid fa-cart-shopping  fa-shake"></i></a>
            <i id="bar" class="fa-solid fa-bars"></i>
          </div>
        </section>      
        <section id="blogs">
          <?php 
          $conn=mysqli_connect("0.0.0.0","root","root","ecommerce");
          $sql = "SELECT * FROM blog;";
          $result = mysqli_query($conn, $sql);
          $row = mysqli_fetch_assoc($result);
            echo '
            <div class="blog-box">
              <div class="title post-title">
              <h4>'.$row["title"].'</h4>
              <h6>'.$row["date"].'</h6>
              <hr>
              </div>
              <div id="blog">
                <div class="blog-img">
                  <img src="'.$row["img"].'">
                </div>            
              </div>
              <p>'.$row["para"].'</p>';
              
            if($row["img2"] != NULL){
              echo '
              <div id="blog" class="blog2">
                <div class="blog-img">
                  <img src="'.$row["img2"].'">
                </div>            
              </div>';
            }
            
            echo '
              <p>'.$row["para2"].'</p>
              <hr>            
            </div>';
          ?>
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
