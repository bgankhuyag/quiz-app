@extends('layouts.app')

@section('content')
<div class="container">
  <a href="{{route('question')}}"><button style="margin-bottom: 20px;" type="button" class="btn btn-outline-primary">Back</button></a>
  <form action="" method="post">
    @csrf
    <h3>Edit Question ID-{{$question->id}}</h3>
    <div class="form-group">
      <label for="exampleFormControlSelect2">Select Category ID</label>
      <select multiple class="form-control" id="exampleFormControlSelect2" style="height: 300px;">
        @foreach($categories as $category)
        <option value="{{$category->id}}" @if($question->categories_id == $category->id) selected @endif>ID: {{$category->id}}&#160;&#160;&#160; Category: {{$category->category}}</option>
        @endforeach
      </select>
    </div>
    <div class="form-group">
      <label for="exampleFormControlSelect2">Select Sub-Category ID</label>
      <select multiple class="form-control" id="exampleFormControlSelect2" style="height: 300px;">
        @foreach($sub_categories as $sub_category)
        <option value="{{$sub_category->id}}" @if($question->sub_categories_id == $sub_category->id) selected @endif>ID: {{$sub_category->id}}&#160;&#160;&#160; Category ID: {{$sub_category->categories_id}}&#160;&#160;&#160; Question: {{$sub_category->sub_category}}</option>
        @endforeach
      </select>
    </div>
    <div class="form-group">
      <label for="exampleFormControlSelect2">Select Correct Option ID</label>
      <select multiple class="form-control" id="exampleFormControlSelect2" style="height: 300px;">
        @foreach($options as $option)
        <option value="{{$option->id}}" @if($question->correct_option_id == $option->id) selected @endif>ID: {{$option->id}}&#160;&#160;&#160; Option: {{$option->option}}</option>
        @endforeach
      </select>
    </div>
    <div class="form-group">
      <label for="exampleInputEmail1">Category</label>
      <input type="text" class="form-control" value="{{$question->question}}" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter Category">
    </div>
    <div>
      @if (!empty($question->image))
        <img src="{{asset($question->image)}}" width="100">
      @endif
      <div class="form-group">
        <label for="exampleFormControlFile1">Choose Image</label>
        <input type="file" class="form-control-file" id="exampleFormControlFile1">
      </div>
    </div>
    <button type="submit" class="btn btn-primary btn-sm float-right">Edit Question</button>
  </form>
</div>

<script>
  checkPage('questions');
</script>
@endsection
