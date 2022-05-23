<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Marca extends Model
{
    use HasFactory;

    protected $fillable = [
        'nome',
        'imagem'
    ];

    public function modelos()
    {
        return $this->hasMany(Modelo::class);
    }

    public function rules()
    {
        return [
            'nome' => 'required|unique:marcas,nome,'.$this->id.'|min:3',
            'imagem' => 'required'
        ];
    }

    public function feedback()
    {
        return [
            'required' => 'O campo :atribute é obrigatório.',
            'nome.unique' => 'O nome da marca já existe.',
            'nome.min' => 'O nome deve conter mais de 3 caracteres.'
        ];
    }
}
