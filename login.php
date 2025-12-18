<?php
require_once __DIR__ . '/function.php';
error_reporting(0);

if (isset($_POST["login"])) {
  $nik_user  = mysqli_real_escape_string($conn, $_POST['nik_user']);
  $password  = mysqli_real_escape_string($conn, $_POST['password']);

  // Ambil data user berdasarkan NIK
  $query = "
    SELECT 
      id_user,
      nik_user,
      password,
      username,
      authorize,
      name_ncvs
    FROM tbl_user
    WHERE nik_user = '$nik_user'
    LIMIT 1
  ";

  $login = mysqli_query($conn, $query);

  if (mysqli_num_rows($login) > 0) {
    $data = mysqli_fetch_assoc($login);

    // ✅ VALIDASI PASSWORD
    if ($password === $data['password']) {

        $_SESSION["login"]     = true;
        $_SESSION['id_user']   = $data['id_user'];
        $_SESSION['nik_user']  = $data['nik_user'];
        $_SESSION['username']  = $data['username'];
        $_SESSION['authorize'] = $data['authorize'];
        $_SESSION['name_ncvs'] = $data['name_ncvs'];

        $_SESSION['login_status'] = 'success';
        header("Location: index.php");
        exit;

    } else {
        // Password salah
        $_SESSION['login_status'] = 'danger';
        header("Location: login.php");
        exit;
    }

  } else {
    // NIK tidak ditemukan
    $_SESSION['login_status'] = 'danger';
    header("Location: login.php");
    exit;
  }
}


?>


<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Stock opname | Log in</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
  <!-- icheck bootstrap -->
  <link rel="stylesheet" href="plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="dist/css/adminlte.min.css">
</head>
<body class="hold-transition login-page">
<div class="login-box">
  <div class="login-logo">
    <a href="index2.php"><b>Stock</b>Opname</a>
  </div>
  <!-- /.login-logo -->
  <div class="card">
    <!-- Notification -->
    <?php include_once __DIR__ . '/notification.php'; ?>
    <div class="card-body login-card-body">
      <p class="login-box-msg">Sign in to start your session</p>

      <form method="post" enctype="multipart/form-data">
        <div class="input-group mb-3">
          <input type="nik" class="form-control" name="nik_user" placeholder="Nik">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-envelope"></span>
            </div>
          </div>
        </div>
        <div class="input-group mb-3">
          <input type="password" class="form-control" name="password" placeholder="Password">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-lock"></span>
            </div>
          </div>
        </div>
        <div class="row">
          <!-- <div class="col-8">
            <div class="icheck-primary">
              <input type="checkbox" id="remember">
              <label for="remember">
                Remember Me
              </label>
            </div>
          </div> -->
          <!-- /.col -->
          <div class="col-12">
            <button type="submit" name="login" class="btn btn-primary btn-block">Sign In</button>
          </div>
          <!-- /.col -->
        </div>
      </form>

      <!-- <div class="social-auth-links text-center mb-3">
        <p>- OR -</p>
        <a href="#" class="btn btn-block btn-primary">
          <i class="fab fa-facebook mr-2"></i> Sign in using Facebook
        </a>
        <a href="#" class="btn btn-block btn-danger">
          <i class="fab fa-google-plus mr-2"></i> Sign in using Google+
        </a>
      </div> -->
      <!-- /.social-auth-links -->

      <!-- <p class="mb-1">
        <a href="forgot-password.php">I forgot my password</a>
      </p>
      <p class="mb-0">
        <a href="register.php" class="text-center">Register a new membership</a>
      </p> -->
    </div>
    <!-- /.login-card-body -->
  </div>
</div>
<!-- /.login-box -->

<!-- jQuery -->
<script src="plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="dist/js/adminlte.min.js"></script>
</body>
</html>
