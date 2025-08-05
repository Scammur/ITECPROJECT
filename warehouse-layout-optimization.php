<?php include "config/config.php";?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Warehouse Layout & Optimization | Inventory & Warehouse Management</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Bootstrap CSS CDN -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
    <!-- Font Awesome CDN -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
    <!-- Animate.css -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>

    <style>
        :root {
            --primary: #0d6efd;
            --warning: #ffc107;
            --success: #198754;
            --info: #0dcaf0;
        }
        
        html { scroll-behavior: smooth; }F
        body { font-family: 'Inter', Arial, sans-serif; background: #f4f4f4; }
        
        .navbar { background: #000 !important; }
        .navbar-brand, .nav-link, .navbar-text { color: #fff !important; font-weight: 500; font-size: 20px; }
        .nav-link.active, .nav-link:focus, .nav-link:hover { color: var(--warning) !important; }
        
        .section-title { font-size: 48px; font-weight: 600; letter-spacing: -0.02em; }
        
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
        .main-container.in-view { opacity: 1 !important; transform: none !important; }
        
        /* Warehouse map styles */
        .warehouse-map-container {
            background: #f8f9fa;
            border-radius: 10px;
            padding: 20px;
            box-shadow: 0 0 15px rgba(0,0,0,0.1);
            margin-bottom: 30px;
        }
        
        .warehouse-map {
            display: grid;
            grid-template-columns: repeat(14, 1fr);
            grid-template-rows: repeat(12, 1fr);
            gap: 4px;
            height: 650px;
            margin: 0 auto;
            max-width: 1000px;
        }
        
        .map-cell {
            background: #e9ecef;
            border-radius: 4px;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: all 0.3s ease;
            position: relative;
            cursor: pointer;
            font-size: 12px;
            text-align: center;
            overflow: hidden;
            border: 1px solid #ced4da;
        }
        
        .aisle { background: #f0f0f0; border: 1px dashed #bbb; }
        .unloading-dock { background: linear-gradient(135deg, #4CAF50, #8BC34A); }
        .loading-dock { background: linear-gradient(135deg, #FF9800, #FFC107); }
        .shelf { color: white; font-weight: 600; text-shadow: 0 1px 2px rgba(0,0,0,0.3); }
        
        .shelf:hover { transform: scale(1.05); box-shadow: 0 0 15px rgba(79, 172, 254, 0.7); z-index: 10; }
        
        .shelf-tooltip {
            position: absolute;
            background: rgba(30, 30, 46, 0.95);
            color: white;
            padding: 15px;
            border-radius: 10px;
            width: 300px;
            z-index: 100;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.5);
            display: none;
            border: 1px solid #4dabf7;
            top: calc(100% + 10px);
            left: 50%;
            transform: translateX(-50%);
        }
        
        .legend-color { width: 15px; height: 15px; border-radius: 3px; }
        
        .fade-in-element {
            opacity: 0;
            transform: translateY(40px);
            transition: opacity 1.1s cubic-bezier(0.23,1,0.32,1), transform 1.1s cubic-bezier(0.23,1,0.32,1);
        }
        .fade-in-element.in-view { opacity: 1; transform: none; }
        
        @media (max-width: 768px) {
            .warehouse-map {
                grid-template-columns: repeat(8, 1fr);
                grid-template-rows: repeat(18, 1fr);
                height: 800px;
            }
        }
    </style>
</head>
<body>
    <!-- Navigation -->
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
                    <li class="nav-item ms-lg-5">
                        <a class="nav-link" href="stock-tracking.php"><i class="fa-solid fa-cubes-stacked me-1"></i>Stock Tracking</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="inventory-valuation.php"><i class="fa-solid fa-coins me-1"></i>Inventory Valuation</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" href="warehouse-layout-optimization.php"><i class="fa-solid fa-sitemap me-1"></i>Warehouse Layout & Optimization</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="order-picking-packing-shipping.php"><i class="fa-solid fa-truck-ramp-box me-1"></i>Order Picking, Packing & Shipping</a>
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

    <div class="container mt-5 pt-5">
        <!-- Header -->
        <div class="row mb-4 animate__animated animate__fadeInLeft">
            <div class="col-12">
                <h1 class="section-title mb-2">
                    <i class="fa-solid fa-sitemap me-2"></i>Warehouse Layout & Optimization
                </h1>
                <p class="lead">
                    Maximize your warehouse space and efficiency with our optimized layout. Items are grouped by category for faster picking.
                </p>
            </div>
        </div>
        <hr class="my-4">
        
        <!-- Warehouse Map -->
        <div class="warehouse-map-container animate__animated animate__fadeInUp">
            <h3 class="text-center mb-4 pb-2 border-bottom">Interactive Warehouse Layout</h3>
            <div class="warehouse-map" id="warehouseMap"></div>
            
            <!-- Legend -->
            <div class="d-flex justify-content-center flex-wrap gap-3 mt-4">
                <?php 
                $categories = [
                    ['name' => 'Consumer Electronics', 'color' => 'linear-gradient(135deg, #4facfe, #00f2fe)'],
                    ['name' => 'Computer Hardware & Peripherals', 'color' => 'linear-gradient(135deg, #5a67d8, #9f7aea)'],
                    ['name' => 'Home Appliances', 'color' => 'linear-gradient(135deg, #ff6b6b, #ff9a9e)'],
                    ['name' => 'Industrial & Power Electronics', 'color' => 'linear-gradient(135deg, #48bb78, #81e6d9)'],
                    ['name' => 'Aisle', 'color' => '#f0f0f0', 'border' => '1px dashed #bbb'],
                    ['name' => 'Unloading Dock', 'color' => 'linear-gradient(135deg, #4CAF50, #8BC34A)'],
                    ['name' => 'Loading Dock', 'color' => 'linear-gradient(135deg, #FF9800, #FFC107)']
                ];
                
                foreach($categories as $category): ?>
                    <div class="d-flex align-items-center gap-2 bg-white rounded p-2 shadow-sm">
                        <div class="legend-color" style="background: <?= $category['color'] ?>; <?= isset($category['border']) ? 'border: '.$category['border'] : '' ?>"></div>
                        <span class="small"><?= $category['name'] ?></span>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
        
        <?php
        // Get all items from the database
        $itemsQuery = "SELECT * FROM stocks";
        $itemsResult = mysqli_query($conn, $itemsQuery);
        $allItems = [];
        $totalItems = 0;
        $totalValue = 0;
        
        while($item = mysqli_fetch_assoc($itemsResult)) {
            $allItems[] = $item;
            $totalItems += $item['stock'];
            $totalValue += $item['stock'] * $item['price'];
        }
        
        // Group items by location (rack)
        $itemsByLocation = [];
        foreach($allItems as $item) {
            $location = $item['location'];
            if(!isset($itemsByLocation[$location])) {
                $itemsByLocation[$location] = [];
            }
            $itemsByLocation[$location][] = $item;
        }
        
        // Get the number of locations
        $locationCount = count($itemsByLocation);
        ?>
        
        <!-- Stats Panel -->
        <div class="bg-light rounded p-4 my-4">
            <div class="row g-3">
                <div class="col-md-6 col-12">
                    <div class="bg-white rounded p-3 text-center shadow-sm h-100">
                        <i class="fas fa-boxes fa-2x text-primary mb-2"></i>
                        <div class="fs-2 fw-bold"><?= number_format($totalItems) ?></div>
                        <div class="text-secondary small">Total Items in Stock</div>
                    </div>
                </div>
                <div class="col-md-6 col-12">
                    <div class="bg-white rounded p-3 text-center shadow-sm h-100">
                        <i class="fas fa-warehouse fa-2x text-success mb-2"></i>
                        <div class="fs-2 fw-bold"><?= $locationCount ?></div>
                        <div class="text-secondary small">Active Racks</div>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Optimization Tips -->
        <div class="alert alert-warning border-start-4 border-warning">
            <h5><i class="fas fa-lightbulb me-2"></i>Optimization Tip</h5>
            <p class="mb-0">Our layout groups items by category to minimize travel time. We've implemented 20 distinct categories with unique color coding for easy visual identification.</p>
        </div>

        <!-- Content -->
        <div class="main-container fade-in-element">
            <div class="alert alert-primary d-flex align-items-center">
                <i class="fa-solid fa-lightbulb fa-2x me-3"></i>
                <div>
                    <strong>Tip:</strong> Organize your warehouse by grouping fast-moving items near packing and shipping areas to speed up order fulfillment!
                </div>
            </div>

            <h4 class="mb-3">Best Practices for Warehouse Layout & Optimization</h4>
            <ul class="list-group list-group-flush mb-4">
                <li class="list-group-item fade-in-element">
                    <i class="fa-solid fa-arrow-right text-primary me-2"></i>
                    <strong>Define clear zones:</strong> Separate receiving, storage, picking, packing, and shipping areas for smooth workflow.
                </li>
                <li class="list-group-item fade-in-element">
                    <i class="fa-solid fa-arrow-right text-primary me-2"></i>
                    <strong>Utilize vertical space:</strong> Install tall shelving and racks to maximize cubic storage.
                </li>
                <li class="list-group-item fade-in-element">
                    <i class="fa-solid fa-arrow-right text-primary me-2"></i>
                    <strong>Use logical item placement:</strong> Place high-turnover or heavy items closer to dispatch to reduce travel time and effort.
                </li>
                <li class="list-group-item fade-in-element">
                    <i class="fa-solid fa-arrow-right text-primary me-2"></i>
                    <strong>Label everything:</strong> Clear, consistent labeling minimizes picking errors and confusion.
                </li>
                <li class="list-group-item fade-in-element">
                    <i class="fa-solid fa-arrow-right text-primary me-2"></i>
                    <strong>Invest in technology:</strong> Use barcode scanners, WMS (Warehouse Management System), and digital maps for real-time optimization.
                </li>
                <li class="list-group-item fade-in-element">
                    <i class="fa-solid fa-arrow-right text-primary me-2"></i>
                    <strong>Keep aisles wide and clear:</strong> Ensure safe and efficient movement of people and equipment.
                </li>
                <li class="list-group-item fade-in-element">
                    <i class="fa-solid fa-arrow-right text-primary me-2"></i>
                    <strong>Review and improve:</strong> Regularly audit your layout and flow for bottlenecks and adjust as needed.
                </li>
            </ul>

            <div class="alert alert-info fade-in-element">
                <i class="fa-solid fa-circle-info me-2"></i>
                An optimized warehouse layout not only saves time but also reduces costs and improves safety!
            </div>
        </div>
    </div>

    <!-- Shelf Tooltip -->
    <div class="shelf-tooltip" id="shelfTooltip">
        <h3 id="shelfTitle" class="mb-3 pb-2 border-bottom">Shelf A-12</h3>
        <div class="shelf-items" id="shelfItems"></div>
    </div>

    <!-- Footer -->
    <footer class="bg-light py-5 mt-5">
        <div class="container text-center">
            &copy; <?= date("Y") ?> Xophia’s Inventory & Warehouse Management
        </div>
    </footer>

    <!-- Bootstrap JS Bundle -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    
    <script>
        // Animate on scroll
        function animateOnScroll(selector) {
            const elements = document.querySelectorAll(selector);
            function check() {
                const triggerBottom = window.innerHeight * 0.92;
                let delay = 0;
                elements.forEach((el) => {
                    const rect = el.getBoundingClientRect();
                    if(rect.top < triggerBottom && !el.classList.contains('in-view')) {
                        el.style.transitionDelay = (delay * 0.13) + "s";
                        el.classList.add('in-view');
                        delay++;
                    }
                });
            }
            window.addEventListener('scroll', check);
            document.addEventListener('DOMContentLoaded', check);
        }
        animateOnScroll('.fade-in-element');
        
    // Warehouse Map Generation
    document.addEventListener('DOMContentLoaded', function() {
        const warehouseMap = document.getElementById('warehouseMap');
        const tooltip = document.getElementById('shelfTooltip');
        
        // Enhanced warehouse layout data
        const layout = [
            ['A1', 'A1', 'aisle', 'B1', 'B1', 'aisle', 'C1', 'C1', 'aisle', 'D1', 'D1', 'aisle', 'E1', 'E1'],
            ['A2', 'A2', 'aisle', 'B2', 'B2', 'aisle', 'C2', 'C2', 'aisle', 'D2', 'D2', 'aisle', 'E2', 'E2'],
            ['aisle', 'aisle', 'aisle', 'aisle', 'aisle', 'aisle', 'aisle', 'aisle', 'aisle', 'aisle', 'aisle', 'aisle', 'aisle', 'aisle'],
            ['A3', 'A3', 'aisle', 'B3', 'B3', 'aisle', 'C3', 'C3', 'aisle', 'D3', 'D3', 'aisle', 'E3', 'E3'],
            ['A4', 'A4', 'aisle', 'B4', 'B4', 'aisle', 'C4', 'C4', 'aisle', 'D4', 'D4', 'aisle', 'E4', 'E4'],
            ['A5', 'A5', 'aisle', 'B5', 'B5', 'aisle', 'C5', 'C5', 'aisle', 'D5', 'D5', 'aisle', 'E5', 'E5'],
            ['aisle', 'aisle', 'aisle', 'aisle', 'aisle', 'aisle', 'aisle', 'aisle', 'aisle', 'aisle', 'aisle', 'aisle', 'aisle', 'aisle'],
            ['A6', 'A6', 'aisle', 'B6', 'B6', 'aisle', 'C6', 'C6', 'aisle', 'D6', 'D6', 'aisle', 'E6', 'E6'],
            ['A7', 'A7', 'aisle', 'B7', 'B7', 'aisle', 'C7', 'C7', 'aisle', 'D7', 'D7', 'aisle', 'E7', 'E7'],
            ['aisle', 'aisle', 'aisle', 'aisle', 'aisle', 'aisle', 'aisle', 'aisle', 'aisle', 'aisle', 'aisle', 'aisle', 'aisle', 'aisle'],
            ['unloading', 'unloading', 'aisle', 'loading', 'loading', 'aisle', 'exit', 'exit', 'aisle', 'loading', 'loading', 'aisle', 'unloading', 'unloading'],
        ];
        
        // Database items from PHP (converted to JSON)
        const dbItems = <?= json_encode($itemsByLocation) ?>;
        
        // Map database locations to our shelf identifiers
        const locationMap = {
            'RACK 1A': 'A1', 'RACK 2A': 'A2', 'RACK 3A': 'A3', 'RACK 4A': 'A4', 
            'RACK 5A': 'A5', 'RACK 6A': 'A6', 'RACK 7A': 'A7', 'RACK 1B': 'B1', 'RACK 2B': 'B2', 
            'RACK 3B': 'B3', 'RACK 4B': 'B4', 'RACK 5B': 'B5', 'RACK 6B': 'B6', 'RACK 7B': 'B7', 
            'RACK 1C': 'C1', 'RACK 2C': 'C2', 'RACK 3C': 'C3', 'RACK 4C': 'C4', 'RACK 5C': 'C5', 
            'RACK 6C': 'C6', 'RACK 7C': 'C7', 'RACK 1D': 'D1', 'RACK 2D': 'D2', 'RACK 3D': 'D3', 
            'RACK 4D': 'D4', 'RACK 5D': 'D5', 'RACK 6D': 'D6', 'RACK 7D': 'D7', 'RACK 1E': 'E1', 
            'RACK 2E': 'E2', 'RACK 3E': 'E3', 'RACK 4E': 'E4', 'RACK 5E': 'E5', 'RACK 6E': 'E6', 
            'RACK 7E': 'E7'
        };
        
        // Map categories to shelf colors - matching the PHP legend exactly
        const categoryColors = {
            'Consumer Electronics': 'linear-gradient(135deg, #4facfe, #00f2fe)',
            'Computer Hardware & Peripherals': 'linear-gradient(135deg, #5a67d8, #9f7aea)',
            'Home Appliances': 'linear-gradient(135deg, #ff6b6b, #ff9a9e)',
            'Industrial & Power Electronics': 'linear-gradient(135deg, #48bb78, #81e6d9)',
            'Other': 'linear-gradient(135deg, #6c757d, #adb5bd)' // Default color for other categories
        };
        
        // Create shelf items object
        const shelfItems = {};
        
        // Map database items to our shelf identifiers
        for (const [location, items] of Object.entries(dbItems)) {
            const shelfCode = locationMap[location] || location;
            const category = items[0]?.category || 'Other'; // Use the first item's category for the whole shelf
            
            // Find the matching color for this category
            let shelfColor = categoryColors['Other']; // Default color
            
            // Check each category key to see if it matches (case insensitive)
            for (const [catName, color] of Object.entries(categoryColors)) {
                if (category.toLowerCase().includes(catName.toLowerCase())) {
                    shelfColor = color;
                    break;
                }
            }
            
            if (!shelfItems[shelfCode]) {
                shelfItems[shelfCode] = {
                    items: [],
                    color: shelfColor,
                    category: category
                };
            }
            
            items.forEach(item => {
                shelfItems[shelfCode].items.push({
                    name: item.item,
                    quantity: item.stock,
                    category: item.category
                });
            });
        }
        
        // Generate the warehouse map
        layout.forEach(row => {
            row.forEach(cell => {
                if (!cell) return;
                
                const cellElement = document.createElement('div');
                cellElement.className = 'map-cell';
                
                if (cell === 'aisle') {
                    cellElement.classList.add('aisle');
                }
                else if (cell === 'exit') {
                    cellElement.classList.add('exit');
                    cellElement.textContent = 'EXIT';
                } 
                else if (cell === 'unloading') {
                    cellElement.classList.add('unloading-dock');
                    cellElement.textContent = 'UNLOADING DOCK';
                } 
                else if (cell === 'loading') {
                    cellElement.classList.add('loading-dock');
                    cellElement.textContent = 'LOADING DOCK';
                } 
                else {
                    const shelfData = shelfItems[cell] || {
                        items: [], 
                        color: categoryColors['Other'],
                        category: 'Other'
                    };
                    
                    cellElement.classList.add('shelf');
                    cellElement.style.background = shelfData.color;
                    cellElement.textContent = cell;
                    cellElement.dataset.shelf = cell;
                    cellElement.dataset.category = shelfData.category;
                    
                    // Add hover event for shelf
                    cellElement.addEventListener('mouseenter', function(e) {
                        const shelf = this.dataset.shelf;
                        const items = shelfItems[shelf]?.items || [];
                        
                        // Position tooltip
                        const rect = this.getBoundingClientRect();
                        tooltip.style.top = `${rect.bottom + window.scrollY + 10}px`;
                        tooltip.style.left = `${rect.left + window.scrollX}px`;
                        
                        // Update tooltip content
                        document.getElementById('shelfTitle').textContent = `Shelf ${shelf} (${this.dataset.category})`;
                        
                        const itemsContainer = document.getElementById('shelfItems');
                        itemsContainer.innerHTML = '';
                        
                        if (items.length > 0) {
                            items.forEach(item => {
                                const itemElement = document.createElement('div');
                                itemElement.className = 'd-flex justify-content-between py-2 border-bottom';
                                itemElement.innerHTML = `
                                    <span class="fw-medium">${item.name}</span>
                                    <span class="badge bg-info bg-opacity-25">${item.category}</span>
                                    <span class="badge bg-primary">${item.quantity} units</span>
                                `;
                                itemsContainer.appendChild(itemElement);
                            });
                        } else {
                            itemsContainer.innerHTML = '<div class="text-center py-3">No items in this shelf</div>';
                        }
                        
                        // Show tooltip
                        tooltip.style.display = 'block';
                    });
                    
                    cellElement.addEventListener('mouseleave', function() {
                        tooltip.style.display = 'none';
                    });
                }
                
                warehouseMap.appendChild(cellElement);
            });
        });
        
        // Close tooltip when mouse leaves
        tooltip.addEventListener('mouseleave', function() {
            this.style.display = 'none';
        });
    });
    </script>
</body>
</html>