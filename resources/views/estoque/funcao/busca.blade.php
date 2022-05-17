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
<div class="mt-2">
@if(Request::segment(1) == 'buscar')
<h3 class="mt-1">Busca</h3>
  <form method="post" action="{{ route('funcao.resultadoBusca') }}">
@else
<h3 class="mt-1">Deposito</h3>
  <form method="post" action="{{ route('funcao.depositar') }}">
@endif
    @csrf
      <label for="skus">Insira os SKU's</label>
      <input type="search" id="skus" name="skus">
      <input type="submit" value="Buscar">
  </form>
  <a href="/g-estoque" class="btn btn-dark mt-2">Voltar</a>
</div>
@endsection
