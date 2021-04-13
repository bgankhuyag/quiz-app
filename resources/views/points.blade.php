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
  <img src="https://quiz-app-files-images.s3-ap-southeast-1.amazonaws.com/math.png" >
  <a href="{{route('addPointPage')}}"><button style="margin-bottom: 20px;" type="button" class="btn btn-primary">Add</button></a>
  <h3>Points</h3>
  <table class="table table-striped">
  <thead>
    <tr>
      <th scope="col">ID</th>
      <th scope="col">User ID</th>
      <th scope="col">Category ID</th>
      <th scope="col">Point</th>
      <th></th>
    </tr>
  </thead>
  <tbody>
    @foreach($points as $point)
    <tr>
      <td>{{$point->id}}</td>
      <td>{{$point->users_id}}</td>
      <td>{{$point->categories_id}}</td>
      <td>{{$point->points}}</td>
      <td class="float-right">
        <a href="{{route('editPointPage', ['id' => $point->id])}}"><button type="button" class="btn btn-outline-primary btn-sm">Edit</button></a>
        <a href="{{route('removePoint', ['id' => $point->id])}}"><button type="button" class="btn btn-outline-danger btn-sm"><i class="far fa-trash-alt"></i> Delete</button></a>
      </td>
    </tr>
    @endforeach
  </tbody>
  <tr>
    <th scope="col">ID</th>
    <th scope="col">Category ID</th>
    <th scope="col">Sub-Category</th>
    <th scope="col">Point</th>
    <th></th>
  </tr>
  </table>
  {{ $points->links() }}
</div>

<script>
  checkPage('points');
</script>
@endsection
