@extends('layouts.app')

@section('content')
<div class="container">
  <a href="{{route('addCategoryPage')}}"><button type="button" class="btn btn-info">Add</button></a>
  <h3>Categories</h3>
  <table class="table table-striped">
  <thead>
    <tr>
      <th scope="col">ID</th>
      <th scope="col">Category</th>
      <th scope="col">Image</th>
      <th></th>
    </tr>
  </thead>
  <tbody>
    @foreach($categories as $category)
    <tr>
      <td>{{$category->id}}</td>
      <td>{{$category->category}}</td>
      <td>{{$category->getRawOriginal('image')}}</td>
      <td class="float-right">
        <a href="{{route('editCategoryPage', ['id' => $category->id])}}"><button type="button" class="btn btn-outline-primary btn-sm">Edit</button></a>
        <button type="button" class="btn btn-outline-danger btn-sm"><i class="far fa-trash-alt"></i> Delete</button>
      </td>
    </tr>
    @endforeach
  </tbody>
  <tr>
    <th scope="col">ID</th>
    <th scope="col">Category</th>
    <th scope="col">Image</th>
    <th></th>
  </tr>
  </table>
  {{ $categories->links() }}
</div>

<script>
  var questions = document.getElementById('questions');
  if (questions.classList.contains("active")) {
    questions.classList.remove("active");
  }
  var users = document.getElementById('users');
  if (users.classList.contains("active")) {
    users.classList.remove("active");
  }
  var answers = document.getElementById('answers');
  if (answers.classList.contains("active")) {
    answers.classList.remove("active");
  }
  var categories = document.getElementById('categories');
  if (!categories.classList.contains("active")) {
    categories.classList.add("active");
  }
  var sub_categories = document.getElementById('sub_categories');
  if (sub_categories.classList.contains("active")) {
    sub_categories.classList.remove("active");
  }
  var images = document.getElementById('images');
  if (images.classList.contains("active")) {
    images.classList.remove("active");
  }
  var options = document.getElementById('options');
  if (options.classList.contains("active")) {
    options.classList.remove("active");
  }
  var roles = document.getElementById('roles');
  if (roles.classList.contains("active")) {
    roles.classList.remove("active");
  }
  var selecteds = document.getElementById('selecteds');
  if (selecteds.classList.contains("active")) {
    selecteds.classList.remove("active");
  }
  var points = document.getElementById('points');
  if (points.classList.contains("active")) {
    points.classList.remove("active");
  }
  var dahsboard = document.getElementById('dashboard');
  if (dashboard.classList.contains("active")) {
    dashboard.classList.remove("active");
  }
</script>
@endsection
