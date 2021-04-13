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
  <a href="{{route('addUserPage')}}"><button style="margin-bottom: 20px;" type="button" class="btn btn-primary">Add</button></a>
  <h3>Users</h3>
  <div class="table-responsive-xl">
    <table class="table table-striped">
      <thead>
        <tr>
          <th scope="col">ID</th>
          <th scope="col">Name</th>
          <th scope="col">Email</th>
          <th scope="col">Role ID</th>
          <th scope="col">Password</th>
          <th></th>
        </tr>
      </thead>
      <tbody>
        @foreach($users as $user)
        <tr>
          <td>{{$user->id}}</td>
          <td>{{$user->name}}</td>
          <td>{{$user->email}}</td>
          <td>{{$user->roles_id}}</td>
          <td>{{$user->password}}</td>
          <td class="float-right">
            <a href="{{route('editUserPage', ['id' => $user->id])}}"><button type="button" class="btn btn-outline-primary btn-sm">Edit</button></a>
            <a href="{{route('removeUser', ['id' => $user->id])}}"><button type="button" class="btn btn-outline-danger btn-sm"><i class="far fa-trash-alt"></i> Delete</button></a>
          </td>
        </tr>
        @endforeach
      </tbody>
      <tr>
        <th scope="col">ID</th>
        <th scope="col">Name</th>
        <th scope="col">Email</th>
        <th scope="col">Role ID</th>
        <th scope="col">Password</th>
        <th></th>
      </tr>
    </table>
  </div>
  {{ $users->links() }}
</div>

<script>
  checkPage('users');
</script>
@endsection
