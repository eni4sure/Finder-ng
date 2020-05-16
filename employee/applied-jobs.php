<?php session_start(); ?>
<!DOCTYPE HTML>
<html lang="en-NG">

<?php include ('php/check_login.php'); ?>

<?php $head_title = 'Applied Jobs | Employee | Finder'; ?>
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
			<div class="row">

				<?php $user_panel_nav = 'applied-jobs'; ?>
				<?php include ('includes/user_panel.php'); ?>

				<div class="col-md-9 col-sm-8 col-xs-12">
					<div class="admin-content-wrapper">

						<div class="admin-section-title">
							<h2>Applied Jobs</h2>
						</div>

						<main class="col-sm-12">
							<?php

								require('../php/connect.php');

								$count_applications = "SELECT COUNT(*) FROM `tbl_job_applications` WHERE member_no = '$sess_member_no'";
								$count_applications_code = mysqli_query($connection, $count_applications);
								$count_applications_get = mysqli_fetch_array ($count_applications_code);
								$count_applications_res =array_shift($count_applications_get);

								if ($count_applications_res > 0) {
									$get_application_info = "SELECT * FROM `tbl_job_applications` WHERE member_no = '$sess_member_no' ORDER BY `tbl_job_applications`.`application_date` DESC";
									$run_application_info = mysqli_query($connection, $get_application_info);

									while ($row_application_info = mysqli_fetch_array($run_application_info)){

										$applied_job_id = $row_application_info['job_id'];
										$application_date = $row_application_info['application_date'];

										$count_if_job_exist = "SELECT COUNT(*) FROM `tbl_jobs` WHERE job_id ='$applied_job_id'";
										$count_if_job_exist_code = mysqli_query($connection, $count_if_job_exist);
										$count_if_job_exist_get = mysqli_fetch_array ($count_if_job_exist_code);
										$count_if_job_exist_res =array_shift($count_if_job_exist_get);

										if ($count_if_job_exist_res > 0) {
											$get_job_info = "SELECT * FROM `tbl_jobs` WHERE job_id ='$applied_job_id'";
											$run_job_info = mysqli_query($connection, $get_job_info);

											while ($row_job_info = mysqli_fetch_array($run_job_info)){
												$job_application_deadline = $row_job_info['job_deadline_date'];

												$post_date = date_format(date_create_from_format('d/m/Y', $job_application_deadline), 'd');
												$post_month = date_format(date_create_from_format('d/m/Y', $job_application_deadline), 'F');
												$post_year = date_format(date_create_from_format('d/m/Y', $job_application_deadline), 'Y');

												if ($row_job_info['job_type'] == "Freelance") {
													$backg = '#28a745';
												} elseif ($row_job_info['job_type'] == "Part-time") {
													$backg = '#ef5f5f';
												} elseif ($row_job_info['job_type'] == "Full-time") {
													$backg = '#ffc107';
												}

												$get_job_company_info = "SELECT fname,image FROM `tbl_users` WHERE member_no = '{$row_job_info['job_company']}'";
												$get_job_company_info_code = mysqli_query($connection, $get_job_company_info);
												$get_job_company_info_res = mysqli_fetch_array ($get_job_company_info_code);
												?>
												<article class="card card-product">
													<div class="card-body">
														<div class="row">
															<aside class="col-sm-3">
																<div class="img-wrap"><a href="#"><img src="<?php if( $get_job_company_info_res['image'] == '') { echo '../employer_img/default.png'; } else { echo '../employer_img/'.$get_job_company_info_res['image'].'';} ?>"></a></div>
															</aside>
															<article class="col-sm-6">
																<h4 class="title"> <?php echo $row_job_info['job_title']; ?> </h4>
																<p> by <a href="view-company?view=<?php echo $row_job_info['job_company']; ?>"><?php echo $get_job_company_info_res['fname']; ?></a></p>
																<dl class="dlist-align">
																	<dt>City</dt>
																	<dd><?php echo $row_job_info['job_city_town']; ?></dd>
																</dl>
																<dl class="dlist-align">
																	<dt>Experience</dt>
																	<dd><?php echo $row_job_info['job_experience']; ?></dd>
																</dl>
																<dl class="dlist-align">
																	<dt>Deadline</dt>
																	<dd><?php echo "$post_month"; ?>  <?php echo "$post_date"; ?>, <?php echo "$post_year"; ?></dd>
																</dl>
																<br>
																<div class="sub-category"><a><?php echo $row_job_info['job_category']; ?></a></div>
																<br>
																<ul class="list-icon row text-center">
																	<li class="col-md-12"><a><i class="icon fa fa-calendar"></i>Applicatopn Date: <span> <b><i><?php echo $application_date; ?></i></b></span></a></li>
																</ul>
															</article>
															<aside class="col-sm-3 border-left">
																<div class="action-wrap">
																	<p class="alert alert-primary" style="text-transform: uppercase; color: black; background-color: <?php echo $backg; ?> ;"> <?php echo $row_job_info['job_type']; echo " job"; ?> </p>
																	<br>
																	<p><a href="../view-job?view=<?php echo $row_job_info['job_id']; ?>" class="btn btn-primary"> VIEW THIS JOB </a></p>
																	<p><a href="../view-company?view=<?php echo $row_job_info['job_company']; ?>" class="btn btn-secondary"> VIEW COMPANY </a></p>
																</div>
															</aside>
														</div>
													</div>
												</article>
												<?php
											}
										} else { ?>
											<div class="admin-empty">
												<div class="icon">
													<i class="fa fa-globe"></i>
												</div>
												<h4 style="text-transform: uppercase;">Sorry!! This job has been deleted by its company</h4>
											</div>
										<?php }

									}
								} else { ?>
									<div class="admin-empty-dashboard">
										<div class="icon">
											<i class="fa fa-bookmark"></i>
										</div>
										<h4>You have not applied for any job!</h4>
										<a href="../job_list" class="btn btn-primary">Browse Jobs</a>
									</div>
								<?php }
							?>
						</main>
					</div>
				</div>
			</div>
		</div>
	</div>

	<?php include ('includes/footer.php'); ?>

</body>
</html>