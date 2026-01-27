<?php
session_start();
require_once __DIR__ . '/../config/koneksi.php';

// Session validation
if (!isset($_SESSION['login']) || !isset($_SESSION['user_id'])) {
    header("Location: ../login.php");
    exit;
}

$user_id = $_SESSION['user_id'];
$tanggal = $_POST['tanggal'] ?? '';

// Validation
if (empty($tanggal)) {
    $_SESSION['error'] = "Tanggal tidak valid.";
    header("Location: ../detail_menuutama/mood.php");
    exit;
}

// Delete mood record
$delete = $koneksi->prepare("
    DELETE FROM mood 
    WHERE user_id = ? AND tanggal = ?
    LIMIT 1
");

if (!$delete) {
    $_SESSION['error'] = "Kesalahan sistem: " . $koneksi->error;
    header("Location: ../detail_menuutama/mood.php");
    exit;
}

$delete->bind_param("is", $user_id, $tanggal);

if ($delete->execute()) {
    if ($delete->affected_rows > 0) {
        $_SESSION['success'] = "Data mood berhasil dihapus.";
    } else {
        $_SESSION['error'] = "Data mood tidak ditemukan.";
    }
} else {
    $_SESSION['error'] = "Gagal menghapus data mood.";
}

$delete->close();
header("Location: ../detail_menuutama/mood.php");
exit;
?>
