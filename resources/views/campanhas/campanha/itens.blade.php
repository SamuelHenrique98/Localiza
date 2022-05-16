@extends('layout.layout')

@section('titulo', 'Localiza!!!')

@section('conteudo')

<h3 class="mt-1">Produtos da Campanha</h3>

<a href="/campanha" class="btn btn-dark mt-2">Voltar</a>

<a class="btn btn-warning float-end" href="{{ route('campanha.export') }}">Export User Data</a>

<table class="table table-bordered mt-2">
    <thead>
        <tr>
            <th>SKU</th>
            <th>Produto</th>
            <th></th>
        </tr>
    </thead>
    <tbody>
        @foreach($itens as $iten)
        <tr>
            <td>{{$iten->sku}}</td>
            <td>{{$iten->produto}}</td>
            <td></td>
        </tr>
        @endforeach
    </tbody>
</table>

@endsection