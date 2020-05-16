<header class="section-header">
		<nav class="navbar navbar-landing navbar-expand-lg navbar-dark bg-dark">
			<div class="container">
				<a class="navbar-brand mr-auto" href="../"> <img class="logo" src="../logos/logo-white.png"> FINDER</a>
				<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbar1">
					<span class="navbar-toggler-icon"></span>
				</button>
				<div class="collapse navbar-collapse" id="navbar1">
					<ul class="navbar-nav ml-auto">
						<li class="nav-item"><a <?php if( $page_nav == 'home') { echo 'style="color: white;"'; } else {} ?> class="nav-link" href=".././">Home</a></li>
						<li class="nav-item"><a <?php if( $page_nav == 'job') { echo 'style="color: white;"'; } else {} ?> class="nav-link" href="../job_list">Jobs</a></li>
						<li class="nav-item"><a <?php if( $page_nav == 'employers') { echo 'style="color: white;"'; } else {} ?> class="nav-link" href="../employers">Employers</a></li>
						<li class="nav-item"><a <?php if( $page_nav == 'employees') { echo 'style="color: white;"'; } else {} ?> class="nav-link" href="../employees">Employees</a></li>
						<?php
							if ($user_online == true) {
								?>
									<div class="widget-header dropdown">
										<a href="#" class="ml-3 icontext" data-toggle="dropdown" data-offset="20,10">
											<div class="icon-wrap icon-xs bg2 round text-secondary"><i class="fa fa-user"></i></div>
											<div class="text-wrap" style="color: white;">
												<small>Logged in.</small>
												<span>My Account <i class="fa fa-caret-down"></i></span>
											</div>
										</a>
										<div class="dropdown-menu dropdown-menu-right">
											<a class="dropdown-item" href="./">My Profile</a>
											<a class="dropdown-item" href="../logout">Logout</a>
										</div>
									</div>
								<?php
							} else {
								?>
									<div class="widget-header dropdown">
										<a href="#" class="ml-3 icontext" data-toggle="dropdown" data-offset="20,10">
											<div class="icon-wrap icon-xs bg2 round text-secondary"><i class="fa fa-user"></i></div>
											<div class="text-wrap" style="color: white;">
												<small>Hello.</small>
												<span>Login <i class="fa fa-caret-down"></i></span>
											</div>
										</a>
										<div class="dropdown-menu dropdown-menu-right">
											<article class="card-body">
												<h4 class="card-title text-center mb-4 mt-1">Sign in</h4>
												<hr>
												<p class="text-success text-center">Login to Access More Features</p>
												<form action="../php/login_auth" method="POST">
													<div class="form-group">
														<div class="input-group">
															<div class="input-group-prepend">
																<span class="input-group-text"> <i class="fa fa-user"></i> </span>
															 </div>
															<input name="email" required class="form-control" placeholder="E-mail Address" type="email">
														</div>
													</div>
													<div class="form-group">
														<div class="input-group">
															<div class="input-group-prepend">
																<span class="input-group-text"> <i class="fa fa-lock"></i> </span>
															 </div>
															<input name="passkey" required class="form-control" placeholder="********" type="password">
														</div>
													</div>
													<div class="form-group">
														<button type="submit" class="btn btn-primary btn-block" name="login"> Login</button>
													</div>
													<p class="text-center"><a href="#" class="btn"><small>Forgot password?</small></a></p>
													<p class="text-center"><a href="../sign-up" class="btn"><small>Dont have an Account? Sign up</small></a></p>
												</form>
											</article>
										</div>
									</div>
								<?php
							}
						?>
					</ul>
				</div>
			</div>
		</nav>
	</header>