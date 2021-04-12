@extends('layouts.app')

@section('content')
<div class="container">
  <a href="{{route('category')}}"><button style="margin-bottom: 20px;" type="button" class="btn btn-outline-primary">Back</button></a>
  <form action="{{$action}}" method="post">
    @csrf
    @if ($new)
      <h3>Add New Category</h3>
    @else
      <h3>Edit Category ID-{{$category->id}}</h3>
    @endif
    <div class="form-group">
      <label for="category">Category</label>
      <input type="text" name="category" class="form-control" @if(!$new) value="{{$category->category}}" @endif id="category" aria-describedby="emailHelp" placeholder="Enter Category">
    </div>
    <div>
      @if(!$new && !empty($category->image))
        <img src="{{asset($category->image)}}" width="100">
      @endif
      <div class="form-group">
        <label for="image">Choose Image</label>
        <input type="file" name="image" class="form-control-file" id="image">
      </div>
    </div>
    <button type="submit" class="btn btn-primary btn-sm float-right">@if($new) Add @else Edit @endif Category</button>
  </form>
</div>

<script>
  checkPage('categories');
</script>
@endsection
