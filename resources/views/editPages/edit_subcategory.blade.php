@extends('layouts.app')

@section('content')
<div class="container">
  <a href="{{route('subcategory')}}"><button style="margin-bottom: 20px;" type="button" class="btn btn-outline-primary">Back</button></a>
  <form action="" method="post">
    @csrf
    <h3>Edit Sub-Category ID-{{$sub_category->id}}</h3>
    <div class="form-group">
    <label for="exampleFormControlSelect2">Select Question ID</label>
    <select multiple class="form-control" id="exampleFormControlSelect2" style="height: 200px;">
      @foreach($categories as $category)
        <option value="{{$category->id}}" @if($sub_category->categories_id == $category->id) selected @endif>ID: {{$category->id}}&#160;&#160;&#160; Category: {{$category->category}}</option>
      @endforeach
    </select>
    </div>
    <div class="form-group">
      <label for="exampleInputEmail1">Sub-Category</label>
      <input type="text" class="form-control" value="{{$sub_category->sub_category}}" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter email">
    </div>
    <button type="submit" class="btn btn-primary btn-sm float-right">Edit Answer</button>
  </form>
</div>

<script>
checkPage('sub_categories');
</script>
@endsection
