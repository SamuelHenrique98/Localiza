<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Zona;

class Estoque extends Model
{
    use HasFactory;

    protected $fillable = [
        'numero'
    ];

    public $timestamps = false;

    protected $guarded = [];

    public function zonas()
    {
        return $this->hasMany(Zona::class);
    }
}
