<?php

namespace App\Services;

use App\Models\{Campanha, Categoria, Estoque, Lote, Zona};
use App\Http\Controllers\CategoriaZonaController;

class Criador
{
    public function criarEstoque(int $estoque, int $Nzona)
    {
        $estoque = Estoque::create([
            'numero' => $estoque
        ]);

        $this->criarZonas($estoque, $Nzona);
    }

    public function criarZonas(Estoque $estoque, int $Nzona)
    {
        for($i = 1; $i <= $Nzona; $i++){
            $estoque->zonas()->create();
        }
    }

    public function criarZona(int $id, string $zona)
    {
        $estoque = Estoque::findOrFail($id);
        $zona = $estoque->zonas()->create([
            'zona' => $zona
        ]);
        
        return $zona;
    }

    public function criarCategoria(string $categoria)
    {
        $categoria = Categoria::create([
            'categoria' => $categoria
        ]);

        return $categoria;
    }


    public function criarProduto(string $ean, string $descricao, int $sku, int $categoriaId, int $zonaId)
    {
        $zona = Zona::findOrFail($zonaId);
        $zona->produtos()->create([
            'ean' => $ean,
            'descricao' => $descricao,
            'sku' => $sku,
            'categoria_id' => $categoriaId
        ]);
    }

    public function criarLote()
    {
        Lote::create()->all();
    }

    public function criarCampanha(string $nome, string $canal, $data_inicial, $data_final)
    {
        Campanha::create([
            'nome' => $nome,
            'canal' => $canal,
            'data_inicial' => $data_inicial,
            'data_final' => $data_final
        ]);
    }
}