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
    <title>Sesi Selesai</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body {
            background: #f8fafc;
        }
        .card {
            border-radius: 20px;
            box-shadow: 0 12px 35px rgba(0,0,0,.08);
            border: none;
        }
    </style>
</head>
<body>

<div class="container my-5" style="max-width: 500px;">

    <div class="card p-4 text-center">

        <h4 class="fw-bold mb-3">🎉 Meditasi Selesai</h4>

        <p class="text-muted mb-4">
            Terima kasih telah meluangkan waktu untuk diri sendiri hari ini.
        </p>

        <a href="index.php" class="btn btn-outline-success w-100 mb-2">
            Ulangi Meditasi
        </a>

        <a href="../dashboard.php" class="btn btn-success w-100">
         Kembali ke Dashboard
        </a>


    </div>

</div>

</body>
</html>
