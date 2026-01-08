<?php
session_start();
if (empty($_SESSION['csrf_token'])) {
    $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Daftar | Jaga Mental</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600;700&display=swap" rel="stylesheet">

    <style>
        * { box-sizing: border-box; }
        body { font-family: 'Inter', sans-serif; margin: 0; background-color: #f8fafc; }
        .auth-container { min-height: 100vh; }
        .btn-back {
            position: fixed; top: 16px; left: 16px; z-index: 100;
            background: #fff; padding: 6px 12px; border-radius: 8px;
            font-size: 0.85rem; text-decoration: none; color: #2563eb;
            box-shadow: 0 3px 8px rgba(0,0,0,.08);
        }
        .auth-left { height: 100vh; padding: 0; }
        .auth-left img { width: 100%; height: 100%; object-fit: cover; }
        .auth-right {
            min-height: 100vh; padding: 24px 16px;
            display: flex; justify-content: center; overflow-y: auto;
        }
        .form-wrapper { width: 100%; max-width: 380px; margin: auto; }
        .form-wrapper h2 { font-weight: 700; font-size: 1.4rem; }
        .form-wrapper p { color: #64748b; font-size: 0.85rem; margin-bottom: 18px; }
        .form-label { font-size: 0.85rem; margin-bottom: 4px; }
        .form-control { border-radius: 10px; padding: 8px 10px; font-size: 0.85rem; }
        .mb-3 { margin-bottom: 12px !important; }
        .mb-4 { margin-bottom: 16px !important; }
        .btn-primary { border-radius: 12px; padding: 10px; font-size: 0.9rem; font-weight: 600; }
        @media (max-width: 768px) { .auth-left { display: none; } }
    </style>
</head>
<body>

<a href="index.php" class="btn-back">
    <i class="bi bi-arrow-left"></i> Kembali
</a>

<div class="container-fluid auth-container">
    <div class="row g-0">

        <div class="col-md-7 auth-left d-none d-md-block">
            <img src="assets/img/yess sir.jpg" alt="Ilustrasi Jaga Mental">
        </div>

        <div class="col-md-5 auth-right">
            <div class="form-wrapper">

                <h2 class="text-primary mb-1">
                    <i class="bi bi-heart-pulse"></i> Jaga Mental
                </h2>
                <p>Buat akun baru untuk mulai menjaga kesehatan mentalmu.</p>

                <!-- 🔔 PESAN ERROR / SUKSES -->
                <?php if (isset($_SESSION['error'])): ?>
                    <div class="alert alert-danger">
                        <?= $_SESSION['error']; unset($_SESSION['error']); ?>
                    </div>
                <?php endif; ?>

                <?php if (isset($_SESSION['success'])): ?>
                    <div class="alert alert-success">
                        <?= $_SESSION['success']; unset($_SESSION['success']); ?>
                    </div>
                <?php endif; ?>

                <form action="proses/register_process.php" method="POST">

                    <input type="hidden" name="csrf_token" value="<?= $_SESSION['csrf_token']; ?>">

                    <div class="mb-3">
                        <label class="form-label">Username</label>
                        <input type="text" name="username" class="form-control" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Email</label>
                        <input type="email" name="email" class="form-control" required>
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Password</label>
                        <input type="password" name="password" class="form-control" required>
                        <small class="text-muted">
                            Password minimal 8 karakter, mengandung huruf besar, huruf kecil, dan angka.
                        </small>
                    </div>

                    <div class="mb-4">
                        <label class="form-label">Konfirmasi Password</label>
                        <input type="password" name="confirm_password" class="form-control" required>
                    </div>

                    <button type="submit" class="btn btn-primary w-100">Daftar</button>
                </form>

                <p class="mt-3 text-center" style="font-size:0.85rem;">
                    Sudah punya akun?
                    <a href="login.php" class="fw-semibold text-primary text-decoration-none">Masuk</a>
                </p>

            </div>
        </div>

    </div>
</div>
</body>
</html>
