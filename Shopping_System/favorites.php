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
	<title>Favorite Products</title>
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
	
	<!-- Header -->
	<header class="header-v4">
		<!-- Header desktop -->
		<div class="container-menu-desktop">
			</div>

			<div class="wrap-menu-desktop how-shadow1">
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

							<li>
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
						<a href="favorites.php" class="icon-header-item cl2 hov-cl1 trans-04 p-l-22 p-r-11 " >
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
				<a href="index.php"><img src="Logo_violet.webp" alt="IMG-LOGO"></a>
			</div>

			<!-- Icon header -->
			<div class="wrap-icon-header flex-w flex-r-m m-r-15">
				<div class="icon-header-item cl2 hov-cl1 trans-04 p-r-11 js-show-modal-search">
					<i class="zmdi zmdi-search"></i>
				</div>

				<div class="icon-header-item cl2 hov-cl1 trans-04 p-r-11 p-l-10 icon-header-noti js-show-cart" data-notify="2">
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

    <Span>
         <div class="spacey">
         </div>
    </Span>
    

    
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

<div class="row isotope-grid">
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

// Sayfadan alınan USR_ID değişkeni
$USR_ID = $_GET['usr_id'];

// favorite_products tablosundan ilgili kullanıcının favori ürünlerini alın
$sql = "SELECT * FROM favorite_products WHERE USR_ID = '$USR_ID'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // Her bir favori ürün için işlemleri gerçekleştirin
    while ($row = $result->fetch_assoc()) {
        $productID = $row["PRDCT_ID"];

        // products tablosundan ürün bilgilerini çekin
        $productQuery = "SELECT * FROM products WHERE PRDCT_ID = '$productID'";
        $productResult = $conn->query($productQuery);

        // product_category tablosundan kategori bilgisini çekin
        $categoryQuery = "SELECT CATEGORY_NAME FROM product_category WHERE PRDCT_ID = '$productID'";
        $categoryResult = $conn->query($categoryQuery);

        // Ürün bilgilerini ve kategori bilgisini ekrana basın
        if ($productResult->num_rows > 0 && $categoryResult->num_rows > 0) {
            $productData = $productResult->fetch_assoc();
            $categoryData = $categoryResult->fetch_assoc();

            echo '<div class="col-sm-6 col-md-4 col-lg-3 p-b-35 isotope-item ' . $categoryData["CATEGORY_NAME"] . '">
                    <div class="block2">
                        <div class="block2-pic hov-img0">
                            <img src="images/' . $productData["PRDCT_IMG"] . '" alt="IMG-PRODUCT">

                            <a href="selectedProduct.php?prdct_id=' . $productData["PRDCT_ID"] . '&usr_id=' . $USR_ID . '" class="block2-btn flex-c-m stext-103 cl2 size-102 bg0 bor2 hov-btn1 p-lr-15 trans-04 ">
                                Quick View
                            </a>
                        </div>

                        <div class="block2-txt flex-w flex-t p-t-14">
                            <div class="block2-txt-child1 flex-col-l">
                                <a href="selectedProduct.php" class="stext-104 cl4 hov-cl1 trans-04 js-name-b2 p-b-6">
                                    ' . $productData["PRDCT_NAME"] . '
                                </a>
                                <span class="stext-105 cl3">
                                    $' . $productData["UNIT_PRICE"] . '
                                </span>
                            </div>

                            <div class="block2-txt-child2 flex-r p-t-3">
                                <img class="icon-heart1 dis-block trans-04" src="images/icons/icon-heart-02.png" alt="ICON">
                            </div>
                        </div>
                    </div>
                </div>';
        }
    }
}

// Veritabanı bağlantısını kapatın
$conn->close();
?>


</div>            

	


	<!-- Back to top -->
	<div class="btn-back-to-top" id="myBtn">
		<span class="symbol-btn-back-to-top">
			<i class="zmdi zmdi-chevron-up"></i>
		</span>
	</div>


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
		$('.js-addwish-b2, .js-addwish-detail').on('click', function(e){
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