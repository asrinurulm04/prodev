<?php

namespace App\Http\Controllers\formula;
use Illuminate\Support\Facades\Mail;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\model\devnf\storage;
use App\model\dev\Formula;
use App\model\master\tb_teams_brand;
use App\model\pkp\pkp_project;
use App\model\pkp\tipp;
use Auth;
use DB;
use redirect;

class storageController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
        $this->middleware('rule:user_rd_proses' || 'rule:user_produk');
    }

    public function st($formulas,$id){
        $formula = Formula::where('id',$id)->first();;
        $fo=formula::where('id',$id)->first();
        $idfor = $formula->workbook_id;
        $idf = $formula->id;
        $storage = storage::where('id_formula',$id)->get();
        $cek_storage =storage::where('id_formula',$id)->count();
        return view('formula.storage')->with([
            'fo' => $fo,
            'idf' => $idf,
            'id' => $id,
            'idfor' => $idfor,
            'storage' => $storage,
            'formula' => $formula,
            'cek_storage' =>$cek_storage
        ]);
    }

    public function hasilnya(Request $request)
    {
        $data = $request->file('filename');
        if($data!=NULL){ $nama = $data->getClientOriginalName();}
        
        $add_st = new storage;
        $add_st->id_formula=$request->idf;
        $add_st->id_wb=$request->wb;
        $add_st->id_wb_pdf=$request->wb_pdf;
        $add_st->no_PST=$request->spt;
        $add_st->suhu=$request->suhu;
        $add_st->estimasi_selesai=$request->estimasi;
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

    public function editdata(request $request, $id)
    {
        $data_storage= storage::where('id',$id)->first();
        $data_storage->no_HSA=$request->hsa;
        $data_storage->keterangan=$request->kesimpulan;
        $data_storage->selesai=$request->selesai;
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
            Mail::send('formula.emailstorage', [
                'app'=>$isistorage,
                'formula' => $formula,
                'info' => 'RD telah selesai membuat data Storage untuk project ini',
            ],function($message)use($request,$id_formula)
            {
                $message->subject('INFO STORAGE PRODEV');
                $for = Formula::where('id',$id_formula)->first();
                if($for->id_wb!=NULL){
                    $project = pkp_project::where('id_project',$for->workbook_id)->first();
                    $teams = tb_teams_brand::where('brand',$project->id_brand)->get();
                    // To
                    foreach($teams as $teams){
                        $user = DB::table('users')->where('id',$teams->id_user)->get();
                        foreach($user as $user){
                            $data = $user->email;
                            $message->to($data);
                        }
                    }
                }elseif($for->id_wb_pdf!=NULL){
                    $user = DB::table('users')->where('role_id','5')->get();
                    foreach($user as $user){
                        $data = $user->email;
                        dd($data);
                        $message->to($data);
                    }
                }
                // CC
                if($for->id_wb!=NULL){
                    $dept = DB::table('departements')->where('id',$project->tujuankirim)->get();
                    foreach($dept as $dept){
                        $user = DB::table('users')->where('id',$dept->manager_id)->get();
                        foreach($user as $user){
                            $data = $user->email;
                            $cc = [$data,Auth::user()->email,'asrinurul4238@gmail.com'];
                            $message->cc($cc);
                        }
                    }
                }elseif($for->id_wb_pdf!=NULL){
                    $project = project_pdf::where('id_project_pdf',$for->workbook_pdf_id)->first();
                    $dept = DB::table('departements')->where('id',$project->tujuankirim)->get();
                    foreach($dept as $dept){
                        $user = DB::table('users')->where('id',$dept->manager_id)->get();
                        foreach($user as $user){
                            $data = $user->email;
                            $cc = [$data,Auth::user()->email,'asrinurul4238@gmail.com'];
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