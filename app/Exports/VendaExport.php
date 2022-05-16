<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class VendaExport implements FromCollection, WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        return;
    }

    public function headings(): array
    {
        return ["EAN", "Produto", "Pedido", "SKU", "Marca", "Quant", "Canal", "Data"];
    }
}
