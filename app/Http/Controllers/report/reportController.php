<?php

namespace App\Http\Controllers\report;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

use App\model\master\Tarkon;
use App\model\master\Brand;
use App\model\pkp\Type;
use App\model\pkp\PkpProject;
use App\model\pkp\ProjectPDF;
use App\model\pkp\Notulen;
use App\model\pkp\DataKlaim;
use App\model\pkp\UOM;
use App\model\pkp\EditProject;
use App\model\pkp\Promo;
use App\model\pkp\Forecast;
use App\model\pkp\Allocation;
use App\model\pkp\DataSES;
use App\model\pkp\DataPromo;
use App\model\pkp\ParameterForm;
use App\model\pkp\SubPDF;
use App\model\pkp\SubPKP;
use App\model\manager\Pengajuan;
use Auth;
use Redirect;
use DB;
use Carbon\Carbon;

class ReportController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
        $this->middleware('rule:pv_global' || 'rule:pv_lokal' || 'rule:NR' || 'rule:marketing' || 'rule:manager' || 'rule:admin');
    }

    public function tabulasi(){
        $datapkp = SubPKP::where('status_project','!=','draf') ->join('tr_project_pkp','tr_project_pkp.id_project','=','tr_sub_pkp.id_pkp')->where('status_data','=','active')->orderBy('pkp_number','desc')->get();
        $datapdf = SubPDF::where('status_project','!=','draf') ->join('tr_pdf_project','tr_pdf_project.id_project_pdf','=','tr_sub_pdf.pdf_id')->where('status_pdf','=','active')->get();
        $datapromo = Promo::where('status_project','!=','draf') ->join('tr_promo','tr_project_promo.id_pkp_promo','=','tr_promo.id_pkp_promoo')->where('status_data','=','active')->get();
        return view('pv.tabulasi')->with([
            'datapkp' => $datapkp,
            'datapdf' => $datapdf,
            'datapromo' => $datapromo
        ]);
    }

    public function editpkpall(){
        $brand = Brand::all();
        $uom = UOM::all();
        $par2 = ParameterForm::where('user',Auth::user()->id)->limit('1')->get();
        $tarkon = Tarkon::all();
        $datapkp = PkpProject::where('status_project','!=','draf') ->join('tr_sub_pkp','tr_project_pkp.id_project','=','tr_sub_pkp.id_pkp')
            ->join('tr_edit','tr_edit.id_pkp','=','tr_project_pkp.id_project')
            ->join('tr_parameter_form','tr_parameter_form.id_pkp','tr_project_pkp.id_project')->where('id_user',Auth::user()->id)->where('status_data','=','active')->get();
        return view('pv.editpkpall')->with([
            'datapkp' => $datapkp,
            'brand' => $brand,
            'par2' => $par2,
            'uom' => $uom,
            'tarkon' => $tarkon
        ]) ;
    }

    public function reportnotulen(){
        $Npkp = Notulen::where('id_pkp','!=',NULL)->where('note','!=',NULL)->orderBy('created_at','desc')->get();
        $DNpkp = Notulen::join('tr_project_pkp','tr_notulen.id_pkp','tr_project_pkp.id_project')->orderBy('prioritas','asc')->select(['id_pkp'])->distinct()->get();
        $Npdf = Notulen::where('id_pdf','!=',NULL)->where('note','!=',NULL)->get();
        $DNpdf = Notulen::join('tr_pdf_project','tr_notulen.id_pdf','tr_pdf_project.id_project_pdf')->orderBy('prioritas','asc')->select(['id_pdf'])->distinct()->get();
        $Npromo = Notulen::where('id_promo','!=',NULL)->where('note','!=',NULL)->get();
        $DNpromo = Notulen::join('tr_project_promo','tr_notulen.id_promo','tr_project_promo.id_pkp_promo')->orderBy('prioritas','asc')->select(['id_promo'])->distinct()->get();
        return view('pkp.reportnotulen')->with([
            'DNpdf' => $DNpdf,
            'Npdf' => $Npdf,
            'DNpromo' => $DNpromo,
            'Npromo' => $Npromo,
            'DNpkp' => $DNpkp,
            'Npkp' => $Npkp
        ]);
    }

    public function hapuscheck(){
        $check = EditProject::where('id_pkp','!=','NULL')->where('id_user',Auth::user()->id)->delete();
        $check = ParameterForm::where('user',Auth::user()->id)->delete();
        return redirect::route('tabulasi');
    }

    public function hapuscheckpdf(){
        $check = EditProject::where('id_pdf','!=','NULL')->where('id_user',Auth::user()->id)->delete();
        $check = ParameterForm::where('user',Auth::user()->id)->delete();
        return redirect::route('tabulasi');
    }

    public function hapuscheckpromo(){
        $check = EditProject::where('id_promo','!=','NULL')->where('id_user',Auth::user()->id)->delete();
        $check = ParameterForm::where('user',Auth::user()->id)->delete();
        return redirect::route('tabulasi');
    }

    public function editpdfall(){
        $type= Type::all();
        $brand = Brand::all();
        $par = ParameterForm::where('user',Auth::user()->id)->limit('1')->get();
        $datapdf = ProjectPDF::where('status_project','!=','draf') ->join('tr_sub_pdf','tr_pdf_project.id_project_pdf','=','tr_sub_pdf.pdf_id')
            ->join('tr_edit','tr_edit.id_pdf','=','tr_pdf_project.id_project_pdf')
            ->join('tr_parameter_form','tr_parameter_form.id_pdf','tr_pdf_project.id_project_pdf')->where('id_user',Auth::user()->id)->where('status_pdf','=','active')->get();
        $datapdf1 = ProjectPDF::where('status_project','!=','draf') ->join('tr_sub_pdf','tr_pdf_project.id_project_pdf','=','tr_sub_pdf.pdf_id')
            ->join('tr_edit','tr_edit.id_pdf','=','tr_pdf_project.id_project_pdf')
            ->join('tr_parameter_form','tr_parameter_form.id_pdf','tr_pdf_project.id_project_pdf')->where('id_user',Auth::user()->id)->where('status_pdf','=','active')->get();
        return view('pv.editpdfall')->with([
            'datapdf' => $datapdf,
            'brand' => $brand,
            'datapdf1' => $datapdf1,
            'type' => $type,
            'par' => $par
        ]) ;
    }

    public function editpromoall(){
        $brand = Brand::all();
        $par = ParameterForm::where('user',Auth::user()->id)->limit('1')->get();
        $datapromo = Promo::where('status_project','!=','draf') ->join('tr_promo','tr_project_promo.id_pkp_promo','=','tr_promo.id_pkp_promoo')
            ->join('tr_edit','tr_edit.id_promo','=','tr_project_promo.id_pkp_promo')->where('id_user',Auth::user()->id)
            ->join('tr_parameter_form','tr_parameter_form.id_promo','tr_project_promo.tr_project_promo')->where('status_data','=','active')->get();
        return view('pv.editpromo')->with([
            'datapromo' => $datapromo,
            'brand' => $brand,
            'par' => $par
        ]) ;
    }

    public function update_pkp(Request $request) {
        $scores = $request->input('scores');
        foreach($scores as $row){
            $tambah = new SubPKP;
            $tambah->id_pkp=$row['id_pkp'];
            $tambah->turunan=$row['turun'];
            $tambah->revisi=$row['revisi'];
            $tambah->idea=$row['idea'];
            $tambah->gender=$row['gender'];
            $tambah->dariumur=$row['dariumur'];
            $tambah->sampaiumur=$row['sampaiumur'];
            $tambah->Uniqueness=$row['uniq'];
            $tambah->reason=$row['reason'];
            $tambah->Estimated=$row['estimated'];
            $tambah->launch=$row['launch'];
            $tambah->years=$row['years'];
            $tambah->tgl_launch=$row['tgl'];
            $tambah->competitive=$row['competitive'];
            $tambah->competitor=$row['competitor'];
            $tambah->aisle=$row['aisle'];
            $tambah->product_form=$row['form'];
            $tambah->bpom=$row['bpom'];
            $tambah->kategori_bpom=$row['katbpom'];
            $tambah->olahan=$row['olahan'];
            $tambah->akg=$row['tarkon'];
            $tambah->primer=$row['primer'];
            $tambah->primery=$row['primary'];
            $tambah->secondary=$row['secondary'];
            $tambah->tertiary=$row['tertiary'];
            $tambah->prefered_flavour=$row['prefered'];
            $tambah->product_benefits=$row['benefits'];
            $tambah->mandatory_ingredient=$row['ingredient'];
            $tambah->status_pkp=$row['data'];
            $tambah->save();

            $turunan = SubPKP::where('id_pkp',$row['id_pkp'])->where('turunan',$row['turun'])->where('revisi',$row['rev'])->update([
                "status_data" => $row['status']
            ]);

            foreach($scores as $row){
                $pkp = PkpProject::where('id_project',$row['id_pkp'])->update([
                    "project_name" => $row['name'],
                    "id_brand" => $row['brand'],
                    "ket_no" => $row['ket'],
                    "note" => $row['note'],
                    "type" => $row['type']
                ]);

                $data=DataSES::where('id_pkp',$row['id_pkp'])->where('turunan',$row['turun'])->where('revisi',$row['rev'])->count();
                if($data>0){
                    $data=DataSES::where('id_pkp',$row['id_pkp'])->where('turunan',$row['turun'])->where('revisi',$row['rev'])->get();
                    foreach ($data as $data){
                        $ses= new DataSES;
                        $ses->id_pkp=$data->id_pkp;
                        $ses->revisi=$tambah->revisi;
                        $ses->turunan=$data->turunan;
                        $ses->ses=$data->ses;
                        $ses->save();
                    }
                }

                $for=Forecast::where('id_pkp',$row['id_pkp'])->where('turunan',$row['turun'])->where('revisi',$row['rev'])->count();
                if($for>0){
                    $data=Forecast::where('id_pkp',$row['id_pkp'])->where('turunan',$row['turun'])->where('revisi',$row['rev'])->get();
                    foreach ($data as $data){
                        $forecast= new Forecast;
                        $forecast->id_pkp=$data->id_pkp;
                        $forecast->revisi=$tambah->revisi;
                        $forecast->turunan=$data->turunan;
                        $forecast->forecast=$data->forecast;
                        $forecast->satuan=$data->satuan;
                        $forecast->save();
                    }
                }

                $kl=DataKlaim::where('id_pkp',$row['id_pkp'])->where('turunan',$row['turun'])->where('revisi',$row['rev'])->count();
                if($kl>0){
                    $data=DataKlaim::where('id_pkp',$row['id_pkp'])->where('turunan',$row['turun'])->where('revisi',$row['rev'])->get();
                    foreach ($data as $data){
                        $klaim= new DataKlaim;
                        $klaim->id_pkp=$data->id_pkp;
                        $klaim->revisi=$tambah->revisi;
                        $klaim->turunan=$data->turunan;
                        $klaim->id_komponen=$data->id_komponen;
                        $klaim->komponen=$data->komponen;
                        $klaim->id_klaim=$data->id_klaim;
                        $klaim->note=$data->note;
                        $klaim->save();
                    }
                }

                $ddk=DetailKlaim::where('id_pkp',$row['id_pkp'])->where('turunan',$row['turun'])->where('revisi',$row['rev'])->count();
                if($ddk>0){
                    $data=DetailKlaim::where('id_pkp',$row['id_pkp'])->where('turunan',$row['turun'])->where('revisi',$row['rev'])->get();
                    foreach ($data as $data){
                        $detail= new DetailKlaim;
                        $detail->id_pkp=$data->id_pkp;
                        $detail->revisi=$tambah->revisi;
                        $detail->turunan=$data->turunan;
                        $detail->id_detail=$data->id_detail;
                        $detail->id_klaim=$data->id_klaim;
                        $detail->save();
                    }
                }
            }
        }
        return redirect::back()->with('status', 'Revised data ');
    }

    public function update_pdf(Request $request){
        $data1 = $request->input('datapdf');
        foreach($data1 as $row){
            $tambah = new SubPDF;
            $tambah->pdf_id = $row['id_pdf'];
            $tambah->primer=$row['primer'];
            $tambah->primery=$row['primary'];
            $tambah->secondery=$row['secondary'];
            $tambah->Tertiary=$row['tertiary'];
            $tambah->kemas_eksis=$row['eksis'];
            $tambah->dariusia= $row['dariusia'];
            $tambah->sampaiusia= $row['sampaiusia'];
            $tambah->gender= $row['gender'];
            $tambah->other= $row['other'];
            $tambah->wight= $row['wight'];
            $tambah->serving= $row['serving'];
            $tambah->target_price= $row['target'];
            $tambah->claim= $row['claim'];
            $tambah->ingredient= $row['ingredient'];
            $tambah->background= $row['background'];
            $tambah->attractiveness= $row['attractive'];
            $tambah->rto= $row['rto'];
            $tambah->name= $row['name2'];
            $tambah->retailer_price= $row['retailer'];
            $tambah->special= $row['special'];
            $tambah->turunan=$row['turun'];
            $tambah->revisi=$row['rev'];
            $tambah->status_data='sent';
            $tambah->save();

            $turunan = SubPDF::where('pdf_id',$row['id_pdf'])->where('turunan',$row['turun'])->where('revisi',$row['revisi'])->update([
                "status_pdf" => $row['status']
            ]);

            foreach($data1 as $row){
                $pdf = ProjectPDF::where('id_project_pdf',$row['id_pdf'])->update([
                    "project_name" => $row['name'],
                    "id_brand" => $row['brand'],
                    "country" => $row['country'],
                    "ket_no" =>$row['ket'],
                    "reference" => $row['reference'],
                    "id_type" => $row['type']
                ]);

                $data=DataSES::where('id_pdf',$row['id_pdf'])->where('turunan',$row['turun'])->where('revisi',$row['rev'])->count();
                if($data>0){
                    $data=DataSES::where('id_pdf',$row['id_pdf'])->where('turunan',$row['turun'])->where('revisi',$row['rev'])->get();
                    foreach ($data as $data){
                        $ses= new DataSES;
                        $ses->id_pdf=$data->id_pdf;
                        $ses->revisi=$tambah->revisi;
                        $ses->turunan=$data->turunan;
                        $ses->ses=$data->ses;
                        $ses->save();
                    }
                }

                $for=Forecast::where('id_pdf',$row['id_pdf'])->where('turunan',$row['turun'])->where('revisi',$row['rev'])->count();
                if($for>0){
                    $data=Forecast::where('id_pdf',$row['id_pdf'])->where('turunan',$row['turun'])->where('revisi',$row['rev'])->get();
                    foreach ($data as $data){
                        $forecast= new Forecast;
                        $forecast->id_pdf=$data->id_pdf;
                        $forecast->revisi=$tambah->revisi;
                        $forecast->turunan=$data->turunan;
                        $forecast->forecast=$data->forecast;
                        $forecast->satuan=$data->satuan;
                        $forecast->save();
                    }
                }
            }
        }
        return redirect::back()->with('status', 'Revised data ');
    }

    public function update_promo(Request $request){
        $data1 = $request->input('datapromo');
        foreach($data1 as $row){
            $tambah = new DataPromo;
            $tambah->id_pkp_promoo = $row['id_promo'];
            $tambah->promo_idea = $row['idea'];
            $tambah->dimension = $row['dimension'];
            $tambah->application = $row['app'];
            $tambah->revisi = $row['rev'];
            $tambah->turunan = $row['turun'];
            $tambah->promo_readiness = $row['readines'];
            $tambah->rto = $row['rto'];
            $tambah->gambaran_proses = $row['gambaran_proses'];
            $tambah->save();

            $turunan = DataPromo::where('id_pkp_promoo',$row['id_promo'])->where('turunan',$row['turun'])->where('revisi',$row['revisi'])->update([
                "status_data" => 'inactive'
            ]);

            foreach($data1 as $row){
                $pdf = Promo::where('id_pkp_promo',$row['id_promo'])->update([
                    "project_name" => $row['name'],
                    "brand" => $row['brand'],
                    "ket_no" => $row['ket'],
                    "promo_type" => $row['promotype'],
                    "country" => $row['country'],
                    "type" => $row['type']
                ]);

                $for=Allocation::where('id_pkp_promo',$row['id_promo'])->where('turunan',$row['turun'])->where('revisi',$row['revisi'])->count();
                if($for>0){
                    $data=Allocation::where('id_pkp_promo',$row['id_promo'])->where('turunan',$row['turun'])->where('revisi',$row['revisi'])->get();
                    foreach ($data as $data){
                        $all= new Allocation;
                        $all->id_pkp_promo=$data->id_pkp_promo;
                        $all->product_sku=$data->product_sku;
                        $all->allocation=$data->allocation;
                        $all->remarks=$data->remarks;
                        $all->start=$data->start;
                        $all->end=$data->end;
                        $all->rto=$data->rto;
                        $all->opsi=$data->opsi;
                        $all->revisi=$tambah->revisi;
                        $all->turunan=$data->turunan;
                        $all->save();
                    }
                }
            }
        }
        return redirect::back()->with('status', 'Revised data ');
    }

    public function checkpkp(Request $request){
        $rules = array();
        if($request->datapkpp!=''){
            $validator = Validator::make($request->all(), $rules);
            if ($validator->passes()) {
                $idz = implode(",", $request->input('datapkpp'));
                $ids = explode(",", $idz);
                for ($i = 0; $i < count($ids); $i++){
                    $pipeline = new EditProject;
                    $pipeline->id_user=Auth::user()->id;
                    $pipeline->id_pkp = $ids[$i];
                    $pipeline->save();
                    $i = $i++;

                }
            }

            $form=EditProject::where('id_user',$pipeline->id_user)->count();
            if($form>0){
                $data=EditProject::where('id_user',$pipeline->id_user)->get();
                foreach ($data as $data){
                    $par= new ParameterForm;
                    $par->id_pkp=$data->id_pkp;
                    $par->user=$request->user;
                    $par->form1=$request->par1;
                    $par->form2=$request->par2;
                    $par->form3=$request->par3;
                    $par->form4=$request->par4;
                    $par->form5=$request->par5;
                    $par->form6=$request->par6;
                    $par->form7=$request->par7;
                    $par->form8=$request->par8;
                    $par->form9=$request->par9;
                    $par->form10=$request->par10;
                    $par->form11=$request->par11;
                    $par->form12=$request->par12;
                    $par->form13=$request->par13;
                    $par->form14=$request->par14;
                    $par->form15=$request->par15;
                    $par->form16=$request->par16;
                    $par->form17=$request->par17;
                    $par->form18=$request->par18;
                    $par->form19=$request->par19;
                    $par->form20=$request->par20;
                    $par->save();
                }
            }
        }
        return redirect::Route('editpkpall');
    }

    public function checkpdf(Request $request){
        $rules = array();
        if($request->datapdf!=''){
            $validator = Validator::make($request->all(), $rules);
            if ($validator->passes()) {
                $idz = implode(",", $request->input('datapdf'));
                $ids = explode(",", $idz);
                for ($i = 0; $i < count($ids); $i++){
                    $pipeline = new EditProject;
                    $pipeline->id_user=Auth::user()->id;
                    $pipeline->id_pdf = $ids[$i];
                    $pipeline->save();
                    $i = $i++;
                }
            }

            $form=EditProject::where('id_user',$pipeline->id_user)->count();
            if($form>0){
                $data=EditProject::where('id_user',$pipeline->id_user)->get();
                foreach ($data as $data){
                    $par= new ParameterForm;
                    $par->id_pdf=$data->id_pdf;
                    $par->user=$request->user;
                    $par->form1=$request->par1;
                    $par->form2=$request->par2;
                    $par->form3=$request->par3;
                    $par->form4=$request->par4;
                    $par->form5=$request->par5;
                    $par->form6=$request->par6;
                    $par->form7=$request->par7;
                    $par->form8=$request->par8;
                    $par->form9=$request->par9;
                    $par->form10=$request->par10;
                    $par->form11=$request->par11;
                    $par->form12=$request->par12;
                    $par->form13=$request->par13;
                    $par->form14=$request->par14;
                    $par->form15=$request->par15;
                    $par->form16=$request->par16;
                    $par->form17=$request->par17;
                    $par->form18=$request->par18;
                    $par->form19=$request->par19;
                    $par->save();
                }
            }
        }
        return redirect::Route('editpdfall');
    }

    public function checkpromo(Request $request){
        if($request->datapromo!=''){
            $rules = array();

            $validator = Validator::make($request->all(), $rules);
            if ($validator->passes()) {
                $idz = implode(",", $request->input('datapromo'));
                $ids = explode(",", $idz);
                for ($i = 0; $i < count($ids); $i++){
                    $pipeline = new EditProject;
                    $pipeline->id_user=Auth::user()->id;
                    $pipeline->id_promo = $ids[$i];
                    $pipeline->save();
                    $i = $i++;

                }
            }

            $form=EditProject::where('id_user',$pipeline->id_user)->count();
            if($form>0){
                $data=EditProject::where('id_user',$pipeline->id_user)->get();
                foreach ($data as $data){
                    $par= new ParameterForm;
                    $par->id_promo=$data->id_promo;
                    $par->user=$request->user;
                    $par->form1=$request->par1;
                    $par->form2=$request->par2;
                    $par->form3=$request->par3;
                    $par->form4=$request->par4;
                    $par->form5=$request->par5;
                    $par->form6=$request->par6;
                    $par->form7=$request->par7;
                    $par->form8=$request->par8;
                    $par->form9=$request->par9;
                    $par->form10=$request->par10;
                    $par->save();
                }
            }
        }
        return redirect::Route('editpromoall');
    }

    public function deletepdf1($id_project_pdf){
        $pdf = EditProject::where('id_pdf',$id_project_pdf)->first();
        $pdf->delete();
        return redirect::back();
    }

    public function deletepkp1($id_project){
        $promo = EditProject::where('id_pkp',$id_project)->first();
        $promo->delete();
        return redirect::back();
    }

    public function deletepromo1($id_pkp_promo){
        $promo = EditProject::where('id_promo',$id_pkp_promo)->first();
        $promo->delete();
        return redirect::back();
    }

    public function notulenpdf(){
        $type= Type::all();
        $brand = Brand::all();
        $datapdf = ProjectPDF::where('status_project','!=','draf') ->join('tr_sub_pdf','tr_pdf_project.id_project_pdf','=','tr_sub_pdf.pdf_id')->where('status_pdf','=','active')->get();
        return view('pdf.notulenpdf')->with([
            'datapdf' => $datapdf,
            'brand' => $brand,
            'type' => $type
        ]) ;
    }

    public function notulenpkp(){
        $brand = Brand::all();
        $datapkp = SubPKP::where('status_project','!=','draf') ->join('tr_project_pkp','tr_project_pkp.id_project','=','tr_sub_pkp.id_pkp')->where('status_data','=','active')->get();
        return view('pkp.notulen')->with([
            'datapkp' => $datapkp,
            'brand' => $brand
        ]) ;
    }

    public function notulenpkpp(Request $request){
        $note = $request->input('note');
        foreach($note as $note){
            if($note!='null'){
                $not = new Notulen;
                $not->id_pkp=$note['pkp'];
                $not->note=$note['note'];
                $not->created_date=$note['date'];
                $not->user=Auth::user()->id;
                $not->save();

                $pkp = PkpProject::where('id_project',$note['pkp'])->update([
                    "prioritas" => $note['prioritas']
                ]);
            }
        }
        return redirect::back()->with('status', 'Saved data ');
    }

    public function indexnotulenpromo(){
        $brand = Brand::all();
        $par = ParameterForm::where('user',Auth::user()->id)->limit('1')->get();
        $datapromo = Promo::where('status_project','!=','draf') ->join('tr_promo','tr_project_promo.id_pkp_promo','=','tr_promo.id_pkp_promoo')->where('status_data','=','active')->get();
        return view('promo.notulenpromo')->with([
            'datapromo' => $datapromo,
            'brand' => $brand,
            'par' => $par
        ]) ;
    }

    public function notulenpdff(Request $request){
        $note = $request->input('note');
        foreach($note as $note){
            if($note!='null'){
                $not = new Notulen;
                $not->id_pdf=$note['pdf'];
                $not->note=$note['note'];
                $not->created_date=$note['date'];
                $not->user=Auth::user()->id;
                $not->save();
            }

            $pdf = ProjectPDF::where('id_project_pdf',$note['pdf'])->update([
                "prioritas" => $note['prioritas']
            ]);
        }
        return redirect::back()->with('status', 'Saved data ');
    }

    public function notulenpromoo(Request $request){
        $note = $request->input('note');
        foreach($note as $note){
            if($note!='null'){
                $not = new Notulen;
                $not->id_promo=$note['promo'];
                $not->note=$note['note'];
                $not->created_date=$note['date'];
                $not->user=Auth::user()->id;
                $not->save();
            }

            $promo = Promo::where('id_pkp_promo',$note['promo'])->update([
                "prioritas" => $note['prioritas']
            ]);
        }
        return redirect::back()->with('status', 'Saved data ');
    }

    public function editnote(Request $request){
        $note = $request->input('pkp');
        foreach($note as $pkp){
            $npkp = Notulen::where('id_notulen',$pkp['id_pkp'])->update([
                "note" => $pkp['note'],
                "user" => Auth::user()->id
            ]);
        }
        return redirect::back()->with('status', 'Saved data ');
    }

    public function data(){
        $hilo1 = PkpProject::where('id_brand','=','Hilo')->count();$hilo2 = ProjectPDF::where('id_brand','=','Hilo')->count();$hhilo = $hilo1 + $hilo2;
        $lmen1 = PkpProject::where('id_brand','=','L-Men')->count();$lmen2 = ProjectPDF::where('id_brand','=','L-Men')->count();$hlmen = $lmen1 + $lmen2;
        $nr1 = PkpProject::where('id_brand','=','Nutrisari')->count();$nr2 = ProjectPDF::where('id_brand','=','Nutrisari')->count();$hnr = $nr1 + $nr2;
        $ts1 = PkpProject::where('id_brand','=','Tropicana Slim')->count();$ts2 = ProjectPDF::where('id_brand','=','Tropicana Slim')->count();$hts = $ts1 + $ts2;
        $ekspor1 = PkpProject::where('id_brand','=','Ekspor')->count();$ekspor2 = ProjectPDF::where('id_brand','=','Ekspor')->count();$hekspor = $ekspor1 + $ekspor2;
        
        $dhilo1 = PkpProject::where('id_brand','=','Hilo')->join('tr_sub_pkp','tr_sub_pkp.id_pkp','=','tr_project_pkp.id_project')->where('status_data','=','active')->get();$dhilo2 = ProjectPDF::where('id_brand','=','Hilo')->join('tr_sub_pdf','tr_sub_pdf.pdf_id','=','tr_pdf_project.id_project_pdf')->where('status_pdf','=','active')->get();
        $dlmen1 = PkpProject::where('id_brand','=','L-Men')->join('tr_sub_pkp','tr_sub_pkp.id_pkp','=','tr_project_pkp.id_project')->where('status_data','=','active')->get();$dlmen2 = ProjectPDF::where('id_brand','=','L-Men')->join('tr_sub_pdf','tr_sub_pdf.pdf_id','=','tr_pdf_project.id_project_pdf')->where('status_pdf','=','active')->get();
        $dnr1 = PkpProject::where('id_brand','=','Nutrisari')->join('tr_sub_pkp','tr_sub_pkp.id_pkp','=','tr_project_pkp.id_project')->where('status_data','=','active')->get();$dnr2 = ProjectPDF::where('id_brand','=','Nutrisari')->join('tr_sub_pdf','tr_sub_pdf.pdf_id','=','tr_pdf_project.id_project_pdf')->where('status_pdf','=','active')->get();
        $dts1 = PkpProject::where('id_brand','=','Tropicana Slim')->join('tr_sub_pkp','tr_sub_pkp.id_pkp','=','tr_project_pkp.id_project')->where('status_data','=','active')->get();$dts2 = ProjectPDF::where('id_brand','=','Tropicana Slim')->join('tr_sub_pdf','tr_sub_pdf.pdf_id','=','tr_pdf_project.id_project_pdf')->where('status_pdf','=','active')->get();
        $dekspor1 = PkpProject::where('id_brand','=','Ekspor')->join('tr_sub_pkp','tr_sub_pkp.id_pkp','=','tr_project_pkp.id_project')->where('status_data','=','active')->get();$dekspor2 = ProjectPDF::where('id_brand','=','Ekspor')->join('tr_sub_pdf','tr_sub_pdf.pdf_id','=','tr_pdf_project.id_project_pdf')->where('status_pdf','=','active')->get();
        return view('pv.data')->with([
            'hhilo' => $hhilo,
            'hlmen' => $hlmen,'hnr' => $hnr,
            'hts' => $hts,'hekspor' => $hekspor,
            'dhilo1' => $dhilo1,'dhilo2' => $dhilo2,
            'dlmen1' => $dlmen1,'dlmen2' => $dlmen2,
            'dnr1' => $dnr1,'dnr2' => $dnr2,
            'dts1' => $dts1,'dts2' =>$dts2,
            'dekspor1' => $dekspor1,'dekspor2' => $dekspor2,
        ]);
    }

    public function pengajuan(){
        $pengajuanpdf = Pengajuan::where('id_pdf','!=','')->get();
        $pengajuanpkp = Pengajuan::where('id_pkp','!=','')->get();
        $pengajuanpromo = Pengajuan::where('id_promo','!=','')->get();
        $pengajuan = Pengajuan::count();
        return view('pv.datapengajuan')->with([
            'pengajuanpdf' => $pengajuanpdf,
            'pengajuanpkp' => $pengajuanpkp,
            'pengajuan' => $pengajuan,
            'pengajuanpromo' => $pengajuanpromo
        ]);
    }
}