<?php

namespace App\Models;

use Hamcrest\Description;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class categoria extends Model
{
    use HasFactory;
    protected $fillable = [
        'nome',
        'description',
        'preco',
        'marca',
        'cor',
        'estado' ,
        'categoria',

        

    ];

    public function detalhe(): HasOne
    {
        return $this->hasOne(detalhe::class);

    }

    
}
