<?php

namespace App\Http\Controllers\feasibility;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\model\pdf\SubPDF;
use App\model\pkp\PkpProject;
use App\model\Modellab\DataLab;
use App\model\Modellab\ItemDesc;
use App\model\Modelkemas\KonsepKemas;
use App\model\Modelkemas\FormulaKemas;
use App\model\feasibility\compare;
use App\model\feasibility\Feasibility;
use App\model\Modelmesin\Mesin;
use App\model\Modelmesin\LiniTerdampak;
use Redirect;

class CompareController extends Controller
{
    public function compare($data,$id){ // halaman compare project
        if($data=='PKP'){ // jika type project fs adalah pkp maka data yang digunakan adalah PkpProject
          $project = PkpProject::where('id_project',$id)->first();
          $fs      = Feasibility::where('id_project',$id)->where('status_feasibility','!=','batal')->select('id','revisi','revisi_kemas','revisi_lab','revisi_proses')->get();
          $cm1     = compare::where('id_pkp',$id)->where('fs1','!=',NULL)->join('tr_feasibility','tr_feasibility.id','tr_compare.fs1')
                   ->join('tr_formulas','tr_formulas.id','tr_feasibility.id_formula')->join('tr_formpengajuanfs','tr_formpengajuanfs.id_feasibility','tr_feasibility.id')
                   ->join('tr_maklon','tr_maklon.id_fs','tr_feasibility.id')->first();
          $cm2     = compare::where('id_pkp',$id)->where('fs2','!=',NULL)->join('tr_feasibility','tr_feasibility.id','tr_compare.fs2')
                   ->join('tr_formulas','tr_formulas.id','tr_feasibility.id_formula')->join('tr_formpengajuanfs','tr_formpengajuanfs.id_feasibility','tr_feasibility.id')
                   ->join('tr_maklon','tr_maklon.id_fs','tr_feasibility.id')->first();
          $cm3     = compare::where('id_pkp',$id)->where('fs3','!=',NULL)->join('tr_feasibility','tr_feasibility.id','tr_compare.fs3')
                   ->join('tr_formulas','tr_formulas.id','tr_feasibility.id_formula')->join('tr_formpengajuanfs','tr_formpengajuanfs.id_feasibility','tr_feasibility.id')
                   ->join('tr_maklon','tr_maklon.id_fs','tr_feasibility.id')->first();
        }elseif($data=='PDF'){ // jika type project fs adalah pdf maka data yang digunakan adalah PdfProject
          $project = SubPDF::where('pdf_id',$id)->first();
          $fs      = Feasibility::where('id_project_pdf',$id)->where('status_feasibility','!=','batal')->select('id','revisi','revisi_kemas','revisi_lab','revisi_proses')->get();
          $cm1     = compare::where('id_pdf',$id)->where('fs1','!=',NULL)->join('tr_feasibility','tr_feasibility.id','tr_compare.fs1')
                   ->join('tr_formulas','tr_formulas.id','tr_feasibility.id_formula')->join('tr_maklon','tr_maklon.id_fs','tr_feasibility.id')->first();
          $cm2     = compare::where('id_pdf',$id)->where('fs2','!=',NULL)->join('tr_feasibility','tr_feasibility.id','tr_compare.fs2')
                   ->join('tr_formulas','tr_formulas.id','tr_feasibility.id_formula')->join('tr_maklon','tr_maklon.id_fs','tr_feasibility.id')->first();
          $cm3     = compare::where('id_pdf',$id)->where('fs3','!=',NULL)->join('tr_feasibility','tr_feasibility.id','tr_compare.fs3')
                   ->join('tr_formulas','tr_formulas.id','tr_feasibility.id_formula')->join('tr_maklon','tr_maklon.id_fs','tr_feasibility.id')->first();
        }
        $mesin   = Mesin::join('ms_mesin','ms_mesin.id_data_mesin','tr_mesin.id_data_mesin')->where('kategori','Filling')
                 ->join('tr_workbook_fs','tr_workbook_fs.id','tr_mesin.id_wb_fs')->where('tr_workbook_fs.status','Sent')->select('nama_mesin','id_feasibility')->distinct()->get();
        $kemas   = KonsepKemas::join('tr_workbook_fs','tr_workbook_fs.id','tr_datakemas.id_ws')->where('tr_workbook_fs.status','Sent')->select('referensi','id_feasibility')->get();
        $all     = LiniTerdampak::join('tr_workbook_fs','tr_workbook_fs.id','tr_lini_allergen.id_ws')->where('tr_workbook_fs.status','Sent')->get();
        $lokasi  = Mesin::join('ms_mesin','ms_mesin.id_data_mesin','tr_mesin.id_data_mesin')->where('kategori','!=','Filling')->where('kategori','!=','Packing')
                 ->join('tr_workbook_fs','tr_workbook_fs.id','tr_mesin.id_wb_fs')->where('tr_workbook_fs.status','Sent')->select('IO','id_feasibility')->distinct()->get();
        $lokasi2 = Mesin::join('ms_mesin','ms_mesin.id_data_mesin','tr_mesin.id_data_mesin')->where('kategori','Filling')->orwhere('kategori','Packing')
                 ->join('tr_workbook_fs','tr_workbook_fs.id','tr_mesin.id_wb_fs')->where('tr_workbook_fs.status','Sent')->select('IO','id_feasibility')->distinct()->get();
        $data    = $data;
        $dataLab = DataLab::join('ms_item_desc','ms_item_desc.id','tr_lab.id_item_desc')->get();
        $forKemas= FormulaKemas::join('tr_feasibility','tr_feasibility.id_wb_kemas','tr_formula_kemas.id_ws')->where('cost_uom','!=',NULL)->get();
        return view('feasibility.compare')->with([
            'project'  => $project,
            'fs'       => $fs,  'fs2'   => $fs,  'fs3'   => $fs,
            'cm1'      => $cm1, 'cm2'   => $cm2, 'cm3'   => $cm3,
            'all'      => $all, 'all2'  => $all, 'all3'  => $all,
            'all4'     => $all, 'all5'  => $all, 'all6'  => $all,
            'all7'     => $all, 'all8'  => $all, 'all9'  => $all,
            'lokasi1'  => $lokasi,
            'lokasi2'  => $lokasi2,
            'lokasi1a' => $lokasi,
            'lokasi2a' => $lokasi2,
            'lokasi1b' => $lokasi,
            'lokasi2b' => $lokasi2,
            'datalab'  => $dataLab,'datalab2'  => $dataLab,'datalab3'  => $dataLab,
            'forKemas' => $forKemas,'forKemas2' => $forKemas,'forKemas3' => $forKemas,
            'data'     => $data,
            'kemas'    => $kemas, 'kemas2' => $kemas, 'kemas3' => $kemas,
            'mesin'    => $mesin, 'mesin2' => $mesin, 'mesin3' => $mesin, 
        ]);
    }

    public function addcompare(Request $request, $id){ // menambahkan data yang akan di compare
        if($request->data=='PKP'){ 
          $hitung = compare::where('id_pkp',$id)->count();

          if($hitung!=0){ // jika pada table compare terdapat project pkp/pdf yang sama maka data tersebut akan di update dengan data yang baru
              $compare = compare::where('id_pkp',$id)->first();
          }elseif($hitung==0){ // jika pada table compare tidak terdapat project pkp/pdf maka akan menambahkan data baru
              $compare = new compare;
          }
          $compare->id_pkp        = $request->id;
          $compare->fs1           = $request->fs1;
          $compare->fs2           = $request->fs2;
          $compare->fs3           = $request->fs3;
          $compare->save();
        }elseif($request->data=='PDF'){ 
          $hitung = compare::where('id_pdf',$id)->count();

          if($hitung!=0){ // jika pada table compare terdapat project pkp/pdf yang sama maka data tersebut akan di update dengan data yang baru
              $compare = compare::where('id_pdf',$id)->first();
          }elseif($hitung==0){ // jika pada table compare tidak terdapat project pkp/pdf maka akan menambahkan data baru
              $compare = new compare;
          }
          $compare->id_pdf        = $request->id;
          $compare->fs1           = $request->fs1;
          $compare->fs2           = $request->fs2;
          $compare->fs3           = $request->fs3;
          $compare->save();
        }

        return redirect::back();
    }

    public function destroyCompare($data, $id){ // saat kembali ke halaman utama maka data compare pada table akan di hapus
        if($data=='PKP'){ 
          $compare_pkp = compare::where('id_pkp',$id)->count();
          if($compare_pkp>=1){
            $compare = compare::where('id_pkp',$id)->delete();
          }

          return redirect::route('listPkpFs',$id);
        }elseif($data=='PDF'){
          $compare_pdf = compare::where('id_pdf',$id)->count();
          if($compare_pdf>=1){
            $compare = compare::where('id_pdf',$id)->delete();
          }

          return redirect::route('listPdfFs',$id);
        }
    }
}