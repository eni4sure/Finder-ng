<?php session_start(); ?>
<!DOCTYPE HTML>
<html lang="en-NG">

<?php include ('php/check_login.php'); ?>

<?php $head_title = 'Alert | Employee | Finder'; ?>
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

				<?php $user_panel_nav = 'my-alert'; ?>
				<?php include ('includes/user_panel.php'); ?>

				<div class="col-md-9 col-sm-8 col-xs-12">
					<div class="admin-content-wrapper">

						<div class="admin-section-title">
							<h2>Alerts</h2>
						</div>

						<div class="admin-empty-dashboard">

							<div class="icon">
								<i class="fa fa-bell"></i>
							</div>

							<h4>You do not have any alert yet!</h4>

							<a href="../job_list" class="btn btn-primary">Browse Jobs</a>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>

	<?php include ('includes/footer.php'); ?>

</body>
</html>