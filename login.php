<?php session_start(); ?>
<!DOCTYPE HTML>
<html lang="en-NG">

<?php include ('php/check_login.php'); ?>

<?php
	if ($user_online == "true") {
		header("location:./");
	} else {
		
	}
?>

<?php $head_title = 'Sign In | Finder'; ?>
<?php include ('includes/head.php'); ?>

<body class="relative" data-spy="scroll" data-target=".navbar-landing">
	<div class="se-pre-con"></div>

	<?php $page_nav = ''; ?>
	<?php include ('includes/navbar.php'); ?>

	<section class="section-content padding-y-sm bg" style="padding-top: 7em !important;">
		<div class="container">
			<?php
				if (isset($_GET['r']) & isset($_GET['ty'])) {
					$report_msg = $_GET['r'];
					$report_type = $_GET['ty'];
					echo '<div class="text-center alert alert-'.$report_type.'">'.strtoupper($report_msg).'</div>';
				}
			?>
			<div class="row">
				<div class="col-md-4"></div>
				<div class="card col-md-4">
					<article class="card-body">
						<h4 class="card-title text-center mb-4 mt-1"><i class="fa fa-sign-in"></i> Sign in</h4>
						<hr>
						<p class="text-success text-center">Login to Access More Features</p>
						<form action="php/login_auth" method="POST">
							<div class="form-group">
								<label>Email Address</label>
								<div class="input-group">
									<div class="input-group-prepend">
										<span class="input-group-text"> <i class="fa fa-user"></i> </span>
									 </div>
									<input name="email" required class="form-control" placeholder="E-mail Address" type="email">
								</div>
							</div>
							<div class="form-group">
								<label>Password</label>
								<div class="input-group">
									<div class="input-group-prepend">
										<span class="input-group-text"> <i class="fa fa-lock"></i> </span>
									 </div>
									<input name="passkey" required class="form-control" placeholder="********" type="password">
								</div>
							</div>
							<div class="form-group">
								<button type="submit" class="btn btn-primary btn-block" name="login"> Login</button>
							</div>
							<p class="text-right"><a href="forgot">Forgot password?</a></p>
						</form>
					</article>
					<div class="border-top card-body text-center">Don't have an account? <a href="sign-up">Sign Up</a></div>
				</div>
				<div class="col-md-4"></div>
			</div>
		</div>
	</section>

	<!-- ========================= FOOTER ========================= -->
	<footer class="section-footer bg-dark white sticky-bottom">
		<div class="container">
			<section class="footer-bottom">
				<p class="text-center">Copyright &copy 2018 Finder</p>
			</section>
		</div>
	</footer>
	<!-- ========================= FOOTER END // ========================= -->

	<?php include ('includes/scripts.php'); ?>

</body>
</html>