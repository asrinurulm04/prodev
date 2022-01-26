<?php

namespace App\Http\Controllers\pv;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Mail;

use App\model\manager\pengajuan;
use App\model\users\User;
use App\model\users\Departement;
use App\model\pkp\ses;
use App\model\pdf\SubPDF;
use App\model\pdf\ProjectPDF;
use Carbon\Carbon;
use Auth;
use DB;
use Redirect;

class PengajuanPdfController extends Controller
{
    
    public function sentpdf(Request $request, $id_project_pdf,$revisi,$turunan){ // mengirimkan project PDF ke manager RD setelah project di revisi
        $edit = ProjectPDF::where('id_project_pdf',$id_project_pdf)->first();
        $edit->tujuankirim    = $request->kirim;
        $edit->status_project = 'sent';
        $edit->pdf_number     = $request->nopdf;
        $edit->ket_no         = $request->ket_no;
        $edit->jangka         = $request->jangka;
        $edit->tujuankirim2   = $request->rka;
        $edit->waktu          = $request->waktu;
        $edit->prioritas      = $request->prioritas;
        $edit->tgl_kirim      = $request->last;
        $edit->status         = 'active';
        $edit->save();

        $data = SubPDF::where([ ['pdf_id',$id_project_pdf], ['revisi',$revisi], ['turunan',$turunan] ])->first();
        $data->status_data='proses';
        $data->save();

        $pdf = pengajuan::where('id_pdf',$id_project_pdf)->count();
        if($pdf>=1){
            $pengajuan = pengajuan::where('id_pdf',$id_project_pdf)->first();
            $pengajuan->delete();
        }
        return redirect::Route('listpdf');
    }

    public function SentPdfToUser(Request $request, $id_project_pdf){ // mengirimkan project ke User RD
        $edit = ProjectPDF::where('id_project_pdf',$id_project_pdf)->first();
        $edit->userpenerima   = $request->user;
        $edit->userpenerima2  = $request->user2;
        $edit->status_project = 'proses';
        $edit->save();

        $isipdf = SubPDF::where('pdf_id',$id_project_pdf)->where('status_pdf','=','active')->get();
        try{
            Mail::send('email.infoemailpdf', [
                'nama'  => $request->email,
                'app'   => $isipdf,
                'info'  => 'anda memiliki project PDF baru :)',
                'jangka'=> $request->jangka,
                'waktu' => $request->waktu,
            ],function($message)use($request){
                $message->subject('PROJECT PDF');
                if($request->user!=null){ //sent email to User
                    $user = DB::table('tr_users')->where('id',$request->user)->get();
                    foreach($user as $user){
                        $data = $user->email;
                        $message->to($data);
                    }
                }else{
                    $user2 = DB::table('tr_users')->where('id',$request->user2)->get();
                    foreach($user2 as $user2){
                        $data2 = $user2->email;
                        $message->to($data2);
                    }
                }

                if($request->pic!=null){
                    $tujuan    = array(); 
                    $validator = Validator::make($request->all(), $tujuan);  
                    if ($validator->passes()) {
                        $picture = implode(',', $request->input('pic'));
                        $data    = explode(',', $picture);
                        for ($i = 0; $i < count($data); $i++){
                            $message->attach(public_path() . '/' .$data[$i]);
                        }
                    }
                }
            });
        }
        catch (Exception $e){
        return response (['status' => false,'errors' => $e->getMessage()]);
        }
        return redirect::Route('listpdfrka');
    }
    
    public function SentRevisiToRD(Request $request, $id_project_pdf,$revisi,$turunan){ // mengirimkan project PDF ke manager RD
        $edit = ProjectPDF::where('id_project_pdf',$id_project_pdf)->first();
        $edit->tujuankirim   = $request->kirim;
        $edit->status_project= 'sent';
        $edit->pdf_number    = $request->nopdf;
        $edit->ket_no        = $request->ket_no;
        $edit->jangka        = $request->jangka;
        $edit->tujuankirim2  = $request->rka;
        $edit->tgl_kirim     = $request->date;
        $edit->waktu         = $request->waktu;
        $edit->prioritas     = $request->prioritas;
        $edit->status        = 'active';
        $edit->save();

        $data = SubPDF::where([ ['pdf_id',$id_project_pdf], ['revisi',$revisi], ['turunan',$turunan] ])->first();
        $data->status_data='sent';
        $data->save();

        $isipdf = SubPDF::where('pdf_id',$id_project_pdf)->where('status_pdf','=','active')->get();
        try{
            Mail::send('email.infoemailpdf', [
                'nama'  => $request->email,
                'app'   => $isipdf,
                'info'  => 'Anda Memiliki Project PDF Baru :)',
                'jangka'=> $request->jangka,
                'waktu' => $request->waktu,
            ],function($message)use($request){
                $message->subject('PROJECT PDF-'.$request->name);
                $dept = DB::table('ms_departements')->where('id',$request->kirim)->get(); //sent email to manager
                foreach($dept as $dept){
                    $user = DB::table('tr_users')->where('id',$dept->manager_id)->get();
                    foreach($user as $user){
                        $data = $user->email;
                        $message->to($data);
                        $message->cc('asrimarifah0402@gmail.com');
                        $message->bcc('asrimarifah0402@gmail.com');
                    }
                }
                if($request->rka==1){// CC Manager tambahan
                    $dept2 = DB::table('ms_departements')->where('id',$request->rka)->get();
                    foreach($dept2 as $dept2){
                        $user2 = DB::table('tr_users')->where('id',$dept2->manager_id)->get();
                        foreach($user2 as $user2){
                            $data2 = $user2->email;
                            $message->cc($data2);
                        }
                    }
                }
                if($request->pic!=null){ // attach file
                    $tujuan = array(); 
                    $validator = Validator::make($request->all(), $tujuan);  
                    if ($validator->passes()) {
                        $picture = implode(',', $request->input('pic'));
                        $data    = explode(',', $picture);
                        for ($i = 0; $i < count($data); $i++){
                            $message->attach(public_path() . '/' .$data[$i]);
                        }
                    }
                }
            });
        }
        catch (Exception $e){
        return response (['status' => false,'errors' => $e->getMessage()]);
        }
        return redirect::Route('listpdf');
    }
}