<?php
session_start();
if (!isset($_SESSION['login'])) {
    header("Location: ../login.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Self Care | Jaga Mental</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&display=swap" rel="stylesheet">

    <style>
        body {
            font-family: 'Inter', sans-serif;
            background: #f8fafc;
        }

        .artikel-container {
            max-width: 900px;
            margin: auto;
        }

        .artikel-cover {
            width: 100%;
            height: 420px;
            object-fit: cover;
            border-radius: 18px;
            margin-bottom: 24px;
        }

        .artikel-meta {
            color: #64748b;
            font-size: 0.9rem;
        }

        .artikel-isi p {
            line-height: 1.8;
            margin-bottom: 1rem;
            color: #1e293b;
        }
    </style>
</head>
<body>

<div class="container my-5 artikel-container">

    <a href="../dashboard.php" class="btn btn-outline-primary btn-sm mb-4">
        ← Kembali ke Dashboard
    </a>

    <img src="../assets/img/artikel2.jpg" class="artikel-cover" alt="Self Care">

    <span class="badge bg-primary mb-3">Self Care</span>

    <h2 class="fw-bold mb-2">Pentingnya Self Care dalam Kehidupan Sehari-hari</h2>

    <div class="artikel-meta mb-4">
        Ditulis oleh <b>Admin</b> • 2026
    </div>

    <div class="artikel-isi">
        <p>
            Self care adalah upaya sadar seseorang untuk menjaga kesejahteraan fisik,
            mental, dan emosional. Di tengah tekanan akademik dan sosial,
            self care menjadi kebutuhan yang sangat penting.
        </p>

        <p>
            Banyak orang menganggap self care sebagai bentuk kemewahan,
            padahal sebenarnya ini adalah bagian dari menjaga kesehatan mental.
        </p>

        <p>
            Contoh sederhana self care yang bisa dilakukan sehari-hari:
        </p>

        <ul>
            <li>Mengatur waktu istirahat</li>
            <li>Menjaga pola makan sehat</li>
            <li>Mengurangi penggunaan media sosial berlebihan</li>
            <li>Melakukan aktivitas yang disukai</li>
        </ul>

        <p>
            Dengan melakukan self care secara konsisten,
            seseorang akan lebih mampu mengelola stres dan emosi negatif.
        </p>
    </div>

</div>

</body>
</html>
