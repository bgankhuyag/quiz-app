<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Answers;
use App\Models\User;
use App\Models\Questions;
use App\Models\Selected;
use App\Models\Categories;
use App\Models\Options;
// use DB, Auth;

class QuizController extends Controller
{
    //
    public function getQuiz($id) {
      // dd($id);
      $category = Categories::firstWhere('id', $id);
      $questions = Questions::where('category', $category->category)->with(['options:id,questions_id,option', 'answer:questions_id,options_id'])->get(['id', 'question']);
      $result  = ['data' => $questions,'succces' => true];
      return response()->json($questions);
      // return response()->json(Auth::user());
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
