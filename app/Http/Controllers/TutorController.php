<?php

namespace App\Http\Controllers;

use App\Models\Tutor;
use Illuminate\Http\Request;

class TutorController extends Controller
{
    public function index()
    {
        $tutores = Tutor::all();
        return response()->json($tutores, 201);
    }
    public function store(Request $request)
    {
        $tutor = Tutor::create($request->all());
        return response()->json($tutor, 201);
    }
    public function show($id)
    {
        $tutor = Tutor::find($id);
        if (!$tutor) {
            return response()->json(['message' => 'Tutor not found'], 404);
        }
        return response()->json($tutor, 201);
    }
    public function update(Request $request, $id)
    {
        $tutor = Tutor::find($id);
        if (!$tutor) {
            return response()->json(['message' => 'Tutor not found'], 404);
        }
        $tutor->update($request->all());
        return response()->json($tutor, 201);
    }
    public function destroy($id)
    {
        $tutor = Tutor::find($id);
        if (!$tutor) {
            return response()->json(['message' => 'Tutor not found'], 404);
        }
        $tutor->delete();
        return response()->json(['message' => 'Tutor deleted'], 201);
    }
    public function search(Request $request)
    {
        $name = $request->input('name');
        $paginate = $request->input('paginate') ?? 10;

        $tutores = Tutor::query();
        if ($name) {
            $tutores->where('name', 'like', '%' . $name . '%');
        }
        $tutores = $tutores->paginate($paginate);
        return response()->json($tutores, 201);
    }
}
