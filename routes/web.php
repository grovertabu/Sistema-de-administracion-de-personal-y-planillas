<?php
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\inicioControl;
use App\Http\Controllers\AsignacionCargoController;
use App\Http\Controllers\PlanillaAsistenciaController;
use App\Http\Controllers\PlanillaBonoAntiguedadController;
use App\Http\Controllers\PlanillaHorasExtraController;
use App\Http\Controllers\CargoController;
use App\Http\Controllers\ConfAporteController;
use App\Http\Controllers\ConfBonoAntiguedadController;
use App\Http\Controllers\ConfHorasExtraController;
use App\Http\Controllers\ConfImpositivaController;
use App\Http\Controllers\ConfOtroDescuentoController;
use App\Http\Controllers\CursoController;
use App\Http\Controllers\DemeritoController;
use App\Http\Controllers\DocumentoPersonalController;
use App\Http\Controllers\EscalaSalarialController;
use App\Http\Controllers\EstructuraOrganizacionalController;
use App\Http\Controllers\ExperienciaLaboralController;
use App\Http\Controllers\FormacionAcademicaController;
use App\Http\Controllers\MeritoController;
use App\Http\Controllers\NominaCargoController;
use App\Http\Controllers\PlanillaSuplenciaController;
use App\Http\Controllers\PlanillaTotalGanadoController;
use App\Http\Controllers\TipoContratoController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\TrabajadorController;
use App\Http\Controllers\UnidadOrganizacionalController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
*/

Route::get('/', inicioControl::class);

Route::middleware(['auth:sanctum', 'verified'])->get('/inicio', function () {
    return view('dash.index');
})->name('dash');


// -----------------Trabajador---------------------
Route::middleware(['auth'])->group(function () {
    // CRUD USUARIOS
    Route::resource('users', UserController::class)->names('users');
    // CRUD TRABAJADOR
    Route::resource('trabajador', TrabajadorController::class)->only('index','create','edit','update','destroy')->names('trabajador');
    Route::get('trabajador/{trabajador}/mostrar', [TrabajadorController::class, 'mostrar'])->name('trabajador.mostrar');
    Route::get('trabajador/lista', [TrabajadorController::class, 'listar'])->name('trabajador.listar');
    Route::post('trabajador/registrar', [TrabajadorController::class, 'registrar'])->name('trabajador.registrar');
    Route::get('trabajador/avatar/{avatar}', [TrabajadorController::class, 'view_avatar'])->name('trabajador.avatar');
    Route::get('trabajador/pdf-ficha-personal/{id}', [TrabajadorController::class, 'pdf_ficha_personal'])->name('trabajador.pdf_ficha_personal');

    // ----------------Documentos de Su Formacion academica---------------------------
    Route::get('formacion_academica/{f_academica}/lista', [FormacionAcademicaController::class, 'listar'])->name('form_academica.listar');
    Route::post('formacion_academica/registrar', [FormacionAcademicaController::class, 'registrar'])
    ->name('form_academica.registrar');
    Route::get('formacion_academica/{f_academica}/eliminar', [FormacionAcademicaController::class, 'delete'])
    ->name('form_academica.delete');
    Route::get('formacion_academica/documento/{id}', [FormacionAcademicaController::class, 'view_document'])->name('form_academica.view_document');
    // -------------------Documentos Personales y administrativos-------------------------------------
    Route::get('documento-personal/{doc_personal}/crear', [DocumentoPersonalController::class, 'create'])
    ->name('documento_personal.create');
    Route::post('documento-personal/registrar', [DocumentoPersonalController::class, 'registrar'])
    ->name('documento_personal.registrar');
    Route::get('documento-personal/{doc_personal}/eliminar', [DocumentoPersonalController::class, 'delete'])
    ->name('documento_personal.delete');
    Route::get('documento_personal/documento/{id}', [DocumentoPersonalController::class, 'view_document'])->name('documento_personal.view_document');

    // -----------------------Cursos--------------------------
    Route::get('curso/{curso}/lista', [CursoController::class, 'listar'])->name('curso.listar');
    Route::post('curso/registrar', [CursoController::class, 'registrar'])
    ->name('curso.registrar');
    Route::get('curso/{curso}/eliminar', [CursoController::class, 'delete'])
    ->name('curso.delete');
    Route::get('curso/{curso}/mostrarCurso', [CursoController::class, 'showModalPdf'])
    ->name('curso.showModalPdf');
    Route::get('curso/documento/{id}', [CursoController::class, 'view_document'])->name('curso.view_document');
    // ---------------------Experiencia Laboral------------------------
    Route::get('experiencia-laboral/{exp_laboral}/lista', [ExperienciaLaboralController::class, 'listar'])->name('exp_laboral.listar');
    Route::post('experiencia-laboral/registrar', [ExperienciaLaboralController::class, 'registrar'])
    ->name('exp_laboral.registrar');
    Route::get('experiencia-laboral/{exp_laboral}/eliminar', [ExperienciaLaboralController::class, 'delete'])
    ->name('exp_laboral.delete');
    Route::get('experiencia-laboral/{exp_laboral}/mostrarCurso', [ExperienciaLaboralController::class, 'showModalPdf'])
    ->name('exp_laboral.showModalPdf');
    Route::get('experiencia-laboral/documento/{id}', [ExperienciaLaboralController::class, 'view_document'])->name('exp_laboral.view_document');
    // -----------------------MERITOS--------------------------
    Route::get('merito/{merito}/lista', [MeritoController::class, 'listar'])->name('merito.listar');
    Route::post('merito/registrar', [MeritoController::class, 'registrar'])->name('merito.registrar');
    Route::get('merito/{merito}/eliminar', [MeritoController::class, 'delete'])->name('merito.delete');
    Route::get('merito/{merito}/mostrarMerito', [MeritoController::class, 'showModalPdf'])
    ->name('merito.showModalPdf');
    Route::get('merito/documento/{id}', [MeritoController::class, 'view_document']);
    // -----------------------DEMERITOS--------------------------
    Route::get('demerito/{demerito}/lista', [DemeritoController::class, 'listar'])->name('demerito.listar');
    Route::post('demerito/registrar', [DemeritoController::class, 'registrar'])->name('demerito.registrar');
    Route::get('demerito/{demerito}/eliminar', [DemeritoController::class, 'delete'])->name('demerito.delete');
    Route::get('demerito/{demerito}/mostrarDemerito', [DemeritoController::class, 'showModalPdf'])
    ->name('demerito.showModalPdf');
    Route::get('demerito/documento/{id}', [DemeritoController::class, 'view_document']);

    // CRUD ESTRUCTURA ORGANIZACIONAL
    Route::resource('estructuras-organizacionales', EstructuraOrganizacionalController::class)->only('index','create','store','edit','update','destroy')->names('estruct_org');
    // CRUD ESCALA ORGANIZACIONAL
    Route::resource('escala-salarial', EscalaSalarialController::class)->only('index','create','store','edit','update','destroy')->names('escala_salarial');
    // CRUD UNIDAD ORGANIZACIONAL
    Route::resource('unidad-organizacional', UnidadOrganizacionalController::class)->only('index','create','store','edit','update','destroy')->names('unidad_organizacional');
    // CRUD CARGOS
    Route::resource('cargo', CargoController::class)->only('index','create','store','edit','update','destroy')->names('cargo');
    // CRUD TIPO CONTRATO
    Route::resource('tipo-contrato', TipoContratoController::class)->only('index','create','store','edit','update','destroy')->names('tipo_contrato');
    // CRUD NOMINA DE CARGOS
    Route::get('/nomina-cargo/exist-item', [NominaCargoController::class, 'existItem']);
    Route::resource('nomina-cargos', NominaCargoController::class)->only('index','create','store','edit','update','destroy')->names('nomina_cargo');
    // CRUD ASIGNACION DE ITEM
    Route::get('items', [AsignacionCargoController::class, 'lista_items'])->name('items.lista');
    Route::get('item/crear', [AsignacionCargoController::class, 'crear_item'])->name('item.nuevo');
    Route::post('item/registrar', [AsignacionCargoController::class, 'registrar_item'])->name('item.registrar');
    Route::get('item/{item}/editar', [AsignacionCargoController::class, 'editar_item'])->name('item.editar');
    Route::put('item/actualizar/{item}', [AsignacionCargoController::class, 'actualizar_item'])->name('item.actualizar');
    Route::get('item/{item}/cambiar', [AsignacionCargoController::class, 'form_cambiar_item'])->name('item.form_cambiar_item');
    Route::put('item/cambiar/{item}', [AsignacionCargoController::class, 'cambiar_item'])->name('item.cambiar_item');
    Route::get('item/{item}/dar-baja', [AsignacionCargoController::class, 'dar_baja_item'])->name('item.dar_baja_item');
    Route::put('item/dar-baja/{item}', [AsignacionCargoController::class, 'baja_item'])->name('item.baja_item');
    // CRUD ASIGNACION DE CONSULTOR
    Route::get('consultores', [AsignacionCargoController::class, 'lista_consultores'])->name('consultores.lista');
    Route::get('consultor/crear', [AsignacionCargoController::class, 'crear_consultor'])->name('consultor.nuevo');
    Route::post('consultor/registrar', [AsignacionCargoController::class, 'registrar_consultor'])->name('consultor.registrar');
    Route::get('consultor/{consultor}/editar', [AsignacionCargoController::class, 'editar_consultor'])->name('consultor.editar');
    Route::put('consultor/actualizar/{consultor}', [AsignacionCargoController::class, 'actualizar_consultor'])->name('consultor.actualizar');
    Route::get('consultor/{consultor}/cambiar', [AsignacionCargoController::class, 'form_cambiar_consultor'])->name('consultor.form_cambiar_consultor');
    Route::put('consultor/cambiar/{consultor}', [AsignacionCargoController::class, 'cambiar_consultor'])->name('consultor.cambiar_consultor');
    Route::get('consultor/{consultor}/dar-baja', [AsignacionCargoController::class, 'dar_baja_consultor'])->name('consultor.dar_baja_consultor');
    Route::put('consultor/dar-baja/{consultor}', [AsignacionCargoController::class, 'baja_consultor'])->name('consultor.baja_consultor');
    // CRUD ASIGNACION DE EVENTUAL
    Route::get('eventuales', [AsignacionCargoController::class, 'lista_eventuales'])->name('eventuales.lista');
    Route::get('eventual/crear', [AsignacionCargoController::class, 'crear_eventual'])->name('eventual.nuevo');
    Route::post('eventual/registrar', [AsignacionCargoController::class, 'registrar_eventual'])->name('eventual.registrar');
    Route::get('eventual/{eventual}/editar', [AsignacionCargoController::class, 'editar_eventual'])->name('eventual.editar');
    Route::put('eventual/actualizar/{eventual}', [AsignacionCargoController::class, 'actualizar_eventual'])->name('eventual.actualizar');
    Route::get('eventual/{eventual}/cambiar', [AsignacionCargoController::class, 'form_cambiar_eventual'])->name('eventual.form_cambiar_eventual');
    Route::put('eventual/cambiar/{eventual}', [AsignacionCargoController::class, 'cambiar_eventual'])->name('eventual.cambiar_eventual');
    Route::get('eventual/{eventual}/dar-baja', [AsignacionCargoController::class, 'dar_baja_eventual'])->name('eventual.dar_baja_eventual');
    Route::put('eventual/dar-baja/{eventual}', [AsignacionCargoController::class, 'baja_eventual'])->name('eventual.baja_eventual');


    // ********************CONFIGURACIONES PARA PLANILLAS ****************************
    // CONFIGURACION DE APORTES
    Route::resource('configuracion-aporte', ConfAporteController::class)
    ->only('index','create','store','edit','update','destroy')->names('conf_aporte');
    // CONFIGURACION OTROS DESCUENTOS
    Route::resource('configuracion-otro-descuento', ConfOtroDescuentoController::class)
    ->only('index','create','store','edit','update','destroy')->names('conf_otro_descuento');
    // CONFIGURACION IMPOSITIVA
    Route::resource('configuracion-impositiva', ConfImpositivaController::class)
    ->only('index','create','store','edit','update','destroy')->names('conf_impositiva');
    // CONFIGURACION IMPOSITIVA
    Route::resource('configuracion-bono-antiguedad', ConfBonoAntiguedadController::class)
    ->only('index','create','store','edit','update','destroy')->names('conf_bono_antiguedad');
    // CONFIGURACION Horas EXTRAS
    Route::resource('configuracion-hora-extra', ConfHorasExtraController::class)
    ->only('index','create','store','edit','update','destroy')->names('conf_horas_extra');

    // Planilla Asistencias
    Route::get('consultar_asistencias', [PlanillaAsistenciaController::class, 'consultar_asistencia'])->name('asistencia.consulta');
    Route::get('planilla/asistencias', [PlanillaAsistenciaController::class, 'lista_asistencia'])->name('asistencia.lista');
    Route::get('planilla/crear-asistencias/{mes}/{gestion}/{tipo_contrato}', [PlanillaAsistenciaController::class, 'create_all_planilla'])->name('asistencia.create_all');
    Route::post('planilla/generar-asistencias', [PlanillaAsistenciaController::class, 'generar_planilla'])->name('asistencia.generar_planilla');
    Route::get('planilla/crear-asistencia/{mes}/{gestion}/{tipo_contrato}', [PlanillaAsistenciaController::class, 'create_asistencia'])->name('asistencia.create');
    Route::post('planilla/generar-asistencia', [PlanillaAsistenciaController::class, 'generar_asistencia'])->name('asistencia.generar_asistencia');
    Route::get('planilla/{asistencia}/editar-asistencia', [PlanillaAsistenciaController::class, 'editar_asistencia'])->name('asistencia.editar');
    Route::put('planilla/asistencia/{asistencia}', [PlanillaAsistenciaController::class, 'update'])->name('asistencia.actualizar');
    Route::delete('planilla/asistencia/{asistencia}', [PlanillaAsistenciaController::class, 'eliminar_asistencia'])->name('asistencia.eliminar');
    Route::delete('planilla/asistencias/{mes}/{gestion}/{tipo_contrato}', [PlanillaAsistenciaController::class, 'eliminar_planilla'])->name('asistencia.eliminar_planilla');
    Route::get('planilla/asistencias-pdf/{mes}/{gestion}/{tipo_contrato}', [PlanillaAsistenciaController::class, 'planilla_pdf'])->name('asistencia.planilla_pdf');

    // Planilla bonos antiguedad
    Route::get('consultar_bono_antiguedads', [PlanillaBonoAntiguedadController::class, 'consultar_bono_antiguedad'])->name('bono_antiguedad.consulta');
    Route::get('planilla/bono_antiguedads', [PlanillaBonoAntiguedadController::class, 'lista_bono_antiguedad'])->name('bono_antiguedad.lista');
    Route::get('planilla/crear-bono_antiguedads/{mes}/{gestion}/{tipo_contrato}', [PlanillaBonoAntiguedadController::class, 'create_all_planilla'])->name('bono_antiguedad.create_all');
    Route::post('planilla/generar-bono_antiguedads', [PlanillaBonoAntiguedadController::class, 'generar_planilla'])->name('bono_antiguedad.generar_planilla');
    Route::get('planilla/crear-bono_antiguedad/{mes}/{gestion}/{tipo_contrato}', [PlanillaBonoAntiguedadController::class, 'create_bono_antiguedad'])->name('bono_antiguedad.create');
    Route::post('planilla/generar-bono_antiguedad', [PlanillaBonoAntiguedadController::class, 'generar_bono_antiguedad'])->name('bono_antiguedad.generar_bono_antiguedad');
    Route::get('planilla/{bono_antiguedad}/editar-bono_antiguedad', [PlanillaBonoAntiguedadController::class, 'editar_bono_antiguedad'])->name('bono_antiguedad.editar');
    Route::put('planilla/bono_antiguedad/{bono_antiguedad}', [PlanillaBonoAntiguedadController::class, 'update'])->name('bono_antiguedad.actualizar');
    Route::delete('planilla/bono_antiguedad/{bono_antiguedad}', [PlanillaBonoAntiguedadController::class, 'eliminar_bono_antiguedad'])->name('bono_antiguedad.eliminar');
    Route::delete('planilla/bono_antiguedads/{mes}/{gestion}/{tipo_contrato}', [PlanillaBonoAntiguedadController::class, 'eliminar_planilla'])->name('bono_antiguedad.eliminar_planilla');
    Route::get('planilla/bono_antiguedads-pdf/{mes}/{gestion}/{tipo_contrato}', [PlanillaBonoAntiguedadController::class, 'planilla_pdf'])->name('bono_antiguedad.planilla_pdf');

    // Planilla Horas extras
    Route::get('consultar_horas_extras', [PlanillaHorasExtraController::class, 'consultar_horas_extra'])->name('horas_extra.consulta');
    Route::get('planilla/horas_extras', [PlanillaHorasExtraController::class, 'lista_horas_extra'])->name('horas_extra.lista');
    Route::get('planilla/crear-horas_extras/{mes}/{gestion}/{tipo_contrato}', [PlanillaHorasExtraController::class, 'create_all_planilla'])->name('horas_extra.create_all');
    Route::get('planilla/crear-horas_extra/{mes}/{gestion}/{tipo_contrato}', [PlanillaHorasExtraController::class, 'create_horas_extra'])->name('horas_extra.create');
    Route::post('planilla/registrar-horas_extra', [PlanillaHorasExtraController::class, 'registrar_horas_extra'])->name('horas_extra.registrar_horas_extra');
    Route::get('planilla/{horas_extra}/editar-horas_extra', [PlanillaHorasExtraController::class, 'editar_horas_extra'])->name('horas_extra.editar');
    Route::put('planilla/horas_extra/{horas_extra}', [PlanillaHorasExtraController::class, 'update'])->name('horas_extra.actualizar');
    Route::delete('planilla/horas_extra/{horas_extra}', [PlanillaHorasExtraController::class, 'eliminar_horas_extra'])->name('horas_extra.eliminar');
    Route::get('planilla/horas_extras-pdf/{mes}/{gestion}/{tipo_contrato}', [PlanillaHorasExtraController::class, 'planilla_pdf'])->name('horas_extra.planilla_pdf');

    // Planilla suplencias
    Route::get('consultar_suplencias', [PlanillaSuplenciaController::class, 'consultar_suplencia'])->name('suplencia.consulta');
    Route::get('planilla/suplencias', [PlanillaSuplenciaController::class, 'lista_suplencia'])->name('suplencia.lista');
    Route::get('planilla/crear-suplencias/{mes}/{gestion}/{tipo_contrato}', [PlanillaSuplenciaController::class, 'create_all_planilla'])->name('suplencia.create_all');
    Route::get('planilla/crear-suplencia/{mes}/{gestion}/{tipo_contrato}', [PlanillaSuplenciaController::class, 'create_suplencia'])->name('suplencia.create');
    Route::post('planilla/registrar-suplencia', [PlanillaSuplenciaController::class, 'registrar_suplencia'])->name('suplencia.registrar_suplencia');
    Route::get('planilla/{suplencia}/editar-suplencia', [PlanillaSuplenciaController::class, 'editar_suplencia'])->name('suplencia.editar');
    Route::put('planilla/suplencia/{suplencia}', [PlanillaSuplenciaController::class, 'update'])->name('suplencia.actualizar');
    Route::delete('planilla/suplencia/{suplencia}', [PlanillaSuplenciaController::class, 'eliminar_suplencia'])->name('suplencia.eliminar');
    Route::get('planilla/suplencias-pdf/{mes}/{gestion}/{tipo_contrato}', [PlanillaSuplenciaController::class, 'planilla_pdf'])->name('suplencia.planilla_pdf');

    // Planilla Total Ganado
    Route::get('consultar_total_ganados', [PlanillaTotalGanadoController::class, 'consultar_total_ganado'])->name('total_ganado.consulta');
    Route::get('planilla/total_ganados', [PlanillaTotalGanadoController::class, 'lista_total_ganado'])->name('total_ganado.lista');
    Route::get('planilla/crear-total_ganados/{mes}/{gestion}/{tipo_contrato}', [PlanillaTotalGanadoController::class, 'create_all_planilla'])->name('total_ganado.create_all');
    Route::post('planilla/generar-total_ganados', [PlanillaTotalGanadoController::class, 'generar_planilla'])->name('total_ganado.generar_planilla');
    Route::get('planilla/crear-total_ganado/{mes}/{gestion}/{tipo_contrato}', [PlanillaTotalGanadoController::class, 'create_total_ganado'])->name('total_ganado.create');
    Route::post('planilla/generar-total_ganado', [PlanillaTotalGanadoController::class, 'generar_total_ganado'])->name('total_ganado.generar_total_ganado');
    Route::get('planilla/{total_ganado}/editar-total_ganado', [PlanillaTotalGanadoController::class, 'editar_total_ganado'])->name('total_ganado.editar');
    Route::put('planilla/total_ganado/{total_ganado}', [PlanillaTotalGanadoController::class, 'update'])->name('total_ganado.actualizar');
    Route::delete('planilla/total_ganado/{total_ganado}', [PlanillaTotalGanadoController::class, 'eliminar_total_ganado'])->name('total_ganado.eliminar');
    Route::delete('planilla/total_ganados/{mes}/{gestion}/{tipo_contrato}', [PlanillaTotalGanadoController::class, 'eliminar_planilla'])->name('total_ganado.eliminar_planilla');
    Route::get('planilla/total_ganados-pdf/{mes}/{gestion}/{tipo_contrato}', [PlanillaTotalGanadoController::class, 'planilla_pdf'])->name('total_ganado.planilla_pdf');
});
