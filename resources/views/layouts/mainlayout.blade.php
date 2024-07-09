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

</head>

<body>
    <div class="header">
        <div class="header-left">
            @if (Auth::user()->usertype == 'admin')
                <a href="{{ route('admin-dashboard.show', ['studentId' => Auth::user()->studentId]) }}" class="logo">
                    <img src="{{ asset('img/logo.png') }}" alt="Logo">
                </a>
                <a href="{{ route('admin-dashboard.show', ['studentId' => Auth::user()->studentId]) }}" class="logo logo-small">
                    <img src="{{ asset('img/logo.png') }}" alt="Logo" width="30" height="30">
                </a>
            @endif

            @if (Auth::user()->usertype == 'teacher')
                <a href="{{ route('teacher-dashboard.show', ['teacherId' => Auth::user()->studentId]) }}"
                    class="logo">
                    <img src="{{ asset('img/logo.png') }}" alt="Logo">
                </a>
                <a href="{{ route('teacher-dashboard.show', ['teacherId' => Auth::user()->studentId]) }}"
                    class="logo logo-small">
                    <img src="{{ asset('img/logo.png') }}" alt="Logo" width="30" height="30">
                </a>
            @endif

            @if (Auth::user()->usertype == 'student')
                <a href="{{ route('student-dashboard.show', ['studentId' => Auth::user()->studentId]) }}"
                    class="logo">
                    <img src="{{ asset('img/logo.png') }}" alt="Logo">
                </a>
                <a href="{{ route('student-dashboard.show', ['studentId' => Auth::user()->studentId]) }}"
                    class="logo logo-small">
                    <img src="{{ asset('img/logo.png') }}" alt="Logo" width="30" height="30">
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
                    <i class="far fa-bell"></i> <span class="badge badge-pill d-inline-block">3</span>
                </a>
                <div class="dropdown-menu notifications">
                    <div class="topnav-dropdown-header">
                        <span class="notification-title">Notifications</span>
                        <a href="javascript:void(0)" class="clear-noti"> Clear All </a>
                    </div>
                    <div class="noti-content">
                        <ul class="notification-list">
                            <li class="notification-message">
                                <a href="#">
                                    <div class="media">
                                        <span class="avatar avatar-sm">
                                            <img class="avatar-img rounded-circle" alt="User Image"
                                                src="{{ asset('img/profiles/avatar-02.jpg') }}">
                                        </span>
                                        <div class="media-body">
                                            <p class="noti-details"><span class="noti-title">Carlson Tech</span> has
                                                approved <span class="noti-title">your estimate</span></p>
                                            <p class="noti-time"><span class="notification-time">4 mins ago</span></p>
                                        </div>
                                    </div>
                                </a>
                            </li>
                            <li class="notification-message">
                                <a href="#">
                                    <div class="media">
                                        <span class="avatar avatar-sm">
                                            <img class="avatar-img rounded-circle" alt="User Image"
                                                src="{{ asset('img/profiles/avatar-11.jpg') }}">
                                        </span>
                                        <div class="media-body">
                                            <p class="noti-details"><span class="noti-title">International Software
                                                    Inc</span> has sent you a invoice in the amount of <span
                                                    class="noti-title">$218</span></p>
                                            <p class="noti-time"><span class="notification-time">6 mins ago</span></p>
                                        </div>
                                    </div>
                                </a>
                            </li>
                            <li class="notification-message">
                                <a href="#">
                                    <div class="media">
                                        <span class="avatar avatar-sm">
                                            <img class="avatar-img rounded-circle" alt="User Image"
                                                src="{{ asset('img/profiles/avatar-17.jpg') }}">
                                        </span>
                                        <div class="media-body">
                                            <p class="noti-details"><span class="noti-title">John Hendry</span> sent a
                                                cancellation request <span class="noti-title">Apple iPhone XR</span>
                                            </p>
                                            <p class="noti-time"><span class="notification-time">8 mins ago</span></p>
                                        </div>
                                    </div>
                                </a>
                            </li>
                            <li class="notification-message">
                                <a href="#">
                                    <div class="media">
                                        <span class="avatar avatar-sm">
                                            <img class="avatar-img rounded-circle" alt="User Image"
                                                src="{{ asset('img/profiles/avatar-13.jpg') }}">
                                        </span>
                                        <div class="media-body">
                                            <p class="noti-details"><span class="noti-title">Mercury Software
                                                    Inc</span> added a new product <span class="noti-title">Apple
                                                    MacBook Pro</span></p>
                                            <p class="noti-time"><span class="notification-time">12 mins ago</span>
                                            </p>
                                        </div>
                                    </div>
                                </a>
                            </li>
                        </ul>
                    </div>
                    <div class="topnav-dropdown-footer">
                        <a href="#">View all Notifications</a>
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
                            <img  src="{{ asset('storage/images/display-photo/' . Auth::user()->displayPhoto) }}" alt="Display"
                                class="avatar-img rounded-circle">
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

                    {{-- ADMIN/REGISTRAR SIDEBAR --}}
                    @if (Auth::user()->usertype == 'admin')
                        <li>
                            <a href="{{ route('admin-dashboard.show', ['studentId' => Auth::user()->studentId]) }}"><i
                                    class="fas fa-user-graduate"></i><span>Dashboard</span></a>
                        </li>
                
                        <li class="submenu">
                            <a href="#"><i class="fas fa-user-graduate"></i> <span> Students</span> <span
                                    class="menu-arrow"></span></a>
                            <ul>
                                <li><a href="{{ route('studentlist.show') }}">Student List</a></li>
                                {{-- <li><a href="{{ url('student-details.html') }}">Student View</a></li> --}}
                                <li><a href="{{ route('addstudent.show') }}">Student Add</a></li>
                                {{-- <li><a href="{{ url('edit-student.html') }}">Student Edit</a></li> --}}
                            </ul>
                        </li>
              
                        <li class="submenu">
                            <a href="#"><i class="fas fa-chalkboard-teacher"></i> <span> Teachers</span> <span
                                    class="menu-arrow"></span></a>
                            <ul>
                                <li><a href="{{ route('teacherlist.show') }}">Teacher List</a></li>
                                {{-- <li><a href="{{ url('teacher-details.html') }}">Teacher View</a></li> --}}
                                <li><a href="{{ route('addteacher.show') }}">Teacher Add</a></li>
                                {{-- <li><a href="{{ url('edit-teacher.html') }}">Teacher Edit</a></li> --}}
                            </ul>
                        </li>
         
                        <li class="submenu">
                            <a href="#"><i class="fas fa-building"></i> <span> Departments</span> <span
                                    class="menu-arrow"></span></a>
                            <ul>
                                <li><a href="{{ url('departments.html') }}">Department List</a></li>
                                <li><a href="{{ url('add-department.html') }}">Department Add</a></li>
                                <li><a href="{{ url('edit-department.html') }}">Department Edit</a></li>
                            </ul>
                        </li>
       
                        <li class="submenu">
                            <a href="#"><i class="fas fa-book-reader"></i> <span> Subjects</span> <span
                                    class="menu-arrow"></span></a>
                            <ul>
                                <li><a href="{{ route('subjectlist.show') }}">Subject List</a></li>
                                <li><a href="{{ route('addsubject.show') }}">Subject Add</a></li>
                                {{-- <li><a href="{{ route('edit-subject.show') }}">Subject Edit</a></li> --}}
                            </ul>
                        </li>
      
                        <li class="submenu">
                            <a href="#"><i class="fas fa-user-graduate"></i> <span> Sections</span> <span
                                    class="menu-arrow"></span></a>
                            <ul>
                                <li><a href="{{ route('sectionlist.show') }}">Section List</a></li>
                                <li><a href="{{ route('add-section.show') }}">Section Add</a></li>
                            </ul>
                        </li>
     
                        <li class="submenu">
                            <a href="#"><i class="fas fa-user-graduate"></i> <span> Enrollment</span> <span
                                    class="menu-arrow"></span></a>
                            <ul>
                                <li><a href="{{ route('enroll-student.show') }}">Enroll Student</a></li>
                                <li><a href="{{ route('enrolled-student-list.show') }}">Enrolled Student</a></li>
                                <li><a href="{{ route('pending-student-list.show') }}">Pending Enrollment</a></li>
                                {{-- <li><a href="{{ url('edit-student.html') }}">Student Edit</a></li> --}}
                            </ul>
                        </li>
            
                        <li>
                            <a href="{{ route('calendar.show') }}"><i
                                    class="fas fa-user-graduate"></i><span>Calendar</span></a>
                        </li>
        
                    <li class="submenu">
                        <a href="#"><i class="fas fa-user-graduate"></i> <span> Time Table</span> <span
                                class="menu-arrow"></span></a>
                        <ul>
                            <li><a href="{{ route('timeTable.show') }}">Schedule List</a></li>
                            <li><a href="{{ route('add-timetable.show') }}">Schedule Add</a></li>
                        </ul>
                    </li>
          
                        <li class="menu-title">
                            <span>Management</span>
                        </li>
                        <li class="submenu">
                            <a href="#"><i class="fas fa-file-invoice-dollar"></i> <span> Accounts</span> <span
                                    class="menu-arrow"></span></a>
                            <ul>
                                <li><a href="{{ route('paymenthistoryadmin.show') }}">Payments Collection</a></li>
                                {{-- <li><a href="{{ url('expenses.html') }}">Expenses</a></li> --}}
                                {{-- <li><a href="{{ url('salary.html') }}">Salary</a></li> --}}
                                <li><a href="{{ route('addfees.show') }}">Add Fees</a></li>
                                {{-- <li><a href="{{ url('add-expenses.html') }}">Add Expenses</a></li> --}}
                                {{-- <li><a href="{{ url('add-salary.html') }}">Add Salary</a></li> --}}
                                <li><a href="{{ route('paymentList.show') }}">Payment List</a></li>
                            </ul>
                        </li>
                    @endif


                         {{-- STUDENT SIDEBAR --}}
                    @if (Auth::user()->usertype == 'student')
                        <li>
                            <a href="{{ route('student-dashboard.show', ['studentId' => Auth::user()->studentId]) }}">
                                <i class="fas fa-user-graduate"></i><span>Dashboard</span>
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('student-subjectlist.show', ['studentId' => Auth::user()->studentId]) }}">
                                <i class="fas fa-book-reader"></i><span>Subject</span>
                            </a>
                        </li>
                            <li>
                            <a href="{{ route('schedule.show') }}"><i class="fas fa-comment-dollar"></i>
                                <span>Schedule</span>
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('paymenthistory.show') }}"><i class="fas fa-comment-dollar"></i>
                                <span>Fees</span></a>
                        </li>
                        <li>
                            <a href="{{ route('selfEnrollment.show') }}"><i class="fas fa-comment-dollar"></i>
                                <span>Enrollment</span></a>
                        </li>
                    @endif


                    {{-- TEACHER SIDEBAR --}}
                    @if (Auth::user()->usertype == 'teacher')
                    <li>
                        <a href="{{ route('teacher-dashboard.show', ['teacherId' => Auth::user()->studentId]) }}"><i class="fas fa-user-graduate"></i><span>Dashboard</span></a>
                    </li>
                    <li>
                        <a href="{{ route('students.show') }}"><i class="fas fa-user-graduate"></i>
                            <span>My Students</span></a>
                    </li>

                    <li>
                        <a href="{{ route('studentsgrade.show') }}"><i class="fas fa-user-graduate"></i>
                            <span>Students Grade</span></a>
                    </li>

                    <li>
                        <a href="{{ route('teacherSchedule.show') }}"><i class="fas fa-user-graduate"></i>
                            <span>My Schedule</span></a>
                    </li>
                @endif
                    {{-- <li>
                        <a href="{{ url('holiday.html') }}"><i class="fas fa-holly-berry"></i>
                            <span>Holiday</span></a>
                    </li>
                    <li>
                        <a href="{{ url('exam.html') }}"><i class="fas fa-clipboard-list"></i> <span>Exam
                                list</span></a>
                    </li>
                    <li>
                        <a href="{{ url('event.html') }}"><i class="fas fa-calendar-day"></i> <span>Events</span></a>
                    </li>
                    <li>
                        <a href="{{ url('time-table.html') }}"><i class="fas fa-table"></i> <span>Time
                                Table</span></a>
                    </li>
                    <li>
                        <a href="{{ url('library.html') }}"><i class="fas fa-book"></i> <span>Library</span></a>
                    </li> --}}
                </ul>
            </div>
        </div>
    </div>

    <script src="{{ asset('js/jquery-3.6.0.min.js') }}"></script>
    <script src="{{ asset('js/popper.min.js') }}"></script>
    <script src="{{ asset('plugins/bootstrap/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('plugins/slimscroll/jquery.slimscroll.min.js') }}"></script>
    <script src="{{ asset('plugins/apexchart/apexcharts.min.js') }}"></script>
    <script src="{{ asset('plugins/apexchart/chart-data.js') }}"></script>
    <script src="{{ asset('js/script.js') }}"></script>
</body>

</html>
