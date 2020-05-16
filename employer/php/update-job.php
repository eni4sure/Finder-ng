<?php session_start(); ?>
<?php
	date_default_timezone_set('Africa/Lagos');

	if (isset($_POST['update-job'])) {

		require('../../php/connect.php');
		require('check_login.php');

		$job_id = $_POST['id'];

		$count_job = "SELECT COUNT(*) FROM tbl_jobs WHERE job_id = '$job_id' AND job_company = '$sess_comp_member_no'";
		$count_job_code = mysqli_query($connection, $count_job);
		$count_job_get = mysqli_fetch_array ($count_job_code);
		$count_job_res = array_shift($count_job_get);

		if ($count_job_res == "0") {

			header("location:../");
		} else {

			$job_title				= ucwords($_POST['job_title']);
			$job_city_town			= ucwords($_POST['job_city_town']);
			$job_category			= ucwords($_POST['job_category']);
			$job_deadline_date		= $_POST['job_deadline_date'];
			$job_type				= ucwords($_POST['job_type']);
			$job_experience			= ucwords($_POST['job_experience']);
			$job_description		= ucwords($_POST['job_description']);
			$job_responsibilities	= ucwords($_POST['job_responsibilities']);
			$job_requirements		= ucwords($_POST['job_requirements']);

			$update = "UPDATE tbl_jobs SET job_title = '$job_title', job_city_town = '$job_city_town', job_category = '$job_category', job_deadline_date = '$job_deadline_date', job_type = '$job_type', job_experience = '$job_experience', job_description = '$job_description', job_responsibilities = '$job_responsibilities', job_requirements = '$job_requirements' WHERE job_id = '$job_id' AND job_company = '$sess_comp_member_no' ";
			$update_con = mysqli_query($connection, $update);

			if ($update_con) {

				header("location:../edit-job?edit=$job_id&r=Your job ad has been updated successfully&ty=success");
			} else {

				header("location:../edit-job?edit=$job_id&?r=Sorry Error while processing Request&ty=danger");
			}
		}
	} else {

		header("location:../");
	}
?>