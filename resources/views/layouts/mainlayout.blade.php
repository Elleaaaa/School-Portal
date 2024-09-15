<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0">
    <title>Dashboard</title>
    <link rel="shortcut icon" href="{{ asset('img/favicon.png') }}">
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,500;0,600;0,700;1,400&amp;display=swap">
    <link rel="stylesheet" href="{{ asset('plugins/bootstrap/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/fontawesome/css/fontawesome.min.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/fontawesome/css/all.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">

    <script src="https://cdn.jsdelivr.net/npm/darkmode-js@1.5.7/lib/darkmode-js.min.js"></script>

    {{-- use for the toast --}}
    @notifyCss
    <style>
        .notify {
            z-index: 9999;
        }
        
        body.darkmode {
            background-color: #333333 !important;  /* Customize your dark background */
            color: #e0e0e0 !important;  /* Customize text color */
        }

        header.darkmode {
            background-color: #333333 !important; /* Change header background in dark mode */
        }

        footer.darkmode {
            background-color: #444444 !important; /* Change footer background in dark mode */
        }

        .darkmode-layer, .darkmode-toggle {
            z-index: 9999 !important; /* Apply a higher z-index */
        }

    </style>

    <meta name="csrf-token" content="{{ csrf_token() }}">

</head>

<body>
    <x-notify::notify />
    <div class="header">
        <div class="header-left">
            @if (Auth::user()->usertype == 'superadmin')
                <a href="{{ route('supadmin-dashboard.show', ['supAdminId' => Auth::user()->studentId]) }}" class="logo">
                    <img src="{{ asset('img/LICEO.png') }}" alt="Logo">
                </a>
                <a href="{{ route('supadmin-dashboard.show', ['supAdminId' => Auth::user()->studentId]) }}"
                    class="logo logo-small">
                    <img src="{{ asset('img/Liceo-sm.png') }}" alt="Logo" width="30" height="30">
                </a>
            @endif
            @if (Auth::user()->usertype == 'cashier')
                <a href="{{ route('cashier-dashboard.show', ['cashierId' => Auth::user()->studentId]) }}" class="logo">
                    <img src="{{ asset('img/LICEO.png') }}" alt="Logo">
                </a>
                <a href="{{ route('cashier-dashboard.show', ['cashierId' => Auth::user()->studentId]) }}"
                    class="logo logo-small">
                    <img src="{{ asset('img/Liceo-sm.png') }}" alt="Logo" width="30" height="30">
                </a>
            @endif
            @if (Auth::user()->usertype == 'admin')
                <a href="{{ route('admin-dashboard.show', ['studentId' => Auth::user()->studentId]) }}" class="logo">
                    <img src="{{ asset('img/LICEO.png') }}" alt="Logo">
                </a>
                <a href="{{ route('admin-dashboard.show', ['studentId' => Auth::user()->studentId]) }}"
                    class="logo logo-small">
                    <img src="{{ asset('img/Liceo-sm.png') }}" alt="Logo" width="30" height="30">
                </a>
            @endif

            @if (Auth::user()->usertype == 'teacher')
                <a href="{{ route('teacher-dashboard.show', ['teacherId' => Auth::user()->studentId]) }}"
                    class="logo">
                    <img src="{{ asset('img/LICEO.png') }}" alt="Logo">
                </a>
                <a href="{{ route('teacher-dashboard.show', ['teacherId' => Auth::user()->studentId]) }}"
                    class="logo logo-small">
                    <img src="{{ asset('img/Liceo-sm.png') }}" alt="Logo" width="30" height="30">
                </a>
            @endif

            @if (Auth::user()->usertype == 'student')
                <a href="{{ route('student-dashboard.show') }}"
                    class="logo">
                    <img src="{{ asset('img/LICEO.png') }}" alt="Logo">
                </a>
                <a href="{{ route('student-dashboard.show') }}"
                    class="logo logo-small">
                    <img src="{{ asset('img/Liceo-sm.png') }}" alt="Logo" width="30" height="30">
                </a>
            @endif
        </div>
        <a href="javascript:void(0);" id="toggle_btn">
            <i class="fas fa-align-left"></i>
        </a>
        {{-- <div class="top-nav-search">
            <form>
                <input type="text" class="form-control" placeholder="Search here">
                <button class="btn" type="submit"><i class="fas fa-search"></i></button>
            </form>
        </div> --}}
        <a class="mobile_btn" id="mobile_btn">
            <i class="fas fa-bars"></i>
        </a>
        <ul class="nav user-menu">
            <li class="nav-item dropdown noti-dropdown">
                <a href="#" class="dropdown-toggle nav-link" data-toggle="dropdown">
                    <i class="far fa-bell"></i> <span class="badge badge-pill d-inline-block"></span>
                </a>
                <div class="dropdown-menu notifications">
                    <div class="topnav-dropdown-header">
                        <span class="notification-title">Notifications</span>
                        <a href="javascript:void(0)" class="clear-noti"> Clear All </a>
                    </div>
                    <div class="noti-content">
                        <ul class="notification-list">
                            <!-- Notifications will be loaded here -->
                        </ul>
                    </div>
                    <div class="topnav-dropdown-footer">
                        <a href="{{ route('notifications.show') }}">View all Notifications</a>
                    </div>
                </div>
            </li>
            
            <li class="nav-item dropdown has-arrow">
                <a href="#" class="dropdown-toggle nav-link" data-toggle="dropdown">
                    <span class="user-img">
                        <img class="avatar-img rounded-circle"
                            src="{{ asset('storage/images/display-photo/' . Auth::user()->displayPhoto) }}"
                            width="40" height="35" alt="Admin Display">
                    </span>

                </a>
                <div class="dropdown-menu">
                    <div class="user-header">
                        <div class="avatar avatar-sm">
                            <img src="{{ asset('storage/images/display-photo/' . Auth::user()->displayPhoto) }}"
                                alt="Display" class="avatar-img rounded-circle">
                        </div>
                        <div class="user-text">
                            <h6>{{ Auth::user()->studentId }}</h6>
                            <p class="text-muted mb-0">{{ Auth::user()->usertype }}</p>
                        </div>
                    </div>

                    @if (Auth::user()->usertype == 'student')
                        <a class="dropdown-item"
                            href="{{ route('profile-details.show', ['studentId' => Auth::user()->studentId]) }}">My
                            Profile</a>
                    @elseif (Auth::user()->usertype == 'teacher')
                        <a class="dropdown-item"
                            href="{{ route('profile-teacher.show', ['teacherId' => Auth::user()->studentId]) }}">My
                            Profile</a>
                    @elseif (Auth::user()->usertype == 'admin')
                        <a class="dropdown-item"
                            href="{{ route('profile-admin.show', ['adminId' => Auth::user()->studentId]) }}">My
                            Profile</a>
                    @elseif (Auth::user()->usertype == 'superadmin')
                        <a class="dropdown-item"
                            href="{{ route('profile-superadmin.show', ['supAdminId' => Auth::user()->studentId]) }}">My
                            Profile</a>
                    @elseif (Auth::user()->usertype == 'cashier')
                        <a class="dropdown-item"
                            href="{{ route('profile-cashier.show', ['cashierId' => Auth::user()->studentId]) }}">My Profile</a>
                    @endif
                    <form method="POST" action="{{ url('/logout') }}">
                        @csrf
                        <button class="dropdown-item" type="submit">Logout</button>
                    </form>
                </div>
            </li>
        </ul>
    </div>
    <div class="sidebar" id="sidebar">
        <div class="sidebar-inner slimscroll">
            <div id="sidebar-menu" class="sidebar-menu">
                <ul>
                    <li class="menu-title">
                        <span>Main Menu</span>
                    </li>

                    {{-- SUPERADMIN/PRINCIPAL SIDEBAR --}}
                    @if (Auth::user()->usertype == 'superadmin')
                    <li class="{{ Request::routeIs('supadmin-dashboard.show') ? 'active' : '' }}">
                        <a href="{{ route('supadmin-dashboard.show', ['supAdminId' => Auth::user()->studentId]) }}">
                            <i class="fas fa-school"></i><span>Dashboard</span>
                        </a>
                    </li>
                    <li class="submenu {{ Request::routeIs('enrolled-student-list.show', 'pending-student-list.show') ? 'active' : '' }}">
                        <a href="#"><i class="fas fa-user-graduate"></i> <span> Enrollment</span> <span class="menu-arrow"></span></a>
                        <ul>
                            <li class="{{ Request::routeIs('enrolled-student-list.show') ? 'active' : '' }}">
                                <a href="{{ route('enrolled-student-list.show') }}">Enrolled Student</a>
                            </li>
                            <li class="{{ Request::routeIs('pending-student-list.show') ? 'active' : '' }}">
                                <a href="{{ route('pending-student-list.show') }}">Pending Enrollment</a>
                            </li>
                        </ul>
                    </li>
                    <li class="submenu {{ Request::routeIs('teacherlist.show', 'addteacher.show') ? 'active' : '' }}">
                        <a href="#"><i class="fas fa-chalkboard-teacher"></i> <span> Teachers</span> <span class="menu-arrow"></span></a>
                        <ul>
                            <li class="{{ Request::routeIs('teacherlist.show') ? 'active' : '' }}">
                                <a href="{{ route('teacherlist.show') }}">Teacher List</a>
                            </li>
                            <li class="{{ Request::routeIs('addteacher.show') ? 'active' : '' }}">
                                <a href="{{ route('addteacher.show') }}">Teacher Add</a>
                            </li>
                        </ul>
                    </li>
                @endif
                

                    {{-- CASHIER SIDEBAR --}}
                    @if (Auth::user()->usertype == 'cashier')
                    <li class="{{ Request::routeIs('cashier-dashboard.show') ? 'active' : '' }}">
                        <a href="{{ route('cashier-dashboard.show', ['cashierId' => Auth::user()->studentId]) }}">
                            <i class="fas fa-school"></i><span>Dashboard</span>
                        </a>
                    </li>
                    <li class="submenu {{ Request::routeIs('enrolled-student-list.show', 'pending-student-list.show') ? 'active' : '' }}">
                        <a href="#"><i class="fas fa-user-graduate"></i> <span> Enrollment</span> <span class="menu-arrow"></span></a>
                        <ul>
                            <li class="{{ Request::routeIs('enrolled-student-list.show') ? 'active' : '' }}">
                                <a href="{{ route('enrolled-student-list.show') }}">Enrolled Student</a>
                            </li>
                            <li class="{{ Request::routeIs('pending-student-list.show') ? 'active' : '' }}">
                                <a href="{{ route('pending-student-list.show') }}">Pending Enrollment</a>
                            </li>
                        </ul>
                    </li>
                    <li class="submenu {{ Request::routeIs('teacherlist.show', 'addteacher.show') ? 'active' : '' }}">
                        <a href="#"><i class="fas fa-chalkboard-teacher"></i> <span> Teachers</span> <span class="menu-arrow"></span></a>
                        <ul>
                            <li class="{{ Request::routeIs('teacherlist.show') ? 'active' : '' }}">
                                <a href="{{ route('teacherlist.show') }}">Teacher List</a>
                            </li>
                            <li class="{{ Request::routeIs('addteacher.show') ? 'active' : '' }}">
                                <a href="{{ route('addteacher.show') }}">Teacher Add</a>
                            </li>
                        </ul>
                    </li>
                    <li class="menu-title"><span>Management</span></li>
                    <li class="submenu {{ Request::routeIs('paymenthistoryadmin.show', 'addfees.show', 'paymentList.show') ? 'active' : '' }}">
                        <a href="#"><i class="fas fa-file-invoice-dollar"></i> <span> Accounts</span> <span class="menu-arrow"></span></a>
                        <ul>
                            <li class="{{ Request::routeIs('paymenthistoryadmin.show') ? 'active' : '' }}">
                                <a href="{{ route('paymenthistoryadmin.show') }}">Payments Collection</a>
                            </li>
                            <li class="{{ Request::routeIs('addfees.show') ? 'active' : '' }}">
                                <a href="{{ route('addfees.show') }}">Add Fees</a>
                            </li>
                            <li class="{{ Request::routeIs('paymentList.show') ? 'active' : '' }}">
                                <a href="{{ route('paymentList.show') }}">Payment List</a>
                            </li>
                        </ul>
                    </li>
                @endif
                

                    {{-- ADMIN/REGISTRAR SIDEBAR --}}
                    @if (Auth::user()->usertype == 'admin')
                    <li class="{{ Route::currentRouteName() == 'admin-dashboard.show' ? 'active' : '' }}">
                        <a href="{{ route('admin-dashboard.show', ['studentId' => Auth::user()->studentId]) }}">
                            <i class="fas fa-school"></i><span>Dashboard</span>
                        </a>
                    </li>
                
                    <li class="submenu {{ in_array(Route::currentRouteName(), ['studentlist.show', 'addstudent.show']) ? 'active' : '' }}">
                        <a href="#"><i class="fas fa-user-graduate"></i><span>Students</span><span class="menu-arrow"></span></a>
                        <ul>
                            <li class="{{ Route::currentRouteName() == 'studentlist.show' ? 'active' : '' }}">
                                <a href="{{ route('studentlist.show') }}">Student List</a>
                            </li>
                            <li class="{{ Route::currentRouteName() == 'addstudent.show' ? 'active' : '' }}">
                                <a href="{{ route('addstudent.show') }}">Student Add</a>
                            </li>
                        </ul>
                    </li>
                
                    <li class="submenu {{ in_array(Route::currentRouteName(), ['teacherlist.show', 'addteacher.show']) ? 'active' : '' }}">
                        <a href="#"><i class="fas fa-chalkboard-teacher"></i><span>Teachers</span><span class="menu-arrow"></span></a>
                        <ul>
                            <li class="{{ Route::currentRouteName() == 'teacherlist.show' ? 'active' : '' }}">
                                <a href="{{ route('teacherlist.show') }}">Teacher List</a>
                            </li>
                            <li class="{{ Route::currentRouteName() == 'addteacher.show' ? 'active' : '' }}">
                                <a href="{{ route('addteacher.show') }}">Teacher Add</a>
                            </li>
                        </ul>
                    </li>
                
                    <li class="submenu {{ in_array(Route::currentRouteName(), ['subjectlist.show', 'addsubject.show']) ? 'active' : '' }}">
                        <a href="#"><i class="fas fa-book"></i><span>Subjects</span><span class="menu-arrow"></span></a>
                        <ul>
                            <li class="{{ Route::currentRouteName() == 'subjectlist.show' ? 'active' : '' }}">
                                <a href="{{ route('subjectlist.show') }}">Subject List</a>
                            </li>
                            <li class="{{ Route::currentRouteName() == 'addsubject.show' ? 'active' : '' }}">
                                <a href="{{ route('addsubject.show') }}">Subject Add</a>
                            </li>
                        </ul>
                    </li>
                
                    <li class="submenu {{ in_array(Route::currentRouteName(), ['sectionlist.show', 'add-section.show']) ? 'active' : '' }}">
                        <a href="#"><i class="fas fa-layer-group"></i><span>Sections</span><span class="menu-arrow"></span></a>
                        <ul>
                            <li class="{{ Route::currentRouteName() == 'sectionlist.show' ? 'active' : '' }}">
                                <a href="{{ route('sectionlist.show') }}">Section List</a>
                            </li>
                            <li class="{{ Route::currentRouteName() == 'add-section.show' ? 'active' : '' }}">
                                <a href="{{ route('add-section.show') }}">Section Add</a>
                            </li>
                        </ul>
                    </li>
                
                    <li class="submenu {{ in_array(Route::currentRouteName(), ['correquest.show', 'goodmoralrequest.show']) ? 'active' : '' }}">
                        <a href="#"><i class="fas fa-file-alt"></i><span>Forms</span><span class="menu-arrow"></span></a>
                        <ul>
                            <li class="{{ Route::currentRouteName() == 'correquest.show' ? 'active' : '' }}">
                                <a href="{{ route('correquest.show') }}">COR</a>
                            </li>
                            <li class="{{ Route::currentRouteName() == 'goodmoralrequest.show' ? 'active' : '' }}">
                                <a href="{{ route('goodmoralrequest.show') }}">Good Moral</a>
                            </li>
                        </ul>
                    </li>
                
                    <li class="submenu {{ in_array(Route::currentRouteName(), ['enroll-student.show', 'enrolled-student-list.show', 'pending-student-list.show']) ? 'active' : '' }}">
                        <a href="#"><i class="fas fa-id-card-alt"></i><span>Enrollment</span><span class="menu-arrow"></span></a>
                        <ul>
                            <li class="{{ Route::currentRouteName() == 'enroll-student.show' ? 'active' : '' }}">
                                <a href="{{ route('enroll-student.show') }}">Enroll Student</a>
                            </li>
                            <li class="{{ Route::currentRouteName() == 'enrolled-student-list.show' ? 'active' : '' }}">
                                <a href="{{ route('enrolled-student-list.show') }}">Enrolled Student</a>
                            </li>
                            <li class="{{ Route::currentRouteName() == 'pending-student-list.show' ? 'active' : '' }}">
                                <a href="{{ route('pending-student-list.show') }}">Pending Enrollment</a>
                            </li>
                        </ul>
                    </li>
                
                    <li class="{{ Route::currentRouteName() == 'calendar.show' ? 'active' : '' }}">
                        <a href="{{ route('calendar.show') }}">
                            <i class="fas fa-calendar-alt"></i><span>Schedule</span>
                        </a>
                    </li>
                
                    <li class="submenu {{ in_array(Route::currentRouteName(), ['timeTable.show', 'add-timetable.show']) ? 'active' : '' }}">
                        <a href="#"><i class="fas fa-calendar-alt"></i><span>Time Table</span><span class="menu-arrow"></span></a>
                        <ul>
                            <li class="{{ Route::currentRouteName() == 'timeTable.show' ? 'active' : '' }}">
                                <a href="{{ route('timeTable.show') }}">Schedule List</a>
                            </li>
                            <li class="{{ Route::currentRouteName() == 'add-timetable.show' ? 'active' : '' }}">
                                <a href="{{ route('add-timetable.show') }}">Schedule Add</a>
                            </li>
                        </ul>
                    </li>
                @endif
                

                {{-- STUDENT SIDEBAR --}}
                @if (Auth::user()->usertype == 'student')
                <li class="{{ Route::currentRouteName() == 'student-dashboard.show' ? 'active' : '' }}">
                    <a href="{{ route('student-dashboard.show') }}">
                        <i class="fas fa-school"></i><span>Dashboard</span>
                    </a>
                </li>
                <li class="{{ Route::currentRouteName() == 'student-subjectlist.show' ? 'active' : '' }}">
                    <a href="{{ route('student-subjectlist.show') }}">
                        <i class="fas fa-book"></i><span>Subject</span>
                    </a>
                </li>
                <li class="{{ Route::currentRouteName() == 'student-grades.show' ? 'active' : '' }}">
                    <a href="{{ route('student-grades.show') }}">
                        <i class="fas fa-chart-bar"></i><span>Grades</span>
                    </a>
                </li>
                <li class="{{ Route::currentRouteName() == 'schedule.show' ? 'active' : '' }}">
                    <a href="{{ route('schedule.show') }}">
                        <i class="fas fa-calendar-alt"></i><span>Schedule</span>
                    </a>
                </li>
                <li class="{{ Route::currentRouteName() == 'paymenthistory.show' ? 'active' : '' }}">
                    <a href="{{ route('paymenthistory.show') }}">
                        <i class="fas fa-comment-dollar"></i><span>Fees</span>
                    </a>
                </li>
                <li class="{{ Route::currentRouteName() == 'student-attendance.show' ? 'active' : '' }}">
                    <a href="{{ route('student-attendance.show') }}">
                        <i class="fas fa-user-check"></i><span>Attendance</span>
                    </a>
                </li>
                @enrolled(Auth::user()->studentId)
                    <li class="{{ Route::currentRouteName() == 'selfEnrollment.show' ? 'active' : '' }}">
                        <a href="{{ route('selfEnrollment.show') }}">
                            <i class="fas fa-id-card-alt"></i><span>Enrollment</span>
                        </a>
                    </li>
                @endenrolled
            @endif
            




                    {{-- TEACHER SIDEBAR --}}
                    @if (Auth::user()->usertype == 'teacher')
                    <li class="{{ Route::currentRouteName() == 'teacher-dashboard.show' ? 'active' : '' }}">
                        <a href="{{ route('teacher-dashboard.show', ['teacherId' => Auth::user()->studentId]) }}">
                            <i class="fas fa-school"></i>
                            <span>Dashboard</span>
                        </a>
                    </li>
                    
                    <li class="{{ Route::currentRouteName() == 'students.show' ? 'active' : '' }}">
                        <a href="{{ route('students.show') }}">
                            <i class="fas fa-user-graduate"></i>
                            <span>My Students</span>
                        </a>
                    </li>
                    
                    <li class="submenu {{ in_array(Route::currentRouteName(), ['studentsgrade.show', 'handleSections.show']) ? 'active' : '' }}">
                        <a href="#">
                            <i class="fas fa-chart-bar"></i>
                            <span>Students Grade</span>
                            <span class="menu-arrow"></span>
                        </a>
                        <ul>
                            <li class="{{ Route::currentRouteName() == 'studentsgrade.show' ? 'active' : '' }}">
                                <a href="{{ route('studentsgrade.show') }}">All</a>
                            </li>
                            <li class="{{ Route::currentRouteName() == 'handleSections.show' ? 'active' : '' }}">
                                <a href="{{ route('handleSections.show') }}">Section</a>
                            </li>
                        </ul>
                    </li>
                    
                    <li class="{{ Route::currentRouteName() == 'teacherSchedule.show' ? 'active' : '' }}">
                        <a href="{{ route('teacherSchedule.show') }}">
                            <i class="fas fa-calendar-alt"></i>
                            <span>My Schedule</span>
                        </a>
                    </li>
                    
                    <li class="{{ Route::currentRouteName() == 'teacher-subjectlist.show' ? 'active' : '' }}">
                        <a href="{{ route('teacher-subjectlist.show', ['teacherId' => Auth::user()->studentId]) }}">
                            <i class="fas fa-book"></i>
                            <span>My Subjects</span>
                        </a>
                    </li>
                    
                    <li class="submenu {{ in_array(Route::currentRouteName(), ['attendance.index', 'view-attendance.show']) ? 'active' : '' }}">
                        <a href="#">
                            <i class="fas fa-user-check"></i>
                            <span>Attendance</span>
                            <span class="menu-arrow"></span>
                        </a>
                        <ul>
                            <li class="{{ Route::currentRouteName() == 'attendance.index' ? 'active' : '' }}">
                                <a href="{{ route('attendance.index') }}">New Attendance</a>
                            </li>
                            <li class="{{ Route::currentRouteName() == 'view-attendance.show' ? 'active' : '' }}">
                                <a href="{{ route('view-attendance.show') }}">View Attendance</a>
                            </li>
                        </ul>
                    </li>
                @endif
                
                </ul>
            </div>
        </div>
    </div>
    {{-- use for the toast --}}
    @notifyJs
    <script src="{{ asset('js/jquery-3.6.0.min.js') }}"></script>
    <script src="{{ asset('js/popper.min.js') }}"></script>
    <script src="{{ asset('plugins/bootstrap/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('plugins/slimscroll/jquery.slimscroll.min.js') }}"></script>
    <script src="{{ asset('plugins/apexchart/apexcharts.min.js') }}"></script>
    <script src="{{ asset('plugins/apexchart/chart-data.js') }}"></script>
    <script src="{{ asset('js/script.js') }}"></script>
    <script src="{{ asset('js/myjs/notification.js') }}"></script>

    <script>
    $(document).ready(function() {
    // Set up CSRF token for all AJAX requests
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    })});
    </script>

<script>
    // Initialize dark mode options (customize if needed)
    const options = {
      bottom: '32px', // Position of the darkmode switch
      right: '32px', // Distance from right edge
      left: 'unset', // Distance from left edge
      time: '0.5s',  // Transition time
      mixColor: '#fff', // Default color for transitions
      backgroundColor: '#fff',  // Default light mode background color
      buttonColorDark: '#100f2c',  // Dark mode button color
      buttonColorLight: '#fff',   // Light mode button color
      saveInCookies: true,  // Save user's dark mode preference
      label: '🌓',  // The label on the switch button
      autoMatchOsTheme: true // Automatically match OS theme setting
    };
  
    const darkmode = new Darkmode(options);
    darkmode.showWidget(); // This will show the dark mode toggle button
  </script>
  
</body>

</html>
