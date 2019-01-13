<!doctype html>
<html class="fixed">
	<head>
		<meta charset="UTF-8">

		<meta name="keywords" content="Candidate Registration" />
		<meta name="description" content="Candidate Registration">
		<meta name="author" content="portal">
		<meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no" />
		<link href="http://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700,800|Shadows+Into+Light" rel="stylesheet" type="text/css">
		<link rel="stylesheet" href="../assets/vendor/bootstrap/css/bootstrap.css" />
		<link rel="stylesheet" href="../assets/vendor/font-awesome/css/font-awesome.css" />
		<link rel="stylesheet" href="../assets/vendor/magnific-popup/magnific-popup.css" />
		<link rel="stylesheet" href="../assets/vendor/bootstrap-datepicker/css/datepicker3.css" />
		<link rel="stylesheet" href="../assets/stylesheets/theme.css" />
		<link rel="stylesheet" href="../assets/stylesheets/skins/default.css" />
		<link rel="stylesheet" href="../assets/stylesheets/theme-custom.css">
		<script src="../assets/vendor/modernizr/modernizr.js"></script>

	</head>
	<body>

	<?php
	session_start();
		$type  = '';
	if (isset($_SESSION['message'])){
		$type = $_SESSION['message']['type']; $message = $_SESSION['message']['message'];
	}
	if ($type && $message): ?>
		<div id="Message" class="<?php echo $type == 'error' ? 'alert-danger' : 'alert-success' ?> col-sm-12" style="margin-bottom: 12px; padding: 12px 12px;"><?php echo $message; ?></div>
	<?php endif; ?>
		
		<section class="body-sign">
			<div class="center-sign">
				<a href="/" class="logo pull-left">
					<h3>Employer</h3>
				</a>

				<div class="panel panel-sign">
					<div class="panel-title-sign mt-xl text-right">
						<h2 class="title text-uppercase text-bold m-none"><i class="fa fa-user mr-xs"></i> Sign Up</h2>
					</div>
					<div class="panel-body">
						<form action="validate.php" method="POST">
							<div class="form-group mb-lg">
								<label>Company Name</label>
								<input name="name" type="text" class="form-control input" placeholder="name"/>
							</div>

							<div class="form-group mb-lg">
								<label>Company Website</label>
								<input name="website" type="text" class="form-control input" placeholder="website"/>
							</div>

							<div class="form-group mb-lg">
								<label>E-mail Address</label>
								<input name="email" type="email" class="form-control input" placeholder="Email address"/>
							</div>

							<div class="form-group mb-lg">
								<label>Contact Number</label>
								<input name="number" type="number" class="form-control input" placeholder="Contact Number"/>
							</div>

							<div class="form-group mb-lg">
								<label>Password</label>
								<input name="pwd" type="password" class="form-control input" placeholder="Password"/>
							</div>

							<div class="row">
								<div class="col-sm-8">
									<div class="checkbox-custom checkbox-default">
										<!-- <input id="AgreeTerms" name="agreeterms" type="checkbox"/>
										<label for="AgreeTerms">I agree with <a href="#">terms of use</a></label> -->
									</div>
								</div>
								<div class="col-sm-4 text-right">
									<button type="submit" class="btn btn-primary hidden-xs" name="company_register">Sign Up</button>
									<button type="submit" class="btn btn-primary btn-block btn-lg visible-xs mt-lg" name="company_register">Sign Up</button>
								</div>
							</div>

							<span class="mt-lg mb-lg line-thru text-center text-uppercase">
								<span>or</span>
							</span>

							<div class="mb-xs text-center">
								<h4>Student <a href="../student/signup.php">Signup</a></h4>
							</div>

							<p class="text-center">Already have an account? <a href="signin.php">Sign In!</a>

						</form>
					</div>
				</div>
			</div>
		</section>

		<script src="../assets/vendor/jquery/jquery.js"></script>
		<script src="../assets/vendor/jquery-browser-mobile/jquery.browser.mobile.js"></script>
		<script src="../assets/vendor/bootstrap/js/bootstrap.js"></script>
		<script src="../assets/vendor/nanoscroller/nanoscroller.js"></script>
		<script src="../assets/vendor/bootstrap-datepicker/js/bootstrap-datepicker.js"></script>
		<script src="../assets/vendor/magnific-popup/magnific-popup.js"></script>
		<script src="../assets/vendor/jquery-placeholder/jquery.placeholder.js"></script>
		<script src="../assets/javascripts/theme.js"></script>
		<script src="../assets/javascripts/theme.custom.js"></script>
		<script src="../assets/javascripts/theme.init.js"></script>

		<script>
			setTimeout(function() {
				$('#Message').fadeOut('fast');
				<?php unset($_SESSION['message']); ?>
			}, 5000);
		</script>

	</body>
</html>