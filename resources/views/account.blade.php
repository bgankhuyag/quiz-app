@extends('layouts.app')

@section('content')
<div class="container">
  <h3 style="margin-bottom:20px; display: inline-block; margin-right: 20px;">Account Information</h3>
  <a href="{{route('editAccountPage')}}"><button type="button" class="btn btn-outline-primary"><i class="fas fa-user-cog"></i> Edit Account</button></a>
  <div class="form-group row">
    <label for="name" class="col-sm-2 col-form-label">Name:</label>
    <div class="col-sm-10">
      <input type="text" readonly class="form-control-plaintext" name="name" id="name" value="{{Auth::guard('web')->user()->name}}" placeholder="firstname lastname" required>
    </div>
  </div>
  <div class="form-group row">
    <label for="email" class="col-lg-2 col-form-label">Email Address:</label>
    <div class="col-lg-10">
      <input type="email" readonly class="form-control-plaintext" name="email" id="email" value="{{Auth::guard('web')->user()->email}}" placeholder="example@example.com" required>
    </div>
  </div>
</div>
@endsection
