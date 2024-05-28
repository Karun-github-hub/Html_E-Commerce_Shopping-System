<?php
$vt_hostname="localhost";
$vt_username="root";
$vt_password="";
$vt_database="shop";
$login=mysqli_connect($vt_hostname,$vt_username,$vt_password,$vt_database,3325);
session_start();

if(isset($_POST['sub'])){
    $USR_MAIL = $_POST['USR_MAIL'];
    $USR_PASSWORD = $_POST['USR_PASSWORD'];

    

    $sql = "SELECT * FROM users WHERE USR_MAIL = '{$USR_MAIL}' AND USR_PASSWORD = '{$USR_PASSWORD}'";
    $result = mysqli_query($login, $sql) or die("query failed!");
    if(mysqli_num_rows($result) > 0){
        while($row = mysqli_fetch_assoc($result)){

            $_SESSION['USR_ID'] = $row['USR_ID'];
            $_SESSION['USR_NAME'] = $row['USR_NAME'];
            $_SESSION['USR_SECQUEST'] = $row['USR_SECQUEST'];
            $_SESSION['data'] = $row;

            if ($row['USR_ADM'] == 1) {
            
                echo '<script>location.replace("administration.html");</script>';
            } else {
            
                echo '<script>location.replace("index.php");</script>';
            }    }}
       else{

        $error = "Password does not match!";
         }
    }
?>

<?php 
if(!empty($error)){
    echo'<div class="from_control">
    <p class="error">
    
    <script>
    alert("invalid e-mail adress or password" );
    location.replace("login.html");
    </script>
    
    ';
    

    echo $error;

    echo'</p>
    </div>';
}



?>

