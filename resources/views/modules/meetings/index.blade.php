@extends('layouts.base')

@section('title', 'Reuniões | ')
@section('main-title', 'Reuniões')

@section('title-actions')
    <a class="btn btn-primary" href="{{ route('meetings.create') }}"><i class="fas fa-plus"></i> Adicionar Reunião</a>
@endsection

@section('content')

<div class="row">
    <div class="col-12 table-responsive">
        <table class="table table-striped table-hover table-bordered">
            <thead>
                <tr>
                    <th>Sala</th>
                    <th>Início</th>
                    <th>Fim</th>
                    <th>Usuário</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($meetings as $meeting)
                    <tr>
                        <td>{{ $meeting->room->name }}</td>
                        <td>{{ $meeting->start->format('d/m/y H:i') }}</td>
                        <td>{{ $meeting->end->format('d/m/y H:i') }}</td>
                        <td>{{ $meeting->user->name }}</td>
                        <td class="action-column">
                            @if ($meeting->user == Auth::user() || Auth::user()->admin)
                                <a href="{{ route('meetings.edit', $meeting->id) }}" class="btn btn-sm btn-secondary"><i class="fas fa-edit"></i> Editar</a>
                                
                                {!! Form::open(['route' => ['meetings.destroy', $meeting->id], 'method' => 'DELETE' ]) !!}
                                    <button class="btn btn-sm btn-danger" onclick="return confirm('Tem certeza que deseja remover este registro?');"><i class="fas fa-trash"></i> Apagar</button>
                                {!! Form::close() !!}
                            @endif
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" class="text-center text-muted">Nenhum registro encontrado</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

@endsection