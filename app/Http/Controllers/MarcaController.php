<?php

namespace App\Http\Controllers;

use App\Models\Marca;
use Illuminate\Http\Request;

class MarcaController extends Controller
{
    public function index()
    {
        $marca = Marca::get();
        return $marca;
    }

    public function store(Request $request)
    {
        $marca = Marca::create($request->all());
        return $marca;
    }

    public function show(Marca $marca)
    {
        return $marca;
    }

    public function update(Request $request, Marca $marca)
    {
        $marca->update($request->all());
        return $marca;
    }

    public function destroy(Marca $marca)
    {
        $marca->delete();
        return [
            'msg' => 'Marca foi removida com sucesso.'
        ];
    }
}
