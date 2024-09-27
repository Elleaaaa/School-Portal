<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FeeController;
use App\Http\Controllers\FileController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\EmailController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\GradeController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\FeeListController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SectionController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\SubjectController;
use App\Http\Controllers\TeacherController;
use App\Http\Controllers\CalendarController;
use App\Http\Controllers\EnrolleesController;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Http\Request;

use App\Http\Controllers\AttendanceController;
use App\Http\Controllers\CashierController;
use App\Http\Controllers\FormController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\SuperAdminController;
use App\Models\Enrollee;
use Illuminate\Cache\RateLimiting\Limit;

Route::get('/login', function () {
    return view('login');
})->middleware(['auth', 'verified'])->name('login'); // will redirect here after register

//Limit the request of the users
Ratelimiter::for('auth_limited', function (Request $request) {
    if ($user = $request->user()) {
        return Limit::perMinute(60)->by($user->id);
    }
    return Limit::none();
});

Route::middleware(['auth', 'throttle:auth_limited'])->group(function (){
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});


Route::middleware(['guest'])->group(function () {
    // FOR LOGGING IN
    Route::get('/', [LoginController::class, 'index'])->name('login');
    Route::post('/login1', [LoginController::class, 'login'])->name('login1');
    Route::post('/logout', [LoginController::class, 'logout'])->name('logout');
});


// STUDENT ROUTES
Route::middleware(['auth', 'throttle:auth_limited'])->group(function () {
    Route::get('/profile-details/{studentId}', [StudentController::class, 'showProfile'])->name('profile-details.show');
    Route::get('/student-dashboard', [StudentController::class, 'showDashboard'])->name('student-dashboard.show');
    Route::get('/student-subjectlist', [StudentController::class, 'showSubjectList'])->name('student-subjectlist.show');

    Route::get('/student-grades', [StudentController::class, 'showGrades'])->name('student-grades.show');
    Route::get('/student-grades/jhs', [GradeController::class, 'showJHSGrades'])->name('student-grades-jhs.show');
    Route::get('/student-grades/shs', [GradeController::class, 'showSHSGrades'])->name('student-grades-shs.show');
    Route::get('/get-jhs-grades', [GradeController::class, 'getJHSGrades'])->name('getJHSGrades');
    Route::get('/get-shs-grades', [GradeController::class, 'getSHSGrades'])->name('getSHSGrades');


    // update personal details for students
    Route::post('/profile-details/{id}', [StudentController::class, 'update'])->name('profile-details.update');

    Route::get('/payments/history', [FeeController::class, 'paymentHistory'])->name('paymenthistory.show');

    Route::get('/myschedule', [CalendarController::class, 'studentSchedule'])->name('schedule.show');

    Route::get('/enrollment', [EnrolleesController::class, 'selfEnrollment'])->name('selfEnrollment.show');
    Route::post('/selfenroll', [EnrolleesController::class, 'selfenroll'])->name('selfEnroll.store');

    Route::get('/fees/invoice', [StudentController::class, 'showInvoice'])->name('invoice.show');

    Route::get('/student/attendance', [AttendanceController::class, 'showStudentAttendance'])->name('student-attendance.show');

    Route::get('/student-attendance', [AttendanceController::class, 'getAttendance'])->name('attendance.get');

    Route::get('/api/attendance', [AttendanceController::class, 'getAttendanceAJAX']);
    Route::get('/api/payments', [FeeController::class, 'getPaymentsAJAX']);
});


// TEACHER ROUTES
Route::middleware(['auth', 'throttle:auth_limited'])->group(function (){
    Route::get('/teacher-dashboard/{teacherId}', [TeacherController::class, 'showDashboard'])->name('teacher-dashboard.show');

    Route::get('/profile-teacher/{teacherId}', [TeacherController::class, 'showProfile'])->name('profile-teacher.show');
    Route::post('/profile-teacher/{id}', [TeacherController::class, 'update'])->name('profile-teacher.update'); // update personal details for teacher

    Route::get('/mystudents', [TeacherController::class, 'showStudents'])->name('students.show');

    Route::get('/students/grades', [TeacherController::class, 'showStudentsGrade'])->name('studentsgrade.show');
    Route::get('/students-grades/section', [TeacherController::class, 'showHandleSections'])->name('handleSections.show');

    Route::get('/students-grades/{gradeLevel}/{section}', [TeacherController::class, 'showStudentsGradeBySection'])->name('studentgradebysection.show');

    Route::post('/students/grades/update/{id}', [GradeController::class, 'update'])->name('studentsgrade.update');
    Route::post('/students/grades/import', [GradeController::class, 'importGrade'])->name('grades.import');

    Route::get('/schedule', [CalendarController::class, 'teacherSchedule'])->name('teacherSchedule.show');

    //attendance
    Route::get('/students-attendance/{gradeLevel}/{section}', [AttendanceController::class, 'showAttendaceBySection'])->name('studentattendancebysection.show');

    Route::get('/attendance', [AttendanceController::class, 'index'])->name('attendance.index');
    Route::post('/attendance', [AttendanceController::class, 'store'])->name('attendance.store');
    Route::get('/view-attendance', [AttendanceController::class, 'showAttendance'])->name('view-attendance.show');

    Route::get('/subjectlist/{teacherId}', [TeacherController::class, 'showSubjectList'])->name('teacher-subjectlist.show');
    Route::get('/subject-details/{subjectId}', [TeacherController::class, 'showSubDetails'])->name('teacher-subjectdetails.show');

    Route::post('/uploadFile/{id}', [FileController::class, 'store'])->name('uploadFile.store');
});



// ADMIN ROUTES
Route::middleware(['auth', 'throttle:auth_limited'])->group(function () {
    Route::get('/admin-dashboard/studentlist', [AdminController::class, 'showStudentList'])->name('studentlist.show');
    Route::get('/admin-dashboard/teacherlist', [AdminController::class, 'showTeacherList'])->name('teacherlist.show');

    Route::get('/admin-dashboard/{studentId}', [AdminController::class, 'showDashboard'])->name('admin-dashboard.show');

    Route::get('/profile-admin/{adminId}', [AdminController::class, 'showProfile'])->name('profile-admin.show');
    Route::post('/profile-admin/{id}', [AdminController::class, 'update'])->name('profile-admin.update');

    Route::get('/subjectlist', [AdminController::class, 'showSubjectList'])->name('subjectlist.show');
    
    Route::get('/admin/edit-subject/{id}', [SubjectController::class, 'showEditSubject'])->name('edit-subject.show');
    Route::post('/admin/edit-subject/{id}', [SubjectController::class, 'update'])->name('edit-subject.update');
    Route::get('/admin/addsubject', [SubjectController::class, 'index'])->name('addsubject.show');
    Route::post('/admin/addsubject', [SubjectController::class, 'store'])->name('subject.add');

    Route::get('/fetch-subjects', [SubjectController::class, 'fetchSubjects'])->name('subject.show');
    Route::get('/fetch-subjectsbysem', [SubjectController::class, 'fetchSubjectsBySem'])->name('subject-shs.show');

    Route::get('/admin/edit-student/{id}', [StudentController::class, 'showEditStudent'])->name('edit-student.show');
    Route::post('/admin/edit-student/{id}', [StudentController::class, 'updateAdmin'])->name('edit-student.update');
    Route::get('/admin/addstudent', [StudentController::class, 'index'])->name('addstudent.show');
    Route::post('/admin/addstudent', [StudentController::class, 'store'])->name('addstudent.store');

    Route::get('/admin/edit-teacher/{id}', [TeacherController::class, 'showEditTeacher'])->name('edit-teacher.show');
    Route::post('/admin/edit-teacher/{id}', [TeacherController::class, 'updateAdmin'])->name('edit-teacher.update');
    Route::get('/admin/addteacher', [TeacherController::class, 'index'])->name('addteacher.show');
    Route::post('/admin/addteacher', [TeacherController::class, 'store'])->name('addteacher.store');

    Route::post('/fetch-student-details', [FeeController::class, 'fetchStudentDetails']);

    Route::post('/fetch-student-grade-level', [FeeController::class, 'fetchStudentGlevel']);

    Route::get('/admin/edit-section/{id}', [SectionController::class, 'showEditSection'])->name('edit-section.show');
    Route::post('/admin/edit-section/{id}', [SectionController::class, 'update'])->name('edit-section.update');
    Route::get('/admin/addsection', [SectionController::class, 'index'])->name('add-section.show');
    Route::post('/admin/addsection', [SectionController::class, 'store'])->name('add-section.store');
    Route::get('/admin/sectionlist', [SectionController::class, 'showSectionList'])->name('sectionlist.show');

    Route::get('/fetch-sections', [SectionController::class, 'fetchSection'])->name('section.show');
    Route::get('/fetch-sectionsbystrand', [SectionController::class, 'fetchSectionByStrand'])->name('section-shs.show');

    Route::get('/admin/enroll-student/{id}', [EnrolleesController::class, 'showEditEnrollStudent'])->name('edit-enroll-student.show');
    Route::post('/admin/enroll-student/{id}', [EnrolleesController::class, 'update'])->name('edit-enroll-student.update');
    //FOR JHS
    Route::get('/admin/enroll-student', [EnrolleesController::class, 'index'])->name('enroll-student.show');
    Route::post('/admin/enroll-student', [EnrolleesController::class, 'store'])->name('enroll-student.store');
    //FOR SHS
    Route::get('/admin/enroll-student-shs', [EnrolleesController::class, 'showEnrollSHS'])->name('enroll-student-shs.show');

    Route::get('/admin/enrolled-student-list', [AdminController::class, 'showEnrolledStudents'])->name('enrolled-student-list.show');
    Route::get('/admin/pending-student-list', [AdminController::class, 'showPendingStudents'])->name('pending-student-list.show');

    Route::post('/check-payment-status', [EnrolleesController::class, 'checkPaymentStatus'])->name('checkpayment.status');


    Route::get('/admin/calendar', [CalendarController::class, 'schedule'])->name('calendar.show');
    Route::post('/admin/calendar', [CalendarController::class, 'schedule'])->name('calendar.get');

    Route::get('/admin/edit-timetable/{id}', [CalendarController::class, 'showEditTimeTable'])->name('edit-timetable.show');
    Route::post('/admin/edit-timetable/{id}', [CalendarController::class, 'editTimeTable'])->name('edit-timetable.update');
    Route::get('/admin/time-table', [CalendarController::class, 'timeTable'])->name('timeTable.show');
    Route::get('/admin/time-table/add', [CalendarController::class, 'timeTableAdd'])->name('add-timetable.show');
    Route::post('/admin/time-table/add', [CalendarController::class, 'store'])->name('add-timetable.store');


    //EVENT CALENDAR
    Route::post('/update-event/{id}', [EventController::class, 'update'])->name('events.update');
    Route::get('/get-events', [EventController::class, 'getEvents'])->name('events.get');
    Route::post('/add-event', [EventController::class, 'store'])->name('events.store');


    //FORMS
    Route::get('/request/cor', [FormController::class, 'requestCOR'])->name('correquest.show');
    Route::get('/cor', [FormController::class, 'printCOR'])->name('cor.get');

    Route::get('/request/goodmoral', [FormController::class, 'requestGoodMoral'])->name('goodmoralrequest.show');
    Route::get('/goodmoral', [FormController::class, 'printGoodMoral'])->name('goodmoral.get');

    Route::get('/request/sf9-jhs', [FormController::class, 'requestSF9JHS'])->name('sf9jhsrequest.show');
    Route::get('/SF9-JHS', [FormController::class, 'printSF9JHS'])->name('sf9jhs.get');

    Route::get('/request/sf9-shs', [FormController::class, 'requestSF9SHS'])->name('sf9shsrequest.show');
    Route::get('/SF9-SHS', [FormController::class, 'printSF9SHS'])->name('sf9shs.get');

    Route::get('/request/sf10-jhs', [FormController::class, 'requestSF10JHS'])->name('sf10jhsrequest.show');
    Route::get('/SF10-JHS', [FormController::class, 'printSF10JHS'])->name('sf10jhs.get');

    Route::get('/request/sf10-shs', [FormController::class, 'requestSF10SHS'])->name('sf10shsrequest.show');
    Route::get('/SF10-SHS', [FormController::class, 'printSF10SHS'])->name('sf10shs.get');
});


// SUPERADMIN ROUTES
Route::middleware(['auth', 'throttle:auth_limited'])->group(function () {
    Route::get('/superadmin-dashboard/{supAdminId}', [SuperAdminController::class, 'showDashboard'])->name('supadmin-dashboard.show');
    Route::get('/profile-superadmin/{supAdminId}', [SuperAdminController::class, 'showProfile'])->name('profile-superadmin.show');
    Route::post('/profile-superadmin/{supAdminId}', [SuperAdminController::class, 'update'])->name('profile-superadmin.update');

    Route::get('/api/allpayments', [FeeController::class, 'getAllPaymentsAJAX']);
    Route::get('/api/allattendance', [AttendanceController::class, 'getallAttendanceAJAX']);

    Route::get('/api/absentreport', [AttendanceController::class, 'getAbsentReportAJAX']);

    Route::get('/api/gradelevels', [EnrolleesController::class, 'getGradeLevelsAJAX']);
});


// CASHIER ROUTES

Route::middleware(['auth', 'throttle:auth_limited'])->group(function (){
    Route::get('/cashier-dashboard/{cashierId}', [CashierController::class, 'showDashboard'])->name('cashier-dashboard.show');
    Route::get('/profile-cashier/{cashierId}', [CashierController::class, 'showProfile'])->name('profile-cashier.show');
    Route::post('/profile-cashier/{cashierId}', [CashierController::class, 'update'])->name('profile-cashier.update');

    Route::get('/payments/admin/history', [FeeController::class, 'paymentHistoryAdmin'])->name('paymenthistoryadmin.show');
    Route::get('/admin/addfees', [FeeController::class, 'index'])->name('addfees.show');
    Route::post('/admin/addfees/add', [FeeController::class, 'store'])->name('addfees.store');

    Route::get('/admin/viewfees', [FeeListController::class, 'index'])->name('paymentList.show');
    Route::post('/admin/addfeelist', [FeeListController::class, 'store'])->name('addfeelist.store');
    Route::post('/toggle-status/{id}', [FeeListController::class, 'toggleStatus']);
});

Route::middleware(['auth', 'throttle:auth_limited'])->group(function (){
    //anyone who logged in can access
    Route::get('/notifications', [NotificationController::class, 'index']);
    Route::get('/notifications/all', [NotificationController::class, 'displayNotif'])->name('notifications.show');
    Route::post('/notifications/mark-as-read/{id}', [NotificationController::class, 'markAsRead']);
    Route::post('/notifications/clear-all', [NotificationController::class, 'clearAll']);
});


Route::get('/fees-collection', function() {
    return view('admin.fees-collection');
})->name('fees-collection');

Route::get('/expenses', function() {
    return view('admin.expenses');
})->name('expenses');

Route::get('/salary', function() {
    return view('admin.salary');
})->name('salary');

Route::get('/events', function() {
    return view('admin.events');
})->name('events');



require __DIR__.'/auth.php';
