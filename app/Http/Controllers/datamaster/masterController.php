<?php

namespace App\Http\Controllers\datamaster;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Exports\KemasExport;
use App\Exports\AkgExport;
use App\Exports\BpomExport;
use App\Exports\klaimexport;
use App\Exports\SKUExport;
use App\Exports\arsenexport;
use Maatwebsite\Excel\Facades\Excel;
use DB;
use Auth;
use redirect;

use App\notification;
use App\pkp\komponen_klaim;
use App\pkp\logam_berat;
use App\pkp\komponen;
use App\devnf\tb_akg;
use App\devnf\tb_akgs;
use App\pkp\klaim;
use App\kemas\datakemas;
use App\pkp\data_sku;
use App\nutfact\datapangan;
use App\dev\ms_allergen;
use App\dev\ms_supplier_principals;
use App\dev\ms_supplier_principal_cps;
use App\pkp\pkp_datapangan;
use App\nutfact\pangan;
use App\nutfact\mikroba;
use App\nutfact\bpom;
use App\manager\pengajuan;

class masterController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
    }

    public function index(){
        $mikroba = mikroba::all();
        $Kjenispangan = pangan::all();
        $pengajuan = pengajuan::count();
        $notif = notification::where('status','=','active')->count();
        $pesan = notification::all();
        $hitungnotif = $pengajuan + $notif;
        return view('datamaster.datapangan1')->with([
            'pangan' => $pangan,
            'pesan' => $pesan,
            'mikroba' => $mikroba,
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
        $logam = logam_berat::join('pkp_datapangan','pkp_datapangan.no_kategori','=','tb_logam_berat.pangan_olahan')->get();
        $pengajuan = pengajuan::count();
        $notif = notification::where('status','=','active')->count();
        $pesan = notification::all();
        $hitungnotif = $pengajuan + $notif;
        return view('datamaster.logam_berat')->with([
            'logam' => $logam,
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

    public function allergen(){
        $allergen = ms_allergen::all();
        return view('datamaster.allergen')->with([
            'allergen' => $allergen
        ]);
    }

    public function add_allergen(Request $request){
        $all = new ms_allergen;
        $all->allergen=$request->allergen;
        $all->tgl_update=$request->last;
        $all->tgl_dibuat=$request->last;
        $all->id_user=Auth::user()->id;
        $all->save();

        return redirect()->back();
    }

    public function edit_allergen(Request $request,$id_allergen){
        $all = ms_allergen::where('id','=',$id_allergen)->first();
        $all->allergen=$request->allergen;
        $all->tgl_update=$request->last;
        $all->id_user=Auth::user()->id;
        $all->save();

        return redirect()->back();
    }

    public function principal(){
        $supplier = ms_supplier_principals::all();
        $principal = ms_supplier_principal_cps::all();
        return view('datamaster.principal')->with([
            'principal' => $principal,
            'supplier' => $supplier
        ]);
    }

    public function inactive_principal($id){
        $principal = ms_supplier_principal_cps::where('id',$id)->first();
        $principal->is_active='inactive';
        $principal->save();

        return redirect()->back();
    }

    public function active_principal($id){
        $principal = ms_supplier_principal_cps::where('id',$id)->first();
        $principal->is_active='active';
        $principal->save();

        return redirect()->back();
    }

    public function add_principal(Request $request){
        $principal = new ms_supplier_principal_cps;
        $principal->ms_supplier_principal_id=$request->supplier;
        $principal->nama_cp=$request->name;
        $principal->email_cp=$request->email;
        $principal->telepon_cp=$request->telp;
        $principal->jabatan_cp=$request->jabatan;
        $principal->is_active='active';
        $principal->created_by=Auth::user()->id;
        $principal->updated_by=Auth::user()->id;
        $principal->save();

        return redirect()->back();
    }

    public function edit_principal(Request $request,$id){
        $principal = ms_supplier_principal_cps::where('id',$id)->first();
        $principal->nama_cp=$request->name;
        $principal->email_cp=$request->email;
        $principal->telepon_cp=$request->telp;
        $principal->jabatan_cp=$request->jabatan;
        $principal->is_active='active';
        $principal->updated_by=Auth::user()->id;
        $principal->save();

        return redirect()->back();
    }

    public function add_supplier(Request $request){
        $supplier = new ms_supplier_principals;
        $supplier->nama_supplier_principal=$request->nama;
        $supplier->kode_oracle_supplier_principal=$request->oracle;
        $supplier->alamat_supplier_principal=$request->alamat;
        $supplier->telepon_supplier_principal=$request->telp;
        $supplier->no_fax_supplier_principal=$request->fax;
        $supplier->website_supplier_principal=$request->web;
        $supplier->created_by=Auth::user()->id;
        $supplier->updated_by=Auth::user()->id;;
        $supplier->is_active='active';
        $supplier->save();

        return redirect()->back();
    }

    public function supplier(){
        $supplier = ms_supplier_principals::all();
        return view('datamaster.supplier')->with([
            'supplier' => $supplier
        ]);
    }

    public function inactive_supplier($id){
        $supplier = ms_supplier_principals::where('id',$id)->first();
        $supplier->is_active='inactive';
        $supplier->save();

        return redirect()->back();
    }

    public function active_supplier($id){
        $supplier = ms_supplier_principals::where('id',$id)->first();
        $supplier->is_active='active';
        $supplier->save();

        return redirect()->back();
    }

    public function edit_supplier(Request $request,$id){
        $supplier = ms_supplier_principals::where('id',$id)->first();
        $supplier->nama_supplier_principal=$request->nama;
        $supplier->kode_oracle_supplier_principal=$request->oracle;
        $supplier->alamat_supplier_principal=$request->alamat;
        $supplier->telepon_supplier_principal=$request->telp;
        $supplier->no_fax_supplier_principal=$request->fax;
        $supplier->website_supplier_principal=$request->web;
        $supplier->updated_by=Auth::user()->id;
        $supplier->save();
        
        return redirect()->back();
    }

    public function akg(){
        $akg = tb_akgs::all();
        $pengajuan = pengajuan::count();
        $notif = notification::where('status','=','active')->count();
        $pesan = notification::all();
        $hitungnotif = $pengajuan + $notif;
        return view('datamaster.akg')->with([
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