<?php

namespace App\Http\Controllers;

use App\Models\Marca;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

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
        $request->validate($this->marca->rules(), $this->marca->feedback());

        $imagem = $request->file('imagem');
        $imagem_urn = $imagem->store('imagens', 'public');

        $marcas = $this->marca->create([
            'nome' => $request->nome,
            'imagem' => $imagem_urn
        ]);

        return response()->json($marcas, 201);
    }

    public function show(int $id)
    {
        $marca = $this->marca->with('modelos')->find($id);
        if ($marca === null) {
            return response()->json(['msg' => 'Marca não encontrada.'], 404);
        }
        return $marca;
    }

    public function update(Request $request, int $id)
    {
        /*
         Para atualizar uma class que possui arquivo,
         temos que utilizar o método Post passando o id.
         E adicionar no body da requisição _method(key) put ou patch(value).
        */

        $marca = $this->marca->find($id);

        if ($marca === null) {
            return response()->json(['msg' => 'Marca não encontrada.'], 404);
        }

        if ($request->method() === 'PATCH') {
            $regrasDinamicas = array();

            foreach ($marca->rules() as $input => $regras) {
                if (array_key_exists($input, $request->all())) {
                    $regrasDinamicas[$input] = $regras;
                }
            }
        } else {
            $request->validate($marca->rules(), $marca->feedback());
        }

        /*
            Remove o arquivo antigo, caso um novo arquivo seja enviado no request.
        */
        if ($request->file('imagem')) {
            Storage::disk('public')->delete($marca->imagem);
        }

        $imagem = $request->file('imagem');
        $imagem_urn = $imagem->store('imagens', 'public');

        $marca->update([
            'nome' => $request->nome,
            'imagem' => $imagem_urn
        ]);

        return response()->json($marca, 204);
    }

    public function destroy(int $id)
    {
        $marca = $this->marca->find($id);

        if ($marca === null) {
            return response()->json(['msg' => 'Marca não encontrada.'], 404);
        }

        Storage::disk('public')->delete($marca->imagem);

        $marca->delete();
        return response()->json(['msg' => 'Marca removida com sucesso.'], 204);
    }
}
