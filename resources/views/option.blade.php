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
  <table class="table table-striped">
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
        <a href="{{route('removeOption', ['id' => $option->id])}}"><button type="button" class="btn btn-outline-danger btn-sm"><i class="far fa-trash-alt"></i> Delete</button></a>
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
  {{ $options->links() }}
</div>

<script>
  checkPage('options');
</script>
@endsection
