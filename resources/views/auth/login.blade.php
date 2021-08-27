@extends('layouts.app')

@section('content')
 <h2>Sign In Now</h2>
                 @php
                    if (isset($_COOKIE['email']) && isset($_COOKIE['password'])) {
                        $email = $_COOKIE['email'];
                        $password = $_COOKIE['password'];
                        $is_remember = "checked = 'checked'";
                    } else {
                        $email = '';
                        $password = '';
                        $is_remember = "";
                    }
                @endphp
 @error('email')
       <a class="invalid-feedback" role="alert">
        <strong>{{ $message }}</strong>
       </a>
  @enderror
   @error('password')
     <a class="invalid-feedback" role="alert">
       <strong>{{ $message }}</strong>
    </a>
     @enderror

        <form action="{{ route('login') }}" method="post">
            @csrf
            <input type="email" class="ggg" name="email" placeholder="E-MAIL" required="">
            <input type="password" class="ggg" name="password" placeholder="PASSWORD" required="">
            <span><input type="checkbox" />Remember Me</span>
             @if (Route::has('password.request'))
            <h6><a href="{{ route('password.request') }}">Forgot Password?</a></h6>
         @endif
                <div class="clearfix"></div>
                <input type="submit" value="Sign In" name="login">
        </form>
        <p>Don't Have an Account ?<a href="{{ route('register')}}">Create an account</a></p>
@endsection
