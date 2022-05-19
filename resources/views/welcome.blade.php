@extends('layout.layout')

@section('titulo', 'Localiza!!!')

@section('conteudo')
<div class="container px-4 mt-4">
  <div class="row g-4">
    <div class="col">
        <a href="/menu-estoque" class="p-4 border bg-light d-flex justify-content-center btn">
            <h5>Estoque</h5>
        </a>
    </div>
    <div class="col">
        <a href="/menu-campanha" class="p-4 border bg-light d-flex justify-content-center btn">
            <h5>Campanha</h5>
        </a>
    </div>
</div>
@endsection
