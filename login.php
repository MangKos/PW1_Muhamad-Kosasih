<?php
// ===== Secure Session Configuration =====
session_set_cookie_params([
    'lifetime' => 0,
    'path' => '/',
    'secure' => true,     // aktifkan jika HTTPS
    'httponly' => true,
    'samesite' => 'Strict'
]);
session_start();

// Jika sudah login, redirect ke dashboard
if (isset($_SESSION['login']) && $_SESSION['login'] === true) {
    header("Location: dashboard.php");
    exit;
}

// Generate CSRF token
if (empty($_SESSION['csrf_token'])) {
    $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
}
?>
<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Masuk | Jaga Mental</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600;700&display=swap" rel="stylesheet">

    <style>
        * { box-sizing: border-box; }
        body {
            font-family: 'Inter', sans-serif;
            margin: 0;
            height: 100vh;
            overflow: hidden;
            background-color: #f8fafc;
        }
        .auth-container { height: 100vh; }
        .btn-back {
            position: fixed; top: 16px; left: 16px; z-index: 1000;
            background: #ffffff; padding: 6px 12px; border-radius: 8px;
            font-size: 0.85rem; text-decoration: none; color: #2563eb;
            box-shadow: 0 3px 8px rgba(0, 0, 0, .08);
        }
        .auth-left { padding: 60px 50px; display: flex; flex-direction: column; justify-content: center; }
        .auth-left h2 { font-weight: 700; }
        .auth-left p { color: #64748b; font-size: 0.95rem; }
        .form-control { border-radius: 12px; padding: 12px; }
        .btn-primary { border-radius: 14px; padding: 12px; font-weight: 600; }
        .auth-right { padding: 0; height: 100vh; }
        .auth-right img { width: 100%; height: 100%; object-fit: cover; }

        @media (max-width: 768px) { .auth-right { display: none; } }
    </style>
</head>

<body>
<a href="index.php" class="btn-back">
    <i class="bi bi-arrow-left"></i> Kembali
</a>

<div class="container-fluid auth-container">
    <div class="row h-100">

        <div class="col-md-5 auth-left">
            <h2 class="text-primary mb-2">
                <i class="bi bi-heart-pulse"></i> Jaga Mental
            </h2>
            <p class="mb-4">Selamat datang kembali, silakan masuk ke akunmu.</p>

            <form action="proses/login_process.php" method="POST">
                <!-- CSRF TOKEN -->
                <input type="hidden" name="csrf_token"
                       value="<?= htmlspecialchars($_SESSION['csrf_token']) ?>">

                <div class="mb-3">
                    <label class="form-label">Username</label>
                    <input type="text" name="username" class="form-control" required>
                </div>

                <div class="mb-4">
                    <label class="form-label">Password</label>
                    <input type="password" name="password" class="form-control" required>
                </div>

                <div class="form-check mb-3">
                    <input class="form-check-input" type="checkbox" name="remember" id="remember">
                    <label class="form-check-label" for="remember">Ingat saya</label>
                </div>

                <button type="submit" name="login" class="btn btn-primary w-100">
                    Masuk
                </button>
            </form>

            <p class="mt-4 text-center">
                Belum punya akun?
                <a href="register.php" class="fw-semibold text-primary text-decoration-none">
                    Daftar
                </a>
            </p>
        </div>

        <div class="col-md-7 auth-right d-none d-md-block">
            <img src="assets/img/yess sir.jpg" alt="Ilustrasi Jaga Mental">
        </div>

    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
