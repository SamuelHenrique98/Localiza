@extends('layout.layout')

@section('titulo', 'Localiza!!!')

@section('conteudo')
<h3 class="mt-1">Resultado das Campanhas {{$mes}}</h3>

<a href="/vendas" class="btn btn-dark mt-2">Voltar</a>
<!--
<a class="hidden btn btn-warning float-end" href="{{ route('resultado.export') }}">Export User Data</a>
-->
<div class="row g-3 mt-2">
    <div class="col-12">
        <h3>Sem Campanha</h3>
        <div class="p-3 border bg-light d-flex justify-content-center ">
            <table class="table table-bordered mt-1">
                <thead>
                    <tr>
                        <th>Quantidade</th>
                        <th>N° de Pedido</th>
                        <th>EAN</th>
                        <th>Descrição</th>
                        <th>SKU</th> 
                        <th>Canal</th> 
                    </tr>
                </thead>
                <tbody>
                    @foreach($SemCamp as $Sem)
                    <tr>
                        @foreach($Sem as $key => $valor)
                        <td>{{$valor}}</td>
                        @endforeach
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    @foreach($resultado as $nome => $canal)
    <div class="col">
        <h3>Campanha {{$nome}}</h3>
        <div class="p-4 border bg-light d-flex justify-content-center">
            <table class="table table-bordered mt-1">
                <thead>
                    <tr>
                        <th>Quantidade</th>
                        <th>N° de Pedido</th>
                        <th>EAN</th>
                        <th>Descrição</th>
                        <th>SKU</th> 
                    </tr>
                </thead>
                <tbody>
                    @foreach($canal as $itens)
                    <tr>
                        @foreach($itens as $key => $valor)
                        @if($valor == $nome)
                            @break
                        @endif    
                        <td>{{$valor}}</td>
                        @endforeach
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    @endforeach
</div>

@endsection

