<?php
session_start();
require_once __DIR__ . '/../config/koneksi.php';

if (!isset($_SESSION['login'])) {
    header("Location: ../login.php");
    exit;
}

$user_id = $_SESSION['user_id'];

/* =====================
   DATA MOOD
===================== */
$moodData = [];
$moodQuery = $koneksi->prepare("
    SELECT tanggal, mood 
    FROM mood 
    WHERE user_id = ?
    ORDER BY tanggal ASC
");
$moodQuery->bind_param("i", $user_id);
$moodQuery->execute();
$resultMood = $moodQuery->get_result();

while ($row = $resultMood->fetch_assoc()) {
    $moodData[] = $row;
}

/* =====================
   DATA SELF CARE
===================== */
$selfCareData = [];
$selfCareQuery = $koneksi->prepare("
    SELECT tanggal,
    (fisik + emosional + mental + sosial + istirahat)/5 AS rata
    FROM self_care
    WHERE user_id = ?
    ORDER BY tanggal ASC
");
$selfCareQuery->bind_param("i", $user_id);
$selfCareQuery->execute();
$resultSC = $selfCareQuery->get_result();

while ($row = $resultSC->fetch_assoc()) {
    $selfCareData[] = $row;
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<title>Laporan Kesehatan Mental</title>
<meta name="viewport" content="width=device-width, initial-scale=1">

<!-- BOOTSTRAP CSS -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
<link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&display=swap" rel="stylesheet">

<!-- CHART JS -->
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<style>
body {
    font-family: 'Inter', sans-serif;
    background: #f8fafc;
}
.card {
    border-radius: 18px;
}
</style>
</head>

<body>

<div class="container my-5">

<a href="../dashboard.php" class="text-muted text-decoration-none small">
    <i class="bi bi-arrow-left"></i> Kembali ke Dashboard
</a>

<h4 class="fw-bold mt-3 mb-2">Laporan Kesehatan Mental</h4>
<p class="text-muted mb-4">
    Laporan ini menampilkan perkembangan kondisi mental berdasarkan catatan harian kamu.
</p>

<!-- ================= GRAFIK ================= -->
<div class="row g-4 mb-4">

    <div class="col-md-6">
        <div class="card p-4 shadow-sm">
            <h6 class="fw-semibold mb-3">Grafik Mood Harian</h6>
            <canvas id="moodChart"></canvas>
        </div>
    </div>

    <div class="col-md-6">
        <div class="card p-4 shadow-sm">
            <h6 class="fw-semibold mb-3">Grafik Self Care</h6>
            <canvas id="selfCareChart"></canvas>
        </div>
    </div>

</div>

<!-- ================= INTERPRETASI ================= -->
<div class="card p-4 shadow-sm mb-4">
    <h6 class="fw-semibold mb-2">Interpretasi</h6>
    <p class="text-muted small mb-0">
        Grafik menunjukkan fluktuasi kondisi mental kamu. Nilai yang stabil dan cenderung meningkat
        menunjukkan pengelolaan emosi dan perawatan diri yang baik. Jika terdapat penurunan signifikan
        dalam beberapa hari berturut-turut, disarankan untuk melakukan evaluasi dan mencari dukungan.
    </p>
</div>

<!-- ================= DOWNLOAD ================= -->
<div class="dropdown">
    <button class="btn btn-primary dropdown-toggle px-4"
        type="button"
        data-bs-toggle="dropdown"
        aria-expanded="false">
        <i class="bi bi-download"></i> Download Laporan
    </button>

    <ul class="dropdown-menu shadow-sm">
        <li>
            <a class="dropdown-item d-flex align-items-center gap-2"
               href="../proses/export_pdf.php">
                <i class="bi bi-file-earmark-pdf text-danger"></i>
                PDF
            </a>
        </li>
        <li>
            <a class="dropdown-item d-flex align-items-center gap-2"
               href="../proses/export_excel.php">
                <i class="bi bi-file-earmark-excel text-success"></i>
                Excel
            </a>
        </li>
    </ul>
</div>

</div>

<!-- ================= SCRIPT ================= -->
<script>
const moodData = <?= json_encode($moodData) ?>;
const selfCareData = <?= json_encode($selfCareData) ?>;

new Chart(document.getElementById('moodChart'), {
    type: 'line',
    data: {
        labels: moodData.map(d => d.tanggal),
        datasets: [{
            label: 'Mood',
            data: moodData.map(d => d.mood),
            borderWidth: 3,
            tension: 0.4
        }]
    }
});

new Chart(document.getElementById('selfCareChart'), {
    type: 'line',
    data: {
        labels: selfCareData.map(d => d.tanggal),
        datasets: [{
            label: 'Self Care',
            data: selfCareData.map(d => d.rata),
            borderWidth: 3,
            tension: 0.4
        }]
    }
});
</script>

<!-- BOOTSTRAP JS (INI YANG TADI KURANG) -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
