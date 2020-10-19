@extends('layouts.base')

@section('title', 'Salas | ')
@section('main-title', 'Salas')

@section('title-actions')
    <a class="btn btn-primary" href="{{ route('rooms.create') }}"><i class="fas fa-plus"></i> Adicionar Sala</a>
@endsection

@section('content')

<div class="row">
    <div class="col-12 table-responsive">
        <table class="table table-striped table-hover table-bordered">
            <thead>
                <tr>
                    <th>Sala</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($rooms as $room)
                    <tr>
                        <td>{{ $room->name }}</td>
                        <td class="action-column">
                            <a href="{{ route('rooms.edit', $room->id) }}" class="btn btn-sm btn-secondary"><i class="fas fa-edit"></i> Editar</a>
                            
                            {!! Form::open(['route' => ['rooms.destroy', $room->id], 'method' => 'DELETE' ]) !!}
                                <button class="btn btn-sm btn-danger" onclick="return confirm('Tem certeza que deseja remover este registro?');"><i class="fas fa-trash"></i> Apagar</button>
                            {!! Form::close() !!}
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="2" class="text-center text-muted">Nenhum registro encontrado</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

@endsection