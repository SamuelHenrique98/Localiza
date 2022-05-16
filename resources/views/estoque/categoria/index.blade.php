@extends('layout.layout')

@section('titulo', 'Localiza!!!')

@section('conteudo')
<h3 class="mt-1">Categoria</h3>

<span>
    <a href="{{ route('categoria.create') }}" class="btn mt-1 border border-dark">Criar categoria</a>
</span>

<ul class="list-group mt-1">
    @foreach($categorias as $categoria)
    <li class="list-group-item d-flex justify-content-between align-items-center">
        <span class="d-flex">
            <h6>{{$categoria->categoria}}</h6>
        </span>
        <span class="d-flex">
            <a href="{{ route('categoria.edit', ['categorium'=>$categoria]) }}" class="btn btn-sm border border-dark">Categoria</a>
            <form method="post" action="{{ route('categoria.destroy',['categorium'=>$categoria] ) }}"
                onsubmit="return confirm('Tem certeza que deseja remover o categoria {{ addslashes($categoria->categoria) }}?')">
                @csrf
                @method('DELETE')
                <button class="btn btn-danger btn-sm border border-dark">
                    Deletar
                </button>
            </form>
        </span>
    </li>
    @endforeach
</ul>
<a href="/g-estoque" class="btn btn-dark mt-2">Voltar</a>
@endsection