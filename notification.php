<style>
 /* ========== TOAST FINAL ========== */
.toast {
    border-radius: 6px !important;
    overflow: hidden;
    min-width: 320px;
}

/* HEADER */
.toast > .toast-header {
    display: flex;
    align-items: center;
    min-height: 54px !important;
    padding: 12px 15px !important;
    font-size: 15px !important;
    font-weight: 600;
}

/* BODY */
.toast > .toast-body {
    min-height: 54px !important;
    padding: 14px 15px !important;
    font-size: 15px !important;
    line-height: 1.4;
}

/* WARNA HEADER */
.toast > .toast-header.bg-success {
    background-color: #2BA948 !important;
}
.toast > .toast-header.bg-danger {
    background-color: #D74552 !important;
}

/* WARNA BODY */
/* .toast.bg-success > .toast-body {
    background: linear-gradient(145deg, #3DB057, #27ae60) !important;
    color: #fff !important;
}
.toast.bg-danger > .toast-body {
    background: linear-gradient(145deg, #E15764, #ff959eff) !important;
    color: #fff !important;
} */

/* WARNA PROGRESS BAR */
.toast-progress-bar.bg-success {
    background: linear-gradient(90deg, #9effb8, #2BA948) !important;
}

.toast-progress-bar.bg-danger {
    background: linear-gradient(90deg, #ffc1c1, #D74552) !important;
}


/* TOMBOL CLOSE */
.toast .close {
    margin-left: auto;
    margin-top: 0 !important;
    font-size: 20px;
    opacity: .8;
}

/* PROGRESS BAR */
.toast-progress {
    height: 4px;
    width: 100%;
    overflow: hidden;
}
.toast-progress-bar {
    height: 100%;
    animation: progressBar 3s linear forwards;
}
@keyframes progressBar {
    from { width: 100%; }
    to { width: 0%; }
}

/* POSISI */
#liveToast {
    position: fixed !important;
    top: 20px !important;
    right: 20px !important;
    left: auto !important;
    z-index: 9999;
    animation: toastIn 0.4s ease;
}

/* ANIMASI MASUK */
@keyframes toastIn {
    from {
        opacity: 0;
        transform: translateX(80px) scale(0.95);
    }
    to {
        opacity: 1;
        transform: translateX(0) scale(1);
    }
}

/* ANIMASI KELUAR */
.toast.hide {
    animation: toastOut 0.4s forwards;
}

@keyframes toastOut {
    from {
        opacity: 1;
        transform: translateX(0) scale(1);
    }
    to {
        opacity: 0;
        transform: translateX(50px) scale(0.9);
    }
}
</style>

<?php
if (isset($_SESSION['green_notif']) || isset($_SESSION['red_notif'])):
    $notif_status  = isset($_SESSION['green_notif']) ? 'success' : 'danger';
    $notif_message = $_SESSION['green_notif'] ?? $_SESSION['red_notif'];
    $notif_icon = $notif_status === 'success'
        ? 'fas fa-check-circle me-2 fa-lg'
        : 'fas fa-times-circle me-2 fa-lg';
    $notif_title   = $notif_status === 'success' ? 'Berhasil!' : 'Gagal!';
?>

<div id="liveToast" class="toast bg-<?= $notif_status ?> show">
    <div class="toast-header bg-<?= $notif_status ?> text-white">
        <i class="<?= $notif_icon ?>"></i>
        <strong class="mr-auto"><?= $notif_title ?></strong>
        <button type="button" class="ml-2 mb-1 close text-white">
            <span>&times;</span>
        </button>
    </div>

    <div class="toast-body">
        <?= $notif_message ?>
    </div>

    <div class="toast-progress">
        <div class="toast-progress-bar bg-<?= $notif_status ?>"></div>
    </div>
</div>

<?php unset($_SESSION['green_notif'], $_SESSION['red_notif']); endif; ?>



<?php
// === Notifikasi Login ===
if (isset($_SESSION['login_status'])):
    $login_status  = $_SESSION['login_status'] === 'success' ? 'success' : 'danger';
    $login_success = $login_status === 'success';

    $login_icon  = $login_success ? 'fas fa-check-circle' : 'fas fa-times-circle';
    $login_title = $login_success ? 'Login Berhasil' : 'Login Gagal';
    $login_message = $login_success
        ? 'Anda berhasil login.'
        : 'NIK atau Password salah. Hubungi Admin jika memerlukan bantuan.';
?>
<div id="liveToast" class="toast bg-<?= $login_status ?> show" role="alert">

    <!-- HEADER -->
    <div class="toast-header bg-<?= $login_status ?> text-white">
        <i class="<?= $login_icon ?> me-2"></i>
        <strong class="me-auto"><?= $login_title ?></strong>
        <!-- <small>Login</small> -->
        <button type="button" class="close text-white"
                data-dismiss="toast" aria-label="Close">
            <span>&times;</span>
        </button>
    </div>

    <!-- BODY -->
    <div class="toast-body">
        <?= $login_message ?>
    </div>

    <!-- PROGRESS BAR -->
    <div class="toast-progress">
        <div class="toast-progress-bar bg-<?= $login_status ?>"></div>
    </div>

</div>

<?php unset($_SESSION['login_status']); ?>
<?php endif; ?>

