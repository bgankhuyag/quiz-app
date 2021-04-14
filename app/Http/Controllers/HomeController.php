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
use Illuminate\Support\Facades\Storage;

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
      dd("here");
      return view('home');
    }

    public function dashboard() {
      // dd("here");
      return view('dashboard');
    }

    public function account() {
      return view('account');
    }

    public function editAccountPage() {
      return view('editPages.edit_account');
    }

    public function editAccount(Request $request) {
      $validator = Validator::make($request->all(), [
        'name' => 'required|string|between:2,100',
        'password' => 'nullable|string|confirmed|min:6',
        'email' => ['required', 'string', 'email', 'max:100', Rule::unique('users')->ignore(backpack_user()->id)],
      ]);
      if($validator->fails()){
        return redirect()->back()->withErrors($validator->errors());
      }
      $user = User::firstWhere('id', backpack_user()->id);
      $user->name = $request->name;
      $user->email = $request->email;
      if (!empty($request->password)) {
        $user->password = bcrypt($request->password);
      }
      $user->save();
      return redirect()->route('account');
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




    public function removeUser($id) {
      $user = User::firstWhere('id', $id);
      $selecteds = Selected::where('users_id', $id)->get();
      if (count($selecteds) > 0) {
        return redirect()->back()->withErrors(['Unable to delete row: foreign key contraint in Selected Options']);
      }
      $points = Points::where('users_id', $id)->get();
      if (count($points) > 0) {
        return redirect()->back()->withErrors(['Unable to delete row: foreign key contraint in Points']);
      }
      $user->delete();
      return redirect()->route('user');
    }

    public function removeAnswer($id) {
      $validator = Validator::make($request->all(), [
        'name' => 'required|string|between:2,100',
        'email' => ['required', 'string', 'email', 'max:100', Rule::unique('users')->ignore($user->id)],
        'role_id' => 'required|integer|min:1',
      ]);
      if($validator->fails()){
        return redirect()->back()->withErrors($validator->errors());
      }
    }

    public function removeCategory($id) {
      $category = Categories::firstWhere('id', $id);
      $questions = Questions::where('categories_id', $id)->get();
      if (count($questions) > 0) {
        return redirect()->back()->withErrors(['Unable to delete row: foreign key contraint in Questions']);
      }
      $points = Points::where('categories_id', $id)->get();
      if (count($points) > 0) {
        return redirect()->back()->withErrors(['Unable to delete row: foreign key contraint in Points']);
      }
      $sub_categories = SubCategories::where('categories_id', $id)->get();
      if (count($sub_categories) > 0) {
        return redirect()->back()->withErrors(['Unable to delete row: foreign key contraint in Sub-Categories']);
      }
      if (!empty($category->getRawOriginal('image'))){
        Storage::disk('s3')->delete($category->getRawOriginal('image'));
        // $image_path = public_path('images/') . $category->getRawOriginal('image');
        // unlink($image_path);
      }
      $category->delete();
      return redirect()->route('category');
    }

    public function removeSubcategory($id) {
      $sub_category = SubCategories::firstWhere('id', $id);
      $questions = Questions::where('sub_categories_id', $id)->get();
      if (count($questions) > 0) {
        return redirect()->back()->withErrors(['Unable to delete row: foreign key contraint in Questions']);
      }
      $sub_category->delete();
      return redirect()->route('subcategory');
    }

    public function removeImage($id) {

    }

    public function removePoint($id) {
      $point = Points::firstWhere('id', $id);
      $point->delete();
      return redirect()->route('points');
    }

    public function removeOption($id) {
      $option = Options::firstWhere('id', $id);
      $selecteds = Selected::where('options_id', $id)->get();
      if (count($selecteds) > 0) {
        return redirect()->back()->withErrors(['Unable to delete row: foreign key contraint in Selected Options']);
      }
      $questions = Questions::where('correct_option_id', $id)->get();
      if (count($questions) > 0) {
        return redirect()->back()->withErrors(['Unable to delete row: foreign key contraint in Questions']);
      }
      $option->delete();
      return redirect()->route('option');
    }

    public function removeQuestion($id) {
      $question = Questions::firstWhere('id', $id);
      $selecteds = Selected::where('questions_id', $id)->get();
      if (count($selecteds) > 0) {
        return redirect()->back()->withErrors(['Unable to delete row: foreign key contraint in Selected Options']);
      }
      if (!empty($question->getRawOriginal('image'))) {
        Storage::disk('s3')->delete($question->getRawOriginal('image'));
        // $image_path = public_path('images/') . $question->getRawOriginal('image');
        // unlink($image_path);
      }
      $options = Options::where('questions_id', $id)->get();
      foreach ($options as $option) {
        $option->delete();
      }
      $question->delete();
      return redirect()->route('question');
    }

    public function removeRole($id) {
      $role = Roles::firstWhere('id', $id);
      $users = User::where('roles_id', $id)->get();
      if (count($users) > 0) {
        return redirect()->back()->withErrors(['Unable to delete row: foreign key contraint in Users']);
      }
      $role->delete();
      return redirect()->route('role');
    }

    public function removeSelected($id) {
      $selected = Selected::firstWhere('id', $id);
      $selected->delete();
      return redirect()->route('selected');
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
      if (backpack_user()->id == $user->id && $user->roles_id != $request->role_id) {
        return redirect()->back()->withErrors(['Cannot change your own role']);
      }
      $user->name = $request->input('name');
      $user->email = $request->input('email');
      $user->roles_id = $request->input('role_id');
      $user->save();
      return redirect()->route('user');
    }

    public function editAnswer($id) {
      $validator = Validator::make($request->all(), [
        'name' => 'required|string|between:2,100',
        'email' => ['required', 'string', 'email', 'max:100', Rule::unique('users')->ignore($user->id)],
        'role_id' => 'required|integer|min:1',
      ]);
      if($validator->fails()){
        return redirect()->back()->withErrors($validator->errors());
      }
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
          Storage::disk('s3')->delete($category->getRawOriginal('image'));
          // $image_path = public_path('images/') . $category->getRawOriginal('image');
          // unlink($image_path);
        }
        $file = $request->image;
        $imageName= time() . $file->getClientOriginalName();
        Storage::disk('s3')->put($imageName, file_get_contents($file));
        // $image_name = time() . '.' . $request->image->getClientOriginalName();
        // $request->image->move(public_path('images'), $image_name);
        $category->image = $imageName;
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
      $sub_category->categories_id = $request->category_id;
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
      $option->questions_id = $request->question_id;
      $option->option = $request->option;
      $option->save();
      return redirect()->route('option');
    }

    public function editQuestion(Request $request, $id) {
      $validator = Validator::make($request->all(), [
        'category_id' => 'required|integer|min:1',
        'subcategory_id' => 'required|integer|min:0',
        'option_id' => 'required|integer|min:1',
        'question' => 'required|string',
        'image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048|nullable',
      ]);
      if($validator->fails()){
        return redirect()->back()->withErrors($validator->errors());
      }
      $question = Questions::firstWhere('id', $id);
      $question->categories_id = $request->category_id;
      if ($request->subcategory_id != 0) {
        $question->sub_categories_id = $request->subcategory_id;
      } else {
        $question->sub_categories_id = NULL;
      }
      $question->correct_option_id = $request->option_id;
      $question->question = $request->question;
      if ($request->removeImage == true) {
        Storage::disk('s3')->delete($question->getRawOriginal('image'));
        $question->image = NULL;
      }
      if (!empty($request->image)) {
        if (!empty($question->getRawOriginal('image'))) {
          Storage::disk('s3')->delete($question->getRawOriginal('image'));
          // $image_path = public_path('images/') . $question->getRawOriginal('image');
          // unlink($image_path);
        }
        $file = $request->image;
        $imageName= time() . $file->getClientOriginalName();
        Storage::disk('s3')->put($imageName, file_get_contents($file));
        // $image_name = time() . '.' . $request->image->getClientOriginalName();
        // $request->image->move(public_path('images'), $image_name);
        $question->image = $imageName;
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
      $user = new User;
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
        'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048'
      ]);
      if($validator->fails()){
        return redirect()->back()->withErrors($validator->errors());
      }
      $category = new Categories;
      $category->category = $request->category;
      $file = $request->image;
      $imageName= time() . $file->getClientOriginalName();
      Storage::disk('s3')->put($imageName, file_get_contents($file));
      // $image_name = time() . '.' . $request->image->getClientOriginalName();
      // $request->image->move(public_path('images'), $image_name);
      $category->image = $imageName;
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
      $sub_category->categories_id = $request->category_id;
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
      $point->points = $request->point;
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
      $option->questions_id = $request->question_id;
      $option->option = $request->option;
      $option->save();
      return redirect()->route('option');
    }

    public function addQuestion(Request $request) {
      $validator = Validator::make($request->all(), [
        'category_id' => 'required|integer|min:1',
        'subcategory_id' => 'required|integer|min:0',
        'option' => 'required|string',
        'question' => 'required|string',
        'image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048|nullable',
      ]);
      if($validator->fails()){
        return redirect()->back()->withErrors($validator->errors());
      }
      $question = new Questions;
      $question->categories_id = $request->category_id;
      if ($request->subcategory_id != 0) {
        $question->sub_categories_id = $request->subcategory_id;
      }
      $question->question = $request->question;
      if (!empty($request->image)) {
        $file = $request->image;
        $imageName= time() . $file->getClientOriginalName();
        Storage::disk('s3')->put($imageName, file_get_contents($file));
        // $image_name = time() . '.' . $request->image->getClientOriginalName();
        // $request->image->move(public_path('images'), $image_name);
        $question->image = $imageName;
      }
      $question->save();
      $option = new Options;
      $option->option = $request->option;
      $option->questions_id = $question->id;
      $option->save();
      $question->correct_option_id = $option->id;
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
      $action = route('editAnswer', ['id' => $id]);
      $new = false;
      $data = ['options' => $options, 'questions' => $questions, 'answer' => $answer, 'action' => $action, 'new' => $new];
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
      $options = Options::where('questions_id', $id)->get();
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
      // $answer = Answers::firstWhere('id', $id);
      $questions = Questions::all();
      $options = Options::all();
      $new = true;
      $action = route('addQuestion');
      $data = ['options' => $options, 'questions' => $questions, 'action' => $action, 'new' => $new];
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
