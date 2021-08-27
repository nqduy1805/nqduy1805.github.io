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

        <form action="{{URL::to('new_password')}}" method="get">
            @csrf 
            <input id="code"   class="ggg @error('code') is-invalid @enderror" name="code" value="{{ old('code') }}" placeholder="CODE" required autocomplete="code" autofocus>
                <div class="clearfix"></div>
                <input type="submit" value="Send code">
        </form>
@endsection
