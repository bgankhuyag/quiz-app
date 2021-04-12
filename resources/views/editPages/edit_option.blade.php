@extends('layouts.app')

@section('content')
<div class="container">
  <a href="{{route('option')}}"><button style="margin-bottom: 20px;" type="button" class="btn btn-outline-primary">Back</button></a>
  <form action="{{$action}}" method="post">
    @csrf
    @if ($new)
      <h3>Add New Option</h3>
    @else
      <h3>Edit Option ID-{{$option->id}}</h3>
    @endif
    <div class="form-group">
      <label for="exampleFormControlSelect2">Select Question ID</label>
      <select multiple class="form-control" id="exampleFormControlSelect2" style="height: 300px;">
        @foreach($questions as $question)
        <option value="{{$question->id}}" @if(!$new && $option->questions_id == $question->id) selected @endif>ID: {{$question->id}}&#160;&#160;&#160; Question: {{$question->question}}</option>
        @endforeach
      </select>
    </div>
    <div class="form-group">
      <label for="exampleInputEmail1">Option</label>
      <input type="text" class="form-control" @if(!$new) value="{{$option->option}}" @endif id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter Option">
    </div>
    <button type="submit" class="btn btn-primary btn-sm float-right">@if($new) Add Option @else Edit Option @endif</button>
  </form>
</div>

<script>
  checkPage('options');
</script>
@endsection
