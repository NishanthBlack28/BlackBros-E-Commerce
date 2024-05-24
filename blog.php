<?php 
session_start();
if (!isset($_COOKIE['user'])) {
    setcookie("user", "testuser", time() + (86400 * 30)); // 30 days
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Black E-commerce/blog</title>
  <link rel="stylesheet" href="style.css">
  <link rel="stylesheet" href="post.css">
  <style>
  @import url('https://fonts.googleapis.com/css2?family=Madimi+One&family=Poppins:wght@400;500;600&display=swap');
  
     #pagination{
      text-align: center;
    }
    
    #pagination a{
      text-decoration: none;
      color: #fff;
      padding: 7.5px 12px;
      border-radius: 4px;
      background-color: #edb808;
      font-weight: 400;
      margin: 0 1px;
    }
    a.bold{
      font-weight: 200;
      font-family: "Madimi One", sans-serif;
    }
    //news newsletter
   #newsletter{
    display: flex;
    justify-content: space-between;
    flex-wrap: wrap;
    align-items: center;
    background-image: url('img/banner/b14.png');
    background-repeat: no-repeat;
    background-position: 20% 30%;
    background-color: #041e42;
  }
  
  #newsletter h4{
    color: #fff;
    font-size: 22px;
    font-weight: 800;
  }
  
  #newsletter p{
    color: #818ae0;
    font-size: 14px;
    font-weight: 600;
  }
  
  #newsletter span{
    color: #d6f123;
  }
  
  #newsletter .form{
    display: flex;
    width: 40%;
  }
  #newsletter input {
    height: 3.125rem;
    width: 100%;
    padding: 0 1.25em;
    font-size: 14px;
    border: 1px solid transparent;
    border-radius: 4px;
    outline: none;
    border-top-right-radius: 0;
    border-bottom-right-radius: 0;
  }
  
  #newsletter button{
    background-color: #edb808;
    color: #fff;
    white-space: nowrap;
    border-radius: 4px;
    border-top-left-radius: 0;
    border-bottom-left-radius: 0;
  }
  footer{
    display: flex;
    justify-content: space-between;
    flex-wrap: wrap;
  }
  
  footer .col{
    display: flex;
    flex-direction: column;
    align-items: flex-start;
    margin-bottom: 20px;
  }
  
  footer .logo{
    margin-bottom: 20px;
  }
  
  footer h4{
    font-size: 14px;
    padding-bottom: 20px;[]
  }
  
  footer p{
    font-size: 13px;
    margin: 0 0 8px 0;
  }
  
  footer a{
    font-size: 13px;
    margin-bottom: 10px;
    text-decoration: none;
    color: #222;
  }
  
  footer .follow{
    margin-top: 20px;
  }
  
  footer .follow i{
    color: #222000;
    padding-right: 4px;
    cursor: pointer;
  }
  
  footer .follow i:hover,
  footer .col a:hover{
    color: #edb808;
  }
  
  footer .install img{
    margin: 10px 0 15px 0;
  }
  footer .install .row img{
    border: 1px solid #b7bbbb;
    border-radius: 6px;
  }
  
  footer .install .row:hover img{
    border: 1px solid #edb808;
    box-shadow: 1px 1px 4px #fcfcfc;
  }
  
  footer .copyright{
    width: 100%;
    text-align: center;
  }  
@media (max-width: 477px) {
    #newsletter {
    padding: 20px 40px;
  }
  #newsletter .form {
    width: 100%;
  }
  footer .copyright {
    text-align: start;
  }
}  
   
  </style>
</head>

<body>

  <section id="header">
    <a href="#"><img src="img/black.png" class="logo" /></a>

    <div>
      <ul id="nav-bar">
        <li><a href="index.html">Home</a></li>
        <li><a href="shop.html">Shop</a></li>
        <li><a class="active" href="blog.html">Blog</a></li>
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

  <?php
  include("con-db.php");
  $items_per_page = 5;
  $current_page = isset($_GET['page']) ? $_GET['page'] : 1;
  $start = ($current_page - 1) * $items_per_page;
  ?>

  <section id="page-header" class="blog-header">
    <h2>#readmore</h2>
    <p>read all case studies about our products!</p>
  </section>

  <section id="blog">
<?php
  $sql = "SELECT id,title,date,img,CONCAT(SUBSTRING_INDEX(para, ' ', 20), '...') AS par FROM blog LIMIT $start, $items_per_page";
  $result = mysqli_query($conn, $sql);
  while ($row = mysqli_fetch_assoc($result)) { // Changed to mysqli_fetch_assoc
    $date = strtotime($row['date']);
      echo '
    <div class="blog-box">
        <div class="blog-img">
            <img src="data:image/webp;base64,' . $row["img"] . '">
        </div>
        <div class="blog-details">
            <h2>' . $row['title'] . '</h2>
            <p>' . $row['par'] . '</p>
                <button style="background:transparent; border:none; outline:none;" type="submit" name="post" value="" class="hidden"><a href="post.php?id='.$row["id"].'">CONTINUE READING</a></button>
        </div>
        <h1>' . date("d/m", $date) . '</h1>
    </div>';
    }
    ?>
  </section>


<?php
$items_per_page = 5;
$current_page = isset($_GET['page']) ? $_GET['page'] : 1;
$start = ($current_page - 1) * $items_per_page;

$sql_count = "SELECT COUNT(*) AS total FROM blog";
$result_count = mysqli_query($conn, $sql_count);
$row_count = mysqli_fetch_assoc($result_count);
$total_items = $row_count['total'];
$total_pages = 1;
$total_pages = ceil($total_items / $items_per_page);

$sql = "SELECT * FROM blog LIMIT $start, $items_per_page";
$result = mysqli_query($conn, $sql);
?>

<section id="pagination" class="section-p1">
<?php
  echo '<a href="?page=1"class="pagination"><i class="fa-solid fa-angles-left"></i></a>';
  if ($current_page > 1) {
    echo '<a href="?page=' . ($current_page - 1) . '" class="pagination"><i class="fa-solid fa-angle-left"></i></a>'; 
  }

  for ($i = max(1, $current_page - 1); $i <= min($current_page + 1, $total_pages); $i++) {
    echo '<a' . ($current_page == $i ? ' class="active bold blod1 pagination"' : '') . ' class="bold pagination" href="?page=' . $i . '">' . $i . '</a>';
  }
  if ($current_page < $total_pages) {
    echo '<a href="?page=' . ($current_page + 1) . '"class="pagination"><i class="fa-solid fa-angle-right"></i></a>'; 
  }
  echo '<a href="?page=' . $total_pages . '"class="pagination"><i class="fa-solid fa-angles-right"></i></a>'; 
  ?>
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
<?php mysqli_close($conn); ?>
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
    <a style="font-size: 13px;
  margin-bottom: 10px;
  text-decoration: none;
  color: #222;" ref="#">About us</a>
    <a style="font-size: 13px;
  margin-bottom: 10px;
  text-decoration: none;
  color: #222;" href="#">Deliver Information</a>
    <a style="font-size: 13px;
  margin-bottom: 10px;
  text-decoration: none;
  color: #222;" href="#">Privacy Policy</a>
    <a style="font-size: 13px;
  margin-bottom: 10px;
  text-decoration: none;
  color: #222;" href="#">Terms and Conditions</a>
    <a style="font-size: 13px;
  margin-bottom: 10px;
  text-decoration: none;
  color: #222;" href="#">Contact us</a>
  </div>
  <div class="col">
    <h4>My Account</h4>
    <a style="font-size: 13px;
  margin-bottom: 10px;
  text-decoration: none;
  color: #222;" href="#">Sign Inc</a>
    <a style="font-size: 13px;
  margin-bottom: 10px;
  text-decoration: none;
  color: #222;" href="#">View Cart</a>
    <a style="font-size: 13px;
  margin-bottom: 10px;
  text-decoration: none;
  color: #222;" href="#">My Wishlist</a>
    <a style="font-size: 13px;
  margin-bottom: 10px;
  text-decoration: none;
  color: #222;" href="#">Track my Order</a>
    <a style="font-size: 13px;
  margin-bottom: 10px;
  text-decoration: none;
  color: #222;" href="#">Help</a>
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
