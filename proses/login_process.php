<?php
require_once __DIR__ . '/../config/koneksi.php';

session_set_cookie_params([
    'lifetime' => 0,
    'path' => '/',
    'secure' => false, 
    'httponly' => true,
    'samesite' => 'Strict'
]);
session_start();

if (
    empty($_POST['csrf_token']) ||
    empty($_SESSION['csrf_token']) ||
    !hash_equals($_SESSION['csrf_token'], $_POST['csrf_token'])
) {
    $_SESSION['error'] = "Permintaan tidak valid (CSRF).";
    header("Location: ../login.php");
    exit;
}

// input
$username = trim($_POST['username'] ?? '');
$password = $_POST['password'] ?? '';

if ($username === '' || $password === '') {
    $_SESSION['error'] = "Username dan password wajib diisi.";
    header("Location: ../login.php");
    exit;
}

// brute force
// $_SESSION['login_attempt'] = $_SESSION['login_attempt'] ?? 0;
// if ($_SESSION['login_attempt'] >= 5) {
//     $_SESSION['error'] = "Terlalu banyak percobaan login. Coba lagi nanti.";
//     header("Location: ../login.php");
//     exit;
// }

$sql = "SELECT id, username, password FROM users WHERE username = ? LIMIT 1";
$stmt = mysqli_prepare($koneksi, $sql);

if (!$stmt) {
    $_SESSION['error'] = "Kesalahan sistem (query gagal).";
    header("Location: ../login.php");
    exit;
}

mysqli_stmt_bind_param($stmt, "s", $username);
mysqli_stmt_execute($stmt);

mysqli_stmt_bind_result($stmt, $id, $uname, $hash);

if (mysqli_stmt_fetch($stmt)) {

    if (password_verify($password, $hash)) {

        // session fixation
        session_regenerate_id(true);

        $_SESSION['login']    = true;
        $_SESSION['user_id']  = $id;
        $_SESSION['username'] = $uname;

        $_SESSION['login_attempt'] = 0;

        header("Location: ../dashboard.php");
        exit;
    }
}

$_SESSION['login_attempt']++;
$_SESSION['error'] = "Username atau password salah.";
header("Location: ../login.php");
exit;
