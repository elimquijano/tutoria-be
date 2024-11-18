<?php

namespace App\Http\Controllers;

use App\Models\Estudiante_SesionTutoria;
use Illuminate\Http\Request;

class EstudianteSesionTutoriaController extends Controller
{
    public function index()
    {
        $estudianteSesionTutoria = Estudiante_SesionTutoria::all();
        return response()->json($estudianteSesionTutoria, 201);
    }
    public function store(Request $request)
    {
        $estudianteSesionTutoria = Estudiante_SesionTutoria::create($request->all());
        return response()->json($estudianteSesionTutoria, 201);
    }
    public function show($id)
    {
        $estudianteSesionTutoria = Estudiante_SesionTutoria::find($id);
        if (!$estudianteSesionTutoria) {
            return response()->json(['message' => 'Estudiante_SesionTutoria no encontrado'], 404);
        }
        return response()->json($estudianteSesionTutoria, 201);
    }
    public function update(Request $request, $id)
    {
        $estudianteSesionTutoria = Estudiante_SesionTutoria::find($id);
        if (!$estudianteSesionTutoria) {
            return response()->json(['message' => 'Estudiante_SesionTutoria no encontrado'], 404);
        }
        $estudianteSesionTutoria->update($request->all());
        return response()->json($estudianteSesionTutoria, 201);
    }
    public function destroy($id)
    {
        $estudianteSesionTutoria = Estudiante_SesionTutoria::find($id);
        if (!$estudianteSesionTutoria) {
            return response()->json(['message' => 'Estudiante_SesionTutoria no encontrado'], 404);
        }
        $estudianteSesionTutoria->delete();
        return response()->json(['message' => 'Estudiante_SesionTutoria eliminado'], 201);
    }
    public function search(Request $request)
    {
        $name = $request->input('name');
        $paginate = $request->input('paginate') ?? 10;

        $estudianteSesionTutoria = Estudiante_SesionTutoria::query();
        if ($name) {
            $estudianteSesionTutoria->where('name', 'like', "%$name%");
        }
        $estudianteSesionTutoria = $estudianteSesionTutoria->paginate($paginate);
        return response()->json($estudianteSesionTutoria, 201);
    }
}
