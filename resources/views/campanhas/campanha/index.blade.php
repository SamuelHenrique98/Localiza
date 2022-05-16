@extends('layout.layout')

@section('titulo', 'Localiza!!!')

@section('conteudo')

<h3 class="mt-1">Campanhas</h3>

<a href="{{ route('campanha.create') }}" class="btn btn-dark mt-2">Criar Campanha</a>

<a href="/menu-campanha" class="btn btn-dark mt-2">Voltar</a>

<table class="table table-bordered mt-2">
    <thead>
        <tr>
            <th>Nome</th>
            <th>Canal</th>
            <th>Inicio</th>
            <th>Termino</th>
            <th>Produtos</th>
            <th></th>
        </tr>
    </thead>
    <tbody">
        @foreach($campanhas as $campanha)
        <tr>
            <td>@if($campanha->nome ==  NULL)
                    {{$campanha->canal}} {{date('d/m', strtotime($campanha->data_inicial)) }} - {{date('d/m/Y', strtotime($campanha->data_final)) }}
                @else
                    {{$campanha->nome}}
                @endif
            </td>
            <td>{{$campanha->canal}}</td>
            <td>{{date('d/m/Y', strtotime($campanha->data_inicial)) }}</td>
            <td>{{date('d/m/Y', strtotime($campanha->data_final)) }}</td>
            <td>{{$campanha->itens()->count()}}</td>
            <td>
                <span class="d-flex">
                    <a href="{{ route('itens.index', ['campanha'=>$campanha]) }}" class="btn btn-sm btn-dark">Produtos</a>
                    <form method="post" action="{{ route('campanha.destroy',['campanha'=>$campanha] ) }}"
                        onsubmit="return confirm('Tem certeza que deseja remover o estoque {{ addslashes($campanha->nome) }}?')">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-danger border border-dark btn-sm">
                            Deletar
                        </button>
                    </form>
                </span>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>


@endsection