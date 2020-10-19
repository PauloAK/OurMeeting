@extends('layouts.base')

@section('title', "Editar Usuário #{$user->id} | ")
@section('main-title', "Editar Usuário #{$user->id}")


@section('content')

    {!! Form::open(['route' => ['users.update', $user->id], 'method' => 'PUT' ]) !!}

        <div class="row">
            <div class="col-md-6 col-lg-4 col-12 form-group">
              
                {!! Form::label('name', 'Nome Completo: *') !!}
                {!! Form::text('name', $user->name, ['class' => 'form-control' . ($errors->has('name') ? ' is-invalid' : null), 'placeholder' => 'João da Silva', 'required']) !!}
                @error('name')
                    <span class="small text-danger mt-xs">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror

            </div>

            <div class="col-md-6 col-lg-4 col-12 form-group">
              
                {!! Form::label('email', 'E-mail: *') !!}
                {!! Form::email('email', $user->email, ['class' => 'form-control' . ($errors->has('email') ? ' is-invalid' : null), 'placeholder' => 'joao@site.com', 'required']) !!}
                @error('email')
                    <span class="small text-danger mt-xs">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror

            </div>

            <div class="col-md-6 col-lg-4 col-12 form-group">
              
                {!! Form::label('phone', 'Telefone: *') !!}
                {!! Form::text('phone', $user->phone, ['class' => 'form-control mask_phone' . ($errors->has('phone') ? ' is-invalid' : null), 'placeholder' => '(XX) X XXXX-XXXX', 'required', 'minlength' => 14, 'maxlength' => 16]) !!}
                @error('phone')
                    <span class="small text-danger mt-xs">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror

            </div>

            <div class="col-md-6 col-lg-4 col-12 form-group">
              
                {!! Form::label('department', 'Setor: *') !!}
                {!! Form::select('department', $departments, $user->department_id, ['class' => 'form-control' . ($errors->has('department') ? ' is-invalid' : null), 'placeholder' => 'Selecione...', 'required']) !!}
                @error('department')
                    <span class="small text-danger mt-xs">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror

            </div>

            <div class="col-12 mb-2">
                <hr>
                <h4 class="m-0">Alterar Senha</h4>
                <span class="text-muted small"><i class="fas fa-info-circle"></i> Deixe os campos em branco para não alterar</span>
            </div>

            <div class="col-md-6 col-lg-4 col-12 form-group">
              
                {!! Form::label('current_password', 'Senha Atual:') !!}
                {!! Form::password('current_password', ['class' => 'form-control' . ($errors->has('current_password') ? ' is-invalid' : null), 'minlength' => 6]) !!}
                @error('current_password')
                    <span class="small text-danger mt-xs">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror

            </div>

            <div class="col-md-6 col-lg-4 col-12 form-group">
              
                {!! Form::label('new_password', 'Nova Senha:') !!}
                {!! Form::password('new_password', ['class' => 'form-control' . ($errors->has('new_password') ? ' is-invalid' : null), 'minlength' => 6]) !!}
                @error('new_password')
                    <span class="small text-danger mt-xs">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror

            </div>

            <div class="col-md-6 col-lg-4 col-12 form-group">
              
                {!! Form::label('new_password_confirmation', 'Repita a Nova Senha:') !!}
                {!! Form::password('new_password_confirmation', ['class' => 'form-control' . ($errors->has('new_password_confirmation') ? ' is-invalid' : null), 'minlength' => 6]) !!}
                @error('new_password_confirmation')
                    <span class="small text-danger mt-xs">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror

            </div>
        </div>

        <div class="col-12">
            <hr>
        </div>

        <div class="row">
            <div class="col-12 text-center form-group">
                <a class="btn btn-light" href="{{ route('users.index') }}"><i class="fas fa-arrow-left"></i> Voltar</a>
                <button class="btn btn-success" type="submit"><i class="fas fa-check"></i> Salvar</button>
            </div>
        </div>

    {!! Form::close() !!}

@endsection