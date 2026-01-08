<?php
session_start();
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Menjaga Kesehatan Mental | Jaga Mental</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&display=swap" rel="stylesheet">

    <style>
        body {
            font-family: 'Inter', sans-serif;
            background: #ffffff;
            color: #0f172a;
        }

        .artikel-container {
            max-width: 860px;
            margin: auto;
        }

        .judul-artikel {
            font-size: 1.9rem;
            font-weight: 700;
            line-height: 1.3;
        }

        .meta-artikel {
            font-size: 0.85rem;
            color: #475569;
        }

        .meta-artikel span {
            margin-right: 12px;
        }

        .abstract-box {
            background: #f8fafc;
            border-left: 4px solid #2563eb;
            padding: 16px 18px;
            border-radius: 6px;
            font-size: 0.9rem;
        }

        .section-title {
            font-weight: 700;
            margin-top: 2.2rem;
            margin-bottom: .6rem;
        }

        .artikel-isi p {
            line-height: 1.9;
            font-size: 0.95rem;
            text-align: justify;
        }

        .artikel-cover {
            width: 100%;
            border-radius: 8px;
            margin: 24px 0;
        }

        .btn-back {
            font-size: 0.85rem;
            text-decoration: none;
            color: #2563eb;
        }
    </style>
</head>

<body>

<div class="container my-5 artikel-container">

    <!-- KEMBALI -->
    <a href="../dashboard.php" class="btn-back mb-3 d-inline-block">
        ← Kembali ke Dashboard
    </a>

    <!-- JUDUL -->
    <h1 class="judul-artikel">
        Menjaga Kesehatan Mental di Era Digital
    </h1>

    <!-- META -->
    <div class="meta-artikel mb-3">
        <span><strong>Penulis:</strong> Muhamad Kosasih</span>
        <span><strong>Kategori:</strong> Mental Health</span>
        <span><strong>Tahun:</strong> 2026</span>
    </div>

    <!-- ABSTRACT -->
    <div class="abstract-box mb-4">
        <strong>Abstrak —</strong>
        Kesehatan mental merupakan aspek penting dalam kehidupan modern.
        Artikel ini membahas pentingnya menjaga kesehatan mental, faktor
        penyebab gangguan mental, serta strategi pencegahan yang dapat
        diterapkan dalam kehidupan sehari-hari.
    </div>

    <!-- GAMBAR -->
    <img src="../assets/img/artikel1.jpg" class="artikel-cover" alt="Mental Health">

    <!-- ISI ARTIKEL -->
    <div class="artikel-isi">

        <h4 class="section-title">1. Pendahuluan</h4>
        <p>
            Kesehatan mental adalah kondisi kesejahteraan individu yang
            memungkinkan seseorang menyadari potensi dirinya, mengelola stres,
            bekerja secara produktif, dan berkontribusi pada masyarakat.
        </p>

        <h4 class="section-title">2. Faktor Penyebab Gangguan Mental</h4>
        <p>
            Beberapa faktor yang mempengaruhi kesehatan mental meliputi tekanan
            akademik, masalah sosial, lingkungan kerja, serta penggunaan media
            digital yang berlebihan.
        </p>

        <h4 class="section-title">3. Strategi Menjaga Kesehatan Mental</h4>
        <p>
            Strategi yang dapat diterapkan antara lain menjaga pola tidur,
            berolahraga secara rutin, mengelola waktu dengan baik, serta
            berbicara dengan orang yang dipercaya.
        </p>

        <h4 class="section-title">4. Kesimpulan</h4>
        <p>
            Menjaga kesehatan mental adalah investasi jangka panjang yang
            berdampak langsung pada kualitas hidup. Kesadaran dan edukasi
            menjadi kunci utama dalam pencegahan gangguan mental.
        </p>

    </div>

</div>

</body>
</html>
