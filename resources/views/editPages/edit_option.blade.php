@extends('layouts.app')

@section('content')
<div class="container">
  <a href="{{route('option')}}"><button style="margin-bottom: 20px;" type="button" class="btn btn-outline-primary">Back</button></a>
  <form action="" method="post">
    @csrf
    <h3>Edit Option ID-{{$option->id}}</h3>
    <div class="form-group">
      <label for="exampleFormControlSelect2">Select Question ID</label>
      <select multiple class="form-control" id="exampleFormControlSelect2" style="height: 300px;">
        @foreach($questions as $question)
        <option value="{{$question->id}}" @if($option->questions_id == $question->id) selected @endif>ID: {{$question->id}}&#160;&#160;&#160; Question: {{$question->question}}</option>
        @endforeach
      </select>
    </div>
    <div class="form-group">
      <label for="exampleInputEmail1">Option</label>
      <input type="text" class="form-control" value="{{$option->option}}" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter email">
    </div>
    <button type="submit" class="btn btn-primary btn-sm float-right">Edit Option</button>
  </form>
</div>

<script>
  checkPage('options');
</script>
@endsection
