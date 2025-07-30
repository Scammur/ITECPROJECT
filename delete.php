<?php
include "config/config.php";

if (!isset($_GET['barcode'])) {
    echo "Invalid request.";
    exit;
}

$barcode = mysqli_real_escape_string($conn, $_GET['barcode']);

$check = mysqli_query($conn, "SELECT * FROM stocks WHERE bar = '$barcode'");
if (mysqli_num_rows($check) == 0) {
    echo "Item not found.";
    exit;
}

$delete = mysqli_query($conn, "DELETE FROM stocks WHERE bar = '$barcode'");

if ($delete) {
    header("Location: stock-tracking.php?deleted=1");
    exit;
} else {
    echo "Error deleting item: " . mysqli_error($conn);
}
