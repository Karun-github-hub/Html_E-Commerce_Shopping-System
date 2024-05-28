<?php

$vt_hostname = "localhost";
$vt_username = "root";
$vt_password = "";
$vt_database = "shop";
$baglan = mysqli_connect($vt_hostname, $vt_username, $vt_password, $vt_database, 3325);

$PRDCT_DESC = $_POST['PRDCT_DESC'];
$CMP_NAME = $_POST['CMP_NAME'];
$COLOUR_NAME = $_POST['COLOUR_NAME'];
$CATEGORY_NAME = $_POST['CATEGORY_NAME'];
$PRDCT_NAME = $_POST['PRDCT_NAME'];  // Add this line to get PRDCT_NAME
$UNIT_PRICE = $_POST['UNIT_PRICE'];  // Add this line to get UNIT_PRICE
$PRDCT_IMG = $_FILES['PRDCT_IMG']['name'];  // Add this line to get PRDCT_IMG
$upload_dir = "C:/xampp/htdocs/VTYS/images/";
$target_file = $upload_dir . basename($_FILES["PRDCT_IMG"]["name"]);
$tmp_file = $_FILES["PRDCT_IMG"]["tmp_name"];
move_uploaded_file($tmp_file, $target_file);




if ($baglan->connect_error) {
    die('Connection Failed: ' . $baglan->connect_error);
} else {
    if (isset($_POST['sub'])) {
        // Check if the product already exists
        $checkStmt = $baglan->prepare("SELECT PRDCT_ID FROM products WHERE PRDCT_NAME=?");
        $checkStmt->bind_param("s", $PRDCT_NAME);
        $checkStmt->execute();
        $checkStmt->store_result();

        if ($checkStmt->num_rows > 0) {
            // Update the existing record
            $stmt = $baglan->prepare("UPDATE products SET PRDCT_NAME=?, UNIT_PRICE=?, PRDCT_IMG=?, PRDCT_DESC=? WHERE PRDCT_NAME=?");
            $stmt->bind_param("sisss", $PRDCT_NAME, $UNIT_PRICE, $PRDCT_IMG, $PRDCT_DESC, $PRDCT_NAME);
            $stmt->execute();
            $stmt->close();

            $checkStmt->bind_result($PRDCT_ID);
            $checkStmt->fetch();

            // Update other related tables
            $stmtOther = $baglan->prepare("UPDATE product_category SET CATEGORY_NAME=? WHERE PRDCT_ID=?");
            $stmtOther->bind_param("si", $CATEGORY_NAME, $PRDCT_ID);
            $stmtOther->execute();
            $stmtOther->close();

            $stmtOther2 = $baglan->prepare("UPDATE product_colour SET COLOUR_NAME=? WHERE PRDCT_ID=?");
            $stmtOther2->bind_param("si", $COLOUR_NAME, $PRDCT_ID);
            $stmtOther2->execute();
            $stmtOther2->close();

            $stmtOther4 = $baglan->prepare("UPDATE company SET CMP_NAME=? WHERE PRDCT_ID=?");
            $stmtOther4->bind_param("si", $CMP_NAME, $PRDCT_ID);
            $stmtOther4->execute();
            $stmtOther4->close();
        } else {
            // Insert a new record
            $stmt = $baglan->prepare("INSERT INTO products (PRDCT_NAME, UNIT_PRICE, PRDCT_IMG, PRDCT_DESC) VALUES (?, ?, ?, ?)");
            $stmt->bind_param("siss", $PRDCT_NAME, $UNIT_PRICE, $PRDCT_IMG, $PRDCT_DESC);
            $stmt->execute();
            $stmt->close();

            // Get the newly added product's ID
            $PRDCT_ID = $baglan->insert_id;

            // Insert into other related tables
            $stmtOther = $baglan->prepare("INSERT INTO product_category (PRDCT_ID, CATEGORY_NAME) VALUES (?, ?)");
            $stmtOther->bind_param("is", $PRDCT_ID, $CATEGORY_NAME);
            $stmtOther->execute();
            $stmtOther->close();

            $stmtOther2 = $baglan->prepare("INSERT INTO product_colour (PRDCT_ID, COLOUR_NAME) VALUES (?, ?)");
            $stmtOther2->bind_param("is", $PRDCT_ID, $COLOUR_NAME);
            $stmtOther2->execute();
            $stmtOther2->close();

             if (!empty($_POST['SIZE_NAME'])) {
             foreach ($_POST['SIZE_NAME'] as $selectedSize) {
                
                $stmtOther4 = $baglan->prepare("INSERT INTO product_size (PRDCT_ID, SIZE_NAME) VALUES (?, ?)");
                $stmtOther4->bind_param("is", $PRDCT_ID, $selectedSize);
                $stmtOther4->execute();
                $stmtOther4->close();
            }}

            $stmtOther4 = $baglan->prepare("INSERT INTO company (PRDCT_ID, CMP_NAME) VALUES (?, ?)");
            $stmtOther4->bind_param("is", $PRDCT_ID, $CMP_NAME);
            $stmtOther4->execute();
            $stmtOther4->close();
        }
        $checkStmt->close();
    } elseif (isset($_POST['del'])) {
        $PRDCT_ID = $baglan->insert_id;
        $stmtOther = $baglan->prepare("DELETE FROM product_category WHERE PRDCT_ID IN (SELECT PRDCT_ID FROM products WHERE PRDCT_NAME = ? AND UNIT_PRICE = ?)");
        $stmtOther->bind_param("si", $PRDCT_NAME, $UNIT_PRICE);
        $stmtOther->execute();
        $stmtOther->close();

        $stmtOther2 = $baglan->prepare("DELETE FROM product_colour WHERE PRDCT_ID IN (SELECT PRDCT_ID FROM products WHERE PRDCT_NAME = ? AND UNIT_PRICE = ?)");
        $stmtOther2->bind_param("si", $PRDCT_NAME, $UNIT_PRICE);
        $stmtOther2->execute();
        $stmtOther2->close();

        if (!empty($_POST['SIZE_NAME'])) {
            foreach ($_POST['SIZE_NAME'] as $selectedSize) {
               
                $stmtOther4 = $baglan->prepare("DELETE FROM product_size WHERE PRDCT_ID IN (SELECT PRDCT_ID FROM products WHERE PRDCT_NAME = ? AND UNIT_PRICE = ?)");
                $stmtOther4->bind_param("si", $PRDCT_NAME, $UNIT_PRICE);
                $stmtOther4->execute();
                $stmtOther4->close();
           }}

        $stmtOther4 = $baglan->prepare("DELETE FROM company WHERE PRDCT_ID IN (SELECT PRDCT_ID FROM products WHERE PRDCT_NAME = ? AND UNIT_PRICE = ?)");
        $stmtOther4->bind_param("si", $PRDCT_NAME, $UNIT_PRICE);
        $stmtOther4->execute();
        $stmtOther4->close();

        // Ana tablodan kaydı sil
        $stmt = $baglan->prepare("DELETE FROM products WHERE PRDCT_NAME = ? AND UNIT_PRICE = ?");
        $stmt->bind_param("si", $PRDCT_NAME, $UNIT_PRICE);
        $stmt->execute();
        $stmt->close();

        mysqli_close($baglan);
    }

    echo '
        <script>
            location.replace("administration.html");
        </script>';
}
?>
