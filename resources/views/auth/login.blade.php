<!DOCTYPE html>
<html>
<head>
  <title>Login</title>
  <link href="{{ asset('css/dashboard.css') }}" rel="stylesheet">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
  <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

</head>
<body style="background-color: #f1f4f8;">
<div class="container" style="margin-top: 20vh;">
  @if($errors->any())
    @if($errors->has('message'))
    <div class="alert alert-danger" role="alert">
      <h3>{{ $errors->first() }}</h3>
    </div>
    @endif
  @endif
  <div class="col-sm-4" style="margin: auto;">
    <div class="card-head">
      Login
    </div>
    <div class="card mb-3 border-primary">
      <!-- <div class="card-header">
        Login
      </div> -->
      <div class="card-body" style="padding: 30px">
        <form method="POST" action="{{ route('login') }}">
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

          <div class="form-group">
            <label for="password" class="col-form-label">{{ __('Password') }}</label>

            <div class="">
              <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">

              @error('password')
              <span class="invalid-feedback" role="alert">
                <strong>{{ $message }}</strong>
              </span>
              @enderror
            </div>
          </div>

          <div class="form-check">
            <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
            <label class="form-check-label" for="remember">
              {{ __('Remember Me') }}
            </label>
          </div>
          <div class="form-group row">
            <div class="col-md-6 offset-md-4">
            </div>
          </div>

          <button type="submit" class="btn btn-primary w-100">
            {{ __('Login') }}
          </button>
          <div class="form-group row mb-0">
            <div class="col-md-8 offset-md-4">

              @if (Route::has('password.request'))
              <a class="btn btn-link" href="{{ route('password.request') }}">
                {{ __('Forgot Your Password?') }}
              </a>
              @endif
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>
</body>
</html>
