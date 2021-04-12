@extends('layouts.app')

@section('content')
<div class="container">
  <a href="{{route('user')}}"><button style="margin-bottom: 20px;" type="button" class="btn btn-outline-primary">Back</button></a>
  <form action="{{$action}}" method="post">
    @csrf
    @if ($new)
      <h3>Add New User</h3>
    @else
      <h3>Edit User ID-{{$user->id}}</h3>
    @endif
    <div class="form-group">
      <label for="exampleInputEmail1">Name</label>
      <input type="text" class="form-control" @if(!$new) value="{{$user->name}}" @endif id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter Name">
    </div>
    <div class="form-group">
      <label for="exampleInputEmail1">Email</label>
      <input type="email" class="form-control" @if(!$new) value="{{$user->email}}" @endif id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter email">
    </div>
    <div class="form-group">
      <label for="exampleFormControlSelect2">Select Option ID</label>
      <select multiple class="form-control" id="exampleFormControlSelect2">
        @foreach($roles as $role)
          <option value="{{$role->id}}" @if(!$new && $user->roles_id == $role->id) selected @endif>ID: {{$role->id}}&#160;&#160;&#160; Role: {{$role->role}}</option>
        @endforeach
      </select>
    </div>
    @if ($new)
    <div class="form-group">
      <label for="exampleInputEmail1">Password</label>
      <input type="email" class="form-control" @endif id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter Password">
    </div>
    <div class="form-group">
      <label for="exampleInputEmail1">Confirm Password</label>
      <input type="email" class="form-control" @endif id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter Password">
    </div>
    @endif
    <button type="submit" class="btn btn-primary btn-sm float-right">@if($new) Add @else Edit @endif Answer</button>
  </form>
</div>

<script>
  checkPage('users');
</script>
@endsection
