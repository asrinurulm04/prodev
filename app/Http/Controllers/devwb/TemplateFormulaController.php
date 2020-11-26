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
        $ada= Fortail::where('formula_id',$id)->count();
        $formulas = Formula::all();
        return view('devwb.template')->with([
            'ada' => $ada,
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
                $fortails->nama_bahan1 = $tfortail->nama_bahan1 ;
                $fortails->nama_bahan2 = $tfortail->nama_bahan2 ;
                $fortails->nama_bahan3 = $tfortail->nama_bahan3 ;
                $fortails->nama_bahan4 = $tfortail->nama_bahan4 ;
                $fortails->nama_bahan5 = $tfortail->nama_bahan5 ;
                $fortails->nama_bahan6 = $tfortail->nama_bahan6 ;
                $fortails->nama_bahan7 = $tfortail->nama_bahan7 ;
                $fortails->per_batch = $tfortail->per_batch ;
                $fortails->per_serving = $tfortail->per_serving ;
                $fortails->jenis_timbangan = $tfortail->jenis_timbangan ;
                $fortails->bahan_baku = $tfortail->bahan_baku ;
                $fortails->alternatif1 = $tfortail->alternatif1 ;
                $fortails->alternatif2 = $tfortail->alternatif2 ;
                $fortails->alternatif3 = $tfortail->alternatif3 ;
                $fortails->alternatif4 = $tfortail->alternatif4 ;
                $fortails->alternatif5 = $tfortail->alternatif5 ;
                $fortails->alternatif6 = $tfortail->alternatif6 ;
                $fortails->alternatif7 = $tfortail->alternatif7 ;
                $fortails->principle1 = $tfortail->principle1 ;
                $fortails->principle2 = $tfortail->principle2 ;
                $fortails->principle3 = $tfortail->principle3 ;
                $fortails->principle4 = $tfortail->principle4 ;
                $fortails->principle5 = $tfortail->principle5 ;
                $fortails->principle6 = $tfortail->principle6 ;
                $fortails->principle7 = $tfortail->principle7 ;
                $fortails->kode_komputer2 = $tfortail->kode_komputer2;
                $fortails->kode_komputer3 = $tfortail->kode_komputer3;
                $fortails->kode_komputer4 = $tfortail->kode_komputer4;
                $fortails->kode_komputer5 = $tfortail->kode_komputer5;
                $fortails->kode_komputer6 = $tfortail->kode_komputer6;
                $fortails->kode_komputer7 = $tfortail->kode_komputer7;
                $fortails->granulasi = $tfortail->granulasi;
                $fortails->premix = $tfortail->premix;
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