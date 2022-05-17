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

<h3 class="mt-1">Vendas</h3>
<div class="">
    <div class="row">
        <div class="col">
            <a class="btn btn-warning float-end" href="{{ route('venda.export') }}">Baixar Modelo</a>
        </div>
    </div>
    <div class="row mt-2">
        <form action="{{ route('venda.import') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <input type="file" name="file" class="form-control">
            <button class="btn btn-success mt-2">Importar Vendas</button>
        </form>
    </div>
</div>

<div id="cards-container" class="row mt-2">
    @foreach($meses as $mes => $value)
    <div class="card col-md-3">
        <div class="card-body">
            <p class="card-date">{{$mes}}</p>
            <h5 class="card-title">{{$value}}</h5>
            <a class="btn btn-sm btn-dark" href="{{ route('campanha.resultado', ['mes'=>$mes]) }}">Pedidos</a>
        </div>
    </div>
    @endforeach
</div>

<a href="/menu-campanha" class="btn btn-dark mt-2">Voltar</a>

@endsection