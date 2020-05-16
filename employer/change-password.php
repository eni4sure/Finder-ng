<?php session_start(); ?>
<!DOCTYPE HTML>
<html lang="en-NG">

<?php include ('php/check_login.php'); ?>

<?php $head_title = 'Change Password | Employer | Finder'; ?>
<?php include ('includes/head.php'); ?>

<body class="relative" data-spy="scroll" data-target=".navbar-landing">
	<div class="se-pre-con"></div>

	<?php $page_nav = ''; ?>
	<?php include ('includes/navbar.php'); ?>

	<div class="admin-container-wrapper" style="padding-top: 7em !important;">
		<div class="container">
			<?php
				if (isset($_GET['r']) & isset($_GET['ty'])) {
					$report_msg = $_GET['r'];
					$report_type = $_GET['ty'];
					echo '<div class="text-center alert alert-'.$report_type.'">'.strtoupper($report_msg).'</div>';
				}
			?>
			<br>
			<div class="row">

				<?php $user_panel_nav = 'change-password'; ?>
				<?php include ('includes/user_panel.php'); ?>

				<div class="col-md-9 col-sm-8 col-xs-12">
					<div class="admin-content-wrapper">

						<div class="admin-section-title">
							<h2>Change Password</h2>										
						</div>

						<form name="frm" class="post-form-wrapper" action="php/change-pass" method="POST">
							<div class="row gap-20">

								<div class="col-sm-6 col-md-8">
									<div class="form-group">
										<label>Current Password</label>
										<input type="password" required class="form-control" name="currentpasskey" placeholder="Enter your current password">
									</div>
								</div>

								<div class="col-sm-6 col-md-6">
									<div class="form-group">
										<label>Password</label>
										<input type="password" required class="form-control" name="newpasskey" placeholder="Enter new password">
									</div>
								</div>

								<div class="col-sm-6 col-md-6">
									<div class="form-group">
										<label>Confirm password</label>
										<input type="password" required class="form-control" name="Cpasskey" placeholder="Confirm new password">
									</div>
								</div>

								<div class="col-sm-12 mt-10">
									<button type="submit" onclick="return check_passwords();" class="btn btn-primary" name="change-pass">Change Password</button>
									<button type="reset" class="btn btn-primary btn-inverse">Cancel</a>
								</div>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>

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