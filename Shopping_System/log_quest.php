<?php
$vt_hostname="localhost";
$vt_username="root";
$vt_password="";
$vt_database="shop";
$login=mysqli_connect($vt_hostname,$vt_username,$vt_password,$vt_database,3325);


if(isset($_POST['sub'])){
    $USR_MAIL = $_POST['USR_MAIL'];
    $USR_SECQUEST = $_POST['USR_SECQUEST'];

    

    $sql = "SELECT * FROM users WHERE USR_MAIL = '{$USR_MAIL}' AND USR_SECQUEST = '{$USR_SECQUEST}'";
    $result = mysqli_query($login, $sql) or die("query failed!");
    if(mysqli_num_rows($result) > 0){
        while($row = mysqli_fetch_assoc($result)){

            $_SESSION['USR_ID'] = $row['USR_ID'];
            $_SESSION['USR_NAME'] = $row['USR_NAME'];
            $_SESSION['USR_PASSWORD'] = $row['USR_PASSWORD'];
            $_SESSION['data'] = $row;

            echo'
                <script>
                   location.replace("index.php");
                </script>
            
            ';     }}
       else{
        
        $error = "Quest code does not match!";
         }
    }
?>

<?php 
if(!empty($error)){
    echo'<div class="from_control">
    <p class="error">
    
    <script>
    alert("invalid e-mail adress or Security code" );
    location.replace("login.html");
    </script>
    
    ';
    

    echo $error;

    echo'</p>
    </div>';
}



?>
