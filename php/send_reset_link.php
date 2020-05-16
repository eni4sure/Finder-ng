<?php session_start(); ?>
<?php
	date_default_timezone_set('Africa/Lagos');

	if (isset($_POST['reset-pass'])) {

		$email = $_POST['email'];

		require('connect.php');
		require('uniques.php');
		require('../includes/http_link.php');

		$count_if_exist = "SELECT COUNT(*) FROM `tbl_users` WHERE email = '$email'";
		$count_if_exist_code = mysqli_query($connection, $count_if_exist);
		$count_if_exist_get = mysqli_fetch_array ($count_if_exist_code);
		$count_if_exist_res =array_shift($count_if_exist_get);

		if ($count_if_exist_res == "0") {

			header("location:../forgot?r=No account is associated with email: <strong>$email</strong>&ty=danger");
		} else {
			$get_user_details = "SELECT * FROM `tbl_users` WHERE email = '$email'";
			$run_user_details = mysqli_query($connection, $get_user_details);

			while ($row_user_details = mysqli_fetch_array($run_user_details)){

				$role = $row_user_details['role'];

				if ($role = "employee") {
					
					$fname = $row_user_details['fname'];
					$lname = $row_user_details['lname'];

					$full_name = "$fname $lname";
					$get_token = 'token'.get_rand_numbers(20).'';
					$token = md5($get_token);

					$link = ''.$domain.'/reset?token='.$token.'';

					$delete_token = "DELETE FROM tbl_tokens WHERE email = '$email'";
					$delete_token_code = mysqli_query($connection, $delete_token);

					$insert_new_token = "INSERT INTO `tbl_tokens` (email, token) VALUES ('$email', '$token')";
					$insert_new_token_code = mysqli_query($connection, $insert_new_token);

					if ($insert_new_token_code) {

						$message = "Hello!! <b>".$full_name."</b>, <br>Click <a href='".$link."'>HERE</a> to reset your <b>Finder</b> Account password.";

						$subject = 'Password Reset Message';
						$header = "From: noreply@finder.com \r\n";
						$header .= "Reply-To: noreply@finder.com \r\n";
						$header .= "Content-type: text/html; charset=iso-8859-1\r\n";
						$message_body = "Employee Account Details<hr><br>";
						$message_body .= "Name: ".$full_name."<br>";
						$message_body .= "Email: ".$email."<br>";
						$message_body .= "Message: ".nl2br($message)."<br>";

						if (mail( $email, $subject, $message_body, $header)) {

							// echo "<script>alert('A Confirmation message has been sent to your mail!');</script>";
							// echo "<script>document.location.href='http://localhost/creativekitten/'</script>";

							header("location:../forgot?r=A link to reset your password was sent to $email &ty=success");
						} else {

							header("location:../forgot?r=Error while sending confirmation link to your mail. Try again.&ty=danger");
						}
					} else {

						header("location:../forgot?r=Error while Processing Request. Try again.&ty=danger");
					}
				} else {

					$fname = $row_user_details['fname'];

					$get_token = 'token'.get_rand_numbers(20).'';
					$token = md5($get_token);

					$link = ''.$domain.'/reset?token='.$token.'';

					$delete_token = "DELETE FROM tbl_tokens WHERE email = '$email'";
					$delete_token_code = mysqli_query($connection, $delete_token);

					$insert_new_token = "INSERT INTO `tbl_tokens` (email, token) VALUES ('$email', '$token')";
					$insert_new_token_code = mysqli_query($connection, $insert_new_token);

					if ($insert_new_token_code) {
						
						$message = "Hello!! <b>".$fname."</b>, <br>Click <a href='".$link."'>HERE</a> to reset your <b>Finder</b> Account password.";

						$subject = 'Password Reset Message';
						$header = "From: noreply@finder.com \r\n";
						$header .= "Reply-To: noreply@finder.com \r\n";
						$header .= "Content-type: text/html; charset=iso-8859-1\r\n";
						$message_body = "Employer Account Details<hr><br>";
						$message_body .= "Company Name: ".$fname."<br>";
						$message_body .= "Email: ".$email."<br>";
						$message_body .= "Message: ".nl2br($message)."<br>";

						if (mail( $email, $subject, $message_body, $header)) {

							// echo "<script>alert('A Confirmation message has been sent to your mail!');</script>";
							// echo "<script>document.location.href='http://localhost/creativekitten/'</script>";

							header("location:../forgot?r=A link to reset your password was sent to $email &ty=success");
						} else {

							header("location:../forgot?r=Error while sending confirmation link to your mail. Try again.&ty=danger");
						}
					} else {

						header("location:../forgot?r=Error while Processing Request. Try again.&ty=danger");
					}
				}
			}
		}
	} else {
		header("location:../");
	}
?>