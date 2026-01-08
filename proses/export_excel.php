<?php
session_start();
require_once __DIR__ . '/../config/koneksi.php';

if (!isset($_SESSION['login'])) {
    exit('Akses ditolak');
}

$user_id = $_SESSION['user_id'];

header("Content-Type: application/vnd.ms-excel");
header("Content-Disposition: attachment; filename=laporan_kesehatan_mental.xls");

echo "Tanggal\tMood\tSelf Care\n";

$query = $koneksi->prepare("
    SELECT 
        m.tanggal,
        m.mood,
        (s.fisik + s.emosional + s.mental + s.sosial + s.istirahat)/5 AS selfcare
    FROM mood m
    LEFT JOIN self_care s ON m.tanggal = s.tanggal AND m.user_id = s.user_id
    WHERE m.user_id = ?
    ORDER BY m.tanggal ASC
");

$query->bind_param("i", $user_id);
$query->execute();
$result = $query->get_result();

while ($row = $result->fetch_assoc()) {
    echo $row['tanggal'] . "\t" .
         $row['mood'] . "\t" .
         round($row['selfcare'], 2) . "\n";
}
