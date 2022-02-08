<?php

namespace App\Http\Controllers\pv;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Mail;

use App\model\pkp\PkpProject;
use App\model\pkp\ses;
use App\model\pkp\Forecast;
use App\model\pkp\ProjectLaunching;
use App\model\manager\pengajuan;
use Auth;
use DB;
use Redirect;

class PengajuanPkpController extends Controller
{
    public function SentPkpToRD(Request $request, $id_project){
        $data = PkpProject::where('id_project',$id_project)->where('status_project','active')->first();
        $data->prioritas    = $request->prioritas;
        $data->pkp_number   = $request->nopkp;
        $data->ket_no       = $request->ket_no;
        $data->status_pkp   = 'sent';
        $data->tujuankirim  = $request->kirim;
        $data->jangka       = $request->jangka;
        $data->waktu        = $request->waktu;
        $data->tahun        = $request->tahun;
        $data->tgl_kirim    = $request->date;
        $data->tujuankirim2 = $request->rka;
        $data->save();

        $isipkp = PkpProject::where('id_project',$id_project)->where('status_project','=','active')->get();
        $for    = Forecast::where('id_project',$data->id_project)->get();
        try{
            Mail::send('email.infoemailpkp', [
                'nama'   => $request->email,
                'app'    => $isipkp,
                'for'    => $for,
                'info'   => 'Anda Memiliki Project PKP Baru :)',
                'jangka' => $request->jangka,
                'waktu'  => $request->waktu,],function($message)use($request){
                    $message->subject('PKP '.$request->name);
                    $dept = DB::table('ms_departements')->where('id',$request->kirim)->get();//sent email to manager
                    foreach($dept as $dept){
                        $user = DB::table('tr_users')->where('id',$dept->manager_id)->get();
                        foreach($user as $user){
                            $data = $user->email;
                            $cc   = Auth::user()->email;
                            $message->to($data);
                            $message->cc($cc);
                        }
                    }
                    if($request->rka==1){ // CC Manager
                        $dept2 = DB::table('ms_departements')->where('id',$request->rka)->get();
                        foreach($dept2 as $dept2){
                            $user2 = DB::table('tr_users')->where('id',$dept2->manager_id)->get();
                            foreach($user2 as $user2){
                                $data2 = [$user2->email,Auth::user()->email];
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
            }
            catch (Exception $e){
            return response (['status' => false,'errors' => $e->getMessage()]);
        }
        return redirect::route('listpkp')->with('Project Successfully Submitted');
    }

    public function sentRevisiPkpRD(Request $request, $id_project){ // mengirim project pkp ke RD setelah project di revisi
        $data = PkpProject::where('id_project',$id_project)->first();
        $data->prioritas    = $request->prioritas;
        $data->pkp_number   = $request->nopkp;
        $data->ket_no       = $request->ket_no;
            if($data->userpenerima!=NULL){
                $data->status_pkp = 'proses';
            }elseif($data->userpenerima2!=NULL){
                $data->status_pkp = 'proses';
            }else{
                $data->status_pkp = 'sent';
            }
        $data->tujuankirim  = $request->kirim;
        $data->jangka       = $request->jangka;
        $data->waktu        = $request->waktu;
        $data->tgl_kirim    = $request->date;
        $data->tujuankirim2 = $request->rka;
        $data->save();
        
        $pengajuan = pengajuan::where('pkp_id',$data->updata)->count();
        if($pengajuan == 1){
            $pengajuan = pengajuan::where('pkp_id',$data->updata)->delete();
        }
        
        $isipkp = PkpProject::where('id_project',$id_project)->get();
        $for    = Forecast::where('id_project',$id_project)->get();
        try{
            Mail::send('email.infoemailpkp', [
                'nama'   => $request->email,
                'app'    => $isipkp,
                'for'    => $for,
                'info'   => 'Project Telah Selesai Di Revisi , dengan alasan revisi "'.$request->alasan.'"',
                'jangka' => $request->jangka,
                'waktu'  => $request->waktu,],function($message)use($request){
                    $message->subject('PKP '.$request->name);
                    $dept = DB::table('ms_departements')->where('id',$request->kirim)->get();//sent email to manager
                    foreach($dept as $dept){
                        $user = DB::table('tr_users')->where('id',$dept->manager_id)->get();
                        foreach($user as $user){
                            $data           = $user->email;
                            $penerima1      = $request->userpenerima;
                            $penerima2      = $request->userpenerima2;
                            $emailpenerima1 = DB::table('tr_users')->where('id',$request->userpenerima)->first();
                            $emailpenerima2 = DB::table('tr_users')->where('id',$request->userpenerima2)->first();
                            if($penerima1==NULL && $penerima2==NULL){
                                $cc = [Auth::user()->email];
                            }if($penerima1!=NULL && $penerima2==NULL){
                                $cc = [Auth::user()->email,$emailpenerima1->email];
                            }if($penerima1==NULL && $penerima2!=NULL){
                                $cc = [Auth::user()->email,$emailpenerima2->email];
                            }if($penerima1!=NULL && $penerima2!=NULL){
                                $cc = [Auth::user()->email,$emailpenerima1->email,$emailpenerima2->email];
                            }
                            $message->to($data);
                            $message->cc($cc);
                        }
                    }
                    if($request->rka==1){// CC Manager
                        $dept2 = DB::table('ms_departements')->where('id',$request->rka)->get();
                        foreach($dept2 as $dept2){
                            $user2 = DB::table('tr_users')->where('id',$dept2->manager_id)->get();
                            foreach($user2 as $user2){
                                $data2 = [$user2->email,Auth::user()->email];
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
            }
            catch (Exception $e){
            return response (['status' => false,'errors' => $e->getMessage()]);
        }
        return redirect::Route('listpkp');
    }

    public function SentPkpToUser(Request $request, $id_project){
        $edit = PkpProject::where('id_project',$id_project)->first();
        $edit->userpenerima  = $request->user;
        $edit->userpenerima2 = $request->user2;
        $edit->status_pkp    = 'proses';
        $edit->save();

        $for    = Forecast::where('id_project',$edit->id_project)->get();
        $isipkp = PkpProject::where('id_project',$id_project)->get();
        try{
            Mail::send('email.infoemailpkp', [
                'nama'   => $request->email,
                'app'    => $isipkp,
                'for'    => $for,
                'info'   => 'Anda memiliki project PKP baru',
                'jangka' => $request->jangka,
                'waktu'  => $request->waktu,
            ],function($message)use($request){
                $message->subject('PROJECT PKP');
                if(Auth::user()->departement_id!=1){//sent email to User
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
        return redirect::Route('listpkprka');
    }

    public function pengajuan(){ // halaman pengajuan Revisi
        $pengajuanpdf   = pengajuan::where('id_pdf','!=','')->get();
        $pengajuanpkp   = pengajuan::where('id_pkp','!=','')->join('tr_project_pkp','tr_project_pkp.id_project','tr_pengajuan.pkp_id')->get();
        $pengajuanpromo = pengajuan::where('id_promo','!=','')->get();
        $pengajuan      = pengajuan::count();
        return view('pv.datapengajuan')->with([
            'pengajuanpdf'  => $pengajuanpdf,
            'pengajuanpkp'  => $pengajuanpkp,
            'pengajuan'     => $pengajuan,
            'pengajuanpromo'=> $pengajuanpromo
        ]);
    }
    
    public function closeproject(Request $request,$id){ // launching project
        $this->validate($request, [
            'filename'  => 'required',
            'filename.*'=> 'required|file|max:2000kb'
        ]);

        $pkp     = PkpProject::where('id_project',$id)->first();
        $project = PkpProject::where('status_pkp','!=','draf')->where('status_project','=','active')->where('prioritas','>=',$pkp->prioritas)->get();
        foreach($project as $project){ // saat projectlaunching maka no prioritasnya akan di hapus, dan project yang memiliki no prioritas di bawan nya akan naik 1 tingkat.
            $akhir = PkpProject::where('id_project',$project->id_project)->update([
                'prioritas' => $project['prioritas']-1,
            ]);
        }
        $pkp->status_pkp = 'close';
        $pkp->tgl_launch = $request->date;
        $pkp->prioritas  = NULL;
        $pkp->save();
        
        $close = new ProjectLaunching; // menyimpan informasi launching
        $close->id_pkp          = $request->id;
        $close->tanggal         = $request->date;
        $close->nama_produk     = $request->produk;
        $close->formula_baku    = $request->baku;
        $close->formula_kemas   = $request->kemas;
        $close->rml             = $request->rml;
        $close->price_list      = $request->price;
        $close->forecast        = $request->forecast;
        $close->selling_channel = $request->selling_channel;
        $close->rto             = $request->rto;
        $close->note            = $request->note; 
        if($request->filename!=NULL){
            $data          = $request->file('filename');
            $nama          = $data->getClientOriginalName();
            $close->barcode= $nama;
            $tujuan_upload = 'data_file';
            $data->move($tujuan_upload,$data->getClientOriginalName());
        }
        $close->save();

        $emaillaunch = PkpProject::where('id_project',$id)->join('tr_project_launching','tr_project_pkp.id_project','tr_project_launching.id_pkp')->first();
        try{ // mengirmkan informasi launching ke user yang bersangkutan
            Mail::send('email.Emaillaunching', ['pkp'=>$emaillaunch,],function($message)use($request,$id){
                $user1    = $request->user1;
                $user2    = $request->user2;
                $rd1      = $request->rd1;
                $rd2      = $request->rd2;
                $author   = $request->author;
                $perevisi = $request->pv;
                $project  = PkpProject::where('id_project',$id)->first();
                if($project->tujuankirim2!=NULL && $project->tujuankirim!=NULL){
                    if($project->userpenerima2!=NULL && $project->userpenerima!=NULL){ // user rd kemas dan produk terisi
                        $to = [$user1,$user2,$rd1,$rd2,$author,$perevisi];
                    }elseif($project->userpenerima==NULL){ // user rd kemas terisi rd produk null
                        $to = [$user2,$rd2,$author,$perevisi];
                    }elseif($project->userpenerima2==NULL){ // user rd kemas null rd produk terisi
                        $to = [$user1,$rd1,$rd2,$author,$perevisi];
                    }
                }elseif($project->tujuankirim2==NULL && $project->tujuankirim!=NULL){
                    if($project->userpenerima!=NULL){
                        $to = [$user1,$rd1,$author,$perevisi];
                    }else{
                        $to = [$rd1,$author,$perevisi];
                    }
                }elseif($project->tujuankirim2!=NULL && $project->tujuankirim==NULL){
                    if($project->userpenerima2!=NULL){
                        $to = [$user2,$rd2,$author,$perevisi];
                    }else{
                        $to = [$rd2,$author,$perevisi];
                    }
                }
                
                $tujuan    = array(); 
                $validator = Validator::make($request->all(), $tujuan);  
                if ($validator->passes()) {
                    $email = implode(',', $request->input('tempEmail'));
                    $data  = explode(',', $email);
                    for ($i = 0; $i < count($data); $i++){
                        $message->subject('PRODEV | KONFIRMASI LAUNCHING PKP ['.$project->project_name.'] '.$request->date.'');
                        $message->to($to);
                        if($data[$i]!=NULL){
                            $message->cc($data[$i]);
                        }
                    }
                }

                $data   = $request->file('filename');
                $nama   = $data->getClientOriginalName();
                $message->attach(public_path() . '/data_file/' .$nama);
            });
        }
        catch (Exception $e){
        return response (['status' => false,'errors' => $e->getMessage()]);
        }
        return redirect()->back()->with('status', 'Project '.$pkp->project_name.' successfully closed');
    }
}