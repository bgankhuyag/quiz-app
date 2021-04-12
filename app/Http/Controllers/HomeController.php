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
      $user = User::firstWhere('id', $id);
    }

    public function editAnswer($id) {

    }

    public function editCategory($id) {

    }

    public function editSubcategory($id) {

    }

    public function editImage($id) {

    }

    public function editPoint($id) {

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
      $new = false;
      $user = User::firstWhere('id', $id);
      $roles = Roles::all();
      $action = route('editUser', ['id' => $id]);
      return view('editPages.edit_user', ['new' => $new, 'user' => $user, 'roles' => $roles, 'action' => $action]);
    }

    public function editAnswerPage($id) {
      $answer = Answers::firstWhere('id', $id);
      $questions = Questions::all();
      $options = Options::all();
      $data = ['options' => $options, 'questions' => $questions, 'answer' => $answer];
      return view('editPages.edit_answer', $data);
    }

    public function editCategoryPage($id) {
      $new = false;
      $category = Categories::firstWhere('id', $id);
      $action = route('editCategory', ['id' => $id]);
      return view('editPages.edit_category',['new' => $new, 'category' => $category, 'action' => $action]);
    }

    public function editSubcategoryPage($id) {
      $new = false;
      $sub_category = SubCategories::firstWhere('id', $id);
      $categories = Categories::all();
      $action = route('editSubcategory', ['id' => $id]);
      return view('editPages.edit_subcategory', ['new' => $new, 'sub_category' => $sub_category, 'categories' => $categories, 'action' => $action]);
    }

    public function editImagePage($id) {
      $image = Images::firstWhere('id', $id);
    }

    public function editPointPage($id) {
      $new = false;
      $point = Points::firstWhere('id', $id);
      $users = User::all();
      $categories = Categories::all();
      $action = route('editPoint', ['id' => $id]);
      $data = [
        'new' => $new,
        'point' => $point,
        'users' => $users,
        'categories' => $categories,
        'action' => $action
      ];
      return view('editPages.edit_point', $data);
    }

    public function editOptionPage($id) {
      $new = false;
      $option = Options::firstWhere('id', $id);
      $questions = Questions::all();
      $action = route('editOption', ['id' => $id]);
      return view('editPages.edit_option', ['new' => $new, 'option' => $option, 'questions' => $questions, 'action' => $action]);
    }

    public function editQuestionPage($id) {
      $new = false;
      $question = Questions::firstWhere('id', $id);
      $categories = Categories::all();
      $sub_categories = SubCategories::all();
      $options = Options::all();
      $action = route('editQuestion', ['id' => $id]);
      $data = [
        'action' => $action,
        'new' => $new,
        'question' => $question,
        'categories' => $categories,
        'sub_categories' => $sub_categories,
        'options' => $options
      ];
      // dd($sub_categories);
      return view('editPages.edit_question', $data);
    }

    public function editRolePage($id) {
      $new = false;
      $role = Roles::firstWhere('id', $id);
      $action = route('editRole', ['id' => $id]);
      return view('editPages.edit_role', ['action' => $action, 'new' => $new, 'role' => $role]);
    }

    public function editSelectedPage($id) {
      $new = false;
      $selected = Selected::firstWhere('id', $id);
      $questions = Questions::all();
      $options = Options::all();
      $users = User::all();
      $action = route('editSelected', ['id' => $id]);
      $data = [
        'action' => $action,
        'new' => $new,
        'selected' => $selected,
        'questions' => $questions,
        'options' => $options,
        'users' => $users
      ];
      return view('editPages.edit_selected', $data);
    }

    public function addUserPage() {
      // $user = User::firstWhere('id', $id);
      $new = true;
      $roles = Roles::all();
      $action = route('addUser');
      return view('editPages.edit_user', ['new' => $new, 'roles' => $roles, 'action' => $action]);
    }

    public function addAnswerPage() {
      $answer = Answers::firstWhere('id', $id);
      $questions = Questions::all();
      $options = Options::all();
      $data = ['options' => $options, 'questions' => $questions, 'answer' => $answer];
      return view('editPages.edit_answer', $data);
    }

    public function addCategoryPage() {
      // $category = Categories::firstWhere('id', $id);
      $new = true;
      $action = route('addCategory');
      return view('editPages.edit_category',['new' => $new, 'action' => $action]);
    }

    public function addSubcategoryPage() {
      // $sub_category = SubCategories::firstWhere('id', $id);
      $new = true;
      $categories = Categories::all();
      $action = route('addSubcategory');
      return view('editPages.edit_subcategory', ['new' => $new, 'categories' => $categories, 'action' => $action]);
    }

    public function addImagePage() {
      $image = Images::firstWhere('id', $id);
    }

    public function addPointPage() {
      // $point = Points::firstWhere('id', $id);
      $new = true;
      $users = User::all();
      $categories = Categories::all();
      $action = route('addPoint');
      $data = [
        'new' => $new,
        'users' => $users,
        'categories' => $categories,
        'action' => $action
      ];
      return view('editPages.edit_point', $data);
    }

    public function addOptionPage() {
      // $option = Options::firstWhere('id', $id);
      $new = true;
      $questions = Questions::all();
      $action = route('addOption');
      return view('editPages.edit_option', ['questions' => $questions, 'new' => $new, 'action' => $action]);
    }

    public function addQuestionPage() {
      // $question = Questions::firstWhere('id', $id);
      $new = true;
      $categories = Categories::all();
      $sub_categories = SubCategories::all();
      $options = Options::all();
      $action = route('addQuestion');
      $data = [
        'new' => $new,
        'categories' => $categories,
        'sub_categories' => $sub_categories,
        'options' => $options,
        'action' => $action
      ];
      return view('editPages.edit_question', $data);
    }

    public function addRolePage() {
      // $role = Roles::firstWhere('id', $id);
      $new = true;
      $action = route('addRole');
      return view('editPages.edit_role', ['new' => $new, 'action' => $action]);
    }

    public function addSelectedPage() {
      // $selected = Selected::firstWhere('id', $id);
      $new = true;
      $questions = Questions::all();
      $options = Options::all();
      $users = User::all();
      $action = route('addSelected');
      $data = [
        'new' => $new,
        'action' => $action,
        'questions' => $questions,
        'options' => $options,
        'users' => $users
      ];
      return view('editPages.edit_selected', $data);
    }
}
