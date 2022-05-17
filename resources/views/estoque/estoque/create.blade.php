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

@if(isset($estoque))
<h3 class="mt-1">Editar Estoque</h3>
<form method="post" action="{{ route('estoque.update', ['estoque'=>$estoque]) }}">
    @method('PUT')
@else
<h3 class="mt-1">Novo Estoque</h3>

<form method="post" action="{{ route('estoque.store') }}">
@endif   
    @csrf
    <div class="row">
    @if(isset($estoque))
        <div class="col col-3">
            <label for="numero">Número do Estoque</label>
            <input type="number" class="form-control" name="numero" id="numero" value="{{$estoque->numero}}">
        </div>
    @else
        <div class="col col-3">
            <label for="numero">Número do Estoque</label>
            <input type="number" class="form-control" name="numero" id="numero">
        </div>
        <div class="col col-3">
            <label for="Nzona">Número de Zonas</label>
            <input type="number" step="any" class="form-control" name="Nzona" id="Nzona">
        </div>
    </div>
    @endif
    <div class="row mt-2">
        <div class="col col-1">
            <button class="btn btn-success" type="submit">Salvar</button> 
        </div>
        <div class="col col-1">
            <a href="/estoque" class="btn btn-dark">Voltar</a>
        </div>
    </div>
</form>

@endsection