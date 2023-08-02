@extends('layouts.auth-master')

@section('content')
<div class="card card-primary">
  <div class="card-header">
    <h4>Login</h4>
  </div>

  <div class="card-body">
    <form method="POST" action="{{ route('login') }}" class="account">
      <input type="hidden" name="_token" value="{{ csrf_token() }}">
      @if ($message = Session::get('error'))
      <div style="color: rgb(136, 25, 25); font-weight: bold; padding: 3px 3px"> {{ $message }}</div>
      @endif
      <div class="form-group">
        <label for="nik">Nomor Induk Kependudukan (NIK)</label>
        <input aria-describedby="nikHelpBlock" id="nik" name="nik" type="nik" class="form-control{{ $errors->has('nik') ? ' is-invalid' : '' }}" name="nik" placeholder="Registered nik address" tabindex="1" value="{{ old('nik') }}">
        <div class="invalid-feedback">
          {{ $errors->first('nik') }}
        </div>
        @if(App::environment('demo'))
        <small id="nikHelpBlock" class="form-text text-muted">
          Demo nik: admin@example.com
        </small>
        @endif
      </div>

      <div class="form-group">
        <div class="d-block">
          <label for="password" class="control-label">Password</label>
          <div class="float-right">
            <a href=" " class="text-small">
              Forgot Password?
            </a>
          </div>
        </div>
        <input aria-describedby="passwordHelpBlock" id="password" name="password" type="password" placeholder="Your account password" class="form-control{{ $errors->has('password') ? ' is-invalid': '' }}" name="password" tabindex="2">
        <div class="invalid-feedback">
          {{ $errors->first('password') }}
        </div>
        @if(App::environment('demo'))
        <small id="passwordHelpBlock" class="form-text text-muted">
          Demo Password: 1234
        </small>
        @endif
      </div>

      <div class="form-group">
        <div class="custom-control custom-checkbox">
          <input type="checkbox" name="remember" class="custom-control-input" tabindex="3" id="remember" {{ old('remember') ? ' checked': '' }}>
          <label class="custom-control-label" for="remember">Remember Me</label>
        </div>
      </div>

      <div class="form-group">
        <button type="submit" class="btn btn-primary btn-lg btn-block" tabindex="4">
          Login
        </button>
      </div>
    </form>
  </div>
</div>
<div class="mt-5 text-muted text-center">
  Don't have an account? <a href="/admin">Create One</a>
</div>
@endsection