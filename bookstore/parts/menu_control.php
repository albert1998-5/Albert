<div id="content">
    <div id="menu">
        <!-- Sidebar -->
        <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

            <!-- Tables Buttons -->
            <li class="nav-item">
                <a class="nav-link" href="customer.php">
                    <i class="fas fa-fw fa-user"></i>
                    <span>會員資料</span></a>
            </li>

            <li class="nav-item">
                <a class="nav-link" href="employee.php">
                    <i class="fas fa-fw fa-user"></i>
                    <span>員工資料</span></a>
            </li>

            <li class="nav-item">
                <a class="nav-link" href=<?php echo $root_cust . "/results/control/productbe/product.php"; ?>>
                    <i class="fas fa-fw fa-table"></i>
                    <span>商品列表</span></a>
            </li>

            <li class="nav-item">
            <a class="nav-link" href=<?php echo $root_cust . "/results/control/stock_erp/stock_list.php"; ?>>
                    <i class="fas fa-fw fa-archive"></i>
                    <span>庫存列表</span></a>
            </li>

            <li class="nav-item">
                <a class="nav-link" href="transaction.php">
                    <i class="fas fa-fw fa-retweet"></i>
                    <span>交易紀錄</span></a>
            </li>

            <li class="nav-item">
                <a class="nav-link" href="supplier.php">
                    <i class="fas fa-fw fa-cogs"></i>
                    <span>供應商</span></a>
            </li>

            <li class="nav-item">
                <a class="nav-link" href="user.php">
                    <i class="fas fa-fw fa-users"></i>
                    <span>帳目</span></a>
            </li>
            <!-- Divider -->
            <hr class="sidebar-divider d-none d-md-block">

            <!-- Sidebar Toggler (Sidebar) -->
            <div class="text-center d-none d-md-inline">
                <button class="rounded-circle border-0" id="sidebarToggle"></button>
            </div>

        </ul>
        <!-- End of Sidebar -->

    </div>
    <!-- menu_end -->

    <div id="main">