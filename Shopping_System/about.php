<?php
session_start();
if (isset($_GET['usr_id'])) {
    $USR_ID = $_GET['usr_id'];
	$_SESSION['USR_ID'] = $USR_ID;
	$temp = $_SESSION['USR_ID'];
	echo "user sess: $temp";
    echo "User ID: $USR_ID";
} else {
    echo "User ID not specified.";
}


$vt_hostname = "localhost";
$vt_username = "root";
$vt_password = "";
$vt_database = "shop";
$conn = mysqli_connect($vt_hostname, $vt_username, $vt_password, $vt_database, 3325);

if ($conn->connect_error) {
die("Bağlantı hatası: " . $conn->connect_error);
}
$sqlCount = "SELECT COUNT(*) AS productCount
FROM cart_items ci
JOIN products p ON ci.PRDCT_ID = p.PRDCT_ID
WHERE ci.USR_ID = $USR_ID";

$resultCount = $conn->query($sqlCount);

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
	<title>About</title>
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

							<li class="active-menu">
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
						<a href="favorites.php?usr_id=<?php echo $USR_ID; ?>" class="icon-header-item cl2 hov-cl1 trans-04 p-l-22 p-r-11 " >
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

				<div class="icon-header-item cl2 hov-cl1 trans-04 p-l-22 p-r-11 icon-header-noti js-show-cart" data-notify="<?php echo $productCount?>">
					<i class="zmdi zmdi-shopping-cart"></i>
				</div>

				<a href="#" class="dis-block icon-header-item cl2 hov-cl1 trans-04 p-r-11 p-l-10 " > 
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


	<!-- Title page -->
	<section class="bg-img1 txt-center p-lr-15 p-tb-92" style="background-image: url('abouttt3.webp');">
		<h2 class="ltext-105 cl0 txt-center">
			About
		</h2>
	</section>	


	<!-- Content page -->
	<section class="bg0 p-t-75 p-b-120">
		<div class="container">
			<div class="row p-b-148">
				<div class="col-md-7 col-lg-8">
					<div class="p-t-7 p-r-85 p-r-15-lg p-r-0-md">
						<h3 class="mtext-111 cl2 p-b-16">
							Our Story
						</h3>

						<p class="stext-113 cl6 p-b-26">
						Vetement Violet is your go-to online destination for seamlessly blending fashion with a touch of uniqueness. Established in 2010, our vision revolves around providing customers with high-quality, stylish, and original designs. At Vetement Violet, we aspire not only to redefine fashion but also to elevate the overall customer experience.
						</p>

						<p class="stext-113 cl6 p-b-26">
							At Vetement Violet, we view fashion not just as clothing but as an expression and lifestyle. Each season, we meticulously follow the latest fashion trends, integrating original and impactful designs into our collections. We believe in offering our customers more than just clothes; we provide an opportunity for self-expression. 
						</p>

						<p class="stext-113 cl6 p-b-26">
							Any questions? Let us know in store at 8th floor, 379 Hudson St, New York, NY 10018 or call us on (+1) 96 716 6879
						</p>
					</div>
				</div>

				<div class="col-11 col-md-5 col-lg-4 m-lr-auto">
					<div class="how-bor1 ">
						<div class="hov-img0">
							<img src="images/about-01.jpg" alt="IMG">
						</div>
					</div>
				</div>
			</div>
			
			<div class="row">
				<div class="order-md-2 col-md-7 col-lg-8 p-b-30">
					<div class="p-t-7 p-l-85 p-l-15-lg p-l-0-md">
						<h3 class="mtext-111 cl2 p-b-16">
							Our Mission
						</h3>

						<p class="stext-113 cl6 p-b-26">
						At Vetement Violet, we believe in not only contributing to fashion but also making a positive impact on society. Through sustainable production methods and contributions to social responsibility projects, we take responsibility for a better world.

Thank you for becoming a part of the Vetement Violet family. We are delighted to welcome you to the world of fashion and elegance. Happy shopping!
						</p>

						<div class="bor16 p-l-29 p-b-9 m-t-22">
							<p class="stext-114 cl6 p-r-40 p-b-11">
								Creativity is just connecting things. When you ask creative people how they did something, they feel a little guilty because they didn't really do it, they just saw something. It seemed obvious to them after a while.
							</p>

							<span class="stext-111 cl8">
							
							</span>
						</div>
					</div>
				</div>

				<div class="order-md-1 col-11 col-md-5 col-lg-4 m-lr-auto p-b-30">
					<div class="how-bor2">
						<div class="hov-img0">
							<img src="aboutt 4.webp" alt="IMG">
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>	

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
	<script src="vendor/MagnificPopup/jquery.magnific-popup.min.js"></script>
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