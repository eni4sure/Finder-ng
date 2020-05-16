<?php session_start(); ?>
<?php
	date_default_timezone_set('Africa/Lagos');

	if (isset($_POST['update-profile'])) {
		update_profile();
	} else {
		header("location:../");
	}

	function update_profile(){
		$fname 			= ucwords($_POST['fname']);
		$lname 			= ucwords($_POST['lname']);
		$gender 		= strtoupper($_POST['gender']);
		$email 			= strtolower($_POST['email']);
		$phone_no		= $_POST['phone_no'];
		$city_town 		= ucwords($_POST['city_town']);
		$about 			= ucwords($_POST['about']);

		require('../../php/connect.php');
		require('check_login.php');

		$count_if_email_exist = "SELECT COUNT(*) FROM tbl_users WHERE email = '$email' AND member_no != '$sess_member_no'";
		$count_if_email_exist_code = mysqli_query($connection, $count_if_email_exist);
		$count_if_email_exist_get = mysqli_fetch_array ($count_if_email_exist_code);
		$count_if_email_exist_res =array_shift($count_if_email_exist_get);

		if ($count_if_email_exist_res == 0) {
			$update = "UPDATE tbl_users SET fname='$fname', lname='$lname', gender='$gender', email='$email', phone_no='$phone_no', city_town='$city_town', about='$about' WHERE  member_no = '$sess_member_no' ";
			$update_con = mysqli_query($connection, $update);

			if ($update_con) {

				$_SESSION['fname'] 		= $fname;
				$_SESSION['lname'] 		= $lname;
				$_SESSION['gender'] 	= $gender;
				$_SESSION['email'] 		= $email;
				$_SESSION['phone_no'] 	= $phone_no;
				$_SESSION['city_town'] 	= $city_town;
				$_SESSION['about'] 		= $about;

				header("location:../?r=Account Updated Successfully&ty=success");

			} else {

				header("location:../?r=Error while processing Request&ty=danger");
			}

		} else {
			header("location:../?r=This email aready exist&ty=danger");
		}
	}
?>