<?php

namespace App\Http\Controllers\pv;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Mail;

use App\model\master\tb_teams_brand;
use App\model\master\Brand;
use App\model\master\Tarkon;
use App\model\kemas\datakemas;
use App\model\devnf\hasilpanel;
use App\model\pkp\pkp_type;
use App\model\pkp\pkp_project;
use App\model\pkp\project_pdf;
use App\model\pkp\pkp_uniq_idea;
use App\model\pkp\uom;
use App\model\pkp\data_ses;
use App\model\pkp\pkp_datapangan;
use App\model\pkp\ses;
use App\model\pkp\project_launching;
use App\model\pkp\pkp_estimasi_market;
use App\model\pkp\jenismenu;
use App\model\dev\Formula;
use App\model\pkp\promo;
use App\model\pkp\klaim;
use App\model\pkp\detail_klaim;
use App\model\pkp\komponen;
use App\model\pkp\data_klaim;
use App\model\pkp\data_detail_klaim;
use App\model\pkp\tipp;
use App\model\pkp\picture;
use App\model\pkp\data_forecast;
use App\model\manager\pengajuan;
use App\model\users\Departement;
use App\model\users\User;
use Auth;
use DB;
use Charts;
use Redirect;
use Carbon\Carbon;

class pkpController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
        $this->middleware('rule:pv_global' || 'rule:pv_lokal' || 'rule:NR' || 'rule:marketing' || 'rule:manager' || 'rule:admin');
    }

    public function datapkp(Request $request){
        $pkp = new pkp_project;
        $pkp->id_brand=$request->brand;
        $pkp->author=$request->author;
        $pkp->created_date=$request->last;
        $pkp->project_name=$request->name;
        $pkp->type=$request->type;
        $pkp->jenis=$request->jenis;
        $pkp->save();

        return Redirect()->Route('rekappkp',$pkp->id_project);
    }

    public function formpkp(){
        $type = pkp_type::all();
        $brand = brand::all();
        $menu = jenismenu::all();
        $pkp= pkp_project::count();
        $idea = pkp_uniq_idea::all();
        $pkp1 = pkp_project::where('status_project','!=','draf')->get();
        $market = pkp_estimasi_market::all();
        return view('pkp.requestPKP')->with([
            'type' => $type,
            'market' => $market,
            'idea' => $idea,
            'brand' => $brand,
            'pkp1' => $pkp1,
            'pkp' => $pkp,
            'menu' => $menu
        ]);
    }

    public function drafpkp(){
        $pkp = pkp_project::where('status_project','draf')->orderBy('created_at','desc')->get();
        return view('pkp.drafpkp')->with([
            'pkp' => $pkp
        ]);
    }

    public function hapuspkp($id_project){
        $pkp= pkp_project::where('id_project',$id_project)->first();
        $pkp->delete();

        $Dpkp= tipp::where('id_pkp',$id_project)->first();
        if($Dpkp!=NULL){
            $Dpkp->delete();
        }
        return redirect::back();
    }

    public function lihatpkp($id_project,$revisi,$turunan){
        $nopkp = DB::table('pkp_project')->max('pkp_number')+1;
        $data =sprintf("%03s", abs($nopkp));
        $id_pkp = tipp::where([ ['id_pkp',$id_project], ['revisi',$revisi], ['turunan',$turunan] ])->first();
        $for = data_forecast::where('id_pkp',$id_project)->where('revisi',$revisi)->where('turunan',$turunan)->get();
        $pkpp = tipp::join('pkp_project','tippu.id_pkp','=','pkp_project.id_project')->where([ ['id_pkp',$id_project], ['revisi',$revisi], ['turunan',$turunan] ])->get();
        $ses= data_ses::where([ ['id_pkp',$id_project], ['revisi','<=',$revisi], ['turunan','<=',$turunan] ])->orderBy('revisi','desc')->orderBy('turunan','desc')->get();
        $max = tipp::where('id_pkp',$id_project)->max('turunan');
        $pkp2 = tipp::where('id_pkp',$id_project)->where('revisi','<=',$revisi)->where('turunan',$max)->orderBy('turunan','desc')->orderBy('revisi','desc')->get();
        $pkp1 = tipp::where('id_pkp',$id_project)->where('revisi','<=',$revisi)->where('turunan','<=',$turunan)->orderBy('turunan','desc')->orderBy('revisi','desc')->get();
        $dataklaim = data_klaim::where('id_pkp',$id_project)->join('klaim','klaim.id','=','id_klaim')->where('revisi',$revisi)->where('turunan',$turunan)->get();
        $datadetail = data_detail_klaim::where('id_pkp',$id_project)->where('revisi',$revisi)->where('turunan',$turunan)->get();
        $picture = picture::where('pkp_id',$id_project)->where('revisi','<=',$revisi)->where('turunan','<=',$turunan)->get();
        $dept = Departement::all();
        return view('pkp.lihatpkp')->with([
            'pkpp' => $pkpp,
            'datases' => $ses,
            'for' => $for,
            'datadetail' => $datadetail,
            'dataklaim' => $dataklaim,
            'pkp2' => $pkp2,
            'pkp1' => $pkp1,
            'nopkp' => $data,
            'picture' => $picture,
            'dept' => $dept
        ]); 
    }

    public function downloadpkp($id_project,$revisi,$turunan){
        $pkpp = tipp::join('pkp_project','tippu.id_pkp','=','pkp_project.id_project')->where([ ['id_project',$id_project], ['revisi',$revisi], ['turunan',$turunan] ])->get();
        $picture = picture::where('pkp_id',$id_project)->get();
        $id_pkp = tipp::where([ ['id_pkp',$id_project], ['revisi',$revisi], ['turunan',$turunan] ])->first();
        $for = data_forecast::where('id_pkp',$id_project)->where('revisi',$revisi)->where('turunan',$turunan)->get();
        $max = tipp::where('id_pkp',$id_project)->max('turunan');
        $max2 = tipp::where('id_pkp',$id_project)->max('revisi');
        $pkp1 = tipp::where('id_pkp',$id_project)->where('revisi',$max2)->where('turunan',$turunan)->get();
        $dataklaim = data_klaim::where('id_pkp',$id_project)->join('klaim','klaim.id','=','id_klaim')->where('revisi',$revisi)->where('turunan',$turunan)->get();
        $ses= data_ses::where([ ['id_pkp',$id_project], ['revisi',$revisi], ['turunan',$turunan] ])->get();
        $datadetail = data_detail_klaim::where('id_pkp',$id_project)->where('turunan',$turunan)->get();
        return view('pkp.downloadpkp')->with([
            'pkpp' => $pkpp,
            'datadetail' => $datadetail,
            'pkp1' => $pkp1,
            'dataklaim' => $dataklaim,
            'datases' => $ses,
            'for' => $for,
            'picture' => $picture
        ]); 
    }

    public function freeze(Request $request,$id_project){
        $data = pkp_project::where('id_project',$id_project)->first();
        $data->status_freeze='active';
        $data->freeze=Auth::user()->id;
        $data->waktu_freeze=Carbon::now();
        $data->note_freeze=$request->notefreeze;
        $data->save();

        return redirect::back()->with('status', 'Project '.$data->project_name.' has been disabled!');
    }

    public function ubahTMpkp(Request $request,$id_project){
        $data= pkp_project::where('id_project',$id_project)->first();
        $data->status_project='revisi';
        $data->save();

        $pengajuan= new pengajuan;
        $pengajuan->prioritas_pengajuan=1;
        $pengajuan->id_pkp=$request->pkp;
        $pengajuan->penerima='14';
        $pengajuan->alasan_pengajuan=$request->lamafreeze;
        $pengajuan->save();

        return redirect::back();
    }

    public function activepkp($id_project){
        $data= pkp_project::where('id_project',$id_project)->first();
        $data->status_freeze='inactive';
        $data->save();

        return redirect::back();
    }

    public function TMubah(Request $request,$id_project){
        $data= pkp_project::where('id_project',$id_project)->first();
        $data->jangka=$request->jangka;
        $data->waktu=$request->waktu;
        $data->status_freeze='inactive';
        $data->freeze_diaktifkan=Carbon::now();
        $data->save();

        return redirect::route('listpkp');
    }

    public function listpkp(){
        $pkp = pkp_project::orderBy('waktu','asc')->get();
        return view('pkp.listpkp')->with([
            'pkp' => $pkp
        ]);
    }

    public function buatpkp($id_project,$revisi,$turunan){
        $pkpdata = tipp::where([ ['id_pkp',$id_project], ['revisi',$revisi], ['turunan',$turunan] ])->get();
        $project = tipp::where('status_pkp','!=','draf')->where('status_data','=','active') ->join('pkp_project','pkp_project.id_project','=','tippu.id_pkp')->get();
        $brand = brand::all();
        $ses = ses::all();
        $user = user::where('status','=','active')->get();
        $datases = data_ses::where([ ['id_pkp',$id_project], ['revisi',$revisi], ['turunan',$turunan]])->get();
        $uom = uom::where('note',NULL)->get();
        $uom_primer = uom::where('note','!=',NULL)->get();
        $Ddetail = data_detail_klaim::max('id')+1;
        $tarkon = Tarkon::all();
        $eksis=datakemas::count();
        $id_pkp = tipp::where([ ['id_pkp',$id_project], ['revisi',$revisi], ['turunan',$turunan] ])->first();
        $for = data_forecast::where('id_pkp',$id_project)->where('revisi',$revisi)->where('turunan',$turunan)->get();
        $for2 = data_forecast::where('id_pkp',$id_project)->where('revisi',$revisi)->where('turunan',$turunan)->count();
        $datadetail = data_detail_klaim::where('id_pkp',$id_project)->where('turunan',$turunan)->where('revisi',$revisi)->get();
        $pangan = pkp_datapangan::all();
        $idea = pkp_uniq_idea::all();
        $dataklaim = data_klaim::where('id_pkp',$id_project)->where('turunan',$turunan)->where('revisi',$revisi)->get();
        $ide = pkp_uniq_idea::all();
        $kemas = datakemas::all();
        $market = pkp_estimasi_market::all();
        $mar = pkp_estimasi_market::all();
        $detail = detail_klaim::all();
        $klaim = klaim::all();
        $komponen = komponen::all();
        return view('pkp.buatpkp')->with([
            'brand' => $brand,
            'eksis' => $eksis,
            'datadetail' => $datadetail,
            'for' => $for,
            'user' => $user,
            'uom' => $uom,
            'project' => $project,
            'for2' => $for2,
            'uom_primer' => $uom_primer,
            'datases' => $datases,
            'ses' => $ses,
            'tarkon' => $tarkon,
            'dataklaim' => $dataklaim,
            'Ddetail' => $Ddetail,
            'pangan' => $pangan,
            'idea' => $idea,
            'kemas' => $kemas,
            'ide' => $ide,
            'komponen' => $komponen,
            'klaim' => $klaim,
            'detail' => $detail,
            'mar' => $mar,
            'pkpdata' => $pkpdata,
            'market' => $market
        ]);
    }

    public function buatpkp1($id_project){
        $pkp = pkp_project::where('id_project',$id_project)->first();
        $brand = brand::all();
        $tarkon = Tarkon::all();
        $pangan = pkp_datapangan::all();
        $kemas = datakemas::get();
        $uom = uom::where('note',NULL)->get();
        $uom_primer = uom::where('note','!=',NULL)->get();
        $data_uom = uom::all();
        $ses = ses::all();
        $eksis=datakemas::count();
        $Ddetail = data_detail_klaim::max('id')+1;
        $detail = detail_klaim::all();
        $klaim = klaim::all();
        $komponen = komponen::all();
        $teams = tb_teams_brand::where('brand',$pkp->id_brand)->get();
        $id_pkp = pkp_project::find($id_project);
        $idea = pkp_uniq_idea::all();
        $project = tipp::where('status_pkp','!=','draf')->where('status_data','=','active') ->join('pkp_project','pkp_project.id_project','=','tippu.id_pkp')->get();
        $ide = pkp_uniq_idea::all();
        $market = pkp_estimasi_market::all();
        $mar = pkp_estimasi_market::all();
        return view('pkp.buatpkp1')->with([
            'brand' => $brand,
            'project' => $project,
            'komponen' => $komponen,
            'klaim' => $klaim,
            'detail' => $detail,
            'tarkon' => $tarkon,
            'pangan' => $pangan,
            'id_pkp' => $id_pkp,
            'teams' => $teams,
            'eksis' => $eksis,
            'idea' => $idea,
            'ses' => $ses,
            'Ddetail' => $Ddetail,
            'uom' => $uom,
            'data_uom' => $data_uom,
            'uom_primer' => $uom_primer,
            'kemas' => $kemas,
            'ide' => $ide,
            'mar' => $mar,
            'market' => $market
        ]);
    }

    public function konfigurasi($id_project,$revisi,$turunan){
        $konfig = tipp::where([ ['id_pkp',$id_project], ['revisi',$revisi], ['turunan',$turunan] ])->first();
        //dd($konfig->secondary);
        $konfig->kemas_eksis=null;
        if($konfig->primery!=null){
        $konfig->primery=null;}
        if($konfig->secondary!=null){
        $konfig->secondary=null;}
        if($konfig->tertiary!=null){
        $konfig->tertiary=null;}
        $konfig->save();
        return redirect::back();
    }

    public function updatetipp(Request $request,$id_project,$revisi,$turunan){
        $pkp = tipp::where('id_pkp',$id_project)->max('turunan');
        $naikversi = $pkp + 1;

        $data2= pkp_project::where('id_project',$id_project)->first();
        $data2->project_name=$request->name_project;
        $data2->id_brand=$request->brand;
        $data2->save();

        $data = tipp::where('id_pkp',$id_project)->where('revisi',$revisi)->where('turunan',$pkp)->first();
        $data->status_data='inactive';
        if($data->bpom==null){
        $data->bpom=$request->bpom;
        }if($data->kategori_bpom==null){
        $data->kategori_bpom=$request->katbpom;
        }if($data->kemas_eksis==null){
        $data->kemas_eksis=$request->eksis;
        }if($data->akg==null){
        $data->akg=$request->akg;
        }
        $data->save();

            $clf=tipp::where('id_pkp',$id_project)->where('revisi',$revisi)->where('turunan',$turunan)->count();
            if($clf>0){
                $isipkp=tipp::where('id_pkp',$id_project)->where('revisi',$revisi)->where('turunan',$turunan)->get();
                foreach ($isipkp as $pkpp)
                {
                $tip= new tipp;
                $tip->id_pkp=$pkpp->id_pkp;
                $tip->idea=$request->idea;
                $tip->gender=$request->gender;
                $tip->dariumur=$request->dariumur;
                $tip->sampaiumur=$request->sampaiumur;
                $tip->Uniqueness=$request->uniq_idea;
                $tip->reason=$request->reason;
                $tip->Estimated=$request->estimated;
                $tip->launch=$request->launch;
                $tip->kemas_eksis=$request->eksis;
                $tip->perevisi=Auth::user()->id;
                $tip->last_update=$request->last_up;
                $tip->years=$request->tahun;
                $tip->remarks_ses=$request->remarks_ses;
                $tip->remarks_forecash=$request->remarks_forecash;
                $tip->remarks_product_form=$request->remarks_product_form;
                $tip->tgl_launch=$request->tanggal;
                $tip->competitive=$request->competitive;
                $tip->selling_price=$request->Selling_price;
                $tip->competitor=$request->competitor;
                $tip->aisle=$request->aisle;
                $tip->serving_suggestion=$request->suggestion;
                $tip->price=$request->analysis;
                $tip->product_form=$request->product;
                $tip->bpom=$request->bpom;
                $tip->kategori_bpom=$request->katbpom;
                $tip->akg=$request->akg;
                if($request->primer==''){
                    $tip->kemas_eksis=$request->data_eksis;
                    }elseif($request->primer!='NULL'){
                    $tip->kemas_eksis=$request->kemas;

                        $kemas = new datakemas;
                        $kemas->nama='-';
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
                $tip->primery=$request->primary;
                $tip->status_data='active';
                $tip->secondary=$request->secondary;
                $tip->tertiary=$request->tertiary;
                $tip->olahan=$request->olahan;
                $tip->turunan=$naikversi;
                $tip->status_data='active';
                $tip->revisi=$pkpp->revisi;
                $tip->prefered_flavour=$request->prefered;
                $tip->product_benefits=$request->benefits;
                $tip->mandatory_ingredient=$request->ingredient;
                $tip->UOM=$request->uom;
                $tip->gambaran_proses=$request->proses;
                $tip->save();
                }
            }

        if($request->ses!=''){
            $rule = array(); 
            $validator = Validator::make($request->all(), $rule);  
            if ($validator->passes()) {
				$idz = implode(',', $request->input('ses'));
				$ids = explode(',', $idz);
				for ($i = 0; $i < count($ids); $i++)
				{
					$pipeline = new data_ses;
                    $pipeline->id_pkp=$id_project;
                    $pipeline->revisi=$revisi;;
                    $pipeline->turunan=$naikversi;
					$pipeline->ses = $ids[$i];
					$pipeline->save();
					$i = $i++;
				}
			}
		}
        if($request->satuan!=''){
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
                    $pipeline->id_pkp=$id_project;
                    $pipeline->revisi=$revisi;;
                    $pipeline->turunan=$naikversi;
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
					$pipeline->id_pkp=$id_project;
					$pipeline->revisi=$revisi;;
					$pipeline->turunan=$naikversi;
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
					$detail->id_pkp=$id_project;
					$detail->revisi=$revisi;;
					$detail->turunan=$naikversi;
					$detail->id_detail = $ids[$i];
					$detail->save();
					$i = $i++;

				}
			}
		}

        $isipkp = tipp::where('id_pkp',$id_project)->where('status_data','=','active')->get();
        try{
            Mail::send('pv.aktifitasinfoemail', [
                'app'=>$isipkp,
                'info' => 'Saat ini terdapat perubahan data PKP',
            ],function($message)use($request)
            {
                $tujuan = array(); 
                $validator = Validator::make($request->all(), $tujuan);  
                if ($validator->passes()) {
                $email = implode(',', $request->input('emailtujuan'));
                $data = explode(',', $email);
                for ($i = 0; $i < count($data); $i++)
                {
                    $message->subject('PRODEV | PKP');
                    $message->to($request->pengirim1);
                    $message->cc($data[$i]);
                }
            }
            });
        }
        catch (Exception $e){
        return response (['status' => false,'errors' => $e->getMessage()]);
        }

        return redirect()->Route('datatambahanpkp',['id_project' => $id_project, 'revisi' => $tip->revisi, 'turunan' => $tip->turunan])->with('status', 'Revised data ');
    }

    public function updatetipp2(Request $request,$id_pkp,$revisi,$turunan){
        $eksis = datakemas::count();

        $data2= pkp_project::where('id_project',$id_pkp)->first();
        $data2->project_name=$request->name_project;
        $data2->id_brand=$request->brand;
        $data2->save();

        $tip = tipp::where('id_pkp',$id_pkp)->where('revisi',$revisi)->where('turunan',$turunan)->first();
        $tip->idea=$request->idea;
        $tip->gender=$request->gender;
        $tip->dariumur=$request->dariumur;
        $tip->sampaiumur=$request->sampaiumur;
        $tip->Uniqueness=$request->uniq_idea;
        $tip->reason=$request->reason;
        $tip->remarks_ses=$request->remarks_ses;
        $tip->remarks_forecash=$request->remarks_forecash;
        $tip->remarks_product_form=$request->remarks_product_form;
        $tip->perevisi=Auth::user()->id;
        $tip->last_update=$request->last_up;
        $tip->Estimated=$request->estimated;
        $tip->launch=$request->launch;
        $tip->kemas_eksis=$request->eksis;
        $tip->years=$request->tahun;
        $tip->revisi=$request->revisi;
        $tip->serving_suggestion=$request->suggestion;
        $tip->tgl_launch=$request->tanggal;
        $tip->competitive=$request->competitive;
        $tip->selling_price=$request->Selling_price;
        $tip->competitor=$request->competitor;
        $tip->aisle=$request->aisle;
        $tip->price=$request->analysis;
        $tip->product_form=$request->product;
        $tip->bpom=$request->bpom;
        $tip->kategori_bpom=$request->katbpom;
        $tip->akg=$request->akg;
        if($request->primer==''){
            $tip->kemas_eksis=$request->data_eksis;
            }elseif($request->primer!='NULL'){
            $tip->kemas_eksis=$request->kemas;

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
        $tip->primery=$request->primary;
        $tip->status_data='active';
        $tip->secondary=$request->secondary;
        $tip->tertiary=$request->tertiary;
        $tip->olahan=$request->olahan;
        $tip->prefered_flavour=$request->prefered;
        $tip->product_benefits=$request->benefits;
        $tip->mandatory_ingredient=$request->ingredient;
        $tip->UOM=$request->uom;
        $tip->gambaran_proses=$request->proses;
        $tip->save();

        if($request->ses!=''){
            $datases = data_ses::where('id_pkp',$id_pkp)->where('revisi',$revisi)->where('turunan',$turunan)->delete();
            $rule = array(); 
            $validator = Validator::make($request->all(), $rule);  
            if ($validator->passes()) {
                $idz = implode(',', $request->input('ses'));
                $ids = explode(',', $idz);
                for ($i = 0; $i < count($ids); $i++)
                {
                    $pipeline = new data_ses;
                    $pipeline->id_pkp=$request->id;
                    $pipeline->turunan=$turunan;
                    $pipeline->revisi=$revisi;
                    $pipeline->ses = $ids[$i];
                    $pipeline->save();
                    $i = $i++;
                }
            }
        }

        if($request->satuan!=''){
            $datasatuan = data_forecast::where('id_pkp',$id_pkp)->where('revisi',$revisi)->where('turunan',$turunan)->delete();
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
                    $pipeline->id_pkp = $request->id;
                    $pipeline->turunan = $turunan;
                    $pipeline->revisi = $revisi;
                    $pipeline->forecast = $ids[$i];
                    $pipeline->satuan = $idb[$i];
                    $pipeline->save();
                    $i = $i++;
                }
            }
        }

        if($request->klaim!=''){
            $dataklaim = data_klaim::where('id_pkp',$id_pkp)->where('revisi',$revisi)->where('turunan',$turunan)->delete();
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
                    $pipeline->id_pkp=$request->id;
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
            $datadetail = data_detail_klaim::where('id_pkp',$id_pkp)->where('revisi',$revisi)->where('turunan',$turunan)->delete();
            $detailklaim = array(); 
            $validator = Validator::make($request->all(), $detailklaim);  
            if ($validator->passes()) {
                $idz = implode(',', $request->input('detail'));
                $ids = explode(',', $idz);
                for ($i = 0; $i < count($ids); $i++)
                {
                    $detail = new data_detail_klaim;
                    $detail->id_pkp=$request->id;
                    $detail->turunan=$turunan;
                    $detail->revisi=$revisi;
                    $detail->id_detail = $ids[$i];
                    $detail->save();
                    $i = $i++;

                }
            }
        }

        $isipkp = tipp::where('id_pkp',$id_pkp)->where('status_data','=','active')->get();
        try{
            Mail::send('pv.aktifitasinfoemail', [
                'app'=>$isipkp,
                'info' => 'Saat ini terdapat perubahan data PKP',],function($message)use($request)
            {
                $tujuan = array(); 
                $validator = Validator::make($request->all(), $tujuan);  
                if ($validator->passes()) {
                    $email = implode(',', $request->input('emailtujuan'));
                    $data = explode(',', $email);
                    for ($i = 0; $i < count($data); $i++)
                    {
                        $message->subject('PRODEV | PKP');
                        $message->to($request->pengirim1);
                        $message->cc($data[$i]);
                    }
                }
            });
        }
        catch (Exception $e){
        return response (['status' => false,'errors' => $e->getMessage()]);
        }

        return redirect()->Route('datatambahanpkp',['id_project' => $tip->id_pkp, 'revisi' => $tip->revisi, 'turunan' => $tip->turunan])->with('status', 'Revised data ');
    }

    public function tipp(Request $request){
        $data = tipp::where('id_pkp',$request->id)->count();
        if($data>=1){
            $pp = 'data1';
            // dd($pp);
            $turunan = tipp::where('id_pkp',$request->id)->max('turunan');
            $revisi = tipp::where('id_pkp',$request->id)->max('revisi');

            return redirect()->route('datatambahanpkp',['id_pkp' => $request->id,'revisi' => $revisi, 'turunan' => $turunan])->with('status', 'Data has been added up ');
        }
        elseif($data==0){
            $pp = 'data0';
            // dd($pp);
            $tip = new tipp;
            $tip->id_pkp=$request->id;
            $tip->idea=$request->idea;
            $tip->gender=$request->gender;
            $tip->dariumur=$request->dariumur;
            $tip->sampaiumur=$request->sampaiumur;
            $tip->Uniqueness=$request->uniq_idea;
            $tip->reason=$request->reason;
            $tip->perevisi=Auth::user()->id;
            $tip->last_update=$request->last_up;
            $tip->Estimated=$request->estimated;
            $tip->launch=$request->launch;
            $tip->years=$request->tahun;
            $tip->serving_suggestion=$request->suggestion;
            $tip->tgl_launch=$request->tanggal;
            $tip->remarks_ses=$request->remarks_ses;
            $tip->remarks_forecash=$request->remarks_forecash;
            $tip->remarks_product_form=$request->remarks_product_form;
            $tip->competitive=$request->Competitive;
            $tip->UOM=$request->uom;
            $tip->revisi='0';
            $tip->selling_price=$request->Selling_price;
            $tip->competitor=$request->competitor;
            $tip->aisle=$request->aisle;
            $tip->price=$request->consumer_price;
                if($request->primer==''){
                    $tip->kemas_eksis=$request->data_eksis;
                }elseif($request->primer!='NULL'){
                $tip->kemas_eksis=$request->kemas;

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
            $tip->product_form=$request->product;
            $tip->bpom=$request->bpom;
            $tip->kategori_bpom=$request->katbpom;
            $tip->akg=$request->akg;
            $tip->olahan=$request->olahan;
            $tip->turunan='0';
            $tip->primery=$request->primary;
            $tip->secondary=$request->secondary;
            $tip->tertiary=$request->tertiary;
            $tip->prefered_flavour=$request->prefered;
            $tip->product_benefits=$request->benefits;
            $tip->mandatory_ingredient=$request->ingredient;
            $tip->gambaran_proses=$request->proses;
            $tip->save();
        
            if($request->ses!=''){
                $rule = array(); 
                $validator = Validator::make($request->all(), $rule);  
                if ($validator->passes()) {
                    $idz = implode(',', $request->input('ses'));
                    $ids = explode(',', $idz);
                    for ($i = 0; $i < count($ids); $i++)
                    {
                        $pipeline = new data_ses;
                        $pipeline->id_pkp=$request->id;
                        $pipeline->turunan='0';
                        $pipeline->ses = $ids[$i];
                        $pipeline->save();
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
                        $pipeline->id_pkp=$request->id;
                        $pipeline->turunan='0';
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
                        $pipeline->id_pkp=$request->id;
                        $pipeline->turunan='0';
                        $pipeline->id_klaim = $ids[$i];
                        $pipeline->id_komponen = $idb[$i];
                        $pipeline->note= $data[$i];
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
                        $detail->id_pkp=$request->id;
                        $detail->id_klaim=$request->iddetail;
                        $detail->turunan='0';
                        $detail->id_detail = $ids[$i];
                        $detail->save();
                        $i = $i++;
                    }
                }
            }

            $isipkp = tipp::where('id_pkp',$request->id)->where('status_data','=','active')->get();
            try{
                Mail::send('pv.aktifitasinfoemail', [
                    'app'=>$isipkp,
                    'info' => 'Terdapat Data PKP Baru',
                ],function($message)use($request)
                {
                    $tujuan = array(); 
                    $validator = Validator::make($request->all(), $tujuan);  
                    if ($validator->passes()) {
                    $email = implode(',', $request->input('emailtujuan'));
                    $data = explode(',', $email);
                    for ($i = 0; $i < count($data); $i++)
                    {
                        $message->subject('PRODEV | PKP');
                        $message->to($request->pengirim1);
                        $message->cc($data[$i]);
                    }
                }
                });
            }
            catch (Exception $e){
            return response (['status' => false,'errors' => $e->getMessage()]);
            }

            return redirect()->Route('datatambahanpkp',['id_pkp' => $tip->id_pkp,'revisi' => $tip->revisi, 'turunan' => $tip->turunan])->with('status', 'Data has been added up ');
        }
        
    }

    public function closeproject(Request $request,$id){
        $this->validate($request, [
            'filename' => 'required',
            'filename.*' => 'required|file|max:5120'
        ]);

        $pkp = pkp_project::where('id_project',$id)->first();
        $pkp->status_project='close';
        $pkp->save();

        $pkp1 = tipp::where('id_pkp',$id)->where('status_data','=','active')->first();
        $pkp1->status_pkp='close';
        $pkp1->save();
        
        $files = [];
        foreach ($request->file('filename') as $file) {
        if ($file->isValid()) {
            $nama = time();
            $nama_file = time()."_".$file->getClientOriginalName();
            $tujuan_upload = 'data_file';
            $path = $file->move($tujuan_upload,$nama_file);
            $turunan =$request->turunan;
            $form=$request->id;
            $files[] = [
                'id_pkp' => $form,
                'tanggal' => $request->date,
                'nama_produk' => $request->product,
                'formula_baku' => $request->baku,
                'formula_kemas' => $request->kemas,
                'price_list' => $request->price,
                'forecast' => $request->forecast,
                'rto' => $request->rto,
                'note' => $request->note, 
                'barcode' => $nama_file,
            ];
            }
        }
        project_launching::insert($files);

        $emaillaunch = pkp_project::where('id_project',$id)->get();
        try{
            Mail::send('launching', [
                'launch'=>$emaillaunch,],function($message)use($request,$id){
                $message->subject('Konfirmasi Launching');

                $data = $request->penerima1;
                $data2 = $request->penerima2;
                $data3 = $request->penerima3;
                $data4 = $request->penerima4;
                $author = $request->author;
                $perevisi = $request->perevisi;
                $project = pkp_project::where('id_project',$id)->get();
                foreach($project as $pro){
                    if($pro->tujuankirim2!=null){
                        if($pro->userpenerima2!=null && $pro->userpenerima!=null){
                            $to = [$data,$data2,$data3,$data4];
                            $cc = [$author,$perevisi];
                            $message->to($to);
                            $message->cc($data);
                        }elseif($pro->userpenerima==null){
                            $to = [$data,$data2,$data4];
                            $cc = [$author,$perevisi];
                            $message->to($to);
                            $message->cc($data);
                        }elseif($pro->userpenerima2==null){
                            $to = [$data,$data2,$data3];
                            $cc = [$author,$perevisi];
                            $message->to($to);
                            $message->cc($data);
                        }
                    }else{
                        if($pro->userpenerima!=null){
                            $to = [$data,$data3];
                            $cc = [$author,$perevisi];
                            $message->to($to);
                            $message->cc($data);
                        }else{
                            $to = $data;
                            $cc = [$author,$perevisi];
                            $message->to($to);
                            $message->cc($data);
                        }
                    }
                }
            });
            return back()->with('status','Berhasil Kirim Email');
        }
        catch (Exception $e){
        return response (['status' => false,'errors' => $e->getMessage()]);
        }
        return redirect()->back()->with('status', 'Project '.$pkp->project_name.' successfully closed');
    }

    public function infogambar(Request $request){
        $info = $request->input('informasi');
        foreach($info as $row){
            foreach($info as $row){
                $pkp = picture::where('id_pictures',$row['pic'])->update([
                    "informasi" => $row['info']
                ]);
            }
        }
        return redirect::route('rekappkp',$request->pkp);
    }

    public function uploadpkp($id_project,$revisi,$turunan){
        $pkp= pkp_project::where('id_project',$id_project)->get();
        $coba1 = picture::where('pkp_id',$id_project)->where('turunan','<=',$turunan)->count();
        $coba = picture::where('pkp_id',$id_project)->where('turunan','<=',$turunan)->get();
        $id_pkp= pkp_project::find($id_project);
        $turunan= tipp::where([ ['id_pkp',$id_project], ['turunan',$turunan] ])->get();
        return view('pkp.datatambahanpkp')->with([
            'pkp' => $pkp,
            'coba' => $coba,
            'coba1' => $coba1,
            'turunan' => $turunan,
            'id_pkp' => $id_pkp
        ]);
    }

    public function uploaddatapkp(Request $request){
        $this->validate($request, [
            'filename' => 'required',
            'filename.*' => 'required|file|max:51200'
       ]);
        $files = [];
        foreach ($request->file('filename') as $file) {
        if ($file->isValid()) {
            $nama = time();
            $nama_file = time()."_".$file->getClientOriginalName();
            $tujuan_upload = 'data_file';
            $path = $file->move($tujuan_upload,$nama_file);
            $turunan =$request->turunan;
            $form=$request->id;
            $files[] = [
                'filename' => $nama_file,
                'lokasi' => $path,
                'pkp_id' => $form,
                'turunan' => $turunan,
            ];
            }
        }
        picture::insert($files);
        return redirect()->back()->withSuccess(sprintf('%s file uploaded successfully.', count($files)));
    }
 
    public function destroydata($id_pictures){
        $data = picture::find($id_pictures);
        $data->delete();
        return redirect::back()->with('status', 'Workbook ');
    }

    public function edit(Request $request, $id_project){
        $turunan = tipp::where('id_pkp',$id_project)->max('turunan');
        $revisi =tipp::where('id_pkp',$id_project)->max('revisi');
        $pkp = tipp::where('id_pkp',$id_project)->where('status_data','active')->first();

        $data = pkp_project::where('id_project',$id_project)->first();
        $data->prioritas=$request->prioritas;
        $data->pkp_number=$request->nopkp;
        $data->ket_no=$request->ket_no;
        $data->status_project='sent';
        $data->tujuankirim=$request->kirim;
        $data->jangka=$request->jangka;
        $data->waktu=$request->waktu;
        $data->tgl_kirim=$request->date;
        $data->tujuankirim2=$request->rka;
        $data->status='active';
        $data->save();

        $isi = tipp::where('id_pkp',$id_project)->update([
            "status_pkp" => 'sent'
        ]);

        $isipkp = tipp::where('id_pkp',$id_project)->where('status_data','=','active')->get();
        try{
            Mail::send('manager.infoemailpkp', [
                'nama'=>$request->email,
                'app'=>$isipkp,
                'info' => 'Anda Memiliki Project PKP Baru :)',
                'jangka' => $request->jangka,
                'waktu' => $request->waktu,],function($message)use($request)
                {
                    $message->subject('PKP '.$request->name);
                    //sent email to manager
                    $dept = DB::table('departements')->where('id',$request->kirim)->get();
                    foreach($dept as $dept){
                        $user = DB::table('users')->where('id',$dept->manager_id)->get();
                        foreach($user as $user){
                            $data = $user->email;
                            $cc = [Auth::user()->email,'asrinurul4238@gmail.com'];
                            $message->to($data);
                            $message->cc($cc);
                        }
                    }

                    // CC Manager
                    if($request->rka==1){
                        $dept2 = DB::table('departements')->where('id',$request->rka)->get();
                        foreach($dept2 as $dept2){
                            $user2 = DB::table('users')->where('id',$dept2->manager_id)->get();
                            foreach($user2 as $user2){
                                $data2 = [$user2->email,Auth::user()->email];
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
            }
            catch (Exception $e){
            return response (['status' => false,'errors' => $e->getMessage()]);
        }
        return redirect::Route('listpkp');
    }

    public function sentpkp(Request $request, $id_project,$revisi,$turunan){
        $turunan = tipp::where('id_pkp',$id_project)->max('turunan');
        $revisi =tipp::where('id_pkp',$id_project)->max('revisi');
        $pkp = tipp::where('id_pkp',$id_project)->where('status_data','active')->first();

        $data = pkp_project::where('id_project',$id_project)->first();
        $data->prioritas=$request->prioritas;
        $data->pkp_number=$request->nopkp;
        $data->ket_no=$request->ket_no;
        $data->status_project='sent';
        $data->tujuankirim=$request->kirim;
        $data->jangka=$request->jangka;
        $data->waktu=$request->waktu;
        $data->tgl_kirim=$request->date;
        $data->tujuankirim2=$request->rka;
        $data->status='active';
        $data->save();
        
        $isi = tipp::where([ ['id_pkp',$id_project], ['revisi',$revisi], ['turunan',$turunan] ])->first();
        $isi->status_pkp='sent';
        $isi->save();

        $pengajuan = pengajuan::where('id_pkp',$id_project)->count();
        if($pengajuan == 1){
            $pengajuan = pengajuan::where('id_pkp',$id_project)->first();
            $pengajuan->delete();
        }
        
        $isipkp = tipp::where('id_pkp',$id_project)->where('status_data','=','active')->get();
        try{
            Mail::send('manager.infoemailpkp', [
                'nama'=>$request->email,
                'app'=>$isipkp,
                'info' => 'Project Telah Selesai Di Revisi , dengan alasan revisi "'.$request->alasan.'"',
                'jangka' => $request->jangka,
                'waktu' => $request->waktu,],function($message)use($request){
                    $message->subject('PKP '.$request->name);
                    //sent email to manager
                    $dept = DB::table('departements')->where('id',$request->kirim)->get();
                    foreach($dept as $dept){
                        $user = DB::table('users')->where('id',$dept->manager_id)->get();
                        foreach($user as $user){
                            $data = $user->email;
                            $penerima1 = $request->userpenerima;
                            $penerima2 = $request->userpenerima2;
                            $emailpenerima1 = DB::table('users')->where('id',$request->userpenerima)->first();
                            $emailpenerima2 = DB::table('users')->where('id',$request->userpenerima2)->first();
                            if($penerima1==NULL && $penerima2==NULL){
                                $cc = [Auth::user()->email,'asrinurul4238@gmail.com'];
                            }if($penerima1!=NULL && $penerima2==NULL){
                                $cc = [Auth::user()->email,'asrinurul4238@gmail.com',$emailpenerima1->email];
                            }if($penerima1!=NULL && $penerima2!=NULL){
                                $cc = [Auth::user()->email,'asrinurul4238@gmail.com',$emailpenerima1->email,$emailpenerima2->email];
                            }
                            $message->to($data);
                            $message->cc($cc);
                        }
                    }

                    // CC Manager
                    if($request->rka==1){
                        $dept2 = DB::table('departements')->where('id',$request->rka)->get();
                        foreach($dept2 as $dept2){
                            $user2 = DB::table('users')->where('id',$dept2->manager_id)->get();
                            foreach($user2 as $user2){
                                $data2 = [$user2->email,Auth::user()->email];
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
            }
            catch (Exception $e){
            return response (['status' => false,'errors' => $e->getMessage()]);
        }
        return redirect::Route('listpkp');
    }

    public function edituser(Request $request, $id_project){
        $data = tipp::where('id_pkp',$id_project)->where('status_data','active')->first();
        $turunan = tipp::where('id_pkp',$id_project)->max('turunan');
        $revisi =tipp::where('id_pkp',$id_project)->max('revisi');
        
        $edit = pkp_project::where('id_project',$id_project)->first();
        $edit->userpenerima=$request->user;
        $edit->userpenerima2=$request->user2;
        $edit->status_project='proses';
        $edit->save();

        $isipkp = tipp::where('id_pkp',$id_project)->where('status_data','=','active')->get();
        try{
            Mail::send('manager.infoemailpkp', [
                'nama'=>$request->email,
                'app'=>$isipkp,
                'info' => 'Anda memiliki project PKP baru',
                'jangka' => $request->jangka,
                'waktu' => $request->waktu,
            ],function($message)use($request){
                $message->subject('PROJECT PKP');
                //sent email to User
                if(Auth::user()->departement_id!=1){
                    $user = DB::table('users')->where('id',$request->user)->get();
                    foreach($user as $user){
                        $data = $user->email;
                        $message->to($data);
                    }
                }else{
                    $user2 = DB::table('users')->where('id',$request->user2)->get();
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
        }
        catch (Exception $e){
        return response (['status' => false,'errors' => $e->getMessage()]);
        }
        return redirect::Route('listpkprka');
    }

    public function rekappkp($id_project){
        $sample_project = Formula::where('workbook_id', $id_project)->orderBy('versi','asc')->get();
        $hitung = tipp::where('id_pkp',$id_project)->count();
        $max = tipp::where('id_pkp',$id_project)->max('turunan');
        $user = user::where('status','=','active')->get();
        $max2 = tipp::where('id_pkp',$id_project)->max('revisi');
        $cf =Formula::where('workbook_id',$id_project)->count();
        $datapkp = tipp::where('id_pkp',$id_project)->where('turunan',$max)->where('revisi',$max2)->get();
        $formula = Formula::where('workbook_id',$id_project)->where('vv','!=','null')->orderBy('versi','asc')->get();
        $data = pkp_project::where('id_project',$id_project)->get();
        $data1 = tipp::where('id_project',$id_project)->join('pkp_project','tippu.id_pkp','pkp_project.id_project')->where('status_data','=','active')->get();
        $hasilpanel = hasilpanel::where('id_wb',$id_project)->count();
        return view('pkp.daftarpkp')->with([
            'sample' => $sample_project,
            'hasilpanel' => $hasilpanel,
            'user' => $user,
            'data1' => $data1,
            'formula' => $formula,
            'datapkp' => $datapkp,
            'cf' => $cf,
            'data' => $data,
            'hitung' => $hitung
        ]);
    }

    public function edittype(Request $request, $id_project){
        $type = pkp_project::where('id_project',$id_project)->first();
        $type->type=$request->type;
        $type->save();

        return redirect::back();
    }

    public function dasboardpv(){
        $hitungpkp = pkp_project::where('status_project','=','draf')->count();
        $pkp1 = pkp_project::all()->count();
        $hitungpromo = promo::where('status_project','=','draf')->count();
        $promo1 = promo::all()->count();
        $hitungpdf = project_pdf::where('status_project','=','draf')->count();
        $pdf1 = project_pdf::all()->count();
        $pengajuan = pengajuan::count();
        $revisi = pkp_project::where('status_project','=','revisi')->count();
        $proses = pkp_project::where('status_project','=','proses')->count();
        $sent= pkp_project::where('status_project','=','sent')->count();
        $close = pkp_project::where('status_project','=','close')->count();
        $pie  =	 Charts::create('bar', 'highcharts')->title('Data PKP')->elementlabel("Data PKP")->colors(['#ff0000', '#ff9000', '#1384fb', '#2afb13', '#d5fb13'])->labels(['draf', 'sent', 'revisi', 'proses', 'close'])
            ->values([$hitungpkp,$sent,$revisi,$proses,$close])->responsive(false);
        $revisipdf = project_pdf::where('status_project','=','revisi')->count();
        $prosespdf = project_pdf::where('status_project','=','proses')->count();
        $sentpdf= project_pdf::where('status_project','=','sent')->count();
        $closepdf = project_pdf::where('status_project','=','close')->count();
        $pie2  =	 Charts::create('pie', 'highcharts')->title('Data PDF')->elementlabel("Data PDF")->colors(['#ff0000', '#ff9000', '#1384fb', '#2afb13', '#d5fb13'])->labels(['draf', 'sent', 'revisi', 'proses', 'close'])
            ->values([$hitungpdf,$sentpdf,$revisipdf,$prosespdf,$closepdf])->responsive(false);
        $revisipromo = promo::where('status_project','=','revisi')->count();
        $prosespromo = promo::where('status_project','=','proses')->count();
        $sentpromo = promo::where('status_project','=','sent')->count();
        $closepromo = promo::where('status_project','=','close')->count();
        $pie3  =	 Charts::create('area', 'highcharts')->title('Data PKP Promo')->elementlabel("Data PROMO")->labels(['draf', 'sent', 'revisi', 'proses', 'close'])
			->values([$hitungpromo,$sentpromo,$revisipromo,$prosespromo,$closepromo])->responsive(false);
        return view('pv.dasboard')->with([
            'hitungpkp' => $hitungpkp,
            'pkp1' => $pkp1,
            'hitungpromo' => $hitungpromo,
            'promo1' => $promo1,
            'hitungpdf' => $hitungpdf,
            'pdf1' => $pdf1,
            'pie' => $pie,
            'pie2' => $pie2,
            'pie3' => $pie3,
            'pengajuan' => $pengajuan
        ]);
    }

    public function upversionpkp($id_project,$revisi,$turunan){
        $pkp = tipp::where('id_pkp',$id_project)->max('revisi');
        $naikversi = $pkp + 1;

        $project = pkp_project::where('id_project',$id_project)->first();
        $project->status_project='revisi';
        // $project->status_terima='proses';
        // $project->status_terima2='proses';
        $project->save();

        $data = tipp::where('id_pkp',$id_project)->where('revisi',$revisi)->where('turunan',$turunan)->first();
        $data->status_data='inactive';
        $data->status_pkp='revisi';
        $data->save();

            $clf=tipp::where('id_pkp',$id_project)->where('revisi',$revisi)->where('turunan',$turunan)->count();
            if($clf>0){
                $isipkp=tipp::where('id_pkp',$id_project)->where('revisi',$revisi)->where('turunan',$turunan)->get();
                foreach ($isipkp as $pkpp)
                {
                $tip= new tipp;
                $tip->id_pkp=$pkpp->id_pkp;
                $tip->idea=$pkpp->idea;
                $tip->gender=$pkpp->gender;
                $tip->dariumur=$pkpp->dariumur;
                $tip->sampaiumur=$pkpp->sampaiumur;
                $tip->Uniqueness=$pkpp->Uniqueness;
                $tip->reason=$pkpp->reason;
                $tip->Estimated=$pkpp->Estimated;
                $tip->remarks_ses=$pkpp->remarks_ses;
                $tip->remarks_forecash=$pkpp->remarks_forecash;
                $tip->remarks_product_form=$pkpp->remarks_product_form;
                $tip->launch=$pkpp->launch;
                $tip->serving_suggestion=$pkpp->serving_suggestion;
                $tip->years=$pkpp->years;
                $tip->olahan=$pkpp->olahan;
                $tip->revisi=$naikversi;
                $tip->turunan=$pkpp->turunan;
                $tip->tgl_launch=$pkpp->tgl_launch;
                $tip->competitive=$pkpp->competitive;
                $tip->selling_price=$pkpp->selling_price;
                $tip->competitor=$pkpp->competitor;
                $tip->aisle=$pkpp->aisle;
                $tip->product_form=$pkpp->product_form;
                $tip->bpom=$pkpp->bpom;
                $tip->status_data=$pkpp->status_data;
                $tip->kategori_bpom=$pkpp->kategori_bpom;
                $tip->akg=$pkpp->akg;
                $tip->UOM=$pkpp->UOM;
                $tip->price=$pkpp->price;
                $tip->status_pkp='revisi';
                $tip->status_data='active';
                $tip->primery=$pkpp->primery;
                $tip->secondary=$pkpp->secondary;
                $tip->tertiary=$pkpp->tertiary;
                $tip->kemas_eksis=$pkpp->kemas_eksis;
                $tip->prefered_flavour=$pkpp->prefered_flavour;
                $tip->product_benefits=$pkpp->product_benefits;
                $tip->mandatory_ingredient=$pkpp->mandatory_ingredient;
                $tip->gambaran_proses=$pkpp->gambaran_proses;
                $tip->perevisi=Auth::user()->id;
                $tip->save();
                }
            }
            $datases=data_ses::where('id_pkp',$id_project)->where('revisi',$revisi)->where('turunan',$turunan)->count();
            if($datases>0){
                $isises=data_ses::where('id_pkp',$id_project)->where('revisi',$revisi)->where('turunan',$turunan)->get();
                foreach ($isises as $isises)
                {
                    $data1= new data_ses;
                    $data1->id_pkp=$isises->id_pkp;
                    $data1->revisi=$naikversi;
                    $data1->turunan=$isises->turunan;
                    $data1->ses=$isises->ses;
                    $data1->save();
                }
            }
            $datafor=data_forecast::where('id_pkp',$id_project)->where('revisi',$revisi)->where('turunan',$turunan)->count();
            if($datafor>0){
                $isifor=data_forecast::where('id_pkp',$id_project)->where('revisi',$revisi)->where('turunan',$turunan)->get();
                foreach ($isifor as $isifor)
                {
                    $for= new data_forecast;
                    $for->id_pkp=$isifor->id_pkp;
                    $for->revisi=$naikversi;
                    $for->turunan=$isifor->turunan;
                    $for->forecast=$isifor->forecast;
                    $for->satuan=$isifor->satuan;
                    $for->save();
                }
            }
            $dataklaim=data_klaim::where('id_pkp',$id_project)->where('revisi',$revisi)->where('turunan',$turunan)->count();
            if($dataklaim>0){
                $isiklaim=data_klaim::where('id_pkp',$id_project)->where('revisi',$revisi)->where('turunan',$turunan)->get();
                foreach ($isiklaim as $isiklaim)
                {
                    $klaim= new data_klaim;
                    $klaim->id_pkp=$isiklaim->id_pkp;
                    $klaim->revisi=$naikversi;
                    $klaim->turunan=$isiklaim->turunan;
                    $klaim->id_komponen=$isiklaim->id_komponen;
                    $klaim->id_klaim=$isiklaim->id_klaim;
                    $klaim->note=$isiklaim->note;
                    $klaim->save();
                }
            }
            $detailklaim=data_detail_klaim::where('id_pkp',$id_project)->where('revisi',$revisi)->where('turunan',$turunan)->count();
            if($detailklaim>0){
                $isidetail=data_detail_klaim::where('id_pkp',$id_project)->where('revisi',$revisi)->where('turunan',$turunan)->get();
                foreach ($isidetail as $isidetail)
                {
                    $detail= new data_detail_klaim;
                    $detail->id_pkp=$isidetail->id_pkp;
                    $detail->revisi=$naikversi;
                    $detail->turunan=$isidetail->turunan;
                    $detail->id_detail=$isidetail->id_detail;
                    $detail->save();
                }
            }
        return Redirect::Route('buatpkp',['id_pkp'=>$id_project, 'revisi' => $naikversi, 'turunan' => $turunan]);
    }

    public function deletelaunch($id_project,$revisi,$turunan){
        $data= tipp::where('id_pkp',$id_project)->where('revisi',$revisi)->where('turunan',$turunan)->first();
        $data->launch=null;
        $data->years=null;
        $data->tgl_launch=null;
        $data->save();
        
        return redirect::back();
    }

    public function pengajuan(){
        $pengajuanpdf = pengajuan::where('id_pdf','!=','')->get();
        $pengajuanpkp = pengajuan::where('id_pkp','!=','')->get();
        $pengajuanpromo = pengajuan::where('id_promo','!=','')->get();
        $pengajuan = pengajuan::count();
        return view('pv.datapengajuan')->with([
            'pengajuanpdf' => $pengajuanpdf,
            'pengajuanpkp' => $pengajuanpkp,
            'pengajuan' => $pengajuan,
            'pengajuanpromo' => $pengajuanpromo
        ]);
    }
}