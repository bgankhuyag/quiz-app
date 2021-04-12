@extends('layouts.app')

@section('content')
<div class="container">
  <a href="{{route('role')}}"><button style="margin-bottom: 20px;" type="button" class="btn btn-outline-primary">Back</button></a>
  <form action="{{$action}}" method="post">
    @csrf
    @if ($new)
      <h3>Add New Role</h3>
    @else
      <h3>Edit Role ID-{{$role->id}}</h3>
    @endif
    <div class="form-group">
      <label for="exampleInputEmail1">Role</label>
      <input type="text" class="form-control" @if(!$new) value="{{$role->role}}" @endif id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter Role">
    </div>
    <button type="submit" class="btn btn-primary btn-sm float-right">@if($new) Add @else Edit @endif Role</button>
  </form>
</div>

<script>
  checkPage('roles');
</script>
@endsection
