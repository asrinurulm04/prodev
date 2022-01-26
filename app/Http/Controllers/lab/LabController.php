<?php

namespace App\Http\Controllers\lab;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

use App\model\pdf\SubPDF;
use App\model\pkp\PkpProject;
use App\model\Modellab\DataLab;
use App\model\Modellab\analisa;
use App\model\Modellab\ItemDesc;
use App\model\Modelmesin\IO;
use App\model\feasibility\Feasibility;
use Redirect;

class LabController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
        $this->middleware('rule:lab' || 'rule:admin');
    }

    public function index($id,$fs){ // halaman data lab
        $desc   = ItemDesc::all();
        $pkp    = PkpProject::where('id_project',$id)->first();
        $pdf    = SubPDF::where('pdf_id',$id)->join('tr_pdf_project','tr_pdf_project.id_project_pdf','tr_sub_pdf.pdf_id')->where('status_pdf','active')->first();
        $ws     = Feasibility::where('id',$fs)->first();
        $iddesc = DataLab::where('id_fs',$fs)->join('ms_item_desc','ms_item_desc.id','tr_lab.id_item_desc')->first();
        return view('lab.datalab')->with([
            'pkp'   => $pkp,
            'pdf'   => $pdf,
            'desc'  => $desc,
            'ws'    => $ws,
            'iddesc'=> $iddesc,
            'fs'    => $fs
        ]);
    }

    public function AddItem($id,$fs){ // halaman untuk menambahkan data item desc baru
        $io     = IO::all();
        $pkp    = PkpProject::where('id_project',$id)->first();
        $pdf    = SubPDF::where('pdf_id',$id)->join('tr_pdf_project','tr_pdf_project.id_project_pdf','tr_sub_pdf.pdf_id')->where('status_pdf','active')->first();
        $ws     = Feasibility::where('id',$fs)->first();
        return view('lab.add_item')->with([
            'pkp'   => $pkp,
            'pdf'   => $pdf,
            'io'    => $io,
            'fs'    => $fs,
            'ws'    => $ws
        ]);
    }

    public function add(Request $request){
        $item = new ItemDesc; // menambahkan data item desc baru
        $item->io                        = $request->io;
        $item->lokasi                    = $request->lokasi;
        $item->item_desc                 = $request->item;
        $item->biaya_analisa_tahun       = $request->biaya_analisa_tahun;
        $item->mikro_analisa             = $request->mikro_analisa;
        $item->spl_batch                 = $request->spl_batch;
        $item->analisa_swab              = $request->analisa_swab;
        $item->sample_swab               = $request->sample_swab;
        $item->biaya_tahanan             = $request->biaya_tahanan;
        $item->parameter_mikro           = $request->parameter_mikro;
        $item->kimia_batch               = $request->kimia_batch;
        $item->sample_analisa            = $request->sample_analisa;
        $item->biaya_analisa             = $request->biaya_analisa;
        $item->jlh_sample_mikro          = $request->jlh_sample_mikro;
        $item->jlh_mikro_tahunan         = $request->jlh_mikro_tahunan;
        $item->save();

        return redirect::route('datalab',[$request->project,$request->fs]);
    }

    public function item(Request $request){
        $fs     = Feasibility::where('id',$request->id)->first();
        $count  = DataLab::where('id_fs',$request->id)->count();
        if($count=='0'){
            $item = new DataLab;
        }elseif($count=='1'){
            $item = DataLab::where('id_fs',$request->id)->first();
        }
        $item->id_fs        = $request->id;
        $item->id_item_desc = $request->item;
        $item->save();

        $fs = Feasibility::where('id',$request->id)->first();
        $fs->status_lab='sending';
        $fs->save();

        if($fs->id_project!=NULL){
            return redirect::route('listPkpFs',$fs->id_project);
        }elseif($fs->id_project_pdf!=NULL){
            return redirect::route('listPdfFs',$fs->id_project_pdf);
        }
    }

    public function itemdesc(){ // data master itemdescs
        $item = ItemDesc::all();
        $io   = IO::all();
        return view('datamaster.itemdesc')->with([
            'item' => $item,
            'io'   => $io
        ]);
    }

    public function editItem(Request $request, $id){ // edit data item desc
        $edit = ItemDesc::where('id',$id)->update([
            'io' => $request->io,
            'item_desc' => $request->item_desc,
            'lokasi' => $request->lokasi,
            'biaya_analisa_tahun' => $request->biaya_analisa_tahun,
            'mikro_analisa' =>$request->mikro_analisa,
            'spl_batch' =>$request->spl_batch,
            'analisa_swab' =>$request->analisa_swab,
            'sample_swab' =>$request->sample_swab,
            'biaya_tahanan' =>$request->biaya_tahanan,
            'parameter_mikro' =>$request->parameter_mikro,
            'kimia_batch' =>$request->kimia_batch,
            'sample_analisa' =>$request->sample_analisa,
            'biaya_analisa' =>$request->biaya_analisa,
            'jlh_sample_mikro' =>$request->jlh_sample_mikro,
            'jlh_mikro_tahunan' =>$request->jlh_mikro_tahunan
        ]);

        return redirect::back()->with('status','Data berhasil di update!');;
    }
}