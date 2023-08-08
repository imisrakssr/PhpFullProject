<?php include "inc/header.php";?>

			<div role="main" class="main">

				<section class="page-header page-header-modern bg-color-light-scale-1 page-header-lg">
					<div class="container">
						<div class="row">
							<div class="col-md-12 align-self-center p-static order-2 text-center">
								<h1 class="font-weight-bold text-dark">Login</h1>
							</div>
							<div class="col-md-12 align-self-center order-1">
								<ul class="breadcrumb d-block text-center">
									<li><a href="index.php">Home</a></li>
									<li class="active">User Login</li>
								</ul>
							</div>
						</div>
					</div>
				</section>

				<div class="container py-4">

					<div class="row justify-content-center">
						<div class="col-md-6 col-lg-5 mb-5 mb-lg-0">
							<h2 class="font-weight-bold text-5 mb-0">Login</h2>
							<form action="https://www.okler.net/" id="frmSignIn" method="post" class="needs-validation">
								<div class="row">
									<div class="form-group col">
										<label class="form-label text-color-dark text-3">Email address <span class="text-color-danger">*</span></label>
										<input type="text" value="" class="form-control form-control-lg text-4" required>
									</div>
								</div>
								<div class="row">
									<div class="form-group col">
										<label class="form-label text-color-dark text-3">Password <span class="text-color-danger">*</span></label>
										<input type="password" value="" class="form-control form-control-lg text-4" required>
									</div>
								</div>
								<div class="row justify-content-between">
									<div class="form-group col-md-auto">
										<div class="custom-control custom-checkbox">
											<input type="checkbox" class="custom-control-input" id="rememberme">
											<label class="form-label custom-control-label cur-pointer text-2" for="rememberme">Remember Me</label>
										</div>
									</div>
									<div class="form-group col-md-auto">
										<a class="text-decoration-none text-color-dark text-color-hover-primary font-weight-semibold text-2" href="#">Forgot Password?</a>
									</div>
								</div>
								<div class="row">
									<div class="form-group col">
										<button type="submit" class="btn btn-dark btn-modern w-100 text-uppercase rounded-0 font-weight-bold text-3 py-3" data-loading-text="Loading...">Login</button>
									</div>
								</div>
							</form>
						</div>
						<div class="col-md-6 col-lg-5">
							<h2 class="font-weight-bold text-5 mb-0">Register</h2>
							<form action="https://www.okler.net/" id="frmSignUp" method="post">
								<div class="row">
									<div class="form-group col">
										<label class="form-label text-color-dark text-3">Username or email address <span class="text-color-danger">*</span></label>
										<input type="text" value="" class="form-control form-control-lg text-4" required>
									</div>
								</div>
								<div class="row">
									<div class="form-group col">
										<label class="form-label text-color-dark text-3">Password <span class="text-color-danger">*</span></label>
										<input type="password" value="" class="form-control form-control-lg text-4" required>
									</div>
								</div>
								<div class="row">
									<div class="form-group col">
										<p class="text-2 mb-2">Your personal data will be used to support your experience throughout this website, to manage access to your account, and for other purposes described in our <a href="#" class="text-decoration-none">privacy policy.</a></p>
									</div>
								</div>
								<div class="row">
									<div class="form-group col">
										<button type="submit" class="btn btn-dark btn-modern w-100 text-uppercase rounded-0 font-weight-bold text-3 py-3" data-loading-text="Loading...">Register</button>
									</div>
								</div>
							</form>
						</div>
					</div>

				</div>

			</div>

<?php include "inc/footer.php";?>
