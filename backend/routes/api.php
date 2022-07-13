<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Models\Student;


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

//References
Route::resource('student', App\Http\Controllers\StudentController::class)->only(['index', 'store', 'update', 'show', 'destroy']);


//Registering the address to return registered students
Route::get('students', function() {
    return Student::all();
});
