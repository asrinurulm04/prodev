<?php

namespace App\Http\Controllers\pv;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Mail;

use App\pkp\pkp_type;
use App\User;
use App\pkp\uom;
use App\pkp\data_detail_klaim;
use App\pkp\sample_project;
use App\pkp\data_ses;
use App\pkp\klaim;
use App\pkp\detail_klaim;
use App\pkp\komponen;
use App\pkp\data_klaim;
use App\manager\pengajuan;
use App\pkp\project_pdf;
use App\pkp\ses;
use Carbon\Carbon;
use App\notification;
use App\kemas\datakemas;
use App\pkp\coba;
use App\master\Brand;
use App\users\Departement;
use App\pkp\jenis;
use App\pkp\data_forecast;
use App\pkp\picture;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Calendar;
use Redirect;


class pdfController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
        $this->middleware('rule:pv_global' || 'rule:pv_lokal' || 'rule:NR' || 'rule:marketing' || 'rule:manager' || 'rule:admin');
    }

    public function datapdf(Request $request){
        $pdf = new project_pdf;
        $pdf->reference=$request->reference;
        $pdf->product_type=$request->product_type;
        $pdf->project_name=$request->project_name;
        $pdf->id_brand=$request->brand;
        $pdf->id_type=$request->type;
        $pdf->author=$request->author;
        $pdf->created_date=$request->date;
        $pdf->country=$request->country;
        $pdf->save();

        return Redirect()->route('rekappdf',$pdf->id_project_pdf);
    }

    public function klaim(Request $request,$id_project_pdf){
        $pdf = project_pdf::where('id_project_pdf',$id_project_pdf)->first();
        $pdf->author=Auth::user()->id;
        $pdf->save();

        return redirect()->back();
    }

    public function lihatpdf($id_project_pdf,$revisi,$turunan){
        $pengajuanpdf = project_pdf::join('pkp_pengajuan','pdf_project.id_project_pdf','=','pkp_pengajuan.id_pdf')->count();
        $datapdf = coba::where('pdf_id',$id_project_pdf)->count();
        $max = coba::where('pdf_id',$id_project_pdf)->max('turunan');
        $pdf1 = coba::where('pdf_id',$id_project_pdf)->where('revisi','<=',$revisi)->where('turunan','<=',$turunan)->orderBy('turunan','desc')->get();
        $pdf2 = coba::where('pdf_id',$id_project_pdf)->where('revisi','<=',$revisi)->where('turunan',$max)->orderBy('revisi','desc')->get();
        $pdf = coba::join('pdf_project','tipu.pdf_id','=','pdf_project.id_project_pdf')->where('id_project_pdf',$id_project_pdf)->where('revisi',$revisi)->where('turunan',$turunan)->get();
        $for = data_forecast::where('id_pdf',$id_project_pdf)->where('turunan','<=',$turunan)->orderBy('turunan','desc')->get();
        $ses = data_ses::where('id_pdf',$id_project_pdf)->where('turunan','<=',$turunan)->orderBy('turunan','desc')->get();
        $nopdf = DB::table('pdf_project')->max('pdf_number')+1;
        $dept1 = Departement::all();
        $dept = Departement::all();
        $dataklaim = data_klaim::where('id_pdf',$id_project_pdf)->join('klaim','klaim.id','=','id_klaim')->where('revisi',$revisi)->where('turunan',$turunan)->get();
        $datadetail = data_detail_klaim::where('id_pdf',$id_project_pdf)->where('revisi',$revisi)->where('turunan',$turunan)->get();
        $pengajuan = pengajuan::count();
        $notif = notification::where('status','=','active')->count();
        $pesan = notification::orderBy('updated_at','desc')->get();
        $hitungnotif = $pengajuan + $notif;
        $user = DB::table('users')->join('pdf_project','pdf_project.tujuankirim','=','users.departement_id')->get();
        $picture = picture::where('pdf_id',$id_project_pdf)->where('turunan','<=',$turunan)->orderBy('turunan','desc')->get();
        return view('pdf.lihatpdf')->with([
            'pdf' => $pdf,
            'pdf1' => $pdf1,
            'pdf2' => $pdf2,
            'datadetail' => $datadetail,
            'dataklaim' => $dataklaim,
            'pengajuanpdf' => $pengajuanpdf,
            'pesan' => $pesan,
            'notif' =>$notif,
            'pengajuan' => $pengajuan,
            'hitungnotif' => $hitungnotif,
            'datases' => $ses,
            'dept' => $dept,
            'for' => $for,
            'dept1' => $dept1,
            'datapdf' => $datapdf,
            'user' => $user,
            'nopdf' => substr("T00".$nopdf,1,3),
            'picture' => $picture
        ]); 
    }

    public function downloadpdf($id_project_pdf,$revisi,$turunan){
        $pdf = coba::join('pdf_project','tipu.pdf_id','=','pdf_project.id_project_pdf')->where([ ['pdf_id',$id_project_pdf], ['revisi',$revisi], ['turunan',$turunan] ])->get();
        $ses = data_ses::where([ ['id_pdf',$id_project_pdf], ['revisi',$revisi], ['turunan',$turunan] ])->get();
        $nopdf = DB::table('pdf_project')->max('pdf_number')+1;
        $dept = Departement::all();
        $pdf1 = coba::where('pdf_id',$id_project_pdf)->where('revisi',$revisi)->where('turunan',$turunan)->get();
        $pengajuan = pengajuan::count();
        $for = data_forecast::where('id_pdf',$id_project_pdf)->where('revisi',$revisi)->where('turunan',$turunan)->get();
        $notif = notification::where('status','=','active')->count();
        $pesan = notification::orderBy('updated_at','desc')->get();
        $hitungnotif = $pengajuan + $notif;$pengajuan = pengajuan::count();
        $user = DB::table('users')->join('pdf_project','pdf_project.tujuankirim','=','users.departement_id')->get();
        $picture = picture::where('pdf_id',$id_project_pdf)->get();
        return view('pdf.pdfdownload')->with([
            'pdf' => $pdf,
            'pdf1' => $pdf1,
            'for' => $for,
            'datases' => $ses,
            'dept' => $dept,
            'user' => $user,
            'pesan' => $pesan,
            'notif' =>$notif,
            'pengajuan' => $pengajuan,
            'hitungnotif' => $hitungnotif,
            'nopdf' => substr("T00".$nopdf,1,3),
            'picture' => $picture
        ]); 
    }

    public function hapuspdf($id_project_pdf){
        $pdf= project_pdf::where('id_project_pdf',$id_project_pdf)->first();
        $pdf->delete();

        $Dpdf= coba::where('pdf_id',$id_project_pdf)->first();
        if($Dpdf!=NULL){
            $Dpdf->delete();
        }

        $story= notification::where('id_pdf',$id_project_pdf)->first();
        if($story!=NULL){
            $story->delete();
        }

        return redirect::back();
    }
    public function approve1(Request $request,$id_project_pdf){
        $pdf = project_pdf::where('id_project_pdf',$id_project_pdf)->first();
        $pdf->status_terima='terima';
        $pdf->save();

        return redirect::back();
    }

    public function approvesamplepdf($id_sample){
        $pdf = sample_project::where('id_sample',$id_sample)->first();
        $pdf->status='approve';
        $pdf->save();

        return redirect::back();
    }

    public function rejectsamplepdf(Request $request,$id_sample){
        $pdf = sample_project::where('id_sample',$id_sample)->first();
        $pdf->status='reject';
        $pdf->catatan_reject=$request->note;
        $pdf->save();

        return redirect::back();
    }

    public function finalsamplepdf($id_project_pdf,$id_sample){
        $sample = project_pdf::where('id_project_pdf',$id_project_pdf)->first();
        $sample->pengajuan_sample='approve';
        $sample->save();
        
        $pdf = sample_project::where('id_sample',$id_sample)->first();
        $pdf->status='final';
        $pdf->save();

        // kirim email final sample (pengirim, pv)
        $isipdf = coba::where('pdf_id',$id_project_pdf)->where('status_pdf','=','active')->get();
        try{
            Mail::send('manager.infoemailpdf', [
                'info' => 'Sample project PDF yang diajukan telah disetujui',
                'app'=>$isipdf,],function($message)use($id_project_pdf)
            {
                $message->subject('Approved PDF sample');
                $message->from('app.prodev@nutrifood.co.id', 'Admin PRODEV');
                
                $datapdf = project_pdf::where('id_project_pdf',$id_project_pdf)->get();
                foreach($datapdf as $data){
                    $dept = DB::table('departements')->where('id',$data->tujuankirim)->get();
                    foreach($dept as $dept){
                        $user = user::where('id',$dept->manager_id)->get();
                        foreach($user as $user){
                            $to = $user->email;
                            // dd($to);
                            $message->to($to);
                        }
                    }
                    $user1 = user::where('id',$data->userpenerima)->get();
                    foreach($user1 as $user1){
                        $cc = [$user1->email,Auth::user()->email];
                        // dd($cc);
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

    public function unfinalsamplepdf($id_project_pdf,$id_sample){
        $sample = project_pdf::where('id_project_pdf',$id_project_pdf)->first();
        $sample->pengajuan_sample='sent';
        $sample->save();

        $pdf = sample_project::where('id_sample',$id_sample)->first();
        $pdf->status='approve';
        $pdf->save();

        // kirim email unfinal sample (pengirim, pv)
        $isipdf = coba::where('pdf_id',$id_project_pdf)->where('status_pdf','=','active')->get();
        try{
            Mail::send('manager.infoemailpdf', [
                'info' => 'Sample project PDF yang diajukan batal disetujui',
                'app'=>$isipdf,],function($message)use($id_project_pdf)
            {
                $message->subject('Cancellation of sample approval');
                $message->from('app.prodev@nutrifood.co.id', 'Admin PRODEV');
                
                $datapdf = project_pdf::where('id_project_pdf',$id_project_pdf)->get();
                foreach($datapdf as $data){
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

    public function approve2(Request $request,$id_project_pdf){
        $pdf = project_pdf::where('id_project_pdf',$id_project_pdf)->first();
        $pdf->status_terima2='terima';
        $pdf->save();

        return redirect::back();
    }

    public function freeze(Request $request,$id_project_pdf){
        $data= project_pdf::where('id_project_pdf',$id_project_pdf)->first();
        $data->status_freeze='active';
        $data->freeze=Auth::user()->id;
        $data->waktu_freeze=Carbon::now();
        $data->note_freeze=$request->notefreeze;
        $data->save();

        return redirect::back()->with('status', 'Project '.$data->project_name.' has been disabled!');
    }

    public function ubahTMpdf(Request $request,$id_project_pdf){
        $data= project_pdf::where('id_project_pdf',$id_project_pdf)->first();
        $data->status_project='revisi';
        $data->save();
        $pengajuan= new pengajuan;
        $pengajuan->prioritas_pengajuan=1;
        $pengajuan->id_pdf=$request->pdf;
        $pengajuan->penerima='5';
        $pengajuan->alasan_pengajuan=$request->lamafreeze;
        $pengajuan->save();

        return redirect::back();
    }

    public function activepdf($id_project_pdf){
        $data= project_pdf::where('id_project_pdf',$id_project_pdf)->first();
        $data->status_freeze='inactive';
        $data->save();

        return redirect::back();
    }

    public function TMubah(Request $request,$id_project_pdf){
        $data= project_pdf::where('id_project_pdf',$id_project_pdf)->first();
        $data->status_project='sent';
        $data->jangka=$request->jangka;
        $data->waktu=$request->waktu;
        $data->status_freeze='inactive';
        $data->freeze_diaktifkan=Carbon::now();
        $data->save();

        $pengajuan = pengajuan::where('id_pdf',$id_project_pdf)->first();
        $pengajuan->delete();

        return redirect::back();
    } 

    public function formpdf(){
        $type = pkp_type::all();
        $pdf1 = project_pdf::where('status_project','!=','draf')->get();
        $pengajuan = pengajuan::count();
        $notif = notification::where('status','=','active')->count();
        $pesan = notification::orderBy('updated_at','desc')->get();
        $hitungnotif = $pengajuan + $notif;
        $brand = brand::all();
        return view('pdf.requestpdf')->with([
            'type' => $type,
            'brand' => $brand,
            'pdf1' => $pdf1,
            'pesan' => $pesan,
            'notif' =>$notif,
            'pengajuan' => $pengajuan,
            'hitungnotif' => $hitungnotif
        ]);
    }

    public function drafpkp(){
        $pdf = project_pdf::all()->sortByDesc('cretaed_date');;
        $pengajuan = pengajuan::count();
        $notif = notification::where('status','=','active')->count();
        $pesan = notification::orderBy('updated_at','desc')->get();
        $hitungnotif = $pengajuan + $notif;
        return view('pdf.pdfdraf')->with([
            'pdf' => $pdf,
            'pesan' => $pesan,
            'notif' =>$notif,
            'pengajuan' => $pengajuan,
            'hitungnotif' => $hitungnotif
        ]);
    }

    public function listpdf(){
        $pdf = project_pdf::orderBy('prioritas','asc')->get();
        $type = pkp_type::all();
        $brand = brand::all();
        $pengajuan = pengajuan::count();
        $notif = notification::where('status','=','active')->count();
        $pesan = notification::orderBy('updated_at','desc')->get();
        $hitungnotif = $pengajuan + $notif;
        return view('pdf.listpdf')->with([
            'type' => $type,
            'pdf' => $pdf,
            'brand' => $brand,
            'pesan' => $pesan,
            'notif' =>$notif,
            'pengajuan' => $pengajuan,
            'hitungnotif' => $hitungnotif
        ]);
    }

    public function buatpdf($id_project_pdf){
        $jenis = jenis::all();
        $kemas= datakemas::all();
        $ses = ses::all();
        $eksis=datakemas::count();
        $Ddetail = data_detail_klaim::max('id')+1;
        $detail = detail_klaim::all();
        $klaim = klaim::all();
        $komponen = komponen::all();
        $user = user::where('status','=','active')->get();
        $project = coba::where('status_data','!=','draf')->where('status_pdf','=','active')->join('pdf_project','pdf_project.id_project_pdf','=','tipu.pdf_id')->get();
        $hitung =coba::where('pdf_id',$id_project_pdf)->count();
        $pdf = coba::where('pdf_id',$id_project_pdf)->get();
        $pengajuan = pengajuan::count();
        $notif = notification::where('status','=','active')->count();
        $pesan = notification::orderBy('updated_at','desc')->get();
        $hitungnotif = $pengajuan + $notif;
        $id_pdf = project_pdf::find($id_project_pdf);
        return view('pdf.buatpdf')->with([
            'jenis' => $jenis,
            'user' => $user,
            'ses' => $ses,
            'Ddetail' => $Ddetail,
            'detail' => $detail,
            'klaim' => $klaim,
            'komponen' => $komponen,
            'hitung' => $hitung,
            'kemas' => $kemas,
            'project' => $project,
            'eksis' => $eksis,
            'pdf' => $pdf,
            'id_pdf' => $id_pdf,
            'pesan' => $pesan,
            'notif' =>$notif,
            'pengajuan' => $pengajuan,
            'hitungnotif' => $hitungnotif
        ]);
    }

    public function konfigurasi($id_project_pdf,$turunan){
        $konfig = coba::where([ ['pdf_id',$id_project_pdf], ['turunan',$turunan] ])->first();
        $konfig->kemas_eksis=null;
        $konfig->save();
        return redirect::back();
    }

    public function buatpdf1($id_project_pdf,$revisi,$turunan){
        $jenis = jenis::all();
        $hitung =coba::where('pdf_id',$id_project_pdf)->count();
        $pdf = coba::where([ ['pdf_id',$id_project_pdf], ['revisi',$revisi], ['turunan',$turunan] ])
        ->join('pdf_project','pdf_project.id_project_pdf','tipu.pdf_id')->get();
        $datases = data_ses::where([ ['id_pdf',$id_project_pdf], ['revisi',$revisi], ['turunan',$turunan] ])->get();
        $project = coba::where('status_data','!=','draf')->where('status_pdf','=','active')->join('pdf_project','pdf_project.id_project_pdf','=','tipu.pdf_id')->get();
        $kemas = datakemas::all();
        $ses = ses::all();
        $dataklaim = data_klaim::where('id_pdf',$id_project_pdf)->where('turunan',$turunan)->where('revisi',$revisi)->get();
        $datadetail = data_detail_klaim::where('id_pdf',$id_project_pdf)->where('turunan',$turunan)->where('revisi',$revisi)->get();
        $detail = detail_klaim::all();
        $klaim = klaim::all();
        $Ddetail = data_detail_klaim::max('id')+1;
        $komponen = komponen::all();
        $for = data_forecast::where('id_pdf',$id_project_pdf)->where('revisi',$revisi)->where('turunan',$turunan)->get();
        $for2 = data_forecast::where('id_pdf',$id_project_pdf)->where('revisi',$revisi)->where('turunan',$turunan)->count();
        $eksis=datakemas::count();
        $user = user::where('status','=','active')->get();
        $pengajuan = pengajuan::count();
        $notif = notification::where('status','=','active')->count();
        $pesan = notification::orderBy('updated_at','desc')->get();
        $hitungnotif = $pengajuan + $notif;
        $id_pdf = project_pdf::find($id_project_pdf);
        return view('pdf.buatpdf1')->with([
            'jenis' => $jenis,
            'project' => $project,
            'eksis' => $eksis,
            'ses' => $ses,
            'kemas' => $kemas,
            'Ddetail' => $Ddetail,
            'komponen' => $komponen,
            'klaim' => $klaim,
            'detail' => $detail,
            'datadetail' => $datadetail,
            'dataklaim' => $dataklaim,
            'for' => $for,
            'user' => $user,
            'for2' => $for2,
            'datases' => $datases,
            'hitung' => $hitung,
            'pesan' => $pesan,
            'notif' =>$notif,
            'pengajuan' => $pengajuan,
            'hitungnotif' => $hitungnotif,
            'pdf' => $pdf,
            'id_pdf' => $id_pdf
        ]);
    }

    public function coba(Request $request){
        $coba = new coba;
        $coba ->pdf_id=$request->id;
        if($request->primer==''){
            $coba->kemas_eksis=$request->data_eksis;
            }elseif($request->primer!='NULL'){
                $coba->kemas_eksis=$request->kemas;

                $kemas = new datakemas;
                $kemas->tersier=$request->tersier;
                $kemas->s_tersier=$request->s_tersier;
                $kemas->primer=$request->primer;
                $kemas->s_primer=$request->s_primer;
                $kemas->sekunder1=$request->sekunder1;
                $kemas->s_sekunder1=$request->s_sekunder1;
                $kemas->sekunder2=$request->sekunder2;
                $kemas->s_sekunder2=$request->s_sekunder2;
                $kemas->save();
            }
        $coba ->primery=$request->primary;
        $coba ->secondery=$request->secondary;
        $coba ->Tertiary=$request->tertiary;
        $coba ->last_update=$request->last_up;
        $coba ->dariusia=$request->dariumur;
        $coba ->perevisi=Auth::user()->id;
        $coba ->sampaiusia=$request->sampaiumur;
        $coba ->gender=$request->gender;
        $coba ->other=$request->other;
        $coba ->wight=$request->weight;
        $coba ->serving=$request->serving;
        $coba ->target_price=$request->target_price;
        $coba ->claim=$request->claim;
        $coba ->ingredient=$request->ingredient;
        $coba ->background=$request->background;
        $coba ->attractiveness=$request->attractive;
        $coba ->rto=$request->rto;
        $coba ->turunan='0';
        $coba ->revisi='0';
        $coba ->name=$request->name_competitors;
        $coba ->retailer_price=$request->retailer_price;
        $coba ->special=$request->special;
        $coba ->save();

        $notif = new notification;
        $notif->id_pdf=$coba->pdf_id;
        $notif->title="Add Data PDF";
        $notif->revisi=$coba->revisi;
        $notif->turunan=$coba->turunan;
        $notif->perevisi=Auth::user()->id;
        $notif->save();

        if($request->ses!=''){
            $rule = array(); 
            $validator = Validator::make($request->all(), $rule);  
            if ($validator->passes()) {
                $idz = implode(',', $request->input('ses'));
                $ids = explode(',', $idz);
                for ($i = 0; $i < count($ids); $i++)
                {
                    $pipeline = new data_ses;
                    $pipeline->id_pdf=$request->id;
                    $pipeline->turunan='0';
                    $pipeline->ses = $ids[$i];
                    $pipeline->save();
                    $i = $i++;
            
                }
            }
        } 

        if($request->klaim!=''){
            $dataklaim = array(); 
            $validator = Validator::make($request->all(), $dataklaim);  
            if ($validator->passes()) {
                $idz = implode(',', $request->input('klaim'));
                $ids = explode(',', $idz);
                $ida = implode(',', $request->input('komponen'));
                $idb = explode(',', $ida);
                $note = implode(',', $request->input('ket'));
                $data = explode(',', $note);
                for ($i = 0; $i < count($ids); $i++)
                {
                    $pipeline = new data_klaim;
                    $pipeline->id_pdf=$request->id;
                    $pipeline->turunan='0';
                    $pipeline->revisi='0';
                    $pipeline->id_klaim = $ids[$i];
                    $pipeline->id_komponen = $idb[$i];
                    $pipeline->note = $data[$i];
                    $pipeline->save();
                    $i = $i++;
                }
            }
        }

        if($request->detail!=''){
            $detailklaim = array(); 
            $validator = Validator::make($request->all(), $detailklaim);  
            if ($validator->passes()) {
                $idz = implode(',', $request->input('detail'));
                $ids = explode(',', $idz);
                for ($i = 0; $i < count($ids); $i++)
                {
                    $detail = new data_detail_klaim;
                    $detail->id_pdf=$request->id;
                    $pipeline->turunan='0';
                    $pipeline->revisi='0';
                    $detail->id_detail = $ids[$i];
                    $detail->save();
                    $i = $i++;

                }
            }
        }

        if($request->forecast!='' && $request->satuan!=''){
            $data = array(); 
            $validator = Validator::make($request->all(), $data);  
            if ($validator->passes()) {
                $idz = implode(',', $request->input('forecast'));
                $ids = explode(',', $idz);
                $ida = implode(',', $request->input('satuan'));
                $idb = explode(',', $ida);
                for ($i = 0; $i < count($ids); $i++)
                {
                    $pipeline = new data_forecast;
                    $pipeline->id_pdf=$request->id;
                    $pipeline->turunan='0';
                    $pipeline->forecast = $ids[$i];
                    $pipeline->satuan = $idb[$i];
                    $pipeline->save();
                    $i = $i++;
                }
            }
        }

        return redirect()->Route('datatambahanpdf',['pdf_id' => $coba->pdf_id, 'revisi' => $coba->revisi, 'turunan' => $coba->turunan])->with('status', 'Data has been added up ');
    }

    public function updatecoba2(Request $request,$pdf_id,$revisi,$turunan){

        $coba = coba::where([ ['pdf_id',$pdf_id], ['revisi',$revisi], ['turunan',$turunan] ])->first();
        $coba ->pdf_id=$request->id;
        if($request->primer==''){
            $coba->kemas_eksis=$request->data_eksis;
            }elseif($request->primer!='NULL'){
            $coba->kemas_eksis=$request->kemas;

                $kemas = new datakemas;
                $kemas->tersier=$request->tersier;
                $kemas->s_tersier=$request->s_tersier;
                $kemas->primer=$request->primer;
                $kemas->s_primer=$request->s_primer;
                $kemas->sekunder1=$request->sekunder1;
                $kemas->s_sekunder1=$request->s_sekunder1;
                $kemas->sekunder2=$request->sekunder2;
                $kemas->s_sekunder2=$request->s_sekunder2;
                $kemas->save();
            }
        $coba ->primery=$request->primary;
        $coba ->secondery=$request->secondary;
        $coba ->Tertiary=$request->tertiary;
        $coba ->dariusia=$request->dariumur;
        $coba ->sampaiusia=$request->sampaiumur;
        $coba ->gender=$request->gender;
        $coba ->other=$request->other;
        $coba ->wight=$request->weight;
        $coba ->perevisi=Auth::user()->id;
        $coba ->last_update=$request->last_up;
        $coba ->serving=$request->serving;
        $coba ->target_price=$request->target_price;
        $coba->claim=$request->claim;
        $coba->revisi=$revisi;
        $coba->turunan=$turunan;
        $coba->ingredient=$request->ingredient;
        $coba->background=$request->background;
        $coba->attractiveness=$request->attractive;
        $coba->rto=$request->rto;
        $coba->name=$request->name_competitors;
        $coba->retailer_price=$request->retailer_price;
        $coba->special=$request->special;
        $coba->save();

        $notif = notification::where('id_pdf',$pdf_id)->first();
        $notif->id_pdf=$pdf_id;
        $notif->title="Edit Data PDF";
        $notif->revisi=$revisi;
        $notif->status='active';
        $notif->turunan=$turunan;
        $notif->perevisi=Auth::user()->id;
        $notif->save();

        if($request->ses!=''){
            $rule = array(); 
            $uom = data_ses::where([ ['id_pdf',$pdf_id], ['revisi',$revisi], ['turunan',$turunan] ])->delete();
            $validator = Validator::make($request->all(), $rule);  
            if ($validator->passes()) {
                $idz = implode(',', $request->input('ses'));
                $ids = explode(',', $idz);
                for ($i = 0; $i < count($ids); $i++)
                {
                    $pipeline = new data_ses;
                    $pipeline->id_pdf=$request->id;
                    $pipeline->turunan=$turunan;
                    $pipeline->revisi=$revisi;
                    $pipeline->ses = $ids[$i];
                    $pipeline->save();
                    $i = $i++;
                }
            }
        }

        if($request->forecast!=''){
            $data = array(); 
            $for = data_forecast::where('id_pdf',$pdf_id)->where('revisi',$revisi)->where('turunan',$turunan)->delete();
            $validator = Validator::make($request->all(), $data);  
            if ($validator->passes()) {
                $idz = implode(',', $request->input('forecast'));
                $ids = explode(',', $idz);
                $ida = implode(',', $request->input('satuan'));
                $idb = explode(',', $ida);
                for ($i = 0; $i < count($ids); $i++)
                {
                    $pipeline = new data_forecast;
                    $pipeline->id_pdf=$request->id;
                    $pipeline->turunan=$turunan;
                    $pipeline->revisi=$revisi;
                    $pipeline->forecast = $ids[$i];
                    $pipeline->satuan = $idb[$i];
                    $pipeline->save();
                    $i = $i++;
                }
            }
        }

        if($request->klaim!=''){
            $dataklaim = array(); 
            $validator = Validator::make($request->all(), $dataklaim);  
            if ($validator->passes()) {
                $idz = implode(',', $request->input('klaim'));
                $ids = explode(',', $idz);
                $ida = implode(',', $request->input('komponen'));
                $idb = explode(',', $ida);
                $note = implode(',', $request->input('ket'));
                $data = explode(',', $note);
                for ($i = 0; $i < count($ids); $i++)
                {
                    $pipeline = new data_klaim;
                    $pipeline->id_pdf=$request->id;
                    $pipeline->turunan=$turunan;
                    $pipeline->revisi=$revisi;
                    $pipeline->id_klaim = $ids[$i];
                    $pipeline->id_komponen = $idb[$i];
                    $pipeline->note = $data[$i];
                    $pipeline->save();
                    $i = $i++;
                }
            }
        }

        if($request->detail!=''){
            $detailklaim = array(); 
            $validator = Validator::make($request->all(), $detailklaim);  
            if ($validator->passes()) {
                $idz = implode(',', $request->input('detail'));
                $ids = explode(',', $idz);
                for ($i = 0; $i < count($ids); $i++)
                {
                    $detail = new data_detail_klaim;
                    $detail->id_pdf=$request->id;
                    $pipeline->turunan=$turunan;
                    $pipeline->revisi=$revisi;
                    $detail->id_detail = $ids[$i];
                    $detail->save();
                    $i = $i++;

                }
            }
        }

        try{
            Mail::send('pv.aktifitasemail', ['type'=>'PDF',],function($message)use($request)
            {
                $tujuan = array(); 
                $validator = Validator::make($request->all(), $tujuan);  
                if ($validator->passes()) {
                $email = implode(',', $request->input('emailtujuan'));
                $data = explode(',', $email);
                for ($i = 0; $i < count($data); $i++)
                {
                    $message->subject('Update Data PDF');
                    $message->from('app.prodev@nutrifood.co.id', 'Admin PRODEV');
                    $message->to($request->pengirim1);
                    $message->cc($data[$i]);

                }
            }
            });
        }
        catch (Exception $e){
        return response (['status' => false,'errors' => $e->getMessage()]);
        }

        return redirect()->Route('datatambahanpdf',['pdf_id' => $coba->pdf_id, 'revisi' => $coba->revisi, 'turunan' => $coba->turunan])->with('status', 'Revised Data ');
    }

    public function updatecoba(Request $request,$id_project_pdf,$revisi,$turunan){
        $pdf = coba::where('pdf_id',$id_project_pdf)->max('turunan');
        $naikversi = $pdf + 1;

        $datapdf = coba::where('pdf_id',$id_project_pdf)->where('revisi',$revisi)->where('turunan',$turunan)->first();
        $datapdf->status_pdf='inactive';
        $datapdf->save();

            $clf=coba::where('pdf_id',$id_project_pdf)->where('revisi',$revisi)->where('turunan',$turunan)->count();
            if($clf>0){
                $isipdf=coba::where('pdf_id',$id_project_pdf)->where('revisi',$revisi)->where('turunan',$turunan)->get();
                foreach ($isipdf as $pdfp)
                {
                $coba= new coba;
                $coba ->pdf_id=$request->id;
                if($request->primer==''){
                    $coba->kemas_eksis=$request->data_eksis;
                    }elseif($request->primer!='NULL'){
                    $coba->kemas_eksis=$request->kemas;

                        $kemas = new datakemas;
                        $kemas->tersier=$request->tersier;
                        $kemas->s_tersier=$request->s_tersier;
                        $kemas->primer=$request->primer;
                        $kemas->s_primer=$request->s_primer;
                        $kemas->sekunder1=$request->sekunder1;
                        $kemas->s_sekunder1=$request->s_sekunder1;
                        $kemas->sekunder2=$request->sekunder2;
                        $kemas->s_sekunder2=$request->s_sekunder2;
                        $kemas->save();
                    }
                $coba ->primery=$request->primary;
                $coba ->secondery=$request->secondary;
                $coba ->Tertiary=$request->tertiary;
                $coba ->perevisi=Auth::user()->id;
                $coba ->last_update=$request->last_up;
                $coba ->dariusia=$request->dariumur;
                $coba ->sampaiusia=$request->sampaiumur;
                $coba ->gender=$request->gender;
                $coba ->other=$request->other;
                $coba ->turunan=$naikversi;
                $coba ->revisi=$pdfp->revisi;
                $coba ->wight=$request->weight;
                $coba ->serving=$request->serving;
                $coba ->target_price=$request->target_price;
                $coba ->claim=$request->claim;
                $coba ->ingredient=$request->ingredient;
                $coba ->background=$request->background;
                $coba ->attractiveness=$request->attractive;
                $coba ->rto=$request->rto;
                $coba ->status_pdf='active';
                $coba ->name=$request->name_competitors;
                $coba ->retailer_price=$request->retailer_price;
                $coba ->special=$request->special;
                $coba ->save();

                $notif = new notification;
                $notif->id_pdf=$request->id;
                $notif->title="Add Data PDF";
                $notif->revisi=$pdfp->revisi;
                $notif->turunan=$naikversi;
                $notif->perevisi=Auth::user()->id;
                $notif->save();
                }
                
            }
            
            $datases=data_ses::where('id_pdf',$id_project_pdf)->where('revisi',$revisi)->where('turunan',$turunan)->count();
            if($datases>0){
                $isises=data_ses::where('id_pdf',$id_project_pdf)->where('revisi',$revisi)->where('turunan',$turunan)->get();
                foreach ($isises as $isises)
                {
                    $data1= new data_ses;
                    $data1->id_pdf=$isises->id_pdf;
                    $data1->turunan=$naikversi;
                    $data1->revisi='0';
                    $data1->ses=$isises->ses;
                    $data1->save();
                }
            }

            $datafor=data_forecast::where('id_pdf',$id_project_pdf)->where('revisi',$revisi)->where('turunan',$turunan)->count();
            if($datafor>0){
                $isifor=data_forecast::where('id_pdf',$id_project_pdf)->where('revisi',$revisi)->where('turunan',$turunan)->get();
                foreach ($isifor as $isifor)
                {
                    $for= new data_forecast;
                    $for->id_pdf=$isifor->id_pdf;
                    $for->turunan=$naikversi;
                    $for->revisi='0';
                    $for->forecast=$isifor->forecast;
                    $for->satuan=$isifor->satuan;
                    $for->save();
                }
            }

            if($request->klaim!=''){
                $dataklaim = array(); 
                $validator = Validator::make($request->all(), $dataklaim);  
                if ($validator->passes()) {
                    $idz = implode(',', $request->input('klaim'));
                    $ids = explode(',', $idz);
                    $ida = implode(',', $request->input('komponen'));
                    $idb = explode(',', $ida);
                    $note = implode(',', $request->input('ket'));
                    $data = explode(',', $note);
                    for ($i = 0; $i < count($ids); $i++)
                    {
                        $pipeline = new data_klaim;
                        $pipeline->id_pdf=$request->id;
                        $pipeline->turunan=$naikversi;
                        $pipeline->revisi='0';
                        $pipeline->id_klaim = $ids[$i];
                        $pipeline->id_komponen = $idb[$i];
                        $pipeline->note = $data[$i];
                        $pipeline->save();
                        $i = $i++;
                    }
                }
            }
    
            if($request->detail!=''){
                $detailklaim = array(); 
                $validator = Validator::make($request->all(), $detailklaim);  
                if ($validator->passes()) {
                    $idz = implode(',', $request->input('detail'));
                    $ids = explode(',', $idz);
                    for ($i = 0; $i < count($ids); $i++)
                    {
                        $detail = new data_detail_klaim;
                        $detail->id_pdf=$request->id;
                        $detail->turunan=$naikversi;
                        $detail->revisi='0';
                        $detail->id_detail = $ids[$i];
                        $detail->save();
                        $i = $i++;
            
                    }
                }
            }

            try{
                Mail::send('pv.aktifitasemail', ['type'=>'PDF',],function($message)use($request)
                {
                    $tujuan = array(); 
                    $validator = Validator::make($request->all(), $tujuan);  
                    if ($validator->passes()) {
                    $email = implode(',', $request->input('emailtujuan'));
                    $data = explode(',', $email);
                    for ($i = 0; $i < count($data); $i++)
                    {
                        $message->subject('Update Data PDF');
                        $message->from('app.prodev@nutrifood.co.id', 'Admin PRODEV');
                        $message->to($request->pengirim1);
                        $message->cc($data[$i]);
    
                    }
                }
                });
            }
            catch (Exception $e){
            return response (['status' => false,'errors' => $e->getMessage()]);
            }

        return redirect()->Route('datatambahanpdf',['pdf_id' => $request->id, 'revisi' => $datapdf->revisi, 'turunan' => $naikversi])->with('status', 'Revised Data ');
    }

    public function uploadpdf($id_project_pdf,$revisi,$turunan){
        $pengajuanpdf = project_pdf::join('pkp_pengajuan','pdf_project.id_project_pdf','=','pkp_pengajuan.id_pdf')->count();
        $coba = picture::where('pdf_id',$id_project_pdf)->where('revisi','<=',$revisi)->where('turunan','<=',$turunan)->get();
        $coba1 = picture::where('pdf_id',$id_project_pdf)->where('turunan','<=',$turunan)->count();
        $turunan = coba::where([ ['pdf_id',$id_project_pdf], ['revisi',$revisi], ['turunan',$turunan] ])->get();
        $pengajuan = pengajuan::count();
        $notif = notification::where('status','=','active')->count();
        $pesan = notification::orderBy('updated_at','desc')->get();
        $hitungnotif = $pengajuan + $notif;
        $pdf = project_pdf::where('id_project_pdf',$id_project_pdf)->get();
        $id_pdf= project_pdf::find($id_project_pdf);
        
        return view('pdf.datatambahanpdf')->with([
            'coba' => $coba,
            'pdf' => $pdf,
            'turunan' => $turunan,
            'coba1' => $coba1,
            'id_pdf' => $id_pdf,
            'pengajuanpdf' => $pengajuanpdf,
            'pesan' => $pesan,
            'notif' =>$notif,
            'pengajuan' => $pengajuan,
            'hitungnotif' => $hitungnotif
        ]);
    }

    public function infogambarpdf(Request $request){
        $info = $request->input('informasi');
        foreach($info as $row){
            foreach($info as $row){
                $pkp = picture::where('id_pictures',$row['pic'])->update([
                    "informasi" => $row['info']
                ]);
            }
        }
        return redirect::route('rekappdf',$request->id);
    }

    public function uploaddatapdf(Request $request){
        $this->validate($request, [
            'filename' => 'required',
            'filename.*' => 'required|file|max:3072'
        ]);

        $files = [];
        foreach ($request->file('filename') as $file) {
            if ($file->isValid()) {
                $nama = time();
                $nama_file = time()."_".$file->getClientOriginalName();
                $path = $file->move('data_file',$nama_file);
                $turunan =$request->turunan;
                $form=$request->id;
                $files[] = [
                    'filename' => $nama_file,
                    'lokasi' => $path,
                    'lokasi' => $path,
                    'pdf_id' => $form,
                    'turunan' => $turunan,
                ];
            }
        }
        picture::insert($files);
        return redirect()
        ->back()
        ->withSuccess(sprintf('%s file uploaded successfully.', count($files)));
    }

    public function destroydata($id_pictures){
        $data = picture::find($id_pictures);
        $data->delete();
        return redirect()->back()->with('status', 'Data berhasil dihapus!');
    }

    public function edit(Request $request, $id_project_pdf,$revisi,$turunan){
        $edit = project_pdf::where('id_project_pdf',$id_project_pdf)->first();
        $edit->tujuankirim=$request->kirim;
        $edit->status_project='sent';
        $edit->pdf_number=$request->nopdf;
        $edit->ket_no=$request->ket_no;
        $edit->jangka=$request->jangka;
        $edit->tujuankirim2=$request->rka;
        $edit->waktu=$request->waktu;
        $edit->prioritas=$request->prioritas;
        $edit->status='active';
        $edit->save();

        $data = coba::where([ ['pdf_id',$id_project_pdf], ['revisi',$revisi], ['turunan',$turunan] ])->first();
        $data->status_data='sent';
        $data->save();

        $isipdf = coba::where('pdf_id',$id_project_pdf)->where('status_pdf','=','active')->get();
        try{
            Mail::send('manager.infoemailpdf', [
                'nama'=>$request->email,
                'app'=>$isipdf,
                'info' => 'Anda Memiliki Project PDF Baru :)',
                'jangka' => $request->jangka,
                'waktu' => $request->waktu,
            ],function($message)use($request)
            {
                $message->subject('PROJECT PDF');
                $message->from('app.prodev@nutrifood.co.id', 'Admin PRODEV');
                //sent email to manager
                $dept = DB::table('departements')->where('id',$request->kirim)->get();
                foreach($dept as $dept){
                    $user = DB::table('users')->where('id',$dept->manager_id)->get();
                    foreach($user as $user){
                        $data = $user->email;
                        //dd($data);
                        $message->to($data);
                    }
                }

                // CC Manager
                if($request->rka==1){
                    $dept2 = DB::table('departements')->where('id',$request->rka)->get();
                    foreach($dept2 as $dept2){
                        $user2 = DB::table('users')->where('id',$dept2->manager_id)->get();
                        foreach($user2 as $user2){
                            $data2 = $user2->email;
                            //dd($data);
                            $message->cc($data2);
                        }
                    }
                }

                if($request->pic!=null){
                    $tujuan = array(); 
                    $validator = Validator::make($request->all(), $tujuan);  
                    if ($validator->passes()) {
                        $picture = implode(',', $request->input('pic'));
                        $data = explode(',', $picture);
                        for ($i = 0; $i < count($data); $i++)
                        {
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

        return redirect::Route('listpdf');
    }

    public function sentpdf(Request $request, $id_project_pdf,$revisi,$turunan){
        $edit = project_pdf::where('id_project_pdf',$id_project_pdf)->first();
        $edit->tujuankirim=$request->kirim;
        $edit->status_project='sent';
        $edit->pdf_number=$request->nopdf;
        $edit->ket_no=$request->ket_no;
        $edit->jangka=$request->jangka;
        $edit->tujuankirim2=$request->rka;
        $edit->waktu=$request->waktu;
        $edit->status='active';
        $edit->save();

        $data = coba::where([ ['pdf_id',$id_project_pdf], ['revisi',$revisi], ['turunan',$turunan] ])->first();
        $data->status_data='sent';
        $data->save();

        $pengajuan = pengajuan::where('id_pdf',$id_project_pdf)->first();
        $pengajuan->delete();

        return redirect::Route('listpdf');
    }

    public function edituser(Request $request, $id_project_pdf){
        $edit = project_pdf::where('id_project_pdf',$id_project_pdf)->first();
        $edit->userpenerima=$request->user;
        $edit->userpenerima2=$request->user2;
        $edit->status_project='proses';
        $edit->save();

        $isipdf = coba::where('pdf_id',$id_project_pdf)->where('status_pdf','=','active')->get();
        try{
            Mail::send('manager.infoemailpdf', [
                'nama'=>$request->email,
                'app'=>$isipdf,
                'jangka' => $request->jangka,
                'waktu' => $request->waktu,
            ],function($message)use($request)
            {
                $message->subject('PROJECT PDF');
                $message->from('app.prodev@nutrifood.co.id', 'Admin PRODEV');
                //sent email to User
                if($request->user!=null){
                    $user = DB::table('users')->where('id',$request->user)->get();
                    foreach($user as $user){
                        $data = $user->email;
                        // dd($data);
                        $message->to($data);
                    }
                }else{
                    $user2 = DB::table('users')->where('id',$request->user2)->get();
                    foreach($user2 as $user2){
                        $data2 = $user2->email;
                        // dd($data2);
                        $message->to($data2);
                    }
                }

                if($request->pic!=null){
                    $tujuan = array(); 
                    $validator = Validator::make($request->all(), $tujuan);  
                    if ($validator->passes()) {
                        $picture = implode(',', $request->input('pic'));
                        $data = explode(',', $picture);
                        for ($i = 0; $i < count($data); $i++)
                        {
                            $message->attach(public_path() . '/' .$data[$i]);
                        }
                    }
                }
            });
            return redirect::Route('listpdfrka')->with('status','E-mail Successfully');
        }
        catch (Exception $e){
        return response (['status' => false,'errors' => $e->getMessage()]);
        }
        return redirect::Route('listpdfrka');
    }

    public function prioritas(Request $request,$id_project_pdf){
        $pkp = project_pdf::where('id_project_pdf',$id_project_pdf)->first();
        $pkp->prioritas=$request->prioritas;
        $pkp->save();

        return redirect::back();
    }

    public function daftarpdf($id_project_pdf){
        $pengajuanpdf = project_pdf::join('pkp_pengajuan','pdf_project.id_project_pdf','=','pkp_pengajuan.id_pdf')->count();
        $data = project_pdf::where('id_project_pdf',$id_project_pdf)->get();
        $data1 = project_pdf::where('id_project_pdf',$id_project_pdf)->get();
        $hitung = coba::where('pdf_id',$id_project_pdf)->count();
        $pengajuan = pengajuan::count();
        $sample_project = sample_project::where('id_pdf',$id_project_pdf)->get();
        $status_sample_project = sample_project::where('id_pdf',$id_project_pdf)->where('status','=','final')->count();
        $notif = notification::where('status','=','active')->count();
        $pesan = notification::orderBy('updated_at','desc')->get();
        $hitungnotif = $pengajuan + $notif;
        $max2 = coba::where('pdf_id',$id_project_pdf)->max('revisi');
        $max = coba::where('pdf_id',$id_project_pdf)->max('turunan');
        $pdf = project_pdf::where('id_project_pdf',$id_project_pdf)->join('tipu','tipu.pdf_id','pdf_project.id_project_pdf')->where('turunan',$max)->where('revisi',$max2)->get();
        $pdff = project_pdf::where('id_project_pdf',$id_project_pdf)->join('tipu','tipu.pdf_id','pdf_project.id_project_pdf')->where('turunan',$max)->where('revisi',$max2)->get();
        return view('pdf.daftarpdf')->with([
            'data' => $data,
            'data1' => $data1,
            'pesan' => $pesan,
            'sample' => $sample_project,
            'status_sample' => $status_sample_project,
            'notif' =>$notif,
            'pengajuan' => $pengajuan,
            'hitungnotif' => $hitungnotif,
            'pengajuanpdf' => $pengajuanpdf,
            'hitung' => $hitung,
            'pdff' => $pdff,
            'pdf' => $pdf
        ]);
    }

    public function upversionpdf($id_project_pdf,$revisi,$turunan){
        $pdf = coba::where('pdf_id',$id_project_pdf)->max('revisi');
        $naikversi = $pdf + 1;
        
        $project = project_pdf::where('id_project_pdf',$id_project_pdf)->first();
        $project->status_project='revisi';
        $project->status_terima='proses';
        $project->status_terima2='proses';
        $project->save();

        $datapdf = coba::where('pdf_id',$id_project_pdf)->where('revisi',$revisi)->where('turunan',$turunan)->first();
        $datapdf->status_pdf='inactive';
        $datapdf->save();

            $clf=coba::where('pdf_id',$id_project_pdf)->where('revisi',$revisi)->where('turunan',$turunan)->count();
            if($clf>0){
                $isipdf=coba::where('pdf_id',$id_project_pdf)->where('revisi',$revisi)->where('turunan',$turunan)->get();
                foreach ($isipdf as $pdfp)
                {
                $coba= new coba;
                $coba ->pdf_id=$pdfp->pdf_id;
                $coba ->primer=$pdfp->primer;
                $coba ->primery=$pdfp->primery;
                $coba ->secondery=$pdfp->secondery;
                $coba ->Tertiary=$pdfp->Tertiary;
                $coba ->dariusia=$pdfp->dariusia;
                $coba ->sampaiusia=$pdfp->sampaiusia;
                $coba ->gender=$pdfp->gender;
                $coba ->other=$pdfp->other;
                $coba ->kemas_eksis=$pdfp->kemas_eksis;
                $coba ->wight=$pdfp->wight;
                $coba ->serving=$pdfp->serving;
                $coba ->target_price=$pdfp->target_price;
                $coba->claim=$pdfp->claim;
                $coba->ingredient=$pdfp->ingredient;
                $coba->background=$pdfp->background;
                $coba->attractiveness=$pdfp->attractiveness;
                $coba->rto=$pdfp->rto;
                $coba->status_data='revisi';
                $coba->status_pdf='active';
                $coba->name=$pdfp->name;
                $coba->retailer_price=$pdfp->retailer_price;
                $coba->special=$pdfp->special;
                $coba->turunan=$pdfp->turunan;
                $coba->revisi=$naikversi;
                $coba->save();
                }
            }
            
            $datases=data_ses::where('id_pdf',$id_project_pdf)->where('revisi',$revisi)->where('turunan',$turunan)->count();
            if($datases>0){
                $isises=data_ses::where('id_pdf',$id_project_pdf)->where('revisi',$revisi)->where('turunan',$turunan)->get();
                foreach ($isises as $isises)
                {
                    $data1= new data_ses;
                    $data1->id_pdf=$isises->id_pdf;
                    $data1->revisi=$naikversi;
                    $data1->turunan=$isises->turunan;
                    $data1->ses=$isises->ses;
                    $data1->save();
                }
            }

            $datafor=data_forecast::where('id_pdf',$id_project_pdf)->where('revisi',$revisi)->where('turunan',$turunan)->count();
            if($datafor>0){
                $isifor=data_forecast::where('id_pdf',$id_project_pdf)->where('revisi',$revisi)->where('turunan',$turunan)->get();
                foreach ($isifor as $isifor)
                {
                    $for= new data_forecast;
                    $for->id_pdf=$isifor->id_pdf;
                    $for->revisi=$naikversi;
                    $for->turunan=$isifor->turunan;
                    $for->forecast=$isifor->forecast;
                    $for->satuan=$isifor->satuan;
                    $for->save();
                }
            }

            $dataklaim=data_klaim::where('id_pdf',$id_project_pdf)->where('revisi',$revisi)->where('turunan',$turunan)->count();
            if($dataklaim>0){
                $isiklaim=data_klaim::where('id_pdf',$id_project_pdf)->where('revisi',$revisi)->where('turunan',$turunan)->get();
                foreach ($isiklaim as $isiklaim)
                {
                    $klaim= new data_klaim;
                    $klaim->id_pdf=$isiklaim->id_pdf;
                    $klaim->revisi=$naikversi;
                    $klaim->turunan=$isiklaim->turunan;
                    $klaim->id_komponen=$isiklaim->id_komponen;
                    $klaim->id_klaim=$isiklaim->id_klaim;
                    $klaim->note=$isiklaim->note;
                    $klaim->save();
                }
            }
            $detailklaim=data_detail_klaim::where('id_pdf',$id_project_pdf)->where('revisi',$revisi)->where('turunan',$turunan)->count();
            if($detailklaim>0){
                $isidetail=data_detail_klaim::where('id_pdf',$id_project_pdf)->where('revisi',$revisi)->where('turunan',$turunan)->get();
                foreach ($isidetail as $isidetail)
                {
                    $detail= new data_detail_klaim;
                    $detail->id_pdf=$isidetail->id_pdf;
                    $detail->revisi=$naikversi;
                    $detail->turunan=$isidetail->turunan;
                    $detail->id_detail=$isidetail->id_detail;
                    $detail->save();
                }
            }
        return Redirect::Route('pdf2',['pdf_id' => $id_project_pdf, 'revisi' => $naikversi, 'turunan' => $turunan]);
    }

    public function kalenderpdf($id_project_pdf)
    {
        $pengajuan = pengajuan::count();
        $notif = notification::where('status','=','active')->count();
        $pesan = notification::orderBy('updated_at','desc')->get();
        $hitungnotif = $pengajuan + $notif;
        $events = [];
        $data = project_pdf::where('id_project_pdf',$id_project_pdf)->get();
        if($data->count()){
            foreach ($data as $key => $value) {
                $events[] = Calendar::event(
                    $value->project_name,
                    true,
                    new \DateTime($value->jangka),
                    new \DateTime($value->waktu.' +1 day')
                );
            }
        }
        $calendar = Calendar::addEvents($events); 
        return view('pdf.kalenderpdf')->with([
            'pesan' => $pesan,
            'notif' =>$notif,
            'pengajuan' => $pengajuan,
            'hitungnotif' => $hitungnotif,
            'calendar' => $calendar
        ]);
    }

}