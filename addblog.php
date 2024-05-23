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
include("con-db.php");

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
</body>
</html>
