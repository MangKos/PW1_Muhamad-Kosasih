<?php
session_start();
session_unset();
session_destroy();

// Hapus cookie remember me jika ada
if (isset($_COOKIE['user_remember'])) {
    setcookie("user_remember", "", time() - 3600, "/");
}

header("Location: login.php");
exit;
?>