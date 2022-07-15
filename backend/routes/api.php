<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Models\Student;
use App\Http\Controllers\StudentController;



/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});



//Registering the address to return registered students
Route::get('/student', function() {
    return Student::all();
});

/*  */
/* Route for SAVE*/
Route::post('/student/register', [StudentController::class, 'store']);

/* Route for Searc*/
Route::get('/student/{id}', [StudentController::class, 'show']);

/* Route for Delete */
Route::delete('/student/{id}', [StudentController::class, 'destroy']);

/* Route for Update */
Route::put('/student/{id}', [StudentController::class, 'update']);
