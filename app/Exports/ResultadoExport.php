<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromArray;

class ResultadoExport implements FromArray
{
    public function array(): array
    {
        return $this->array;
    }
}
