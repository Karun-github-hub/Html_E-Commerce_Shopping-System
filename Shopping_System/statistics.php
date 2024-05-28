<!DOCTYPE html>
<html lang="en">

<head>
	<title>Statistics</title>
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
    <link rel="stylesheet" type="text/css" href="radio_btnn.css">
    <link href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css" rel="stylesheet">
<!--===============================================================================================-->
</head>
<body class="animsition">
	
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
							<li >
								<a href="administration.html">Administration</a>
							</li>
                            <li class="active-menu">
								<a href="statistics.php">Statistics</a>
							</li>
						</ul>
					</div>
                <div class="wrap-icon-header flex-w flex-r-m">
                    </div>
                        <a href="login.html" class="icon-header-item cl2 hov-cl1 trans-04 p-l-22 p-r-11" >
                            <i class='bx bx-log-out'></i>
                        </a>
                    </div>
                </div>    		
				</nav>
			</div>	
		</div>
        <!-- Icon header -->
		
        		<!-- Header Mobile -->
		<div class="wrap-header-mobile">
			<!-- Logo moblie -->		
			<div class="logo-mobile">
				<a href="myaccount.html"><img src="Logo_violet.webp" alt="IMG-LOGO"></a>
			</div>
		</div>
        
	</header>

    	<!-- Modal Account Variables -->
		<section class="bg0 p-t-104 p-b-116">
                <div class="container">
                <div class="flex-w flex-tr">
                    <div class="size-210 bor10 p-lr-70 p-t-55 p-b-70 p-lr-15-lg w-full-md">
                        <form action="product_register.php" method="post" enctype="multipart/form-data"> 
                            <h4 class="mtext-105 cl2 txt-center p-b-30">
                                STATISTICS PAGE
                            </h4> 
                            <div class="comment-box" >
                            <table class="table">
                            <thead>
                                <tr>
                                    <th>CMNT_ID</th>
                                    <th>CMNT_DESC</th>
                                    <th>USR_ID</th>
                                    <th>PRDCT_ID</th>
                                    <th>PRDCT_NAME</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php

                                $vt_hostname="localhost";
                                $vt_username="root";
                                $vt_password="";
                                $vt_database="shop";
                                $conn=mysqli_connect($vt_hostname,$vt_username,$vt_password,$vt_database,3325);
                                // Assuming $conn is your database connection object
                                $result = $conn->query("SELECT CMNT_ID, CMNT_DESC, USR_ID, PRDCT_ID, PRDCT_NAME FROM commentproductview");

                                if ($result->num_rows > 0) {
                                    while ($row = $result->fetch_assoc()) {
                                        echo "<tr>";
                                        echo "<td>" . $row["CMNT_ID"] . "</td>";
                                        echo "<td>" . $row["CMNT_DESC"] . "</td>";
                                        echo "<td>" . $row["USR_ID"] . "</td>";
                                        echo "<td>" . $row["PRDCT_ID"] . "</td>";
                                        echo "<td>" . $row["PRDCT_NAME"] . "</td>";
                                        echo "</tr>";
                                    }
                                } else {
                                    echo "<tr><td colspan='5'>No records found</td></tr>";
                                }
                                ?>
                            </tbody>
                        </table>
                                                
                            </div> 
			                    </div>
                                <div class="size-210 bor10 flex-w flex-col-m p-lr-70 p-tb-30 p-lr-15-lg w-full-md">
                                    <div class="hero">

                                    <table class="table">
                            <thead>
                                <tr>
                                    <th>ORDER_ID</th>
                                    <th>ORDER_DATE</th>
                                    <th>USR_ID</th>
                                    <th>ORDER_TOTAL</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php

                                $vt_hostname="localhost";
                                $vt_username="root";
                                $vt_password="";
                                $vt_database="shop";
                                $conn=mysqli_connect($vt_hostname,$vt_username,$vt_password,$vt_database,3325);
                                // Assuming $conn is your database connection object
                                $result = $conn->query("SELECT * FROM orders");

                                if ($result->num_rows > 0) {
                                    while ($row = $result->fetch_assoc()) {
                                        echo "<tr>";
                                        echo "<td>" . $row["ORDER_ID"] . "</td>";
                                        echo "<td>" . $row["ORDER_DATE"] . "</td>";
                                        echo "<td>" . $row["USR_ID"] . "</td>";
                                        echo "<td>" . $row["ORDER_TOTAL"] . "</td>";
                                        echo "</tr>";
                                    }
                                } else {
                                    echo "<tr><td colspan='5'>No records found</td></tr>";
                                }
                                ?>
                            </tbody>
                        </table>


                                    </div>
                          
                                  
                            </div>
                        </form>
                 </section>	
                
           
		    </div>
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

