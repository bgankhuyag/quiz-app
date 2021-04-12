@extends('layouts.app')

@section('content')
<div class="container">
  <a href="{{route('role')}}"><button style="margin-bottom: 20px;" type="button" class="btn btn-outline-primary">Back</button></a>
  <form action="" method="post">
    @csrf
    <h3>Edit Role ID-{{$role->id}}</h3>
    <div class="form-group">
      <label for="exampleInputEmail1">Role</label>
      <input type="text" class="form-control" value="{{$role->role}}" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter Role">
    </div>
    <button type="submit" class="btn btn-primary btn-sm float-right">Edit Role</button>
  </form>
</div>

<script>
  checkPage('roles');
</script>
@endsection
