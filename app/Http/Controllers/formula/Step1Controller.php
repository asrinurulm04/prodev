<?php

namespace App\Http\Controllers\formula;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\model\master\Subbrand;
use App\model\users\User;
use App\model\dev\Formula;
use App\model\dev\DataFormula;
use Redirect;

class Step1Controller extends Controller
{
    public function __construct(){
        $this->middleware('auth');
        $this->middleware('rule:user_rd_proses' || 'rule:user_produk');
    }
    
    public function create($formula,$id){
        $formula = Formula::where('id',$id)->first();
        $subbrands = Subbrand::all();
        $idfor = $formula->workbook_id;
        $idf = $id;
        $data = DataFormula::where('id_formula',$id)->get();
        return view('formula/step1')->with([
            'idf' => $idf,
            'subbrands' => $subbrands,
            'formula' => $formula,
            'data' => $data,
            'idfor' => $idfor
        ]);
    }

    public function step1_pdf($formula,$id){
        $subbrands = Subbrand::all();
        $formula = Formula::where('id',$id)->first();
        $idfor_pdf = $formula->workbook_pdf_id;
        $idf = $id;
        $data = DataFormula::where('id_formula',$id)->get();
        return view('formula/step1_pdf')->with([
            'idf' => $idf,
            'data' => $data,
            'formula' => $formula,
            'subbrands' => $subbrands,
            'idfor_pdf' => $idfor_pdf
        ]);
    }

    public function update($formula,$id,Request $request){
        $formula = Formula::where('id',$formula)->first();
        $formula->catatan_rd = $request->keterangan;
        $formula->note_formula = $request->formula;
        $formula->serving_size = $request->serving;
        $formula->formula = $request->sample;
        $formula->satuan = $request->satuan;
        $formula->berat_jenis = $request->berat_jenis;
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
                $nama = time();
                $nama_file = time()."_".$file->getClientOriginalName();
                $tujuan_upload = 'data_file';
                $path = $file->move($tujuan_upload,$nama_file);
                $form=$request->id;
                $files[] = [
                    'file' => $nama_file,
                    'lokasi' => $path,
                    'id_formula' => $formula->id,
                ];
                }
            }
            DataFormula::insert($files);
        }

        if($formula->workbook_id!=NULL){
            return Redirect()->route('step2', [$formula->workbook_id,$formula->id]);
        }
        if($formula->workbook_pdf_id!=NULL){
            return Redirect()->route('step2', [$formula->workbook_pdf_id,$formula->id]);
        }
    }
    
    public function hapus_file($id){
        $file = DataFormula::where('id_data',$id)->delete();
        return redirect::back();
    }
}