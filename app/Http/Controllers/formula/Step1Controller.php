<?php

namespace App\Http\Controllers\formula;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\model\master\Subbrand;
use App\model\users\User;
use App\model\dev\Formula;
use App\model\dev\DataFormula;
use App\model\pkp\PkpProject;
use Redirect;

class Step1Controller extends Controller
{
    public function __construct(){
        $this->middleware('auth');
        $this->middleware('rule:user_rd_proses' || 'rule:user_produk');
    }
    
    public function create($formula,$pkp,$project){
        $id_for  = $formula;
        $id_pkp  = $pkp;
        $id_pro  = $project;
        $project = PkpProject::where('id_project',$pkp)->first();
        $formula = Formula::where('id',$formula)->first();
        $data    = DataFormula::where('id_formula',$formula)->get();
        return view('formula/step1')->with([
            'formula' => $formula,
            'data'    => $data,
            'project' => $project,
            'idfor'   => $id_for,
            'idpkp'   => $id_pkp,
            'idpro'   => $id_pro
        ]);
    }

    public function step1_pdf($formula,$pro){
        $id_for  = $formula;
        $id_pro  = $pro;
        $formula = Formula::where('id',$formula)->first();
        $data    = DataFormula::where('id_formula',$formula)->get();
        return view('formula/step1_pdf')->with([
            'data'    => $data,
            'formula' => $formula,
            'idfor'   => $id_for,
            'idpro'   => $id_pro
        ]);
    }

    public function update(Request $request, $formula,$wb,$project){
        $id_for = $formula;
        $formula = Formula::where('id',$formula)->first();
        $formula->catatan_rd    = $request->keterangan;
        $formula->note_formula  = $request->formula;
        $formula->serving_size  = $request->serving;
        $formula->formula       = $request->sample;
        $formula->satuan        = $request->satuan;
        $formula->berat_jenis   = $request->berat_jenis;
		if($request->kategori_formula!=NULL){
		    $formula->kategori=$request->kategori_formula;
		}else{
			$formula->kategori='fg';
		}
        $formula->save();

        if($request->file('filename')!=''){
            $files = [];
            foreach ($request->file('filename') as $file) {
            if ($file->isValid()) {
                $nama           = time();
                $nama_file      = time()."_".$file->getClientOriginalName();
                $tujuan_upload  = 'data_file';
                $path           = $file->move($tujuan_upload,$nama_file);
                $form           = $request->id;
                $files[] = [
                    'file'      => $nama_file,
                    'lokasi'    => $path,
                    'id_formula'=> $formula->id,
                ];
                }
            }
            DataFormula::insert($files);
        }

        if($formula->workbook_id!=NULL){
            return Redirect()->route('step2', [$id_for,$wb,$project]);
        }
        if($formula->workbook_pdf_id!=NULL){
            return Redirect()->route('step2', [$id_for,$wb,$project]);
        }
    }
    
    public function hapus_file($id){
        $file = DataFormula::where('id_data',$id)->delete();
        return redirect::back();
    }
}