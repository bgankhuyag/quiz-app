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
  <a href="{{route('addSubcategoryPage')}}"><button style="margin-bottom: 20px;" type="button" class="btn btn-primary">Add</button></a>
  <h3>Sub-Categories</h3>
  <div class="table-responsive-xl">
    <table class="table table-striped table-hover">
      <thead>
        <tr>
          <th scope="col">ID</th>
          <th scope="col">Category ID</th>
          <th scope="col">Sub-Category</th>
          <th></th>
        </tr>
      </thead>
      <tbody>
        @foreach($sub_categories as $sub_category)
        <tr>
          <td>{{$sub_category->id}}</td>
          <td>{{$sub_category->categories_id}}</td>
          <td>{{$sub_category->sub_category}}</td>
          <td class="float-right">
            <a href="{{route('editSubcategoryPage', ['id' => $sub_category->id])}}"><button type="button" class="btn btn-outline-primary btn-sm">Edit</button></a>
            <a href="{{route('removeSubcategory', ['id' => $sub_category->id])}}"><button type="button" class="btn btn-outline-danger btn-sm"><i class="far fa-trash-alt"></i> Delete</button></a>
          </td>
        </tr>
        @endforeach
      </tbody>
      <tr>
        <th scope="col">ID</th>
        <th scope="col">Category ID</th>
        <th scope="col">Sub-Category</th>
        <th></th>
      </tr>
    </table>
  </div>
  {{ $sub_categories->links() }}
</div>

@endsection

@section('javascript')
<script>
checkPage('sub_categories');
</script>
@endsection
