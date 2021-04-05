<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Answers;
use App\Models\Categories;
use App\Models\SubCategories;
use App\Models\User;
use App\Models\Questions;
use App\Models\Options;
use Illuminate\Support\Facades\Auth;
// use DB, Auth;

class Copy_QuizController extends Controller
{
    //
    public function getQuiz($id) {
      $category = Categories::firstWhere('id', $id);
      $questions = Questions::where('category', $category->category)->with(['options:id,questions_id,option', 'answer:questions_id,options_id'])->get(['id', 'question']);
      $result  = ['data' => $questions,'succces' => true];
      return response()->json($questions);
      // return $questions;
      // return response()->json(Auth::user());
    }

    public function getCategories() {
      // dd(Auth::user());
      // $categories = Categories::all('id', 'category');
      // $categories = Categories::with('sub_category:id,categories_id,sub_category')->join('sub_categories', 'categories.id', '=', 'sub_categories.categories_id')->get(['id', 'category']);
      $categories = Questions::join('categories', 'questions.categories_id', '=', 'categories.id')->join('sub_categories', 'questions.sub_categories_id', '=', 'sub_categories.id')->get();
      // dd($categories);
      return response()->json($categories);
    }

    public function addCategories(Request $request) {
      $categories = json_decode($request->body, true);
      // dd($categories);
      foreach ($categories as $category) {
        $new_category = new Categories;
        $new_category->category = $category;
        // $new_category->save();
        echo ($category);
      }
    }

    public function removeCategory(Request $request) {
      $category_id = ($request->category_id);
      // dd($category_id);
      $sub_categories = SubCategories::where('categories_id', $category_id)->get();
      // dd( $sub_categories);
      foreach ($sub_categories as $sub_category) {
        echo ($sub_category->sub_category);
        // $sub_category->delete();
      }
      $category = Categories::firstWhere('id', $category_id);
      echo ($category->category);
      // $category->delete();
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

    public function removeQuestion(Request $request) {
      $options = Options::where('questions_id', $request->question_id)->get();
      foreach ($options as $option) {
        // $option->delete();
        echo ($option);
      }
      $answer = Answers::firstWhere('questions_id', $question_id);
      echo ($answer);
      // $answer->delete();
      $question = Questions::firstWhere('id', $request->question_id);
      echo ($question);
      // $question->delete();
    }

    public function addOptions(Request $request) {
      // $json = $request->body;
      $question_id = json_decode($request->getContent(), true)['question_id'];
      // $question_id = $request->input('question_id');
      echo ($question_id);
      $options = json_decode($request->getContent(), true)['options'];
      // $options = $request->input('options');
      foreach ($options as $option) {
        $new_option = new Options;
        $new_option->option = $option;
        $new_option->question_id = $question_id;
        // $new_option->save();
        echo ($option);
      }
    }

    public function removeOption(Request $request) {
      // json_decode($request->getContent(), true)['option_id']
      $option_id = $request->option_id;
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
      $question->question = $request->question;
      $question->categories_id = $request->category_id;
      echo($question);
      // $question->save();
      $options = json_decode($request->options, true);
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
