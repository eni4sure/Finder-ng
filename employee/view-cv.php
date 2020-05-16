<?php session_start(); ?>
<!DOCTYPE HTML>
<html lang="en-NG">

<?php include ('php/check_login.php'); ?>

<?php $head_title = 'My CV | Employee | Finder'; ?>
<title><?php echo $head_title ?></title>

<body>
	<?php 
		if (isset($_GET['id'])) {

			require('../php/connect.php');
			require('../includes/http_link.php');

			$cv_owner_id = $_GET['id'];

			$count_cv_owner_id = "SELECT COUNT(*) FROM tbl_cv WHERE member_no = '$cv_owner_id'";
			$count_cv_owner_id_code = mysqli_query($connection, $count_cv_owner_id);
			$count_cv_owner_id_get = mysqli_fetch_array ($count_cv_owner_id_code);
			$count_cv_owner_id_res = array_shift($count_cv_owner_id_get);

			if ($count_cv_owner_id_res == "0") {

				header("location:upload-cv?r=You have not uploaded your cv&ty=danger");
			} else {

				$get_cv_details = "SELECT * FROM tbl_cv WHERE member_no = '$cv_owner_id'";
				$run_cv_details = mysqli_query($connection, $get_cv_details);

				while ($row_cv_details = mysqli_fetch_array($run_cv_details)){
					$cv = $row_cv_details['cv_attachment'];
					$cv_owner_id = $row_cv_details['member_no'];

					$file_extension = strtolower(pathinfo($cv, PATHINFO_EXTENSION));

					if ($file_extension == "pdf") {

						$get_cv_owner_name_pass = "SELECT * FROM `tbl_users` WHERE member_no = '$cv_owner_id'";
						$get_cv_owner_name_pass_code = mysqli_query($connection, $get_cv_owner_name_pass);
						$get_cv_owner_name_pass_res = mysqli_fetch_array ($get_cv_owner_name_pass_code);

						$title = "".$get_cv_owner_name_pass_res['fname']." ".$get_cv_owner_name_pass_res['lname']." CV";
						$cv_path = "$domain/cv/".$cv."";
						?>
						<iframe src="../ViewerJS/?title=<?php echo $title ?>#<?php echo ''.$cv_path.'' ?>" width="100%" height="655px"></iframe>
						<?php
					} else {

						header("location:$domain/cv/$cv");
					}
				}
			}
		} else {
			header("location:./");
		}	
	?>
</body>
</html>