<?php

namespace App\Services;

use App\Models\{Campanha, Estoque, Zona, Categoria, ItensCampanha, Lote, Produto, Venda};
use Illuminate\Support\Facades\DB;

class Removedor
{
    public function removerEstoque(int $id)
    {
        $estoque = Estoque::find($id);
        $this->removerZonas($estoque);
        $estoque->delete();
    }

    public function removerZonas(Estoque $estoque)
    {
        $estoque->zonas->each(function (Zona $zona){
            $zona->delete();
        });        
    }

    public function removerZona(int $id)
    {
        $zona = Zona::findOrFail($id);
        $zona->delete();
    }

    public function removerCategoria(int $id)
    {
        $categoria = Categoria::findOrFail($id);
        $categoria->delete();
    }

    public function removerProduto(int $id)
    {
        $produto = Produto::findOrFail($id);
        $produto->delete();
    }

    public function removerLote(Lote $lote)
    {
        $lote->delete();
    }

    public function removerCampanha(int $id)
    {
        $campanha = Campanha::find($id);
        $this->removerItens($campanha);

        $campanha->vendas->each(function (Venda $venda)
            use ($campanha){
                $venda->campanha()->dissociate($campanha->id);
                $venda->save();      
        });
        
        $campanha->delete();
    }

    public function removerItens(Campanha $campanha)
    {
        $campanha->itens->each(function (ItensCampanha $iten){
            $iten->delete();
        });        
    }
}