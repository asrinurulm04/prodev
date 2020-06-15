<?php

namespace App\Http\Controllers\devnf;

use Illuminate\Http\Request;
use App\dev\Bahan;
use App\devnf\tb_nutrition;
use App\Http\Controllers\Controller;

class TbHitungBtpController extends Controller
{
    public function index($id){
        $bahan      = Bahan::where('id', $id)->get();
        return view('devnf.nutrition', compact('bahan'));
    }

    public function restore(Request $requet, $id){
        $nutri                  = new tb_nutrition;
        $nutri                  = $request->bahan;
        $nutri->Lemak           = $request->lemak;
        $nutri->SFA             = $request->sfa;
        $nutri->karbohidrat     = $request->karbohidrat;
        $nutri->gula_total      = $request->gula;
        $nutri->laktosa         = $request->laktosa;
        $nutri->sukrosa         = $request->sukrosa;
        $nutri->serat           = $request->serat;
        $nutri->serat_larut     = $request->serat_larut;
        $nutri->protein         = $request->protein;
        $nutri->kalori          = $request->kalori;
        $nutri->na              = $request->na;
        $nutri->k               = $request->k;
        $nutri->ca              = $request->ca;
        $nutri->mg              = $request->mg;
        $nutri->p               = $request->p;
        $nutri->beta            = $request->beta;
        $nutri->cr              = $request->cr;
        $nutri->vit_c           = $request->vit_c;
        $nutri->vit_e           = $request->vit_e;
        $nutri->vit_d           = $request->vit_d;
        $nutri->carnitin        = $request->carnitin;
        $nutri->cla             = $request->cla;
        $nutri->sterol_ester    = $request->sterol;
        $nutri->chondroitin     = $request->condroitin;
        $nutri->omega_3         = $request->omega_3;
        $nutri->dha             = $request->dha;
        $nutri->epa             = $request->epa;
        $nutri->creatine        = $request->creatine;
        $nutri->lysin           = $request->lysin;
        $nutri->glucosamine     = $request->glucosamin;
        $nutri->kolin           = $request->kolin;
        $nutri->mufa            = $request->mufa;
        $nutri->linoleic_acido6 = $request->linoleic_acid;
        $nutri->linoleic_acid   = $request->linoleic;
        $nutri->oleic_acid      = $request->oleic;
        $nutri->sorbitol        = $request->sorbitol;
        $nutri->maltitol        = $request->maltitol;
        $nutri->kafein          = $request->kafein;
        $nutri->kolestrol       = $request->kolestrol;
        $nutri->save();

        return back();
    }
}
