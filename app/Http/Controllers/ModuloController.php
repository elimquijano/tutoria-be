<?php

namespace App\Http\Controllers;

use App\Models\Modulo;
use Illuminate\Http\Request;

class ModuloController extends Controller
{
    public function index()
    {
        $modulos = Modulo::all();
        return response()->json($modulos);
    }

    public function show($id)
    {
        $modulo = Modulo::find($id);

        if (!$modulo) {
            return response()->json(['message' => 'Módulo no encontrado'], 404);
        }

        return response()->json($modulo);
    }

    public function store(Request $request)
    {
        $modulo = Modulo::create($request->all());
        return response()->json($modulo, 201);
    }

    public function update(Request $request, $id)
    {
        $modulo = Modulo::find($id);

        if (!$modulo) {
            return response()->json(['message' => 'Módulo no encontrado'], 404);
        }

        $modulo->update($request->all());
        return response()->json($modulo);
    }

    public function destroy($id)
    {
        $modulo = Modulo::find($id);

        if (!$modulo) {
            return response()->json(['message' => 'Módulo no encontrado'], 404);
        }

        $modulo->delete();
        return response()->json(['message' => 'Módulo eliminado con éxito']);
    }

    public function search(Request $request)
    {
        $name = $request->input('form_name');
        $description = $request->input('form_description');
        $code = $request->input('form_code');
        $route = $request->input('form_route');
        $paginate = $request->input('paginate') ?? 10;

        $modulos = Modulo::query();

        if ($name) {
            $modulos->where('name', 'like', "%$name%");
        }
        if ($description) {
            $modulos->where('description', 'like', "%$description%");
        }
        if ($code) {
            $modulos->where('code', 'like', "%$code%");
        }
        if ($route) {
            $modulos->where('route', 'like', "%$route%");
        }
        $modulos->orderBy('id', 'desc');

        $modulos = $modulos->paginate($paginate);

        return response()->json($modulos);
    }
}
