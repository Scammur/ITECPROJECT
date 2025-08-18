<?php
include 'config/config.php';

// Pagination variables
$limit = 10; // Number of records per page
$current_page = isset($_GET['page']) && is_numeric($_GET['page']) ? (int)$_GET['page'] : 1;
$offset = ($current_page - 1) * $limit;

// Get total number of orders
$total_orders_query = "SELECT COUNT(*) as total FROM orders";
$total_orders_result = mysqli_query($conn, $total_orders_query);
$total_rows = mysqli_fetch_assoc($total_orders_result)['total'];
$total_pages = ceil($total_rows / $limit);

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Order Fulfillment | Inventory & Warehouse Management</title>
    <link rel="icon" href="img/ico/logo.ico">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">

    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>

    <style>
        html {
            scroll-behavior: smooth;
        }
        body {
            font-family: 'Inter', Arial, sans-serif;
            background: #f4f4f4;
            color: #000;
        }

        .navbar {
            background: #000 !important;
        }
        .navbar-brand, .nav-link, .navbar-text {
            color: #fff !important;
            font-weight: 500;
            font-size: 20px;
        }
        .nav-link.active, .nav-link:focus, .nav-link:hover {
            color: #ffc107 !important;
        }
        .section-title {
            font-size: 48px;
            font-weight: 600;
            letter-spacing: -0.02em;
        }
        .main-container {
            margin: 2em auto;
            max-width: 1000px;
            background: #fff;
            padding: 2em;
            border-radius: 8px;
            box-shadow: 0 2px 8px 0 #00000011;
            opacity: 0;
            transform: translateY(40px);
            transition: opacity 1.1s cubic-bezier(0.23,1,0.32,1), transform 1.1s cubic-bezier(0.23,1,0.32,1);
        }
        .main-container.in-view {
            opacity: 1 !important;
            transform: none !important;
        }
        .divider {
            border-top: 1px solid #E6E6E6;
            margin: 2rem 0;
        }
        .process-step {
            margin-bottom: 2rem;
            opacity: 0;
            transform: translateY(40px);
            transition: opacity 0.7s, transform 0.7s;
        }
        .process-step.in-view {
            opacity: 1;
            transform: none;
        }
        .process-icon {
            font-size: 2rem;
            color: #0d6efd;
            margin-right: 1rem;
        }
        .highlight {
            background: #fff3cd;
            border-left: 5px solid #ffc107;
            padding: 1rem;
            border-radius: 5px;
            margin-bottom: 1.5rem;
            opacity: 0;
            transform: translateY(40px);
            transition: opacity 0.7s, transform 0.7s;
        }
        .highlight.in-view {
            opacity: 1;
            transform: none;
        }
        .example-table thead th {
            background: #363636;
            color: #fff;
            font-weight: 600;
        }
        .example-table tbody tr {
            background: #fff;
        }
        .example-table tbody tr:nth-child(even) {
            background: #f2f2f2;
        }
        .example-table tbody tr {
            opacity: 0;
            transform: translateY(40px);
            transition: opacity 0.7s, transform 0.7s;
        }
        .example-table tbody tr.in-view {
            opacity: 1;
            transform: none;
        }
        .alert-info.section-image-animate {
            opacity: 0;
            transform: translateY(40px);
            transition: opacity 1.1s cubic-bezier(0.23,1,0.32,1), transform 1.1s cubic-bezier(0.23,1,0.32,1);
        }
        .alert-info.section-image-animate.in-view {
            opacity: 1 !important;
            transform: none !important;
        }
    </style>
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark fixed-top py-3">
        <div class="container-fluid">
            <a class="navbar-brand ps-4" href="index.php">
              <i class="fa-solid fa-warehouse me-2"></i>Inventory & Warehouse Management
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
                <ul class="navbar-nav gap-3">
                    <li class="nav-item ms-5">
                        <a class="nav-link" href="stock-tracking.php"><i class="fa-solid fa-cubes-stacked me-1"></i>Stock Tracking</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="inventory-valuation.php"><i class="fa-solid fa-coins me-1"></i>Inventory Valuation</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="warehouse-layout-optimization.php"><i class="fa-solid fa-sitemap me-1"></i>Warehouse Layout & Optimization</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" href="order-fulfillment.php"><i class="fa-solid fa-truck-ramp-box me-1"></i>Order Fulfillment</a>
                    </li>
                    <li>
                        <div class="nav-item dropdown me-3">
                            <a class="nav-link position-relative" href="#" id="notificationDropdown" data-bs-toggle="dropdown" aria-expanded="false" onclick="markNotificationsSeen()">
                                <i class="fa-solid fa-bell"></i>
                                <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                                    <?php
                                    $query = "SELECT COUNT(*) as con FROM stocks WHERE stock < 49 AND notified = 0";
                                    $result = mysqli_query($conn, $query);
                                    echo mysqli_fetch_array($result)['con'];
                                    ?>
                                    <span class="visually-hidden">unread messages</span>
                                </span>
                            </a>
                             <script>
                                 function markNotificationsSeen() {
                                     fetch('assets/msee.php', {
                                         method: 'POST'
                                     }).then(() => {
                                         document.querySelector('.badge').textContent = '0';
                                     });
                                 }
                            </script>
                            <ul class="dropdown-menu dropdown-menu-end animate__animated animate__fadeIn" aria-labelledby="notificationDropdown" style="min-width: 300px;">
                                <li><h6 class="dropdown-header">Notifications</h6></li>
                                <?php
                                $quer = 'SELECT item, stock from stocks';
                                $res = mysqli_query($conn,$quer);
                                while($notif=mysqli_fetch_array($res)){
                                    if($notif['stock'] > 0 && $notif['stock'] <=49) {
                                        ?>
                                        <li><a class="dropdown-item" href="stock-tracking.php">⚠️Low stock alert: <?php echo $notif['item'];?></a></li>
                                        <?php
                                    }elseif($notif['stock'] == 0){
                                        ?>
                                        <li><a class="dropdown-item" href="stock-tracking.php">⚠️No Stock alert: <?php echo $notif['item'];?></a></li>
                                        <?php
                                    }
                                }
                                ?>
                                 </ul>
                        </div>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <div class="container" style="margin-top: 120px;">
        <div class="row mb-4">
            <div class="col-12 animate__animated animate__fadeInLeft">
                <div class="section-title mb-2">
                    <i class="fa-solid fa-truck-ramp-box me-2"></i>Order Fulfillment
                </div>
                <p class="lead">
                    Track and manage orders.
                </p>
            </div>
        </div>
        <hr class="divider">

            <h5 class="mb-3 mt-5">Order Fulfillment</h5>
            <div class="table-responsive mb-4">
                <table class="table table-bordered align-middle example-table">
                    <thead>
                        <tr>
                            <th>Order #</th>
                            <th>Date Ordered</th>
                            <th>Items</th>
                            <th>Order Status</th>
                            <th>Shipping Status</th>
                            <th>Date Received</th>
                            <th>Review & Ratings</th>
                        </tr>
                    </thead>
                    <tbody>
                            <?php
                            $quer = "SELECT * FROM orders ORDER BY date_ordered DESC LIMIT $limit OFFSET $offset";
                            $res = mysqli_query($conn, $quer);
                            while ($l = mysqli_fetch_array($res)) {  
                                ?>
                                <tr>
                                    <td class="text-center fw-bold text-nowrap"><?php echo $l['order_number']; ?></td>
                                    <td class="text-center text-nowrap"><?php echo $l['date_ordered']; ?></td>
                                    <td class="text-center"><?php echo $l['items']; ?></td>
                                    <td class="text-center fw-semibold 
                                    <?php echo ($l['order_status'] == 'Confirmed') ? 'text-success' : (($l['order_status'] == 'Pending') ? 'text-warning' : 'text-danger'); ?>">
                                    <?php echo $l['order_status']; ?>
                                    </td>
                                    <td class="text-center fw-semibold 
                                    <?php echo ($l['shipping_status'] == 'Delivered') ? 'text-success' : (($l['shipping_status'] == 'Packed') ? 'text-warning' : (($l['shipping_status'] == "Pending") ? 'text-danger' : 'text-secondary')); ?>">
                                    <?php echo $l['shipping_status']; ?>
                                    </td>
                                    <td class="text-center text-nowrap"><?php echo $l['date_received']; ?></td>
                                    <td class="text-center">
                                        <form method="POST" action="assets/review-order.php">
                                            <input type="hidden" name="order_id" value="<?php echo $l['order_number']; ?>">
                                            <input type="hidden" name="items" value="<?php echo htmlspecialchars($l['items']); ?>">
                                            <button type="submit" class="btn btn-outline-primary btn-sm px-3 py-1 rounded-pill shadow-sm">
                                                <i class="fa-solid fa-star me-1"></i> Review
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                                <?php
                            }
                            ?>

                    </tbody>
                </table>
            </div> 
        
        <nav aria-label="Page navigation">
            <ul class="pagination justify-content-center">
                <li class="page-item <?php if ($current_page <= 1) echo 'disabled'; ?>">
                    <a class="page-link" href="?page=<?php echo $current_page - 1; ?>">Previous</a>
                </li>
                <?php for ($i = 1; $i <= $total_pages; $i++) : ?>
                    <li class="page-item <?php if ($i == $current_page) echo 'active'; ?>">
                        <a class="page-link" href="?page=<?php echo $i; ?>"><?php echo $i; ?></a>
                    </li>
                <?php endfor; ?>
                <li class="page-item <?php if ($current_page >= $total_pages) echo 'disabled'; ?>">
                    <a class="page-link" href="?page=<?php echo $current_page + 1; ?>">Next</a>
                </li>
            </ul>
        </nav>
            
    </div>
    <footer class="bg-light text-dark py-5 mt-5">
        <div class="container">
            <div class="text-center mt-4">
                &copy; <?php echo date("Y"); ?> Inventory & Warehouse Management
            </div>
        
    </footer>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Animate on scroll for .main-container, .highlight, .process-step, .example-table tbody tr, and .section-image-animate
        function animateOnScroll(selector, className = 'in-view') {
            const elements = document.querySelectorAll(selector);
            function check() {
                const triggerBottom = window.innerHeight * 0.92;
                let delay = 0;
                elements.forEach((el, idx) => {
                    const rect = el.getBoundingClientRect();
                    if(rect.top < triggerBottom && !el.classList.contains(className)) {
                        el.style.transitionDelay = (delay * 0.13) + "s";
                        el.classList.add(className);
                        delay++;
                    }
                });
            }
            window.addEventListener('scroll', check);
            document.addEventListener('DOMContentLoaded', check);
        }
        animateOnScroll('.main-container');
        animateOnScroll('.highlight');
        animateOnScroll('.process-step');
        animateOnScroll('.example-table tbody tr');
        animateOnScroll('.section-image-animate');
    </script>
</body>
</html>