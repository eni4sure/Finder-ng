<?php
	if (isset($_SESSION['logged_in']) && $_SESSION['logged_in'] == true) {
		$user_online = true;	
		$sess_role = $_SESSION['role'];
	} else {
		$user_online = false;
	}
?>