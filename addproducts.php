<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Black E-commerce/contact</title>
    
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <section id="form-details">
        <form action="" method="post" enctype="multipart/form-data">
            <h2>Add your Products here...</h2>
            <input type="text" name="brand" placeholder="Enter your Brand name" required="">
            <input type="text" name="title" placeholder="Enter your Products title" name="title" required="">
            <input type="number" placeholder="Enter your Product Rating in 0-5" name="rating" required="">
            <input type="number" placeholder="Enter your Price" name="price" required="">
            <input type="text" name="season" placeholder="Enter Season" required="">
            <input type="text" placeholder="Enter Category" name="category">
            <textarea name="para" placeholder="Enter your Description about product"></textarea>
            <label>Image 1:</label>
            <input type="file" name="img1" required=""><br>
            <label>Image 2:</label>
            <input type="file" name="img2">
            <label>Image 3:</label>
            <input type="file" name="img3">
            <label>Image 4:</label>
            <input type="file" name="img4">
            <button class="normal" type="submit" name="submit">Submit</button>
        </form>
    </section>

<?php
include("con-db.php");

// Check if form is submitted
if(isset($_POST['submit'])){
    // Get form data
    $brand = $_POST['brand'];
    $title = $_POST['title'];
    $rating = $_POST['rating'];
    $price = $_POST['price'];
    $season = $_POST['season'];
    $category = $_POST['category'];
    $para = $_POST['para'];

    // Convert images to base64
    $img1 = base64_encode(file_get_contents($_FILES['img1']['tmp_name']));
    $img2 = !empty($_FILES['img2']['tmp_name']) ? base64_encode(file_get_contents($_FILES['img2']['tmp_name'])) : NULL;
    $img3 = !empty($_FILES['img3']['tmp_name']) ? base64_encode(file_get_contents($_FILES['img3']['tmp_name'])) : NULL;
    $img4 = !empty($_FILES['img4']['tmp_name']) ? base64_encode(file_get_contents($_FILES['img4']['tmp_name'])) : NULL;

    // SQL query to insert data into the table
    $sql = "INSERT INTO products (brand, name, rating, img1, img2, img3, img4, season, price, para)
    VALUES ('$brand', '$title', $rating, '$img1', '$img2', '$img3', '$img4', '$season', $price, '$para')";


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
</body>
</html>
