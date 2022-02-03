<?php

namespace App\Http\Controllers\feasibility;
use Illuminate\Support\Facades\Mail;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\model\feasibility\Feasibility;
use App\model\users\Departement;
use App\model\users\User;
use App\model\pkp\PkpProject;
use App\model\pdf\ProjectPDF;

use Redirect;
use Auth;

class ApproveFsController extends Controller
{
  public function approvefs(Request $request, $fs){
    $fs = Feasibility::where('id',$fs)->first();
    $fs->status='approve';
    $fs->note_approve=$request->note;
    $fs->save();

    if($request->type=="PKP"){ // jika type project fs adalah pkp maka data yang digunakan adalah PkpProject
        $data   = PkpProject::where('id_project',$fs->id_project)->first();
        $id     = $data->id_project;
    }elseif($request->type=='PDF'){ // jika type project fs adalah pdf maka data yg di gunakan adalah PdfProject
        $data   = ProjectPDF::where('id_project_pdf',$fs->id_project_pdf)->first();
        $id     = $data->id_project_pdf;
    }
    try{
        Mail::send('email.EmailUpFs', [ // mengirim email approval ke manager rea dan PIC fs lainnya
            'data'    => $data,
            'info'   => 'PV telah menerima pengajuan FS anda!',
            'alasan' => $request->note,
            'catatan' => '...',
        ], function ($message) use ($request,$id) {
            $data  = PkpProject::where('id_project',$id)->first();
            $mr    = Departement::where('dept','RKA')->first();
            $mr2   = Departement::where('dept','REA')->first();
            $user1 = User::where('departement_id','7')->first();
            $user2 = User::where('id',$data->user_fs)->first();
            $user3 = User::where('id',$data->userpenerima2)->first();
            $user4 = User::where('id',$mr->manager_id )->first();
            $user5 = User::where('id',$mr2->manager_id )->first();

            $message->subject('PRODEV | INFO APPROVAL MARGIN |'.$data->project_name.'- '.$request->tgl.'');
            $message->to([$user1->email,$user2->email,$user3->email,$user4->email,$user5->email]);
            $message->cc(Auth::user()->email);
        });
    }
    catch (Exception $e){
        return response (['status' => false,'errors' => $e->getMessage()]);
    }
    return redirect::back()->with('status','E-mail Successfully');
  }

  public function batalApprove($fs){
    $fs = Feasibility::where('id',$fs)->first();
    $fs->status         = NULL;
    $fs->note_approve   = NULL;
    $fs->save();

    return redirect::back();
  }

  public function batalReject($fs){
    $fs = Feasibility::where('id',$fs)->first();
    $fs->status         = NULL;
    $fs->note_approve   = NULL;
    $fs->save();

    return redirect::back();
  }

  public function rejectfs(Request $request, $fs){
    $fs = Feasibility::where('id',$fs)->first();
    $fs->status         = 'reject';
    $fs->note_approve   = $request->note;
    $fs->save();

    if($request->type=="PKP"){// jika type project fs adalah pkp maka data yang digunakan adalah PkpProject
        $data   = PkpProject::where('id_project',$fs->id_project)->first();
        $id     = $data->id_project;
    }elseif($request->type=='PDF'){ // jika type project fs adalah pdf maka data yg di gunakan adalah PdfProject
        $data   = ProjectPDF::where('id_project_pdf',$fs->id_project_pdf)->first();
        $id     = $data->id_project_pdf;
    }
    try{
        Mail::send('email.EmailUpFs', [ // mengirim email reject ke manager rea dan PIC fs lainnya
            'data'    => $data,
            'info'   => 'Maaf PV menolak pengajuan FS anda!',
            'alasan' => $request->note,
            'catatan' => '...',
        ], function ($message) use ($request,$id) {
            $data  = PkpProject::where('id_project',$id)->first();
            $mr    = Departement::where('dept','RKA')->first();
            $mr2   = Departement::where('dept','REA')->first();
            $user1 = User::where('departement_id','7')->first();
            $user2 = User::where('id',$data->user_fs)->first();
            $user3 = User::where('id',$data->userpenerima2)->first();
            $user4 = User::where('id',$mr->manager_id )->first();
            $user5 = User::where('id',$mr2->manager_id )->first();

            $message->subject('PRODEV | INFO REJECT MARGIN |'.$data->project_name.'- '.$request->tgl.'');
            $message->to([$user1->email,$user2->email,$user3->email,$user4->email,$user5->email]);
            $message->cc(Auth::user()->email);
        });
    }
    catch (Exception $e){
        return response (['status' => false,'errors' => $e->getMessage()]);
    }
    return redirect::back();
  }
}