<?php
include "config/config.php";
$sku = isset($_GET['barcode']) ? mysqli_real_escape_string($conn, $_GET['barcode']) : '';
if (empty($sku)) {
    echo "<div class='alert alert-danger text-center mt-5'>Invalid or missing barcode.</div>";
    exit;
}
$result = mysqli_query($conn, "SELECT * FROM stocks WHERE bar = '$sku'");
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8"><title>Item Info</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>body{background:#f8f9fa;} .info-table{max-width:600px;margin:60px auto;box-shadow:0 0 10px rgba(0,0,0,0.1);} .info-table thead th{background:#343a40;color:#fff;} .info-table tbody td{background:#fff;}</style>
</head>
<body>
<div class="container">
  <?php
    $status = $_GET['status'] ?? '';
    switch ($status) {
      case 'success':
        echo "<div class='alert alert-success text-center mt-3'>✅ Request submitted successfully.</div>";
        break;
      case 'duplicate':
        echo "<div class='alert alert-warning text-center mt-3'>⚠️ Duplicate request detected for this item.</div>";
        break;
      case 'fail':
        echo "<div class='alert alert-danger text-center mt-3'>❌ Failed to submit request. Try again later.</div>";
        break;
      case 'not_found':
        echo "<div class='alert alert-danger text-center mt-3'>🚫 Item not found in inventory.</div>";
        break;
      case 'invalid_quantity':
        echo "<div class='alert alert-danger text-center mt-3'>⚠️ Invalid quantity entered.</div>";
        break;
    }
  ?>
</div>
<div class="container d-flex justify-content-center">
<?php if ($result && mysqli_num_rows($result) > 0): ?>
  <table class="table table-bordered info-table"><thead><tr><th colspan="2" class="text-center">📦 Item Information</th></tr></thead><tbody>
    <?php while ($d = mysqli_fetch_assoc($result)): ?>
      <tr><td><strong>Item</strong></td><td><?=htmlspecialchars($d['item'])?></td></tr>
      <tr><td><strong>SKU</strong></td><td><?=htmlspecialchars($d['bar'])?></td></tr>
      <tr><td><strong>Category</strong></td><td><?=htmlspecialchars($d['category'])?></td></tr>
      <tr><td><strong>Location</strong></td><td><?=htmlspecialchars($d['location'])?></td></tr>
      <tr><td><strong>Stock</strong></td><td><?=intval($d['stock'])?></td></tr>
      <?php if ((int)$d['stock'] < 49): ?>
        <tr><td colspan="2">
          <form method="POST" action="assets/request-stock.php" class="row g-2 align-items-end">
            <input type="hidden" name="item" value="<?=htmlspecialchars($d['item'])?>">
            <input type="hidden" name="sku" value="<?=htmlspecialchars($d['bar'])?>">
            <div class="col-md-6">
              <label class="form-label mb-0"><strong>Quantity to Request</strong></label>
              <input type="number" name="quantity" class="form-control" min="1" value="1" required>
            </div>
            <div class="col-md-6 d-grid">
              <button type="submit" name="reqbtn" class="btn btn-warning">Request New Stock</button>
            </div>
          </form>
        </td></tr>
      <?php endif; ?>
    <?php endwhile; ?>
  </tbody></table>
<?php else: ?>
  <div class="alert alert-warning text-center mt-5">No item found for barcode <strong><?=htmlspecialchars($sku)?></strong>.</div>
<?php endif; ?>
</div>
</body>
</html>
