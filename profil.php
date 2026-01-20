<?php
session_start();

if (!isset($_SESSION['login'])) {
    header("Location: login.php");
    exit;
}

$username = $_SESSION['username'];
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Profil | Jaga Mental</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&display=swap" rel="stylesheet">

    <style>
        body {
            font-family: 'Inter', sans-serif;
            background: #f8fafc;
        }

        .profile-card {
            border: none;
            border-radius: 18px;
            padding: 32px;
        }

        .profile-avatar {
            width: 110px;
            height: 110px;
            border-radius: 50%;
            object-fit: cover;
            background: #e5e7eb;
            border: 3px solid #ffffff;
        }

        .profile-name {
            font-weight: 600;
            font-size: 1.1rem;
        }

        .profile-menu a {
            display: flex;
            align-items: center;
            gap: 10px;
            padding: 12px 14px;
            border-radius: 12px;
            text-decoration: none;
            color: #0f172a;
            transition: .2s;
        }

        .profile-menu a:hover {
            background: #f1f5f9;
        }

        footer {
            color: #64748b;
            font-size: 0.85rem;
        }
    </style>
</head>

<body>

<!-- NAVBAR -->
<nav class="navbar navbar-light bg-white shadow-sm">
    <div class="container">
        <a href="dashboard.php" class="navbar-brand fw-bold text-primary">
            <i class="bi bi-arrow-left"></i> Kembali
        </a>
    </div>
</nav>

<div class="container my-5">

    <div class="row justify-content-center">
        <div class="col-md-5">

            <!-- PROFIL CARD -->
            <div class="card profile-card shadow-sm text-center">

                <!-- FOTO PROFIL -->
                <img
                    src="assets/img/yess sir.jpg"
                    alt="Foto Profil"
                    class="profile-avatar mx-auto mb-3"
                >

                <!-- NAMA -->
                <div class="profile-name mb-1">
                    <?= htmlspecialchars($username) ?>
                </div>
                <p class="text-muted small mb-4">
                    Akun Pengguna
                </p>

                <!-- MENU PROFIL -->
                <div class="profile-menu text-start">

                    <a href="#">
                        <i class="bi bi-person"></i>
                        <span>Informasi Akun</span>
                    </a>

                    <a href="#">
                        <i class="bi bi-lock"></i>
                        <span>Ubah Password</span>
                    </a>

                    <a href="logout.php" class="text-danger">
                        <i class="bi bi-box-arrow-right"></i>
                        <span>Keluar</span>
                    </a>

                </div>

            </div>

        </div>
    </div>

</div>

<footer class="text-center py-4">
    <small>©Copyright by 23552011450_MUHAMAD KOSASIH_TIF RP 23 CNS B_UASWEB1</small>
</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
