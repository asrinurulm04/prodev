<?php

namespace App\Http\Controllers\pv;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Mail;

use App\model\promo\promo;
use App\model\promo\DataPromo;
use Auth;
use DB;
use Redirect;

class PengajuanPromoController extends Controller
{
    public function sentPromoToRD(Request $request, $id_pkp_promo,$revisi,$turunan){ // mengirimkan project promo ke RD
        $data = promo::where('id_pkp_promo',$id_pkp_promo)->first();
        $data->tujuankirim   = $request->kirim;
        $data->tujuankirim2  = $request->rka;
        $data->prioritas     = $request->prioritas;
        $data->promo_number  = $request->nopromo;
        $data->ket_no        = $request->ket_no;
        $data->status_project= 'sent';
        $data->tgl_kirim     = $request->date;
        $data->jangka        = $request->jangka;
        $data->waktu         = $request->waktu;
        $data->status        = 'active';
        $data->save();

        $promo = DataPromo::where([ ['id_pkp_promoo',$id_pkp_promo], ['revisi',$revisi], ['turunan',$turunan] ])->first();
        $promo->status_promo='sent';
        $promo->save();

        $isipromo = DataPromo::where('id_pkp_promoo',$id_pkp_promo)->where('status_data','=','active')->get();
        try{
            Mail::send('email.infoemailpromo', [
                'nama'   => $request->email,
                'app'    => $isipromo,
                'jangka' => $request->jangka,
                'info'   => 'Anda Memiliki Project PKP PROMO Baru :)',
                'waktu'  => $request->waktu,
            ],function($message)use($request){
                $message->subject('PROJECT PKP PROMO-'.$request->name);
                $dept = DB::table('ms_departements')->where('id',$request->kirim)->get(); //sent email to manager
                foreach($dept as $dept){
                    $user = DB::table('tr_users')->where('id',$dept->manager_id)->get();
                    foreach($user as $user){
                        $data = $user->email;
                        $message->to($data);
                    }
                }
                if($request->rka==1){ // CC Manager
                    $dept2 = DB::table('ms_departements')->where('id',$request->rka)->get();
                    foreach($dept2 as $dept2){
                        $user2 = DB::table('tr_users')->where('id',$dept2->manager_id)->get();
                        foreach($user2 as $user2){
                            $data2 = $user2->email;
                            $message->cc($data2);
                        }
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
            return back()->with('status','E-mail Successfully');
        }
        catch (Exception $e){
            return response (['status' => false,'errors' => $e->getMessage()]);
        }
        return redirect::Route('listpromo');
    }
    
    public function SentToUser(Request $request, $id_pkp_promo){ // mengirimkan project promo ke user RD
        $edit = promo::where('id_pkp_promo',$id_pkp_promo)->first();
        $edit->userpenerima   = $request->user;
        $edit->userpenerima2  = $request->user2;
        $edit->status_project = 'proses';
        $edit->save();

        $isipromo = DataPromo::where('id_pkp_promoo',$id_pkp_promo)->where('status_data','=','active')->get();
        try{
            Mail::send('email.infoemailpromo', [
                'nama'   => $request->email,
                'app'    => $isipromo,
                'jangka' => $request->jangka,
                'info'   => 'Anda memiliki project PKP baru',
                'waktu'  => $request->waktu,
            ],function($message)use($request){
                $message->subject('PROJECT PKP PROMO');
                if($request->user!=null){
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

                if($request->pic!=null){ // jika project promo memiliki data attach maka sistem akan mengirimkan data tersebut ke email
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
        return redirect::Route('listpromoo')->with('status','Data Berhasil dikirim');
    }
}
