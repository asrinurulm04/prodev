<?php

namespace App\Http\Controllers\formula;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\model\formula\Formula;
use App\model\formula\Fortail;
use Redirect;

class TemplateFormulaController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
        $this->middleware('rule:user_rd_proses' || 'rule:user_produk');
    }

    public function index($for,$pkp,$pro){ // halaman template formula
        $ada          = Fortail::where('formula_id',$pro)->count();
        $formulas     = Formula::join('tr_project_pkp','tr_project_pkp.id_pkp','tr_formulas.workbook_id')->orderBy('pkp_number','asc')->orderBy('versi','asc')->get();
        $formulas_pdf = Formula::join('tr_pdf_project','tr_pdf_project.id_project_pdf','tr_formulas.workbook_pdf_id')->orderBy('pdf_number','asc')->orderBy('versi','asc')->get();
        return view('formula.template')->with([
            'ada'           => $ada,
            'formulas'      => $formulas,
            'formulas_pdf'  => $formulas_pdf,
            'for'           => $for,
            'pro'           => $pro,
            'pkp'           => $pkp
        ]);
    }

    public function template($ftujuan,$wb,$fasal){ // mengambil data dari template yang akan di gunakan
        $namaformAsal   = Formula::where('id',$fasal)->first()->nama_produk;
        $cft            = Fortail::where('formula_id',$fasal)->count();
        $formula_Asal   = Formula::where('id',$fasal)->first();

        $formula_Tujuan = Formula::where('id',$ftujuan)->first();
        $formula_Tujuan->batch   = $formula_Asal->batch;
        $formula_Tujuan->serving = $formula_Asal->serving + $formula_Tujuan->serving;
        $formula_Tujuan->save();
        if($cft>0){ // Ambil Susunan Bahan
            $tfortails=Fortail::where('formula_id',$fasal)->get();
            foreach ($tfortails as $tfortail) {
                $fortails = new Fortail;
                $fortails->formula_id     = $ftujuan ;
                $fortails->kode_komputer  = $tfortail->kode_komputer ;
                $fortails->nama_sederhana = $tfortail->nama_sederhana ;
                $fortails->kode_oracle    = $tfortail->kode_oracle ;
                $fortails->bahan_id       = $tfortail->bahan_id ;
                $fortails->nama_bahan     = $tfortail->nama_bahan ;
                $fortails->nama_bahan1    = $tfortail->nama_bahan1 ;
                $fortails->nama_bahan2    = $tfortail->nama_bahan2 ;
                $fortails->nama_bahan3    = $tfortail->nama_bahan3 ;
                $fortails->nama_bahan4    = $tfortail->nama_bahan4 ;
                $fortails->nama_bahan5    = $tfortail->nama_bahan5 ;
                $fortails->nama_bahan6    = $tfortail->nama_bahan6 ;
                $fortails->nama_bahan7    = $tfortail->nama_bahan7 ;
                $fortails->per_batch      = $tfortail->per_batch ;
                $fortails->per_serving    = $tfortail->per_serving ;
                $fortails->bahan_baku     = $tfortail->bahan_baku ;
                $fortails->alternatif1    = $tfortail->alternatif1 ;
                $fortails->alternatif2    = $tfortail->alternatif2 ;
                $fortails->alternatif3    = $tfortail->alternatif3 ;
                $fortails->alternatif4    = $tfortail->alternatif4 ;
                $fortails->alternatif5    = $tfortail->alternatif5 ;
                $fortails->alternatif6    = $tfortail->alternatif6 ;
                $fortails->alternatif7    = $tfortail->alternatif7 ;
                $fortails->principle      = $tfortail->principle ;
                $fortails->principle1     = $tfortail->principle1 ;
                $fortails->principle2     = $tfortail->principle2 ;
                $fortails->principle3     = $tfortail->principle3 ;
                $fortails->principle4     = $tfortail->principle4 ;
                $fortails->principle5     = $tfortail->principle5 ;
                $fortails->principle6     = $tfortail->principle6 ;
                $fortails->principle7     = $tfortail->principle7 ;
                $fortails->kode_komputer2 = $tfortail->kode_komputer2;
                $fortails->kode_komputer3 = $tfortail->kode_komputer3;
                $fortails->kode_komputer4 = $tfortail->kode_komputer4;
                $fortails->kode_komputer5 = $tfortail->kode_komputer5;
                $fortails->kode_komputer6 = $tfortail->kode_komputer6;
                $fortails->kode_komputer7 = $tfortail->kode_komputer7;
                $fortails->granulasi      = $tfortail->granulasi;
                $fortails->premix         = $tfortail->premix;
                $fortails->save();
            }
        }
        if($formula_Tujuan->workbook_id!=NULL){
            return Redirect()->route('step2',[$ftujuan,$wb,$formula_Tujuan->workbook_id])->with('status','Struktur Formula '.$namaformAsal.' Telah Dimasukan');
        }if($formula_Tujuan->workbook_pdf_id!=NULL){
            return Redirect()->route('step2',[$ftujuan,$wb,$fasal])->with('status','Struktur Formula '.$namaformAsal.' Telah Dimasukan');
        }
    }
}