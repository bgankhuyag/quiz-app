@extends('layouts.app')

@section('content')
<div class="container">
  <h3>Welcome, <strong>{{Auth::guard('web')->user()->name}}</strong>.</h3>
  <h5>Use the links to view tables.</h5>
</div>

@endsection

@section('javascript')
<script>
checkPage('dashboard');
</script>
@endsection
