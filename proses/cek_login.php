<?php
session_start();

if (
    !isset($_SESSION['login']) ||
    $_SESSION['login'] !== true ||
    !isset($_SESSION['user_id'])
) {
    header("Location: ../login.php");
    exit;
}
