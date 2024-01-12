<!DOCTYPE html>
<html lang="en" data-layout="vertical" data-topbar="light" data-sidebar="dark" data-sidebar-size="lg" data-sidebar-image="none">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="Smarthr - Bootstrap Admin Template">
		<meta name="keywords" content="admin, estimates, bootstrap, business, corporate, creative, management, minimal, modern, accounts, invoice, html5, responsive, CRM, Projects">
        <meta name="author" content="Dreamguys - Bootstrap Admin Template">
        <title>Student Concerns Management System</title>

		<!-- Favicon -->
        <link rel="shortcut icon" type="image/x-icon" href="MYLOGO.png">

		<!-- Bootstrap CSS -->
        <link rel="stylesheet" href="assets/css/bootstrap.min.css">

		<!-- Main CSS -->
        <link rel="stylesheet" href="assets/css/style.css">


    </head>
    <body class="account-page">

		<!-- Main Wrapper -->
        <div class="main-wrapper">
			<div class="account-content">
				<div class="container">

					<!-- Account Logo -->
					<div class="account-logo">
						<a href="admin-dashboard.html"><img src="MYLOGO.png" alt="Dreamguy's Technologies"></a>
					</div>
					<!-- /Account Logo -->

					<div class="account-box">
						<div class="account-wrapper">
							<h3 class="account-title">Register</h3>
							<p class="account-subtitle">Access to our dashboard</p>
                            @if($errors->any())
                            <div class="alert alert-danger alert-dismissible fade show" role="alert">
								<ul>
                                    @foreach($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
								<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
								</button>
							</div>

                            @endif
							<!-- Account Form -->
							<form action="{{ route('register.store') }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="input-block mb-4">
									<label class="col-form-label">Student #<span class="mandatory">*</span></label>
									<input class="form-control" type="text" name="student_number" required>
								</div>
                                <div class="input-block mb-4">
									<label class="col-form-label">First Name<span class="mandatory">*</span></label>
									<input class="form-control" type="text" name="first_name" required>
								</div>
                                <div class="input-block mb-4">
									<label class="col-form-label">Last Name<span class="mandatory">*</span></label>
									<input class="form-control" type="text" name="last_name" required>
								</div>
                                <div class="input-block mb-4">
									<label class="col-form-label">Middle Name</label>
									<input class="form-control" type="text" name="middle_name">
								</div>
                                <div class="input-block mb-4">
									<label class="col-form-label">Personal Email</label>
									<input class="form-control" type="text" name="personal_email">
								</div>
                                <div class="input-block mb-4">
									<label class="col-form-label">Contact #</label>
									<input class="form-control" type="text" name="contact_number">
								</div>
                                <div class="input-block mb-4">
									<label class="col-form-label">Course<span class="mandatory">*</span></label>
                                    <select name="college" class="form-control" required>
                                        <option value="BS ChE">Bachelor of Science in Chemical Engineering - BS ChE</option>
                                        <option value="BS CE">Bachelor of Science in Civil Engineering - BS CE</option>
                                        <option value="BS CpE">Bachelor of Science in Computer Engineering - BS CpE</option>
                                        <option value="BS CS">Bachelor of Science in Computer Science - BS CS</option>
                                        <option value="BS EE">Bachelor of Science in Electrical Engineering - BS EE</option>
                                        <option value="BS ECE">Bachelor of Science in Electronics Engineering - BS ECE</option>
                                        <option value="BS IT">Bachelor of Science in Information Technology - BS IT</option>
                                        <option value="BS MfE">Bachelor of Science in Manufacturing Engineering - BS MfE</option>
                                        <option value="BS ME">Bachelor of Science in Mechanical Engineering - BS ME</option>
                                    </select>

								</div>
                                <div class="input-block mb-4">
									<label class="col-form-label">Gender<span class="mandatory">*</span></label>
									<select name="gender" id="gender" class="form-control" required>
                                        <option value="Male">Male</option>
                                        <option value="Female">Female</option>
                                    </select>
								</div>
                                <div class="input-block mb-4">
									<label class="col-form-label">Civil Status<span class="mandatory">*</span></label>
									<select name="civil_status" id="civil_status" class="form-control" required>
                                        <option value="Single">Single</option>
                                        <option value="Married">Married</option>
                                        <option value="Widowed">Widowed</option>
                                    </select>
								</div>
								<div class="input-block mb-4">
									<label class="col-form-label">Email<span class="mandatory">*</span></label>
									<input class="form-control" type="text" name="email" required>
								</div>
								<div class="input-block mb-4">
									<label class="col-form-label">Password<span class="mandatory">*</span></label>
									<input class="form-control" type="password" name="password" required>
								</div>
								<div class="input-block mb-4">
									<label class="col-form-label">Repeat Password<span class="mandatory">*</span></label>
									<input class="form-control" type="password" name="password_confirmation" required>
								</div>
                                <div class="input-block mb-4">
									<label class="col-form-label">Enrollment Form<span class="mandatory">*</span></label>
									<input class="form-control" type="file" name="enrollment_form" required>
								</div>
								<div class="input-block mb-4 text-center">
									<button class="btn btn-primary account-btn" type="submit">Register</button>
								</div>
								<div class="account-footer">
									<p>Already have an account? <a href="{{ route('login') }}">Login</a></p>
								</div>
							</form>
							<!-- /Account Form -->
						</div>
					</div>
				</div>
			</div>
        </div>
		<!-- /Main Wrapper -->

		<!-- jQuery -->
       <script src="assets/js/jquery-3.7.0.min.js"></script>

		<!-- Bootstrap Core JS -->
        <script src="assets/js/bootstrap.bundle.min.js"></script>

		<!-- Custom JS -->
		<script src="assets/js/app.js"></script>

    </body>
</html>
