<div class="col-md-3 col-sm-4 col-xs-12">
					<div class="admin-sidebar">
						<div class="admin-user-item for-employer">

							<div class="image">
								<center><img src="<?php if( $sess_comp_image == '') { echo '../employer_img/default.png'; } else { echo '../employer_img/'.$sess_comp_image.'';} ?>" alt="image" style="width: 158px; height: 79px;"></center>
							</div>

							<h4><?php echo $sess_comp_name ?></h4>
							<p class="user-role" style="text-transform: capitalize;"><?php echo $sess_role ?></p>
						</div>

						<div class="admin-user-action text-center">
							<a href="post-job" class="btn btn-primary btn-sm btn-inverse">Post a Job</a>
						</div>

						<ul class="admin-user-menu clearfix" style="list-style: none;">
							<li <?php if( $user_panel_nav == 'profile') { echo 'class="active"'; } else {} ?>>
								<a href="./"><i class="fa fa-user"></i> Profile</a>
							</li>
							<li <?php if( $user_panel_nav == 'change-password') { echo 'class="active"'; } else {} ?>>
								<a href="change-password"><i class="fa fa-key"></i> Change Password</a>
							</li>
							<li <?php if( $user_panel_nav == 'view-overview') { echo 'class="active"'; } else {} ?>>
								<a href="../view-company?view=<?php echo $sess_comp_member_no ?>"><i class="fa fa-briefcase"></i> View Overview</a>
							</li>
							<li <?php if( $user_panel_nav == 'posted-jobs') { echo 'class="active"'; } else {} ?>>
								<a href="posted-jobs"><i class="fa fa-bookmark"></i> Posted Jobs</a>
							</li>
							<li>
								<a href="../logout"><i class="fa fa-sign-out"></i> Logout</a>
							</li>
						</ul>
					</div>
				</div>