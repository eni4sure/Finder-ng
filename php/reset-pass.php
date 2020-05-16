<?php error_reporting(0); ?>
<?php require ('config.php'); ?>
<?php check_gen_login(); ?>
<?php
	date_default_timezone_set('Africa/Lagos');

	if (isset($_POST['reset-pass'])) {

		require('connect.php');

		$reset_email = $_SESSION['resetmail'];
		$new_password = md5($_POST['newpasskey']);

		$update_password = "UPDATE tbl_users SET passkey = '$new_password' WHERE email = '$reset_email'";
		$run_password = mysqli_query($connection, $update_password);

		$delete_token = "DELETE FROM tbl_tokens WHERE email = '$reset_email'";
		$run_token = mysqli_query($connection, $delete_token);

		$_SESSION['resetmail'] = "";

		header("location:../login?r=Password Change Successful. You can now Login Here <i class='fa fa-hand-o-down'></i>&ty=success");
	} else {

		header("location:../");
	}
?>