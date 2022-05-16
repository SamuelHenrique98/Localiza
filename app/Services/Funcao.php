<?php

namespace App\Services;

use App\Models\Lote;
use App\Models\Produto;
use DateTime;
use Illuminate\Support\Facades\DB;
use PhpOffice\PhpSpreadsheet\Shared\Date;

class Funcao
{
    public function Filtrar(string $skus): array
    {
        $skuInput = $skus;
        $sku2 = str_replace(" ", "", $skuInput);
        $sku3 = explode(",", $sku2);
        $results = array_unique($sku3);

        return $results;
    }

    public function Separacao(array $filtro1): array
    {
        $array = array();
        foreach ($filtro1 as $value) {
            $array[] = intval($value);
        }

        $produtos = Produto::query()->get();
        $resultado = array();
        $achado = array();
        $nEncontrado = null;

        for ($i=0; $i < count($array); $i++) { 
            foreach ($produtos as $produto) {
                if ($produto->sku == $array[$i]) {
                    $zona = $produto->zona()->first();
                    $estoque = $zona->estoque()->first();
                    $resultado["resultado$i"] = [
                        'sku' => $produto->sku,
                        'ean' => $produto->ean,
                        'descricao' => $produto->descricao,
                        'zona' => $zona->zona,
                        'estoque' => $estoque->numero
                    ];
                    $achado[] = $array[$i];
                    break;
                }else{
                    $nEncontrado .= "$array[$i], ";
                }
            }
        }

        $filtro2 = $this->NaoEncontrado($nEncontrado, $achado);
   
        if ($resultado == null || $filtro2 != null) {
            return $filtro2;      
        }else {
            return $resultado;
        }
    }

    public function NaoEncontrado(string $nEncontrado, array $achado): array
    {
        $filtro2 = $this->Filtrar($nEncontrado);      
            $key = array_search("", $filtro2);
            if ($key !== false) {
                unset($filtro2[$key]);
                // $cont = $cont - 1; 
            }

        if ($achado <> null) {
            for ($i=0; $i < count($achado); $i++) { 
                $key = array_search($achado[$i], $filtro2);
                if ($key !== false) {
                    unset($filtro2[$key]);
                }
            }
        }    
        

        return $filtro2;
    }

    public function SeparacaoLote($resultados)
    {
        $lote = Lote::findOrFail($resultados->lote_id);
        $produtos = $lote->produtos()->get();

        $i = 0;
        foreach ($produtos as $produto) {
            $zona = $produto->zona()->first();
            $estoque = $zona->estoque()->first();
            $resultado["resultado$i"] = [
                'ean' => $produto->ean,
                'descricao' => $produto->descricao,
                'sku' => $produto->sku,
                'zona' => $zona->zona,
                'estoque' => $estoque->numero
            ];
            $i++;
        }

        return $resultado;
    }


    public function FiltroVendaImport(array $row)
    {
        
        $search = Date::excelToDateTimeObject($row['data']);
        $data = $search->format('Y-m-d');
       
        $campanha = DB::table('campanhas')->where([
            ['canal', '=', $row['canal']], 
            ['data_inicial', '<=', $data],
            ['data_final', '>=', $data]
        ])->value('id');
        
        $id = null;

        $itens = DB::table('itens_campanha')->where([
            ['campanha_id', '=', $campanha],
            ['sku', '=', $row['sku']]
        ])->get();

        if (!$itens->isEmpty()) {
            $id = $campanha;
        }

        return $id;
    }

    public function mes($vendas): array
    {
        $meses = array();
        $jan = 0;
        $fev = 0;
        $mar = 0;
        $abr = 0;
        $mai = 0;
        $jun = 0;
        $jul = 0;
        $ago = 0;
        $set = 0;
        $out = 0;
        $nov = 0;
        $dez = 0;

        foreach ($vendas as $venda) {
            switch (date('m',strtotime($venda->data))) {
                case '1':
                    $meses["Janeiro"] = ++$jan;
                    break;
                case '2':
                    $meses['Fevereiro'] = ++$fev;
                    break;
                case '3':
                    $meses['Março'] = ++$mar;
                    break;
                case '4':
                    $meses["Abril"] = ++$abr;
                    break;
                case '5':
                    $meses['Maio'] = ++$mai;
                    break;
                case '6':
                    $meses['Junho'] = ++$jun;
                    break;
                case '7':
                    $meses['Julho'] = ++$jul;
                    break;
                case '8':
                    $meses['Agosto'] = ++$ago;
                    break;
                case '9':
                    $meses['Setembro'] = ++$set;
                    break;
                case '10':
                    $meses['Outubro'] = ++$out;
                    break;
                case '11':
                    $meses['Novembro'] = ++$nov;
                    break;
                case '12':
                    $meses['Dezembro'] = ++$dez;
                    break;
            }
        }
        
        return $meses; 
    }


    public function vendasMes(string $mes)
    {
        $now = new DateTime();
        $Y = $now->format('Y');;

        $data = "";

        switch ($mes) {
            case "Janeiro":
                $data = "$Y-01-01,$Y-01-31";
                break;
            case 'Fevereiro':
                $data = "$Y-02-01,$Y-02-28";
                break;
            case 'Março':
                $data = "$Y-03-01,$Y-03-31";
                break;
            case "Abril":
                $data = "$Y-04-01,$Y-04-30";
                break;
            case 'Maio':
                $data = "$Y-05-01,$Y-05-31";
                break;
            case 'Junho':
                $data = "$Y-06-01,$Y-06-30";
                break;
            case 'Julho':
                $data = "$Y-07-01,$Y-07-31";
                break;
            case 'Agosto':
                $data = "$Y-08-01,$Y-08-31";
                break;
            case 'Setembro':
                $data = "$Y-09-01,$Y-09-30";
                break;
            case 'Outubro':
                $data = "$Y-10-01,$Y-10-31";
                break;
            case 'Novembro':
                $data = "$Y-11-01,$Y-11-30";
                break;
            case 'Dezembro':
                $data = "$Y-12-01,$Y-12-31";
                break;
        }

        return $data;
    }

    public function filtroCampanha($vendas)
    {
        $aux = null;
        $i = 0;
        $quant = 0;
        $pedido = 0;
        $resultado = array();
        
        
        foreach ($vendas as $venda) {
            if (!isset($aux)) {
                $aux = $venda->sku;
                $i++;
                $resultado[$i] = [
                    'quant' => $venda->quant,
                    'pedido' => 1,
                    'ean' => $venda->ean,
                    'produto' => $venda->produto,
                    'sku' => $venda->sku,
                    'canal' => $venda->canal
                ];
            }elseif ($venda->sku == $aux) {
                $pedido = $resultado[$i]['pedido'];
                $quant = $resultado[$i]['quant'];
                $resultado[$i] = [
                    'quant' => $venda->quant + $quant,
                    'pedido' => $pedido = $resultado[$i]['pedido'] + 1,
                    'ean' => $venda->ean,
                    'produto' => $venda->produto,
                    'sku' => $venda->sku,
                    'canal' => $venda->canal
                ];
            }else {
                $i++;
                $resultado[$i] = [
                    'quant' => $venda->quant,
                    'pedido' => 1,
                    'ean' => $venda->ean,
                    'produto' => $venda->produto,
                    'sku' => $venda->sku,
                    'canal' => $venda->canal
                ];
                $aux = $venda->sku;
            }
        }

        return $resultado;
    }

    public function canalCampanha($vendas)
    {
        $filtro1 = "";

        foreach ($vendas as $venda) {
            $filtro1 .= "$venda->canal,";
        }

        $filtro2 = $this->Filtrar($filtro1);

        $key = array_search("", $filtro2);
            if ($key !== false) {
                unset($filtro2[$key]);
            }

        return $filtro2;
    }
}