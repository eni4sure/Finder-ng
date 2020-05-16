<?php session_start(); ?>
<!DOCTYPE HTML>
<html lang="en-NG">

<?php include ('php/check_login.php'); ?>

<?php $head_title = 'Job List | Finder'; ?>
<?php include ('includes/head.php'); ?>

<body class="relative" data-spy="scroll" data-target=".navbar-landing">
	<div class="se-pre-con"></div>

	<?php $page_nav = 'job'; ?>
	<?php include ('includes/navbar.php'); ?>

	<?php $search_nav = 'JB'; ?>
	<?php include ('includes/search.php'); ?>

	<!-- ========================= SECTION CONTENT ========================= -->
	<section class="section-content bg padding-y">
		<div class="container">
			<div class="row">
				<main class="col-md-12">
					<?php

						require('php/connect.php');

						$count_if_post_exist = "SELECT COUNT(*) FROM `tbl_jobs`";
						$count_if_post_exist_code = mysqli_query($connection, $count_if_post_exist);
						$count_if_post_exist_get = mysqli_fetch_array ($count_if_post_exist_code);
						$count_if_post_exist_res =array_shift($count_if_post_exist_get);

						if ($count_if_post_exist_res > 0) {
							$get_post_info = "SELECT * FROM `tbl_jobs` WHERE job_deadline_date <= now() ORDER BY `tbl_jobs`.`id` DESC";
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
												<div class="img-wrap"><a href="view-company?view=<?php echo $row_post_info['job_company']; ?>"><img src="<?php if( $get_job_company_info_res['image'] == '') { echo 'employer_img/default.png'; } else { echo 'employer_img/'.$get_job_company_info_res['image'].'';} ?>" alt="image" style="padding: 50px 20px;"></a></div>
											</aside>
											<article class="col-sm-6">
												<h4 class="title"> <?php echo $row_post_info['job_title']; ?> </h4>
												<p> by <a href="view-company?view=<?php echo $row_post_info['job_company']; ?>"><?php echo $get_job_company_info_res['fname']; ?></a></p>
												<p> <?php echo substr($row_post_info['job_description'], 0, 175); ?> .... </p>
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
													<p><a href="view-company?view=<?php echo $row_post_info['job_company']; ?>" class="btn btn-secondary"> VIEW COMPANY </a></p>
												</div>
											</aside>
										</div>
									</div>
								</article>
								<?php
							}
						} else { ?>
							<div class="admin-empty-dashboard" style="margin: 0px 0 0px;">
								<div class="icon">
									<i class="fa fa-frown-o"></i>
								</div>
								<h4 style="text-transform: uppercase;">Sorry No Jobs Available For Now</h4>
							</div>
						<?php }
					?>
				</main>
			</div>
		</div>
	</section>
	<!-- ========================= SECTION CONTENT END// ========================= -->

	<?php include ('includes/footer.php'); ?>

</body>
</html>