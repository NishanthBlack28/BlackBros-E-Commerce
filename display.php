<?php
// Assuming you have a database connection established
include("con-db.php");

// SQL query to fetch all data from the table
$sql = "SELECT * FROM products";
$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) > 0) {
    // Output data of each row
    while($row = mysqli_fetch_assoc($result)) {
        echo "Brand: " . $row["brand"]. "<br>";
        echo "Title: " . $row["name"]. "<br>";
        echo "Rating: " . $row["rating"]. "<br>";
        echo "Price: " . $row["price"]. "<br>";
        echo "Season: " . $row["season"]. "<br>";
        echo "Category: " . $row["category"]. "<br>";

        // Display images
        echo '<img src="data:image/jpeg;base64,' . $row["img1"] . '" />';
        echo '<img src="data:image/jpeg;base64,' . $row["img2"] . '" />';
        echo '<img src="data:image/jpeg;base64,' . $row["img3"] . '" />';
        echo '<img src="data:image/jpeg;base64,' . $row["img4"] . '" />';
        echo "<hr>";
    }
} else {
    echo "0 results";
}

// Close connection
mysqli_close($conn);
?>
