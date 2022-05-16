@extends('layout.layout')

@section('titulo', 'Localiza!!!')

@section('conteudo')
<h3 class="mt-1">Zonas</h3>

<span>
    <a href="{{ route('estoque.zona.create',['estoque'=>$estoque]) }}" class="btn btn-light mt-1">Criar Zona</a>
</span>

<ul class="list-group mt-1">
    @foreach($zonas as $zona)
    <li class="list-group-item d-flex justify-content-between align-items-center">
        <span class="d-flex">
        @if($zona->zona == NULL)
            Zona sem identificação
        @else
            <h6>Zona: {{$zona->zona}}</h6>
        @endif  
        </span>
        <span class="d-flex">
            <a href="{{ route('estoque.zona.edit', ['estoque'=>$estoque, 'zona'=>$zona]) }}" class="btn btn-info">Editar</a>
            <form method="post" action="{{ route('estoque.zona.destroy',['estoque'=>$estoque, 'zona'=>$zona] ) }}"
                onsubmit="return confirm('Tem certeza que deseja remover a zona {{ addslashes($zona->zona) }}?')">
                @csrf
                @method('DELETE')
                <button class="btn btn-danger">
                    Deletar
                </button>
            </form>
        </span>
    </li>
    @endforeach
</ul>
<a href="/estoque" class="btn btn-dark mt-2">Voltar</a>
@endsection