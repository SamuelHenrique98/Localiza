<?php

namespace App\Http\Controllers;

use App\Models\Campanha;

class ItensCampanhaController extends Controller
{
    public function index($id)
    {
        $campanha = Campanha::findOrFail($id);
        $itens = $campanha->itens;

        return view("campanhas.campanha.itens", compact('itens'));
    }
}
