<?php
include("con-db.php");

if (!isset($_GET["id"]) || $_GET["id"] == NULL) {
  header('Location: blog.php');
  exit();
}

$id = mysqli_real_escape_string($conn, $_GET["id"]);
$current_url = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";

if (isset($_COOKIE["user"])) {
  $user = $_COOKIE["user"];
}

// Increment views in the database
$hash = md5($_SERVER['REMOTE_ADDR']); // Simple hash of user IP to maintain privacy
$usql="SELECT id FROM users WHERE username='$user'";
$ures=mysqli_query($conn,$usql);
$urow=mysqli_fetch_assoc($ures);
$user_id=$urow["id"];

// Check if this IP has already seen this post today (simple 24-hour check)
$query_check = "SELECT * FROM post_views WHERE post_id='$id' AND user_ip_hash='$hash' AND DATE(view_timestamp) = CURDATE()";
$result_check = mysqli_query($conn, $query_check);
if (mysqli_num_rows($result_check) == 0) {
  // Record the new view
  $query_view = "INSERT INTO post_views (post_id, user_ip_hash, user_id) VALUES ('$id', '$hash', $user_id)";
  $result_view = mysqli_query($conn, $query_view);
}

$sql = "SELECT * FROM blog WHERE id=$id;";
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_assoc($result);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Black E-commerce/blog/post</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="post.css">
    <style>
        #pagination{
            text-align: center;
            display: flex;
            justify-content: space-evenly;
        }

        #pagination span{
            text-decoration: none;
            color: #fff;
            padding: 7.5px 12px;
            border-radius: 4px;
            background-color: #bcbcbc;
            font-weight: 400;
            margin: 0 auto;
        }

        #pagination a{
            text-decoration: none;
            color: #fff;
            padding: 7.5px 12px;
            border-radius: 4px;
            background-color: #edb808;
            font-weight: 400;
            margin: 0 auto;
        }
        a{
            font-family: "Madimi One", sans-serif;
        }

        .share-icons {
            display: flex;
            margin: 8px 0px 8px 24px;
        }

        .copied-popup {
            position: fixed;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            background-color: rgba(0, 0, 0, 0.8);
            color: #fff;
            padding: 10px 20px;
            border-radius: 5px;
            z-index: 9999;
            display: none;
        }
        .post-title h5 {
          transform: translateX(24px);
          margin: 4px 0;
          color: #94bcbc;
        } 
        .copied-popup.show {
            display: block;
        }

        .share-icons a svg{
            width: 40px;
            height: 40px;
        }
        .share-icons button svg{
            width: 36px;
            height: 36px;
        }

        @media (max-width: 477px) {
            .share-icons a svg{
                width: 20px;
                height: 20px;
            }
            .share-icons button svg{
                width: 18px;
                height: 18px;
            }
        }
    </style>
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
<section id="blog-post">
    <?php
    include("con-db.php");
    $id=$_GET["id"];
    $sql = "SELECT * FROM blog WHERE id=$id;";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($result);
    echo '
          <div class="post-title">
            <h4>  '.$row["title"].'</h4>
            <h6>  '.$row["date"].'</h6>
            <h5><i class="fa fa-soild fa-eye"></i><b>  '.$row["view"].'</b>&nbsp;&nbsp;<i class="bi bi-hand-thumbs-up"></i><b>  '.$row["view"].'</b></h5>
            <hr>
              <div class="blog-post-img">
                <img src="data:image/webp;base64,' . $row["img"] . '">
              </div>            
            <p>&nbsp;&nbsp;'.$row["para"].'</p>';

    if($row["img2"] != NULL){
        echo '
              <div class="blog-post-img">
                <img src="data:image/webp;base64,' . $row["img2"] . '">';
    }
    echo '
              <p>&nbsp;&nbsp;'.$row["para2"].'
              </p><hr></div>';
    ?>
</section>
<br>
<h4 style="font-size:16px; text-decoration:underline; margin:0 8px;">Share Post with friends via</h4>

<br>
<section id="pagination">
    <?php
    $current_post = isset($_GET['id']) ? $_GET['id'] : 1;
    $sql_count = "SELECT COUNT(*) AS total FROM blog";
    $result_count = mysqli_query($conn, $sql_count);
    $row_count = mysqli_fetch_assoc($result_count);
    $total_items = $row_count['total']+ 2;
    if ($current_post > 1) {
        echo '<a href="?id=' . ($current_post - 1) . '" class="pagination"><b>&lsaquo;</b> Previous</a>';
    } else {
        echo '<span class="pagination disabled"><b>&lsaquo;</b> Previous</span>';
    }

    // Next page link
    if ($current_post < $total_items) {
        echo '<a href="?id=' . ($current_post + 1) . '" class="pagination">Next <b>&rsaquo;</b></a>';
    } else {
        echo '<span class="pagination disabled">Next <b>&rsaquo;</b></span>';
    }
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
<script>
    function copyToClipboard(text) {
        var dummy = document.createElement("textarea");
        document.body.appendChild(dummy);
        dummy.value = text;
        dummy.select();
        document.execCommand("copy");
        document.body.removeChild(dummy);
        var popup = document.createElement("div");
        popup.className = "copied-popup";
        popup.innerHTML = "Link copied";
        document.body.appendChild(popup);
        setTimeout(function(){
            popup.classList.add("show");
            setTimeout(function(){
                popup.classList.remove("show");
                document.body.removeChild(popup);
            }, 1000);
        }, 100);
    }
</script>
</body>
</html>

