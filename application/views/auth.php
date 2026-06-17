<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Favicon icon-->
    <link rel="shortcut icon" type="image/png" href="<?= base_url('template/assets/images/approve.png') ?>">

    <!-- Theme CSS -->
    <link href="<?= base_url('template/assets/libs/bootstrap-icons/font/bootstrap-icons.css') ?>" rel="stylesheet">
    <link href="<?= base_url('template/assets/libs/jquery-form-validator/form-validator/theme-default.css') ?>" rel="stylesheet">
    <link href="<?= base_url('template/assets/libs/jquery-toast/iziToast.min.css') ?>" rel="stylesheet" />
    <link rel="stylesheet" href="<?= base_url('template/assets/css/theme.min.css') ?>">
    <title>Sign In | SIMPUN (Sistem Informasi Pengelolaan Usulan Pensiun)</title>
</head>

<body>
    <noscript>
        <style>
            #main-login {
                display: none;
            }

            .disabled-js {
                position: absolute;
                width: 100%;
                height: 100vh;
                left: 0;
                top: 0;
                z-index: 9999;
                background: #fff;
                display: flex;
                justify-content: center;
                align-items: center;
            }

            h1 {
                /* even if this h1 is inside head tags it will be first hidden, so we have to display it again after all body elements are hidden*/
                display: block;
                color: red;
            }
        </style>
        <div class="disabled-js">
            <h1>JavaScript is not enabled, please check your browser settings.</h1>
        </div>
    </noscript>
    <!-- container -->
        <div class="d-flex align-items-center justify-content-center g-0 max-w-xl min-vh-100" style="background: linear-gradient(
    180deg,
    #F6F9FE 0%,
    #EEF4FB 45%,
    #E1EBF7 100%
);">
            <div class="col-5 d-none d-lg-block">
                <img style="width:100%; border-radius: 2%" src="<?= base_url('template/assets/images/f2927c30-5043-4d21-9e77-fa16c87842f9.png') ?>" alt="background-simpun">
            </div>
            <div class="col-12 col-lg-6">
                <div class="col-12 col-sm-8 mx-auto">

                <!-- Card -->
                <div class="card rounded-xl">
                    <!-- Card body -->
                    <div class="card-body p-8">
                        <?php
                        $urlRef = isset($_GET['continue']) ? $_GET['continue'] : '';
                        if (!$this->session->csrf_token) {
                            $this->session->csrf_token = hash('sha1', time());
                        }
                        ?>

                        <?php
                        $sesi = $this->session->tempdata();
                        if (@$sesi['logout_status']) {
                        ?>
                            <div class="alert alert-<?= $sesi['logout_is'] ?> alert-dismissible fade show" role="alert">
                                <strong><?= @$sesi['logout_title']; ?> !</strong> <?= $sesi['logout_message']; ?>
                            </div>
                        <?php
                        }
                        ?>

                        <div>
                            <h3>Masuk dengan akun SSO</h3>
                            <h5 class="opacity-50">Sistem Informasi Pengelolaan Usulan Pensiun</h5>
                            <div class="d-grid mt-6">
                                <!-- <a href="<?= base_url("oauth/sso/authorize") ?>" class="btn btn-lg btn-outline-primary">
                                    Login with SSO <i class="bi bi-fingerprint"></i></a> -->
                                <button id="loginBtn" class="btn btn-lg btn-outline-primary shadow" type="button">
                                    Continue with SSO <i class="bi bi-fingerprint"></i></a>
                                </button>
                            </div>
                            <div style="display: flex; align-items: center; margin: 20px 0;">
                                <hr style="flex: 1; border: none; height: 1px; background-color: #ccc;">
                                <span style="padding: 0 10px; color: #666; font-weight: bold;">ATAU BISA JUGA</span>
                                <hr style="flex: 1; border: none; height: 1px; background-color: #ccc;">
                            </div>
                            <div class="d-flex justify-content-center align-items-center mt-3 gap-4">
                                <a href="<?= base_url("/cekstatus") ?>" class="btn btn-lg btn-outline-secondary w-100">
                                    Cek Status Usulan <i class="bi bi-app-indicator"></i></a>
                                <a href="https://drive.google.com/file/d/1gvj4zjsTGtNgu2itWgnBTufuyempmRRX/view?usp=sharing" class="btn btn-lg btn-outline-secondary  w-100" target="_blank">
                                    Buku Panduan <i class="bi bi-book-half"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
                <p class="mx-auto mt-4 mb-3 fs-small text-center text-muted opacity-50">&copy; <?= date('Y') ?> Dikembangkan Oleh Bidang PPIK. Version <?= phpversion(); ?></p>
                </div>
            </div>
        </div>
    <!-- Scripts -->
    <!-- Libs JS -->
    <script src="<?= base_url('template/') ?>assets/libs/jquery/dist/jquery.min.js"></script>
    <script src="<?= base_url('template/') ?>assets/libs/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
    <script src="<?= base_url('template/') ?>assets/libs/jquery-slimscroll/jquery.slimscroll.min.js"></script>
    <script src="<?= base_url('template/') ?>assets/libs/jquery-toast/iziToast.min.js"></script>

    <!-- Theme JS -->
    <script src="<?= base_url('template/') ?>assets/js/theme.min.js"></script>
    <script src="<?= base_url('template/') ?>assets/js/oauth.js"></script>
    <script>
        new Oauth("loginBtn", {
            onSuccess: (data) => {
                iziToast.success({
                    timeout: 8000,
                    title: "Login Berhasil",
                    position: "topCenter",
                    icon: 'bi bi-check-circle-fill',
                    message: data.response,
                    transitionIn: 'fadeInDown',
                    transitionOut: 'fadeOutUp',
                    pauseOnHover: false,
                    onOpened: function(instance, toast){
                        window.location.href = '/app/dashboard'
                    },
                    // onClosing: function(instance, toast, closedBy){
                    // }
                });
            }
        });
    </script>
</body>

</html>