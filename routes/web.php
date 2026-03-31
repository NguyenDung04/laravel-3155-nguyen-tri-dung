<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\EnrollmentController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\BookingController;

Route::get('/', function () {
    return view('welcome');
});
 

// Resource route tự tạo CRUD
Route::resource('students', StudentController::class);
Route::resource('products', ProductController::class);
Route::resource('courses', CourseController::class);
Route::resource('enrollments', EnrollmentController::class);
Route::resource('orders', OrderController::class);
Route::resource('bookings', BookingController::class);