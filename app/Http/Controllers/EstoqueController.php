<?php

namespace App\Http\Controllers;

use App\Models\Estoque;
use App\Http\Requests\EstoqueRequest;
use App\Services\{Criador, Removedor};
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;

class EstoqueController extends Controller
{
    public function index()
    {
        $estoques = Estoque::query()
            ->get();
        
        return view('estoque.estoque.index', compact('estoques'));
    }

    public function create()
    {
        return view('estoque.estoque.create');
    }

    public function store(EstoqueRequest $request, Criador $criarEstoque)
    {
        DB::transaction(function () use ($criarEstoque, $request){
            $criarEstoque->criarEstoque(
                $request->numero,
                $request->Nzona
            );
        });

        return redirect('/estoque');
    }

    public function edit(int $id)
    {
        $estoque = Estoque::findOrFail($id);
        return view('estoque.estoque.create', compact('estoque'));
    }

    public function update(EstoqueRequest $request, int $id)
    {
        DB::transaction(function () use ($id, $request){
            Estoque::findOrFail($id)->update([
                'numero' => $request->numero
            ]);
        });

        return Redirect::to("/estoque");
    }

    public function destroy(Removedor $remove, int $id)
    {
        DB::transaction(function () use ($id, $remove){
            $remove->removerEstoque($id);
        });

        return Redirect::to("/estoque");
    }
}
