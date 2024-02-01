<?php

use App\Http\Controllers\Api\AttendeeController;
use App\Http\Controllers\Api\AttendenceController;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\LectureController;
use App\Http\Controllers\Api\NotificationController;
use App\Http\Controllers\Api\PackageController;
use App\Http\Controllers\Api\SubjectController;

use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Route;

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

Route::controller(AuthController::class)->group(function () {
    // Route::get('user', "getUserInfo")->middleware('auth:sanctum');
    // Route::get('my_payments', 'myPayments')->middleware('auth:sanctum');
    // Route::post('reset-token', 'resetTokenDate')->middleware('auth:sanctum'); //for front developer

    Route::post('register', [\App\Http\Controllers\Api\AuthController::class, 'registerStudent']);
    Route::post('confirmOtp', [\App\Http\Controllers\Api\AuthController::class, 'confirmOtp']);
    Route::post('resendOtp', [\App\Http\Controllers\Api\AuthController::class, 'resendOtp']);
    Route::post('login', [\App\Http\Controllers\Api\AuthController::class, 'login']);
});


Route::get('my_public_classes', [\App\Http\Controllers\Api\PackageController::class, "getPublicSubjects"]);

Route::middleware('auth:sanctum')->group(function () {

    Route::controller(PackageController::class)->group(function () {
        Route::get('my_classes',  "getSubjects");
        Route::get('my_class', "getMySubjects"); //صفوفي
    });
    Route::controller(NotificationController::class)->group(function () {
        Route::get('/my_notifications_all',  'index');
        Route::get('/my_notifications_unseen',  'unseen');
        Route::post('/my_notifications',  'see');
    });
    Route::controller(LectureController::class)->group(function () {
        Route::get('time_table',  'timeTable');
        Route::get('lecture/{id}',  'show');
    });


    // Route::get('attend/{lecture_id}', [AttendeeController::class, 'attend']);
    Route::controller(AttendenceController::class)->group(function () {
        Route::get('getTodayAttendences ', 'getTodayAttendences');
        Route::post('setAttendence/{lecture_id}',  'setAttendence');
    });

    Route::post('class_order_create', [SubjectController::class, 'subscribe']); /**** review need prevent resubcribe */
});





Route::get('test/{p}', function ($p) {  
    return Hash::make($p);
});
