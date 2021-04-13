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
  <a href="{{route('addQuestionPage')}}"><button style="margin-bottom: 20px;" type="button" class="btn btn-primary">Add</button></a>
  <h3>Questions</h3>
  <div class="table-responsive-xl">
    <table class="table table-striped">
    <thead>
      <tr>
        <th scope="col-sm-1">ID</th>
        <th scope="col">Question</th>
        <th scope="col-sm-1">Category ID</th>
        <th scope="col-sm-1">Sub Category ID</th>
        <th scope="col-sm-1">Correct Option ID</th>
        <th scope="col">Image</th>
        <th></th>
      </tr>
    </thead>
    <tbody>
      @foreach($questions as $question)
      <tr>
        <td>{{$question->id}}</td>
        <td>{{$question->question}}</td>
        <td>{{$question->categories_id}}</td>
        <td>{{$question->sub_categories_id}}</td>
        <td>{{$question->correct_option_id}}</td>
        <td>{{$question->getRawOriginal('image')}}</td>
        <td class="float-right">
          <a href="{{route('editQuestionPage', ['id' => $question->id])}}"><button type="button" class="btn btn-outline-primary btn-sm">Edit</button></a>
          <a href="{{route('removeQuestion', ['id' => $question->id])}}"><button type="button" class="btn btn-outline-danger btn-sm"><i class="far fa-trash-alt"></i> Delete</button></a>
        </td>
      </tr>
      @endforeach
    </tbody>
    <tr>
      <th scope="col">ID</th>
      <th scope="col">Question</th>
      <th scope="col">Category ID</th>
      <th scope="col">Sub Category ID</th>
      <th scope="col">Correct Option ID</th>
      <th scope="col">Image</th>
      <th></th>
    </tr>
    </table>
  </div>
  {{ $questions->links() }}
</div>

<script>
  checkPage('questions');
</script>
@endsection
