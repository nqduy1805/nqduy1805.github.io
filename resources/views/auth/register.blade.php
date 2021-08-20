
@extends('layouts.app')

@section('content')
 <h2>Register</h2>
 @error('name')
 <span class="invalid-feedback" role="alert">
        <strong>{{ $message }}</strong>
       </span> @enderror
       @error('phone')
 <span class="invalid-feedback" role="alert">
        <strong>{{ $message }}</strong>
       </span> @enderror
        @error('adress')
 <span class="invalid-feedback" role="alert">
        <strong>{{ $message }}</strong>
       </span> @enderror
 @error('email')
       <span class="invalid-feedback" role="alert">
        <strong>{{ $message }}</strong>
       </span>
  @enderror
   @error('password')
     <span class="invalid-feedback" role="alert">
       <strong>{{ $message }}</strong>
    </span>
     @enderror

        <form action="{{ route('register') }}" method="post">
            @csrf
             <input id="name" type="text" class="ggg @error('name') is-invalid @enderror" name="name" placeholder="NAME" value="{{ old('name') }}" required autocomplete="name" autofocus>
            <input id="email"  type="email" class="ggg @error('email') is-invalid @enderror" name="email" placeholder="E-MAIL" value="{{ old('email') }}" required autocomplete="email">
            <input id="phone" type="text" class="ggg @error('phone') is-invalid @enderror" name="phone" placeholder="PHONE" value="{{ old('phone') }}" required autocomplete="phone" autofocus> 
              <input id="adress" type="text" class="ggg @error('adress') is-invalid @enderror" name="adress" placeholder="ADRESS" value="{{ old('adress') }}" required autocomplete="adress" autofocus>
            <input id="password"  type="password" class="ggg @error('password') is-invalid @enderror" name="password" placeholder="PASSWORD" required autocomplete="new-password">
            <input id="password-confirm"  type="password" class="ggg" name="password_confirmation" placeholder="CONFIRM PASSWORD" required autocomplete="new-password">
            
            <input type="submit" value="Register" name="login">
        </form>
@endsection
