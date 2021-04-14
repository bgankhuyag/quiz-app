@extends('layouts.app')

@section('content')
<div class="container">
  <h4>Welcome, <strong>{{backpack_user()->name}}</strong>. Use the link to the left to view tables.</h4>
</div>

<script>
  checkPage('dashboard');
</script>
@endsection
