<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LessonController;
use App\Http\Controllers\Dashboard\UserController;
use App\Models\Lesson;





Route::get('/', function () {
    return view('welcome');
});



use App\Http\Controllers\MeetingController;



Route::middleware('auth')->group(function () {
    Route::get('/meetings', [MeetingController::class, 'index'])->name('meetings.index');
    Route::get('/meetings/dashboard', [MeetingController::class, 'dashboard'])->name('dashboard.meetings.index');
    Route::get('/meetings/create', [MeetingController::class, 'create'])->name('meetings.create');
    Route::post('/meetings', [MeetingController::class, 'store'])->name('meetings.store');
    Route::get('/meetings/{meeting}/edit', [MeetingController::class, 'edit'])->name('meetings.edit');
    Route::put('/meetings/{meeting}', [MeetingController::class, 'update'])->name('meetings.update');
    Route::delete('/meetings/{meeting}', [MeetingController::class, 'destroy'])->name('meetings.destroy');
    Route::get('/meetings/{meeting}', [MeetingController::class, 'show'])->name('meetings.show');
});



use App\Http\Controllers\ExamController;
Route::middleware('auth')->group(function () {
    Route::get('/exams', [ExamController::class, 'index'])->name('exams.index');
    Route::get('/exams/create', [ExamController::class, 'create'])->name('exams.create');
    Route::get('/exams/dashboard', [ExamController::class, 'dashboard'])->name('exams.dashboard');
    Route::post('/exams', [ExamController::class, 'store'])->name('exams.store');
    Route::get('/exams/{id}', [ExamController::class, 'show'])->name('exams.show');
    Route::get('/exams/{id}/edit', [ExamController::class, 'edit'])->name('exams.edit');
    Route::put('/exams/{id}', [ExamController::class, 'update'])->name('exams.update');
    Route::delete('/exams/{id}', [ExamController::class, 'destroy'])->name('exams.destroy');
});




Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get('/lessons', [LessonController::class, 'index'])->name('lessons.index');
    Route::get('/lessons/create', [LessonController::class, 'create'])->name('lessons.create');
    Route::get('/lessons/{lesson}', [LessonController::class, 'show'])->name('lessons.show');
    Route::post('/lessons', [LessonController::class, 'store'])->name('lessons.store');
    Route::get('/lessons/{lesson}/edit', [LessonController::class, 'edit'])->name('lessons.edit');
    Route::put('/lessons/{lesson}', [LessonController::class, 'update'])->name('lessons.update');
    Route::delete('/lessons/{lesson}', [LessonController::class, 'destroy'])->name('lessons.destroy');
    Route::get('/dashboard', [LessonController::class, 'dashboard'])->name('dashboard');


    Route::get('/users', [UserController::class, 'index'])->name('dashboard.users.index');
    Route::get('/users/{user}/edit', [UserController::class, 'edit'])->name('dashboard.users.edit');
    Route::put('/users/{user}', [UserController::class, 'update'])->name('dashboard.users.update');
    Route::delete('/users/{user}', [UserController::class, 'destroy'])->name('dashboard.users.destroy');

});



use App\Http\Controllers\MaterialController;

Route::middleware(['auth'])->group(function () {
    Route::get('/materials', [MaterialController::class, 'index'])->name('materials.index');
    Route::get('/materials/create', [MaterialController::class, 'create'])->name('materials.create');
    Route::get('/materials/{material}/edit', [MaterialController::class, 'edit'])->name('materials.edit');
    Route::post('/materials', [MaterialController::class, 'store'])->name('materials.store');
    Route::get('/materials/dashboard', [MaterialController::class, 'dashboard'])->name('materials.dashboard');
    Route::put('/materials/{material}', [MaterialController::class, 'update'])->name('materials.update');
    Route::get('/materials/{material}', [MaterialController::class, 'show'])->name('materials.show');
    Route::delete('/materials/{material}', [MaterialController::class, 'destroy'])->name('materials.destroy');
});


use App\Http\Controllers\Auth\RegisteredUserController;
Route::middleware(['auth'])->group(function () {

    Route::get('register', [RegisteredUserController::class, 'create'])
        ->name('register');

    Route::post('register', [RegisteredUserController::class, 'store']);
});

require __DIR__ . '/auth.php';
