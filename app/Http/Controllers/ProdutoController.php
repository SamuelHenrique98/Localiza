<?php

namespace App\Http\Controllers;

use App\Exports\ProdutoExport;
use App\Http\Requests\BuscaRequest;
use App\Http\Requests\ImportProdutoRequest;
use App\Models\{Categoria, Produto, Zona};
use App\Services\{Criador, Funcao, Removedor};
use Illuminate\Support\Facades\Redirect;
use App\Imports\ProdutoImport;
use Maatwebsite\Excel\Facades\Excel;
use App\Http\Requests\ProdutoRequest;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;


class ProdutoController extends Controller
{
    public function index()
    {
        $search = request('search');

        if ($search) {
            $produtos = Produto::where([
                ['ean', 'like', '%'.$search.'%']
            ])
            ->orWhere([
                ['descricao', 'like', '%'.$search.'%']
            ])
            ->orWhere([
                ['sku', 'like', '%'.$search.'%']
            ])
            ->simplePaginate(20);
        }else {
            $produtos = Produto::query()->simplePaginate(20);
        }

        return view('estoque.produto.index', compact('produtos', 'search'));
    }

    public function create()
    {
        $categorias = Categoria::query()->get();
        $zonas = Zona::query()->get();

        return view('estoque.produto.create', compact('categorias', 'zonas'));
    }

    public function store(ProdutoRequest $request, Criador $criarProduto)
    {
        DB::transaction(function () use ($criarProduto, $request){
            $criarProduto->criarProduto(
                $request->ean,
                $request->descricao,
                $request->sku,
                $request->categoria,
                $request->zona 
            );
        });
        
        return redirect('/produto');
    }

    public function edit(int $id)
    {
        $produto = Produto::findOrFail($id);
        $categorias = Categoria::query()->get();
        $zonas = Zona::query()->get();

        return view('estoque.produto.create', compact('produto', 'categorias', 'zonas'));
    }

    public function update(ProdutoRequest $request, int $id)
    {
        DB::transaction(function () use ($id, $request){
            Produto::findOrFail($id)->update([
                'ean' => $request->ean,
                'descricao' => $request->descricao,
                'sku' => $request->sku,
                'categoria_id' => intval($request->categoria),
                'zona_id' => intval($request->zona)
            ]);
        });
        
        return Redirect::to("/produto");
    }

    public function destroy(Removedor $remove, int $id)
    {
        DB::transaction(function () use ($id, $remove){
            $remove->removerProduto($id);
        });
        return Redirect::to("/produto");
    }

    public function busca()
    {
        return view('estoque.funcao.busca');
    }

    public function resultadoBusca(BuscaRequest $request, Funcao $funcao)
    {

        $filtro1 = $funcao->Filtrar($request->skus);        

        $resultados = $funcao->Separacao($filtro1);

        if (array_key_exists("resultado0", $resultados)==TRUE) {
            return view('estoque.funcao.resultadoBusca', compact('resultados'));
        }else {
            $NaoEncontrados = $resultados;
            return view('estoque.funcao.resultadoBusca', compact('NaoEncontrados'));
        }       
    }

    public function import(ImportProdutoRequest $request) 
    {
        Excel::import(new ProdutoImport,$request->file);
               
        return back();
    }

    public function export() 
    {
        return Excel::download(new ProdutoExport, 'produto.xlsx');
    }
}
