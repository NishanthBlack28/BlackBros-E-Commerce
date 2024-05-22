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

        #pagination {
            text-align: center;
        }

        #pagination a {
            text-decoration: none;
            color: #fff;
            padding: 7.5px 12px;
            border-radius: 4px;
            background-color: #edb808;
            font-weight: 400;
            margin: 0 1px;
        }

        a.bold {
            font-weight: 200;
            font-family: "Madimi One", sans-serif;
        }

        /* news newsletter */
        #newsletter {
            display: flex;
            justify-content: space-between;
            flex-wrap: wrap;
            align-items: center;
            background-image: url('img/banner/b14.png');
            background-repeat: no-repeat;
            background-position: 20% 30%;
            background-color: #041e42;
        }

        #newsletter h4 {
            color: #fff;
            font-size: 22px;
            font-weight: 800;
        }

        #newsletter p {
            color: #818ae0;
            font-size: 14px;
            font-weight: 600;
        }

        #newsletter span {
            color: #d6f123;
        }

        #newsletter .form {
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

        #newsletter button {
            background-color: #edb808;
            color: #fff;
            white-space: nowrap;
            border-radius: 4px;
            border-top-left-radius: 0;
            border-bottom-left-radius: 0;
        }

        footer {
            display: flex;
            justify-content: space-between;
            flex-wrap: wrap;
        }

        footer .col {
            display: flex;
            flex-direction: column;
            align-items: flex-start;
            margin-bottom: 20px;
        }

        footer .logo {
            margin-bottom: 20px;
        }

        footer h4 {
            font-size: 14px;
            padding-bottom: 20px;
        }

        footer p {
            font-size: 13px;
            margin: 0 0 8px 0;
        }

        footer a {
            font-size: 13px;
            margin-bottom: 10px;
            text-decoration: none;
            color: #222;
        }

        footer .follow {
            margin-top: 20px;
        }

        footer .follow i {
            color: #222000;
            padding-right: 4px;
            cursor: pointer;
        }

        footer .follow i:hover,
        footer .col a:hover {
            color: #edb808;
        }

        footer .install img {
            margin: 10px 0 15px 0;
        }

        footer .install .row img {
            border: 1px solid #b7bbbb;
            border-radius: 6px;
        }

        footer .install .row:hover img {
            border: 1px solid #edb808;
            box-shadow: 1px 1px 4px #fcfcfc;
        }

        footer .copyright {
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

        /* Floating Button */
        .floating-btn {
            position: fixed;
            bottom: 20px;
            right: 20px;
            background-color: #edb808;
            color: white;
            border: none;
            border-radius: 50%;
            width: 60px;
            height: 60px;
            font-size: 30px;
            cursor: pointer;
            box-shadow: 0px 2px 10px rgba(0, 0, 0, 0.3);
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .floating-btn:hover {
            background-color: #d39b06;
        }

        /* Modal Styles */
        .modal {
            display: none;
            position: fixed;
            z-index: 1;
            left: 0;
            top: 0;
            width: 100%;
            height: 100%;
            overflow: auto;
            background-color: rgba(0, 0, 0, 0.5);
            justify-content: center;
            align-items: center;
        }

        .modal-content {
            background-color: #fefefe;
            margin: auto;
            padding: 20px;
            border: 1px solid #888;
            width: 80%;
            max-width: 500px;
            border-radius: 8px;
        }

        .close {
            color: #aaa;
            float: right;
            font-size: 28px;
            font-weight: bold;
        }

        .close:hover,
        .close:focus {
            color: black;
            text-decoration: none;
            cursor: pointer;
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
                <li><a href="contact.html">Contact us</a></li>
                <li id="lg-bag"><a href="cart.html"><i class="fa-solid fa-cart-shopping fa-shake"></i></a></li>
                <a href="#" id="close"><i class="fa-solid fa-xmark"></i></a>
            </ul>
        </div>
        <div id="mobile">
            <a href="cart.html"><i id="shake" class="fa-solid fa-cart-shopping  fa-shake"></i></a>
            <i id="bar" class="fa-solid fa-bars"></i>
        </div>
    </section>

    <section id="page-header" class="blog-header">
        <h2>#readmore</h2>
        <p>Read all case studies about our products!</p>
    </section>

    <section id="blog">
        <?php
        $conn = mysqli_connect("0.0.0.0", "root", "root", "ecommerce");
        if (!$conn) {
            die("Connection failed: " . mysqli_connect_error());
        }
        $items_per_page = 5;
        $current_page = isset($_GET['page']) ? $_GET['page'] : 1;
        $start = ($current_page - 1) * $items_per_page;

        $sql = "SELECT id, title, date, img, CONCAT(SUBSTRING_INDEX(para, ' ', 20), '...') AS par FROM blog LIMIT $start, $items_per_page";
        $result = mysqli_query($conn, $sql);

        while ($row = mysqli_fetch_assoc($result)) {
            $date = strtotime($row['date']);
            echo '
            <div class="blog-box">
                <div class="blog-img">
                    <img src="data:image/webp;base64,' . $row["img"] . '">
                </div>
                <div class="blog-details">
                    <h2>' . $row['title'] . '</h2>
                    <p>' . $row['par'] . '</p>
                    <button style="background:transparent; border:none; outline:none;" type="submit" name="post" value="" class="hidden"><a href="post.php?id=' . $row["id"] . '">CONTINUE READING</a></button>
                </div>
                <h1>' . date("d/m", $date) . '</h1>
            </div>';
        }

        mysqli_close($conn);
        ?>
    </section>

<?php
$conn = mysqli_connect("0.0.0.0", "root", "root", "ecommerce");
if (!$conn) {
  die("Connection failed: " . mysqli_connect_error());
}
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
  if ($current_page > 1) {
    echo '<a href="?page=' . ($current_page - 1) . '" class="pagination"><b>&lsaquo;&lsaquo;</b></a>'; 
  }
  
  echo '<a href="?page=1"class="pagination"><b>&lsaquo;</b></a>';
  
  for ($i = max(1, $current_page - 1); $i <= min($current_page + 1, $total_pages); $i++) {
    echo '<a' . ($current_page == $i ? ' class="active bold blod1 pagination"' : '') . ' class="bold pagination" href="?page=' . $i . '">' . $i . '</a>';
  }
  if ($current_page < $total_pages) {
    echo '<a href="?page=' . ($current_page + 1) . '"class="pagination"><b>&rsaquo;</b></a>'; 
  }
  echo '<a href="?page=' . $total_pages . '"class="pagination"><b>&rsaquo;&rsaquo;</b></a>'; 
  ?>
</section>

    <section id="newsletter" class="section-p1 section-m1">
        <div class="newstext">
            <h4>Sign Up For Newsletters</h4>
            <p>Get E-mail updates about our latest shop and <span>special offers.</span></p>
        </div>
        <div class="form">
            <input type="text" placeholder="Your email address" />
            <button class="normal">Sign Up</button>
        </div>
    </section>

    <footer class="section-p1">
        <div class="col">
            <img class="logo" src="img/black.png" alt="" />
            <h4>Contact</h4>
            <p><strong>Address:</strong> 562 Wellington Road, Street 32, San Francisco</p>
            <p><strong>Phone:</strong> +01 2222 365 /(+91) 01 2345 6789</p>
            <p><strong>Hours:</strong> 10:00 - 18:00, Mon - Sat</p>
            <div class="follow">
                <h4>Follow us</h4>
                <div class="icon">
                    <i class="fa-brands fa-facebook-f"></i>
                    <i class="fa-brands fa-twitter"></i>
                    <i class="fa-brands fa-instagram"></i>
                    <i class="fa-brands fa-pinterest-p"></i>
                    <i class="fa-brands fa-youtube"></i>
                </div>
            </div>
        </div>

        <div class="col">
            <h4>About</h4>
            <a href="#">About us</a>
            <a href="#">Delivery Information</a>
            <a href="#">Privacy Policy</a>
            <a href="#">Terms & Conditions</a>
            <a href="#">Contact Us</a>
        </div>
        <div class="col">
            <h4>My Account</h4>
            <a href="#">Sign In</a>
            <a href="#">View Cart</a>
            <a href="#">My Wishlist</a>
            <a href="#">Track My Order</a>
            <a href="#">Help</a>
        </div>
        <div class="col install">
            <h4>Install App</h4>
            <p>From App Store or Google Play</p>
            <div class="row">
                <img src="img/pay/app.jpg" alt="" />
                <img src="img/pay/play.jpg" alt="" />
            </div>
            <p>Secured Payment Gateways</p>
            <img src="img/pay/pay.png" alt="" />
        </div>

        <div class="copyright">
            <p>© 2021, Black E-commerce Template</p>
        </div>
    </footer>

    <!-- Floating Button -->
    <button class="floating-btn" onclick="openModal()">+</button>

    <!-- Modal -->
    <div id="myModal" class="modal">
        <div class="modal-content">
            <span class="close" onclick="closeModal()">&times;</span>
              <body>
                  <section id="form-details">
                      <form action="" method="post" enctype="multipart/form-data">
                          <h2>Add your Products here...</h2>
                          <input type="text" name="title" placeholder="Enter your blog title" name="title" required="">
                          <textarea name="para" placeholder="Enter your Description"></textarea>
                          <textarea name="para2" placeholder="Enter your Description"></textarea>
                          <label>Image 1:</label>
                          <input type="file" name="img1" required=""><br>
                          <label>Image 2:</label>
                          <input type="file" name="img2">
                          <button class="normal" type="submit" name="submit">Submit</button>
                      </form>
                  </section>
              
              <?php
              $conn=mysqli_connect("0.0.0.0","root","root","ecommerce");
              // Check connection
              if (!$conn) {
                die("Connection failed: " . mysqli_connect_error());
              }
              
              // Check if form is submitted
              if(isset($_POST['submit'])){
                  // Get form data
                  $title = $_POST['title'];
                  $para2 = $_POST['para2'];
                  $para = $_POST['para'];
              
                  // Convert images to base64
                  $img1 = base64_encode(file_get_contents($_FILES['img1']['tmp_name']));
                  $img2 = !empty($_FILES['img2']['tmp_name']) ? base64_encode(file_get_contents($_FILES['img2']['tmp_name'])) : NULL;
              
                  // SQL query to insert data into the table
                  $sql = "INSERT INTO blog (title, para, para2, img, img2)
                  VALUES ('$title', '$para' , '$para2' , '$img1', '$img2')";
              
              
                  // Execute query
                  if (mysqli_query($conn, $sql)) {
                    echo "New record created successfully";
                  } else {
                    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
                  }
              
                  // Close connection
                  mysqli_close($conn);
              }
              ?>            
        </div>
    </div>

    <script>
        // Modal Functions
        function openModal() {
            document.getElementById("myModal").style.display = "flex";
        }

        function closeModal() {
            document.getElementById("myModal").style.display = "none";
        }

        // Add event listener to close modal when clicking outside of it
        window.onclick = function(event) {
            const modal = document.getElementById("myModal");
            if (event.target == modal) {
                closeModal();
            }
        };
    </script>

    <script src="script.js"></script>
    <script src="https://kit.fontawesome.com/22bb3b50ca.js" crossorigin="anonymous"></script>
</body>
</html>