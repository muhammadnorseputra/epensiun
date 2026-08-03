<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CEK STATUS USULAN PENSIUN | SIMPUN (Sistem Informasi Pengelolaan Usulan Pensiun)</title>

    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <link href="<?php echo base_url('template/assets/libs/bootstrap-icons/font/bootstrap-icons.css') ?>"
        rel="stylesheet">
    <link href="<?php echo base_url('template/assets/libs/jquery-form-validator/form-validator/theme-default.css') ?>"
        rel="stylesheet">
    <style>
    body {
        font-family: 'Inter', sans-serif;
    }

    .text-gradient-green {
        background: linear-gradient(90deg, #00ed64 0%, #7cf9ab 100%);
        -webkit-background-clip: text;
        background-clip: text;
        color: transparent;
    }

    .bg-grid {
        background-image:
            linear-gradient(rgba(255, 255, 255, 0.045) 1px, transparent 1px),
            linear-gradient(90deg, rgba(255, 255, 255, 0.045) 1px, transparent 1px);
        background-size: 44px 44px;
    }

    .bg-grid-dark {
        background-image:
            linear-gradient(rgba(0, 30, 43, 0.05) 1px, transparent 1px),
            linear-gradient(90deg, rgba(0, 30, 43, 0.05) 1px, transparent 1px);
        background-size: 44px 44px;
    }

    .pulse-dot {
        animation: pulse-dot 2s ease-in-out infinite;
    }

    @keyframes pulse-dot {

        0%,
        100% {
            opacity: 1;
            transform: scale(1);
        }

        50% {
            opacity: 0.5;
            transform: scale(0.75);
        }
    }

    .btn-shine {
        position: relative;
        overflow: hidden;
    }

    .btn-shine::after {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        height: 100%;
        width: 40%;
        background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.45), transparent);
        transform: translateX(-200%) skewX(-20deg);
        animation: shine 3.5s ease-in-out infinite;
    }

    @keyframes shine {
        0% {
            transform: translateX(-200%) skewX(-20deg);
        }

        60%,
        100% {
            transform: translateX(350%) skewX(-20deg);
        }
    }

    .fade-up {
        animation: fade-up 0.7s ease-out both;
    }

    @keyframes fade-up {
        from {
            opacity: 0;
            transform: translateY(18px);
        }

        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    .fade-up-1 {
        animation-delay: 0.15s;
    }

    .fade-up-2 {
        animation-delay: 0.3s;
    }

    .fade-up-3 {
        animation-delay: 0.45s;
    }
    </style>
</head>

<body class="min-h-screen overflow-x-hidden bg-white">
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

    <div class="lg:grid lg:grid-cols-2 min-h-screen lg:mx-auto lg:w-full">

        <!-- LEFT: HERO BAND -->

        <section class="relative overflow-hidden bg-[#001e2b] flex items-center justify-center px-6 py-10 lg:pl-14 lg:pr-10 lg:py-16">

            <!-- Base grid pattern -->

            <div class="absolute inset-0 bg-grid"></div>

            <!-- Atmospheric glows -->

            <div class="absolute -top-40 -left-40 w-[560px] h-[560px] bg-[#00ed64]/15 rounded-full blur-3xl"></div>

            <div class="absolute -bottom-32 -right-24 w-[620px] h-[620px] bg-[#003d4f]/60 rounded-full blur-3xl"></div>

            <div class="absolute top-1/3 right-8 w-72 h-72 bg-[#00a35c]/20 rounded-full blur-3xl"></div>

            <div class="relative w-full max-w-xl fade-up">

                <!-- Logo -->

                <div class="flex items-center gap-4 mb-6">

                    <div class="relative">

                        <div
                        class="h-12 w-12 rounded-2xl bg-gradient-to-br from-[#00ed64] to-[#00a35c] flex items-center justify-center text-[#001e2b] font-extrabold text-2xl shadow-[0_8px_24px_rgba(0,237,100,0.35)]">
                        </div>

                        <div class="pulse-dot absolute -top-1 -right-1 h-3 w-3 rounded-full bg-[#00ed64] ring-2 ring-[#001e2b]"></div>

                    </div>

                    <div>
                        <h2 class="font-extrabold text-xl text-white tracking-tight">
                            SIMPUN
                        </h2>

                        <p class="text-sm text-[#a8b3bc]">
                            Sistem Informasi Pengelolaan Usulan Pensiun
                        </p>
                    </div>

                </div>

                <!-- Badge -->

                <span class="inline-flex items-center gap-2 px-4 py-2 rounded-full bg-[#00ed64]/10 text-[#00ed64] text-sm font-medium border border-[#00ed64]/30 backdrop-blur-sm">
                    <span class="pulse-dot h-1.5 w-1.5 rounded-full bg-[#00ed64]"></span>
                    🔍 Pengecekan Status Usulan
                </span>

                <!-- Heading -->

                <h1 class="mt-5 text-3xl sm:text-5xl font-extrabold leading-[1.08] tracking-tight text-white">

                    Pantau progres

                    <span class="text-gradient-green block">
                        usulan pensiun Anda.
                    </span>

                </h1>

                <p class="mt-4 text-sm sm:text-base text-[#a8b3bc] leading-relaxed max-w-xl">
                    Masukkan NIP untuk mengetahui perkembangan proses usulan pensiun secara cepat, aman, dan
                    real-time melalui SIMPUN.
                </p>

                <!-- Features -->

                <div class="flex flex-wrap gap-2 sm:gap-3 mt-6 max-w-xl">

                    <div class="fade-up fade-up-1 px-3 py-1.5 sm:px-4 sm:py-2 bg-white/5 border border-white/10 rounded-full text-[#c3f0d2] text-xs sm:text-sm transition hover:bg-white/10 hover:border-white/20">
                        ⚡ Cek Status Cepat
                    </div>

                    <div class="fade-up fade-up-2 px-3 py-1.5 sm:px-4 sm:py-2 bg-white/5 border border-white/10 rounded-full text-[#c3f0d2] text-xs sm:text-sm transition hover:bg-white/10 hover:border-white/20">
                        🔒 Aman
                    </div>

                    <div class="fade-up fade-up-3 px-3 py-1.5 sm:px-4 sm:py-2 bg-white/5 border border-white/10 rounded-full text-[#c3f0d2] text-xs sm:text-sm transition hover:bg-white/10 hover:border-white/20">
                        📊 Real-time
                    </div>

                    <div class="fade-up px-3 py-1.5 sm:px-4 sm:py-2 bg-white/5 border border-white/10 rounded-full text-[#c3f0d2] text-xs sm:text-sm transition hover:bg-white/10 hover:border-white/20">
                        📱 Mudah Digunakan
                    </div>

                </div>

            </div>

        </section>

        <!-- RIGHT: FORM CARD -->

        <section class="relative flex items-center justify-center px-6 py-10 lg:pl-10 lg:pr-14 lg:py-16 bg-white overflow-hidden">
            <!-- Base grid pattern -->

            <div class="absolute inset-0 bg-grid-dark"></div>

            <!-- Soft background accents -->

            <div class="absolute -top-24 -right-24 h-80 w-80 rounded-full bg-[#e3fcef] blur-3xl opacity-70"></div>

            <div class="absolute -bottom-24 -left-24 h-80 w-80 rounded-full bg-[#e3fcef] blur-3xl opacity-50"></div>

            <div class="fade-up relative w-full max-w-md rounded-3xl border border-[#e1e5e8] bg-white/90 backdrop-blur-sm shadow-[0_24px_48px_-12px_rgba(0,30,43,0.16)] p-6 lg:p-8">

                <div class="mb-6">

                    <div
                        class="w-14 h-14 rounded-2xl bg-gradient-to-br from-[#00ed64] to-[#00a35c] flex items-center justify-center text-2xl text-[#001e2b] shadow-[0_8px_20px_rgba(0,237,100,0.3)] mb-3">
                        🔍
                    </div>

                    <h2 class="text-2xl font-extrabold tracking-tight text-[#001e2b]">
                        Cek Status
                    </h2>

                    <p class="mt-2 text-[#5c6c7a]">
                        Masukkan data untuk melihat status usulan pensiun.
                    </p>

                </div>
                        <?php
                            $urlRef = isset($_GET['continue']) ? $_GET['continue'] : '';

                            if (! $this->session->csrf_token) {
                                $this->session->csrf_token = hash('sha1', time());
                            }

                            if ($this->session->flashdata('success') && $this->session->userdata('usul')) {

                                $usul = $this->session->userdata('usul');
                            ?>

                        <div
                            class="mb-6 flex items-start gap-3 rounded-2xl border border-[#00a35c] bg-[#e3fcef] px-4 py-4 text-[#00684a]">

                            <div class="flex h-8 w-8 items-center justify-center rounded-full bg-[#00ed64]/20">
                                🔍
                            </div>

                            <div>
                                <p class="font-semibold">
                                    Data usulan ditemukan
                                </p>

                                <p class="mt-1 text-sm">
                                    NIP:
                                    <span class="font-bold">
                                        <?php echo $usul->nip ?>
                                    </span>
                                </p>
                            </div>

                        </div>

                        <?php

                                echo trackingUsulan($usul);

                            ?>

                        <div class="mt-4">
                            <button type="button" onclick="window.location.reload()"
                                class="btn-shine w-full h-14 rounded-full bg-[#00ed64] px-4 py-3 font-semibold text-[#001e2b] transition hover:bg-[#00b545] shadow-[0_8px_24px_rgba(0,237,100,0.35)] cursor-pointer">

                                OKE

                            </button>
                        </div>

                        <?php
                            return false;
                            }

                            if ($this->session->flashdata('error')) {
                            ?>

                        <div id="alert-error"
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
                                        <?php echo $this->session->flashdata('error'); ?>
                                    </p>
                                </div>

                            </div>

                            <button type="button" onclick="document.getElementById('alert-error').remove()"
                                class="text-red-500 transition hover:text-red-700">

                                ✕
                            </button>

                        </div>

                        <?php
                            }
                        ?>

                        <?php echo form_open(base_url("cekstatus/docek")); ?>
                        <!-- NIP -->

                        <div class="mb-4">

                            <label class="block text-sm font-semibold text-[#3d4f5b] mb-2">
                                Nomor Induk Pegawai
                            </label>

                            <input type="search" placeholder="Masukkan NIP" name="nip" data-validation="required,number"
                                maxlength="18" minlength="18" value="<?php echo set_value('nip'); ?>" required
                                class="w-full h-14 rounded-xl border border-[#c1ccd6] px-4 focus:outline-none focus:ring-4 focus:ring-[#c3f0d2] focus:border-[#00684a]">

                        </div>

                        <!-- Captcha -->

                        <div class="mb-4">

                            <label class="block text-sm font-semibold text-[#3d4f5b] mb-2">
                                Kode Keamanan
                            </label>

                            <div class="flex items-center gap-3 mb-3">

                                <img src="<?php echo base_url('cekstatus/getImageCaptcha') ?>" alt="Captcha"
                                    class="h-14 rounded-xl border border-[#e1e5e8]">

                                <button onclick="refreshCaptcha()" type="button"
                                    class="text-[#00684a] text-sm font-medium hover:text-[#00a35c] cursor-pointer">

                                    <i class="bi bi-arrow-clockwise"></i> Refresh

                                </button>

                            </div>

                            <input type="text" name="captcha" data-validation="required,number"
                                placeholder="Masukkan kode CAPTCHA"
                                class="w-full h-14 rounded-xl border border-[#c1ccd6] px-4 focus:outline-none focus:ring-4 focus:ring-[#c3f0d2] focus:border-[#00684a]">

                        </div>

                        <!-- Button -->

                        <button type="submit"
                            class="btn-shine w-full h-14 rounded-full bg-[#00ed64] text-[#001e2b] font-bold hover:bg-[#00b545] transition shadow-[0_8px_24px_rgba(0,237,100,0.35)] cursor-pointer">

                            Submit

                        </button>
                        <?php echo form_close(); ?>

                        <!-- Divider -->

                        <div class="relative my-6">

                            <div class="border-t border-[#e1e5e8]"></div>

                            <span
                                class="absolute left-1/2 -translate-x-1/2 -top-3 bg-white px-4 text-sm text-[#a8b3bc]">

                                ATAU

                            </span>

                        </div>

                        <!-- Back -->

                        <a href="<?php echo base_url('/') ?>"
                            class="flex justify-center text-[#00684a] font-medium hover:text-[#00a35c]">

                            ← Kembali ke Login

                        </a>

                        <!-- Footer -->

                        <div class="mt-6 text-center text-xs text-[#a8b3bc]">

                            &copy; <?php echo date('Y') ?> Dikembangkan Oleh Bidang PPIK. <br /> Version
                            <?php echo phpversion(); ?>

                        </div>

                    </div>

                </section>

    </div>
    <script src="<?php echo base_url('template/assets/libs/jquery/dist/jquery.min.js') ?>"></script>
    <script
        src="<?php echo base_url('template/assets/libs/jquery-form-validator/form-validator/jquery.form-validator.min.js') ?>">
    </script>
    <script>
    $.validate({
        modules: 'security'
    });

    function refreshCaptcha() {
        const captchaImage = document.querySelector('img[alt="Captcha"]');
        captchaImage.src = '<?php echo base_url('cekstatus/getImageCaptcha') ?>?' + new Date().getTime();
    }
    </script>
</body>

</html>