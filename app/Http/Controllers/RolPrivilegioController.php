<?php

namespace App\Http\Controllers;

use App\Models\RolPrivilegio;
use Illuminate\Http\Request;

class RolPrivilegioController extends Controller
{
    public function index()
    {
        $rolPrivilegios = RolPrivilegio::all();
        return response()->json($rolPrivilegios);
    }

    public function show($id)
    {
        $rolPrivilegio = RolPrivilegio::find($id);

        if (!$rolPrivilegio) {
            return response()->json(['message' => 'RolPrivilegio no encontrado'], 404);
        }

        return response()->json($rolPrivilegio);
    }

    public function store(Request $request)
    {
        $rolPrivilegio = RolPrivilegio::create($request->all());
        return response()->json($rolPrivilegio, 201);
    }

    public function update(Request $request, $id)
    {
        $rolPrivilegio = RolPrivilegio::find($id);

        if (!$rolPrivilegio) {
            return response()->json(['message' => 'RolPrivilegio no encontrado'], 404);
        }

        $rolPrivilegio->update($request->all());
        return response()->json($rolPrivilegio);
    }

    public function destroy($id)
    {
        $rolPrivilegio = RolPrivilegio::find($id);

        if (!$rolPrivilegio) {
            return response()->json(['message' => 'RolPrivilegio no encontrado'], 404);
        }

        $rolPrivilegio->delete();
        return response()->json(['message' => 'RolPrivilegio eliminado con éxito']);
    }

    public function search(Request $request)
    {
        $rolId = $request->input('form_rol_id');
        $privilegioId = $request->input('form_privilegio_id');
        $paginate = $request->input('paginate') ?? 10;

        $rolPrivilegios = RolPrivilegio::query();

        if ($rolId) {
            $rolPrivilegios->where('rol_id', $rolId);
        }

        if ($privilegioId) {
            $rolPrivilegios->where('privilegio_id', $privilegioId);
        }
        $rolPrivilegios->orderBy('id', 'desc');

        $rolPrivilegios = $rolPrivilegios->paginate($paginate);

        return response()->json($rolPrivilegios);
    }
}
