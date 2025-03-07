<?php
$hostname = 'localhost';
$username = 'root';
$password = '';
$dbname   = 'db_irfastore';

// Buat koneksi ke database
$conn = mysqli_connect($hostname, $username, $password, $dbname);

// Periksa koneksi
if (!$conn) {
    die('Gagal terhubung ke database: ' . mysqli_connect_error());
}
?>
