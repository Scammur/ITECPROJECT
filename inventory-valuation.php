<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Inventory Valuation | Xophia’s Inventory & Warehouse</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Bootstrap CSS CDN -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">

    <!-- Font Awesome CDN -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">

    <!-- Google Fonts Inter (optional, fallback to sans-serif) -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">

    <style>
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
    </style>
</head>
<body>
    <!-- Navigation Bar -->
    <nav class="navbar navbar-expand-lg navbar-dark fixed-top py-3">
        <div class="container-fluid">
            <a class="navbar-brand ps-3" href="index.php">
                <i class="fa-solid fa-warehouse me-2"></i>Inventory & Warehouse Management
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
                <ul class="navbar-nav gap-3">
                    <li class="nav-item">
                        <a class="nav-link" href="stock-tracking.php">
                            <i class="fa-solid fa-cubes-stacked me-1"></i>Stock Tracking
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" href="inventory-valuation.php">
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
            <div class="col-12">
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
        <div class="main-container">
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
                        <tr>
                            <td>Mouse</td>
                            <td>Electronics</td>
                            <td>Rack 1A</td>
                            <td>120</td>
                            <td>350.00</td>
                            <td>42,000.00</td>
                        </tr>
                        <tr>
                            <td>Box B</td>
                            <td>Packaging</td>
                            <td>Rack 2B</td>
                            <td>12</td>
                            <td>25.00</td>
                            <td>300.00</td>
                        </tr>
                        <tr>
                            <td>Envelope C</td>
                            <td>Mailers</td>
                            <td>Rack 3C</td>
                            <td>0</td>
                            <td>10.00</td>
                            <td>0.00</td>
                        </tr>
                        <tr>
                            <td>Stapler</td>
                            <td>Stationary</td>
                            <td>Rack 3B</td>
                            <td>50</td>
                            <td>100.00</td>
                            <td>5,000.00</td>
                        </tr>
                        <tr>
                            <td>Ballpoint Pen Red</td>
                            <td>Stationary</td>
                            <td>Rack 3D</td>
                            <td>600</td>
                            <td>12.00</td>
                            <td>7,200.00</td>
                        </tr>
                        <tr>
                            <td>Syringe 5cc</td>
                            <td>Medical</td>
                            <td>Rack 7A</td>
                            <td>100</td>
                            <td>10.00</td>
                            <td>1000.00</td>
                        </tr>
                    </tbody>
                    <tfoot>
                        <tr>
                            <th colspan="6" class="text-end">Total Inventory Value</th>
                            <th class="valuation-result">55,500.00</th>
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
                &copy; <?php echo date("Y"); ?> Xophia’s Inventory & Warehouse Management
            </div>
        </div>
    </footer>
    <!-- End Footer -->

    <!-- Bootstrap JS Bundle (with Popper) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    
