<?php session_start(); ?>
<?php
	date_default_timezone_set('Africa/Lagos');

	if (isset($_POST['post-job'])) {
		post_job();
	} else {
		header("location:../");
	}

	function post_job(){

		require('../../php/connect.php');
		require('../../php/uniques.php');
		require('check_login.php');

		$job_title				= ucwords($_POST['job_title']);
		$job_city_town			= ucwords($_POST['job_city_town']);
		$job_category			= ucwords($_POST['job_category']);
		$job_deadline_date		= $_POST['job_deadline_date'];
		$job_type				= ucwords($_POST['job_type']);
		$job_experience			= ucwords($_POST['job_experience']);
		$job_description		= ucwords($_POST['job_description']);
		$job_responsibilities	= ucwords($_POST['job_responsibilities']);
		$job_requirements		= ucwords($_POST['job_requirements']);
		$job_id					= 'JOB'.get_rand_numbers(10).'';
		$job_company			= $sess_comp_member_no;
		$job_post_date			= date('F d, Y');


		$insert_job = "INSERT INTO `tbl_jobs` (`job_title`, `job_city_town`, `job_category`, `job_deadline_date`, `job_type`, `job_experience`, `job_description`, `job_responsibilities`, `job_requirements`, `job_id`, `job_company`, `job_post_date`) 
			VALUES ('$job_title', '$job_city_town', '$job_category', '$job_deadline_date', '$job_type', '$job_experience','$job_description', '$job_responsibilities', '$job_requirements', '$job_id', '$job_company', '$job_post_date')";
		$insert_job_code = mysqli_query($connection, $insert_job);
		if ($insert_job_code) {

			header("location:../post-job?r=Your job ad has been posted successfully&ty=success");
		} else {

			header("location:../post-job?r=Sorry Error Processing Request. Try Again&ty=danger");
		}
	}
?>