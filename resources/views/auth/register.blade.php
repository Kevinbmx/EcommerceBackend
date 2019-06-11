
    @extends('auth.masterPage')

    @section('title', 'Login')

    @section('auth')
    {{-- <div class="col-md-3">
    </div> --}}
    {{-- <div class="justify-content-start"> --}}
    <div class="middle-box text-center  animated fadeInDown">
            <div class="ibox-content">
                    {{-- <div class="card-header">{{ __('Register') }}</div> --}}
                    <h2>Registrate a Trovare</h2>
                
                        <form method="POST" class="m-t" action="{{ route('register') }}">
                            @csrf

                            <div class="form-group ">
                                {{-- <label for="name" class="col-md-4 col-form-label text-md-right">{{ __('Name') }}</label> --}}

                                {{-- <div class="col-md-6"> --}}
                                    <input id="name" type="text" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="name" placeholder="nombre completo" value="{{ old('name') }}" required autofocus>

                                    @if ($errors->has('name'))
                                        <span class="invalid-feedback">
                                            <strong>{{ $errors->first('name') }}</strong>
                                        </span>
                                    @endif
                                {{-- </div> --}}
                            </div>

                            <div class="form-group ">
                                {{-- <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label> --}}

                                {{-- <div class="col-md-6"> --}}
                                    <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" placeholder="ingrese su email" name="email" value="{{ old('email') }}" required>

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
                                    <input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" placeholder="contraseña" required>

                                    @if ($errors->has('password'))
                                        <span class="invalid-feedback">
                                            <strong>{{ $errors->first('password') }}</strong>
                                        </span>
                                    @endif
                                {{-- </div> --}}
                            </div>

                            <div class="form-group ">
                                {{-- <label for="password-confirm" class="col-md-4 col-form-label text-md-right">{{ __('Confirm Password') }}</label> --}}

                                {{-- <div class="col-md-6"> --}}
                                    <input id="password-confirm" type="password" class="form-control" name="password_confirmation" placeholder="confirme su contraseña" required>
                                {{-- </div> --}}
                            </div>

                            <div class="form-group  mb-0">
                                {{-- <div class="col-md-6 offset-md-4"> --}}
                                    <button type="submit" class="btn btn-primary block full-width m-b">
                                        {{ __('Registrese') }}
                                    </button>
                                {{-- </div> --}}
                                <a href="{{ route('login') }}"><small>quieres ingresar?</small></a>
                                {{-- <a class="btn btn-sm btn-white btn-block" href="{{ route('login') }}">Ingresar</a> --}}
                            </div>
                        </form>
                    </div>
    </div>  
    {{-- <div class="col-md-3">
        </div>  --}}
    {{-- </div> --}}
        @endsection
