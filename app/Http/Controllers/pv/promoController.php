<?php

namespace App\Http\Controllers\pv;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Mail;

use App\model\master\Brand;
use App\model\manager\pengajuan;
use App\model\pkp\product_allocation;
use App\model\pkp\pkp_uniq_idea;
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
use Redirect;
use Carbon\Carbon;

class promoController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
        $this->middleware('rule:pv_global' || 'rule:pv_lokal' || 'rule:marketing' || 'rule:NR' || 'rule:manager' || 'rule:CS' || 'rule:admin');
    }

    public function promo(){
        $brand = brand::all();
        $idea = pkp_uniq_idea::all();
        $market = pkp_estimasi_market::all();
        $pengajuan = pengajuan::count();
        return view('promo.pkppromo')->with([
            'market' => $market,
            'idea' => $idea,
            'brand' => $brand,
            'pengajuan' => $pengajuan
        ]);
    }

    public function buatpromo($id_pkp_promo){
        $pkp= promo::where('id_pkp_promo',$id_pkp_promo)->get();
        $promo = data_promo::where('id_pkp_promoo',$id_pkp_promo)->count();
        $data = data_promo::where('id_pkp_promoo',$id_pkp_promo)->get();
        return view('promo.datapromo')->with([
            'pkp' => $pkp,
            'promo' => $promo,
            'data' => $data
        ]);
    }

    public function buatpromo1($id_pkp_promo,$revisi,$turunan){
        $pkp= promo::where('id_pkp_promo',$id_pkp_promo)->get();
        $promo = data_promo::where('id_pkp_promoo',$id_pkp_promo)->count();
        $data = data_promo::where('id_pkp_promoo',$id_pkp_promo)->where('revisi',$revisi)->where('turunan',$turunan)->get();
        $ide = promo_idea::where('id_promo',$id_pkp_promo)->where('revisi',$revisi)->where('turunan',$turunan)->get();
        $users = user::where('status','=','active')->where('role_id','14')->get();
        return view('promo.datapromo1')->with([
            'pkp' => $pkp,
            'ide' => $ide,
            'users' => $users,
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
        $promo = promo::where('status_project','draf')->get();
        return view('promo.drafpromo')->with([
            'promo' => $promo
        ]);
    }

    public function listpromo(){
        $promo = promo::orderBy('updated_at','asc')->get();
        return view('promo.listpromo')->with([
            'promo' => $promo
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

    public function daftarpromo($id_pkp_promo){
        $max = data_promo::where('id_pkp_promoo',$id_pkp_promo)->max('turunan');
        $max2 = data_promo::where('id_pkp_promoo',$id_pkp_promo)->max('revisi');
        $pkp = promo::where('id_pkp_promo',$id_pkp_promo)->first();
        $data = data_promo::where('id_pkp_promoo',$id_pkp_promo)->where('turunan',$max)->orderBy('turunan','desc')->where('revisi',$max2)->first();
        $promo = data_promo::where('id_pkp_promoo',$id_pkp_promo)->count();
        return view ('promo.daftarpromo')->with([
            'promo' => $promo,
            'pkp' => $pkp,
            'data' => $data,
        ]);
    }

    public function step4($id_pkp_promo,$revisi,$turunan){
        $allocation = product_allocation::where([ ['id_pkp_promo',$id_pkp_promo],['revisi',$revisi],['turunan',$turunan]])->get();
        $hitung = product_allocation::where('id_pkp_promo',$id_pkp_promo)->count();
        $promo = data_promo::where([ ['id_pkp_promoo',$id_pkp_promo],['revisi',$revisi],['turunan',$turunan]])->get();
        $sku = data_sku::all();
        $sku2 = data_sku::all();
        return view('promo.step4')->with([
            'promo' => $promo,
            'allocation' => $allocation,
            'hitung' => $hitung,
            'sku' => $sku,
            'sku2' => $sku2
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
        $id= promo::where('id_pkp_promo',$id_pkp_promo)->get();
        $coba = picture::where('promo',$id_pkp_promo)->where('revisi','<=',$revisi)->where('turunan','<=',$turunan)->get(); 
        $coba1 = picture::where('promo',$id_pkp_promo)->where('turunan','<=',$turunan)->count();
        $id_pkp= data_promo::where([ ['id_pkp_promoo',$id_pkp_promo], ['revisi',$revisi], ['turunan',$turunan] ])->get();
        return view('promo.step5')->with([
            'id' => $id,
            'coba1' => $coba1,
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

        $pengajuan_hitung = pengajuan::where('id_promo',$id_pkp_promo)->count();
        if($pengajuan_hitung!=0){
            $pengajuan = pengajuan::where('id_promo',$id_pkp_promo)->first();
            $pengajuan->delete();
        }

        return redirect::back();
    }

    public function downloadpromo($id_pkp_promo,$revisi,$turunan){
        $promoo = data_promo::join('tr_project_promo','tr_promo.id_pkp_promoo','=','tr_project_promo.id_pkp_promo')->where([ ['id_pkp_promo',$id_pkp_promo], ['revisi',$revisi], ['turunan',$turunan]])->get();
        $app = product_allocation::where('id_pkp_promo',$id_pkp_promo)->where('revisi',$revisi)->where('turunan',$turunan)->orderBy('turunan','desc')->orderBy('revisi','desc')->get();
        $picture = picture::where('promo',$id_pkp_promo)->get();
        $idea = promo_idea::where('id_promo',$id_pkp_promo)->where('turunan',$turunan)->where('revisi',$revisi)->orderBy('turunan','desc')->orderBy('revisi','desc')->get();
        return view('promo.promodownload')->with([
            'promoo' => $promoo,
            'app' => $app,
            'idea' => $idea,
            'picture' => $picture
        ]);
    }
 
    public function lihatpromo($id_pkp_promo,$revisi,$turunan){
        $promoo = data_promo::join('tr_project_promo','tr_promo.id_pkp_promoo','=','tr_project_promo.id_pkp_promo')->where([ ['id_pkp_promo',$id_pkp_promo], ['revisi',$revisi], ['turunan',$turunan]])->get();
        $max = data_promo::where('id_pkp_promoo',$id_pkp_promo)->max('turunan');
        $promo1 = data_promo::where('id_pkp_promoo',$id_pkp_promo)->where('turunan','<=',$turunan)->where('revisi','<=',$revisi)->orderBy('turunan','desc')->orderBy('revisi','desc')->get();
        $app = product_allocation::where('id_pkp_promo',$id_pkp_promo)->where('revisi','<=',$revisi)->where('turunan','<=',$turunan)->orderBy('turunan','desc')->get();
        $app2 = product_allocation::where('id_pkp_promo',$id_pkp_promo)->where('revisi','<=',$revisi)->where('turunan',$max)->orderBy('turunan','desc')->orderBy('revisi','desc')->get();
        $promo = promo::where('id_pkp_promo',$id_pkp_promo)->get();
        $nopromo = DB::table('tr_project_promo')->max('promo_number')+1;
        $data =sprintf("%03s", abs($nopromo));
        $picture = picture::where('promo',$id_pkp_promo)->where('revisi','<=',$revisi)->where('turunan','<=',$turunan)->orderBy('turunan','desc')->get();
        $idea = promo_idea::where('id_promo',$id_pkp_promo)->where('turunan','<=',$turunan)->where('revisi','<=',$revisi)->orderBy('turunan','desc')->orderBy('revisi','desc')->get();
        $dept = Departement::all();
        $dept1 = Departement::all();
        $allocation = product_allocation::where([ ['id_pkp_promo',$id_pkp_promo], ['revisi',$revisi], ['turunan',$turunan]])->get();
        $user = DB::table('tr_users')->join('tr_project_promo','tr_project_promo.tujuankirim','=','tr_users.departement_id')->get();
        return view('promo.lihatpromo')->with([
            'promo' => $promo,
            'promo1' => $promo1,
            'promoo' => $promoo,
            'idea' => $idea,
            'app' => $app,
            'app2' => $app2,
            'picture' => $picture,
            'allocation' => $allocation,
            'nopromo' => $data,
            'user' => $user,
            'dept' => $dept,
            'dept1' => $dept1
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
            Mail::send('pv.aktifitasemail', ['type'=>'PROMO',],function($message)use($request){
                $tujuan = array(); 
                $validator = Validator::make($request->all(), $tujuan);  
                if ($validator->passes()) {
                    $email = implode(',', $request->input('emailtujuan'));
                    $data = explode(',', $email);
                    for ($i = 0; $i < count($data); $i++)
                    {
                        $message->subject('Update Data PROMO');
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

    public function editdatapromo(Request $request,$id_pkp_promoo,$revisi,$turunan){
        $promo = data_promo::where('id_pkp_promoo',$id_pkp_promoo)->where('revisi',$revisi)->where('turunan',$turunan)->first();
        $naikversi = $promo->turunan + 1;

        $datapromo = data_promo::where('id_pkp_promoo',$id_pkp_promoo)->where('revisi',$revisi)->where('turunan',$turunan)->first();
        $datapromo->status_data='inactive';
        $datapromo->save();

        $clf=data_promo::where('id_pkp_promoo',$id_pkp_promoo)->where('turunan',$turunan)->count();
        if($clf>0){
            $isipromo=data_promo::where([ ['id_pkp_promoo',$id_pkp_promoo], ['revisi',$revisi], ['turunan',$turunan] ])->get();
            foreach ($isipromo as $promoo){
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
        for ($i = 0; $i < count($ids); $i++){
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
            foreach($isiallocation as $all){
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
                    for ($i = 0; $i < count($data); $i++){
                        $message->subject('Update Data PROMO');
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

    function postSave( Request $request){
        $rules = array(); 
        
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
        for ($i = 0; $i < count($ids); $i++){
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
            ],function($message)use($request){
                $message->subject('PROJECT PKP PROMO-'.$request->name);
                //sent email to manager
                $dept = DB::table('ms_departements')->where('id',$request->kirim)->get();
                foreach($dept as $dept){
                    $user = DB::table('tr_users')->where('id',$dept->manager_id)->get();
                    foreach($user as $user){
                        $data = $user->email;
                        $message->to($data);
                    }
                }

                // CC Manager
                if($request->rka==1){
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
                    $tujuan = array(); 
                    $validator = Validator::make($request->all(), $tujuan);  
                    if ($validator->passes()) {
                        $picture = implode(',', $request->input('pic'));
                        $data = explode(',', $picture);
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

        $pengajuan_hitung = pengajuan::where('id_promo',$id_pkp_promo)->count();
        if($pengajuan_hitung!=0){
            $pengajuan = pengajuan::where('id_promo',$id_pkp_promo)->first();
            $pengajuan->delete();
        }
        
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
            ],function($message)use($request){
                $message->subject('PROJECT PKP PROMO');
                //sent email to User
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

                if($request->pic!=null){
                    $tujuan = array(); 
                    $validator = Validator::make($request->all(), $tujuan);  
                    if ($validator->passes()) {
                        $picture = implode(',', $request->input('pic'));
                        $data = explode(',', $picture);
                        for ($i = 0; $i < count($data); $i++){
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
        $promo = data_promo::where('id_pkp_promoo',$id_pkp_promo)->where('revisi',$revisi)->where('turunan',$turunan)->first();
        $naikversi = $promo->revisi + 1;

        $datapromo = data_promo::where('id_pkp_promoo',$id_pkp_promo)->where('revisi',$revisi)->where('turunan',$turunan)->first();
        $datapromo->status_data='inactive';
        $datapromo->save();

        $clf=data_promo::where('id_pkp_promoo',$id_pkp_promo)->where('revisi',$revisi)->where('turunan',$turunan)->count();
        if($clf>0){
            $isipromo=data_promo::where('id_pkp_promoo',$id_pkp_promo)->where('revisi',$revisi)->where('turunan',$turunan)->get();
            foreach ($isipromo as $promoo){
                $ppromo = new data_promo;
                $ppromo->id_pkp_promoo=$promoo->id_pkp_promoo;
                $ppromo->application=$promoo->application;
                $ppromo->promo_readiness=$promoo->promo_readiness;
                $ppromo->promo_readiness2=$promoo->promo_readiness2;
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
            foreach($isiallocation as $all){
                $al= new product_allocation;
                $al->id_pkp_promo=$all->id_pkp_promo;
                $al->product_sku=$all->product_sku;
                $al->allocation=$all->allocation;
                $al->remarks=$all->remarks;
                $al->start=$all->start;
                $al->end=$all->end;
                $al->turunan=$all->turunan;
                $al->revisi=$naikversi;
                $al->rto=$all->rto;
                $al->opsi=$all->opsi;
                $al->save();
            }
        }
        $idea = promo_idea::where('id_promo',$id_pkp_promo)->where('revisi',$revisi)->where('turunan',$turunan)->count();
        if($idea>0){
            $isiidea = promo_idea::where('id_promo',$id_pkp_promo)->where('revisi',$revisi)->where('turunan',$turunan)->get();
            foreach($isiidea as $all){
                $ide= new promo_idea;
                $ide->id_promo=$all->id_promo;
                $ide->promo_idea=$all->promo_idea;
                $ide->dimension=$all->dimension;
                $ide->turunan=$all->turunan;
                $ide->revisi=$naikversi;
                $ide->save();
            }
        }
        return Redirect::Route('datapromo11',['id_pkp_promo'=> $ppromo->id_pkp_promoo,'revisi' => $naikversi,'turunan' => $ppromo->turunan]);
    }
}