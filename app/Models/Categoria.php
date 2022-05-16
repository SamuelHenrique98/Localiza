<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\{Zona, Produto};

class Categoria extends Model
{
    use HasFactory;

    protected $table = 'categorias';

    protected $fillable = [
        'categoria'
    ];

    public $timestamps = false;

    protected $guarded = [];

    public function zonas()
    {
        return $this->belongsToMany(Zona::class);
    }

    public function produtos()
    {
        return $this->hasMany(Produto::class);
    }
}
