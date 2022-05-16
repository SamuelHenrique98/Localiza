@extends('layout.layout')

@section('titulo', 'Localiza!!!')

@section('conteudo')
<div class="container px-4 mt-4">
  <div class="row g-4">
    <div class="col">
        <div class="p-4 border bg-light d-flex justify-content-center btn">
            <a href="{{ route('estoque.index') }}" class="btn"><h5>Estoques</h5></a>
        </div>
    </div>
    <div class="col">
        <div class="p-4 border bg-light d-flex justify-content-center btn">
            <a href="{{ route('categoria.index') }}" class="btn"><h5>Categorias</h5></a>
        </div>
    </div>
    <div class="col">
        <div class="p-4 border bg-light d-flex justify-content-center btn">
            <a href="{{ route('produto.index') }}" class="btn"><h5>Produtos</h5></a>
        </div>
    </div>
    <div class="col">
        <div class="p-4 border bg-light d-flex justify-content-center btn">
            <a href="{{ route('funcao.busca') }}" class="btn"><h5>Buscar</h5></a>
        </div>
    </div>
    <div class="col">
        <div class="p-4 border bg-light d-flex justify-content-center btn">
            <a href="{{ route('funcao.deposito') }}" class="btn"><h5>Depositar</h5></a>
        </div>
    </div>
  </div>
</div>
@endsection