<?php
session_start();
if (!isset($_SESSION['status']) || $_SESSION['status'] !== "login" || $_SESSION['hak_akses'] !== "user") {
	header("Location: ../login.php");
	exit;
}
?>
<!DOCTYPE html>
<html lang="zxx" class="no-js">

<head>
	<!-- Mobile Specific Meta -->
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<!-- Favicon-->
	<link rel="shortcut icon" href="img/fav.png">
	<!-- Author Meta -->
	<meta name="author" content="CodePixar">
	<!-- Meta Description -->
	<meta name="description" content="">
	<!-- Meta Keyword -->
	<meta name="keywords" content="">
	<!-- meta character set -->
	<meta charset="UTF-8">
	<!-- Site Title -->
	<title>Sistem E-lelang</title>
	<!--
		CSS
		============================================= -->
	<link rel="stylesheet" href="../landing-page/css/linearicons.css">
	<link rel="stylesheet" href="../landing-page/css/font-awesome.min.css">
	<link rel="stylesheet" href="../landing-page/css/themify-icons.css">
	<link rel="stylesheet" href="../landing-page/css/bootstrap.css">
	<link rel="stylesheet" href="../landing-page/css/owl.carousel.css">
	<link rel="stylesheet" href="../landing-page/css/nice-select.css">
	<link rel="stylesheet" href="../landing-page/css/nouislider.min.css">
	<link rel="stylesheet" href="../landing-page/css/ion.rangeSlider.css" />
	<link rel="stylesheet" href="../landing-page/css/ion.rangeSlider.skinFlat.css" />
	<link rel="stylesheet" href="../landing-page/css/magnific-popup.css">
	<link rel="stylesheet" href="../landing-page/css/main.css">
</head>

<body>

	<!-- Start Header Area -->
	<header class="header_area sticky-header">
		<div class="main_menu">
			<nav class="navbar navbar-expand-lg navbar-light main_box">
				<div class="container">
					<!-- Brand and toggle get grouped for better mobile display -->
					<a class="navbar-brand logo_h" href="dashboard.php"><img src="../vendor/dist/img/vokasi.png" alt="" style="width: 50px; height: 50px; object-fit: cover;"></a>
					<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
					</button>

					<div class="collapse navbar-collapse offset" id="navbarSupportedContent">
						<ul class="nav navbar-nav menu_nav ml-auto">
							<li class="nav-item "><a class="nav-link" href="dashboard.php">Home</a></li>
							<li class="nav-item ">
								<a class="nav-link" href="dashboard.php">Lelang</a>
							</li>
						</ul>
						<ul class="nav navbar-nav navbar-right">
							<li class="nav-item">
								<a href="logout.php" class="nav-link">Logout</a>
							</li>
						</ul>

					</div>
				</div>
			</nav>
		</div>
	</header>
	<!-- End Header Area -->

	<!-- start banner Area -->
	<section class="banner-area">
		<div class="container">
			<div class="row fullscreen align-items-center justify-content-start">
				<div class="col-lg-12">
					<div class="row single-slide align-items-center d-flex">
						<div class="col-lg-5 col-md-6">
							<div class="banner-content">
								<h1>Selamat Datang di <br> Lelang Online!</h1>
								<p>Platform lelang online terbaik di Indonesia. Temukan barang-barang unik dan menarik dengan harga yang kompetitif. Bergabunglah dengan komunitas kami dan mulailah menawar sekarang!</p>
								<div class="add-bag d-flex align-items-center">
									<a class="btn btn-primary" href="login.php">Lihat Barang</a>
								</div>
							</div>
						</div>
						<div class="col-lg-7">
							<div class="banner-img">
								<img class="img-fluid w-50 h-50" src="../landing-page/img/image (2).png" alt="Lelang Online">
							</div>
						</div>
					</div>

				</div>
			</div>
		</div>
	</section>

	<!-- End banner Area -->

	<!-- start features Area -->
	<section class="features-area section_gap">
		<div class="container">
			<div class="row features-inner">
				<!-- single features -->
				<div class="col-lg-3 col-md-6 col-sm-6">
					<div class="single-features">
						<div class="f-icon">
							<img src="../landing-page/img/features/f-icon1.png" alt="">
						</div>
						<h6>Free Delivery</h6>
						<p>Free Shipping on all order</p>
					</div>
				</div>
				<!-- single features -->
				<div class="col-lg-3 col-md-6 col-sm-6">
					<div class="single-features">
						<div class="f-icon">
							<img src="../landing-page/img/features/f-icon2.png" alt="">
						</div>
						<h6>Return Policy</h6>
						<p>Free Shipping on all order</p>
					</div>
				</div>
				<!-- single features -->
				<div class="col-lg-3 col-md-6 col-sm-6">
					<div class="single-features">
						<div class="f-icon">
							<img src="../landing-page/img/features/f-icon3.png" alt="">
						</div>
						<h6>24/7 Support</h6>
						<p>Free Shipping on all order</p>
					</div>
				</div>
				<!-- single features -->
				<div class="col-lg-3 col-md-6 col-sm-6">
					<div class="single-features">
						<div class="f-icon">
							<img src="../landing-page/img/features/f-icon4.png" alt="">
						</div>
						<h6>Secure Payment</h6>
						<p>Free Shipping on all order</p>
					</div>
				</div>
			</div>
		</div>
	</section>
	<!-- end features Area -->


	<?php
	// Database connection (replace with your own connection details)
	include '../koneksi/koneksi.php';

	// Enable error reporting for debugging
	error_reporting(E_ALL);
	ini_set('display_errors', 1);

	// Fetch products from the database
	$sql = "SELECT id_barang, nama_barang, deskripsi, harga_awal, foto, status FROM barang";
	$result = $conn->query($sql);

	// Check if the query was successful
	if ($result === false) {
		die("Error: " . $conn->error);
	}
	?>

	<!-- Start Product Area -->
	<!-- Start Product Area -->
	<section id="lelang">
		<div class="container">
			<div class="row justify-content-center">
				<div class="col-lg-6 text-center">
					<div class="section-title">
						<h1>Lelang Barang</h1>
						<p> Temukan barang-barang unik dan menarik dengan harga yang kompetitif.</p>
					</div>
				</div>
			</div>
			<div class="row">
				<?php while ($row = $result->fetch_assoc()) { ?>
					<!-- Single Product -->
					<div class="col-lg-3 col-md-6">
						<div class="single-product">
							<img class="img-fluid" src="../uploads/<?php echo $row['foto']; ?>" alt="">
							<div class="product-details">
								<h6><?php echo $row['nama_barang']; ?></h6>
								<p><?php echo substr($row['deskripsi'], 0, 100); ?>...</p>
								<div class="price">
									<h6>$<?php echo number_format($row['harga_awal'], 2); ?></h6>
								</div>
								<?php
								$statusText = '';
								$statusClass = '';
								switch ($row['status']) {
									case 'Available':
										$statusText = 'Tersedia';
										$statusClass = 'badge-success';
										break;
									case 'Sold':
										$statusText = 'Terjual';
										$statusClass = 'badge-danger';
										break;
									default:
										$statusText = 'Pending';
										$statusClass = 'badge-warning';
								}
								?>
								<div class="status-badge <?php echo $statusClass; ?>" style="padding: 5px; margin-top: 10px; display: inline-block;">
									<?php echo $statusText; ?>
								</div>
								<div class="prd-bottom">
									<form action="actionlelang.php" method="post" class="mt-3">
										<input type="hidden" name="id_barang" value="<?php echo $row['id_barang']; ?>">
										<input class="form-control form-control-sm" type="text" name="bid" placeholder="Bid">
										<button type="submit" class="btn btn-primary mt-2">Submit Bid</button>
									</form>
								</div>
							</div>
						</div>
					</div>
				<?php } ?>
			</div>
		</div>
	</section>

	<footer class="footer-area section_gap">
		<div class="container">
			<div class="row">

				<div class="footer-bottom d-flex justify-content-center align-items-center flex-wrap">
					<p class="footer-text m-0"><!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
						Copyright &copy;<script>
							document.write(new Date().getFullYear());
						</script>Vokasi UB <i class="fa fa-heart-o" aria-hidden="true"></i> by <a href="https://colorlib.com" target="_blank">Colorlib</a>
						<!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
					</p>
				</div>
			</div>
	</footer>
	<!-- End footer Area -->

	<script src="../landing-page/js/vendor/jquery-2.2.4.min.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js" integrity="sha384-b/U6ypiBEHpOf/4+1nzFpr53nxSS+GLCkfwBdFNTxtclqqenISfwAzpKaMNFNmj4" crossorigin="anonymous"></script>
	<script src="../landing-page/js/vendor/bootstrap.min.js"></script>
	<script src="../landing-page/js/jquery.ajaxchimp.min.js"></script>
	<script src="../landing-page/js/jquery.nice-select.min.js"></script>
	<script src="../landing-page/js/jquery.sticky.js"></script>
	<script src="../landing-page/js/nouislider.min.js"></script>
	<script src="../landing-page/js/countdown.js"></script>
	<script src="../../landing-page/js//jquery.magnific-popup.min.js"></script>
	<script src="landing-page/js/owl.carousel.min.js"></script>
	<!--gmaps Js-->
	<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCjCGmQ0Uq4exrzdcL6rvxywDDOvfAu6eE"></script>
	<script src="../landing-page/js/gmaps.min.js"></script>
	<script src="../landing-page/js/main.js"></script>
	<script>
    // Ambil nilai dari PHP session untuk pesan sukses atau gagal
    <?php if(isset($_SESSION['success_message'])): ?>
        alert("<?php echo $_SESSION['success_message']; ?>");
        <?php unset($_SESSION['success_message']); ?>
    <?php elseif(isset($_SESSION['error_message'])): ?>
        alert("<?php echo $_SESSION['error_message']; ?>");
        <?php unset($_SESSION['error_message']); ?>
    <?php endif; ?>
</script>



</body>

</html>