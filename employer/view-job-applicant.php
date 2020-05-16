<?php session_start(); ?>
<!DOCTYPE HTML>
<html lang="en-NG">

<?php include ('php/check_login.php'); ?>

<?php $head_title = 'Job Applicants | Finder'; ?>
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
			<div class="row">

				<?php $user_panel_nav = 'posted-jobs'; ?>
				<?php include ('includes/user_panel.php'); ?>

				<div class="col-md-9 col-sm-8 col-xs-12">
					<div class="admin-content-wrapper">

						<div class="admin-section-title">
							<h2>Job Applicants</h2>
						</div>

						<?php 
							if (isset($_GET['view'])) {

								require('../php/connect.php');

								$job_id = $_GET['view'];

								$count_job = "SELECT COUNT(*) FROM tbl_jobs WHERE job_id = '$job_id' AND job_company = '$sess_comp_member_no'";
								$count_job_code = mysqli_query($connection, $count_job);
								$count_job_get = mysqli_fetch_array ($count_job_code);
								$count_job_res = array_shift($count_job_get);

								if ($count_job_res == "0") {

									header("location:posted-jobs");
								} else {

									$count_application = "SELECT COUNT(*) FROM tbl_job_applications WHERE job_id = '$job_id'";
									$count_application_code = mysqli_query($connection, $count_application);
									$count_application_get = mysqli_fetch_array ($count_application_code);
									$count_application_res = array_shift($count_application_get);

									if ($count_application_res == "0") {

										header("location:posted-jobs?r=No applicant for this job yet&ty=danger");
									} else {

										$get_application_details = "SELECT * FROM tbl_job_applications WHERE job_id = '$job_id'";
										$run_application_details = mysqli_query($connection, $get_application_details);

										while ($row_application_details = mysqli_fetch_array($run_application_details)){

											$applicant_member_no 	= $row_application_details['member_no'];
											$application_date 		= $row_application_details['application_date'];

											$get_applicant_details = "SELECT * FROM `tbl_users` WHERE member_no = '$applicant_member_no'";
											$get_applicant_details_code = mysqli_query($connection, $get_applicant_details);
											$get_applicant_details_res = mysqli_fetch_array ($get_applicant_details_code);

											$get_application_job_details = "SELECT * FROM `tbl_jobs` WHERE job_id = '$job_id'";
											$get_application_job_details_code = mysqli_query($connection, $get_application_job_details);
											$get_application_job_details_res = mysqli_fetch_array ($get_application_job_details_code);

											$count_if_cv_exist = "SELECT COUNT(*) FROM tbl_cv WHERE member_no = '$applicant_member_no'";
											$count_if_cv_exist_code = mysqli_query($connection, $count_if_cv_exist);
											$count_if_cv_exist_get = mysqli_fetch_array ($count_if_cv_exist_code);
											$count_if_cv_exist_res = array_shift($count_if_cv_exist_get);

											$get_cv_info = "SELECT * FROM tbl_cv WHERE member_no = '$applicant_member_no'";
											$get_cv_info_code = mysqli_query($connection, $get_cv_info);
											$get_cv_info_res = mysqli_fetch_array ($get_cv_info_code);

											$cv = $get_cv_info_res['cv_attachment'];

											$user_img = $get_applicant_details_res['image'];

											?>
											<div class="resume-list-wrapper">
												<div class="resume-list-item">
													<div class="row">
														<div class="col-sm-12 col-md-10">
															<div class="content">
																<a href="../view-employee?view=<?php echo $applicant_member_no; ?>">
																	<div class="image">
																		<img src="<?php if( $user_img == '') { echo '../employee_img/default.png'; } else { echo '../employee_img/'.$user_img.'';} ?>" alt="image" class="img-circle" style="width: 54px; height: 54px;">
																	</div>
																	<h4><?php echo $get_applicant_details_res['fname']; ?> <?php echo $get_applicant_details_res['lname']; ?></h4>
																	<div class="row">
																		<div class="col-sm-12 col-md-7">
																			<strong class="mr-5">Phone : <?php echo $get_applicant_details_res['phone_no']; ?></strong> <i class="fa fa-map-marker text-primary"></i> <?php echo $get_applicant_details_res['city_town']; ?>
																		</div>
																		<div class="col-sm-12 col-md-5 mt-10-sm">
																			<i class="fa fa-calendar text-primary"></i> <?php echo $application_date; ?>
																		</div>
																	</div>
																</a>
															</div>
														</div>
														
														<div class="col-sm-12 col-md-2" style="margin-top: 1em;">
															<div class="resume-list-btn">
																<a href="../view-employee?view=<?php echo $applicant_member_no; ?>" class="btn btn-primary btn-sm">View Profile</a>
																<br><br>
																<?php if ($count_if_cv_exist_res == "0") {
																	?>
																		<a class="btn btn-primary btn-sm disabled text-white">No CV Uploaded</a>
																	<?php } else { ?>
																		<p><a href="../cv/<?php echo $cv; ?>" class="btn btn-primary">Download CV</a></p>
																	<?php }
																?>
															</div>
														</div>
													</div>
												</div>
												
											</div>
											<?php

										}
									}
								}
							} else {

								header("location:./");
							}
						?>
					</div>
				</div>
			</div>
		</div>
	</div>

	<?php include ('includes/footer.php'); ?>

</body>
</html>