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

<?php $head_title = 'Sign Up | Finder'; ?>
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
				<div class="card col-md-5">
					<header class="card-header">
						<h4 class="card-title text-center mt-2">Employee Form</h4>
					</header>
					<article class="card-body">
						<form action="php/create-account" method="POST" name="frm1">
							<div class="form-row">
								<div class="col form-group">
									<label>First name</label>
									<input type="text" required class="form-control" name="fname" placeholder="Enter first name">
								</div>
								<div class="col form-group">
									<label>Last name</label>
									<input type="text" required class="form-control" name="lname" placeholder="Enter last name">
								</div>
							</div>
							<div class="form-group">
								<label>Email address</label>
								<input type="email" required class="form-control" name="email" placeholder="Enter Email Address">
							</div>
							<div class="form-group">
								<label>Gender: </label>
								<label class="form-check form-check-inline">
									<input checked class="form-check-input" type="radio" name="gender" value="M">
									<span class="form-check-label"> Male </span>
								</label>
								<label class="form-check form-check-inline">
									<input class="form-check-input" type="radio" name="gender" value="F">
									<span class="form-check-label"> Female</span>
								</label>
							</div>
							<div class="form-row">
								<div class="form-group col-md-6">
									<label>City/Town</label>
									<input type="text" required class="form-control" name="city_town" placeholder="Enter your city/town">
								</div>
								<div class="form-group col-md-6">
									<label>Phone Number</label>
									<input type="tel" required class="form-control" name="phone_no" placeholder="Enter Phone Number" pattern="[0-9]{11,11}" maxlength="11">
								</div>
							</div>
							<div class="form-group">
								<label>Password</label>
								<input required class="form-control" name="passkey" type="password" placeholder="Enter password">
							</div>
							<div class="form-group">
								<label>Confirm Password</label>
								<input required class="form-control" name="Cpasskey" type="password" placeholder="Enter confirm password">
							</div>
							<div class="form-group">
								<input required class="form-control" name="role" type="text" value="employee" hidden>
								<button type="submit" onclick="return check_passwords1();" class="btn btn-primary btn-block" name="register"> Sign Up</button>
							</div>
							<small class="text-muted">By clicking the 'Sign Up' button, you confirm that you accept our <br> Terms of use and Privacy Policy.</small>
						</form>
					</article>
					<div class="border-top card-body text-center">Have an account? <a href="login">Log In</a></div>
				</div>
				<br>
				<div class="col-md-2"></div>
				<br>
				<div class="card col-md-5">
					<header class="card-header">
						<h4 class="card-title text-center mt-2">Employer Form</h4>
					</header>
					<article class="card-body">
						<form action="php/create-account" method="POST" name="frm2">
							<div class="form-group">
								<label>Company Name</label>
								<input type="text" required class="form-control" name="comp_name" placeholder="Enter company name">
							</div>
							<div class="form-group">
								<label>Email Address</label>
								<input type="email" required class="form-control" name="email" placeholder="Enter email address">
							</div>
							<div class="form-group">
								<label>Company Type</label>
								<input type="text" required class="form-control" name="comp_type" placeholder="Enter company type E.g Computer Software, Insurance, Banking">
							</div>
							<div class="form-row">
								<div class="form-group col-md-6">
									<label>City/Town</label>
									<input type="text" required class="form-control" name="comp_city_town" placeholder="Enter your city">
								</div>
								<div class="form-group col-md-6">
									<label>Phone Number</label>
									<input type="tel" required class="form-control" name="comp_phone_no" placeholder="Enter Phone Number" pattern="[0-9]{11,11}" maxlength="11">
								</div>
							</div>
							<div class="form-group">
								<label>Password</label>
								<input type="password" required class="form-control" name="comp_passkey" placeholder="Enter password">
							</div>
							<div class="form-group">
								<label>Confirm password</label>
								<input type="password" required class="form-control" name="comp_Cpasskey" placeholder="Enter confirm password">
							</div>
							<div class="form-group">
								<input required class="form-control" name="role" type="text" value="employer" hidden>
								<button type="submit" onclick="return check_passwords2();" class="btn btn-primary btn-block" name="register"> Sign Up</button>
							</div>
							<small class="text-muted">By clicking the 'Sign Up' button, you confirm that you accept our <br> Terms of use and Privacy Policy.</small>
						</form>
					</article>
					<div class="border-top card-body text-center">Have an account? <a href="login">Log In</a></div>
				</div>
			</div>
		</div>
	</section>

	<script type="text/javascript">
		function check_passwords1(){
			if(frm1.passkey.value == ""){

				alert("Enter the Password.");
				frm1.passkey.focus();
				return false;
			}

			if(frm1.Cpasskey.value == ""){

				alert("Enter the Confirmation Password.");
				frm1.Cpasskey.focus();
				return false;
			}

			if(frm1.Cpasskey.value != frm1.passkey.value){

				alert("Password confirmation does not match.");
				return false;
			}

			return true;
		}
	</script>

	<script type="text/javascript">
		function check_passwords2(){
			if(frm2.comp_passkey.value == ""){

				alert("Enter the Password.");
				frm2.comp_passkey.focus();
				return false;
			}

			if(frm2.comp_Cpasskey.value == ""){

				alert("Enter the Confirmation Password.");
				frm2.comp_Cpasskey.focus();
				return false;
			}

			if(frm2.comp_Cpasskey.value != frm2.comp_passkey.value){

				alert("Password confirmation does not match.");
				return false;
			}

			return true;
		}
	</script>

	<?php include ('includes/footer.php'); ?>

</body>
</html>