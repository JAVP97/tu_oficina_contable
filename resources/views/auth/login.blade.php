@extends('layouts.app')

@section('content')
    <form class="form-horizontal" method="POST" action="{{ route('login') }}">
        @csrf
        <div class="mb-3">
            <label for="email" class="form-label">Correo El√©ctronico</label>
            <input class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" placeholder="Email" type="email">
            @error('email')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>

        <div class="mb-3">
            <label class="form-label">Password</label>
            <div class="input-group auth-pass-inputgroup">
            <input class="form-control @error('password') is-invalid @enderror"  name="password" placeholder="Contrase√±a" type="password" aria-label="Password" aria-describedby="password-addon">
                <button class="btn btn-light " type="button" id="password-addon"><i class="mdi mdi-eye-outline"></i></button>
            </div>
            @error('password')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>
        
        <div class="mt-3 d-grid">
            <button class="btn btn-primary waves-effect waves-light" type="submit">Ingresar</button>
        </div>

        <div class="mt-4 text-center" hidden>
          @if (Route::has('password.request'))
            <a href="{{ route('password.request') }}" class="text-muted">
                <i class="mdi mdi-lock me-1"></i> {{ __('Olvidaste tu contraseè´–a?') }}
            </a>
          @endif
        </div>
    </form>
@endsection
