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
use App\Http\Controllers\ConfDescuentoController;
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
use App\Http\Controllers\NombrePlanillaController;
use App\Http\Controllers\NominaCargoController;
use App\Http\Controllers\PlanillaAporteLaboralController;
use App\Http\Controllers\PlanillaController;
use App\Http\Controllers\PlanillaDescuentoController;
use App\Http\Controllers\PlanillaFondoEmpleadoController;
use App\Http\Controllers\PlanillaImpositivaController;
use App\Http\Controllers\PlanillaOtroDescuentoController;
use App\Http\Controllers\PlanillaRefrigerioController;
use App\Http\Controllers\PlanillaSuplenciaController;
use App\Http\Controllers\PlanillaTotalGanadoController;
use App\Http\Controllers\TipoContratoController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\TrabajadorController;
use App\Http\Controllers\UnidadOrganizacionalController;
use App\Models\AsignacionCargo;
use App\Models\NominaCargo;
use App\Models\Trabajador;

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
    $trabajadores = Trabajador::where('estado_trabajador','HABILITADO')->count();
    $nomina_cargos_ocupados = NominaCargo::where('estado','OCUPADO')->count();
    $nomina_cargos_libres = NominaCargo::where('estado','LIBRE')->count();
    $items_habilitados = AsignacionCargo::where([['estado','HABILITADO']])->count();
    return view('dash.index', compact('trabajadores','nomina_cargos_ocupados','nomina_cargos_libres','items_habilitados'));
})->name('dash');


// -----------------Trabajador---------------------
Route::middleware(['auth'])->group(function () {
    // CRUD USUARIOS
    Route::resource('users', UserController::class)->names('users');
    // CRUD TRABAJADOR
    Route::resource('trabajador', TrabajadorController::class)->only('index', 'create', 'edit', 'update', 'destroy')->names('trabajador');
    Route::get('trabajador/{trabajador}/mostrar', [TrabajadorController::class, 'mostrar'])->name('trabajador.mostrar');
    Route::get('trabajador/lista', [TrabajadorController::class, 'listar'])->name('trabajador.listar');
    Route::post('trabajador/registrar', [TrabajadorController::class, 'registrar'])->name('trabajador.registrar');
    Route::get('trabajador/avatar/{avatar}', [TrabajadorController::class, 'view_avatar'])->name('trabajador.avatar');
    Route::get('trabajador/pdf-ficha-personal/{id}', [TrabajadorController::class, 'pdf_ficha_personal'])->name('trabajador.pdf_ficha_personal');

    // ----------------Documentos de Su Formacion academica---------------------------
    Route::get('formacion_academica/{f_academica}/lista', [FormacionAcademicaController::class, 'listar'])->name('form_academica.listar');
    Route::post('formacion_academica/registrar', [FormacionAcademicaController::class, 'registrar'])
        ->name('form_academica.registrar');
    Route::get('formacion_academica/documento/{id}', [FormacionAcademicaController::class, 'view_document'])->name('form_academica.view_document');
    Route::delete('formacion_academica/{f_academica}', [FormacionAcademicaController::class, 'delete'])
        ->name('form_academica.delete');
    // -------------------Documentos Personales y administrativos-------------------------------------
    Route::get('documento_personal/{documento_personal}/lista', [DocumentoPersonalController::class, 'listar'])->name('documento_personal.listar');
    Route::post('documento_personal/registrar', [DocumentoPersonalController::class, 'registrar'])
        ->name('documento_personal.registrar');
    Route::get('documento_personal/documento/{id}', [DocumentoPersonalController::class, 'view_document'])->name('documento_personal.view_document');
    Route::delete('documento_personal/{id}', [DocumentoPersonalController::class, 'delete'])
        ->name('documento_personal.delete');
    // -----------------------Cursos--------------------------
    Route::get('curso/{curso}/lista', [CursoController::class, 'listar'])->name('curso.listar');
    Route::post('curso/registrar', [CursoController::class, 'registrar'])
        ->name('curso.registrar');
    Route::get('curso/documento/{id}', [CursoController::class, 'view_document'])->name('curso.view_document');
    Route::delete('curso/{id}', [CursoController::class, 'delete'])
        ->name('curso.delete');
    // ---------------------Experiencia Laboral------------------------
    Route::get('experiencia-laboral/{exp_laboral}/lista', [ExperienciaLaboralController::class, 'listar'])->name('exp_laboral.listar');
    Route::post('experiencia-laboral/registrar', [ExperienciaLaboralController::class, 'registrar'])
        ->name('exp_laboral.registrar');
    Route::get('experiencia-laboral/documento/{id}', [ExperienciaLaboralController::class, 'view_document'])->name('exp_laboral.view_document');
    Route::delete('experiencia-laboral/{id}', [ExperienciaLaboralController::class, 'delete'])
        ->name('exp_laboral.delete');
    // -----------------------MERITOS--------------------------
    Route::get('merito/{merito}/lista', [MeritoController::class, 'listar'])->name('merito.listar');
    Route::post('merito/registrar', [MeritoController::class, 'registrar'])->name('merito.registrar');
    Route::get('merito/documento/{id}', [MeritoController::class, 'view_document']);
    Route::delete('merito/{id}', [MeritoController::class, 'delete'])->name('merito.delete');
    // -----------------------DEMERITOS--------------------------
    Route::get('demerito/{demerito}/lista', [DemeritoController::class, 'listar'])->name('demerito.listar');
    Route::post('demerito/registrar', [DemeritoController::class, 'registrar'])->name('demerito.registrar');
    Route::get('demerito/documento/{id}', [DemeritoController::class, 'view_document']);
    Route::delete('demerito/{demerito}', [DemeritoController::class, 'delete'])->name('demerito.delete');

    // CRUD ESTRUCTURA ORGANIZACIONAL
    Route::resource('estructuras-organizacionales', EstructuraOrganizacionalController::class)->only('index', 'create', 'store', 'edit', 'update', 'destroy')->names('estruct_org');
    // CRUD ESCALA ORGANIZACIONAL
    Route::resource('escala-salarial', EscalaSalarialController::class)->only('index', 'create', 'store', 'edit', 'update', 'destroy')->names('escala_salarial');
    // CRUD UNIDAD ORGANIZACIONAL
    Route::resource('unidad-organizacional', UnidadOrganizacionalController::class)->only('index', 'create', 'store', 'edit', 'update', 'destroy')->names('unidad_organizacional');
    // CRUD CARGOS
    Route::resource('cargo', CargoController::class)->only('index', 'create', 'store', 'edit', 'update', 'destroy')->names('cargo');
    // CRUD TIPO CONTRATO
    Route::resource('tipo-contrato', TipoContratoController::class)->only('index', 'create', 'store', 'edit', 'update', 'destroy')->names('tipo_contrato');
    // CRUD NOMINA DE CARGOS
    Route::get('/nomina-cargo/exist-item', [NominaCargoController::class, 'existItem']);
    Route::resource('nomina-cargos', NominaCargoController::class)->only('index', 'create', 'store', 'edit', 'update', 'destroy')->names('nomina_cargo');
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

    Route::get('contratos/pdf', [AsignacionCargoController::class, 'pdf'])->name('contratos.pdf');
    // ********************CONFIGURACIONES PARA PLANILLAS ****************************
    // CONFIGURACION DE APORTES
    Route::resource('configuracion-aporte', ConfAporteController::class)
        ->only('index', 'create', 'store', 'edit', 'update', 'destroy')->names('conf_aporte');
    // CONFIGURACION OTROS DESCUENTOS
    Route::resource('configuracion-otro-descuento', ConfOtroDescuentoController::class)
        ->only('index', 'create', 'store', 'edit', 'update', 'destroy')->names('conf_otro_descuento');
    // CONFIGURACION IMPOSITIVA
    Route::resource('configuracion-impositiva', ConfImpositivaController::class)
        ->only('index', 'create', 'store', 'edit', 'update', 'destroy')->names('conf_impositiva');
    // CONFIGURACION IMPOSITIVA
    Route::resource('configuracion-bono-antiguedad', ConfBonoAntiguedadController::class)
        ->only('index', 'create', 'store', 'edit', 'update', 'destroy')->names('conf_bono_antiguedad');
    // CONFIGURACION Horas EXTRAS
    Route::resource('configuracion-hora-extra', ConfHorasExtraController::class)
        ->only('index', 'create', 'store', 'edit', 'update', 'destroy')->names('conf_horas_extra');
    // CONFIGURACION DESCUENTOS
    Route::resource('configuracion-descuentos', ConfDescuentoController::class)
        ->only('index', 'create', 'store', 'edit', 'update', 'destroy')->names('conf_descuento');

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

    // Planilla aporte laborales
    Route::get('consultar_aporte_laborals', [PlanillaAporteLaboralController::class, 'consultar_aporte_laboral'])->name('aporte_laboral.consulta');
    Route::get('planilla/aporte_laborals', [PlanillaAporteLaboralController::class, 'lista_aporte_laboral'])->name('aporte_laboral.lista');
    Route::get('planilla/crear-aporte_laborals/{mes}/{gestion}/{tipo_contrato}', [PlanillaAporteLaboralController::class, 'create_all_planilla'])->name('aporte_laboral.create_all');
    Route::post('planilla/generar-aporte_laborals', [PlanillaAporteLaboralController::class, 'generar_planilla'])->name('aporte_laboral.generar_planilla');
    Route::get('planilla/crear-aporte_laboral/{mes}/{gestion}/{tipo_contrato}', [PlanillaAporteLaboralController::class, 'create_aporte_laboral'])->name('aporte_laboral.create');
    Route::post('planilla/generar-aporte_laboral', [PlanillaAporteLaboralController::class, 'generar_aporte_laboral'])->name('aporte_laboral.generar_aporte_laboral');
    Route::get('planilla/{aporte_laboral}/editar-aporte_laboral', [PlanillaAporteLaboralController::class, 'editar_aporte_laboral'])->name('aporte_laboral.editar');
    Route::put('planilla/aporte_laboral/{aporte_laboral}', [PlanillaAporteLaboralController::class, 'update'])->name('aporte_laboral.actualizar');
    Route::delete('planilla/aporte_laboral/{aporte_laboral}', [PlanillaAporteLaboralController::class, 'eliminar_aporte_laboral'])->name('aporte_laboral.eliminar');
    Route::delete('planilla/aporte_laborals/{mes}/{gestion}/{tipo_contrato}', [PlanillaAporteLaboralController::class, 'eliminar_planilla'])->name('aporte_laboral.eliminar_planilla');
    Route::get('planilla/aporte_laborals-pdf/{mes}/{gestion}/{tipo_contrato}', [PlanillaAporteLaboralController::class, 'planilla_pdf'])->name('aporte_laboral.planilla_pdf');

    // Planilla refrigerios
    Route::get('consultar_refrigerios', [PlanillaRefrigerioController::class, 'consultar_refrigerio'])->name('refrigerio.consulta');
    Route::get('planilla/refrigerios', [PlanillaRefrigerioController::class, 'lista_refrigerio'])->name('refrigerio.lista');
    Route::get('planilla/crear-refrigerios/{mes}/{gestion}/{tipo_contrato}', [PlanillaRefrigerioController::class, 'create_all_planilla'])->name('refrigerio.create_all');
    Route::post('planilla/generar-refrigerios', [PlanillaRefrigerioController::class, 'generar_planilla'])->name('refrigerio.generar_planilla');
    Route::get('planilla/crear-refrigerio/{mes}/{gestion}/{tipo_contrato}', [PlanillaRefrigerioController::class, 'create_refrigerio'])->name('refrigerio.create');
    Route::post('planilla/generar-refrigerio', [PlanillaRefrigerioController::class, 'generar_refrigerio'])->name('refrigerio.generar_refrigerio');
    Route::get('planilla/{refrigerio}/editar-refrigerio', [PlanillaRefrigerioController::class, 'editar_refrigerio'])->name('refrigerio.editar');
    Route::put('planilla/refrigerio/{refrigerio}', [PlanillaRefrigerioController::class, 'update'])->name('refrigerio.actualizar');
    Route::delete('planilla/refrigerio/{refrigerio}', [PlanillaRefrigerioController::class, 'eliminar_refrigerio'])->name('refrigerio.eliminar');
    Route::delete('planilla/refrigerios/{mes}/{gestion}/{tipo_contrato}', [PlanillaRefrigerioController::class, 'eliminar_planilla'])->name('refrigerio.eliminar_planilla');
    Route::get('planilla/refrigerios-pdf/{mes}/{gestion}/{tipo_contrato}', [PlanillaRefrigerioController::class, 'planilla_pdf'])->name('refrigerio.planilla_pdf');

    // Planilla impositiva
    Route::get('consultar_impositivas', [PlanillaImpositivaController::class, 'consultar_impositiva'])->name('impositiva.consulta');
    Route::get('planilla/impositivas', [PlanillaImpositivaController::class, 'lista_impositiva'])->name('impositiva.lista');
    Route::get('planilla/crear-impositivas/{mes}/{gestion}/{tipo_contrato}', [PlanillaImpositivaController::class, 'create_all_planilla'])->name('impositiva.create_all');
    Route::post('planilla/generar-impositivas', [PlanillaImpositivaController::class, 'generar_planilla'])->name('impositiva.generar_planilla');
    Route::get('planilla/crear-impositiva/{mes}/{gestion}/{tipo_contrato}', [PlanillaImpositivaController::class, 'create_impositiva'])->name('impositiva.create');
    Route::post('planilla/generar-impositiva', [PlanillaImpositivaController::class, 'generar_impositiva'])->name('impositiva.generar_impositiva');
    Route::get('planilla/{impositiva}/editar-impositiva', [PlanillaImpositivaController::class, 'editar_impositiva'])->name('impositiva.editar');
    Route::put('planilla/impositiva/{impositiva}', [PlanillaImpositivaController::class, 'update'])->name('impositiva.actualizar');
    Route::delete('planilla/impositiva/{impositiva}', [PlanillaImpositivaController::class, 'eliminar_impositiva'])->name('impositiva.eliminar');
    Route::delete('planilla/impositivas/{mes}/{gestion}/{tipo_contrato}', [PlanillaImpositivaController::class, 'eliminar_planilla'])->name('impositiva.eliminar_planilla');
    Route::get('planilla/impositivas-pdf/{mes}/{gestion}/{tipo_contrato}', [PlanillaImpositivaController::class, 'planilla_pdf'])->name('impositiva.planilla_pdf');

    // Planilla otros descuentos
    Route::get('consultar_otro_descuentos', [PlanillaOtroDescuentoController::class, 'consultar_otro_descuento'])->name('otro_descuento.consulta');
    Route::get('planilla/otro_descuentos', [PlanillaOtroDescuentoController::class, 'lista_otro_descuento'])->name('otro_descuento.lista');
    Route::get('planilla/crear-otro_descuentos/{mes}/{gestion}/{tipo_contrato}', [PlanillaOtroDescuentoController::class, 'create_all_planilla'])->name('otro_descuento.create_all');
    Route::post('planilla/generar-otro_descuentos', [PlanillaOtroDescuentoController::class, 'generar_planilla'])->name('otro_descuento.generar_planilla');
    Route::get('planilla/crear-otro_descuento/{mes}/{gestion}/{tipo_contrato}', [PlanillaOtroDescuentoController::class, 'create_otro_descuento'])->name('otro_descuento.create');
    Route::post('planilla/generar-otro_descuento', [PlanillaOtroDescuentoController::class, 'generar_otro_descuento'])->name('otro_descuento.generar_otro_descuento');
    Route::get('planilla/{otro_descuento}/editar-otro_descuento', [PlanillaOtroDescuentoController::class, 'editar_otro_descuento'])->name('otro_descuento.editar');
    Route::put('planilla/otro_descuento/{otro_descuento}', [PlanillaOtroDescuentoController::class, 'update'])->name('otro_descuento.actualizar');
    Route::delete('planilla/otro_descuento/{otro_descuento}', [PlanillaOtroDescuentoController::class, 'eliminar_otro_descuento'])->name('otro_descuento.eliminar');
    Route::delete('planilla/otro_descuentos/{mes}/{gestion}/{tipo_contrato}', [PlanillaOtroDescuentoController::class, 'eliminar_planilla'])->name('otro_descuento.eliminar_planilla');
    Route::get('planilla/otro_descuentos-pdf/{mes}/{gestion}/{tipo_contrato}', [PlanillaOtroDescuentoController::class, 'planilla_pdf'])->name('otro_descuento.planilla_pdf');

    // Planilla otros descuentos
    Route::get('consultar_fondo_empleados', [PlanillaFondoEmpleadoController::class, 'consultar_fondo_empleado'])->name('fondo_empleado.consulta');
    Route::get('planilla/fondo_empleados', [PlanillaFondoEmpleadoController::class, 'lista_fondo_empleado'])->name('fondo_empleado.lista');
    Route::get('planilla/crear-fondo_empleados/{mes}/{gestion}/{tipo_contrato}', [PlanillaFondoEmpleadoController::class, 'create_all_planilla'])->name('fondo_empleado.create_all');
    Route::post('planilla/generar-fondo_empleados', [PlanillaFondoEmpleadoController::class, 'generar_planilla'])->name('fondo_empleado.generar_planilla');
    Route::get('planilla/crear-fondo_empleado/{mes}/{gestion}/{tipo_contrato}', [PlanillaFondoEmpleadoController::class, 'create_fondo_empleado'])->name('fondo_empleado.create');
    Route::post('planilla/generar-fondo_empleado', [PlanillaFondoEmpleadoController::class, 'generar_fondo_empleado'])->name('fondo_empleado.generar_fondo_empleado');
    Route::get('planilla/{fondo_empleado}/editar-fondo_empleado', [PlanillaFondoEmpleadoController::class, 'editar_fondo_empleado'])->name('fondo_empleado.editar');
    Route::put('planilla/fondo_empleado/{fondo_empleado}', [PlanillaFondoEmpleadoController::class, 'update'])->name('fondo_empleado.actualizar');
    Route::delete('planilla/fondo_empleado/{fondo_empleado}', [PlanillaFondoEmpleadoController::class, 'eliminar_fondo_empleado'])->name('fondo_empleado.eliminar');
    Route::delete('planilla/fondo_empleados/{mes}/{gestion}/{tipo_contrato}', [PlanillaFondoEmpleadoController::class, 'eliminar_planilla'])->name('fondo_empleado.eliminar_planilla');
    Route::get('planilla/fondo_empleados-pdf/{mes}/{gestion}/{tipo_contrato}', [PlanillaFondoEmpleadoController::class, 'planilla_pdf'])->name('fondo_empleado.planilla_pdf');

    // Planilla aporte laborales
    Route::get('consultar_descuentos', [PlanillaDescuentoController::class, 'consultar_descuento'])->name('descuento.consulta');
    Route::get('planilla/descuentos', [PlanillaDescuentoController::class, 'lista_descuento'])->name('descuento.lista');
    Route::get('planilla/crear-descuentos/{mes}/{gestion}/{tipo_contrato}', [PlanillaDescuentoController::class, 'create_all_planilla'])->name('descuento.create_all');
    Route::post('planilla/generar-descuentos', [PlanillaDescuentoController::class, 'generar_planilla'])->name('descuento.generar_planilla');
    Route::get('planilla/crear-descuento/{mes}/{gestion}/{tipo_contrato}', [PlanillaDescuentoController::class, 'create_descuento'])->name('descuento.create');
    Route::post('planilla/generar-descuento', [PlanillaDescuentoController::class, 'generar_descuento'])->name('descuento.generar_descuento');
    Route::get('planilla/{descuento}/editar-descuento', [PlanillaDescuentoController::class, 'editar_descuento'])->name('descuento.editar');
    Route::put('planilla/descuento/{descuento}', [PlanillaDescuentoController::class, 'update'])->name('descuento.actualizar');
    Route::delete('planilla/descuento/{descuento}', [PlanillaDescuentoController::class, 'eliminar_descuento'])->name('descuento.eliminar');
    Route::delete('planilla/descuentos/{mes}/{gestion}/{tipo_contrato}', [PlanillaDescuentoController::class, 'eliminar_planilla'])->name('descuento.eliminar_planilla');
    Route::get('planilla/descuentos-pdf/{mes}/{gestion}/{tipo_contrato}', [PlanillaDescuentoController::class, 'planilla_pdf'])->name('descuento.planilla_pdf');

     // CRUD Planilla General
    Route::resource('planilla/nombre_planilla', NombrePlanillaController::class)->only('index', 'create', 'store', 'destroy')->names('nombre_planilla');

    Route::get('planilla_general/lista/{id}', [PlanillaController::class, 'lista_planilla'])->name('planilla.lista');
    Route::get('planilla_general/crear/{id}', [PlanillaController::class, 'crear_planilla'])->name('planilla.create');
    Route::post('planilla_general/generar_planilla', [PlanillaController::class, 'generar_planilla'])->name('planilla.generar_planilla');
    Route::get('planilla_general/resumen/{id}', [PlanillaController::class, 'lista_resumen'])->name('planilla.resumen');
    Route::get('planilla_general/resumen_pdf/{id}', [PlanillaController::class, 'resumen_pdf'])->name('planilla.resumen_pdf');
    Route::get('planilla_general/planilla_pdf/{id}', [PlanillaController::class, 'planilla_pdf'])->name('planilla.pdf');
    Route::get('planilla_general/papeletas_pago/{id}', [PlanillaController::class, 'papeletas_pdf'])->name('planilla.papeletas_pdf');
    Route::delete('planilla_general/{id}', [PlanillaController::class, 'eliminar_planilla'])->name('planilla.eliminar_planilla');
    Route::get('planilla_general/estado/{id}/{estado}', [PlanillaController::class, 'cambiar_estado'])->name('planilla.estado');
});
