<?php


namespace App\Imports;

use App\Models\{Venda};
use App\Services\Funcao;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use PhpOffice\PhpSpreadsheet\Shared\Date;


class VendaImport implements ToModel, WithHeadingRow
{
    public function chamarFuncao(Funcao $funcao, array $row)
    {
        $id = $funcao->FiltroVendaImport($row);
        return $id;
    }

    public function model(array $row)
    {
        $funcao = new Funcao;

        $resposta = $this->chamarFuncao($funcao, $row);

        return new Venda([
            'ean'    => $row['ean'],            
            'produto'=> $row['produto'],
            'pedido' => $row['pedido'],
            'sku'    => $row['sku'],
            'marca'  => $row['marca'],
            'quant'  => $row['quant'],
            'canal'  => $row['canal'],
            'data' => Date::excelToDateTimeObject($row['data']),
            'campanha_id' => $resposta
        ]);
    }
}
