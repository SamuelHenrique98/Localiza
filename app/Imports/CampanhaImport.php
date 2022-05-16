<?php

namespace App\Imports;

use App\Models\Campanha;
use App\Models\ItensCampanha;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class CampanhaImport implements ToModel, WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        $campanha = Campanha::query()->orderBy('id', 'desc')->first();
        return new ItensCampanha([
            'sku'     => $row['sku'],  
            'produto' => $row['produto'],
            'campanha_id' => $campanha->id,
        ]);
    }
}
