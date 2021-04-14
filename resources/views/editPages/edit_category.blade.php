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
  <a href="{{route('category')}}"><button style="margin-bottom: 20px;" type="button" class="btn btn-outline-primary"><i class="fas fa-arrow-left"></i>&nbsp;Back</button></a>
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
      @endif
      <div class="form-group">
        <label for="image">Choose Image</label>
        <input type="file" name="image" class="form-control-file" id="image">
      </div>
    </div>
    <button type="submit" style="margin-bottom: 40px;" class="btn btn-primary btn-sm float-right">@if($new) Add @else Edit @endif Category</button>
  </form>
</div>

<script>
  checkPage('categories');
</script>
@endsection
