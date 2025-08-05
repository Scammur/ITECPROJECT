<?php
include "config/config.php";

header('Content-Type: application/json');

if (isset($_GET['sku'])) {
    $sku = $_GET['sku'];
    $query = "SELECT COUNT(*) as count FROM stocks WHERE bar = ?";
    $stmt = mysqli_prepare($conn, $query);
    mysqli_stmt_bind_param($stmt, "s", $sku);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);
    $row = mysqli_fetch_assoc($result);
    
    echo json_encode(['exists' => $row['count'] > 0]);
} else {
    echo json_encode(['exists' => false]);
}

mysqli_close($conn);
?>