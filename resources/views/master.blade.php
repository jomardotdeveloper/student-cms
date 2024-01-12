<!DOCTYPE html>
<html lang="en" data-layout="vertical" data-topbar="light" data-sidebar="dark"  data-sidebar-size="lg" data-sidebar-image="none">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="Smarthr - Bootstrap Admin Template">
		<meta name="keywords" content="admin, estimates, bootstrap, business, corporate, creative, management, minimal, modern, accounts, invoice, html5, responsive, CRM, Projects">
        <meta name="author" content="Dreamguys - Bootstrap Admin Template">
        <title>Student Concerns Management System</title>

		<!-- Favicon -->
        <link rel="shortcut icon" type="image/x-icon" href="{{ asset('assets/img/favicon.png') }}">

        <!-- Bootstrap CSS -->
        <link rel="stylesheet" href="{{ asset('assets/css/bootstrap.min.css') }}">

        <!-- Fontawesome CSS -->
        <link rel="stylesheet" href="{{ asset('assets/plugins/fontawesome/css/fontawesome.min.css') }}">
        <link rel="stylesheet" href="{{ asset('assets/plugins/fontawesome/css/all.min.css') }}">

        <!-- Lineawesome CSS -->
        <link rel="stylesheet" href="{{ asset('assets/css/line-awesome.min.css') }}">
        <link rel="stylesheet" href="{{ asset('assets/css/material.css') }}">

        <!-- Chart CSS -->
        <link rel="stylesheet" href="{{ asset('assets/plugins/morris/morris.css') }}">
        <link rel="stylesheet" href="{{ asset('assets/css/dataTables.bootstrap4.min.css') }}">
        <!-- Main CSS -->
        <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
        <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
        <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js" defer></script>

    </head>

    <body>
		<!-- Main Wrapper -->
        <div class="main-wrapper">

			<!-- Header -->
            <div class="header">

				<!-- Logo -->
                <div class="header-left">
                     <a href="#" class="logo">
						<img src="{{ asset("assets/img/logo.png") }}" width="40" height="40" alt="Logo">
					</a>
					<a href="#" class="logo2">
						<img src="{{ asset('assets/img/logo2.png') }}" width="40" height="40" alt="Logo">
					</a>
                </div>
            <!-- /Logo -->

				<a id="toggle_btn" href="javascript:void(0);">
					<span class="bar-icon">
						<span></span>
						<span></span>
						<span></span>
					</span>
				</a>

				<a id="mobile_btn" class="mobile_btn" href="#sidebar"><i class="fa-solid fa-bars"></i></a>

				<!-- Header Menu -->
				<ul class="nav user-menu">
					<li class="nav-item dropdown has-arrow main-drop">
						<a href="#" class="dropdown-toggle nav-link" data-bs-toggle="dropdown">
							<span class="user-img"><img src="{{ asset('avatar.png') }}" alt="User Image">
							<span class="status online"></span></span>
							<span>{{ auth()->user()->contact->full_name }}</span>
						</a>
						<div class="dropdown-menu">
							<a class="dropdown-item" href="{{ route('profile') }}">My Profile</a>

							<a class="dropdown-item" href="{{ route('change-password') }}">Change Password</a>
							<a class="dropdown-item" href="javascript:void(0);" onclick="logout()">Logout</a>
						</div>
					</li>
				</ul>
                <form method="POST" action="{{ route('logout') }}" id="logoutForm">
                    @csrf
                    {{-- <input type="hidden" name="logout" value="1"> --}}
                </form>
				<!-- /Header Menu -->

				<!-- Mobile Menu -->
				<div class="dropdown mobile-user-menu">
					<a href="#" class="nav-link dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false"><i class="fa-solid fa-ellipsis-vertical"></i></a>
					<div class="dropdown-menu dropdown-menu-right">
						<a class="dropdown-item" href="profile.html">My Profile</a>
						<a class="dropdown-item" href="settings.html">Settings</a>
						<a class="dropdown-item" href="index.html">Logout</a>
					</div>
				</div>
				<!-- /Mobile Menu -->

            </div>
			<!-- /Header -->

			<!-- Sidebar -->
			<div class="sidebar" id="sidebar">
				<div class="sidebar-inner slimscroll">
					<div id="sidebar-menu" class="sidebar-menu">
						<nav class="greedys sidebar-horizantal">
							<ul class="list-inline-item list-unstyled links">
								<li class="menu-title">
									<span>Main</span>
								</li>
								<li class="submenu">
									<a href="#"><i class="la la-dashboard"></i> <span> Dashboard</span> <span class="menu-arrow"></span></a>
									<ul>
										<li><a  href="admin-dashboard.html">Admin Dashboard</a></li>
										<li><a  href="employee-dashboard.html">Employee Dashboard</a></li>
									</ul>
								</li>
								<li class="submenu">
									<a href="#"><i class="la la-cube"></i> <span> Apps</span> <span class="menu-arrow"></span></a>
									<ul>
										<li><a href="chat.html">Chat</a></li>
										<li class="submenu">
											<a href="#"><span> Calls</span> <span class="menu-arrow"></span></a>
											<ul>
												<li><a href="voice-call.html">Voice Call</a></li>
												<li><a href="video-call.html">Video Call</a></li>
												<li><a href="outgoing-call.html">Outgoing Call</a></li>
												<li><a href="incoming-call.html">Incoming Call</a></li>
											</ul>
										</li>
										<li><a href="events.html">Calendar</a></li>
										<li><a href="contacts.html">Contacts</a></li>
										<li><a href="inbox.html">Email</a></li>
										<li><a href="file-manager.html">File Manager</a></li>
									</ul>
								</li>
								<li class="menu-title">
									<span>Employees</span>
								</li>
								<li class="submenu">
									<a href="#" class="noti-dot"><i class="la la-user"></i> <span> Employees</span> <span class="menu-arrow"></span></a>
									<ul>
										<li><a href="employees.html">All Employees</a></li>
										<li><a href="holidays.html">Holidays</a></li>
										<li><a href="leaves.html">Leaves (Admin) <span class="badge rounded-pill bg-primary float-end">1</span></a></li>
										<li><a href="leaves-employee.html">Leaves (Employee)</a></li>
										<li><a href="leave-settings.html">Leave Settings</a></li>
										<li><a href="attendance.html">Attendance (Admin)</a></li>
										<li><a href="attendance-employee.html">Attendance (Employee)</a></li>
										<li><a href="departments.html">Departments</a></li>
										<li><a href="designations.html">Designations</a></li>
										<li><a href="timesheet.html">Timesheet</a></li>
										<li><a href="shift-scheduling.html">Shift & Schedule</a></li>
										<li><a href="overtime.html">Overtime</a></li>
									</ul>
								</li>
								<li>
									<a href="clients.html"><i class="la la-users"></i> <span>Clients</span></a>
								</li>
								<li class="submenu">
									<a href="#"><i class="la la-rocket"></i> <span> Projects</span> <span class="menu-arrow"></span></a>
									<ul>
										<li><a href="projects.html">Projects</a></li>
										<li><a href="tasks.html">Tasks</a></li>
										<li><a href="task-board.html">Task Board</a></li>
									</ul>
								</li>
								<li>
									<a href="leads.html"><i class="la la-user-secret"></i> <span>Leads</span></a>
								</li>
								<li>
									<a href="tickets.html"><i class="la la-ticket"></i> <span>Tickets</span></a>
								</li>
								<li class="menu-title">
									<span>HR</span>
								</li>
								<li class="submenu">
									<a href="#"><i class="la la-files-o"></i> <span> Sales </span> <span class="menu-arrow"></span></a>
									<ul>
										<li><a href="estimates.html">Estimates</a></li>
										<li><a href="invoices.html">Invoices</a></li>
										<li><a href="payments.html">Payments</a></li>
										<li><a href="expenses.html">Expenses</a></li>
										<li><a href="provident-fund.html">Provident Fund</a></li>
										<li><a href="taxes.html">Taxes</a></li>
									</ul>
								</li>
							</ul>
							<button class="viewmoremenu">More Menu</button>
							<ul class="hidden-links hidden">
								<li class="submenu">
									<a href="#"><i class="la la-files-o"></i> <span> Accounting </span> <span class="menu-arrow"></span></a>
									<ul>
										<li><a href="categories.html">Categories</a></li>
										<li><a href="budgets.html">Budgets</a></li>
										<li><a href="budget-expenses.html">Budget Expenses</a></li>
										<li><a href="budget-revenues.html">Budget Revenues</a></li>
									</ul>
								</li>
								<li class="submenu">
									<a href="#"><i class="la la-money"></i> <span> Payroll </span> <span class="menu-arrow"></span></a>
									<ul>
										<li><a href="salary.html"> Employee Salary </a></li>
										<li><a href="salary-view.html"> Payslip </a></li>
										<li><a href="payroll-items.html"> Payroll Items </a></li>
									</ul>
								</li>
								<li>
									<a href="policies.html"><i class="la la-file-pdf-o"></i> <span>Policies</span></a>
								</li>
								<li class="submenu">
									<a href="#"><i class="la la-pie-chart"></i> <span> Reports </span> <span class="menu-arrow"></span></a>
									<ul>
										<li><a href="expense-reports.html"> Expense Report </a></li>
										<li><a href="invoice-reports.html"> Invoice Report </a></li>
										<li><a href="payments-reports.html"> Payments Report </a></li>
										<li><a href="project-reports.html"> Project Report </a></li>
										<li><a href="task-reports.html"> Task Report </a></li>
										<li><a href="user-reports.html"> User Report </a></li>
										<li><a href="employee-reports.html"> Employee Report </a></li>
										<li><a href="payslip-reports.html"> Payslip Report </a></li>
										<li><a href="attendance-reports.html"> Attendance Report </a></li>
										<li><a href="leave-reports.html"> Leave Report </a></li>
										<li><a href="daily-reports.html"> Daily Report </a></li>
									</ul>
								</li>
								<li class="menu-title">
									<span>Performance</span>
								</li>
								<li class="submenu">
									<a href="#"><i class="la la-graduation-cap"></i> <span> Performance </span> <span class="menu-arrow"></span></a>
									<ul>
										<li><a href="performance-indicator.html"> Performance Indicator </a></li>
										<li><a href="performance.html"> Performance Review </a></li>
										<li><a href="performance-appraisal.html"> Performance Appraisal </a></li>
									</ul>
								</li>
								<li class="submenu">
									<a href="#"><i class="la la-crosshairs"></i> <span> Goals </span> <span class="menu-arrow"></span></a>
									<ul>
										<li><a href="goal-tracking.html"> Goal List </a></li>
										<li><a href="goal-type.html"> Goal Type </a></li>
									</ul>
								</li>
								<li class="submenu">
									<a href="#"><i class="la la-edit"></i> <span> Training </span> <span class="menu-arrow"></span></a>
									<ul>
										<li><a href="training.html"> Training List </a></li>
										<li><a href="trainers.html"> Trainers</a></li>
										<li><a href="training-type.html"> Training Type </a></li>
									</ul>
								</li>
								<li><a href="promotion.html"><i class="la la-bullhorn"></i> <span>Promotion</span></a></li>
								<li><a href="resignation.html"><i class="la la-external-link-square"></i> <span>Resignation</span></a></li>
								<li><a href="termination.html"><i class="la la-times-circle"></i> <span>Termination</span></a></li>
								<li class="menu-title">
									<span>Administration</span>
								</li>
								<li>
									<a href="assets.html"><i class="la la-object-ungroup"></i> <span>Assets</span></a>
								</li>
								<li class="submenu">
									<a href="#"><i class="la la-briefcase"></i> <span> Jobs </span> <span class="menu-arrow"></span></a>
									<ul>
										<li><a href="user-dashboard.html"> User Dasboard </a></li>
										<li><a href="jobs-dashboard.html"> Jobs Dasboard </a></li>
										<li><a href="jobs.html"> Manage Jobs </a></li>
										<li><a href="manage-resumes.html"> Manage Resumes </a></li>
										<li><a href="shortlist-candidates.html"> Shortlist Candidates </a></li>
										<li><a href="interview-questions.html"> Interview Questions </a></li>
										<li><a href="offer_approvals.html"> Offer Approvals </a></li>
										<li><a href="experiance-level.html"> Experience Level </a></li>
										<li><a href="candidates.html"> Candidates List </a></li>
										<li><a href="schedule-timing.html"> Schedule timing </a></li>
										<li><a href="apptitude-result.html"> Aptitude Results </a></li>
									</ul>
								</li>
								<li>
									<a href="knowledgebase.html"><i class="la la-question"></i> <span>Knowledgebase</span></a>
								</li>
								<li>
									<a href="activities.html"><i class="la la-bell"></i> <span>Activities</span></a>
								</li>
								<li>
									<a href="users.html"><i class="la la-user-plus"></i> <span>Users</span></a>
								</li>
								<li>
									<a href="settings.html"><i class="la la-cog"></i> <span>Settings</span></a>
								</li>
								<li class="menu-title">
									<span>Pages</span>
								</li>
								<li class="submenu">
									<a href="#"><i class="la la-user"></i> <span> Profile </span> <span class="menu-arrow"></span></a>
									<ul>
										<li><a href="profile.html"> Employee Profile </a></li>
										<li><a href="client-profile.html"> Client Profile </a></li>
									</ul>
								</li>
								<li class="submenu">
									<a href="#"><i class="la la-key"></i> <span> Authentication </span> <span class="menu-arrow"></span></a>
									<ul>
										<li><a href="index.html"> Login </a></li>
										<li><a href="register.html"> Register </a></li>
										<li><a href="forgot-password.html"> Forgot Password </a></li>
										<li><a href="otp.html"> OTP </a></li>
										<li><a href="lock-screen.html"> Lock Screen </a></li>
									</ul>
								</li>
								<li class="submenu">
									<a href="#"><i class="la la-exclamation-triangle"></i> <span> Error Pages </span> <span class="menu-arrow"></span></a>
									<ul>
										<li><a href="error-404.html">404 Error </a></li>
										<li><a href="error-500.html">500 Error </a></li>
									</ul>
								</li>
								<li class="submenu">
									<a href="#"><i class="la la-hand-o-up"></i> <span> Subscriptions </span> <span class="menu-arrow"></span></a>
									<ul>
										<li><a href="subscriptions.html"> Subscriptions (Admin) </a></li>
										<li><a href="subscriptions-company.html"> Subscriptions (Company) </a></li>
										<li><a href="subscribed-companies.html"> Subscribed Companies</a></li>
									</ul>
								</li>
								<li class="submenu">
									<a href="#"><i class="la la-columns"></i> <span> Pages </span> <span class="menu-arrow"></span></a>
									<ul>
										<li><a href="search.html"> Search </a></li>
										<li><a href="faq.html"> FAQ </a></li>
										<li><a href="terms.html"> Terms </a></li>
										<li><a href="privacy-policy.html"> Privacy Policy </a></li>
										<li><a href="blank-page.html"> Blank Page </a></li>
									</ul>
								</li>
								<li class="menu-title">
									<span>UI Interface</span>
								</li>
								<li>
									<a href="components.html"><i class="la la-puzzle-piece"></i> <span>Components</span></a>
								</li>
								<li class="submenu">
									<a href="#"><i class="la la-object-group"></i> <span> Forms </span> <span class="menu-arrow"></span></a>
									<ul>
										<li><a href="form-basic-inputs.html">Basic Inputs </a></li>
										<li><a href="form-input-groups.html">Input Groups </a></li>
										<li><a href="form-horizontal.html">Horizontal Form </a></li>
										<li><a href="form-vertical.html"> Vertical Form </a></li>
										<li><a href="form-mask.html"> Form Mask </a></li>
										<li><a href="form-validation.html"> Form Validation </a></li>
									</ul>
								</li>
								<li class="submenu">
									<a href="#"><i class="la la-table"></i> <span> Tables </span> <span class="menu-arrow"></span></a>
									<ul>
										<li><a href="tables-basic.html">Basic Tables </a></li>
										<li><a href="data-tables.html">Data Table </a></li>
									</ul>
								</li>
								<li class="menu-title">
									<span>Extras</span>
								</li>
								<li>
									<a href="#"><i class="la la-file-text"></i> <span>Documentation</span></a>
								</li>
								<li>
									<a href="javascript:void(0);"><i class="la la-info"></i> <span>Change Log</span> <span class="badge badge-primary ms-auto">v3.4</span></a>
								</li>
								<li class="submenu">
									<a href="javascript:void(0);"><i class="la la-share-alt"></i> <span>Multi Level</span> <span class="menu-arrow"></span></a>
									<ul>
										<li class="submenu">
											<a href="javascript:void(0);"> <span>Level 1</span> <span class="menu-arrow"></span></a>
											<ul>
												<li><a href="javascript:void(0);"><span>Level 2</span></a></li>
												<li class="submenu">
													<a href="javascript:void(0);"> <span> Level 2</span> <span class="menu-arrow"></span></a>
													<ul>
														<li><a href="javascript:void(0);">Level 3</a></li>
														<li><a href="javascript:void(0);">Level 3</a></li>
													</ul>
												</li>
												<li><a href="javascript:void(0);"> <span>Level 2</span></a></li>
											</ul>
										</li>
										<li>
											<a href="javascript:void(0);"> <span>Level 1</span></a>
										</li>
									</ul>
								</li>
							</ul>
						</nav>
						<ul class="sidebar-vertical">
							<li class="menu-title">
								<span>Main</span>
							</li>
                            {{-- ADMIN MENUS --}}
                            @if (auth()->user()->contact->role->has_dashboard_access)
                            <li class="{{

                                Route::current()->getName() == 'dashboard' ? 'active' : ''
                            }}">
								<a href="{{ route('dashboard') }}"><i class="la la-dashboard"></i> <span>Dashboard</span></a>
							</li>

                            @endif
                            @if (auth()->user()->contact->role->access_to_message)
                            <li class="{{
                                Route::current()->getName() == 'emails.index' ? 'active' : ''
                            }}">
								<a href="{{ route('emails.index') }}"><i class="lab la-rocketchat"></i> <span>Messages <span class="badge bg-inverse-success">{{
                                    auth()->user()->unread_messages
                                }} </span></span></a>
							</li>
                            @endif

                            @if (auth()->user()->contact->role->has_roles_access)
                            <li class="{{

                                Route::current()->getName() == 'roles.index' ? 'active' : ''
                            }}">
								<a href="{{ route('roles.index') }}"><i class="la la-user"></i> <span>Roles</span></a>
							</li>
                            @endif

                            @if (auth()->user()->contact->role->has_students_access)
                            <li class="{{
                                Route::current()->getName() == 'students.index' ? 'active' : ''

                            }}">
								<a href="{{ route('students.index') }}"><i class="la la-users"></i> <span>Students</span></a>
							</li>
                            @endif

                            @if (auth()->user()->contact->role->has_committees_access)
                            <li class="{{
                                Route::current()->getName() == 'committees.index' ? 'active' : ''


                            }}">
								<a href="{{ route('committees.index') }}"><i class="la la-briefcase"></i> <span>Committees</span></a>
							</li>

                            <li class="{{
                                Route::current()->getName() == 'imports.index' ? 'active' : ''


                            }}">
								<a href="{{ route('imports.index') }}"><i class="la la-file-csv"></i> <span>Import Data</span></a>
							</li>


                            @endif

                            @if (auth()->user()->contact->role->has_registration_requests_access)
                            <li class="{{
                                Route::current()->getName() == 'contacts.index' ? 'active' : ''

                            }}">
								<a href="{{ route('contacts.index') }}"><i class="la la-file-text"></i> <span>Registration Requests</span></a>
							</li>
                            @endif

                            @if (auth()->user()->contact->role->has_pinboard_access)
                            <li class="{{
                                Route::current()->getName() == 'announcement_categories.index' ? 'active' : ''

                            }}">
								<a href="{{ route('announcement_categories.index') }}"><i class="la la-bell"></i> <span>Pinboard Categories</span></a>
							</li>
                            <li class="{{
                                Route::current()->getName() == 'announcements.index' ? 'active' : ''

                            }}" >
								<a href="{{ route('announcements.index') }}"><i class="la la-bell"></i> <span>Pinboard</span></a>
							</li>
                            @endif


                            @if (auth()->user()->contact->role->has_complaints_access)
                            <li class="{{
                                Route::current()->getName() == 'grievances.index' ? 'active' : ''

                            }}">
								<a href="{{ route('grievances.index')}}"><i class="la la-object-group"></i> <span>Grievances</span></a>
							</li>
                            @endif

                            @if (auth()->user()->contact->role->has_stats_access)
                            <li class="{{
                                Route::current()->getName() == 'stats.index' ? 'active' : ''

                            }}">
								<a href="{{ route('stats.index') }}"><i class="la la-puzzle-piece"></i> <span>Stats</span></a>
							</li>
                            @endif

                            @if (auth()->user()->contact->role->has_suggestion_category_access)
                            <li class="{{
                                Route::current()->getName() == 'suggestion_categories.index' ? 'active' : ''

                            }}">
								<a href="{{ route('suggestion_categories.index') }}"><i class="la la-file-pdf-o"></i> <span>Suggestion Category</span></a>
							</li>
                            @endif

                            @if (auth()->user()->contact->role->has_suggestion_access)

                            <li class="{{
                                Route::current()->getName() == 'suggestions.index' ? 'active' : ''

                            }}">
								<a href="{{ route('suggestions.index') }}"><i class="la la-file-pdf-o"></i> <span>Suggestions</span></a>
							</li>
                            @endif

                            <li class="{{
                                Route::current()->getName() == 'policies.index' ? 'active' : ''

                            }}">
								<a href="{{ route('policies.index') }}"><i class="la la-file"></i> <span>Policies</span></a>
							</li>

						</ul>

					</div>
				</div>
			</div>

			<!-- /Sidebar -->

			<!-- Two Col Sidebar -->


			<!-- Page Wrapper -->
            <div class="page-wrapper">

				<!-- Page Content -->
                <div class="content container-fluid">

					<!-- Page Header -->
					<div class="page-header">
						<div class="row">
							<div class="col-sm-12">
								{{-- <h3 class="page-title">Welcome Admin!</h3>
								<ul class="breadcrumb">
									<li class="breadcrumb-item active">Dashboard</li>
								</ul> --}}
							</div>
						</div>
					</div>
					<!-- /Page Header -->
                    @yield('content')
				</div>
				<!-- /Page Content -->

            </div>
			<!-- /Page Wrapper -->


        </div>
		<!-- /Main Wrapper -->
		<!-- jQuery -->
        <script>
            function logout() {
                document.getElementById('logoutForm').submit();
            }
        </script>
        <script src="{{ asset('assets/js/jquery-3.7.0.min.js') }}"></script>

        <!-- Bootstrap Core JS -->
        <script src="{{ asset('assets/js/bootstrap.bundle.min.js') }}"></script>

        <!-- Slimscroll JS -->
        <script src="{{ asset('assets/js/jquery.slimscroll.min.js') }}"></script>

        <!-- Chart JS -->
        <script src="{{ asset('assets/plugins/morris/morris.min.js') }}"></script>
        <script src="{{ asset('assets/plugins/raphael/raphael.min.js') }}"></script>
        <script src="{{ asset('assets/js/chart.js') }}"></script>
        <script src="{{ asset('assets/js/greedynav.js') }}"></script>

        <!-- Theme Settings JS -->
        <script src="{{ asset('assets/js/layout.js') }}"></script>
        <script src="{{ asset('assets/js/theme-settings.js') }}"></script>

        <!-- Custom JS -->
        <script src="{{ asset('assets/js/app.js') }}"></script>
        <script src="{{ asset('assets/js/jquery.dataTables.min.js') }}"></script>
        <script src="{{ asset('assets/js/dataTables.bootstrap4.min.js') }}"></script>
        <script>
            $(document).ready(function() {
                $('.select-multiple').select2();
                $('.select-multiple-tags').select2({tags: true});
            });

        </script>

        @stack('scripts')

    </body>
</html>
