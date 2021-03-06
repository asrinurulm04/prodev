<?php

namespace App\Http\Controllers\pv;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Mail;

use App\model\pkp\FileProject;
use App\model\pkp\SKU;
use App\model\promo\Allocation;
use App\model\promo\PromoIdea;
use App\model\promo\promo;
use App\model\promo\DataPromo;
use App\model\users\User;
use App\model\users\Departement;
use App\model\master\Brand;
use App\model\manager\pengajuan;
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
        return view('promo.RequestPromo')->with([
            'brand' => $brand
        ]);
    }

    public function buatpromo($id_pkp_promo){
        $pkp    = promo::where('id_pkp_promo',$id_pkp_promo)->get();
        $promo  = DataPromo::where('id_pkp_promoo',$id_pkp_promo)->count();
        $data   = DataPromo::where('id_pkp_promoo',$id_pkp_promo)->get();
        return view('promo.datapromo')->with([
            'pkp'   => $pkp,
            'promo' => $promo,
            'data'  => $data
        ]);
    }

    public function buatpromo1($id_pkp_promo,$revisi,$turunan){
        $pkp    = promo::where('id_pkp_promo',$id_pkp_promo)->get();
        $data   = DataPromo::where('id_pkp_promoo',$id_pkp_promo)->where('revisi',$revisi)->where('turunan',$turunan)->get();
        $ide    = PromoIdea::where('id_promo',$id_pkp_promo)->where('revisi',$revisi)->where('turunan',$turunan)->get();
        $users  = user::where('status','=','active')->where('role_id','14')->get();
        return view('promo.datapromo1')->with([
            'pkp'   => $pkp,
            'ide'   => $ide,
            'users' => $users,
            'data'  => $data
        ]);
    }

    public function NewPromo(Request $request){
        $promo= new promo;
        $promo->brand        = $request->brand;
        $promo->Author       = $request->author;
        $promo->created_date = $request->create;
        $promo->country      = $request->county;
        $promo->promo_type   = $request->promo;
        $promo->project_name = $request->name;
        $promo->type         = $request->type;
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
        $promo = promo::where('status_project','!=','draf')->orderBy('updated_at','asc')->get();
        return view('promo.listpromo')->with([
            'promo' => $promo
        ]);
    }

    public function hapuspromo($id_pkp_promo){
        $promo  = promo::where('id_pkp_promo',$id_pkp_promo)->first();
        $promo->delete();

        $Dpromo = DataPromo::where('id_pkp_promoo',$id_pkp_promo)->first();
        if($Dpromo!=NULL){
            $Dpromo->delete();
        }

        return redirect::back();
    }

    public function daftarpromo($id_pkp_promo){
        $max    = DataPromo::where('id_pkp_promoo',$id_pkp_promo)->max('turunan');
        $max2   = DataPromo::where('id_pkp_promoo',$id_pkp_promo)->max('revisi');
        $pkp    = promo::where('id_pkp_promo',$id_pkp_promo)->first();
        $data   = DataPromo::where('id_pkp_promoo',$id_pkp_promo)->where('turunan',$max)->orderBy('turunan','desc')->where('revisi',$max2)->first();
        $promo  = DataPromo::where('id_pkp_promoo',$id_pkp_promo)->count();
        return view ('promo.daftarpromo')->with([
            'promo' => $promo,
            'pkp'   => $pkp,
            'data'  => $data,
        ]);
    }

    public function step4($id_pkp_promo,$revisi,$turunan){
        $allocation = Allocation::where([ ['id_pkp_promo',$id_pkp_promo],['revisi',$revisi],['turunan',$turunan]])->get();
        $hitung     = Allocation::where('id_pkp_promo',$id_pkp_promo)->count();
        $promo      = DataPromo::where([ ['id_pkp_promoo',$id_pkp_promo],['revisi',$revisi],['turunan',$turunan]])->get();
        $sku        = SKU::all();
        return view('promo.step4')->with([
            'promo'     => $promo,
            'allocation'=> $allocation,
            'hitung'    => $hitung,
            'sku'       => $sku,
        ]);
    }

    public function editdatastep4(Request $request, $id_product_allocation,$turunan){
        $allocation = Allocation::where([['id_product_allocation',$id_product_allocation],['turunan',$turunan]])->first();
        $allocation->product_sku = $request->product;
        $allocation->allocation  = $request->allocation;
        $allocation->remarks     = $request->remarks;
        $allocation->start       = $request->start;
        $allocation->end         = $request->end;
        $allocation->rto         = $request->rto;
        $allocation->save();
        return redirect::back();
    }

    public function deletedatastep4($id_pkp_promo,$turunan){
        $allocation = Allocation::where([ ['id_pkp_promo',$id_pkp_promo], ['turunan',$turunan] ])->delete();

        return redirect::back();
    }

    public function uploaddatapkp(Request $request){
        $this->validate($request, [
            'filename'  => 'required',
            'filename.*'=> 'required|file|max:3072'
        ]);
        $files = [];
        foreach ($request->file('filename') as $file) {
            if ($file->isValid()) {
                $nama           = time();
                $nama_file      = time()."_".$file->getClientOriginalName();
                $tujuan_upload  = 'data_file';
                $path           = $file->move($tujuan_upload,$nama_file);
                $form           = $request->id;
                $turunan        = $request->turunan;
                $files[] = [
                    'filename' => $nama_file,
                    'lokasi'   => $path,
                    'promo'    => $form,
                    'turunan'  => $turunan,
                ];
            }
        }
        FileProject::insert($files);
        return redirect::back()->withSuccess(sprintf('%s file uploaded successfully.', count($files)));
    }

    public function uploadpromo($id_pkp_promo,$revisi,$turunan){
        $id     = promo::where('id_pkp_promo',$id_pkp_promo)->first();
        $coba   = FileProject::where('promo',$id_pkp_promo)->where('revisi','<=',$revisi)->where('turunan','<=',$turunan)->get(); 
        $coba1  = FileProject::where('promo',$id_pkp_promo)->where('turunan','<=',$turunan)->count();
        $id_pkp = DataPromo::where([ ['id_pkp_promoo',$id_pkp_promo], ['revisi',$revisi], ['turunan',$turunan] ])->get();
        return view('promo.step5')->with([
            'id'    => $id,
            'coba1' => $coba1,
            'coba'  => $coba,
            'id_pkp'=> $id_pkp
        ]);
    }

    public function freeze(Request $request,$id_pkp_promo){
        $data= promo::where('id_pkp_promo',$id_pkp_promo)->first();
        $data->status_freeze= 'active';
        $data->freeze       = Auth::user()->id;
        $data->waktu_freeze = Carbon::now();
        $data->note_freeze  = $request->notefreeze;
        $data->save();

        return redirect::back()->with('status', 'Project '.$data->project_name.' has been disabled!');
    }

    public function ubahTM(Request $request,$id_pkp_promo){
        $data= promo::where('id_pkp_promo',$id_pkp_promo)->first();
        $data->status_project='revisi';
        $data->save();

        $pengajuan= new pengajuan;
        $pengajuan->prioritas_pengajuan = 1;
        $pengajuan->id_promo            = $request->pkp;
        $pengajuan->penerima            = '14';
        $pengajuan->alasan_pengajuan    = $request->lamafreeze;
        $pengajuan->save();

        return redirect::back();
    }

    public function InactiveFreeze($id_pkp_promo){
        $data= promo::where('id_pkp_promo',$id_pkp_promo)->first();
        $data->status_freeze='inactive';
        $data->save();

        return redirect::back();
    }

    public function UbahTimeline(Request $request,$id_pkp_promo){
        $data= promo::where('id_pkp_promo',$id_pkp_promo)->first();
        $data->status_project   = 'sent';
        $data->jangka           = $request->jangka;
        $data->waktu            = $request->waktu;
        $data->status_freeze    = 'inactive';
        $data->freeze_diaktifkan= Carbon::now();
        $data->save();

        $pengajuan_hitung = pengajuan::where('id_promo',$id_pkp_promo)->count();
        if($pengajuan_hitung!=0){
            $pengajuan = pengajuan::where('id_promo',$id_pkp_promo)->first();
            $pengajuan->delete();
        }
        return redirect::back();
    }

    public function downloadpromo($id_pkp_promo,$revisi,$turunan){
        $promoo = DataPromo::join('tr_project_promo','tr_promo.id_pkp_promoo','=','tr_project_promo.id_pkp_promo')->where([ ['id_pkp_promo',$id_pkp_promo], ['revisi',$revisi], ['turunan',$turunan]])->get();
        $app    = Allocation::where('id_pkp_promo',$id_pkp_promo)->where('revisi',$revisi)->where('turunan',$turunan)->orderBy('turunan','desc')->orderBy('revisi','desc')->get();
        $picture= FileProject::where('promo',$id_pkp_promo)->get();
        $idea   = PromoIdea::where('id_promo',$id_pkp_promo)->where('turunan',$turunan)->where('revisi',$revisi)->orderBy('turunan','desc')->orderBy('revisi','desc')->get();
        return view('promo.promodownload')->with([
            'promoo'    => $promoo,
            'app'       => $app,
            'idea'      => $idea,
            'picture'   => $picture
        ]);
    }
 
    public function lihatpromo($id_pkp_promo,$revisi,$turunan){
        $promoo     = DataPromo::join('tr_project_promo','tr_promo.id_pkp_promoo','=','tr_project_promo.id_pkp_promo')->where([ ['id_pkp_promo',$id_pkp_promo], ['revisi',$revisi], ['turunan',$turunan]])->get();
        $max        = DataPromo::where('id_pkp_promoo',$id_pkp_promo)->max('turunan');
        $promo1     = DataPromo::where('id_pkp_promoo',$id_pkp_promo)->where('turunan','<=',$turunan)->where('revisi','<=',$revisi)->orderBy('turunan','desc')->orderBy('revisi','desc')->get();
        $app        = Allocation::where('id_pkp_promo',$id_pkp_promo)->where('revisi','=',$revisi)->where('turunan','=',$turunan)->orderBy('turunan','desc')->get();
        $app2       = Allocation::where('id_pkp_promo',$id_pkp_promo)->where('revisi','<=',$revisi)->where('turunan',$max)->orderBy('turunan','desc')->orderBy('revisi','desc')->get();
        $nopromo    = DB::table('tr_project_promo')->max('promo_number')+1;
        $data       = sprintf("%03s", abs($nopromo));
        $picture    = FileProject::where('promo',$id_pkp_promo)->where('revisi','<=',$revisi)->where('turunan','<=',$turunan)->orderBy('turunan','desc')->get();
        $idea       = PromoIdea::where('id_promo',$id_pkp_promo)->where('turunan','=',$turunan)->where('revisi','=',$revisi)->orderBy('turunan','desc')->orderBy('revisi','desc')->get();
        $dept       = Departement::all();
        $allocation = Allocation::where([ ['id_pkp_promo',$id_pkp_promo], ['revisi',$revisi], ['turunan',$turunan]])->get();
        $user       = DB::table('tr_users')->join('tr_project_promo','tr_project_promo.tujuankirim','=','tr_users.departement_id')->get();
        return view('promo.lihatpromo')->with([
            'promo1'    => $promo1,
            'promoo'    => $promoo,
            'idea'      => $idea,
            'app'       => $app,
            'app2'      => $app2,
            'picture'   => $picture,
            'allocation'=> $allocation,
            'nopromo'   => $data,
            'user'      => $user,
            'dept'      => $dept
        ]);
    }

    public function edittype(Request $request, $id_pkp_promo){
        $type = promo::where('id_pkp_promo',$id_pkp_promo)->first();
        $type->type = $request->type;
        $type->save();

        return redirect::back();
    }

    public function datapromo(Request $request){
        $promo = new DataPromo;
        $promo->id_pkp_promoo    = $request->id_promo;
        $promo->application      = $request->application;
        $promo->promo_readiness  = $request->promo;
        $promo->promo_readiness2 = $request->promo1;
        $promo->perevisi         = Auth::user()->id;
        $promo->rto              = $request->rto;
        $promo->last_update      = $request->last_up;
        $promo->turunan          = '0';
        $promo->revisi           = '0';
        $promo->gambaran_proses  = $request->proses;
        $promo->save();

        $rule = array(); 
        $validator = Validator::make($request->all(), $rule);  
        if ($validator->passes()) {
            $idz = implode(',', $request->input('promo_idea'));
            $ids = explode(',', $idz);
            $ida = implode(',', $request->input('dimension'));
            $idb = explode(',', $ida);
            for ($i = 0; $i < count($ids); $i++){
                $pipeline = new PromoIdea;
                $pipeline->id_promo   = $request->id_promo;
                $pipeline->turunan    = '0';
                $pipeline->revisi     = '0';
                $pipeline->promo_idea = $ids[$i];
                $pipeline->dimension  = $idb[$i];
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
                $pkp = FileProject::where('id_pictures',$row['pic'])->update([
                    "informasi" => $row['info']
                ]);
            }
        }
        return redirect::route('rekappromo',$request->id);
    }

    public function editdatapromo2(Request $request,$id_pkp_promoo,$revisi,$turunan){
        $promo = DataPromo::where([ ['id_pkp_promoo',$id_pkp_promoo], ['revisi',$revisi], ['turunan',$turunan] ])->first();
        $promo->id_pkp_promoo    = $request->id_promo;
        $promo->application      = $request->application;
        $promo->promo_readiness  = $request->promo;
        $promo->promo_readiness2 = $request->promo2;
        $promo->rto              = $request->rto;
        $promo->perevisi         = Auth::user()->id;
        $promo->last_update      = $request->last_up;
        $promo->gambaran_proses  = $request->proses;
        $promo->save();

        $rule = array(); 
        $data = PromoIdea::where([ ['id_promo',$id_pkp_promoo], ['revisi',$revisi], ['turunan',$turunan] ])->delete();
        $validator = Validator::make($request->all(), $rule);  
        if ($validator->passes()) {
            $idz = implode(',', $request->input('promo_idea'));
            $ids = explode(',', $idz);
            $ida = implode(',', $request->input('dimension'));
            $idb = explode(',', $ida);
            for ($i = 0; $i < count($ids); $i++){
                $pipeline = new PromoIdea;
                $pipeline->id_promo     = $request->id_promo;
                $pipeline->turunan      = '0';
                $pipeline->revisi       = '0';
                $pipeline->promo_idea   = $ids[$i];
                $pipeline->dimension    = $idb[$i];
                $pipeline->save();
                $i = $i++;
            }
        }
        return redirect::route('promo4',['id_pkp_promo'=> $promo->id_pkp_promoo,'revisi' => $promo->revisi,'turunan' => $promo->turunan])->with('status', 'Data has been added up');
    }

    public function editdatapromo(Request $request,$id_pkp_promoo,$revisi,$turunan){
        $promo     = DataPromo::where('id_pkp_promoo',$id_pkp_promoo)->where('revisi',$revisi)->where('turunan',$turunan)->first();
        $naikversi = $promo->turunan + 1;

        $datapromo = DataPromo::where('id_pkp_promoo',$id_pkp_promoo)->where('revisi',$revisi)->where('turunan',$turunan)->first();
        $datapromo->status_data='inactive';
        $datapromo->save();

        $clf       = DataPromo::where('id_pkp_promoo',$id_pkp_promoo)->where('turunan',$turunan)->count();
        if($clf>0){
            $isipromo=DataPromo::where([ ['id_pkp_promoo',$id_pkp_promoo], ['revisi',$revisi], ['turunan',$turunan] ])->get();
            foreach ($isipromo as $promoo){
                $promo = new DataPromo;
                $promo->id_pkp_promoo    = $request->id_promo;
                $promo->application      = $request->application;
                $promo->promo_readiness  = $request->promo;
                $promo->promo_readiness2 = $request->promo2;
                $promo->rto              = $request->rto;
                $promo->turunan          = $naikversi;
                $promo->perevisi         = Auth::user()->id;
                $promo->last_update      = $request->last_up;
                $promo->status_data      = 'active';
                $promo->revisi           = $promoo->revisi;
                $promo->gambaran_proses  = $request->proses;
                $promo->save();
            }
        }
        $rule      = array(); 
        $validator = Validator::make($request->all(), $rule);  
        if ($validator->passes()) {
        $idz = implode(',', $request->input('promo_idea'));
        $ids = explode(',', $idz);
        $ida = implode(',', $request->input('dimension'));
        $idb = explode(',', $ida);
        for ($i = 0; $i < count($ids); $i++){
                $pipeline = new PromoIdea;
                $pipeline->id_promo   = $request->id_promo;
                $pipeline->turunan    = $naikversi;
                $pipeline->revisi     = '0';
                $pipeline->promo_idea = $ids[$i];
                $pipeline->dimension  = $idb[$i];
                $pipeline->save();
                $i = $i++;
            }
        }

        $allocation = Allocation::where('id_pkp_promo',$id_pkp_promoo)->where('revisi',$revisi)->where('turunan',$turunan)->count();
        if($allocation>0){
            $isiallocation = Allocation::where('id_pkp_promo',$id_pkp_promoo)->where('revisi',$revisi)->where('turunan',$turunan)->get();
            foreach($isiallocation as $all){
                $al= new Allocation;
                $al->id_pkp_promo = $all->id_pkp_promo;
                $al->product_sku  = $all->product_sku;
                $al->allocation   = $all->allocation;
                $al->remarks      = $all->remarks;
                $al->start        = $all->start;
                $al->end          = $all->end;
                $al->turunan      = $naikversi;
                $al->revisi       = $all->revisi;
                $al->rto          = $all->rto;
                $al->opsi         = $all->opsi;
                $al->save();
            }
        }
        return redirect::route('promo4',['id_pkp_promo'=> $promo->id_pkp_promoo,'revisi' => $promo->revisi,'turunan' => $promo->turunan])->with('status', 'Revised Data ');
    }

    function postSave( Request $request){
        $rules = array(); 
        $validator = Validator::make($request->all(), $rules);  
        if ($validator->passes()) {
            $idz   = implode(",", $request->input('sku'));
            $ids   = explode(",", $idz);
            $tgz   = implode(",", $request->input('pcs'));
            $tgs   = explode(",", $tgz);
            $tga   = implode(",", $request->input('remarks'));
            $tgb   = explode(",", $tga);
            $sta   = implode(",", $request->input('start'));
            $stb   = explode(",", $sta);
            $enda  = implode(",", $request->input('end'));
            $endb  = explode(",", $enda);
            $rto   = implode(",", $request->input('rto'));
            $rtoo  = explode(",", $rto);
            $opsi  = implode(",", $request->input('opsi'));
            $opsi1 = explode(",", $opsi);
            for ($i = 0; $i < count($ids); $i++){
                $pipeline = new Allocation;
                $pipeline->id_pkp_promo = $request->promo;
                $pipeline->turunan      = $request->turunan;
                $pipeline->revisi       = $request->revisi;
                $pipeline->opsi         = $opsi1[$i];
                $pipeline->product_sku  = $ids[$i];
                $pipeline->allocation   = $tgs[$i];
                $pipeline->remarks      = $tgb[$i];
                $pipeline->start        = $stb[$i];
                $pipeline->end          = $endb[$i];
                $pipeline->rto          = $rtoo[$i];
                $pipeline->save();
                $i = $i++;
            }
        return redirect::Route('uploadpkppromo',['id_pkp_promo'=> $pipeline->id_pkp_promo,'revisi' => $pipeline->revisi,'turunan' => $pipeline->turunan]);
        }
    }
}