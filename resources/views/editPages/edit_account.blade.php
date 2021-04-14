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
  <a href="{{route('account')}}"><button type="button" style="margin-bottom: 20px;" class="btn btn-outline-primary"><i class="fas fa-arrow-left"></i>&nbsp;Back</button></a>
  <h3 style="margin-bottom:20px;">Edit Account</h3>
  <form action="{{route('editAccount')}}" method="post" style="width: 90%; margin: auto;">
    @csrf
    <h5 style="margin: 10px 0px;">Acount Information</h5>
    <div class="form-group row">
      <label for="name" class="col-sm-2 col-form-label">Name</label>
      <div class="col-sm-10">
        <input type="text" class="form-control" name="name" id="name" value="{{backpack_user()->name}}" placeholder="firstname lastname" required>
      </div>
    </div>
    <div class="form-group row">
      <label for="email" class="col-sm-2 col-form-label">Email</label>
      <div class="col-sm-10">
        <input type="email" class="form-control" name="email" id="email" value="{{backpack_user()->email}}" placeholder="example@example.com" required>
      </div>
    </div>
    <h5 style="margin: 10px 0px;">Change Password</h5>
    <div class="form-group row">
      <label for="password" class="col-sm-2 col-form-label">New Password</label>
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
    <button type="submit" style="margin-bottom: 40px;" class="btn btn-primary mb-2 float-right">Save</button>
  </form>
</div>
@endsection
