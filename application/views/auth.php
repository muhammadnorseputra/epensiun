<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SIMPUN - Sistem Informasi Pengelolaan Usulan Pensiun</title>

    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <!-- Favicon icon-->
    <link rel="shortcut icon" type="image/png" href="<?= base_url('template/assets/images/approve.png') ?>">

    <!-- Theme CSS -->
    <link href="<?= base_url('template/assets/libs/bootstrap-icons/font/bootstrap-icons.css') ?>" rel="stylesheet">
    <link href="<?= base_url('template/assets/libs/jquery-toast/iziToast.min.css') ?>" rel="stylesheet" />
    <style>
        body {
            font-family: 'Inter', sans-serif;
        }

        .floating {
            animation: floating 5s ease-in-out infinite;
        }

        .floating-delay {
            animation: floating 5s ease-in-out infinite;
            animation-delay: 1.5s;
        }

        @keyframes floating {

            0%,
            100% {
                transform: translateY(0px);
            }

            50% {
                transform: translateY(-10px);
            }
        }

        .spinner-border {
            display: inline-block;
            width: 2rem;
            height: 2rem;
            vertical-align: middle;
            border: 0.25em solid currentColor;
            border-right-color: transparent;
            border-radius: 9999px;
            animation: spinner-border .75s linear infinite;
        }

        .spinner-border-sm {
            width: 1rem;
            height: 1rem;
            border-width: .18em;
        }

        .me-2 {
            margin-right: .5rem;
        }

        @keyframes spinner-border {
            to {
                transform: rotate(360deg);
            }
        }

        /* Creative extras */
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
                        <div class="h-12 w-12 rounded-2xl bg-gradient-to-br from-[#00ed64] to-[#00a35c] flex items-center justify-center text-[#001e2b] font-extrabold text-2xl shadow-[0_8px_24px_rgba(0,237,100,0.35)]">
                            S
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
                    🚀 Platform Digital Pengelolaan Pensiun
                </span>

                <!-- Title -->
                <h1 class="mt-5 text-3xl sm:text-5xl xl:text-6xl font-extrabold leading-[1.08] tracking-tight text-white">

                    Urus pensiun jadi

                    <span class="text-gradient-green block">
                        mudah & teratur.
                    </span>

                </h1>

                <!-- Dashboard mockup -->
                <div class="floating relative mt-8 mb-2 hidden lg:block xl:mb-16">

                    <div class="bg-white/[0.06] border border-white/10 rounded-2xl backdrop-blur-xl p-5 shadow-[0_24px_48px_-12px_rgba(0,0,0,0.5)]">

                        <div class="flex items-center justify-between mb-4">

                            <div class="flex items-center gap-2">

                                <div class="pulse-dot h-2 w-2 rounded-full bg-[#00ed64]"></div>

                                <span class="text-sm font-semibold text-white">
                                    Progres Usulan Pensiun
                                </span>

                            </div>

                            <span class="text-xs font-medium text-[#00ed64] bg-[#00ed64]/10 border border-[#00ed64]/30 rounded-full px-2.5 py-1">
                                Live
                            </span>

                        </div>

                        <!-- Step 1 -->
                        <div class="flex items-center gap-3 mb-3">

                            <div class="h-7 w-7 rounded-full bg-[#00ed64] flex items-center justify-center text-[#001e2b] text-xs font-bold shrink-0">
                                ✓
                            </div>

                            <div class="flex-1">

                                <div class="flex justify-between text-xs mb-1">
                                    <span class="text-[#c3f0d2]">Pengajuan Diterima</span>
                                    <span class="text-[#a8b3bc]">Selesai</span>
                                </div>

                                <div class="h-1.5 rounded-full bg-white/10">
                                    <div class="h-1.5 rounded-full bg-[#00ed64] w-full"></div>
                                </div>

                            </div>

                        </div>

                        <!-- Step 2 -->
                        <div class="flex items-center gap-3 mb-3">

                            <div class="h-7 w-7 rounded-full border-2 border-[#00ed64] text-[#00ed64] flex items-center justify-center text-xs font-bold shrink-0">
                                2
                            </div>

                            <div class="flex-1">

                                <div class="flex justify-between text-xs mb-1">
                                    <span class="text-[#c3f0d2]">Verifikasi Berkas</span>
                                    <span class="text-[#00ed64]">80%</span>
                                </div>

                                <div class="h-1.5 rounded-full bg-white/10">
                                    <div class="h-1.5 rounded-full bg-[#00ed64] w-4/5"></div>
                                </div>

                            </div>

                        </div>

                        <!-- Step 3 -->
                        <div class="flex items-center gap-3">

                            <div class="h-7 w-7 rounded-full border-2 border-white/20 text-[#a8b3bc] flex items-center justify-center text-xs font-bold shrink-0">
                                3
                            </div>

                            <div class="flex-1">

                                <div class="flex justify-between text-xs mb-1">
                                    <span class="text-[#a8b3bc]">Persetujuan</span>
                                    <span class="text-[#a8b3bc]">Menunggu</span>
                                </div>

                                <div class="h-1.5 rounded-full bg-white/10">
                                    <div class="h-1.5 rounded-full bg-gradient-to-r from-[#00ed64] to-[#00a35c] w-2/5"></div>
                                </div>

                            </div>

                        </div>

                    </div>

                    <!-- Floating estimate card -->
                    <div class="floating-delay absolute -right-6 -bottom-6 hidden xl:block">

                        <div class="bg-[#003d4f]/90 border border-white/10 rounded-xl px-4 py-3 backdrop-blur-xl shadow-[0_12px_24px_-4px_rgba(0,0,0,0.5)]">

                            <p class="text-[10px] uppercase tracking-widest text-[#a8b3bc] mb-1">
                                Estimasi Selesai
                            </p>

                            <p class="text-sm font-bold text-white">
                                12 Hari <span class="text-[#00ed64] font-semibold">lagi</span>
                            </p>

                        </div>

                    </div>

                </div>

                <!-- Description -->
                <p class="mt-4 text-sm sm:text-base text-[#a8b3bc] leading-relaxed max-w-xl">
                    Ajukan usulan pensiun, pantau proses secara real-time,
                    dan dapatkan informasi terbaru dengan cepat melalui
                    platform yang aman, modern, dan terintegrasi.
                </p>

                <!-- Features -->
                <div class="flex flex-wrap gap-2 sm:gap-3 mt-6">

                    <div class="fade-up fade-up-1 px-3 py-1.5 sm:px-4 sm:py-2 bg-white/5 border border-white/10 rounded-full text-[#c3f0d2] text-xs sm:text-sm transition hover:bg-white/10 hover:border-white/20">
                        ⚡ Proses Cepat
                    </div>

                    <div class="fade-up fade-up-2 px-3 py-1.5 sm:px-4 sm:py-2 bg-white/5 border border-white/10 rounded-full text-[#c3f0d2] text-xs sm:text-sm transition hover:bg-white/10 hover:border-white/20">
                        📊 Monitoring Real-time
                    </div>

                    <div class="fade-up fade-up-3 px-3 py-1.5 sm:px-4 sm:py-2 bg-white/5 border border-white/10 rounded-full text-[#c3f0d2] text-xs sm:text-sm transition hover:bg-white/10 hover:border-white/20">
                        🔔 Notifikasi Otomatis
                    </div>

                </div>
            </div>
        </section>

        <!-- RIGHT: AUTH CARD -->
        <section class="relative flex items-center justify-center px-6 py-10 lg:py-16 bg-white overflow-hidden">
            <!-- Base grid pattern -->
            <div class="absolute inset-0 bg-grid-dark"></div>

            <!-- Soft background accents -->
            <div class="absolute -top-24 -right-24 h-80 w-80 rounded-full bg-[#e3fcef] blur-3xl opacity-70"></div>
            <div class="absolute -bottom-24 -left-24 h-80 w-80 rounded-full bg-[#e3fcef] blur-3xl opacity-50"></div>

            <div class="fade-up relative w-full max-w-md rounded-3xl border border-[#e1e5e8] bg-white/90 backdrop-blur-sm shadow-[0_24px_48px_-12px_rgba(0,30,43,0.16)] p-7 lg:p-9">

                        <div class="mb-7">

                            <div class="inline-flex h-14 w-14 items-center justify-center rounded-2xl bg-gradient-to-br from-[#00ed64] to-[#00a35c] text-[#001e2b] shadow-[0_8px_20px_rgba(0,237,100,0.3)] mb-4">
                                🔐
                            </div>

                            <h2 class="text-2xl sm:text-3xl font-extrabold tracking-tight text-[#001e2b]">
                                Masuk dengan SSO
                            </h2>

                            <p class="mt-2 text-sm text-[#5c6c7a]">
                                Login menggunakan akun Single Sign-On untuk mengakses layanan SIMPUN.
                            </p>

                        </div>

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
                            <div
                                id="logout-alert"
                                class="relative mb-4 rounded-xl border px-4 py-3 pr-10 bg-red-50 border-red-300 text-red-800"
                                role="alert">

                                <strong class="font-semibold">
                                    <?= @$sesi['logout_title']; ?>!
                                </strong>

                                <span class="ml-1">
                                    <?= $sesi['logout_message']; ?>
                                </span>

                                <button
                                    type="button"
                                    onclick="document.getElementById('logout-alert').remove()"
                                    class="absolute right-3 top-3 text-current opacity-60 hover:opacity-100">

                                    ✕
                                </button>

                            </div>
                        <?php
                        }
                        ?>

                        <!-- Button -->
                        <button id="loginBtn"
                            class="btn-shine w-full h-14 rounded-full bg-[#00ed64] text-[#001e2b] font-bold text-lg shadow-[0_8px_24px_rgba(0,237,100,0.35)] transition hover:-translate-y-0.5 hover:bg-[#00b545] hover:shadow-[0_12px_28px_rgba(0,237,100,0.4)] cursor-pointer disabled:opacity-20 disabled:cursor-wait">
                            Continue with SSO <span class="ml-1">→</span>
                        </button>

                        <!-- Divider -->
                        <div class="relative my-6">

                            <div class="border-t border-[#e1e5e8]"></div>

                            <span
                                class="absolute left-1/2 -translate-x-1/2 -top-2 bg-white rounded-xl px-4 text-sm text-[#a8b3bc]">

                                ATAU

                            </span>

                        </div>

                        <!-- Actions -->
                        <div class="grid grid-cols-2 gap-4 text-center">

                            <a href="<?= base_url("/cekstatus") ?>"
                                class="group rounded-2xl border border-[#e1e5e8] p-5 transition hover:-translate-y-1 hover:border-[#00a35c] hover:bg-[#f4f7f6] hover:shadow-[0_8px_20px_rgba(0,30,43,0.08)] cursor-pointer">
                                <div class="text-3xl mb-2 transition group-hover:scale-110">
                                    📄
                                </div>
                                <div class="font-semibold text-[#3d4f5b] transition group-hover:text-[#00684a]">
                                    Cek Status Usul
                                </div>

                            </a>

                            <a href="https://drive.google.com/file/d/1gvj4zjsTGtNgu2itWgnBTufuyempmRRX/view?usp=sharing"
                                class="group rounded-2xl border border-[#e1e5e8] p-5 transition hover:-translate-y-1 hover:border-[#00a35c] hover:bg-[#f4f7f6] hover:shadow-[0_8px_20px_rgba(0,30,43,0.08)] cursor-pointer">
                                <div class="text-3xl mb-2 transition group-hover:scale-110">
                                    📚
                                </div>
                                <div class="font-semibold text-[#3d4f5b] transition group-hover:text-[#00684a]">
                                    Panduan
                                </div>
                            </a>

                        </div>

                        <!-- Trust strip -->
                        <div class="mt-7 flex items-center justify-center gap-2 rounded-xl bg-[#f4f7f6] px-4 py-3 text-xs text-[#5c6c7a]">

                            <span class="text-base text-[#00a35c]">🛡️</span>

                            <span>
                                Data Anda aman & terenkripsi — layanan resmi BKPSDM Kab. Balangan
                            </span>

                        </div>

                        <!-- Footer -->
                        <div class="mt-6 pt-5 border-t border-[#e1e5e8]">

                            <div class="text-center text-sm text-[#a8b3bc]">
                                © 2026 Bidang PPIK - BKPSDM Kab. Balangan
                            </div>

                            <div class="text-center text-xs text-[#a8b3bc] mt-1">
                                Version 1.2
                            </div>

                        </div>

                    </div>
                </section>

    </div>
    <!-- Scripts -->
    <!-- Libs JS -->
    <script src="<?= base_url('template/') ?>assets/libs/jquery-toast/iziToast.min.js"></script>

    <!-- Theme JS -->
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
                    onOpened: function(instance, toast) {
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