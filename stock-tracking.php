<?php include "config/config.php"; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Stock Tracking | Inventory & Warehouse Management</title>
    <link rel="icon" href="img/ico/logo.ico">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Bootstrap CSS CDN -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">

    <!-- Font Awesome CDN -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">

    <!-- DataTables CSS -->
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.7/css/dataTables.bootstrap5.min.css">

    <!-- Google Fonts Inter -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">

    <!-- Animate.css CDN -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>

    <style>
        :root {
            --primary: #0d6efd;
            --warning: #ffc107;
            --success: #198754;
            --info: #0dcaf0;
        }
        
        html { scroll-behavior: smooth; }
        body { 
            font-family: 'Inter', Arial, sans-serif;
            background: #f4f4f4;
            color: #000;
        }
        footer{
            position: absolute;
            bottom: 0;
            left: 0;
            right: 0;
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
            color: var(--warning) !important;
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
            cursor: pointer;
            position: relative;
        }
        .table thead th:hover {
            background: #2a2a2a;
        }
        .table thead th.sorting:after,
        .table thead th.sorting_asc:after,
        .table thead th.sorting_desc:after {
            font-family: "Font Awesome 6 Free";
            font-weight: 900;
            margin-left: 8px;
            opacity: 0.7;
        }
        .table thead th.sorting:after {
            content: "\f0dc";
        }
        .table thead th.sorting_asc:after {
            content: "\f0de";
        }
        .table thead th.sorting_desc:after {
            content: "\f0dd";
        }
        
        .table tbody tr {
            background: #fff;
        }
        .table tbody tr:nth-child(even) {
            background: #f2f2f2;
        }
        
        .stock-status.in-stock {
            color: var(--success);
            font-weight: 600;
        }
        .stock-status.low-stock {
            color: var(--warning);
            font-weight: 600;
        }
        .stock-status.out-stock {
            color: #dc3545;
            font-weight: 600;
        }
        
        .main-container {
            margin: 2em auto;
            max-width: 2000px;
            background: #fff;
            padding: 2em;
            border-radius: 8px;
            box-shadow: 0 2px 8px 0 #00000011;
        }
        
        .divider {
            border-top: 1px solid #E6E6E6;
            margin: 2rem 0;
        }
        
        /* Custom DataTables controls styling */
        .dataTables_wrapper .dataTables_length {
            display: inline-block;
            margin-right: 20px;
        }

        .dataTables_wrapper .dataTables_length select {
            -webkit-appearance: none;
            -moz-appearance: none;
            appearance: none;
            padding-right: 25px;
            background-image: none;
            border: 1px solid #ced4da;
            border-radius: 4px;
            padding: 0.375rem 1.75rem 0.375rem 0.75rem;
        }

        .dataTables_wrapper .dataTables_filter {
            display: inline-block;
            margin-left: 0;
        }

        .dataTables_wrapper .dataTables_filter input {
            border: 1px solid #ced4da;
            border-radius: 4px;
            padding: 0.375rem 0.75rem;
        }

        .dataTables_wrapper .top {
            display: flex;
            align-items: center;
            margin-bottom: 15px;
            flex-wrap: wrap;
            gap: 10px;
        }

        .dataTables_wrapper .dataTables_paginate .paginate_button {
            padding: 0.25rem 0.75rem;
            border: 1px solid transparent;
            border-radius: 4px;
            margin-left: 2px;
        }
        .dataTables_wrapper .dataTables_paginate .paginate_button.current,
        .dataTables_wrapper .dataTables_paginate .paginate_button.current:hover {
            background: var(--primary);
            color: white !important;
            border: 1px solid var(--primary);
        }
        .dataTables_wrapper .dataTables_paginate .paginate_button:hover {
            background: #e9ecef;
            border: 1px solid #dee2e6;
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
                        <a class="nav-link active" href="stock-tracking.php"><i class="fa-solid fa-cubes-stacked me-1"></i>Stock Tracking</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="inventory-valuation.php"><i class="fa-solid fa-coins me-1"></i>Inventory Valuation</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="warehouse-layout-optimization.php"><i class="fa-solid fa-sitemap me-1"></i>Warehouse Layout & Optimization</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="order-fulfillment.php"><i class="fa-solid fa-truck-ramp-box me-1"></i>Order Fulfillment</a>
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
    <!-- End Navigation -->

    <div class="container" style="margin-top: 120px;">
        <?php if (isset($_GET['deleted']) && $_GET['deleted'] == 1): ?>
        <div class="alert alert-success alert-dismissible fade show" role="alert">
        Item successfully deleted.
        <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
        </div>
        <?php endif; ?>

        <div class="row mb-4">
            <div class="col-12 animate__animated animate__fadeInLeft">
                <div class="section-title mb-2"><i class="fa-solid fa-cubes-stacked me-2"></i>Stock Tracking</div>
                <p class="lead">Monitor your inventory levels, stock movements, and status in real time.</p>
            </div>
        </div>
        
        <hr class="divider">

        <!-- Stock Table -->
        <div class="main-container section-image-animate">
            <div class="d-flex justify-content-between align-items-center mb-3">
                <h4>Current Stock Levels</h4>
                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addItemModal">
                    <i class="fa fa-plus"></i> Add New Item
                </button>
            </div>
            
            <div class="table-responsive">
                <table class="table table-bordered align-middle" id="stockTable">
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
                        <?php
                        $quer = "SELECT * FROM stocks";
                        $res = mysqli_query($conn, $quer);
                        while($data = mysqli_fetch_array($res)){
                            $status_class = '';
                            $status_icon = '';
                            $status_text = '';
                            
                            if($data['stock'] == 0){
                                $status_class = 'out-stock';
                                $status_icon = 'fa-xmark-circle';
                                $status_text = 'Out of Stock';
                            } elseif($data['stock'] > 50){
                                $status_class = 'in-stock';
                                $status_icon = 'fa-circle';
                                $status_text = 'In Stock';
                            } else {
                                $status_class = 'low-stock';
                                $status_icon = 'fa-triangle-exclamation';
                                $status_text = 'Low Stock';
                            }
                            ?>
                            <tr>
                                <td><?php echo htmlspecialchars($data['item']); ?></td>
                                <td><?php echo htmlspecialchars($data['bar']); ?></td>
                                <td><?php echo htmlspecialchars($data['category']); ?></td>
                                <td><?php echo htmlspecialchars($data['location']); ?></td>
                                <td data-order="<?php echo $data['stock']; ?>"><?php echo $data['stock']; ?></td>
                                <td data-order="<?php echo $data['stock']; ?>">
                                    <span class="stock-status <?php echo $status_class; ?>">
                                        <i class="fa-solid <?php echo $status_icon; ?>"></i> <?php echo $status_text; ?>
                                    </span>
                                </td>
                                <td>
                                    <a href="view.php?barcode=<?php echo urlencode($data['bar']); ?>" class="btn btn-sm btn-outline-info"><i class="fa fa-eye"></i></a>
                                    <a href="edit.php?barcode=<?php echo urlencode($data['bar']); ?>" class="btn btn-sm btn-outline-warning"><i class="fa fa-edit"></i></a>
                                    <a href="delete.php?barcode=<?php echo urlencode($data['bar']); ?>" class="btn btn-sm btn-outline-danger" onclick="return confirm('Are you sure you want to delete this item?');">
                                        <i class="fa fa-trash"></i>
                                    </a>
                                </td>
                            </tr>
                            <?php
                        } 
                        ?>
                    </tbody>
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

    <!-- Add Item Modal -->
    <div class="modal fade" id="addItemModal" tabindex="-1" aria-labelledby="addItemModalLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <form method="POST" action="assets/stockadd.php" id="addItemForm">
            <div class="modal-header">
              <h5 class="modal-title" id="addItemModalLabel">Add New Stock Item</h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
              <div class="mb-3">
                <label for="item" class="form-label">Item Name</label>
                <input type="text" class="form-control" name="item" required>
              </div>
              <div class="mb-3">
                <label for="sku" class="form-label">SKU</label>
                <input type="text" class="form-control" name="sku" id="skuInput" required>
                <div class="invalid-feedback" id="skuFeedback">This SKU already exists</div>
              </div>
              <div class="mb-3">
                <label for="category" class="form-label">Category</label>
                <select class="form-select" name="category" required>
                  <option value="" selected disabled>Select a category</option>
                  <option value="Consumer Electronics">Consumer Electronics</option>
                  <option value="Computer Hardware & Peripherals">Computer Hardware & Peripherals</option>
                  <option value="Home Appliances">Home Appliances</option>
                  <option value="Industrial & Power Electronics">Industrial & Power Electronics</option>
                </select>
              </div>
              <div class="mb-3">
                <label for="location" class="form-label">Location</label>
                <select class="form-select" name="location" required>
                  <option value="" selected disabled>Select a location</option>
                  <option value="RACK 1A">A1</option>
                  <option value="RACK 2A">A2</option>
                  <option value="RACK 3A">A3</option>
                  <option value="RACK 4A">A4</option>
                  <option value="RACK 5A">A5</option>
                  <option value="RACK 6A">A6</option>
                  <option value="RACK 7A">A7</option>
                  <option value="RACK 1B">B1</option>
                  <option value="RACK 2B">B2</option>
                  <option value="RACK 3B">B3</option>
                  <option value="RACK 4B">B4</option>
                  <option value="RACK 5B">B5</option>
                  <option value="RACK 6B">B6</option>
                  <option value="RACK 7B">B7</option>
                  <option value="RACK 1C">C1</option>
                  <option value="RACK 2C">C2</option>
                  <option value="RACK 3C">C3</option>
                  <option value="RACK 4C">C4</option>
                  <option value="RACK 5C">C5</option>
                  <option value="RACK 6C">C6</option>
                  <option value="RACK 7C">C7</option>
                  <option value="RACK 1D">D1</option>
                  <option value="RACK 2D">D2</option>
                  <option value="RACK 3D">D3</option>
                  <option value="RACK 4D">D4</option>
                  <option value="RACK 5D">D5</option>
                  <option value="RACK 6D">D6</option>
                  <option value="RACK 7D">D7</option>
                  <option value="RACK 1E">E1</option>
                  <option value="RACK 2E">E2</option>
                  <option value="RACK 3E">E3</option>
                  <option value="RACK 4E">E4</option>
                  <option value="RACK 5E">E5</option>
                  <option value="RACK 6E">E6</option>
                  <option value="RACK 7E">E7</option>
                </select>
              </div>
              <div class="mb-3">
                <label for="stock" class="form-label">Stock Quantity</label>
                <input type="number" class="form-control" name="stock" required>
              </div>
              <div class="mb-3">
                <label for="price" class="form-label">Price</label>
                <input type="text" class="form-control" name="price" required>
              </div>
            </div>
            <div class="modal-footer">
              <button type="submit" name="addItem" class="btn btn-success" id="submitBtn">Add Item</button>
            </div>
          </form>
        </div>
      </div>
    </div>

    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    
    <!-- Bootstrap JS Bundle (with Popper) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    
    <!-- DataTables JS -->
    <script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.7/js/dataTables.bootstrap5.min.js"></script>
    
    <script>
        // Initialize DataTable with sorting and search functionality
        $(document).ready(function() {
            var table = $('#stockTable').DataTable({
                responsive: true,
                dom: '<"top"lf>rt<"bottom"ip>',
                language: {
                    search: "_INPUT_",
                    searchPlaceholder: "Search items...",
                    lengthMenu: "Show _MENU_ entries",
                    paginate: {
                        previous: '<i class="fa-solid fa-chevron-left"></i>',
                        next: '<i class="fa-solid fa-chevron-right"></i>'
                    }
                },
                columnDefs: [
                    { orderable: true, targets: [0, 1, 2, 3, 4, 5] },
                    { orderable: false, targets: [6] }
                ],
                initComplete: function() {
                    // Remove dropdown arrow from length menu
                    $('.dataTables_length select').removeClass('form-select-sm').addClass('form-select');
                    $('.dataTables_filter input').removeClass('form-control-sm').addClass('form-control');
                    
                    // Custom styling for controls container
                    $('.dataTables_wrapper .top').css({
                        'display': 'flex',
                        'align-items': 'center',
                        'flex-wrap': 'wrap',
                        'gap': '10px'
                    });
                }
            });
            
            // Add custom sorting for the Status column (based on stock numbers)
            table.on('order.dt search.dt', function() {
                table.column(5, {search:'applied', order:'applied'}).nodes().each(function(cell, i) {
                    cell.setAttribute('data-order', $(cell).find('.stock-status').data('order'));
                });
            }).draw();
            
            // SKU validation for the add item modal
            const skuInput = document.getElementById('skuInput');
            const skuFeedback = document.getElementById('skuFeedback');
            const submitBtn = document.getElementById('submitBtn');
            const form = document.getElementById('addItemForm');
            
            skuInput.addEventListener('change', function() {
                checkSKU(this.value);
            });
            
            form.addEventListener('submit', function(e) {
                if (skuInput.classList.contains('is-invalid')) {
                    e.preventDefault();
                    skuFeedback.style.display = 'block';
                }
            });
            
            function checkSKU(sku) {
                if (!sku) return;
                
                fetch('check_sku.php?sku=' + encodeURIComponent(sku))
                    .then(response => response.json())
                    .then(data => {
                        if (data.exists) {
                            skuInput.classList.add('is-invalid');
                            skuFeedback.style.display = 'block';
                            submitBtn.disabled = true;
                        } else {
                            skuInput.classList.remove('is-invalid');
                            skuFeedback.style.display = 'none';
                            submitBtn.disabled = false;
                        }
                    });
            }
        });
    </script>
</body>

</html>
