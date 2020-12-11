<?php

namespace App\Http\Controllers\devwb;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\devnf\allergen_formula;
use App\dev\Formula;
use App\devnf\tb_overage;
use App\pkp\pkp_project;
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

    public function upversion($id){  
        $pkp_hitung = pkp_project::where('id_project',$id)->max('workbook')+1;
		$pkp = pkp_project::where('id_project',$id)->first();
		$pkp->workbook=$pkp_hitung;
        $pkp->save();
        
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
        $formulas->formula = $lastf->formula; 
        $formulas->revisi = $lastf->revisi;                
        $formulas->versi = $cf;
        $formulas->turunan = 0;
        $formulas->jenis = $lastf->jenis;
        $formulas->akg = $lastf->akg;
        $formulas->main_item  = $lastf->main_item;
        $formulas->main_item_eks = $lastf->main_item_eks;
        $formulas->overage='100';
        $formulas->bj = $lastf->bj;
        $formulas->batch = $lastf->batch;
        $formulas->serving = $lastf->serving;
        $formulas->satuan = $lastf->satuan;
        $formulas->berat_jenis = $lastf->berat_jenis;
        $formulas->serving_size = $lastf->serving_size;
        $formulas->liter = $lastf->liter;
        $formulas->kfp_premix = $lastf->kfp_premix;
        $formulas->catatan_rd = $lastf->keterangan;
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
                $fortails->nama_bahan1 = $lastft->nama_bahan1 ;
                $fortails->nama_bahan2 = $lastft->nama_bahan2 ;
                $fortails->nama_bahan3 = $lastft->nama_bahan3 ;
                $fortails->nama_bahan4 = $lastft->nama_bahan4 ;
                $fortails->nama_bahan5 = $lastft->nama_bahan5 ;
                $fortails->nama_bahan6 = $lastft->nama_bahan6 ;
                $fortails->nama_bahan7 = $lastft->nama_bahan7 ;
                $fortails->per_batch = $lastft->per_batch ;
                $fortails->per_serving = $lastft->per_serving ;
                $fortails->jenis_timbangan = $lastft->jenis_timbangan ;
                $fortails->alternatif1 = $lastft->alternatif1;
                $fortails->alternatif2 = $lastft->alternatif2;
                $fortails->alternatif3 = $lastft->alternatif3;
                $fortails->alternatif4 = $lastft->alternatif4;
                $fortails->alternatif5 = $lastft->alternatif5;
                $fortails->alternatif6 = $lastft->alternatif6;
                $fortails->alternatif7 = $lastft->alternatif7;
                $fortails->principle = $lastft->principle;
                $fortails->principle2 = $lastft->principle2;
                $fortails->principle3 = $lastft->principle3;
                $fortails->principle4 = $lastft->principle4;
                $fortails->principle5 = $lastft->principle5;
                $fortails->principle6 = $lastft->principle6;
                $fortails->principle7 = $lastft->principle7;
                $fortails->kode_komputer2 = $lastft->kode_komputer2;
                $fortails->kode_komputer3 = $lastft->kode_komputer3;
                $fortails->kode_komputer4 = $lastft->kode_komputer4;
                $fortails->kode_komputer5 = $lastft->kode_komputer5;
                $fortails->kode_komputer6 = $lastft->kode_komputer6;
                $fortails->kode_komputer7 = $lastft->kode_komputer7;
                $fortails->granulasi = $lastft->granulasi;
                $fortails->premix = $lastft->premix;
                $fortails->save();
   
                $allergen= allergen_formula::where('id_formula',$lastf->id)->count();
                if($allergen>0){
                    $allergen_for= allergen_formula::where('id_formula',$lastf->id)->get();
                    foreach ($allergen_for as $allergen_for)
                    {
                        $allergen_formula = new allergen_formula;
                        $allergen_formula->id_bahan=$allergen_for->id_bahan;
                        $allergen_formula->id_formula=$formulas->id;
                        $allergen_formula->id_fortails=$fortails->id;
                        $allergen_formula->save();
                    }
                }
                
            }
        } 

        $overage = new tb_overage;
        $overage->id_formula=$formulas->id;
        $overage->save();

        return redirect()->route('step1',[$formulas->workbook_id,$formulas->id])->with('status', 'Formula '.$lastf->nama_produk.' Sudah Naik Versi!');
    }

    public function upversion2($id,$revisi){             
        $lastf=Formula::where('id',$id)->first();

        $pkp_hitung = pkp_project::where('id_project',$lastf->workbook_id)->max('workbook')+1;
		$pkp = pkp_project::where('id_project',$lastf->workbook_id)->first();
		$pkp->workbook=$pkp_hitung;
        $pkp->save();

        $last=formula::where('workbook_id',$lastf->workbook_id)->get();
        $lastturunan = $last->where('versi',$revisi)->max('turunan')+1;
        $formulas = new Formula;
        $formulas->workbook_id = $lastf->workbook_id; 
        $formulas->formula = $lastf->formula; 
        $formulas->revisi = $lastf->revisi;
        $formulas->versi = $lastf->versi; // Versi Sama
        $formulas->turunan = $lastturunan; // Turunan Berbeda
        $formulas->akg = $lastf->akg;
        $formulas->jenis = $lastf->jenis;
        $formulas->main_item  = $lastf->main_item;
        $formulas->main_item_eks = $lastf->main_item_eks;
        $formulas->bj = $lastf->bj;
        $formulas->batch = $lastf->batch;
        $formulas->overage='100';
        $formulas->serving = $lastf->serving;
        $formulas->berat_jenis = $lastf->berat_jenis;
        $formulas->satuan = $lastf->satuan;
        $formulas->serving_size = $lastf->serving_size;
        $formulas->liter = $lastf->liter;
        $formulas->kfp_premix = $lastf->kfp_premix;
        $formulas->catatan_rd = $lastf->keterangan;
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
                $fortails->nama_bahan1 = $lastft->nama_bahan1 ;
                $fortails->nama_bahan2 = $lastft->nama_bahan2 ;
                $fortails->nama_bahan3 = $lastft->nama_bahan3 ;
                $fortails->nama_bahan4 = $lastft->nama_bahan4 ;
                $fortails->nama_bahan5 = $lastft->nama_bahan5 ;
                $fortails->nama_bahan6 = $lastft->nama_bahan6 ;
                $fortails->nama_bahan7 = $lastft->nama_bahan7 ;
                $fortails->per_batch = $lastft->per_batch ;
                $fortails->per_serving = $lastft->per_serving ;
                $fortails->jenis_timbangan = $lastft->jenis_timbangan ;
                $fortails->alternatif1 = $lastft->alternatif1;
                $fortails->alternatif2 = $lastft->alternatif2;
                $fortails->alternatif3 = $lastft->alternatif3;
                $fortails->alternatif4 = $lastft->alternatif4;
                $fortails->alternatif5 = $lastft->alternatif5;
                $fortails->alternatif6 = $lastft->alternatif6;
                $fortails->alternatif7 = $lastft->alternatif7;
                $fortails->principle = $lastft->principle;
                $fortails->principle2 = $lastft->principle2;
                $fortails->principle3 = $lastft->principle3;
                $fortails->principle4 = $lastft->principle4;
                $fortails->principle5 = $lastft->principle5;
                $fortails->principle6 = $lastft->principle6;
                $fortails->principle7 = $lastft->principle7;
                $fortails->kode_komputer2 = $lastft->kode_komputer2;
                $fortails->kode_komputer3 = $lastft->kode_komputer3;
                $fortails->kode_komputer4 = $lastft->kode_komputer4;
                $fortails->kode_komputer5 = $lastft->kode_komputer5;
                $fortails->kode_komputer6 = $lastft->kode_komputer6;
                $fortails->kode_komputer7 = $lastft->kode_komputer7;
                $fortails->granulasi = $lastft->granulasi;
                $fortails->premix = $lastft->premix;
                $fortails->save();

                $allergen= allergen_formula::where('id_formula',$lastf->id)->count();
                if($allergen>0){
                    $allergen_for= allergen_formula::where('id_formula',$lastf->id)->get();
                    foreach ($allergen_for as $allergen_for)
                    {
                        $allergen_formula = new allergen_formula;
                        $allergen_formula->id_bahan=$allergen_for->id_bahan;
                        $allergen_formula->id_formula=$formulas->id;
                        $allergen_formula->id_fortails=$fortails->id;
                        $allergen_formula->save();
                    }
                }

            }
        } 

        $overage = new tb_overage;
        $overage->id_formula=$formulas->id;
        $overage->save();
        
        return redirect()->route('step1',[$formulas->workbook_id,$formulas->id])->with('status', 'Formula '.$lastf->nama_produk.' Sudah Naik Versi!');
    }
}
