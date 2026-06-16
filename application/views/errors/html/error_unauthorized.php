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
    </style>
</head>

<body>

    <div class="container error-container">
        <div class="card error-card">
            <div class="card-body p-5">

                <div class="error-icon mb-3">
                    🔒
                </div>

                <h1 class="h3 text-danger mb-3">
                    <?= $heading; ?>
                </h1>

                <div class="text-muted mb-4">
                    <?= $message; ?>
                </div>

                <a href="<?= site_url('/'); ?>" class="btn btn-primary">
                    Login
                </a>

                <button onclick="history.back();" class="btn btn-secondary">
                    Kembali
                </button>

            </div>
        </div>
    </div>

</body>

</html>