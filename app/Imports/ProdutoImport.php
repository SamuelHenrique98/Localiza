<?php

namespace App\Imports;

use App\Models\Categoria;
use App\Models\Zona;
use App\Services\Criador;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
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
        $criarProduto = new Criador;

        $categoria = Categoria::query()->where([
            ['categoria', '=', $row['categoria']]
        ])->value('id');
        
        $zona = Zona::query()->where([
            ['zona', '=', $row['zona']]
        ])->value('id');       

        DB::transaction(function () use ($criarProduto, $row, $categoria, $zona){
            $criarProduto->criarProduto(
                $row['ean'],
                $row['descricao'], 
                $row['sku'],
                $categoria,
                $zona
            );
        });

        return;
    }
}
