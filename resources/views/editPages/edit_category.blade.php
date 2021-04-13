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
  <a href="{{route('category')}}"><button style="margin-bottom: 20px;" type="button" class="btn btn-outline-primary">Back</button></a>
  <form action="{{$action}}" method="post" enctype="multipart/form-data">
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
        <img src="{{$category->image}}" width="100" style="margin-right: 20px;">
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
    <button type="submit" class="btn btn-primary btn-sm float-right">@if($new) Add @else Edit @endif Category</button>
  </form>
</div>

<script>
  checkPage('categories');
</script>
@endsection
