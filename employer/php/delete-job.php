<?php session_start(); ?>
<?php
	date_default_timezone_set('Africa/Lagos');

	if (isset($_GET['del'])) {

		require('../../php/connect.php');
		require('check_login.php');

		$job_id = $_GET['del'];

		$count_job = "SELECT COUNT(*) FROM tbl_jobs WHERE job_id = '$job_id' AND job_company = '$sess_comp_member_no'";
		$count_job_code = mysqli_query($connection, $count_job);
		$count_job_get = mysqli_fetch_array ($count_job_code);
		$count_job_res = array_shift($count_job_get);

		if ($count_job_res == "0") {

			header("location:../");
		} else {

			$delete_job = "DELETE FROM tbl_jobs WHERE job_id = '$job_id'";
			$delete_job_code = mysqli_query($connection, $delete_job);

			$delete_applicants = "DELETE FROM tbl_job_applications WHERE job_id = '$job_id'";
			$delete_applicants_code = mysqli_query($connection, $delete_applicants);

			if ($delete_job_code && $delete_applicants_code) {

				header("location:../posted-jobs?r=Your job ad has been deleted successfully&ty=success");
			} else {

				header("location:../posted-jobs?r=Sorry Error while processing Request&ty=danger");
			}
		}
	} else {

		header("location:../");
	}
?>