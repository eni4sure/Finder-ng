<?php session_start(); ?>
<!DOCTYPE HTML>
<html lang="en-NG">

<?php include ('php/check_login.php'); ?>

<?php 
	if (isset($_GET['view'])) {

		require('php/connect.php');

		$employee_member_no = $_GET['view'];

		$count_companies = "SELECT COUNT(*) FROM tbl_users WHERE member_no = '$employee_member_no' AND role = 'employee'";
		$count_companies_code = mysqli_query($connection, $count_companies);
		$count_companies_get = mysqli_fetch_array ($count_companies_code);
		$count_companies_res = array_shift($count_companies_get);

		if ($count_companies_res == "0") {

			header("location:./");
		} else {

			$get_employee_details = "SELECT * FROM tbl_users WHERE member_no = '$employee_member_no' AND role = 'employee'";
			$run_employee_details = mysqli_query($connection, $get_employee_details);

			while ($row_employee_details = mysqli_fetch_array($run_employee_details)){

				$employee_fname 		= $row_employee_details['fname'];
				$employee_lname 		= $row_employee_details['lname'];
				$employee_gender	 	= $row_employee_details['gender'];
				$employee_email 		= $row_employee_details['email'];
				$employee_phone_no	 	= $row_employee_details['phone_no'];
				$employee_city_town 	= $row_employee_details['city_town'];
				$employee_about 		= $row_employee_details['about'];
				$employee_image 		= $row_employee_details['image'];
			}
		}
	} else {

		header("location:./");
	}
?>

<?php $head_title = ''.$employee_fname.' '.$employee_lname.' | Finder'; ?>
<?php include ('includes/head.php'); ?>

<body class="relative" data-spy="scroll" data-target=".navbar-landing">
	<div class="se-pre-con"></div>

	<?php $page_nav = 'employees'; ?>
	<?php include ('includes/navbar.php'); ?>

	<!-- ========================= SECTION CONTENT ========================= -->
	<section class="section-content bg padding-y" style="padding-top: 7em !important;">
		<div class="container">
			<div class="row">
				<div class="col-md-1"></div>
				<div class="col-md-10">
					<div class="employee-detail-wrapper">
						<div class="employee-detail-header text-center">
							<div class="image">
								<img src="<?php if( $employee_image == '') { echo 'employee_img/default.png'; } else { echo 'employee_img/'.$employee_image.'';} ?>" alt="image" class="img-circle" style="width: 108px; height: 108px;">
							</div>
							<h2 class="heading mb-15"><?php echo $employee_fname; ?> <?php echo $employee_lname; ?></h2>
						
							<p class="location"><i class="fa fa-map-marker"></i> <?php echo $employee_city_town; ?> <span class="mh-5">|</span> <i class="fa fa-phone"></i> <?php echo $employee_phone_no; ?></p>
							<?php
								$count_cv = "SELECT COUNT(*) FROM tbl_cv WHERE member_no = '$employee_member_no'";
								$count_cv_code = mysqli_query($connection, $count_cv);
								$count_cv_get = mysqli_fetch_array ($count_cv_code);
								$count_cv_res = array_shift($count_cv_get);

								if ($count_cv_res > 0) {
									$get_cv_info = "SELECT cv_attachment FROM `tbl_cv` WHERE member_no = '$employee_member_no'";
									$get_cv_info_code = mysqli_query($connection, $get_cv_info);
									$get_cv_info_res = mysqli_fetch_array ($get_cv_info_code);

									$cv = $get_cv_info_res['cv_attachment'];
									?>
									<div class="clearfix">
										<a href="cv/<?php echo $cv; ?>" class="btn btn-primary">Download CV</a>
									</div>
									<?php
								} else {
									echo "";
								}
							?>
							<ul class="meta-list clearfix">
								<li class="text-center" style="width: 50%;">
									<h4 class="heading">Gender:</h4>
									<?php if( $employee_gender == 'M') { echo 'Male'; } else { echo 'Female';} ?>
								</li>
								<li class="text-center" style="width: 50%;">
									<h4 class="heading">Email: </h4>
									<?php echo $employee_email; ?>
								</li>
							</ul>
						</div>
			
						<div class="employee-detail-company-overview mt-40 clearfix">
							<h3>About Me</h3>
							<p><?php if( $employee_about == '') { echo '<div class="admin-empty"> <h4 style="text-transform: uppercase;">No Info Available</h4> </div>'; } else { echo ''.$employee_about.'';} ?></p>

							<!-- <div class="row">
								<div class="col-sm-6">
									<h3>Education</h3>
									<ul class="employee-detail-list">
										<li>
											<h5>Bachelor Of Engineering in Computer </h5>
											<p class="text-muted font-italic">Jan 2008 – Jan 2012 from <span class="font600 text-primary">University of Bangkok, Thailand</span></p>
											<p>Consider now provided laughter boy landlord dashwood. Village equally prepare up females as an. That do an case an what plan hour of paid.</p>
										</li>
										<li>
											<h5>Master Of Engineering in Computer </h5>
											<p class="text-muted font-italic">Jan 2008 – Jan 2012 from <span class="font600 text-primary">University of Bangkok, Thailand</span></p>
											<p>Ignorant saw her her drawings marriage laughter. Case oh an that or away sigh do here upon. Acuteness you exquisite ourselves now end forfeited.</p>
										</li>
										<li>
											<h5>Certificate in Web Design</h5>
											<p class="text-muted font-italic">Jan 2008 – Jan 2012 from <span class="font600 text-primary">University of Bangkok, Thailand</span></p>
											<p>Advice me cousin an spring of needed. Tell use paid law ever yet new. Meant to learn of vexed if style allow he there.</p>
										</li>
									</ul>
								</div>
								<div class="col-sm-6">
									<h3>Skill</h3>
									<ul class="employee-detail-list">
										<li>
											<h5>HTML</h5>
											<div class="progress">
												<div class="progress-bar" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: 60%;">
													60%
												</div>
											</div>
											<p>Village equally prepare up females as an. That do an case an what plan hour of paid.</p>
										</li>
										<li>
											<h5>CSS</h5>
											<div class="progress">
												<div class="progress-bar" role="progressbar" aria-valuenow="80" aria-valuemin="0" aria-valuemax="100" style="width: 80%;">
													80%
												</div>
											</div>
											<p>Case oh an that or away sigh do here upon. Acuteness you exquisite ourselves now end forfeited.</p>
										</li>
										<li>
											<h5>jQuery</h5>
											<div class="progress">
												<div class="progress-bar" role="progressbar" aria-valuenow="75" aria-valuemin="0" aria-valuemax="100" style="width: 75%;">
													75%
												</div>
											</div>
											<p>Tell use paid law ever yet new. Meant to learn of vexed if style allow he there.</p>
										</li>
										<li>
											<h5>Languages</h5>
											<p class="text-muted font-italic">3 languages: <span class="font600 text-primary">English, Thai, Malay</span></p>
											<p>Times so do he downs me would. Witty abode party her found quiet law. They door four bed fail now have. Tell use paid law ever yet new. Meant to learn of vexed if style allow he there.</p>
										</li>
									</ul>
								</div>
							</div>

							<h3>Work Expeince</h3>
							<div class="work-expereince-wrapper">
								<div class="work-expereince-block">
									<div class="work-expereince-content">
										<h5>Advanced addition absolute received</h5>
										<p class="text-muted font-italic">Jan 2008 – Jan 2012 at <span class="font600 text-primary">Some Compamy Name</span></p>
										<p>In entirely be to at settling felicity. Fruit two match men you seven share. Was justice improve age article between. No projection as up preference reasonably delightful celebrated. Preserved and abilities assurance tolerably breakfast use saw replying throwing he.</p>
									</div>
								</div>
								<div class="work-expereince-block">
									<div class="work-expereince-content">
										<h5>Advanced addition absolute received</h5>
										<p class="text-muted font-italic">Jan 2008 – Jan 2012 at <span class="font600 text-primary">Some Compamy Name</span></p>
										<p>In entirely be to at settling felicity. Fruit two match men you seven share. Was justice improve age article between. No projection as up preference reasonably delightful celebrated. Preserved and abilities assurance tolerably breakfast use saw replying throwing he.</p>
									</div>
								</div>
								<div class="work-expereince-block">
									<div class="work-expereince-content">
										<h5>Advanced addition absolute received</h5>
										<p class="text-muted font-italic">Jan 2008 – Jan 2012 at <span class="font600 text-primary">Some Compamy Name</span></p>
										<p>In entirely be to at settling felicity. Fruit two match men you seven share. Was justice improve age article between. No projection as up preference reasonably delightful celebrated. Preserved and abilities assurance tolerably breakfast use saw replying throwing he.</p>
									</div>
								</div>
								<div class="work-expereince-block">
									<div class="work-expereince-content">
										<h5>Advanced addition absolute received</h5>
										<p class="text-muted font-italic">Jan 2008 – Jan 2012 at <span class="font600 text-primary">Some Compamy Name</span></p>
										<p>In entirely be to at settling felicity. Fruit two match men you seven share. Was justice improve age article between. No projection as up preference reasonably delightful celebrated. Preserved and abilities assurance tolerably breakfast use saw replying throwing he.</p>
									</div>
								</div>
							</div> -->

							<h3>Interests &amp; Hobby</h3>
							<p> Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
						</div>
					</div>
				</div>
				<div class="col-md-1"></div>
			</div>
		</div>
	</section>

	<?php include ('includes/footer.php'); ?>

</body>
</html>