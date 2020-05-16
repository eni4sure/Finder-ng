<?php session_start(); ?>
<!DOCTYPE HTML>
<html lang="en-NG">

<?php include ('php/check_login.php'); ?>

<?php $head_title = 'Posted Jobs | Employer | Finder'; ?>
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
							<h2>Posted Jobs</h2>
						</div>

						<?php

							require('../php/connect.php');

							$count_if_post_exist = "SELECT COUNT(*) FROM `tbl_jobs` WHERE job_company = '$sess_comp_member_no'";
							$count_if_post_exist_code = mysqli_query($connection, $count_if_post_exist);
							$count_if_post_exist_get = mysqli_fetch_array ($count_if_post_exist_code);
							$count_if_post_exist_res =array_shift($count_if_post_exist_get);

							if ($count_if_post_exist_res > 0) {

								echo '<div class="row">';

								$get_post_info = "SELECT * FROM `tbl_jobs` WHERE job_company = '$sess_comp_member_no'";
								$run_post_info = mysqli_query($connection, $get_post_info);

								while ($row_post_info = mysqli_fetch_array($run_post_info)){
									$job_application_deadline = $row_post_info['job_deadline_date'];
									$job_id =  $row_post_info['job_id'];

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

									$get_applicants = "SELECT COUNT(*) FROM `tbl_job_applications` WHERE job_id = '$job_id'";
									$get_applicants_code = mysqli_query($connection, $get_applicants);
									$get_applicants_get = mysqli_fetch_array ($get_applicants_code);
									$get_applicants_res =array_shift($get_applicants_get);

									?>
									<div class="col-md-4">
										<a href="#" style="color: initial;"><figure class="card card-product">
											<div class="img-wrap">
												<img src="<?php if( $sess_comp_image == '') { echo '../employer_img/default.png'; } else { echo '../employer_img/'.$sess_comp_image.'';} ?>">
											</div>
											<figcaption class="info-wrap">
												<span class="badge-new" style="text-transform: uppercase; background-color: <?php echo $backg; ?> ;"> <?php echo $row_post_info['job_type']; ?> </span>
												<h4 class="title"><?php echo $row_post_info['job_title']; ?></h4>
												<div class="rating-wrap">
													<div class="label-rating">City: <?php echo $row_post_info['job_city_town']; ?></div>
												</div>
												<div class="rating-wrap">
													<div class="label-rating">Deadline:  <?php echo "$post_month"; ?>  <?php echo "$post_date"; ?>, <?php echo "$post_year"; ?></div>
												</div>
												<div class="rating-wrap">
													<div class="label-rating"><?php echo $get_applicants_res; ?> Applicant(s)</div>
												</div>
											</figcaption>
											<div class="bottom-wrap">
												<a href="view-job-applicant?view=<?php echo $job_id; ?>" class="btn btn-sm btn-primary">View Applicants</a>
												<a href="edit-job?edit=<?php echo $job_id; ?>" class="btn btn-sm btn-primary">Edit</a>	
												<a onclick = "return confirm('Are you sure you want to delete this job ? YOU CANNOT UNDO THIS ACTION!!!')" href="php/delete-job?del=<?php echo $job_id; ?>" class="btn btn-sm btn-primary">Delete</a>	
											</div>
										</figure></a>
									</div>
									<?php
								}

								echo '</div>';

							} else { ?>
								<div class="admin-empty-dashboard">
									<div class="icon">
										<i class="fa fa-bookmark"></i>
									</div>
									<h4>You have not posted any job yet!</h4>
									<a href="post-job" class="btn btn-primary">Post a Job</a>
								</div>
							<?php }
						?>
					</div>
				</div>
			</div>
		</div>
	</div>

	<?php include ('includes/footer.php'); ?>

</body>
</html>