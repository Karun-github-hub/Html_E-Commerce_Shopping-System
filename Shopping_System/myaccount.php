
<?php
session_start();
// Check if the 'usr_id' parameter is set in the URL
if (isset($_GET['usr_id'])) {
    $USR_ID = $_GET['usr_id'];
	$_SESSION['USR_ID'] = $USR_ID;
	$temp = $_SESSION['USR_ID'];
	echo "user sess: $temp";

    // Now you can use the $usr_id variable as needed
    echo "User ID: $USR_ID";
} else {
    // If 'usr_id' parameter is not set, provide a default behavior
    echo "User ID not specified.";
}







$vt_hostname = "localhost";
$vt_username = "root";
$vt_password = "";
$vt_database = "shop";

// MySQL veritabanına bağlantıyı oluştur
$login = mysqli_connect($vt_hostname, $vt_username, $vt_password, $vt_database, 3325);

// Bağlantıyı kontrol et
if (!$login) {
    die("Bağlantı başarısız: " . mysqli_connect_error());
}
else{
    // Check if the user is logged in
   "";
}


$sqlSelect = "SELECT * FROM users WHERE USR_ID = $USR_ID";
$result = mysqli_query($login, $sqlSelect);

if ($result) {
// Check if the user with $USR_ID exists
if (mysqli_num_rows($result) > 0) {
	// Fetch the user data as an associative array
	$userData = mysqli_fetch_assoc($result);

	// Now you can use $userData in your code
	// For example, you might want to display user information:
	echo "User Name: " . $userData['USR_NAME'];
	echo "User Email: " . $userData['USR_MAIL'];
	// ... other user data

} else {
	echo "User not found";
}
mysqli_free_result($result); // Free the result set
} else {
echo "Query failed: " . mysqli_error($login);
}



$vt_hostname = "localhost";
$vt_username = "root";
$vt_password = "";
$vt_database = "shop";
$conn = mysqli_connect($vt_hostname, $vt_username, $vt_password, $vt_database, 3325);

// Bağlantıyı kontrol etme
if ($conn->connect_error) {
die("Bağlantı hatası: " . $conn->connect_error);
}
// Sepetteki ürün sayısını al
$sqlCount = "SELECT COUNT(*) AS productCount
FROM cart_items ci
JOIN products p ON ci.PRDCT_ID = p.PRDCT_ID
WHERE ci.USR_ID = $USR_ID";

$resultCount = $conn->query($sqlCount);

// Hesaplanan ürün sayısını al
if ($resultCount) {
$rowCount = $resultCount->fetch_assoc();
$productCount = $rowCount['productCount'];
} else {
$productCount = 0;
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
	<title>My_Account</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
<!--===============================================================================================-->	
	<link rel="icon" type="image/png" href="Logo_violet.webp"/>
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/bootstrap/css/bootstrap.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="fonts/font-awesome-4.7.0/css/font-awesome.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="fonts/iconic/css/material-design-iconic-font.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="fonts/linearicons-v1.0.0/icon-font.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/animate/animate.css">
<!--===============================================================================================-->	
	<link rel="stylesheet" type="text/css" href="vendor/css-hamburgers/hamburgers.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/animsition/css/animsition.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/select2/select2.min.css">
<!--===============================================================================================-->	
	<link rel="stylesheet" type="text/css" href="vendor/daterangepicker/daterangepicker.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/slick/slick.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/MagnificPopup/magnific-popup.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/perfect-scrollbar/perfect-scrollbar.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="css/util.css">
	<link rel="stylesheet" type="text/css" href="css/main.css">
	<link href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css" rel="stylesheet">
<!--===============================================================================================-->
</head>
<body class="animsition">
<?php



if (isset($_POST['Submit'])) {
    $USR_NAME = mysqli_real_escape_string($login, $_POST['USR_NAME']);
    $USR_MAIL = mysqli_real_escape_string($login, $_POST['USR_MAIL']);
    $USR_PASSWORD = mysqli_real_escape_string($login, $_POST['USR_PASSWORD']);

    // SQL sorgusunu oluşturun (uygun olanı kullanın)
    $sql = "UPDATE users SET USR_NAME = '$USR_NAME', USR_MAIL = '$USR_MAIL', USR_PASSWORD = '$USR_PASSWORD' WHERE USR_ID = $USR_ID";

    // Sorguyu çalıştırın ve sonucu kontrol edin
    if (mysqli_query($login, $sql)) {
        echo "Veri başarıyla güncellendi.";
    } else {
        echo "Güncelleme sırasında bir hata oluştu: " . mysqli_error($login);
    }
}

// Veritabanı bağlantısını kapatın (isteğe bağlı)
mysqli_close($login);

?>
	<!-- Header -->
	<header>
		<!-- Header desktop -->
		<div class="container-menu-desktop">
			<div class="wrap-menu-desktop">
				<nav class="limiter-menu-desktop container">
					
					<!-- Logo desktop -->		
					<a href="#" class="logo">
						<img src="Logo_violet.webp" alt="IMG-LOGO">
					</a>

					<!-- Menu desktop -->
					<div class="menu-desktop">
						<ul class="main-menu">
							<li>
								<a href="index.php?usr_id=<?php echo $USR_ID; ?>">Home</a>
							</li>

							<li>
								<a href="product.php?usr_id=<?php echo $USR_ID; ?>">Vêtements</a>
							</li>

							<li class="active-menu">
								<a href="myaccount.php?usr_id=<?php echo $USR_ID; ?>">My Account</a>
							</li>

							<li>
								<a href="about.php?usr_id=<?php echo $USR_ID; ?>">About</a>
							</li>

							<li>
								<a href="contact.php?usr_id=<?php echo $USR_ID; ?>">Contact</a>
							</li>
						</ul>
					</div>	

					<!-- Icon header -->
					<div class="wrap-icon-header flex-w flex-r-m">
						<div class="icon-header-item cl2 hov-cl1 trans-04 p-l-22 p-r-11 js-show-modal-search">
							<i class="zmdi zmdi-search"></i>
						</div>

						<div class="icon-header-item cl2 hov-cl1 trans-04 p-l-22 p-r-11 icon-header-noti js-show-cart" data-notify="<?php echo $productCount?>">
							<i class="zmdi zmdi-shopping-cart"></i>
						</div>
						<a href="favorites.php?usr_id=<?php echo $USR_ID; ?>" class="icon-header-item cl2 hov-cl1 trans-04 p-l-22 p-r-11" >
							<i class="zmdi zmdi-favorite-outline"></i>
						</a>
					</div>
						<a href="login.html" class="icon-header-item cl2 hov-cl1 trans-04 p-l-22 p-r-11" >
							<i class='bx bx-log-out'></i>
						</a>
					</div>	
				</nav>
			</div>	
		</div>
        		<!-- Header Mobile -->
		<div class="wrap-header-mobile">
			<!-- Logo moblie -->		
			<div class="logo-mobile">
				<a href="myaccount.php?usr_id=<?php echo $USR_ID; ?>"><img src="Logo_violet.webp" alt="IMG-LOGO"></a>
			</div>

			<!-- Icon header -->
			<div class="wrap-icon-header flex-w flex-r-m m-r-15">
				<div class="icon-header-item cl2 hov-cl1 trans-04 p-r-11 js-show-modal-search">
					<i class="zmdi zmdi-search"></i>
				</div>

				<div class="icon-header-item cl2 hov-cl1 trans-04 p-l-22 p-r-11 icon-header-noti js-show-cart" data-notify="<?php echo $productCount?>">
					<i class="zmdi zmdi-shopping-cart"></i>
				</div>

				<a href="#" class="dis-block icon-header-item cl2 hov-cl1 trans-04 p-r-11 p-l-10 icon-header-noti" data-notify="0">
					<i class="zmdi zmdi-favorite-outline"></i>
				</a>
			</div>

			<!-- Button show menu -->
			<div class="btn-show-menu-mobile hamburger hamburger--squeeze">
				<span class="hamburger-box">
					<span class="hamburger-inner"></span>
				</span>
			</div>
		</div>
        
		<!-- Modal Search -->
		<div class="modal-search-header flex-c-m trans-04 js-hide-modal-search">
			<div class="container-search-header">
				<button class="flex-c-m btn-hide-modal-search trans-04 js-hide-modal-search">
					<img src="images/icons/icon-close2.png" alt="CLOSE">
				</button>

				<form class="wrap-search-header flex-w p-l-15">
					<button class="flex-c-m trans-04">
						<i class="zmdi zmdi-search"></i>
					</button>
					<input class="plh3" type="text" name="search" placeholder="Search...">
				</form>
			</div>
		</div>
	</header>
    		<!-- Cart -->
<div class="wrap-header-cart js-panel-cart">
    <div class="s-full js-hide-cart"></div>

    <div class="header-cart flex-col-l p-l-65 p-r-25">
        <div class="header-cart-title flex-w flex-sb-m p-b-8">
            <span class="mtext-103 cl2">
                Your Cart
            </span>

            <div class="fs-35 lh-10 cl2 p-lr-5 pointer hov-cl1 trans-04 js-hide-cart">
                <i class="zmdi zmdi-close"></i>
            </div>
        </div>

        <div class="header-cart-content flex-w js-pscroll">
            <ul class="header-cart-wrapitem w-full">
                <?php
			$sql = "SELECT p.PRDCT_ID, p.PRDCT_IMG, p.PRDCT_NAME, p.UNIT_PRICE, ci.CART_ITEM_QUANTITY
			FROM cart_items ci
			JOIN products p ON ci.PRDCT_ID = p.PRDCT_ID
			WHERE ci.USR_ID = $USR_ID";

			$result = $conn->query($sql);

                $result = $conn->query($sql);

                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        echo '
                        <li class="header-cart-item flex-w flex-t m-b-12">
                            <div class="header-cart-item-img">
                                <img src="images/' . $row["PRDCT_IMG"] . '" alt="IMG">
                            </div>
                            <div class="header-cart-item-txt p-t-8">
                                <a href="#" class="header-cart-item-name m-b-18 hov-cl1 trans-04">
                                    ' . $row["PRDCT_NAME"] . '
                                </a>
                                <span class="header-cart-item-info">
                                    ' . $row["CART_ITEM_QUANTITY"] . ' x $' . $row["UNIT_PRICE"] . '
                                </span>
                            </div>
                        </li>';
                    }
                } else {
                    echo '<li class="header-cart-item flex-w flex-t m-b-12">Your cart is empty</li>';
                }
                ?>
            </ul>

            <div class="w-full">
                <div class="header-cart-buttons flex-w w-full">
                    <a href="shoping-cart.php?usr_id=<?php echo $USR_ID; ?>" class="flex-c-m stext-101 cl0 size-107 bg3 bor2 hov-btn3 p-lr-15 trans-04 m-r-8 m-b-10">
                        View Cart
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>

    	<!-- Modal Account Variables -->
		<section class="bg0 p-t-104 p-b-116">
    <div class="container">
        <div class="flex-w flex-tr">
            <div class="size-210 bor10 p-lr-70 p-t-55 p-b-70 p-lr-15-lg w-full-md">
                <form action="myaccount.php?usr_id=<?php echo $USR_ID; ?>" method="post">
                    <h4 class="mtext-105 cl2 txt-center p-b-30">
                        ACCOUNT PAGE
                    </h4>
                    <div class="comment-box">
                        <label for="fname">Name: <input type="text" id="USR_NAME" name="USR_NAME" value="<?php echo $userData['USR_NAME']; ?>"></label>
                        <label for="fname">Email: <input type="email" class="plh3" id="USR_MAIL" name="USR_MAIL" value="<?php echo $userData['USR_MAIL']; ?>"></label>
                        <label for="fname">Password <input type="password" id="USR_PASSWORD" name="USR_PASSWORD" value="<?php echo $userData['USR_PASSWORD']; ?>"></label>
                        <span class="button-space"></span>
                        <button onclick="myFunction()" id="Submit" name="Submit">Submit</button>
                        <span class="button-space"></span>
                        <button onclick="myFunction()">Reset <a href="myaccount.php?usr_id=<?php echo $USR_ID; ?>"></a></button>
                    </div>
                </form>
            </div>
            <div class="size-210 bor10 flex-w flex-col-m p-lr-70 p-tb-30 p-lr-15-lg w-full-md">
                <div class="flex-w w-full p-b-42">
                    <img src="images/icons/user.icon.png" alt="IMG-LOGO" height="450" width="450">
                </div>
            </div>
        </div>
    </div>
</section>

	</header>


    <!--===============================================================================================-->	
	<script src="vendor/jquery/jquery-3.2.1.min.js"></script>
    <!--===============================================================================================-->
        <script src="vendor/animsition/js/animsition.min.js"></script>
    <!--===============================================================================================-->
        <script src="vendor/bootstrap/js/popper.js"></script>
        <script src="vendor/bootstrap/js/bootstrap.min.js"></script>
    <!--===============================================================================================-->
        <script src="vendor/select2/select2.min.js"></script>
        <script>
            $(".js-select2").each(function(){
                $(this).select2({
                    minimumResultsForSearch: 20,
                    dropdownParent: $(this).next('.dropDownSelect2')
                });
            })
        </script>
    <!--===============================================================================================-->
        <script src="vendor/daterangepicker/moment.min.js"></script>
        <script src="vendor/daterangepicker/daterangepicker.js"></script>
    <!--===============================================================================================-->
        <script src="vendor/slick/slick.min.js"></script>
        <script src="js/slick-custom.js"></script>
    <!--===============================================================================================-->
        <script src="vendor/parallax100/parallax100.js"></script>
        <script>
            $('.parallax100').parallax100();
        </script>
    <!--===============================================================================================-->
        <script src="vendor/MagnificPopup/jquery.magnific-popup.min.js"></script>
        <script>
            $('.gallery-lb').each(function() { // the containers for all your galleries
                $(this).magnificPopup({
                    delegate: 'a', // the selector for gallery item
                    type: 'image',
                    gallery: {
                        enabled:true
                    },
                    mainClass: 'mfp-fade'
                });
            });
        </script>
    <!--===============================================================================================-->
        <script src="vendor/isotope/isotope.pkgd.min.js"></script>
    <!--===============================================================================================-->
        <script src="vendor/sweetalert/sweetalert.min.js"></script>
        <script>
            $('.js-addwish-b2').on('click', function(e){
                e.preventDefault();
            });
    
            $('.js-addwish-b2').each(function(){
                var nameProduct = $(this).parent().parent().find('.js-name-b2').html();
                $(this).on('click', function(){
                    swal(nameProduct, "is added to wishlist !", "success");
    
                    $(this).addClass('js-addedwish-b2');
                    $(this).off('click');
                });
            });
    
            $('.js-addwish-detail').each(function(){
                var nameProduct = $(this).parent().parent().parent().find('.js-name-detail').html();
    
                $(this).on('click', function(){
                    swal(nameProduct, "is added to wishlist !", "success");
    
                    $(this).addClass('js-addedwish-detail');
                    $(this).off('click');
                });
            });
    
            /*---------------------------------------------*/
    
            $('.js-addcart-detail').each(function(){
                var nameProduct = $(this).parent().parent().parent().parent().find('.js-name-detail').html();
                $(this).on('click', function(){
                    swal(nameProduct, "is added to cart !", "success");
                });
            });
        
        </script>
    <!--===============================================================================================-->
        <script src="vendor/perfect-scrollbar/perfect-scrollbar.min.js"></script>
        <script>
            $('.js-pscroll').each(function(){
                $(this).css('position','relative');
                $(this).css('overflow','hidden');
                var ps = new PerfectScrollbar(this, {
                    wheelSpeed: 1,
                    scrollingThreshold: 1000,
                    wheelPropagation: false,
                });
    
                $(window).on('resize', function(){
                    ps.update();
                })
            });
        </script>
    <!--===============================================================================================-->

        <script src="js/main.js"></script>
    </body>
    </html>


