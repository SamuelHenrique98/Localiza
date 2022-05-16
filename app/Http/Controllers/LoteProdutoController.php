<?php

namespace App\Http\Controllers;

use App\Models\{Lote, LoteProduto, Produto};
use App\Services\{Criador, Funcao, Removedor};
use Illuminate\Http\Request;
use App\Exports\LoteProdutoExport;
use App\Http\Requests\DepositoRequest;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;

class LoteProdutoController extends Controller
{
    public function deposito()
    {
        return view("estoque.funcao.busca");
    }

    public function depositar(DepositoRequest $request, Criador $criarLote, Funcao $funcao, Removedor $removedor)
    {
        $resultado = array();
        $criarLote->criarLote();       
        
        $filtro1 = $funcao->Filtrar($request->skus);
        $anexado = $this->anexando($filtro1);
        
        $lote = Lote::query()->orderBy('id', 'desc')->first();
        
        if (is_object($anexado) == TRUE) {
            // echo "entrei no if";
            // exit;
            $resultados = $funcao->SeparacaoLote($anexado); 
        }else {
            // echo "entrei no else";
            // exit;
            $resultados = $anexado;
        }
        
        
        if (array_key_exists("resultado0", $resultados)==TRUE) {
            return view('estoque.funcao.resultadoBusca', compact('resultados', 'lote'));
        }else {
            $removedor->removerLote($lote);
            $NaoEncontrados = $resultados;
            return view('estoque.funcao.resultadoBusca', compact('NaoEncontrados'));
        } 
    }

    public function anexando($filtro1)
    {
        $funcao = new Funcao;
        $lote = Lote::query()->orderBy('id', 'desc')->first();
        $produtos = Produto::query()->get();

        $achado = array();
        $nEncontrado = null;
        
        for ($i=0; $i < count($filtro1); $i++) { 
            foreach ($produtos as $produto) {
                if ($produto->sku == $filtro1[$i]) {
                    $produto->lotes()->attach($lote);
                    $achado[] = $filtro1[$i];
                    break;
                }else{
                    $nEncontrado .= "$filtro1[$i], ";
                }
            }
        }

        $filtro2 = $funcao->NaoEncontrado($nEncontrado, $achado);

        

        if (!empty($filtro2)) {            
            $this->desanexando($produtos, $lote, $achado);
            return $filtro2;      
        }

        $LD = LoteProduto::query()->orderBy('lote_id', 'desc')->first();
        return $LD; 
    }

    public function desanexando($produtos, $lote, $achado)
    {
        for ($i=0; $i < count($achado); $i++) { 
            foreach ($produtos as $produto) {
                if ($produto->sku == $achado[$i]) {
                    $produto->lotes()->detach($lote);
                    break;
                }
            }
        }
    }

    public function export() 
    {
        return Excel::download(new LoteProdutoExport, 'LoteProduto.xls');
    }
}
