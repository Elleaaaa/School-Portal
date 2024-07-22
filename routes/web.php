<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\CalendarController;
use App\Http\Controllers\EmailController;
use App\Http\Controllers\EnrolleesController;
use App\Http\Controllers\EventController;
use App\Http\Controllers\FeeController;
use App\Http\Controllers\FeeListController;
use App\Http\Controllers\GradeController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\SectionController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\SubjectController;
use App\Http\Controllers\TeacherController;

use Illuminate\Support\Facades\Route;

Route::get('/login', function () {
    return view('login');
})->middleware(['auth', 'verified'])->name('login'); // will redirect here after register

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware('guest')->group(function () {
    // FOR LOGGING IN
    Route::get('/', [LoginController::class, 'index'])->name('login');
    Route::post('/login1', [LoginController::class, 'login'])->name('login1');
    Route::post('/logout', [LoginController::class, 'logout'])->name('logout');
});


// STUDENT ROUTES
Route::middleware('auth')->group(function () {
    Route::get('/profile-details/{studentId}', [StudentController::class, 'showProfile'])->name('profile-details.show');
    Route::get('/student-dashboard/{studentId}', [StudentController::class, 'showDashboard'])->name('student-dashboard.show');
    Route::get('/student-subjectlist/{studentId}', [StudentController::class, 'showSubjectList'])->name('student-subjectlist.show');

    Route::get('/student-grades/{studentId}', [StudentController::class, 'showGrades'])->name('student-grades.show');

    // update personal details for students
    Route::post('/profile-details/{id}', [StudentController::class, 'update'])->name('profile-details.update');

    Route::get('/payments/history', [FeeController::class, 'paymentHistory'])->name('paymenthistory.show');

    Route::get('/myschedule', [CalendarController::class, 'studentSchedule'])->name('schedule.show');

    Route::get('/enrollment', [EnrolleesController::class, 'selfEnrollment'])->name('selfEnrollment.show');
    Route::post('/selfenroll', [EnrolleesController::class, 'selfenroll'])->name('selfEnroll.store');

    Route::get('/fees/invoice', [StudentController::class, 'showInvoice'])->name('invoice.show');
});




// TEACHER ROUTES
Route::middleware('auth')->group(function () {
    Route::get('/teacher-dashboard/{teacherId}', [TeacherController::class, 'showDashboard'])->name('teacher-dashboard.show');

    Route::get('/profile-teacher/{teacherId}', [TeacherController::class, 'showProfile'])->name('profile-teacher.show');
    Route::post('/profile-teacher/{id}', [TeacherController::class, 'update'])->name('profile-teacher.update'); // update personal details for teacher

    Route::get('/mystudents', [TeacherController::class, 'showStudents'])->name('students.show');

    Route::get('/students/grades', [TeacherController::class, 'showStudentsGrade'])->name('studentsgrade.show');
    Route::post('/students/grades/update/{id}', [GradeController::class, 'update'])->name('studentsgrade.update');
    Route::post('/students/grades/import', [GradeController::class, 'importGrade'])->name('grades.import');

    Route::get('/schedule', [CalendarController::class, 'teacherSchedule'])->name('teacherSchedule.show');
});


// ADMIN ROUTES
Route::middleware('auth')->group(function () {
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

    Route::get('/admin/viewfees', [FeeListController::class, 'index'])->name('paymentList.show');
    Route::post('/admin/addfeelist', [FeeListController::class, 'store'])->name('addfeelist.store');
    Route::post('/toggle-status/{id}', [FeeListController::class, 'toggleStatus']);

    Route::get('/admin/edit-student/{id}', [StudentController::class, 'showEditStudent'])->name('edit-student.show');
    Route::post('/admin/edit-student/{id}', [StudentController::class, 'updateAdmin'])->name('edit-student.update');
    Route::get('/admin/addstudent', [StudentController::class, 'index'])->name('addstudent.show');
    Route::post('/admin/addstudent', [StudentController::class, 'store'])->name('addstudent.store');

    Route::get('/admin/edit-teacher/{id}', [TeacherController::class, 'showEditTeacher'])->name('edit-teacher.show');
    Route::post('/admin/edit-teacher/{id}', [TeacherController::class, 'updateAdmin'])->name('edit-teacher.update');
    Route::get('/admin/addteacher', [TeacherController::class, 'index'])->name('addteacher.show');
    Route::post('/admin/addteacher', [TeacherController::class, 'store'])->name('addteacher.store');

    Route::get('/payments/admin/history', [FeeController::class, 'paymentHistoryAdmin'])->name('paymenthistoryadmin.show');
    Route::get('/admin/addfees', [FeeController::class, 'index'])->name('addfees.show');
    Route::post('/admin/addfees/add', [FeeController::class, 'store'])->name('addfees.store');
    Route::post('/fetch-student-details', [FeeController::class, 'fetchStudentDetails']);

    Route::post('/fetch-student-grade-level', [FeeController::class, 'fetchStudentGlevel']);

    Route::get('/admin/edit-section/{id}', [SectionController::class, 'showEditSection'])->name('edit-section.show');
    Route::post('/admin/edit-section/{id}', [SectionController::class, 'update'])->name('edit-section.update');
    Route::get('/admin/addsection', [SectionController::class, 'index'])->name('add-section.show');
    Route::post('/admin/addsection', [SectionController::class, 'store'])->name('add-section.store');
    Route::get('/admin/sectionlist', [SectionController::class, 'showSectionList'])->name('sectionlist.show');

    Route::get('/fetch-sections', [SectionController::class, 'fetchSection'])->name('section.show');

    Route::get('/admin/enroll-student/{id}', [EnrolleesController::class, 'showEditEnrollStudent'])->name('edit-enroll-student.show');
    Route::post('/admin/enroll-student/{id}', [EnrolleesController::class, 'update'])->name('edit-enroll-student.update');
    Route::get('/admin/enroll-student', [EnrolleesController::class, 'index'])->name('enroll-student.show');
    Route::post('/admin/enroll-student', [EnrolleesController::class, 'store'])->name('enroll-student.store');
    Route::get('/admin/enrolled-student-list', [AdminController::class, 'showEnrolledStudents'])->name('enrolled-student-list.show');
    Route::get('/admin/pending-student-list', [AdminController::class, 'showPendingStudents'])->name('pending-student-list.show');

    Route::get('/admin/calendar', [CalendarController::class, 'schedule'])->name('calendar.show');

    Route::get('/admin/edit-timetable/{id}', [CalendarController::class, 'showEditTimeTable'])->name('edit-timetable.show');
    Route::post('/admin/edit-timetable/{id}', [CalendarController::class, 'editTimeTable'])->name('edit-timetable.update');
    Route::get('/admin/time-table', [CalendarController::class, 'timeTable'])->name('timeTable.show');
    Route::get('/admin/time-table/add', [CalendarController::class, 'timeTableAdd'])->name('add-timetable.show');
    Route::post('/admin/time-table/add', [CalendarController::class, 'store'])->name('add-timetable.store');


    //EVENT CALENDAR
    Route::post('/update-event/{id}', [EventController::class, 'update'])->name('events.update');
    Route::get('/get-events', [EventController::class, 'getEvents'])->name('events.get');
    Route::post('/add-event', [EventController::class, 'store'])->name('events.store');

});

//anyone who logged in can access
Route::middleware('auth')->group(function () {
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
