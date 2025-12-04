<?php
// config/db.php
$DB_HOST = 'localhost';
$DB_NAME = 'iletisim_db';
$DB_USER = 'root';
$DB_PASS = ''; // XAMPP için genelde boş

$mysqli = new mysqli($DB_HOST, $DB_USER, $DB_PASS, $DB_NAME);

if ($mysqli->connect_error) {
    die("Veritabanı bağlantı hatası: " . $mysqli->connect_error);
}

$mysqli->set_charset('utf8mb4');
