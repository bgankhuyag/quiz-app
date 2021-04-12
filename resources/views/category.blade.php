@extends('layouts.app')

@section('content')
<div class="container">
  <a href="{{route('addCategoryPage')}}"><button style="margin-bottom: 20px;" type="button" class="btn btn-primary">Add</button></a>
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
  checkPage('categories');
</script>
@endsection
