@extends('layout.layout')

@section('titulo', 'Localiza!!!')

@section('conteudo')



<div class="container px-4 mt-4">
  <div class="row g-4">
    <div class="col">
      <a href="{{ route('campanha.index') }}" class="p-4 border bg-light d-flex justify-content-center btn"><h5>Campanhas</h5></a>
    </div>
    <div class="col">
      <a href="{{ route('venda.index') }}" class="p-4 border bg-light d-flex justify-content-center btn"><h5>Vendas</h5></a>
    </div>
  </div>
</div>

@endsection