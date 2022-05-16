<?php

namespace App\Http\Controllers;

use App\Models\Campanha;
use App\Imports\CampanhaImport;
use App\Exports\CampanhaExport;
use App\Exports\ResultadoExport;
use App\Http\Requests\CampanhaRequest;
use App\Services\Criador;
use App\Services\Funcao;
use App\Services\Removedor;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redirect;
use Maatwebsite\Excel\Facades\Excel;

class CampanhaController extends Controller
{
    public function index()
    {
        $campanhas = Campanha::query()->simplePaginate(20);

        return view("campanhas.campanha.index", compact('campanhas'));
    }

    public function create()
    {
        return view("campanhas.campanha.create");
    }

    public function store(Criador $criarCampanha, CampanhaRequest $request)
    {
        DB::transaction(function () use ($criarCampanha, $request){
            $criarCampanha->criarCampanha(
                $request->nome,
                $request->canal,
                $request->inicial,
                $request->final
            );

            $this->import(request()->file('file'));
        }); 
        
        return redirect('/campanha');
    }

    public function destroy(Removedor $remove, int $id)
    {
        DB::transaction(function () use ($remove, $id){
            $remove->removerCampanha($id);
        }); 
        
        return Redirect::to("/campanha");
    }

    public function export() 
    {
        return Excel::download(new CampanhaExport, 'Campanha.xlsx');
    }

    public function import($file) 
    {
        Excel::import(new CampanhaImport,$file);
    }

    public function vendasCampanha(Funcao $funcao, $mes, ResultadoExport $resultadoExport)
    {
        $data = $funcao->vendasMes($mes);
        $datas = explode(',', $data);
        $inicio = $datas[0];
        $final = $datas[1];

        $vendaSemCamp = DB::table('vendas')->where([
            ['data', '>=', $inicio],
            ['data', '<=', $final],
            ['campanha_id', '=', null] 
        ])->orderBy('sku')
        ->get();

        $vendaComCamp = DB::table('vendas')->where([
            ['data', '>=', $inicio],
            ['data', '<=', $final],
            ['campanha_id', '<>', null] 
        ])->orderBy('sku')
        ->get();

        $SemCamp = $funcao->filtroCampanha($vendaSemCamp);

        $ComCamp = $funcao->filtroCampanha($vendaComCamp);

        $canalComCamp = $funcao->canalCampanha($vendaComCamp);

        arsort($SemCamp);

        arsort($ComCamp);

        foreach ($canalComCamp as $canal) {
            foreach ($ComCamp as $com) {
                foreach ($com as $key => $value) {
                    if ($value == $canal) {
                        $resultado[$canal][] = $com;
                    }
                }  
            }
        }

        return view("campanhas.campanha.resultado", compact('mes', 'resultado', 'SemCamp', 'ComCamp', 'canalComCamp'));
    }

    // public function exportResultado() 
    // {
    //     return Excel::download(new ResultadoExport, 'resultado.xlsx');
    // }

}
