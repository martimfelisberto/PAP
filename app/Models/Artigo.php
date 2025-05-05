<?php

namespace App\Models;
use App\Models\User;


use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;




class Artigo extends Model
{
    use HasFactory;

    protected $fillable = [
        'nome',
        'descricao',
        'preco',
        'marca',
        'categoria',
        'estado',
        'tamanho',
        'cores',
        'imagem',
        'destaque',
        'genero',
    ];
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}