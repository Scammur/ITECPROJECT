<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Warehouse Layout & Optimization | Xophia’s Inventory & Warehouse</title>
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
            max-width: 1000px;
            background: #fff;
            padding: 2em;
            border-radius: 8px;
            box-shadow: 0 2px 8px 0 #00000011;
        }
        .divider {
            border-top: 1px solid #E6E6E6;
            margin: 2rem 0;
        }
        .tip-icon {
            color: #007bff;
            margin-right: 0.5rem;
        }
        .layout-img {
            max-width: 100%;
            border-radius: 8px;
            box-shadow: 0 1px 5px #0001;
            margin-bottom: 1rem;
        }
        .opt-list li {
            margin-bottom: 1rem;
            font-size: 1.1rem;
        }
        .highlight {
            background: #e7f5ff;
            border-left: 5px solid #0d6efd;
            padding: 1rem;
            border-radius: 5px;
            margin-bottom: 1.5rem;
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
                        <a class="nav-link" href="inventory-valuation.php">
                            <i class="fa-solid fa-coins me-1"></i>Inventory Valuation
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" href="warehouse-layout-optimization.php">
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
                    <i class="fa-solid fa-sitemap me-2"></i>Warehouse Layout & Optimization
                </div>
                <p class="lead">
                    Maximize your warehouse space and efficiency by optimizing your layout. Streamline processes, reduce travel time, and increase productivity.
                </p>
            </div>
        </div>
        <hr class="divider">

        <!-- Content -->
        <div class="main-container">
            <img src="https://images.unsplash.com/photo-1464983953574-0892a716854b?auto=format&fit=crop&w=900&q=80" alt="Warehouse Layout" class="layout-img mb-4">

            <div class="highlight d-flex align-items-center">
                <i class="fa-solid fa-lightbulb tip-icon fa-2x"></i>
                <div>
                    <strong>Tip:</strong> Organize your warehouse by grouping fast-moving items near packing and shipping areas to speed up order fulfillment!
                </div>
            </div>

            <h4 class="mb-3">Best Practices for Warehouse Layout & Optimization</h4>
            <ul class="opt-list">
                <li>
                    <i class="fa-solid fa-arrow-right text-primary me-2"></i>
                    <strong>Define clear zones:</strong> Separate receiving, storage, picking, packing, and shipping areas for smooth workflow.
                </li>
                <li>
                    <i class="fa-solid fa-arrow-right text-primary me-2"></i>
                    <strong>Utilize vertical space:</strong> Install tall shelving and racks to maximize cubic storage.
                </li>
                <li>
                    <i class="fa-solid fa-arrow-right text-primary me-2"></i>
                    <strong>Use logical item placement:</strong> Place high-turnover or heavy items closer to dispatch to reduce travel time and effort.
                </li>
                <li>
                    <i class="fa-solid fa-arrow-right text-primary me-2"></i>
                    <strong>Label everything:</strong> Clear, consistent labeling minimizes picking errors and confusion.
                </li>
                <li>
                    <i class="fa-solid fa-arrow-right text-primary me-2"></i>
                    <strong>Invest in technology:</strong> Use barcode scanners, WMS (Warehouse Management System), and digital maps for real-time optimization.
                </li>
                <li>
                    <i class="fa-solid fa-arrow-right text-primary me-2"></i>
                    <strong>Keep aisles wide and clear:</strong> Ensure safe and efficient movement of people and equipment.
                </li>
                <li>
                    <i class="fa-solid fa-arrow-right text-primary me-2"></i>
                    <strong>Review and improve:</strong> Regularly audit your layout and flow for bottlenecks and adjust as needed.
                </li>
            </ul>

            <div class="alert alert-info mt-4">
                <i class="fa-solid fa-circle-info me-2"></i>
                An optimized warehouse layout not only saves time but also reduces costs and improves safety!
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
</body>
</html>
