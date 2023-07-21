<?php 
	require_once dirname(__FILE__)."/library/global.php";
	header('Refresh: 5; URL=dashboard.php');
?>
<!doctype html>
<html lang="en">
  <head>
  	 <title><?php echo WEB_TITLE; ?></title>
	 <link rel="icon" type="image/png" href="assets/img/logo.png">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	
	<script type="text/javascript"  src="assets/js/core/jquery-3.6.js"></script>
	<script type="text/javascript"  src="assets/js/page/jlogin.js"></script>

	<link href="https://fonts.googleapis.com/css?family=Lato:300,400,700&display=swap" rel="stylesheet">
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">	
	<link rel="stylesheet" href="assets/css/login.css">
	</head>
	<body>
	<section class="ftco-section">
		<div class="container">
			<div class="row justify-content-center">
				<div class="col-md-6 text-center mb-5">
					<h4 class="heading-section"></h4>
				</div>
			</div>
			<div class="row justify-content-center">
				<div class="col-md-7 col-lg-5">
					<div class="login-wrap p-4 p-md-5">
		      	<div class="icon d-flex align-items-center justify-content-center">
							<img src="assets/img/logo.png" style="width:70%;"/>
		      	</div>
				
		      	<h3 class="text-center mb-4" style="font-weight: bold;">Training Application Management System</h3>

		      	<br >
		      	<h4 class="text-center mb-4" style="font-weight: bold;">You are not authorised to access the page</h4>

		      	<h6 class="text-center mb-4" style="font-weight: bold;">You will be redirected to dashboard in 5 seconds...</h6>
							
	        </div>
				</div>
			</div>
		</div>
	</section>


	</body>
</html>

