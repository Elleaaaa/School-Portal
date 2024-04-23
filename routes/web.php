<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\FeeController;
use App\Http\Controllers\FeeListController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\SubjectController;
use App\Http\Controllers\TeacherController;
use App\Models\Fee;
use App\Models\Teacher;
use Illuminate\Support\Facades\Route;
use Spatie\FlareClient\View;

Route::get('/login', function () {
    return view('login');
})->middleware(['auth', 'verified'])->name('login'); // will redirect here after register

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// FOR LOGGING IN
Route::get('/', [LoginController::class, 'index'])->name('login');
Route::post('/login1', [LoginController::class, 'login'])->name('login1');
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');



// STUDENT ROUTES
Route::middleware('auth')->group(function () {
    Route::get('/profile-details/{studentId}', [StudentController::class, 'showProfile'])->name('profile-details.show');
    Route::get('/student-dashboard/{studentId}', [StudentController::class, 'showDashboard'])->name('student-dashboard.show');
    Route::get('/student-subjectlist/{studentId}', [StudentController::class, 'showSubjectList'])->name('student-subjectlist.show');

    Route::get('/payments/history', [FeeController::class, 'paymentHistory'])->name('paymenthistory.show');

    // update personal details for students
    Route::post('/profile-details/{id}', [StudentController::class, 'update'])->name('profile-details.update');
});




// TEACHER ROUTES
Route::middleware('auth')->group(function () {
    Route::get('/teacher-dashboard/{teacherId}', [TeacherController::class, 'showDashboard'])->name('teacher-dashboard.show');

    Route::get('/profile-teacher/{teacherId}', [TeacherController::class, 'showProfile'])->name('profile-teacher.show');
    Route::post('/profile-teacher/{id}', [TeacherController::class, 'update'])->name('profile-teacher.update'); // update personal details for teacher
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
    Route::get('/admin/addsubject', [AdminController::class, 'showAddSubject'])->name('addsubject.show');
    Route::post('/admin/addsubject', [SubjectController::class, 'store'])->name('subject.add');

    Route::get('/admin/viewfees', [FeeListController::class, 'index'])->name('paymentList.show');
    Route::post('/admin/addfeelist', [FeeListController::class, 'store'])->name('addfeelist.store');
    Route::post('/toggle-status/{id}', [FeeListController::class, 'toggleStatus']);

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

});



Route::get('/admin-dashboard', function() {
    return view('admin.dashboard');
})->name('admin-dashboard');


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
