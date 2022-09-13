<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use Barryvdh\DomPDF\PDF;
use Illuminate\Support\Facades\DB;

class PDFController extends Controller
{
    // public function PDF(Informe $informe){
    //     $pdf = PDF::loadview('PDF/informe',compact('informe'));
    //     return $pdf->stream('Informe.pdf');
    //     // return $informe;
    // }

    // public function PDF_informe_material(Informe $informe){

    //     $inspector= DB::table('users')
    //     ->join('cronogramas', 'users.id','=','cronogramas.user_id')
    //     ->join('solicituds', 'solicituds.id','=','cronogramas.solicitud_id')
    //     ->join('informes', 'informes.solicitud_id','=','solicituds.id')
    //     ->where('informes.id',$informe->id)
    //     ->select('users.name as nombre_inspector')
    //     ->get();

    //     $materiales= DB::table('informe_materials')
    //         ->join('materials','informe_materials.material_id','=','materials.id')
    //         ->select('informe_materials.cantidad as cantidad',
    //                 'informe_materials.u_medida as u_medida',
    //                 'materials.nombre_material as nombre_material')
    //         ->where('informe_materials.informe_id',$informe->id)
    //         ->get();
    //     $mano_obra= DB::table('informe_materials')
    //         ->join('materials','informe_materials.material_id','=','materials.id')
    //         ->select('informe_materials.cantidad as cantidad',
    //                 'informe_materials.u_medida as u_medida',
    //                 'materials.nombre_material as nombre_material')
    //         ->where('informe_materials.informe_id',$informe->id)
    //         ->first();

    //     $pdf = PDF::loadview('PDF/informe_material',compact('informe','materiales','inspector','mano_obra'));
    //     return $pdf->stream('Informe_material.pdf');
    //     // return $informe;
    // }

    // public function PDF_pedido(Informe $informe){
    //     $materiales= DB::table('informe_materials')
    //         ->join('materials','informe_materials.material_id','=','materials.id')

    //         ->select('informe_materials.cantidad as cantidad',
    //                 'informe_materials.u_medida as u_medida',
    //                 'materials.nombre_material as nombre_material')
    //         ->where('informe_materials.informe_id',$informe->id)
    //         ->get();
    //     $inspector = DB::table('informes')
    //         ->join('solicituds', 'solicituds.id', '=', 'informes.solicitud_id')
    //         ->join('cronogramas', 'cronogramas.solicitud_id', '=', 'solicituds.id')
    //         ->join('users', 'cronogramas.user_id', '=', 'users.id')
    //         ->select('users.name as name','informes.estado_in as estado')
    //         ->where('informes.id',$informe->id)
    //         ->first();
    //     $jefe_r= DB::table('users')
    //         ->where('users.tipo_user','Jefe de red')
    //         ->select('users.name as name')
    //         ->first();
    //     // $materiales=DB::select("SELECT m.nombre_material,im.cantidad,im.u_medida FROM informe_materials im
    //     //                         INNER JOIN materials m on m.id=im.material_id WHERE im.informe_id=1");
    //     // $pdf = PDF::loadview('PDF/pedido_material',compact('informe','materiales','inspector','jefe_r'));
    //     // return $pdf->stream('reporte_pedido.pdf');
    //     return PDF::setOptions(['isHtml5ParserEnabled' => true, 'isRemoteEnabled' => true])->loadview('PDF/pedido_material',compact('informe','materiales','inspector','jefe_r'))->stream('reporte_pedido.pdf');
    //     // return $informe;
    // }

    // public function PDF_cronograma($fecha_inspeccion , $valor){
    //     if ($valor==0) {
    //         $cronogramas = DB::table('informes')
    //             ->join('solicituds', 'solicituds.id', '=', 'informes.solicitud_id')
    //             ->join('cronogramas', 'cronogramas.solicitud_id', '=', 'solicituds.id')
    //             ->join('users', 'cronogramas.user_id', '=', 'users.id')
    //             ->select('solicituds.zona_sol as zona',
    //                     'solicituds.nombre_sol as nombre_sol',
    //                     'users.name as name',
    //                     'solicituds.celular_sol as celular',
    //                     'cronogramas.fecha_inspe as fecha_inspe')
    //             ->where('cronogramas.estado','asignado')
    //             ->whereDate('cronogramas.fecha_inspe',$fecha_inspeccion)
    //             ->get();
    //     }
    //     else{
    //         $cronogramas = DB::table('informes')
    //             ->join('solicituds', 'solicituds.id', '=', 'informes.solicitud_id')
    //             ->join('cronogramas', 'cronogramas.solicitud_id', '=', 'solicituds.id')
    //             ->join('users', 'cronogramas.user_id', '=', 'users.id')
    //             ->select('solicituds.zona_sol as zona',
    //                     'solicituds.nombre_sol as nombre_sol',
    //                     'users.name as name',
    //                     'solicituds.celular_sol as celular',
    //                     'cronogramas.fecha_inspe as fecha_inspe')
    //             ->where('cronogramas.estado','asignado')
    //             ->whereDate('cronogramas.fecha_inspe',$fecha_inspeccion)
    //             ->where('users.id',$valor)
    //             ->get();
    //         }
    //     $pdf = PDF::loadview('PDF.reporte_cronograma',compact('cronogramas','fecha_inspeccion'));
    //     return $pdf->stream('cronograma.pdf');
    //     // return $cronogramas;
    // }
    // public function PDF_reporte_pedido(Informe $informe){
    //     $pdf = PDF::loadview('PDF/informe',compact('informe'));
    //     return $pdf->stream('Informe.pdf');
    //     // return $informe;
    // }
}
