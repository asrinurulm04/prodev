<?php

namespace App\Http\Controllers\datamaster;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Maatwebsite\Excel\Facades\Excel;

use App\model\pkp\komponen;
use App\model\pkp\klaim;
use App\model\pkp\uom;
use App\model\pkp\SKU;
use App\model\pkp\ses;
use App\model\master\Supplier;
use App\model\master\Principal;
use App\model\nutfact\BPOM;
use App\model\nutfact\mikroba;
use App\model\nutfact\Allergen;
use App\model\Modelkemas\datakemas;
use App\model\Modelmesin\dataOH;
use App\model\Modelmesin\DataMesin;
use DB;
use Auth;
use Redirect;

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
        $mikroba = mikroba::select('jenis_mikroba','no','n','c','mk','Mb','metode_analisa')->get();
        $Kjenispangan = BPOM::select('no_kategori','kategori','no_kategori')->get();
        return view('datamaster.datapangan1')->with([
            'mikroba' => $mikroba,
            'Kjenispangan' => $Kjenispangan
        ]);
    }

    public function editsku(Request $request,$id){
        $sku = SKU::where('id',$id)->first();
        $sku->nama_produk=$request->name;
        $sku->nama_sku=$request->sku;
        $sku->kode_items=$request->kode;
        $sku->no=$request->no;
        $sku->save();

        return redirect()->back();
    }

    public function tambahsku(Request $request){
        $sku = new SKU;
        $sku->no_formula=$request->formula;
        $sku->nama_produk=$request->produk;
        $sku->no=$request->no;
        $sku->nama_sku=$request->sku;
        $sku->kode_items=$request->kode;
        $sku->save();

        return redirect()->back();
    }

    public function editbpom(Request $request,$id_bpom){
        $pangan = BPOM::where('id_bpom',$id_bpom)->first();
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
        $allergen = Allergen::all();
        return view('datamaster.allergen')->with([
            'allergen' => $allergen
        ]);
    }

    public function add_allergen(Request $request){
        $all = new Allergen;
        $all->allergen=$request->allergen;
        $all->tgl_update=$request->last;
        $all->tgl_dibuat=$request->last;
        $all->id_user=Auth::user()->id;
        $all->save();

        return redirect()->back();
    }

    public function edit_allergen(Request $request,$id_allergen){
        $all = Allergen::where('id','=',$id_allergen)->first();
        $all->allergen=$request->allergen;
        $all->tgl_update=$request->last;
        $all->id_user=Auth::user()->id;
        $all->save();

        return redirect()->back();
    }

    public function principal(){
        $supplier = Supplier::orderBy('nama_supplier_principal','asc')->get();
        $principal = Principal::orderBy('nama_cp','asc')->select('nama_cp','is_active','email_cp')->get();
        return view('datamaster.principal')->with([
            'principal' => $principal,
            'supplier' => $supplier
        ]);
    }

    public function inactive_principal($id){
        $principal = Principal::where('id',$id)->first();
        $principal->is_active='inactive';
        $principal->save();

        return redirect::back()->with('status', 'Data nonactive');
    }

    public function active_principal($id){
        $principal = Principal::where('id',$id)->first();
        $principal->is_active='active';
        $principal->save();

        return redirect::back()->with('status', 'Data di aktifkan');
    }

    public function add_principal(Request $request){
        $principal = new Principal;
        $principal->ms_supplier_principal_id=$request->supplier;
        $principal->nama_cp=$request->name;
        $principal->email_cp=$request->email;
        $principal->telepon_cp=$request->telp;
        $principal->jabatan_cp=$request->jabatan;
        $principal->is_active='active';
        $principal->created_by=Auth::user()->id;
        $principal->updated_by=Auth::user()->id;
        $principal->save();

        return redirect::back()->with('status', 'Data berhasil ditambahkan');
    }

    public function edit_principal(Request $request,$id){
        $principal = Principal::where('id',$id)->first();
        $principal->nama_cp=$request->name;
        $principal->email_cp=$request->email;
        $principal->telepon_cp=$request->telp;
        $principal->jabatan_cp=$request->jabatan;
        $principal->is_active='active';
        $principal->updated_by=Auth::user()->id;
        $principal->save();

        return redirect::back()->with('status', 'Revised data ');
    }

    public function add_supplier(Request $request){
        $supplier = new Supplier;
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

        return redirect::back()->with('status', 'Data berhasil ditambahkan');
    }

    public function supplier(){
        $supplier = Supplier::orderBy('nama_supplier_principal','asc')->select('id','nama_supplier_principal','alamat_supplier_principal','telepon_supplier_principal','is_active')->get();
        return view('datamaster.supplier')->with([
            'supplier' => $supplier
        ]);
    }

    public function inactive_supplier($id){
        $supplier = Supplier::where('id',$id)->first();
        $supplier->is_active='inactive';
        $supplier->save();

        return redirect::back()->with('status', 'Data nonactive');
    }

    public function active_supplier($id){
        $supplier = Supplier::where('id',$id)->first();
        $supplier->is_active='active';
        $supplier->save();

        return redirect::back()->with('status', 'data diaktifkan');
    }

    public function edit_supplier(Request $request,$id){
        $supplier = Supplier::where('id',$id)->first();
        $supplier->nama_supplier_principal=$request->nama;
        $supplier->kode_oracle_supplier_principal=$request->oracle;
        $supplier->alamat_supplier_principal=$request->alamat;
        $supplier->telepon_supplier_principal=$request->telp;
        $supplier->no_fax_supplier_principal=$request->fax;
        $supplier->website_supplier_principal=$request->web;
        $supplier->updated_by=Auth::user()->id;
        $supplier->save();
        
        return redirect::back()->with('status', 'Revised data ');
    }

    public function kemas(){
        $kemas = datakemas::all();
        return view('datamaster.datakemas')->with([
            'kemas' => $kemas
        ]);
    }

    public function klaim(){
        $klaim =klaim::all();
        $komponen = komponen::all();;
        return view('datamaster.komponenklaim1')->with([
            'klaim' => $klaim,
            'komponen' => $komponen
        ]);
    }

    public function sku(){
        $sku = SKU::select('nama_produk','no_formula','nama_sku','kode_items','no')->get();
        return view('datamaster.sku1')->with([
            'sku' => $sku
        ]);
    }

    public function datases(){
        $ses= ses::select('ses')->get();
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

    public function mesin(){
        $mesin = DataMesin::select('workcenter','kategori','IO','nama_mesin')->get();
        return view('datamaster.mesin')->with([
            'mesin' => $mesin
        ]);
    }
}