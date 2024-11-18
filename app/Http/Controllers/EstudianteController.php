<?php

namespace App\Http\Controllers;

use App\Models\Estudiante;
use Illuminate\Http\Request;

class EstudianteController extends Controller
{
    public function index()
    {
        $estudiantes = Estudiante::all();
        return response()->json($estudiantes, 201);
    }
    public function store(Request $request)
    {
        $estudiante = Estudiante::create($request->all());
        return response()->json($estudiante, 201);
    }
    public function show($id)
    {
        $estudiante = Estudiante::find($id);
        if (!$estudiante) {
            return response()->json(['message' => 'Estudiante no encontrado'], 404);
        }
        return response()->json($estudiante, 201);
    }
    public function update(Request $request, $id)
    {
        $estudiante = Estudiante::find($id);
        if (!$estudiante) {
            return response()->json(['message' => 'Estudiante no encontrado'], 404);
        }
        $estudiante->update($request->all());
        return response()->json($estudiante, 201);
    }
    public function destroy($id)
    {
        $estudiante = Estudiante::find($id);
        if (!$estudiante) {
            return response()->json(['message' => 'Estudiante no encontrado'], 404);
        }
        $estudiante->delete();
        return response()->json(['message' => 'Estudiante eliminado'], 201);
    }
    public function search(Request $request)
    {
        $name = $request->input('name');
        $paginate = $request->input('paginate') ?? 10;

        $estudiantes = Estudiante::query();
        if ($name) {
            $estudiantes->where('nombre', 'like', "%$name%");
        }
        $estudiantes = $estudiantes->paginate($paginate);
        return response()->json($estudiantes, 201);
    }
}
