<?php
include '../config/config.php';

if (isset($_POST['addItem'])) {
    $item = mysqli_real_escape_string($conn, $_POST['item']);
    $sku = mysqli_real_escape_string($conn, $_POST['sku']);
    $category = mysqli_real_escape_string($conn, $_POST['category']);
    $location = mysqli_real_escape_string($conn, $_POST['location']);
    $price = mysqli_real_escape_string($conn, $_POST['price']);
    $stock = (int) $_POST['stock'];

    $insert = "INSERT INTO stocks (item, bar, category, location, stock, price) 
               VALUES ('$item', '$sku', '$category', '$location', '$stock', '$price')";

    if (mysqli_query($conn, $insert)) {
        echo "<script>window.location.href='../stock-tracking.php';</script>";
    } else {
        echo "<script>alert('Error: ".mysqli_error($conn)."');</script>";
    }
}
?>
