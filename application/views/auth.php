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
    </style>
</head>

<body class="min-h-screen overflow-x-hidden bg-gradient-to-br from-slate-50 via-blue-50 to-indigo-50">
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
    <div class="fixed inset-0 overflow-hidden -z-10">

<div class="absolute -top-40 -left-40 w-[500px] h-[500px] bg-blue-400/15 rounded-full blur-3xl"></div>

<div class="absolute bottom-0 right-0 w-[600px] h-[600px] bg-indigo-400/15 rounded-full blur-3xl"></div>

</div>
    <div class="container mx-auto">
        <div class="flex justify-center items-center min-h-screen px-6 py-8 lg:px-10">
            <div class="grid lg:grid-cols-2 gap-14 items-center w-full">

                <!-- LEFT SIDE -->
                <div class="relative cursor-default">

                    <!-- Logo -->
                    <div class="flex items-center gap-4 mb-8">

                        <div class="h-14 w-14 rounded-2xl bg-blue-600 flex items-center justify-center text-white font-bold text-3xl shadow-lg">
                            S
                        </div>

                        <div>
                            <h2 class="font-extrabold text-2xl text-slate-900">
                                SIMPUN
                            </h2>

                            <p class="text-sm text-slate-500">
                                Sistem Informasi Pengelolaan Usulan Pensiun
                            </p>
                        </div>

                    </div>

                    <!-- Badge -->
                    <span class="inline-flex items-center gap-2 px-4 py-2 rounded-full bg-blue-100 text-blue-700 text-sm font-medium">
                        🚀 Platform Digital Pengelolaan Pensiun
                    </span>

                    <!-- Title -->
                    <h1 class="mt-6 text-3xl sm:text-5xl xl:text-6xl font-extrabold leading-tight text-slate-900">

                        Urus pensiun jadi

                        <span class="text-blue-600 block">
                            mudah & teratur.
                        </span>

                    </h1>

                    <!-- Card 2 -->
                    <div class="floating-delay absolute right-0 lg:-right-20 xl:right-0 top-14 lg:-top-14 xl:top-14 z-20 hidden lg:block">

                        <div class="bg-white rounded-2xl shadow-xl border border-slate-100 p-4 w-56">

                            <div class="flex items-center gap-2 mb-3">

                                <div class="h-3 w-3 rounded-full bg-blue-500"></div>

                                <span class="font-semibold text-sm">
                                    Informasi Pensiun
                                </span>

                            </div>

                            <p class="text-xs text-slate-500">
                                Informasi terbaru tersedia.
                            </p>

                        </div>

                    </div>

                    <!-- Card 1 -->
                    <div class="floating absolute -right-24 bottom-18 lg:-bottom-18 xl:bottom-18 z-20 hidden lg:block">

                        <div class="bg-white rounded-2xl shadow-xl border border-slate-100 p-4 w-56">

                            <div class="flex items-center gap-2 mb-3">

                                <div class="h-3 w-3 rounded-full bg-green-500"></div>

                                <span class="font-semibold text-sm">
                                    Status Usulan
                                </span>

                            </div>

                            <p class="text-xs text-slate-500">
                                Usulan pensiun berhasil diverifikasi.
                            </p>

                        </div>

                    </div>

                    <!-- Description -->
                    <p class="mt-6 text-sm sm:text-lg text-slate-600 leading-relaxed max-w-xl">
                        Ajukan usulan pensiun, pantau proses secara real-time,
                        dan dapatkan informasi terbaru dengan cepat melalui
                        platform yang aman, modern, dan terintegrasi.
                    </p>

                    <!-- Features -->
                    <div class="flex flex-wrap gap-2 sm:gap-3 mt-4 sm:mt-8">

                        <div class="px-4 py-1 sm:px-4 sm:py-3 bg-white rounded-2xl border border-slate-100 shadow-sm">
                            ⚡ Proses Cepat
                        </div>

                        <div class="px-4 py-1 sm:px-4 sm:py-3  bg-white rounded-2xl border border-slate-100 shadow-sm">
                            📊 Monitoring Real-time
                        </div>

                        <div class="px-4 py-1 sm:px-4 sm:py-3  bg-white rounded-2xl border border-slate-100 shadow-sm">
                            🔔 Notifikasi Otomatis
                        </div>

                    </div>
                </div>

                <!-- RIGHT SIDE -->
                <div class="flex justify-center lg:justify-end">

                    <div
                        class="w-full max-w-md rounded-[32px]
                    border border-white/70
                    bg-white
                    backdrop-blur-xl
                    shadow-[0_25px_80px_rgba(15,23,42,0.12)]
                    p-8">

                        <div class="mb-8">

                            <div class="inline-flex h-16 w-16 items-center justify-center rounded-2xl bg-blue-100 text-blue-600 mb-4">
                                🔐
                            </div>

                            <h2 class="text-2xl sm:text-3xl font-bold text-slate-900">
                                Masuk dengan SSO
                            </h2>

                            <p class="mt-2 text-sm sm:text-normal text-slate-500">
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
                            class="w-full h-14 rounded-2xl bg-sky-600 text-white font-semibold text-lg shadow-lg transition hover:-translate-y-1 hover:bg-sky-700 hover:shadow-xl cursor-pointer disabled:opacity-20 disabled:cursor-wait">
                            Continue with SSO
                        </button>

                        <!-- Divider -->
                        <div class="relative my-8">

                            <div class="border-t border-slate-200"></div>

                            <span
                                class="absolute left-1/2 -translate-x-1/2 -top-2 bg-white rounded-xl px-4 text-sm text-slate-400">

                                ATAU

                            </span>

                        </div>

                        <!-- Actions -->
                        <div class="grid grid-cols-2 gap-4 text-center">

                            <a href="<?= base_url("/cekstatus") ?>"
                                class="group rounded-2xl border border-slate-200 p-5 transition hover:border-blue-500 hover:bg-blue-50 cursor-pointer">
                                <div class="text-3xl mb-2">
                                    📄
                                </div>
                                <div class="font-semibold text-slate-700">
                                    Cek Status Usul
                                </div>

                            </a>

                            <a href="https://drive.google.com/file/d/1gvj4zjsTGtNgu2itWgnBTufuyempmRRX/view?usp=sharing"
                                class="group rounded-2xl border border-slate-200 p-5 transition hover:border-blue-500 hover:bg-blue-50 cursor-pointer">
                                <div class="text-3xl mb-2">
                                    📚
                                </div>
                                <div class="font-semibold text-slate-700">
                                    Panduan
                                </div>
                            </a>

                        </div>

                        <!-- Footer -->
                        <div class="mt-8 pt-6 border-t border-slate-100">

                            <div class="text-center text-sm text-slate-400">
                                © 2026 Bidang PPIK - BKPSDM Kab. Balangan
                            </div>

                            <div class="text-center text-xs text-slate-400 mt-1">
                                Version 1.2
                            </div>

                        </div>

                    </div>

                </div>

            </div>
        </div>
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