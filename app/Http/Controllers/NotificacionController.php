<?php

namespace App\Http\Controllers;

use App\Models\Notificacion;
use Illuminate\Http\Request;

class NotificacionController extends Controller
{
    public function index()
    {
        $notificaciones = Notificacion::all();
        return response()->json($notificaciones, 201);
    }
    public function store(Request $request)
    {
        $notificacion = Notificacion::create($request->all());
        return response()->json($notificacion, 201);
    }
    public function show($id)
    {
        $notificacion = Notificacion::find($id);
        if (!$notificacion) {
            return response()->json(['message' => 'Notificacion no encontrada'], 404);
        }
        return response()->json($notificacion, 201);
    }
    public function update(Request $request, $id){
        $notificacion = Notificacion::find($id);
        if (!$notificacion) {
            return response()->json(['message' => 'Notificacion no encontrada'], 404);
        }
        $notificacion->update($request->all());
        return response()->json($notificacion, 201);
    }
    public function destroy($id){
        $notificacion = Notificacion::find($id);
        if (!$notificacion) {
            return response()->json(['message' => 'Notificacion no encontrada'], 404);
        }
        $notificacion->delete();
        return response()->json(['message' => 'Notificacion eliminada'], 201);
    }
}
