<?php

namespace App\Http\Controllers\datamaster;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Maatwebsite\Excel\Facades\Excel;
use App\model\Exports\KemasExport;
use App\model\Exports\klaimexport;
use App\model\Exports\SKUExport;

use App\model\pkp\komponen_klaim;
use App\model\pkp\logam_berat;
use App\model\pkp\komponen;
use App\model\devnf\tb_akg;
use App\model\pkp\klaim;
use App\model\pkp\uom;
use App\model\kemas\datakemas;
use App\model\pkp\data_sku;
use App\model\pkp\ses;
use App\model\pkp\data_ses;
use App\model\dev\ms_allergen;
use App\model\dev\ms_supplier_principals;
use App\model\dev\ms_supplier_principal_cps;
use App\model\pkp\pkp_datapangan;
use App\model\nutfact\bpom_mikrobiologi;
use App\model\nutfact\mikroba;
use App\model\manager\pengajuan;
use DB;
use Auth;
use redirect;

class masterController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
    }

    public function datauom(){
        $uom = uom::all();
        return view('datamaster.datauom')->with([
            'uom' => $uom
        ]);
    }

    public function uom(Request $request){
        $uom = new uom;
        $uom->primary_uom=$request->uom;
        $uom->save();

        return redirect::back();
    }

    public function index(){
        $mikroba = mikroba::get();
        $Kjenispangan = bpom_mikrobiologi::all();
        $pengajuan = pengajuan::count();
        return view('datamaster.datapangan1')->with([
            'mikroba' => $mikroba,
            'Kjenispangan' => $Kjenispangan,
            'pengajuan' => $pengajuan
        ]);
    }

    public function logamberat(){
        $logam = logam_berat::join('pkp_datapangan','pkp_datapangan.no_kategori','=','tb_logam_berat.pangan_olahan')->get();
        $pengajuan = pengajuan::count();
        return view('datamaster.logam_berat')->with([
            'logam' => $logam,
            'pengajuan' => $pengajuan
        ]);
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

    public function kemas(){
        $kemas = datakemas::all();
        $pengajuan = pengajuan::count();
        return view('datamaster.datakemas')->with([
            'kemas' => $kemas,
            'pengajuan' => $pengajuan
        ]);
    }

    public function klaim(){
        $klaim =komponen_klaim::all();
        $komponen = komponen::all();
        $pengajuan = pengajuan::count();
        return view('datamaster.komponenklaim1')->with([
            'klaim' => $klaim,
            'komponen' => $komponen,
            'pengajuan' => $pengajuan
        ]);
    }

    public function sku(){
        $sku = data_sku::all();
        $pengajuan = pengajuan::count();
        return view('datamaster.sku1')->with([
            'sku' => $sku,
            'pengajuan' => $pengajuan
        ]);
    }

    public function datases(){
        $ses= ses::all();
        return view('admin.ses')->with([
            'ses' => $ses
        ]);
    }

    public function ses(Request $request){
        $ses = new ses;
        $ses->ses=$request->ses;
        $ses->save();

        return redirect::back();
    }

    public function exportsku(){
		return Excel::download(new SKUExport, 'SKU.xlsx');
    }

    public function export_excel(){
		return Excel::download(new KemasExport, 'kemas.xlsx');
    }

    public function export_klaim(){
		return Excel::download(new klaimexport, 'klaim.xlsx');
    }
    
    public function exportAkg(){
		return Excel::download(new AkgExport, 'Akg.xlsx');
    }
}