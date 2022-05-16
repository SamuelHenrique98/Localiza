<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\{Venda, ItensCampanha};

class Campanha extends Model
{
    use HasFactory;

    protected $table = 'campanhas';

    protected $fillable = [
            'nome',
            'canal',
            'data_inicial',
            'data_final'
    ];

    public $timestamps = false;
    
    protected $guarded = [];

    public function vendas()
    {
        return $this->hasMany(Venda::class);
    }

    public function itens()
    {
        return $this->hasMany(ItensCampanha::class);
    }
}
