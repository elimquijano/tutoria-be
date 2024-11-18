<?php

namespace App\Http\Controllers;

use App\Models\RolUser;
use Illuminate\Http\Request;

class RolUserController extends Controller
{
    public function index()
    {
        $rolUsers = RolUser::all();
        return response()->json($rolUsers);
    }

    public function show($id)
    {
        $rolUser = RolUser::find($id);

        if (!$rolUser) {
            return response()->json(['message' => 'RolUser no encontrado'], 404);
        }

        return response()->json($rolUser);
    }

    public function store(Request $request)
    {
        $rolUser = RolUser::create($request->all());
        return response()->json($rolUser, 201);
    }

    public function update(Request $request, $id)
    {
        $rolUser = RolUser::find($id);

        if (!$rolUser) {
            return response()->json(['message' => 'RolUser no encontrado'], 404);
        }

        $rolUser->update($request->all());
        return response()->json($rolUser);
    }

    public function destroy($id)
    {
        $rolUser = RolUser::find($id);

        if (!$rolUser) {
            return response()->json(['message' => 'RolUser no encontrado'], 404);
        }

        $rolUser->delete();
        return response()->json(['message' => 'RolUser eliminado con éxito']);
    }

    public function search(Request $request)
    {
        $user_id = $request->input('form_user_id');
        $rol_id = $request->input('form_rol_id');
        $paginate = $request->input('paginate') ?? 10;

        $rolUsers = RolUser::query();

        if ($user_id) {
            $rolUsers->where('user_id', $user_id);
        }
        if ($rol_id) {
            $rolUsers->where('rol_id', $rol_id);
        }
        $rolUsers->orderBy('id', 'desc');

        $rolUsers = $rolUsers->paginate($paginate);

        return response()->json($rolUsers);
    }

    public function UserFromRolName(Request $request)
    {
        $form_name = $request->input('form_name');
        if (!$form_name) {
            return response()->json(['message' => "El campo nombre es necesario"], 404);
        }
        $rolUser = RolUser::query()
            ->join('rols', 'rol_id', '=', 'rols.id')
            ->where('rols.name', 'like', "%$form_name%")
            ->first();

        return response()->json($rolUser, 201);
    }
}
