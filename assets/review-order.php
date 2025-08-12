<?php
include '../config/config.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['order_id']) && isset($_POST['items'])) {
    $order_id = mysqli_real_escape_string($conn, $_POST['order_id']);
    $items = mysqli_real_escape_string($conn, $_POST['items']);
} else {
    die("Invalid access.");
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Review Order</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
</head>
<body class="bg-light">
    <div class="container mt-5">
        <div class="card shadow">
            <div class="card-header bg-primary text-white">
                <h5><i class="fa-solid"></i>Review Order <br> ID: <?php echo htmlspecialchars($order_id); ?><br>Items: <?php echo htmlspecialchars($items); ?></h5>
            </div>
            <div class="card-body">
                <form action="submit-review.php" method="POST">
                    <input type="hidden" name="order_number" value="<?php echo htmlspecialchars($order_id); ?>">
                    
                    <div class="mb-3">
                        <label for="rating" class="form-label">Rating (1 to 5)</label>
                        <select name="rating" id="rating" class="form-select" required>
                            <option value="">Choose...</option>
                            <?php for ($i = 1; $i <= 5; $i++): ?>
                                <option value="<?php echo $i; ?>"><?php echo str_repeat("⭐", $i); ?></option>
                            <?php endfor; ?>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label for="comment" class="form-label">Comments</label>
                        <textarea name="comment" id="comment" rows="4" class="form-control" placeholder="Share your experience..." required></textarea>
                    </div>

                    <button type="submit" class="btn btn-success">
                        <i class="fa-solid fa-paper-plane me-1"></i> Submit Review
                    </button>
                    <a href="../order-fulfillment.php" class="btn btn-secondary ms-2">Cancel</a>
                </form>
            </div>
        </div>
    </div>
</body>
</html>
