<?php

namespace App\Http\Controllers\datamaster;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Maatwebsite\Excel\Facades\Excel;

use App\model\pkp\komponen;
use App\model\pkp\klaim;
use App\model\pkp\uom;
use App\model\pkp\SKU;
use App\model\nutfact\BPOM;
use App\model\nutfact\mikroba;
use App\model\Modelmesin\DataMesin;
use App\model\Modelmesin\IO;
use DB;
use Auth;
use Redirect;

class masterController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
    }
    // Data Master UOM 
    public function datauom(){ // halaman UOM
        $uom = uom::all();
        return view('datamaster.datauom')->with([
            'uom' => $uom
        ]);
    }

    public function uom(Request $request){ // Menambah data uom
        $uom = new uom;
        $uom->primary_uom=$request->uom;
        $uom->save();

        return redirect::back();
    }
    // Data Master Data Pangan
    public function index(){ // halaman data pangan
        $mikroba      = mikroba::select('jenis_mikroba','no','n','c','mk','Mb','metode_analisa')->get();
        $Kjenispangan = BPOM::select('no_kategori','kategori','no_kategori')->get();
        return view('datamaster.datapangan1')->with([
            'mikroba' => $mikroba,
            'Kjenispangan' => $Kjenispangan
        ]);
    }
    // Data Master SKU
    public function sku(){ // Halaman SKU
        $sku = SKU::select('nama_produk','no_formula','nama_sku','kode_items','no')->get();
        return view('datamaster.sku1')->with([
            'sku' => $sku
        ]);
    }

    public function editsku(Request $request,$id){ // Edit Data SKU
        $sku = SKU::where('id',$id)->first();
        $sku->nama_produk   = $request->name;
        $sku->nama_sku      = $request->sku;
        $sku->kode_items    = $request->kode;
        $sku->no            = $request->no;
        $sku->save();

        return redirect()->back();
    }

    public function tambahsku(Request $request){ // Menambah Data SKU
        $sku = new SKU;
        $sku->no_formula    = $request->formula;
        $sku->nama_produk   = $request->produk;
        $sku->no            = $request->no;
        $sku->nama_sku      = $request->sku;
        $sku->kode_items    = $request->kode;
        $sku->save();

        return redirect()->back();
    }
    // Data Master Klaim
    public function klaim(){ // Halaman Klaim
        $klaim      = klaim::all();
        $komponen   = komponen::all();;
        return view('datamaster.komponenklaim1')->with([
            'klaim'     => $klaim,
            'komponen'  => $komponen
        ]);
    }

    public function editklaim(Request $request, $id){ //Edit Data Klaim
        $klaim = klaim::where('id',$id)->first();
        $klaim->klaim        = $request->klaim;
        $klaim->persyaratan  = $request->persyaratan;
        $klaim->save();
        
        return redirect()->back();
    }
    // Data Master Mesin
    public function mesin(){ // Halaman Mesin
        $mesin  = DataMesin::select('workcenter','kategori','IO','nama_mesin')->get();
        $IO     = IO::all();
        return view('datamaster.mesin')->with([
            'mesin' => $mesin,
            'IO'    => $IO
        ]);
    }

    public function addmesin(Request $request){ // Tambah data mesin
        $mesin  = new DataMesin;
        $mesin->workcenter  = $request->workcenter;
        $mesin->kategori    = $request->kategori;
        $mesin->IO          = $request->io;
        $mesin->nama_mesin  = $request->mesin;
        $mesin->jlh_line    = $request->line;
        $mesin->save();

        return redirect::back()->with('status','Successfully');
    }
}