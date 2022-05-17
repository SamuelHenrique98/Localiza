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

@if(isset($produto))
<h3 class="mt-1">Editar Produto</h3>
<form method="post" action="{{ route('produto.update', ['produto'=>$produto]) }}">
    @method('PUT')
@else
<h3 class="mt-1">Novo Produto</h3>
<form method="post" action="{{ route('produto.store') }}">
@endif   
    @csrf
    <div class="row">
    @if(isset($produto))
        <div class="col col-2">
            <label for="ean">Ean</label>
            <input type="text" class="form-control" name="ean" id="ean" value="{{$produto->ean}}">
        </div>
        <div class="col col-2">
            <label for="descricao">Descrição</label>
            <input type="text" class="form-control" name="descricao" id="descricao" value="{{$produto->descricao}}">
        </div>
        <div class="col col-2">
            <label for="sku">Sku</label>
            <input type="number" step="any" class="form-control" name="sku" id="sku" value="{{$produto->sku}}">
        </div>
        <div class="col col-2">
            <label for="categoria" class="">Categoria</label>
            <select name="categoria" id="categoria">
                <option value="0">Selecionar</option>
                @foreach($categorias as $categoria)
                    <option value="{{$categoria->id}}">{{$categoria->categoria}}</option>
                @endforeach
            </select>
        </div>
        <div class="col col-2">
            <label for="zona" class="">Zona</label>
            <select name="zona" id="zona">
                <option value="0">Selecionar</option>
                @foreach($zonas as $zona)
                    <option value="{{$zona->id}}">{{$zona->zona}}</option>
                @endforeach
            </select>
        </div>
    @else
        <div class="col col-2">
            <label for="ean">Ean</label>
            <input type="text" class="form-control" name="ean" id="ean">
        </div>
        <div class="col col-2">
            <label for="descricao">Descrição</label>
            <input type="text" class="form-control" name="descricao" id="descricao">
        </div>
        <div class="col col-2">
            <label for="sku">Sku</label>
            <input type="number" step="any" class="form-control" name="sku" id="sku">
        </div>
        <div class="col col-2">
            <label for="categoria" class="">Categoria</label>
            <select name="categoria" id="categoria">
                <option disabled selected value>-- Selecionar -- </option>
                @foreach($categorias as $categoria)
                    <option value="{{$categoria->id}}">{{$categoria->categoria}}</option>
                @endforeach
            </select>
        </div>
        <div class="col col-2">
            <label for="zona" class="">Zona</label>
            <select name="zona" id="zona">
                <option disabled selected value>-- Selecionar -- </option>
                @foreach($zonas as $zona)
                    <option value="{{$zona->id}}">{{$zona->zona}}</option>
                @endforeach
            </select>
        </div>
    </div>
    @endif
    <div class="row mt-2">
        <div class="col col-1">
            <button class="btn btn-success" type="submit">Salvar</button> 
        </div>
        <div class="col col-1">
            <a href="/produto" class="btn btn-dark">Voltar</a>
        </div>
    </div>
</form>
@endsection