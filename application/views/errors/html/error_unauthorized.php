<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="utf-8">
    <title><?= $heading; ?></title>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css">

    <style>
        body {
            background: #f8f9fa;
        }

        .error-container {
            min-height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .error-card {
            max-width: 600px;
            width: 100%;
            text-align: center;
            border: none;
            box-shadow: 0 0 20px rgba(0, 0, 0, .1);
        }

        .error-icon {
            font-size: 80px;
            color: #dc3545;
        }

        .countdown {
            font-size: 14px;
            margin-bottom: 20px;
            color: #6c757d;
        }

        .countdown span {
            font-weight: bold;
            color: #dc3545;
        }
    </style>
</head>

<body>

    <?php $login_url = site_url('/'); ?>

    <div class="container error-container">
        <div class="card error-card">
            <div class="card-body p-5">

                <div class="error-icon mb-3">
                    🔒
                </div>

                <h1 class="h3 text-danger mb-3">
                    <?= $heading; ?>
                </h1>

                <div class="text-muted mb-3">
                    <?= $message; ?>
                </div>

                <div class="countdown">
                    Anda akan dialihkan ke halaman login dalam
                    <span id="countdown">5</span> detik...
                </div>

                <a href="<?= $login_url; ?>" class="btn btn-primary">
                    Login
                </a>

                <button onclick="history.back();" class="btn btn-secondary">
                    Kembali
                </button>

            </div>
        </div>
    </div>

    <script>
        let seconds = 5;
        const countdownElement = document.getElementById('countdown');
        const loginUrl = '<?= $login_url; ?>';

        const timer = setInterval(function() {
            seconds--;
            countdownElement.textContent = seconds;

            if (seconds <= 0) {
                clearInterval(timer);
                window.location.href = loginUrl;
            }
        }, 1000);
    </script>

</body>

</html>