@extends('layout.layout')

@section('titulo', 'Localiza!!!')

@section('conteudo')

<h3 class="mt-1">Estoque</h3>

<a href="{{ route('estoque.create') }}" class="btn btn-light mt-1 border border-dark">Criar estoque</a>

<ul class="list-group mt-1">
    @foreach($estoques as $estoque)
    <li class="list-group-item d-flex justify-content-between align-items-center">
        <span class="d-flex">
            <h6>Estoque: {{$estoque->numero}}</h6>
        </span>
        <span class="d-flex">
            <a href="{{ route('estoque.edit', ['estoque'=>$estoque]) }}" class="btn btn-info border border-dark">Editar</a>
            <a href="{{ route('estoque.zona.index', ['estoque'=>$estoque]) }}" class="btn btn-light border border-dark">Zonas</a>
            <form method="post" action="{{ route('estoque.destroy',['estoque'=>$estoque] ) }}"
                onsubmit="return confirm('Tem certeza que deseja remover o estoque {{ addslashes($estoque->numero) }}?')">
                @csrf
                @method('DELETE')
                <button class="btn btn-danger border border-dark">
                    Deletar
                </button>
            </form>
        </span>
    </li>
    @endforeach
</ul>
<a href="/g-estoque" class="btn btn-dark mt-2">Voltar</a>

@endsection
