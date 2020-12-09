<?php
	session_start();
	// set the loggout variable as empty
	$loggout = "";
	// if there is a cookie then we set it as equal with the session, so we can call the sesssion when we want
	if(array_key_exists("StayLoggedIn", $_COOKIE)) {
		$_SESSION['StayLoggedIn'] = $_COOKIE['StayLoggedIn'];
	}
	// check if there is the session and set the loggout button
	if(array_key_exists('StayLoggedIn', $_SESSION)) {
		//echo '<a href="index.php?logout=1">Logout</a>';
		$loggout = "index.php?logout=1";
		// else redirect them back to the sign Up Page
	} else {
		echo "<script>alert('You have to login to explore our subordinate sites')</script>";
		header("Location: index.php");
	}
	include("connection.php");
	if(isset($_GET['product'])) {
		$ISBN = $_GET['product'];
		$query = "SELECT * FROM Books WHERE ISBN = '$ISBN'";
		$result = mysqli_query($conn, $query);
		if(!$result){
			echo "<script>alert('Something went wrong')</script>";
		} else {
			$row = mysqli_fetch_array($result);
		}
	}

	if(isset($_POST['submit_addToCard'])) {
		$isbn = $_POST['hidden_isbn'];
		$price = $_POST['hidden_price'];
		$customer = $_SESSION['Customer']; //pairnw kai to customer
		$quantity = $_POST['quantity'];
		echo $customer;
		$sql = "INSERT INTO Orders VALUES(NULL, '$isbn', $customer, CURRENT_DATE(), CURRENT_TIME(), $quantity, $price, 'not_delivered')";
		$res = mysqli_query($conn, $sql);
		if(!$res) {
			echo "<script>alert('Something went wrong!!')</script>";
			echo $isbn." ".$customer." ".$quantity;
		} else {
			header("Location: order.php");
		}
	}


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Book Store</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="theme-color" content="#03a6f3">
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link href="https://fonts.googleapis.com/css?family=Montserrat:200,300,400,500,600,700,800,900" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" type="text/css" href="css/owl.carousel.min.css">
    <link rel="stylesheet" href="css/styles.css">
</head>

<body>
    <header>
        <div class="header-top">
            <div class="container">
                <div class="row">
                    <div class="col-md-3"><a href="#" class="web-url">www.bookstore.com</a></div>
                    <div class="col-md-6">
                        <h5>Free Shipping Over $99 + 3 Free Samples With Every Order</h5></div>
                    <div class="col-md-3">
                        <span class="ph-number">Call : 800 1234 5678</span>
                    </div>
                </div>
            </div>
        </div>
        <div class="main-menu">
            <div class="container">
                <nav class="navbar navbar-expand-lg navbar-light">
                    <a class="navbar-brand" href="loggedIn.php"><img src="images/logo.png" alt="logo"></a>
                    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="collapse navbar-collapse" id="navbarSupportedContent">
                        <ul class="navbar-nav ml-auto">
													<li class="navbar-item active">
															<a href="loggedIn.php" class="nav-link">Home</a>
													</li>
													<li class="navbar-item">
															<a href="shop.php" class="nav-link">Shop</a>
													</li>
													<?php
														if(array_key_exists('Employee_in', $_SESSION)) {
															echo '  <li class="navbar-item">
																				<a href="addBook.php" class="nav-link">Add Book</a>
																			</li>';
														}
													 ?>
													 <?php
														if(array_key_exists('Admin_in', $_SESSION)) {
															echo '  <li class="navbar-item">
																				<a href="addEmployee.php" class="nav-link">Add Employee</a>
																			</li>';
														}
													 ?>
													 <?php
														if(array_key_exists('Employee_in', $_SESSION)) {
															echo '<li class="navbar-item">
																			<a href="deleteBook.php" class="nav-link">Delete Book</a>
																		</li>';
														}
													 ?>
													<li class="navbar-item">
															<a href="about.php" class="nav-link">About</a>
													</li>
													<li class="navbar-item">
															<a href="order.php" class="nav-link">Shopping card</a>
													</li>
													<li class="navbar-item">
															<a href="<?php echo $loggout; ?>" class="nav-link">Logout</a>
													</li>
											</ul>
											<div class="cart my-2 my-lg-0">
													<span><i class="fa fa-shopping-cart" aria-hidden="true"></i></span>
													<span class="quntity">3</span>
											</div>
                    </div>
                </nav>
            </div>
        </div>
    </header>
    <div class="breadcrumb">
        <div class="container">
            <a class="breadcrumb-item" href="loggedIn.php">Home</a>
            <span class="breadcrumb-item active">The book: <?php echo $row['Title']; ?></span>
        </div>
    </div>
    <section class="product-sec">
        <div class="container">
            <h1><?php echo $row['Title']; ?></h1>
            <div class="row">
                <div class="col-md-6 slider-sec">
                    <!-- main slider carousel -->
                    <div id="myCarousel" class="carousel slide">
                        <!-- main slider carousel items -->
                        <div class="carousel-inner">
                            <div class="active item carousel-item" data-slide-number="0">
                                <img src="<?php echo $row['Photo_of_book']; ?>" style="width: 360px; height: 576px;" class="img-fluid">
                            </div>
                            <div class="item carousel-item" data-slide-number="1">
                                <img src="images/product2.jpg" style="width: 360px; height: 576px;" class="img-fluid">
                            </div>
                            <div class="item carousel-item" data-slide-number="2">
                                <img src="images/product3.jpg" style="width: 360px; height: 576px;" class="img-fluid">
                            </div>
                        </div>
                        <!-- main slider carousel nav controls -->
                        <ul class="carousel-indicators list-inline">
                            <li class="list-inline-item active">
                                <a id="carousel-selector-0" class="selected" data-slide-to="0" data-target="#myCarousel">
                                <img src="<?php echo $row['Photo_of_book']; ?>" style="width: 115px; height: 184px;" class="img-fluid">
                            </a>
                            </li>
                            <li class="list-inline-item">
                                <a id="carousel-selector-1" data-slide-to="1" data-target="#myCarousel">
                                <img src="images/product2.jpg" class="img-fluid">
                            </a>
                            </li>
                            <li class="list-inline-item">
                                <a id="carousel-selector-2" data-slide-to="2" data-target="#myCarousel">
                                <img src="images/product3.jpg" class="img-fluid">
                            </a>
                            </li>
                        </ul>
                    </div>
                    <!--/main slider carousel-->
                </div>
                <div class="col-md-6 slider-content">
                    <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's printer took a galley of type and Scrambled it to make a type and typesetting industry. Lorem Ipsum has been the book. </p>
                    <p>t has survived not only fiveLorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's printer took a galley of type and</p>
                    <ul>
                        <!-- <li>
                            <span class="name">Digital List Price</span><span class="clm">:</span>
                            <span class="price">$4.71</span>
                        </li>
                        <li>
                            <span class="name">Print List Price</span><span class="clm">:</span>
                            <span class="price">$10.99</span>
                        </li> -->
                        <li>
                            <span class="name">Product Price</span><span class="clm">:</span>
                            <span class="price final">$<?php echo $row['price']; ?></span>
                        </li>
                    </ul>
                    <div class="btn-sec">
											<form action="product-single.php?product=<?php echo $row['ISBN']; ?>" method="post">
												<input type="hidden" name="hidden_isbn" value="<?php echo $row['ISBN']; ?>">
												<input type="hidden" name="hidden_price" value="<?php echo $row['price']; ?>">
												<input type="number" name="quantity" value="1">
												<input class="btn" name="submit_addToCard" type="submit" value="ORDER THIS NOW">
											</form>
                        <button class="btn black">Buy Now</button>
                    </div>
                </div>
            </div>
        </div>
				<?php mysqli_close($conn); ?>
    </section>
    <section class="related-books">
        <div class="container">
            <h2>You may also like these book</h2>
            <div class="recomended-sec">
									<div class="row">
										<?php
										include("connection.php");
										$query = "SELECT * FROM Books ORDER BY RAND() LIMIT 4";
										$result = mysqli_query($conn, $query);
										if(!$result) {
											echo '<script>alert(Not working)</script>';
										}
										while($row = mysqli_fetch_array($result)){ ?>
											<div class="col-lg-3 col-md-6">
													<div class="item">
															<img src="<?php echo $row['Photo_of_book']; ?>" style="height: 218px; width: 130px;" alt="img">
															<h3><?php echo $row['Title']; ?></h3>
															<h6><span class="price">$<?php echo $row['price']; ?></span> / <a href="product-single.php?buy_now=<?php echo $row['ISBN']; ?>">Buy Now</a></h6>
															<div class="hover">
																	<a href="product-single.php?product=<?php echo $row["ISBN"]; ?>">
																	<span><i class="fa fa-long-arrow-right" aria-hidden="true"></i></span>
																	</a>
															</div>
													</div>
											</div>
										<?php
											}
											mysqli_close($conn);
										?>
									</div>
                </div>
            </div>
        </div>
    </section>
    <footer>
        <div class="container">
            <div class="row">
                <div class="col-md-4">
                    <div class="address">
                        <h4>Our Address</h4>
                        <h6>The BookStore Theme, 4th Store
                        Beside that building, USA</h6>
                        <h6>Call : 800 1234 5678</h6>
                        <h6>Email : info@bookstore.com</h6>
                    </div>
                    <div class="timing">
                        <h4>Timing</h4>
                        <h6>Mon - Fri: 7am - 10pm</h6>
                        <h6>​​Saturday: 8am - 10pm</h6>
                        <h6>​Sunday: 8am - 11pm</h6>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="navigation">
                        <h4>Navigation</h4>
                        <ul>
                            <li><a href="loggedIn.php">Home</a></li>
                            <li><a href="about.php">About Us</a></li>
                            <li><a href="privacy-policy.html">Privacy Policy</a></li>
                            <li><a href="terms-conditions.html">Terms</a></li>
                            <li><a href="products.php">Products</a></li>
                        </ul>
                    </div>
                    <div class="navigation">
                        <h4>Help</h4>
                        <ul>
                            <li><a href="">Shipping & Returns</a></li>
                            <li><a href="privacy-policy.html">Privacy</a></li>
                            <li><a href="deleteBook.php">FAQ’s</a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-md-5">
                    <div class="form">
                        <h3>Quick Contact us</h3>
                        <h6>We are now offering some good discount
                            on selected books go and shop them</h6>
                        <form>
                            <div class="row">
                                <div class="col-md-6">
                                    <input placeholder="Name" required>
                                </div>
                                <div class="col-md-6">
                                    <input type="email" placeholder="Email" required>
                                </div>
                                <div class="col-md-12">
                                    <textarea placeholder="Messege"></textarea>
                                </div>
                                <div class="col-md-12">
                                    <button class="btn black">Alright, Submit</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <div class="copy-right">
            <div class="container">
                <div class="row">
                    <div class="col-md-6">
                        <h5>(C) 2017. All Rights Reserved. BookStore Wordpress Theme</h5>
                    </div>
                    <div class="col-md-6">
                        <div class="share align-middle">
                            <span class="fb"><i class="fa fa-facebook-official"></i></span>
                            <span class="instagram"><i class="fa fa-instagram"></i></span>
                            <span class="twitter"><i class="fa fa-twitter"></i></span>
                            <span class="pinterest"><i class="fa fa-pinterest"></i></span>
                            <span class="google"><i class="fa fa-google-plus"></i></span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </footer>
    <script src="js/jquery.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script type="text/javascript" src="js/owl.carousel.min.js"></script>
    <script src="js/custom.js"></script>
</body>

</html>
