<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Answers;
use App\Models\Categories;
use App\Models\User;
use App\Models\Questions;
use App\Models\Options;
use Illuminate\Support\Facades\Auth;
// use DB, Auth;

class Copy_QuizController extends Controller
{
    //
    public function getQuiz() {
      $questions = Questions::with('options:id,questions_id,option')->get(['id', 'question']);
      $result  = ['data' => $questions,'succces' => true];
      return response()->json($questions);
      return $questions;
      // return response()->json(Auth::user());
    }

    public function getCategories() {
      $categories = Categories::all('id', 'category');
      // dd($categories);
      return $categories;
    }

    public function addCategories(Request $request) {
      $categories = $request->input('categories');
      foreach ($categories as $category) {
        $new_category = new Categories;
        $new_category->category = $category;
        // $new_category->save();
        echo ($category);
      }
    }

    public function removeCategory(Request $request) {
      $category_id = $request->input("category_id");
      $category = Categories::firstWhere('id', $category_id);
      echo ($category->category);
      // $category->delete();
    }

    public function check(Request $request) {
      $checked = [];
      $submitted_answers = $request->input('data');
      foreach ($submitted_answers as $submitted_answer) {
        $question_id = $submitted_answer['question_id'];
        $question = Questions::firstWhere('id', $question_id);
        $answer = Answers::firstWhere('questions_id', $question_id);
        $option_id = $submitted_answer['option_id'];
        $correct = false;
        if ($answer->options_id == $option_id) {
          $correct = true;
        }
        array_push($checked, (object)["question_id" => $question->question, "correct" => $correct]);
      }
      return response()->json($checked);
    }

    public function removeQuestion(Request $request) {
      $question_id = $request->input('question_id');
      $question = Questions::firstWhere('id', $question_id);
      echo ($question);
      $options = Options::where('questions_id', $question_id)->get();
      foreach ($options as $option) {
        // $option->delete();
        echo ($option);
      }
      $answer = Answers::firstWhere('questions_id', $question_id);
      echo ($answer);
      // $answer->delete();
      // $question->delete();
    }

    public function addOptions(Request $request) {
      $question_id = $request->input('question_id');
      echo ($question_id);
      $options = $request->input('options');
      foreach ($options as $option) {
        $new_option = new Options;
        $new_option->option = $option;
        $new_option->question_id = $question_id;
        // $new_option->save();
        echo ($option);
      }
    }

    public function removeOption(Request $request) {
      $option_id = $request->input("option_id");
      $option = Options::firstWhere('id', $option_id);
      echo ($option->option);
      // $option->delete();
    }

    public function addQuestion(Request $request) {
      if (! $user = Auth::user()) {
        // return response()->json(['error' => 'Unauthorized'], 401);
      }
      // dd($user);
      $question = new Questions;
      $question->question = $request->input('question');
      $question->category = $request->input('category');
      echo($question);
      // $question->save();
      $options = $request->input('options');
      foreach ($options as $option) {
        $new_option = new Options;
        $new_option->option = $option;
        $new_option->questions_id = $question->id;
        // $new_option->save();
        echo($new_option->option);
      }
      // add correct answer
      $answer = new Answers;
    }
}
