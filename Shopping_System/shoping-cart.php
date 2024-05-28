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

	<title>Shoping Cart</title>
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
	<link rel="folder" type="folder" href="images/">
	<link href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css" rel="stylesheet">
	<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
<!--===============================================================================================-->
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

	<div class="wrap-header-cart js-panel-cart">
    <div class="s-full js-hide-cart"></div>
	<form method="post" action="">
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
				JOIN users u ON ci.USR_ID = u.USR_ID
				WHERE u.USR_ID = $USR_ID";

                $result = $conn->query($sql);

                if ($result->num_rows > 0) {
                    while ($row = $result->fetch_assoc()) {
                        echo '
                        <li class="header-cart-item flex-w flex-t m-b-12">
                            <div class="header-cart-item-img">
                                <img src="images/' .$row["PRDCT_IMG"]. '" alt="IMG">
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


	<!-- breadcrumb -->
	<div class="container">
		<div class="bread-crumb flex-w p-l-25 p-r-15 p-t-30 p-lr-0-lg">
			<a href="index.php" class="stext-109 cl8 hov-cl1 trans-04">
				Home
				<i class="fa fa-angle-right m-l-9 m-r-10" aria-hidden="true"></i>
			</a>

			<span class="stext-109 cl4">
				Shoping Cart
			</span>
		</div>
	</div>
		

	<!-- Shoping Cart -->
	<form class="bg0 p-t-75 p-b-85">
	<div class="container">
    <div class="row">
        <div class="col-lg-10 col-xl-7 m-lr-auto m-b-50">
            <div class="m-l-25 m-r--38 m-lr-0-xl">
                <div class="wrap-table-shopping-cart">
                    <table class="table-shopping-cart">
                        <tr class="table_head">
                            <th class="column-1">Product</th>
                            <th class="column-2"></th>
                            <th class="column-3">Price</th>
                            <th class="column-4">Quantity</th>
                            <th class="column-5">Total</th>
                        </tr>
                            	<?php
                           		 $sql = "SELECT ci.CART_ITEM_QUANTITY, p.PRDCT_IMG, p.PRDCT_NAME, p.UNIT_PRICE
                                  	 FROM cart_items ci
                                   	 INNER JOIN products p ON ci.PRDCT_ID = p.PRDCT_ID
                                   	 WHERE ci.USR_ID = $USR_ID";

                            $result = mysqli_query($conn, $sql);
							$totalAmount = 0;

							if ($result) {
								while ($row = mysqli_fetch_assoc($result)) {
									// Access data for each cart item
									$quantity = $row['CART_ITEM_QUANTITY'];
									$image = $row['PRDCT_IMG'];
									$productName = $row['PRDCT_NAME'];
									$unitPrice = $row['UNIT_PRICE'];
									$totalPrice = $quantity * $unitPrice;
							
									// Toplam tutarı güncelle
									$totalAmount += $totalPrice;
							
									// Output the HTML for each cart item
									echo '<tr class="table_row">';
									echo '<td class="column-1"><div class="how-itemcart1"><img src="images/' . $row["PRDCT_IMG"] . '" alt="Product Image"></div></td>';
									echo '<td class="column-2">' . $productName . '</td>';
									echo '<td class="column-3">$ ' . number_format($unitPrice, 2) . '</td>';
									echo '<td class="column-4">' . $quantity . '</td>';
									echo '<td class="column-5">$ ' . number_format($totalPrice, 2) . '</td>';
									echo '</tr>';
								}
							} else {
								echo "Error in the query: " . mysqli_error($conn);
							}
							

                           
                            
                            ?>
                         </table>
                </div>
            </div>
        </div>
		<?php


	echo '

    <div class="col-sm-10 col-lg-7 col-xl-5 m-lr-auto m-b-50">
        <div class="bor10 p-lr-40 p-t-30 p-b-40 m-l-63 m-r-40 m-lr-0-xl p-lr-15-sm">
            <h4 class="mtext-109 cl2 p-b-30">
                Cart Total
            </h4>

            <div class="flex-w flex-t p-t-27 p-b-33">
                <div class="size-208">
                    <span class="mtext-101 cl2">
                        Total:
                    </span>
                </div>

                <div class="size-209 p-t-1">
                    <span class="mtext-110 cl2">
					' . number_format($totalAmount, 2) . ' 
                    </span>
                </div>
            </div>
            <button type="submit" name="submit" id="submit" class="flex-c-m stext-101 cl0 size-116 bg3 bor14 hov-btn3 p-lr-15 trans-04 pointer">
                PAY TO PROCEED!
            </button>
        </div>
    </div>
</form>
	';
	if (isset($_POST['submit'])) {
		if (!$USR_ID) {
			echo "User ID not specified.";
			exit();
		}
	
		$orderDate = date("Y-m-d");
		$orderTotal = $totalAmount;
	
		// Insert order into the 'orders' table
		$insertOrderQuery = "INSERT INTO orders (USR_ID, ORDER_DATE, ORDER_TOTAL) VALUES (?, ?, ?)";
		$stmt = $conn->prepare($insertOrderQuery);
		$stmt->bind_param("iss", $USR_ID, $orderDate, $orderTotal);
	
		$insertResult = $stmt->execute();
	
		if ($insertResult) {
			// Order successfully placed
			echo "Order successfully placed!";
	
			// Delete records from 'cart_items' where USR_ID matches the submitted form value
			$deleteCartItemsQuery = "DELETE FROM cart_items WHERE USR_ID = ?";
			$stmtDelete = $conn->prepare($deleteCartItemsQuery);
			$stmtDelete->bind_param("i", $USR_ID);
	
			$deleteResult = $stmtDelete->execute();
	
			if ($deleteResult) {
				echo "Cart items successfully deleted.";
			} else {
				echo "Error deleting cart items: " . $stmtDelete->error;
			}
		} else {
			// Error placing the order
			echo "Error placing the order: " . $stmt->error;
		}
	}
	



?>



	<!-- Back to top -->
	<div class="btn-back-to-top" id="myBtn">
		<span class="symbol-btn-back-to-top">
			<i class="zmdi zmdi-chevron-up"></i>
		</span>
	</div>

	<script>
    function redirectToOrders() {
        window.location.href = 'orders.php';
    }
</script>
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