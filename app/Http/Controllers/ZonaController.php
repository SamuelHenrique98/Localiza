<?php

namespace App\Http\Controllers;

use App\Models\{Categoria, CategoriaZona, Zona,Estoque};
use App\Http\Controllers\CategoriaZonaController;
use App\Services\{Criador, Removedor};
use Illuminate\Support\Facades\Redirect;
use App\Http\Requests\ZonaRequest;
use Illuminate\Support\Facades\DB;

class ZonaController extends Controller
{
    public function index(int $id)
    {
        $estoque = Estoque::find($id);
        $zonas = $estoque->zonas;

        return view('estoque.zona.index', compact('estoque', 'zonas'));
    }

    public function create(int $id)
    {
        $estoque = Estoque::find($id);
        $categorias = Categoria::query()->get();
        $itens = null;

        return view('estoque.zona.create', compact('estoque', 'categorias', 'itens'));
    }

    public function store(Criador $criarZona, int $estoqueId, ZonaRequest $request, CategoriaZonaController $cz)
    {
        DB::transaction(function () use ($criarZona, $estoqueId, $request, $cz){
            $zona = $criarZona->criarZona(
                $estoqueId,
                $request->zona
            );
    
            if (empty($request->categorias) === false) {
                $cz->anexandoZona($zona->id, $request->categorias);
            }
        });
        

        return Redirect::to("/estoque/$estoqueId/zona");
    }

    public function edit(int $estoqueId, int $zonaId)
    {
        $zona = Zona::findOrFail($zonaId);
        $estoque = Estoque::findOrFail($estoqueId);
        $categorias = Categoria::query()->get();
        $CZs = CategoriaZona::query()->get();
        $itens = array();
        foreach ($CZs as $CZ) {
            if ($zona->id == $CZ->zona_id) {
                $itens[] = $CZ->categoria_id;
            }
        }

        return view('estoque.zona.create', compact('estoque', 'zona', 'categorias', 'itens'));
    }

    public function update(ZonaRequest $request, int $estoqueId, int $zonaId, CategoriaZonaController $cz)
    {
        DB::transaction(function () use ($request, $zonaId, $cz){
            $categorias = $request->categorias;
            Zona::findOrFail($zonaId)->update([
                'zona' => $request->zona
            ]);
    
            if (empty($categorias) === false) {
                $cz->anexandoZona($zonaId, $categorias);
            }else {
                $cz->desanexandoZona($zonaId);
            }
        });
        
        return Redirect::to("/estoque/$estoqueId/zona");
    }

    public function destroy(Removedor $remove, int $estoqueId, int $zonaId)
    {
        DB::transaction(function () use ($remove, $zonaId){
            $remove->removerZona($zonaId);
        });
        
        return Redirect::to("/estoque/$estoqueId/zona");
    }
}
