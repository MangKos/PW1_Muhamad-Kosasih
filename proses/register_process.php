<?php
session_start();
require_once __DIR__ . '/../config/koneksi.php';

//    CSRF
if (
    empty($_POST['csrf_token']) ||
    empty($_SESSION['csrf_token']) ||
    !hash_equals($_SESSION['csrf_token'], $_POST['csrf_token'])
) {
    $_SESSION['error'] = "Permintaan tidak valid (CSRF terdeteksi).";
    header("Location: ../register.php");
    exit;
}

// ambil input
$username = trim($_POST['username'] ?? '');
$email    = trim($_POST['email'] ?? '');
$password = $_POST['password'] ?? '';
$confirm  = $_POST['confirm_password'] ?? '';

if ($username === '' || $email === '' || $password === '' || $confirm === '') {
    $_SESSION['error'] = "Semua field wajib diisi.";
    header("Location: ../register.php");
    exit;
}

if ($password !== $confirm) {
    $_SESSION['error'] = "Konfirmasi password tidak cocok.";
    header("Location: ../register.php");
    exit;
}

if (
    strlen($password) < 8 ||
    !preg_match('/[A-Z]/', $password) ||
    !preg_match('/[a-z]/', $password) ||
    !preg_match('/[0-9]/', $password)
) {
    $_SESSION['error'] = "Password minimal 8 karakter, mengandung huruf besar, huruf kecil, dan angka.";
    header("Location: ../register.php");
    exit;
}

// cek nama
$stmt = mysqli_prepare(
    $koneksi,
    "SELECT id FROM users WHERE username = ? OR email = ?"
);
mysqli_stmt_bind_param($stmt, "ss", $username, $email);
mysqli_stmt_execute($stmt);
mysqli_stmt_store_result($stmt);

if (mysqli_stmt_num_rows($stmt) > 0) {
    $_SESSION['error'] = "Username atau email sudah terdaftar.";
    mysqli_stmt_close($stmt);
    header("Location: ../register.php");
    exit;
}
mysqli_stmt_close($stmt);

// hash kata sandi
$hash = password_hash($password, PASSWORD_DEFAULT);

$stmt = mysqli_prepare(
    $koneksi,
    "INSERT INTO users (username, email, password) VALUES (?, ?, ?)"
);
mysqli_stmt_bind_param($stmt, "sss", $username, $email, $hash);

if (mysqli_stmt_execute($stmt)) {


    $_SESSION['success'] = "Pendaftaran berhasil! Silakan login.";
    mysqli_stmt_close($stmt);
    header("Location: ../login.php");
    exit;

} else {
    $_SESSION['error'] = "Terjadi kesalahan saat mendaftar.";
    mysqli_stmt_close($stmt);
    header("Location: ../register.php");
    exit;
}
