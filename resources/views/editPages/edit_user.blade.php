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
  <a href="{{route('user')}}"><button style="margin-bottom: 20px;" type="button" class="btn btn-outline-primary"><i class="fas fa-arrow-left"></i>&nbsp;Back</button></a>
  <form action="{{$action}}" method="post">
    @csrf
    @if ($new)
      <h3>Add New User</h3>
    @else
      <h3>Edit User ID-{{$user->id}}</h3>
    @endif
    <div class="form-group">
      <label for="name">Name</label>
      <input type="text" name="name" class="form-control" @if(!$new) value="{{$user->name}}" @endif id="name" aria-describedby="emailHelp" placeholder="Enter Name">
    </div>
    <div class="form-group">
      <label for="email">Email</label>
      <input type="email" name="email" class="form-control" @if(!$new) value="{{$user->email}}" @endif id="email" aria-describedby="emailHelp" placeholder="Enter email">
    </div>
    <div class="form-group">
      <label for="role_id">Select Option ID</label>
      <select multiple class="form-control" name="role_id" id="role_id">
        @foreach($roles as $role)
          <option value="{{$role->id}}" @if(!$new && $user->roles_id == $role->id) selected @endif>ID: {{$role->id}}&#160;&#160;&#160; Role: {{$role->role}}</option>
        @endforeach
      </select>
    </div>
    @if ($new)
    <div class="form-group">
      <label for="password">Password</label>
      <input type="password" class="form-control" name="password" id="password" aria-describedby="emailHelp" placeholder="Enter Password">
    </div>
    <div class="form-group">
      <label for="password_confirmation">Confirm Password</label>
      <input type="password" class="form-control" name="password_confirmation" id="password_confirmation" aria-describedby="emailHelp" placeholder="Enter Password">
    </div>
    @endif
    <button type="submit" style="margin-bottom: 40px;" class="btn btn-primary btn-sm float-right">@if($new) Add @else Edit @endif Answer</button>
  </form>
</div>

<script>
  checkPage('users');
</script>
@endsection
