<?php

namespace App\Exports;

use App\Models\{LoteProduto, Lote};
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class LoteProdutoExport implements FromCollection, WithHeadings
{
    public function collection()
    {
        $LD = LoteProduto::query()->orderBy('lote_id', 'desc')->first();
        $lote = Lote::findOrFail($LD->lote_id);
        $produtos = $lote->produtos()->get();

        $i = 0;
        foreach ($produtos as $produto) {
            $zona = $produto->zona()->first();
            $estoque = $zona->estoque()->first();
            $resultado["resultado$i"] = [
                'lote' => $lote->created_at,
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

    public function headings(): array
    {
        return ["Lote", "Ean", "Descricao", "Sku", "Zona", "Estoque"];
    }
}
