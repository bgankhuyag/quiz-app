@extends('layouts.app')

@section('content')
<!-- <div class="links">
  <div class="list-group">
    <a class="list-group-item list-group-item-action" href="{{ backpack_url('dashboard') }}"><i class="la la-home nav-icon"></i> {{ trans('backpack::base.dashboard') }}</a>
    <a class='list-group-item list-group-item-action' href='{{ route("user") }}'><i class="nav-icon far fa-user"></i> Users</a>
    <a class='list-group-item list-group-item-action' href='{{ route("answer") }}'><i class="nav-icon fas fa-key"></i> Answers</a>
    <a class='list-group-item list-group-item-action' href='{{ route("category") }}'><i class="nav-icon fas fa-th"></i> Categories</a>
    <a class='list-group-item list-group-item-action active' href='{{ route("subcategory") }}'><i class="nav-icon fas fa-layer-group"></i> Sub-Categories</a>
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
