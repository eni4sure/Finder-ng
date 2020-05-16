<?php session_start(); ?>
<!DOCTYPE HTML>
<html lang="en-NG">

<?php include ('php/check_login.php'); ?>

<?php 
	if (isset($_GET['view'])) {

		require('php/connect.php');

		$job_id = $_GET['view'];

		$count_job = "SELECT COUNT(*) FROM tbl_jobs WHERE job_id = '$job_id'";
		$count_job_code = mysqli_query($connection, $count_job);
		$count_job_get = mysqli_fetch_array ($count_job_code);
		$count_job_res = array_shift($count_job_get);

		if ($count_job_res == "0") {

			header("location:./");
		} else {

			$get_job_details = "SELECT * FROM tbl_jobs WHERE job_id = '$job_id'";
			$run_job_details = mysqli_query($connection, $get_job_details);

			while ($row_job_details = mysqli_fetch_array($run_job_details)){

				$job_title				= $row_job_details['job_title'];
				$job_city_town			= $row_job_details['job_city_town'];
				$job_category			= $row_job_details['job_category'];
				$job_deadline_date		= $row_job_details['job_deadline_date'];
				$job_type				= $row_job_details['job_type'];
				$job_experience			= $row_job_details['job_experience'];
				$job_description		= $row_job_details['job_description'];
				$job_responsibilities	= $row_job_details['job_responsibilities'];
				$job_requirements		= $row_job_details['job_requirements'];
				$job_post_date			= $row_job_details['job_post_date'];
				$job_company 			= $row_job_details['job_company'];

				$get_job_company_info = "SELECT fname,image,about FROM `tbl_users` WHERE member_no = '$job_company'";
				$get_job_company_info_code = mysqli_query($connection, $get_job_company_info);
				$get_job_company_info_res = mysqli_fetch_array ($get_job_company_info_code);

				if ($job_type == "Freelance") {
					$backg = '#28a745';
				} elseif ($job_type == "Part-time") {
					$backg = '#ef5f5f';
				} elseif ($job_type == "Full-time") {
					$backg = '#ffc107';
				}

				$today_date = strtotime(date('Y/m/d'));
				$convert_date = date_format(date_create_from_format('d/m/Y', $job_deadline_date), 'Y/m/d');
				$converted_date = strtotime($convert_date);

				if ($today_date > $converted_date){
					$jobexpired = true;
				}else{
					$jobexpired = false;
				}
			}
		}
	} else {

		header("location:./");
	}
?>

<?php $head_title = ''.$job_title.' | Finder'; ?>
<?php include ('includes/head.php'); ?>

<body class="relative" data-spy="scroll" data-target=".navbar-landing">
	<div class="se-pre-con"></div>

	<?php $page_nav = 'job'; ?>
	<?php include ('includes/navbar.php'); ?>

	<!-- ========================= SECTION CONTENT ========================= -->
	<section class="section-content bg padding-y" style="padding-top: 7em !important;">
		<div class="container">
			<?php
				if (isset($_GET['r']) & isset($_GET['ty'])) {
					$report_msg = $_GET['r'];
					$report_type = $_GET['ty'];
					echo '<div class="text-center alert alert-'.$report_type.'">'.strtoupper($report_msg).'</div>';
				}
			?>
			<div class="row">
				<div class="col-md-1"></div>
				<div class="col-md-10">
					<div class="job-detail-wrapper">

						<div class="job-detail-header text-center">
							<h2 class="heading mb-15"><?php echo $job_title; ?></h2>
							<div class="meta-div clearfix mb-25">
								<span>at <a href="view-company?view=<?php echo $job_company; ?>"><?php echo $get_job_company_info_res['fname']; ?></a> as </span>
								<span class="badge-type" style="text-transform: uppercase; background-color: <?php echo $backg; ?> ;"> <?php echo $job_type; ?> job</span>
							</div>
							<ul class="meta-list clearfix">
								<li>
									<h4 class="heading">Location:</h4>
									<?php echo $job_city_town; ?>
								</li>
								<li>
									<h4 class="heading">Experience</h4>
									<?php echo $job_experience; ?>
								</li>
								<li>
									<h4 class="heading">Posted: </h4>
									<?php echo $job_post_date; ?>
								</li>
							</ul>
						</div>
			
						<div class="job-detail-company-overview clearfix">
						
							<h3>Company overview</h3>
							<div class="image">
								<img src="<?php if( $get_job_company_info_res['image'] == '') { echo 'employer_img/default.png'; } else { echo 'employer_img/'.$get_job_company_info_res['image'].'';} ?>" alt="image" style="width: 160px; height: 80px;">
							</div>
							
							<p><?php if( $get_job_company_info_res['about'] == '') { echo '<br><div class="admin-empty"> <h4 style="text-transform: uppercase;">No Info Available</h4> </div>'; } else { echo ''.substr($get_job_company_info_res['about'], 0, 175).' .... <a href="view-company?view='.$job_company.'"> read more about this company <i class="fa fa-long-arrow-right"></i></a>';} ?> </p>
							
						</div>
						
						<div class="job-detail-content mt-30 clearfix">	
							<h3>Job Description</h3>
							<p><?php echo $job_description; ?></p>
							<br>
							
							<h3>Job Responsibilies</h3>
							<p><?php echo $job_responsibilities; ?></p>
							<br>
							
							<h3>Requirements:</h3>
							<p><?php echo $job_requirements; ?></p>
							<br>
						</div>
						<?php
							if ($user_online == true) {
								if ($jobexpired == true) {
									echo '<button class="btn btn-primary disabled btn-lg" style="text-transform: uppercase;"><i class="fa fa-calendar"></i> This job has expired</button>';
								} else {
									if ($sess_role == "employee") {

										$count_if_application_exist = "SELECT COUNT(*) FROM `tbl_job_applications` WHERE member_no = '{$_SESSION['member_no']}' AND job_id = '$job_id'";
										$count_if_application_exist_code = mysqli_query($connection, $count_if_application_exist);
										$count_if_application_exist_get = mysqli_fetch_array ($count_if_application_exist_code);
										$count_if_application_exist_res =array_shift($count_if_application_exist_get);

										if ($count_if_application_exist_res > 0) {

											echo '<button class="btn btn-primary disabled btn-lg" style="text-transform: uppercase;"><i class="fa fa-lock"></i> You have already applied for this job</button>';
										} else {

											echo '<a href="php/apply?job='.$job_id.'&applicant='.$_SESSION['member_no'].'" '; ?> onclick = "return confirm('Are you sure you want to apply for this job ? YOU CAN NOT UNDO!!!')" <?php echo 'class="btn btn-primary btn-lg" type="submit" style="text-transform: uppercase;"><i class="fa fa-edit"></i> Apply for this job</a>';
										}
										
									} else {
										echo '<button class="btn btn-primary disabled btn-lg" style="text-transform: uppercase;"><i class="fa fa-lock"></i> Login as employee to apply</button>';
									}
								}
							} else {
								echo '<button class="btn btn-primary disabled btn-lg" style="text-transform: uppercase;"><i class="fa fa-lock"></i> Login to apply this job</button>';	
							}
						?>

						<section class="section-content bg padding-y">
							<div class="container">

								<header class="section-heading heading-line text-center">
									<h4 class="title-section bg text-uppercase pl-3">Similar Jobs</h4>
								</header>

								<div class="row">
									<main class="col-sm-12">
										<?php

											require('php/connect.php');

											$count_if_post_exist = "SELECT COUNT(*) FROM `tbl_jobs` WHERE job_deadline_date <= now() AND job_category = '$job_category' AND job_id != '$job_id'";
											$count_if_post_exist_code = mysqli_query($connection, $count_if_post_exist);
											$count_if_post_exist_get = mysqli_fetch_array ($count_if_post_exist_code);
											$count_if_post_exist_res =array_shift($count_if_post_exist_get);

											if ($count_if_post_exist_res > 0) {
												$get_post_info = "SELECT * FROM `tbl_jobs` WHERE job_deadline_date <= now() AND job_category = '$job_category' AND job_id != '$job_id' ORDER BY RAND() LIMIT 5";
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
													<h4 style="text-transform: uppercase;">Sorry No Job Similar to This</h4>
												</div>
											<?php }
										?>
									</main>
								</div>
							</div>
						</section>
					</div>
				</div>
				<div class="col-md-1"></div>
			</div>
		</div>
	</section>

	<?php include ('includes/footer.php'); ?>

</body>
</html>
