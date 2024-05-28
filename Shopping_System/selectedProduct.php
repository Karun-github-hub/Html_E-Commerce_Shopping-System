


<?php 	
session_start();
$PRDCT_ID = isset($_GET['prdct_id']) ? (int)$_GET['prdct_id'] : 0;
$USR_ID = isset($_GET['usr_id']) ? (int)$_GET['usr_id'] : 0;

// Şimdi $prdct_id ve $usr_id değişkenlerini kullanabilirsiniz
echo "Product ID: " . $PRDCT_ID . "<br>";
echo "User ID: " . $USR_ID;	

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


<?php
// Fonksiyon: Kullanıcının adını al
function getUserNameByUserID($userID) {
    // Veritabanı bağlantısı
    $vt_hostname = "localhost";
    $vt_username = "root";
    $vt_password = "";
    $vt_database = "shop";

    $conn = mysqli_connect($vt_hostname, $vt_username, $vt_password, $vt_database, 3325);

    if ($conn->connect_error) {
        die("Bağlantı hatası: " . $conn->connect_error);
    }

    // USR_ID'ye göre kullanıcı adını çekme sorgusu
    $sql = "SELECT USR_NAME FROM users WHERE USR_ID = $userID";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        // Kullanıcı adını al
        $row = $result->fetch_assoc();
        $userName = $row['USR_NAME'];

        // Veritabanı bağlantısını kapat
        $conn->close();

        return $userName;
    } else {
        // Veritabanı bağlantısını kapat
        $conn->close();

        return "Guest";
    }
}

// Fonksiyon: Yorumları al
function getComments($productID) {
    // Veritabanı bağlantısı
    $vt_hostname = "localhost";
    $vt_username = "root";
    $vt_password = "";
    $vt_database = "shop";

    $conn = mysqli_connect($vt_hostname, $vt_username, $vt_password, $vt_database, 3325);

    if ($conn->connect_error) {
        die("Bağlantı hatası: " . $conn->connect_error);
    }

    // PRDCT_ID'ye göre yorumları çekme sorgusu
    $sql = "SELECT * FROM comments WHERE PRDCT_ID = $productID";
    $result = $conn->query($sql);

    $comments = [];

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $comments[] = $row;
        }
    }

    // Veritabanı bağlantısını kapat
    $conn->close();

    return $comments;
}

function addComment($productID, $userID, $comment) {
    // Veritabanı bağlantısı
    $vt_hostname = "localhost";
    $vt_username = "root";
    $vt_password = "";
    $vt_database = "shop";

    $conn = mysqli_connect($vt_hostname, $vt_username, $vt_password, $vt_database, 3325);

    if ($conn->connect_error) {
        die("Bağlantı hatası: " . $conn->connect_error);
    }

    // Yorum eklemek için SQL sorgusu
    $sql = "INSERT INTO comments (PRDCT_ID, USR_ID, CMNT_DESC) VALUES ($productID, $userID, '$comment')";

    if ($conn->query($sql) === TRUE) {
        $message = true;
    } else {
        $message = "Error: " . $sql . "<br>" . $conn->error;
    }

    // Veritabanı bağlantısını kapat
    $conn->close();

    return $message;
}

// Örneğin bir ürün ID'si
$productID = $PRDCT_ID;

// Fonksiyonu çağırma
$comments = getComments($productID);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['comment'])) {
        // Örneğin bir kullanıcı ID'si
        $userID = $USR_ID;
        $comment = $_POST['comment'];

        // Fonksiyonu çağırma
        $result = addComment($productID, $userID, $comment);

        // Eğer yorum eklendiyse sayfayı yeniden yönlendirme
        if ($result === true) {
            header("Location: selectedProduct.php?prdct_id=$productID&usr_id=$userID");
            exit();
        } else {
            // Yorum eklenemediyse hata mesajını ekrana yazdırma
            echo $result;
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<title>Selected Product</title>
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
						<a href="favorites.php" class="icon-header-item cl2 hov-cl1 trans-04 p-l-22 p-r-11 icon-header-noti" data-notify="0">
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

    <?php
	


// Veritabanı bağlantı bilgileri
$vt_hostname = "localhost";
$vt_username = "root";
$vt_password = "";
$vt_database = "shop";

// Veritabanı bağlantısı
$conn = mysqli_connect($vt_hostname, $vt_username, $vt_password, $vt_database, 3325);

// URL parametrelerinden PRDCT_ID'yi al
if (isset($PRDCT_ID) && $PRDCT_ID !== '') {

    // Veritabanından seçilen ürünün detaylarını al
    $sql = "SELECT * FROM products p, product_colour c WHERE p.PRDCT_ID = c.PRDCT_ID AND p.PRDCT_ID = $PRDCT_ID";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        // Ürün detaylarını göster
        while ($row = $result->fetch_assoc()) {
            echo '<div class="product-container">
            <img class="product-image" style="max-width: 40%; height: auto; display: block; margin-right: auto; margin-left: auto; padding: 20px;" src="images/' . $row["PRDCT_IMG"] . '" alt="Product Image">
            <div class="product-content">
                <div class="product-title">' . $row["PRDCT_NAME"] . '</div>
                <div class="product-price">$' . $row["UNIT_PRICE"] . '</div>
                <div class="product-description">' . $row["PRDCT_DESC"] . '</div>

                <div class="dropDownSelect2"></div>

                <form method="post" action="">
                    <div class="flex-w flex-r-m p-b-10">
                        <div class="size-203 flex-c-m respon6">
                            Size
                        </div>
                        <div class="size-204 respon6-next">
                            <div class="rs1-select2 bor8 bg0">
                                <select class="js-select2" name="size">';
            // Get sizes from the database
			$selectedSize = '';  // Başlangıçta seçili boyut boş olarak tanımlanır

			$sqlSizes = "SELECT DISTINCT SIZE_NAME FROM product_size WHERE PRDCT_ID = $PRDCT_ID";
			$resultSizes = $conn->query($sqlSizes);
			
			if ($resultSizes->num_rows > 0) {
				while ($sizeRow = $resultSizes->fetch_assoc()) {
					// Boyut seçili olan boyutsa, $selectedSize değişkenine atılır
					if (isset($_POST['size']) && $_POST['size'] === $sizeRow["SIZE_NAME"]) {
						$selectedSize = $sizeRow["SIZE_NAME"];
					}
			
					echo '<option>' . $sizeRow["SIZE_NAME"] . '</option>';
				}
			}
            echo '</select>
                    <div class="dropDownSelect2"></div>
                    </div>
                </div>

				<div class="size-203 flex-c-m respon6">
				Color
			</div>
			<div class="size-204 respon6-next">
				<div class="rs1-select2 bor8 bg0">
					<select class="js-select2" name="color">';
						
            // Get colors from the database
            $sqlColors = "SELECT DISTINCT COLOUR_NAME FROM product_colour WHERE PRDCT_ID = $PRDCT_ID";
            $resultColors = $conn->query($sqlColors);
			$selectedColor = ''; 
			if ($resultColors->num_rows > 0) {
				while ($colorRow = $resultColors->fetch_assoc()) {
					// Renk seçili olan renkse, $selectedColor değişkenine atılır
					if (isset($_POST['color']) && $_POST['color'] === $colorRow["COLOUR_NAME"]) {
						$selectedColor = $colorRow["COLOUR_NAME"];
					}
			
					echo '<option>' . $colorRow["COLOUR_NAME"] . '</option>';
				}
			}
            echo ' </select>
			<div class="dropDownSelect2"></div>
		</div>
	</div>

                <div class="spacey"></div>

                <div class="size-203 flex-c-m respon6">
                    Quantity
                </div>
                <div class="rs1-select2 bor10 bg0">
                    <input type="number" id="quantity" name="quantity" class="quantity-input" min="1" value="1">
                </div>
            <div class="spacey"> </div>
            <div>
                <button type="submit" name="addToCart" id="addToCart"  class="add-to-cart-button">Add to Cart!</button>
            </div>
        </form>

        <a href="shopping-cart.php"></a>';
                

			
			$vt_hostname = "localhost";
			$vt_username = "root";
			$vt_password = "";
			$vt_database = "shop";
			
			$conn = mysqli_connect($vt_hostname, $vt_username, $vt_password, $vt_database, 3325);
			
			if (!$conn) {
				die("Bağlantı hatası: " . mysqli_connect_error());
			}
			
			// Ürün ID'si
			$prdctID = $PRDCT_ID;
			
			// Yorumları çekme sorgusu
			$sql = "SELECT c.CMNT_DESC, u.USR_NAME
					FROM comments c
					JOIN users u ON c.USR_ID = u.USR_ID
					WHERE c.PRDCT_ID = $prdctID";
			
			$result = $conn->query($sql);
			
			
			
			echo '<div class="comment-container">
        <h2>Comments</h2>
        <ul class="comment-list" id="commentList">';
        
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        echo '<li>' . $row['USR_NAME'] . ': ' . $row['CMNT_DESC'] . '</li>';
    }
} else {
    echo '<li>No comments yet</li>';
}

echo '</ul>
        <div class="comment-form">
            <form method="post">
			<input type="text" class="comment-input" name="username" placeholder="Username"  value="' . getUserNameByUserID($USR_ID) . '" readonly>
                <input type="text" class="comment-input" name="comment" placeholder="Comment">
                <button type="submit" class="comment-button">Comment</button>
            </form>
        </div>
    </div>';
    
// Veritabanı bağlantısını kapat
        }
        if (isset($_POST['addToCart'])) {
            // Kullanıcının girdiği miktarı al
            $quantity = isset($_POST['quantity']) ? intval($_POST['quantity']) : 1;

            // Diğer ürün bilgileriyle birlikte cart_items tablosuna eklemek için SQL sorgusu
            $insertCartSql = $conn->prepare("INSERT INTO cart_items (CART_ITEM_QUANTITY, PRDCT_ID, USR_ID, COLOUR_NAME, SIZE_NAME) VALUES (?, ?, ?, ?, ?)");
            
            // Değişkenleri bağla
            $insertCartSql->bind_param("iiiss", $quantity, $PRDCT_ID,$USR_ID , $selectedColor, $selectedSize);

            // SQL sorgusunu çalıştır
            if ($insertCartSql->execute()) {
            } else {
                echo "Hata: " . $insertCartSql->error;
            }

            // Diğer işlemleri buraya ekleyebilirsiniz
        }
    } else {
        echo "Ürün bulunamadı";
    }
}
?>


<!--===============================================================================================-->	    


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