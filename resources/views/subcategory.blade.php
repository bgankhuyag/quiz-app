@extends('layouts.app')

@section('title')
: Sub-Categories
@endsection

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
          <th scope="col">Category</th>
          <th scope="col">Sub-Category</th>
          <th></th>
        </tr>
      </thead>
      <tbody>
        @foreach($sub_categories as $sub_category)
        <tr>
          <td>{{$sub_category->id}}</td>
          <td>{{$sub_category->category->category}}</td>
          <td>{{$sub_category->sub_category}}</td>
          <td class="float-right">
            <a href="{{route('editSubcategoryPage', ['id' => $sub_category->id])}}"><button type="button" class="btn btn-outline-primary btn-sm">Edit</button></a>
            <button type="button" class="btn btn-outline-danger btn-sm" data-toggle="modal" data-target="#exampleModal" onclick="clickModal({{$sub_category->id}})"><i class="far fa-trash-alt"></i> Delete</button>
          </td>
        </tr>
        @endforeach
      </tbody>
      <tr>
        <th scope="col">ID</th>
        <th scope="col">Category</th>
        <th scope="col">Sub-Category</th>
        <th></th>
      </tr>
    </table>
  </div>

  <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Delete Sub-Category</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form action="{{route('removeSubcategory')}}" method="post">
          @csrf
          <div class="modal-body">
            <div class="form-group">
              Do you want to delete Sub-Category ID <input type="text" readonly style="width: 30%;background-color: transparent;border: 0; font-size: 1em; font-weight: bold" name="id" id="id">
            </div>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
            <button type="submit" class="btn btn-danger">Delete</button>
          </div>
        </form>
      </div>
    </div>
  </div>

  {{ $sub_categories->links() }}
</div>

@endsection

@section('javascript')
<script>
checkPage('sub_categories');

function clickModal(id) {
  document.getElementById('id').value = id;
}
</script>
@endsection
