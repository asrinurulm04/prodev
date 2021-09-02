<?php

namespace App\Http\Controllers\pv;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Mail;

use App\model\pkp\PkpProject;
use App\model\pkp\Uniqueness;
use App\model\pkp\uom;
use App\model\pkp\DataSES;
use App\model\pkp\DataPangan;
use App\model\pkp\ses;
use App\model\pkp\ProjectLaunching;
use App\model\pkp\EstimasiMarket;
use App\model\dev\Formula;
use App\model\pkp\klaim;
use App\model\pkp\KlaimDetail;
use App\model\pkp\komponen;
use App\model\pkp\DataKlaim;
use App\model\pkp\DetailKlaim;
use App\model\pkp\FileProject;
use App\model\pkp\Forecast;
use App\model\manager\pengajuan;
use App\model\master\Teams;
use App\model\master\Brand;
use App\model\master\Tarkon;
use App\model\kemas\datakemas;
use App\model\users\Departement;
use App\model\users\User;
use Auth;
use DB;
use Redirect;
use Carbon\Carbon;

class pkpController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
        $this->middleware('rule:pv_global' || 'rule:pv_lokal' || 'rule:NR' || 'rule:marketing' || 'rule:manager' || 'rule:admin');
    }

    public function datapkp(Request $request){
        $datapkp = PkpProject::max('id_pkp')+1;
        if($request->umum!=NULL){$data=$request->umum;}
        elseif($request->kemas!=NULL){$data=$request->kemas;}
        elseif($request->kemas==NULL && $request->umum==NULL){$data='New';}
        if($data=='New'){
            $pkp = new PkpProject;
            $pkp->id_pkp        = $datapkp;
            $pkp->revisi_kemas  = '0';
            $pkp->id_brand      = $request->brand;
            $pkp->author        = $request->author;
            $pkp->perevisi      = $request->author;
            $pkp->created_date  = $request->last;
            $pkp->last_update   = $request->last;
            $pkp->project_name  = $request->name;
            $pkp->type          = $request->type;
            $pkp->jenis         = $request->jenis;
            $pkp->no_kemas      = 'A';
            if($request->umum!=NULL){$pkp->kategori=$request->umum;}
            elseif($request->kemas!=NULL){ $pkp->kategori=$request->kemas;}
            elseif($request->kemas==NULL && $request->umum==NULL){$pkp->kategori='New';}
            $pkp->save();

            return Redirect()->Route('buatpkp1',[$pkp->id_project,$pkp->id_pkp]);
        }elseif($data=='Eksis'){
            $revisi     = PkpProject::where('id_project',$request->eksis)->first();
            $naikversi  = $revisi->revisi+1;
            if($request->jenis=='Umum'){
                $pkp = PkpProject::where('id_project',$request->eksis)->first();
                if($pkp->status_pkp=='draf'){
                    if($request->umum!=NULL){$pkp->jenis=$request->jenis;}
                    $pkp->type      = $request->type;
                    $pkp->id_brand  = $request->brand;
                    $pkp->save();
                }else{
                    if($request->umum!=NULL){$pkp->jenis=$request->jenis;}
                    $pkp->type      = $request->type;
                    $pkp->id_brand  = $request->brand;
                    $pkp->status_pkp= 'revisi';

                        $datases=DataSES::where([['id_project',$pkp->id_project],['id_pkp',$pkp->id_pkp],['revisi',$pkp->revisi],['turunan',$pkp->turunan],['revisi_kemas',$pkp->revisi_kemas]])->count();
                        if($datases>0){
                            $isises=DataSES::where([['id_project',$pkp->id_project],['id_pkp',$pkp->id_pkp],['revisi',$pkp->revisi],['turunan',$pkp->turunan],['revisi_kemas',$pkp->revisi_kemas]])->get();
                            foreach ($isises as $isises){
                                $data1= new DataSES;
                                $data1->id_project   = $pkp->id_project;
                                $data1->id_pkp       = $pkp->id_pkp;
                                $data1->revisi       = $naikversi;
                                $data1->turunan      = $pkp->turunan;
                                $data1->revisi_kemas = $pkp->revisi_kemas;
                                $data1->ses          = $isises->ses;
                                $data1->save();
                            }
                        }
                        $datafor=Forecast::where([['id_project',$pkp->id_project],['id_pkp',$pkp->id_pkp],['revisi',$pkp->revisi],['turunan',$pkp->turunan],['revisi_kemas',$pkp->revisi_kemas]])->count();
                        if($datafor>0){
                            $isifor=Forecast::where([['id_project',$pkp->id_project],['id_pkp',$pkp->id_pkp],['revisi',$pkp->revisi],['turunan',$pkp->turunan],['revisi_kemas',$pkp->revisi_kemas]])->get();
                            foreach ($isifor as $isifor){
                                $for= new Forecast;
                                $for->id_project  = $pkp->id_project;
                                $for->id_pkp      = $pkp->id_pkp;
                                $for->revisi      = $naikversi;
                                $for->turunan     = $pkp->turunan;
                                $for->revisi_kemas= $pkp->revisi_kemas;
                                $for->forecast    = $isifor->forecast;
                                $for->satuan      = $isifor->satuan;
                                $for->save();
                            }
                        }
                        $dataklaim=DataKlaim::where([['id_project',$pkp->id_project],['id_pkp',$pkp->id_pkp],['revisi',$pkp->revisi],['turunan',$pkp->turunan],['revisi_kemas',$pkp->revisi_kemas]])->count();
                        if($dataklaim>0){
                            $isiklaim=DataKlaim::where([['id_project',$pkp->id_project],['id_pkp',$pkp->id_pkp],['revisi',$pkp->revisi],['turunan',$pkp->turunan],['revisi_kemas',$pkp->revisi_kemas]])->get();
                            foreach ($isiklaim as $isiklaim){
                                $klaim= new DataKlaim;
                                $klaim->id_project  = $pkp->id_project;
                                $klaim->id_pkp      = $pkp->id_pkp;
                                $klaim->revisi      = $naikversi;
                                $klaim->turunan     = $pkp->turunan;
                                $klaim->revisi_kemas= $pkp->revisi_kemas;
                                $klaim->id_komponen = $isiklaim->id_komponen;
                                $klaim->id_klaim    = $isiklaim->id_klaim;
                                $klaim->note        = $isiklaim->note;
                                $klaim->save();
                            }
                        }
                        $detailklaim=DetailKlaim::where([['id_project',$pkp->id_project],['id_pkp',$pkp->id_pkp],['revisi',$pkp->revisi],['turunan',$pkp->turunan],['revisi_kemas',$pkp->revisi_kemas]])->count();
                        if($detailklaim>0){
                            $isidetail=DetailKlaim::where([['id_project',$pkp->id_project],['id_pkp',$pkp->id_pkp],['revisi',$pkp->revisi],['turunan',$pkp->turunan],['revisi_kemas',$pkp->revisi_kemas]])->get();
                            foreach ($isidetail as $isidetail){
                                $detail= new DetailKlaim;
                                $detail->id_project  = $pkp->id_project;
                                $detail->id_pkp      = $pkp->id_pkp;
                                $detail->revisi      = $naikversi;
                                $detail->turunan     = $pkp->turunan;
                                $detail->revisi_kemas= $pkp->revisi_kemas;
                                $detail->id_detail   = $isidetail->id_detail;
                                $detail->save();
                            }
                        }
                    $pkp->revisi=$naikversi;
                    $pkp->save();
                }
                return Redirect::Route('buatpkp',$pkp->id_project);
            }elseif($request->jenis=='Kemas'){
                $pkpp = PkpProject::where('id_project',$request->eksis)->first();
                $pkpp->save();
                $upkemas = PkpProject::where('id_pkp',$pkpp->id_pkp)->max('revisi_kemas')+1;
                $x = PkpProject::where('id_pkp',$pkpp->id_pkp)->max('no_kemas');$x++;
                    $tip= new PkpProject;
                    $tip->project_name=$pkpp->project_name;
                    $tip->pkp_number    = $pkpp->pkp_number;
                    $tip->id_pkp        = $pkpp->id_pkp;
                    $tip->revisi        = '0';
                    $tip->revisi_kemas  = '0';
                    $tip->approval              = 'approve';
                    $tip->kategori              = $pkpp->kategori;
                    $tip->id_brand              = $pkpp->id_brand;
                    $tip->no_kemas              = $x;
                    $tip->type                  = $pkpp->type;
                    $tip->jenis                 = $pkpp->jenis;
                    $tip->created_date          = $pkpp->created_date;
                    $tip->last_update           = $pkpp->last_update;
                    $tip->author                = $pkpp->author;
                    $tip->perevisi              = Auth::user()->id;
                    $tip->idea                  = $pkpp->idea;
                    $tip->gender                = $pkpp->gender;
                    $tip->dariumur              = $pkpp->dariumur;
                    $tip->sampaiumur            = $pkpp->sampaiumur;
                    $tip->Uniqueness            = $pkpp->Uniqueness;
                    $tip->reason                = $pkpp->reason;
                    $tip->Estimated             = $pkpp->Estimated;
                    $tip->launch                = $pkpp->launch;
                    $tip->kemas_eksis           = $pkpp->kemas_eksis;
                    $tip->years                 = $pkpp->years;
                    $tip->remarks_ses           = $pkpp->remarks_ses;
                    $tip->remarks_forecash      = $pkpp->remarks_forecash;
                    $tip->remarks_product_form  = $pkpp->remarks_product_form;
                    $tip->competitive           = $pkpp->competitive;
                    $tip->selling_price         = $pkpp->selling_price;
                    $tip->competitor            = $pkpp->competitor;
                    $tip->aisle                 = $pkpp->aisle;
                    $tip->serving_suggestion    = $pkpp->serving_suggestion;
                    $tip->price                 = $pkpp->price;
                    $tip->product_form          = $pkpp->product_form;
                    $tip->bpom                  = $pkpp->bpom;
                    $tip->kategori_bpom         = $pkpp->kategori_bpom;
                    $tip->akg                   = $pkpp->akg;
                    $tip->primery               = $pkpp->primery;
                    $tip->secondary             = $pkpp->secondary;
                    $tip->tertiary              = $pkpp->tertiary;
                    $tip->olahan                = $pkpp->olahan;
                    $tip->turunan               = '0';
                    $tip->status_project        = 'active';
                    $tip->prefered_flavour      = $pkpp->prefered_flavour;
                    $tip->product_benefits      = $pkpp->product_benefits;
                    $tip->mandatory_ingredient  = $pkpp->mandatory_ingredient;
                    $tip->UOM                   = $pkpp->UOM;
                    $tip->gambaran_proses       = $pkpp->gambaran_proses;
                    $tip->workbook              = $pkpp->workbook;
                    $tip->pengajuan_sample      = $pkpp->pengajuan_sample;
                    $tip->save();

                    $datases=DataSES::where([['id_project',$pkpp->id_project],['id_pkp',$pkpp->id_pkp],['revisi',$pkpp->revisi],['turunan',$pkpp->turunan],['revisi_kemas',$pkpp->revisi_kemas]])->count();
                        if($datases>0){
                            $isises=DataSES::where([['id_project',$pkpp->id_project],['id_pkp',$pkpp->id_pkp],['revisi',$pkpp->revisi],['turunan',$pkpp->turunan],['revisi_kemas',$pkpp->revisi_kemas]])->get();
                            foreach ($isises as $isises){
                                $data1= new DataSES;
                                $data1->id_project  = $tip->id_project;
                                $data1->id_pkp      = $tip->id_pkp;
                                $data1->revisi      = '0';
                                $data1->turunan     = '0';
                                $data1->revisi_kemas= '0';
                                $data1->ses         = $isises->ses;
                                $data1->save();
                            }
                        }
                        $datafor=Forecast::where([['id_project',$pkpp->id_project],['id_pkp',$pkpp->id_pkp],['revisi',$pkpp->revisi],['turunan',$pkpp->turunan],['revisi_kemas',$pkpp->revisi_kemas]])->count();
                        if($datafor>0){
                            $isifor=Forecast::where([['id_project',$pkpp->id_project],['id_pkp',$pkpp->id_pkp],['revisi',$pkpp->revisi],['turunan',$pkpp->turunan],['revisi_kemas',$pkpp->revisi_kemas]])->get();
                            foreach ($isifor as $isifor){
                                $for= new Forecast;
                                $for->id_project    = $tip->id_project;
                                $for->id_pkp        = $tip->id_pkp;
                                $for->revisi        = '0';
                                $for->turunan       = '0';
                                $for->revisi_kemas  = '0';
                                $for->forecast      = $isifor->forecast;
                                $for->satuan        = $isifor->satuan;
                                $for->save();
                            }
                        }
                        $dataklaim=DataKlaim::where([['id_project',$pkpp->id_project],['id_pkp',$pkpp->id_pkp],['revisi',$pkpp->revisi],['turunan',$pkpp->turunan],['revisi_kemas',$pkpp->revisi_kemas]])->count();
                        if($dataklaim>0){
                            $isiklaim=DataKlaim::where([['id_project',$pkpp->id_project],['id_pkp',$pkpp->id_pkp],['revisi',$pkpp->revisi],['turunan',$pkpp->turunan],['revisi_kemas',$pkpp->revisi_kemas]])->get();
                            foreach ($isiklaim as $isiklaim){
                                $klaim= new DataKlaim;
                                $klaim->id_project   = $tip->id_project;
                                $klaim->id_pkp       = $tip->id_pkp;
                                $klaim->revisi       = '0';
                                $klaim->turunan      = '0';
                                $klaim->revisi_kemas = '0';
                                $klaim->id_komponen  = $isiklaim->id_komponen;
                                $klaim->id_klaim     = $isiklaim->id_klaim;
                                $klaim->note         = $isiklaim->note;
                                $klaim->save();
                            }
                        }
                        $detailklaim=DetailKlaim::where([['id_project',$pkpp->id_project],['id_pkp',$pkpp->id_pkp],['revisi',$pkpp->revisi],['turunan',$pkpp->turunan],['revisi_kemas',$pkpp->revisi_kemas]])->count();
                        if($detailklaim>0){
                            $isidetail=DetailKlaim::where([['id_project',$pkpp->id_project],['id_pkp',$pkpp->id_pkp],['revisi',$pkpp->revisi],['turunan',$pkpp->turunan],['revisi_kemas',$pkpp->revisi_kemas]])->get();
                            foreach ($isidetail as $isidetail){
                                $detail= new DetailKlaim;
                                $detail->id_project  = $tip->id_project;
                                $detail->id_pkp      = $tip->id_pkp;
                                $detail->revisi      = '0';
                                $detail->turunan     = '0';
                                $detail->revisi_kemas= '0';
                                $detail->id_detail   = $isidetail->id_detail;
                                $detail->save();
                            }
                        }
                return Redirect()->Route('buatpkp1',[$tip->id_project,$tip->id_pkp]);
            }
        }
    }

    public function formpkp(){
        $brand      = brand::all();
        $kemas_eksis= PkpProject::where('jenis','Kemas')->where('status_project','active')->orderBy('project_name','asc')->get();
        $baku_eksis = PkpProject::where('jenis','Baku')->where('status_project','active')->orderBy('project_name','asc')->get();
        $pkp_eksis  = PkpProject::where('jenis','!=','Baku')->where('status_project','active')->orderBy('project_name','asc')->get();
        $pkp1       = PkpProject::where('status_project','active')->where('status_pkp','!=','draf')->orderBy('pkp_number','asc')->get();
        return view('pkp.requestPKP')->with([
            'brand'      => $brand,
            'pkp1'       => $pkp1,
            'kemas_eksis'=> $kemas_eksis,
            'pkp_eksis'  => $pkp_eksis,
            'baku_eksis' => $baku_eksis
        ]);
    }

    public function drafpkp(){
        $pkp = PkpProject::where('status_pkp','draf')->where('status_project','active')->orderBy('created_at','desc')->get();
        return view('pkp.drafpkp')->with([
            'pkp' => $pkp
        ]);
    }

    public function hapuspkp($id_project){
        $pkp= PkpProject::where('id_project',$id_project)->first();
        $pkp->delete();

        return redirect::back();
    }

    public function lihatpkp($id_project){
        $pkp        = PkpProject::where('id_project',$id_project)->first();
        $prioritas  = PkpProject::max('prioritas')+1;
        $tahun      = Carbon::now()->format('Y');
        $nopkp      = DB::table('tr_project_pkp')->where('tahun',$tahun)->max('pkp_number')+1;
        $data       = sprintf("%03s", abs($nopkp));
        $for        = Forecast::where([['id_project',$pkp->id_project],['id_pkp',$pkp->id_pkp],['revisi',$pkp->revisi],['turunan',$pkp->turunan],['revisi_kemas',$pkp->revisi_kemas]])->get();
        $type       = $pkp->type;
        $ses        = DataSES::where([['id_project',$pkp->id_project],['id_pkp',$pkp->id_pkp],['revisi','<=',$pkp->revisi],['turunan','<=',$pkp->turunan],['revisi_kemas','<=',$pkp->revisi_kemas]])->orderBy('revisi','desc')->orderBy('turunan','desc')->get();
        $pkp2       = PkpProject::where('id_pkp',$pkp->id_pkp)->where('revisi','<=',$pkp->revisi)->where('turunan',$pkp->turunan)->orderBy('turunan','desc')->orderBy('revisi','desc')->get();
        $pkp1       = PkpProject::where([['id_pkp',$pkp->id_pkp],['revisi','<=',$pkp->revisi],['turunan','<=',$pkp->turunan],['revisi_kemas','<=',$pkp->revisi_kemas]])->orderBy('turunan','desc')->orderBy('revisi','desc')->get();
        $dataklaim  = DataKlaim::join('ms_klaim','ms_klaim.id','=','id_klaim')->where([['id_project',$pkp->id_project],['id_pkp',$pkp->id_pkp],['revisi',$pkp->revisi],['turunan',$pkp->turunan],['revisi_kemas',$pkp->revisi_kemas]])->get();
        $datadetail = DetailKlaim::where([['id_project',$pkp->id_project],['id_pkp',$pkp->id_pkp],['revisi',$pkp->revisi],['turunan',$pkp->turunan],['revisi_kemas',$pkp->revisi_kemas]])->get();
        $picture    = FileProject::where([['pkp_id',$pkp->id_pkp],['revisi','<=',$pkp->revisi],['turunan','<=',$pkp->turunan],['revisi_kemas','<=',$pkp->revisi_kemas]])->get();
        $dept       = Departement::all();
        return view('pkp.lihatpkp')->with([
            'pkp'       => $pkp,
            'datases'   => $ses,
            'for'       => $for,
            'prioritas' => $prioritas,
            'type'      => $type,
            'datadetail'=> $datadetail,
            'dataklaim' => $dataklaim,
            'pkp2'      => $pkp2,
            'pkp1'      => $pkp1,
            'nopkp'     => $data,
            'picture'   => $picture,
            'dept'      => $dept
        ]); 
    }

    public function downloadpkp($id_project){
        $id_pkp     = PkpProject::where('id_project',$id_project)->first();
        $picture    = FileProject::where([['pkp_id',$id_pkp->id_project], ['revisi',$id_pkp->revisi], ['turunan',$id_pkp->turunan],['revisi_kemas',$id_pkp->revisi_kemas]])->get();
        $for        = Forecast::where([['id_project',$id_project], ['id_pkp',$id_pkp->id_pkp], ['revisi',$id_pkp->revisi], ['turunan',$id_pkp->turunan],['revisi_kemas',$id_pkp->revisi_kemas]])->get();
        $dataklaim  = DataKlaim::join('ms_klaim','ms_klaim.id','=','id_klaim')->where([['id_project',$id_project], ['id_pkp',$id_pkp->id_pkp], ['revisi',$id_pkp->revisi], ['turunan',$id_pkp->turunan],['revisi_kemas',$id_pkp->revisi_kemas]])->get();
        $ses        = DataSES::where([['id_project',$id_project], ['id_pkp',$id_pkp->id_pkp], ['revisi',$id_pkp->revisi], ['turunan',$id_pkp->turunan],['revisi_kemas',$id_pkp->revisi_kemas] ])->get();
        $datadetail = DetailKlaim::where([['id_project',$id_project], ['id_pkp',$id_pkp->id_pkp], ['revisi',$id_pkp->revisi], ['turunan',$id_pkp->turunan],['revisi_kemas',$id_pkp->revisi_kemas] ])->get();
        return view('pkp.downloadpkp')->with([
            'id_pkp'     => $id_pkp,
            'datadetail' => $datadetail,
            'dataklaim'  => $dataklaim,
            'datases'    => $ses,
            'for'        => $for,
            'picture'    => $picture
        ]); 
    }

    public function freeze(Request $request,$id_project){
        $data = PkpProject::where('id_project',$id_project)->first();
        $data->status_freeze= 'active';
        $data->note_freeze  = $request->notefreeze;
        $max = PkpProject::max('prioritas');
        if($data->prioritas<=$max){
            $project = PkpProject::where('status_pkp','!=','draf')->where('status_project','=','active')->where('prioritas','<=',$max)->get();
            foreach($project as $project){
                $akhir = PkpProject::where('id_project',$project->id_project)->where('prioritas','>',$data->prioritas)->update([
                    'prioritas' => $project['prioritas']-1,
                ]);
            }
        }
        $data->prioritas    = $max;
        $data->save();

        $isipkp = PkpProject::where('id_project',$id_project)->get();
        try{
            Mail::send('pv.aktifitasinfoemail', [
                'app'  => $isipkp,
                'info' => 'Project Ini di freeze oleh PV dengan alasan "'.$request->notefreeze.'"',
            ], function ($message) use ($request,$id_project) {
                $data  = PkpProject::where('id_project',$id_project)->first();
                $dept  = Departement::where('id',$data->tujuankirim)->first();
                $user1 = User::where('id',$dept->manager_id)->first();
                $user2 = User::where('id',$data->perevisi)->first();
                $message->subject('PRODEV | PKP');
                $message->to($user1->email);
                $message->cc($user2->email);

            });
            return back()->with('status','E-mail Successfully');
        }
        catch (Exception $e){
        return response (['status' => false,'errors' => $e->getMessage()]);
        }

        return redirect::back()->with('status', 'Project '.$data->project_name.' has been disabled!');
    }

    public function drop($id_project){
        $data = PkpProject::where('id_project',$id_project)->first();
        $data->status_pkp='drop';
        $project = PkpProject::where('status_pkp','!=','draf')->where('status_project','=','active')->where('prioritas','>=',$data->prioritas)->get();
        foreach($project as $project){
            $akhir = PkpProject::where('id_project',$project->id_project)->update([
                'prioritas' => $project['prioritas']-1,
            ]);
        }
        $data->prioritas=NULL;
        $data->save();

        return redirect::back()->with('status', 'Project '.$data->project_name.' has been dropped!');
    }

    public function activepkp(Request $request,$id_project){
        $data= PkpProject::where('id_project',$id_project)->first();
        $data->jangka        = $request->jangka;
        $data->waktu         = $request->waktu;
        $data->status_freeze = 'inactive';
        $data->save();

        return redirect::back();
    }

    public function TMubah(Request $request,$id_project){
        $data= PkpProject::where('id_project',$id_project)->first();
        $data->jangka           = $request->jangka;
        $data->waktu            = $request->waktu;
        $data->status_freeze    = 'inactive';
        $data->freeze_diaktifkan= Carbon::now();
        $data->save();

        return redirect::route('listpkp');
    }

    public function listpkp(){
        $pkp    = PkpProject::where('status_project','active')->where('status_pkp','!=','draf')->orderBy('pkp_number','desc')->get();
        $launch = PkpProject::join('tr_project_launching','tr_project_pkp.id_project','tr_project_launching.id_pkp')->get();
        return view('pkp.listpkp')->with([
            'pkp' => $pkp,
            'launch' => $launch
        ]);
    }

    public function buatpkp($id_project){
        $pkpdata    = PkpProject::where('id_project',$id_project)->first();
        $project    = PkpProject::where('status_pkp','!=','draf')->where('status_project','=','active')->get();
        $brand      = brand::all();
        $ses        = ses::all();
        $teams      = Teams::where('brand',$pkpdata->id_brand)->get();
        $datases    = DataSES::where([['id_project',$pkpdata->id_project],['id_pkp',$pkpdata->id_pkp],['revisi',$pkpdata->revisi],['turunan',$pkpdata->turunan],['revisi_kemas',$pkpdata->revisi_kemas]])->get();
        $uom        = uom::where('note',NULL)->get();
        $uom_primer = uom::where('note','!=',NULL)->get();
        $Ddetail    = DetailKlaim::max('id')+1;
        $tarkon     = Tarkon::all();
        $eksis      = datakemas::count();
        $for        = Forecast::where([['id_project',$pkpdata->id_project],['id_pkp',$pkpdata->id_pkp],['revisi',$pkpdata->revisi],['turunan',$pkpdata->turunan],['revisi_kemas',$pkpdata->revisi_kemas]])->get();
        $for2       = $for->count();
        $datadetail = DetailKlaim::where([['id_project',$pkpdata->id_project],['id_pkp',$pkpdata->id_pkp],['revisi',$pkpdata->revisi],['turunan',$pkpdata->turunan],['revisi_kemas',$pkpdata->revisi_kemas]])->get();
        $pangan     = DataPangan::all();
        $dataklaim  = DataKlaim::where([['id_project',$pkpdata->id_project],['id_pkp',$pkpdata->id_pkp],['revisi',$pkpdata->revisi],['turunan',$pkpdata->turunan],['revisi_kemas',$pkpdata->revisi_kemas]])->get();
        $ide        = Uniqueness::all();
        $kemas      = datakemas::all();
        $market     = EstimasiMarket::all();
        $detail     = KlaimDetail::all();
        $klaim      = klaim::all();
        $komponen   = komponen::all();
        return view('pkp.buatpkp')->with([
            'brand'     => $brand,
            'eksis'     => $eksis,
            'datadetail'=> $datadetail,
            'for'       => $for,
            'teams'     => $teams,
            'uom'       => $uom,
            'project'   => $project,
            'for2'      => $for2,
            'uom_primer'=> $uom_primer,
            'datases'   => $datases,
            'ses'       => $ses,
            'tarkon'    => $tarkon,
            'ide'       => $ide,
            'dataklaim' => $dataklaim,
            'Ddetail'   => $Ddetail,
            'pangan'    => $pangan,
            'kemas'     => $kemas,
            'komponen'  => $komponen,
            'klaim'     => $klaim,
            'detail'    => $detail,
            'pkp'       => $pkpdata,
            'market'    => $market
        ]);
    }

    public function buatpkp1($id_project,$id_pkp){
        $pkpdata    = PkpProject::where('id_project',$id_project)->first();
        $project    = PkpProject::where('status_pkp','!=','draf')->where('status_project','=','active')->get();
        $brand      = brand::all();
        $ses        = ses::all();
        $teams      = Teams::where('brand',$pkpdata->id_brand)->get();
        $datases    = DataSES::where([['id_project',$id_project], ['id_pkp',$pkpdata->id_pkp], ['revisi',$pkpdata->revisi], ['turunan',$pkpdata->turunan], ['revisi_kemas',$pkpdata->revisi_kemas]])->get();
        $uom        = uom::where('note',NULL)->get();
        $uom_primer = uom::where('note','!=',NULL)->get();
        $Ddetail    = DetailKlaim::max('id')+1;
        $tarkon     = Tarkon::all();
        $eksis      = datakemas::count();
        $for        = Forecast::where([['id_project',$id_project], ['id_pkp',$pkpdata->id_pkp], ['revisi',$pkpdata->revisi], ['turunan',$pkpdata->turunan], ['revisi_kemas',$pkpdata->revisi_kemas]])->get();
        $for2       = $for->count();
        $datadetail = DetailKlaim::where([['id_project',$id_project],['id_pkp',$id_pkp],['revisi',$pkpdata->revisi],['turunan',$pkpdata->turunan],['revisi_kemas',$pkpdata->revisi_kemas]])->get();
        $pangan     = DataPangan::all();
        $dataklaim  = DataKlaim::where([['id_project',$id_project],['id_pkp',$id_pkp],['revisi',$pkpdata->revisi],['turunan',$pkpdata->turunan],['revisi_kemas',$pkpdata->revisi_kemas]])->get();
        $ide        = Uniqueness::all();
        $kemas      = datakemas::all();
        $market     = EstimasiMarket::all();
        $detail     = KlaimDetail::all();
        $klaim      = klaim::all();
        $komponen   = komponen::all();
        return view('pkp.buatpkp1')->with([
            'brand'     => $brand,
            'eksis'     => $eksis,
            'datadetail'=> $datadetail,
            'for'       => $for,
            'teams'     => $teams,
            'uom'       => $uom,
            'project'   => $project,
            'for2'      => $for2,
            'uom_primer'=> $uom_primer,
            'datases'   => $datases,
            'ses'       => $ses,
            'tarkon'    => $tarkon,
            'ide'       => $ide,
            'dataklaim' => $dataklaim,
            'Ddetail'   => $Ddetail,
            'pangan'    => $pangan,
            'kemas'     => $kemas,
            'komponen'  => $komponen,
            'klaim'     => $klaim,
            'detail'    => $detail,
            'pkp'       => $pkpdata,
            'market'    => $market
        ]);
    }

    public function konfigurasi($id_project){
        $konfig = PkpProject::where('id_project',$id_project)->first();
        $konfig->kemas_eksis = null;
        if($konfig->primery != null){
            $konfig->primery = null;}
        if($konfig->secondary != null){
            $konfig->secondary = null;}
        if($konfig->tertiary != null){
            $konfig->tertiary= null;}
        $konfig->save();
        return redirect::back();
    }

    public function updatetipp(Request $request,$id_project,$revisi,$turunan){
        $pkp        = PkpProject::where('id_project',$id_project)->first();
        $naikversi  = $pkp->turunan + 1;
        $versikemas = $pkp->revisi_kemas + 1;

        $pkpp = PkpProject::where('id_project',$id_project)->first();
        $pkpp->project_name  = $request->name_project;
        $pkpp->id_brand      = $request->brand;
        $pkpp->status_project= 'inactive';
        if($pkpp->bpom==null){$pkpp->bpom=$request->bpom;}
        if($pkpp->kategori_bpom==null){$pkpp->kategori_bpom=$request->katbpom;}
        if($pkpp->kemas_eksis==null){$pkpp->kemas_eksis=$request->eksis;}
        if($pkpp->akg==null){$pkpp->akg=$request->akg;}
        $pkpp->save();

            $tip= new PkpProject;
            $tip->id_pkp                = $pkpp->id_pkp;
            $tip->project_name          = $pkpp->project_name;
            if($pkpp->pkp_number!=NULL){
                $tip->pkp_number        = $pkpp->pkp_number;
            }
            $tip->id_brand              = $pkpp->id_brand;
            $tip->no_kemas              = $pkpp->no_kemas;
            $tip->revisi_kemas          = $pkpp->revisi_kemas;
            $tip->type                  = $pkpp->type;
            $tip->jenis                 = $pkpp->jenis;
            $tip->kategori              = $pkpp->kategori;
            $tip->created_date          = $pkpp->created_date;
            $tip->last_update           = $request->last_up;
            $tip->author                = $pkpp->author;
            $tip->perevisi              = Auth::user()->id;
            $tip->idea                  = $request->idea;
            $tip->gender                = $request->gender;
            $tip->dariumur              = $request->dariumur;
            $tip->sampaiumur            = $request->sampaiumur;
            $tip->Uniqueness            = $request->uniq_idea;
            $tip->reason                = $request->reason;
            $tip->Estimated             = $request->estimated;
            $tip->launch                = $request->launch;
            $tip->kemas_eksis           = $request->eksis;
            $tip->years                 = $request->tahun;
            $tip->remarks_ses           = $request->remarks_ses;
            $tip->remarks_forecash      = $request->remarks_forecash;
            $tip->remarks_product_form  = $request->remarks_product_form;
            $tip->competitive           = $request->competitive;
            $tip->selling_price         = $request->Selling_price;
            $tip->competitor            = $request->competitor;
            $tip->aisle                 = $request->aisle;
            $tip->serving_suggestion    = $request->suggestion;
            $tip->price                 = $request->analysis;
            $tip->product_form          = $request->product;
            $tip->bpom                  = $request->bpom;
            $tip->kategori_bpom         = $request->katbpom;
                if($request->akg!=NUll){
                    $tip->akg           = $request->akg;
                }elseif($request->akg==NULL){
                    $tip->akg           = '6';
                }
                if($request->primer==''){
                    $tip->kemas_eksis   = $request->data_eksis;
                }elseif($request->primer!='NULL'){
                    $tip->kemas_eksis   = $request->kemas;

                    $kemas = new datakemas;
                    $kemas->nama        = '-';
                    $kemas->tersier     = $request->tersier;
                    $kemas->s_tersier   = $request->s_tersier;
                    $kemas->primer      = $request->primer;
                    $kemas->s_primer    = $request->s_primer;
                    $kemas->sekunder1   = $request->sekunder1;
                    $kemas->s_sekunder1 = $request->s_sekunder1;
                    $kemas->sekunder2   = $request->sekunder2;
                    $kemas->s_sekunder2 = $request->s_sekunder2;
                    $kemas->save();
                }
            $tip->primery               = $request->primary;
            $tip->secondary             = $request->secondary;
            $tip->tertiary              = $request->tertiary;
            $tip->olahan                = $request->olahan;
                if($pkpp->jenis=='Baku'){
                    $tip->turunan       = $naikversi;
                    $tip->revisi_kemas  = $pkpp->revisi_kemas;
                }elseif($pkpp->jenis=='Kemas'){
                    $tip->revisi_kemas  = $versikemas;
                    $tip->turunan       = $pkpp->turunan;
                }else{
                    $tip->revisi_kemas  = $versikemas;
                    $tip->turunan       = $naikversi;
                }
            $tip->status_project         = 'active';
            $tip->revisi                 = $pkpp->revisi;
            $tip->prefered_flavour       = $request->prefered;
            $tip->product_benefits       = $request->benefits;
            $tip->mandatory_ingredient   = $request->ingredient;
            $tip->UOM                    = $request->uom;
            $tip->gambaran_proses        = $request->proses;
            $tip->save();

        if($request->ses!=''){
            $rule      = array(); 
            $validator = Validator::make($request->all(), $rule);  
            if ($validator->passes()) {
				$idz = implode(',', $request->input('ses'));
				$ids = explode(',', $idz);
				for ($i = 0; $i < count($ids); $i++){
					$pipeline = new DataSES;
                    $pipeline->id_project   = $tip->id_project;
                    $pipeline->id_pkp       = $pkpp->id_pkp;
                    $pipeline->revisi       = $revisi;
                    $pipeline->turunan      = $tip->turunan;
                    $pipeline->revisi_kemas = $tip->revisi_kemas;
					$pipeline->ses          = $ids[$i];
					$pipeline->save();
					$i = $i++;
				}
			}
		}
        if($request->satuan!=''){
            $data      = array(); 
            $validator = Validator::make($request->all(), $data);  
            if ($validator->passes()) {
				$idz = implode(',', $request->input('forecast'));
				$ids = explode(',', $idz);
				$ida = implode(',', $request->input('satuan'));
				$idb = explode(',', $ida);
				for ($i = 0; $i < count($ids); $i++){
					$pipeline = new Forecast;
                    $pipeline->id_project   = $tip->id_project;
                    $pipeline->id_pkp       = $pkpp->id_pkp;
                    $pipeline->revisi       = $revisi;
                    $pipeline->turunan      = $tip->turunan;
                    $pipeline->revisi_kemas = $tip->revisi_kemas;
					$pipeline->forecast     = $ids[$i];
					$pipeline->satuan       = $idb[$i];
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
				for ($i = 0; $i < count($ids); $i++){
					$pipeline = new DataKlaim;
					$pipeline->id_project   = $tip->id_project;
					$pipeline->id_pkp       = $pkpp->id_pkp;
					$pipeline->revisi       = $revisi;
				    $pipeline->turunan      = $tip->turunan;
				    $pipeline->revisi_kemas = $tip->revisi_kemas;
					$pipeline->id_klaim     = $ids[$i];
					$pipeline->id_komponen  = $idb[$i];
					$pipeline->note         = $data[$i];
					$pipeline->save();
					$i = $i++;
				}
			}
		}
		if($request->detail!=''){
			$detailklaim = array(); 
			$validator   = Validator::make($request->all(), $detailklaim);  
			if ($validator->passes()) {
				$idz = implode(',', $request->input('detail'));
				$ids = explode(',', $idz);
				for ($i = 0; $i < count($ids); $i++){
					$detail = new DetailKlaim;
					$detail->id_project   = $tip->id_project;
					$detail->id_pkp       = $pkpp->id_pkp;
					$detail->revisi       = $revisi;
                    $detail->turunan      = $tip->turunan;
                    $detail->revisi_kemas = $tip->revisi_kemas;
					$detail->id_detail    = $ids[$i];
					$detail->save();
					$i = $i++;

				}
			}
		}
        $isipkp = PkpProject::where('id_project',$tip->id_project)->get();
        $for    = Forecast::where('id_project',$request->id)->get();
        try{
            Mail::send('pv.aktifitasinfoemail', [
                'app'  => $isipkp,
                'for'  => $for,
                'info' => 'Saat ini terdapat perubahan data PKP',
            ],function($message)use($request){
                $tujuan    = array(); 
                $validator = Validator::make($request->all(), $tujuan);  
                if ($validator->passes()) {
                    $email = implode(',', $request->input('emailtujuan'));
                    $data  = explode(',', $email);
                    for ($i = 0; $i < count($data); $i++){
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

        return redirect()->Route('datatambahanpkp',$tip->id_project)->with('status', 'Revised data ');
    }

    public function updatetipp2(Request $request,$id_pkp,$revisi,$turunan,$kemas){
        $eksis = datakemas::count();
        $pkpp  = PkpProject::where('id_project',$id_pkp)->where('revisi',$revisi)->where('turunan',$turunan)->where('revisi_kemas',$kemas)->first();
        $tip   = PkpProject::where('id_project',$id_pkp)->where('revisi',$revisi)->where('turunan',$turunan)->where('revisi_kemas',$kemas)->first();
        $tip->project_name          = $request->name_project;
        $tip->id_brand              = $request->brand;
        $tip->id_pkp                = $pkpp->id_pkp;
        $tip->project_name          = $pkpp->project_name;
        $tip->id_brand              = $pkpp->id_brand;
        $tip->type                  = $pkpp->type;
        $tip->jenis                 = $pkpp->jenis;
        $tip->created_date          = $pkpp->created_date;
        $tip->last_update           = $request->last_up;
        $tip->author                = $pkpp->author;
        $tip->perevisi              = Auth::user()->id;
        $tip->idea                  = $request->idea;
        $tip->gender                = $request->gender;
        $tip->dariumur              = $request->dariumur;
        $tip->sampaiumur            = $request->sampaiumur;
        $tip->Uniqueness            = $request->uniq_idea;
        $tip->reason                = $request->reason;
        $tip->remarks_ses           = $request->remarks_ses;
        $tip->remarks_forecash      = $request->remarks_forecash;
        $tip->remarks_product_form  = $request->remarks_product_form;
        $tip->Estimated             = $request->estimated;
        $tip->launch                = $request->launch;
        $tip->kemas_eksis           = $request->eksis;
        $tip->years                 = $request->tahun;
        $tip->revisi                = $request->revisi;
        $tip->serving_suggestion    = $request->suggestion;
        $tip->competitive           = $request->competitive;
        $tip->selling_price         = $request->Selling_price;
        $tip->competitor            = $request->competitor;
        $tip->aisle                 = $request->aisle;
        $tip->price                 = $request->analysis;
        $tip->product_form          = $request->product;
        $tip->bpom                  = $request->bpom;
        $tip->kategori_bpom         = $request->katbpom;
            if($request->akg!=NUll){
                $tip->akg          = $request->akg;
            }elseif($request->akg==NULL){
                $tip->akg          = '6';
            }
            if($request->primer==''){
                $tip->kemas_eksis  = $request->data_eksis;
            }elseif($request->primer!='NULL'){
                $tip->kemas_eksis  = $request->kemas;

                $kemas = new datakemas;
                $kemas->tersier    = $request->tersier;
                $kemas->s_tersier  = $request->s_tersier;
                $kemas->primer     = $request->primer;
                $kemas->s_primer   = $request->s_primer;
                $kemas->sekunder1  = $request->sekunder1;
                $kemas->s_sekunder1= $request->s_sekunder1;
                $kemas->sekunder2  = $request->sekunder2;
                $kemas->s_sekunder2= $request->s_sekunder2;
                $kemas->save();
            }
        $tip->primery              = $request->primary;
        $tip->status_project       = 'active';
        $tip->secondary            = $request->secondary;
        $tip->tertiary             = $request->tertiary;
        $tip->olahan               = $request->olahan;
        $tip->prefered_flavour     = $request->prefered;
        $tip->product_benefits     = $request->benefits;
        $tip->mandatory_ingredient = $request->ingredient;
        $tip->UOM                  = $request->uom;
        $tip->turunan              = $pkpp->turunan;
        $tip->revisi_kemas         = $pkpp->revisi_kemas;
        $tip->gambaran_proses      = $request->proses;
        $tip->save();

        if($request->ses!=''){
            $datases   = DataSES::where('id_pkp',$pkpp->id_pkp)->where('revisi',$pkpp->revisi)->where('turunan',$pkpp->turunan)->where('revisi_kemas',$pkpp->revisi_kemas)->delete();
            $rule      = array(); 
            $validator = Validator::make($request->all(), $rule);  
            if ($validator->passes()) {
                $idz = implode(',', $request->input('ses'));
                $ids = explode(',', $idz);
                for ($i = 0; $i < count($ids); $i++){
                    $pipeline = new DataSES;
                    $pipeline->id_project   = $tip->id_project;
                    $pipeline->id_pkp       = $request->id;
                    $pipeline->turunan      = $turunan;
                    $pipeline->revisi       = $revisi;
                    $pipeline->revisi_kemas = $tip->revisi_kemas;
                    $pipeline->ses          = $ids[$i];
                    $pipeline->save();
                    $i = $i++;
                }
            }
        }
        if($request->satuan!=''){
            $datasatuan = Forecast::where('id_pkp',$pkpp->id_pkp)->where('revisi',$pkpp->revisi)->where('turunan',$pkpp->turunan)->where('revisi_kemas',$pkpp->revisi_kemas)->delete();
            $data       = array(); 
            $validator  = Validator::make($request->all(), $data);  
            if ($validator->passes()) {
                $idz = implode(',', $request->input('forecast'));
                $ids = explode(',', $idz);
                $ida = implode(',', $request->input('satuan'));
                $idb = explode(',', $ida);
                for ($i = 0; $i < count($ids); $i++){
                    $pipeline = new Forecast;
                    $pipeline->id_project   = $tip->id_project;
                    $pipeline->id_pkp       = $request->id;
                    $pipeline->turunan      = $turunan;
                    $pipeline->revisi       = $revisi;
                    $pipeline->revisi_kemas = $tip->revisi_kemas;
                    $pipeline->forecast     = $ids[$i];
                    $pipeline->satuan       = $idb[$i];
                    $pipeline->save();
                    $i = $i++;
                }
            }
        }
        if($request->klaim!=''){
            $dataklaim = DataKlaim::where('id_pkp',$pkpp->id_pkp)->where('revisi',$pkpp->revisi)->where('turunan',$pkpp->turunan)->where('revisi_kemas',$pkpp->revisi_kemas)->delete();
            $dataklaim = array(); 
            $validator = Validator::make($request->all(), $dataklaim);  
            if ($validator->passes()) {
                $idz  = implode(',', $request->input('klaim'));
                $ids  = explode(',', $idz);
                $ida  = implode(',', $request->input('komponen'));
                $idb  = explode(',', $ida);
                $note = implode(',', $request->input('ket'));
                $data = explode(',', $note);
                for ($i = 0; $i < count($ids); $i++){
                    $pipeline = new DataKlaim;
                    $pipeline->id_project   = $tip->id_project;
                    $pipeline->id_pkp       = $request->id;
                    $pipeline->turunan      = $turunan;
                    $pipeline->revisi       = $revisi;
                    $pipeline->revisi_kemas = $tip->revisi_kemas;
                    $pipeline->id_klaim     = $ids[$i];
                    $pipeline->id_komponen  = $idb[$i];
                    $pipeline->note         = $data[$i];
                    $pipeline->save();
                    $i = $i++;
                }
            }
        }
        if($request->detail!=''){
            $datadetail  = DetailKlaim::where('id_pkp',$pkpp->id_pkp)->where('revisi',$pkpp->revisi)->where('turunan',$pkpp->turunan)->where('revisi_kemas',$pkpp->revisi_kemas)->delete();
            $detailklaim = array(); 
            $validator   = Validator::make($request->all(), $detailklaim);  
            if ($validator->passes()) {
                $idz = implode(',', $request->input('detail'));
                $ids = explode(',', $idz);
                for ($i = 0; $i < count($ids); $i++){
                    $detail = new DetailKlaim;
                    $detail->id_project     = $tip->id_project;
                    $detail->id_pkp         = $request->id;
                    $detail->turunan        = $turunan;
                    $detail->revisi         = $revisi;
                    $detail->revisi_kemas = $tip->revisi_kemas;
                    $detail->id_detail      = $ids[$i];
                    $detail->save();
                    $i = $i++;
                }
            }
        }
        $isipkp = PkpProject::where('id_project',$tip->id_project)->where('status_project','=','active')->get();
        $for    = Forecast::where('id_project',$request->id)->get();
        try{
            Mail::send('pv.aktifitasinfoemail', [
            'app'  => $isipkp,
            'for'  => $for,
            'info' => 'Saat ini terdapat perubahan data PKP',],function($message)use($request) {
                $tujuan     = array(); 
                $validator  = Validator::make($request->all(), $tujuan);  
                if ($validator->passes()) {
                    $email = implode(',', $request->input('emailtujuan'));
                    $data  = explode(',', $email);
                    for ($i = 0; $i < count($data); $i++){
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
        return redirect()->Route('datatambahanpkp',$tip->id_project)->with('status', 'Revised data ');
    }

    public function tipp(Request $request,$id_project){
            $tip = PkpProject::where('id_project',$id_project)->first();
            $tip->id_pkp               = $request->id;
            $tip->idea                 = $request->idea;
            $tip->gender               = $request->gender;
            $tip->project_name         = $request->name_project;
            $tip->id_brand             = $request->brand;
            $tip->dariumur             = $request->dariumur;
            $tip->sampaiumur           = $request->sampaiumur;
            $tip->Uniqueness           = $request->uniq_idea;
            $tip->reason               = $request->reason;
            $tip->perevisi             = Auth::user()->id;
            $tip->last_update          = $request->last_up;
            $tip->Estimated            = $request->estimated;
            $tip->launch               = $request->launch;
            $tip->years                = $request->tahun;
            $tip->serving_suggestion   = $request->suggestion;
            $tip->remarks_ses          = $request->remarks_ses;
            $tip->remarks_forecash     = $request->remarks_forecash;
            $tip->remarks_product_form = $request->remarks_product_form;
            $tip->competitive          = $request->competitive;
            $tip->UOM                  = $request->uom;
            $tip->revisi               = '0';
            $tip->revisi_kemas         = $tip->revisi_kemas;
            $tip->selling_price        = $request->Selling_price;
            $tip->competitor           = $request->competitor;
            $tip->aisle                = $request->aisle;
            $tip->price                = $request->analysis;
                if($request->primer==''){
                    $tip->kemas_eksis  = $request->data_eksis;
                }elseif($request->primer!='NULL'){
                    $tip->kemas_eksis  = $request->kemas;

                    $kemas = new datakemas;
                    $kemas->tersier    = $request->tersier;
                    $kemas->s_tersier  = $request->s_tersier;
                    $kemas->primer     = $request->primer;
                    $kemas->s_primer   = $request->s_primer;
                    $kemas->sekunder1  = $request->sekunder1;
                    $kemas->s_sekunder1= $request->s_sekunder1;
                    $kemas->sekunder2  = $request->sekunder2;
                    $kemas->s_sekunder2= $request->s_sekunder2;
                    $kemas->save();
                }
            $tip->product_form         = $request->product;
            $tip->bpom                 = $request->bpom;
            $tip->kategori_bpom        = $request->katbpom;
                if($request->akg!=NUll){
                    $tip->akg          = $request->akg;
                }elseif($request->akg==NULL){
                    $tip->akg          = '6';
                }
            $tip->olahan               = $request->olahan;
            $tip->turunan              = '0';
            $tip->primery              = $request->primary;
            $tip->secondary            = $request->secondary;
            $tip->tertiary             = $request->tertiary;
            $tip->prefered_flavour     = $request->prefered;
            $tip->product_benefits     = $request->benefits;
            $tip->mandatory_ingredient = $request->ingredient;
            $tip->gambaran_proses      = $request->proses;
            $tip->save();
        
            if($request->ses!=''){
                $datases   = DataSES::where('id_project',$tip->id_project)->delete();
                $rule      = array(); 
                $validator = Validator::make($request->all(), $rule);  
                if ($validator->passes()) {
                    $idz = implode(',', $request->input('ses'));
                    $ids = explode(',', $idz);
                    for ($i = 0; $i < count($ids); $i++){
                        $pipeline = new DataSES;
                        $pipeline->id_project   = $tip->id_project;
                        $pipeline->id_pkp       = $request->id;
                        $pipeline->turunan      = '0';
                        $pipeline->revisi       = '0';
                        $pipeline->revisi_kemas = '0';
                        $pipeline->ses          = $ids[$i];
                        $pipeline->save();
                        $i = $i++;
                    }
                }
            }
            if($request->forecast!='' && $request->satuan!=''){
                $datasatuan = Forecast::where('id_project',$tip->id_project)->delete();
                $data       = array(); 
                $validator  = Validator::make($request->all(), $data);  
                if ($validator->passes()) {
                    $idz = implode(',', $request->input('forecast'));
                    $ids = explode(',', $idz);
                    $ida = implode(',', $request->input('satuan'));
                    $idb = explode(',', $ida);
                    for ($i = 0; $i < count($ids); $i++){
                        $pipeline = new Forecast;
                        $pipeline->id_project   = $tip->id_project;
                        $pipeline->id_pkp       = $request->id;
                        $pipeline->turunan      = '0';
                        $pipeline->revisi       = '0';
                        $pipeline->revisi_kemas = '0';
                        $pipeline->forecast     = $ids[$i];
                        $pipeline->satuan       = $idb[$i];
                        $pipeline->save();
                        $i = $i++;
                    }
                }
            }
            if($request->klaim!=''){
                $dataklaim = DataKlaim::where('id_project',$tip->id_project)->delete();
                $dataklaim = array(); 
                $validator = Validator::make($request->all(), $dataklaim);  
                if ($validator->passes()) {
                    $idz  = implode(',', $request->input('klaim'));
                    $ids  = explode(',', $idz);
                    $ida  = implode(',', $request->input('komponen'));
                    $idb  = explode(',', $ida);
                    $note = implode(',', $request->input('ket'));
                    $data = explode(',', $note);
                    for ($i = 0; $i < count($ids); $i++){
                        $pipeline = new DataKlaim;
                        $pipeline->id_project   = $tip->id_project;
                        $pipeline->id_pkp       = $request->id;
                        $pipeline->turunan      = '0';
                        $pipeline->revisi       = '0';
                        $pipeline->revisi_kemas = '0';
                        $pipeline->id_klaim     = $ids[$i];
                        $pipeline->id_komponen  = $idb[$i];
                        $pipeline->note         = $data[$i];
                        $pipeline->save();
                        $i = $i++;
                    }
                }
            }
            if($request->detail!=''){
                $datadetail = DetailKlaim::where('id_project',$tip->id_project)->delete();
                $detailklaim= array(); 
                $validator  = Validator::make($request->all(), $detailklaim);  
                if ($validator->passes()) {
                    $idz = implode(',', $request->input('detail'));
                    $ids = explode(',', $idz);
                    for ($i = 0; $i < count($ids); $i++){
                        $detail = new DetailKlaim;
                        $detail->id_project    = $tip->id_project;
                        $detail->id_pkp        = $request->id;
                        $detail->id_klaim      = $request->iddetail;
                        $detail->turunan       = '0';
                        $detail->revisi        = '0';
                        $detail->revisi_kemas  = '0';
                        $detail->id_detail     = $ids[$i];
                        $detail->save();
                        $i = $i++;
                    }
                }
            }
            $isipkp = PkpProject::where('id_project',$request->id)->where('status_project','=','active')->get();
            $for    = Forecast::where('id_project',$tip->id_project)->get();
            try{
                Mail::send('pv.aktifitasinfoemail', [
                    'app'  => $isipkp,
                    'for'  => $for,
                    'info' => 'Terdapat Data PKP Baru',
                ],function($message)use($request){
                    $tujuan    = array(); 
                    $validator = Validator::make($request->all(), $tujuan);  
                    if ($validator->passes()) {
                        $email = implode(',', $request->input('emailtujuan'));
                        $data  = explode(',', $email);
                        for ($i = 0; $i < count($data); $i++){
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
            return redirect()->Route('datatambahanpkp',$tip->id_project)->with('status', 'Data has been added up ');
    }

    public function closeproject(Request $request,$id){
        $pkp     = PkpProject::where('id_project',$id)->first();
        $project = PkpProject::where('status_pkp','!=','draf')->where('status_project','=','active')->where('prioritas','>=',$pkp->prioritas)->get();
        foreach($project as $project){
            $akhir = PkpProject::where('id_project',$project->id_project)->update([
                'prioritas' => $project['prioritas']-1,
            ]);
        }
        $pkp->status_pkp = 'close';
        $pkp->prioritas  = NULL;
        $pkp->save();
        
        $close = new ProjectLaunching;
        $close->id_pkp          = $request->id;
        $close->tanggal         = $request->date;
        $close->nama_produk     = $request->produk;
        $close->formula_baku    = $request->baku;
        $close->formula_kemas   = $request->kemas;
        $close->price_list      = $request->price;
        $close->forecast        = $request->forecast;
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
        try{
            Mail::send('launching', ['pkp'=>$emaillaunch,],function($message)use($request,$id){
                $message->subject('Konfirmasi Launching');
                $user1    = $request->user1;
                $user2    = $request->user2;
                $rd1      = $request->rd1;
                $rd2      = $request->rd2;
                $author   = $request->author;
                $perevisi = $request->pv;
                $project  = PkpProject::where('id_project',$id)->get();
                foreach($project as $pro){
                    if($pro->tujuankirim2!=NULL && $pro->tujuankirim!=NULL){
                        // user rd kemas dan produk terisi
                        if($pro->userpenerima2!=NULL && $pro->userpenerima!=NULL){
                            $to = [$user1,$user2,$rd1,$rd2];
                            $cc = [$author,$perevisi,$request->cc1,$request->cc2,$request->cc2];
                            $message->to($to);
                            $message->cc($cc);
                        }
                        // user rd kemas terisi rd produk null
                        elseif($pro->userpenerima==NULL){
                            $to = [$user2,$rd2];
                            $cc = [$author,$perevisi,$request->cc1,$request->cc2,$request->cc2];
                            $message->to($to);
                            $message->cc($cc);
                        }
                        // user rd kemas null rd produk terisi
                        elseif($pro->userpenerima2==NULL){
                            $to = [$user1,$rd1,$rd2];
                            $cc = [$author,$perevisi,$request->cc1,$request->cc2,$request->cc2];
                            $message->to($to);
                            $message->cc($cc);
                        }
                    }elseif($pro->tujuankirim2==NULL && $pro->tujuankirim!=NULL){
                        if($pro->userpenerima!=NULL){
                            $to = [$user1,$rd1];
                            $cc = [$author,$perevisi,$request->cc1,$request->cc2,$request->cc2];
                            $message->to($to);
                            $message->cc($cc);
                        }else{
                            $to = $rd1;
                            $cc = [$author,$perevisi,$request->cc1,$request->cc2,$request->cc2];
                            $message->to($to);
                            $message->cc($cc);
                        }
                    }elseif($pro->tujuankirim2!=NULL && $pro->tujuankirim==NULL){
                        if($pro->userpenerima2!=NULL){
                            $to = [$user2,$rd2];
                            $cc = [$author,$perevisi,$request->cc1,$request->cc2,$request->cc2];
                            $message->to($to);
                            $message->cc($cc);
                        }else{
                            $to = $rd2;
                            $cc = [$author,$perevisi,$request->cc1,$request->cc2,$request->cc2];
                            $message->to($to);
                            $message->cc($cc);
                        }
                    }
                }
            });
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
                $pkp = FileProject::where('id_pictures',$row['pic'])->update([
                    "informasi" => $row['info']
                ]);
            }
        }
        return redirect::route('rekappkp',[$request->id,$request->pkp]);
    }

    public function uploadpkp($id_project){
        $id_pkp= PkpProject::where('id_project',$id_project)->first();
        $coba1 = FileProject::where('pkp_id',$id_pkp->id_pkp)->where('revisi','<=',$id_pkp->revisi)->where('turunan','<=',$id_pkp->turunan)->where('revisi_kemas','<=',$id_pkp->revisi_kemas)->count();
        $coba  = FileProject::where('pkp_id',$id_pkp->id_pkp)->where('revisi','<=',$id_pkp->revisi)->where('turunan','<=',$id_pkp->turunan)->where('revisi_kemas','<=',$id_pkp->revisi_kemas)->get();
        return view('pkp.datatambahanpkp')->with([
            'coba'   => $coba,
            'coba1'  => $coba1,
            'id_pkp' => $id_pkp
        ]);
    }

    public function uploaddatapkp(Request $request){
        $this->validate($request, [
            'filename'  => 'required',
            'filename.*'=> 'required|file|max:51200'
        ]);
        $files = [];
        foreach ($request->file('filename') as $file) {
        if ($file->isValid()) {
            $nama           = time();
            $nama_file      = time()."_".$file->getClientOriginalName();
            $tujuan_upload  = 'data_file';
            $path           = $file->move($tujuan_upload,$nama_file);
            $turunan        = $request->turunan;
            $revisi         = $request->revisi;
            $kemas          = $request->kemas;
            $form           = $request->id;
            $files[] = [
                'filename'     => $nama_file,
                'lokasi'       => $path,
                'pkp_id'       => $form,
                'turunan'      => $turunan,
                'revisi'       => $revisi,
                'revisi_kemas' => $kemas,
            ];
            }
        }
        FileProject::insert($files);
        return redirect()->back()->withSuccess(sprintf('%s file uploaded successfully.', count($files)));
    }
 
    public function destroydata($id_pictures){
        $data = FileProjectfind($id_pictures);
        $data->delete();
        return redirect::back()->with('status', 'Workbook ');
    }

    public function edit(Request $request, $id_project){
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
            Mail::send('manager.infoemailpkp', [
                'nama'   => $request->email,
                'app'    => $isipkp,
                'for'    => $for,
                'info'   => 'Anda Memiliki Project PKP Baru :)',
                'jangka' => $request->jangka,
                'waktu'  => $request->waktu,],function($message)use($request){
                    $message->subject('PKP '.$request->name);
                    //sent email to manager
                    $dept = DB::table('ms_departements')->where('id',$request->kirim)->get();
                    foreach($dept as $dept){
                        $user = DB::table('tr_users')->where('id',$dept->manager_id)->get();
                        foreach($user as $user){
                            $data = $user->email;
                            $cc   = [Auth::user()->email,'bagas@nutrifood.co.id'];
                            $message->to($data);
                            $message->cc($cc);
                        }
                    }
                    // CC Manager
                    if($request->rka==1){
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

    public function sentpkp(Request $request, $id_project){
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
            Mail::send('manager.infoemailpkp', [
                'nama'   => $request->email,
                'app'    => $isipkp,
                'for'    => $for,
                'info'   => 'Project Telah Selesai Di Revisi , dengan alasan revisi "'.$request->alasan.'"',
                'jangka' => $request->jangka,
                'waktu'  => $request->waktu,],function($message)use($request){
                    $message->subject('PKP '.$request->name);
                    //sent email to manager
                    $dept = DB::table('ms_departements')->where('id',$request->kirim)->get();
                    foreach($dept as $dept){
                        $user = DB::table('tr_users')->where('id',$dept->manager_id)->get();
                        foreach($user as $user){
                            $data = $user->email;
                            $penerima1      = $request->userpenerima;
                            $penerima2      = $request->userpenerima2;
                            $emailpenerima1 = DB::table('tr_users')->where('id',$request->userpenerima)->first();
                            $emailpenerima2 = DB::table('tr_users')->where('id',$request->userpenerima2)->first();
                            if($penerima1==NULL && $penerima2==NULL){
                                $cc = [Auth::user()->email,];
                            }if($penerima1!=NULL && $penerima2==NULL){
                                $cc = [Auth::user()->email,$emailpenerima1->email];
                            }if($penerima1!=NULL && $penerima2!=NULL){
                                $cc = [Auth::user()->email,$emailpenerima1->email,$emailpenerima2->email];
                            }
                            $message->to($data);
                            $message->cc($cc);
                        }
                    }
                    // CC Manager
                    if($request->rka==1){
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

    public function edituser(Request $request, $id_project){
        $edit = PkpProject::where('id_project',$id_project)->first();
        $edit->userpenerima  = $request->user;
        $edit->userpenerima2 = $request->user2;
        $edit->status_pkp    = 'proses';
        $edit->save();

        $for    = Forecast::where('id_project',$edit->id_project)->get();
        $isipkp = PkpProject::where('id_project',$id_project)->get();
        try{
            Mail::send('manager.infoemailpkp', [
                'nama'   => $request->email,
                'app'    => $isipkp,
                'for'    => $for,
                'info'   => 'Anda memiliki project PKP baru',
                'jangka' => $request->jangka,
                'waktu'  => $request->waktu,
            ],function($message)use($request){
                $message->subject('PROJECT PKP');
                //sent email to User
                if(Auth::user()->departement_id!=1){
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

    public function rekappkp($id_project,$id_pkp){
        $sample_project = Formula::where('workbook_id', $id_pkp)->orderBy('versi','asc')->get();
        $user           = user::where('status','=','active')->get();
        $cf             =Formula::where('workbook_id',$id_pkp)->count();
        $formula        = Formula::where('workbook_id',$id_pkp)->where('vv','!=','null')->orderBy('versi','asc')->get();
        $id             = PkpProject::where('id_project',$id_project)->first();
        $data           = PkpProject::where('id_project',$id_project)->where('id_pkp',$id_pkp)->where('status_project','active')->get();
        return view('pkp.daftarpkp')->with([
            'sample' => $sample_project,
            'user'    => $user,
            'formula' => $formula,
            'cf'      => $cf,
            'id'      => $id,
            'data'    => $data
        ]);
    }

    public function edittype(Request $request, $id_project){
        $type = PkpProject::where('id_project',$id_project)->first();
        $type->type=$request->type;
        $type->save();

        return redirect::back();
    }

    public function deletelaunch($id_project,$revisi,$turunan){
        $data= tipp::where('id_pkp',$id_project)->where('revisi',$revisi)->where('turunan',$turunan)->first();
        $data->launch = null;
        $data->years  = null;
        $data->save();
        
        return redirect::back();
    }

    public function pengajuan(){
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
}
