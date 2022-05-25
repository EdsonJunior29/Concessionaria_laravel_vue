<?php

namespace App\Http\Controllers;

use App\Models\Modelo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ModeloController extends Controller
{
    public function __construct(Modelo $modelo)
    {
        $this->modelo = $modelo;
    }

    public function index(Request $request)
    {
        $modelos = array();

        if ($request->has('atributos_marca')) {
            $atributos_marca = $request->atributos_marca;
            $modelos = $this->modelo->with('marca:id,'.$atributos_marca);
        } else {
            $modelos = $this->modelo->with('marca');
        }

        if ($request->has('filtro')) {
            $codicao = explode(':', $request->filtro);
            $modelos = $modelos->where($codicao[0], $codicao[1], $codicao[2]);
        }

        if ($request->has('atributos')) {
            $atributos = $request->atributos;
            $modelos = $modelos->selectRaw($atributos)->get();
        } else {
            $modelos = $modelos->get();
        }

        return response()->json($modelos, 200);
    }

    public function store(Request $request)
    {
        $request->validate($this->modelo->rules());

        $imagem = $request->file('imagem');
        $imagem_urn = $imagem->store('imagens/modelos', 'public');

        $modelo = $this->modelo->create([
            'marca_id' => $request->marca_id,
            'nome' => $request->nome,
            'imagem' => $imagem_urn,
            'numero_protas' => $request->numero_protas,
            'lugares' => $request->lugares,
            'air_bag' => $request->air_bag,
            'abs' => $request->abs
        ]);

        return response()->json($modelo, 201);
    }

    public function show(int $id)
    {
        $modelo = $this->modelo->with('marca')->find($id);
        if ($modelo === null) {
            return response()->json(['msg' => 'Marca não encontrada.'], 404);
        }
        return $modelo;
    }

    public function update(Request $request, int $id)
    {
        /*
         Para atualizar uma class que possui arquivo,
         temos que utilizar o método Post passando o id.
         E adicionar no body da requisição _method(key) put ou patch(value).
        */

        $modelo = $this->modelo->find($id);

        if ($modelo === null) {
            return response()->json(['msg' => 'Marca não encontrada.'], 404);
        }

        if ($request->method() === 'PATCH') {
            $regrasDinamicas = array();

            foreach ($modelo->rules() as $input => $regras) {
                if (array_key_exists($input, $request->all())) {
                    $regrasDinamicas[$input] = $regras;
                }
            }
        } else {
            $request->validate($modelo->rules());
        }

        /*
            Remove o arquivo antigo, caso um novo arquivo seja enviado no request.
        */
        if ($request->file('imagem')) {
            Storage::disk('public')->delete($modelo->imagem);
        }

        $imagem = $request->file('imagem');
        $imagem_urn = $imagem->store('imagens/modelos', 'public');

        $modelo->fill($request->all());
        $modelo->imagem = $imagem_urn;

        $modelo->save();

        return response()->json($modelo, 204);
    }

    public function destroy(int $id)
    {
        $modelo = $this->modelo->find($id);

        if ($modelo === null) {
            return response()->json(['msg' => 'Modelo não encontrada.'], 404);
        }

        //Removendo arquivo
        Storage::disk('public')->delete($modelo->imagem);

        $modelo->delete();
        return response()->json(['msg' => 'Modelo removida com sucesso.'], 204);
    }
}
