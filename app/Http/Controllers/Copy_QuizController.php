<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Answers;
use App\Models\Categories;
use App\Models\SubCategories;
use App\Models\User;
use App\Models\Questions;
use App\Models\Images;
use App\Models\Options;
use Illuminate\Support\Facades\Auth;
use Validator;
// use DB, Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\DB;

class Copy_QuizController extends Controller
{
    //
    public function getQuiz($id) {
      $questions = Questions::where('sub_categories_id', $id)->with(['options:id,questions_id,option', 'answer', 'image:questions_id,name'])->get(['id', 'question']);
      // $questions = Questions::where('category', "IELTS")->get();
      // dd($questions->isEmpty());
      // return response()->json(url(asset('images/spiderman.jpeg')));
      $result  = ['data' => $questions,'succces' => true];
      return response()->json($questions);
      // return $questions;
      // return response()->json(Auth::user());
    }

    public function getCategories() {
      // dd(Auth::user());
      // $categories = Categories::all('id', 'category');
      $categories = Categories::with('sub_category:id,categories_id,sub_category')->get(['id', 'category', 'image']);
      // $categories = Categories::with('sub_category:id,categories_id,sub_category')->join('sub_categories', 'categories.id', '=', 'sub_categories.categories_id')->get(['id', 'category']);
      // $categories = Questions::join('categories', 'questions.categories_id', '=', 'categories.id')->join('sub_categories', 'questions.sub_categories_id', '=', 'sub_categories.id')->get();
      // $categories = Questions::distinct('categories_id')->with('category:id,category', 'category.sub_category:id,categories_id,sub_category')->get(['categories_id']);
      // dd($categories);
      $result  = ['succces' => true, 'data' => $categories];
      return response()->json($result);
    }

    public function addCategories(Request $request) {
      $validator = Validator::make($request->all(), [
        // 'question' => 'required|string|between:1,255',
        'bodyuse Illuminate\Support\Facades\File; ' => 'required|string|between:1,255',
        // 'email' => 'required|string|email|max:100|unique:users',
        // 'password' => 'required|string|confirmed|min:6',
      ]);
      if ($validator->fails()) {
        $result = ['error' => $validator->errors()->toJson(), 'success' => false];
        return response()->json($result, 422);
      }
      $categories = json_decode($request->body, true);
      // dd($categories);
      foreach ($categories as $category) {
        $new_category = new Categories;
        $new_category->category = $category;
        $new_category->save();
        // echo ($category);
      }
      $data = ['success' => true];
      return response()->json($data);
    }

    public function removeCategory(Request $request) {
      $validator = Validator::make($request->all(), [
        'category_id' => 'required|integer',
      ]);
      if ($validator->fails()) {
        $data = ['error' => $validator->errors()->toJson(), 'success' => false];
        return response()->json($data, 422);
      }
      $category_id = $request->category_id;
      if (!$category = Categories::firstWhere('id', $category_id)) {
        return response()->json(['data' => 'Invalid category id', 'success' => false]);
      }
      $sub_categories = SubCategories::where('categories_id', $category_id)->get();
      foreach ($sub_categories as $sub_category) {
        $sub_category->delete();
      }
      $category->delete();
      return response()->json(['success' => true]);
    }

    public function test($item) {
      // dd($item);
      return view('test', ["item"=>$item]);

    }

    public function check(Request $request) {
      $checked = [];
      $submitted_answers = json_decode($request->body, true);
      // $submitted_answers = $request->input('data');
      // return $this->test($submitted_answers);
      // dd($submitted_answers["data"]);
      foreach ($submitted_answers as $submitted_answer) {
        $question_id = $submitted_answer['question_id'];
        $question = Questions::firstWhere('id', $question_id);
        $answer = Answers::firstWhere('questions_id', $question_id);
        $option_id = $submitted_answer['option_id'];
        $option = Options::firstWhere('id', $option_id);
        $correct = false;
        if ($answer->options_id == $option_id) {
          $correct = true;
        }
        if ($correct) {
          array_push($checked, (object)["question" => $question->question, "correct" => $correct, "correct_option" => $option->option]);
        } else {
          $correct_option = Options::firstWhere('id', $answer->options_id);
          array_push($checked, (object)["question" => $question->question, "correct" => $correct, "selected_option" => $option->option, "correct_option" => $correct_option->option]);
        }
      }
      return response()->json($checked);
    }


    public function addOptions(Request $request) {
      $validator = Validator::make($request->all(), [
        'options' => 'required|string',
        'question_id' => 'required|integer|min:1'
      ]);
      if ($validator->fails()) {
        $data = ['error' => $validator->errors()->toJson(), 'success' => false];
        return response()->json($data, 422);
      }
      $options = json_decode($request->options, true);
      foreach ($options as $option) {
        $new_option = new Options;
        $new_option->option = $option;
        $new_option->questions_id = $request->question_id;
        $new_option->save();
      }
      return response()->json(['success' => true]);
    }

    public function removeOption(Request $request) {
      $validator = Validator::make($request->all(), [
        'option_id' => 'required|integer|min:1'
      ]);
      if ($validator->fails()) {
        $data = ['error' => $validator->errors()->toJson(), 'success' => false];
        return response()->json($data, 422);
      }
      if (!$option = Options::firstWhere('id', $request->option_id)) {
        return response()->json(['data' => 'Invalid option id', 'success' => false]);
      }
      $option->delete();
      return response()->json(['success' => true]);
    }

    public function addQuestion(Request $request) {
      $validator = Validator::make($request->all(), [
        'question' => 'required|string|between:1,255',
        'options' => 'required|string',
        'category_id' => 'required|integer|min:1',
        'answer' => 'required|string',
      ]);
      if ($validator->fails()) {
        $data = ['error' => $validator->errors()->toJson(), 'success' => false];
        return response()->json($data, 422);
      }
      $question = new Questions;
      $question->question = $request->question;
      $question->categories_id = $request->category_id;
      if(!empty($request->sub_category_id)){
        $question->sub_categories_id = $request->sub_category_id;
      }
      $question->save();
      if (!empty($request->image)) {
        $image_name = time() . '.' . $request->image->getClientOriginalName();
        $image = new Images;
        $image->name = $image_name;
        $image->questions_id = $question->id;
        $image->save();
        $request->image->move(public_path('images'), $image_name);
      }
      $options = json_decode($request->options, true);
      foreach ($options as $option) {
        $new_option = new Options;
        $new_option->option = $option;
        $new_option->questions_id = $question->id;
        $new_option->save();
      }
      $new_option = new Options;
      $new_option->questions_id = $question->id;
      $new_option->option = $request->answer;
      $new_option->save();
      $answer = new Answers;
      $answer->questions_id = $question->id;
      $answer->options_id = $new_option->id;
      $answer->save();
      return response()->json(['success' => true]);
    }

    public function removeQuestion(Request $request) {
      $validator = Validator::make($request->all(), [
        'question_id' => 'required|integer|min:1',
      ]);
      if ($validator->fails()) {
        $data = ['error' => $validator->errors()->toJson(), 'success' => false];
        return response()->json($data, 422);
      }
      if (!$question = Questions::firstWhere('id', $request->question_id)) {
        return response()->json(['data' => 'Invalid question id', 'success' => false]);
      }
      $answer = Answers::firstWhere('questions_id', $request->question_id);
      $answer->delete();
      $options = Options::where('questions_id', $request->question_id)->get();
      foreach ($options as $option) {
        $option->delete();
      }
      $image = Images::firstWhere('questions_id', $request->question_id);
      if (!empty($images)) {
        $image_path = public_path('images/') . $image->getRawOriginal('name');
        unlink($image_path);
        $image->delete();
      }
      // $question = Questions::firstWhere('id', $request->question_id);
      $question->delete();
      return response()->json(['success' => true]);
    }

    public function editQuestion(Request $request) {
      $validator = Validator::make($request->all(), [
        'question_id' => 'required|integer|min:1',
      ]);
      if ($validator->fails()) {
        $data = ['error' => $validator->errors()->toJson(), 'success' => false];
        return response()->json($data, 422);
      }
      if (!$question = Questions::firstWhere('id', $request->question_id)) {
        return response()->json(['data' => 'Invalid question id', 'success' => false]);
      }
      if (!empty($request->question)) {
        $question->question = $request->question;
      }
      if (!empty($request->category_id)) {
        $question->categories_id = $request->category_id;
      }
      if (!empty($request->sub_category_id)) {
        $question->sub_categories_id = $request->sub_category_id;
      }
      if (!empty($request->answer_id)) {
        $answer = Answers::firstWhere('questions_id', $question->id);
        $answer->options_id = $request->answer_id;
      }
      if (!empty($request->image)) {
        $image = Images::firstWhere('questions_id', $question->id);
        $image_path = public_path('images/') . $image->getRawOriginal('name');
        // unlink($image_path);
        // $image->delete();
        $image_name = time() . '.' . $request->image->getClientOriginalName();
        $image = new Images;
        $image->name = $image_name;
        $image->questions_id = $question->id;
        // $image->save();
        // $request->image->move(public_path('images'), $image_name);
      }
      // $question->save();
      return response()->json(['success' => true]);
    }

}
