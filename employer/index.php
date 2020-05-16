<?php session_start(); ?>
<!DOCTYPE HTML>
<html lang="en-NG">

<?php include ('php/check_login.php'); ?>

<?php $head_title = 'My Profile | Employer | Finder'; ?>
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

				<?php $user_panel_nav = 'profile'; ?>
				<?php include ('includes/user_panel.php'); ?>

				<div class="col-md-9 col-sm-8 col-xs-12">
					<div class="admin-content-wrapper">

						<div class="admin-section-title">
							<h2>Profile</h2>
						</div>
						
						<form class="post-form-wrapper" action="php/update-profile" method="POST">
							<div class="row gap-20">

								<div class="col-sm-6 col-md-8">
									<div class="form-group">
										<label>Company Name</label>
										<input type="text"  name="company_name" required class="form-control" value="<?php echo $sess_comp_name ?>" placeholder="Enter company name">
									</div>
								</div>

								<div class="col-sm-6 col-md-6">
									<div class="form-group">
										<label>Established in</label>
										<input type="text" name="company_year" required class="form-control" value="<?php echo $sess_comp_year ?>" placeholder="Enter year eg: 2016, 2017, 2018" maxlength="4">
									</div>
								</div>

								<div class="col-sm-6 col-md-6">
									<div class="form-group">
										<label>Company Type <i class="fa fa-info-circle" data-toggle="tooltip" title="Company type is used to improve your search presence. E.g Networking, Banking, Insurance"></i> </label>
										<input type="text" name="company_type" required class="form-control" value="<?php echo $sess_comp_type ?>" placeholder="Eg: Booking, Travel, Banking, Insurance">
									</div>
								</div>

								<div class="col-sm-6 col-md-6">
									<div class="form-group">
										<label>People <i class="fa fa-info-circle" data-toggle="tooltip" title="Number of Staff in Organisation"></i></label>
										<select name="company_people" class="form-control" required>
											<option <?php if( $sess_comp_people == "") { echo "selected"; } else {} ?> value="">Select Number of Staff(s)</option>
											<option <?php if( $sess_comp_people == "1-10") { echo "selected"; } else {} ?> value="1-10">1-10</option>
											<option <?php if( $sess_comp_people == "11-100") { echo "selected"; } else {} ?> value="11-100">11-100</option>
											<option <?php if( $sess_comp_people == "200+") { echo "selected"; } else {} ?> value="200+">200+</option>
											<option <?php if( $sess_comp_people == "300+") { echo "selected"; } else {} ?> value="300+">300+</option>
											<option <?php if( $sess_comp_people == "1000+") { echo "selected"; } else {} ?> value="1000+">1000+ </option>
										</select>
									</div>
								</div>

								<div class="col-sm-6 col-md-6">
									<div class="form-group">
										<label>Website</label>
										<input type="url" name="company_website" class="form-control" value="<?php echo $sess_comp_website ?>" placeholder="Enter company website">
									</div>
								</div>
								<div class="col-sm-6 col-md-6">
									<div class="form-group">
										<label>Phone Number</label>
										<input type="tel" name="company_phone_no" required class="form-control" value="<?php echo $sess_comp_phone_no ?>" placeholder="Enter Phone Number" pattern="[0-9]{11,11}" maxlength="11">
									</div>
								</div>

								<div class="col-sm-6 col-md-6">
									<div class="form-group">
										<label>City/Town</label>
										<input type="text" name="company_city_town" required class="form-control" value="<?php echo $sess_comp_city_town ?>" placeholder="Enter your city/town">
									</div>
								</div>

								<div class="col-sm-6 col-md-6">
									<div class="form-group">
										<label>Office Address</label>
										<input type="text" name="company_address" class="form-control" value="<?php echo $sess_comp_address ?>" placeholder="Enter your office address">
									</div>
								</div>

								<div class="col-sm-6 col-md-6">
									<div class="form-group">
										<label>Email Address</label>
										<input type="email" name="company_email" required class="form-control" value="<?php echo $sess_comp_email ?>" placeholder="Enter your email address">
									</div>
								</div>

								<div class="col-sm-12 col-md-12">
									<div class="form-group">
										<label>About Company <i class="fa fa-info-circle" data-toggle="tooltip" title="Enter a short description about the company to help build an audience"></i> </label>
										<textarea name="company_about" class="form-control" minlength="100" placeholder="Enter a short description about your company..." style="height: 200px;"><?php echo $sess_comp_about ?></textarea>
									</div>
								</div>

								<div class="col-sm-12 col-md-12">
									<div class="form-group">
										<label>Company Services <i class="fa fa-info-circle" data-toggle="tooltip" title="Enter services made available by your company"></i> </label>
										<textarea name="company_services" class="form-control" minlength="50" placeholder="Enter company services ..." style="height: 200px;"><?php echo $sess_comp_services ?></textarea>
									</div>
								</div>

								<div class="col-sm-12 col-md-12">
									<div class="form-group">
										<label>Company Expertise <i class="fa fa-info-circle" data-toggle="tooltip" title="Enter expertise posts available in your comapny E.g Human Resource Manager, Digital Marketing"></i> </label>
										<textarea name="company_expertise" class="form-control" minlength="50" placeholder="Enter company expertise ..." style="height: 200px;"><?php echo $sess_comp_expertise ?></textarea>
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