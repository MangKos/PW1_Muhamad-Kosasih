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
    <title>Mood Tracker | Jaga Mental</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&display=swap" rel="stylesheet">

    <style>
        body {
            font-family: 'Inter', sans-serif;
            background: linear-gradient(135deg, #eef2ff, #f8fafc);
            min-height: 100vh;
        }

        .page-wrapper {
            max-width: 760px;
            margin: auto;
        }

        .mood-card {
            border: none;
            border-radius: 22px;
            box-shadow: 0 15px 40px rgba(0,0,0,.08);
        }

        .section-title {
            font-weight: 700;
            font-size: 1.4rem;
        }

        .section-desc {
            color: #64748b;
            font-size: .95rem;
        }

        /* Mood Option */
        .mood-option input {
            display: none;
        }

        .mood-option label {
            width: 100%;
            padding: 18px 12px;
            border-radius: 16px;
            border: 2px solid #e5e7eb;
            cursor: pointer;
            transition: all .25s ease;
            text-align: center;
            background: #fff;
        }

        .mood-option i {
            font-size: 1.6rem;
            margin-bottom: 6px;
            display: block;
        }

        .mood-option span {
            font-weight: 600;
            font-size: .95rem;
        }

        .mood-option input:checked + label {
            border-color: #2563eb;
            background: #eff6ff;
            color: #1d4ed8;
            box-shadow: 0 8px 20px rgba(37,99,235,.25);
        }

        textarea.form-control {
            border-radius: 14px;
            resize: none;
        }

        .btn-primary {
            border-radius: 14px;
            padding: 12px;
            font-weight: 600;
        }
    </style>
</head>

<body>

<div class="container py-5">
    <div class="page-wrapper">

        <!-- BACK -->
        <a href="../dashboard.php" class="text-decoration-none text-muted small">
            <i class="bi bi-arrow-left"></i> Kembali ke Dashboard
        </a>

        <!-- CARD -->
        <div class="card mood-card mt-3 p-4 p-md-5">

            <!-- HEADER -->
            <div class="mb-4">
                <h3 class="section-title mb-1">Mood Tracker</h3>
                <p class="section-desc mb-0">
                    Luangkan waktu sejenak untuk mengenali perasaanmu hari ini.
                </p>
            </div>

            <form action="../proses/mood_process.php" method="POST">
                <input type="hidden" name="tanggal" value="<?= $tanggal_hari_ini ?>">

                <!-- PILIH MOOD -->
                <label class="form-label fw-semibold mb-3">
                    Bagaimana kondisi emosimu hari ini?
                </label>

                <div class="row g-3 mb-4">

                    <?php
                    $moods = [
                        1 => ['label'=>'Sangat Buruk','icon'=>'bi-emoji-frown'],
                        2 => ['label'=>'Buruk','icon'=>'bi-emoji-expressionless'],
                        3 => ['label'=>'Biasa','icon'=>'bi-emoji-neutral'],
                        4 => ['label'=>'Baik','icon'=>'bi-emoji-smile'],
                        5 => ['label'=>'Sangat Baik','icon'=>'bi-emoji-laughing']
                    ];

                    foreach ($moods as $value => $data):
                    ?>
                    <div class="col-6 col-md-4 mood-option">
                        <input type="radio" name="mood" id="mood<?= $value ?>" value="<?= $value ?>" required>
                        <label for="mood<?= $value ?>">
                            <i class="bi <?= $data['icon'] ?>"></i>
                            <span><?= $data['label'] ?></span>
                        </label>
                    </div>
                    <?php endforeach; ?>

                </div>

                <!-- CATATAN -->
                <div class="mb-4">
                    <label class="form-label fw-semibold">
                        Catatan Pribadi (opsional)
                    </label>
                    <textarea
                        name="catatan"
                        class="form-control"
                        rows="4"
                        placeholder="Tuliskan hal penting yang memengaruhi perasaanmu hari ini..."></textarea>
                </div>

                <!-- SUBMIT -->
                <button type="submit" class="btn btn-primary w-100">
                    Simpan Mood Hari Ini
                </button>
            </form>

        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
