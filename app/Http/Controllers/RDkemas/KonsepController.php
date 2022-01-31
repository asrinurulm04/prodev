<?php

namespace App\Http\Controllers\RDkemas;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

use App\model\pkp\PkpProject;
use App\model\pkp\SKU;
use App\model\pdf\SubPDF;
use App\model\formula\Formula;
use App\model\formula\Fortail;
use App\model\Imports\KemasImport;
use App\model\Modelmesin\Mesin;
use App\model\Modelmesin\datamesin;
use App\model\Modelkemas\KonsepKemas;
use App\model\Modelkemas\FormulaKemas;
use App\model\feasibility\Feasibility;
use App\model\feasibility\FormPengajuanFS;
use App\model\feasibility\WorkbookFs;
use Redirect;
use Auth;
use Excel;
use DB;

class KonsepController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
        $this->middleware('rule:kemas');
    }

    public function index($id,$fs,$ws){
        $wb         = WorkbookFs::where('id',$ws)->first();
        $fs         = Feasibility::where('id',$wb->id_feasibility)->first();
        $pkp        = PkpProject::where('id_project',$id)->where('status_project','=','active')->first();
        $form       = FormPengajuanFS::where('id_feasibility',$fs->id)->first();
        $yield      = $form->batch_size * ($form->Yield/100);
        $pdf        = SubPDF::where('pdf_id',$id)->join('tr_pdf_project','tr_pdf_project.id_project_pdf','tr_sub_pdf.pdf_id')->where('status_pdf','active')->first();
        $count      = KonsepKemas::where('id_ws',$ws)->count();
        $sku        = SKU::select('id','nama_sku')->get();
        $kemas      = KonsepKemas::where('id_ws',$ws)->first();
        $mesins     = datamesin::where('kategori','Filling')->orwhere('kategori','Packing')->select('id_data_mesin','aktifitas')->get();
        $Mdata      = DB::table('tr_mesin')->where('id_wb_fs',$ws)->where('kategori','Filling')
                    ->orwhere('kategori','Packing')->join('ms_mesin','tr_mesin.id_data_mesin','=','ms_mesin.id_data_mesin')->get();
        return view('RDkemas/konsep')->with([
            'form'      => $form,
            'yield'     => $yield,
            'mesins'    => $mesins,
            'count'     => $count,
            'Mdata'     => $Mdata,
            'sku'       => $sku,
            'kemas'     => $kemas,
            'id'        => $id,
            'ws'        => $ws,
            'fs'        => $fs,
            'pdf'       => $pdf,
			'pkp'       => $pkp
        ]);
    }

    public function hasilnya(Request $request,$id,$fs, $ws){ // halaman summary data kemas
        $pdf        = SubPDF::where('pdf_id',$id)->join('tr_pdf_project','tr_pdf_project.id_project_pdf','tr_sub_pdf.pdf_id')->where('status_pdf','active')->first();
        $pkp        = PkpProject::where('id_project',$id)->where('status_project','=','active')->first();
        $myFormula  = Formula::where('id',$fs)->first();
        $konsep     = KonsepKemas::where('id_ws',$ws)->first();
		$kemas      = FormulaKemas::where('id_ws', $ws)->get();
		$kemasNew   = FormulaKemas::where('id_ws', $ws)->get();
        $fortail    = Fortail::where('formula_id',$fs)->join('ms_bahans','ms_bahans.id','tr_fortails.bahan_id')->where('status_bb','baru')->get();
        $workbook   = WorkbookFs::where('id',$ws)->first();
        $form       = FormPengajuanFS::where('id_feasibility',$workbook->id_feasibility)->first();
        $Mdata      = DB::table('tr_mesin')->join('ms_mesin','tr_mesin.id_data_mesin','=','ms_mesin.id_data_mesin')->where('id_wb_fs',$ws)->orwhere('kategori','Filling')->where('kategori','Packing')->get();
        $manual     = Mesin::where('manual','!=',NULL)->where('id_wb_fs',$ws)->get();
        $lokasi2    = Mesin::join('ms_mesin','ms_mesin.id_data_mesin','tr_mesin.id_data_mesin')->where('kategori','Filling')->orwhere('kategori','Packing')
                    ->join('tr_workbook_fs','tr_workbook_fs.id','tr_mesin.id_wb_fs')->where('tr_workbook_fs.status','Sent')
                    ->join('tr_feasibility','tr_feasibility.id','tr_workbook_fs.id_feasibility')->select('IO')->distinct()->get();
        return view('RDkemas.has')->with([
            'kemas'     => $kemas,
            'id'        => $id,
            'manual'    => $manual,
            'lokasi'    => $lokasi2,
            'fortail'   => $fortail,
            'form'      => $form,
            'konsep'    => $konsep,
            'kemasNew'  => $kemasNew,
            'Mdata'     => $Mdata,
            'myFormula' => $myFormula,
            'ws'        => $ws,
            'fs'        => $fs,
            'wb'        => $workbook,
            'id'        => $id,
            'pdf'       => $pdf,
			'pkp'       => $pkp
        ]);
    }

    public function insert(Request $request){
        $km = KonsepKemas::where('id_ws',$request->id_ws)->count();
        if($km==0){
            $kemass= new KonsepKemas;
        }elseif($km==1){
            $kemass = KonsepKemas::where('id_ws',$request->id_ws)->first();
        }
        $kemass->id_ws          = $request->id_ws;
        $kemass->keterangan     = $request->keterangan;
        $kemass->batch_size     = $request->batch;
        $kemass->box_palet      = $request->box_palet;
        $kemass->batch_yield    = $request->yield;
        $kemass->referensi      = $request->referensi;
        $kemass->jumlah_box     = $request->box_batch;
        $kemass->kubikasi       = $request->kubikasi;
        $kemass->created_date   = $request->last;
        $kemass->save();
        
        if($request->file!=NULL){
			$file = $request->file;
			$data = new FormulaKemas;
			$data->id_ws = $request->id_ws;
            Excel::import(new KemasImport,$request->file); //GET FILE
			$lastkemas 	 	= DB::table('tr_formula_kemas')->max('id_fk');
			$hapus 		 	= FormulaKemas::where('id_ws',$request->id_ws)->delete();
			$changekemas 	= FormulaKemas::where('id_ws', '0')->update(['id_ws'=>$request->id_ws]);
        }
        return redirect::route('datamesin',[$request->id,$request->fs,$request->id_ws])->with(['success' => 'Upload success']);
    }
}