@extends('layouts.app')

@section('content')
<div class="links">
  <div class="list-group">
    <a class="list-group-item list-group-item-action" href="{{ backpack_url('dashboard') }}"><i class="la la-home nav-icon"></i> {{ trans('backpack::base.dashboard') }}</a>
    <a class='list-group-item list-group-item-action' href='{{ route("user") }}'><i class="nav-icon far fa-user"></i> Users</a>
    <a class='list-group-item list-group-item-action active' href='{{ route("answer") }}'><i class="nav-icon fas fa-key"></i> Answers</a>
    <a class='list-group-item list-group-item-action' href='{{ route("category") }}'><i class="nav-icon fas fa-th"></i> Categories</a>
    <a class='list-group-item list-group-item-action' href='{{ route("subcategory") }}'><i class="nav-icon fas fa-layer-group"></i> Sub-Categories</a>
    <a class='list-group-item list-group-item-action' href='{{ route("image") }}'><i class="nav-icon fas fa-images"></i> Images</a>
    <a class='list-group-item list-group-item-action' href='{{ route("option") }}'><i class="nav-icon fas fa-bars"></i> Options</a>
    <a class='list-group-item list-group-item-action' href='{{ route("question") }}'><i class="fas fa-question-circle"></i> Questions</a>
    <a class='list-group-item list-group-item-action' href='{{ route("role") }}'><i class="nav-icon fas fa-user-shield"></i> Roles</a>
    <a class='list-group-item list-group-item-action' href='{{ route("selected") }}'><i class="nav-icon fas fa-check-circle"></i> Selected Options</a>
  </div>
</div>
<div class="container">
  <h3>Answers</h3>
  <table class="table table-striped">
  <thead>
    <tr>
      <th scope="col">ID</th>
      <th scope="col">Question ID</th>
      <th scope="col">Option ID</th>
      <th></th>
    </tr>
  </thead>
  <tbody>
    @foreach($answers as $answer)
    <tr>
      <td>{{$answer->id}}</td>
      <td>{{$answer->questions_id}}</td>
      <td>{{$answer->options_id}}</td>
      <td class="float-right">
        <a href="{{ route('editAnswerPage', ['id' => $answer->id])}}"><button type="button" class="btn btn-outline-primary btn-sm">Edit</button></a>
        <button type="button" class="btn btn-outline-danger btn-sm"><i class="far fa-trash-alt"></i> Delete</button>
      </td>
    </tr>
    @endforeach
  </tbody>
  <tr>
    <th scope="col">ID</th>
    <th scope="col">Question ID</th>
    <th scope="col">Option ID</th>
    <th></th>
  </tr>
  </table>
  {{ $answers->links() }}
</div>
@endsection
