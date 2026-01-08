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
    <title>Tidur Berkualitas | Jaga Mental</title>
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

    <img src="../assets/img/artikel4.jpg" class="artikel-cover" alt="Tidur Berkualitas">

    <span class="badge bg-primary mb-3">Tidur</span>

    <h2 class="fw-bold mb-2">
        Tidur Berkualitas untuk Kesehatan Mental dan Fisik
    </h2>

    <div class="artikel-meta mb-4">
        Ditulis oleh <b>Admin</b> • 2026
    </div>

    <div class="artikel-isi">
        <p>
            Tidur memiliki peran penting dalam menjaga kesehatan mental dan fisik.
            Kurang tidur dapat memengaruhi suasana hati, konsentrasi,
            serta meningkatkan risiko stres dan kecemasan.
        </p>

        <p>
            Saat tidur, tubuh melakukan proses pemulihan,
            termasuk memperbaiki sel-sel tubuh dan menyeimbangkan hormon.
            Oleh karena itu, kualitas tidur sama pentingnya dengan durasinya.
        </p>

        <p>
            Beberapa tips untuk mendapatkan tidur yang berkualitas:
        </p>

        <ul>
            <li>Tidur dan bangun di jam yang sama setiap hari</li>
            <li>Hindari penggunaan gadget sebelum tidur</li>
            <li>Ciptakan suasana kamar yang nyaman dan tenang</li>
            <li>Batasi konsumsi kafein di malam hari</li>
        </ul>

        <p>
            Dengan tidur yang cukup dan berkualitas,
            tubuh dan pikiran akan lebih siap menghadapi aktivitas sehari-hari.
        </p>
    </div>

</div>

</body>
</html>
