@extends('layout.layout')

@section('titulo', 'Localiza!!!')

@section('conteudo')
<div class="container px-4 mt-4">
  <div class="row g-4">
    <div class="col">
        <a href="{{ route('estoque.index') }}" class="p-4 border bg-light d-flex justify-content-center btn"><h5>Estoques</h5></a>
    </div>
    <div class="col">
        <a href="{{ route('categoria.index') }}" class="p-4 border bg-light d-flex justify-content-center btn"><h5>Categorias</h5></a>
    </div>
    <div class="col">
        <a href="{{ route('produto.index') }}" class="p-4 border bg-light d-flex justify-content-center btn"><h5>Produtos</h5></a>
    </div>
    <div class="col">
        <a href="{{ route('funcao.busca') }}" class="p-4 border bg-light d-flex justify-content-center btn"><h5>Buscar</h5></a>
    </div>
    <div class="col">
        <a href="{{ route('funcao.deposito') }}" class="p-4 border bg-light d-flex justify-content-center btn"><h5>Depositar</h5></a>
    </div>
  </div>
</div>
@endsection