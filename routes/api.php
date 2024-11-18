<?php

use App\Http\Controllers\ConversationController;
use App\Http\Controllers\EstudianteController;
use App\Http\Controllers\EstudianteSesionTutoriaController;
use App\Http\Controllers\MensajeController;
use App\Http\Controllers\ModuloController;
use App\Http\Controllers\NotificacionController;
use App\Http\Controllers\ParticipanteController;
use App\Http\Controllers\PrivilegioController;
use App\Http\Controllers\RolController;
use App\Http\Controllers\RolPrivilegioController;
use App\Http\Controllers\RolUserController;
use App\Http\Controllers\SesionTutoriaController;
use App\Http\Controllers\TutorController;
use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/users', [UserController::class, 'users']);
Route::post('/login', [UserController::class, 'login']);
Route::get('/user', [UserController::class, 'search']);
Route::get('/user/{id}', [UserController::class, 'show']);
Route::post('/user', [UserController::class, 'store']);
Route::post('/userupdate/{id}', [UserController::class, 'update']);
Route::delete('/user/{id}', [UserController::class, 'destroy']);
Route::put('/user/{id}/change-password', [UserController::class, 'changePassword']);

Route::get('/rol', [RolController::class, 'search']);
Route::get('/rol/{id}', [RolController::class, 'show']);
Route::post('/rol', [RolController::class, 'store']);
Route::put('/rol/{id}', [RolController::class, 'update']);
Route::delete('/rol/{id}', [RolController::class, 'destroy']);
Route::get('/rolwithusers/{id}', [RolController::class, 'rolWithUsers']);

Route::get('/modulo', [ModuloController::class, 'search']);
Route::get('/modulo/{id}', [ModuloController::class, 'show']);
Route::post('/modulo', [ModuloController::class, 'store']);
Route::put('/modulo/{id}', [ModuloController::class, 'update']);
Route::delete('/modulo/{id}', [ModuloController::class, 'destroy']);

Route::get('/privilegio', [PrivilegioController::class, 'search']);
Route::get('/privilegio/{id}', [PrivilegioController::class, 'show']);
Route::post('/privilegio', [PrivilegioController::class, 'store']);
Route::put('/privilegio/{id}', [PrivilegioController::class, 'update']);
Route::delete('/privilegio/{id}', [PrivilegioController::class, 'destroy']);
Route::get('/privilegiotipo', [PrivilegioController::class, 'tipePrivilegio']);

Route::get('/rolprivilegio', [RolPrivilegioController::class, 'search']);
Route::get('/rolprivilegio/{id}', [RolPrivilegioController::class, 'show']);
Route::post('/rolprivilegio', [RolPrivilegioController::class, 'store']);
Route::put('/rolprivilegio/{id}', [RolPrivilegioController::class, 'update']);
Route::delete('/rolprivilegio/{id}', [RolPrivilegioController::class, 'destroy']);

Route::get('/roluser', [RolUserController::class, 'search']);
Route::get('/roluser/{id}', [RolUserController::class, 'show']);
Route::get('/rolusername', [RolUserController::class, 'UserFromRolName']);
Route::post('/roluser', [RolUserController::class, 'store']);
Route::put('/roluser/{id}', [RolUserController::class, 'update']);
Route::delete('/roluser/{id}', [RolUserController::class, 'destroy']);

Route::get('/tutor', [TutorController::class, 'search']);
Route::get('/tutor/{id}', [TutorController::class, 'show']);
Route::post('/tutor', [TutorController::class, 'store']);
Route::put('/tutor/{id}', [TutorController::class, 'update']);
Route::delete('/tutor/{id}', [TutorController::class, 'destroy']);

Route::get('/estudiante', [EstudianteController::class, 'search']);
Route::get('/estudiante/{id}', [EstudianteController::class, 'show']);
Route::post('/estudiante', [EstudianteController::class, 'store']);
Route::put('/estudiante/{id}', [EstudianteController::class, 'update']);
Route::delete('/estudiante/{id}', [EstudianteController::class, 'destroy']);

Route::get('/sesiontutoria', [SesionTutoriaController::class, 'search']);
Route::get('/sesiontutoria/{id}', [SesionTutoriaController::class, 'show']);
Route::post('/sesiontutoria', [SesionTutoriaController::class, 'store']);
Route::put('/sesiontutoria/{id}', [SesionTutoriaController::class, 'update']);
Route::delete('/sesiontutoria/{id}', [SesionTutoriaController::class, 'destroy']);

Route::get('/estudiantesesiontutoria', [EstudianteSesionTutoriaController::class, 'search']);
Route::get('/estudiantesesiontutoria/{id}', [EstudianteSesionTutoriaController::class, 'show']);
Route::post('/estudiantesesiontutoria', [EstudianteSesionTutoriaController::class, 'store']);
Route::put('/estudiantesesiontutoria/{id}', [EstudianteSesionTutoriaController::class, 'update']);
Route::delete('/estudiantesesiontutoria/{id}', [EstudianteSesionTutoriaController::class, 'destroy']);

Route::get('/notificacion', [NotificacionController::class, 'search']);
Route::get('/notificacion/{id}', [NotificacionController::class, 'show']);
Route::post('/notificacion', [NotificacionController::class, 'store']);
Route::put('/notificacion/{id}', [NotificacionController::class, 'update']);
Route::delete('/notificacion/{id}', [NotificacionController::class, 'destroy']);