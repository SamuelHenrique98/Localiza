<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\{Estoque, Categoria};

class Zona extends Model
{
    use HasFactory;

    protected $table = 'zonas';

    protected $fillable = [
        'zona'
    ];

    public $timestamps = false;

    protected $guarded = [];

    public function estoque()
    {
        return $this->belongsTo(Estoque::class);
    }

    public function categorias()
    {
        return $this->belongsToMany(Categoria::class);
    }

    public function produtos()
    {
        return $this->hasMany(Produto::class);
    }
}
