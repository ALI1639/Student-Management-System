<?php

use App\Http\Controllers\ActivityController;
use App\Http\Controllers\AdminPasswordController;
use App\Http\Controllers\AttendanceController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DepartmentController;
use App\Http\Controllers\GlobalSearchController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\ResultController;
use App\Http\Controllers\SettingController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\SubjectController;
use App\Http\Controllers\TeacherController;
use Illuminate\Support\Facades\Route;



/*
|--------------------------------------------------------------------------
| Authentication Routes
|--------------------------------------------------------------------------
*/


Route::get(
    '/login',
    [AuthController::class, 'showLogin']
)->name('login');


Route::post(
    '/login',
    [AuthController::class, 'login']
)->name('login.store');



Route::get(
    '/register',
    [AuthController::class, 'showRegister']
)->name('register');


Route::post(
    '/register',
    [AuthController::class, 'register']
)->name('register.store');





// forget Password



Route::get(
    '/forgot-password',
    [AdminPasswordController::class, 'index']
)->name('forget.password');


Route::post(
    '/forgot-password',
    [AdminPasswordController::class, 'update']
)->name('password.update');




/*
|--------------------------------------------------------------------------
| Admin Panel Routes
|--------------------------------------------------------------------------
*/


Route::middleware(['auth', 'maintenance'])->group(function () {



    Route::get(
        '/dashboard',
        [DashboardController::class, 'index']
    )->name('dashboard');




    Route::resource(
        'departments',
        DepartmentController::class
    );

    Route::resource(
        'courses',
        CourseController::class
    );



    Route::resource(
        'students',
        StudentController::class
    );



    Route::resource(
        'teachers',
        TeacherController::class
    );



    Route::resource(
        'subjects',
        SubjectController::class
    );



    Route::resource(
        'attendances',
        AttendanceController::class
    );



    Route::resource(
        'results',
        ResultController::class
    );





    /*
    |--------------------------------------------------------------------------
    | Settings
    |--------------------------------------------------------------------------
    */


    Route::get(
        '/settings',
        [SettingController::class, 'index']
    )->name('settings.index');



    Route::post(
        '/settings/update',
        [SettingController::class, 'update']
    )->name('settings.update');


    Route::resource('activities', ActivityController::class)
        ->only('index');

    Route::delete(
        '/activities/delete-all',
        [ActivityController::class, 'destroyAll']
    )->name('destroy.activities');




    /*
    |--------------------------------------------------------------------------
    | Reports
    |--------------------------------------------------------------------------
    */


    Route::get(
        '/reports',
        [ReportController::class, 'index']
    )->name('reports.index');


    Route::get(
        '/reports/pdf',
        [ReportController::class, 'pdf']
    )->name('reports.pdf');


    Route::get(
        '/reports/excel',
        [ReportController::class, 'excel']
    )->name('reports.excel');


    Route::get(
        '/reports/print',
        [ReportController::class, 'print']
    )->name('reports.print');






    /*
    |--------------------------------------------------------------------------
    | Profile
    |--------------------------------------------------------------------------
    */


    Route::get(
        '/my-profile',
        [ProfileController::class, 'index']
    )->name('profile');


    Route::post(
        '/profile/update',
        [ProfileController::class, 'update']
    )->name('profile.update');





    // Notification Routes

    Route::get(
        '/notifications',
        [NotificationController::class, 'index']
    )->name('notifications.index');


    Route::get(
        '/notifications/read/{id}',
        [NotificationController::class, 'read']
    )->name('notifications.read');


    Route::post(
        '/notifications/read-all',
        [NotificationController::class, 'readAll']
    )->name('notifications.readAll');


    Route::delete(
        '/notifications/{id}',
        [NotificationController::class, 'destroy']
    )->name('notifications.destroy');

    Route::delete(
        '/notification/delete-all',
        [NotificationController::class, 'destroyAll']
    )->name('destroyall');

    //  Global Search

    Route::get(
        '/global-search',
        [GlobalSearchController::class, 'search']
    )->name('global.search');



    /*
    |--------------------------------------------------------------------------
    | Logout
    |--------------------------------------------------------------------------
    */


    Route::post(
        '/logout',
        [AuthController::class, 'logout']
    )->name('logout');
});
