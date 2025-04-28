<div class="wrapper">
        <!-- Sidebar -->
        <nav class="sidebar">
            <div class="sidebar-header p-3">
                <a href="<?php echo base_url('/') ?>" class="d-flex align-items-center text-white text-decoration-none">
                    <span class="fs-4">Admin Panel</span>
                </a>
            </div>
            
            <ul class="nav flex-column">
                <li class="nav-item">
                    <a class="nav-link active" href="<?php echo base_url('/') ?>">
                        <i class="bi bi-speedometer2"></i>
                        Dashboard
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="<?php echo base_url('/users') ?>">
                        <i class="bi bi-person"></i>
                        Users
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="<?php echo base_url('/customers') ?>">
                        <i class="bi bi-people"></i>
                        Customers
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="<?php echo base_url('/orders') ?>">
                        <i class="bi bi-cart"></i>
                        Orders
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="<?php echo base_url('/products') ?>">
                        <i class="bi bi-gift"></i>
                        Products
                    </a>
                </li>

                <!-- 
                <li class="nav-item">
                    <a class="nav-link" href="#">
                        <i class="bi bi-graph-up"></i>
                        Reports
                    </a>
                </li> -->
                <li class="nav-item">
                    <a class="nav-link" href="#">
                        <i class="bi bi-gear"></i>
                        Settings
                    </a>
                </li>
            </ul>
        </nav>
        
        <!-- Mobile overlay (hidden by default) -->
        <div class="sidebar-overlay" id="sidebarOverlay"></div>