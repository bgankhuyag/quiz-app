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
  <a href="{{route('question')}}"><button style="margin-bottom: 20px;" type="button" class="btn btn-outline-primary">Back</button></a>
  <form action="{{$action}}" method="post" enctype="multipart/form-data">
    @csrf
    @if($new)
      <h3>Add New Question</h3>
    @else
      <h3>Edit Question ID-{{$question->id}}</h3>
    @endif
    <div class="form-group">
      <label for="category_id">Select Category ID</label>
      <select multiple class="form-control" name="category_id" id="category_id" style="height: 300px;">
        @foreach($categories as $category)
        <option value="{{$category->id}}" @if(!$new && $question->categories_id == $category->id) selected @endif>ID: {{$category->id}}&#160;&#160;&#160; Category: {{$category->category}}</option>
        @endforeach
      </select>
    </div>
    <div class="form-group">
      <label for="subcategory_id">Select Sub-Category ID</label>
      <select multiple class="form-control" name="subcategory_id" id="subcategory_id" style="height: 300px;">
        @foreach($sub_categories as $sub_category)
        <option value="{{$sub_category->id}}" @if(!$new && $question->sub_categories_id == $sub_category->id) selected @endif>ID: {{$sub_category->id}}&#160;&#160;&#160; Category ID: {{$sub_category->categories_id}}&#160;&#160;&#160; Question: {{$sub_category->sub_category}}</option>
        @endforeach
      </select>
    </div>
    @if ($new)
      <div class="form-group">
        <label for="option">Correct Option</label>
        <input type="text" name="option" class="form-control" id="option" aria-describedby="option" placeholder="Enter Option">
      </div>
    @else
      <div class="form-group">
        <label for="option_id">Select Correct Option ID</label>
        <select multiple class="form-control" name="option_id" id="option_id" style="height: 300px;">
          @foreach($options as $option)
          <option value="{{$option->id}}" @if($question->correct_option_id == $option->id) selected @endif>ID: {{$option->id}}&#160;&#160;&#160; Question ID: {{$option->questions_id}} &#160;&#160;&#160; Option: {{$option->option}}</option>
          @endforeach
        </select>
      </div>
    @endif
    <div class="form-group">
      <label for="question">Question</label>
      <input type="text" name="question" class="form-control" @if(!$new) value="{{$question->question}}" @endif id="question" aria-describedby="emailHelp" placeholder="Enter Question">
    </div>
    <div>
      @if (!$new && !empty($question->image))
        <img src="{{$question->image}}" width="250" style="margin-right: 20px;">
        <div class="form-check form-check-inline">
          <input class="form-check-input" type="checkbox" id="removeImage" name="removeImage" value="remove">
          <label class="form-check-label" for="removeImage">Delete Image</label>
        </div>
      @endif
      <div class="form-group">
        <label for="image">Choose Image</label>
        <input type="file" name="image" class="form-control-file" id="image">
      </div>
    </div>
    <button type="submit" class="btn btn-primary btn-sm float-right">@if($new) Add @else Edit @endif Question</button>
  </form>
</div>

<script>
  checkPage('questions');
</script>
@endsection
