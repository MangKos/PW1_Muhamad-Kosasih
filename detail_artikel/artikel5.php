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
    <title>Mengelola Stres | Jaga Mental</title>
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

    <img src="../assets/img/artikel5.jpg" class="artikel-cover" alt="Mengelola Stres">

    <span class="badge bg-primary mb-3">Stres</span>

    <h2 class="fw-bold mb-2">
        Cara Mengelola Stres dalam Kehidupan Sehari-hari
    </h2>

    <div class="artikel-meta mb-4">
        Ditulis oleh <b>Admin</b> • 2026
    </div>

    <div class="artikel-isi">
        <p>
            Stres adalah respon alami tubuh terhadap tekanan atau tantangan.
            Namun, stres yang tidak dikelola dengan baik dapat berdampak
            negatif pada kesehatan mental dan fisik.
        </p>

        <p>
            Beberapa penyebab umum stres antara lain tekanan akademik,
            pekerjaan, masalah keluarga, dan tuntutan sosial.
            Mengenali sumber stres merupakan langkah awal untuk mengatasinya.
        </p>

        <p>
            Berikut beberapa cara efektif untuk mengelola stres:
        </p>

        <ul>
            <li>Atur waktu dengan baik dan buat prioritas</li>
            <li>Lakukan aktivitas fisik secara rutin</li>
            <li>Luangkan waktu untuk relaksasi dan hobi</li>
            <li>Berbagi cerita dengan orang terpercaya</li>
            <li>Istirahat yang cukup dan pola hidup sehat</li>
        </ul>

        <p>
            Dengan pengelolaan stres yang baik,
            kualitas hidup dapat meningkat dan kesehatan mental tetap terjaga.
        </p>
    </div>

</div>

</body>
</html>
