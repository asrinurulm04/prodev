<?php

namespace App\Http\Controllers\pv;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\pkp\pkp_type;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Mail;

use App\model\master\Brand;
use App\model\manager\pengajuan;
use App\model\pkp\product_allocation;
use App\model\pkp\pkp_uniq_idea;
use App\model\pkp\sample_project;
use App\model\pkp\promo_idea;
use App\model\pkp\pkp_estimasi_market;
use App\model\pkp\promo;
use App\model\pkp\data_promo;
use App\model\pkp\picture;
use App\model\pkp\data_sku;
use App\model\users\User;
use App\model\users\Departement;
use Auth;
use DB;
use Calendar;
use Redirect;
use Carbon\Carbon;

class promoController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
        $this->middleware('rule:pv_global' || 'rule:pv_lokal' || 'rule:marketing' || 'rule:NR' || 'rule:manager' || 'rule:CS' || 'rule:admin');
    }

    public function promo(){
        $type = pkp_type::all();
        $brand = brand::all();
        $idea = pkp_uniq_idea::all();
        $market = pkp_estimasi_market::all();
        $pengajuan = pengajuan::count();
        return view('promo.pkppromo')->with([
            'type' => $type,
            'market' => $market,
            'idea' => $idea,
            'brand' => $brand,
            'pengajuan' => $pengajuan
        ]);
    }

    public function klaim(Request $request,$id_pkp_promo){
        $promo = promo::where('id_pkp_promo',$id_pkp_promo)->first();
        $promo->author=Auth::user()->id;
        $promo->save();

        return redirect()->back();
    }

    public function buatpromo($id_pkp_promo){
        $pkp= promo::where('id_pkp_promo',$id_pkp_promo)->get();
        $promo = data_promo::where('id_pkp_promoo',$id_pkp_promo)->count();
        $data = data_promo::where('id_pkp_promoo',$id_pkp_promo)->get();
        $pengajuan = pengajuan::count();
        $user = user::where('status','=','active')->get();
        return view('promo.datapromo')->with([
            'pkp' => $pkp,
            'user' => $user,
            'pengajuan' => $pengajuan,
            'promo' => $promo,
            'data' => $data
        ]);
    }

    public function buatpromo1($id_pkp_promo,$revisi,$turunan){
        $pkp= promo::where('id_pkp_promo',$id_pkp_promo)->get();
        $promo = data_promo::where('id_pkp_promoo',$id_pkp_promo)->count();
        $data = data_promo::where('id_pkp_promoo',$id_pkp_promo)->where('revisi',$revisi)->where('turunan',$turunan)->get();
        $pengajuan = pengajuan::count();
        $idea = promo_idea::where('id_promo',$id_pkp_promo)->where('revisi',$revisi)->where('turunan',$turunan)->get();
        $user = user::where('status','=','active')->get();
        return view('promo.datapromo1')->with([
            'pkp' => $pkp,
            'idea' => $idea,
            'pengajuan' => $pengajuan,
            'user' => $user,
            'promo' => $promo,
            'data' => $data
        ]);
    }

    public function isipromo(Request $request){
        $promo= new promo;
        $promo->brand=$request->brand;
        $promo->Author=$request->author;
        $promo->created_date=$request->create;
        $promo->country=$request->county;
        $promo->promo_type=$request->promo;
        $promo->project_name=$request->name;
        $promo->type=$request->type;
        $promo->save();

        return redirect()->Route('rekappromo',$promo->id_pkp_promo);
    }

    public function drafpromo(){
        $promo = promo::all();
        $pengajuan = pengajuan::count();
        return view('promo.drafpromo')->with([
            'promo' => $promo,
            'pengajuan' => $pengajuan
        ]);
    }

    public function listpromo(){
        $promo = promo::orderBy('updated_at','asc')->get();
        $pengajuan = pengajuan::count();
        return view('promo.listpromo')->with([
            'promo' => $promo,
            'pengajuan' => $pengajuan
        ]);
    }

    public function hapuspromo($id_pkp_promo){
        $promo= promo::where('id_pkp_promo',$id_pkp_promo)->first();
        $promo->delete();

        $Dpromo= data_promo::where('id_pkp_promoo',$id_pkp_promo)->first();
        if($Dpromo!=NULL){
        $Dpromo->delete();
        }

        return redirect::back();
    }

    public function prioritas(Request $request,$id_pkp_promo){
        $pkp = promo::where('id_pkp_promo',$id_pkp_promo)->first();
        $pkp->prioritas=$request->prioritas;
        $pkp->save();

        return redirect::back();
    }

    public function daftarpromo($id_pkp_promo){
        $pengajuanpromo = promo::join('pkp_pengajuan','pkp_promo.id_pkp_promo','=','pkp_pengajuan.id_promo')->where('penerima','=','5')->count();
        $data = promo::where('id_pkp_promo',$id_pkp_promo)->get();
        $max = data_promo::where('id_pkp_promoo',$id_pkp_promo)->max('turunan');
        $max2 = data_promo::where('id_pkp_promoo',$id_pkp_promo)->max('revisi');
        $pkp = data_promo::where('id_pkp_promoo',$id_pkp_promo)->where('turunan',$max)->orderBy('turunan','desc')->where('revisi',$max2)->get();
        $promo = data_promo::where('id_pkp_promoo',$id_pkp_promo)->count();
        $pengajuan = pengajuan::count();
        $sample_project = sample_project::where('id_promo',$id_pkp_promo)->get();
        $status_sample_project = sample_project::where('id_promo',$id_pkp_promo)->where('status','=','final')->count();
        return view ('promo.daftarpromo')->with([
            'data' => $data,
            'promo' => $promo,
            'sample' => $sample_project,
            'status_sample' => $status_sample_project,
            'pengajuan' => $pengajuan,
            'pkp' => $pkp,
            'pengajuanpromo' => $pengajuanpromo
        ]);
    }

    public function step4($id_pkp_promo,$revisi,$turunan){
        $allocation = product_allocation::where([ ['id_pkp_promo',$id_pkp_promo],['revisi',$revisi],['turunan',$turunan]])->get();
        $hitung = product_allocation::where('id_pkp_promo',$id_pkp_promo)->count();
        $promo = data_promo::where([ ['id_pkp_promoo',$id_pkp_promo],['revisi',$revisi],['turunan',$turunan]])->get();
        $pengajuan = pengajuan::count();
        $sku = data_sku::all();
        $sku2 = data_sku::all();
        return view('promo.step4')->with([
            'promo' => $promo,
            'allocation' => $allocation,
            'hitung' => $hitung,
            'sku' => $sku,
            'sku2' => $sku2,
            'pengajuan' => $pengajuan
        ]);
    }

    public function editdatastep4(Request $request, $id_product_allocation,$turunan){
        $allocation = product_allocation::where([['id_product_allocation',$id_product_allocation],['turunan',$turunan]])->first();
        $allocation->product_sku = $request->product;
        $allocation->allocation = $request->allocation;
        $allocation->remarks = $request->remarks;
        $allocation->start = $request->start;
        $allocation->end = $request->end;
        $allocation->rto=$request->rto;
        $allocation->save();
        return redirect::back();
    }

    public function deletedatastep4($id_pkp_promo,$turunan){
        $allocation = product_allocation::where([ ['id_pkp_promo',$id_pkp_promo], ['turunan',$turunan] ])->first();
        $allocation->delete();

        return redirect::back();
    }

    public function uploaddatapkp(Request $request){
        $this->validate($request, [
            'filename' => 'required',
            'filename.*' => 'required|file|max:3072'
        ]);
        $files = [];
        foreach ($request->file('filename') as $file) {
            if ($file->isValid()) {
                $nama = time();
                $nama_file = time()."_".$file->getClientOriginalName();
                $tujuan_upload = 'data_file';
                $path = $file->move($tujuan_upload,$nama_file);
                $form=$request->id;
                $turunan=$request->turunan;
                $files[] = [
                    'filename' => $nama_file,
                    'lokasi' => $path,
                    'promo' => $form,
                    'turunan' => $turunan,
                ];
            }
        }
        picture::insert($files);
        return redirect::back()->withSuccess(sprintf('%s file uploaded successfully.', count($files)));
    }

    public function uploadpromo($id_pkp_promo,$revisi,$turunan){
        $pengajuanpromo = promo::join('pkp_pengajuan','pkp_promo.id_pkp_promo','=','pkp_pengajuan.id_promo')->count();
        $pkp= promo::where('id_pkp_promo',$id_pkp_promo)->get();
        $coba = picture::where('promo',$id_pkp_promo)->where('revisi','<=',$revisi)->where('turunan','<=',$turunan)->get(); 
        $coba1 = picture::where('promo',$id_pkp_promo)->where('turunan','<=',$turunan)->count();
        $id_pkp= data_promo::where([ ['id_pkp_promoo',$id_pkp_promo], ['revisi',$revisi], ['turunan',$turunan] ])->get();
        $pengajuan = pengajuan::count();
        return view('promo.step5')->with([
            'pkp' => $pkp,
            'coba1' => $coba1,
            'pengajuan' => $pengajuan,
            'pengajuanpromo' => $pengajuanpromo,
            'coba' => $coba,
            'id_pkp' => $id_pkp
        ]);
    }

    public function approve1(Request $request,$id_pkp_promo){
        $pdf = promo::where('id_pkp_promo',$id_pkp_promo)->first();
        $pdf->status_terima='terima';
        $pdf->save();

        return redirect::back();
    }

    public function approve2(Request $request,$id_pkp_promo){
        $pdf = promo::where('id_pkp_promo',$id_pkp_promo)->first();
        $pdf->status_terima2='terima';
        $pdf->save();

        return redirect::back();
    }

    public function freeze(Request $request,$id_pkp_promo){
        $data= promo::where('id_pkp_promo',$id_pkp_promo)->first();
        $data->status_freeze='active';
        $data->freeze=Auth::user()->id;
        $data->waktu_freeze=Carbon::now();
        $data->note_freeze=$request->notefreeze;
        $data->save();

        return redirect::back()->with('status', 'Project '.$data->project_name.' has been disabled!');
    }

    public function ubahTM(Request $request,$id_pkp_promo){
        $data= promo::where('id_pkp_promo',$id_pkp_promo)->first();
        $data->status_project='revisi';
        $data->save();

        $pengajuan= new pengajuan;
        $pengajuan->prioritas_pengajuan=1;
        $pengajuan->id_promo=$request->pkp;
        $pengajuan->penerima='14';
        $pengajuan->alasan_pengajuan=$request->lamafreeze;
        $pengajuan->save();

        return redirect::back();
    }

    public function active($id_pkp_promo){
        $data= promo::where('id_pkp_promo',$id_pkp_promo)->first();
        $data->status_freeze='inactive';
        $data->save();

        return redirect::back();
    }

    public function TMubah(Request $request,$id_pkp_promo){
        $data= promo::where('id_pkp_promo',$id_pkp_promo)->first();
        $data->status_project='sent';
        $data->jangka=$request->jangka;
        $data->waktu=$request->waktu;
        $data->status_freeze='inactive';
        $data->freeze_diaktifkan=Carbon::now();
        $data->save();

        $pengajuan = pengajuan::where('id_promo',$id_pkp_promo)->first();
        $pengajuan->delete();

        return redirect::back();
    }

    public function downloadpromo($id_pkp_promo,$revisi,$turunan){
        $promoo = data_promo::join('pkp_promo','isi_promo.id_pkp_promoo','=','pkp_promo.id_pkp_promo')->where([ ['id_pkp_promo',$id_pkp_promo], ['revisi',$revisi], ['turunan',$turunan]])->get();
        $promo1 = data_promo::where('id_pkp_promoo',$id_pkp_promo)->where('revisi','<=',$revisi)->where('turunan','<=',$turunan)->get();
        $app = product_allocation::where('id_pkp_promo',$id_pkp_promo)->where('revisi','<=',$revisi)->where('turunan','<=',$turunan)->orderBy('turunan','desc')->orderBy('revisi','desc')->get();
        $jumlahpromo = data_promo::where('id_pkp_promoo',$id_pkp_promo)->count();
        $promo = promo::where('id_pkp_promo',$id_pkp_promo)->get();
        $nopromo = DB::table('pkp_promo')->max('promo_number')+1;
        $picture = picture::where('promo',$id_pkp_promo)->get();
        $dept = Departement::all();
        $idea = promo_idea::where('id_promo',$id_pkp_promo)->where('turunan','<=',$turunan)->where('revisi','<=',$revisi)->orderBy('turunan','desc')->orderBy('revisi','desc')->get();
        $dept1 = Departement::all();
        $allocation = product_allocation::where([ ['id_pkp_promo',$id_pkp_promo], ['revisi',$revisi], ['turunan',$turunan]])->get();
        return view('promo.promodownload')->with([
            'promo' => $promo,
            'promo1' => $promo1,
            'promoo' => $promoo,
            'app' => $app,
            'idea' => $idea,
            'picture' => $picture,
            'allocation' => $allocation,
            'nopromo' => substr("T00".$nopromo,1,3),
            'dept' => $dept,
            'dept1' => $dept1,
            'jumlahpromo' => $jumlahpromo
        ]);
    }
 
    public function lihatpromo($id_pkp_promo,$revisi,$turunan){
        $pengajuanpromo = promo::join('pkp_pengajuan','pkp_promo.id_pkp_promo','=','pkp_pengajuan.id_promo')->count();
        $promoo = data_promo::join('pkp_promo','isi_promo.id_pkp_promoo','=','pkp_promo.id_pkp_promo')->where([ ['id_pkp_promo',$id_pkp_promo], ['revisi',$revisi], ['turunan',$turunan]])->get();
        $max = data_promo::where('id_pkp_promoo',$id_pkp_promo)->max('turunan');
        $promo1 = data_promo::where('id_pkp_promoo',$id_pkp_promo)->where('turunan','<=',$turunan)->where('revisi','<=',$revisi)->orderBy('turunan','desc')->orderBy('revisi','desc')->get();
        $promo2 = data_promo::where('id_pkp_promoo',$id_pkp_promo)->where('revisi','<=',$revisi)->where('turunan',$max)->orderBy('revisi','desc')->orderBy('turunan','desc')->get();
        $app = product_allocation::where('id_pkp_promo',$id_pkp_promo)->where('revisi','<=',$revisi)->where('turunan','<=',$turunan)->orderBy('turunan','desc')->get();
        $app2 = product_allocation::where('id_pkp_promo',$id_pkp_promo)->where('revisi','<=',$revisi)->where('turunan',$max)->orderBy('turunan','desc')->orderBy('revisi','desc')->get();
        $jumlahpromo = data_promo::where('id_pkp_promoo',$id_pkp_promo)->count();
        $promo = promo::where('id_pkp_promo',$id_pkp_promo)->get();
        $nopromo = DB::table('pkp_promo')->max('promo_number')+1;
        $picture = picture::where('promo',$id_pkp_promo)->where('revisi','<=',$revisi)->where('turunan','<=',$turunan)->orderBy('turunan','desc')->get();
        $idea = promo_idea::where('id_promo',$id_pkp_promo)->where('turunan','<=',$turunan)->where('revisi','<=',$revisi)->orderBy('turunan','desc')->orderBy('revisi','desc')->get();
        $dept = Departement::all();
        $dept1 = Departement::all();
        $pengajuan = pengajuan::count();
        $allocation = product_allocation::where([ ['id_pkp_promo',$id_pkp_promo], ['revisi',$revisi], ['turunan',$turunan]])->get();
        $user = DB::table('users')->join('pkp_promo','pkp_promo.tujuankirim','=','users.departement_id')->get();
        return view('promo.lihatpromo')->with([
            'promo' => $promo,
            'promo1' => $promo1,
            'promo2' => $promo2,
            'promoo' => $promoo,
            'idea' => $idea,
            'app' => $app,
            'app2' => $app2,
            'picture' => $picture,
            'pengajuanpromo' => $pengajuanpromo,
            'pengajuan' => $pengajuan,
            'allocation' => $allocation,
            'nopromo' => substr("T00".$nopromo,1,3),
            'user' => $user,
            'dept' => $dept,
            'dept1' => $dept1,
            'jumlahpromo' => $jumlahpromo
        ]);
    }

    public function edittype(Request $request, $id_pkp_promo){
        $type = promo::where('id_pkp_promo',$id_pkp_promo)->first();
        $type->type=$request->type;
        $type->save();

        return redirect::back();
    }

    public function datapromo(Request $request){
        $promo = new data_promo;
        $promo->id_pkp_promoo=$request->id_promo;
        $promo->application=$request->application;
        $promo->promo_readiness=$request->promo;
        $promo->promo_readiness2=$request->promo1;
        $promo->perevisi=Auth::user()->id;
        $promo->rto=$request->rto;
        $promo->last_update=$request->last_up;
        $promo->turunan='0';
        $promo->revisi='0';
        $promo->gambaran_proses=$request->proses;
        $promo->save();

        $rule = array(); 
        $validator = Validator::make($request->all(), $rule);  
        if ($validator->passes()) {
        $idz = implode(',', $request->input('promo_idea'));
        $ids = explode(',', $idz);
        $ida = implode(',', $request->input('dimension'));
        $idb = explode(',', $ida);
        for ($i = 0; $i < count($ids); $i++)
            {
                $pipeline = new promo_idea;
                $pipeline->id_promo=$request->id_promo;
                $pipeline->turunan='0';
                $pipeline->revisi='0';
                $pipeline->promo_idea = $ids[$i];
                $pipeline->dimension = $idb[$i];
                $pipeline->save();
                $i = $i++;
            }
        }

        return redirect::route('promo4',['id_pkp_promo'=> $promo->id_pkp_promoo,'revisi' => $promo->revisi,'turunan' => $promo->turunan])->with('status', 'Data has been added up');
    }

    public function infogambarpromo(Request $request){
        $info = $request->input('informasi');
        foreach($info as $row){
            foreach($info as $row){
            $pkp = picture::where('id_pictures',$row['pic'])->update([
                "informasi" => $row['info']
            ]);
        }
    }
        return redirect::route('rekappromo',$request->id);
    }

    public function editdatapromo2(Request $request,$id_pkp_promoo,$revisi,$turunan){
        $promo = data_promo::where([ ['id_pkp_promoo',$id_pkp_promoo], ['revisi',$revisi], ['turunan',$turunan] ])->first();
        $promo->id_pkp_promoo=$request->id_promo;
        $promo->application=$request->application;
        $promo->promo_readiness=$request->promo;
        $promo->promo_readiness2=$request->promo2;
        $promo->rto=$request->rto;
        $promo->perevisi=Auth::user()->id;
        $promo->last_update=$request->last_up;
        $promo->gambaran_proses=$request->proses;
        $promo->save();

        $rule = array(); 
        $data = promo_idea::where([ ['id_promo',$id_pkp_promoo], ['revisi',$revisi], ['turunan',$turunan] ])->delete();
        $validator = Validator::make($request->all(), $rule);  
        if ($validator->passes()) {
            $idz = implode(',', $request->input('promo_idea'));
            $ids = explode(',', $idz);
            $ida = implode(',', $request->input('dimension'));
            $idb = explode(',', $ida);
            for ($i = 0; $i < count($ids); $i++)
            {
                $pipeline = new promo_idea;
                $pipeline->id_promo=$request->id_promo;
                $pipeline->turunan='0';
                $pipeline->revisi='0';
                $pipeline->promo_idea = $ids[$i];
                $pipeline->dimension = $idb[$i];
                $pipeline->save();
                $i = $i++;
            }
        }

        try{
            Mail::send('pv.aktifitasemail', ['type'=>'PROMO',],function($message)use($request)
            {
                $tujuan = array(); 
                $validator = Validator::make($request->all(), $tujuan);  
                if ($validator->passes()) {
                $email = implode(',', $request->input('emailtujuan'));
                $data = explode(',', $email);
                for ($i = 0; $i < count($data); $i++)
                {
                    $message->subject('Update Data PROMO');
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

        return redirect::route('promo4',['id_pkp_promo'=> $promo->id_pkp_promoo,'revisi' => $promo->revisi,'turunan' => $promo->turunan])->with('status', 'Data has been added up');
    }

    public function approvesamplepromo($id_sample){
        $pkp = sample_project::where('id_sample',$id_sample)->first();
        $pkp->status='approve';
        $pkp->save();

        return redirect::back();
    }

    public function rejectsamplepromo(Request $request,$id_sample){
        $pkp = sample_project::where('id_sample',$id_sample)->first();
        $pkp->status='reject';
        $pkp->catatan_reject=$request->note;
        $pkp->save();

        return redirect::back();
    }

    public function finalsamplepromo($id_pkp_promo,$id_sample){ 
        $sample = promo::where('id_pkp_promo',$id_pkp_promo)->first();
        $sample->pengajuan_sample='approve';
        $sample->save();

        $pkp = sample_project::where('id_sample',$id_sample)->first();
        $pkp->status='final';
        $pkp->save();

        // kirim email final sample (pengirim, pv)
        $isipromo = data_promo::where('id_pkp_promoo',$id_pkp_promo)->where('status_data','=','active')->get();
        try{
            Mail::send('manager.infoemailpromo', [
                'info' => 'Sample project PROMO yang diajukan telah disetujui',
                'app'=>$isipromo,],function($message)use($id_pkp_promo)
            {
                $message->subject('Approved PROMO sample');
                $message->from('app.prodev@nutrifood.co.id', 'Admin PRODEV');
                
                $datapromo = promo::where('id_pkp_promo',$id_pkp_promo)->get();
                foreach($datapromo as $data){
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

    public function unfinalsamplepromo($id_pkp_promo,$id_sample){
        $sample = promo::where('id_pkp_promo',$id_pkp_promo)->first();
        $sample->pengajuan_sample='sent';
        $sample->save();

        $pkp = sample_project::where('id_sample',$id_sample)->first();
        $pkp->status='approve';
        $pkp->save();

        // kirim email unfinal sample (pengirim, pv)
        $isipromo = data_promo::where('id_pkp_promoo',$id_pkp_promo)->where('status_data','=','active')->get();
        try{
            Mail::send('manager.infoemailpromo', [
                'info' => 'Sample project PROMO yang diajukan batal disetujui',
                'app'=>$isipromo,],function($message)use($id_pkp_promo)
            {
                $message->subject('Cancellation of sample approval');
                $message->from('app.prodev@nutrifood.co.id', 'Admin PRODEV');
                
                $datapromo = promo::where('id_pkp_promo',$id_pkp_promo)->get();
                foreach($datapromo as $data){
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

    public function editdatapromo(Request $request,$id_pkp_promoo,$revisi,$turunan){
        
        $promo = promo::where('id_pkp_promo',$id_pkp_promoo)->first();
        $naikversi = $promo->turunan + 1;

        $datapromo = data_promo::where('id_pkp_promoo',$id_pkp_promoo)->where('revisi',$revisi)->where('turunan',$promo)->first();
        $datapromo->status_data='inactive';
        $datapromo->save();

        $clf=data_promo::where('id_pkp_promoo',$id_pkp_promoo)->where('turunan',$turunan)->count();
        if($clf>0){
            $isipromo=data_promo::where([ ['id_pkp_promoo',$id_pkp_promoo], ['revisi',$revisi], ['turunan',$turunan] ])->get();
            foreach ($isipromo as $promoo)
            {
                $promo = new data_promo;
                $promo->id_pkp_promoo=$request->id_promo;
                $promo->application=$request->application;
                $promo->promo_readiness=$request->promo;
                $promo->promo_readiness2=$request->promo2;
                $promo->rto=$request->rto;
                $promo->turunan=$naikversi;
                $promo->perevisi=Auth::user()->id;
                $promo->last_update=$request->last_up;
                $promo->status_data='active';
                $promo->revisi=$promoo->revisi;
                $promo->gambaran_proses=$request->proses;
                $promo->save();
            }
        }
        $rule = array(); 
        $validator = Validator::make($request->all(), $rule);  
        if ($validator->passes()) {
        $idz = implode(',', $request->input('promo_idea'));
        $ids = explode(',', $idz);
        $ida = implode(',', $request->input('dimension'));
        $idb = explode(',', $ida);
        for ($i = 0; $i < count($ids); $i++)
            {
                $pipeline = new promo_idea;
                $pipeline->id_promo=$request->id_promo;
                $pipeline->turunan=$naikversi;
                $pipeline->revisi='0';
                $pipeline->promo_idea = $ids[$i];
                $pipeline->dimension = $idb[$i];
                $pipeline->save();
                $i = $i++;
            }
        }

        $allocation = product_allocation::where('id_pkp_promo',$id_pkp_promoo)->where('revisi',$revisi)->where('turunan',$turunan)->count();
        if($allocation>0){
            $isiallocation = product_allocation::where('id_pkp_promo',$id_pkp_promoo)->where('revisi',$revisi)->where('turunan',$turunan)->get();
            foreach($isiallocation as $all)
            {
                $al= new product_allocation;
                $al->id_pkp_promo=$all->id_pkp_promo;
                $al->product_sku=$all->product_sku;
                $al->allocation=$all->allocation;
                $al->remarks=$all->remarks;
                $al->start=$all->start;
                $al->end=$all->end;
                $al->turunan=$naikversi;
                $al->revisi=$all->revisi;
                $al->rto=$all->rto;
                $al->opsi=$all->opsi;
                $al->save();
            }
        }

        try{
            Mail::send('pv.aktifitasemail', ['type'=>'PROMO',],function($message)use($request)
            {
                $tujuan = array(); 
                $validator = Validator::make($request->all(), $tujuan);  
                if ($validator->passes()) {
                $email = implode(',', $request->input('emailtujuan'));
                $data = explode(',', $email);
                for ($i = 0; $i < count($data); $i++)
                {
                    $message->subject('Update Data PROMO');
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

        return redirect::route('promo4',['id_pkp_promo'=> $promo->id_pkp_promoo,'revisi' => $promo->revisi,'turunan' => $promo->turunan])->with('status', 'Revised Data ');
    }

    function postSave( Request $request)
    {
        $rules = array(
        ); 
        
        $validator = Validator::make($request->all(), $rules);  
        if ($validator->passes()) {
        $idz = implode(",", $request->input('sku'));
        $ids = explode(",", $idz);
        $tgz = implode(",", $request->input('pcs'));
        $tgs = explode(",", $tgz);
        $tga = implode(",", $request->input('remarks'));
        $tgb = explode(",", $tga);
        $sta = implode(",", $request->input('start'));
        $stb = explode(",", $sta);
        $enda = implode(",", $request->input('end'));
        $endb = explode(",", $enda);
        $rto = implode(",", $request->input('rto'));
        $rtoo = explode(",", $rto);
        $opsi = implode(",", $request->input('opsi'));
        $opsi1 = explode(",", $opsi);
        for ($i = 0; $i < count($ids); $i++)
        {
            $pipeline = new product_allocation;
            $pipeline->id_pkp_promo=$request->promo;
            $pipeline->turunan=$request->turunan;
            $pipeline->revisi=$request->revisi;
            $pipeline->opsi=$opsi1[$i];
            $pipeline->product_sku = $ids[$i];
            $pipeline->allocation = $tgs[$i];
            $pipeline->remarks = $tgb[$i];
            $pipeline->start = $stb[$i];
            $pipeline->end = $endb[$i];
            $pipeline->rto = $rtoo[$i];
            $pipeline->save();
            $i = $i++;

        }
        return redirect::Route('uploadpkppromo',['id_pkp_promo'=> $pipeline->id_pkp_promo,'revisi' => $pipeline->revisi,'turunan' => $pipeline->turunan]);
        }
    }

    public function edit(Request $request, $id_pkp_promo,$revisi,$turunan){
        $data = promo::where('id_pkp_promo',$id_pkp_promo)->first();
        $data->tujuankirim=$request->kirim;
        $data->tujuankirim2=$request->rka;
        $data->prioritas=$request->prioritas;
        $data->promo_number=$request->nopromo;
        $data->ket_no=$request->ket_no;
        $data->status_project='sent';
        $data->tgl_kirim=$request->date;
        $data->jangka=$request->jangka;
        $data->waktu=$request->waktu;
        $data->status='active';
        $data->save();

        $promo = data_promo::where([ ['id_pkp_promoo',$id_pkp_promo], ['revisi',$revisi], ['turunan',$turunan] ])->first();
        $promo->status_promo='sent';
        $promo->save();

        $isipromo = data_promo::where('id_pkp_promoo',$id_pkp_promo)->where('status_data','=','active')->get();
        try{
            Mail::send('manager.infoemailpromo', [
                'nama'=>$request->email,
                'app'=>$isipromo,
                'jangka' => $request->jangka,
                'info' => 'Anda Memiliki Project PKP PROMO Baru :)',
                'waktu' => $request->waktu,
            ],function($message)use($request)
            {
                $message->subject('PROJECT PKP PROMO-'.$request->name);
                $message->from('app.prodev@nutrifood.co.id', 'Admin PRODEV');
                //sent email to manager
                $dept = DB::table('departements')->where('id',$request->kirim)->get();
                foreach($dept as $dept){
                    $user = DB::table('users')->where('id',$dept->manager_id)->get();
                    foreach($user as $user){
                        $data = $user->email;
                        // dd($data);
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
                            // dd($data);
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

        return redirect::Route('listpromo');
    }

    public function sentpromo(Request $request, $id_pkp_promo,$revisi,$turunan){
        $data = promo::where('id_pkp_promo',$id_pkp_promo)->first();
        $data->tujuankirim=$request->kirim;
        $data->tujuankirim2=$request->rka;
        $data->prioritas=$request->prioritas;
        $data->promo_number=$request->nopromo;
        $data->ket_no=$request->ket_no;
        $data->status_project='sent';
        $data->jangka=$request->jangka;
        $data->waktu=$request->waktu;
        $data->status='active';
        $data->save();

        $promo = data_promo::where([ ['id_pkp_promoo',$id_pkp_promo], ['revisi',$revisi], ['turunan',$turunan] ])->first();
        $promo->status_promo='sent';
        $promo->save();

        $pengajuan = pengajuan::where('id_promo',$id_pkp_promo)->first();
        $pengajuan->delete();

        return redirect::Route('listpromo');
    }

    public function edituser(Request $request, $id_pkp_promo){
        $edit = promo::where('id_pkp_promo',$id_pkp_promo)->first();
        $edit->userpenerima=$request->user;
        $edit->userpenerima2=$request->user2;
        $edit->status_project='proses';
        $edit->save();

        $isipromo = data_promo::where('id_pkp_promoo',$id_pkp_promo)->where('status_data','=','active')->get();
        try{
            Mail::send('manager.infoemailpromo', [
                'nama'=>$request->email,
                'app'=>$isipromo,
                'jangka' => $request->jangka,
                'info' => 'Anda memiliki project PKP baru',
                'waktu' => $request->waktu,
            ],function($message)use($request)
            {
                $message->subject('PROJECT PKP PROMO');
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
            return redirect::Route('listpromoo')->with('status','Data Berhasil dikirim');
        }
        catch (Exception $e){
        return response (['status' => false,'errors' => $e->getMessage()]);
        }
        return redirect::Route('listpromoo');
    }

    public function upversionpromo($id_pkp_promo,$revisi,$turunan){
        $promo = promo::where('id_pkp_promo',$id_pkp_promo)->first();
        $naikversi = $promo->revisi + 1;

        $project = promo::where('id_pkp_promo',$id_pkp_promo)->first();
        // $project->status_terima='proses';
        // $project->status_terima2='proses';
        $project->save();

        $datapromo = data_promo::where('id_pkp_promoo',$id_pkp_promo)->where('revisi',$revisi)->where('turunan',$turunan)->first();
        $datapromo->status_data='inactive';
        $datapromo->save();

        $clf=data_promo::where('id_pkp_promoo',$id_pkp_promo)->where('revisi',$revisi)->where('turunan',$turunan)->count();
        if($clf>0){
            $isipromo=data_promo::where('id_pkp_promoo',$id_pkp_promo)->where('revisi',$revisi)->where('turunan',$turunan)->get();
            foreach ($isipromo as $promoo)
            {
                $ppromo = new data_promo;
                $ppromo->id_pkp_promoo=$promoo->id_pkp_promoo;
                $ppromo->promo_idea=$promoo->promo_idea;
                $ppromo->dimension=$promoo->dimension;
                $ppromo->application=$promoo->application;
                $ppromo->promo_readiness=$promoo->promo_readiness;
                $ppromo->rto=$promoo->rto;
                $ppromo->status_promo='revisi';
                $ppromo->status_data='active';
                $ppromo->turunan=$promoo->turunan;
                $ppromo->revisi=$naikversi;
                $ppromo->gambaran_proses=$promoo->gambaran_proses;
                $ppromo->save();
            }
        }
        $allocation = product_allocation::where('id_pkp_promo',$id_pkp_promo)->where('revisi',$revisi)->where('turunan',$turunan)->count();
        if($allocation>0){
            $isiallocation = product_allocation::where('id_pkp_promo',$id_pkp_promo)->where('revisi',$revisi)->where('turunan',$turunan)->get();
            foreach($isiallocation as $all)
            {
                $al= new product_allocation;
                $al->id_pkp_promo=$all->id_pkp_promo;
                $al->product_sku=$all->product_sku;
                $al->allocation=$all->allocation;
                $al->remarks=$all->remarks;
                $al->start=$all->start;
                $al->end=$all->end;
                $al->turunan=$all->turunan;
                $al->revisi=$all->revisi+1;
                $al->rto=$all->rto;
                $al->opsi=$all->opsi;
                $al->save();
            }
        }
        return Redirect::Route('promo11',['id_pkp_promo'=> $ppromo->id_pkp_promoo,'revisi' => $naikversi,'turunan' => $ppromo->turunan]);
    }

}