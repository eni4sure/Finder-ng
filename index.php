<?php session_start(); ?>
<!DOCTYPE HTML>
<html lang="en-NG">

<?php include ('php/check_login.php'); ?>

<?php $head_title = 'Finder | Job Portal'; ?>
<?php include ('includes/head.php'); ?>

<body class="relative" data-spy="scroll" data-target=".navbar-landing">
	<div class="se-pre-con"></div>

	<?php $page_nav = 'home'; ?>
	<?php include ('includes/navbar.php'); ?>

	<?php $search_nav = 'JB'; ?>
	<!-- ========================= SECTION INTRO ========================= -->
	<section id="intro" class="section-intro bg-secondary pt-5 text-white text-center" style="padding-top: 5em !important;">
		<div class="container d-flex flex-column" style="min-height:80vh;">

			<div class="row mt-auto">
				<div class="col-lg-8 col-sm-12 text-center mx-auto">
					<h1 class="display-4 mb-3">Finder</h1>
					<p class="lead mb-5">...THE NO.1 JOB PORTAL TO GET A JOB <b><i>FAST</i></b></p>
				</div>
			</div>
			<div class="row">
				<div class="col-lg-9 col-md-8 col-sm-12 mx-auto text-center">
					<form class="form-noborder" action="search" method="GET">
						<div class="form-row mb-5">
							<div class="col-lg-6 col-sm-12 form-group">
								<input class="form-control form-control-lg" name="key" placeholder="Search..." type="text" required>
							</div>
							<div class="col-lg-3 col-sm-12 form-group">
								<select class="custom-select form-control-lg" name="cat">
									<option <?php if( $search_nav == 'JB') { echo 'selected'; } else {} ?> value="JB"> Jobs </option>
									<option <?php if( $search_nav == 'CM') { echo 'selected'; } else {} ?> value="CM"> Employers </option>
									<option <?php if( $search_nav == 'EM') { echo 'selected'; } else {} ?> value="EM"> Employees </option>
								</select>
							</div>
							<div class="col-lg-3 col-sm-12 form-group">
								<button class="btn btn-warning btn-block btn-lg" type="submit">Search</button>
							</div>
						</div>
					</form>
					<p class="small">YOU COULD FOLLOW US ON OUR SOCIAL MEDIA PLATFORMS FOR NEW AND LASTEST JOB OFFERS</p>
					<ul class="list-inline my-5">

						<li class="list-inline-item">
							<label data-toggle="tooltip" title="Twitter">
								<a class="h4 text-light p-2" href="#">
									<i class="fab fa fa-twitter"></i>
								</a>
							</label>
						</li>
						<li class="list-inline-item">
							<label data-toggle="tooltip" title="Facebook">
								<a class="h4 text-light p-2" href="#">
									<i class="fab fa fa-facebook"></i>
								</a>
							</label>
						</li>
						<li class="list-inline-item">
							<label data-toggle="tooltip" title="Google Plus">
								<a class="h4 text-light p-2" href="#">
									<i class="fab fa fa-google-plus"></i>
								</a>
							</label>
						</li>
						<li class="list-inline-item">
							<label data-toggle="tooltip" title="Instagram">
								<a class="h4 text-light p-2" href="#">
									<i class="fab fa fa-instagram"></i>
								</a>
							</label>
						</li>
					</ul>
				</div>
			</div>
		</div>
	</section>
	<!-- ========================= SECTION INTRO END// ========================= -->

	<!-- ========================= SECTION FEATURES ========================= -->
	<section id="features" class="section-features bg2 padding-y-lg">
		<div class="container">

			<header class="section-heading text-center">
				<h2 class="title-section">How it works </h2>
				<p class="lead"> Start Now with Just Three Steps </p>
			</header>

			<div class="row">
				<aside class="col-sm-4">
					<figure class="itembox text-center">
						<span class="icon-wrap icon-lg bg-secondary white"><i class="fa fa-search"></i></span>
						<figcaption class="text-wrap">
							<h4 class="title">Search for a Job</h4>	
						</figcaption>
					</figure>
				</aside>
				<aside class="col-sm-4">
					<figure class="itembox text-center">
						<span class="icon-wrap icon-lg bg-secondary white"><i class="fa fa-envelope"></i></span>
						<figcaption class="text-wrap">
						<h4 class="title">Apply for Job</h4>
						</figcaption>
					</figure>
				</aside>
				<aside class="col-sm-4">
					<figure class="itembox text-center">
						<span class="icon-wrap icon-lg bg-secondary white"><i class="fa fa-users"></i>	</span>
						<figcaption class="text-wrap">
						<h4 class="title">Start Working</h4>
						</figcaption>
					</figure>
				</aside>
			</div>

			<p class="text-center">
				<br>
				<a href="sign-up" class="btn btn-warning">Register</a>
			</p>
		</div>
	</section>
	<!-- ========================= SECTION FEATURES END// ========================= -->

	<!-- ========================= SECTION CONTENT ========================= -->
	<section class="section-content padding-y-sm bg">
		<div class="container">

			<header class="section-heading heading-line text-center">
				<h4 class="title-section bg pl-3">Random Jobs</h4>
			</header>

			<div class="row">
				<main class="col-sm-12">
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

	<!-- ========================= SECTION CONTENT ========================= -->
	<section class="section-content padding-y-sm bg">
		<div class="container">

			<header class="section-heading heading-line text-center">
				<h4 class="title-section bg pl-3">Random Employers</h4>
			</header>

			<div class="row">
				<?php

					require('php/connect.php');

					$count_if_employer_exist = "SELECT COUNT(*) FROM `tbl_users` WHERE role = 'employer'";
					$count_if_employer_exist_code = mysqli_query($connection, $count_if_employer_exist);
					$count_if_employer_exist_get = mysqli_fetch_array ($count_if_employer_exist_code);
					$count_if_employer_exist_res =array_shift($count_if_employer_exist_get);

					if ($count_if_employer_exist_res > 0) {
						$get_employer_info = "SELECT * FROM `tbl_users` WHERE role = 'employer' ORDER BY RAND() LIMIT 8";
						$run_employer_info = mysqli_query($connection, $get_employer_info);

						while ($row_employer_info = mysqli_fetch_array($run_employer_info)){
							if ($row_employer_info['comp_type'] == "") {
								$company_type = 'Unknown';
							} else {
								$company_type = $row_employer_info['comp_type'];
							}

							$count_active_post = "SELECT COUNT(*) FROM tbl_jobs WHERE job_company = '{$row_employer_info['member_no']}' AND now() > job_deadline_date";
							$count_active_post_code = mysqli_query($connection, $count_active_post);
							$count_active_post_get = mysqli_fetch_array ($count_active_post_code);
							$count_active_post_res =array_shift($count_active_post_get);
							?>
							<div class="col-md-3">
								<figure class="card card-product">
									<div class="img-wrap"> 
										<img src="<?php if( $row_employer_info['image'] == '') { echo 'employer_img/default.png'; } else { echo 'employer_img/'.$row_employer_info['image'].'';} ?>" alt="image" style="padding: 50px 20px;">
										<a class="btn-overlay" href="view-company?view=<?php echo $row_employer_info['member_no']; ?>"><i class="fa fa-search-plus"></i> View</a>
									</div>
									<figcaption class="info-wrap">
										<a href="view-company?view=<?php echo $row_employer_info['member_no']; ?>" class="title"><?php echo $row_employer_info['fname']; ?></a>
										<div class="action-wrap">
											<a href="view-company?view=<?php echo $row_employer_info['member_no']; ?>" class="btn btn-primary btn-sm float-right"> View </a>
											<div class="price-wrap h6">
												<span class="price-new"><?php echo $count_active_post_res; ?> Job Post(s)</span>
											</div>
											<div class="sub-category"><a><?php echo $company_type; ?></a></div>
										</div>
									</figcaption>
								</figure>
							</div>
							<?php
						}
					} else { ?>
						<div class="col-md-12">
							<div class="admin-empty-dashboard" style="margin: 0px 0 0px;">
								<div class="icon">
									<i class="fa fa-frown-o"></i>
								</div>
								<h4 style="text-transform: uppercase;">Sorry No Employer For Now</h4>
							</div>
						</div>
					<?php }
				?>
			</div>
		</div>
	</section>
	<!-- ========================= SECTION CONTENT END// ========================= -->

	<!-- ========================= SECTION ITEMS ========================= -->
	<section class="section-request bg padding-y-sm">
		<div class="container">
			<header class="section-heading heading-line text-center">
				<h4 class="title-section bg text-uppercase pl-3">Random Employees</h4>
			</header>

			<div class="row">
				<?php

					require('php/connect.php');

					$count_if_employee_exist = "SELECT COUNT(*) FROM `tbl_users` WHERE role = 'employee'";
					$count_if_employee_exist_code = mysqli_query($connection, $count_if_employee_exist);
					$count_if_employee_exist_get = mysqli_fetch_array ($count_if_employee_exist_code);
					$count_if_employee_exist_res =array_shift($count_if_employee_exist_get);

					if ($count_if_employee_exist_res > 0) {
						$get_employee_info = "SELECT * FROM `tbl_users` WHERE role = 'employee' ORDER BY RAND() LIMIT 8";
						$run_employee_info = mysqli_query($connection, $get_employee_info);

						while ($row_employee_info = mysqli_fetch_array($run_employee_info)){
							?>
							<div class="col-md-3">
								<figure class="card card-product">
									<div class="img-wrap">
										<img class="img-circle" style="height: 220px; width: 220px; object-fit: cover;" src="<?php if( $row_employee_info['image'] == '') { echo 'employee_img/default.png'; } else { echo 'employee_img/'.$row_employee_info['image'].'';} ?>">
										<a class="btn-overlay" href="view-employee?view=<?php echo $row_employee_info['member_no']; ?>"><i class="fa fa-search-plus"></i> View</a>
									</div>
									<figcaption class="info-wrap">
										<a href="view-employee?view=<?php echo $row_employee_info['member_no']; ?>" class="title"><?php echo $row_employee_info['fname']; ?> <?php echo $row_employee_info['lname']; ?></a>
										<div class="action-wrap">
											<a href="view-employee?view=<?php echo $row_employee_info['member_no']; ?>" class="btn btn-primary btn-sm float-right"> View </a>
											<div class="price-wrap h6">
												<span class="price-new"><i class="fa fa-map-marker"></i> <?php echo $row_employee_info['city_town']; ?></span>
											</div>
										</div>
									</figcaption>
								</figure>
							</div>
							<?php
						}
					} else { ?>
						<div class="col-md-12">
							<div class="admin-empty-dashboard" style="margin: 0px 0 0px;">
								<div class="icon">
									<i class="fa fa-frown-o"></i>
								</div>
								<h4 style="text-transform: uppercase;">Sorry No Employee For Now</h4>
							</div>
						</div>
					<?php }
				?>
			</div>
		</div>
	</section>
	<!-- ========================= SECTION ITEMS .END// ========================= -->

	<?php include ('includes/footer.php'); ?>

</body>
</html>