<?php

namespace App\Http\Controllers\formula;
use Illuminate\Support\Facades\Mail;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\model\formula\storage;
use App\model\formula\Formula;
use App\model\master\Teams;
use App\model\pkp\PkpProject;
use App\model\pdf\ProjectPDF;
use Auth;
use DB;
use redirect;

class storageController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
        $this->middleware('rule:user_rd_proses' || 'rule:user_produk');
    }

    public function st($formulas,$pkp,$id){
        $idfor       = $formulas;
        $formula     = Formula::where('id',$formulas)->first();
        $storage     = storage::where('id_formula',$formulas)->get();
        $cek_storage = storage::where('id_formula',$formulas)->count();
        return view('formula.storage')->with([
            'id'          => $id,
            'idfor'       => $idfor,
            'pkp'         =>$pkp,
            'storage'     => $storage,
            'formula'     => $formula,
            'cek_storage' =>$cek_storage
        ]);
    }

    public function hasilnya(Request $request){
        $data = $request->file('filename');
        if($data!=NULL){ $nama = $data->getClientOriginalName();}
        
        $add_st = new storage;
        $add_st->id_formula      = $request->idf;
        $add_st->id_wb           = $request->wb;
        $add_st->id_wb_pdf       = $request->wb_pdf;
        $add_st->no_PST          = $request->spt;
        $add_st->suhu            = $request->suhu;
        $add_st->estimasi_selesai= $request->estimasi;
        if($data!=NULL){ 
            $add_st->data_file=$nama;
        }
        $add_st->save();

        $for = Formula::where('id',$request->idf)->first();
        $for->status_storage='proses';
        $for->save();

        if($data!=NULL){
            $tujuan_upload = 'data_file';
            $data->move($tujuan_upload,$data->getClientOriginalName());
        }
    
        return redirect()->back();
    }

    public function editdata(request $request, $id){
        $data_storage= storage::where('id',$id)->first();
        $data_storage->no_HSA       = $request->hsa;
        $data_storage->keterangan   = $request->kesimpulan;
        $data_storage->selesai      = $request->selesai;
        $data_storage->save();

        return redirect()->back();
    }

    public function delete($id){
        $storage = storage::where('id',$id)->delete();
        return redirect()->back()->with('status','proses storage'.' Telah Dihapus! ');
    }

    public function ajukanstorage(Request $request,$id_formula,$id_storage){
        $formula = Formula::where('id',$id_formula)->first();
        $formula->status_storage='sent';
        $formula->save();

        $storage = storage::where('id',$id_storage)->first();
        $storage->status='done';
        $storage->save();

        $isistorage = storage::where('id',$id_storage)->first();
        try{
            Mail::send('email.emailstorage', [
                'app'     => $isistorage,
                'formula' => $formula,
                'info'    => 'RD telah selesai membuat data Storage untuk project ini',
            ],function($message)use($request,$id_formula) {
                $message->subject('INFO STORAGE PRODEV');
                $for = Formula::where('id',$id_formula)->first();
                if($for->id_wb!=NULL){
                    $project = PkpProject::where('id_project',$for->workbook_id)->first();
                    $teams   = Teams::where('brand',$project->id_brand)->get();
                    // To
                    foreach($teams as $teams){
                        $user = DB::table('tr_users')->where('id',$teams->id_user)->get();
                        foreach($user as $user){
                            $data = $user->email;
                            $message->to($data);
                        }
                    }
                }elseif($for->id_wb_pdf!=NULL){
                    $user = DB::table('tr_users')->where('role_id','5')->get();
                    foreach($user as $user){
                        $data = $user->email;
                        $message->to($data);
                    }
                }
                // CC
                if($for->id_wb!=NULL){
                    $dept = DB::table('ms_departements')->where('id',$project->tujuankirim)->get();
                    foreach($dept as $dept){
                        $user = DB::table('tr_users')->where('id',$dept->manager_id)->get();
                        foreach($user as $user){
                            $data = $user->email;
                            $cc   = [$data,Auth::user()->email,'asrinurul4238@gmail.com'];
                            $message->cc($cc);
                        }
                    }
                }elseif($for->id_wb_pdf!=NULL){
                    $project = ProjectPDF::where('id_project_pdf',$for->workbook_pdf_id)->first();
                    $dept    = DB::table('ms_departements')->where('id',$project->tujuankirim)->get();
                    foreach($dept as $dept){
                        $user = DB::table('tr_users')->where('id',$dept->manager_id)->get();
                        foreach($user as $user){
                            $data = $user->email;
                            $cc   = [$data,Auth::user()->email,'asrinurul4238@gmail.com'];
                            $message->cc($cc);
                        }
                    }
                }
            });
        }
        catch (Exception $e){
        return response (['status' => false,'errors' => $e->getMessage()]);
        }
        return redirect()->back();
    }
}