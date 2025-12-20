@extends('layouts.web')

@section('content')
    <div class="container-fluid">
        <h2>Editar Story #{{ $story->id }}</h2>

        <form action="{{ route('panel.stories.update', $story->id) }}" method="POST">
            @csrf
            <div class="mb-3">
                <label>Título</label>
                <input type="text" name="title" class="form-control" value="{{ old('title', $story->title) }}">
            </div>
            <div class="mb-3">
                <label>Imagens (paths separados por vírgula)</label>
                <input type="text" name="images" class="form-control" value="{{ old('images', is_array($story->images) ? implode(', ', $story->images) : '') }}" placeholder="stories/img1.jpg, stories/img2.jpg">
            </div>
            <div class="mb-3">
                <label>Ordem</label>
                <input type="number" name="order" class="form-control" value="{{ old('order', $story->order) }}">
            </div>
            <div class="mb-3 form-check">
                <input type="checkbox" name="active" value="1" class="form-check-input" {{ $story->active ? 'checked' : '' }}>
                <label class="form-check-label">Ativo</label>
            </div>
            <button class="btn btn-primary">Salvar</button>
        </form>
    </div>
@endsection
