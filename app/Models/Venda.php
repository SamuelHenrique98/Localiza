<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\{Campanha};

class Venda extends Model
{
    use HasFactory;

    protected $table = 'vendas';

    protected $fillable = [
        'ean',            
        'produto',
        'pedido',
        'sku',
        'marca',
        'quant',
        'canal',
        'data', 
        'campanha_id'
    ];

    public $timestamps = false;
    
    protected $guarded = [];

    public function campanha()
    {
        return $this->belongsTo(Campanha::class);
    }
}
