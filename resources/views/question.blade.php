@extends('layouts.app')

@section('content')
<div class="links">
  <div class="list-group">
    <a class="list-group-item list-group-item-action" href="{{ backpack_url('dashboard') }}"><i class="la la-home nav-icon"></i> {{ trans('backpack::base.dashboard') }}</a>
    <a class='list-group-item list-group-item-action' href='{{ route("user") }}'><i class="nav-icon far fa-user"></i> Users</a>
    <a class='list-group-item list-group-item-action' href='{{ route("answer") }}'><i class="nav-icon fas fa-key"></i> Answers</a>
    <a class='list-group-item list-group-item-action' href='{{ route("category") }}'><i class="nav-icon fas fa-th"></i> Categories</a>
    <a class='list-group-item list-group-item-action' href='{{ route("subcategory") }}'><i class="nav-icon fas fa-layer-group"></i> Sub-Categories</a>
    <a class='list-group-item list-group-item-action' href='{{ route("image") }}'><i class="nav-icon fas fa-images"></i> Images</a>
    <a class='list-group-item list-group-item-action' href='{{ route("option") }}'><i class="nav-icon fas fa-bars"></i> Options</a>
    <a class='list-group-item list-group-item-action active' href='{{ route("question") }}'><i class="fas fa-question-circle"></i> Questions</a>
    <a class='list-group-item list-group-item-action' href='{{ route("role") }}'><i class="nav-icon fas fa-user-shield"></i> Roles</a>
    <a class='list-group-item list-group-item-action' href='{{ route("selected") }}'><i class="nav-icon fas fa-check-circle"></i> Selected Options</a>
  </div>
</div>
<div class="container">
  <h3>Questions</h3>
  <table class="table table-striped">
  <thead>
    <tr>
      <th scope="col">ID</th>
      <th scope="col">Question</th>
      <th scope="col">Category ID</th>
      <th scope="col">Sub-Category ID</th>
      <th></th>
    </tr>
  </thead>
  <tbody>
    @foreach($questions as $question)
    <tr>
      <td>{{$question->id}}</td>
      <td>{{$question->question}}</td>
      <td>{{$question->categories_id}}</td>
      <td>{{$question->sub_categories_id}}</td>
      <td class="float-right">
        <button type="button" class="btn btn-outline-primary btn-sm">Edit</button>
        <button type="button" class="btn btn-outline-danger btn-sm"><i class="far fa-trash-alt"></i> Delete</button>
      </td>
    </tr>
    @endforeach
  </tbody>
  <tr>
    <th scope="col">ID</th>
    <th scope="col">Question</th>
    <th scope="col">Category ID</th>
    <th scope="col">Sub-Category ID</th>
    <th></th>
  </tr>
  </table>
  {{ $questions->links() }}
</div>
@endsection
