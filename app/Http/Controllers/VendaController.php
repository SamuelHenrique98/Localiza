<?php

namespace App\Http\Controllers;

use App\Models\Venda;
use App\Imports\VendaImport;
use App\Exports\VendaExport;
use App\Http\Requests\VendaRequest;
use App\Services\Funcao;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;

class VendaController extends Controller
{
    public function index(Funcao $funcao)
    {
        $vendas = Venda::query()->get();

        $meses = $funcao->mes($vendas);
        
        return view("campanhas.vendas.index", compact('vendas', 'meses'));
    }

    public function export() 
    {
        return Excel::download(new VendaExport, 'Vendas.xlsx');
    }

    public function import(VendaRequest $request) 
    {
        DB::transaction(function (){
            $vendas = Venda::query()->get();
            foreach ($vendas as $venda) {
                $venda->delete();
            }
        });

        Excel::import(new VendaImport,$request->file);
               
        return back();
    }
}
