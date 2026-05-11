<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Favicon icon-->
    <link rel="shortcut icon" type="image/png" href="<?= base_url('template/') ?>assets/images/approve.png">

    <!-- Theme CSS -->
    <link href="<?= base_url('template/') ?>assets/libs/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
    <link href="<?= base_url('template/') ?>assets/libs/jquery-form-validator/form-validator/theme-default.css"
        rel="stylesheet">
    <link rel="stylesheet" href="<?= base_url('template/') ?>assets/css/theme.min.css">
    <title>CEK STATUS USULAN PENSIUN | SIMPUN (Sistem Informasi Pengelolaan Usulan Pensiun)</title>
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
    <div id="main-login" class="container d-flex flex-column">
        <div class="row align-items-center justify-content-center g-0
        min-vh-100">
            <img class="position-fixed z-n1 opacity-25"
                src="https://png.pngtree.com/thumb_back/fw800/background/20240430/pngtree-tree-planting-on-black-soil-in-forest-background-image_15722421.jpg" alt="Background"
                style="height: 100vh;margin:0;padding:0;top:0;left:0">
            <div class="col-12 col-md-8 col-lg-6 col-xxl-5 py-8 py-xl-0 z-1">
                <!-- Logo ICON -->
                <!-- <div class="mx-auto text-center my-4"><i class="bi bi-browser-edge fs-1 text-primary "></i></div> -->
                <!-- Logo IMAGE -->
                <div class="my-4 d-flex gap-5 justify-content-center align-items-center">
                    <img src="https://upload.wikimedia.org/wikipedia/commons/thumb/e/e6/Lambang_Kabupaten_Balangan.png/640px-Lambang_Kabupaten_Balangan.png"
                        alt="Logo Kab. Balangan" width="50">
                    <!-- <img src="http://silka.balangankab.go.id/assets/silka3copy.png" alt="Logo Kab. Balangan"
                        width="150">
                    <img src="https://www.iosys.co.uk/images/ssl-security-encryption.png" alt="Logo Kab. Balangan"
                        width="100"> -->
                </div>
                <!-- Card -->
                <div class="card rounded-lg">
                    <!-- Card body -->
                    <div class="card-body p-6">
                        <div class="mb-4 text-center">
                            <h2 class="font-bold"><span class="text-primary text-xl">PENGECEKAN STATUS USULAN</span></h2>
                            <h4>Masukkan NIP Anda untuk melakukan pengecekan status usulan pensiun melalui sistem kami.</h4>
                        </div>
                        <?php
                        $urlRef = isset($_GET['continue']) ? $_GET['continue'] : '';
                        if (!$this->session->csrf_token) {
                            $this->session->csrf_token = hash('sha1', time());
                        }
                        if ($this->session->flashdata('success') && $this->session->userdata('usul')) {
                            $usul = $this->session->userdata('usul');
                            echo '<div class="alert alert-info alert-dismissible fade show" role="alert">';
                            echo 'Data usulan ditemukan: <strong>' . $usul->nip . '</strong>';
                            echo '</div>';
                            echo TrackingUsulan($usul);
                            echo '<div class="d-grid mt-3"><button type="button" class="btn btn-danger" aria-label="Close" onclick="window.location.reload()">OKE</button></div>';
                            return false;
                        }
                        if ($this->session->flashdata('error')) {
                            echo '<div class="alert alert-danger alert-dismissible fade show" role="alert">';
                            echo $this->session->flashdata('error');
                            echo '<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>';
                            echo '</div>';
                        }
                        ?>

                        <?= form_open(base_url("cekstatus/docek")); ?>
                        <!-- Search input -->
                        <div class="mb-3">
                            <label for="search-input" class="form-label fw-bold">Nomor Induk Pegawai (NIP)</label>
                            <input class="form-control form-control-lg" type="search" id="search-input" placeholder="Masukan NIP" name="nip" maxlength="18" minlength="18" value="<?= set_value('nip'); ?>" required>
                            <small id="emailHelp" class="form-text text-muted">Pastikan NIP yang Anda masukkan benar.</small>
                        </div>
                        <div class="mb-3 d-flex flex-column">
                            <label for="captcha" class="form-label fw-bold">Kode Keamanan (CAPTCHA)</label>
                            <div>
                                <img src="<?= base_url('cekstatus/getImageCaptcha') ?>" alt="Captcha" class="img-fluid" width="200" height="50">
                                <button type="button" class="btn btn-link btn-outline-info" onclick="refreshCaptcha()"><i class="bi bi-arrow-clockwise"></i> Refresh</button>
                            </div>
                            <input type="text" class="form-control form-control-lg mt-2 w-50" id="captcha" name="captcha"
                                placeholder="Masukkan kode" required>
                        </div>
                        <div class="d-grid mt-3">
                            <button type="submit" class="btn btn-lg btn-outline-primary">
                                Submit <i class="bi bi-search"></i></button>
                        </div>
                        <?= form_close(); ?>
                        <div style="display: flex; align-items: center; margin: 20px 0;">
                            <hr style="flex: 1; border: none; height: 1px; background-color: #ccc;">
                            <span style="padding: 0 10px; color: #666; font-weight: bold;">OR</span>
                            <hr style="flex: 1; border: none; height: 1px; background-color: #ccc;">
                        </div>
                        <a href="<?= base_url('/') ?>" class="btn btn-link"><i class="bi bi-arrow-left"></i> Kembali Login</a>
                    </div>
                </div>
                <p class="mx-auto mt-4 mb-3 text-center text-black">&copy; <?= date('Y') ?> Dikembangkan Oleh Bidang PPIK. Version <?= phpversion(); ?></p>
            </div>
        </div>
    </div>
    <!-- Scripts -->
    <!-- Libs JS -->
    <script src="<?= base_url('template/') ?>assets/libs/jquery/dist/jquery.min.js"></script>
    <script src="<?= base_url('template/') ?>assets/libs/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
    <script src="<?= base_url('template/') ?>assets/libs/jquery-slimscroll/jquery.slimscroll.min.js"></script>

    <!-- Theme JS -->
    <script src="<?= base_url('template/') ?>assets/js/theme.min.js"></script>
    <script>
        function refreshCaptcha() {
            const captchaImage = document.querySelector('img[alt="Captcha"]');
            captchaImage.src = '<?= base_url('cekstatus/getImageCaptcha') ?>?' + new Date().getTime();
        }
    </script>
</body>

</html>