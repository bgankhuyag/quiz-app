<?php

use App\Http\Controllers\HomeController;
// --------------------------
// Custom Backpack Routes
// --------------------------
// This route file is loaded automatically by Backpack\Base.
// Routes you generate using Backpack\Generators will be placed here.

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
  Route::crud('user', 'UserCrudController');
  Route::crud('answer', 'AnswerCrudController');
  Route::crud('category', 'CategoryCrudController');
  Route::crud('image', 'ImageCrudController');
  Route::crud('option', 'OptionCrudController');
  Route::crud('question', 'QuestionCrudController');
  Route::crud('role', 'RoleCrudController');
  Route::crud('selected', 'SelectedCrudController');
  // Route::crud('subcategory', 'SubcategoryCrudController');
  Route::crud('subcategory', 'SubCategoryCrudController');
  // Route::crud('selected', 'SelectedCrudController');
}); // this should be the absolute last line of this file
