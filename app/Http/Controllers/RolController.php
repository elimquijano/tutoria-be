<?php

namespace App\Http\Controllers;

use App\Models\Rol;
use Illuminate\Http\Request;

class RolController extends Controller
{
    public function index()
    {
        $roles = Rol::all();
        return response()->json($roles);
    }

    public function show($id)
    {
        $rol = Rol::find($id);

        if (!$rol) {
            return response()->json(['message' => 'Rol no encontrado'], 404);
        }

        return response()->json($rol);
    }

    public function store(Request $request)
    {
        $rol = Rol::create($request->all());
        return response()->json($rol, 201);
    }

    public function update(Request $request, $id)
    {
        $rol = Rol::find($id);

        if (!$rol) {
            return response()->json(['message' => 'Rol no encontrado'], 404);
        }

        $rol->update($request->all());
        return response()->json($rol);
    }

    public function destroy($id)
    {
        $rol = Rol::find($id);

        if (!$rol) {
            return response()->json(['message' => 'Rol no encontrado'], 404);
        }

        $rol->delete();
        return response()->json(['message' => 'Rol eliminado con éxito']);
    }
    public function search(Request $request)
    {
        $name = $request->input('form_name');
        $code = $request->input('form_code');
        $UserId = $request->input('id_user');
        $rolIn = $request->input('rol_in');
        $paginate = $request->input('paginate') ?? 10;

        if ($UserId) {
            if ($rolIn) {
                $roles = Rol::select('rols.*')
                    ->join('rol_users as rp', 'rols.id', '=', 'rp.rol_id')
                    ->where('rp.user_id', $UserId);
            } else {
                $roles = Rol::select('rols.*')
                    ->whereNotIn('id', function ($query) use ($UserId) {
                        $query->select('rol_id')
                            ->from('rol_users')
                            ->where('user_id', $UserId);
                    });
            }
        } else {
            $roles = Rol::query();
        }

        if ($name) {
            $roles->where('name', 'like', "%$name%");
        }
        if ($code) {
            $roles->where('code', 'like', "%$code%");
        }
        $roles->orderBy('id', 'desc');

        $roles = $roles->paginate($paginate);

        return response()->json($roles);
    }

    public function rolWithUsers($id)
    {
        $rol = Rol::with('users')->find($id);
        if (!$rol) {
            return response()->json(["messaje" => "No se encontró el rol"], 404);
        }
        return response()->json($rol, 201);
    }
}
