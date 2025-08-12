<?php
include "../config/config.php";

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['reqbtn'])) {
    $itemRaw = $_POST['item']; // original
    $skuRaw = $_POST['sku'];
    $quantity = intval($_POST['quantity']);

    if ($quantity <= 0) {
        header("Location: ../view.php?barcode=".rawurlencode($skuRaw)."&status=invalid_quantity");
        exit();
    }

    $skuSafe = mysqli_real_escape_string($conn, $skuRaw);
    $query = "SELECT location, stock FROM stocks WHERE bar = '$skuSafe' LIMIT 1";
    $res = mysqli_query($conn, $query);
    if (!$res || mysqli_num_rows($res) === 0) {
        header("Location: ../view.php?barcode=".rawurlencode($skuRaw)."&status=not_found");
        exit();
    }

    $row = mysqli_fetch_assoc($res);
    $stock = intval($row['stock']);
    $locationRaw = $row['location'];

    $notifUrl = "https://mrdeath1291.pythonanywhere.com/notification";
    $notifRaw = @file_get_contents($notifUrl);
    if ($notifRaw) {
        $arr = json_decode($notifRaw, true);
        foreach ($arr['data'] as $d) {
            if ($d['barcode'] === $skuRaw && $d['item'] === $itemRaw) {
                header("Location: ../view.php?barcode=".rawurlencode($skuRaw)."&status=duplicate");
                exit();
            }
        }
    }

    if ($stock === 0) {
        $label = "Out of Stock";
    } elseif ($stock <= 50) {
        $label = "Low on Stock";
    } else {
        $label = "Stock Available";
    }

    $queryParams = http_build_query([
        'item'     => $itemRaw,
        'sku'      => $skuRaw,
        'location' => $locationRaw,
        'stock'    => $stock,
        'need'     => $quantity,
        'status'   => $label,
        'to'       => 'PROCUREMENT',
        'from'     => 'INVENTORY'
    ]);
    $apiUrl = "https://mrdeath1291.pythonanywhere.com/invent-req?$queryParams";
    $apiResp = @file_get_contents($apiUrl);

    if ($apiResp !== false) {
        $quer = "insert into orders(date_ordered, items, order_status, shipping_status, date_received, created_at) values(date(NOW()), '$itemRaw','Pending','N/A', NULL, NOW())";
        mysqli_query($conn,$quer);
        header("Location: ../view.php?barcode=".rawurlencode($skuRaw)."&status=success");
    } else {
        header("Location: ../view.php?barcode=".rawurlencode($skuRaw)."&status=fail");
    }
    exit();
} else {
    header("Location: ../view.php");
    exit();
}
?>

