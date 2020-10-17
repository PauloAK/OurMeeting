@extends('layouts.auth')

@section("content")

<div class="justify-content-center align-items-center d-flex h-100">
    <div class="col-md-4 col-xs-12">
        {!! Form::open(['route' => 'login']) !!}
            <div class="col-md-12 form-group text-center">
                <h2>Login</h2>
            </div>
            
            <div class="col-md-12 form-group">
                {!! Form::label('email', 'E-mail: *') !!}
                {!! Form::email('email', null, ['class' => 'form-control', 'required']) !!}
                @error('email')
                    <span class="small text-danger mt-xs">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
            
            <div class="col-md-12 form-group">
                {!! Form::label('password', 'Senha: *') !!}
                {!! Form::password('password', ['class' => 'form-control', 'required']) !!}
                @error('password')
                <span class="small text-danger mt-xs">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
            
            <div class="col-md-12 form-group text-center">
                <button class="btn btn-primary">Acessar Sistema <i class="fas fa-sign-in-alt"></i></button>
            </div>
        {!! Form::close() !!}
    </div>
</div>

@endsection