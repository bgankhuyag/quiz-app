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
use Validator;
use Illuminate\Validation\Rule;

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

    public function editUser(Request $request, $id) {
      $user = User::firstWhere('id', $id);
      $validator = Validator::make($request->all(), [
        'name' => 'required|string|between:2,100',
        'email' => ['required', 'string', 'email', 'max:100', Rule::unique('users')->ignore($user->id)],
        'role_id' => 'required|integer|min:1',
      ]);
      if($validator->fails()){
        return redirect()->back()->withErrors($validator->errors());
      }
      $user->name = $request->input('name');
      $user->email = $request->input('email');
      $user->roles_id = $request->input('role_id');
      $user->save();
      return redirect()->route('user');
    }

    public function editAnswer($id) {

    }

    public function editCategory(Request $request, $id) {
      $validator = Validator::make($request->all(), [
        'category' => 'required|string',
        'image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048|nullable',
      ]);
      if($validator->fails()){
        return redirect()->back()->withErrors($validator->errors());
      }
      $category = Categories::firstWhere('id', $id);
      $category->category = $request->category;
      if (!empty($request->image)) {
        if (!empty($category->getRawOriginal('image'))){
          $image_path = public_path('images/') . $category->getRawOriginal('image');
          unlink($image_path);
        }
        $image_name = time() . '.' . $request->image->getClientOriginalName();
        $request->image->move(public_path('images'), $image_name);
        $category->image = $image_name;
      }
      $category->save();
      return redirect()->route('category');
    }

    public function editSubcategory(Request $request, $id) {
      $validator = Validator::make($request->all(), [
        'category_id' => 'required|integer|min:1',
        'subcategory' => 'required|string',
      ]);
      if($validator->fails()){
        return redirect()->back()->withErrors($validator->errors());
      }
      $sub_category = SubCategories::firstWhere('id', $id);
      $sub_categories->categories_id = $request->category_id;
      $sub_category->sub_category = $request->subcategory;
      $sub_category->save();
      return redirect()->route('subcategory');
    }

    public function editImage($id) {

    }

    public function editPoint(Request $request, $id) {
      $validator = Validator::make($request->all(), [
        'category_id' => 'required|integer|min:1',
        'user_id' => 'required|integer|min:1',
        'point' => 'required|integer|min:0',
      ]);
      if($validator->fails()){
        return redirect()->back()->withErrors($validator->errors());
      }
      $point = Points::firstWhere('id', $id);
      $point->categories_id = $request->category_id;
      $point->users_id = $request->user_id;
      $point->points = $request->point;
      $point->save();
      return redirect()->route('points');
    }

    public function editOption(Request $request, $id) {
      $validator = Validator::make($request->all(), [
        'question_id' => 'required|integer|min:1',
        'option' => 'required|string',
      ]);
      if($validator->fails()){
        return redirect()->back()->withErrors($validator->errors());
      }
      $option = Options::firstWhere('id', $id);
      $option->categories_id = $request->category_id;
      $option->option = $request->option;
      $option->save();
      return redirect()->route('option');
    }

    public function editQuestion(Request $request, $id) {
      $validator = Validator::make($request->all(), [
        'category_id' => 'required|integer|min:1',
        'subcategory_id' => 'required|integer|min:1',
        'option_id' => 'required|integer|min:1',
        'question' => 'required|string',
        'image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048|nullable',
      ]);
      if($validator->fails()){
        return redirect()->back()->withErrors($validator->errors());
      }
      $question = Questions::firstWhere('id', $id);
      $question->categories_id = $request->category_id;
      $question->sub_categories_id = $request->subcategory_id;
      $question->correct_option_id = $request->option_id;
      $question->question = $request->question;
      if (!empty($request->image)) {
        if (!empty($question->getRawOriginal('image'))) {
          $image_path = public_path('images/') . $question->getRawOriginal('image');
          unlink($image_path);
        }
        $image_name = time() . '.' . $request->image->getClientOriginalName();
        $request->image->move(public_path('images'), $image_name);
        $question->image = $image_name;
      }
      $question->save();
      return redirect()->route('question');
    }

    public function editRole(Request $request, $id) {
      $validator = Validator::make($request->all(), [
        'role' => 'required|string',
      ]);
      if($validator->fails()){
        return redirect()->back()->withErrors($validator->errors());
      }
      $role = Roles::firstWhere('id', $id);
      $role->role = $request->role;
      $role->save();
      return redirect()->route('role');
    }

    public function editSelected(Request $request, $id) {
      $validator = Validator::make($request->all(), [
        'question_id' => 'required|integer|min:1',
        'user_id' => 'required|integer|min:1',
        'option_id' => 'required|integer|min:1',
      ]);
      if($validator->fails()){
        return redirect()->back()->withErrors($validator->errors());
      }
      $selected = Selected::firstWhere('id', $id);
      $selected->questions_id = $request->question_id;
      $selected->options_id = $request->option_id;
      $selected->users_id = $request->user_id;
      $selected->save();
      return redirect()->route('selected');
    }



    public function addUser(Request $request) {
      $validator = Validator::make($request->all(), [
        'name' => 'required|string|between:2,100',
        'email' => ['required', 'string', 'email', 'max:100', Rule::unique('users')],
        'password' => 'required|string|confirmed|min:6',
        'role_id' => 'required|integer|min:1',
      ]);
      if($validator->fails()){
        return redirect()->back()->withErrors($validator->errors());
      }
      $user = new Users;
      $user->name = $request->input('name');
      $user->email = $request->input('email');
      $user->roles_id = $request->input('role_id');
      $user->password = bcrypt($request->password);
      $user->save();
      return redirect()->route('user');
    }

    public function addAnswer($id) {

    }

    public function addCategory(Request $request) {
      $validator = Validator::make($request->all(), [
        'category' => 'required|string',
        'image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048|nullable',
      ]);
      if($validator->fails()){
        return redirect()->back()->withErrors($validator->errors());
      }
      $category = new Categories;
      $category->category = $request->category;
      if (!empty($request->image)) {
        $image_name = time() . '.' . $request->image->getClientOriginalName();
        $request->image->move(public_path('images'), $image_name);
        $category->image = $image_name;
      }
      $category->save();
      return redirect()->route('category');
    }

    public function addSubcategory(Request $request) {
      $validator = Validator::make($request->all(), [
        'category_id' => 'required|integer|min:1',
        'subcategory' => 'required|string',
      ]);
      if($validator->fails()){
        return redirect()->back()->withErrors($validator->errors());
      }
      $sub_category = new SubCategories;
      $sub_categories->categories_id = $request->category_id;
      $sub_category->sub_category = $request->subcategory;
      $sub_category->save();
      return redirect()->route('subcategory');
    }

    public function addImage(Request $request) {

    }

    public function addPoint(Request $request) {
      $validator = Validator::make($request->all(), [
        'category_id' => 'required|integer|min:1',
        'user_id' => 'required|integer|min:1',
        'point' => 'required|integer|min:0',
      ]);
      if($validator->fails()){
        return redirect()->back()->withErrors($validator->errors());
      }
      $point = new Points;
      $point->categories_id = $request->category_id;
      $point->users_id = $request->user_id;
      $point->save();
      return redirect()->route('points');
    }

    public function addOption(Request $request) {
      $validator = Validator::make($request->all(), [
        'question_id' => 'required|integer|min:1',
        'option' => 'required|string',
      ]);
      if($validator->fails()){
        return redirect()->back()->withErrors($validator->errors());
      }
      $option = new Options;
      $option->categories_id = $request->category_id;
      $option->option = $request->option;
      $option->save();
      return redirect()->route('option');
    }

    public function addQuestion(Request $request) {
      $validator = Validator::make($request->all(), [
        'category_id' => 'required|integer|min:1',
        'subcategory_id' => 'required|integer|min:1',
        'option_id' => 'required|integer|min:1',
        'question' => 'required|string',
        'image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048|nullable',
      ]);
      if($validator->fails()){
        return redirect()->back()->withErrors($validator->errors());
      }
      $question = new Questions;
      $question->categories_id = $request->category_id;
      $question->sub_categories_id = $request->subcategory_id;
      $question->correct_option_id = $request->option_id;
      $question->question = $request->question;
      if (!empty($request->image)) {
        $image_name = time() . '.' . $request->image->getClientOriginalName();
        $request->image->move(public_path('images'), $image_name);
        $question->image = $image_name;
      }
      $question->save();
      return redirect()->route('question');
    }

    public function addRole(Request $request) {
      $validator = Validator::make($request->all(), [
        'role' => 'required|string',
      ]);
      if($validator->fails()){
        return redirect()->back()->withErrors($validator->errors());
      }
      $role = new Roles;
      $role->role = $request->role;
      $role->save();
      return redirect()->route('role');
    }

    public function addSelected(Request $request) {
      $validator = Validator::make($request->all(), [
        'question_id' => 'required|integer|min:1',
        'user_id' => 'required|integer|min:1',
        'option_id' => 'required|integer|min:1',
      ]);
      if($validator->fails()){
        return redirect()->back()->withErrors($validator->errors());
      }
      $selected = new Selected;
      $selected->questions_id = $request->question_id;
      $selected->options_id = $request->option_id;
      $selected->users_id = $request->user_id;
      $selected->save();
      return redirect()->route('selected');
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
