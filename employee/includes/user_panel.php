<div class="col-md-3 col-sm-4 col-xs-12">
					<div class="admin-sidebar">
						<div class="admin-user-item">

							<div class="image">
								<center><img class="img-circle autofit2" src="<?php if( $sess_image == '') { echo '../employee_img/default.png'; } else { echo '../employee_img/'.$sess_image.'';} ?>" alt="image"></center>
							</div>
							<br>
							<h4><?php echo $sess_fname ?> <?php echo $sess_lname ?></h4>
							<p class="user-role" style="text-transform: capitalize;"><?php echo $sess_role ?></p>
						</div>

						<div class="admin-user-action text-center">
							<a target="_blank" href="view-cv?id=<?php echo $sess_member_no ?>" class="btn btn-primary btn-sm btn-inverse">View my CV</a>
						</div>

						<ul class="admin-user-menu clearfix" style="list-style: none;">
							<li <?php if( $user_panel_nav == 'profile') { echo 'class="active"'; } else {} ?>>
								<a href="./"><i class="fa fa-user"></i> Profile</a>
							</li>
							<li <?php if( $user_panel_nav == 'change-password') { echo 'class="active"'; } else {} ?>>
								<a href="change-password"><i class="fa fa-key"></i> Change Password</a>
							</li>
							<li <?php if( $user_panel_nav == 'upload-cv') { echo 'class="active"'; } else {} ?>>
								<a href="upload-cv"><i class="fa fa-briefcase"></i> Upload CV</a>
							</li>
							<li <?php if( $user_panel_nav == 'applied-jobs') { echo 'class="active"'; } else {} ?>>
								<a href="applied-jobs"><i class="fa fa-bookmark"></i> Applied Jobs</a>
							</li>
							<!-- <li <?php // if( $user_panel_nav == 'my-alert') { echo 'class="active"'; } else {} ?>>
								<a href="my-alert"><i class="fa fa-bell"></i> My Alert</a>
							</li> -->
							<li>
								<a href="../logout"><i class="fa fa-sign-out"></i> Logout</a>
							</li>
						</ul>
					</div>
				</div>