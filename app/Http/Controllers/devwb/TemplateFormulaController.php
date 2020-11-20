<?php

namespace App\Http\Controllers\devwb;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\dev\Formula;
use App\dev\Fortail;
use App\dev\Premix;
use App\dev\Pretail;
use App\dev\Bahan;
use Redirect;

class TemplateFormulaController extends Controller
{
    public function __construct(){

        $this->middleware('auth');
        $this->middleware('rule:user_rd_proses' || 'rule:user_produk');
    }

    public function index($ftujuan,$id){
        $formulas = Formula::all();
        return view('devwb.template')->with([
            'formulas' => $formulas,
            'ftujuan' => $ftujuan,
            'for' => $id
        ]);
    }

    public function template($ftujuan,$fasal){
        //dd($ftujuan);
        $namaformAsal = Formula::where('id',$fasal)->first()->nama_produk;
        $cft=Fortail::where('formula_id',$fasal)->count();
        $formula_Asal   = Formula::where('id',$fasal)->first();
        $formula_Tujuan = Formula::where('id',$ftujuan)->first();
        $formula_Tujuan->batch   = $formula_Asal->batch;
        $formula_Tujuan->serving = $formula_Asal->serving;
        $formula_Tujuan->save();
        // Ambil Susunan Bahan
        if($cft>0){

            $tfortails=Fortail::where('formula_id',$fasal)->get();
            foreach ($tfortails as $tfortail) {
                $fortails = new Fortail;
                $fortails->formula_id = $ftujuan ;
                $fortails->kode_komputer = $tfortail->kode_komputer ;
                $fortails->nama_sederhana = $tfortail->nama_sederhana ;
                $fortails->kode_oracle = $tfortail->kode_oracle ;
                $fortails->bahan_id = $tfortail->bahan_id ;
                $fortails->nama_bahan = $tfortail->nama_bahan ;
                $fortails->per_batch = $tfortail->per_batch ;
                $fortails->per_serving = $tfortail->per_serving ;
                $fortails->jenis_timbangan = $tfortail->jenis_timbangan ;
                $fortails->alternatif = $tfortail->alternatif ;
                $fortails->kode_komputer2 = $tfortail->kode_komputer2;
                $fortails->kode_komputer3 = $tfortail->kode_komputer3;
                $fortails->kode_komputer4 = $tfortail->kode_komputer4;
                $fortails->kode_komputer5 = $tfortail->kode_komputer5;
                $fortails->granulasi = $tfortail->granulasi;
                $fortails->save();

                $clp=Premix::where('fortail_id',$tfortail->id)->count();
                if($clp>0){
                    $lpremix=Premix::where('fortail_id',$tfortail->id)->get();
                    foreach($lpremix as $lp){
                        $premixs = new Premix;
                        $premixs->fortail_id = $fortails->id;
                        $premixs->utuh = $lp->utuh;
                        $premixs->koma = $lp->koma;
                        $premixs->utuh_cpb = $lp->utuh_cpb;
                        $premixs->koma_cpb = $lp->koma_cpb;
                        $premixs->satuan = $lp->satuan;
                        $premixs->berat = $lp->berat;
                        $premixs->keterangan = $lp->keterangan;
                        $premixs->save();

                        $clpt=Pretail::where('premix_id',$lp->id)->count();
                        if($clpt>0){
                            $lpretail=Pretail::where('premix_id',$lp->id)->get();
                            foreach ($lpretail as $lpt){
                                $pretails =  new Pretail;
                                $pretails->premix_id = $premixs->id;
                                $pretails->premix_ke = $lpt->premix_ke;
                                $pretails->awalan = $lpt->awalan;
                                $pretails->turunan = $lpt->turunan;
                                $pretails->jumlah = $lpt->jumlah;
                                $pretails->kode_kantong = $lpt->kode_kantong;
                                $pretails->save();
                            }
                        }
                    }
                }
            }
        }
        return Redirect()->route('step2',[$formula_Tujuan->workbook_id,$ftujuan])->with('status','Struktur Formula '.$namaformAsal.' Telah Dimasukan');
    }
}