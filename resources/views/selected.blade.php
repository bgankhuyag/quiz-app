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
  <a href="{{route('addSelectedPage')}}"><button style="margin-bottom: 20px;" type="button" class="btn btn-primary">Add</button></a>
  <h3>Selected Options</h3>
  <div class="table-responsive-xl">
    <table class="table table-striped table-hover">
      <thead>
        <tr>
          <th scope="col">ID</th>
          <th scope="col">User ID</th>
          <th scope="col">Question ID</th>
          <th scope="col">Option ID</th>
          <th></th>
        </tr>
      </thead>
      <tbody>
        @foreach($selecteds as $selected)
        <tr>
          <td>{{$selected->id}}</td>
          <td>{{$selected->users_id}}</td>
          <td>{{$selected->questions_id}}</td>
          <td>{{$selected->options_id}}</td>
          <td class="float-right">
            <a href="{{route('editSelectedPage', ['id' => $selected->id])}}"><button type="button" class="btn btn-outline-primary btn-sm">Edit</button></a>
            <a href="{{route('removeSelected', ['id' => $selected->id])}}"><button type="button" class="btn btn-outline-danger btn-sm"><i class="far fa-trash-alt"></i> Delete</button></a>
          </td>
        </tr>
        @endforeach
      </tbody>
      <tr>
        <th scope="col">ID</th>
        <th scope="col">User ID</th>
        <th scope="col">Question ID</th>
        <th scope="col">Option ID</th>
        <th></th>
      </tr>
    </table>
  </div>
  {{ $selecteds->links() }}
</div>

<script>
  checkPage('selecteds');
</script>
@endsection
