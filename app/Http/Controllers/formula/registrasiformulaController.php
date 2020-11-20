<?php

namespace App\Http\Controllers\formula;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

use App\pkp\pkp_project;
use App\pkp\tipp;
use App\master\subbrand;
use App\formula\registrasi_formula;

use Auth;
use Redirect;

class registrasiformulaController extends Controller
{
    public function __construct(){

        $this->middleware('auth');
        $this->middleware('rule:user_rd_proses' || 'rule:user_produk');
    }

    public function registrasi($id){
        $pkp = tipp::where('id',$id)->get();
        $subbrand = subbrand::all();
        return view('formula/registrasi_formula')->with([
            'pkp' => $pkp,
            'subbrand' => $subbrand
        ]);
    }

    public function new_registrasi(Request $request){
        $registrasi = new registrasi_formula;
        $registrasi->id_pkp=$request->pkp;
        $registrasi->company=$request->company;
        $registrasi->category=$request->categori;
        $registrasi->data_category=$request->data_category;
        $registrasi->brand=$request->brand;
        $registrasi->subbrand=$request->subbrand;
        $registrasi->serving_size=$request->serving_size;
        $registrasi->penetapan_serving_size=$request->penetapan_target;
        $registrasi->satuan=$request->satuan;
        $registrasi->berat_jenis=$request->berat_jenis;
        $registrasi->jlh_air_serving=$request->jlh_air_serving;
        $registrasi->nama_formula=$request->nama_formula;
        $registrasi->alokasi_formula=$request->alokasi;
        $registrasi->rasio_batch=$request->rasio;
        $registrasi->lokasi_plant=$request->plat_produksi;
        $registrasi->lokasi_proses_persiapan=$request->lokasi;
        $registrasi->formula_product=$request->for;
        $registrasi->kfp_internal=$request->kfp_internal;
        $registrasi->kfp_maklon=$request->kfp_maklon;
        $registrasi->intruksi_proses=$request->intruksi_proses;
        $registrasi->lini_internal=$request->lini_internal;
        $registrasi->lini_maklon=$request->lini_maklon;
        $registrasi->lini_proses=$request->lini_proses;
        $registrasi->io_internal=$request->io_internal;
        $registrasi->io_maklon=$request->io_maklon;
        $registrasi->io_prosess=$request->io_proses;
        $registrasi->allergen_internal=$request->allergen_internal;
        $registrasi->allergen_maklon=$request->allergen_maklon;
        $registrasi->allergen_proses=$request->allergen_proses;
        $registrasi->catatan=$request->catatan;
        $registrasi->save();

        return redirect::route('penyusunan.formula',[$registrasi->id_registrasi,$request->pkp]);
    }
}
