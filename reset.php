<?php session_start(); ?>
<!DOCTYPE HTML>
<html lang="en-NG">

<?php include ('php/check_login.php'); ?>

<?php $head_title = 'Reset Password | Finder'; ?>
<?php include ('includes/head.php'); ?>

<body class="relative" data-spy="scroll" data-target=".navbar-landing">
	<div class="se-pre-con"></div>

	<?php $page_nav = ''; ?>
	<?php include ('includes/navbar.php'); ?>

	<?php
		require('php/connect.php');

		if (isset($_GET['token'])) {

			$token = $_GET['token'];
		} else {

			header("location:./");
		}
	?>

	<?php $search_nav = ''; ?>
	<?php include ('includes/search.php'); ?>

	<!-- ========================= SECTION CONTENT ========================= -->
	<section class="section-content bg padding-y">
		<div class="container">
			<div class="row">
				<div class="col-md-4"></div>
				<?php 
					$get_token = "SELECT COUNT(*) FROM tbl_tokens WHERE token = '$token' limit 1";
					$run_token = mysqli_query($connection, $get_token);
					$row_token = mysqli_fetch_array($run_token);
					$count_token_res = array_shift($row_token);

					if ($count_token_res == "0") {
						?>
						<div class="admin-empty" style="margin: 0px 0 0px;">
							<div class="icon">
								<i class="fa fa-frown-o"></i>
							</div>
							<strong>Could not use this token because</strong><br>
							<li>This token is invalid</li>
							<li>This token is already used</li>
						</div>
						<?php
					} else {
						$get_token2 = "SELECT * FROM tbl_tokens WHERE token = '$token' limit 1";
						$run_token2 = mysqli_query($connection, $get_token2);

						while ($row_token2 = mysqli_fetch_array($run_token2)){

							$_SESSION['resetmail'] = $row_token2['email'];
						}
						?>
						<div class="card col-md-4">
							<article class="card-body">
								<h4 class="card-title text-center mb-4 mt-1"><i class="fa fa-key"></i> Reset your Password</h4>
								<hr>
								<form action="php/reset-pass" method="POST" name="frm">
									<div class="form-group">
										<label>New Password</label>
										<div class="input-group">
											<div class="input-group-prepend">
												<span class="input-group-text"> <i class="fa fa-lock"></i> </span>
											 </div>
											<input name="newpasskey" required class="form-control" placeholder="********" type="password">
										</div>
									</div>
									<div class="form-group">
										<label>Confirm Password</label>
										<div class="input-group">
											<div class="input-group-prepend">
												<span class="input-group-text"> <i class="fa fa-lock"></i> </span>
											 </div>
											<input name="Cpasskey" required class="form-control" placeholder="********" type="password">
										</div>
									</div>
									<div class="form-group">
										<button type="submit" onclick="return check_passwords();" class="btn btn-primary btn-block" name="reset-pass"> Reset Password</button>
									</div>
									<p class="text-right"><a href="login">Login</a></p>
								</form>
							</article>
							<div class="border-top card-body text-center">Don't have an account? <a href="sign-up">Sign Up</a></div>
						</div>
						<?php
					} ?>
					
				<div class="col-md-4"></div>
			</div>
		</div>
	</section>
	<!-- ========================= SECTION CONTENT END// ========================= -->

	<script type="text/javascript">
		function check_passwords(){
			if(frm.newpasskey.value == ""){

				alert("Enter the Password.");
				frm.newpasskey.focus();
				return false;
			}

			if(frm.Cpasskey.value == ""){

				alert("Enter the Confirmation Password.");
				frm.Cpasskey.focus();
				return false;
			}

			if(frm.Cpasskey.value != frm.newpasskey.value){

				alert("Password confirmation does not match.");
				return false;
			}

			return true;
		}
	</script>

	<?php include ('includes/footer.php'); ?>

</body>
</html>