@extends('layouts.base')

@section('title', "Editar Reunião #{$meeting->id} | ")
@section('main-title', "Editar Reunião #{$meeting->id}")


@section('content')

    {!! Form::open(['route' => ['meetings.update', $meeting->id], 'method' => 'PUT' ]) !!}

        <div class="row">
            <div class="col-md-12 col-lg-4 form-group">
              
                {!! Form::label('room', 'Sala: *') !!}
                {!! Form::select('room', $rooms, $meeting->room_id, ['class' => 'form-control' . ($errors->has('room') ? ' is-invalid' : null), 'placeholder' => 'Selecione...', 'required']) !!}
                @error('room')
                    <span class="small text-danger mt-xs">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror

            </div>

        </div>

        <div class="row">
            <div class="col-lg-6 col-md-12">
                <hr>
                <h3>Início</h3>

                <div class="row">

                    <div class="col-md-6 col-lg-8 form-group">
                        {!! Form::label('start_date', 'Dia: *') !!}
                        {!! Form::date('start_date', $meeting->start->format('Y-m-d'), ['class' => 'form-control' . ($errors->has('start_date') ? ' is-invalid' : null), 'required']) !!}
                        @error('start_date')
                            <span class="small text-danger mt-xs">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <div class="col-md-6 col-lg-4 form-group">
                        {!! Form::label('start_time', 'Hora: *') !!}
                        {!! Form::time('start_time', $meeting->start->format('H:i'), ['class' => 'form-control' . ($errors->has('start_time') ? ' is-invalid' : null), 'required']) !!}
                        @error('start_time')
                            <span class="small text-danger mt-xs">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                </div>

            </div>

            <div class="col-lg-6 col-md-12">
                <hr>
                <h3>Fim</h3>

                <div class="row">

                    <div class="col-md-6 col-lg-8 form-group">
                        {!! Form::label('end_date', 'Dia: *') !!}
                        {!! Form::date('end_date', $meeting->end->format('Y-m-d'), ['class' => 'form-control' . ($errors->has('end_date') ? ' is-invalid' : null), 'required']) !!}
                        @error('end_date')
                            <span class="small text-danger mt-xs">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <div class="col-md-6 col-lg-4 form-group">
                        {!! Form::label('end_time', 'Hora: *') !!}
                        {!! Form::time('end_time', $meeting->end->format('H:i'), ['class' => 'form-control' . ($errors->has('end_time') ? ' is-invalid' : null), 'required']) !!}
                        @error('end_time')
                            <span class="small text-danger mt-xs">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                </div>

            </div>
        </div>

        @error('meeting_error')
            <div class="row">
                <div class="col-12 text-center">
                    <span class="small text-danger mt-xs">
                        <strong>{{ $message }}</strong>
                    </span>
                </div>
            </div>
        @enderror
        

        <div class="row">
            <div class="col-12 text-center form-group">
                <hr>
                <a class="btn btn-light" href="{{ route('meetings.index') }}"><i class="fas fa-arrow-left"></i> Voltar</a>
                <button class="btn btn-success" type="submit"><i class="fas fa-check"></i> Salvar</button>
            </div>
        </div>

    {!! Form::close() !!}

@endsection