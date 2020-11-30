<?php

namespace App\Http\Controllers\pv;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\pkp\pkp_type;
use Illuminate\Support\Facades\Validator;
use App\Mail\kirimemail;
use Illuminate\Support\Facades\Mail;

use App\pkp\pkp_project;
use App\pkp\project_pdf;
use App\pkp\pkp_uniq_idea;
use App\pkp\uom;
use App\master\tb_teams_brand;
use App\pkp\data_ses;
use Carbon\Carbon;
use App\pkp\pkp_datapangan;
use App\devnf\hasilpanel;
use App\pkp\ses;
use App\pkp\project_launching;
use App\pkp\pkp_estimasi_market;
use App\master\Brand;
use App\pkp\jenismenu;
use App\dev\formula;
use App\User;
use App\master\Tarkon;
use App\pkp\sample_project;
use App\Modelfn\finance;
use App\pkp\promo;
use App\kemas\datakemas;
use App\pkp\coba;
use App\pkp\klaim;
use App\pkp\detail_klaim;
use App\pkp\komponen;
use App\pkp\data_klaim;
use App\pkp\data_detail_klaim;
use App\pkp\tipp;
use App\manager\pengajuan;
use App\pkp\picture;
use App\pkp\data_forecast;
use App\users\Departement;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Charts;
use Calendar;
use Redirect;

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
        $pengajuan = pengajuan::count();

        return view('pkp.requestPKP')->with([
            'type' => $type,
            'market' => $market,
            'idea' => $idea,
            'brand' => $brand,
            'pkp1' => $pkp1,
            'pkp' => $pkp,
            'pengajuan' => $pengajuan,
            'menu' => $menu
        ]);
    }

    public function klaim(Request $request,$id_project){
        $pkp = pkp_project::where('id_project',$id_project)->first();
        $pkp->author=Auth::user()->id;
        $pkp->save();

        return redirect()->back();
    }

    public function drafpkp(){
        $pkp1 = pkp_project::where('status_project','!=','draf')->get();
        $pkp = pkp_project::orderBy('created_at','desc')->get();
        $pengajuan = pengajuan::count();
        $jmenu = jenismenu::all();
        $hitung = pkp_project::where('status_project','=','sent')->where('status_project','=','close')->count();
        return view('pkp.drafpkp')->with([
            'pkp' => $pkp,
            'pkp1' => $pkp1,
            'pengajuan' => $pengajuan,
            'jmenu' => $jmenu,
            'hitung' => $hitung
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
        $pengajuanpkp = pkp_project::join('pkp_pengajuan','pkp_project.id_project','=','pkp_pengajuan.id_pkp')->count();
        $datapkp = tipp::where('id_pkp',$id_project)->count();
        $nopkp = DB::table('pkp_project')->max('pkp_number')+1;
        $pkp = pkp_project::where('id_project',$id_project)->get();
        $for = data_forecast::where('id_pkp',$id_project)->where('revisi',$revisi)->where('turunan',$turunan)->get();
        $pkpp = tipp::join('pkp_project','tippu.id_pkp','=','pkp_project.id_project')->where([ ['id_pkp',$id_project], ['revisi',$revisi], ['turunan',$turunan] ])->get();
        $ses= data_ses::where([ ['id_pkp',$id_project], ['revisi','<=',$revisi], ['turunan','<=',$turunan] ])->orderBy('revisi','desc')->orderBy('turunan','desc')->get();
        $max = tipp::where('id_pkp',$id_project)->max('turunan');
        $pkp2 = tipp::where('id_pkp',$id_project)->where('revisi','<=',$revisi)->where('turunan',$max)->orderBy('turunan','desc')->orderBy('revisi','desc')->get();
        $pkp1 = tipp::where('id_pkp',$id_project)->where('revisi','<=',$revisi)->where('turunan','<=',$turunan)->orderBy('turunan','desc')->orderBy('revisi','desc')->get();
        $pengajuan = pengajuan::count();
        $formula = formula::where('workbook_id',$id_project)->count();
        $dataklaim = data_klaim::where('id_pkp',$id_project)->join('klaim','klaim.id','=','id_klaim')->where('revisi',$revisi)->where('turunan',$turunan)->get();
        $datadetail = data_detail_klaim::where('id_pkp',$id_project)->where('revisi',$revisi)->where('turunan',$turunan)->get();
        $user = DB::table('users')->join('pdf_project','pdf_project.tujuankirim','=','users.departement_id')->join('tipu','tipu.pdf_id','=','pdf_project.id_project_pdf')->where([ ['pdf_id',$id_project], ['revisi',$revisi], ['turunan',$turunan] ])->get();
        $picture = picture::where('pkp_id',$id_project)->where('revisi','<=',$revisi)->where('turunan','<=',$turunan)->get();
        $dept = Departement::all();
        $dept1 = Departement::all();
        return view('pkp.lihatpkp')->with([
            'pkpp' => $pkpp,
            'pengajuan' => $pengajuan,
            'pkp' => $pkp,
            'datases' => $ses,
            'for' => $for,
            'formula' => $formula,
            'datadetail' => $datadetail,
            'dataklaim' => $dataklaim,
            'pkp2' => $pkp2,
            'pkp1' => $pkp1,
            'pengajuanpkp' => $pengajuanpkp,
            'user' => $user,
            'datapkp' => $datapkp,
            'nopkp' => substr("T00".$nopkp,1,3),
            'picture' => $picture,
            'dept' => $dept,
            'dept1' => $dept1
        ]); 
    }

    public function downloadpkp($id_project,$revisi,$turunan){
        $pkp = pkp_project::where('id_project',$id_project)->get();
        $pkpp = tipp::join('pkp_project','tippu.id_pkp','=','pkp_project.id_project')->where([ ['id_project',$id_project], ['revisi',$revisi], ['turunan',$turunan] ])->get();
        $picture = picture::where('pkp_id',$id_project)->get();
        $dept = Departement::all();
        $for = data_forecast::where('id_pkp',$id_project)->where('revisi',$revisi)->where('turunan',$turunan)->get();
        $max = tipp::where('id_pkp',$id_project)->max('turunan');
        $max2 = tipp::where('id_pkp',$id_project)->max('revisi');
        $pkp1 = tipp::where('id_pkp',$id_project)->where('revisi',$max2)->where('turunan',$turunan)->get();
        $pengajuan = pengajuan::count();
        $dataklaim = data_klaim::where('id_pkp',$id_project)->join('klaim','klaim.id','=','id_klaim')->where('revisi',$revisi)->where('turunan',$turunan)->get();
        $ses= data_ses::where([ ['id_pkp',$id_project], ['revisi',$revisi], ['turunan',$turunan] ])->get();
        $datadetail = data_detail_klaim::where('id_pkp',$id_project)->where('turunan',$turunan)->get();
        return view('pkp.downloadpkp')->with([
            'pkpp' => $pkpp,
            'pengajuan' => $pengajuan,
            'datadetail' => $datadetail,
            'pkp1' => $pkp1,
            'dataklaim' => $dataklaim,
            'datases' => $ses,
            'for' => $for,
            'pkp' => $pkp,
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
        $data->status_project='sent';
        $data->jangka=$request->jangka;
        $data->waktu=$request->waktu;
        $data->status_freeze='inactive';
        $data->pengajuan_sample='reject';
        $data->prioritas=$request->prioritas;
        $data->freeze_diaktifkan=Carbon::now();
        $data->save();

        return redirect::route('listpkp');
    }

    public function terima(Request $request, $id_project){
        $terima= pkp_project::where('id_project',$id_project)->first();
        $terima->project_status=$request->terima;
        $terima->save();
        
        return Redirect()->back()->with('status', 'PKP '.$pkp->name.' Telah Ditambahkan!');
    }

    public function listpkp(){
        $pkp = pkp_project::orderBy('waktu','asc')->get();
        $type = pkp_type::all();
        $brand = brand::all();
        $pengajuan = pengajuan::count();
        return view('pkp.listpkp')->with([
            'type' => $type,
            'brand' => $brand,
            'pkp' => $pkp,
            'pengajuan' => $pengajuan
        ]);
    }

    public function konfigurasi($id_project,$revisi,$turunan){
        $konfig = tipp::where([ ['id_pkp',$id_project], ['revisi',$revisi], ['turunan',$turunan] ])->first();
        $konfig->kemas_eksis=null;
        if($konfig->primery!=null){
        $konfig->primery=null;}
        if($konfig->secondary!=null){
        $konfog->secondary=null;}
        if($konfig->tertiary!=null){
        $konfig->tertiary=null;}
        $konfig->save();
        return redirect::back();
    }

    public function buatpkp($id_project,$revisi,$turunan){
        $pkp = pkp_project::where('id_project',$id_project)->get();
        $pkpdata = tipp::where([ ['id_pkp',$id_project], ['revisi',$revisi], ['turunan',$turunan] ])->get();
        $project = tipp::where('status_pkp','!=','draf')->where('status_data','=','active') ->join('pkp_project','pkp_project.id_project','=','tippu.id_pkp')->get();
        $brand = brand::all();
        $ses = ses::all();
        $user = user::where('status','=','active')->get();
        $datases = data_ses::where([ ['id_pkp',$id_project], ['revisi',$revisi], ['turunan',$turunan]])->get();
        $uom = uom::all();
        $Ddetail = data_detail_klaim::max('id')+1;
        $tarkon = Tarkon::all();
        $for = data_forecast::where('id_pkp',$id_project)->where('revisi',$revisi)->where('turunan',$turunan)->get();
        $for2 = data_forecast::where('id_pkp',$id_project)->where('revisi',$revisi)->where('turunan',$turunan)->count();
        $kemas = datakemas::all();
        $eksis=datakemas::count();
        $datadetail = data_detail_klaim::where('id_pkp',$id_project)->where('turunan',$turunan)->where('revisi',$revisi)->get();
        $pangan = pkp_datapangan::all();
        $hitung = tipp::where([ ['id_pkp',$id_project], ['revisi',$revisi], ['turunan',$turunan] ])->count();
        $id_pkp = pkp_project::find($id_project);
        $idea = pkp_uniq_idea::all();
        $dataklaim = data_klaim::where('id_pkp',$id_project)->where('turunan',$turunan)->where('revisi',$revisi)->get();
        $ide = pkp_uniq_idea::all();
        $market = pkp_estimasi_market::all();
        $mar = pkp_estimasi_market::all();
        $pengajuan = pengajuan::count();
        $detail = detail_klaim::all();
        $klaim = klaim::all();
        $komponen = komponen::all();
        return view('pkp.buatpkp')->with([
            'brand' => $brand,
            'for2' => $for2,
            'datadetail' => $datadetail,
            'for' => $for,
            'user' => $user,
            'hitung' => $hitung,
            'uom' => $uom,
            'pengajuan' => $pengajuan,
            'datases' => $datases,
            'ses' => $ses,
            'tarkon' => $tarkon,
            'dataklaim' => $dataklaim,
            'eksis' => $eksis,
            'project' => $project,
            'Ddetail' => $Ddetail,
            'pangan' => $pangan,
            'kemas' => $kemas,
            'id_pkp' => $id_pkp,
            'idea' => $idea,
            'pkp' => $pkp,
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
        $uom = uom::all();
        $ses = ses::all();
        $Ddetail = data_detail_klaim::max('id')+1;
        $detail = detail_klaim::all();
        $klaim = klaim::all();
        $komponen = komponen::all();
        $pengajuan = pengajuan::count();
        $teams = tb_teams_brand::where('brand',$pkp->id_brand)->get();
        $id_pkp = pkp_project::find($id_project);
        $idea = pkp_uniq_idea::all();
        $project = tipp::where('status_pkp','!=','draf')->where('status_data','=','active') ->join('pkp_project','pkp_project.id_project','=','tippu.id_pkp')->get();
        $eksis=datakemas::count();
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
            'pengajuan' => $pengajuan,
            'id_pkp' => $id_pkp,
            'teams' => $teams,
            'idea' => $idea,
            'ses' => $ses,
            'Ddetail' => $Ddetail,
            'uom' => $uom,
            'eksis' => $eksis,
            'kemas' => $kemas,
            'ide' => $ide,
            'mar' => $mar,
            'market' => $market
        ]);
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
                    $message->from('app.prodev@nutrifood.co.id', 'PRODEV');
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
        $tip->perevisi=$tip->perevisi;
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
                        $message->from('app.prodev@nutrifood.co.id', 'PRODEV');
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
                'launch'=>$emaillaunch,],function($message)use($request,$id)
            {
                $message->subject('Konfirmasi Launching');
                $message->from('app.prodev@nutrifood.co.id', 'PRODEV');

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

    public function tipp(Request $request){
        $data = tipp::where('id_pkp',$request->id)->count();
        if($data>=1){
            $turunan = tipp::where('id_pkp',$request->id)->max('turunan');
            $revisi = tipp::where('id_pkp',$request->id)->max('revisi');

            return redirect()->Route('datatambahanpkp',['id_pkp' => $request->id,'revisi' => $revisi, 'turunan' => $turunan])->with('status', 'Data has been added up ');
        }
        elseif($data==0){
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
            $tip->aisle=$request->aislea;
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
                        $message->from('app.prodev@nutrifood.co.id', 'PRODEV');
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
        $pengajuan = pengajuan::count();
        return view('pkp.datatambahanpkp')->with([
            'pkp' => $pkp,
            'coba' => $coba,
            'coba1' => $coba1,
            'pengajuan' => $pengajuan,
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
                    $message->from('app.prodev@nutrifood.co.id', 'PRODEV');
                    //sent email to manager
                    $dept = DB::table('departements')->where('id',$request->kirim)->get();
                    foreach($dept as $dept){
                        $user = DB::table('users')->where('id',$dept->manager_id)->get();
                        foreach($user as $user){
                            $data = $user->email;
                            $cc = [Auth::user()->email,'asrinurul4238@gmail.com'];
                            //dd($cc);
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
        return redirect::Route('listpkp');
    }

    public function sentpkp(Request $request, $id_project,$revisi,$turunan){
        $data = pkp_project::where('id_project',$id_project)->first();
        $data->prioritas=$request->prioritas;
        $data->pkp_number=$request->nopkp;
        $data->ket_no=$request->ket_no;
        $data->status_project='sent';
        $data->tujuankirim=$request->kirim;
        $data->jangka=$request->jangka;
        $data->waktu=$request->waktu;
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
                'info' => 'Project Telah Selesai Di Revisi :)',
                'jangka' => $request->jangka,
                'waktu' => $request->waktu,],function($message)use($request)
                {
                    $message->subject('PKP '.$request->name);
                    $message->from('app.prodev@nutrifood.co.id', 'PRODEV');
                    //sent email to manager
                    $dept = DB::table('departements')->where('id',$request->kirim)->get();
                    foreach($dept as $dept){
                        $user = DB::table('users')->where('id',$dept->manager_id)->get();
                        foreach($user as $user){
                            $data = $user->email;
                            $cc = [Auth::user()->email,'asrinurul4238@gmail.com'];
                            //dd($cc);
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

        return redirect::Route('listpkp');
    }

    public function edituser(Request $request, $id_project){
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
            ],function($message)use($request)
            {
                $message->subject('PROJECT PKP');
                $message->from('app.prodev@nutrifood.co.id', 'PRODEV');
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
                        for ($i = 0; $i < count($data); $i++)
                        {
                            $message->attach(public_path() . '/' .$data[$i]);
                        }
                    }
                }
            });
            return redirect::Route('listpkprka')->with('status','E-mail Successfully');
        }
        catch (Exception $e){
        return response (['status' => false,'errors' => $e->getMessage()]);
        }

        return redirect::Route('listpkprka');
    }

    public function downloadfile($filename){
        $url = Storage::disk('public')->url('$filename');
        return response()->download(storage_path("app/public/{$filename}"));
    }

    public function rekappkp($id_project){
        $pengajuanpkp = pkp_project::join('pkp_pengajuan','pkp_project.id_project','=','pkp_pengajuan.id_pkp')->count();
        $pkp = pkp_project::where('id_project',$id_project)->get();
        $pengajuan = pengajuan::count();
        $sample_project = sample_project::where('id_pkp',$id_project)->get();
        $status_sample_project = sample_project::where('id_pkp',$id_project)->where('status','=','final')->count();
        $hitung = tipp::where('id_pkp',$id_project)->count();
        $max = tipp::where('id_pkp',$id_project)->max('turunan');
        $user = user::where('status','=','active')->get();
        $max2 = tipp::where('id_pkp',$id_project)->max('revisi');
        $datapkp = tipp::where('id_pkp',$id_project)->where('turunan',$max)->where('revisi',$max2)->get();
        $pkp1 = pkp_project::where('id_project',$id_project)->get();
        $hformula = formula::where('workbook_id',$id_project)->count();
        $formula = formula::where('workbook_id',$id_project)->where('vv','!=','null')->orderBy('versi','asc')->get();
        $data = pkp_project::where('id_project',$id_project)->get();
        $data1 = tipp::where('id_project',$id_project)->join('pkp_project','tippu.id_pkp','pkp_project.id_project')->where('status_data','=','active')->get();
        $hasilpanel = hasilpanel::where('id_wb',$id_project)->count();
        return view('pkp.daftarpkp')->with([
            'pkp' => $pkp,
            'pkp1' => $pkp1,
            'sample' => $sample_project,
            'status_sample' => $status_sample_project,
            'hasilpanel' => $hasilpanel,
            'user' => $user,
            'data1' => $data1,
            'formula' => $formula,
            'hformula' => $hformula,
            'datapkp' => $datapkp,
            'pengajuanpkp' => $pengajuanpkp,
            'data' => $data,
            'hitung' => $hitung
        ]);
    }

    public function approve1(Request $request,$id_project){
        $pkp = pkp_project::where('id_project',$id_project)->first();
        $pkp->status_terima='terima';
        $pkp->save();

        return redirect::back();
    }

    public function approve2(Request $request,$id_project){
        $pkp = pkp_project::where('id_project',$id_project)->first();
        $pkp->status_terima2='terima';
        $pkp->save();

        return redirect::back();
    }

    public function edittype(Request $request, $id_project){
        $type = pkp_project::where('id_project',$id_project)->first();
        $type->type=$request->type;
        $type->save();

        $pkp = tipp::where('id_pkp',$id_project)->first();
        $pkp->gambaran_proses=null;
        $pkp->save();

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

    public function dasboardnr(){
        $pkp1 = pkp_project::all()->count();
        $promo1 = promo::all()->count();
        $pdf1 = project_pdf::all()->count();
        $pengajuan = pengajuan::count();
        $hitungpkp = pkp_project::where('status_project','=','draf')->count();
        $pkp1 = pkp_project::all()->count();
        $hitungpromo = promo::where('status_project','=','draf')->count();
        $promo1 = promo::all()->count();
        $hitungpdf = project_pdf::where('status_project','=','draf')->count();
        $revisi = pkp_project::where('status_project','=','revisi')->count();
        $proses = pkp_project::where('status_project','=','proses')->count();
        $sent= pkp_project::where('status_project','=','sent')->count();
        $close = pkp_project::where('status_project','=','close')->count();
        $pie  =	 Charts::create('bar', 'highcharts')->title('Data PKP')->colors(['#ff0000', '#ff9000', '#1384fb', '#2afb13', '#d5fb13'])->labels(['draf', 'sent', 'revisi', 'proses', 'close'])
            ->values([$hitungpkp,$sent,$revisi,$proses,$close])->responsive(false);
        $revisipdf = project_pdf::where('status_project','=','revisi')->count();
        $prosespdf = project_pdf::where('status_project','=','proses')->count();
        $sentpdf= project_pdf::where('status_project','=','sent')->count();
        $closepdf = project_pdf::where('status_project','=','close')->count();
        $pie2  =	 Charts::create('pie', 'highcharts')->title('Data PDF')->colors(['#ff0000', '#ff9000', '#1384fb', '#2afb13', '#d5fb13'])->labels(['draf', 'sent', 'revisi', 'proses', 'close'])
            ->values([$hitungpdf,$sentpdf,$revisipdf,$prosespdf,$closepdf])->responsive(false);
        $revisipromo = promo::where('status_project','=','revisi')->count();
        $prosespromo = promo::where('status_project','=','proses')->count();
        $sentpromo = promo::where('status_project','=','sent')->count();
        $closepromo = promo::where('status_project','=','close')->count();
        $pie3  =	 Charts::create('area', 'highcharts')->title('Data PKP Promo')->labels(['draf', 'sent', 'revisi', 'proses', 'close'])
			->values([$hitungpromo,$sentpromo,$revisipromo,$prosespromo,$closepromo])->responsive(false);
        return view('NR.dasboard')->with([
            'pkp1' => $pkp1,
            'promo1' => $promo1,
            'pie' => $pie,
            'pie2' => $pie2,
            'hitungpkp' => $hitungpkp,
            'hitungpromo' => $hitungpromo,
            'hitungpdf' => $hitungpdf,
            'pesan' => $pesan,
            'pengajuan' => $pengajuan,
            'pie3' => $pie3,
            'pdf1' => $pdf1
        ]);
    }

    public function dasboardcs(){
        $pkp1 = pkp_project::all()->count();
        $hitungpkp = pkp_project::where('status_project','=','draf')->count();
        $promo1 = promo::all()->count();
        $pdf1 = project_pdf::all()->count();
        $pengajuan = pengajuan::count();
        $pkp1 = pkp_project::all()->count();
        $hitungpromo = promo::where('status_project','=','draf')->count();
        $promo1 = promo::all()->count();
        $hitungpdf = project_pdf::where('status_project','=','draf')->count();
        $pdf1 = project_pdf::all()->count();
        $revisipromo = promo::where('status_project','=','revisi')->count();
        $prosespromo = promo::where('status_project','=','proses')->count();
        $sentpromo = promo::where('status_project','=','sent')->count();
        $closepromo = promo::where('status_project','=','close')->count();
        $pie3  =Charts::create('area', 'highcharts')->title('Data PKP Promo')->labels(['draf', 'sent', 'revisi', 'proses', 'close'])
			->values([$hitungpromo,$sentpromo,$revisipromo,$prosespromo,$closepromo])->responsive(false);
        return view('CS.dasboardCS')->with([
            'pkp1' => $pkp1,
            'promo1' => $promo1,
            'hitungpromo' => $hitungpromo,
            'promo1' => $promo1,
            'hitungpdf' => $hitungpdf,
            'pdf1' => $pdf1,
            'pie3' => $pie3,
            'hitungpkp' => $hitungpkp,
            'pengajuan' => $pengajuan,
            'pdf1' => $pdf1
        ]);
    }

    public function prioritas(Request $request,$id_project){
        $pkp = pkp_project::where('id_project',$id_project)->first();
        $pkp->prioritas=$request->prioritas;
        $pkp->save();

        return redirect::back();
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

    public function kalenderpkp($id_project)
    {
        $pengajuan = pengajuan::count();
        $events = [];
        $data = pkp_project::where('id_project',$id_project)->get();
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
      return view('pkp.kalenderpkp')->with([
        'pengajuan' => $pengajuan,
        'calendar' => $calendar
    ]);
    }

    public function allcalenderpkp()
    {
        $pengajuan = pengajuan::count();
        $events = [];
        $data = pkp_project::where('status_project','!=','draf')->get();
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
        return view('pv.allcalender')->with([
            'pengajuan' => $pengajuan,
            'calendar' => $calendar
        ]);
    }

    public function allcalenderpdf()
    {
        $pengajuan = pengajuan::count();
        $events = [];
        $data = project_pdf::where('status_project','!=','draf')->get();
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
        return view('pv.allcalendarpdf')->with([
            'pengajuan' => $pengajuan,
            'calendar' => $calendar
        ]);
    }

    public function allcalenderpromo()
    {
        $pengajuan = pengajuan::count();
        $events = [];
        $data = promo::where('status_project','!=','draf')->get();
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
        return view('pv.allcalendarpromo')->with([
            'pesan' => $pesan,
            'pengajuan' => $pengajuan,
            'calendar' => $calendar
        ]);
    }

    public function story(){
        $pengajuan = pengajuan::count();
        $pkp = tipp::all();
        $pdf1 = coba::all();
        $promo = promo::all();
        return view('pkp.story')->with([
            'pkp' => $pkp,
            'pdf1' => $pdf1,
            'promo' => $promo,
            'pengajuan' => $pengajuan
        ]);
    }

}