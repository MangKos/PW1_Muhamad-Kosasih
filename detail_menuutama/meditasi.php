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
    <title>Meditasi | Jaga Mental</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body {
            background: #f8fafc;
        }
        .card {
            border-radius: 18px;
            box-shadow: 0 10px 30px rgba(0,0,0,.08);
            border: none;
        }
    </style>
</head>
<body>

<div class="container my-5" style="max-width: 700px;">

    <a href="../dashboard.php" class="text-muted text-decoration-none small">
        ← Kembali ke Dashboard
    </a>

    <h3 class="fw-bold mt-3 mb-4">Meditasi & Relaksasi</h3>

    <form action="../meditasi/mulai.php" method="GET">

        <div class="card p-4 mb-4">
            <h5 class="fw-semibold mb-3">Pilih Jenis Meditasi</h5>

            <select name="jenis" class="form-select" required>
                <option value="">-- Pilih --</option>
                <option value="pernapasan">Pernapasan</option>
                <option value="relaksasi">Relaksasi Tubuh</option>
                <option value="fokus">Fokus Pikiran</option>
            </select>
        </div>

        <div class="card p-4 mb-4">
            <h5 class="fw-semibold mb-3">Pilih Durasi</h5>

            <select name="durasi" class="form-select" required>
                <option value="3">3 Menit</option>
                <option value="5">5 Menit</option>
                <option value="10">10 Menit</option>
            </select>
        </div>

        <button type="submit" class="btn btn-success w-100 py-2 fw-semibold">
            Mulai Meditasi
        </button>

    </form>

</div>

</body>
</html>
