<?php

namespace App\Http\Controllers;

use App\Models\SesionTutoria;
use Illuminate\Http\Request;

class SesionTutoriaController extends Controller
{
    public function index()
    {
        $sesiones = SesionTutoria::all();
        return response()->json($sesiones, 201);
    }
    public function store(Request $request)
    {
        $sesion = SesionTutoria::create($request->all());
        return response()->json($sesion, 201);
    }
    public function show($id)
    {
        $sesion = SesionTutoria::find($id);
        if (!$sesion) {
            return response()->json(['message' => 'Sesion de tutoria no encontrada'], 404);
        }
        return response()->json($sesion, 201);
    }
    public function update(Request $request, $id)
    {
        $sesion = SesionTutoria::find($id);
        if (!$sesion) {
            return response()->json(['message' => 'Sesion de tutoria no encontrada'], 404);
        }
        $sesion->update($request->all());
        return response()->json($sesion, 201);
    }
    public function destroy($id)
    {
        $sesion = SesionTutoria::find($id);
        if (!$sesion) {
            return response()->json(['message' => 'Sesion de tutoria no encontrada'], 404);
        }
        $sesion->delete();
        return response()->json(['message' => 'Sesion de tutoria eliminada'], 201);
    }
    public function search(Request $request)
    {
        $name = $request->input('name');
        $paginate = $request->input('paginate') ?? 10;

        $sesiones = SesionTutoria::query();
        if ($name) {
            $sesiones->where('name', 'like', "%$name%");
        }
        $sesiones = $sesiones->paginate($paginate);
        return response()->json($sesiones, 201);
    }
}
