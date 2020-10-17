@extends('layouts.base')

@section('title', "Editar Sala #{$room->id} | ")
@section('main-title', "Editar Sala #{$room->id}")


@section('content')

    {!! Form::open(['route' => ['rooms.update', $room->id], 'method' => 'PUT']) !!}

        <div class="row">
            <div class="col-12 form-group">
              
                {!! Form::label('name', 'Nome: *') !!}
                {!! Form::text('name', $room->name, ['class' => 'form-control' . ($errors->has('name') ? ' is-invalid' : null), 'placeholder' => 'Sala 1', 'required']) !!}
                @error('name')
                    <span class="small text-danger mt-xs">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror

            </div>
        </div>

        <div class="row">
            <div class="col-12 text-center form-group">
                <a class="btn btn-light" href="{{ route('rooms.index') }}"><i class="fas fa-arrow-left"></i> Voltar</a>
                <button class="btn btn-success" type="submit"><i class="fas fa-check"></i> Salvar</button>
            </div>
        </div>

    {!! Form::close() !!}

@endsection