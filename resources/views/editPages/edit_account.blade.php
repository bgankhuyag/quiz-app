@extends('layouts.app')

@section('content')
<div class="container">
  <a href="{{route('account')}}"><button type="button" class="btn btn-outline-primary">Back</button></a>
  <h3 style="margin-bottom:20px;">Edit Account</h3>
  <form action="" method="post" style="width: 90%; margin: auto;">
    @csrf
    <h5 style="margin: 10px 0px;">Acount Information</h5>
    <div class="form-group row">
      <label for="name" class="col-sm-2 col-form-label">Name</label>
      <div class="col-sm-10">
        <input type="text" class="form-control" name="name" id="name" value="{{backpack_user()->name}}" placeholder="firstname lastname" required>
      </div>
    </div>
    <div class="form-group row">
      <label for="email" class="col-sm-2 col-form-label">Eamil</label>
      <div class="col-sm-10">
        <input type="email" class="form-control" name="email" id="email" value="{{backpack_user()->email}}" placeholder="example@example.com" required>
      </div>
    </div>
    <h5 style="margin: 10px 0px;">Change Password</h5>
    <div class="form-group row">
      <label for="password" class="col-sm-2 col-form-label">Password</label>
      <div class="col-sm-10">
        <input type="password" class="form-control" name="password" id="password">
      </div>
    </div>
    <div class="form-group row">
      <label for="password_confirmation" class="col-sm-2 col-form-label">Confirm Password</label>
      <div class="col-sm-10">
        <input type="password" class="form-control" name="password_confirmation" id="password_confirmation">
      </div>
    </div>
    <button type="submit" class="btn btn-primary mb-2 float-right">Edit</button>
  </form>
</div>
@endsection
