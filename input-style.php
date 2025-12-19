<?php
// menghubungkan php dengan koneksi database
require_once __DIR__ . '/function.php';
require_once 'auth.php';
checkAuth();

$users = mysqli_query($conn, "SELECT * FROM `tbl_master_style`");

?>


<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Stock Opname | Form-Input</title>

  <!-- Favicon -->
  <link rel="icon" type="image/png" href="dist/img/logo-stock.png">

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
  <!-- daterange picker -->
  <link rel="stylesheet" href="plugins/daterangepicker/daterangepicker.css">
  <!-- iCheck for checkboxes and radio inputs -->
  <link rel="stylesheet" href="plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- Bootstrap Color Picker -->
  <link rel="stylesheet" href="plugins/bootstrap-colorpicker/css/bootstrap-colorpicker.min.css">
  <!-- Tempusdominus Bootstrap 4 -->
  <link rel="stylesheet" href="plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">
  <!-- Select2 -->
  <link rel="stylesheet" href="plugins/select2/css/select2.min.css">
  <link rel="stylesheet" href="plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css">
  <!-- Bootstrap4 Duallistbox -->
  <link rel="stylesheet" href="plugins/bootstrap4-duallistbox/bootstrap-duallistbox.min.css">
  <!-- BS Stepper -->
  <link rel="stylesheet" href="plugins/bs-stepper/css/bs-stepper.min.css">
  <!-- dropzonejs -->
  <link rel="stylesheet" href="plugins/dropzone/min/dropzone.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="dist/css/adminlte.min.css">
  <!-- DataTables -->
  <link rel="stylesheet" href="plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
  <!-- <link rel="stylesheet" href="plugins/datatables-responsive/css/responsive.bootstrap4.min.css"> -->
  <link rel="stylesheet" href="plugins/datatables-buttons/css/buttons.bootstrap4.min.css">




  <style>
    /* PAKSA HEADER & BODY UKURAN SAMA */
    .dataTables_scrollHeadInner,
    .dataTables_scrollHeadInner table,
    .dataTables_scrollBody table {
        width: 100% !important;
    }

    /* HILANGKAN SCROLL GANDA */
    .dataTables_scrollBody {
        overflow-x: auto !important;
        overflow-y: auto !important;
    }

    /* HEADER LEBIH STABIL */
    .dataTables_scrollHead {
        overflow: hidden !important;
    }

    /* JANGAN BIARKAN KOLOM PECALAH */
    #example1 th,
    #example1 td {
        white-space: nowrap;
    }
    .card-body {
    overflow-x: visible !important;
    }

  </style>

</head>

<body class="hold-transition sidebar-mini">
<div class="wrapper">
  <!-- Notification -->
  <?php include_once __DIR__ . '/notification.php'; ?>

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
    </ul>
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
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Master Master</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="index.php">Home</a></li>
              <li class="breadcrumb-item">Input Data</li>
              <li class="breadcrumb-item active">Master Master</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <div class="row">
          <!-- left column -->
          <div class="col-md-12">
            <!-- Form Stock Opname elements -->
            <div class="card card-primary">
              <div class="card-header">
                <h3 class="card-title">Input data Master Master</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form action="function.php" method="POST" enctype="multipart/form-data">
                <div class="card-body">
                     <input type="text" name="updated_by" hidden value="<?php echo htmlspecialchars($_SESSION['username'] ?? ''); ?>">

                    <div class="form-group">  
                      <label>Style Name</label>
                      <input type="text" class="form-control" name="name_style" placeholder="Masukkan Style Name">
                    </div>

                    <button type="submit" name="submit-style" class="btn btn-primary">Submit</button>
                </div>
                <!-- /.card-body -->
                
                <div class="card-footer">
                    <label>Upload data Style</label>
                      <div class="input-group">
                          <div class="custom-file">
                              <input type="file" class="custom-file-input" id="exampleInputFile" name="file_csv" required>
                              <label class="custom-file-label" for="exampleInputFile">Choose file</label>
                          </div>
                          <div class="input-group-append">
                              <button type="submit" name="upload-data-style" class="btn btn-success">Upload</button>
                          </div>
                      </div>

                </div>
              </form>
            </div>
            <!-- /.card -->

            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Data Master Style</h3>
                </div>
                <div class="card-body">

                    <!-- ✅ HILANGKAN table-responsive -->
                    <table id="example1" class="table table-bordered table-striped" style="width:100%">
                    <thead>
                    <tr>
                        <th>No</th>
                        <th>Style Name</th>
                        <th>Update by</th>
                        <th>Last Update</th>
                    </tr>
                    </thead>
                    <tbody>
                      <?php $no = 1; ?>
                      <?php foreach ($users as $user): ?>
                    <tr>
                        <td><?= $no++; ?></td>
                        <td><?= $user['name_style']; ?></td>
                        <td><?= $user['updated_by']; ?></td>
                        <td><?= $user['last_update']; ?></td>
                    </tr>
                      <?php endforeach; ?>  
                    
                    </tbody>
                    </table>

                </div>
            </div>

          </div>
        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
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
<!-- Bootstrap 4 -->
<script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- bs-custom-file-input -->
<script src="plugins/bs-custom-file-input/bs-custom-file-input.min.js"></script>
<!-- Select2 -->
<script src="plugins/select2/js/select2.full.min.js"></script>
<!-- AdminLTE App -->
<script src="dist/js/adminlte.min.js"></script>
<!-- AdminLTE for demo purposes -->
<!-- <script src="dist/js/demo.js"></script> -->


<!-- DataTables  & Plugins -->
<script src="plugins/datatables/jquery.dataTables.min.js"></script>
<script src="plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
<!-- <script src="plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
<script src="plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script> -->
<script src="plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>
<script src="plugins/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
<script src="plugins/jszip/jszip.min.js"></script>
<script src="plugins/pdfmake/pdfmake.min.js"></script>
<script src="plugins/pdfmake/vfs_fonts.js"></script>
<script src="plugins/datatables-buttons/js/buttons.php5.min.js"></script>
<script src="plugins/datatables-buttons/js/buttons.print.min.js"></script>
<script src="plugins/datatables-buttons/js/buttons.colVis.min.js"></script>

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


<!-- Page specific script -->
<script>
//Initialize Select2 Elements
    $('.select2').select2()

    //Initialize Select2 Elements
    $('.select2bs4').select2({
      theme: 'bootstrap4'
    })

</script>

<!-- Data_table -->
<script>
$(function () {

  var table = $("#example1").DataTable({
    scrollX: true,
    scrollCollapse: true,
    responsive: false,
    autoWidth: true,          // ✅ HIDUPKAN auto width
    fixedHeader: false,
    lengthChange: false,
    buttons: ["copy", "csv", "excel", "pdf"] // Print & Colvis sudah dihilangkan
  });

  table.buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');

  table.columns.adjust().draw();

});
</script>

<script>
$(function () {
  bsCustomFileInput.init();
});
</script>

</body>
</html>
