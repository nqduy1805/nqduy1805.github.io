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

        <form action="{{URL::to('create_new_password')}}" method="get">
            @csrf
            <input id="password"   class="ggg @error('password') is-invalid @enderror" name="password" value="{{ old('password') }}" placeholder="NEW PASSWORD" required autocomplete="password" autofocus>
                <div class="clearfix"></div>
                <input type="submit" value="Create new password">
        </form>
@endsection
