<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Answers;
use App\Models\User;
use App\Models\Questions;
use App\Models\Options;
use Illuminate\Support\Facades\Auth;
// use DB, Auth;

class QuizController extends Controller
{
    //
    public function getQuiz() {
      $questions = Questions::with('options:id,questions_id,option')->get(['id', 'question']);
      $result  = ['data' => $questions,'succces' => true];
      return $questions;
      // return response()->json(Auth::user());
    }

    public function check(Request $request) {
      // dd('here');
      $correct = false;
      $question_id = $request->input('question_id');
      $option_id = $request->input('option_id');
      // $question_id = 2;
      // $option_id = 8;
      $answer = Answers::firstWhere('questions_id', $question_id);
      if ($answer->options_id == $option_id) {
        $correct = true;
      }
      return response()->json($correct);
      return ($request->input('option_id'));
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
