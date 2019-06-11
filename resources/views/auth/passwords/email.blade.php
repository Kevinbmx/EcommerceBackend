
    @extends('auth.masterPage')

    @section('title', 'Resetear')

    @section('auth')
    {{-- <div class="col-md-3">
    </div> --}}
    {{-- <div class="justify-content-start"> --}}
    <div class="middle-box text-center  animated fadeInDown">
            <div class="ibox-content">
        {{-- <div class="col-md-8"> --}}
            <div class="card">
                <div class="card-header">{{ __('Reset Password') }}</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif

                    <form method="POST" class="m-t" action="{{ route('password.email') }}">
                        @csrf

                        <div class="form-group ">
                            {{-- <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label> --}}

                            {{-- <div class="col-md-6"> --}}
                                <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" placeholder="ingrese su email para resetear su contraseña" name="email" value="{{ old('email') }}" required>

                                @if ($errors->has('email'))
                                    <span class="invalid-feedback">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            {{-- </div> --}}
                        </div>

                        {{-- <div class="form-group  mb-0"> --}}
                            {{-- <div class="col-md-6 offset-md-4"> --}}
                                <button type="submit" class="btn btn-primary">
                                    {{ __('Enviar reseteo de contraseña') }}
                                </button>
                            {{-- </div> --}}
                        {{-- </div> --}}
                    </form>
                </div>
            {{-- </div> --}}
        </div>
    </div>
</div>
@endsection
