
@extends('auth.masterPage')

@section('title', 'Login')

@section('auth')
<div class="loginColumns animated fadeInDown">
        <div class="row">
        <div class="col-md-6">
            <h1 class="font-bold" >Bienvenido a Trovare</h1>
            <p>
                Administra todo acerca de la tienda online Trovare.
            </p>
            <p>
                prodra crear usuario, ver pedidos y asignar pedidos para su entrega.
            </p>
                        {{--
            <p>
                When an unknown printer took a galley of type and scrambled it to make a type specimen book.
            </p>
            <p>
                <small>It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged.</small>
            </p> --}}
        </div>
        <div class="col-md-6">
            <div class="ibox-content">
                {{-- <div class="card-header">{{ __('Login') }}</div> --}}
                <h2>Trovare</h2>
                {{-- <div class="card-body"> --}}
                    <form method="POST" class="m-t" action="{{ route('login') }}">
                        @csrf

                        <div class="form-group ">
                            {{-- <label for="email" class="col-sm-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label> --}}

                            {{-- <div class="col-md-6"> --}}
                                <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" required autofocus placeholder="Correo electronico">

                                @if ($errors->has('email'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            {{-- </div> --}}
                        </div>

                        <div class="form-group ">
                            {{-- <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label> --}}

                            {{-- <div class="col-md-6"> --}}
                                <input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required placeholder="Contraseña">

                                @if ($errors->has('password'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            {{-- </div> --}}
                        </div>

                        <div class="form-group ">
                                <div class="checkbox">
                                    <label>
                                        <input type="checkbox" name="remember" {{ old('remember') ? 'checked' : '' }}> {{ __('Remember Me') }}
                                    </label>
                                </div>
                        </div>

                        <div class="form-group  mb-0">
                            {{-- <div class="col-md-8 offset-md-4"> --}}
                                <button type="submit" class="btn btn-primary block full-width m-b">
                                    {{ __('Entrar') }}
                                </button>

                                <a class="btn btn-link" href="{{ route('password.request') }}">
                                    <small>{{ __('olvidaste tu Contraseña?') }}</small>
                                </a>
                                <p class="text-muted text-center">
                                        <small>No tienes cuenta?</small>
                                </p>
                                <a class="btn btn-sm btn-white btn-block" href="{{ route('register') }}">Create una cuenta</a>
                            {{-- </div> --}}
                        </div>
                    </form>
                {{-- </div> --}}
            </div>
        </div>
        </div>
</div>
@endsection