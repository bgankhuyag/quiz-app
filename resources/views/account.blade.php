@extends('layouts.app')

@section('content')
<div class="container">
  <h3 style="margin-bottom:20px; display: inline-block; margin-right: 20px;">Account Information</h3>
  <a href="{{route('editAccountPage')}}"><button type="button" class="btn btn-outline-primary">Edit Account</button></a>
  <div class="form-group row">
    <label for="name" class="col-sm-2 col-form-label">Name</label>
    <div class="col-sm-10">
      <input type="text" readonly class="form-control" name="name" id="name" value="{{backpack_user()->name}}" placeholder="firstname lastname" required>
    </div>
  </div>
  <div class="form-group row">
    <label for="email" class="col-sm-2 col-form-label">Eamil</label>
    <div class="col-sm-10">
      <input type="email" readonly class="form-control" name="email" id="email" value="{{backpack_user()->email}}" placeholder="example@example.com" required>
    </div>
  </div>
</div>
@endsection
