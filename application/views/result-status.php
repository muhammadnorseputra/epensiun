<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>SimpunASN · Autentikasi</title>

    <style>
        :root {
            --ink: #ffffff;
            --muted: #a8b3bc;
            --dim: #5c6c7a;
            --line: rgba(255, 255, 255, .09);
            --green: #00ed64;
            --green-mid: #00a35c;
            --ok: #00ed64;
            --err: #fa6e39;
        }

        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
        }

        html,
        body {
            height: 100%;
        }

        body {
            font-family: "Euclid Circular A", "Avenir Next", -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, "Helvetica Neue", Arial, sans-serif;
            color: var(--ink);
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 24px;
            position: relative;
            overflow: hidden;
            background:
                radial-gradient(900px 520px at 12% -10%, rgba(0, 237, 100, .13), transparent 62%),
                radial-gradient(820px 520px at 112% 112%, rgba(0, 61, 79, .6), transparent 62%),
                linear-gradient(180deg, #001e2b, #003144);
        }

        /* grid overlay */
        body::before {
            content: "";
            position: fixed;
            inset: 0;
            pointer-events: none;
            background-image:
                linear-gradient(rgba(168, 179, 188, .04) 1px, transparent 1px),
                linear-gradient(90deg, rgba(168, 179, 188, .04) 1px, transparent 1px);
            background-size: 44px 44px;
            -webkit-mask-image: radial-gradient(circle at 50% 42%, #000, transparent 78%);
            mask-image: radial-gradient(circle at 50% 42%, #000, transparent 78%);
        }

        /* floating orbs */
        .orb {
            position: fixed;
            border-radius: 50%;
            filter: blur(70px);
            opacity: .35;
            pointer-events: none;
            animation: drift 16s ease-in-out infinite alternate;
        }

        .orb.a {
            width: 360px;
            height: 360px;
            background: #00a35c;
            top: -130px;
            left: -110px;
        }

        .orb.b {
            width: 300px;
            height: 300px;
            background: #003d4f;
            bottom: -110px;
            right: -90px;
            animation-delay: -8s;
        }

        @keyframes drift {
            from {
                transform: translate(0, 0) scale(1);
            }
            to {
                transform: translate(46px, 34px) scale(1.12);
            }
        }

        /* ===== card ===== */
        .card {
            position: relative;
            width: min(420px, 100%);
            padding: 38px 34px 22px;
            border-radius: 16px;
            border: 1px solid var(--line);
            background: linear-gradient(180deg, rgba(0, 61, 79, .48), rgba(0, 30, 43, .88));
            -webkit-backdrop-filter: blur(18px) saturate(140%);
            backdrop-filter: blur(18px) saturate(140%);
            box-shadow: 0 30px 80px rgba(0, 6, 14, .6), inset 0 1px 0 rgba(255, 255, 255, .05);
            overflow: hidden;
        }

        .card::before {
            content: "";
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            height: 2px;
            background: linear-gradient(90deg, transparent, rgba(0, 237, 100, .95), rgba(0, 163, 92, .9), transparent);
        }

        /* brand */
        .brand {
            display: flex;
            align-items: center;
            gap: 14px;
            margin-bottom: 34px;
        }

        .emblem {
            width: 46px;
            height: 46px;
            flex: none;
            border-radius: 12px;
            display: grid;
            place-items: center;
            background: linear-gradient(135deg, rgba(0, 237, 100, .18), rgba(0, 163, 92, .08));
            border: 1px solid rgba(0, 237, 100, .3);
            box-shadow: 0 0 24px rgba(0, 237, 100, .22);
        }

        .emblem svg {
            width: 26px;
            height: 26px;
        }

        .brand-txt strong {
            display: block;
            font-size: 16px;
            font-weight: 700;
            letter-spacing: .2px;
        }

        .brand-txt span {
            display: block;
            margin-top: 2px;
            font-size: 9.5px;
            font-weight: 600;
            letter-spacing: 2.6px;
            text-transform: uppercase;
            color: var(--dim);
        }

        /* stages */
        .stages {
            position: relative;
            min-height: 272px;
        }

        .stage {
            position: absolute;
            inset: 0;
            display: flex;
            flex-direction: column;
            align-items: center;
            text-align: center;
            gap: 14px;
            opacity: 1;
            transition: opacity .4s ease, transform .4s ease;
        }

        .stage.is-hidden {
            opacity: 0;
            transform: translateY(10px);
            pointer-events: none;
        }

        .stage-title {
            font-size: 18px;
            font-weight: 600;
            letter-spacing: .2px;
        }

        .stage-sub {
            font-size: 13.5px;
            color: var(--muted);
            max-width: 300px;
            line-height: 1.5;
        }

        .stage-detail {
            font-size: 12px;
            color: var(--dim);
            max-width: 300px;
            line-height: 1.45;
            word-break: break-word;
        }

        /* verify spinner */
        .spinner {
            width: 96px;
            height: 96px;
            margin-top: 14px;
            margin-bottom: 6px;
        }

        .spinner svg {
            width: 100%;
            height: 100%;
        }

        .spin-track {
            fill: none;
            stroke: rgba(255, 255, 255, .07);
            stroke-width: 6;
        }

        .spin-arc {
            fill: none;
            stroke-width: 6;
            stroke-linecap: round;
            stroke-dasharray: 170 251;
            transform-origin: 48px 48px;
            animation: spin 1s linear infinite;
            filter: drop-shadow(0 0 8px rgba(0, 237, 100, .4));
        }

        .shimmer {
            width: 180px;
            height: 3px;
            margin-top: 18px;
            border-radius: 99px;
            background: rgba(255, 255, 255, .06);
            overflow: hidden;
        }

        .shimmer span {
            display: block;
            width: 45%;
            height: 100%;
            border-radius: 99px;
            background: linear-gradient(90deg, transparent, rgba(0, 237, 100, .9), transparent);
            animation: slide 1.1s ease-in-out infinite;
        }

        /* terminal chip (code-mockup aesthetic) */
        .term {
            display: inline-flex;
            align-items: center;
            gap: 9px;
            margin-top: 24px;
            padding: 10px 16px;
            border-radius: 8px;
            border: 1px solid var(--line);
            background: rgba(0, 30, 43, .65);
            font-family: "Source Code Pro", ui-monospace, SFMono-Regular, Menlo, Consolas, monospace;
            font-size: 12.5px;
            line-height: 1.4;
            color: var(--muted);
        }

        .term-p {
            color: var(--green);
            font-weight: 600;
        }

        .term-cursor {
            width: 7px;
            height: 14px;
            border-radius: 1px;
            background: var(--green);
            opacity: .85;
            animation: step 1s steps(1) infinite;
        }

        @keyframes step {
            0%,
            49% {
                opacity: 1;
            }
            50%,
            100% {
                opacity: 0;
            }
        }

        /* result badge */
        .status-badge {
            width: 96px;
            height: 96px;
            margin-top: 14px;
            margin-bottom: 6px;
            border-radius: 50%;
            background: radial-gradient(circle at 50% 42%, rgba(255, 255, 255, .07), transparent 72%);
        }

        .status-badge svg {
            width: 100%;
            height: 100%;
            overflow: visible;
        }

        .badge-circle {
            fill: none;
            stroke-width: 4;
            stroke-dasharray: 276;
            stroke-dashoffset: 276;
            animation: draw 550ms cubic-bezier(.65, 0, .35, 1) forwards;
        }

        .badge-mark {
            fill: none;
            stroke-width: 6;
            stroke-linecap: round;
            stroke-linejoin: round;
            stroke-dasharray: 60;
            stroke-dashoffset: 60;
            animation: draw 420ms ease-out .45s forwards;
        }

        .stage.is-ok .badge-circle {
            stroke: var(--ok);
            filter: drop-shadow(0 0 10px rgba(0, 237, 100, .5));
        }

        .stage.is-ok .badge-mark {
            stroke: var(--ok);
        }

        .stage.is-err .badge-circle {
            stroke: var(--err);
            filter: drop-shadow(0 0 10px rgba(250, 110, 57, .5));
        }

        .stage.is-err .badge-mark {
            stroke: var(--err);
        }

        /* progress */
        .progress {
            width: 220px;
            height: 5px;
            margin-top: 16px;
            border-radius: 99px;
            background: rgba(255, 255, 255, .08);
            overflow: hidden;
        }

        .progress span {
            display: block;
            width: 100%;
            height: 100%;
            border-radius: 99px;
            transform: scaleX(0);
            transform-origin: left;
            transition: transform 2.4s linear;
        }

        .stage.is-ok .progress span {
            background: linear-gradient(90deg, #00b545, #00ed64);
            box-shadow: 0 0 12px rgba(0, 237, 100, .5);
        }

        .stage.is-err .progress span {
            background: linear-gradient(90deg, #f97316, #fa6e39);
            box-shadow: 0 0 12px rgba(250, 110, 57, .5);
        }

        /* closing hint */
        .closing {
            font-size: 11px;
            font-weight: 600;
            letter-spacing: 1.6px;
            text-transform: uppercase;
            color: var(--dim);
            margin-top: 4px;
        }

        .dots i {
            font-style: normal;
            opacity: 0;
            animation: blink 1.2s infinite;
        }

        .dots i:nth-child(2) {
            animation-delay: .2s;
        }

        .dots i:nth-child(3) {
            animation-delay: .4s;
        }

        /* footer */
        .foot {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 7px;
            margin-top: 28px;
            padding-top: 18px;
            border-top: 1px solid var(--line);
            font-size: 11px;
            color: var(--dim);
        }

        .foot svg {
            width: 12px;
            height: 12px;
            flex: none;
            opacity: .7;
        }

        .foot .dot {
            opacity: .4;
        }

        .foot .ver {
            margin-left: auto;
            letter-spacing: .5px;
            opacity: .6;
        }

        /* keyframes */
        @keyframes spin {
            to {
                transform: rotate(360deg);
            }
        }

        @keyframes slide {
            from {
                transform: translateX(-120%);
            }
            to {
                transform: translateX(320%);
            }
        }

        @keyframes draw {
            to {
                stroke-dashoffset: 0;
            }
        }

        @keyframes blink {
            0%,
            60% {
                opacity: 0;
            }
            100% {
                opacity: 1;
            }
        }

        @media (prefers-reduced-motion: reduce) {
            *,
            *::before,
            *::after {
                animation-duration: .01ms !important;
                animation-iteration-count: 1 !important;
                transition-duration: .01ms !important;
            }
        }
    </style>
</head>

<body>

    <div class="orb a"></div>
    <div class="orb b"></div>

    <main class="card" role="status" aria-live="polite">

        <header class="brand">
            <span class="emblem" aria-hidden="true">
                <svg viewBox="0 0 40 40">
                    <defs>
                        <linearGradient id="emblem-grad" x1="0" y1="0" x2="1" y2="1">
                            <stop offset="0%" stop-color="#00ed64" />
                            <stop offset="100%" stop-color="#00a35c" />
                        </linearGradient>
                    </defs>
                    <path d="M20 3 C26 9 31 15 31 21.5 C31 27.5 26 32 20.5 32 C15.5 32 11 28 9.5 22 C8.5 18 9 12 20 3 Z" fill="url(#emblem-grad)" />
                    <path d="M11 21 C14 17.5 17.5 14.5 21 11.5" fill="none" stroke="#001e2b" stroke-width="1.6" stroke-linecap="round" opacity=".55" />
                </svg>
            </span>
            <div class="brand-txt">
                <strong>SimpunASN</strong>
                <span>Portal Pensiun ASN</span>
            </div>
        </header>

        <div class="stages">

            <!-- stage 1 : verify -->
            <section class="stage" id="stage-verify">
                <div class="spinner" aria-hidden="true">
                    <svg viewBox="0 0 96 96">
                        <defs>
                            <linearGradient id="spin-grad" x1="0" y1="0" x2="1" y2="1">
                                <stop offset="0%" stop-color="#00ed64" />
                                <stop offset="100%" stop-color="#00a35c" />
                            </linearGradient>
                        </defs>
                        <circle class="spin-track" cx="48" cy="48" r="40" />
                        <circle class="spin-arc" cx="48" cy="48" r="40" stroke="url(#spin-grad)" />
                    </svg>
                </div>
                <h1 class="stage-title">Memverifikasi sesi Anda</h1>
                <p class="stage-sub">Menghubungkan ke server otentikasi&hellip;</p>
                <div class="shimmer"><span></span></div>
                <div class="term" aria-hidden="true">
                    <span class="term-p">$</span>
                    <span>sso verify --session</span>
                    <span class="term-cursor"></span>
                </div>
            </section>

            <!-- stage 2 : result -->
            <section class="stage is-hidden" id="stage-result">
                <div class="status-badge" aria-hidden="true">
                    <svg viewBox="0 0 96 96">
                        <circle class="badge-circle" cx="48" cy="48" r="44" />
                        <path class="badge-mark" id="badge-mark" d="" />
                    </svg>
                </div>
                <h1 class="stage-title" id="res-title">Login berhasil</h1>
                <p class="stage-sub" id="res-msg"></p>
                <p class="stage-detail" id="res-detail"></p>
                <div class="progress"><span id="bar-fill"></span></div>
                <p class="closing" id="closing">Mengalihkan ke aplikasi<span class="dots"><i>.</i><i>.</i><i>.</i></span></p>
            </section>

        </div>

        <footer class="foot">
            <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                <rect x="3" y="11" width="18" height="11" rx="2" />
                <path d="M7 11V7a5 5 0 0 1 10 0v4" />
            </svg>
            <span>Koneksi terenkripsi</span>
            <span class="dot">&middot;</span>
            <span>SILKA SSO</span>
            <span class="ver">v1.0</span>
        </footer>

    </main>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var STATUS = <?= ($status ?? false) ? 'true' : 'false' ?>;
            var MSG = <?= json_encode($message ?? '', JSON_HEX_TAG | JSON_HEX_AMP | JSON_HEX_APOS | JSON_HEX_QUOT) ?>;
            var DETAIL = <?= json_encode($data ?? '', JSON_HEX_TAG | JSON_HEX_AMP | JSON_HEX_APOS | JSON_HEX_QUOT) ?>;

            function $(id) {
                return document.getElementById(id);
            }

            var verify = $('stage-verify');
            var result = $('stage-result');

            // mark shapes: check (success) / x (failed)
            $('badge-mark').setAttribute('d', STATUS ? 'M30 50 l12 12 l24 -26' : 'M36 36 l24 24 M60 36 l-24 24');

            // stage 1 -> stage 2
            setTimeout(function() {
                verify.classList.add('is-hidden');
                result.classList.remove('is-hidden');
                result.classList.add(STATUS ? 'is-ok' : 'is-err');

                $('res-title').textContent = STATUS ? 'Login berhasil' : 'Login gagal';
                $('res-msg').textContent = STATUS ?
                    (DETAIL ? 'Selamat datang, ' + DETAIL : 'Sesi terverifikasi.') :
                    (MSG || 'Tidak dapat memverifikasi sesi.');
                $('res-detail').textContent = STATUS ?
                    'Mengalihkan ke aplikasi…' :
                    (DETAIL ? DETAIL + ' Silakan coba lagi beberapa saat.' : 'Silakan coba lagi beberapa saat.');
                $('closing').textContent = STATUS ? 'Mengalihkan ke aplikasi' : 'Menutup jendela';

                var delay = STATUS ? 2400 : 3400;

                requestAnimationFrame(function() {
                    $('bar-fill').style.transitionDuration = delay + 'ms';
                    $('bar-fill').style.transform = 'scaleX(1)';
                });

                setTimeout(function() {
                    if (window.opener) {
                        window.opener.postMessage({
                            type: STATUS ? 'SSO_SUCCESS' : 'SSO_FAILED',
                            response: MSG + ' (' + DETAIL + ')'
                        }, '*');
                    }
                    window.close();
                }, delay);
            }, 900);
        });
    </script>

</body>

</html>