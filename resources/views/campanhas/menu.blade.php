@extends('layout.layout')

@section('titulo', 'Localiza!!!')

@section('conteudo')



<div class="container px-4 mt-4">
  <div class="row g-4">
    <div class="col">
        <div class="p-4 border bg-light d-flex justify-content-center btn">
            <a href="{{ route('campanha.index') }}" class="btn"><h5>Campanhas</h5></a>
        </div>
    </div>
    <div class="col">
        <div class="p-4 border bg-light d-flex justify-content-center btn">
            <a href="{{ route('venda.index') }}" class="btn"><h5>Vendas</h5></a>
        </div>
    </div>
  </div>
</div>

@endsection