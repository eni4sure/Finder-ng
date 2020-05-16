<?php session_start(); ?>
<!DOCTYPE HTML>
<html lang="en-NG">

<?php include ('php/check_login.php'); ?>

<?php $head_title = 'Upload CV | Employee | Finder'; ?>
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
			<?php
				if (isset($_GET['r']) & isset($_GET['ty'])) {
					$report_msg = $_GET['r'];
					$report_type = $_GET['ty'];
					echo '<div class="text-center alert alert-'.$report_type.'">'.strtoupper($report_msg).'</div>';
				}
			?>
			<br>
			<div class="row">

				<?php $user_panel_nav = 'upload-cv'; ?>
				<?php include ('includes/user_panel.php'); ?>

				<div class="col-md-9 col-sm-8 col-xs-12">
					<div class="admin-content-wrapper">

						<div class="admin-section-title">
							<h2>Upload CV</h2>
						</div>

						<form action="php/upload-cv" method="POST" enctype="multipart/form-data">
							<div class="row gap-20">
								<div class="col-sm-12 col-md-12">
									<div class="form-group">
										<label> Upload CV</label><br>
										<input class="form-control" type="file" name="cv" id="cv" accept=".pdf,.docx">
									</div>
								</div>

								<div class="col-sm-12 mt-10">
									<button type="submit" class="btn btn-primary" name="upload-cv">Upload</button>
								</div>
							</div>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>

	<?php include ('includes/footer.php'); ?>

</body>
</html>