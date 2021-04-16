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
  <a href="{{route('addOptionPage')}}"><button style="margin-bottom: 20px;" type="button" class="btn btn-primary">Add</button></a>
  <h3>Options</h3>
  <div class="table-responsive-xl">
    <table class="table table-striped table-hover">
      <thead>
        <tr>
          <th scope="col">ID</th>
          <th scope="col">Question ID</th>
          <th scope="col">Option</th>
          <th></th>
        </tr>
      </thead>
      <tbody>
        @foreach($options as $option)
        <tr>
          <td>{{$option->id}}</td>
          <td>{{$option->questions_id}}</td>
          <td>{{$option->option}}</td>
          <td class="float-right">
            <a href="{{route('editOptionPage', ['id' => $option->id])}}"><button type="button" class="btn btn-outline-primary btn-sm">Edit</button></a>
            <button type="button" class="btn btn-outline-danger btn-sm" data-toggle="modal" data-target="#exampleModal" onclick="clickModal({{$option->id}})"><i class="far fa-trash-alt"></i> Delete</button>
          </td>
        </tr>
        @endforeach
      </tbody>
      <tr>
        <th scope="col">ID</th>
        <th scope="col">Question ID</th>
        <th scope="col">Option</th>
        <th></th>
      </tr>
    </table>
  </div>

  <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Delete Option</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form action="{{route('removeOption')}}" method="post">
          @csrf
          <div class="modal-body">
            <div class="form-group">
              Do you want to delete Option ID <input type="text" readonly style="background-color: transparent;border: 0; font-size: 1em; font-weight: bold" name="id" id="id">
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

  {{ $options->links() }}
</div>
@endsection

@section('javascript')
<script>
checkPage('options');

function clickModal(id) {
  document.getElementById('id').value = id;
}
</script>
@endsection
