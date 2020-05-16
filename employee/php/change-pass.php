<?php session_start(); ?>
<?php
	date_default_timezone_set('Africa/Lagos');

	if (isset($_POST['change-pass'])) {
		$current_password = md5($_POST['currentpasskey']);

		require('../../php/connect.php');
		require('check_login.php');

		$get_old_pass = "SELECT * FROM `tbl_users` WHERE member_no='$sess_member_no'";
		$get_old_pass_code = mysqli_query($connection, $get_old_pass);
		$get_old_pass_res = mysqli_fetch_array ($get_old_pass_code);

		$stored_pass = $get_old_pass_res['passkey'];

		if ($current_password == $stored_pass) {
			$new_password = md5($_POST['newpasskey']);

			$update_pass = "UPDATE tbl_users SET passkey = '$new_password' WHERE member_no='$sess_member_no'";
			$update_pass_con = mysqli_query($connection, $update_pass);

			if ($update_pass_con) {
				header("location:../change-password?r=Password has been successfully changed&ty=success");
			} else {
				header("location:../change-password?r=Error while processing request&ty=danger");
			}
		} else {
			header("location:../change-password?r=Your Password is Incorret&ty=danger");
		}
	} else {
		header("location:../");
	}
?>