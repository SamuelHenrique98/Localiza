@extends('layout.layout')

@section('titulo', 'Localiza!!!')

@section('conteudo')
@if(Request::segment(1) == 'buscar' && isset($resultados))
    <h3>Lista de Produtos</h3>
    <table class="table table-bordered mt-2">
        <thead>
            <tr>
                <th>EAN</th>
                <th>Descrição</th>
                <th>SKU</th>
                <th>Zona</th>
                <th>Estoque</th>
            </tr>
        </thead>
        <tbody>
            @foreach($resultados as $itens) 
            <tr>
                @foreach($itens as $key => $valor)
                <td>{{$valor}}</td>
                @endforeach
            </tr>
            @endforeach
        </tbody>
    </table>
    <p><a href="{{ route('funcao.busca') }}" class="btn btn-dark">Voltar</a></p>
@elseif(Request::segment(1) == 'depositar' && isset($resultados))
    <h3 class="mt-2">Lote {{$lote->created_at}}</h3>
    <table class="table table-bordered mt-2">
        <thead>
            <span>
                <a class="btn btn-warning float-end" href="{{ route('funcao.depositar-export') }}">Exportar</a>
            </span>
            <tr>
                <th>EAN</th>
                <th>Descrição</th>
                <th>SKU</th>
                <th>Zona</th>
                <th>Estoque</th>
            </tr>
        </thead>
        <tbody>
            @foreach($resultados as $itens) 
            <tr>
                @foreach($itens as $key => $valor)
                <td>{{$valor}}</td>
                @endforeach
            </tr>
            @endforeach
        </tbody>
    </table>
    <p><a href="{{ route('funcao.deposito') }}" class="btn btn-dark">Voltar</a></p>
@elseif(Request::segment(1) == 'buscar' && isset($NaoEncontrados))
    <h3>SKUs não encontrado</h3>
    <table class="table table-bordered mt-2">
    @foreach($NaoEncontrados as $NaoEncontrado)
        <tr>
            <td>
                Sku: {{$NaoEncontrado}} 
            </td>
        </tr>
    @endforeach
    </table>
    <p><a href="{{ route('produto.create') }}" class="btn btn-sm border border-dark">Criar produto</a></p>
    <p><a href="{{ route('funcao.busca') }}" class="btn btn-dark">Voltar</a></p>
@elseif(Request::segment(1) == 'depositar' && isset($NaoEncontrados))
    <h3>SKUs não encontrado</h3>
    <table class="table table-bordered mt-2">
    @foreach($NaoEncontrados as $NaoEncontrado)
        <tr>
            <td>
                Sku: {{$NaoEncontrado}} 
            </td>
        </tr>
    @endforeach
    </table>
    <p><a href="{{ route('produto.create') }}" class="btn">Criar produto</a></p>
    <p><a href="{{ route('funcao.deposito') }}" class="btn btn-dark">Voltar</a></p>
@endif
@endsection