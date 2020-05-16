<?php
	session_start();
	$_SESSION['logged_in'] = false;
	session_unset();
	session_destroy();
	header("location:./");
?>