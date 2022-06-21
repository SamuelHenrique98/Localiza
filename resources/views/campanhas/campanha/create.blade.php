@extends('layout.layout')

@section('titulo', 'Localiza!!!')

@section('conteudo')
@if ($errors->any())
    <div class="alert alert-danger mt-1">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<h3 class="mt-1">Nova Campanha</h3>

<a class="btn btn-warning float-end" href="{{ route('campanha.export') }}">Baixar Modelo</a>

<form action="{{ route('campanha.store') }}" method="post" enctype="multipart/form-data">
@csrf
    <div>
        <div class="col col-2">
            <label for="nome">Nome da Campanha</label>
            <input type="text" class="form-control" name="nome" id="nome">
        </div>
        @include('campanhas.campanha.canais.selectCanais')
        <div class="col col-2">
            <label for="inicial">Data Inicial</label>
            <input type="date" step="any" class="form-control" name="inicial" id="inicial">
        </div>
        <div class="col col-2">
            <label for="final">Data Final</label>
            <input type="date" step="any" class="form-control" name="final" id="final">
        </div>
        <div class="col col-5">
            <label for="file">Planilha</label>
            <input type="file" name="file" id="file" class="form-control">
        </div>
    </div>
    <div class="row mt-2">
        <div class="col col-1">
            <button class="btn btn-success" type="submit">Salvar</button> 
        </div>
        <div class="col col-1">
            <a href="/campanha" class="btn btn-dark">Voltar</a>
        </div>
    </div>
</form>

@endsection