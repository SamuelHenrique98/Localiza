@extends('layout.layout')

@section('titulo', 'Localiza!!!')

@section('conteudo')

@if(isset($categoria))
<h3 class="mt-1">Editar Categoria</h3>
<form method="post" action="{{ route('categoria.update', ['categorium'=>$categoria]) }}">
    @method('PUT')
@else
<h3 class="mt-1">Nova Categoria</h3>
<form method="post" action="{{ route('categoria.store') }}">
@endif   
    @csrf
    <div class="row">
@if(isset($categoria))
        <div class="col col-2">
            <label for="categoria">Categoria</label>
            <input type="text" class="form-control" name="categoria" id="categoria" value="{{$categoria->categoria}}">
        </div>
        <div class="col col-1">
            <button class="btn btn-success mt-4" type="submit">Salvar</button> 
        </div>
        <div class="col col-1">
            <a href="/categoria" class="btn btn-dark mt-4">Voltar</a>
        </div>
    </div>
    @if(isset($zonas))
        @include('estoque.selecao.zonas')
    @endif
    @else
        <div class="col col-2">
            <label for="categoria">Categoria</label>
            <input type="text" class="form-control" name="categoria" id="categoria">
        </div>
        <div class="col col-1">
            <button class="btn btn-success mt-4" type="submit">Salvar</button> 
        </div>
        <div class="col col-1">
            <a href="/categoria" class="btn btn-dark mt-4">Voltar</a>
        </div>
    </div>
    @if(isset($zonas))
        @include('estoque.selecao.zonas')
    @endif
@endif
</form>
@endsection