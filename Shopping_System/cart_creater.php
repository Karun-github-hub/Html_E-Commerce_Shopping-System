<?php
include("selectedProduct.php");
// Diğer gerekli başlık ve kodlar...

// Form gönderimi kontrolü
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['addcart'])) {
    // POST verilerini al
    $selectedSizeId = $_POST['selected1'];
    $selectedColourId = $_POST['selected2'];
    $quantity = $_POST['quantity'];
    
    // Diğer işlemleri buraya ekleyin
    // ...

    // Yeni bir öğeyi cart-items tablosuna ekleyin
    $insertSql = $conn->prepare("INSERT INTO `cart_items` (`CART_ITEM_QUANTITY`, `SIZE_ID`, `COLOUR_ID`, `USR_ID`, `PRDCT_ID`) VALUES (?, ?, ?, ?, ?)");
    $insertSql->bind_param("iiiii", $quantity, $selectedSizeId, $selectedColourId, $secilenUsrId, $prdctId);

    if ($insertSql->execute()) {
        // Eğer işlem başarılı ise
        echo '<script>location.replace("index.php");</script>';
    } else {
        // Eğer hata varsa
        echo "Hata oluştu: " . $insertSql->error;
    }

    // Sorgu nesnesini kapat
    $insertSql->close();

    if ($insertSql->affected_rows > 0) {
        echo '<script>location.replace("index.php");</script>';
    } else {
        echo "Hata oluştu: " . $insertSql->error;
    }
}

// Diğer sayfa içeriği ve kapanış etiketleri...

$conn->close();

?>