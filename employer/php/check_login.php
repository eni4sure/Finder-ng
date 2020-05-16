<?php
	if (isset($_SESSION['logged_in']) && $_SESSION['logged_in'] == true) {
		$sess_comp_name				= $_SESSION['comp_name'];
		$sess_comp_email			= $_SESSION['comp_email'];
		$sess_comp_passkey			= $_SESSION['passkey'];
		$sess_comp_phone_no			= $_SESSION['comp_phone_no'];
		$sess_comp_city_town		= $_SESSION['comp_city_town'];
		$sess_comp_about			= $_SESSION['comp_about'];
		$sess_comp_year				= $_SESSION['comp_year'];
		$sess_comp_type				= $_SESSION['comp_type'];
		$sess_comp_people			= $_SESSION['comp_people'];
		$sess_comp_website			= $_SESSION['comp_website'];
		$sess_comp_address			= $_SESSION['comp_address'];
		$sess_comp_services			= $_SESSION['comp_services'];
		$sess_comp_expertise		= $_SESSION['comp_expertise'];
		$sess_comp_image			= $_SESSION['comp_image'];
		$sess_comp_member_no		= $_SESSION['comp_member_no'];
		$sess_role					= $_SESSION['role'];

		$user_online = true;	
	} else {
		$user_online = false;
	}
?>
<?php
	if ($user_online == "true") {
		if ($sess_role == "employer"){

		} else {
			header("location:../");
		}
	} else {
		header("location:../");
	}
?>