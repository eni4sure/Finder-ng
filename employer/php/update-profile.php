<?php session_start(); ?>
<?php
	date_default_timezone_set('Africa/Lagos');

	if (isset($_POST['update-profile'])) {
		update_profile();
	} else {
		header("location:../");
	}

	function update_profile(){
		$fname 			= ucwords($_POST['company_name']);
		$email 			= strtolower($_POST['company_email']);
		$phone_no		= $_POST['company_phone_no'];
		$city_town 		= ucwords($_POST['company_city_town']);
		$about 			= ucwords($_POST['company_about']);
		$comp_year 		= $_POST['company_year'];
		$comp_type 		= ucwords($_POST['company_type']);
		$comp_people 	= $_POST['company_people'];
		$comp_website 	= strtolower($_POST['company_website']);
		$comp_address 	= ucwords($_POST['company_address']);
		$comp_services 	= ucwords($_POST['company_services']);
		$comp_expertise = ucwords($_POST['company_expertise']);

		require('../../php/connect.php');
		require('check_login.php');

		$count_if_email_exist = "SELECT COUNT(*) FROM tbl_users WHERE email = '$email' AND member_no != '$sess_comp_member_no'";
		$count_if_email_exist_code = mysqli_query($connection, $count_if_email_exist);
		$count_if_email_exist_get = mysqli_fetch_array ($count_if_email_exist_code);
		$count_if_email_exist_res =array_shift($count_if_email_exist_get);

		if ($count_if_email_exist_res == "0") {
			$update = "UPDATE tbl_users SET fname='$fname', email='$email', phone_no='$phone_no', city_town='$city_town', about='$about', comp_year='$comp_year', comp_type='$comp_type', comp_people='$comp_people', comp_website='$comp_website', comp_address='$comp_address', comp_services='$comp_services', comp_expertise='$comp_expertise' WHERE  member_no = '$sess_comp_member_no' ";
			$update_con = mysqli_query($connection, $update);

			if ($update_con) {

				$_SESSION['comp_name'] 			= $fname;
				$_SESSION['comp_email'] 		= $email;
				$_SESSION['comp_phone_no'] 		= $phone_no;
				$_SESSION['comp_city_town'] 	= $city_town;
				$_SESSION['comp_about'] 		= $about;
				$_SESSION['comp_year'] 			= $comp_year;
				$_SESSION['comp_type'] 			= $comp_type;
				$_SESSION['comp_people'] 		= $comp_people;
				$_SESSION['comp_website'] 		= $comp_website;
				$_SESSION['comp_address'] 		= $comp_address;
				$_SESSION['comp_services'] 		= $comp_services;
				$_SESSION['comp_expertise'] 	= $comp_expertise;

				header("location:../?r=Account Updated Successfully&ty=success");

			} else {

				header("location:../?r=Error while processing Request&ty=danger");
			}

		} else {

			header("location:../?r=This email aready exist&ty=danger");
		}
	}
?>