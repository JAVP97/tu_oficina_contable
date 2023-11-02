@extends('layouts.app')

@section('content')
            <div>
                <div class="card-header">Cambiar Contraseña</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    <form method="POST" action="{{ route('password.email') }}">
                        @csrf

                        <div class="form-group">
                            <label for="email" class="form-control-label text-md-right">{{ __('Correo Electronico') }}</label>

                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                        </div>

                                <button type="submit" class="btn btn-primary btn-block">
                                    {{ __('Enviar enlace') }}
                                </button>
                                <a href="{{url('/')}}" class="btn btn-warning btn-block">
                                    Iniciar Sesión
                                </a>
                    </form>
                </div>
            </div>
@endsection
