<?php 
	require_once dirname(__FILE__)."/library/global.php";
	require_once dirname(__FILE__)."/library/page/b_change_password.php";
	


	session_start();
  session_destroy();

?>
<!doctype html>
<html lang="en">
  <head>
  	 <title><?php echo WEB_TITLE; ?></title>
	 <link rel="icon" type="image/png" href="assets/img/logo.png">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	
	<script type="text/javascript"  src="assets/vendor/jquery/jquery-3.6.js"></script>
	<script type="text/javascript"  src="assets/js/global.js"></script>
	<script type="text/javascript"  src="assets/js/page/jchange_password.js"></script>

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
					<img src="assets/img/logo.png" style="width:100%;"/>
		      	</div>
				
		      	<h3 class="text-center mb-4" style="font-weight: bold;">Training Application Management System </h3>
				<form action="" method="post" autocomplete='off' class="login-form" name="frmchange_password" id="frmchange_password">
					<div class="form-group d-flex">
						<div id="ErrorLogin" name="ErrorLogin" style="color:red;"></div>
					</div>
					<div class="form-group">
		      			<input type="text" id="username" name="username" class="form-control rounded-left" placeholder="Username" required value="<?php echo $id; ?>" data-toggle="tooltip" data-placement="top" title="Enter your user name" readonly>
					</div>
					<div class="form-group d-flex">
						<input type="password" id="current_password" name="current_password" class="form-control rounded-left" placeholder="Current Password" required value="" data-toggle="tooltip" data-placement="top" title="Enter your current password">
					</div>
					<hr />
					<div class="form-group">
		      			<input type="password" id="new_password" name="new_password" class="form-control rounded-left" placeholder="New Password" required value="" data-toggle="tooltip" data-placement="top" title="Enter your new password" onKeyUp="checkPasswordStrength();" >
		      			
					</div>
					<div class="form-group d-flex">
						<input type="password" id="repeat_password" name="repeat_password" class="form-control rounded-left" placeholder="Password Confirmation" required value="" data-toggle="tooltip" data-placement="top" title="Enter your password confirmation">
					</div>
					<div class="form-group">
						<div id="password-strength-status"></div>
					</div>

					<div class="form-group">
						<button type="button" id="change_password" name="change_password" class="form-control btn btn-primary rounded submit px-3" onclick="">Change Password</button>
					</div>
					
					
	          </form>
	        </div>
				</div>
			</div>
		</div>
	</section>


	</body>
</html>

