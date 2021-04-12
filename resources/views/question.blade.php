@extends('layouts.app')

@section('content')
<div class="container">
  <a href="{{route('addQuestionPage')}}"><button style="margin-bottom: 20px;" type="button" class="btn btn-primary">Add</button></a>
  <h3>Questions</h3>
  <table class="table table-striped">
  <thead>
    <tr>
      <th scope="col">ID</th>
      <th scope="col">Question</th>
      <th scope="col">Category ID</th>
      <th scope="col">Sub-Category ID</th>
      <th scope="col">Correct Option ID</th>
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
        <button type="button" class="btn btn-outline-danger btn-sm"><i class="far fa-trash-alt"></i> Delete</button>
      </td>
    </tr>
    @endforeach
  </tbody>
  <tr>
    <th scope="col">ID</th>
    <th scope="col">Question</th>
    <th scope="col">Category ID</th>
    <th scope="col">Sub-Category ID</th>
    <th scope="col">Correct Option ID</th>
    <th scope="col">Image</th>
    <th></th>
  </tr>
  </table>
  {{ $questions->links() }}
</div>

<script>
  checkPage('questions');
</script>
@endsection
