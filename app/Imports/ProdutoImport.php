<?php

namespace App\Imports;

use App\Models\Produto;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class ProdutoImport implements ToModel, WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new Produto([
            'ean' => $row['ean'],
            'descricao' => $row['descricao'], 
            'sku' => $row['sku'],
            'categoria_id' => $row['categoria_id'],
            'zona_id' => $row['zona_id']
        ]);
    }
}
