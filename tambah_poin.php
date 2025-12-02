<?php
session_start();

if (!isset($_SESSION['poin'])) {
    $_SESSION['poin'] = 0;
}

if (isset($_POST['poin'])) {
    $tambah = (int) $_POST['poin'];
    $_SESSION['poin'] += $tambah;
}

// Kirim total poin terbaru ke JavaScript
echo $_SESSION['poin'];
