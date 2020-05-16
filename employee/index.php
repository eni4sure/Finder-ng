<?php session_start(); ?>
<!DOCTYPE HTML>
<html lang="en-NG">

<?php include ('php/check_login.php'); ?>

<?php $head_title = 'My Profile | Employee | Finder'; ?>
<?php include ('includes/head.php'); ?>

<body class="relative" data-spy="scroll" data-target=".navbar-landing">
	<div class="se-pre-con"></div>

	<?php $page_nav = ''; ?>
	<?php include ('includes/navbar.php'); ?>

	<style>
		.autofit2 { height:80px; width:85px; object-fit:cover; border-radius: 50%; }
	</style>

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

				<?php $user_panel_nav = 'profile'; ?>
				<?php include ('includes/user_panel.php'); ?>

				<div class="col-md-9 col-sm-8 col-xs-12">
					<div class="admin-content-wrapper">

						<div class="admin-section-title">
							<h2>Profile</h2>
						</div>
						
						<form class="post-form-wrapper" action="php/update-profile" method="POST">
							<div class="row gap-20">

								<div class="col-sm-6 col-md-6">
									<div class="form-group">
										<label>First Name</label>
										<input name="fname" required type="text" class="form-control" value="<?php echo $sess_fname ?>" placeholder="Enter your first name">
									</div>
								</div>

								<div class="col-sm-6 col-md-6">
									<div class="form-group">
										<label>Last Name</label>
										<input type="text" name="lname" required class="form-control" value="<?php echo $sess_lname ?>" placeholder="Enter your last name">
									</div>
								</div>

								<div class="col-sm-6 col-md-6">
									<div class="form-group">
										<label>Email</label>
										<input type="email" name="email" required class="form-control" value="<?php echo $sess_email ?>" placeholder="Enter your email address">
									</div>
								</div>

								<div class="col-sm-6 col-md-6">
									<div class="form-group">
										<label>Gender</label>
										<select name="gender" required class="form-control">
											<option disabled value="">Select</option>
											<option <?php if( $sess_gender == "M") { echo "selected"; } else {} ?> value="M">Male</option>
											<option <?php if( $sess_gender == "F") { echo "selected"; } else {} ?> value="F">Female</option>
										</select>
									</div>
								</div>

								<div class="col-sm-6 col-md-6">
									<div class="form-group">
										<label>Phone Number</label>
										<input name="phone_no" required class="form-control" value="<?php echo $sess_phone_no ?>" type="tel" pattern="[0-9]{11,11}" maxlength="11">
									</div>
								</div>

								<div class="col-sm-6 col-md-6">
									<div class="form-group">
										<label>City/Town</label>
										<input name="city_town" required class="form-control" value="<?php echo $sess_city_town ?>" type="text" placeholder="Enter your state">
									</div>
								</div>

								<div class="col-sm-12 col-md-12">
									<div class="form-group">
										<label>About me <i class="fa fa-info-circle" data-toggle="tooltip" title="Enter a short description about yourself to help people know you better"></i> </label>
										<textarea name="about" required class="form-control" minlength="50" placeholder="Enter a short description ..." style="height: 200px;"><?php echo $sess_about ?></textarea>
									</div>
								</div>

								<div class="col-sm-12 mt-10">
									<button type="submit" class="btn btn-primary" name="update-profile">Update</button>
									<button type="reset" class="btn btn-primary btn-inverse">Cancel</button>
								</div>
							</div>
						</form>

						<br>

						<form action="php/upload_image" method="POST" enctype="multipart/form-data">
							<div class="row gap-20">
								<div class="col-sm-12 col-md-12">
									<div class="form-group">
										<label>Display Image</label><br>
										<input accept=".jpg,.png,.jpeg" type="file" name="image" id="image" required>
									</div>
								</div>

								<div class="col-sm-12 mt-10">
									<button type="submit" class="btn btn-primary" name="upload-img">Update</button>
								</div>
							</div>
						</form>

					</div>
				</div>
			</div>
		</div>
	</div>

	<?php include ('includes/footer.php'); ?>

</body>
</html>