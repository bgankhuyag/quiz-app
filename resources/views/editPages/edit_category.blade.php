@extends('layouts.app')

@section('content')
<div class="container">
  <form action="" method="post">
    @csrf
    <h3>Edit Category ID-{{$category->id}}</h3>
    <div class="form-group">
      <label for="exampleInputEmail1">Category</label>
      <input type="text" class="form-control" value="{{$category->category}}" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter Category">
    </div>
    <div>
      <img src="{{asset($category->image)}}" width="300">
    </div>
    <button type="submit" class="btn btn-primary btn-sm float-right">Edit Category</button>
  </form>
</div>

<script>
  checkPage('categories');
</script>
@endsection
