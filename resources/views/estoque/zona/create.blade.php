@extends('layout.layout')

@section('titulo', 'Localiza!!!')

@section('conteudo')

@if(isset($zona))
<h3 class="mt-1">Editar Zona</h3>
<form method="post" action="{{ route('estoque.zona.update', ['estoque'=>$estoque, 'zona'=>$zona]) }}">
    @method('PUT')
@else
<h3 class="mt-1">Nova Zona</h3>
<form method="post" action="{{ route('estoque.zona.store', ['estoque'=>$estoque]) }}">
@endif   
    @csrf
    <div class="row">
    @if(isset($zona))
        <div class="col col-2">
            <label for="zona">Zona</label>
            <input type="text" class="form-control" name="zona" id="zona" value="{{$zona->zona}}">
        </div>
        <div class="col col-1">
            <button class="btn btn-success mt-4" type="submit">Salvar</button> 
        </div>
        <div class="col col-1">
            <a href="{{ route('estoque.zona.index', ['estoque'=>$estoque]) }}" class="btn btn-dark mt-4">Voltar</a>
        </div>
    </div>
    @if(isset($categorias))
        @include('estoque.selecao.categorias')
    @endif
    @else
        <div class="col col-2">
            <label for="zona">Zona</label>
            <input type="text" class="form-control" name="zona" id="zona">
        </div>
        <div class="col col-1">
            <button class="btn btn-success mt-4" type="submit">Salvar</button> 
        </div>
        <div class="col col-1">
            <a href="/estoque" class="btn btn-dark mt-4">Voltar</a>
        </div>
    </div>
    @if(isset($categorias))
        @include('estoque.selecao.categorias')
    @endif
    @endif
</form>
@endsection