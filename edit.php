<?php
include "config/config.php";

// Handle update logic
if (isset($_POST['updateItem'])) {
    $item = mysqli_real_escape_string($conn, $_POST['item']);
    $sku = mysqli_real_escape_string($conn, $_POST['sku']);
    $category = mysqli_real_escape_string($conn, $_POST['category']);
    $location = mysqli_real_escape_string($conn, $_POST['location']);
    $stock = (int)$_POST['stock'];
    $price = (float)$_POST['price'];

    $updateQuery = "UPDATE stocks SET 
        item = '$item', 
        category = '$category', 
        location = '$location', 
        stock = '$stock', 
        price = '$price',
        notified = 0
        WHERE bar = '$sku'";

    if (mysqli_query($conn, $updateQuery)) {
        header("Location: stock-tracking.php?updated=1");
        exit;
    } else {
        $error = "Update failed: " . mysqli_error($conn);
    }
}

// Load data to edit
if (!isset($_GET['barcode'])) {
    echo "Invalid request.";
    exit;
}

$barcode = mysqli_real_escape_string($conn, $_GET['barcode']);
$query = "SELECT * FROM stocks WHERE bar = '$barcode'";
$result = mysqli_query($conn, $query);

if (!$result || mysqli_num_rows($result) == 0) {
    echo "Item not found.";
    exit;
}

$data = mysqli_fetch_assoc($result);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Edit Item | Xophia’s Inventory</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
</head>
<body>
<div class="container mt-5">
    <h3 class="mb-4">Edit Item: <?php echo htmlspecialchars($data['item']); ?></h3>

    <?php if (isset($error)): ?>
        <div class="alert alert-danger"><?php echo $error; ?></div>
    <?php endif; ?>

    <form method="POST">
        <input type="hidden" name="sku" value="<?php echo htmlspecialchars($data['bar']); ?>">

        <div class="mb-3">
            <label for="item" class="form-label">Item Name</label>
            <input type="text" class="form-control" name="item" value="<?php echo htmlspecialchars($data['item']); ?>" required>
        </div>
        <div class="mb-3">
            <label for="category" class="form-label">Category</label>
            <input type="text" class="form-control" name="category" value="<?php echo htmlspecialchars($data['category']); ?>" required>
        </div>
        <div class="mb-3">
            <label for="location" class="form-label">Location</label>
            <input type="text" class="form-control" name="location" value="<?php echo htmlspecialchars($data['location']); ?>" required>
        </div>
        <div class="mb-3">
            <label for="stock" class="form-label">Stock Quantity</label>
            <input type="number" class="form-control" name="stock" value="<?php echo (int)$data['stock']; ?>" required>
        </div>
        <div class="mb-3">
            <label for="price" class="form-label">Price</label>
            <input type="text" class="form-control" name="price" value="<?php echo htmlspecialchars($data['price']); ?>" required>
        </div>
        <button type="submit" name="updateItem" class="btn btn-primary">Update Item</button>
        <a href="stock-tracking.php" class="btn btn-secondary">Cancel</a>
    </form>
</div>
</body>
</html>
