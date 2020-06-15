<?php

namespace App\Http\Controllers\produksi;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\Modelfn\finance;
use App\Modelmesin\Dmesin;
use App\Modelmesin\oh;
use App\modelfn\pesan;
use Auth;

class ProduksiController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
        $this->middleware('rule:produksi');
    }

    public function index($id_feasibility)
    {
        $fe=finance::find($id_feasibility);
        $dataF = finance::where('id_feasibility', $id_feasibility)->get();
        $jumlah = pesan::where('user','produksi')->count();
        $Jmesin = Dmesin::where('id_feasibility',$id_feasibility)->sum('hasil');
        $Joh = oh::where('id_feasibility',$id_feasibility)->sum('hasil');
        $total = $Jmesin+$Joh;
        $Mdata = Dmesin::with('meesin')->get()->where('id_feasibility', $id_feasibility);
        $dataO = oh::with('dataoh')->get()->where('id_feasibility', $id_feasibility);
        return view('produksi.produksi')->with([
            'id_feasibility' => $id_feasibility,
            'Mdata' => $Mdata,
            'dataO' => $dataO,
            'fe' => $fe,
            'jumlah' =>$jumlah,
            'total' => $total,
            'dataF' => $dataF
        ]);
    }

    public function mixing($id_feasibility)
    {
        $fe=finance::find($id_feasibility);
        $dataF = finance::where('id_feasibility', $id_feasibility)->get();
        $jumlah = pesan::where('user','produksi')->count();
        $Jmesin = Dmesin::where('id_feasibility',$id_feasibility)->sum('hasil');
        $Joh = oh::where('id_feasibility',$id_feasibility)->sum('hasil');
        $total = $Jmesin+$Joh;
        $Mdata = Dmesin::with('meesin')->get()->where('id_feasibility', $id_feasibility);
        $dataO = oh::with('dataoh')->get()->where('id_feasibility', $id_feasibility);
        return view('produksi.mixing')->with([
            'id_feasibility' => $id_feasibility,
            'Mdata' => $Mdata,
            'dataO' => $dataO,
            'fe' => $fe,
            'total' => $total,
            'jumlah' =>$jumlah,
            'dataF' => $dataF
        ]);
    }

    public function filling($id_feasibility)
    {
        $fe=finance::find($id_feasibility);
        $dataF = finance::where('id_feasibility', $id_feasibility)->get();
        $jumlah = pesan::where('user','produksi')->count();
        $Jmesin = Dmesin::where('id_feasibility',$id_feasibility)->sum('hasil');
        $Joh = oh::where('id_feasibility',$id_feasibility)->sum('hasil');
        $total = $Jmesin+$Joh;
        $Mdata = Dmesin::with('meesin')->get()->where('id_feasibility', $id_feasibility);
        $dataO = oh::with('dataoh')->get()->where('id_feasibility', $id_feasibility);
        return view('produksi.filling')->with([
            'id_feasibility' => $id_feasibility,
            'Mdata' => $Mdata,
            'dataO' => $dataO,
            'fe' => $fe,
            'total' => $total,
            'jumlah' =>$jumlah,
            'dataF' => $dataF
        ]);
    }

    public function packing($id_feasibility)
    {
        $fe=finance::find($id_feasibility);
        $dataF = finance::where('id_feasibility', $id_feasibility)->get();
        $jumlah = pesan::where('user','produksi')->count();
        $Jmesin = Dmesin::where('id_feasibility',$id_feasibility)->sum('hasil');
        $Joh = oh::where('id_feasibility',$id_feasibility)->sum('hasil');
        $total = $Jmesin+$Joh;
        $Mdata = Dmesin::with('meesin')->get()->where('id_feasibility', $id_feasibility);
        $dataO = oh::with('dataoh')->get()->where('id_feasibility', $id_feasibility);
        return view('produksi.packing')->with([
            'id_feasibility' => $id_feasibility,
            'Mdata' => $Mdata,
            'dataO' => $dataO,
            'fe' => $fe,
            'total' => $total,
            'jumlah' =>$jumlah,
            'dataF' => $dataF
        ]);
    }

    public function oh($id_feasibility)
    {
        $fe=finance::find($id_feasibility);
        $dataF = finance::where('id_feasibility', $id_feasibility)->get();
        $jumlah = pesan::where('user','produksi')->count();
        $Jmesin = Dmesin::where('id_feasibility',$id_feasibility)->sum('hasil');
        $Joh = oh::where('id_feasibility',$id_feasibility)->sum('hasil');
        $total = $Jmesin+$Joh;
        $Mdata = Dmesin::with('meesin')->get()->where('id_feasibility', $id_feasibility);
        $dataO = oh::with('dataoh')->get()->where('id_feasibility', $id_feasibility);
        return view('produksi.oh')->with([
            'id_feasibility' => $id_feasibility,
            'Mdata' => $Mdata,
            'dataO' => $dataO,
            'fe' => $fe,
            'total' => $total,
            'jumlah' =>$jumlah,
            'dataF' => $dataF
        ]);
    }

    public function status(Request $request,$id, $id_feasibility)
    {
        $statuss=finance::where('id_feasibility',$id_feasibility)->first();
        $statuss->status_SDM=$request->statusP;
        $statuss->save();

        $data = Dmesin::where('id_feasibility',$id_feasibility)->first();
        $data->user2=Auth::user()->name;
        $data->save();
        return redirect()->route('myFeasibility',$id);
    }

    public function inbox($id_feasibility)
    {
        $inboxs = pesan::all()->sortByDesc('created_at')->where('user','produksi');
        $jumlah = pesan::where('user','produksi')->count();
        $dataF = finance::with('formula')->get()->where('id_feasibility', $id_feasibility)->first();
        return view('produksi.inboxproduksi')->with([
            'inboxs' => $inboxs,
            'dataF' => $dataF,
            'jumlah' =>$jumlah,
            'id_feasibility' => $id_feasibility
        ]);
    }

    public function has($id,$id_feasibility)
    {

        $fe=finance::find($id_feasibility);
        $dataF = finance::with('formula')->get()->where('id_feasibility', $id_feasibility)->first();
        $Mdata = Dmesin::with('meesin')->get()->where('id_feasibility', $id_feasibility);
        $jumlah = pesan::where('user','produksi')->count();
        $Jmesin = Dmesin::where('id_feasibility',$id_feasibility)->sum('hasil');
        $Joh = oh::where('id_feasibility',$id_feasibility)->sum('hasil');
        $total = $Jmesin+$Joh;
        $dataO = oh::with('dataoh')->get()->where('id_feasibility', $id_feasibility);
        return view('produksi.lihat')->with([
            'fe'=>$fe,
            'id_feasibility' => $id_feasibility,
            'id' => $id,
            'jumlah' =>$jumlah,
            'Mdata' => $Mdata,
            'dataO' => $dataO,
            'total' => $total,
            'dataF' => $dataF
        ]);
    }

    public function sdmM(Request $request, $id_mesin)
    {
        $data_mesin = Dmesin::where('id_mesin', $id_mesin)->first();
        $standar =  $data_mesin->standar_sdm;
        $runtime =  $data_mesin->runtime;
        $sdm = $request->SDM;
        $rate = $data_mesin->rate_mesin;

        $hasil = ((($sdm/$standar)*$runtime)/60)*$rate;

        $data_mesin->SDM=$request->SDM;
        
        $data_mesin->user2=Auth::user()->name;
        $data_mesin->hasil =$hasil;
        $data_mesin->save();

        return redirect()->back();
   }

   public function destroyPsdm($id)
   {
       $mail = pesan::find($id);
       $mail->delete();
       return redirect()->back();
   }

   public function sdmO(Request $request, $id_oh)
   {
       $data_oh = oh::where('id_oh', $id_oh)->first();

       $standarr =  $data_oh->standar_sdm;
       $sdmm =  $request->SDM;
       $runtimee = $data_oh->runtime;
       $ratee = $data_oh->rate_aktifitas;

       $hasilnya = ((($sdmm/$standarr)*$runtimee)/60)*$ratee;

       $data_oh->SDM=$request->SDM;
       $data_oh->hasil =$hasilnya;
       $data_oh->save();
       return redirect()->back();
    }
}
