<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\{Produto};

class Lote extends Model
{
    use HasFactory;

    protected $table = 'lotes';

    protected $guarded = [];

    public function produtos()
    {
        return $this->belongsToMany(Produto::class);
    }
}
