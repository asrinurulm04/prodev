<?php

namespace App\Http\Controllers\mesin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

use App\model\Modelmesin\datamesin;
use App\model\Modelmesin\Dmesin;
use App\model\modelkemas\konsep;
use App\model\Modelkemas\userkemas;
use App\model\Modelfn\finance;
use App\model\modelfn\pesan;
use App\model\pkp\tipp;
use App\model\dev\Formula;
use Auth;
use Redirect;

class MesinController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
        $this->middleware('rule:evaluator');
    }

    public function index(Request $request,$id,$id_feasibility){
        $reference = $request->session()->get('references');
        $formulas = Formula::where('id',$id)->get();
        $konsep= konsep::where('id_feasibility', $id_feasibility)->get();
        $mesins = datamesin::all();
        $dataMesin = Dmesin::where('id_feasibility',$id_feasibility)->count();
        $messin = DB::table('fs_datamesin')->select(['workcenter'])->distinct()->get();
        $Mdata = DB::table('fs_mesin')
            ->join('fs_datamesin','fs_mesin.id_data_mesin','=','fs_datamesin.id_data_mesin')
            ->where('id_feasibility', $id_feasibility)->get();
        $dataF = finance::where('id_feasibility', $id_feasibility)->get();
        $jumlah = pesan::where('user','inputor')->count();
        $fe=finance::find($id_feasibility);
        return view('mesin.datamesin')->with([
            'id_feasibility' => $id_feasibility,
            'fe' => $fe,
            'konsep' => $konsep,
			'formulas' => $formulas,
            'mesins' => $mesins,
            'dataMesin' => $dataMesin,
            'Mdata' => $Mdata,
            'dataF' => $dataF,
            'id' => $id,
            'jumlah' => $jumlah,
            'messin' => $messin,
            'reference' => $reference
            ]);

    }

    public function ubah(Request $request,$id,$id_feasibility){
        $reference = $request->session()->get('references');
        $formulas = Formula::where('id',$id)->get();
        $konsep= konsep::where('id_feasibility', $id_feasibility)->get();
        $mesins = datamesin::all();
        $Mdata = Dmesin::with('meesin')->get()->where('id_feasibility', $id_feasibility);
        $dataF = finance::where('id_feasibility', $id_feasibility)->get();
        $jumlah = pesan::where('user','inputor')->count();
        $fe=finance::find($id_feasibility);
        return view('mesin.ubahdata')->with([
            'id_feasibility' => $id_feasibility,
            'fe' => $fe,
            'konsep' => $konsep,
			'formulas' => $formulas,
            'mesins' => $mesins,
            'Mdata' => $Mdata,
            'dataF' => $dataF,
            'id' => $id,
            'jumlah' => $jumlah,
            'reference' => $reference
        ]);
    }

    public function kirimlab(Request $request){
        $fnn= new pesan;
        $fnn->id_feasibility=$request->finance;
        $fnn->pengirim=Auth::user()->name;
        $fnn->user='lab';
        $fnn->subject='1 data anda terima';
        $fnn->message='analisa data lab';
        $fnn->save();

    	return redirect()->back()->with(['success' => 'Data terkirim']);
    }

    public function status(Request $request,$id, $id_feasibility)
    {
        $statuss=finance::where('id_feasibility',$id_feasibility)->first();
        $statuss->status_mesin=$request->statusM;
        $statuss->save();
        return redirect()->route('myFeasibility',$id);
    }

    public function lihat(Request $request){
        $data = DB::table('fs_datamesin')
            ->leftjoin('fs_mesin','fs_mesin.id_data_mesin','=','fs_datamesin.id_data_mesin')
            ->rightjoin('fs_finance','fs_mesin.id_feasibility','=','fs_finance.id_feasibility')
            ->rightjoin('formulas','fs_finance.id_formula','=','formulas.id')
            ->where([
                ['fs_finance.status_mesin','selesai'],
                ['fs_finance.id_feasibility', $request->id_feasibility]
            ])->get();
        $reference = $request->session()->get('references');
        $reference = $request->session()->put('references', $data);

        $ms= new Dmesin;
        $mesin = [];
        for($i = 0; $i < $request->cek_mesin; $i++){
            $mesin += array(
                $i => $request->input('mesin_' . $i),
            );
        }

        $standar = [];
        for($i = 0; $i < $request->cek_mesin; $i++){
            $standar += array(
                $i => $request->input('standar_' . $i),
            );
        }

        $runtime = [];
        for($i = 0; $i < $request->cek_mesin; $i++){
            $runtime += array(
                $i => $request->input('runtime_' . $i),
            );
        }

        $hasil = [];
        for($i = 0; $i < $request->cek_mesin; $i++){
            $hasil += array(
                $i => $request->input('hasil_' . $i),
            );
        }

        $line = [];
        for($i = 0; $i < $request->cek_mesin; $i++){
            $line += array(
                $i => $request->input('line_' . $i),
            );
        }

        for($i = 0; $i < $request->cek_lab; $i++){
            $add_lab = new Dmesin;
            $add_lab->id_feasibility=$request->finance;
            $add_lab->id_data_mesin=$mesin[$i];
            $add_lab->SDM=$standar[$i];
            $add_lab->runtime=$runtime[$i];
            $add_lab->line=$line[$i];
            $add_lab->hasil=$hasil[$i];
            $add_lab->save();
        }
        return redirect()->back();
    }

    public function reference(Request $request, $id,$id_feasibility){
        $request->session()->get('references');
        $mesins = datamesin::all();
        $jumlah = pesan::where('user','inputor')->count();
        $formulas = Formula::where('status_fisibility','proses')->get();
        $messin = DB::table('fs_datamesin')->select(['workcenter'])->distinct()->get();
        $Mdata = Dmesin::with('meesin')->get()->where('id_feasibility', $id_feasibility);
        $cek_mesin =Dmesin::where('id_feasibility',$id_feasibility)->count();
        $dataN = finance::with('formula')->get();
        $data = DB::table('fs_datamesin')
            ->leftjoin('fs_mesin','fs_mesin.id_data_mesin','=','fs_datamesin.id_data_mesin')
            ->leftjoin('fs_finance','fs_mesin.id_feasibility','=','fs_finance.id_feasibility')
            ->rightjoin('formulas','fs_finance.id_formula','=','formulas.id')
            ->where([['fs_finance.status_mesin','selesai']])->get();
        $dataMesin = Dmesin::join('fs_datamesin','fs_datamesin.id_data_mesin','fs_mesin.id_data_mesin')->get();
        $dataF = finance::where('id_feasibility', $id_feasibility)->get();
        $dataO = oh::with('dataoh')->get()->where('id_feasibility', $id_feasibility);
        $fe=finance::find($id_feasibility);
        return view('mesin.reference')->with([
            'id_feasibility' => $id_feasibility,
            'id' => $id,
            'fe' => $fe,
            'cek_mesin' => $cek_mesin,
            'dataMesin' =>$dataMesin,
            'jumlah' => $jumlah,
            'mesins' => $mesins,
            'formulas' => $formulas,
            'Mdata' => $Mdata,
            'dataN' => $dataN,
            'data' => $data,
            'dataF' => $dataF,
            'dataO' => $dataO,
            'messin' => $messin
        ]);
    }

    public function data($id,$id_feasibility){
        $aktifitas = aktifitasOH::all();
        $dataF = finance::where('id_feasibility', $id_feasibility)->get();
        $fe=finance::find($id_feasibility);
        $jumlah = pesan::where('user','inputor')->count();
        $dataO = oh::with('dataoh')->get()->where('id_feasibility', $id_feasibility);
        return view('mesin.dataoh')->with([
            'dataF' => $dataF,
            'jumlah' => $jumlah,
            'fe'=> $fe,
            'id' => $id,
            'id_feasibility' => $id_feasibility,
            'aktifitas' => $aktifitas,
            'dataO' => $dataO
        ]);
    }

    public function ubahdata(Request $request){
        foreach (array_combine($request->input('rate'), $request->input('no')) as $rate => $no){
            $data = datamesin::find($no);
            $data->rate_mesin= $rate;
            $data->save();
        }
        return redirect()->back();
     }
     
    public function dataO(Request $request){
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

    public function std($id_feasibility){
        $dataF = finance::with('formula')->get()->where('id_feasibility', $id_feasibility)->first();
        $fe=finance::find($id_feasibility);
        return view('mesin.std',[])->with([
            'fe'=>$fe,
            'id_feasibility' => $id_feasibility,
            'dataF' => $dataF
        ]);
    }

    public function store(Request $request){
        $this->validate($request, [
            'nama' => 'required',
            'acid' =>'required',
            'lye' => 'required',
        ]);

        $stdd= new std;
        $stdd->id_feasibility=$request->finance;
        $stdd->nama_item=$request->nama;
        $stdd->kode_item=$request->acid;
        $stdd->yield=$request->lye;
        $stdd->catatan=$request->keterangan;
        $stdd->save();

        return redirect()->back();
    }


    public function inbox($id,$id_feasibility){
        $inboxs = pesan::all()->sortByDesc('created_at')->where('user','inputor');
        $jumlah = pesan::where('user','inputor')->count();
        $dataF = finance::with('formula')->get()->where('id_feasibility', $id_feasibility)->first();
        return view('mesin.inboxmesin')
            ->with(['id_feasibility' => $id_feasibility])
            ->with(['id' => $id])
            ->with(['jumlah' => $jumlah])
            ->with(['dataF' => $dataF])
            ->with(['inboxs' => $inboxs]
        );
    }

    public function runM(Request $request, $id_mesin){
        $data_mesin = Dmesin::where('id_mesin', $id_mesin)->first();

        $standar =  $data_mesin->standar_sdm;
        $sdm =  $data_mesin->SDM;
        $runtime = $request->runtime;
        $rate = $data_mesin->rate_mesin;

        $hasill = ((($sdm/$standar)*$runtime)/60)*$rate;

        $data_mesin->runtime=$request->runtime;
        $data_mesin->hasil =$hasill;
        $data_mesin->save();

        return redirect()->back();
     }

     public function runO(Request $request, $id_oh){
        $data_oh = oh::where('id_oh', $id_oh)->first();

        $standarr =  $data_oh->standar_sdm;
        $sdmm =  $data_oh->SDM;
        $runtimee = $request->runtime;
        $ratee = $data_oh->rate_aktifitas;;

        $hasilnya = ((($sdmm/$standarr)*$runtimee)/60)*$ratee;

        $data_oh->runtime=$request->runtime;
        $data_oh->hasil =$hasilnya;
        $data_oh->save();
        return redirect()->back();
     }

     public function hasil($id,$id_feasibility){
        $fe=finance::find($id_feasibility);
        $dataF = finance::with('formula')->get()->where('id_feasibility', $id_feasibility)->first();
        $Mdata = Dmesin::with('meesin')->get()->where('id_feasibility', $id_feasibility);
        $Jmesin = Dmesin::where('id_feasibility',$id_feasibility)->sum('hasil');
        $Joh = oh::where('id_feasibility',$id_feasibility)->sum('hasil');
        $total = $Jmesin+$Joh;
        $jumlah = pesan::where('user','inputor')->count();
        $lihat = std::where('id_feasibility', $id_feasibility)->get();
        $dataO = oh::with('dataoh')->get()->where('id_feasibility', $id_feasibility);
        $yieldd = DB::table('fs_formula_kemas')
            ->join('fs_finance','fs_formula_kemas.id_feasibility','=','fs_finance.id_feasibility')
            ->join('fs_data_yield','fs_formula_kemas.kode','=','fs_data_yield.kode_item')
            ->where('fs_formula_kemas.id_feasibility', $id_feasibility)->get();
        return view('mesin.lihat')->with([
            'fe'=>$fe,
            'id_feasibility' => $id_feasibility,
            'id' => $id,
            'Mdata' => $Mdata,
            'dataO' => $dataO,
            'jumlah' => $jumlah,
            'lihat' => $lihat,
            'yieldd' => $yieldd,
            'dataF' => $dataF,
            'total' => $total
        ]);
    }

     public function createrateM($id,$id_feasibility){
        $Jmesin = Dmesin::where('id_feasibility',$id_feasibility)->sum('hasil');
        $Joh = oh::where('id_feasibility',$id_feasibility)->sum('hasil');
        $total = $Jmesin+$Joh;
        $jumlah = pesan::where('user','inputor')->count();
        $std = std::with('kemas')->get()->where('kode_kemas','item_code');
        $fe=finance::find($id_feasibility);
        $kemas = userkemas::with('kemas')->get()->where('id_feasibility', $id_feasibility);
        $dataF =finance::where('id_feasibility', $id_feasibility)->get();
        $Mdata = Dmesin::with('meesin')->get()->where('id_feasibility', $id_feasibility);
        $dataO = oh::with('dataoh')->get()->where('id_feasibility', $id_feasibility);
        return view('mesin.runtimemesin')->with([
            'fe'=>$fe,
            'id' => $id,
            'id_feasibility' => $id_feasibility,
            'Mdata' => $Mdata,
            'dataO' => $dataO,
            'kemas' => $kemas,
            'dataF' => $dataF,
            'jumlah' => $jumlah,
            'total' => $total
        ]);
    }

    public function destroy(Request $request, $id){
        $request->session()->forget('references');
        $mesin = Dmesin::find($id);
        $mesin->delete();

        return redirect::back()->with('alert', 'Data berhasil dihapus!');
    }

    public function destroyoh($id){
        $mesin = oh::find($id);
        $mesin->delete();
        return redirect::back()->with('message', 'Data berhasil dihapus!');
    }

    public function destroyP($id){
        $mail = pesan::find($id);
        $mail->delete();
        return redirect::back();
    }

    public function speed(Request $request,$id_mesin){
        $ms= new Dmesin;
        foreach (array_combine($request->input('hasil'), $request->input('no')) as $hasil => $no){
            $data_mesin = Dmesin::find($no);
            $data_mesin->runtime=$hasil;
            $data_mesin->save();
        }

        return redirect()->back();
    }

    public function Mdata(Request $request){
        $ms= new Dmesin;
        foreach ($request->input("pmesin") as $pmesin){
            $add_mesin = new Dmesin;
            $add_mesin->id_feasibility=$request->finance;
            $add_mesin->rate_mesin=$request->rate;
            $add_mesin->standar_sdm=$request->standar;
            $add_mesin->line=$request->jlh_line;
            $add_mesin->id_data_mesin= $pmesin;
            $add_mesin->user1=Auth::user()->name;
            $add_mesin->runtime=$request->hasil;
            $add_mesin->hasil=$request->jumlah;
            $add_mesin->SDM=$request->sdm;
            $add_mesin->save();
            $id = Dmesin::orderBy('created_at', 'desc')->pluck('id_feasibility')->first();
            $data = DB::table('fs_datamesin')
                ->leftjoin('fs_mesin','fs_mesin.id_data_mesin','=','fs_datamesin.id_data_mesin')
                ->rightjoin('fs_finance','fs_mesin.id_feasibility','=','fs_finance.id_feasibility')
                ->rightjoin('formulas','fs_finance.id_formula','=','formulas.id')
                ->where([['fs_finance.id_feasibility', $id]])->first();
            $request->session()->push('references', $data);
        }
    return redirect()->back();
    }

    public function createDMmesin(Request $request){
        $Dm= new datamesin;
        $Dm->workcenter=$request->workcenter;
        $Dm->rate_mesin=$request->rate;
        $Dm->kategori=$request->kategori;
        $Dm->IO=$request->aktifitas;
        $Dm->gedung=$request->gedung;
        $Dm->jlh_line=$request->line;
        $Dm->standar_sdm=$request->sdm;
        $Dm->nama_kategori=$request->Nkategori;
        $Dm->nama_mesin=$request->mesin;
        $Dm->save();

        return redirect()->back();
    }

    public function createmixing($id,$id_feasibility){
        $Jmesin = Dmesin::where('id_feasibility',$id_feasibility)->sum('hasil');
        $Joh = oh::where('id_feasibility',$id_feasibility)->sum('hasil');
        $total = $Jmesin+$Joh;
        $jumlah = pesan::where('user','inputor')->count();
        $std = std::with('kemas')->get()->where('kode_kemas','item_code');
        $fe=finance::find($id_feasibility);
        $kemas = userkemas::with('kemas')->get()->where('id_feasibility', $id_feasibility);
        $dataF =finance::where('id_feasibility', $id_feasibility)->get();
        $Mdata = Dmesin::with('meesin')->get()->where('id_feasibility', $id_feasibility);
        $dataO = oh::with('dataoh')->get()->where('id_feasibility', $id_feasibility);
        return view('mesin.mixing')->with([
            'fe'=>$fe,
            'id' => $id,
            'id_feasibility' => $id_feasibility,
            'Mdata' => $Mdata,
            'dataO' => $dataO,
            'kemas' => $kemas,
            'dataF' => $dataF,
            'jumlah' => $jumlah,
            'total' => $total
            ]);
    }

    public function createfilling($id,$id_feasibility){
        $Jmesin = Dmesin::where('id_feasibility',$id_feasibility)->sum('hasil');
        $Joh = oh::where('id_feasibility',$id_feasibility)->sum('hasil');
        $total = $Jmesin+$Joh;
        $jumlah = pesan::where('user','inputor')->count();
        $lab = DB::table('formulas');
        $std = std::with('kemas')->get()->where('kode_kemas','item_code');
        $fe=finance::find($id_feasibility);
        $yieldd = DB::table('fs_formula_kemas');
        $kemas = userkemas::with('kemas')->get()->where('id_feasibility', $id_feasibility);
        $dataF =finance::where('id_feasibility', $id_feasibility)->get();
        $Mdata = Dmesin::with('meesin')->get()->where('id_feasibility', $id_feasibility);
        $dataO = oh::with('dataoh')->get()->where('id_feasibility', $id_feasibility);
        return view('mesin.filling')->with([
            'fe'=>$fe,
            'id' => $id,
            'id_feasibility' => $id_feasibility,
            'Mdata' => $Mdata,
            'dataO' => $dataO,
            'kemas' => $kemas,
            'dataF' => $dataF,
            'jumlah' => $jumlah,
            'total' => $total
        ]);
    }

    public function createpacking($id,$id_feasibility){
        $Jmesin = Dmesin::where('id_feasibility',$id_feasibility)->sum('hasil');
        $Joh = oh::where('id_feasibility',$id_feasibility)->sum('hasil');
        $total = $Jmesin+$Joh;
        $jumlah = pesan::where('user','inputor')->count();
        $fe=finance::find($id_feasibility);
        $kemas = userkemas::with('kemas')->get()->where('id_feasibility', $id_feasibility);
        $dataF =finance::where('id_feasibility', $id_feasibility)->get();
        $Mdata = Dmesin::with('meesin')->get()->where('id_feasibility', $id_feasibility);
        $dataO = oh::with('dataoh')->get()->where('id_feasibility', $id_feasibility);
        return view('mesin.packing')->with([
            'fe'=>$fe,
            'id' => $id,
            'id_feasibility' => $id_feasibility,
            'Mdata' => $Mdata,
            'dataO' => $dataO,
            'kemas' => $kemas,
            'dataF' => $dataF,
            'jumlah' => $jumlah,
            'total' => $total
        ]);
    }

    public function createactivity($id,$id_feasibility){
        $Jmesin = Dmesin::where('id_feasibility',$id_feasibility)->sum('hasil');
        $Joh = oh::where('id_feasibility',$id_feasibility)->sum('hasil');
        $total = $Jmesin+$Joh;
        $jumlah = pesan::where('user','inputor')->count();
        $fe=finance::find($id_feasibility);
        $kemas = userkemas::with('kemas')->get()->where('id_feasibility', $id_feasibility);
        $dataF =finance::where('id_feasibility', $id_feasibility)->get();
        $dataO = oh::with('dataoh')->get()->where('id_feasibility', $id_feasibility);
        return view('mesin.activity')->with([
            'fe'=>$fe,
            'id' => $id,
            'id_feasibility' => $id_feasibility,
            'dataO' => $dataO,
            'kemas' => $kemas,
            'dataF' => $dataF,
            'jumlah' => $jumlah,
            'total' => $total
        ]);
    }

    public function createlab($id,$id_feasibility){
        $Jmesin = Dmesin::where('id_feasibility',$id_feasibility)->sum('hasil');
        $Joh = oh::where('id_feasibility',$id_feasibility)->sum('hasil');
        $total = $Jmesin+$Joh;
        $jumlah = pesan::where('user','inputor')->count();
        $lab = DB::table('formulas')
            ->join('tippu','tippu.id','=','formulas.workbook_id')
            ->join('fs_kategori_pangan','fs_kategori_pangan.id_pangan','=','tippu.bpom')
            ->join('fs_jenismikroba','fs_kategori_pangan.no_kategori','=','fs_jenismikroba.no_kategori')
            ->where('formulas.id',$id)->get();
        $std = std::with('kemas')->get()->where('kode_kemas','item_code');
        $fe=finance::find($id_feasibility);
        $kemas = userkemas::with('kemas')->get()->where('id_feasibility', $id_feasibility);
        $dataF =finance::where('id_feasibility', $id_feasibility)->get();
        $Mdata = Dmesin::with('meesin')->get()->where('id_feasibility', $id_feasibility);
        $dataO = oh::with('dataoh')->get()->where('id_feasibility', $id_feasibility);
        return view('mesin.lab')->with([
            'fe'=>$fe,
            'id' => $id,
            'id_feasibility' => $id_feasibility,
            'Mdata' => $Mdata,
            'dataO' => $dataO,
            'kemas' => $kemas,
            'dataF' => $dataF,
            'lab' => $lab,
            'jumlah' => $jumlah,
            'total' => $total
        ]);
    }

    public function createstd($id,$id_feasibility){
        $Jmesin = Dmesin::where('id_feasibility',$id_feasibility)->sum('hasil');
        $Joh = oh::where('id_feasibility',$id_feasibility)->sum('hasil');
        $total = $Jmesin+$Joh;
        $stdd = std::where('id_feasibility',$id_feasibility)->count();
        $standar = std::where('id_feasibility',$id_feasibility)->get();
        $jumlah = pesan::where('user','inputor')->count();
        $fe=finance::find($id_feasibility);
        $yieldd = DB::table('fs_formula_kemas')
            ->join('fs_finance','fs_formula_kemas.id_feasibility','=','fs_finance.id_feasibility')
            ->join('fs_data_yield','fs_formula_kemas.kode','=','fs_data_yield.kode_item')
            ->where('fs_formula_kemas.id_feasibility', $id_feasibility)->get();
        $kemas = userkemas::with('kemas')->get()->where('id_feasibility', $id_feasibility);
        $dataF =finance::where('id_feasibility', $id_feasibility)->get();
        return view('mesin.std')->with([
            'fe'=>$fe,
            'stdd' => $stdd,
            'standar' => $standar,
            'id' => $id,
            'id_feasibility' => $id_feasibility,
            'yieldd' => $yieldd,
            'kemas' => $kemas,
            'dataF' => $dataF,
            'jumlah' => $jumlah,
            'total' => $total
            ]);
    }
}