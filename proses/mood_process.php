<?php
session_start();
require_once __DIR__ . '/../config/koneksi.php';

if (!isset($_SESSION['login'])) {
    header("Location: ../login.php");
    exit;
}

$user_id = $_SESSION['user_id'];
$tanggal = $_POST['tanggal'] ?? '';
$mood    = $_POST['mood'] ?? '';
$catatan = $_POST['catatan'] ?? null;

// Validasi dasar
if (empty($tanggal) || empty($mood)) {
    header("Location: ../detail_menuutama/mood.php?error=invalid");
    exit;
}

// Cek apakah mood hari ini sudah ada
$cek = $koneksi->prepare("
    SELECT 1 FROM mood 
    WHERE user_id = ? AND tanggal = ?
");
$cek->bind_param("is", $user_id, $tanggal);
$cek->execute();
$cek->store_result();

if ($cek->num_rows > 0) {
    // UPDATE jika sudah ada
    $update = $koneksi->prepare("
        UPDATE mood 
        SET mood = ?, catatan = ?
        WHERE user_id = ? AND tanggal = ?
    ");
    $update->bind_param("isis", $mood, $catatan, $user_id, $tanggal);
    $update->execute();
} else {
    // INSERT jika belum ada
    $insert = $koneksi->prepare("
        INSERT INTO mood (user_id, tanggal, mood, catatan)
        VALUES (?, ?, ?, ?)
    ");
    $insert->bind_param("isis", $user_id, $tanggal, $mood, $catatan);
    $insert->execute();
}

header("Location: ../detail_menuutama/mood.php?success=1");
exit;
