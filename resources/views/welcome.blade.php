@extends('layout.layout')

@section('titulo', 'Localiza!!!')

@section('conteudo')
<div class="container px-4 mt-4">
  <div class="row g-4">
    <div class="col">
        <div class="p-4 border bg-light d-flex justify-content-center btn">
            <a href="/menu-estoque" class="btn"><h5>Estoque</h5></a>
        </div>
    </div>
    <div class="col">
        <div class="p-4 border bg-light d-flex justify-content-center btn">
            <a href="/menu-campanha" class="btn"><h5>Campanha</h5></a>
        </div>
    </div>
</div>
@endsection
