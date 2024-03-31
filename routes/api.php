<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\EducationController;
use App\Http\Controllers\UserController;

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::group([

    'middleware' => 'api',
    'prefix' => 'auth'

], function ($router) {
    Route::post('adminlogin', [AdminController::class,'adminlogin'])->name('adminlogin');
    Route::post('Adminregister', [AdminController::class,'Adminregister'])->name('Adminregister');
    Route::post('logoutAdmin', [AdminController::class,'logoutAdmin'])->name('logoutAdmin');
    Route::get('profileAdmin', [AdminController::class,'profileAdmin'])->name('profileAdmin');

    // edducation
    Route::post('Educationlogin', [EducationController::class,'Educationlogin'])->name('Educationlogin');
    Route::post('Educationregister', [EducationController::class,'Educationregister'])->name('Educationregister');
    Route::post('logoutEducation', [EducationController::class,'logoutEducation'])->name('logoutEducation');
    Route::get('profileEducation', [EducationController::class,'profileEducation'])->name('profileEducation');



    Route::post('registerUser', [UserController::class,'registerUser'])->name('registerUser');
    Route::post('loginUser', [UserController::class,'loginUser'])->name('loginUser');

    Route::get('profileUser', [UserController::class,'profileUser'])->name('profileUser');

    Route::post('logoutUser', [UserController::class,'logoutUser'])->name('logoutUser');

});
