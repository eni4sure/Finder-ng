<?php
	date_default_timezone_set('Africa/Lagos');

	if (isset($_GET['job']) & isset($_GET['applicant'])) {
		$job_id 		= $_GET['job'];
		$applicant_id 	= $_GET['applicant'];
		$today			= date('F d, Y');

		require('connect.php');

		$count_if_job_exist = "SELECT COUNT(*) FROM `tbl_jobs` WHERE job_id = '$job_id'";
		$count_if_job_exist_code = mysqli_query($connection, $count_if_job_exist);
		$count_if_job_exist_get = mysqli_fetch_array ($count_if_job_exist_code);
		$count_if_job_exist_res = array_shift($count_if_job_exist_get);

		if ($count_if_job_exist_res > 0) {

			$count_if_applicant_exist = "SELECT COUNT(*) FROM `tbl_users` WHERE role = 'employee' AND member_no = '$applicant_id'";
			$count_if_applicant_exist_code = mysqli_query($connection, $count_if_applicant_exist);
			$count_if_applicant_exist_get = mysqli_fetch_array ($count_if_applicant_exist_code);
			$count_if_applicant_exist_res = array_shift($count_if_applicant_exist_get);

			if ($count_if_applicant_exist_res > 0) {

				$count_if_application_exist = "SELECT COUNT(*) FROM `tbl_job_applications` WHERE job_id = '$job_id' AND member_no = '$applicant_id'";
				$count_if_application_exist_code = mysqli_query($connection, $count_if_application_exist);
				$count_if_application_exist_get = mysqli_fetch_array ($count_if_application_exist_code);
				$count_if_application_exist_res = array_shift($count_if_application_exist_get);

				if ($count_if_application_exist_res == "0") {
					
					$insert_application = "INSERT INTO `tbl_job_applications` (`member_no`, `job_id`, `application_date`) VALUES ('$applicant_id', '$job_id', '$today')";
					$insert_application_code = mysqli_query($connection, $insert_application);
					if ($insert_application_code) {

						header("location:../view-job?view=$job_id&r=You have succesfully applied to this job&ty=success");
					} else {

						header("location:../view-job?view=$job_id&r=Sorry Error Processing Request. Try Again&ty=danger");
					}
				} else {

					header("location:../view-job?view=$job_id&r=You have already applied to this job&ty=danger");
				}
			} else {

				header("location:../");
			}
		} else {

			header("location:../");
		}
		
	} else {
		header("location:../");
	}
?>