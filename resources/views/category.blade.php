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
  <a href="{{route('addCategoryPage')}}"><button style="margin-bottom: 20px;" type="button" class="btn btn-primary">Add</button></a>
  <h3>Categories</h3>
  <div class="table-responsive-xl">
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
            <a href="{{route('removeCategory', ['id' => $category->id])}}"><button type="button" class="btn btn-outline-danger btn-sm"><i class="far fa-trash-alt"></i> Delete</button></a>
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
  </div>
  {{ $categories->links() }}
</div>

<script>
  checkPage('categories');
</script>
@endsection
