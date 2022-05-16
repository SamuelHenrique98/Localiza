<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\{Campanha};

class ItensCampanha extends Model
{
    use HasFactory;

    protected $table = 'itens_campanha';

    protected $fillable = [
            'sku',  
            'produto',
            'campanha_id'
    ];

    public $timestamps = false;
    
    protected $guarded = [];

    public function campanha()
    {
        return $this->belongsTo(Campanha::class);
    }
}
