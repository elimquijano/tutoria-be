<?php

namespace App\Http\Controllers;

use App\Models\Privilegio;
use Illuminate\Http\Request;

class PrivilegioController extends Controller
{
    public function index()
    {
        $privilegios = Privilegio::all();
        return response()->json($privilegios);
    }

    public function show($id)
    {
        $privilegio = Privilegio::find($id);

        if (!$privilegio) {
            return response()->json(['message' => 'Privilegio no encontrado'], 404);
        }

        return response()->json($privilegio);
    }

    public function store(Request $request)
    {
        $privilegio = Privilegio::create($request->all());
        return response()->json($privilegio, 201);
    }

    public function update(Request $request, $id)
    {
        $privilegio = Privilegio::find($id);

        if (!$privilegio) {
            return response()->json(['message' => 'Privilegio no encontrado'], 404);
        }

        $privilegio->update($request->all());
        return response()->json($privilegio);
    }

    public function destroy($id)
    {
        $privilegio = Privilegio::find($id);

        if (!$privilegio) {
            return response()->json(['message' => 'Privilegio no encontrado'], 404);
        }

        $privilegio->delete();
        return response()->json(['message' => 'Privilegio eliminado con éxito']);
    }

    public function search(Request $request)
    {
        $name = $request->input('form_name');
        $code = $request->input('form_code');
        $description = $request->input('form_description');
        $type = $request->input('form_type');
        $idModulo = $request->input('form_id_modulo');
        $rolId = $request->input('id_rol');
        $rolIn = $request->input('rol_in');
        $paginate = $request->input('paginate') ?? 10;

        if ($rolId) {
            if ($rolIn) {
                $privilegios = Privilegio::query()
                    ->select('privilegios.*')
                    ->join('rol_privilegios as rp', 'privilegios.id', '=', 'rp.privilegio_id')
                    ->where('rp.rol_id', $rolId);
            } else {
                $privilegios = Privilegio::query()
                    ->select('privilegios.*')
                    ->whereNotIn('id', function ($query) use ($rolId) {
                        $query->select('privilegio_id')
                            ->from('rol_privilegios')
                            ->where('rol_id', $rolId);
                    });
            }
        } else {
            $privilegios = Privilegio::query();
        }

        if ($name) {
            $privilegios->where('name', 'like', "%$name%");
        }

        if ($code) {
            $privilegios->where('code', 'like', "%$code%");
        }

        if ($description) {
            $privilegios->where('description', 'like', "%$description%");
        }

        if ($type) {
            $privilegios->where('type', $type);
        }

        if ($idModulo) {
            $privilegios->where('id_modulo', $idModulo);
        }
        $privilegios->orderBy('id', 'desc');

        $privilegios = $privilegios->paginate($paginate);

        return response()->json($privilegios);
    }
    public function tipePrivilegio()
    {
        $response = [
            ['id' => 'BTN', 'name' => 'Boton'],
            ['id' => 'MOD', 'name' => 'Modulo'],
            ['id' => 'LOC', 'name' => 'Local'],
            ['id' => 'PAG', 'name' => 'Pagina'],
        ];

        return response()->json($response);
    }
}
