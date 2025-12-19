<?php
// menghubungkan php dengan koneksi database
require_once __DIR__ . '/function.php';
require_once 'auth.php';
checkAuth();

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Stock Opname | Home</title>

  <!-- Favicon -->
  <link rel="icon" type="image/png" href="dist/img/logo-stock.png">

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Tempusdominus Bootstrap 4 -->
  <link rel="stylesheet" href="plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">
  <!-- iCheck -->
  <link rel="stylesheet" href="plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- JQVMap -->
  <link rel="stylesheet" href="plugins/jqvmap/jqvmap.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="dist/css/adminlte.min.css">
  <!-- overlayScrollbars -->
  <link rel="stylesheet" href="plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
  <!-- Daterange picker -->
  <link rel="stylesheet" href="plugins/daterangepicker/daterangepicker.css">
  <!-- summernote -->
  <link rel="stylesheet" href="plugins/summernote/summernote-bs4.min.css">
</head>

<body class="hold-transition sidebar-mini layout-fixed">
<div class="wrapper">

  <!-- Preloader -->
  <div class="preloader flex-column justify-content-center align-items-center">
    <img class="animation__shake" src="dist/img/AdminLTELogo.png" alt="AdminLTELogo" height="60" width="60">
  </div>

  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
      </li>
      <li class="nav-item d-none d-sm-inline-block">
        <a href="index.php" class="nav-link">Home</a>
      </li>
      <!-- <li class="nav-item d-none d-sm-inline-block">
        <a href="#" class="nav-link">Contact</a>
      </li> -->
    </ul>
    <!-- Right navbar links -->
    
  </nav>
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <?php
    include 'sidebar.php';
    ?>
  </aside>



  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Notification -->
    <?php include_once __DIR__ . '/notification.php'; ?>
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Welcome, <?php echo htmlspecialchars($_SESSION['username'] ?? ''); ?>!</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="index.php">Home</a></li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <!-- Small boxes (Stat box) -->
        <div class="row">
          <div class="col-sm-12 mt-4">
            <div class="card shadow-sm border-0 position-relative">

              <!-- Ribbon -->
              <div class="ribbon-wrapper">
                <div class="ribbon bg-warning text-white">
                  Roles
                </div>
              </div>

              <!-- Card Header -->
              <div class="card-header bg-info text-white fw-bold fs-5">
                <b>ROLE OF STOCK OPNAME</b>
              </div>

              <!-- Card Body -->
              <div class="card-body bg-light p-0">
                <ol class="list-group list-group-numbered list-group-flush">

                  <li class="list-group-item">
                    Material yang dihitung saat SO adalah
                    <b>Upper, Outsole, Texon & Insole</b>.
                  </li>

                  <li class="list-group-item">
                    <b>Upper</b> yang set dengan <b>Texon, Insole & Outsole</b>,
                    dijadikan satu dan disusun pada
                    <b>Conveyor Assembling</b>.
                  </li>

                  <li class="list-group-item">
                    Area Stock Opname mulai dari
                    <b>Out Stitching (Rack Upper)</b> sampai
                    <b>Finishing</b>.
                  </li>

                  <li class="list-group-item">
                    Untuk Material yang <b>SET</b>
                    (<b>Upper, Texon, Insole & Outsole</b>) dan
                    sepatu yang ada di area <b>CTPAT</b>
                    diinput menggunakan
                    <b>System Aplikasi SO</b>.
                  </li>

                  <li class="list-group-item">
                    Untuk Material yang <b>NON SET</b>
                    (<b>Upper, Texon, Insole & Outsole</b>)
                    diinput menggunakan
                    <b>System Aplikasi SO</b>.
                  </li>

                  <li class="list-group-item">
                    Komponen <b>Upper</b> yang sudah dilakukan proses
                    <b>shoe lace</b>, disimpan ke dalam
                    <b>Rack Upper</b> dan didata
                    (<b>tidak ada upper shoe lace di area meja QC</b>).
                  </li>

                  <!-- Highlight SET -->
                  <li class="list-group-item bg-warning-subtle">
                    <b>Inventory Komponen SET</b> pada badan line
                    (<i>Lasting s/d Finishing</i>) maksimal
                    <b>2 Lot (252 × 2 = 504 pasang)</b>,
                    dan pada area <b>CTPAT</b> maksimal
                    <b>2 Lot (504 pasang)</b>.
                  </li>

                  <!-- Highlight NON SET -->
                  <li class="list-group-item bg-warning-subtle">
                    <b>Inventory Komponen NON SET</b>
                    (<b>Upper, Texon, Insole & Outsole</b>)
                    pada <b>Rack</b> maksimal
                    <b>4 Lot (252 × 4 = 1008 pasang)</b>.
                  </li>

                  <li class="list-group-item">
                    Jika ada <b>Upper</b> yang sudah diproses
                    <b>shoe lace</b> dan berada di luar
                    <b>NCVS (line)</b>, maka upper tersebut
                    didata dan dimasukkan ke dalam line.
                  </li>

                  <li class="list-group-item">
                    Untuk <b>Upper / Shoe</b> dengan kategori
                    <b>C-Grade</b> tidak dimasukkan ke dalam
                    data <b>SO</b>, dan diberi
                    <b>Identitas</b> jika berada di area
                    <b>NCVS</b>.
                  </li>

                  <li class="list-group-item">
                    Untuk line <b>shift 1</b> tanggal
                    <b>26 & 27</b>, <b>NCVS (107, 109 & 112)</b>
                    hanya mendata komponen
                    <b>NON SET</b>
                    (<b>Upper, Texon, Insole</b>).
                  </li>

                </ol>
              </div>
            </div>
          </div>

          <!-- // Noted -->
          <div class="col-sm-12 mt-4">
            <div class="card shadow-sm border-0">

              <!-- Card Header -->
              <div class="card-header bg-secondary text-white fw-bold fs-5">
                <b>Noted</b>
              </div>

              <!-- Card Body -->
              <div class="card-body bg-light">
                <ul class="list-group list-group-flush">

                  <li class="list-group-item bg-light">
                    <b>Material SET</b> adalah material yang
                    <b>lengkap secara jumlah, model, style, dan size</b>
                    dengan <b>4 komponen</b>:
                    <b>Upper, Texon, Insole & Outsole</b>.
                  </li>

                  <li class="list-group-item bg-light">
                    <b>Material NON SET</b> adalah material yang
                    <b>tidak lengkap secara jumlah, model, style, dan size</b>
                    dengan <b>4 komponen</b>:
                    <b>Upper, Texon, Insole & Outsole</b>.
                  </li>

                  <li class="list-group-item bg-light">
                    <b>Form Audit</b> dibuat <b>2 rangkap</b>,
                    ditandatangani oleh <b>VSS</b> dan <b>Auditor</b>.
                    <ul class="mt-2">
                      <li>1 rangkap disimpan oleh <b>VSS</b></li>
                      <li>1 rangkap diberikan kepada <b>Auditor</b>
                        untuk diserahkan ke <b>Team Accounting</b></li>
                    </ul>
                  </li>

                </ul>
              </div>

            </div>
          </div>

          <!-- // Code Oracle -->
          <div class="col-sm-12 mt-4">
            <div class="card shadow-sm border-0">

              <!-- Card Header -->
              <div class="card-header bg-dark text-white fw-bold fs-5">
                <b>Code Oracle</b>
              </div>

              <!-- Card Body -->
              <div class="card-body p-0">
                <div class="table-responsive">
                  <table class="table table-bordered table-hover align-middle mb-0">

                    <thead class="table-secondary text-center">
                      <tr>
                        <th style="width: 15%">Code Oracle</th>
                        <th style="width: 25%">Untuk</th>
                        <th>Remarks</th>
                      </tr>
                    </thead>

                    <tbody>
                      <tr>
                        <td class="fw-bold text-center">SA.UPR</td>
                        <td>Upper Set, Upper Non Set & Shoe</td>
                        <td>
                          Upper yang sudah <b>Set</b> dengan
                          <b>Texon, Insole & Outsole</b> atau
                          hanya <b>Upper saja</b> dan sudah
                          menjadi <b>Sepatu</b>
                        </td>
                      </tr>

                      <tr>
                        <td class="fw-bold text-center">SA.BTM</td>
                        <td>Outsole Non Set</td>
                        <td>Outsole yang belum <b>Set</b></td>
                      </tr>

                      <tr>
                        <td class="fw-bold text-center">SA.UCI</td>
                        <td>Insole Non Set</td>
                        <td>Insole yang belum <b>Set</b></td>
                      </tr>

                      <tr>
                        <td class="fw-bold text-center">SA.UTS</td>
                        <td>Texon Non Set</td>
                        <td>Texon yang belum <b>Set</b></td>
                      </tr>
                    </tbody>

                  </table>
                </div>
              </div>

            </div>
          </div>





          <!-- ./col -->
        </div>
        <!-- /.row -->
        <!-- Main row -->
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  <footer class="main-footer">
    <?php
    include 'footer.php';
    ?>
  </footer>

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->

<!-- jQuery -->
<script src="plugins/jquery/jquery.min.js"></script>
<!-- jQuery UI 1.11.4 -->
<script src="plugins/jquery-ui/jquery-ui.min.js"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
  $.widget.bridge('uibutton', $.ui.button)
</script>
<!-- Bootstrap 4 -->
<script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- ChartJS -->
<script src="plugins/chart.js/Chart.min.js"></script>
<!-- Sparkline -->
<script src="plugins/sparklines/sparkline.js"></script>
<!-- JQVMap -->
<script src="plugins/jqvmap/jquery.vmap.min.js"></script>
<script src="plugins/jqvmap/maps/jquery.vmap.usa.js"></script>
<!-- jQuery Knob Chart -->
<script src="plugins/jquery-knob/jquery.knob.min.js"></script>
<!-- daterangepicker -->
<script src="plugins/moment/moment.min.js"></script>
<script src="plugins/daterangepicker/daterangepicker.js"></script>
<!-- Tempusdominus Bootstrap 4 -->
<script src="plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"></script>
<!-- Summernote -->
<script src="plugins/summernote/summernote-bs4.min.js"></script>
<!-- overlayScrollbars -->
<script src="plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
<!-- AdminLTE App -->
<script src="dist/js/adminlte.js"></script>
<!-- AdminLTE for demo purposes -->
<!-- <script src="dist/js/demo.js"></script> -->
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<!-- <script src="dist/js/pages/dashboard.js"></script> -->

<!-- Notification -->
<script>
document.addEventListener('DOMContentLoaded', function () {
    const toast = document.getElementById("liveToast");
    if (!toast) return;

    const progress = toast.querySelector(".toast-progress-bar");
    const duration = 3000; // 3 detik

    progress.style.animationDuration = duration + "ms";

    // Close manual
    toast.querySelector('.close').onclick = () => {
        toast.classList.add("hide");
        setTimeout(() => toast.remove(), 400);
    };

    // Auto close
    setTimeout(() => {
        toast.classList.add("hide");
        setTimeout(() => toast.remove(), 400);
    }, duration);
});
</script>
</body>
</html>
