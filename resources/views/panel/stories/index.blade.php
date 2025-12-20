@extends('layouts.web')

@section('content')
    <div class="container-fluid">
        <h2>Stories</h2>
        <p><a href="{{ route('panel.stories.create') }}" class="btn btn-primary">Nova Story</a></p>

        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <table class="table table-striped">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Título</th>
                    <th>Imagens</th>
                    <th>Ordem</th>
                    <th>Ativo</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody>
                @foreach($stories as $s)
                    <tr>
                        <td>{{ $s->id }}</td>
                        <td>{{ $s->title }}</td>
                        <td>{{ is_array($s->images) ? implode(', ', $s->images) : '' }}</td>
                        <td>{{ $s->order }}</td>
                        <td>{{ $s->active ? 'Sim' : 'Não' }}</td>
                        <td>
                            <a href="{{ route('panel.stories.edit', $s->id) }}" class="btn btn-sm btn-secondary">Editar</a>
                            <form action="{{ route('panel.stories.destroy', $s->id) }}" method="POST" style="display:inline-block;">
                                @csrf
                                <button class="btn btn-sm btn-danger" onclick="return confirm('Remover story?')">Remover</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
