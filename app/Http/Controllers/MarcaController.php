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
        return response()->json($marcas, 200);
    }

    public function store(Request $request)
    {
        $regras = [
            'nome' => 'required|unique:marcas',
            'imagem' => 'required'
        ];

        $feedback = [
            'required' => 'O campo :atribute é obrigatório.',
            'nome.unique' => 'O nome da marca já existe.'
        ];

        $request->validate($regras, $feedback);

        $marcas = $this->marca->create($request->all());
        return response()->json($marcas, 201);
    }

    public function show(int $id)
    {
        $marca = $this->marca->find($id);
        if ($marca === null) {
            return response()->json(['msg' => 'Marca não encontrada.'], 404);
        }
        return $marca;
    }

    public function update(Request $request, int $id)
    {
        $marca = $this->marca->find($id);
        if ($marca === null) {
            return response()->json(['msg' => 'Marca não encontrada.'], 404);
        }
        $marca->update($request->all());
        return response()->json($marca, 204);
    }

    public function destroy(int $id)
    {
        $marca = $this->marca->find($id);
        if ($marca === null) {
            return response()->json(['msg' => 'Marca não encontrada.'], 404);
        }
        $marca->delete();
        return response()->json(['msg' => 'Marca removida com sucesso.'], 204);
    }
}
