<?php

namespace App\Http\Controllers\datamaster;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Maatwebsite\Excel\Facades\Excel;
use App\model\Exports\KemasExport;
use App\model\Exports\AkgExport;
use App\model\Exports\BpomExport;
use App\model\Exports\klaimexport;
use App\model\Exports\SKUExport;
use App\model\Exports\arsenexport;

use App\model\pkp\komponen_klaim;
use App\model\pkp\arsen;
use App\model\pkp\komponen;
use App\model\pkp\klaim;
use App\model\pkp\data_sku;
use App\model\devnf\tb_akg;
use App\model\kemas\datakemas;
use App\model\nutfact\datapangan;
use App\model\nutfact\pangan;
use App\model\nutfact\mikroba;
use App\model\nutfact\bpom;
use App\model\manager\pengajuan;
use DB;
use Auth;
use redirect;

class datapanganController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
    }

    public function index(){
        $jenispangan = datapangan::all();
        $pangan = bpom::orderBy('no','asc')->get();
        $katpangan = datapangan::all();
        $mikroba = mikroba::all();
        $Kjenispangan = pangan::all();
        $pengajuan = pengajuan::count();
        $notif = notification::where('status','=','active')->count();
        $pesan = notification::all();
        $hitungnotif = $pengajuan + $notif;
        return view('datamaster.datapangan1')->with([
            'pangan' => $pangan,
            'pesan' => $pesan,
            'datapangan' => $jenispangan,
            'mikroba' => $mikroba,
            'katpangan' => $katpangan,
            'notif' =>$notif,
            'Kjenispangan' => $Kjenispangan,
            'pengajuan' => $pengajuan,
            'hitungnotif' => $hitungnotif
        ]);
    }

    public function tambahpangan(Request $request){
        $pangan = new bpom;
        $pangan->jenis=$request->jenis;
        $pangan->no=$request->no;
        $pangan->kategori_pangan=$request->kategori;
        $pangan->jenis_mikroba=$request->mikroba;
        $pangan->n=$request->n;
        $pangan->c=$request->c;
        $pangan->m1=$request->m1;
        $pangan->m2=$request->m2;
        $pangan->metode_analisa=$request->analisa;
        $pangan->save();

        return redirect()->back();
    }

    public function arsen(){
        $arsen = arsen::all();
        $pengajuan = pengajuan::count();
        $notif = notification::where('status','=','active')->count();
        $pesan = notification::all();
        $hitungnotif = $pengajuan + $notif;
        return view('datamaster.logam_berat_arsen')->with([
            'arsen' => $arsen,
            'notif' =>$notif,
            'pesan' => $pesan,
            'pengajuan' => $pengajuan,
            'hitungnotif' => $hitungnotif
        ]);
    }

    public function tambaharsen(Request $request){
        $arsen = new arsen;
        $arsen->jenis_makanan=$request->jenis;
        $arsen->batasan_maksimum=$request->batasan_maksimum;
        $arsen->save();
    }

    public function editakg(Request $request,$id_akg){
        $akg = tb_akg::where('id_akg',$id_akg)->first();
        $akg->satuan=$request->satuan;
        $akg->umum=$request->umum;
        $akg->bayi=$request->bayi;
        $akg->anak7_23bulan=$request->anak7;
        $akg->anak2_5tahun=$request->anak2;
        $akg->ibu_hamil=$request->ibuh;
        $akg->ibu_menyusui=$request->ibum;
        $akg->save();

        return redirect()->back();
    }

    public function editarsen(Request $request,$id_arsen){
        $arsen = arsen::where('id_arsen',$id_arsen)->first();
        $arsen->jenis_makanan=$request->jenis;
        $arsen->batasan_maksimum=$request->batasan;
        $arsen->save();

        return redirect()->back();
    }

    public function tambahakg(Request $request){
        $akg = new tb_akg;
        $akg->zat_gizi=$request->gizi;
        $akg->satuan=$request->satuan;
        $akg->umum=$request->umum;
        $akg->bayi=$request->bayi;
        $akg->anak7_23bulan=$request->anak7;
        $akg->anak2_5tahun=$request->anak2;
        $akg->ibu_hamil=$request->ibuh;
        $akg->ibu_menyusui=$request->ibum;
        $akg->save();

        return redirect()->back();
    }

    public function editsku(Request $request,$id){
        $sku = data_sku::where('id',$id)->first();
        $sku->nama_produk=$request->name;
        $sku->nama_sku=$request->sku;
        $sku->kode_items=$request->kode;
        $sku->no=$request->no;
        $sku->save();

        return redirect()->back();
    }

    public function tambahsku(Request $request){
        $sku = new data_sku;
        $sku->no_formula=$request->formula;
        $sku->nama_produk=$request->produk;
        $sku->no=$request->no;
        $sku->nama_sku=$request->sku;
        $sku->kode_items=$request->kode;
        $sku->save();

        return redirect()->back();
    }

    public function editbpom(Request $request,$id_bpom){
        $pangan = bpom::where('id_bpom',$id_bpom)->first();
        $pangan->kategori_pangan=$request->kategori;
        $pangan->jenis_mikroba=$request->mikro;
        $pangan->n=$request->n;
        $pangan->c=$request->c;
        $pangan->m1=$request->m1;
        $pangan->m2=$request->m2;
        $pangan->metode_analisa=$request->analisa;
        $pangan->save();

        return redirect()->back();
    }

    public function editklaim(Request $request, $id){
        $klaim = klaim::where('id',$id)->first();
        $klaim->klaim=$request->klaim;
        $klaim->persyaratan=$request->persyaratan;
        $klaim->save();
        
        return redirect()->back();
    }

    public function akg(){
        $akg = tb_akg::all();
        $pengajuan = pengajuan::count();
        $notif = notification::where('status','=','active')->count();
        $pesan = notification::all();
        $hitungnotif = $pengajuan + $notif;
        return view('datamaster.akg1')->with([
            'akg' => $akg,
            'pesan' => $pesan,
            'notif' =>$notif,
            'pengajuan' => $pengajuan,
            'hitungnotif' => $hitungnotif
        ]);
    }

    public function kemas(){
        $kemas = datakemas::all();
        $pengajuan = pengajuan::count();
        $notif = notification::where('status','=','active')->count();
        $pesan = notification::all();
        $hitungnotif = $pengajuan + $notif;
        return view('datamaster.datakemas')->with([
            'kemas' => $kemas,
            'pesan' => $pesan,
            'notif' =>$notif,
            'pengajuan' => $pengajuan,
            'hitungnotif' => $hitungnotif
        ]);
    }

    public function klaim(){
        $klaim =komponen_klaim::all();
        $komponen = komponen::all();
        $pengajuan = pengajuan::count();
        $notif = notification::where('status','=','active')->count();
        $pesan = notification::all();
        $hitungnotif = $pengajuan + $notif;
        return view('datamaster.komponenklaim1')->with([
            'klaim' => $klaim,
            'pesan' => $pesan,
            'notif' =>$notif,
            'komponen' => $komponen,
            'pengajuan' => $pengajuan,
            'hitungnotif' => $hitungnotif
        ]);
    }

    public function sku(){
        $sku = data_sku::all();
        $pengajuan = pengajuan::count();
        $notif = notification::where('status','=','active')->count();
        $pesan = notification::all();
        $hitungnotif = $pengajuan + $notif;
        return view('datamaster.sku1')->with([
            'sku' => $sku,
            'pesan' => $pesan,
            'notif' =>$notif,
            'pengajuan' => $pengajuan,
            'hitungnotif' => $hitungnotif
        ]);
    }

    public function exportsku()
	{
		return Excel::download(new SKUExport, 'SKU.xlsx');
    }

    public function export_excel()
	{
		return Excel::download(new KemasExport, 'kemas.xlsx');
    }

    public function export_klaim()
	{
		return Excel::download(new klaimexport, 'klaim.xlsx');
    }
    
    public function exportAkg()
	{
		return Excel::download(new AkgExport, 'Akg.xlsx');
    }
    
    public function exportBpom()
	{
		return Excel::download(new BpomExport, 'BPOM.xlsx');
    }
    
    public function exportarsen()
	{
		return Excel::download(new arsenExport, 'Logam Berat (Arsen).xlsx');
	}
}