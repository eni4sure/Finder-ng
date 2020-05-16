<?php session_start(); ?>
<?php
	if (isset($_POST['upload-cv'])) {
		require('../../php/connect.php');
		require('check_login.php');

		$cv_upload_dir = "../../cv/";
		$cv_info = $_FILES["cv"]["name"];
		$file_extension = strtolower(pathinfo($cv_info, PATHINFO_EXTENSION));

		$target_file = $cv_upload_dir . basename("".$sess_member_no.".".$file_extension."");

		$cv = "".$sess_member_no.".".$file_extension."";

		// Check file size
		if ($_FILES["cv"]["size"] > 500000) {

			header("location:../upload-cv?r=The file is too large to upload&ty=danger");
		} else {

			// Allow certain file formats
			if( $file_extension != "pdf" && $file_extension != "docx" ) {

				header("location:../upload-cv?r=Please Upload format must be a pdf or a microsoft word document&ty=danger");
			} else {
				// if everything is ok, try to upload file
				if (move_uploaded_file($_FILES["cv"]["tmp_name"], $target_file)) {

					$delete_prev_cv = "DELETE FROM tbl_cv WHERE member_no = '$sess_member_no'";
					$delete_prev_cv_code = mysqli_query($connection, $delete_prev_cv);

					$insert_cv = "INSERT INTO `tbl_cv` (member_no, cv_attachment) 
						VALUES ('$sess_member_no', '$cv')";
					$insert_cv_code = mysqli_query($connection, $insert_cv);
					if ($insert_cv_code) {

						header("location:../upload-cv?r=Cv uploaded successfully&ty=success");
					} else {

						header("location:../upload-cv?r=Error while processing Request&ty=danger");
					}
				} else {
					header("location:../upload-cv?r=Error while uploading cv. Try again Later&ty=danger");
				}
			}
		}
	} else {
		header("location:../");
	}
?>