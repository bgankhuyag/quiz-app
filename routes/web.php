<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Auth;

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
  if (Auth::guard('web')->user() == null) {
    return redirect()->route('login');
  } else {
    return redirect()->route('dashboard');
  }
});

Route::group(['prefix' => 'admin'], function() {
  // Auth::routes();
  Route::get('/login', 'App\Http\Controllers\Auth\LoginController@showLoginForm')->name('login');
  Route::post('/login', 'App\Http\Controllers\Auth\LoginController@login');
  Route::post('/logout', 'App\Http\Controllers\Auth\LoginController@logout')->name('logout');

  Route::post('/password/email', 'App\Http\Controllers\Auth\ForgotPasswordController@sendResetLinkEmail')->name('password.email');

  Route::post('/password/reset', 'App\Http\Controllers\Auth\ResetPasswordController@reset')->name('password.update');
  Route::get('/password/reset', 'App\Http\Controllers\Auth\ForgotPasswordController@showLinkRequestForm')->name('password.request');
  Route::get('/password/reset/{token}', 'App\Http\Controllers\Auth\ResetPasswordController@showResetForm')->name('password.reset');
});

Route::group([
    'prefix'     => 'admin',
    'middleware' => array_merge(
        (array) 'checkIfAdmin',
        (array) 'cache.headers:public;max_age=3600'
    ),
    // 'middleware' => 'checkIfAdmin:web',
], function () {
  Route::get('/dashboard', [HomeController::class, 'dashboard'])->name('dashboard');

  Route::get('/user', [HomeController::class, 'user'])->name('user');
  Route::get('/category', [HomeController::class, 'category'])->name('category');
  Route::get('/points', [HomeController::class, 'points'])->name('points');
  Route::get('/option', [HomeController::class, 'option'])->name('option');
  Route::get('/question', [HomeController::class, 'question'])->name('question');
  Route::get('/role', [HomeController::class, 'role'])->name('role');
  Route::get('/selected', [HomeController::class, 'selected'])->name('selected');
  Route::get('/subcategory', [HomeController::class, 'subcategory'])->name('subcategory');

  Route::post('/edit_user/{id}', [HomeController::class, 'editUser'])->name('editUser');
  Route::post('/edit_category/{id}', [HomeController::class, 'editCategory'])->name('editCategory');
  Route::post('/edit_option/{id}', [HomeController::class, 'editOption'])->name('editOption');
  Route::post('/edit_question/{id}', [HomeController::class, 'editQuestion'])->name('editQuestion');
  Route::post('/edit_role/{id}', [HomeController::class, 'editRole'])->name('editRole');
  Route::post('/edit_selected/{id}', [HomeController::class, 'editSelected'])->name('editSelected');
  Route::post('/edit_point/{id}', [HomeController::class, 'editPoint'])->name('editPoint');
  Route::post('/edit_subcategory/{id}', [HomeController::class, 'editSubcategory'])->name('editSubcategory');

  Route::post('/add_user', [HomeController::class, 'addUser'])->name('addUser');
  Route::post('/add_category', [HomeController::class, 'addCategory'])->name('addCategory');
  Route::post('/add_option', [HomeController::class, 'addOption'])->name('addOption');
  Route::post('/add_question', [HomeController::class, 'addQuestion'])->name('addQuestion');
  Route::post('/add_role', [HomeController::class, 'addRole'])->name('addRole');
  Route::post('/add_selected', [HomeController::class, 'addSelected'])->name('addSelected');
  Route::post('/add_point', [HomeController::class, 'addPoint'])->name('addPoint');
  Route::post('/add_subcategory', [HomeController::class, 'addSubcategory'])->name('addSubcategory');

  Route::post('/remove_user', [HomeController::class, 'removeUser'])->name('removeUser');
  Route::post('/remove_category', [HomeController::class, 'removeCategory'])->name('removeCategory');
  Route::post('/remove_option', [HomeController::class, 'removeOption'])->name('removeOption');
  Route::post('/remove_question', [HomeController::class, 'removeQuestion'])->name('removeQuestion');
  Route::post('/remove_role', [HomeController::class, 'removeRole'])->name('removeRole');
  Route::post('/remove_selected', [HomeController::class, 'removeSelected'])->name('removeSelected');
  Route::post('/remove_point', [HomeController::class, 'removePoint'])->name('removePoint');
  Route::post('/remove_subcategory', [HomeController::class, 'removeSubcategory'])->name('removeSubcategory');

  Route::get('/edit_user_page/{id}', [HomeController::class, 'editUserPage'])->name('editUserPage');
  Route::get('/edit_category_page/{id}', [HomeController::class, 'editCategoryPage'])->name('editCategoryPage');
  Route::get('/edit_point_page/{id}', [HomeController::class, 'editPointPage'])->name('editPointPage');
  Route::get('/edit_option_page/{id}', [HomeController::class, 'editOptionPage'])->name('editOptionPage');
  Route::get('/edit_question_page/{id}', [HomeController::class, 'editQuestionPage'])->name('editQuestionPage');
  Route::get('/edit_role_page/{id}', [HomeController::class, 'editRolePage'])->name('editRolePage');
  Route::get('/edit_selected_page/{id}', [HomeController::class, 'editSelectedPage'])->name('editSelectedPage');
  Route::get('/edit_subcategory_page/{id}', [HomeController::class, 'editSubcategoryPage'])->name('editSubcategoryPage');

  Route::get('/add_user_page', [HomeController::class, 'addUserPage'])->name('addUserPage');
  Route::get('/add_category_page', [HomeController::class, 'addCategoryPage'])->name('addCategoryPage');
  Route::get('/add_point_page', [HomeController::class, 'addPointPage'])->name('addPointPage');
  Route::get('/add_option_page', [HomeController::class, 'addOptionPage'])->name('addOptionPage');
  Route::get('/add_question_page', [HomeController::class, 'addQuestionPage'])->name('addQuestionPage');
  Route::get('/add_role_page', [HomeController::class, 'addRolePage'])->name('addRolePage');
  Route::get('/add_selected_page', [HomeController::class, 'addSelectedPage'])->name('addSelectedPage');
  Route::get('/add_subcategory_page', [HomeController::class, 'addSubcategoryPage'])->name('addSubcategoryPage');

  Route::get('/account', [HomeController::class, 'account'])->name('account');
  Route::get('/account/edit_page', [HomeController::class, 'editAccountPage'])->name('editAccountPage');
  Route::post('/account/edit', [HomeController::class, 'editAccount'])->name('editAccount');

});
