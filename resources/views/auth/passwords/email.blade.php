<!DOCTYPE html>
<html>
<head>
  <title>Reset</title>
  <link href="{{ asset('css/dashboard.css') }}" rel="stylesheet">
  <link href="{{ asset('css/app.css') }}" rel="stylesheet">
  <!-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
  <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script> -->

</head>
<body style="background-color: #f1f4f8;">
<div class="container" style="margin-top: 20vh;">
  <div class="col-lg-4" style="margin: auto; max-width: 500px">
    @if($errors->any())
    @if($errors->has('message'))
    <div class="alert alert-danger" role="alert">
      <h3>{{ $errors->first() }}</h3>
    </div>
    @endif
    @endif
    <div class="card-head">
      Reset Password
    </div>
    <div class="card mb-3 border-primary">
      @if (session('status'))
        <div class="alert alert-success" role="alert">
          {{ session('status') }}
        </div>
      @endif
      <div class="card-body" style="padding: 30px">
        <form method="POST" action="{{ route('password.email') }}">
          @csrf
          <div class="form-group">
            <label for="email" class="col-form-label">{{ __('E-Mail Address') }}</label>

            <div class="">
              <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

              @error('email')
              <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
              </span>
              @enderror
            </div>
          </div>
          <button type="submit" class="btn btn-primary w-100">
            {{ __('Send Password Reset Link') }}
          </button>
          <a href="{{ route('login') }}"><button type="button" class="btn btn-link text-center w-100">Login</button></a>
        </form>
      </div>
    </div>
  </div>
</div>
</body>
</html>
