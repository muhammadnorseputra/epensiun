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
    <div id="main-login" class="container d-flex flex-column">
        <div class="row align-items-center justify-content-center g-0
        min-vh-100">
            <img class="position-fixed z-n1 opacity-25"
                src="https://png.pngtree.com/thumb_back/fw800/background/20240430/pngtree-tree-planting-on-black-soil-in-forest-background-image_15722421.jpg" alt="Background"
                style="height: 100vh;margin:0;padding:0;top:0;left:0">
            <div class="col-12 col-md-8 col-lg-6 col-xxl-4 py-8 py-xl-0 z-1">
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
                            <a href="<?= base_url() ?>">
                                <h2 class="font-bold"><span class="text-primary text-xl">SIMPUN</span></h2>
                                <h3>Layanan Pegawai Terintegrasi</h3>
                            </a>
                            <p class="mb-4">Silahkan masukan akun yang terdaftar dan aktif pada SILka Online</p>
                        </div>
                        <?php
                        $urlRef = isset($_GET['continue']) ? $_GET['continue'] : '';
                        if (!$this->session->csrf_token) {
                            $this->session->csrf_token = hash('sha1', time());
                        }
                        ?>
                        <!-- Form -->
                        <?= form_open(base_url('auth/cek_akun'), ['autocomplete' => 'off', 'id' => 'f_login', 'class' => 'toggle-disabled', 'novalidate' => ''], ['token' => $this->session->csrf_token, 'continue' => $urlRef]) ?>
                        <!-- Chose user type login v1 -->
                        <!-- <div class="mb-4 d-flex justify-content-between gap-3">
                                <div class="border rounded p-2 w-100 cursor-pointer">
                                    <div class="form-check form-check-inline">
                                        <label class="form-check-label ms-2" for="flexRadioDefault1">
                                            <h1><i class="bi bi-person-badge"></i></h1>
                                            <b>PERSONAL</b>
                                            <p class="small">Masuk dengan akun personal ASN</p>
                                        </label>
                                        <input class="form-check-input p-2 cursor-pointer" type="radio" value="PERSONAL" name="type" id="flexRadioDefault1" required="">
                                    </div>
                                </div>

                                <div class="border p-2 rounded w-100">
                                    <div class="form-check form-check-inline">
                                        <label class="form-check-label ms-2" for="flexRadioDefault2">
                                            <h1><i class="bi bi-person-vcard"></i></h1>
                                            <b>UMPEG</b>
                                            <p class="small">Masuk dengan akun pengelola kepegawaian</p>
                                        </label>
                                        <input class="form-check-input p-2" type="radio" value="UMPEG" data-sanitize="trim" name="type" id="flexRadioDefault2" required="">
                                    </div>
                                </div>
                            </div> -->
                        <!-- Chose user type login v2 -->
                        <div class="fw-bold text-dark mb-2">Pilih type akun :</div>
                        <div class="btn-group mb-4" role="group" aria-label="Basic radio toggle button group">
                            <input type="radio" class="btn-check" name="type" id="type1" autocomplete="off"
                                value="PERSONAL" checked required="">
                            <label class="btn btn-outline-primary w-100" for="type1">
                                <h1><i class="bi bi-person-badge text-warning"></i></h1>
                                <b>PERSONAL</b>
                                <p class="small">Masuk dengan akun personal ASN</p>
                            </label>

                            <input type="radio" class="btn-check" name="type" id="type2" autocomplete="off"
                                value="UMPEG" required="">
                            <label class="btn btn-outline-primary w-100" for="type2">
                                <h1><i class="bi bi-person-vcard text-info"></i></h1>
                                <b>UMPEG</b>
                                <p class="small">Masuk dengan akun pengelola kepegawaian</p>
                            </label>
                        </div>

                        <div id="message"></div>
                        <!-- Username -->
                        <div class="mb-3">
                            <label for="username" class="form-label fw-bold">Username</label>
                            <div class="input-group">
                                <span class="input-group-text" id="basic-addon1"><i
                                        class="bi bi-person-circle"></i></span>
                                <input type="text" id="username" class="form-control" name="username"
                                    data-sanitize="trim" placeholder="Username on SILKa Online" required="">
                            </div>
                        </div>
                        <!-- Password -->
                        <div class="mb-3">
                            <label for="password" class="form-label fw-bold">Password</label>
                            <div class="input-group">
                                <span class="input-group-text" id="basic-addon"><i class="bi bi-lock-fill"></i></span>
                                <input type="password" id="password" class="form-control password-input" name="password"
                                    placeholder="**************" required="">
                                <span class="input-group-text" id="basic-addon-append"><button
                                        class="btn btn-sm btn-default border-0 p-0 m-0" type="button"><i
                                            class="bi bi-eye-fill toggle-password fs-5"></i></button></span>
                            </div>

                        </div>


                        <!-- Username v2 -->
                        <!--<div class="form-floating mb-3">
                            <input type="text" id="username" class="form-control" name="username" data-sanitize="trim" placeholder="Username on SILKa Online" required="">
                            <label for="username">Username</label>
                        </div>-->
                        <!-- Password v2 -->
                        <!-- <div class="form-floating mb-3 position-relative">
                            <input type="password" id="password" class="form-control password-input" name="password" placeholder="**************" required="">
                            <button class="btn btn-sm btn-default border-0 position-absolute end-0 top-50 translate-middle-y" type="button"><i class="bi bi-eye-fill toggle-password fs-4"></i></button>
                            <label for="password">Password</label>
                        </div> -->
                        <!-- Checkbox -->
                        <div class="d-lg-flex justify-content-between align-items-center mb-4">
                            <div class="form-check custom-checkbox">
                                <input type="checkbox" class="form-check-input" id="rememberme">
                                <label class="form-check-label" for="rememberme">Remember
                                    me</label>
                            </div>
                        </div>
                        <div>
                            <!-- Button -->
                            <div class="d-grid">
                                <button type="submit" class="btn btn-lg btn-primary"><i class="bi bi-unlock-fill"></i>
                                    Masuk</button>
                            </div>
                            <div class="d-md-flex justify-content-between mt-4">
                                <div>
                                    <a href="https://silka-sso.vercel.app/lupa-password" class="text-inherit fs-5">Forgot your
                                        password?</a>
                                </div>
                            </div>
                            <div style="display: flex; align-items: center; margin: 20px 0;">
                                <hr style="flex: 1; border: none; height: 1px; background-color: #ccc;">
                                <span style="padding: 0 10px; color: #666; font-weight: bold;">OR</span>
                                <hr style="flex: 1; border: none; height: 1px; background-color: #ccc;">
                            </div>
                            <div class="d-grid mt-3">
                                <a href="<?= base_url("oauth/sso/authorize") ?>" class="btn btn-lg btn-success">
                                    Login with SSO <i class="bi bi-fingerprint"></i></a>
                            </div>

                        </div>
                        <?= form_close() ?>
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
    <script
        src="<?= base_url('template/') ?>assets/libs/jquery-form-validator/form-validator/jquery.form-validator.min.js">
    </script>

    <!-- Theme JS -->
    <script src="<?= base_url('template/') ?>assets/js/theme.min.js"></script>
    <script src="<?= base_url('template/') ?>assets/js/auth.js"></script>
</body>

</html>