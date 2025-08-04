<?php
include "../config/config.php";

$query = "UPDATE stocks SET notified = 1 WHERE stock < 49 AND notified = 0";
mysqli_query($conn, $query);
?>
