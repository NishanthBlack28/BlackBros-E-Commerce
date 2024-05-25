<?php
  $conn = mysqli_connect("0.0.0.0", "root", "root", "ecommerce");
  if (!$conn) {
      die("Connection failed: " . mysqli_connect_error());
  }
?>