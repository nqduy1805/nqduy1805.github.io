@extends('layouts.app')

@section('content')
 <h2>Sign In Now</h2>
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
