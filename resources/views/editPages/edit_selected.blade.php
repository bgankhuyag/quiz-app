@extends('layouts.app')

@section('content')
<div class="container">
  @if($errors->any())
  <div class="alert alert-danger" role="alert">
    @foreach ($errors->all() as $error)
      <h3>{{ $error }}</h3>
    @endforeach
  </div>
  @endif
  <a href="{{route('selected')}}"><button style="margin-bottom: 20px;" type="button" class="btn btn-outline-primary">Back</button></a>
  <form action="{{$action}}" method="post">
    @csrf
    @if ($new)
      <h3>Add New Selected Option</h3>
    @else
      <h3>Edit Selected Option ID-{{$selected->id}}</h3>
    @endif
    <div class="form-group">
      <label for="question_id">Select Question ID</label>
      <select multiple class="form-control" name="question_id" id="question_id" style="height: 300px;" onchange="changeQuestion(this)">
        @foreach($questions as $question)
        <option value="{{$question->id}}" @if(!$new && $selected->questions_id == $question->id) selected @endif>ID: {{$question->id}}&#160;&#160;&#160; Question: {{$question->question}}</option>
        @endforeach
      </select>
    </div>
    <div class="form-group">
      <label for="option_id">Select Option ID</label>
      <select multiple class="form-control" name="option_id" id="option_id" style="height: 300px;">
        @foreach($options as $option)
        <option class="{{$option->questions_id}}" value="{{$option->id}}" @if(!$new && $selected->options_id == $option->id) selected @endif>ID: {{$option->id}}&#160;&#160;&#160; Question ID: {{$option->questions_id}}&#160;&#160;&#160; Option: {{$option->option}}</option>
        @endforeach
      </select>
    </div>
    <div class="form-group">
      <label for="user_id">Select User ID</label>
      <select multiple class="form-control" name="user_id" id="user_id" style="height: 300px;">
        @foreach($users as $user)
        <option value="{{$user->id}}" @if(!$new && $selected->users_id == $user->id) selected @endif>ID: {{$user->id}}&#160;&#160;&#160; Name: {{$user->name}} &#160;&#160;&#160; Email: {{$user->email}}</option>
        @endforeach
      </select>
    </div>
    <button type="submit" class="btn btn-primary btn-sm float-right">@if($new) Add @else Edit @endif Question</button>
  </form>
</div>

<script>
  checkPage('selecteds');

  function changeQuestion(question) {
    var options = document.getElementById('option_id');
    for (var i = 0; i < options.length; i++) {
      if (!options[i].classList.contains(question.value)) {
        options[i].style.display = "none";
      } else {
        options[i].style.display = "block";
      }
    }
  }

  function checkQuestion() {
    var question = document.getElementById('question_id');
    // console.log(!question.value);
    if (question.value) {
      var options = document.getElementById('option_id');
      for (var i = 0; i < options.length; i++) {
        if (!options[i].classList.contains(question.value)) {
          options[i].style.display = "none";
        } else {
          options[i].style.display = "block";
        }
      }
    }
  }

  window.onload = checkQuestion();
</script>
@endsection
