<?php session_start(); ?>
<!DOCTYPE HTML>
<html lang="en-NG">

<?php include ('php/check_login.php'); ?>

<?php $head_title = 'Employer | Finder'; ?>
<?php include ('includes/head.php'); ?>

<body class="relative" data-spy="scroll" data-target=".navbar-landing">
	<div class="se-pre-con"></div>

	<?php $page_nav = 'employers'; ?>
	<?php include ('includes/navbar.php'); ?>

	<?php $search_nav = 'CM'; ?>
	<?php include ('includes/search.php'); ?>

	<!-- ========================= SECTION CONTENT ========================= -->
	<section class="section-content bg padding-y">
		<div class="container">
			<div class="row">
				<?php

					require('php/connect.php');

					$count_if_employer_exist = "SELECT COUNT(*) FROM `tbl_users` WHERE role = 'employer'";
					$count_if_employer_exist_code = mysqli_query($connection, $count_if_employer_exist);
					$count_if_employer_exist_get = mysqli_fetch_array ($count_if_employer_exist_code);
					$count_if_employer_exist_res =array_shift($count_if_employer_exist_get);

					if ($count_if_employer_exist_res > 0) {
						$get_employer_info = "SELECT * FROM `tbl_users` WHERE role = 'employer' ORDER BY RAND()";
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

	<?php include ('includes/footer.php'); ?>

</body>
</html>