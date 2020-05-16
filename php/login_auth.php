<?php session_start(); ?>
<?php
	date_default_timezone_set('Africa/Lagos');

	require('check_login.php');

	if ($user_online == false) {
		if (isset($_POST['login'])) {
			check_if_user_exist();
		} else {
			header("location:../");
		}
	} else {
		header("location:../$sess_role");
	}

	function check_if_user_exist(){
		$email = strtolower($_POST['email']);
		$passkey = md5($_POST['passkey']);

		require('connect.php');

		$count_if_user_exist = "SELECT COUNT(*) FROM tbl_users WHERE email = '$email' AND passkey = '$passkey'";
		$count_if_user_exist_code = mysqli_query($connection, $count_if_user_exist);
		$count_if_user_exist_get = mysqli_fetch_array ($count_if_user_exist_code);
		$count_if_user_exist_res =array_shift($count_if_user_exist_get);

		if ($count_if_user_exist_res != 1) {

			header("location:../login?r=Account details are invalid&ty=danger");
		} else {
			$get_user_info = "SELECT * FROM tbl_users WHERE email = '$email' AND passkey = '$passkey'";
			$run_user_info = mysqli_query($connection, $get_user_info);

			while ($row_user_info = mysqli_fetch_array($run_user_info)){
				$role = $row_user_info['role'];

				if ($role == "employee"){

					$_SESSION['logged_in'] 	= true;
					$_SESSION['fname'] 		= $row_user_info['fname'];
					$_SESSION['lname'] 		= $row_user_info['lname'];
					$_SESSION['gender'] 	= $row_user_info['gender'];
					$_SESSION['email'] 		= $row_user_info['email'];
					$_SESSION['passkey'] 	= $row_user_info['passkey'];
					$_SESSION['phone_no'] 	= $row_user_info['phone_no'];
					$_SESSION['city_town'] 	= $row_user_info['city_town'];
					$_SESSION['about'] 		= $row_user_info['about'];
					$_SESSION['image'] 		= $row_user_info['image'];
					$_SESSION['member_no'] 	= $row_user_info['member_no'];
					$_SESSION['role'] 		= $role;
				} elseif ($role == "employer"){

					$_SESSION['logged_in'] 			= true;	
					$_SESSION['comp_name'] 			= $row_user_info['fname'];
					$_SESSION['comp_email'] 		= $row_user_info['email'];
					$_SESSION['passkey'] 			= $row_user_info['passkey'];
					$_SESSION['comp_phone_no'] 		= $row_user_info['phone_no'];
					$_SESSION['comp_city_town'] 	= $row_user_info['city_town'];
					$_SESSION['comp_about'] 		= $row_user_info['about'];
					$_SESSION['comp_year'] 			= $row_user_info['comp_year'];
					$_SESSION['comp_type'] 			= $row_user_info['comp_type'];
					$_SESSION['comp_people'] 		= $row_user_info['comp_people'];
					$_SESSION['comp_website'] 		= $row_user_info['comp_website'];
					$_SESSION['comp_address'] 		= $row_user_info['comp_address'];
					$_SESSION['comp_services'] 		= $row_user_info['comp_services'];
					$_SESSION['comp_expertise'] 	= $row_user_info['comp_expertise'];
					$_SESSION['comp_image'] 		= $row_user_info['image'];
					$_SESSION['comp_member_no'] 	= $row_user_info['member_no'];
					$_SESSION['role'] 				= $role;
				} else {
					header("location:../login?r=Your Account details are invalid and therefore you can't Login&type=danger");
				}

				header("location:../$role");
			}
		}
	}
?>