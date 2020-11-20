<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\pkp\sub;
use App\pkp\kategori;
use App\pkp\jenis;
use App\pkp\menu;
use App\pkp\jenismenu;
use Redirect;
use DB;

class dataController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
        $this->middleware('rule:admin');
    }

    public function formjenis(){
        $jenis = jenis::all();
        $id_jenis = jenis::find('id_jenis');
        return view('admin.editform1')->with([
            'jenis' => $jenis,
            'id_jenis' => $id_jenis
        ]);
    }

    public function formkat(){
        $kategori = kategori::all();
        $id_kategori = kategori::find('id');
        return view('admin.editform2')->with([
            'kategori' => $kategori,
            'id_kategori' => $id_kategori
        ]);
    }

    public function formsub(){
        $sub = sub::all();
        $ksub = sub::all();
        return view('admin.editform3')->with([
            'sub' => $sub,
            'ksub' => $ksub 
        ]);
    }
    
    public function tambahdata(){
        $kate = kategori::all();
        $jenis = jenis::all();
        $sub = sub::all();
        return view('admin.tambahdatapkp')->with([
            'jenis' => $jenis,
            'kategori' => $kate,
            'sub' => $sub
        ]);
    }
    
    // update jenis
    public function blokjenis($id_jenis){
        $jenis = jenis::find($id_jenis)->update(['status'=>'active']);
        $kategori = kategori::where('id_jenis',$id_jenis)->update(['status' => 'active']);
        $sub = sub::where('id_kategori',$kategori)->update(['status' => 'active']);
        return Redirect::back()->with('status','Data Telah Dirubah !');

    }

    public function openjenis($id_jenis){
        $jenis = jenis::find($id_jenis)->update(['status'=>'inactive']);
        $kategori = kategori::where('id_jenis',$id_jenis)->update(['status' => 'inactive']);
        $sub = sub::where('id_kategori',$kategori)->update(['status' => 'active']);
        return Redirect::back()->with('status','Data Telah Dirubah !');
    }

    //update kategori
    public function blokkat($id)
    {
        $kat = kategori::find($id)->update(['status'=>'active']);
        $kat = sub::where('id_kategori',$id)->update(['status'=>'active']);
        return redirect::back()->with('status','Data Telah Diubah');
    }

    public function openkat($id){
        $kat = kategori::find($id)->update(['status'=>'inactive']);
        $kat = sub::where('id_kategori',$id)->update(['status'=>'inactive']);
        return redirect::back()->with('status','Data Telah Diubah');
    }

    //update Subkategori
    public function bloksub($id_subkategori){
        $sub = sub::find($id_subkategori)->update(['status'=>'active']);
        return redirect::back()->with('status','Data Telah Diubah');
    }

    public function opensub($id_subkategori){
        $sub = sub::find($id_subkategori)->update(['status'=>'inactive']);
        return redirect::back()->with('status','Data Telah Diubah');
    }

    public function getdata($id){
        $kategori = DB::table('data_kategori')->where('id_jenis',$id_jenis);
        return json_encode($kategori);
    }

    public function editjenis(Request $request,$id_jenis){
        $jenis = jenis::where('id_jenis',$id_jenis)->first();
        $jenis->nama=$request->jenis;
        $jenis->save();

        return redirect::back();
    }

    public function tambahjenis(Request $request){
        $jenis = new jenis;
        $jenis->nama=$request->jenis;
        $jenis->form=$request->form;
        $jenis->save();

        return redirect::back();
    }

    public function editkat(Request $request,$id){
        $kat = kategori::where('id',$id)->first();
        $kat->nama_kategori=$request->kat;
        $kat->save();

        return redirect::back();
    }

    public function tambahkategori(Request $request){
        $kategori = new kategori;
        $kategori->nama_kategori=$request->kategori;
        $kategori->id_jenis=$request->jenis;
        $kategori->save();

        return redirect::back()->with('status','Data Kategori Telah Ditambahkan');
    }

    public function editsub(Request $request,$id_subkategori){
        $sub = sub::where('id_subkategori',$id_subkategori)->first();
        $sub->nama_sub=$request->sub;
        $sub->save();

        return redirect::back();
    }

    public function tambahsub(Request $request){
        $sub = new sub;
        $sub->nama_sub=$request->subkategori;
        $sub->id_kategori=$request->kategori;
        $sub->save();

        return redirect::back()->with('status','Data SubKategori Telah Ditambahkan');
    }

    public function akses(){
        $menu1 = menu::select('akses')->distinct()->get();
        $type = menu::select('jenis')->distinct()->get();
        $menu = menu::select('akses')->distinct()->get();
        $data = menu::select('jenis')->distinct()->get();
        return view('admin.aksesmenu')->with([
            'menu' => $menu,
            'menu1' => $menu1,
            'type' => $type,
            'data' => $data
        ]);
    }

    public function tambahmenu(Request $request){
        foreach ($request->input("akses") as $akses){
            $menu = new menu;
            $menu->type=$request->menu;
            $menu->jenis=$request->jenis;
            $menu->akses=$akses;
            $menu->save();
        }

    return redirect()->back();
    }

    public function jenismenu(Request $request){
        $jenis = new jenismenu;
        $jenis->type_menu=$request->type_menu;
        $jenis->jenis_menu=$request->jenis_menu;
        $jenis->save();

        return redirect::back();
    }

}