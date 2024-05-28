<?php
include("con-db.php");
if (!isset($_GET["id"]) || $_GET["id"] == NULL) {
    header('Location: blog.php');
    exit();
}

$id = mysqli_real_escape_string($conn, $_GET["id"]);

function getCurrentPageURL() {
    $url = 'http';
    if (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on') {
        $url .= "s";
    }
    $url .= "://";
    $url .= $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
    return $url;
}
$currentURL = getCurrentPageURL();
$pageTitle = "BlackBro's-Posts";

function getShareLinks($url, $title) {
    $encodedURL = urlencode($url);
    $encodedTitle = urlencode($title);

    $facebookShare = "https://www.facebook.com/sharer/sharer.php?u=$encodedURL&quote=$encodedTitle";
    $twitterShare = "https://twitter.com/intent/tweet?url=$encodedURL&text=$encodedTitle";
    $linkedinShare = "https://www.linkedin.com/shareArticle?mini=true&url=$encodedURL&title=$encodedTitle";
    $whatsappShare = "https://api.whatsapp.com/send?text=$encodedTitle%20$encodedURL";
    $emailShare = "mailto:?subject=$encodedTitle&body=$encodedURL";
    $redditShare = "https://www.reddit.com/submit?url=$encodedURL&title=$encodedTitle";
    $telegramShare = "https://t.me/share/url?url=$encodedURL&text=$encodedTitle";
    $githubShare = "https://github.com/share?url=$encodedURL&title=$encodedTitle";
    $stackoverflowShare = "https://stackoverflow.com/share?url=$encodedURL&title=$encodedTitle";
    $instagramShare = "https://www.instagram.com/?url=$encodedURL";
    $threadsShare = "https://www.threads.com/share?url=$encodedURL&text=$encodedTitle";

    return [
        'facebook' => $facebookShare,
        'twitter' => $twitterShare,
        'linkedin' => $linkedinShare,
        'whatsapp' => $whatsappShare,
        'email' => $emailShare,
        'reddit' => $redditShare,
        'telegram' => $telegramShare,
        'github' => $githubShare,
        'stackoverflow' => $stackoverflowShare,
        'instagram' => $instagramShare,
        'threads' => $threadsShare
    ];
}
$shareLinks = getShareLinks($currentURL, $pageTitle);

if (isset($_COOKIE["user"])) {
    $user = $_COOKIE["user"];
    $usql = "SELECT id FROM users WHERE username='$user'";
    $ures = mysqli_query($conn, $usql);
    $urow = mysqli_fetch_assoc($ures);
    $user_id = $urow["id"];
} else {
    $user_id = NULL;
}

// Increment views in the database
$hash = md5($_SERVER['REMOTE_ADDR']); // Simple hash of user IP to maintain privacy

// Check if this IP has already seen this post today (simple 24-hour check)
$query_check = "SELECT * FROM post_views WHERE blog_id='$id' AND user_ip_hash='$hash' AND DATE(view_timestamp) = CURDATE()";
$result_check = mysqli_query($conn, $query_check);
if (mysqli_num_rows($result_check) == 0) {
  // Record the new view
  $query_view = "INSERT INTO post_views (blog_id, user_ip_hash, user_id) VALUES ('$id', '$hash', '$user_id')";
  mysqli_query($conn, $query_view);
}

// Handle likes and dislikes
if ($_SERVER["REQUEST_METHOD"] == "POST" && $user_id != NULL) {
    $interaction_type = isset($_POST["like"]) ? 'like' : (isset($_POST["dislike"]) ? 'dislike' : NULL);
    if ($interaction_type) {
        $existing_interaction = "SELECT * FROM post_interactions WHERE post_id='$id' AND user_id='$user_id'";
        $result_existing = mysqli_query($conn, $existing_interaction);
        
        if (mysqli_num_rows($result_existing) > 0) {
            $row_existing = mysqli_fetch_assoc($result_existing);
            $existing_type = $row_existing['interaction_type'];

            if ($existing_type !== $interaction_type) {
                // Update the interaction type
                $query = "UPDATE post_interactions SET interaction_type='$interaction_type' WHERE post_id='$id' AND user_id='$user_id'";
                mysqli_query($conn, $query);
                
                // Adjust counts
                if ($interaction_type == 'like') {
                    $query_update = "UPDATE blog SET likes = likes + 1, dislikes = dislikes - 1 WHERE id = '$id'";
                } else {
                    $query_update = "UPDATE blog SET likes = likes - 1, dislikes = dislikes + 1 WHERE id = '$id'";
                }
                mysqli_query($conn, $query_update);
            }
        } else {
            // Insert new interaction
            $query = "INSERT INTO post_interactions (post_id, user_id, interaction_type) VALUES ('$id', '$user_id', '$interaction_type')";
            mysqli_query($conn, $query);
            
            // Update like or dislike count
            if ($interaction_type == 'like') {
                $query_update = "UPDATE blog SET likes = likes + 1 WHERE id = '$id'";
            } elseif ($interaction_type == 'dislike') {
                $query_update = "UPDATE blog SET dislikes = dislikes + 1 WHERE id = '$id'";
            }
            mysqli_query($conn, $query_update);
        }
    }
    echo "<script>
           window.location('post.php?id=".$id."');
          </script>";
}

$sql = "SELECT * FROM blog WHERE id=$id;";
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_assoc($result);
// Check if user has liked or disliked the post
$user_interaction = NULL;
if ($user_id != NULL) {
    $query_user_interaction = "SELECT interaction_type FROM post_interactions WHERE post_id='$id' AND user_id='$user_id'";
    $result_user_interaction = mysqli_query($conn, $query_user_interaction);
    if (mysqli_num_rows($result_user_interaction) > 0) {
        $user_interaction_row = mysqli_fetch_assoc($result_user_interaction);
        $user_interaction = $user_interaction_row['interaction_type'];
    }
}
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
        .share-buttons {
            display: flex;
            gap: 10px;
        }
        .share-buttons a, .share-buttons button {
            text-decoration: none;
            padding: 10px 20px;
            background-color: #0073b1; /* example color */
            color: #fff;
            border-radius: 5px;
            border: none;
            cursor: pointer;
        }
        .share-buttons a:hover, .share-buttons button:hover {
            background-color: #005582; /* example hover color */
        }

        #pagination {
            text-align: center;
            display: flex;
            justify-content: space-evenly;
        }

        #pagination span, #pagination a {
            text-decoration: none;
            color: #fff;
            padding: 7.5px 12px;
            border-radius: 4px;
            font-weight: 400;
            margin: 0 auto;
        }

        #pagination span {
            background-color: #bcbcbc;
        }

        #pagination a {
            background-color: #edb808;
        }

        a {
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

        .share-icons a svg, .share-icons button svg {
            width: 40px;
            height: 40px;
        }

        @media (max-width: 477px) {
            .share-icons a svg, .share-icons button svg {
                width: 20px;
                height: 20px;
            }
        }

        .like-button, .dislike-button {
            background-color: #bcbcbc;
            border: none;
            padding: 10px;
            cursor: pointer;
            margin: 5px;
        }

        .like-button.active, .dislike-button.active {
            background-color: #edb808;
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
            <li><a class="active" href="blog.html">Blog</a></li>
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
<section id="blog-post">
    <?php
    echo '
          <div class="post-title">
            <h4>  '.$row["title"].'</h4>
            <h6>  '.$row["date"].'</h6>
            <h5><i class="fa fa-solid fa-eye"></i>&nbsp;&nbsp;&nbsp;<b>'.$row["view"].'</b>&nbsp;&nbsp;
            <i class="bi bi-hand-thumbs-up"></i>&nbsp;&nbsp;&nbsp;<b>'.$row["likes"].'</b>&nbsp;&nbsp;
            <i class="bi bi-hand-thumbs-down"></i>&nbsp;&nbsp;&nbsp;<b>'.$row["dislikes"].'</b></h5>
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
<form method="post" action="">
    <input type="hidden" name="post_id" value="<?php echo $id; ?>">
    <button type="submit" name="like" value="1" class="like-button <?php echo ($user_interaction == 'like') ? 'active' : ''; ?>">Like</button>
    <button type="submit" name="dislike" value="1" class="dislike-button <?php echo ($user_interaction == 'dislike') ? 'active' : ''; ?>">Dislike</button>
</form>

<br>
<h4 style="font-size:16px; text-decoration:underline; margin:0 8px;">Share Post with friends via</h4>
<?php
echo '<div class="share-buttons">
    <table>
        <tr>
            <td><a class="btn btn-primary" style="background-color: #3b5998;" href="<?php echo $shareLinks[\'facebook\']; ?>" role="button"><i class="fab fa-facebook-f"></i></a></td>
            <td><a class="btn btn-primary" style="background-color: #55acee;" href="<?php echo $shareLinks[\'twitter\']; ?>" role="button"><i class="fab fa-twitter"></i></a></td>
            <td><a class="btn btn-primary" style="background-color: #0082ca;" href="<?php echo $shareLinks[\'linkedin\']; ?>" role="button"><i class="fab fa-linkedin-in"></i></a></td>
            <td><a class="btn btn-primary" style="background-color: #25D366;" href="<?php echo $shareLinks[\'whatsapp\']; ?>" role="button"><i class="fab fa-whatsapp"></i></a></td>
        </tr>
        <br>
        <tr class="extra-share-links" style="display: none;">
            <td><a class="btn btn-primary" style="background-color: #ea4335;" href="<?php echo $shareLinks[\'email\']; ?>" role="button"><i class="fas fa-envelope"></i></a></td>
            <td><a class="btn btn-primary" style="background-color: #FF4500;" href="<?php echo $shareLinks[\'reddit\']; ?>" role="button"><i class="fab fa-reddit-alien"></i></a></td>
            <td><a class="btn btn-primary" style="background-color: #0088cc;" href="<?php echo $shareLinks[\'telegram\']; ?>" role="button"><i class="fab fa-telegram-plane"></i></a></td>
            <td><a class="btn btn-primary" style="background-color: #333;" href="<?php echo $shareLinks[\'github\']; ?>" role="button"><i class="fab fa-github"></i></a></td>
        </tr>
        <tr class="extra-share-links" style="display: none;">
            <td><a class="btn btn-primary" style="background-color: #f48024;" href="<?php echo $shareLinks[\'stackoverflow\']; ?>" role="button"><i class="fab fa-stack-overflow"></i></a></td>
            <td><a class="btn btn-primary" style="background-color: #E4405F;" href="<?php echo $shareLinks[\'instagram\']; ?>" role="button"><i class="fab fa-instagram"></i></a></td>
            <td><a class="btn btn-primary" style="background-color: #000000;" href="<?php echo $shareLinks[\'threads\']; ?>" role="button"><i class="fab fa-threads"></i></a></td>
            <td><button onclick="copyLink()" class="btn btn-primary" style="background-color: #0073b1;"><i class="fas fa-link"></i></button></td>
        </tr>
    </table>
    <button class="toggle-more" onclick="toggleMore()">+</button></div>';
?>
<br>
<section id="pagination">
    <?php
    $current_post = isset($_GET['id']) ? $_GET['id'] : 1;
    $sql_count = "SELECT COUNT(*) AS total FROM blog";
    $result_count = mysqli_query($conn, $sql_count);
    $row_count = mysqli_fetch_assoc($result_count);
    $total_items = $row_count['total'] + 2;
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
function toggleMore() {
    var extraLinks = document.querySelectorAll('.extra-share-links');
    var toggleButton = document.querySelector('.toggle-more');
    var isVisible = extraLinks[0].style.display === 'table-row';

    extraLinks.forEach(function(row) {
        row.style.display = isVisible ? 'none' : 'table-row';
    });

    toggleButton.textContent = isVisible ? '+' : '-';
}

function copyLink() {
    var copyText = "<?php echo $currentURL; ?>";
    navigator.clipboard.writeText(copyText).then(function() {
        alert("Link copied to clipboard");
    }, function(err) {
        console.error('Could not copy text: ', err);
    });
}
</script>
</body>
</html>
