@extends('layouts.base')

@section('title', 'Usuários | ')
@section('main-title', 'Usuários')

@section('title-actions')
    <a class="btn btn-primary" href="{{ route('users.create') }}"><i class="fas fa-plus"></i> Adicionar Usuário</a>
@endsection

@section('content')

<div class="row">
    <div class="col-12 table-responsive">
        <table class="table table-striped table-hover table-bordered">
            <thead>
                <tr>
                    <th>Nome</th>
                    <th>E-mail</th>
                    <th>Setor</th>
                    <th>Telefone</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($users as $user)
                    <tr>
                        <td>{{ $user->name }}</td>
                        <td>{{ $user->email }}</td>
                        <td>{{ $user->department ? $user->department->name : '' }}</td>
                        <td>{{ $user->phone }}</td>
                        <td class="action-column">
                            <a href="{{ route('users.edit', $user->id) }}" class="btn btn-sm btn-secondary"><i class="fas fa-edit"></i> Editar</a>
                            
                            @if ( !$user->admin )
                                {!! Form::open(['route' => ['users.destroy', $user->id], 'method' => 'DELETE' ]) !!}
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