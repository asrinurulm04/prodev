<?php

namespace App\Http\Controllers\pv;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Mail;

use Auth;
use Redirect;
use DB;

use App\User;
use App\dev\formula;
use App\pkp\pkp_project;
use App\pkp\tipp;
use App\modelfn\finance;

class pengajuansampleController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
        $this->middleware('rule:pv_lokal');
    }

    public function ajukanfs($id_project,$for){
        $pkp = pkp_project::where('id_project',$id_project)->first();
        $pkp->pengajuan_sample='approve';
        $pkp->save();

        $sample = formula::where('id',$for)->first();
        $sample->status_fisibility='proses';
        $sample->status_panel='proses';
        $sample->status_storage='proses';
        $sample->vv='approve';
        $sample->save();

        $data = tipp::where('id_pkp',$id_project)->where('status_data','=','active')->first();
        $fs = new finance;
        $fs->id_wb=$data->id_pkp;
        $fs->id_formula=$for;
        $fs->save();

        return redirect::back();
    }

    public function tidakajukanfs($id_project,$for){
        $pkp = pkp_project::where('id_project',$id_project)->first();
        $pkp->pengajuan_sample='approve';
        $pkp->save();

        $sample = formula::where('id',$for)->first();
        $sample->status_fisibility='not_approved';
        $sample->status_panel='proses';
        $sample->status_storage='proses';
        $sample->vv='approve';
        $sample->save();

        return redirect::back();
    }

    public function unfinalsample($for){
        $pkp = formula::where('id',$for)->first();
        $pkp->vv='approve';
        $pkp->save();

        return redirect::back();
    }

    public function finalsample($id_sample){
        $pkp = formula::where('id',$id_sample)->first();
        $pkp->vv='final';
        $pkp->save();

        return redirect::back();
    }

    public function rejectsample(Request $request,$id_sample){
        $for = formula::where('id',$id_sample)->first();
        $for->vv='reject';
        $for->catatan_pv=$request->note;
        $for->save();

        $data = $for->workbook_id;

        // kirim email reject final sample (pengirim, Manager, PV)
        $isipkp = tipp::where('id_pkp',$for->workbook_id)->where('status_data','=','active')->get();
        try{
            Mail::send('manager.infoemailpkp', [
                'info' => 'Maaf Sampel project PKP yang anda ajukan ditolak karna "'.$request->note.'"',
                'app'=>$isipkp,],function($message)use($data)
            {
                $message->subject('Reject PKP sample');
                $message->from('app.prodev@nutrifood.co.id', 'Admin PRODEV');
                
                $datapkp = pkp_project::where('id_project',$data)->get();
                foreach($datapkp as $data){
                    $dept = DB::table('departements')->where('id',$data->tujuankirim)->get();
                    foreach($dept as $dept){
                        $user = user::where('id',$dept->manager_id)->get();
                        foreach($user as $user){
                            $to = $user->email;
                            $message->to($to);
                        }
                    }
                    $user1 = user::where('id',$data->userpenerima)->get();
                    foreach($user1 as $user1){
                        $cc = [$user1->email,Auth::user()->email];
                        $message->cc($cc);
                    }
                }
            });
            return back()->with('status','E-mail Successfully');
        }
        catch (Exception $e){
        return response (['status' => false,'errors' => $e->getMessage()]);
        }

        return redirect::back();
    }

    public function approvefs($id_sample){
        $for = formula::where('id',$id_sample)->first();
        $for->status_fisibility='approve';
        $for->save();

        $fs = feasibility::where('id_formula',$id_project)->first();
        $fs->status_feasibility='approve';
        $fs->save();

        return redirect::back();
    }
}
