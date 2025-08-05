<?php
include "../config/config.php";

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['reqbtn'])) {
    $item = urlencode($_POST['item']);
    $sku = urlencode($_POST['sku']);
    $quantity = intval($_POST['quantity']);
    $query = "SELECT location, stock FROM stocks WHERE bar = '" . mysqli_real_escape_string($conn, $_POST['sku']) . "' LIMIT 1";
    $result = mysqli_query($conn, $query);
    if (!$result || mysqli_num_rows($result) == 0) {
        header("Location: ../view.php?barcode=" . urlencode($_POST['sku']) . "&request=fail");
        exit();
    }
    $data = mysqli_fetch_assoc($result);
    $location = urlencode($data['location']);
    $stock = urlencode($data['stock']);
    if ($stock > 0 && $stock <= 50) {
        $api_url = "https://mrdeath1291.pythonanywhere.com/invent-req?"
        . "item=$item&sku=$sku&location=$location&stock=$stock&need=$quantity&status=Low%20on%20Stock&to=PROCUREMENT&from=INVENTORY";

    } else {
            if ($stock == 0) {
                $api_url = "https://mrdeath1291.pythonanywhere.com/invent-req?"
                . "item=$item&sku=$sku&location=$location&stock=$stock&need=$quantity&status=Out%20of%20Stock&to=PROCUREMENT&from=INVENTORY";
            }
    }
    $response = @file_get_contents($api_url);

    
    if ($response !== FALSE) {

        header("Location: ../view.php?barcode=" . urlencode($_POST['sku']) . "&status=success");
        exit();
    } else {

        header("Location: ../view.php?barcode=" . urlencode($_POST['sku']) . "&status=fail");
        exit();
    }
} else {
    header("Location: ../view.php");
    exit();
}
