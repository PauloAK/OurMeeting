@extends('layouts.base')

@section('title', 'Criar Usuário | ')
@section('main-title', 'Criar Usuário')


@section('content')

    {!! Form::open(['route' => 'users.store']) !!}

        <div class="row">
            <div class="col-md-6 col-lg-4 col-12 form-group">
              
                {!! Form::label('name', 'Nome Completo: *') !!}
                {!! Form::text('name', null, ['class' => 'form-control' . ($errors->has('name') ? ' is-invalid' : null), 'placeholder' => 'João da Silva', 'required']) !!}
                @error('name')
                    <span class="small text-danger mt-xs">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror

            </div>

            <div class="col-md-6 col-lg-4 col-12 form-group">
              
                {!! Form::label('email', 'E-mail: *') !!}
                {!! Form::email('email', null, ['class' => 'form-control' . ($errors->has('email') ? ' is-invalid' : null), 'placeholder' => 'joao@site.com', 'required']) !!}
                @error('email')
                    <span class="small text-danger mt-xs">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror

            </div>

            <div class="col-md-6 col-lg-4 col-12 form-group">
              
                {!! Form::label('phone', 'Telefone: *') !!}
                {!! Form::text('phone', null, ['class' => 'form-control mask_phone' . ($errors->has('phone') ? ' is-invalid' : null), 'placeholder' => '(XX) X XXXX-XXXX', 'required', 'minlength' => 14, 'maxlength' => 16]) !!}
                @error('phone')
                    <span class="small text-danger mt-xs">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror

            </div>

            <div class="col-md-6 col-lg-4 col-12 form-group">
              
                {!! Form::label('department', 'Setor: *') !!}
                {!! Form::select('department', $departments, null, ['class' => 'form-control' . ($errors->has('department') ? ' is-invalid' : null), 'placeholder' => 'Selecione...', 'required']) !!}
                @error('department')
                    <span class="small text-danger mt-xs">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror

            </div>

            <div class="col-md-6 col-lg-4 col-12 form-group">
              
                {!! Form::label('password', 'Senha: *') !!}
                {!! Form::password('password', ['class' => 'form-control' . ($errors->has('password') ? ' is-invalid' : null), 'required', 'minlength' => 6]) !!}
                @error('password')
                    <span class="small text-danger mt-xs">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror

            </div>

            <div class="col-md-6 col-lg-4 col-12 form-group">
              
                {!! Form::label('password_confirmation', 'Repita a Senha: *') !!}
                {!! Form::password('password_confirmation', ['class' => 'form-control' . ($errors->has('password_confirmation') ? ' is-invalid' : null), 'required', 'minlength' => 6]) !!}
                @error('password_confirmation')
                    <span class="small text-danger mt-xs">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror

            </div>
        </div>

        <div class="row">
            <div class="col-12 text-center form-group">
                <a class="btn btn-light" href="{{ route('users.index') }}"><i class="fas fa-arrow-left"></i> Voltar</a>
                <button class="btn btn-success" type="submit"><i class="fas fa-check"></i> Salvar</button>
            </div>
        </div>

    {!! Form::close() !!}

@endsection