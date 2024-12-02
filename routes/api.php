<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\OptInController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\ScheduleController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/


// Route::apiResource('courses', CourseController::class);

Route::get('courses', [CourseController::class, 'index']); // Get all courses
Route::post('courses', [CourseController::class, 'store']); // Create a new course
Route::put('courses/{id}', [CourseController::class, 'update']); // Update a course by ID
Route::delete('courses/{id}', [CourseController::class, 'destroy']); // Delete a course by ID


Route::get('student', [StudentController::class, 'index']); // Get all courses
Route::post('student', [StudentController::class, 'store']); // Create a new course
Route::put('student/{id}', [StudentController::class, 'update']); // Update a course by ID
Route::delete('student/{id}', [StudentController::class, 'destroy']); // Delete a course by ID

Route::get('schedule', [ScheduleController::class, 'index']); // Get all courses
Route::post('schedule', [ScheduleController::class, 'store']); // Create a new course
Route::put('schedule/{id}', [ScheduleController::class, 'update']); // Update a course by ID
Route::delete('schedule/{id}', [ScheduleController::class, 'destroy']); // Delete a course by ID


Route::post('opt-in', [OptInController::class, 'optIn']);
Route::post('opt-out', [OptInController::class, 'optOut']);
Route::get('opt-in-list', [OptInController::class, 'getAllActiveStudent']);

// Route::middleware('auth:sanctum')->group(function(){
// });

