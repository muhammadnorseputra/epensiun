<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title><?= $message ?? "Loading..."; ?></title>

    <style>
        * {
            box-sizing: border-box;
            font-family: Arial, sans-serif;
        }

        body {
            margin: 0;
            height: 100vh;

            display: flex;
            align-items: center;
            justify-content: center;
            flex-direction: column;

            gap: 20px;

            background: #0b1020;
            color: white;
        }

        .spinner {
            width: 50px;
            height: 50px;

            border: 4px solid rgba(255, 255, 255, 0.2);
            border-top: 4px solid white;

            border-radius: 50%;

            animation: spin 0.7s linear infinite;
        }

        h1 {
            margin: 0;
            font-size: 28px;
            font-weight: 500;
        }

        p {
            margin: 0;
            color: #cbd5e1;
            font-size: 16px;
        }

        @keyframes spin {
            to {
                transform: rotate(360deg);
            }
        }
    </style>
</head>

<body>

    <div class="spinner"></div>

    <?php if (!$status): ?>
        <h1>Login Gagal...</h1>
        <p>Silahkan coba login kembali beberapa saat.</p>
    <?php endif; ?>

    <?php if ($status): ?>
        <h1>Login berhasil...</h1>
        <p>Mengalihkan ke aplikasi</p>
    <?php endif; ?>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            if (!<?= $status ?>) {
                if (window.opener) {
                    window.opener.postMessage({
                        type: "SSO_FAILED",
                        response: "<?= $message ?> (<?= $data; ?>)"
                    }, "*");
                }
                window.close();
                return false;
            }

            // delay 2 detik
            setTimeout(function() {
                // kirim event ke parent window
                if (window.opener) {
                    window.opener.postMessage({
                        type: "SSO_SUCCESS",
                        response: "<?= $message ?> (<?= $data; ?>)"
                    }, "*");
                }
                // tutup popup
                window.close();

            }, 1000);

        });
    </script>

</body>

</html>