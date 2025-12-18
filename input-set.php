<?php
// menghubungkan php dengan koneksi database
require_once __DIR__ . '/function.php';
require_once 'auth.php';
checkAuth();


$ncvs = mysqli_real_escape_string($conn, $_SESSION['name_ncvs']);

$Data_Set = mysqli_query($conn, "SELECT * 
  FROM tbl_transac 
  WHERE status_transac = 'For_Validation' 
    AND ncvs = '$ncvs' AND status_set = 'SET'
  ORDER BY last_update DESC");

$Style = mysqli_query($conn, "SELECT * FROM tbl_master_style");
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

<body class="hold-transition sidebar-mini">
<div class="wrapper">
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
    <!-- Notification -->
    <?php include_once __DIR__ . '/notification.php'; ?>

    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>Form Stock Opname</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Input Data</a></li>
              <li class="breadcrumb-item active">Form Stock Opname</li>
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
                <h3 class="card-title">Input data Stock SET</h3>
              </div>
              <!-- /.card-header -->
              <!-- form start -->
              <form action="function.php" method="POST">
                <div class="card-body">
                    
                     <input type="text" name="updated_by" hidden   value="<?php echo htmlspecialchars($_SESSION['username'] ?? ''); ?>">
                     <input type="text" name="ncvs" hidden   value="<?php echo htmlspecialchars($_SESSION['name_ncvs'] ?? ''); ?>">
                     <input type="text" name="status_set" hidden   value="SET">
                     <input type="text" name="status_transac" hidden   value="For_validation">
                    
                    <div class="form-group">
                      <label>Area</label>
                      <select class="form-control select2" name="area" style="width: 100%;">
                        <option selected="selected" value="">Area</option>
                        <option value="Area-CTPAT">CTPAT</option>
                        <option value="Area-Finishing">Finishing</option>
                        <option value="Area-Cementing">Cementing</option>
                        <option value="Area-Lasting">Lasting</option>
                      </select>
                    </div>

                    <div class="form-group">
                        <label>Style</label>
                        
                        <select class="form-control select2" name="style_name" style="width: 100%;">
                          <option selected="selected"  value="">Style</option>
                          <?php foreach ($Style AS $data):?>
                          <option value="<?=$data["name_style"];?>"><?=$data["name_style"];?></option>
                          <?php endforeach;?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Size (Qty)</label>
                        <div class="row">
                            <div class="col-2">
                            <label>001</label>
                            <input type="text" name="size[001]" class="form-control size-input" placeholder="0">
                            </div>

                            <div class="col-2">
                            <label>01T</label>
                            <input type="text" name="size[01T]" class="form-control size-input" placeholder="0">
                            </div>

                            <div class="col-2">
                            <label>002</label>
                            <input type="text" name="size[002]" class="form-control size-input" placeholder="0">
                            </div>

                            <div class="col-2">
                            <label>02T</label>
                            <input type="text" name="size[02T]" class="form-control size-input" placeholder="0">
                            </div>

                            <div class="col-2">
                            <label>003</label>
                            <input type="text" name="size[003]" class="form-control size-input" placeholder="0">
                            </div>

                            <div class="col-2">
                            <label>03T</label>
                            <input type="text" name="size[03T]" class="form-control size-input" placeholder="0">
                            </div>

                            
                        </div>
                        <br>
                        <div class="row">
                            <div class="col-2">
                            <label>004</label>
                            <input type="text" name="size[004]" class="form-control size-input" placeholder="0">
                            </div>

                            <div class="col-2">
                            <label>04T</label>
                            <input type="text" name="size[04T]" class="form-control size-input" placeholder="0">
                            </div>

                            <div class="col-2">
                            <label>005</label>
                            <input type="text" name="size[005]" class="form-control size-input" placeholder="0">
                            </div>

                            <div class="col-2">
                            <label>05T</label>
                            <input type="text" name="size[05T]" class="form-control size-input" placeholder="0">
                            </div>

                            <div class="col-2">
                            <label>006</label>
                            <input type="text" name="size[006]" class="form-control size-input" placeholder="0">
                            </div>

                            <div class="col-2">
                            <label>06T</label>
                            <input type="text" name="size[06T]" class="form-control size-input" placeholder="0">
                            </div>

                            
                        </div>
                        <br>
                        <div class="row">
                            <div class="col-2">
                            <label>007</label>
                            <input type="text" name="size[007]" class="form-control size-input" placeholder="0">
                            </div>

                            <div class="col-2">
                            <label>07T</label>
                            <input type="text" name="size[07T]" class="form-control size-input" placeholder="0">
                            </div>

                            <div class="col-2">
                            <label>008</label>
                            <input type="text" name="size[008]" class="form-control size-input" placeholder="0">
                            </div>

                            <div class="col-2">
                            <label>08T</label>
                            <input type="text" name="size[08T]" class="form-control size-input" placeholder="0">
                            </div>

                            <div class="col-2">
                            <label>009</label>
                            <input type="text" name="size[009]" class="form-control size-input" placeholder="0">
                            </div>

                            <div class="col-2">
                            <label>09T</label>
                            <input type="text" name="size[09T]" class="form-control size-input" placeholder="0">
                            </div>

                            

                        </div>
                        <br>
                        <div class="row">
                            <div class="col-2">
                            <label>110</label>
                            <input type="text" name="size[110]" class="form-control size-input" placeholder="0">
                            </div>

                            <div class="col-2">
                            <label>10T</label>
                            <input type="text" name="size[10T]" class="form-control size-input" placeholder="0">
                            </div>

                            <div class="col-2">
                            <label>111</label>
                            <input type="text" name="size[111]" class="form-control size-input" placeholder="0">
                            </div>

                            <div class="col-2">
                            <label>11T</label>
                            <input type="text" name="size[11T]" class="form-control size-input" placeholder="0">
                            </div>

                            <div class="col-2">
                            <label>012</label>
                            <input type="text" name="size[012]" class="form-control size-input" placeholder="0">
                            </div>

                            <div class="col-2">
                            <label>12T</label>
                            <input type="text" name="size[12T]" class="form-control size-input" placeholder="0">
                            </div>
                        </div>
                        <br>
                        <div class="row">
                            <div class="col-2">
                            <label>013</label>
                            <input type="text" name="size[013]" class="form-control size-input" placeholder="0">
                            </div>

                            <div class="col-2">
                            <label>13T</label>
                            <input type="text" name="size[13T]" class="form-control size-input" placeholder="0">
                            </div>

                            <div class="col-2">
                            <label>014</label>
                            <input type="text" name="size[014]" class="form-control size-input" placeholder="0">
                            </div>

                            <div class="col-2">
                            <label>14T</label>
                            <input type="text" name="size[14T]" class="form-control size-input" placeholder="0">
                            </div>

                            <div class="col-2">
                            <label>015</label>
                            <input type="text" name="size[015]" class="form-control size-input" placeholder="0">
                            </div>

                            <div class="col-2">
                            <label>016</label>
                            <input type="text" name="size[016]" class="form-control size-input" placeholder="0">
                            </div>
                        </div>
                    </div>
                </div>
                <!-- /.card-body -->

                <div class="card-footer">
                  <button type="submit" name="Set-submit" class="btn btn-primary">Submit</button>
                </div>
              </form>
            </div>
            <!-- /.card -->

            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Data Stock Opname komponen SET</h3>
                </div>
                <div class="card-body">

                    <!-- ✅ HILANGKAN table-responsive -->
                    <table id="example1" class="table table-bordered table-striped" style="width:100%">
                    <thead>
                    <tr>
                        <th>No</th>
                        <th>NCVS</th>
                        <th>Area</th>
                        <th>Style</th>
                        <th>Kode Oracle</th>
                        <th>Status</th>
                        <th>Size</th>
                        <th>Qty</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php $no = 1; ?>
                    <?php foreach ($Data_Set as $data): ?>
                    <tr>
                        <td><?= $no++; ?></td>
                        <td><?= $data['ncvs']; ?></td>
                        <td><?= $data['area']; ?></td>
                        <td><?= $data['style_name']; ?></td>
                        <td><?= $data['category']; ?>.<?= $data['style_name']; ?>.<?= $data['size']; ?></td>
                        <td><?= $data['status_set']; ?></td>
                        <td><?= $data['size']; ?></td>
                        <td><?= $data['qty']; ?></td>
                        <td class="text-center">
                      <div class="dropdown">
                        <button class="btn btn-sm btn-tool" type="button"
                                id="dropdownMenu<?= $data['id_transac']; ?>"
                                data-toggle="dropdown">
                          <i class="fas fa-ellipsis-v"></i>
                        </button>

                        <div class="dropdown-menu dropdown-menu-right"
                            aria-labelledby="dropdownMenu<?= $data['id_transac']; ?>">

                          <a class="dropdown-item editSet"
                            data-toggle="modal"
                            data-target="#editInputSet"
                            data-id="<?= $data['id_transac']; ?>"
                            data-ncvs="<?= $data['ncvs']; ?>"
                            data-style-name="<?= $data['style_name']; ?>"
                            data-category="<?= $data['category']; ?>"
                            data-status-set="<?= $data['status_set']; ?>"
                            data-size="<?= $data['size']; ?>"
                            data-qty="<?= $data['qty']; ?>"
                            data-area="<?= $data['area']; ?>">
                            <i class="fas fa-edit mr-2"></i> Edit
                          </a>

                          <div class="dropdown-divider"></div>

                          <form action="function.php" method="post"
                                onsubmit="return confirm('Yakin ingin hapus data ini?');">
                            <input type="hidden" name="id_transac" value="<?= htmlspecialchars($data['id_transac']); ?>">
                            <button type="submit" name="delete-set" class="dropdown-item text-danger">
                              <i class="fas fa-trash mr-2"></i> Remove
                            </button>
                          </form>

                        </div>
                      </div>
                    </td>
                    </tr>
                    <?php endforeach; ?>
                    </tbody>
                    </table>

                </div>
            </div>

          </div>
        </div>
        <!-- /.row -->

        <div class="modal fade" id="editInputSet" tabindex="-1" role="dialog">
          <div class="modal-dialog modal-lg modal-dialog-centered" role="document">
            <div class="modal-content">

              <div class="modal-header bg-light">
                <h5 class="modal-title">
                  <i class="fas fa-edit mr-2"></i> Edit Data SET
                </h5>
                <button type="button" class="close" data-dismiss="modal">
                  <span>&times;</span>
                </button>
              </div>

              <form action="function.php" method="POST">
                <div class="modal-body">
                  <div class="row">

                    <input type="hidden" name="id_transac" id="edit_id_transac">

                    <div class="col-md-6">
                      <div class="form-group">
                        <label>NCVS</label>
                        <input type="text" name="ncvs" id="edit_ncvs" class="form-control" readonly>
                      </div>
                    </div>

                    <div class="col-md-6">
                      <div class="form-group">
                        <label>Style Name</label>
                        <!-- <input type="text" name="style_name" id="edit_style_name" class="form-control"> -->
                        <select class="form-control select2"
                                name="style_name"
                                id="edit_style_name"
                                style="width: 100%;">
                        <option selected="selected" value="">Style Name</option>
                        <?php foreach ($Style AS $data):?>
                        <option value="<?=$data["name_style"];?>"><?=$data["name_style"];?></option>
                        <?php endforeach;?>
                        </select>
                      </div>
                    </div>

                    <div class="col-md-6">
                      <div class="form-group">
                        <label>Category</label>
                        <input type="text" name="category" id="edit_category" class="form-control" readonly>
                      </div>
                    </div>

                    <div class="col-md-6">
                      <div class="form-group">
                        <label>Status Set</label>
                        <input type="text" name="status_set" id="edit_status_set" class="form-control" readonly>
                      </div>
                    </div>

                    <div class="col-md-6">
                      <div class="form-group">
                        <label>Size</label>
                        <select class="form-control select2"
                                name="size"
                                id="edit_size"
                                style="width: 100%;">
                        <option selected="selected" value="">Size</option>
                        <option value="001">001</option>
                        <option value="01T">01T</option>
                        <option value="002">002</option>
                        <option value="02T">02T</option>
                        <option value="003">003</option>
                        <option value="03T">03T</option>
                        <option value="004">004</option>
                        <option value="04T">04T</option>
                        <option value="005">005</option>
                        <option value="05T">05T</option>
                        <option value="006">006</option>
                        <option value="06T">06T</option>
                        <option value="007">007</option>
                        <option value="07T">07T</option>
                        <option value="008">008</option>
                        <option value="08T">08T</option>
                        <option value="009">009</option>
                        <option value="09T">09T</option>
                        <option value="010">010</option>
                        <option value="10T">10T</option>
                        <option value="011">011</option>
                        <option value="11T">11T</option>
                        <option value="012">012</option>
                        <option value="12T">12T</option>
                        <option value="013">013</option>
                        <option value="13T">13T</option>
                        <option value="014">014</option>
                        <option value="14T">14T</option>
                        <option value="015">015</option>
                        <option value="016">016</option>
                        </select>
                      </div>
                    </div>

                    <div class="col-md-6">
                      <div class="form-group">
                        <label>Area</label>
                        <!-- <input type="text" name="area" id="edit_area" class="form-control"> -->
                        <select class="form-control select2"
                                name="area"
                                id="edit_area"
                                style="width: 100%;">
                        <option selected="selected" value="">Area</option>
                        <option value="Area-CTPAT">CTPAT</option>
                        <option value="Area-Finishing">Finishing</option>
                        <option value="Area-Cementing">Cementing</option>
                        <option value="Area-Lasting">Lasting</option>
                        </select>
                      </div>
                    </div>

                    <div class="col-md-6">
                      <div class="form-group">
                        <label>Qty</label>
                        <input type="text" name="qty" id="edit_qty" class="form-control">
                      </div>
                    </div>
                  </div>
                </div>

                <div class="modal-footer justify-content-between">
                  <button type="button" class="btn btn-secondary" data-dismiss="modal">
                    <i class="fas fa-times mr-1"></i> Batal
                  </button>
                  <button type="submit" name="update-set" class="btn btn-success">
                    <i class="fas fa-save mr-1"></i> Update
                  </button>
                </div>

              </form>
            </div>
          </div>
        </div>
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
  document.addEventListener("DOMContentLoaded", function () {

    // init select2
    $('.select2').select2({
      width: '100%'
    });

    document.querySelectorAll(".editSet").forEach(function (btn) {
      btn.addEventListener("click", function () {

        document.getElementById("edit_id_transac").value = this.dataset.id;
        document.getElementById("edit_ncvs").value = this.dataset.ncvs;
        document.getElementById("edit_category").value = this.dataset.category;
        document.getElementById("edit_status_set").value = this.dataset.statusSet;
        document.getElementById("edit_qty").value = this.dataset.qty;


        // 🔥 SET SIZE KE SELECT2
        $('#edit_size')
          .val(this.dataset.size)
          .trigger('change');

          // 🔥 SET AREA KE SELECT2
        $('#edit_area')
          .val(this.dataset.area)
          .trigger('change');

          // 🔥 SET STYLE NAME KE SELECT2
        $('#edit_style_name')
          .val(this.dataset.styleName)
          .trigger('change');

      });
    });
  });
</script>



</body>
</html>
