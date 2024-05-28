<?php

$vt_hostname = "localhost";
$vt_username = "root";
$vt_password = "";
$vt_database = "shop";

// MySQL veritabanına bağlantıyı oluştur
$login = mysqli_connect($vt_hostname, $vt_username, $vt_password, $vt_database, 3325);
session_start();
// Bağlantıyı kontrol et
if (!$login) {
    die("Bağlantı başarısız: " . mysqli_connect_error());
}
else{
    // Check if the user is logged in
    if (!isset($_SESSION['USR_ID'])) {
        // Redirect to the login page if not logged in
        header("Location: login.html");
        exit();
    }
    else{
        $USR_ID = $_SESSION['USR_ID'];
    }
}



?>