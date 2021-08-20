@extends('layouts.app')
@section('content')

    <h2>Reset Password</h2>
   @if (session('status'))
      <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                            </div>

      @endif
       @error('email')
         <span class="invalid-feedback" role="alert">
               <strong>{{ $message }}</strong>
                                    </span>
      @enderror

        <form action="{{ route('password.email') }}" method="post">
            @csrf
            <input id="email"  type="email" class="ggg @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
                <div class="clearfix"></div>
                <input type="submit" value="Send Password Reset Link" name="login">
        </form>
@endsection
