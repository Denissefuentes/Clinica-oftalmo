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

Route::get('/', function () {
    return view('welcome');
});

Route::resource('pacientes', PacienteController::class); //resource crea las rutas CRUD.
Route::resource('doctores',DoctorController::class)->parameters(['doctores'=>'doctor']);
Route::patch('doctores/{doctor}/estado',[DoctorController::class,'cambiarEstado'])->name('doctores.estado');
Route::get('/citas/buscarPaciente',[CitaController::class,'buscarPaciente'])->name('citas.buscarPaciente');
Route::resource('citas',CitaController::class);
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
Route::get('/examenes/{id_examen}/alineacion-motilidad/create',[AlineacionMotilidadOcularPediatricosController::class, 'create'])->name('alineacion_motilidad.create');
Route::post('/examenes/{id_examen}/alineacion-motilidad',[AlineacionMotilidadOcularPediatricosController::class, 'store'])->name('alineacion_motilidad.store');
Route::get('/examenes/{id_examen}/alineacion-motilidad/edit',[AlineacionMotilidadOcularPediatricosController::class, 'edit'])->name('alineacion_motilidad.edit');
Route::put('/examenes/{id_examen}/alineacion-motilidad',[AlineacionMotilidadOcularPediatricosController::class, 'update'])->name('alineacion_motilidad.update');
Route::get('/examenes/{id_examen}/exploracion-oftalmologica/create',[ExploracionOftalmologicaController::class, 'create'])->name('exploracion_oftalmologica.create');
Route::post('/examenes/{id_examen}/exploracion-oftalmologica',[ExploracionOftalmologicaController::class, 'store'])->name('exploracion_oftalmologica.store');
Route::get('/examenes/{id_examen}/exploracion-oftalmologica/edit',[ExploracionOftalmologicaController::class, 'edit'])->name('exploracion_oftalmologica.edit');
Route::put('/examenes/{id_examen}/exploracion-oftalmologica',[ExploracionOftalmologicaController::class, 'update'])->name('exploracion_oftalmologica.update');
Route::get('/consultas/{id_consulta}/tratamiento/create',[TratamientosController::class, 'create'])->name('tratamientos.create');
Route::post('/consultas/{id_consulta}/tratamiento',[TratamientosController::class, 'store'])->name('tratamientos.store');
Route::get('/consultas/{id_consulta}/tratamiento/edit',[TratamientosController::class, 'edit'])->name('tratamientos.edit');
Route::put('/consultas/{id_consulta}/tratamiento',[TratamientosController::class, 'update'])->name('tratamientos.update');
Route::get('/consultas/{id_consulta}/tratamiento/receta',[TratamientosController::class, 'receta'])->name('tratamientos.receta');
Route::get('/consultas/{id_consulta}/tratamiento/orden-examenes',[TratamientosController::class, 'ordenExamenes'])->name('tratamientos.orden_examenes');