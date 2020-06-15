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

class UpVersionController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
        $this->middleware('rule:user_rd_proses' || 'rule:user_produk');
    }

    public function upversion($cf,$id){  
        $lastversion = Formula::where('workbook_id',$id)->max('versi');
        $myformulas  = Formula::where([
            ['versi',$lastversion],
            ['workbook_id',$id]
            ])->get();
        $lastturunan = $myformulas->max('turunan');                       
        
        $lastf=Formula::where([
            ['workbook_id', $id],
            ['versi', $lastversion],
            ['turunan', $lastturunan],
        ])->first();
        $cf = $lastversion + 1;    

        $formulas = new Formula;
        $formulas->workbook_id = $id;
        $formulas->revisi = $lastf->revisi;                
        $formulas->versi = $cf;
        $formulas->turunan = 0;
        $formulas->kode_formula = $lastf->kode_formula;
        $formulas->nama_produk = $lastf->nama_produk;
        $formulas->produksi_id = $lastf->produksi_id;
        $formulas->maklon_id = $lastf->maklon_id;
        $formulas->gudang_id = $lastf->gudang_id;
        $formulas->jenis = $lastf->jenis;
        $formulas->main_item  = $lastf->main_item;
        $formulas->main_item_eks = $lastf->main_item_eks;
        $formulas->bj = $lastf->bj;
        $formulas->batch = $lastf->batch;
        $formulas->serving = $lastf->serving;
        $formulas->liter = $lastf->liter;
        $formulas->kfp_premix = $lastf->kfp_premix;
        $formulas->keterangan = $lastf->keterangan;
        $formulas->save();

        $clf=Fortail::where('formula_id',$lastf->id)->count();
        if($clf>0){

            $lfortail=Fortail::where('formula_id',$lastf->id)->get();
            foreach ($lfortail as $lastft) {
                $fortails = new Fortail;
                $fortails->formula_id = $formulas->id ;
                $fortails->kode_komputer = $lastft->kode_komputer ;
                $fortails->nama_sederhana = $lastft->nama_sederhana ;
                $fortails->kode_oracle = $lastft->kode_oracle ;
                $fortails->bahan_id = $lastft->bahan_id ;
                $fortails->nama_bahan = $lastft->nama_bahan ;
                $fortails->per_batch = $lastft->per_batch ;
                $fortails->per_serving = $lastft->per_serving ;
                $fortails->jenis_timbangan = $lastft->jenis_timbangan ;
                $fortails->alternatif = $lastft->alternatif;
                $fortails->kode_komputer2 = $lastft->kode_komputer2;
                $fortails->kode_komputer3 = $lastft->kode_komputer3;
                $fortails->kode_komputer4 = $lastft->kode_komputer4;
                $fortails->kode_komputer5 = $lastft->kode_komputer5;
                $fortails->granulasi = $lastft->granulasi;
                $fortails->save();

                $clp=Premix::where('fortail_id',$lastft->id)->count();
                if($clp>0){
                    $lpremix=Premix::where('fortail_id',$lastf->id)->get();
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
                                $pretails = new Pretail;
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
        
        return redirect()->route('step1',$formulas->id)->with('status', 'Formula '.$lastf->nama_produk.' Sudah Naik Versi!');
    }

    public function upversion2($id){                                       
        $lastf=Formula::where('id',$id)->first();        
        $lastturunan = $lastf->turunan + 1;

        $formulas = new Formula;
        $formulas->workbook_id = $lastf->workbook_id; 
        $formulas->revisi = $lastf->revisi;
        $formulas->versi = $lastf->versi; // Versi Sama
        $formulas->turunan = $lastturunan; // Turunan Berbeda
        $formulas->kode_formula = $lastf->kode_formula;
        $formulas->nama_produk = $lastf->nama_produk;
        $formulas->produksi_id = $lastf->produksi_id;
        $formulas->maklon_id = $lastf->maklon_id;
        $formulas->gudang_id = $lastf->gudang_id;
        $formulas->jenis = $lastf->jenis;
        $formulas->main_item  = $lastf->main_item;
        $formulas->main_item_eks = $lastf->main_item_eks;
        $formulas->bj = $lastf->bj;
        $formulas->batch = $lastf->batch;
        $formulas->serving = $lastf->serving;
        $formulas->liter = $lastf->liter;
        $formulas->kfp_premix = $lastf->kfp_premix;
        $formulas->keterangan = $lastf->keterangan;
        $formulas->save();

        $clf=Fortail::where('formula_id',$lastf->id)->count();
        if($clf>0){

            $lfortail=Fortail::where('formula_id',$lastf->id)->get();
            foreach ($lfortail as $lastft) {
                $fortails = new Fortail;
                $fortails->formula_id = $formulas->id ;
                $fortails->kode_komputer = $lastft->kode_komputer ;
                $fortails->nama_sederhana = $lastft->nama_sederhana ;
                $fortails->kode_oracle = $lastft->kode_oracle ;
                $fortails->bahan_id = $lastft->bahan_id ;
                $fortails->nama_bahan = $lastft->nama_bahan ;
                $fortails->per_batch = $lastft->per_batch ;
                $fortails->per_serving = $lastft->per_serving ;
                $fortails->jenis_timbangan = $lastft->jenis_timbangan ;
                $fortails->alternatif = $lastft->alternatif;
                $fortails->kode_komputer2 = $lastft->kode_komputer2;
                $fortails->kode_komputer3 = $lastft->kode_komputer3;
                $fortails->kode_komputer4 = $lastft->kode_komputer4;
                $fortails->kode_komputer5 = $lastft->kode_komputer5;
                $fortails->granulasi = $lastft->granulasi;
                $fortails->save();

                $clp=Premix::where('fortail_id',$lastft->id)->count();
                if($clp>0){
                    $lpremix=Premix::where('fortail_id',$lastf->id)->get();
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
                                $pretails = new Pretail;
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
        return redirect()->route('step1',$formulas->id)->with('status', 'Formula '.$lastf->nama_produk.' Sudah Naik Versi!');
    }
}
