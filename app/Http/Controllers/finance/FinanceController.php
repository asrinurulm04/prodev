<?php

namespace App\Http\Controllers\finance;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
use Redirect;
use Input;
use Validator;

use App\Modelmesin\Dmesin;
use App\Modelmesin\oh;
use App\Modelfn\finance;
use App\Modelfn\pesan;
use App\dev\Formula;
use App\Modellab\Dlab;
use App\modelkemas\konsep;
use App\Modelkemas\userkemas;
use App\Modelmesin\aktifitasOH;
use App\Modelmesin\workcenter;
use App\Modelmesin\datamesin;
use App\dev\Bahan;
use App\master\Curren;
use App\dev\Fortail;
use Auth;

class FinanceController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
        $this->middleware('rule:finance');
    }

    public function indexx($id,$id_feasibility){
        $Mdata = Dmesin::with('meesin')->get()->where('id_feasibility', $id_feasibility);
        $dataO = oh::with('dataoh')->get()->where('id_feasibility', $id_feasibility);
        $fe=finance::find($id_feasibility);
        $formula = Formula::where('id',$id)->first();
        $Jlab = Dlab::where('id_feasibility',$id_feasibility)->sum('rate');
        $Jmesin = Dmesin::where('id_feasibility',$id_feasibility)->sum('hasil');
        $Joh = oh::where('id_feasibility',$id_feasibility)->sum('hasil');
        $total = $Jmesin+$Joh;
        $dataL =Dlab::where('id_feasibility',$id_feasibility)->get();
        $kemas =userkemas::where('id_feasibility', $id_feasibility)->get();
        $dataF = finance::where('id_feasibility', $id_feasibility)->get();
        return view('finance.finance')->with([
            'id_feasibility' => $id_feasibility,
            'fe' => $fe,
            'kemas' => $kemas,
            'Mdata' => $Mdata,
            'id' => $id,
            'formula' => $formula,
            'total' => $total,
            'jlab' =>$Jlab,
            'dataL' => $dataL,
            'dataO' => $dataO,
            'dataF' => $dataF
        ]);
    }

    public function summary($id,$id_feasibility){
        $Mdata = Dmesin::with('meesin')->get()->where('id_feasibility', $id_feasibility);
        $dataO = oh::with('dataoh')->get()->where('id_feasibility', $id_feasibility);
        $fe=finance::find($id_feasibility);
        $dataL =Dlab::where('id_feasibility',$id_feasibility)->get();
        $kemas =userkemas::where('id_feasibility', $id_feasibility)->get();
        $dataF = finance::where('id_feasibility', $id_feasibility)->get();
        return view('finance.hasilakhir')->with([
            'id_feasibility' => $id_feasibility,
            'fe' => $fe,
            'kemas' => $kemas,
            'Mdata' => $Mdata,
            'id' => $id,
            'dataL' => $dataL,
            'dataO' => $dataO,
            'dataF' => $dataF
        ]);
    }

    public function inboxfn($id,$id_feasibility){
        $inboxs = pesan::all()->sortByDesc('created_at');
        $dataF = finance::where('id_feasibility', $id_feasibility)->get();
        return view('finance.inboxfn')->with([
            'id_feasibility' => $id_feasibility,
            'inboxs' => $inboxs,
            'id' => $id,
            'dataF' => $dataF
        ]);
    }

    public function komentar(Request $request,$id,$id_feasibility){
        $dataF = finance::where('id_feasibility', $id_feasibility)->get();
        $fe=finance::find($id_feasibility);
        $id = $request->session()->get('id_feasibility');
        return view('finance.komentar')->with([
            'id_feasibility' => $id_feasibility,
            'fe' => $fe,
            'id' => $id,
            'dataF' => $dataF
        ]);
    }

    public function pesan(Request $request,$id,$id_feasibility){
        $dataF = finance::where('id_feasibility', $id_feasibility)->get();
        $fe=finance::find($id_feasibility);
        $id = $request->session()->get('id_feasibility');
        return view('finance.pesan')->with([
            'id_feasibility' => $id_feasibility,
            'fe' => $fe,
            'id' => $id,
            'dataF' => $dataF
        ]);
    }

    public function pesankemas(Request $request,$id,$id_feasibility){
        $dataF = finance::where('id_feasibility', $id_feasibility)->get();
        $fe=finance::find($id_feasibility);
        $id = $request->session()->get('id_feasibility');
        return view('finance.Pkemas')->with([
            'id_feasibility' => $id_feasibility,
            'fe' => $fe,
            'id' => $id,
            'dataF' => $dataF
        ]);
    }

    public function store(Request $request,$id){
        $fnn= new pesan;
        $fnn->id_feasibility=$request->finance;
        $fnn->pengirim=Auth::user()->name;
        $fnn->user='inputor';
        $fnn->subject=$request->sub;
        $fnn->message=$request->get('mail');
        $fnn->save();

        $change_status  = finance::where('id_feasibility',$request->finance)->first();
        $change_status->status_mesin='belum selesai';
        $change_status->save();

    	return redirect()->back();
    }

    public function Pkemas(Request $request,$id){
        $fnn= new pesan;
        $fnn->id_feasibility=$request->finance;
        $fnn->pengirim=Auth::user()->name;
        $fnn->user='kemas';
        $fnn->subject=$request->sub;
        $fnn->message=$request->get('mail');
        $fnn->save();

        $change_status  = finance::where('id_feasibility',$request->finance)->first();
        $change_status->status_kemas='belum selesai';
        $change_status->save();

    	return redirect()->back();
    }

    public function kirim(Request $request,$id){
        $fnn= new pesan;
        $fnn->id_feasibility=$request->finance;
        $fnn->pengirim=Auth::user()->name;
        $fnn->user='produksi';
        $fnn->subject=$request->sub;
        $fnn->message=$request->get('mail');
        $fnn->save();

        $change_status  = finance::where('id_feasibility',$request->finance)->first();
        $change_status->status_sdm='belum selesai';
        $change_status->save();

    	return redirect()->back();
    }

    public function DMmesin($id,$id_feasibility){
        $formulas = Formula::where('id',$id)->get();
        $konsep= konsep::where('id_feasibility', $id_feasibility)->get();
        $mesins = datamesin::all();
        $messin = DB::table('fs_datamesin')->select(['workcenter'])->distinct()->get();
        $Mdata = Dmesin::with('meesin')->get()->where('id_feasibility', $id_feasibility);
        $dataF = finance::where('id_feasibility', $id_feasibility)->get();
        $fe=finance::find($id_feasibility);
        return view('finance.DMmesin')->with([
            'id_feasibility' => $id_feasibility,
            'fe' => $fe,
            'konsep' => $konsep,
			'formulas' => $formulas,
            'mesins' => $mesins,
            'Mdata' => $Mdata,
            'dataF' => $dataF,
            'id' => $id,
            'messin' => $messin
        ]);
    }

    public function DMoh($id,$id_feasibility){
        $aktifitas = aktifitasOH::all();
        $dataF = finance::where('id_feasibility', $id_feasibility)->get();
        $fe=finance::find($id_feasibility);
        $dataO = oh::with('dataoh')->get()->where('id_feasibility', $id_feasibility);
        return view('finance.DMoh')->with([
            'dataF' => $dataF,
            'fe'=> $fe,
            'id' => $id,
            'id_feasibility' => $id_feasibility,
            'aktifitas' => $aktifitas,
            'dataO' => $dataO
        ]);
    }

    public function createDMmesin(Request $request){
        $ms= new Dmesin;
        foreach ($request->input("pmesin") as $pmesin){
            $add_mesin = new Dmesin;
            $add_mesin->id_feasibility=$request->finance;
            $add_mesin->rate_mesin=$request->rate;
            $add_mesin->id_data_mesin= $pmesin;
            $add_mesin->save();
        }
        return redirect()->back();
    }

    public function createDMoh(Request $request){
        $aktifitas= new oh;
        foreach ($request->input("oh") as $oh){
            $add_oh = new oh;
            $add_oh->id_feasibility=$request->finance;
            $add_oh->rate_aktifitas=$request->rateoh;
            $add_oh->id_aktifitasOH= $oh;
            $add_oh->save();
        }
        return redirect()->back();
    }

    public function updateMesin(Request $request, $id_mesin ,$id_data_mesin){
        $check = array(
            $request->standar,
            $request->data
        );

        if(!empty($check[0])){
            $data_mesin = Dmesin::where('id_mesin', $id_mesin)->first();
            $data_mesin->runtime;
            $data_mesin->jlh_sdm;
            $data_mesin->standar_sdm=$request->std_sdm;
            $data_mesin->rate_mesin=$request->hargaM;

            $standar =  $data_mesin->standar_sdm;
            $sdm =  $data_mesin->SDM;
            $runtime = $data_mesin->runtime;
            $rate = $data_mesin->rate_mesin;

            $hasil = ((($sdm/$standar)*$runtime)/60)*$rate;
            $data_mesin->hasil =$hasil;
            $data_mesin->save();
        }
        if(!empty($check[1])){
            $data = datamesin::where('id_data_mesin', $id_data_mesin)->first();
            $data->standar_sdm=$request->std_sdm;
            $data->rate_mesin=$request->hargaM;
            $data->save();
        }
        return redirect()->back();
    }

    public function destroy($id){
        $mesin = Dmesin::find($id);
        $mesin->delete();
        return redirect::back()->with('message', 'Data berhasil dihapus!');
    }

    public function destroyoh($id){
        $mesin = oh::find($id);
        $mesin->delete();
        return redirect::back();
    }

    public function status(Request $request,$id, $id_feasibility){
        $statuss=finance::where('id_feasibility',$id_feasibility)->first();
        $statuss->status_finance=$request->statusF;
        $statuss->status_kemas=$request->statusK;
        $statuss->status_SDM=$request->statusS;
        $statuss->status_mesin=$request->statusM;
        $statuss->save();
        return redirect()->route('myFeasibility',$id);
    }

    public function akhir($id_feasibility){
        $Mdata = Dmesin::with('meesin')->get()->where('id_feasibility', $id_feasibility);
        $dataO = oh::with('dataoh')->get()->where('id_feasibility', $id_feasibility);
        $fe=finance::find($id_feasibility);
        $dataF = finance::with('formula')->get()->where('id_feasibility', $id_feasibility)->first();
        return view('finance.akhir')->with([
            'id_feasibility' => $id_feasibility,
            'fe' => $fe,
            'Mdata' => $Mdata,
            'dataO' => $dataO,
            'dataF' => $dataF
        ]);
    }

    public function kemasan($id, $id_feasibility){
        $fe=finance::find($id_feasibility);
		$kemas =userkemas::where('id_feasibility', $id_feasibility)->get();
        $dataF = finance::where('id_feasibility', $id_feasibility)->get();
        return view('finance.kemas',['fe'=>$fe], compact('toImport'))
			->with(['dataF' => $dataF])
            ->with(['kemas' => $kemas])
            ->with(['id' => $id])
        ->with(['id_feasibility' => $id_feasibility]);
    }

    public function index($id,$id_feasibility){
        $ko= konsep::where('id_feasibility',$id_feasibility)->first();
        $u= Dmesin::where('id_feasibility',$id_feasibility)->first();
        $Mdata = Dmesin::with('meesin')->get()->where('id_feasibility', $id_feasibility);
        $dataO = oh::with('dataoh')->get()->where('id_feasibility', $id_feasibility);
        $fe=finance::find($id_feasibility);
        $Jlab = Dlab::where('id_feasibility',$id_feasibility)->sum('rate');
        $Jmesin = Dmesin::where('id_feasibility',$id_feasibility)->sum('hasil');
        $Joh = oh::where('id_feasibility',$id_feasibility)->sum('hasil');
        $total = $Jmesin+$Joh;
        $dataL =Dlab::where('id_feasibility',$id_feasibility)->get();
        $kemas =userkemas::where('id_feasibility', $id_feasibility)->get();
        $dataF = finance::where('id_feasibility', $id_feasibility)->get();
        $formula = Formula::where('id',$id)->first();
        $fortails = Fortail::where('formula_id',$formula->id)->get();
        $ada = Fortail::where('formula_id',$formula->id)->count();

        if($ada < 1){
            return Redirect::back()->with('error','Data Bahan Formula Versi '.$formula->versi.' Masih Kosong');
        }elseif($formula->batch < 1){
            return Redirect::back()->with('error','Data Bahan Formula Versi '.$formula->versi.'.'.$formula->turunan.' Belum Memliki Batch');
        }

        $detail_formula     = collect();
        $granulasi          = 0;
        $jumlah_granulasi   = 0;
        $biasa              = 0;
        $one_persen         = $formula->batch / 100;

        foreach($fortails as $fortail){
            // Get Persen
            $persen = $fortail->per_batch / $one_persen; $persen = round($persen, 2);
            $detail_formula->push([

                'id' => $fortail->id,
                'kode_komputer' => $fortail->kode_komputer,
                'nama_sederhana' => $fortail->nama_sederhana,
                'nama_bahan' => $fortail->nama_bahan,
                'per_batch' => $fortail->per_batch,
                'per_serving' => $fortail->per_serving,
                'granulasi' => $fortail->granulasi,
                'persen' => $persen,
            ]);            

            if($fortail->granulasi == 'ya'){
                $granulasi = $granulasi + 1;
                $jumlah_granulasi = $jumlah_granulasi + $fortail->per_batch;
            }
        }

        $biasa = $ada - $granulasi;
        $gp    = $jumlah_granulasi / $one_persen; $gp = round($gp , 2);

        // Tampil Harga Bahan Baku
        $detail_harga = collect();
        $satu_persen = $formula->serving / 100;
        // Inisialisasi Total
        $total_harga_per_gram = 0;
        $total_berat_per_serving = 0;
        $total_harga_per_serving = 0;
        $total_berat_per_batch = 0;
        $total_harga_per_batch = 0;
        $total_berat_per_kg = 0;
        $total_harga_per_kg = 0; 

        foreach($fortails as $fortail){
            //Get Needed
            $bahan  = Bahan::where('id',$fortail->bahan_id)->first();
            $curren = Curren::where('id',$bahan->curren_id)->first();
            //Start Count
                // Harga Pergram
                $hpg = ($bahan->harga_satuan * $curren->harga) / ($bahan->berat * 1000); $hpg = round($hpg,2);
                // PerServing
                $berat_per_serving = $fortail->per_serving; $berat_per_serving = round($berat_per_serving,5);
                $persen = $fortail->per_serving / $satu_persen; $persen = round($persen,2);
                $harga_per_serving = $berat_per_serving * $hpg; $harga_per_serving = round($harga_per_serving,2);
                // Per Batch
                $berat_per_batch = $fortail->per_batch; $berat_per_batch = round($berat_per_batch,5);
                $harga_per_batch = $berat_per_batch * $hpg; $harga_per_batch = round($harga_per_batch,2);
                // Per Kg
                $berat_per_kg = (1000 * $berat_per_serving) / $formula->serving; $berat_per_kg = round($berat_per_kg,5);
                $harga_per_kg = $berat_per_kg * $hpg; $harga_per_kg = round($harga_per_kg,2);       
            // Tampilkan
            $detail_harga->push([

                'id' => $fortail->id,
                'kode_komputer' => $bahan->kode_komputer,
                'nama_sederhana' => $bahan->nama_sederhana,
                'hpg' => $hpg,
                'per_serving' =>  $berat_per_serving,
                'persen' => $persen,
                'harga_per_serving' => $harga_per_serving,
                'per_batch' => $berat_per_batch,
                'harga_per_batch' => $harga_per_batch,
                'per_kg' => $berat_per_kg,
                'harga_per_kg' => $harga_per_kg

            ]);

            // Count Total
            $total_harga_per_gram = $total_harga_per_gram + $hpg;
            $total_berat_per_serving = $total_berat_per_serving + $berat_per_serving;
            $total_harga_per_serving = $total_harga_per_serving + $harga_per_serving;
            $total_berat_per_batch = $total_berat_per_batch + $berat_per_batch;
            $total_harga_per_batch = $total_harga_per_batch + $harga_per_batch;
            $total_berat_per_kg = $total_berat_per_kg + $berat_per_kg;
            $total_harga_per_kg = $total_harga_per_kg + $harga_per_kg;
        }

        $total_harga = collect([
            'total_harga_per_gram' => $total_harga_per_gram,
            'total_berat_per_serving' => $total_berat_per_serving,
            'total_persen' => 100,
            'total_harga_per_serving' => $total_harga_per_serving,
            'total_berat_per_batch' => $total_berat_per_batch,
            'total_harga_per_batch' => $total_harga_per_batch,
            'total_berat_per_kg' => $total_berat_per_kg,
            'total_harga_per_kg' => $total_harga_per_kg,                       
        ]);

        return view('finance.finance')->with([
            'ada'     => $ada,
            'formula' => $formula,
            'detail_formula' =>  $detail_formula,
            'granulasi' => $granulasi,
            'gp' => $gp,
            'detail_harga' => $detail_harga,
            'total_harga' => $total_harga,
            'id_feasibility' => $id_feasibility,
            'fe' => $fe,
            'kemas' => $kemas,
            'Mdata' => $Mdata,
            'id' => $id,
            'formula' => $formula,
            'total' => $total,
            'jlab' =>$Jlab,
            'u' => $u,
            'ko' => $ko,
            'dataL' => $dataL,
            'dataO' => $dataO,
            'dataF' => $dataF
        ]);
    }
}