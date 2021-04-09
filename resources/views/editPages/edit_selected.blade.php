@extends('layouts.app')

@section('content')
<div class="container">
  <form action="" method="post">
    @csrf
    <h3>Edit Selected Option ID-{{$selected->id}}</h3>
    <div class="form-group">
      <label for="exampleFormControlSelect2">Select Question ID</label>
      <select multiple class="form-control" id="exampleFormControlSelect2" style="height: 300px;">
        @foreach($questions as $question)
        <option value="{{$question->id}}" @if($selected->questions_id == $question->id) selected @endif>ID: {{$question->id}}&#160;&#160;&#160; Question: {{$question->question}}</option>
        @endforeach
      </select>
    </div>
    <div class="form-group">
      <label for="exampleFormControlSelect2">Select Option ID</label>
      <select multiple class="form-control" id="exampleFormControlSelect2" style="height: 300px;">
        @foreach($options as $option)
        <option value="{{$option->id}}" @if($selected->options_id == $option->id) selected @endif>ID: {{$option->id}}&#160;&#160;&#160; Question ID: {{$option->questions_id}}&#160;&#160;&#160; Option: {{$option->option}}</option>
        @endforeach
      </select>
    </div>
    <div class="form-group">
      <label for="exampleFormControlSelect2">Select User ID</label>
      <select multiple class="form-control" id="exampleFormControlSelect2" style="height: 300px;">
        @foreach($users as $user)
        <option value="{{$user->id}}" @if($selected->users_id == $user->id) selected @endif>ID: {{$user->id}}&#160;&#160;&#160; Name: {{$user->name}}</option>
        @endforeach
      </select>
    </div>
    <button type="submit" class="btn btn-primary btn-sm float-right">Edit Question</button>
  </form>
</div>

<script>
  checkPage('selecteds');
</script>
@endsection
