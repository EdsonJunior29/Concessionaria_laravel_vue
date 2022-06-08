<?php

namespace App\Repositories;

use Illuminate\Database\Eloquent\Model;

abstract class AbstractRepository
{
    public function __construct($model)
    {
        $this->model = $model;
    }

    public function selectAtributosRegistrosRelacionados(string $atributos)
    {
        $this->model = $this->model->with($atributos);
    }

    public function filtro(string $filtros)
    {
        $filtros = explode(';', $filtros);
        foreach ($filtros as $key => $condicoes) {
            $m = explode(':', $condicoes);
            $this->model = $this->model->where($m[0], $m[1], $m[2]);
        }
    }

    public function selectAtributos(string $atributos)
    {
        $this->model = $this->model->selectRaw($atributos);
    }

    public function getResultado()
    {
        return $this->model->get();
    }

    public function getResultadoPaginado(int $numeroDePagina)
    {
        return $this->model->paginate($numeroDePagina);
    }
}
