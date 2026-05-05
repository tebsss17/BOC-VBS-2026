<?php

use App\Http\Controllers\AttendanceController;
use App\Http\Controllers\LessonController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::view('/', 'welcome')->name('home');

Route::middleware(['auth', 'verified'])->group(function () {
    Route::view('dashboard', 'dashboard')->name('dashboard');

    // User Routes
    Route::get('/users', [UserController::class, 'index'] )->name('user.index');
    Route::get('/users/create', [UserController::class, 'create'] )->name('user.create');
    Route::get('/users/{user}', [UserController::class, 'show'] )->name('user.show');
    Route::get('/users/{user}/edit', [UserController::class, 'edit'] )->name('user.edit');
    Route::post('/users', [UserController::class, 'store'] )->name('user.store');
    Route::patch('/users/{user}', [UserController::class, 'update'] )->name('user.update');
    Route::delete('/users/{user}', [UserController::class, 'destroy'] )->name('user.destroy');

    // Student Routes
    Route::get('/students', [StudentController::class, 'index'] )->name('student.index');
    Route::get('/students/create', [StudentController::class, 'create'] )->name('student.create');
    Route::get('/students/{student}', [StudentController::class, 'show'] )->name('student.show');
    Route::get('/students/{student}/edit', [StudentController::class, 'edit'] )->name('student.edit');
    Route::post('/students', [StudentController::class, 'store'] )->name('student.store');
    Route::patch('/students/{student}', [StudentController::class, 'update'] )->name('student.update');
    Route::delete('/students/{student}', [StudentController::class, 'destroy'] )->name('student.destroy');

    // Lesson Routes
    Route::get('/lessons', [LessonController::class, 'index'] )->name('lesson.index');
    Route::get('/lessons/create', [LessonController::class, 'create'] )->name('lesson.create');
    Route::get('/lessons/{lesson}', [LessonController::class, 'show'] )->name('lesson.show');
    Route::get('/lessons/{lesson}/edit', [LessonController::class, 'edit'] )->name('lesson.edit');
    Route::post('/lessons', [LessonController::class, 'store'] )->name('lesson.store');
    Route::patch('/lessons/{lesson}', [LessonController::class, 'update'] )->name('lesson.update');
    Route::delete('/lessons/{lesson}', [LessonController::class, 'destroy'] )->name('lesson.destroy');

    // Attendance Routes
    Route::get('/attendances', [AttendanceController::class, 'index'] )->name('attendance.index');
    Route::get('/lessons/create', [AttendanceController::class, 'create'] )->name('attendance.create');
    Route::get('/lessons/{lesson}', [AttendanceController::class, 'show'] )->name('attendance.show');
    Route::get('/lessons/{lesson}/edit', [AttendanceController::class, 'edit'] )->name('attendance.edit');
    Route::post('/lessons', [AttendanceController::class, 'store'] )->name('attendance.store');
    Route::patch('/lessons/{lesson}', [AttendanceController::class, 'update'] )->name('attendance.update');
    Route::delete('/lessons/{lesson}', [AttendanceController::class, 'destroy'] )->name('attendance.destroy');

    // Report Route
    Route::get('/attendances', [AttendanceController::class, 'index'] )->name('attendance.index');



});

require __DIR__.'/settings.php';
