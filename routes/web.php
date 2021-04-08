<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
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

Route::group([
    'prefix'     => 'admin',
    'middleware' => array_merge(
        (array) config('backpack.base.web_middleware', 'web'),
        (array) config('backpack.base.middleware_key', 'admin'),
        // (array) 'checkAdmin'
    ),
    // 'middleware' => 'checkIfAdmin',
    'namespace'  => 'App\Http\Controllers\Admin',
], function () { // custom admin routes
  // Route::get('dashboard', [HomeController::class, 'dashboard']);
  Route::get('/user', [HomeController::class, 'user'])->name('user');
  Route::get('/answer', [HomeController::class, 'answer'])->name('answer');
  Route::get('/category', [HomeController::class, 'category'])->name('category');
  Route::get('/image', [HomeController::class, 'image'])->name('image');
  Route::get('option', [HomeController::class, 'option'])->name('option');
  Route::get('question', [HomeController::class, 'question'])->name('question');
  Route::get('role', [HomeController::class, 'role'])->name('role');
  Route::get('selected', [HomeController::class, 'selected'])->name('selected');
  Route::get('subcategory', [HomeController::class, 'subcategory'])->name('subcategory');

  Route::put('/edit_user/{id}', [HomeController::class, 'editUser'])->name('editUser');
  Route::put('/edit_answer/{id}', [HomeController::class, 'editAnswer'])->name('editAnswer');
  Route::put('/edit_category/{id}', [HomeController::class, 'editCategory'])->name('editCategory');
  Route::put('/edit_image/{id}', [HomeController::class, 'editImage'])->name('editImage');
  Route::put('/edit_option/{id}', [HomeController::class, 'editOption'])->name('editOption');
  Route::put('/edit_question/{id}', [HomeController::class, 'editOption'])->name('editOption');
  Route::put('/edit_role/{id}', [HomeController::class, 'editRole'])->name('editRole');
  Route::put('/edit_selected/{id}', [HomeController::class, 'editSelected'])->name('editSelected');
  Route::put('/edit_subcategory/{id}', [HomeController::class, 'editSubcategory'])->name('editSubcategory');

  Route::get('/edit_user_page/{id}', [HomeController::class, 'editUserPage'])->name('editUserPage');
  Route::get('/edit_answer_page/{id}', [HomeController::class, 'editAnswerPage'])->name('editAnswerPage');
  Route::get('/edit_category_page/{id}', [HomeController::class, 'editCategoryPage'])->name('editCategoryPage');
  Route::get('/edit_image_page/{id}', [HomeController::class, 'editImagePage'])->name('editImagePage');
  Route::get('/edit_option_page/{id}', [HomeController::class, 'editOptionPage'])->name('editOptionPage');
  Route::get('/edit_question_page/{id}', [HomeController::class, 'editOptionPage'])->name('editOptionPage');
  Route::get('/edit_role_page/{id}', [HomeController::class, 'editRolePage'])->name('editRole');
  Route::get('/edit_selected_page/{id}', [HomeController::class, 'editSelectedPage'])->name('editSelectedPage');
  Route::get('/edit_subcategory_page/{id}', [HomeController::class, 'editSubcategoryPage'])->name('editSubcategoryPage');
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
// Route::get('/home', [App\Http\Controllers\HHomeController::class, 'index']omeController::class, 'index'])->name('home');

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
