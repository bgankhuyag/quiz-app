<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Answers;
use App\Models\User;
use App\Models\Questions;
use App\Models\Selected;
use App\Models\Categories;
use App\Models\SubCategories;
use App\Models\Points;
use App\Models\Images;
use App\Models\Options;
use Validator;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
// use DB, Auth;

class QuizController extends Controller
{

    public function getPoints(Request $request) {
      $user_id = auth()->id();
      // dd($user_id);

      // $points = Categories::with(['questions.selected' => function ($query) use ($user_id) {
      //   $query->select('questions_id','points', 'users_id')->where('users_id', $user_id);
      // }])->get();
      $points = Points::where('users_id', $user_id)->get(['points', 'categories_id']);
      // $points = Categories::join('questions', 'categories.id', '=', 'questions.categories_id')->join('selecteds', 'questions.id', '=', 'selecteds.questions_id')->where('users_id', $user_id)->groupBy('category')->select([DB::raw("SUM(points) as total_points")])->get();
      // $points = Selected::where('users_id', $user_id)->with('question')->get();
      // $points = Selected::where('users_id', $user_id)->join('questions', 'selecteds.questions_id', '=', 'questions.id')->rightJoin('categories', 'categories.id', '=', 'questions.categories_id')->get()->groupBy('category');
      return response()->json($points);

    }

    public function getQuiz($id) {
      // dd($id);
      // $category = Categories::firstWhere('id', $id);
      // $sub_category = SubCategories::firstWhere('id', $id);
      // return $category;
      // $categories = SubCategories::where('parent_category', $category->category)->get(['id', 'category']);
      // if (!$categories->isEmpty()) {
      //   $result  = ['data' => $categories,'quiz_start' => false];
      //   return response()->json($result);
      // }
      // $result  = ['data' => $category->category,'quiz_start' => true];
      // return response()->json($result);
      //
      // if (!empty($categories)) {
      //   return $categories;
      // }
      // $questions = Questions::where('category', $category->category)->join('answers', 'answers.questions_id', '=', 'questions.id')->join('options', 'options.id', '=', 'answers.options_id')->join('options', 'options.questions_id', '=', 'questions.id')->get();
      $questions = Questions::where('sub_categories_id', $id)->with(['options:id,questions_id,option'])->get(['id', 'question', 'correct_option_id', 'image']);
      // $questions = Questions::where('category', "IELTS")->get();
      // dd($questions->isEmpty());
      $result  = ['succces' => true, 'data' => $questions];
      // Log::info(json_encode($this));
      return response()->json($result);
      // return response()->json(Auth::user());
    }

    public function selectCategory($id) {
      // $category = Categories::firstWhere('id', $id);
      // $categories = SubCategories::where('categories_id', $id)->get(['id', 'sub_category']);
      // $categories = Questions::where('questions.categories_id', $id)->join('sub_categories', 'questions.sub_categories_id', '=', 'sub_categories.id')->distinct('id')->pluck('sub_category');

      // dd($categories);
      $questions = Questions::where('categories_id', $id)->with(['options:id,questions_id,option'])->get(['id', 'question', 'correct_option_id', 'image']);
      $result  = ['succces' => true, 'data' => $questions];
      return response()->json($result);
      // $result  = ['start_quiz' => true, 'data' => $questions];
      // if ($categories->isEmpty()){
      // }
      // $result  = ['start_quiz' => false, 'data' => $categories];
      // return response()->json($result);
    }

    public function getCategories(Request $request) {
      // dd(Auth::user());
      // $categories = Categories::all('id', 'category');
      $categories = Categories::with('sub_category:id,categories_id,sub_category')->get(['id', 'category', 'image']);
      // $categories = Questions::join('categories', 'questions.categories_id', '=', 'categories.id')->join('sub_categories', 'questions.sub_categories_id', '=', 'sub_categories.id')->get();
      // dd($categories);
      $points = Points::where('users_id', auth()->id())->get(['points', 'categories_id']);
      $result  = ['succces' => true, 'data' => $categories, 'points' => $points];
      return response()->json($result);
    }

    public function leaderboard(Request $request, $id) {
      $points = Points::where('categories_id', $id)->orderBy('points', 'desc')->join('users', 'points.users_id', '=', 'users.id')->take(5)->get(['name', 'points.id', 'points']);
      $user_point = Points::where('categories_id', $id)->where('users_id', auth()->id())->join('users', 'points.users_id', '=', 'users.id')->first(['name', 'points.id', 'points']);
      $result = ['data' => $points, 'user' => $user_point];
      return response()->json($result);
    }

    public function total(Request $request) {
      $points = Points::join('users', 'points.users_id', '=', 'users.id')->groupBy('users_id')->selectRaw('users_id, name, sum(points) as total')->get();
      $user_point = Points::where('users_id', auth()->id())->join('users', 'points.users_id', '=', 'users.id')->sum('points');
      $result = ['data' => $points, 'user' => $user_point];
      return response()->json($result);
    }

    public function addCategories(Request $request) {
      $validator = Validator::make($request->all(), [
        // 'question' => 'required|string|between:1,255',
        'body' => 'required|string|between:1,255',
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
      }
      return response()->json(['success' => true]);
    }

    public function removeCategory(Request $request) {
      $validator = Validator::make($request->all(), [
        'category_id' => 'required|integer|min:1',
      ]);
      if ($validator->fails()) {
        $data = ['error' => $validator->errors()->toJson(), 'success' => false];
        return response()->json($data, 422);
      }
      // remove questions
      $category_id = $request->category_id;
      if (!$category = Categories::firstWhere('id', $category_id)) {
        return response()->json(['error' => 'Invalid category id', 'success' => false]);
      }
      $sub_categories = SubCategories::where('categories_id', $category_id)->get();
      foreach ($sub_categories as $sub_category) {
        $sub_category->delete();
      }
      $category->delete();
      return response()->json(['success' => true]);
    }

    public function check(Request $request) {
      // $checked = [];
      $submitted_answers = json_decode($request->body, true);
      // dd($submitted_answers);
      // return $this->test($submitted_answers);
      // return (auth()->id());
      // return response()->json($request->category_id);
      $category_id = json_decode($request->category_id);
      $points = json_decode($request->points);
      $point = Points::firstOrCreate(
        ['users_id' => auth()->id(), 'categories_id' => $category_id],
        ['points' => 0]
      );
      $point->points = $point->points + $points;
      $point->save();
      foreach ($submitted_answers as $submitted_answer) {
        $question_id = $submitted_answer['question_id'];
        $option_id = $submitted_answer['option_id'];
        $question = Questions::where('id', $question_id)->firstOrFail();
        $option = Options::where('id', $option_id)->firstOrFail();
        // $answer = Answers::firstWhere('questions_id', $question_id);

        // $correct = false;
        // if ($answer->options_id == $option_id) {
        //   $correct = true;
        // }
        // if ($correct) {
        //   array_push($checked, (object)["question" => $question->question, "correct" => $correct, "correct_option" => $option->option]);
        // } else {
        //   $correct_option = Options::firstWhere('id', $answer->options_id);
        //   array_push($checked, (object)["question" => $question->question, "correct" => $correct, "selected_option" => $option->option, "correct_option" => $correct_option->option]);
        // }
        $selected = Selected::updateOrCreate(
          ['users_id' => auth()->id(), 'questions_id' => $question->id],
          ['options_id' => $option->id]
        );
      }
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
        $image = new Images;
        $image->name = $image_name;
        $image->questions_id = $question->id;
        $image->save();
        $image_name = time() . '.' . $request->image->getClientOriginalName();
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
        return response()->json(['error' => 'Invalid question id', 'success' => false]);
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
      $question->delete();
      return response()->json(['success' => true]);
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
        return response()->json(['error' => 'Invalid option id', 'success' => false]);
      }
      $option->delete();
      return response()->json(['success' => true]);
    }

}
