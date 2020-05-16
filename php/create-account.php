<?php session_start(); ?>
<?php
	date_default_timezone_set('Africa/Lagos');

	if (isset($_POST['register'])) {
		check_if_exist();	
	} else {
		header("location:../");		
	}

	function check_if_exist(){
		$email = $_POST['email'];
		$role = $_POST['role'];

		require('connect.php');

		$count_if_exist = "SELECT COUNT(*) FROM `tbl_users` WHERE email = '$email'";
		$count_if_exist_code = mysqli_query($connection, $count_if_exist);
		$count_if_exist_get = mysqli_fetch_array ($count_if_exist_code);
		$count_if_exist_res =array_shift($count_if_exist_get);

		if ($count_if_exist_res > 0) {
			header("location:../sign-up?r=Email Already Exists&ty=danger");
		} else {

			if ($role == "employee") {
				register_as_employee();
			} elseif ($role == "employer") {
				register_as_employer();
			} else {
				header("location:../sign-up?r=Sorry Invalid Request&ty=danger");
			}
		}
	}

	function register_as_employee(){
		require('connect.php');
		require('uniques.php');
		$fname 			= ucwords($_POST['fname']);
		$lname 			= ucwords($_POST['lname']);
		$gender 		= strtoupper($_POST['gender']);
		$email 			= strtolower($_POST['email']);
		$passkey		= md5($_POST['passkey']);
		$phone_no		= $_POST['phone_no'];
		$city_town 		= ucwords($_POST['city_town']);
		$about 			= null;
		$comp_year 		= null;
		$comp_type 		= null;
		$comp_people 	= null;
		$comp_website 	= null;
		$comp_address 	= null;
		$comp_services 	= null;
		$comp_expertise = null;
		$image 			= null;
		$member_no		= 'EM'.get_rand_numbers(9).'';
		$role 			= 'employee';

		$insert_user = "INSERT INTO `tbl_users` (`fname`, `lname`, `gender`, `email`, `passkey`, `phone_no`, `city_town`, `about`, `comp_year`, `comp_type`, `comp_people`, `comp_website`, `comp_address`, `comp_services`, `comp_expertise`, `image`, `member_no`, `role`) 
			VALUES ('$fname', '$lname', '$gender', '$email', '$passkey', '$phone_no', '$city_town', '$about', '$comp_year', '$comp_type', '$comp_people', '$comp_website', '$comp_address', '$comp_services', '$comp_expertise', '$image', '$member_no', '$role')";
		$insert_user_code = mysqli_query($connection, $insert_user);
		if ($insert_user_code) {
			header("location:../sign-up?r=$role has been successfully registered&ty=success");
		} else {
			header("location:../sign-up?r=Sorry Error Processing Request. Try Again&ty=danger");
		}
	}

	function register_as_employer(){
		require('connect.php');
		require('uniques.php');
		$fname 			= ucwords($_POST['comp_name']);
		$lname 			= null;
		$gender 		= null;
		$email 			= strtolower($_POST['email']);
		$passkey		= md5($_POST['comp_passkey']);
		$phone_no		= $_POST['comp_phone_no'];
		$city_town 		= ucwords($_POST['comp_city_town']);
		$about 			= null;
		$comp_year 		= null;
		$comp_type 		= ucwords($_POST['comp_type']);
		$comp_people 	= null;
		$comp_website 	= null;
		$comp_address 	= null;
		$comp_services 	= null;
		$comp_expertise = null;
		$image 			= null;
		$member_no		= 'CM'.get_rand_numbers(9).'';
		$role 			= 'employer';

		$insert_user = "INSERT INTO `tbl_users` (`fname`, `lname`, `gender`, `email`, `passkey`, `phone_no`, `city_town`, `about`, `comp_year`, `comp_type`, `comp_people`, `comp_website`, `comp_address`, `comp_services`, `comp_expertise`, `image`, `member_no`, `role`) 
			VALUES ('$fname', '$lname', '$gender', '$email', '$passkey', '$phone_no', '$city_town', '$about', '$comp_year', '$comp_type', '$comp_people', '$comp_website', '$comp_address', '$comp_services', '$comp_expertise', '$image', '$member_no', '$role')";
		$insert_user_code = mysqli_query($connection, $insert_user);
		if ($insert_user_code) {
			header("location:../sign-up?r=$role has been successfully registered&ty=success");
		} else {
			header("location:../sign-up?r=Sorry Error Processing Request. Try Again&ty=danger");
		}
	}
?>