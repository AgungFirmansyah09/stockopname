<?php
// menghubungkan php dengan koneksi database
require_once __DIR__ . '/function.php';

?>


<!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <div class="sidebar">
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                <img src="dist/img/user2-160x160.jpg" class="img-circle elevation-2" alt="User Image">
            </div>
            <div class="info">
                <a href="index.php" class="d-block">
                    <?php echo htmlspecialchars($_SESSION['username'] ?? ''); ?>
                </a>
            </div>
        </div>

        <?php 
        $authorize = $_SESSION['authorize'] ?? '';
        ?>

        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" authorize="menu">

                <!-- Dashboard: Tampil untuk semua authorize -->
                <li class="nav-item">
                    <a href="./Dashboard.php" class="nav-link">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>Dashboard</p>
                    </a>
                </li>

                <!-- Input Data: hanya untuk USER & Admin -->
                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-edit"></i>
                        <p>
                            Input Data
                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">

                        <!-- Komponen NON SET -->
                        <li class="nav-item">
                            <a href="input-non-set.php" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Komponen NON SET</p>
                            </a>
                        </li>

                        <!-- Komponen SET -->
                        <li class="nav-item">
                            <a href="input-set.php" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Komponen SET</p>
                            </a>
                        </li>

                        <!-- Final data SO - hanya Admin -->
                        <?php if ($authorize === 'Admin'): ?>
                        <li class="nav-item">
                            <a href="input-final-data.php" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Final data SO</p>
                            </a>
                        </li>
                        <?php endif; ?>

                    </ul>
                </li>

                <!-- Reports - hanya Admin -->
                <?php if ($authorize === 'Admin'): ?>
                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-chart-pie"></i>
                        <p>
                            Reports
                            <i class="right fas fa-angle-left"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="report-validation.php" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Report For Validation</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="report-final.php" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Report Final SO</p>
                            </a>
                        </li>
                    </ul>
                </li>
                <?php endif; ?>

                <!-- Master Data - hanya Admin -->
                <?php if ($authorize === 'Admin'): ?>
                <li class="nav-item">
                    <a href="#" class="nav-link">
                        <i class="nav-icon fas fa-table"></i>
                        <p>
                            Master Data
                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="input-data-user.php" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Data User</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="input-style.php" class="nav-link">
                                <i class="far fa-circle nav-icon"></i>
                                <p>Data Master Style</p>
                            </a>
                        </li>
                    </ul>
                </li>
                <?php endif; ?>

                <!-- Logout -->
                <li class="nav-item">
                    <a href="logout.php" class="nav-link">
                        <i class="far fa-circle nav-icon"></i>
                        <p>Logout</p>
                    </a>
                </li>

            </ul>
        </nav>
    </div>
</aside>
