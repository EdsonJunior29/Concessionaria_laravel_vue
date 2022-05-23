<?php

namespace App\Http\Controllers;

use App\Models\Marca;
use Illuminate\Http\Request;

class MarcaController extends Controller
{

    public function __construct(Marca $marca)
    {
        $this->marca = $marca;
    }

    public function index()
    {
        $marcas = $this->marca->all();
        return $marcas;
    }

    public function store(Request $request)
    {
        $marcas = $this->marca->create($request->all());
        return $marcas;
    }

    public function show(int $id)
    {
        $marca = $this->marca->find($id);
        return $marca;
    }

    public function update(Request $request, int $id)
    {
        $marca = $this->marca->find($id);
        $marca->update($request->all());
        return $marca;
    }

    public function destroy(int $id)
    {
        $marca = $this->marca->find($id);
        $marca->delete();
        return [
            'msg' => 'Marca foi removida com sucesso.'
        ];
    }
}
