<?php session_start(); ?>
<!DOCTYPE HTML>
<html lang="en-NG">

<?php include ('php/check_login.php'); ?>

<?php $head_title = 'Post A Job | Employer | Finder'; ?>
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
			<br>
			<div class="row">

				<?php $user_panel_nav = ''; ?>
				<?php include ('includes/user_panel.php'); ?>

				<div class="col-md-9 col-sm-8 col-xs-12">
					<div class="admin-content-wrapper">

						<div class="admin-section-title">
							<h2>Post A Job</h2>
						</div>

						<form class="post-form-wrapper" action="php/post-job" method="POST">

							<div class="col-sm-8 col-md-8">
								<div class="form-group">
									<label>Job Title</label>
									<input name="job_title" required type="text" class="form-control" placeholder="Enter job title">
								</div>
							</div>

							<div class="col-sm-8 col-md-8">
								<div class="form-group">
									<label>Job City/Town</label>
									<input name="job_city_town" required type="text" class="form-control" placeholder="Enter job city/town">
								</div>
							</div>

							<div class="col-sm-8 col-md-8">
								<div class="form-group">
									<label>Job Category</label>
									<input name="job_category" required type="text" class="form-control" placeholder="E.g Trading, Clothing, Corporate, Marketing, Accounting etc">
									<!-- <input list="category" name="job_category" required type="text" class="form-control" placeholder="Enter job category"> -->
									<!-- <datalist id="category">
										<?php

											// require('../php/connect.php');

											// $get_job_cat = "SELECT * FROM tbl_categories ORDER BY category";
											// $run_job_cat = mysqli_query($connection, $get_job_cat);

											// while ($row_job_cat = mysqli_fetch_array($run_job_cat)){ 
											?><option value="<?php //echo $row_job_cat['category']; ?>">
										<?php //}
										?>
									</datalist> -->
								</div>
							</div>

							<div class="col-sm-8 col-md-8">
								<div class="form-group">
									<label>Application Deadline</label>
									<!-- <input name="job_deadline_date" required type="text" class="form-control" placeholder="Eg: 30/12/2018"> -->
									<input name="job_deadline_date" required type="text" class="form-control" placeholder="Choose a deadline date" id="deadline_date">
								</div>
							</div>


							<div class="row" style="margin-right: 0px; margin-left: 0px; ">
								<div class="col-sm-6 col-md-6">
									<div class="form-group">
										<label>Job Type</label>
										<select name="job_type" required class="form-control">
											<option value="">-Select job type-</option>
											<option value="Full-time">Full-time</option>
											<option value="Part-time">Part-time</option>
											<option value="Freelance">Freelance</option>
										</select>
									</div>
								</div>

								<div class="col-sm-6 col-md-6">
									<div class="form-group">
										<label>Experience</label>
										<select name="job_experience" required class="form-control">
											<option value="">-Select experience-</option>
											<option value="2 Years">2 Years</option>
											<option value="3 Years">3 Years</option>
											<option value="4 Years">4 Years</option>
											<option value="5 Years">5 Years</option>
											<option value="Expert">Expert</option>
										</select>
									</div>
								</div>
							</div>

							<div class="col-sm-12 col-md-12">
								<div class="form-group">
									<label>Job Description <i class="fa fa-info-circle" data-toggle="tooltip" title="Enter a short description about the job to help people know more about the job"></i> </label>
									<textarea name="job_description" required class="form-control" minlength="100" placeholder="Enter job description ..." style="height: 200px;"></textarea>
								</div>
							</div>

							<div class="col-sm-12 col-md-12">
								<div class="form-group">
									<label>Job Responsibilities </label>
									<textarea name="job_responsibilities" required class="form-control" minlength="100" placeholder="Enter job responsibilities ..." style="height: 200px;"></textarea>
								</div>
							</div>

							<div class="col-sm-12 col-md-12">
								<div class="form-group">
									<label>Requirements </label>
									<textarea name="job_requirements" required class="form-control" minlength="100" placeholder="Enter job requirements ..." style="height: 200px;"></textarea>
								</div>
							</div>

							<div class="col-sm-12 mt-10">
								<button type="submit" class="btn btn-primary" name="post-job">Post Job</button>
								<button type="reset" class="btn btn-primary btn-inverse">Cancel</button>
							</div>
						</form>

					</div>
				</div>
			</div>
		</div>
	</div>

	<?php include ('includes/footer.php'); ?>

	
	<script type="text/javascript">
		
	</script>

</body>
</html>