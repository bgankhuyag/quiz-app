@extends('layouts.app')

@section('content')
<!-- <div class="links">
  <div class="list-group">
    <a class="list-group-item list-group-item-action" href="{{ backpack_url('dashboard') }}"><i class="la la-home nav-icon"></i> {{ trans('backpack::base.dashboard') }}</a>
    <a class='list-group-item list-group-item-action' href='{{ route("user") }}'><i class="nav-icon far fa-user"></i> Users</a>
    <a class='list-group-item list-group-item-action active' href='{{ route("answer") }}'><i class="nav-icon fas fa-key"></i> Answers</a>
    <a class='list-group-item list-group-item-action' href='{{ route("category") }}'><i class="nav-icon fas fa-th"></i> Categories</a>
    <a class='list-group-item list-group-item-action' href='{{ route("subcategory") }}'><i class="nav-icon fas fa-layer-group"></i> Sub-Categories</a>
    <a class='list-group-item list-group-item-action' href='{{ route("image") }}'><i class="nav-icon fas fa-images"></i> Images</a>
    <a class='list-group-item list-group-item-action' href='{{ route("option") }}'><i class="nav-icon fas fa-bars"></i> Options</a>
    <a class='list-group-item list-group-item-action' href='{{ route("question") }}'><i class="fas fa-question-circle"></i> Questions</a>
    <a class='list-group-item list-group-item-action' href='{{ route("role") }}'><i class="nav-icon fas fa-user-shield"></i> Roles</a>
    <a class='list-group-item list-group-item-action' href='{{ route("selected") }}'><i class="nav-icon fas fa-check-circle"></i> Selected Options</a>
  </div>
</div> -->
<div class="container">
  <form action="" method="post">
    @csrf
    <h3>Edit Answer ID-{{$answer->id}}</h3>
    <div class="form-group">
    <label for="exampleFormControlSelect2">Select Question ID</label>
    <select multiple class="form-control" id="exampleFormControlSelect2" style="height: 300px;">
      @foreach($questions as $question)
        <option value="{{$question->id}}" @if($answer->questions_id == $question->id) selected @endif>ID: {{$question->id}}&#160;&#160;&#160; Question: {{$question->question}}</option>
      @endforeach
    </select>
    </div>
    <div class="form-group">
      <label for="exampleFormControlSelect2">Select Option ID</label>
      <select multiple class="form-control" id="exampleFormControlSelect2" style="height: 300px;">
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
