<?php

namespace App\Http\Controllers\workbookFS;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\model\feasibility\WorkbookFs;
use App\model\feasibility\Feasibility;
use App\model\Modelmesin\Mesin;
use App\model\Modelmesin\OH;
use App\model\Modelmesin\LiniTerdampak;
use App\model\Modelkemas\KonsepKemas;
use App\model\Modelkemas\FormulaKemas;
use Redirect;

class UpFsController extends Controller
{
    public function upProses(Request $request, $ws){
        $WorkbookFs = WorkbookFs::where('id',$ws)->first();
        $fs         = Feasibility::where('id',$WorkbookFs->id_feasibility)->first();
        $opsi       = WorkbookFs::where('type','proses')->where('id_feasibility',$fs->id)->max('opsi')+1;
        
        $add = new WorkbookFs;
        $add->id_feasibility = $WorkbookFs->id_feasibility;
        $add->opsi           = $opsi;
        $add->type           = $WorkbookFs->type;
        $add->save();

        $clm= Mesin::where('id_wb_fs',$ws)->count();
        if($clm>0){
            $mesin= Mesin::where('id_wb_fs',$ws)->get();
            foreach ($mesin as $lastM) {
                $mesins = new Mesin;
                $mesins->id_wb_fs           = $add->id ;
                $mesins->id_data_mesin      = $lastM->id_data_mesin ;
                $mesins->runtime            = $lastM->runtime ;
                $mesins->runtime_granulasi  = $lastM->runtime_granulasi ;
                $mesins->note               = $lastM->note ;
                $mesins->save();
            }
        } 

        $clo= OH::where('id_ws',$ws)->count();
        if($clo>0){
            $oh= OH::where('id_ws',$ws)->get();
            foreach ($oh as $lastO) {
                $oh = new OH;
                $oh->id_ws          = $add->id ;
                $oh->mesin          = $lastO->mesin ;
                $oh->nominal        = $lastO->nominal ;
                $oh->Curren         = $lastO->Curren ;
                $oh->note           = $lastO->note ;
                $oh->save();
            }
        } 

        $lini = LiniTerdampak::where('id_ws',$ws)->first();
        $ln   = new LiniTerdampak;
        $ln->id_ws          = $add->id ;
        $ln->my_contain     = $lini->my_contain ;
        $ln->allergen_baru  = $lini->allergen_baru ;
        $ln->lini_terdampak = $lini->lini_terdampak ;
        $ln->catatan        = $lini->catatan ;
        $ln->no_ref         = $lini->no_ref;
        $ln->save();

        return redirect::back();
    }

    public function upKemas(Request $request, $ws){
        $WorkbookFs = WorkbookFs::where('id',$ws)->first();
        $fs         = Feasibility::where('id',$WorkbookFs->id_feasibility)->first();
        $opsi       = WorkbookFs::where('type','kemas')->where('id_feasibility',$fs->id)->max('opsi')+1;
        
        $add                 = new WorkbookFs;
        $add->id_feasibility = $WorkbookFs->id_feasibility;
        $add->opsi           = $opsi;
        $add->type           = $WorkbookFs->type;
        $add->save();

        $konsep = KonsepKemas::where('id_ws',$ws)->first();
        $kp     = new KonsepKemas;
        $kp->id_ws          = $add->id ;
        $kp->keterangan     = $konsep->keterangan ;
        $kp->batch_size     = $konsep->batch_size ;
        $kp->box_palet      = $konsep->box_palet ;
        $kp->batch_yield    = $konsep->batch_yield ;
        $kp->referensi      = $konsep->referensi ;
        $kp->jumlah_box     = $konsep->jumlah_box ;
        $kp->kubikasi       = $konsep->kubikasi ;
        $kp->created_date   = $konsep->created_date ;
        $kp->save();

        $clm= Mesin::where('id_wb_fs',$ws)->count();
        if($clm>0){
            $mesin= Mesin::where('id_wb_fs',$ws)->get();
            foreach ($mesin as $lastM) {
                $mesins = new Mesin;
                $mesins->id_wb_fs           = $add->id ;
                $mesins->id_data_mesin      = $lastM->id_data_mesin ;
                $mesins->runtime            = $lastM->runtime ;
                $mesins->runtime_granulasi  = $lastM->runtime_granulasi ;
                $mesins->sdm                = $lastM->sdm ;
                $mesins->note               = $lastM->note ;
                $mesins->manual             = $lastM->manual ;
                $mesins->save();
            }
        } 

        $fk = FormulaKemas::where('id_ws',$ws)->count();
        if($fk>0){
            $kemas = FormulaKemas::where('id_ws',$ws)->get();
            foreach ($kemas as $formulaK) {
                $km = new FormulaKemas;
                $km->id_ws          = $add->id ;
                $km->item_code      = $formulaK->item_code ;
                $km->kode_komputer  = $formulaK->kode_komputer ;
                $km->Description    = $formulaK->Description ;
                $km->jlh_pemakaian  = $formulaK->jlh_pemakaian ;
                $km->spek           = $formulaK->spek ;
                $km->supplier       = $formulaK->supplier ;
                $km->min_order      = $formulaK->min_order ;
                $km->harga_uom      = $formulaK->harga_uom ;
                $km->cost_kemas     = $formulaK->cost_kemas ;
                $km->line_mesin     = $formulaK->line_mesin ;
                $km->dus_ppa        = $formulaK->dus_ppa ;
                $km->box_ppa        = $formulaK->box_ppa ;
                $km->batch_ppa      = $formulaK->batch_ppa ;
                $km->unit_ppa       = $formulaK->unit_ppa ;
                $km->dus_net        = $formulaK->dus_net ;
                $km->box_net        = $formulaK->box_net ;
                $km->batch_net      = $formulaK->batch_net ;
                $km->unit_net       = $formulaK->unit_net ;
                $km->waste          = $formulaK->waste ;
                $km->cost_box       = $formulaK->cost_box ;
                $km->cost_dus       = $formulaK->cost_dus ;
                $km->cost_sachet    = $formulaK->cost_sachet ;
                $km->save();
            }
        } 
        return redirect::back();
    }
}