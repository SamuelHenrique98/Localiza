@extends('layout.layout')

@section('titulo', 'Localiza!!!')

@section('conteudo')
@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
<h3 class="mt-1">Produtos</h3>
<div class="d-flex justify-content-between align-items-center mt-1"> 
    <span class="d-flex">
        <a href="{{ route('produto.create') }}" class="btn border-dark">Criar produto</a>
    </span>
    <span class="d-flex">
        <a href="/g-estoque" class="btn btn-dark">Voltar</a>
        <a class="btn btn-warning float-end" href="{{ route('produto.export') }}">Baixar modelo</a>
    </span>
</div>
<div class="row mt-2"> 
    <form action="{{ route('produto.import') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="col col-5">
            <input type="file" name="file" class="form-control">
            <button class="btn btn-success mt-2">Importar Produtos</button>
        </div>
    </form>
</div>
<div class="row mt-2"> 
    <div class="col col-10">
        <form action="{{ route('produto.index') }}" method="GET">
            <input type="text" id="search" name="search" class="form-control" placeholder="procurar...">
        </form>
    </div>
    <div class="col col-2">
            <a href="{{ route('produto.index') }}" class="btn border-dark">Limpar Busca</a>
    </div>
</div>

<table class="table table-bordered mt-2">
    <thead>
        <tr>
            <th>EAN</th>
            <th>Descrição</th>
            <th>SKU</th>
            <th></th>
        </tr>
    </thead>
    <tbody>
        @foreach($produtos as $produto)
        <tr>
            <td>{{$produto->ean}}</td>
            <td>{{$produto->descricao}}</td>
            <td>{{$produto->sku}}</td>
            <td>
                <span class="d-flex">
                    <a href="{{ route('produto.edit', ['produto'=>$produto]) }}" class="btn btn-light btn-sm border border-dark">Editar</a>
                    <form method="post" action="{{ route('produto.destroy',['produto'=>$produto] ) }}"
                        onsubmit="return confirm('Tem certeza que deseja remover o estoque {{ addslashes($produto->descricao) }}?')">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-danger btn-sm border border-dark">
                            Deletar
                        </button>
                    </form>
                </span>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>

@if(count($produtos) == 0 && $search)
    <p>Não foi possível encontrar nenhum produto com esse valor: {{$search}}! <a href="{{ route('produto.index') }}">Ver todos!</a></p>
@elseif(count($produtos) == 0)
    <p>Não tem esse produto</p>
@endif
<div>
    <span class="d-flex">
        {{$produtos->links()}}
    </span>
</div>
@endsection