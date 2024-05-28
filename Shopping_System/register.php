
<?php

$vt_hostname="localhost";
$vt_username="root";
$vt_password="";
$vt_database="shop";
$baglan=mysqli_connect($vt_hostname,$vt_username,$vt_password,$vt_database,3325);


$USR_NAME = $_POST['USR_NAME'];
$USR_MAIL = $_POST['USR_MAIL'];
$USR_PASSWORD = $_POST['USR_PASSWORD'];
$USR_SECQUEST = $_POST['USR_SECQUEST'];

if($baglan-> connect_error){
    die('Connection Failed: ' .$baglan-> connect_error);
}
else{
$stmt =$baglan->prepare("INSERT INTO users( USR_NAME, USR_MAIL, USR_PASSWORD, USR_SECQUEST) values(?,?,?,?)");
$stmt ->bind_param("ssss",$USR_NAME,$USR_MAIL,$USR_PASSWORD,$USR_SECQUEST);
$stmt->execute();
$stmt-> close();
echo'
<script>
   location.replace("index.php");
</script>

';
}
?>