<?php
include '../config/config.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $order_number = mysqli_real_escape_string($conn, $_POST['order_number']);
    $rating = (int) $_POST['rating'];
    $comment = mysqli_real_escape_string($conn, $_POST['comment']);

    if ($rating < 1 || $rating > 5 || empty($comment)) {
        die("Invalid input.");
    }

    $query = "INSERT INTO order_reviews (order_number, rating, comment) 
              VALUES ('$order_number', $rating, '$comment')";
    
    if (mysqli_query($conn, $query)) {
        header("Location: ../order-fulfillment.php?review=success");
        exit;
    } else {
        echo "Error: " . mysqli_error($conn);
    }
} else {
    die("Invalid access.");
}
?>
