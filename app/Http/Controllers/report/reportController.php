<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;

use App\model\pkp\pkp_project;
use App\model\pkp\project_pdf;
use App\model\pkp\promo;
use App\model\pkp\tipp;
use App\model\users\User;
use App\model\master\brand;
use App\model\manager\pengajuan;
use Auth;
use DB;
use redirect;

class reportController extends Controller
{
    public function data(){
        $hilo1 = pkp_project::where('id_brand','=','Hilo')->count();$hilo2 = project_pdf::where('id_brand','=','Hilo')->count();$hhilo = $hilo1 + $hilo2;
        $lmen1 = pkp_project::where('id_brand','=','L-Men')->count();$lmen2 = project_pdf::where('id_brand','=','L-Men')->count();$hlmen = $lmen1 + $lmen2;
        $nr1 = pkp_project::where('id_brand','=','Nutrisari')->count();$nr2 = project_pdf::where('id_brand','=','Nutrisari')->count();$hnr = $nr1 + $nr2;
        $ts1 = pkp_project::where('id_brand','=','Tropicana Slim')->count();$ts2 = project_pdf::where('id_brand','=','Tropicana Slim')->count();$hts = $ts1 + $ts2;
        $ekspor1 = pkp_project::where('id_brand','=','Ekspor')->count();$ekspor2 = project_pdf::where('id_brand','=','Ekspor')->count();$hekspor = $ekspor1 + $ekspor2;
        $draf = pkp_project::where('status_project','=','draf')->count();$draf1 = project_pdf::where('status_project','=','draf')->count();$hdraf = $draf + $draf1;
        $revisi = pkp_project::where('status_project','=','revisi')->count();$revisi1 = project_pdf::where('status_project','=','revisi')->count();$hrevisi = $revisi + $revisi1;
        $proses = pkp_project::where('status_project','=','proses')->count();$proses1 = project_pdf::where('status_project','=','proses')->count();$hproses = $proses + $proses1;
        $sent= pkp_project::where('status_project','=','sent')->count();$sent1 = project_pdf::where('status_project','=','sent')->count();$hsent = $sent + $sent1;
        $close = pkp_project::where('status_project','=','close')->count();$close1 = project_pdf::where('status_project','=','close')->count();$hclose = $close + $close1;

        $dhilo1 = pkp_project::where('id_brand','=','Hilo')->join('tippu','tippu.id_pkp','=','pkp_project.id_project')->where('status_data','=','active')->get();$dhilo2 = project_pdf::where('id_brand','=','Hilo')->join('tipu','tipu.pdf_id','=','pdf_project.id_project_pdf')->where('status_pdf','=','active')->get();
        $dlmen1 = pkp_project::where('id_brand','=','L-Men')->join('tippu','tippu.id_pkp','=','pkp_project.id_project')->where('status_data','=','active')->get();$dlmen2 = project_pdf::where('id_brand','=','L-Men')->join('tipu','tipu.pdf_id','=','pdf_project.id_project_pdf')->where('status_pdf','=','active')->get();
        $dnr1 = pkp_project::where('id_brand','=','Nutrisari')->join('tippu','tippu.id_pkp','=','pkp_project.id_project')->where('status_data','=','active')->get();$dnr2 = project_pdf::where('id_brand','=','Nutrisari')->join('tipu','tipu.pdf_id','=','pdf_project.id_project_pdf')->where('status_pdf','=','active')->get();
        $dts1 = pkp_project::where('id_brand','=','Tropicana Slim')->join('tippu','tippu.id_pkp','=','pkp_project.id_project')->where('status_data','=','active')->get();$dts2 = project_pdf::where('id_brand','=','Tropicana Slim')->join('tipu','tipu.pdf_id','=','pdf_project.id_project_pdf')->where('status_pdf','=','active')->get();
        $dekspor1 = pkp_project::where('id_brand','=','Ekspor')->join('tippu','tippu.id_pkp','=','pkp_project.id_project')->where('status_data','=','active')->get();$dekspor2 = project_pdf::where('id_brand','=','Ekspor')->join('tipu','tipu.pdf_id','=','pdf_project.id_project_pdf')->where('status_pdf','=','active')->get();
        $ddraf = pkp_project::where('status_project','=','draf')->join('tippu','tippu.id_pkp','=','pkp_project.id_project')->where('status_data','=','active')->get();$ddraf1 = project_pdf::where('status_project','=','draf')->join('tipu','tipu.pdf_id','=','pdf_project.id_project_pdf')->where('status_pdf','=','active')->get();
        $drevisi = pkp_project::where('status_project','=','revisi')->join('tippu','tippu.id_pkp','=','pkp_project.id_project')->where('status_data','=','active')->get();$drevisi1 = project_pdf::where('status_project','=','revisi')->join('tipu','tipu.pdf_id','=','pdf_project.id_project_pdf')->where('status_pdf','=','active')->get();
        $dproses = pkp_project::where('status_project','=','proses')->join('tippu','tippu.id_pkp','=','pkp_project.id_project')->where('status_data','=','active')->get();$dproses1 = project_pdf::where('status_project','=','proses')->join('tipu','tipu.pdf_id','=','pdf_project.id_project_pdf')->where('status_pdf','=','active')->get();
        $dsent= pkp_project::where('status_project','=','sent')->join('tippu','tippu.id_pkp','=','pkp_project.id_project')->where('status_data','=','active')->get();$dsent1 = project_pdf::where('status_project','=','sent')->join('tipu','tipu.pdf_id','=','pdf_project.id_project_pdf')->where('status_pdf','=','active')->get();
        $dclose = pkp_project::where('status_project','=','close')->join('tippu','tippu.id_pkp','=','pkp_project.id_project')->where('status_data','=','active')->get();$dclose1 = project_pdf::where('status_project','=','close')->join('tipu','tipu.pdf_id','=','pdf_project.id_project_pdf')->where('status_pdf','=','active')->get();
        
        $pengajuan = pengajuan::count();
        return view('pv.data')->with([
            'hdraf' => $hdraf,'hrevisi' => $hrevisi,
            'hproses' => $proses,'hsent' => $hsent,
            'hclose' => $hclose,'hhilo' => $hhilo,
            'hlmen' => $hlmen,'hnr' => $hnr,
            'hts' => $hts,'hekspor' => $hekspor,
            'dhilo1' => $dhilo1,'dhilo2' => $dhilo2,
            'dlmen1' => $dlmen1,'dlmen2' => $dlmen2,
            'dnr1' => $dnr1,'dnr2' => $dnr2,
            'dts1' => $dts1,'dts2' =>$dts2,
            'dekspor1' => $dekspor1,'dekspor2' => $dekspor2,
            'ddraf1' =>$ddraf1,'ddraf' => $ddraf,
            'drevisi1' => $drevisi1,'drevisi'=>$drevisi,
            'dproses1' => $dproses1,'dproses' => $dproses,
            'dsent1' => $dsent1,'dsent' => $dsent,
            'dclose1' => $dclose1,'dclose' => $dclose
        ]);
    }
}