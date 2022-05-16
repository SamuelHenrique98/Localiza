<?php

namespace App\Http\Controllers;

use App\Models\Categoria;
use App\Http\Controllers\CategoriaZonaController;
use App\Models\CategoriaZona;
use App\Models\Zona;
use App\Services\{Criador, Removedor};
use Illuminate\Support\Facades\Redirect;
use App\Http\Requests\CategoriaRequest;
use Illuminate\Support\Facades\DB;

class CategoriaController extends Controller
{
    public function index()
    {
        $categorias = Categoria::query()->get();

        return view('estoque.categoria.index', compact('categorias'));
    }

    public function create()
    {
        $zonas = Zona::query()->get();
        $itens = null;

        return view('estoque.categoria.create', compact('zonas', 'itens'));
    }

    public function store(CategoriaRequest $request, Criador $criarCategoria, CategoriaZonaController $cz)
    {
        DB::transaction(function () use ($criarCategoria, $cz, $request){
            $categoria = $criarCategoria->criarCategoria(
                $request->categoria
            );
            if (empty($request->zonas) === false) {
                $cz->anexandoCategoria($categoria->id, $request->zonas);
            }
        });
        
        return redirect('/categoria');
    }

    public function edit(Categoria $categoria, int $id)
    {
        $categoria = Categoria::findOrFail($id);
        $zonas = Zona::query()->get();
        $CZs = CategoriaZona::query()->get();
        $itens = array();
        foreach ($CZs as $CZ) {
            if ($categoria->id == $CZ->categoria_id) {
                $itens[] = $CZ->zona_id;
            }
        }

        return view('estoque.categoria.create', compact('categoria', 'zonas', 'itens'));
    }

    public function update(CategoriaRequest $request, int $id, CategoriaZonaController $cz)
    {
        DB::transaction(function () use ($request, $id, $cz){
            $zonas = $request->zonas;
            Categoria::findOrFail($id)->update([
                'categoria' => $request->categoria
            ]);
    
            if (empty($zonas) === false) {
                $cz->anexandoCategoria($id, $zonas);
            }else {
                $cz->desanexandoCategoria($id);
            }
        });
        
        return Redirect::to("/categoria");
    }

    public function destroy(Removedor $remove, int $id)
    {
        DB::transaction(function () use ($remove, $id){
            $remove->removerCategoria($id);
        });

        return Redirect::to("/categoria");
    }
}
