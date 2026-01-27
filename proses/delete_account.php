<?php
session_start();
require_once __DIR__ . '/../config/koneksi.php';

// Session validation
if (!isset($_SESSION['login']) || !isset($_SESSION['user_id'])) {
    header("Location: ../login.php");
    exit;
}

$user_id = $_SESSION['user_id'];

// Confirmation check
$action = $_POST['action'] ?? '';
if ($action !== 'confirm_delete') {
    $_SESSION['error'] = "Permintaan tidak valid.";
    header("Location: ../profil.php");
    exit;
}

// Delete user account (cascade delete via database constraints if configured)
$delete = $koneksi->prepare("
    DELETE FROM users 
    WHERE id = ?
    LIMIT 1
");

if (!$delete) {
    $_SESSION['error'] = "Kesalahan sistem: " . $koneksi->error;
    header("Location: ../profil.php");
    exit;
}

$delete->bind_param("i", $user_id);

if ($delete->execute()) {
    if ($delete->affected_rows > 0) {
        // Clear session after successful deletion
        session_unset();
        session_destroy();
        
        // Clear remember me cookie if exists
        if (isset($_COOKIE['user_remember'])) {
            setcookie("user_remember", "", time() - 3600, "/");
        }
        
        // Redirect to login with success message
        header("Location: ../login.php?account_deleted=1");
        exit;
    } else {
        $_SESSION['error'] = "Akun tidak ditemukan.";
    }
} else {
    $_SESSION['error'] = "Gagal menghapus akun. Silakan coba lagi.";
}

$delete->close();
header("Location: ../profil.php");
exit;
?>
