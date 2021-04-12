@extends('layouts.app')

@section('content')
<div class="container">
  <a href="{{route('points')}}"><button style="margin-bottom: 20px;" type="button" class="btn btn-outline-primary">Back</button></a>
  <form action="" method="post">
    @csrf
    <h3>Edit Point ID-{{$point->id}}</h3>
    <div class="form-group">
      <label for="exampleFormControlSelect2">Select Category ID</label>
      <select multiple class="form-control" id="exampleFormControlSelect2" style="height: 300px;">
        @foreach($categories as $category)
        <option value="{{$category->id}}" @if($point->categories_id == $category->id) selected @endif>ID: {{$category->id}}&#160;&#160;&#160; Category: {{$category->category}}</option>
        @endforeach
      </select>
    </div>
    <div class="form-group">
      <label for="exampleFormControlSelect2">Select User ID</label>
      <select multiple class="form-control" id="exampleFormControlSelect2" style="height: 300px;">
        @foreach($users as $user)
        <option value="{{$user->id}}" @if($option->users_id == $user->id) selected @endif>ID: {{$user->id}}&#160;&#160;&#160; Name: {{$user->name}} &#160;&#160;&#160; Email: {{$user->email}}</option>
        @endforeach
      </select>
    </div>
    <div class="form-group">
      <label for="exampleInputEmail1">Point</label>
      <input type="number" class="form-control" min="0" value="{{$point->points}}" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter Category">
    </div>
    <button type="submit" class="btn btn-primary btn-sm float-right">Edit Point</button>
  </form>
</div>

<script>
  checkPage('points');
</script>
@endsection
