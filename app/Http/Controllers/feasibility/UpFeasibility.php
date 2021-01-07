<?php

namespace App\Http\Controllers\feasibility;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Redirect;

use App\model\dev\Formula;
use App\model\Modelfn\finance;
use App\model\Modelmesin\Dmesin;//banyak
use App\model\Modellab\Dlab;//satu
use App\model\Modelkemas\konsep;//satu
use App\model\Modelkemas\userkemas;//banyak
use App\model\Modelfn\pesan;//satu

class UpFeasibility extends Controller
{
    public function __construct(){

        $this->middleware('auth');
    }

    public function index($id){
        $hitung_feasibility_terakhir = finance::where('id_formula',$id)->count();
        $feasibility_terakhir = finance::where('kemungkinan',$hitung_feasibility_terakhir)->first();
        
        //upFeasibility
        $feasibility_baru = new finance;
        $feasibility_baru->id_formula = $id;
        $feasibility_baru->kemungkinan = $hitung_feasibility_terakhir+1;
        // $feasibility_baru->status_mesin = $feasibility_terakhir->status_mesin;
        // $feasibility_baru->status_kemas = $feasibility_terakhir->status_kemas;
        $feasibility_baru->status_lab = $feasibility_terakhir->status_lab;
        // $feasibility_baru->message = $feasibility_terakhir->message;
        $feasibility_baru->save();

        //upUserKemas
        $check_last_userkemas = userkemas::where('id_feasibility',$feasibility_terakhir->id)->count();
        if($check_last_userkemas > 0){
            $last_userkemas = userkemas::where('id_feasibility',$feasibility_terakhir->id)->get();
            foreach($last_userkemas as $luk){
                $userkemas = new userkemas;
                $userkemas->id_feasibility = $feasibility_baru->id;
                $userkemas->nama_sku = $luk->nama_sku;
                $userkemas->formula_item = $luk->formula_item;
                $userkemas->kode_sku = $luk->kode_sku;
                $userkemas->jumlah_primer = $luk->jumlah_primer;
                $userkemas->jumlah_kemasan = $luk->jumlah_kemasan;
                $userkemas->gramasi = $luk->gramasi;
                $userkemas->no_formula = $luk->no_formula;
                $userkemas->jenis = $luk->jenis;
                $userkemas->revisi = $luk->revisi;
                $userkemas->tgl_berlaku = $luk->tgl_berlaku;
                $userkemas->jumlah_batch = $luk->jumlah_batch;
                $userkemas->jumlah_batch_box = $luk->jumlah_batch_box;
                $userkemas->keterangan = $luk->keterangan;
                $userkemas->user = $luk->user;
                $userkemas->item_code = $luk->item_code;
                $userkemas->kode_komputer = $luk->kode_komputer;
                $userkemas->supplier = $luk->supplier;
                $userkemas->dimensi = $luk->dimensi;
                $userkemas->unit_dimensi = $luk->unit_dimensi;
                $userkemas->spek = $luk->spek;
                $userkemas->line_mesin = $luk->line_mesin;
                $userkemas->dus_ppa = $luk->dus_ppa;
                $userkemas->box_ppa = $luk->box_ppa;
                $userkemas->batch_ppa = $luk->batch_ppa;
                $userkemas->unit_ppa = $luk->unit_ppa;
                $userkemas->dus_net = $luk->dus_net;
                $userkemas->box_net = $luk->box_net;
                $userkemas->batch_net = $luk->batch_net;
                $userkemas->unit_net = $luk->unit_net;
                $userkemas->waste = $luk->waste;
                $userkemas->min_order = $luk->min_order;
                $userkemas->unit_order = $luk->unit_order;
                $userkemas->harga_uom = $luk->harga_uom;
                $userkemas->cost = $luk->cost;
                $userkemas->Description = $luk->Description;
                $userkemas->save();
            }
        }

        //uplab
        $check_last_lab = Dlab::where('id_feasibility',$feasibility_terakhir->id)->count();
        if($check_last_lab > 0){

            $last_lab = Dlab::where('id_feasibility',$feasibility_terakhir->id)->first();
            $lab = new Dlab;
            $lab->id_feasibility = $feasibility_baru->id;
            $lab->rever_exist = $last_lab->rever_exist;
            $lab->nama_item = $last_lab->nama_item;
            $lab->jumlah_sample = $last_lab->jumlah_sample;
            $lab->parameter = $last_lab->parameter;
            $lab->total = $last_lab->total;
            $lab->save();
        }

        //uppesan
        $check_last_pesan = pesan::where('id_feasibility',$feasibility_terakhir->id)->count();
        if($check_last_pesan > 0){

            $last_pesan = pesan::where('id_feasibility',$feasibility_terakhir->id)->first();
            $pesan = new pesan;
            $pesan->id_feasibility = $feasibility_baru->id;
            $pesan->pengirim = $last_pesan->pengirim;
            $pesan->user = $last_pesan->user;
            $pesan->subject = $last_pesan->subject;
            $pesan->message = $last_pesan->message;
            $pesan->save();
        }

        //upkonsep
        $check_last_konsep = konsep::where('id_feasibility',$feasibility_terakhir->id)->count();
        if($check_last_konsep > 0){

            $last_konsep = konsep::where('id_feasibility',$feasibility_terakhir->id)->first();
            $konsep = new konsep;
            $konsep->id_feasibility = $feasibility_baru->id;
            $konsep->konsep = $last_konsep->konsep;
            $konsep->primer = $last_konsep->primer;
            $konsep->s_primer = $last_konsep->s_primer;
            $konsep->sekunder = $last_konsep->sekunder;
            $konsep->s_sekunder = $last_konsep->s_sekunder;
            $konsep->tersier = $last_konsep->tersier;
            $konsep->s_tersier = $last_konsep->s_tersier;
            $konser->save();

        }

        //upmesin
        $check_last_mesin = Dmesin::where('id_feasibility',$feasibility_terakhir->id)->count();
        if($check_last_mesin > 0){
            $last_mesin = Dmesin::where('id_feasibility',$feasibility_terakhir->id)->get();
            foreach ($last_mesin as $mes) {
                $mesin = new Dmesin;
                $mesin->id_feasibility = $feasibility_baru->id;
                $mesin->id_data_mesin = $mes->is_data_mesin;
                $mesin->runtime = $mes->runtime;
                $mesin->SDM = $mes->SDM;
                $mesin->rate_mesin = $mes->rate_mesin;
                $mesin->rate_sdm = $mes->rate_sdm;
                $mesin->standar_sdm = $mes->standar_sdm;
                $mesin->save();
            }
        }
        return redirect()->back();
    }
}