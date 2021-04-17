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
    <table class="table table-striped table-hover">
    <thead>
      <tr>
        <th scope="col-sm-1">ID</th>
        <th scope="col" style="min-width: 300px;">Question</th>
        <th scope="col-sm-1">Category</th>
        <th scope="col-sm-1">Sub Category</th>
        <th scope="col-sm-1" style="min-width: 150px;">Correct Option</th>
        <th scope="col">Image</th>
        <th style="min-width: 140px;"></th>
      </tr>
    </thead>
    <tbody>
      @foreach($questions as $question)
      <tr>
        <td>{{$question->id}}</td>
        <td>{{$question->question}}</td>
        <td>{{$question->category->category}}</td>
        @if ($question->subcategory)
          <td>{{$question->subcategory->sub_category}}</td>
        @else
          <td></td>
        @endif
        <td>{{$question->correct_option->option}}</td>
        <td><img src="{{$question->image}}" width="100"></td>
        <td class="float-right">
          <a href="{{route('editQuestionPage', ['id' => $question->id])}}"><button type="button" class="btn btn-outline-primary btn-sm">Edit</button></a>
          <button type="button" class="btn btn-outline-danger btn-sm" data-toggle="modal" data-target="#exampleModal" onclick="clickModal({{$question->id}})"><i class="far fa-trash-alt"></i> Delete</button>
        </td>
      </tr>
      @endforeach
    </tbody>
    <tr>
      <th>ID</th>
      <th>Question</th>
      <th>Category</th>
      <th>Sub Category</th>
      <th>Correct Option</th>
      <th>Image</th>
      <th></th>
    </tr>
    </table>
  </div>

  <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Delete Question</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form action="{{route('removeQuestion')}}" method="post">
          @csrf
          <div class="modal-body">
            <div class="form-group">
              Do you want to delete Question ID <input type="text" readonly style="background-color: transparent;border: 0; font-size: 1em; font-weight: bold" name="id" id="id">
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

  {{ $questions->links() }}
</div>

@endsection

@section('javascript')
<script>
checkPage('questions');

function clickModal(id) {
  document.getElementById('id').value = id;
}
</script>
@endsection
