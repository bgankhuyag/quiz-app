<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Copy_QuizController;
use App\Models\Answers;
use App\Models\User;
use App\Models\Questions;
use App\Models\Selected;
use App\Models\Categories;
use App\Models\SubCategories;
use App\Models\Images;
use App\Models\Options;
// use App\Models\Options;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
  return view('welcome');
});

Route::get('/test', function () {
  $users = User::all();
  $answers = Answers::all();
  $questions = Questions::all();
  $selected = Selected::all();
  $categories = Categories::all();
  $sub_categories = SubCategories::all();
  $images = Images::all();
  $options = Options::all();
  $data = [$users, $answers, $questions, $selected, $categories, $sub_categories, $images, $options];
  // dd($data);
  return view('test', ['users' => $users, 'answers' => $answers, 'questions' => $questions, 'selecteds' => $selected, 'categories' => $categories, 'sub_categories' => $sub_categories, 'images' => $images, 'options' => $options]);
});


// Route::get('/test', [Copy_QuizController::class, 'test'])->name('test');
// Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

// Auth::routes();
// Route::group([
//     'prefix'     => config('backpack.base.route_prefix', 'admin'),
//     'middleware' => array_merge(
//         (array) config('backpack.base.web_middleware', 'web'),
//         // (array) config('backpack.base.middleware_key', 'admin')
//     ),
//     // 'middleware' => 'checkAdmin',
//     'namespace'  => 'App\Http\Controllers\Admin',
// ], function () { // custom admin routes
// }); // this should be the absolute last line of this file

// Auth::routes();


Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
