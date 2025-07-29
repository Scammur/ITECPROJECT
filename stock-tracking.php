<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Stock Tracking | Xophia’s Inventory & Warehouse</title>
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
        .stock-status.in-stock {
            color: #28a745;
            font-weight: 600;
        }
        .stock-status.low-stock {
            color: #ffc107;
            font-weight: 600;
        }
        .stock-status.out-stock {
            color: #dc3545;
            font-weight: 600;
        }
        .main-container {
            margin: 2em auto;
            max-width: 1100px;
            background: #fff;
            padding: 2em;
            border-radius: 8px;
            box-shadow: 0 2px 8px 0 #00000011;
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
            <a class="navbar-brand" href="index.php">
                <i class="fa-solid fa-warehouse me-2 ps-4"></i>Xophia’s Inventory & Warehouse
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
                <ul class="navbar-nav gap-3">
                    <li class="nav-item">
                        <a class="nav-link active" href="stock-tracking.php">
                            <i class="fa-solid fa-cubes-stacked me-1"></i>Stock Tracking
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="inventory-valuation.php">
                            <i class="fa-solid fa-coins me-1"></i>Inventory Valuation
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="warehouse-layout-optimization.php">
                            <i class="fa-solid fa-sitemap me-1"></i>Warehouse Layout & Optimization
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="order-picking-packing-shipping.php">
                            <i class="fa-solid fa-truck-ramp-box me-1"></i>Order Picking, Packing & Shipping
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <!-- End Navigation -->

    <div class="container" style="margin-top: 120px;">
        <!-- Section Title -->
        <div class="row mb-4">
            <div class="col-12 animate__animated animate__fadeInLeft">
                <div class="section-title mb-2"><i class="fa-solid fa-cubes-stacked me-2"></i>Stock Tracking</div>
                <p class="lead">Monitor your inventory levels, stock movements, and status in real time.</p>
            </div>
        </div>
        <!-- Divider -->
        <hr class="divider">

        <!-- Stock Table -->
        <div class="main-container section-image-animate">
            <div class="d-flex justify-content-between align-items-center mb-3">
                <h4>Current Stock Levels</h4>
                <a href="#" class="btn btn-primary">
                    <i class="fa fa-plus"></i> Add New Item
                </a>
            </div>
            <div class="table-responsive">
                <table class="table table-bordered align-middle">
                    <thead>
                        <tr>
                            <th scope="col"><i class="fa-solid fa-box"></i> Item</th>
                            <th scope="col"><i class="fa-solid fa-barcode"></i> SKU</th>
                            <th scope="col"><i class="fa-solid fa-layer-group"></i> Category</th>
                            <th scope="col"><i class="fa-solid fa-warehouse"></i> Location</th>
                            <th scope="col"><i class="fa-solid fa-sort-numeric-up"></i> In Stock</th>
                            <th scope="col"><i class="fa-solid fa-bolt"></i> Status</th>
                            <th scope="col"><i class="fa-solid fa-ellipsis-h"></i> Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        <!-- Example rows, replace with PHP & DB integration -->
                        <tr class="card-feature">
                            <td>Widget A</td>
                            <td>SKU-001</td>
                            <td>Electronics</td>
                            <td>Rack 1A</td>
                            <td>120</td>
                            <td><span class="stock-status in-stock"><i class="fa-solid fa-circle"></i> In Stock</span></td>
                            <td>
                                <a href="#" class="btn btn-sm btn-outline-info"><i class="fa fa-eye"></i></a>
                                <a href="#" class="btn btn-sm btn-outline-warning"><i class="fa fa-edit"></i></a>
                                <a href="#" class="btn btn-sm btn-outline-danger"><i class="fa fa-trash"></i></a>
                            </td>
                        </tr>
                        <tr class="card-feature">
                            <td>Box B</td>
                            <td>SKU-002</td>
                            <td>Packaging</td>
                            <td>Rack 2B</td>
                            <td>12</td>
                            <td><span class="stock-status low-stock"><i class="fa-solid fa-triangle-exclamation"></i> Low Stock</span></td>
                            <td>
                                <a href="#" class="btn btn-sm btn-outline-info"><i class="fa fa-eye"></i></a>
                                <a href="#" class="btn btn-sm btn-outline-warning"><i class="fa fa-edit"></i></a>
                                <a href="#" class="btn btn-sm btn-outline-danger"><i class="fa fa-trash"></i></a>
                            </td>
                        </tr>
                        <tr class="card-feature">
                            <td>Envelope C</td>
                            <td>SKU-003</td>
                            <td>Mailers</td>
                            <td>Rack 3C</td>
                            <td>0</td>
                            <td><span class="stock-status out-stock"><i class="fa-solid fa-xmark-circle"></i> Out of Stock</span></td>
                            <td>
                                <a href="#" class="btn btn-sm btn-outline-info"><i class="fa fa-eye"></i></a>
                                <a href="#" class="btn btn-sm btn-outline-warning"><i class="fa fa-edit"></i></a>
                                <a href="#" class="btn btn-sm btn-outline-danger"><i class="fa fa-trash"></i></a>
                            </td>
                        </tr>
                        <!-- Add more example rows as needed -->
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Footer -->
    <footer class="bg-light text-dark py-5 mt-5">
        <div class="container">
            <div class="text-center">
                &copy; <?php echo date("Y"); ?> Xophia’s Inventory & Warehouse Management
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