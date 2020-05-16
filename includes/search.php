<!-- ========================= SECTION SEARCH ========================= -->
	<section class="header-main shadow" style="padding-top: 5em !important;">
		<div class="container">
			<div class="row align-items-center">
				<div class="col-lg-3 col-sm-2"></div>
				<div class="col-lg-6 col-sm-8">
					<form action="search" class="search-wrap" method="GET">
						<div class="input-group w-100">
							<input type="text" name="key" class="form-control" style="width:55%;" placeholder="Search..." required>
							<select class="custom-select" name="cat">
								<option <?php if( $search_nav == 'JB') { echo 'selected'; } else {} ?> value="JB"> Jobs </option>
								<option <?php if( $search_nav == 'CM') { echo 'selected'; } else {} ?> value="CM"> Employers </option>
								<option <?php if( $search_nav == 'EM') { echo 'selected'; } else {} ?> value="EM"> Employees </option>
							</select>
							<div class="input-group-append">
								<button class="btn btn-primary" type="submit">
									<i class="fa fa-search"></i>
								</button>
							</div>
						</div>
					</form>
				</div>
				<div class="col-lg-3 col-sm-2"></div>
			</div>
		</div>
	</section>
	<!-- ========================= SECTION SEARCH END// ========================= -->