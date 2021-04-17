@extends('layouts.app')

@section('title')
@if ($new)
: Add Point
@else
: Edit Point
@endif
@endsection

@section('content')
<div class="container">
  @if($errors->any())
  <div class="alert alert-danger" role="alert">
    @foreach ($errors->all() as $error)
      <h3>{{ $error }}</h3>
    @endforeach
  </div>
  @endif
  <a href="{{route('points')}}"><button style="margin-bottom: 20px;" type="button" class="btn btn-outline-primary"><i class="fas fa-arrow-left"></i>&nbsp;Back</button></a>
  <form action="{{$action}}" method="post" >
    @csrf
    @if ($new)
      <h3>Ad New Point</h3>
    @else
      <h3>Edit Point ID-{{$point->id}}</h3>
    @endif
    <div class="form-group">
      <label for="category_id">Select Category ID</label>
      <select multiple class="form-control" name="category_id" id="category_id" style="height: 300px;">
        @foreach($categories as $category)
        <option value="{{$category->id}}" @if(!$new && $point->categories_id == $category->id) selected @endif>ID: {{$category->id}}&#160;&#160;&#160; Category: {{$category->category}}</option>
        @endforeach
      </select>
    </div>
    <div class="form-group">
      <label for="user_id">Select User ID</label>
      <select multiple class="form-control" name="user_id" id="user_id" style="height: 300px;">
        @foreach($users as $user)
        <option value="{{$user->id}}" @if(!$new && $point->users_id == $user->id) selected @endif>ID: {{$user->id}}&#160;&#160;&#160; Name: {{$user->name}} &#160;&#160;&#160; Email: {{$user->email}}</option>
        @endforeach
      </select>
    </div>
    <div class="form-group">
      <label for="point">Point</label>
      <input type="number" name="point" class="form-control" min="0" @if(!$new) value="{{$point->points}}" @endif id="point" aria-describedby="emailHelp" placeholder="Enter Point">
    </div>
    <button style="margin-bottom: 40px;" type="submit" class="btn btn-primary btn-sm float-right">@if($new) Add @else Save @endif Point</button>
  </form>
</div>

@endsection

@section('javascript')
<script>
checkPage('points');
</script>
@endsection
