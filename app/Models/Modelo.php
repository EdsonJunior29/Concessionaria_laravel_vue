<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Modelo extends Model
{
    use HasFactory;


    protected $fillable = [
        'marca_id',
        'nome',
        'imagem',
        'numero_protas',
        'lugares',
        'air_bag',
        'abs'
    ];

    public function marca()
    {
        return $this->belongsTo(Marca::class);
    }

    public function carros()
    {
        return $this->hasMany(Carro::class);
    }

    public function rules()
    {
        return [
            'marca_id' => 'exists:marcas,id',
            'nome' => 'required|unique:modelos,nome,'.$this->id.'|min:3',
            'imagem' => 'required|file|mimes:png,jpeg,jpg',
            'numero_protas' => 'required|integer|digits_between:1,5',
            'lugares' => 'required|integer|digits_between:1,7',
            'air_bag' => 'required|boolean',
            'abs' => 'required|boolean'
        ];
    }
}
