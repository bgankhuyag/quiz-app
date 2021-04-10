<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Answers;
use App\Models\User;
use App\Models\Questions;
use App\Models\Selected;
use App\Models\Roles;
use App\Models\Points;
use App\Models\Categories;
use App\Models\SubCategories;
use App\Models\Images;
use App\Models\Options;
use Illuminate\Support\Facades\Schema;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('checkIfAdmin');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home');
    }

    public function dashboard() {
      // dd("here");
      return view('dashboard');
    }

    public function user() {
      $users = User::paginate(10);
      return view('user', ['users' => $users]);
    }

    public function answer() {
      $answers = Answers::paginate(10);
      return view('answer', ['answers' => $answers]);
    }

    public function category() {
      $categories = Categories::paginate(10);
      return view('category', ['categories' => $categories]);
    }

    public function image() {
      $images = Images::paginate(10);
      return view('image', ['images' => $images]);
    }

    public function points() {
      $points = Points::paginate(10);
      return view('points', ['points' => $points]);
    }

    public function option() {
      $options = Options::paginate(10);
      return view('option', ['options' => $options]);
    }

    public function question() {
      $questions = Questions::paginate(10);
      return view('question', ['questions' => $questions]);
    }

    public function role() {
      $roles = Roles::paginate(10);
      return view('role', ['roles' => $roles]);
    }

    public function selected() {
      $selecteds = Selected::paginate(10);
      return view('selected', ['selecteds' => $selecteds]);
    }

    public function subcategory() {
      $sub_categories = SubCategories::paginate(10);
      return view('subcategory', ['sub_categories' => $sub_categories]);
    }

    public function editUser($id) {

    }

    public function editAnswer($id) {

    }

    public function editCategory($id) {

    }

    public function editSubcategory($id) {

    }

    public function editImage($id) {

    }

    public function editOption($id) {

    }

    public function editQuestion($id) {

    }

    public function editRole($id) {

    }

    public function editSelected($id) {

    }

    public function editUserPage($id) {
      $user = User::firstWhere('id', $id);
      $roles = Roles::all();
      return view('editPages.edit_user', ['user' => $user, 'roles' => $roles]);
    }

    public function editAnswerPage($id) {
      $answer = Answers::firstWhere('id', $id);
      $questions = Questions::all();
      $options = Options::all();
      $data = ['options' => $options, 'questions' => $questions, 'answer' => $answer];
      return view('editPages.edit_answer', $data);
    }

    public function editCategoryPage($id) {

    }

    public function editSubcategoryPage($id) {
      $sub_category = SubCategories::firstWhere('id', $id);
      $categories = Categories::all();
      return view('editPages.edit_subcategory', ['sub_category' => $sub_category, 'categories' => $categories]);
    }

    public function editImagePage($id) {

    }

    public function editPointPage($id) {
      $point = Points::firstWhere('id', $id);
      $users = User::all();
      $categories = Categories::all();
      $data = [
        'point' => $point,
        'users' => $users,
        'categories' => $categories
      ];
      return view('editPages.edit_point', $data);
    }

    public function editOptionPage($id) {
      $option = Options::firstWhere('id', $id);
      $questions = Questions::all();
      return view('editPages.edit_option', ['option' => $option, 'questions' => $questions]);
    }

    public function editQuestionPage($id) {
      $question = Questions::firstWhere('id', $id);
      $categories = Categories::all();
      $sub_categories = SubCategories::all();
      $options = Options::all();
      $data = [
        'question' => $question,
        'categories' => $categories,
        'sub_categories' => $sub_categories,
        'options' => $options
      ];
      // dd($sub_categories);
      return view('editPages.edit_question', $data);
    }

    public function editRolePage($id) {
      $role = Roles::firstWhere('id', $id);
      return view('editPages.edit_role', ['role' => $role]);
    }

    public function editSelectedPage($id) {
      $selected = Selected::firstWhere('id', $id);
      $questions = Questions::all();
      $options = Options::all();
      $users = User::all();
      $data = [
        'selected' => $selected,
        'questions' => $questions,
        'options' => $options,
        'users' => $users
      ];
      return view('editPages.edit_selected', $data);
    }
}
