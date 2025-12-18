<?php
// menghubungkan php dengan koneksi database
require_once __DIR__ . '/function.php';

$users = mysqli_query($conn, "SELECT * FROM `tbl_user`");

?>


<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Stock Opname | Form-Input</title>

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

<body class="hold-transition sidebar-mini layout-fixed">

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
        <a href="index3.php" class="nav-link">Home</a>
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
            <h1>Master User</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Input Data</a></li>
              <li class="breadcrumb-item active">Master User</li>
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
                <h3 class="card-title">Input data Master User</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form action="function.php" method="POST">
                <div class="card-body">
                    <!-- <input type="text" name="username" hidden   value="<?php echo $_GET['username']; ?>"> -->
                     <input type="text" name="updated_by" hidden   value="Agung">
                     <input type="text" name="password" hidden   value="123456">

                    <div class="form-group">
                      <label>Username</label>
                      <input type="text" class="form-control" name="username" placeholder="Masukkan Username">
                    </div>

                    <div class="form-group">
                      <label>Nik</label>
                      <input type="text" class="form-control" name="nik_user" placeholder="Masukkan Nik">
                    </div>

                    <div class="form-group">

                      <label>NCVS</label>
                      <select class="form-control select2" style="width: 100%;" name="name_ncvs"> 
                        <option selected="selected" value="">NCVS</option>
                        <option value="101">101</option>
                        <option value="102">102</option>
                        <option value="103">103</option>
                        <option value="104">104</option>
                        <option value="105">105</option>
                        <option value="107">107</option>
                        <option value="108">108</option>
                        <option value="109">109</option>
                        <option value="110">110</option>
                        <option value="111">111</option>
                        <option value="112">112</option>
                        <option value="113">113</option>
                        <option value="114">114</option>
                        <option value="115">115</option>
                        <option value="116">116</option>
                        <option value="201">201</option>
                        <option value="202">202</option>
                        <option value="203">203</option>
                        <option value="204">204</option>
                        <option value="205">205</option>
                        <option value="206">206</option>
                      </select>
                    </div>

                    <div class="form-group">
                        <label>Authorize</label>
                        <select class="form-control select2" style="width: 100%;" name="authorize">
                          <option selected="selected" value="">Authorize</option>
                          <option value="Admin">Admin</option>
                          <option value="User">User</option>
                        </select>
                    </div>                    

                  <!-- <div class="form-group">
                    <label for="exampleInputPassword1">Password</label>
                    <input type="password" class="form-control" id="exampleInputPassword1" placeholder="Password">
                  </div> -->
                </div>
                <!-- /.card-body -->
                
                <div class="card-footer">
                  <button type="submit" name="submit-user" class="btn btn-primary">Submit</button>
                </div>
              </form>
            </div>
            <!-- /.card -->

            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Data Master User</h3>
                </div>
                <div class="card-body">

                    <!-- ✅ HILANGKAN table-responsive -->
                    <table id="example1" class="table table-bordered table-striped" style="width:100%">
                    <thead>
                    <tr>
                        <th>No</th>
                        <th>Style</th>
                        <th>Nik</th>
                        <th>NCVS</th>
                        <th>Authorize</th>
                        <th>Last Update</th>
                    </tr>
                    </thead>
                    <tbody>
                      <?php $no = 1; ?>
                      <?php foreach ($users as $user): ?>
                    <tr>
                        <td><?= $no++; ?></td>
                        <td><?= $user['username']; ?></td>
                        <td><?= $user['nik_user']; ?></td>
                        <td><?= $user['name_ncvs']; ?></td>
                        <td><?= $user['authorize']; ?></td>
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

</body>
</html>
