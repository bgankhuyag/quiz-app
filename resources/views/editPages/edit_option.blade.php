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
  <a href="{{route('option')}}"><button style="margin-bottom: 20px;" type="button" class="btn btn-outline-primary"><i class="fas fa-arrow-left"></i>&nbsp;Back</button></a>
  <form action="{{$action}}" method="post">
    @csrf
    @if ($new)
      <h3>Add New Option</h3>
    @else
      <h3>Edit Option ID-{{$option->id}}</h3>
    @endif
    <div class="form-group">
      <label for="question_id">Select Question ID</label>
      <select multiple class="form-control" name="question_id" id="question_id" style="height: 300px;">
        @foreach($questions as $question)
        <option value="{{$question->id}}" @if(!$new && $option->questions_id == $question->id) selected @endif>ID: {{$question->id}}&#160;&#160;&#160; Question: {{$question->question}}</option>
        @endforeach
      </select>
    </div>
    <div class="form-group">
      <label for="option">Option</label>
      <input type="text" name="option" class="form-control" @if(!$new) value="{{$option->option}}" @endif id="option" aria-describedby="emailHelp" placeholder="Enter Option">
    </div>
    <button type="submit" style="margin-bottom: 40px;" class="btn btn-primary btn-sm float-right">@if($new) Add Option @else Edit Option @endif</button>
  </form>
</div>

<script>
  checkPage('options');
</script>
@endsection
