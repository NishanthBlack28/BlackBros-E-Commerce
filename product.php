<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Pagination</title>
<style>
    .pagination {
        display: flex;
        justify-content: center;
        align-items: center;
        list-style: none;
        padding: 0;
    }
    .pagination li {
        margin: 0 5px;
    }
    .pagination a {
        background-color: #007bff;
        color: #fff;
        text-decoration: none;
        padding: 5px 10px;
        cursor: pointer;
    }
</style>
</head>
<body>

<?php
$conn = mysqli_connect("0.0.0.0","root","root","22ct19");

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

$items_per_page = 1;
$current_page = isset($_GET['page']) ? $_GET['page'] : 1;
$start = ($current_page - 1) * $items_per_page;
$sql = "SELECT * FROM products LIMIT $start, $items_per_page";
$result = mysqli_query($conn, $sql);

$total_count_sql = "SELECT COUNT(*) AS total_count FROM products";
$total_count_result = mysqli_query($conn, $total_count_sql);
$total_count_row = mysqli_fetch_assoc($total_count_result);
$total_items = $total_count_row['total_count'];
$total_pages = ceil($total_items / $items_per_page);

if (mysqli_num_rows($result) > 0) {
    echo "<ul>";
    while($row = mysqli_fetch_assoc($result)) {
        echo "<li>" . $row["title"] . "</li>";
    }
    echo "</ul>";
} else {
    echo "No data found";
}

echo '<section id="pagination" class="section-p1">';
if ($current_page > 1) {
    echo '<a href="?page=1">&lt;&lt;</a>';
    echo '<a href="?page='.($current_page - 1).'">&lt;</a>';
}
for ($i = max(1, $current_page - 2); $i <= min($current_page + 2, $total_pages); $i++) {
    echo '<a' . ($current_page == $i ? ' style="background-color: #333;"' : '') . ' href="?page='.$i.'"><i class="fa-solid fa-'.$i.'"></i></a>';
}
if ($current_page < $total_pages) {
    echo '<a href="?page='.($current_page + 1).'">&gt;</a>';
    echo '<a href="?page='.$total_pages.'">&gt;&gt;</a>';
}
echo '</section>';

// Close connection
mysqli_close($conn);
?>

</body>
</html>
