@extends('master')

@section('content')
<div class="card large-pad z-depth-4">
	<h1>Login</h1>

	<form action="{{ url('user/do-login') }}" class="form" method="POST">
      <div class="row">
        <div class="input-field col s12">
          <input id="email" type="email" name="email" class="validate" value="{{ old('email') }}">
          <label for="email">Email</label>
        </div>
      </div>
      <div class="row">
        <div class="input-field col s12">
          <input id="password" type="password" name="password" class="validate" id="password">
          <label for="password">Password</label>
        </div>
        <div class="input-field col s12">
          <input type="checkbox" name="remember" id="rememberMe">
          <label for="rememberMe">Remember me</label>
        </div>
      </div>
      <div class="row">
        <div class="input-field col s12">

        </div>
      </div>
      <div class="row">
      	<input type="submit" name="login" id="login-btn" class="btn waves-effect waves-light">
      </div>
      <input type="hidden" name="_token" value="{{ csrf_token() }}">
	</form>
</div>

@endsection