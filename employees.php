<?php session_start(); ?>
<!DOCTYPE HTML>
<html lang="en-NG">

<?php include ('php/check_login.php'); ?>

<?php $head_title = 'Employee | Finder'; ?>
<?php include ('includes/head.php'); ?>

<body class="relative" data-spy="scroll" data-target=".navbar-landing">
	<div class="se-pre-con"></div>

	<?php $page_nav = 'employees'; ?>
	<?php include ('includes/navbar.php'); ?>

	<?php $search_nav = 'EM'; ?>
	<?php include ('includes/search.php'); ?>

	<!-- ========================= SECTION CONTENT ========================= -->
	<section class="section-content bg padding-y">
		<div class="container">
			<div class="row">
				<?php

					require('php/connect.php');

					$count_if_employee_exist = "SELECT COUNT(*) FROM `tbl_users` WHERE role = 'employee'";
					$count_if_employee_exist_code = mysqli_query($connection, $count_if_employee_exist);
					$count_if_employee_exist_get = mysqli_fetch_array ($count_if_employee_exist_code);
					$count_if_employee_exist_res =array_shift($count_if_employee_exist_get);

					if ($count_if_employee_exist_res > 0) {
						$get_employee_info = "SELECT * FROM `tbl_users` WHERE role = 'employee' ORDER BY RAND()";
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
	<!-- ========================= SECTION CONTENT END// ========================= -->

	<?php include ('includes/footer.php'); ?>

</body>
</html>