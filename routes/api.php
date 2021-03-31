<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\QuizController;
use App\Http\Controllers\Copy_QuizController;
use App\Http\Controllers\AuthController;

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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/get_quiz', [QuizController::class, 'getQuiz'])->name('getQuiz');

Route::get('/get_categories', [Copy_QuizController::class, 'getCategories'])->name('getCategories');
Route::post('/add_categories', [Copy_QuizController::class, 'addCategories'])->name('addCategories');
Route::post('/remove_category', [Copy_QuizController::class, 'removeCategory'])->name('removeCategory');

Route::post('/check', [Copy_QuizController::class, 'check'])->name('check');
Route::post('/remove_question', [Copy_QuizController::class, 'removeQuestion'])->name('removeQuestion');
Route::post('/add_question', [Copy_QuizController::class, 'addQuestion'])->name('addQuestion');
Route::post('/add_options', [Copy_QuizController::class, 'addOptions'])->name('addOptions');
Route::post('/remove_option', [Copy_QuizController::class, 'removeOption'])->name('removeOption');

Route::group([
    'middleware' => 'api',
    'prefix' => 'auth'

], function ($router) {
    Route::post('/register', [AuthController::class, 'register'])->name('register');
    Route::post('/login', [AuthController::class, 'login']);
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::post('/refresh', [AuthController::class, 'refresh']);
    Route::get('/user-profile', [AuthController::class, 'userProfile']);
});
