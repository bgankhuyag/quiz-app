<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/dashboard.css') }}" rel="stylesheet">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" integrity="sha512-iBBXm8fW90+nuLcSKlbmrPcLa0OT92xO1BIsZ+ywDWZCvqsWgccV3gFoRBv0z+8dLJgyAHIhR35VZc2oM/gI1w==" crossorigin="anonymous" />

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

<script>
function checkPage(page) {
  var questions = document.getElementById('questions');
  if (questions.classList.contains("active")) {
    questions.classList.remove("active");
  }
  var users = document.getElementById('users');
  if (users.classList.contains("active")) {
    users.classList.remove("active");
  }
  var categories = document.getElementById('categories');
  if (categories.classList.contains("active")) {
    categories.classList.remove("active");
  }
  var sub_categories = document.getElementById('sub_categories');
  if (sub_categories.classList.contains("active")) {
    sub_categories.classList.remove("active");
  }
  var options = document.getElementById('options');
  if (options.classList.contains("active")) {
    options.classList.remove("active");
  }
  var roles = document.getElementById('roles');
  if (roles.classList.contains("active")) {
    roles.classList.remove("active");
  }
  var selecteds = document.getElementById('selecteds');
  if (selecteds.classList.contains("active")) {
    selecteds.classList.remove("active");
  }
  var points = document.getElementById('points');
  if (points.classList.contains("active")) {
    points.classList.remove("active");
  }
  var dahsboard = document.getElementById('dashboard');
  if (dashboard.classList.contains("active")) {
    dashboard.classList.remove("active");
  }
  if (page == 'questions') {
    questions.classList.add("active");
  } else if (page == 'users') {
    users.classList.add("active");
  } else if (page == 'categories') {
    categories.classList.add("active");
  } else if (page == 'sub_categories') {
    sub_categories.classList.add("active");
  } else if (page == 'options') {
    options.classList.add("active");
  } else if (page == 'roles') {
    roles.classList.add("active");
  } else if (page == 'selecteds') {
    selecteds.classList.add("active");
  } else if (page == 'questions') {
    points.classList.add("active");
  } else if (page == 'dashboard') {
    dashboard.classList.add("active");
  } else if (page == 'points') {
    points.classList.add("active");
  }
}
</script>


</head>
<body style="background-color: #f1f4f8;">
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            <div class="container">
                <div class="navbar-brand">
                    Hippo<strong>Quiz</strong>
                </div>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="mr-auto">

                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <!-- Authentication Links -->
                        <a class="logout" href="{{ backpack_url('logout') }}"><button type="button" class="user btn btn-outline-secondary">Logout</button></a>
                        <a href="{{route('account')}}"><button class="user btn btn-primary"><i class="fas fa-user"></i>&nbsp;{{backpack_user()['name']}}</button></a>

                    </ul>
                </div>
            </div>
        </nav>

        <nav id="links-navbar" class="navbar navbar-expand-lg navbar-light">
          <a class="navbar-brand" href="#"></a>
          <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <i class="fas fa-chevron-down"></i>&nbsp;Tables
          </button>
          <div class="collapse navbar-collapse" id="navbarNav">
            <div class="links" style="display: block;">
              <div class="list-group">
                <a id="dashboard" class="list-group-item list-group-item-action" href="{{ backpack_url('dashboard') }}"><i class="la la-home nav-icon"></i> {{ trans('backpack::base.dashboard') }}</a>
                <a id="users" class='list-group-item list-group-item-action' href='{{ route("user") }}'><i class="nav-icon far fa-user"></i> Users</a>
                <!-- <a id="answers" class='list-group-item list-group-item-action' href='{{ route("answer") }}'><i class="nav-icon fas fa-key"></i> Answers</a> -->
                <a id="categories" class='list-group-item list-group-item-action' href='{{ route("category") }}'><i class="nav-icon fas fa-th"></i> Categories</a>
                <a id="sub_categories" class='list-group-item list-group-item-action' href='{{ route("subcategory") }}'><i class="nav-icon fas fa-layer-group"></i> Sub-Categories</a>
                <!-- <a id="images" class='list-group-item list-group-item-action' href='{{ route("image") }}'><i class="nav-icon fas fa-images"></i> Images</a> -->
                <a id="options" class='list-group-item list-group-item-action' href='{{ route("option") }}'><i class="nav-icon fas fa-bars"></i> Options</a>
                <a id="questions" class='list-group-item list-group-item-action' href='{{ route("question") }}'><i class="fas fa-question-circle"></i> Questions</a>
                <a id="roles" class='list-group-item list-group-item-action' href='{{ route("role") }}'><i class="nav-icon fas fa-user-shield"></i> Roles</a>
                <a id="selecteds" class='list-group-item list-group-item-action' href='{{ route("selected") }}'><i class="nav-icon fas fa-check-circle"></i> Selected Options</a>
                <a id="points" class='list-group-item list-group-item-action' href='{{ route("points") }}'><i class="nav-icon fas fa-images"></i> Points</a>
              </div>
            </div>
          </div>
        </nav>


        <main class="py-4">
          @yield('content')
        </main>
    </div>
</body>

@yield('javascript')

</html>
