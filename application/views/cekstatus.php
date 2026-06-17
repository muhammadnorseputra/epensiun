<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CEK STATUS USULAN PENSIUN | SIMPUN (Sistem Informasi Pengelolaan Usulan Pensiun)</title>

    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <link href="<?= base_url('template/assets/libs/bootstrap-icons/font/bootstrap-icons.css') ?>" rel="stylesheet">
    <link href="<?= base_url('template/assets/libs/jquery-form-validator/form-validator/theme-default.css') ?>" rel="stylesheet">
    <style>
        body {
            font-family: 'Inter', sans-serif;
        }
    </style>
</head>

<body class="min-h-screen bg-gradient-to-br from-slate-50 via-blue-50 to-indigo-50">
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
    <!-- Background Decoration -->

    <div class="fixed inset-0 overflow-hidden -z-10">

        <div class="absolute -top-40 -left-40 w-[500px] h-[500px] bg-blue-400/15 rounded-full blur-3xl"></div>

        <div class="absolute bottom-0 right-0 w-[600px] h-[600px] bg-indigo-400/15 rounded-full blur-3xl"></div>

    </div>

    <div class="container mx-auto">

        <div class="min-h-screen flex items-center py-8 px-6 lg:px-10">

            <div class="grid lg:grid-cols-2 gap-16 items-center w-full">

                <!-- LEFT -->

                <div>

                    <!-- Logo -->

                    <div class="flex items-center gap-4 mb-8">

                        <div class="h-14 w-14 rounded-2xl bg-blue-600 flex items-center justify-center text-white font-bold text-xl shadow-lg">
                            S
                        </div>

                        <div>
                            <h2 class="font-bold text-2xl text-slate-900">
                                SIMPUN
                            </h2>

                            <p class="text-sm text-slate-500">
                                Sistem Informasi Pengelolaan Usulan Pensiun
                            </p>
                        </div>

                    </div>

                    <!-- Badge -->

                    <span class="inline-flex px-4 py-2 rounded-full bg-blue-100 text-blue-700 text-sm font-medium">
                        🔍 Pengecekan Status Usulan
                    </span>

                    <!-- Heading -->

                    <h1 class="mt-6 text-3xl sm:text-5xl font-extrabold leading-tight text-slate-900">

                        Pantau progres

                        <span class="text-blue-600 block">
                            usulan pensiun Anda.
                        </span>

                    </h1>

                    <p class="mt-6 text-normal sm:text-lg text-slate-600 leading-relaxed max-w-xl">
                        Masukkan NIP untuk mengetahui perkembangan proses usulan pensiun secara cepat, aman, dan real-time melalui SIMPUN.
                    </p>

                    <!-- Features -->

                    <div class="grid grid-cols-2 gap-4 mt-8 max-w-xl">

                        <div class="bg-white rounded-2xl p-4 border border-slate-100 shadow-sm">
                            ⚡ Cek Status Cepat
                        </div>

                        <div class="bg-white rounded-2xl p-4 border border-slate-100 shadow-sm">
                            🔒 Aman
                        </div>

                        <div class="bg-white rounded-2xl p-4 border border-slate-100 shadow-sm">
                            📊 Real-time
                        </div>

                        <div class="bg-white rounded-2xl p-4 border border-slate-100 shadow-sm">
                            📱 Mudah Digunakan
                        </div>

                    </div>

                    <!-- Illustration -->

                </div>

                <!-- RIGHT -->

                <div class="flex justify-center lg:justify-end">

                    <div
                        class="w-full max-w-md
                        bg-white
                        backdrop-blur-xl
                        rounded-[32px]
                        border border-white
                        shadow-[0_20px_70px_rgba(15,23,42,0.10)]
                        p-8">

                        <div class="mb-8">

                            <div class="w-16 h-16 rounded-2xl bg-blue-100 flex items-center justify-center text-3xl mb-4">
                                🔍
                            </div>

                            <h2 class="text-3xl font-bold text-slate-900">
                                Cek Status
                            </h2>

                            <p class="mt-2 text-slate-500">
                                Masukkan data untuk melihat status usulan pensiun.
                            </p>

                        </div>
                        <?php
                        $urlRef = isset($_GET['continue']) ? $_GET['continue'] : '';

                        if (!$this->session->csrf_token) {
                            $this->session->csrf_token = hash('sha1', time());
                        }

                        if ($this->session->flashdata('success') && $this->session->userdata('usul')) {

                            $usul = $this->session->userdata('usul');
                        ?>

                            <div
                                class="mb-6 flex items-start gap-3 rounded-2xl border border-blue-200 bg-blue-50 px-4 py-4 text-blue-800">

                                <div class="flex h-8 w-8 items-center justify-center rounded-full bg-blue-100">
                                    🔍
                                </div>

                                <div>
                                    <p class="font-semibold">
                                        Data usulan ditemukan
                                    </p>

                                    <p class="mt-1 text-sm">
                                        NIP:
                                        <span class="font-bold">
                                            <?= $usul->nip ?>
                                        </span>
                                    </p>
                                </div>

                            </div>

                            <?php

                            echo trackingUsulan($usul);

                            ?>

                            <div class="mt-6">
                                <button
                                    type="button"
                                    onclick="window.location.reload()"
                                    class="w-full rounded-2xl bg-teal-600 px-4 py-3 font-semibold text-white transition hover:bg-teal-700 cursor-pointer">

                                    OKE

                                </button>
                            </div>

                        <?php
                            return false;
                        }

                        if ($this->session->flashdata('error')) {
                        ?>

                            <div
                                id="alert-error"
                                class="mb-6 flex items-start justify-between gap-4 rounded-2xl border border-red-200 bg-red-50 px-4 py-4 text-red-800">

                                <div class="flex items-start gap-3">

                                    <div class="flex h-8 w-8 items-center justify-center rounded-full bg-red-100">
                                        ⚠️
                                    </div>

                                    <div>
                                        <p class="font-semibold">
                                            Informasi Sistem
                                        </p>

                                        <p class="mt-1 text-sm">
                                            <?= $this->session->flashdata('error'); ?>
                                        </p>
                                    </div>

                                </div>

                                <button
                                    type="button"
                                    onclick="document.getElementById('alert-error').remove()"
                                    class="text-red-500 transition hover:text-red-700">

                                    ✕
                                </button>

                            </div>

                        <?php
                        }
                        ?>

                        <?= form_open(base_url("cekstatus/docek")); ?>
                        <!-- NIP -->

                        <div class="mb-5">

                            <label class="block text-sm font-semibold text-slate-700 mb-2">
                                Nomor Induk Pegawai
                            </label>

                            <input
                                type="search"
                                placeholder="Masukkan NIP"
                                name="nip"
                                data-validation="required,number"
                                maxlength="18"
                                minlength="18"
                                value="<?= set_value('nip'); ?>"
                                required
                                class="w-full h-14 rounded-2xl border border-slate-200 px-4 focus:outline-none focus:ring-4 focus:ring-blue-100 focus:border-blue-500">

                        </div>

                        <!-- Captcha -->

                        <div class="mb-5">

                            <label class="block text-sm font-semibold text-slate-700 mb-2">
                                Kode Keamanan
                            </label>

                            <div class="flex items-center gap-3 mb-3">

                                <img
                                    src="<?= base_url('cekstatus/getImageCaptcha') ?>"
                                    alt="Captcha"
                                    class="h-14 rounded-xl border border-slate-200">

                                <button
                                    onclick="refreshCaptcha()"
                                    type="button"
                                    class="text-blue-600 text-sm font-medium hover:text-blue-700 cursor-pointer">

                                    <i class="bi bi-arrow-clockwise"></i> Refresh

                                </button>

                            </div>

                            <input
                                type="text"
                                name="captcha"
                                data-validation="required,number"
                                placeholder="Masukkan kode CAPTCHA"
                                class="w-full h-14 rounded-2xl border border-slate-200 px-4 focus:outline-none focus:ring-4 focus:ring-blue-100 focus:border-blue-500">

                        </div>

                        <!-- Button -->

                        <button type="submit" class="w-full h-14 rounded-2xl bg-blue-600 text-white font-semibold hover:bg-blue-700 transition shadow-lg cursor-pointer">

                            Submit

                        </button>
                        <?= form_close(); ?>

                        <!-- Divider -->

                        <div class="relative my-8">

                            <div class="border-t border-slate-200"></div>

                            <span
                                class="absolute left-1/2 -translate-x-1/2 -top-3 bg-white px-4 text-sm text-slate-400">

                                ATAU

                            </span>

                        </div>

                        <!-- Back -->

                        <a
                            href="<?= base_url('/') ?>"
                            class="flex justify-center text-blue-600 font-medium hover:text-blue-700">

                            ← Kembali ke Login

                        </a>

                        <!-- Footer -->

                        <div class="mt-8 text-center text-xs text-slate-400">

                            &copy; <?= date('Y') ?> Dikembangkan Oleh Bidang PPIK. <br /> Version <?= phpversion(); ?>

                        </div>

                    </div>

                </div>

            </div>

        </div>

    </div>
    <script src="<?= base_url('template/assets/libs/jquery/dist/jquery.min.js') ?>"></script>
    <script src="<?= base_url('template/assets/libs/jquery-form-validator/form-validator/jquery.form-validator.min.js') ?>"></script>
    <script>
        $.validate({
            modules: 'security'
        });

        function refreshCaptcha() {
            const captchaImage = document.querySelector('img[alt="Captcha"]');
            captchaImage.src = '<?= base_url('cekstatus/getImageCaptcha') ?>?' + new Date().getTime();
        }
    </script>
</body>

</html>