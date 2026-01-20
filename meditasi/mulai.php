<?php
session_start();
if (!isset($_SESSION['login'])) {
    header("Location: ../login.php");
    exit;
}

$jenis  = $_GET['jenis'] ?? '';
$durasi = (int) ($_GET['durasi'] ?? 5);

$judul = [
    'pernapasan' => 'Meditasi Pernapasan',
    'relaksasi'  => 'Relaksasi Tubuh',
    'fokus'      => 'Fokus Pikiran'
];

$panduan = [
    'pernapasan' => 'Tarik napas perlahan selama 4 detik, tahan 2 detik, lalu hembuskan selama 6 detik.',
    'relaksasi'  => 'Rilekskan tubuh secara perlahan dari kepala hingga kaki.',
    'fokus'      => 'Fokuskan perhatian pada satu hal dan biarkan pikiran lain berlalu.'
];

if (!isset($judul[$jenis])) {
    header("Location: index.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title><?= $judul[$jenis] ?></title>
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
        #timer {
            font-size: 48px;
            font-weight: bold;
        }
    </style>
</head>
<body>

<div class="container my-5" style="max-width: 600px;">

    <div class="card p-4 text-center">

        <h4 class="fw-bold mb-3"><?= $judul[$jenis] ?></h4>

        <p class="text-muted mb-4"><?= $panduan[$jenis] ?></p>

        <div id="timer"><?= str_pad($durasi, 2, '0', STR_PAD_LEFT) ?>:00</div>

        <p class="small text-muted mt-3">
            Tetap tenang dan fokus hingga sesi selesai.
        </p>

    </div>

</div>

<script>
let durasi = <?= $durasi ?> * 60;
const timerEl = document.getElementById("timer");

const interval = setInterval(() => {
    let menit = Math.floor(durasi / 60);
    let detik = durasi % 60;

    timerEl.textContent =
        menit.toString().padStart(2,'0') + ':' + detik.toString().padStart(2,'0');

    if (durasi <= 0) {
        clearInterval(interval);
        window.location.href = "selesai.php";
    }

    durasi--;
}, 1000);
</script>

</body>
</html>
