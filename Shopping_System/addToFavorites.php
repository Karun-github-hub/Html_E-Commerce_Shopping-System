<?php

$vt_hostname = "localhost";
$vt_username = "root";
$vt_password = "";
$vt_database = "shop";
$conn = mysqli_connect($vt_hostname, $vt_username, $vt_password, $vt_database, 3325);

// Bağlantı kontrolü yapın
if ($conn->connect_error) {
    die("Bağlantı hatası: " . $conn->connect_error);
}

// POST parametrelerini alın
$productID = $_POST["productID"];
$userID = $_POST["userID"];

// Favori ürünün zaten eklenip eklenmediğini kontrol et
$checkQuery = "SELECT * FROM favorite_products WHERE PRDCT_ID = '$productID' AND USR_ID = '$userID'";
$checkResult = $conn->query($checkQuery);

if ($checkResult->num_rows > 0) {
    // Favori ürün zaten eklenmiş, uyarı ver
    echo "Bu ürün zaten favorilere eklenmiş.";
} else {
    // Favori ürünü ekleme işlemini yapın
    $insertQuery = "INSERT INTO favorite_products (PRDCT_ID, USR_ID) VALUES ('$productID', '$userID')";

    if ($conn->query($insertQuery) === TRUE) {
        echo "Favori ürün başarıyla eklendi";
    } else {
        echo "Hata: " . $insertQuery . "<br>" . $conn->error;
    }
}

// Veritabanı bağlantısını kapatın
$conn->close();
?>
