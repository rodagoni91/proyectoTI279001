@extends('layouts.app')

@section('content') 
<style>

</style>
<div class="page-header header-filter" filter-color="orange"  style="background-image:url('{{ asset('imagen/login.jpg') }}'); background-size: cover;background-repeat: no-repeat;background-position: center;margin-top:-50px;">
    <div class="page-header-image"></div> 
    <div class="container" >
    
        <div class="row justify-content-center">
            <div class="col-md-3"></div>
            <div class="col-md-6">
                <div class="card-body"  style='padding-top:20px'>

                    <div class="card-header textBox">{{ __('Iniciar Sesión') }}</div>

                    <div class="card-body">
                        <form method="POST" action="{{ route('login') }}">
                            @csrf

                            <div class="form-group row">
                                <label for="email" class="col-md-4 col-form-label text-md-right textBox">{{ __('Correo Electrónico') }}</label>

                                <div class="col-md-6">
                                    <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                                    @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="password" class="col-md-4 col-form-label text-md-right textBox">{{ __('Contraseña') }}</label>

                                <div class="col-md-6">
                                    <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">

                                    @error('password')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row mb-0">
                                <div class="col-md-8 offset-md-4">
                                    <a class="btn btn-link" style="color: white;" 
                                    href="password/reset">
                                        ¿Olvidó Su Contraseña?
                                    </a>
                                </div>
                            </div>

                            <div class="form-group row mb-0">
                                <div class="col-md-10 offset-md-1  btn-block">
                                    <button type="submit" class="btn btn-primary btn-round btn-lg btn-block">
                                        {{ __('Iniciar Sesión') }}
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>

                </div>
            </div>
            <div class="col-md-3"></div>
        </div>
        
    </div>
</div>
@endsection
