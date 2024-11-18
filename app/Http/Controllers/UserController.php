<?php

namespace App\Http\Controllers;

use App\Models\Privilegio;
use App\Models\RolUser;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    public function users(Request $request)
    {

        if ($request->has('active')) {
            $users = User::where('active', true)->get();
        } else {
            $users = User::all();
        }

        return response()->json($users);
    }

    public function login(Request $request)
    {
        $response = ["status" => false, "msg" => ""];
        $data = json_decode($request->getContent());

        $user = User::where('dni', $data->dni)->first();
        if (!$user) {
            $response["msg"] = "El correo electrónico no pertenece a ninguna cuenta.";
        } else {

            if ($user && Hash::check($data->password, $user->password)) {
                $token = $user->createToken("example");

                $response["status"] = true;
                $response["msg"] = "Usuario encontrado correctamente.";
                $response["token"] = $token->plainTextToken;
                $response["user_id"] = $user->dni;
                $response["user_name"] = $user->nombres;
                $response["user_email"] = $user->email;
                $response["user_avatar"] = $user->image;

                $userRoles = RolUser::query()->where('user_id', $user->id)
                    ->pluck('rol_id');

                $privileges = Privilegio::query()->join('rol_privilegios', 'privilegios.id', '=', 'rol_privilegios.privilegio_id')
                    ->whereIn('rol_privilegios.rol_id', $userRoles)
                    ->select('privilegios.id', 'privilegios.name', 'privilegios.code', 'privilegios.description', 'privilegios.type', 'privilegios.id_modulo', 'privilegios.created_at', 'privilegios.updated_at')
                    ->get();

                $uniquePrivileges = $privileges->unique('id')->values();
                $response["privilegios"] = $uniquePrivileges;
            } else {
                $response["msg"] = "Credenciales incorrectas.";
            }
        }

        return response()->json($response);
    }

    public function index()
    {
        $usuarios = User::all();
        return response()->json($usuarios);
    }

    public function store(Request $request)
    {
        $password = $request->input('password');

        $request->merge(['password' => Hash::make($password)]);
        $user = User::create($request->all());
        return response()->json($user, 201);
    }

    public function update(Request $request, $id)
    {

        $user = User::find($id);
        if (!$user) {
            return response()->json(['message' => 'Usuario no encontrado'], 404);
        }

        $user->update($request->all());
        return response()->json($user, 201);
    }

    public function destroy(Request $request, $id)
    {
        $user = User::find($id);

        if (!$user) {
            return response()->json(['message' => 'Usuario no encontrado'], 404);
        }

        $user->delete();
        return response()->json(['message' => 'Usuario eliminado con éxito']);
    }

    public function search(Request $request)
    {
        $name = $request->input('form_name');
        $ape_m = $request->input('form_ape_m');
        $ape_p = $request->input('form_ape_p');
        $dni = $request->input('form_dni');
        $phone = $request->input('form_phone');
        $email = $request->input('form_email');
        $paginate = $request->input('paginate') ?? 10;

        $users = User::query();

        if ($name) {
            $users->where('name', 'like', "%$name%");
        }
        if ($ape_m) {
            $users->where('ape_m', 'like', "%$ape_m%");
        }
        if ($ape_p) {
            $users->where('ape_p', 'like', "%$ape_p%");
        }
        if ($dni) {
            $users->where('dni', 'like', "%$dni%");
        }
        if ($phone) {
            $users->where('phone', 'like', "%$phone%");
        }
        if ($email) {
            $users->where('email', 'like', "%$email%");
        }

        $users = $users->paginate($paginate);

        return response()->json($users);
    }

    public function changePassword(Request $request, $id)
    {
        $user = User::find($id);

        if (!$user) {
            return response()->json(['message' => 'Usuario no encontrado'], 404);
        }

        $currentPassword = $request->input('current_password');

        // Validar la antigua contraseña
        if (!Hash::check($currentPassword, $user->password)) {
            return response()->json(['message' => 'La antigua contraseña no es válida'], 400);
        }

        $validator = Validator::make($request->all(), [
            'new_password' => 'required|string|min:8|confirmed',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 400);
        }

        // Actualizar la contraseña
        $user->password = Hash::make($request->input('new_password'));
        $user->save();

        return response()->json(['message' => 'Contraseña actualizada con éxito']);
    }
}
