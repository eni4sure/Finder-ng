<?php
	if (isset($_SESSION['logged_in']) && $_SESSION['logged_in'] == true) {
		$sess_fname			= $_SESSION['fname'];
		$sess_lname			= $_SESSION['lname'];
		$sess_gender		= $_SESSION['gender'];
		$sess_email			= $_SESSION['email'];
		$sess_passkey		= $_SESSION['passkey'];
		$sess_phone_no		= $_SESSION['phone_no'];
		$sess_city_town		= $_SESSION['city_town'];
		$sess_about			= $_SESSION['about'];
		$sess_image			= $_SESSION['image'];
		$sess_member_no		= $_SESSION['member_no'];
		$sess_role			= $_SESSION['role'];

		$user_online = true;
	} else {
		$user_online = false;
	}
?>
<?php
	if ($user_online == "true") {
		if ($sess_role == "employee"){

		} else {
			header("location:../");
		}
	} else {
		header("location:../");
	}
?>