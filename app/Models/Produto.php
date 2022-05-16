<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\{Lote, Categoria, Zona};


class Produto extends Model
{
    use HasFactory;

    protected $table = 'produtos';

    protected $fillable = [
        'ean',
        'descricao',
        'sku',
        'categoria_id',
        'zona_id'
    ];

    public $timestamps = false;
    
    protected $guarded = [];

    public function lotes()
    {
        return $this->belongsToMany(Lote::class);
    }

    public function categoria()
    {
        return $this->belongsTo(Categoria::class);
    }

    public function zona()
    {
        return $this->belongsTo(Zona::class);
    }
}
