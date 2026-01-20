<?php
session_start();
require_once __DIR__ . '/../config/koneksi.php';

if (!isset($_SESSION['login'])) {
    header("Location: ../login.php");
    exit;
}

$user_id   = $_SESSION['user_id'];
$tanggal   = $_POST['tanggal'];

$fisik     = $_POST['fisik'];
$emosional = $_POST['emosional'];
$mental    = $_POST['mental'];
$sosial    = $_POST['sosial'];
$istirahat = $_POST['istirahat'];
$catatan   = $_POST['catatan'] ?? null;

/* CEK APAKAH SUDAH ADA DATA HARI INI */
$cek = $koneksi->prepare("
    SELECT id FROM self_care 
    WHERE user_id = ? AND tanggal = ?
");
$cek->bind_param("is", $user_id, $tanggal);
$cek->execute();
$hasil = $cek->get_result();

if ($hasil->num_rows > 0) {

    // UPDATE
    $query = $koneksi->prepare("
        UPDATE self_care SET
            fisik = ?, emosional = ?, mental = ?, sosial = ?, istirahat = ?, catatan = ?
        WHERE user_id = ? AND tanggal = ?
    ");
    $query->bind_param(
        "iiiiisis",
        $fisik, $emosional, $mental, $sosial, $istirahat, $catatan,
        $user_id, $tanggal
    );

} else {

    // INSERT
    $query = $koneksi->prepare("
        INSERT INTO self_care
        (user_id, tanggal, fisik, emosional, mental, sosial, istirahat, catatan)
        VALUES (?, ?, ?, ?, ?, ?, ?, ?)
    ");
    $query->bind_param(
        "isiiiiis",
        $user_id, $tanggal,
        $fisik, $emosional, $mental, $sosial, $istirahat, $catatan
    );
}

$query->execute();

header("Location: ../detail_menuutama/selfcare.php?success=1");
exit;
