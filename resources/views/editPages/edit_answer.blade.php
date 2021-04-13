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
  <form action="" method="post">
    @csrf
    <h3>Edit Answer ID-{{$answer->id}}</h3>
    <div class="form-group">
    <label for="question_id">Select Question ID</label>
    <select multiple class="form-control" name="question_id" id="question_id" style="height: 300px;">
      @foreach($questions as $question)
        <option value="{{$question->id}}" @if($answer->questions_id == $question->id) selected @endif>ID: {{$question->id}}&#160;&#160;&#160; Question: {{$question->question}}</option>
      @endforeach
    </select>
    </div>
    <div class="form-group">
      <label for="option_id">Select Option ID</label>
      <select multiple class="form-control" name="option_id" id="option_id" style="height: 300px;">
        @foreach($options as $option)
          <option value="{{$option->id}}" @if($answer->options_id == $option->id) selected @endif>ID: {{$option->id}}&#160;&#160;&#160; Question ID: {{$option->questions_id}} &#160;&#160;&#160;Option: {{$option->option}}</option>
        @endforeach
      </select>
    </div>
    <button type="submit" class="btn btn-primary btn-sm float-right">Edit Answer</button>
  </form>
</div>

<script>
checkPage('answers');
</script>
@endsection
