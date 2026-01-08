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
    <title>Psikologi | Jaga Mental</title>
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

    <img src="../assets/img/artikel3.jpg" class="artikel-cover" alt="Psikologi">

    <span class="badge bg-primary mb-3">Psikologi</span>

    <h2 class="fw-bold mb-2">
        Pentingnya Konsultasi Psikologi untuk Kesehatan Mental
    </h2>

    <div class="artikel-meta mb-4">
        Ditulis oleh <b>Admin</b> • 2026
    </div>

    <div class="artikel-isi">
        <p>
            Psikologi adalah ilmu yang mempelajari perilaku, pikiran, dan emosi manusia.
            Konsultasi dengan psikolog profesional dapat membantu seseorang memahami
            kondisi mentalnya secara lebih objektif.
        </p>

        <p>
            Banyak orang masih ragu untuk berkonsultasi karena stigma sosial.
            Padahal, konsultasi psikologi bukan tanda kelemahan,
            melainkan langkah berani untuk memperbaiki kualitas hidup.
        </p>

        <p>
            Manfaat konsultasi psikologi antara lain:
        </p>

        <ul>
            <li>Mengenali akar masalah emosional</li>
            <li>Mendapatkan strategi coping yang sehat</li>
            <li>Mengurangi stres dan kecemasan</li>
            <li>Meningkatkan kepercayaan diri</li>
        </ul>

        <p>
            Dengan bantuan profesional, individu dapat belajar mengelola emosi
            dan mengambil keputusan yang lebih sehat secara mental.
        </p>
    </div>

</div>

</body>
</html>
