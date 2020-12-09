<?php
	session_start();
	// set the loggout variable as empty
	unset($_SESSION['LoginMessage']);
	$loggout = "";
	// if there is a cookie then we set it as equal with the session, so we can call the sesssion when we want
	if(array_key_exists("StayLoggedIn", $_COOKIE)) {
		$_SESSION['StayLoggedIn'] = $_COOKIE['StayLoggedIn'];
	}
	// check if there is the session and set the loggout button
	if(array_key_exists('StayLoggedIn', $_SESSION)) {
		//echo '<a href="signUp.php?logout=1">Logout</a>';
		$loggout = "index.php?logout=1";
		// else redirect them back to the sign Up Page
	} else {
		header("Location: signUp.php");
	}
	include("connection.php");
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
                    <a class="navbar-brand" href="index.html"><img src="images/logo.png" alt="logo"></a>
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
 																echo '  <li class="navbar-item">
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
    <section class="slider">
        <div class="container">
            <div id="owl-demo" class="owl-carousel owl-theme">
                <div class="item">
                    <div class="slide">
                        <img src="images/slide1.jpg" alt="slide1">
                        <div class="content">
                            <div class="title">
                                <h3>welcome to bookstore</h3>
                                <h5>Discover the best books online with us</h5>
                                <a href="#" class="btn">shop books</a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="item">
                    <div class="slide">
                        <img src="images/slide2.jpg" alt="slide1">
                        <div class="content">
                            <div class="title">
                                <h3>welcome to bookstore</h3>
                                <h5>Discover the best books online with us</h5>
                                <a href="#" class="btn">shop books</a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="item">
                    <div class="slide">
                        <img src="images/slide3.jpg" alt="slide1">
                        <div class="content">
                            <div class="title">
                                <h3>welcome to bookstore</h3>
                                <h5>Discover the best books online with us</h5>
                                <a href="#" class="btn">shop books</a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="item">
                    <div class="slide">
                        <img src="images/slide4.jpg" alt="slide1">
                        <div class="content">
                            <div class="title">
                                <h3>welcome to bookstore</h3>
                                <h5>Discover the best books online with us</h5>
                                <a href="#" class="btn">shop books</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="recomended-sec">
        <div class="container">
            <div class="title">
                <h2>highly recommendes books</h2>
                <hr>
            </div>
            <div class="row">
							<?php
							$query = "SELECT * FROM Books ORDER BY Date_added LIMIT 4";
							$result = mysqli_query($conn, $query);
							if(!$result) {
								echo '<script>alert(Not working)</script>';
							}
							while($row = mysqli_fetch_array($result)){ ?>
								<div class="col-lg-3 col-md-6">
										<div class="item">
												<img src="<?php echo $row['Photo_of_book']; ?>" style="height: 218px; width: 130px;" alt="img">
												<h3><?php echo $row['Title']; ?></h3>
												<h6><span class="price">$<?php echo $row['price']; ?></span> / <a href="loggedIn.php?buy_now=<?php echo $row['ISBN']; ?>">Buy Now</a></h6>
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
    </section>
    <section class="about-sec">
        <div class="about-img">
            <figure style="background:url(./images/about-img.jpg)no-repeat;"></figure>
        </div>
        <div class="about-content">
            <h2>About bookstore,</h2>
            <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's printer took a galley of type and Scrambled it to make a type and typesetting industry. Lorem Ipsum has been the book. </p>
            <p>It has survived not only fiveLorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's printer took a galley of type and</p>
            <div class="btn-sec">
                <a href="shop.php" class="btn yellow">shop books</a>
                <a href="form.php" class="btn black">subscriptions</a>
            </div>
        </div>
    </section>
    <section class="recent-book-sec">
        <div class="container">
            <div class="title">
                <h2>highly recommendes books</h2>
                <hr>
            </div>
						<div class="row">
						<?php // an o xristis patisei load_books tote egw tha emfanizw ola ta vivlia poy exw sti vasi mou
							if(isset($_GET['load_books'])) {
								include("connection.php");
								$query4 = "SELECT * FROM Books ORDER BY RAND()";
								$result4 = mysqli_query($conn, $query4);
								if(!$result2) {
									echo '<script>alert(Not working)</script>';
								}
								while($row = mysqli_fetch_array($result4)){ ?>
								<div class="col-lg-2 col-md-3 col-sm-4">
										<div class="item">
												<img src="<?php echo $row['Photo_of_book']; ?>" style="width: 167px; height: 260px;" alt="img">
												<h3><a href="product-single.php?product=<?php echo $row["ISBN"]; ?>"><?php echo $row['Title']; ?></a></h3>
												<h6><span class="price">$ <?php echo $row['price']; ?></span> / <a href="#">Buy Now</a></h6>
										</div>
								</div>
								<?php
									}
							} else {
						 ?>
					 </div>
            <div class="row">
								<?php //emfanizw 5 vivlia an den patisei o xristis kati
								include("connection.php");
								$query2 = "SELECT * FROM Books ORDER BY Date_added DESC	 LIMIT 5";
								$result2 = mysqli_query($conn, $query2);
								if(!$result2) {
									echo '<script>alert(Not working)</script>';
								}
								while($row = mysqli_fetch_array($result2)){ ?>
                <div class="col-lg-2 col-md-3 col-sm-4">
                    <div class="item">
                        <img src="<?php echo $row['Photo_of_book']; ?>" style="width: 167px; height: 260px;" alt="img">
                        <h3><a href="product-single.php?product=<?php echo $row["ISBN"]; ?>"><?php echo $row['Title']; ?></a></h3>
                        <h6><span class="price">$ <?php echo $row['price']; ?></span> / <a href="#">Buy Now</a></h6>
                    </div>
                </div>
								<?php
									}
									mysqli_close($conn);
								?>
								</div>
								<div class="row">
								<?php //emfanizw 5 tixaia vivlia an den patisei o xristis
								include("connection.php");
								$query4 = "SELECT * FROM Books ORDER BY RAND() LIMIT 5";
								$result4 = mysqli_query($conn, $query4);
								if(!$result2) {
									echo '<script>alert(Not working)</script>';
								}
								while($row = mysqli_fetch_array($result4)){ ?>
                <div class="col-lg-2 col-md-3 col-sm-4">
                    <div class="item">
                        <img src="<?php echo $row['Photo_of_book']; ?>" style="width: 167px; height: 260px;" alt="img">
                        <h3><a href="product-single.php?product=<?php echo $row["ISBN"]; ?>"><?php echo $row['Title']; ?></a></h3>
                        <h6><span class="price">$ <?php echo $row['price']; ?></span> / <a href="#">Buy Now</a></h6>
                    </div>
                </div>
								<?php
									}
								?>
								</div>
							<?php
						} //klinei to isset tou GET['Load_books']

						?>
						</div>
            <div class="btn-sec">
                <a href="loggedIn.php?load_books=1" class="btn gray-btn">view all books</a>
            </div>

        </div>
    </section>
    <section class="features-sec">
        <div class="container">
            <ul>
                <li>
                    <span class="icon"><i class="fa fa-shopping-cart" aria-hidden="true"></i></span>
                    <h3>SAFE SHOPPING</h3>
                    <h5>Safe Shopping Guarantee</h5>
                    <h6>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's...</h6>
                </li>
                <li>
                    <span class="icon return"><i class="fa fa-reply-all" aria-hidden="true"></i></span>
                    <h3>30- DAY RETURN</h3>
                    <h5>Moneyback guarantee</h5>
                    <h6>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's...</h6>
                </li>
                <li>
                    <span class="icon chat"><i class="fa fa-comments" aria-hidden="true"></i></span>
                    <h3>24/7 SUPPORT</h3>
                    <h5>online Consultations</h5>
                    <h6>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's...</h6>
                </li>
            </ul>
        </div>
    </section>
    <section class="offers-sec" style="background:url(images/offers.jpg)no-repeat;">
        <div class="cover"></div>
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    <div class="detail">
                        <h3>Top 50% OFF on Selected</h3>
                        <h6>We are now offering some good discount
                    on selected books go and shop them</h6>
                        <a href="products.php" class="btn blue-btn">view all books</a>
                        <span class="icon-point percentage">
                            <img src="images/precentagae.png" alt="">
                        </span>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="detail">
                        <h3>Shop $ 500 Above and Get Extra!</h3>
                        <h6>We are now offering some good discount
                    on selected books go and shop them</h6>
                        <a href="products.php" class="btn blue-btn">view all books</a>
                        <span class="icon-point amount"><img src="images/amount.png" alt=""></span>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="testimonial-sec">
        <div class="container">
            <div id="testimonal" class="owl-carousel owl-theme">
                <div class="item">
                    <h3>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's printer took a galley of type and Scrambled it to make a type and typesetting industry. been the book</h3>
                    <div class="box-user">
                        <h4 class="author">Susane Mathew</h4>
                        <span class="country">Australia</span>
                    </div>
                </div>
                <div class="item">
                    <h3>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's printer took a galley of type and Scrambled it to make a type and typesetting industry. been the book</h3>
                    <div class="box-user">
                        <h4 class="author">Susane Mathew</h4>
                        <span class="country">Australia</span>
                    </div>
                </div>
                <div class="item">
                    <h3>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's printer took a galley of type and Scrambled it to make a type and typesetting industry. been the book</h3>
                    <div class="box-user">
                        <h4 class="author">Susane Mathew</h4>
                        <span class="country">Australia</span>
                    </div>
                </div>
                <div class="item">
                    <h3>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's printer took a galley of type and Scrambled it to make a type and typesetting industry. been the book</h3>
                    <div class="box-user">
                        <h4 class="author">Susane Mathew</h4>
                        <span class="country">Australia</span>
                    </div>
                </div>
            </div>
        </div>
        <div class="left-quote">
            <img src="images/left-quote.png" alt="quote">
        </div>
        <div class="right-quote">
            <img src="images/right-quote.png" alt="quote">
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
                            <li><a href="index.html">Home</a></li>
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
