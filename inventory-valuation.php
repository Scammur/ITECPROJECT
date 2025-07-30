<?php
include "config/config.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Inventory Valuation | Inventory & Warehouse Management</title>
    <link rel="icon" href="img/ico/logo.ico">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Bootstrap CSS CDN -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">

    <!-- Font Awesome CDN -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">

    <!-- Google Fonts Inter (optional, fallback to sans-serif) -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">

    <!-- Animate.css CDN -->
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
            max-width: 900px;
            background: #fff;
            padding: 2em;
            border-radius: 8px;
            box-shadow: 0 2px 8px 0 #00000011;
        }
        .valuation-method {
            font-size: 20px;
            font-weight: 500;
        }
        .valuation-result {
            font-size: 24px;
            font-weight: 700;
            color: #1a7f37;
        }
        .table thead th {
            background: #363636;
            color: #fff;
            font-weight: 600;
        }
        .table tbody tr {
            background: #fff;
        }
        .table tbody tr:nth-child(even) {
            background: #f2f2f2;
        }
        .divider {
            border-top: 1px solid #E6E6E6;
            margin: 2rem 0;
        }
        /* Animation styles from index.php */
        .card-feature {
            border: 1px solid #E6E6E6;
            border-radius: 12px;
            padding: 32px 20px;
            background: #fff;
            box-shadow: 0 2px 6px 0 #00000011;
            opacity: 0;
            transform: translateY(40px);
            transition: opacity 0.7s, transform 0.7s;
        }
        .card-feature.in-view {
            opacity: 1;
            transform: none;
        }
        .section-image-animate {
            opacity: 0;
            transform: translateY(40px);
            transition: opacity 1.1s cubic-bezier(0.23,1,0.32,1), transform 1.1s cubic-bezier(0.23,1,0.32,1);
        }
        .section-image-animate.in-view {
            opacity: 1 !important;
            transform: none !important;
        }
    </style>
</head>
<body>
    <!-- Navigation Bar -->
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
                        <a class="nav-link" href="order-picking-packing-shipping.php"><i class="fa-solid fa-truck-ramp-box me-1"></i>Order Picking, Packing & Shipping</a>
                    </li>
                    <li>
                        <div class="nav-item dropdown me-3">
                            <a class="nav-link position-relative" href="#" id="notificationDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                <i class="fa-solid fa-bell"></i>
                                <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                                     <?php
                                     $quer = 'SELECT stock from stocks';
                                     $res = mysqli_query($conn,$quer);
                                     while($notif=mysqli_fetch_array($res)){
                                             $quer = 'SELECT count(stock) as con from stocks where stock < 49';
                                             $res = mysqli_query($conn,$quer);
                                             echo mysqli_fetch_array($res)['con'];
                                        }
                                     ?>
                                    <span class="visually-hidden">unread messages</span>
                                </span>
                            </a>
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
                                 <!--<hr class="dropdown-divider"></li>-->
                            </ul>
                        </div>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <!-- End Navigation -->

    <div class="container text-center" style="margin-top: 120px;">
        <!-- Section Title -->
        <div class="row mb-4">
            <div class="col-12 animate__animated animate__fadeInLeft">
                <div class="section-title mb-2">
                    <i class="fa-solid fa-coins me-2"></i>Inventory Valuation
                </div>
                <p class="lead">
                    The current Inventory Valuation
                </p>
            </div>
        </div>
        <!-- Divider -->
        <hr class="divider">

        <!-- Inventory Valuation Table -->
        <div class="main-container section-image-animate">
            <div class="table-responsive mb-4">
                <table class="table table-bordered align-middle">
                    <thead>
                        <tr>
                            <th scope="col"><i class="fa-solid fa-box"></i> Item</th>
                            <th scope="col"><i class="fa-solid fa-layer-group"></i> Category</th>
                            <th scope="col"><i class="fa-solid fa-warehouse"></i> Location</th>
                            <th scope="col"><i class="fa-solid fa-sort-numeric-up"></i> In Stock</th>
                            <th scope="col"><i class="fa-solid fa-money-bill-wave"></i> Unit Cost</th>
                            <th scope="col"><i class="fa-solid fa-calculator"></i> Total Value</th>
                        </tr>
                    </thead>
                    <tbody>
                        <!-- Example rows, replace with PHP & DB integration -->
                        <?php 
                                $query = "SELECT *, concat(price * stock) as totalCost FROM stocks";
                                $res = mysqli_query($conn, $query);
                                while ($data = mysqli_fetch_array($res)) {
                                    ?>
                                    <tr>
                                        <td><?php echo $data['item']; ?></td>
                                        <td><?php echo $data['category']; ?></td> 
                                        <td><?php echo $data['location']; ?></td> 
                                        <td><?php echo $data['stock']; ?></td>
                                        <td><?php echo $data['price']; ?></td>
                                        <td><?php echo $data['totalCost']; ?></td>
                                    </tr>
                                    <?php
                                    }
                        ?>
                    </tbody>
                    <tfoot>
                        <tr>
                            <th colspan="5" class="text-end">Total Inventory Value</th>
                            <?php
                                $query = "SELECT sum(price * stock) as totalval FROM stocks";
                                $res = mysqli_query($conn, $query);
                                while($data2 = mysqli_fetch_array($res)){
                                    ?>
                                    <th><?php echo $data2['totalval']?></th>
                                    <?php
                                }
                            ?>
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>

    <!-- Footer -->
    <footer class="bg-light text-dark py-5 mt-5">
        <div class="container">
            <div class="text-center">
                &copy; <?php echo date("Y"); ?> Inventory & Warehouse Management
            </div>
        </div>
    </footer>
    <!-- End Footer -->

    <!-- Bootstrap JS Bundle (with Popper) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Animate on scroll for .card-feature and .section-image-animate
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
        animateOnScroll('.card-feature');
        animateOnScroll('.section-image-animate');
    </script>
</body>
</html>