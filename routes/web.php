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
  // return view('welcome');
  return redirect()->guest(backpack_url('login'));
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
  Route::get('/points', [HomeController::class, 'points'])->name('points');
  Route::get('option', [HomeController::class, 'option'])->name('option');
  Route::get('question', [HomeController::class, 'question'])->name('question');
  Route::get('role', [HomeController::class, 'role'])->name('role');
  Route::get('selected', [HomeController::class, 'selected'])->name('selected');
  Route::get('subcategory', [HomeController::class, 'subcategory'])->name('subcategory');

  Route::post('/edit_user/{id}', [HomeController::class, 'editUser'])->name('editUser');
  Route::post('/edit_answer/{id}', [HomeController::class, 'editAnswer'])->name('editAnswer');
  Route::post('/edit_category/{id}', [HomeController::class, 'editCategory'])->name('editCategory');
  Route::post('/edit_image/{id}', [HomeController::class, 'editImage'])->name('editImage');
  Route::post('/edit_option/{id}', [HomeController::class, 'editOption'])->name('editOption');
  Route::post('/edit_question/{id}', [HomeController::class, 'editQuestion'])->name('editQuestion');
  Route::post('/edit_role/{id}', [HomeController::class, 'editRole'])->name('editRole');
  Route::post('/edit_selected/{id}', [HomeController::class, 'editSelected'])->name('editSelected');
  Route::post('/edit_point/{id}', [HomeController::class, 'editPoint'])->name('editPoint');
  Route::post('/edit_subcategory/{id}', [HomeController::class, 'editSubcategory'])->name('editSubcategory');

  Route::post('/add_user', [HomeController::class, 'addUser'])->name('addUser');
  Route::post('/add_answer', [HomeController::class, 'addAnswer'])->name('addAnswer');
  Route::post('/add_category', [HomeController::class, 'addCategory'])->name('addCategory');
  Route::post('/add_image', [HomeController::class, 'addImage'])->name('addImage');
  Route::post('/add_option', [HomeController::class, 'addOption'])->name('addOption');
  Route::post('/add_question', [HomeController::class, 'addQuestion'])->name('addQuestion');
  Route::post('/add_role', [HomeController::class, 'addRole'])->name('addRole');
  Route::post('/add_selected', [HomeController::class, 'addSelected'])->name('addSelected');
  Route::post('/add_point', [HomeController::class, 'addPoint'])->name('addPoint');
  Route::post('/add_subcategory', [HomeController::class, 'addSubcategory'])->name('addSubcategory');

  Route::get('/remove_user', [HomeController::class, 'removeUser'])->name('removeUser');
  Route::get('/remove_answer', [HomeController::class, 'removeAnswer'])->name('removeAnswer');
  Route::get('/remove_category', [HomeController::class, 'removeCategory'])->name('removeCategory');
  Route::get('/remove_image', [HomeController::class, 'removeImage'])->name('removeImage');
  Route::get('/remove_option', [HomeController::class, 'removeOption'])->name('removeOption');
  Route::get('/remove_question', [HomeController::class, 'removeQuestion'])->name('removeQuestion');
  Route::get('/remove_role', [HomeController::class, 'removeRole'])->name('removeRole');
  Route::get('/remove_selected', [HomeController::class, 'removeSelected'])->name('removeSelected');
  Route::get('/remove_point', [HomeController::class, 'removePoint'])->name('removePoint');
  Route::get('/remove_subcategory', [HomeController::class, 'removeSubcategory'])->name('removeSubcategory');

  Route::get('/edit_user_page/{id}', [HomeController::class, 'editUserPage'])->name('editUserPage');
  Route::get('/edit_answer_page/{id}', [HomeController::class, 'editAnswerPage'])->name('editAnswerPage');
  Route::get('/edit_category_page/{id}', [HomeController::class, 'editCategoryPage'])->name('editCategoryPage');
  Route::get('/edit_image_page/{id}', [HomeController::class, 'editImagePage'])->name('editImagePage');
  Route::get('/edit_point_page/{id}', [HomeController::class, 'editPointPage'])->name('editPointPage');
  Route::get('/edit_option_page/{id}', [HomeController::class, 'editOptionPage'])->name('editOptionPage');
  Route::get('/edit_question_page/{id}', [HomeController::class, 'editQuestionPage'])->name('editQuestionPage');
  Route::get('/edit_role_page/{id}', [HomeController::class, 'editRolePage'])->name('editRolePage');
  Route::get('/edit_selected_page/{id}', [HomeController::class, 'editSelectedPage'])->name('editSelectedPage');
  Route::get('/edit_subcategory_page/{id}', [HomeController::class, 'editSubcategoryPage'])->name('editSubcategoryPage');

  Route::get('/add_user_page', [HomeController::class, 'addUserPage'])->name('addUserPage');
  Route::get('/add_answer_page', [HomeController::class, 'addAnswerPage'])->name('addAnswerPage');
  Route::get('/add_category_page', [HomeController::class, 'addCategoryPage'])->name('addCategoryPage');
  Route::get('/add_image_page', [HomeController::class, 'addImagePage'])->name('addImagePage');
  Route::get('/add_point_page', [HomeController::class, 'addPointPage'])->name('addPointPage');
  Route::get('/add_option_page', [HomeController::class, 'addOptionPage'])->name('addOptionPage');
  Route::get('/add_question_page', [HomeController::class, 'addQuestionPage'])->name('addQuestionPage');
  Route::get('/add_role_page', [HomeController::class, 'addRolePage'])->name('addRolePage');
  Route::get('/add_selected_page', [HomeController::class, 'addSelectedPage'])->name('addSelectedPage');
  Route::get('/add_subcategory_page', [HomeController::class, 'addSubcategoryPage'])->name('addSubcategoryPage');
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

// Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
