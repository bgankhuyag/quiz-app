@extends('layouts.app')

@section('content')
<div class="container">
  <a href="{{route('user')}}"><button style="margin-bottom: 20px;" type="button" class="btn btn-outline-primary">Back</button></a>
  <form action="" method="post">
    @csrf
    <h3>Edit User ID-{{$user->id}}</h3>
    <div class="form-group">
      <label for="exampleInputEmail1">Name</label>
      <input type="text" class="form-control" value="{{$user->name}}" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter email">
    </div>
    <div class="form-group">
      <label for="exampleInputEmail1">Email</label>
      <input type="email" class="form-control" value="{{$user->email}}" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter email">
    </div>
    <div class="form-group">
      <label for="exampleFormControlSelect2">Select Option ID</label>
      <select multiple class="form-control" id="exampleFormControlSelect2">
        @foreach($roles as $role)
          <option value="{{$role->id}}" @if($user->roles_id == $role->id) selected @endif>ID: {{$role->id}}&#160;&#160;&#160; Role: {{$role->role}}</option>
        @endforeach
      </select>
    </div>
    <button type="submit" class="btn btn-primary btn-sm float-right">Edit Answer</button>
  </form>
</div>

<script>
  checkPage('users');
</script>
@endsection
