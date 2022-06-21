<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;


class ProdutoExport implements FromCollection, WithHeadings
{
    public function collection()
    {
        return;
    }

    public function headings(): array
    {
        return ["Ean", "Descricao", "Sku", "Categoria", "Zona"];
    }
}
