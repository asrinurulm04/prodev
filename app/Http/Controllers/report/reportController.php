<?php

namespace App\Http\Controllers\report;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

use App\model\pkp\Type;
use App\model\pkp\PkpProject;
use App\model\pkp\notulen;
use App\model\pkp\DataKlaim;
use App\model\pkp\uom;
use App\model\pkp\EditProject;
use App\model\pkp\promo;
use App\model\pkp\Forecast;
use App\model\pkp\NoteForecast;
use App\model\pkp\Allocation;
use App\model\pkp\DataSES;
use App\model\pkp\DataPromo;
use App\model\pkp\ParameterForm;
use App\model\pdf\SubPDF;
use App\model\pdf\ProjectPDF;
use App\model\master\Tarkon;
use App\model\master\Brand;
use App\model\manager\pengajuan;
use Auth;
use Redirect;
use DB;
use Carbon\Carbon;

class reportController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
        $this->middleware('rule:pv_global' || 'rule:pv_lokal' || 'rule:NR' || 'rule:marketing' || 'rule:manager' || 'rule:admin');
    }

    public function tabulasi(){
        $datapkp    = PkpProject::where('status_project','=','active')->where('status_pkp','!=','draf')->where('status_pkp','!=','drop')->orderBy('prioritas','asc')->get();
        $datapdf    = SubPDF::where('status_project','!=','draf') ->join('tr_pdf_project','tr_pdf_project.id_project_pdf','=','tr_sub_pdf.pdf_id')->where('status_pdf','=','active')->get();
        $datapromo  = promo::where('status_project','!=','draf') ->join('tr_promo','tr_project_promo.id_pkp_promo','=','tr_promo.id_pkp_promoo')->where('status_data','=','active')->get();
        $for        = Forecast::all();
        return view('pv.tabulasi')->with([
            'datapkp'   => $datapkp,
            'for'       => $for,
            'datapdf'   => $datapdf,
            'datapromo' => $datapromo
        ]);
    }

    public function editpkpall(){
        $brand   = Brand::all();
        $uom     = uom::all();
        $par2    = ParameterForm::where('user',Auth::user()->id)->limit('1')->get();
        $tarkon  = Tarkon::all();
        $datapkp = PkpProject::where('status_project','!=','draf')->join('tr_edit','tr_edit.id_pkp','=','tr_project_pkp.id_project')
                ->join('tr_parameter_form','tr_parameter_form.id_pkp','tr_project_pkp.id_project')->where('id_user',Auth::user()->id)->where('status_project','=','active')->get();
        return view('pv.editpkpall')->with([
            'datapkp' => $datapkp,
            'brand'   => $brand,
            'par2'    => $par2,
            'uom'     => $uom,
            'tarkon'  => $tarkon
        ]) ;
    }

    public function reportnotulen(){
        $jan       = notulen::where('bulan','January')->where('note_pv_marketing','!=',NULL)->count();
        $feb       = notulen::where('bulan','February')->where('note_pv_marketing','!=',NULL)->count();
        $mar       = notulen::where('bulan','March')->where('note_pv_marketing','!=',NULL)->count();
        $apr       = notulen::where('bulan','April')->where('note_pv_marketing','!=',NULL)->count();
        $may       = notulen::where('bulan','May')->where('note_pv_marketing','!=',NULL)->count();
        $jun       = notulen::where('bulan','June')->where('note_pv_marketing','!=',NULL)->count();
        $jul       = notulen::where('bulan','july')->where('note_pv_marketing','!=',NULL)->count();
        $aug       = notulen::where('bulan','August')->where('note_pv_marketing','!=',NULL)->count();
        $sep       = notulen::where('bulan','September')->where('note_pv_marketing','!=',NULL)->count();
        $oct       = notulen::where('bulan','October')->where('note_pv_marketing','!=',NULL)->count();
        $nov       = notulen::where('bulan','November')->where('note_pv_marketing','!=',NULL)->count();
        $des       = notulen::where('bulan','December')->where('note_pv_marketing','!=',NULL)->count();

        $jan2      = notulen::where('bulan','January')->where('note_rd_pv','!=',NULL)->count();
        $feb2      = notulen::where('bulan','February')->where('note_rd_pv','!=',NULL)->count();
        $mar2      = notulen::where('bulan','March')->where('note_rd_pv','!=',NULL)->count();
        $apr2      = notulen::where('bulan','April')->where('note_rd_pv','!=',NULL)->count();
        $may2      = notulen::where('bulan','May')->where('note_rd_pv','!=',NULL)->count();
        $jun2      = notulen::where('bulan','June')->where('note_rd_pv','!=',NULL)->count();
        $jul2      = notulen::where('bulan','july')->where('note_rd_pv','!=',NULL)->count();
        $aug2      = notulen::where('bulan','August')->where('note_rd_pv','!=',NULL)->count();
        $sep2      = notulen::where('bulan','September')->where('note_rd_pv','!=',NULL)->count();
        $oct2      = notulen::where('bulan','October')->where('note_rd_pv','!=',NULL)->count();
        $nov2      = notulen::where('bulan','November')->where('note_rd_pv','!=',NULL)->count();
        $des2      = notulen::where('bulan','December')->where('note_rd_pv','!=',NULL)->count();
        $not       = notulen::select('tahun')->distinct()->get();
        $Npkp      = notulen::orderBy('created','desc')->get();
        $NForecast =NoteForecast::all();
        $DNpkp     = PkpProject::where('status_pkp','sent')->orwhere('status_pkp','proses')->orwhere('status_pkp','revisi')->where('status_project','=','active')->orderBy('pkp_number','asc')->get();
        $Npdf      = notulen::where('id_pdf','!=',NULL)->where('note_rd_pv','!=',NULL)->get();
        $DNpdf     = notulen::join('tr_pdf_project','tr_notulen.id_pdf','tr_pdf_project.id_project_pdf')->select(['id_pdf'])->distinct()->get();
        $Npromo    = notulen::where('id_promo','!=',NULL)->where('note_rd_pv','!=',NULL)->get();
        $DNpromo   = notulen::join('tr_project_promo','tr_notulen.id_promo','tr_project_promo.id_pkp_promo')->select(['id_promo'])->distinct()->get();
        return view('pkp.reportnotulen')->with([
            'DNpdf'     => $DNpdf,
            'Npdf'      => $Npdf,
            'DNpromo'   => $DNpromo,
            'Npromo'    => $Npromo,
            'NForecast' => $NForecast,
            'not'       => $not,
            'jan'       => $jan,        'feb'   => $feb,
            'mar'       => $mar,        'apr'   => $apr,
            'may'       => $may,        'jun'   => $jun,
            'jul'       => $jul,        'aug'   => $aug,
            'sep'       => $sep,        'oct'   => $oct,
            'nov'       => $nov,        'des'   => $des,
            'jan2'      => $jan2,       'feb2'  => $feb2,
            'mar2'      => $mar2,       'apr2'  => $apr2,
            'may2'      => $may2,       'jun2'  => $jun2,
            'jul2'      => $jul2,       'aug2'  => $aug2,
            'sep2'      => $sep2,       'oct2'  => $oct2,
            'nov2'      => $nov2,       'des2'  => $des2,
            'DNpkp'     => $DNpkp,      'Npkp'  => $Npkp
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
        $type     = Type::all();
        $brand    = Brand::all();
        $par      = ParameterForm::where('user',Auth::user()->id)->limit('1')->get();
        $datapdf  = ProjectPDF::where('status_project','!=','draf') ->join('tr_sub_pdf','tr_pdf_project.id_project_pdf','=','tr_sub_pdf.pdf_id')
                ->join('tr_edit','tr_edit.id_pdf','=','tr_pdf_project.id_project_pdf')
                ->join('tr_parameter_form','tr_parameter_form.id_pdf','tr_pdf_project.id_project_pdf')->where('id_user',Auth::user()->id)->where('status_pdf','=','active')->get();
        $datapdf1 = ProjectPDF::where('status_project','!=','draf') ->join('tr_sub_pdf','tr_pdf_project.id_project_pdf','=','tr_sub_pdf.pdf_id')
                ->join('tr_edit','tr_edit.id_pdf','=','tr_pdf_project.id_project_pdf')
                ->join('tr_parameter_form','tr_parameter_form.id_pdf','tr_pdf_project.id_project_pdf')->where('id_user',Auth::user()->id)->where('status_pdf','=','active')->get();
        return view('pv.editpdfall')->with([
            'datapdf'   => $datapdf,
            'brand'     => $brand,
            'datapdf1'  => $datapdf1,
            'type'      => $type,
            'par'       => $par
        ]) ;
    }

    public function editpromoall(){
        $brand     = Brand::all();
        $par       = ParameterForm::where('user',Auth::user()->id)->limit('1')->get();
        $datapromo = promo::where('status_project','!=','draf') ->join('tr_promo','tr_project_promo.id_pkp_promo','=','tr_promo.id_pkp_promoo')
                ->join('tr_edit','tr_edit.id_promo','=','tr_project_promo.id_pkp_promo')->where('id_user',Auth::user()->id)
                ->join('tr_parameter_form','tr_parameter_form.id_promo','tr_project_promo.tr_project_promo')->where('status_data','=','active')->get();
        return view('pv.editpromo')->with([
            'datapromo' => $datapromo,
            'brand'     => $brand,
            'par'       => $par
        ]) ;
    }

    public function update_pkp(Request $request) {
        $scores = $request->input('scores');
        foreach($scores as $row){
            $tambah = new PkpProject;
            $tambah->id_pkp               = $row['id_pkp'];
            $tambah->turunan              = $row['turun'];
            $tambah->revisi               = $row['revisi'];
            $tambah->idea                 = $row['idea'];
            $tambah->gender               = $row['gender'];
            $tambah->dariumur             = $row['dariumur'];
            $tambah->sampaiumur           = $row['sampaiumur'];
            $tambah->Uniqueness           = $row['uniq'];
            $tambah->reason               = $row['reason'];
            $tambah->Estimated            = $row['estimated'];
            $tambah->launch               = $row['launch'];
            $tambah->years                = $row['years'];
            $tambah->competitive          = $row['competitive'];
            $tambah->competitor           = $row['competitor'];
            $tambah->aisle                = $row['aisle'];
            $tambah->product_form         = $row['form'];
            $tambah->bpom                 = $row['bpom'];
            $tambah->kategori_bpom        = $row['katbpom'];
            $tambah->olahan               = $row['olahan'];
            $tambah->akg                  = $row['tarkon'];
            $tambah->primer               = $row['primer'];
            $tambah->primery              = $row['primary'];
            $tambah->secondary            = $row['secondary'];
            $tambah->tertiary             = $row['tertiary'];
            $tambah->prefered_flavour     = $row['prefered'];
            $tambah->product_benefits     = $row['benefits'];
            $tambah->mandatory_ingredient = $row['ingredient'];
            $tambah->status_pkp           = $row['data'];
            $tambah->save();

            $turunan = PkpProject::where('id_pkp',$row['id_pkp'])->where('turunan',$row['turun'])->where('revisi',$row['rev'])->update([
                "status_data" => $row['status']
            ]);

            foreach($scores as $row){
                $pkp = PkpProject::where('id_project',$row['id_pkp'])->update([
                    "project_name" => $row['name'],
                    "id_brand"     => $row['brand'],
                    "ket_no"       => $row['ket'],
                    "note"         => $row['note'],
                    "type"         => $row['type']
                ]);

                $data=DataSES::where('id_pkp',$row['id_pkp'])->where('turunan',$row['turun'])->where('revisi',$row['rev'])->count();
                if($data>0){
                    $data=DataSES::where('id_pkp',$row['id_pkp'])->where('turunan',$row['turun'])->where('revisi',$row['rev'])->get();
                    foreach ($data as $data){
                        $ses= new DataSES;
                        $ses->id_pkp  = $data->id_pkp;
                        $ses->revisi  = $tambah->revisi;
                        $ses->turunan = $data->turunan;
                        $ses->ses     = $data->ses;
                        $ses->save();
                    }
                }

                $for=Forecast::where('id_pkp',$row['id_pkp'])->where('turunan',$row['turun'])->where('revisi',$row['rev'])->count();
                if($for>0){
                    $data=Forecast::where('id_pkp',$row['id_pkp'])->where('turunan',$row['turun'])->where('revisi',$row['rev'])->get();
                    foreach ($data as $data){
                        $forecast= new Forecast;
                        $forecast->id_pkp   = $data->id_pkp;
                        $forecast->revisi   = $tambah->revisi;
                        $forecast->turunan  = $data->turunan;
                        $forecast->forecast = $data->forecast;
                        $forecast->satuan   = $data->satuan;
                        $forecast->save();
                    }
                }

                $kl=DataKlaim::where('id_pkp',$row['id_pkp'])->where('turunan',$row['turun'])->where('revisi',$row['rev'])->count();
                if($kl>0){
                    $data=DataKlaim::where('id_pkp',$row['id_pkp'])->where('turunan',$row['turun'])->where('revisi',$row['rev'])->get();
                    foreach ($data as $data){
                        $klaim= new DataKlaim;
                        $klaim->id_pkp      = $data->id_pkp;
                        $klaim->revisi      = $tambah->revisi;
                        $klaim->turunan     = $data->turunan;
                        $klaim->id_komponen = $data->id_komponen;
                        $klaim->komponen    = $data->komponen;
                        $klaim->id_klaim    = $data->id_klaim;
                        $klaim->note        = $data->note;
                        $klaim->save();
                    }
                }

                $ddk=DetailKlaim::where('id_pkp',$row['id_pkp'])->where('turunan',$row['turun'])->where('revisi',$row['rev'])->count();
                if($ddk>0){
                    $data=DetailKlaim::where('id_pkp',$row['id_pkp'])->where('turunan',$row['turun'])->where('revisi',$row['rev'])->get();
                    foreach ($data as $data){
                        $detail= new DetailKlaim;
                        $detail->id_pkp     = $data->id_pkp;
                        $detail->revisi     = $tambah->revisi;
                        $detail->turunan    = $data->turunan;
                        $detail->id_detail  = $data->id_detail;
                        $detail->id_klaim   = $data->id_klaim;
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
            $tambah->pdf_id         = $row['id_pdf'];
            $tambah->primer         = $row['primer'];
            $tambah->primery        = $row['primary'];
            $tambah->secondery      = $row['secondary'];
            $tambah->Tertiary       = $row['tertiary'];
            $tambah->kemas_eksis    = $row['eksis'];
            $tambah->dariusia       = $row['dariusia'];
            $tambah->sampaiusia     = $row['sampaiusia'];
            $tambah->gender         = $row['gender'];
            $tambah->other          = $row['other'];
            $tambah->wight          = $row['wight'];
            $tambah->serving        = $row['serving'];
            $tambah->target_price   = $row['target'];
            $tambah->claim          = $row['claim'];
            $tambah->ingredient     = $row['ingredient'];
            $tambah->background     = $row['background'];
            $tambah->attractiveness = $row['attractive'];
            $tambah->rto            = $row['rto'];
            $tambah->name           = $row['name2'];
            $tambah->retailer_price = $row['retailer'];
            $tambah->special        = $row['special'];
            $tambah->turunan        = $row['turun'];
            $tambah->revisi         = $row['rev'];
            $tambah->status_data    = 'sent';
            $tambah->save();

            $turunan = SubPDF::where('pdf_id',$row['id_pdf'])->where('turunan',$row['turun'])->where('revisi',$row['revisi'])->update([
                "status_pdf" => $row['status']
            ]);

            foreach($data1 as $row){
                $pdf = ProjectPDF::where('id_project_pdf',$row['id_pdf'])->update([
                    "project_name"  => $row['name'],
                    "id_brand"      => $row['brand'],
                    "country"       => $row['country'],
                    "ket_no"        =>$row['ket'],
                    "reference"     => $row['reference'],
                    "id_type"       => $row['type']
                ]);

                $data=DataSES::where('id_pdf',$row['id_pdf'])->where('turunan',$row['turun'])->where('revisi',$row['rev'])->count();
                if($data>0){
                    $data=DataSES::where('id_pdf',$row['id_pdf'])->where('turunan',$row['turun'])->where('revisi',$row['rev'])->get();
                    foreach ($data as $data){
                        $ses= new DataSES;
                        $ses->id_pdf    = $data->id_pdf;
                        $ses->revisi    = $tambah->revisi;
                        $ses->turunan   = $data->turunan;
                        $ses->ses       = $data->ses;
                        $ses->save();
                    }
                }

                $for=Forecast::where('id_pdf',$row['id_pdf'])->where('turunan',$row['turun'])->where('revisi',$row['rev'])->count();
                if($for>0){
                    $data=Forecast::where('id_pdf',$row['id_pdf'])->where('turunan',$row['turun'])->where('revisi',$row['rev'])->get();
                    foreach ($data as $data){
                        $forecast= new Forecast;
                        $forecast->id_pdf   = $data->id_pdf;
                        $forecast->revisi   = $tambah->revisi;
                        $forecast->turunan  = $data->turunan;
                        $forecast->forecast = $data->forecast;
                        $forecast->satuan   = $data->satuan;
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
            $tambah->id_pkp_promoo   = $row['id_promo'];
            $tambah->promo_idea      = $row['idea'];
            $tambah->dimension       = $row['dimension'];
            $tambah->application     = $row['app'];
            $tambah->revisi          = $row['rev'];
            $tambah->turunan         = $row['turun'];
            $tambah->promo_readiness = $row['readines'];
            $tambah->rto             = $row['rto'];
            $tambah->gambaran_proses = $row['gambaran_proses'];
            $tambah->save();

            $turunan = DataPromo::where('id_pkp_promoo',$row['id_promo'])->where('turunan',$row['turun'])->where('revisi',$row['revisi'])->update([
                "status_data" => 'inactive'
            ]);

            foreach($data1 as $row){
                $pdf = promo::where('id_pkp_promo',$row['id_promo'])->update([
                    "project_name" => $row['name'],
                    "brand"        => $row['brand'],
                    "ket_no"       => $row['ket'],
                    "promo_type"   => $row['promotype'],
                    "country"      => $row['country'],
                    "type"         => $row['type']
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
                    $par->user  =$request->user;
                    $par->form1 =$request->par1;
                    $par->form2 =$request->par2;
                    $par->form3 =$request->par3;
                    $par->form4 =$request->par4;
                    $par->form5 =$request->par5;
                    $par->form6 =$request->par6;
                    $par->form7 =$request->par7;
                    $par->form8 =$request->par8;
                    $par->form9 =$request->par9;
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
                    $par->user  =$request->user;
                    $par->form1 =$request->par1;
                    $par->form2 =$request->par2;
                    $par->form3 =$request->par3;
                    $par->form4 =$request->par4;
                    $par->form5 =$request->par5;
                    $par->form6 =$request->par6;
                    $par->form7 =$request->par7;
                    $par->form8 =$request->par8;
                    $par->form9 =$request->par9;
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
                    $pipeline->id_user  = Auth::user()->id;
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
                    $par->id_promo = $data->id_promo;
                    $par->user     = $request->user;
                    $par->form1    = $request->par1;
                    $par->form2    = $request->par2;
                    $par->form3    = $request->par3;
                    $par->form4    = $request->par4;
                    $par->form5    = $request->par5;
                    $par->form6    = $request->par6;
                    $par->form7    = $request->par7;
                    $par->form8    = $request->par8;
                    $par->form9    = $request->par9;
                    $par->form10   = $request->par10;
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
        $type    = Type::all();
        $brand   = Brand::all();
        $datapdf = ProjectPDF::where('status_project','!=','draf') ->join('tr_sub_pdf','tr_pdf_project.id_project_pdf','=','tr_sub_pdf.pdf_id')->where('status_pdf','=','active')->get();
        return view('pdf.notulenpdf')->with([
            'datapdf' => $datapdf,
            'brand'   => $brand,
            'type'    => $type
        ]) ;
    }

    public function notulenpkp($info){
        $informasi = $info;
        $for       = Forecast::all();
        $brand     = Brand::all();
        $datapkp   = PkpProject::where('status_pkp','sent')->orwhere('status_pkp','proses')->orwhere('status_pkp','revisi')->where('status_project','=','active')->orderBy('prioritas','asc')->get();
        $notulen1  = notulen::all();
        $NForecast = NoteForecast::all();
        return view('pkp.notulen')->with([
            'datapkp'   => $datapkp,
            'info'      => $informasi,
            'for'       => $for,
            'notulen'   => $notulen1,
            'NForecast' => $NForecast,
            'brand'     => $brand
        ]) ;
    }

    public function updateUser(Request $request){
        $name   = $request->input('name');
        $editid = $request->input('editid');
    
        if($name !=''){
            $not = PkpProject::where('id_project',$request->input('editid'))->first();
            if($not->prioritas<=$request->input('name')){
                $project = PkpProject::where('status_pkp','!=','draf')->where('status_project','=','active')->where('prioritas','<=',$request->input('name'))->get();
                foreach($project as $project){
                    $akhir = PkpProject::where('id_project',$project->id_project)->where('prioritas','>=',$not->prioritas)->update([
                        'prioritas' => $project['prioritas']-1,
                    ]);
                }
            }
            elseif($not->prioritas>=$request->input('name')){
                $project = PkpProject::where('status_pkp','!=','draf')->where('status_project','=','active')->where('prioritas','>=',$request->input('name'))->get();
                foreach($project as $project){
                    $akhir = PkpProject::where('id_project',$project->id_project)->where('prioritas','<=',$not->prioritas)->update([
                        'prioritas' => $project['prioritas']+1,
                    ]);
                }
            }
            
            $pkp = PkpProject::where('id_project',$request->input('editid'))->first();
            $pkp->prioritas=$request->input('name');
            $pkp->save();
            
          echo 'Update successfully.';
        }else{
          echo 'Fill all fields.';
        }
        exit; 
    }

    public function konfirmasi_notulen(Request $request){
        $konfirmasi = $request->info;
        $bulan      = $request->bulan;
        return redirect::route('notulenpkp',$konfirmasi);
    }

    public function notulenpkpp(Request $request){
        $note = $request->input('note');
        if($request->info=='1'){
            $nf = NoteForecast::where('info','=','1')->where('Bulan',$request->bulan)->delete();
        }elseif($request->info=='2'){
            $nf = NoteForecast::where('info','=','2')->where('Bulan',$request->bulan)->delete();
        }
        foreach($note as $note){
            $jumlah = notulen::where('id_pkp',$note['pkp'])->where('Bulan',$request->bulan)->where('note_rd_pv','!=','NULL')->count();
            if($jumlah>='1' && $request->info=='1'){
                $info = notulen::where('id_pkp',$note['pkp'])->where('note_rd_pv','!=','NULL')->first();
                $nf   = NoteForecast::where('info','=','1')->where('Bulan',$request->bulan)->count();
                $info->delete();
            }
            $jumlah2 = notulen::where('id_pkp',$note['pkp'])->where('Bulan',$request->bulan)->where('note_pv_marketing','!=','NULL')->count();
            if($jumlah2>='1' && $request->info=='2'){
                $info = notulen::where('id_pkp',$note['pkp'])->where('note_pv_marketing','!=','NULL')->first();
                $nf   = NoteForecast::where('id_pkp',$note['pkp'])->where('info','=','2')->where('Bulan',$request->bulan)->delete();
                $info->delete();
            }
            if($note!='null'){
                $not = new notulen;
                $not->id_pkp = $note['pkp'];
                if($request->info=='1'){
                    $not->note_rd_pv = $note['note'];
                }
                if($request->info=='2'){
                    $not->note_pv_marketing = $note['note'];
                }
                $not->Bulan         = $request->bulan;
                $not->tahun         = $request->tahun;
                $not->created       = $note['date'];
                $not->launch        = $note['launch'];
                $not->launch_years  = $note['years'];
                $not->prioritas     = $note['prio'];
                $not->user          = Auth::user()->id;
                $not->save();
            }
            $project = PkpProject::where('id_project',$note['pkp'])->update([
                "launch" => $note['launch'],
                "years"  => $note['years']
            ]);
        }

        $for = $request->input('for');
        foreach($for as $for){
            if($request->info=='1'){
                $fn = new NoteForecast;
                $fn->id_pkp   = $for['id'];
                $fn->forecash = $for['for'];
                $fn->satuan   = $for['satuan'];
                $fn->Bulan    = $request->bulan;
                $fn->tahun    = $request->tahun;
                $fn->date     = $for['up'];
                $fn->info     = '1';
                $fn->save();
            }elseif($request->info=='2'){
                $fn = new NoteForecast;
                $fn->id_pkp   = $for['id'];
                $fn->forecash = $for['for'];
                $fn->satuan   = $for['satuan'];
                $fn->Bulan    = $request->bulan;
                $fn->tahun    = $request->tahun;
                $fn->date     = $for['up'];
                $fn->info     = '2';
                $fn->save();
            }
              
            $fc = Forecast::where('id',$for['pr'])->update([
                "forecast" => $for['for'],
                "satuan"   => $for['satuan']
            ]);
            
        }
        return redirect::back()->with('status', 'Saved data ');
    }

    public function indexnotulenpromo(){
        $brand     = Brand::all();
        $par       = ParameterForm::where('user',Auth::user()->id)->limit('1')->get();
        $datapromo = promo::where('status_project','!=','draf') ->join('tr_promo','tr_project_promo.id_pkp_promo','=','tr_promo.id_pkp_promoo')->where('status_data','=','active')->get();
        return view('promo.notulenpromo')->with([
            'datapromo' => $datapromo,
            'brand'     => $brand,
            'par'       => $par
        ]) ;
    }

    public function notulenpdff(Request $request){
        $note = $request->input('note');
        foreach($note as $note){
            if($note!='null'){
                $not = new notulen;
                $not->id_pdf        = $note['pdf'];
                $not->note          = $note['note'];
                $not->created_date  = $note['date'];
                $not->user          = Auth::user()->id;
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
                $not = new notulen;
                $not->id_promo      = $note['promo'];
                $not->note          = $note['note'];
                $not->created_date  = $note['date'];
                $not->user          = Auth::user()->id;
                $not->save();
            }

            $promo = promo::where('id_pkp_promo',$note['promo'])->update([
                "prioritas" => $note['prioritas']
            ]);
        }
        return redirect::back()->with('status', 'Saved data ');
    }

    public function editnote(Request $request){
        $note = $request->input('pkp');
        foreach($note as $pkp){
            $npkp = notulen::where('id_notulen',$pkp['pkp_id'])->update([
                "note" => $pkp['note'],
                "user" => Auth::user()->id
            ]);
        }
        return redirect::back()->with('status', 'Saved data ');
    }

    public function data(){
        $hilo1    = PkpProject::where('id_brand','=','Hilo')->count();
        $hilo2    = ProjectPDF::where('id_brand','=','Hilo')->count();
        $hhilo    = $hilo1 + $hilo2;
        $lmen1    = PkpProject::where('id_brand','=','L-Men')->count();
        $lmen2    = ProjectPDF::where('id_brand','=','L-Men')->count();
        $hlmen    = $lmen1 + $lmen2;
        $nr1      = PkpProject::where('id_brand','=','Nutrisari')->count();
        $nr2      = ProjectPDF::where('id_brand','=','Nutrisari')->count();
        $hnr      = $nr1 + $nr2;
        $ts1      = PkpProject::where('id_brand','=','Tropicana Slim')->count();
        $ts2      = ProjectPDF::where('id_brand','=','Tropicana Slim')->count();
        $hts      = $ts1 + $ts2;
        $ekspor1  = PkpProject::where('id_brand','=','Ekspor')->count();
        $ekspor2  = ProjectPDF::where('id_brand','=','Ekspor')->count();
        $hekspor  = $ekspor1 + $ekspor2;
        $dhilo1   = PkpProject::where('id_brand','=','Hilo')->where('status_project','=','active')->get();
        $dhilo2   = ProjectPDF::where('id_brand','=','Hilo')->join('tr_sub_pdf','tr_sub_pdf.pdf_id','=','tr_pdf_project.id_project_pdf')->where('status_pdf','=','active')->get();
        $dlmen1   = PkpProject::where('id_brand','=','L-Men')->where('status_project','=','active')->get();
        $dlmen2   = ProjectPDF::where('id_brand','=','L-Men')->join('tr_sub_pdf','tr_sub_pdf.pdf_id','=','tr_pdf_project.id_project_pdf')->where('status_pdf','=','active')->get();
        $dnr1     = PkpProject::where('id_brand','=','Nutrisari')->where('status_project','=','active')->get();
        $dnr2     = ProjectPDF::where('id_brand','=','Nutrisari')->join('tr_sub_pdf','tr_sub_pdf.pdf_id','=','tr_pdf_project.id_project_pdf')->where('status_pdf','=','active')->get();
        $dts1     = PkpProject::where('id_brand','=','Tropicana Slim')->where('status_project','=','active')->get();
        $dts2     = ProjectPDF::where('id_brand','=','Tropicana Slim')->join('tr_sub_pdf','tr_sub_pdf.pdf_id','=','tr_pdf_project.id_project_pdf')->where('status_pdf','=','active')->get();
        $dekspor1 = PkpProject::where('id_brand','=','Ekspor')->where('status_project','=','active')->get();
        $dekspor2 = ProjectPDF::where('id_brand','=','Ekspor')->join('tr_sub_pdf','tr_sub_pdf.pdf_id','=','tr_pdf_project.id_project_pdf')->where('status_pdf','=','active')->get();
        return view('pv.data')->with([
            'hhilo'    => $hhilo,
            'hlmen'    => $hlmen,   'hnr'      => $hnr,
            'hts'      => $hts,     'hekspor'  => $hekspor,
            'dhilo1'   => $dhilo1,  'dhilo2'   => $dhilo2,
            'dlmen1'   => $dlmen1,  'dlmen2'   => $dlmen2,
            'dnr1'     => $dnr1,    'dnr2'     => $dnr2,
            'dts1'     => $dts1,    'dts2'     =>$dts2,
            'dekspor1' => $dekspor1,'dekspor2' => $dekspor2
        ]);
    }

    public function pengajuan(){
        $pengajuanpdf   = pengajuan::where('id_pdf','!=','')->get();
        $pengajuanpkp   = pengajuan::where('id_pkp','!=','')->get();
        $pengajuanpromo = pengajuan::where('id_promo','!=','')->get();
        $pengajuan      = pengajuan::count();
        return view('pv.datapengajuan')->with([
            'pengajuanpdf'   => $pengajuanpdf,
            'pengajuanpkp'   => $pengajuanpkp,
            'pengajuan'      => $pengajuan,
            'pengajuanpromo' => $pengajuanpromo
        ]);
    }
}
