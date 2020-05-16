<?php session_start(); ?>
<!DOCTYPE HTML>
<html lang="en-NG">

<?php include ('php/check_login.php'); ?>

<?php 
	if (isset($_GET['view'])) {

		require('php/connect.php');

		$company_member_no = $_GET['view'];

		$count_companies = "SELECT COUNT(*) FROM tbl_users WHERE member_no = '$company_member_no' AND role = 'employer'";
		$count_companies_code = mysqli_query($connection, $count_companies);
		$count_companies_get = mysqli_fetch_array ($count_companies_code);
		$count_companies_res = array_shift($count_companies_get);

		if ($count_companies_res == "0") {

			header("location:./");
		} else {

			$get_company_details = "SELECT * FROM tbl_users WHERE member_no = '$company_member_no' AND role = 'employer'";
			$run_company_details = mysqli_query($connection, $get_company_details);

			while ($row_company_details = mysqli_fetch_array($run_company_details)){

				$company_name 		= $row_company_details['fname'];
				$company_email 		= $row_company_details['email'];
				$company_phone_no 	= $row_company_details['phone_no'];
				$company_city_town	= $row_company_details['city_town'];
				$company_about 		= $row_company_details['about'];
				$company_year 		= $row_company_details['comp_year'];
				$company_type 		= $row_company_details['comp_type'];
				$company_people		= $row_company_details['comp_people'];
				$company_website	= $row_company_details['comp_website'];
				$company_address	= $row_company_details['comp_address'];
				$company_services 	= $row_company_details['comp_services'];
				$company_expertise 	= $row_company_details['comp_expertise'];
				$company_image 		= $row_company_details['image'];
			}
		}
	} else {

		header("location:./");
	}
?>

<?php $head_title = ''.$company_name.' | Finder'; ?>
<?php include ('includes/head.php'); ?>

<body class="relative" data-spy="scroll" data-target=".navbar-landing">
	<div class="se-pre-con"></div>

	<?php $page_nav = 'employers'; ?>
	<?php include ('includes/navbar.php'); ?>

	<!-- ========================= SECTION CONTENT ========================= -->
	<section class="section-content bg padding-y" style="padding-top: 7em !important;">
		<div class="container">
			<div class="row">
				<div class="col-md-1"></div>
				<div class="col-md-10">
					<div class="company-detail-wrapper">
						<div class="company-detail-header text-center">
							
							<div class="image">
								<img src="<?php if( $company_image == '') { echo 'employer_img/default.png'; } else { echo 'employer_img/'.$company_image.'';} ?>" alt="image" style="width: 160px; height: 80px;">
							</div>
							
							<h2 class="heading mb-15"><?php echo $company_name; ?></h2>
						
							<p class="location"><i class="fa fa-map-marker"></i> <?php if( $company_address == '') { echo '--Unavailable--'; } else { echo ''.$company_address.'';} ?> <span class="mh-5">|</span> <i class="fa fa-phone"></i> <?php if( $company_phone_no == '') { echo '--Unavailable--'; } else { echo ''.$company_phone_no.'';} ?></p>
							
							<ul class="meta-list clearfix">
								<li>
									<h4 class="heading">Established In:</h4>
									<?php if( $company_year == '0000') { echo '--Unavailable--'; } else { echo ''.$company_year.'';} ?>
								</li>
								<li>
									<h4 class="heading">Type:</h4>
									<?php echo $company_type; ?>
								</li>
								<li>
									<h4 class="heading">People:</h4>
									<?php if( $company_people == '') { echo '--Unavailable--'; } else { echo ''.$company_people.'';} ?>
								</li>
								<li>
									<h4 class="heading">Website: </h4>
									<?php if( $company_website == '') { echo '--Unavailable--'; } else { echo '<a href="'.$company_website.'" target="_blank">'.$company_website.'</a>';} ?>
								</li>
							</ul>
							
						</div>
						<div class="company-detail-company-overview clearfix">
							<h3>Company background</h3>
							
							<p><?php if( $company_about == '') { echo '<div class="admin-empty"> <h4 style="text-transform: uppercase;">No Info Available</h4> </div>'; } else { echo ''.$company_about.'';} ?></p>

							<h3>Services</h3>

							<p><?php if( $company_services == '') { echo '<div class="admin-empty"> <h4 style="text-transform: uppercase;">No Info Available</h4> </div>'; } else { echo ''.$company_services.'';} ?></p>

							<h3>Expertise</h3>

							<p><?php if( $company_expertise == '') { echo '<div class="admin-empty"> <h4 style="text-transform: uppercase;">No Info Available</h4> </div>'; } else { echo ''.$company_expertise.'';} ?></p>
						</div>

						<br>

						<header class="section-heading heading-line text-center">
							<h4 class="title-section bg text-uppercase pl-3">Jobs Offered At <?php echo $company_name; ?></h4>
						</header>

						<?php

							require('php/connect.php');

							$count_if_post_exist = "SELECT COUNT(*) FROM `tbl_jobs` WHERE job_deadline_date <= now() AND job_company = '$company_member_no'";
							$count_if_post_exist_code = mysqli_query($connection, $count_if_post_exist);
							$count_if_post_exist_get = mysqli_fetch_array ($count_if_post_exist_code);
							$count_if_post_exist_res =array_shift($count_if_post_exist_get);

							if ($count_if_post_exist_res > 0) {
								$get_post_info = "SELECT * FROM `tbl_jobs` WHERE job_deadline_date <= now() AND job_company = '$company_member_no' ORDER BY `tbl_jobs`.`id` DESC LIMIT 5";
								$run_post_info = mysqli_query($connection, $get_post_info);

								while ($row_post_info = mysqli_fetch_array($run_post_info)){
									$job_application_deadline = $row_post_info['job_deadline_date'];

									$post_date = date_format(date_create_from_format('d/m/Y', $job_application_deadline), 'd');
									$post_month = date_format(date_create_from_format('d/m/Y', $job_application_deadline), 'F');
									$post_year = date_format(date_create_from_format('d/m/Y', $job_application_deadline), 'Y');

									if ($row_post_info['job_type'] == "Freelance") {
										$backg = '#28a745';
									} elseif ($row_post_info['job_type'] == "Part-time") {
										$backg = '#ef5f5f';
									} elseif ($row_post_info['job_type'] == "Full-time") {
										$backg = '#ffc107';
									}

									$get_job_company_info = "SELECT fname,image FROM `tbl_users` WHERE member_no = '{$row_post_info['job_company']}'";
									$get_job_company_info_code = mysqli_query($connection, $get_job_company_info);
									$get_job_company_info_res = mysqli_fetch_array ($get_job_company_info_code);
									?>
									<article class="card card-product">
										<div class="card-body">
											<div class="row">
												<aside class="col-sm-3">
													<div class="img-wrap"><a href="#"><img src="<?php if( $get_job_company_info_res['image'] == '') { echo 'employer_img/default.png'; } else { echo 'employer_img/'.$get_job_company_info_res['image'].'';} ?>"></a></div>
												</aside>
												<article class="col-sm-6">
													<h4 class="title"> <?php echo $row_post_info['job_title']; ?> </h4>
													<p> by <a href="view-company?view=<?php echo $row_post_info['job_company']; ?>"><?php echo $get_job_company_info_res['fname']; ?></a></p>
													<p> <?php echo substr($row_post_info['job_description'], 0, 75); ?> .... </p>
													<dl class="dlist-align">
														<dt>City</dt>
														<dd><?php echo $row_post_info['job_city_town']; ?></dd>
													</dl>
													<dl class="dlist-align">
														<dt>Experience</dt>
														<dd><?php echo $row_post_info['job_experience']; ?></dd>
													</dl>
													<dl class="dlist-align">
														<dt>Deadline</dt>
														<dd><?php echo "$post_month"; ?>  <?php echo "$post_date"; ?>, <?php echo "$post_year"; ?></dd>
													</dl>
													<br>
													<div class="sub-category"><a><?php echo $row_post_info['job_category']; ?></a></div>
												</article>
												<aside class="col-sm-3 border-left">
													<div class="action-wrap">
														<p class="alert alert-primary" style="text-transform: uppercase; color: black; background-color: <?php echo $backg; ?> ;"> <?php echo $row_post_info['job_type']; echo " job"; ?> </p>
														<br>
														<p><a href="view-job?view=<?php echo $row_post_info['job_id']; ?>" class="btn btn-primary"> VIEW THIS JOB </a></p>
													</div>
												</aside>
											</div>
										</div>
									</article>
									<hr>
									<?php
								}
							} else { ?>
								<div class="admin-empty">
									<div class="icon">
										<i class="fa fa-globe"></i>
									</div>
									<h4 style="text-transform: uppercase;">No Jobs Have been Posted!!</h4>
								</div>
							<?php }
						?>
					</div>
				</div>
				<div class="col-md-1"></div>
			</div>
		</div>
	</section>

	<?php include ('includes/footer.php'); ?>

</body>
</html>