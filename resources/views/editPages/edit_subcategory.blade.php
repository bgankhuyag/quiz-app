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
  <a href="{{route('subcategory')}}"><button style="margin-bottom: 20px;" type="button" class="btn btn-outline-primary"><i class="fas fa-arrow-left"></i>&nbsp;Back</button></a>
  <form action="{{$action}}" method="post">
    @csrf
    @if ($new)
      <h3>Add New Sub-Category</h3>
    @else
      <h3>Edit Sub-Category ID-{{$sub_category->id}}</h3>
    @endif
    <div class="form-group">
    <label for="category_id">Select Question ID</label>
    <select multiple class="form-control" name="category_id" id="category_id" style="height: 200px;">
      @foreach($categories as $category)
        <option value="{{$category->id}}" @if(!$new && $sub_category->categories_id == $category->id) selected @endif>ID: {{$category->id}}&#160;&#160;&#160; Category: {{$category->category}}</option>
      @endforeach
    </select>
    </div>
    <div class="form-group">
      <label for="subcategory">Sub-Category</label>
      <input type="text" name="subcategory" class="form-control" @if (!$new) value="{{$sub_category->sub_category}}" @endif id="subcategory" aria-describedby="emailHelp" placeholder="Enter Sub-Category">
    </div>
    <button type="submit" class="btn btn-primary btn-sm float-right">@if($new) Add @else Edit @endif Answer</button>
  </form>
</div>

<script>
checkPage('sub_categories');
</script>
@endsection
