<?php
use App\Http\Controllers\PacienteController;
use App\Http\Controllers\DoctorController;
use App\Http\Controllers\CitaController;
use App\Http\Controllers\ExpedienteController;
use App\Http\Controllers\AntecedentesController;
use App\Http\Controllers\DatosAdicionalesController;
use App\Http\Controllers\ConsultaController;
use App\Http\Controllers\ExamenesController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;


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
    Route::resource('citas', CitaController::class);
});

// Ruta utilizada para buscar pacientes desde el módulo de citas.
// Requiere iniciar sesión y permite los tres roles autorizados.
Route::middleware(['auth', 'role:admin,doctor,secretaria'])->group(function () {
    Route::get('/citas/buscarPaciente', [CitaController::class, 'buscarPaciente'])
        ->name('citas.buscarPaciente');
});




    Route::resource('doctores',DoctorController::class)->parameters(['doctores'=>'doctor']);
    Route::patch('doctores/{doctor}/estado',[DoctorController::class,'cambiarEstado'])->name('doctores.estado');
    
    
    Route::resource('expedientes',ExpedienteController::class);
    Route::resource('antecedentes',AntecedentesController::class);
    Route::get('expedientes/{expediente}/antecedentes',[ExpedienteController::class, 'antecedentes'])->name('expedientes.antecedentes');
    Route::post('expedientes/{expediente}/antecedentes',[ExpedienteController::class, 'guardarAntecedentes'])->name('expedientes.antecedentes.guardar');
    Route::get('/expedientes/{expediente}/datos_adicionales/create', [DatosAdicionalesController::class, 'create'])->name('datos_adicionales.create');
    Route::post('/expedientes/{expediente}/datos_adicionales',[DatosAdicionalesController::class, 'store'])->name('datos_adicionales.store');
    Route::get('expedientes/{expediente}/consultas/create',[ConsultaController::class, 'create'])->name('consultas.create');
    Route::post('expedientes/{expediente}/consultas',[ConsultaController::class, 'store'])->name('consultas.store');
    Route::get('consultas/{consulta}',[ConsultaController::class, 'show'])->name('consultas.show');
    Route::get('expedientes/{expediente}/consultas',[ConsultaController::class, 'index'])->name('expedientes.consultas');
    Route::get('consultas/{consulta}/edit',[ConsultaController::class, 'edit'])->name('consultas.edit');
    Route::put('consultas/{consulta}',[ConsultaController::class, 'update'])->name('consultas.update');
    Route::get('consultas/{consulta}/examenes/create',[ExamenesController::class, 'create'])->name('examenes.create');
    Route::post('consultas/{consulta}/examenes',[ExamenesController::class, 'store'])->name('examenes.store');
    Route::get('/examenes/{examen}/edit', [ExamenesController::class, 'edit'])->name('examenes.edit');
    Route::put('/examenes/{examen}', [ExamenesController::class, 'update'])->name('examenes.update');



Route::view('/login', 'auth.login')->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.authenticate');



