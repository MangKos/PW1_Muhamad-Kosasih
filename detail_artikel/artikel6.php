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
    <title>Mengelola Emosi | Jaga Mental</title>
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

    <img src="../assets/img/artikel6.jpg" class="artikel-cover" alt="Mengelola Emosi">

    <span class="badge bg-primary mb-3">Emosi</span>

    <h2 class="fw-bold mb-2">
        Mengenali dan Mengelola Emosi dengan Baik
    </h2>

    <div class="artikel-meta mb-4">
        Ditulis oleh <b>Admin</b> • 2026
    </div>

    <div class="artikel-isi">
        <p>
            Emosi merupakan bagian alami dari kehidupan manusia.
            Setiap individu dapat merasakan berbagai emosi seperti senang,
            sedih, marah, takut, maupun cemas.
        </p>

        <p>
            Masalah muncul ketika emosi tidak dikenali atau tidak dikelola
            dengan baik, sehingga dapat memengaruhi perilaku,
            hubungan sosial, dan kesehatan mental.
        </p>

        <p>
            Mengelola emosi bukan berarti menekan perasaan,
            melainkan memahami dan mengekspresikannya secara sehat.
        </p>

        <p>
            Beberapa tips untuk mengelola emosi dengan baik:
        </p>

        <ul>
            <li>Mengenali jenis emosi yang sedang dirasakan</li>
            <li>Memberi waktu untuk menenangkan diri sebelum bereaksi</li>
            <li>Mengungkapkan perasaan dengan cara yang tepat</li>
            <li>Melatih teknik pernapasan atau meditasi</li>
            <li>Mencari bantuan profesional jika diperlukan</li>
        </ul>

        <p>
            Dengan kemampuan mengelola emosi yang baik,
            seseorang dapat menghadapi tantangan hidup dengan lebih sehat
            dan seimbang.
        </p>
    </div>

</div>

</body>
</html>
