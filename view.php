<?php
include "config/config.php";

$sku = isset($_GET['barcode']) ? mysqli_real_escape_string($conn, $_GET['barcode']) : '';

if (empty($sku)) {
    echo "<div class='alert alert-danger mt-5 text-center'>Invalid or missing barcode.</div>";
    exit;
}

$query = "SELECT * FROM stocks WHERE bar = '$sku'";
$result = mysqli_query($conn, $query);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Item Info</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa;
        }
        .info-table {
            max-width: 600px;
            margin-top: 60px;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
        }
        .info-table thead th {
            background-color: #343a40;
            color: white;
        }
        .info-table tbody td {
            background-color: #ffffff;
        }
    </style>
</head>
<body>

<div class="container d-flex justify-content-center">
<?php if (mysqli_num_rows($result) > 0): ?>
    <table class="table table-bordered info-table">
        <thead>
            <tr>
                <th colspan="2" class="text-center">📦 Item Information</th>
            </tr>
        </thead>
        <tbody>
            <?php while ($data = mysqli_fetch_assoc($result)): ?>
                <tr>
                    <td><strong>Item</strong></td>
                    <td><?php echo htmlspecialchars($data['item']); ?></td>
                </tr>
                <tr>
                    <td><strong>SKU</strong></td>
                    <td><?php echo htmlspecialchars($data['bar']); ?></td>
                </tr>
                <tr>
                    <td><strong>Category</strong></td>
                    <td><?php echo htmlspecialchars($data['category']); ?></td>
                </tr>
                <tr>
                    <td><strong>Location</strong></td>
                    <td><?php echo htmlspecialchars($data['location']); ?></td>
                </tr>
                <tr>
                    <td><strong>Stock</strong></td>
                    <td><?php echo $data['stock']; ?></td>
                </tr>
                <?php
                if($data['stock'] < 49){
                    ?>
                    <tr>
                        <td colspan="2">
                            <form method="POST" action="assets/request-stock.php">
                                <input type="hidden" name="item" value="<?php echo htmlspecialchars($data['item']); ?>">
                                <input type="hidden" name="sku" value="<?php echo htmlspecialchars($data['bar']); ?>">
                                <button type="submit" name="reqbtn" class="btn btn-warning">REQUEST NEW STOCK</button>
                            </form>
                        </td>
                    </tr>
                <?php
                }
                ?>
            <?php endwhile; ?>
        </tbody>
    </table>
<?php else: ?>
    <div class="alert alert-warning mt-5 text-center">
        No item found for barcode <strong><?php echo htmlspecialchars($sku); ?></strong>.
    </div>
<?php endif; ?>
</div>

</body>
</html>
