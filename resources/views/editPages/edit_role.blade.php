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
  <a href="{{route('role')}}"><button style="margin-bottom: 20px;" type="button" class="btn btn-outline-primary"><i class="fas fa-arrow-left"></i>&nbsp;Back</button></a>
  <form action="{{$action}}" method="post">
    @csrf
    @if ($new)
      <h3>Add New Role</h3>
    @else
      <h3>Edit Role ID-{{$role->id}}</h3>
    @endif
    <div class="form-group">
      <label for="role">Role</label>
      <input type="text" name="role" class="form-control" @if(!$new) value="{{$role->role}}" @endif id="role" aria-describedby="emailHelp" placeholder="Enter Role">
    </div>
    <button style="margin-bottom: 40px;" type="submit" class="btn btn-primary btn-sm float-right">@if($new) Add @else Edit @endif Role</button>
  </form>
</div>

<script>
  checkPage('roles');
</script>
@endsection
