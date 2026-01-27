<?php
session_start();
require_once __DIR__ . '/../config/koneksi.php';

if (!isset($_SESSION['login'])) {
    header("Location: ../login.php");
    exit;
}

$tanggal_hari_ini = date('Y-m-d');
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Self Care Tracker | Jaga Mental</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&display=swap" rel="stylesheet">

    <style>
        body {
            font-family: 'Inter', sans-serif;
            background-color: #f8fafc;
        }
        .card-main {
            border: none;
            border-radius: 20px;
            box-shadow: 0 12px 35px rgba(0,0,0,.08);
        }
        .scale-option input {
            display: none;
        }
        .scale-option label {
            width: 100%;
            padding: 12px 0;
            border-radius: 12px;
            border: 2px solid #e5e7eb;
            text-align: center;
            cursor: pointer;
            font-weight: 600;
            transition: .2s;
        }
        .scale-option input:checked + label {
            border-color: #16a34a;
            background-color: #ecfdf5;
            color: #166534;
        }
        .question-box {
            padding: 16px;
            border-radius: 14px;
            background: #ffffff;
            border: 1px solid #e5e7eb;
        }
    </style>
</head>

<body>

<div class="container my-5" style="max-width: 760px;">

    <a href="../dashboard.php" class="text-decoration-none text-muted small">
        <i class="bi bi-arrow-left"></i> Kembali ke Dashboard
    </a>

    <div class="card card-main mt-3 p-4">

        <h4 class="fw-bold mb-1">Self Care Tracker</h4>
        <p class="text-muted mb-4">
            Catat sejauh mana kamu merawat diri hari ini secara jujur dan konsisten.
        </p>

        <!-- PENJELASAN SKALA -->
        <div class="alert alert-light border rounded-3 mb-4">
            <h6 class="fw-bold mb-2">Petunjuk Pengisian</h6>
            <p class="small text-muted mb-3">
                Pilih angka 1 sampai 5 sesuai dengan kondisi yang paling menggambarkan diri Anda hari ini.
            </p>
            <ul class="small text-muted mb-0">
                <li><strong>1</strong> – Sangat Tidak Sesuai / Sangat Buruk</li>
                <li><strong>2</strong> – Tidak Sesuai / Buruk</li>
                <li><strong>3</strong> – Cukup / Netral</li>
                <li><strong>4</strong> – Sesuai / Baik</li>
                <li><strong>5</strong> – Sangat Sesuai / Sangat Baik</li>
            </ul>
        </div>

        <form action="../proses/selfcare_process.php" method="POST">

            <input type="hidden" name="tanggal" value="<?= $tanggal_hari_ini ?>">

            <!-- PERTANYAAN -->
            <?php
            $pertanyaan = [
                'fisik' => 'Saya menjaga kondisi fisik saya hari ini (makan, istirahat, kebersihan).',
                'emosional' => 'Saya mampu mengelola emosi saya dengan baik hari ini.',
                'mental' => 'Saya memberi waktu untuk menenangkan pikiran saya.',
                'sosial' => 'Saya berinteraksi atau berkomunikasi secara sehat dengan orang lain.',
                'istirahat' => 'Saya memberikan waktu istirahat yang cukup untuk diri saya.'
            ];

            foreach ($pertanyaan as $name => $label):
            ?>
            <div class="question-box mb-4">
                <label class="fw-semibold mb-3 d-block"><?= $label ?></label>
                <div class="row g-2">
                    <?php for ($i = 1; $i <= 5; $i++): ?>
                    <div class="col scale-option">
                        <input type="radio" name="<?= $name ?>" id="<?= $name.$i ?>" value="<?= $i ?>" required>
                        <label for="<?= $name.$i ?>"><?= $i ?></label>
                    </div>
                    <?php endfor; ?>
                </div>
            </div>
            <?php endforeach; ?>

            <!-- CATATAN -->
            <div class="mb-4">
                <label class="fw-semibold mb-2">Catatan Tambahan (Opsional)</label>
                <textarea name="catatan" class="form-control" rows="4"
                    placeholder="Catatan singkat terkait perawatan diri hari ini..."></textarea>
            </div>

            <button type="submit" class="btn btn-success w-100 py-2 fw-semibold">
                Simpan Self Care Hari Ini
            </button>

        </form>

        <!-- DELETE FORM -->
        <form action="../proses/delete_selfcare.php" method="POST" style="margin-top: 15px;">
            <input type="hidden" name="tanggal" value="<?= $tanggal_hari_ini ?>">
            <button type="submit" class="btn btn-outline-danger w-100 py-2 fw-semibold" onclick="return confirm('Yakin ingin menghapus data self-care hari ini?');">
                <i class="bi bi-trash"></i> Hapus Data Self Care Hari Ini
            </button>
        </form>

    </div>

</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
