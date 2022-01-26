<?php

namespace App\Http\Controllers\RDproses;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;

use App\model\pdf\SubPDF;
use App\model\pdf\ProjectPDF;
use App\model\pkp\PkpProject;
use App\model\master\Curren;
use App\model\formula\Fortail;
use App\model\formula\Formula;
use App\model\nutfact\AllergenBB;
use App\model\Modelmesin\Mesin;
use App\model\Modelmesin\OH;
use App\model\Modelmesin\IO;
use App\model\Modelmesin\LiniTerdampak;
use App\model\Modelmesin\datamesin;
use App\model\modelkemas\KonsepKemas;
use App\model\Modelkemas\FormulaKemas;
use App\model\feasibility\WorkbookFs;
use App\model\feasibility\Feasibility;
use Auth;
use Redirect;

class MesinController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
    }

    public function index(Request $request,$id,$fs,$ws){
        $wsMesin    = datamesin::select(['workcenter'])->distinct()->get();
        if(Auth::user()->departement_id=='2'){ // jika user memiliki id dept "2" maka bagian ini yang akan di jalankan
            $kategori   = datamesin::where('kategori','!=','Filling')->where('kategori','!=','Packing')->select(['kategori'])->distinct()->get();
            $mesins     = datamesin::where('kategori','!=','Filling')->where('kategori','!=','Packing')->get();
            $Mdata      = DB::table('tr_mesin')->join('ms_mesin','tr_mesin.id_data_mesin','=','ms_mesin.id_data_mesin')->where('id_wb_fs',$ws)->where('kategori','!=','Filling')->where('kategori','!=','Packing')->get();
            $WorkbookFs = WorkbookFs::where('type','proses')->where('id','!=',$ws)->get();
        }elseif(Auth::user()->departement_id=='1'){ // jika user memiliki id dept "1" maka bagian ini yang akan di jalankan 
            $kategori   = datamesin::where('kategori','Filling')->orwhere('kategori','Packing')->select(['kategori'])->distinct()->get();
            $mesins     = datamesin::where('kategori','Filling')->orwhere('kategori','Packing')->get();
            $Mdata      = DB::table('tr_mesin')->join('ms_mesin','tr_mesin.id_data_mesin','=','ms_mesin.id_data_mesin')->where('id_wb_fs',$ws)->orwhere('kategori','Filling')->where('kategori','Packing')->get();
            $WorkbookFs = WorkbookFs::where('type','kemas')->where('id','!=',$ws)->get();
        }
        $Mdata2     = DB::table('tr_mesin')->where('manual','!=',NULL)->where('id_wb_fs',$ws)->get();
        $lokasi     = Mesin::join('ms_mesin','ms_mesin.id_data_mesin','tr_mesin.id_data_mesin')->where('kategori','!=','Filling')->where('kategori','!=','Packing')
                    ->join('tr_workbook_fs','tr_workbook_fs.id','tr_mesin.id_wb_fs')->where('id_feasibility',$fs)->join('tr_feasibility','tr_feasibility.id','tr_workbook_fs.id_feasibility')->select('id_wb_fs','IO')->distinct()->get();
        $hitung     = DB::table('tr_mesin')->where('id_wb_fs',$ws)->count();
        $wb         = WorkbookFs::where('id',$ws)->first();
        $fs         = Feasibility::where('id',$wb->id_feasibility)->first();
        $pkp        = PkpProject::where('id_project',$id)->where('status_project','=','active')->first();
        $pdf        = SubPDF::where('pdf_id',$id)->where('status_pdf','active')->first();
        return view('RDproses.datamesin')->with([
            'mesins'        => $mesins,
            'Mdata'         => $Mdata,
            'Mdata2'        => $Mdata2,
            'id'            => $id,
            'ws'            => $ws,
            'lokasi'        => $lokasi,
            'wsMesin'       => $wsMesin,
            'kategori'      => $kategori,
            'WorkbookFs'    => $WorkbookFs,
            'fs'            => $fs,
            'wb'            => $wb,
            'pkp'           => $pkp,
            'pdf'           => $pdf,
            'hitung'        => $hitung
        ]);
    }

    public function AllergenBaru($id,$fs,$ws){
        $pkp    = PkpProject::where('id_project',$id)->first();
        $pdf    = SubPDF::where('pdf_id',$id)->join('tr_pdf_project','tr_pdf_project.id_project_pdf','tr_sub_pdf.pdf_id')->where('status_pdf','active')->first();
        $count  = LiniTerdampak::where('id_ws',$ws)->count();
        $lini   = LiniTerdampak::where('id_ws',$ws)->first();
        $ws     = WorkbookFs::where('id',$ws)->first();
        $fs     = Feasibility::where('id',$ws->id_feasibility)->first();
        $all    = Fortail::where('formula_id',$fs->id_formula)->join('tr_bb_allergen','tr_bb_allergen.id_bb','tr_fortails.bahan_id')->get();
        $bahan  = Fortail::where('formula_id',$fs->id_formula)->join('tr_bb_allergen','tr_bb_allergen.id_bb','tr_fortails.bahan_id')->select('bahan_id')->distinct()->get();
        return view('RDproses.allergenBaru')->with([
            'pkp'   => $pkp,
            'pdf'   => $pdf,
            'lini'  => $lini,
            'bahan' => $bahan,
            'all'   => $all,
            'count' => $count,
            'fs'    => $fs,
            'ws'    => $ws,
            'ws'    => $ws
        ]);
    }

    public function lini(Request $request){ // lini allergen terdampak
        $hitung = LiniTerdampak::where('id_ws',$request->ws)->count();
        if($hitung=='0'){
            $lini = new LiniTerdampak;
        }elseif($hitung!='0'){
            $lini = LiniTerdampak::where('id_ws',$request->ws)->first();
        }
        $lini->id_ws            = $request->ws;
        $lini->my_contain       = $request->my_contain;
        $lini->allergen_baru    = $request->allergen;
        $lini->lini_terdampak   = $request->lini;
        $lini->catatan          = $request->note;
        $lini->no_ref           = $request->ref;
        $lini->save();

        return redirect::back();
    }

    public function judul(Request $request){ // menambahkan judul workbook proses
        $ws = WorkbookFs::where('id',$request->ws)->first();
        $ws->name=$request->judul;
        $ws->note=$request->remarks;
        $ws->save();
        
        return redirect::route('workbookfs',[$request->id,$request->fs]);
    }

    public function dataOH($id,$fs,$ws){
        $wb     = WorkbookFs::where('id',$ws)->first();
        $fs     = Feasibility::where('id',$wb->id_feasibility)->first();
        $pkp    = PkpProject::where('id_project',$id)->first();
        $pdf    = SubPDF::where('pdf_id',$id)->join('tr_pdf_project','tr_pdf_project.id_project_pdf','tr_sub_pdf.pdf_id')->where('status_pdf','active')->first();
        $dataO  = OH::where('id_ws',$ws)->get();
        $countO = OH::where('id_ws',$ws)->count();
        $hitung = DB::table('tr_dataoh')->where('id_ws',$ws)->count();
        $Curren = Curren::all();
        return view('RDproses.dataoh')->with([
            'id'     => $id,
            'pkp'    => $pkp,
            'pdf'    => $pdf,
            'ws'     => $ws,
            'fs'     => $fs,
            'Curren' => $Curren,
            'dataO'  => $dataO,
            'countO' => $countO,
            'hitung' => $hitung
        ]);
    }

    public function destroy($id){ // menghapus data mesin yang telah di pilih
        $mesin = Mesin::where('id_mesin',$id)->delete();
        return redirect::back()->with('alert', 'Data berhasil dihapus!');
    }

    public function Mdata(Request $request){ // menambahkan multiple mesin yang akan di gunakan 
        $ms= new Mesin;
        foreach ($request->input("pmesin") as $pmesin){
            $add_mesin = new Mesin;
            $add_mesin->id_wb_fs        = $request->id_ws;
            $add_mesin->id_data_mesin   = $pmesin;
            $add_mesin->save();
        }
        return redirect()->back();
    }

    public function runtime(Request $request){ // menambahkan informasi runtime pada mesin yang telah di pilih
        $scores = $request->input('scores');
        foreach($scores as $row){
            $mesin = Mesin::where('id_mesin',$row['id'])->update([
                "runtime"           => $row['runtime'],
                "note"              => $row['note'],
                "sdm"               => $row['sdm'],
                "runtime_granulasi" => $row['granul']
            ]);
        }

        if($request->mesin!=NULL){ // jika terdapat request mesin manual maka bagian ini akan di jalankan
            $data      = array(); 
            $delete    = Mesin::where('manual','!=',NULL)->where('id_wb_fs',$request->ws)->delete();
            $validator = Validator::make($request->all(), $data);  
            if ($validator->passes()) {
                $mesin    = implode(',', $request->input('mesin'));
                $Dmensin  = explode(',', $mesin);
                $runtime  = implode(',', $request->input('runtime'));
                $Druntime = explode(',', $runtime);
                $note     = implode(',', $request->input('note'));
                $Dnote    = explode(',', $note);
                $sdm      = implode(',', $request->input('sdm'));
                $Dsdm     = explode(',', $sdm);
                for ($i = 0; $i < count($Dmensin); $i++){
                    if($Dmensin[$i]!='-'){
                        $pipeline = new Mesin;
                        $pipeline->id_wb_fs = $request->ws;
                        $pipeline->manual   = $Dmensin[$i];
                        $pipeline->runtime  = $Druntime[$i];
                        $pipeline->sdm      = $Dsdm[$i];
                        $pipeline->note     = $Dnote[$i];
                        $pipeline->save();
                        $i = $i++;
                    }
                }
            }
        }
        if(Auth::user()->departement_id=='2'){ // jika user yang meng akses adalah user proses maka halaman akan di alihkan ke halaman dataOH
            return redirect::route('dataOH',[$request->idd,$request->fs,$request->ws]);
        }elseif(Auth::user()->departement_id=='1'){ // jika user yang meng akses adalah user kemas, maka halaman akan di alihkan ke halaman summary kemasan
            return redirect::route('hasilnya',[$request->idd,$request->fs,$request->ws]);
        }
    }

    public function ohOther(Request $request){
        $rules = array(); 
        $oh = OH::where('id_ws',$request->id_ws)->delete();
        $validator = Validator::make($request->all(), $rules);  
        if ($validator->passes()) {
            $idz   = implode(",", $request->input('mesin'));
            $ids   = explode(",", $idz);
            $tgz   = implode(",", $request->input('nominal'));
            $tgs   = explode(",", $tgz);
            $tgc   = implode(",", $request->input('curren'));
            $tgd   = explode(",", $tgc);
            $tga   = implode(",", $request->input('note'));
            $tgb   = explode(",", $tga);
            for ($i = 0; $i < count($ids); $i++){
                $pipeline = new OH;
                $pipeline->id_ws        = $request->id_ws;
                $pipeline->mesin        = $ids[$i];
                $pipeline->nominal      = $tgs[$i];
                $pipeline->Curren       = $tgd[$i];
                $pipeline->note         = $tgb[$i];
                $pipeline->save();
                $i = $i++;
            }
        }
        return redirect::route('AllergenBaru',[$request->id,$request->fs,$request->id_ws]);
    }

    public function useMesin($id,$ws){ // menambahkan data dari project FS berbeda
        $clf=Mesin::where('id_wb_fs',$id)->count();
        if($clf>0){
            $isimesin=Mesin::where('id_wb_fs',$id)->get();
            foreach ($isimesin as $ms){
                $tip= new Mesin;
                $tip->id_wb_fs          = $ws;
                $tip->id_data_mesin     = $ms->id_data_mesin;
                $tip->sdm               = $ms->sdm;
                $tip->manual            = $ms->manual;
                $tip->runtime           = $ms->runtime;
                $tip->runtime_granulasi = $ms->runtime_granulasi;
                $tip->note              = $ms->note;
                $tip->save();
            }
        }
        return redirect::back();
    }
}