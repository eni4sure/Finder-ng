<?php session_start(); ?>
<?php
	if (isset($_POST['upload-img'])) {
		require('../../php/connect.php');
		require('check_login.php');

		$img_upload_dir = "../../employee_img/";
		$img_info = $_FILES["image"]["name"];
		$file_extension = strtolower(pathinfo($img_info, PATHINFO_EXTENSION));

		$target_file = $img_upload_dir . basename("".$sess_member_no.".".$file_extension."");

		$image = "".$sess_member_no.".".$file_extension."";

		// Check file size
		if ($_FILES["image"]["size"] > 500000) {

			header("location:../?r=The image is too large to upload&ty=danger");
		} else {

			// Allow certain file formats
			if( $file_extension != "jpg" && $file_extension != "png" && $file_extension != "jpeg" ) {

				header("location:../?r=Error. image must be jpg, png or jpeg format&ty=danger");
			} else {
				// if everything is ok, try to upload file
				if (move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)) {

					$update_img = "UPDATE tbl_users SET image = '$image' WHERE member_no = '$sess_member_no'";
					$update_img_con = mysqli_query($connection, $update_img);

					if ($update_img_con) {
						$get_image_details = "SELECT image FROM tbl_users WHERE member_no = '$sess_member_no'";
						$run_image_details = mysqli_query($connection, $get_image_details);

						while ($row_image_details = mysqli_fetch_array($run_image_details)){

							$_SESSION['image'] 	= $row_image_details['image'];
							header("location:../?r=image upload successful&ty=success");
						}
					} else {
						header("location:../?r=Error while processing request&ty=danger");
					}

					// $delete_prev_cv = "DELETE FROM tbl_cv WHERE member_no = '$sess_member_no'";
					// $delete_prev_cv_code = mysqli_query($connection, $delete_prev_cv);

					// $insert_cv = "INSERT INTO `tbl_cv` (member_no, cv_attachment) 
					// 	VALUES ('$sess_member_no', '$cv')";
					// $insert_cv_code = mysqli_query($connection, $insert_cv);
					// if ($insert_cv_code) {

					// 	header("location:../?r=Image uploaded successfully&ty=success");
					// } else {

					// 	header("location:../?r=Error while processing Request&ty=danger");
					// }
				} else {
					header("location:../?r=Error while uploading image. Try again Later&ty=danger");
				}
			}
		}
	} else {
		header("location:../");
	}
?>