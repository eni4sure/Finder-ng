<?php session_start(); ?>
<!DOCTYPE HTML>
<html lang="en-NG">

<?php include ('php/check_login.php'); ?>

<?php $head_title = 'Search | Finder'; ?>
<?php include ('includes/head.php'); ?>

<body class="relative" data-spy="scroll" data-target=".navbar-landing">
	<div class="se-pre-con"></div>

	<?php $page_nav = ''; ?>
	<?php include ('includes/navbar.php'); ?>

	<?php
		require('php/connect.php');

		if (isset($_GET['key']) && isset($_GET['cat'])) {

			$s_key = $_GET['key'];
			$s_cat = strtoupper($_GET['cat']);
		} else {

			header("location:./");
		}
	?>

	<?php $search_nav = $s_cat; ?>
	<!-- ========================= SECTION SEARCH ========================= -->
	<section class="header-main shadow" style="padding-top: 5em !important;">
		<div class="container">
			<div class="row align-items-center">
				<div class="col-lg-3 col-sm-2"></div>
				<div class="col-lg-6 col-sm-8">
					<form action="search" class="search-wrap" method="GET">
						<div class="input-group w-100">
							<input type="text" name="key" class="form-control" style="width:55%;" value="<?php echo $s_key; ?>" placeholder="Search..." required>
							<select class="custom-select" name="cat">
								<option <?php if( $search_nav == 'JB') { echo 'selected'; } else {} ?> value="JB"> Jobs </option>
								<option <?php if( $search_nav == 'CM') { echo 'selected'; } else {} ?> value="CM"> Employers </option>
								<option <?php if( $search_nav == 'EM') { echo 'selected'; } else {} ?> value="EM"> Employees </option>
							</select>
							<div class="input-group-append">
								<button class="btn btn-primary" type="submit">
									<i class="fa fa-search"></i>
								</button>
							</div>
						</div>
					</form>
				</div>
				<div class="col-lg-3 col-sm-2"></div>
			</div>
		</div>
	</section>
	<!-- ========================= SECTION SEARCH END// ========================= -->

	<!-- ========================= SECTION CONTENT ========================= -->
	<section class="section-content bg padding-y">
		<div class="container">
			<div class="row">
				<?php
					require('php/connect.php');

					if ($s_cat == "JB") {

						$count_if_query_exist = "SELECT COUNT(*) FROM `tbl_jobs` WHERE `job_title` LIKE '%$s_key%' OR `job_city_town` LIKE '%$s_key%' OR `job_category` LIKE '%$s_key%' OR `job_deadline_date` LIKE '%$s_key%' OR `job_type` LIKE '%$s_key%' OR `job_experience` LIKE '%$s_key%' OR `job_description` LIKE '%$s_key%' OR `job_responsibilities` LIKE '%$s_key%' OR `job_requirements` LIKE '%$s_key%' OR `job_post_date` LIKE '%$s_key%'";
						$count_if_query_exist_code = mysqli_query($connection, $count_if_query_exist);
						$count_if_query_exist_get = mysqli_fetch_array ($count_if_query_exist_code);
						$count_if_query_exist_res =array_shift($count_if_query_exist_get);

						if ($count_if_query_exist_res > 0) {

							$search = "SELECT * FROM `tbl_jobs` WHERE `job_title` LIKE '%$s_key%' OR `job_city_town` LIKE '%$s_key%' OR `job_category` LIKE '%$s_key%' OR `job_deadline_date` LIKE '%$s_key%' OR `job_type` LIKE '%$s_key%' OR `job_experience` LIKE '%$s_key%' OR `job_description` LIKE '%$s_key%' OR `job_responsibilities` LIKE '%$s_key%' OR `job_requirements` LIKE '%$s_key%' OR `job_post_date` LIKE '%$s_key%'";
							$search_code = mysqli_query($connection, $search);

							while ($row_search_code = mysqli_fetch_array($search_code)){

								$job_application_deadline = $row_search_code['job_deadline_date'];

								$post_date = date_format(date_create_from_format('d/m/Y', $job_application_deadline), 'd');
								$post_month = date_format(date_create_from_format('d/m/Y', $job_application_deadline), 'F');
								$post_year = date_format(date_create_from_format('d/m/Y', $job_application_deadline), 'Y');

								if ($row_search_code['job_type'] == "Freelance") {
									$backg = '#28a745';
								} elseif ($row_search_code['job_type'] == "Part-time") {
									$backg = '#ef5f5f';
								} elseif ($row_search_code['job_type'] == "Full-time") {
									$backg = '#ffc107';
								}

								$get_job_company_info = "SELECT fname,image FROM `tbl_users` WHERE member_no = '{$row_search_code['job_company']}'";
								$get_job_company_info_code = mysqli_query($connection, $get_job_company_info);
								$get_job_company_info_res = mysqli_fetch_array ($get_job_company_info_code);
								?>
								<article class="card card-product">
									<div class="card-body">
										<div class="row">
											<aside class="col-sm-3">
												<div class="img-wrap"><a href="view-company?view=<?php echo $row_search_code['job_company']; ?>"><img src="<?php if( $get_job_company_info_res['image'] == '') { echo 'employer_img/default.png'; } else { echo 'employer_img/'.$get_job_company_info_res['image'].'';} ?>" alt="image" style="padding: 50px 20px;"></a></div>
											</aside>
											<article class="col-sm-6">
												<h4 class="title"> <?php echo $row_search_code['job_title']; ?> </h4>
												<p> by <a href="view-company?view=<?php echo $row_search_code['job_company']; ?>"><?php echo $get_job_company_info_res['fname']; ?></a></p>
												<p> <?php echo substr($row_search_code['job_description'], 0, 175); ?> .... </p>
												<dl class="dlist-align">
													<dt>City</dt>
													<dd><?php echo $row_search_code['job_city_town']; ?></dd>
												</dl>
												<dl class="dlist-align">
													<dt>Experience</dt>
													<dd><?php echo $row_search_code['job_experience']; ?></dd>
												</dl>
												<dl class="dlist-align">
													<dt>Deadline</dt>
													<dd><?php echo "$post_month"; ?>  <?php echo "$post_date"; ?>, <?php echo "$post_year"; ?></dd>
												</dl>
												<br>
												<div class="sub-category"><a><?php echo $row_search_code['job_category']; ?></a></div>
											</article>
											<aside class="col-sm-3 border-left">
												<div class="action-wrap">
													<p class="alert alert-primary" style="text-transform: uppercase; color: black; background-color: <?php echo $backg; ?> ;"> <?php echo $row_search_code['job_type']; echo " job"; ?> </p>
													<br>
													<p><a href="view-job?view=<?php echo $row_search_code['job_id']; ?>" class="btn btn-primary"> VIEW THIS JOB </a></p>
													<p><a href="view-company?view=<?php echo $row_search_code['job_company']; ?>" class="btn btn-secondary"> VIEW COMPANY </a></p>
												</div>
											</aside>
										</div>
									</div>
								</article>
								<?php
							}
						} else { ?>
							<div class="col-md-12">
								<div class="admin-empty-dashboard" style="margin: 0px 0 0px;">
									<div class="icon">
										<i class="fa fa-frown-o"></i>
									</div>
									<h4 style="text-transform: uppercase;">Sorry No Job Result for <?php echo $s_key; ?></h4>
								</div>
							</div>
						<?php }
					} elseif ($s_cat == "CM") {

						$count_if_query_exist = "SELECT COUNT(*) FROM `tbl_users` WHERE `fname` LIKE '%$s_key%' OR `email` LIKE '%$s_key%' OR `phone_no` LIKE '%$s_key%' OR `city_town` LIKE '%$s_key%' OR `about` LIKE '%$s_key%' OR `comp_type` LIKE '%$s_key%' OR `comp_people` LIKE '%$s_key%' OR `comp_address` LIKE '%$s_key%' OR `comp_services` LIKE '%$s_key%' OR `comp_expertise` LIKE '%$s_key%' AND `role` = 'employer'";
						$count_if_query_exist_code = mysqli_query($connection, $count_if_query_exist);
						$count_if_query_exist_get = mysqli_fetch_array ($count_if_query_exist_code);
						$count_if_query_exist_res =array_shift($count_if_query_exist_get);

						if ($count_if_query_exist_res > 0) {

							$search = "SELECT * FROM `tbl_users`WHERE `fname` LIKE '%$s_key%' OR `email` LIKE '%$s_key%' OR `phone_no` LIKE '%$s_key%' OR `city_town` LIKE '%$s_key%' OR `about` LIKE '%$s_key%' OR `comp_type` LIKE '%$s_key%' OR `comp_people` LIKE '%$s_key%' OR `comp_address` LIKE '%$s_key%' OR `comp_services` LIKE '%$s_key%' OR `comp_expertise` LIKE '%$s_key%' AND `role` = 'employer'";
							$search_code = mysqli_query($connection, $search);

							while ($row_search_code = mysqli_fetch_array($search_code)){

								$role = $row_search_code['role'];

								if ($role == "employer") {

									if ($row_search_code['comp_type'] == "") {
										$company_type = 'Unknown';
									} else {
										$company_type = $row_search_code['comp_type'];
									}

									$count_active_post = "SELECT COUNT(*) FROM tbl_jobs WHERE job_company = '{$row_search_code['member_no']}' AND now() > job_deadline_date";
									$count_active_post_code = mysqli_query($connection, $count_active_post);
									$count_active_post_get = mysqli_fetch_array ($count_active_post_code);
									$count_active_post_res =array_shift($count_active_post_get);
									?>
									<div class="col-md-3">
										<figure class="card card-product">
											<div class="img-wrap">
												<img src="<?php if( $row_search_code['image'] == '') { echo 'employer_img/default.png'; } else { echo 'employer_img/'.$row_search_code['image'].'';} ?>" alt="image" style="padding: 50px 20px;">
												<a class="btn-overlay" href="view-company?view=<?php echo $row_search_code['member_no']; ?>"><i class="fa fa-search-plus"></i> View</a>
											</div>
											<figcaption class="info-wrap">
												<a href="view-company?view=<?php echo $row_search_code['member_no']; ?>" class="title"><?php echo $row_search_code['fname']; ?></a>
												<div class="action-wrap">
													<a href="view-company?view=<?php echo $row_search_code['member_no']; ?>" class="btn btn-primary btn-sm float-right"> View </a>
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
								
							}
						} else { ?>
							<div class="col-md-12">
								<div class="admin-empty-dashboard" style="margin: 0px 0 0px;">
									<div class="icon">
										<i class="fa fa-frown-o"></i>
									</div>
									<h4 style="text-transform: uppercase;">Sorry No Employer Result for <?php echo $s_key; ?></h4>
								</div>
							</div>
						<?php }
					} elseif ($s_cat == "EM") {

						$count_if_query_exist = "SELECT COUNT(*) FROM `tbl_users` WHERE `fname` LIKE '%$s_key%' OR `lname` LIKE '%$s_key%' OR `email` LIKE '%$s_key%' OR `phone_no` LIKE '%$s_key%' OR `city_town` LIKE '%$s_key%' OR `about` LIKE '%$s_key%' AND `role` = 'employee'";
						$count_if_query_exist_code = mysqli_query($connection, $count_if_query_exist);
						$count_if_query_exist_get = mysqli_fetch_array ($count_if_query_exist_code);
						$count_if_query_exist_res =array_shift($count_if_query_exist_get);

						if ($count_if_query_exist_res > 0) {

							$search = "SELECT * FROM `tbl_users` WHERE `fname` LIKE '%$s_key%' OR `lname` LIKE '%$s_key%' OR `email` LIKE '%$s_key%' OR `phone_no` LIKE '%$s_key%' OR `city_town` LIKE '%$s_key%' OR `about` LIKE '%$s_key%' AND `role` = 'employee'";
							$search_code = mysqli_query($connection, $search);

							while ($row_search_code = mysqli_fetch_array($search_code)){

								$role = $row_search_code['role'];

								if ($role == "employee") {
									?>
									<div class="col-md-3">
										<figure class="card card-product">
											<div class="img-wrap">
												<img class="img-circle" style="height: 220px; width: 220px; object-fit: cover;" src="<?php if( $row_search_code['image'] == '') { echo 'employee_img/default.png'; } else { echo 'employee_img/'.$row_search_code['image'].'';} ?>">
												<a class="btn-overlay" href="view-employee?view=<?php echo $row_search_code['member_no']; ?>"><i class="fa fa-search-plus"></i> View</a>
											</div>
											<figcaption class="info-wrap">
												<a href="view-employee?view=<?php echo $row_search_code['member_no']; ?>" class="title"><?php echo $row_search_code['fname']; ?> <?php echo $row_search_code['lname']; ?></a>
												<div class="action-wrap">
													<a href="view-employee?view=<?php echo $row_search_code['member_no']; ?>" class="btn btn-primary btn-sm float-right"> View </a>
													<div class="price-wrap h6">
														<span class="price-new"><i class="fa fa-map-marker"></i> <?php echo $row_search_code['city_town']; ?></span>
													</div>
												</div>
											</figcaption>
										</figure>
									</div>
									<?php
								}

							}
						} else { ?>
							<div class="col-md-12">
								<div class="admin-empty-dashboard" style="margin: 0px 0 0px;">
									<div class="icon">
										<i class="fa fa-frown-o"></i>
									</div>
									<h4 style="text-transform: uppercase;">Sorry No Employee Result for <?php echo $s_key; ?></h4>
								</div>
							</div>
						<?php }
					} else {

						$count_if_query_exist = "SELECT COUNT(*) FROM `tbl_jobs` WHERE `job_title` LIKE '%$s_key%' OR `job_city_town` LIKE '%$s_key%' OR `job_category` LIKE '%$s_key%' OR `job_deadline_date` LIKE '%$s_key%' OR `job_type` LIKE '%$s_key%' OR `job_experience` LIKE '%$s_key%' OR `job_description` LIKE '%$s_key%' OR `job_responsibilities` LIKE '%$s_key%' OR `job_requirements` LIKE '%$s_key%' OR `job_post_date` LIKE '%$s_key%'";
						$count_if_query_exist_code = mysqli_query($connection, $count_if_query_exist);
						$count_if_query_exist_get = mysqli_fetch_array ($count_if_query_exist_code);
						$count_if_query_exist_res =array_shift($count_if_query_exist_get);

						if ($count_if_query_exist_res > 0) {

							$search = "SELECT * FROM `tbl_jobs` WHERE `job_title` LIKE '%$s_key%' OR `job_city_town` LIKE '%$s_key%' OR `job_category` LIKE '%$s_key%' OR `job_deadline_date` LIKE '%$s_key%' OR `job_type` LIKE '%$s_key%' OR `job_experience` LIKE '%$s_key%' OR `job_description` LIKE '%$s_key%' OR `job_responsibilities` LIKE '%$s_key%' OR `job_requirements` LIKE '%$s_key%' OR `job_post_date` LIKE '%$s_key%'";
							$search_code = mysqli_query($connection, $search);

							while ($row_search_code = mysqli_fetch_array($search_code)){

								$job_application_deadline = $row_search_code['job_deadline_date'];

								$post_date = date_format(date_create_from_format('d/m/Y', $job_application_deadline), 'd');
								$post_month = date_format(date_create_from_format('d/m/Y', $job_application_deadline), 'F');
								$post_year = date_format(date_create_from_format('d/m/Y', $job_application_deadline), 'Y');

								if ($row_search_code['job_type'] == "Freelance") {
									$backg = '#28a745';
								} elseif ($row_search_code['job_type'] == "Part-time") {
									$backg = '#ef5f5f';
								} elseif ($row_search_code['job_type'] == "Full-time") {
									$backg = '#ffc107';
								}

								$get_job_company_info = "SELECT fname,image FROM `tbl_users` WHERE member_no = '{$row_search_code['job_company']}'";
								$get_job_company_info_code = mysqli_query($connection, $get_job_company_info);
								$get_job_company_info_res = mysqli_fetch_array ($get_job_company_info_code);
								?>
								<article class="card card-product">
									<div class="card-body">
										<div class="row">
											<aside class="col-sm-3">
												<div class="img-wrap"><a href="view-company?view=<?php echo $row_search_code['job_company']; ?>"><img src="<?php if( $get_job_company_info_res['image'] == '') { echo 'employer_img/default.png'; } else { echo 'employer_img/'.$get_job_company_info_res['image'].'';} ?>" alt="image" style="padding: 50px 20px;"></a></div>
											</aside>
											<article class="col-sm-6">
												<h4 class="title"> <?php echo $row_search_code['job_title']; ?> </h4>
												<p> by <a href="view-company?view=<?php echo $row_search_code['job_company']; ?>"><?php echo $get_job_company_info_res['fname']; ?></a></p>
												<p> <?php echo substr($row_search_code['job_description'], 0, 175); ?> .... </p>
												<dl class="dlist-align">
													<dt>City</dt>
													<dd><?php echo $row_search_code['job_city_town']; ?></dd>
												</dl>
												<dl class="dlist-align">
													<dt>Experience</dt>
													<dd><?php echo $row_search_code['job_experience']; ?></dd>
												</dl>
												<dl class="dlist-align">
													<dt>Deadline</dt>
													<dd><?php echo "$post_month"; ?>  <?php echo "$post_date"; ?>, <?php echo "$post_year"; ?></dd>
												</dl>
												<br>
												<div class="sub-category"><a><?php echo $row_search_code['job_category']; ?></a></div>
											</article>
											<aside class="col-sm-3 border-left">
												<div class="action-wrap">
													<p class="alert alert-primary" style="text-transform: uppercase; color: black; background-color: <?php echo $backg; ?> ;"> <?php echo $row_search_code['job_type']; echo " job"; ?> </p>
													<br>
													<p><a href="view-job?view=<?php echo $row_search_code['job_id']; ?>" class="btn btn-primary"> VIEW THIS JOB </a></p>
													<p><a href="view-company?view=<?php echo $row_search_code['job_company']; ?>" class="btn btn-secondary"> VIEW COMPANY </a></p>
												</div>
											</aside>
										</div>
									</div>
								</article>
								<?php
							}
						} else { ?>
							<div class="col-md-12">
								<div class="admin-empty-dashboard" style="margin: 0px 0 0px;">
									<div class="icon">
										<i class="fa fa-frown-o"></i>
									</div>
									<h4 style="text-transform: uppercase;">Sorry No Job Result for <?php echo $s_key; ?></h4>
								</div>
							</div>
						<?php }
					}
				?>
			</div>
		</div>
	</section>

	<?php include ('includes/footer.php'); ?>

</body>
</html>