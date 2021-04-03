<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Answers;
use App\Models\User;
use App\Models\Questions;
use App\Models\Selected;
use App\Models\Categories;
use App\Models\SubCategories;
use App\Models\Options;
// use DB, Auth;

class QuizController extends Controller
{
    //
    public function getQuiz($id) {
      // dd($id);
      // $category = Categories::firstWhere('id', $id);
      $category = SubCategories::firstWhere('id', $id);
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
      $questions = Questions::where('categories_id', $category->categories_id)->where('sub_categories_id', $category->id)->with(['options:id,questions_id,option', 'answer'])->get(['id', 'question']);
      // $questions = Questions::where('category', "IELTS")->get();
      // dd($questions->isEmpty());
      $result  = ['data' => $questions,'succces' => true];
      return response()->json($questions);
      // return response()->json(Auth::user());
    }

    public function selectCategory($id) {
      // $category = Categories::firstWhere('id', $id);
      $categories = SubCategories::where('categories_id', $id)->get(['id', 'sub_category']);
      // return $categories;
      if ($categories->isEmpty()){
        $questions = Questions::where('categories_id', $id)->with(['options:id,questions_id,option', 'answer'])->get(['id', 'question']);
        $result  = ['start_quiz' => true, 'data' => $questions];
        return response()->json($result);
      }
      $result  = ['start_quiz' => false, 'data' => $categories];
      return response()->json($result);
    }

    public function check(Request $request) {
      // $checked = [];
      $submitted_answers = json_decode($request->body, true);
      // dd($submitted_answers);
      // return $this->test($submitted_answers);
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
          ['questions_id' => $question->id],
          ['options_id' => $option->id]
        );
      }
      return response()->json("Check Complete!");
    }

    public function removeQuestion(Request $request, $id) {

    }

    public function addQuestion(Request $request) {
      if (! $user = Auth::user()) {
        // return response()->json(['error' => 'Unauthorized'], 401);
      }
      dd($user);
      $question = new Question;
      $question->question = $request->input('question');
      $options = $request->input('options');
      $answer = new Answer;
      // add answer
    }
}
