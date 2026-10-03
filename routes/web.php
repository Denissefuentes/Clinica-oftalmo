<?php

use App\Http\Controllers\PacienteController;
use App\Http\Controllers\DoctorController;
use App\Http\Controllers\CitaController;
use App\Http\Controllers\ExpedienteController;
use App\Http\Controllers\AntecedentesController;
use App\Http\Controllers\DatosAdicionalesController;
use App\Http\Controllers\ConsultaController;
use App\Http\Controllers\ExamenesController;
use App\Http\Controllers\AlineacionMotilidadOcularPediatricosController;
use App\Http\Controllers\ExploracionOftalmologicaController;
use App\Http\Controllers\TratamientosController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;

// Ruta principal que se muestra al iniciar el sistema
Route::get('/', function () {
    return redirect()->route('login');
});


// Rutas del módulo de pacientes.
// Requieren iniciar sesión y permiten el acceso
// a los tres roles definidos del sistema.
Route::middleware(['auth', 'role:admin,doctor,secretaria'])->group(function () {
    Route::resource('pacientes', PacienteController::class); //resource crea las rutas CRUD.
});


// Rutas del módulo de citas.
// Requieren iniciar sesión y permiten el acceso
// a los tres roles definidos del sistema.
Route::middleware(['auth', 'role:admin,doctor,secretaria'])->group(function () {

    // Esta ruta debe estar antes de Route::resource()
    // para que Laravel la reconozca como una ruta específica.
    Route::get('/citas/buscarPaciente', [CitaController::class, 'buscarPaciente'])
        ->name('citas.buscarPaciente');

    // Resource crea las rutas CRUD de citas.
    Route::resource('citas', CitaController::class);
});


// Rutas de doctores.
// Solo el administrador puede gestionar el módulo de doctores.
Route::middleware(['auth', 'role:admin'])->group(function () {

    // Resource crea las rutas CRUD de doctores.
    Route::resource('doctores', DoctorController::class)
        ->parameters(['doctores' => 'doctor']);

    // Permite cambiar el estado activo/inactivo de un doctor.
    Route::patch('doctores/{doctor}/estado', [DoctorController::class, 'cambiarEstado'])
        ->name('doctores.estado');
});


// Rutas de expedientes y antecedentes.
// Solo el administrador puede acceder a estos módulos.
Route::middleware(['auth', 'role:admin'])->group(function () {

    // Resource crea las rutas CRUD de expedientes.
    Route::resource('expedientes', ExpedienteController::class);

    // Resource crea las rutas CRUD de antecedentes.
    Route::resource('antecedentes', AntecedentesController::class);

    // Permite consultar los antecedentes de un expediente específico.
    Route::get(
        'expedientes/{expediente}/antecedentes',
        [ExpedienteController::class, 'antecedentes']
    )->name('expedientes.antecedentes');

    // Permite guardar los antecedentes de un expediente.
    Route::post(
        'expedientes/{expediente}/antecedentes',
        [ExpedienteController::class, 'guardarAntecedentes']
    )->name('expedientes.antecedentes.guardar');
});


// Rutas de datos adicionales.
// Solo el administrador puede acceder a esta información.
Route::middleware(['auth', 'role:admin'])->group(function () {

    // Muestra el formulario para registrar datos adicionales.
    Route::get(
        '/expedientes/{expediente}/datos_adicionales/create',
        [DatosAdicionalesController::class, 'create']
    )->name('datos_adicionales.create');

    // Guarda los datos adicionales del expediente.
    Route::post(
        '/expedientes/{expediente}/datos_adicionales',
        [DatosAdicionalesController::class, 'store']
    )->name('datos_adicionales.store');
});


// Rutas de consultas.
// Solo el administrador puede acceder a las consultas (Aqui no estoy seguro, el doctor no deberia tener acceso tambien?,
// si alguien lee esto, recuerdenme esta duda porque posiblemente se me olvide preguntar, att: Jesus).
// psdt: Tengo hambre y sueño, son las 2AM
Route::middleware(['auth', 'role:admin'])->group(function () {

    // Muestra el formulario para crear una consulta.
    Route::get(
        'expedientes/{expediente}/consultas/create',
        [ConsultaController::class, 'create']
    )->name('consultas.create');

    // Guarda una nueva consulta.
    Route::post(
        'expedientes/{expediente}/consultas',
        [ConsultaController::class, 'store']
    )->name('consultas.store');

    // Muestra una consulta específica.
    Route::get(
        'consultas/{consulta}',
        [ConsultaController::class, 'show']
    )->name('consultas.show');

    // Muestra las consultas asociadas a un expediente.
    Route::get(
        'expedientes/{expediente}/consultas',
        [ConsultaController::class, 'index']
    )->name('expedientes.consultas');

    // Muestra el formulario para editar una consulta.
    Route::get(
        'consultas/{consulta}/edit',
        [ConsultaController::class, 'edit']
    )->name('consultas.edit');

    // Actualiza una consulta existente.
    Route::put(
        'consultas/{consulta}',
        [ConsultaController::class, 'update']
    )->name('consultas.update');
});


// Rutas de exámenes.
// Solo el administrador puede acceder a los exámenes. (aqui tengo la misma inseguridad, el doc no tiene acceso a esto?)
Route::middleware(['auth', 'role:admin'])->group(function () {

    // Muestra el formulario para registrar un examen.
    Route::get(
        'consultas/{consulta}/examenes/create',
        [ExamenesController::class, 'create']
    )->name('examenes.create');

    // Guarda un nuevo examen.
    Route::post(
        'consultas/{consulta}/examenes',
        [ExamenesController::class, 'store']
    )->name('examenes.store');

    // Muestra el formulario para editar un examen.
    Route::get(
        '/examenes/{examen}/edit',
        [ExamenesController::class, 'edit']
    )->name('examenes.edit');

    // Actualiza un examen existente.
    Route::put(
        '/examenes/{examen}',
        [ExamenesController::class, 'update']
    )->name('examenes.update');
});


// Rutas de alineación y motilidad ocular pediátrica.
// Solo el administrador puede acceder a este módulo. (Siempre la misma duda con el acceso del doc)
Route::middleware(['auth', 'role:admin'])->group(function () {

    // Muestra el formulario para registrar la alineación y motilidad.
    Route::get(
        '/examenes/{id_examen}/alineacion-motilidad/create',
        [AlineacionMotilidadOcularPediatricosController::class, 'create']
    )->name('alineacion_motilidad.create');

    // Guarda la información de alineación y motilidad.
    Route::post(
        '/examenes/{id_examen}/alineacion-motilidad',
        [AlineacionMotilidadOcularPediatricosController::class, 'store']
    )->name('alineacion_motilidad.store');

    // Muestra el formulario para editar la información.
    Route::get(
        '/examenes/{id_examen}/alineacion-motilidad/edit',
        [AlineacionMotilidadOcularPediatricosController::class, 'edit']
    )->name('alineacion_motilidad.edit');

    // Actualiza la información de alineación y motilidad.
    Route::put(
        '/examenes/{id_examen}/alineacion-motilidad',
        [AlineacionMotilidadOcularPediatricosController::class, 'update']
    )->name('alineacion_motilidad.update');
});


// Rutas de exploración oftalmológica.
// Solo el administrador puede acceder a este módulo.
Route::middleware(['auth', 'role:admin'])->group(function () {

    // Muestra el formulario para registrar una exploración.
    Route::get(
        '/examenes/{id_examen}/exploracion-oftalmologica/create',
        [ExploracionOftalmologicaController::class, 'create']
    )->name('exploracion_oftalmologica.create');

    // Guarda la exploración oftalmológica.
    Route::post(
        '/examenes/{id_examen}/exploracion-oftalmologica',
        [ExploracionOftalmologicaController::class, 'store']
    )->name('exploracion_oftalmologica.store');

    // Muestra el formulario para editar la exploración.
    Route::get(
        '/examenes/{id_examen}/exploracion-oftalmologica/edit',
        [ExploracionOftalmologicaController::class, 'edit']
    )->name('exploracion_oftalmologica.edit');

    // Actualiza la exploración oftalmológica.
    Route::put(
        '/examenes/{id_examen}/exploracion-oftalmologica',
        [ExploracionOftalmologicaController::class, 'update']
    )->name('exploracion_oftalmologica.update');
});


// Rutas de tratamientos.
// Solo el administrador puede acceder a los tratamientos.(De igual manera los doc no tiene acceso a esto?)
Route::middleware(['auth', 'role:admin'])->group(function () {

    // Muestra el formulario para crear un tratamiento.
    Route::get(
        '/consultas/{id_consulta}/tratamiento/create',
        [TratamientosController::class, 'create']
    )->name('tratamientos.create');

    // Guarda un tratamiento.
    Route::post(
        '/consultas/{id_consulta}/tratamiento',
        [TratamientosController::class, 'store']
    )->name('tratamientos.store');

    // Muestra el formulario para editar un tratamiento.
    Route::get(
        '/consultas/{id_consulta}/tratamiento/edit',
        [TratamientosController::class, 'edit']
    )->name('tratamientos.edit');

    // Actualiza un tratamiento existente.
    Route::put(
        '/consultas/{id_consulta}/tratamiento',
        [TratamientosController::class, 'update']
    )->name('tratamientos.update');

    // Genera la receta asociada al tratamiento.
    Route::get(
        '/consultas/{id_consulta}/tratamiento/receta',
        [TratamientosController::class, 'receta']
    )->name('tratamientos.receta');

    // Genera la orden de exámenes asociada al tratamiento.
    Route::get(
        '/consultas/{id_consulta}/tratamiento/orden-examenes',
        [TratamientosController::class, 'ordenExamenes']
    )->name('tratamientos.orden_examenes');
});


// Rutas de autenticación.
// Estas rutas deben permanecer fuera del middleware "auth".
Route::view('/login', 'auth.login')->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.authenticate');

// Permite cerrar la sesión del usuario autenticado.
Route::post('/logout', [AuthController::class, 'logout'])
    ->name('logout')
    ->middleware('auth');


// Rutas para la gestión de usuarios.
// Solamente el administrador puede acceder a este módulo.
Route::middleware(['auth', 'role:admin'])->group(function () {

    // Muestra el formulario para registrar doctores y secretarias.
    Route::get('/usuarios/create', [UserController::class, 'create'])
        ->name('usuarios.create');

    // Guarda un nuevo doctor o secretaria.
    Route::post('/usuarios', [UserController::class, 'store'])
        ->name('usuarios.store');
});