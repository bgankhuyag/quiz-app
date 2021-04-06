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

Route::group(['middleware' => 'auth:api'], function () {
  Route::get('/get/{id}', [Copy_QuizController::class, 'getQuiz'])->name('get');
  Route::get('/get_quiz/{id}', [QuizController::class, 'getQuiz'])->name('getQuiz');
  Route::get('/select_category/{id}', [QuizController::class, 'selectCategory'])->name('selectCategory');

  Route::get('/get_categories', [QuizController::class, 'getCategories'])->name('getCategories');
  Route::get('/check_get_categories', [Copy_QuizController::class, 'getCategories'])->name('checkGetCategories');

  Route::post('/check_test', [Copy_QuizController::class, 'check']);
  Route::post('/check', [QuizController::class, 'check'])->name('check');

  Route::group(['middleware' => 'checkAdmin:api'], function () {
    // add and remove categories
    Route::post('/add_categories', [QuizController::class, 'addCategories'])->name('addCategories');
    Route::post('/remove_category', [QuizController::class, 'removeCategory'])->name('removeCategory');
    // add and remove questions
    Route::post('/add_question', [QuizController::class, 'addQuestion'])->name('addQuestion');
    Route::post('/remove_question', [QuizController::class, 'removeQuestion'])->name('removeQuestion');
    // add and remove options
    Route::post('/add_options', [QuizController::class, 'addOptions'])->name('addOptions');
    Route::post('/remove_option', [QuizController::class, 'removeOption'])->name('removeOption');
  });
});

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
