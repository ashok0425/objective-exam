@extends('auth.layout')
@section('title')
    Login
@endsection
@section('content')
<section>

  <hgroup>
      <h2>Welcome back!</h2>
      {{-- <p>Please enter your details to sign into your account</p> --}}
  </hgroup>

  <form method = "post" class = "log-form" action="{{route('user.login')}}">

    @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

@if (session()->has('message'))
<div class="alert alert-{{session()->get('message')['alert-type']}}">
    {!!      session()->get('message')['content']
    !!}           
    </div>
@endif







@csrf
      <div class="group log-input">
          <input type="text" id = "username" name = "email" required placeholder = "Email Address" autocomplete="false">
      </div>

      <div class="group log-input">
          <input type="password" id = "password" name = "password" required placeholder = "Password" autocomplete="false">
      </div>

      <div class="container-log-btn">
        <button type="submit" name = "btn_submit" class="log-form-btn">
          <span>Sign In</span>
        </button>
      </div>

      <p class="text-center">Don't have an Account.Sign up <a href="{{route('user.register')}}">here</a></p>

  </form>

  

</section>
@endsection