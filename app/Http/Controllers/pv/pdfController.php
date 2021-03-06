<?php

namespace App\Http\Controllers\pv;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Mail;

use App\model\pkp\Type;
use App\model\pkp\uom;
use App\model\pkp\DetailKlaim;
use App\model\pkp\DataSES;
use App\model\pkp\klaim;
use App\model\pkp\KlaimDetail;
use App\model\pkp\komponen;
use App\model\pkp\DataKlaim; 
use App\model\pkp\ses;
use App\model\pkp\Forecast;
use App\model\pkp\FileProject;
use App\model\pdf\kemaspdf;
use App\model\pdf\SubPDF;
use App\model\pdf\ProjectPDF;
use App\model\manager\pengajuan;
use App\model\users\User;
use App\model\users\Departement;
use App\model\master\Brand;
use App\model\formula\Formula;
use App\model\Modelkemas\datakemas;
use Carbon\Carbon;
use Auth;
use DB;
use Redirect;

class pdfController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
        $this->middleware('rule:pv_global' || 'rule:pv_lokal' || 'rule:NR' || 'rule:marketing' || 'rule:manager' || 'rule:admin');
    }

    public function NewPDf(Request $request){ // membuat project PDF baru
        $pdf = new ProjectPDF;
        $pdf->reference     = $request->reference;
        $pdf->product_type  = $request->product_type;
        $pdf->project_name  = $request->project_name;
        $pdf->id_brand      = $request->brand;
        $pdf->id_type       = $request->type;
        $pdf->author        = $request->author;
        $pdf->created_date  = $request->date;
        $pdf->workbook      = '0';
        $pdf->country       = $request->country;
        $pdf->save();

        return Redirect()->route('rekappdf',$pdf->id_project_pdf);
    }

    public function lihatpdf($id_project_pdf,$revisi,$turunan){
        $max            = SubPDF::where('pdf_id',$id_project_pdf)->max('turunan');
        $pdf1           = SubPDF::where('pdf_id',$id_project_pdf)->where('revisi','<=',$revisi)->where('turunan','<=',$turunan)->orderBy('turunan','desc')->get();
        $pdf2           = SubPDF::where('pdf_id',$id_project_pdf)->where('revisi','<=',$revisi)->where('turunan',$max)->orderBy('revisi','desc')->get();
        $pdf            = SubPDF::join('tr_pdf_project','tr_sub_pdf.pdf_id','=','tr_pdf_project.id_project_pdf')->where('id_project_pdf',$id_project_pdf)->where('revisi',$revisi)->where('turunan',$turunan)->first();
        $id_pdf         = SubPDF::where([ ['pdf_id',$id_project_pdf], ['revisi',$revisi], ['turunan',$turunan] ])->first();
        $for            = Forecast::where('id_pdf',$id_project_pdf)->where('revisi',$revisi)->where('revisi','=',$revisi)->where('turunan','=',$turunan)->get();
        $ses            = DataSES::where('id_pdf',$id_project_pdf)->where('revisi',$revisi)->where('turunan','<=',$turunan)->orderBy('turunan','desc')->get();
        $nopdf          = DB::table('tr_pdf_project')->max('pdf_number')+1;
        $data           = sprintf("%03s", abs($nopdf));
        $kemaspdf       = kemaspdf::where('id_pdf',$id_project_pdf)->where('revisi','=',$revisi)->where('turunan','=',$turunan)->get();
        $hitungkemaspdf = kemaspdf::where('id_pdf',$id_project_pdf)->where('revisi','=',$revisi)->where('turunan','=',$turunan)->count();
        $dept           = Departement::all();
        $dataklaim      = DataKlaim::where('id_pdf',$id_project_pdf)->join('ms_klaim','ms_klaim.id','=','id_klaim')->where('revisi',$revisi)->where('turunan',$turunan)->get();
        $datadetail     = DetailKlaim::where('id_pdf',$id_project_pdf)->where('revisi',$revisi)->where('turunan',$turunan)->get();
        $picture        = FileProject::where('pdf_id',$id_project_pdf)->where('turunan','<=',$turunan)->orderBy('turunan','desc')->get();
        return view('pdf.lihatpdf')->with([
            'pdf'           => $pdf,
            'pdf1'          => $pdf1,
            'pdf2'          => $pdf2,
            'datadetail'    => $datadetail,
            'dataklaim'     => $dataklaim,
            'kemaspdf'      => $kemaspdf,
            'hitungkemaspdf'=> $hitungkemaspdf,
            'datases'       => $ses,
            'dept'          => $dept,
            'for'           => $for,
            'nopdf'         => $data,
            'picture'       => $picture
        ]); 
    }

    public function downloadpdf($id_project_pdf,$revisi,$turunan){ // halaman untuk mencetak PDF -> PDF/Print
        $datapdf        = SubPDF::where('pdf_id',$id_project_pdf)->count();
        $pdf1           = SubPDF::where('pdf_id',$id_project_pdf)->where('revisi',$revisi)->where('turunan',$turunan)->orderBy('turunan','desc')->get();
        $pdf            = SubPDF::join('tr_pdf_project','tr_sub_pdf.pdf_id','=','tr_pdf_project.id_project_pdf')->where('id_project_pdf',$id_project_pdf)->where('revisi',$revisi)->where('turunan',$turunan)->get();
        $id_pdf         = SubPDF::where([ ['pdf_id',$id_project_pdf], ['revisi',$revisi], ['turunan',$turunan] ])->first();
        $dataklaim      = DataKlaim::where('id_pdf',$id_project_pdf)->join('ms_klaim','ms_klaim.id','=','id_klaim')->where('revisi',$revisi)->where('turunan',$turunan)->get();
        $datadetail     = DetailKlaim::where('id_pdf',$id_project_pdf)->where('revisi',$revisi)->where('turunan',$turunan)->get();
        $for            = Forecast::where('id_pdf',$id_project_pdf)->where('revisi',$revisi)->where('turunan','<=',$turunan)->orderBy('turunan','desc')->get();
        $ses            = DataSES::where('id_pdf',$id_project_pdf)->where('revisi',$revisi)->where('turunan',$turunan)->orderBy('turunan','desc')->get();
        $kemaspdf       = kemaspdf::where('id_pdf',$id_project_pdf)->where('revisi','=',$revisi)->where('turunan',$turunan)->get();
        $hitungkemaspdf = kemaspdf::where('id_pdf',$id_project_pdf)->where('revisi','=',$revisi)->where('turunan',$turunan)->count();
        $dataklaim      = DataKlaim::where('id_pdf',$id_project_pdf)->join('ms_klaim','ms_klaim.id','=','id_klaim')->where('revisi',$revisi)->where('turunan',$turunan)->get();
        $datadetail     = DetailKlaim::where('id_pdf',$id_project_pdf)->where('revisi',$revisi)->where('turunan',$turunan)->get();
        $picture        = FileProject::where('pdf_id',$id_project_pdf)->where('turunan','<=',$turunan)->orderBy('turunan','desc')->get();
        return view('pdf.pdfdownload')->with([
            'pdf'           => $pdf,
            'datadetail'    => $datadetail,
            'dataklaim'     => $dataklaim,
            'pdf1'          => $pdf1,
            'datadetail'    => $datadetail,
            'dataklaim'     => $dataklaim,
            'kemaspdf'      => $kemaspdf,
            'hitungkemaspdf'=> $hitungkemaspdf,
            'datases'       => $ses,
            'for'           => $for,
            'datapdf'       => $datapdf,
            'picture'       => $picture
        ]); 
    }

    public function hapuspdf($id_project_pdf){
        $pdf    = ProjectPDF::where('id_project_pdf',$id_project_pdf)->delete();
        $Dpdf   = SubPDF::where('pdf_id',$id_project_pdf)->first();
        if($Dpdf!=NULL){
            $Dpdf->delete();
        }

        return redirect::back();
    }

    public function freeze(Request $request,$id_project_pdf){
        $data= ProjectPDF::where('id_project_pdf',$id_project_pdf)->first();
        $data->status_freeze= 'active';
        $data->freeze       = Auth::user()->id;
        $data->waktu_freeze = Carbon::now();
        $data->note_freeze  = $request->notefreeze;
        $data->save();

        return redirect::back()->with('status', 'Project '.$data->project_name.' has been disabled!');
    }

    public function ubahTMpdf(Request $request,$id_project_pdf){ // mengubah timeline pengiriman sample
        $data= ProjectPDF::where('id_project_pdf',$id_project_pdf)->first();
        $data->status_project = 'revisi';
        $data->save();

        $pengajuan= new pengajuan;
        $pengajuan->prioritas_pengajuan = 1;
        $pengajuan->id_pdf              = $request->pdf;
        $pengajuan->penerima            = '5';
        $pengajuan->alasan_pengajuan    = $request->lamafreeze;
        $pengajuan->save();

        return redirect::back();
    }

    public function activepdf($id_project_pdf){ // meng aktifkan kembali project PDF yang telah di freeze
        $data = ProjectPDF::where('id_project_pdf',$id_project_pdf)->first();
        $data->status_freeze='inactive';
        $data->save();

        return redirect::back();
    }

    public function EditTimeline(Request $request,$id_project_pdf){
        $data = ProjectPDF::where('id_project_pdf',$id_project_pdf)->first();
        $data->status_project   = 'sent';
        $data->jangka           = $request->jangka;
        $data->waktu            = $request->waktu;
        $data->status_freeze    = 'inactive';
        $data->freeze_diaktifkan= Carbon::now();
        $data->save();

        return redirect::back();
    } 

    public function formpdf(){
        $type = Type::all();
        $pdf1 = ProjectPDF::where('status_project','!=','draf')->get();
        $brand= Brand::all();
        return view('pdf.requestpdf')->with([
            'type' => $type,
            'brand'=> $brand,
            'pdf1' => $pdf1
        ]);
    }

    public function drafpdf(){
        $pdf = ProjectPDF::where('status_project','draf')->get();
        return view('pdf.pdfdraf')->with([
            'pdf' => $pdf
        ]);
    }

    public function listpdf(){
        $pdf = ProjectPDF::where('status_project','!=','draf')->get();
        return view('pdf.listpdf')->with([
            'pdf' => $pdf
        ]);
    }

    public function buatpdf($id_project_pdf){
        $ses        = ses::all();
        $Ddetail    = DetailKlaim::max('id')+1;
        $detail     = KlaimDetail::all();
        $uom        = uom::where('note',NULL)->get();
        $kemas      = datakemas::all();
        $uom_primer = uom::where('note','!=',NULL)->get();
        $klaim      = klaim::all();
        $eksis      = datakemas::count();
        $komponen   = komponen::all();
        $project    = SubPDF::where('status_data','!=','draf')->where('status_pdf','=','active')->join('tr_pdf_project','tr_pdf_project.id_project_pdf','=','tr_sub_pdf.pdf_id')->get();
        $id_pdf     = ProjectPDF::find($id_project_pdf);
        return view('pdf.buatpdf')->with([
            'ses'       => $ses,
            'Ddetail'   => $Ddetail,
            'detail'    => $detail,
            'klaim'     => $klaim,
            'komponen'  => $komponen,
            'eksis'     => $eksis,
            'uom'       => $uom,
            'kemas'     => $kemas,
            'uom_primer'=> $uom_primer,
            'project'   => $project,
            'id_pdf'    => $id_pdf
        ]);
    }

    public function konfigurasi($pdf){ // menghapus data konfigurasi pada project PDF
        $konfig = SubPDF::where('id',$pdf)->first();
        $konfig->kemas_eksis= null;
        $konfig->primery    = null;
        $konfig->secondery  = null;
        $konfig->Tertiary   = null;
        $konfig->save();
        return redirect::back();
    }

    public function buatpdf1($id_project_pdf,$revisi,$turunan){ // halaman edit data PDF
        $pdf            = SubPDF::where([ ['pdf_id',$id_project_pdf], ['revisi',$revisi], ['turunan',$turunan] ])->join('tr_pdf_project','tr_pdf_project.id_project_pdf','tr_sub_pdf.pdf_id')->get();
        $datases        = DataSES::where([ ['id_pdf',$id_project_pdf], ['revisi',$revisi], ['turunan',$turunan] ])->get();
        $project        = SubPDF::where('status_data','!=','draf')->where('status_pdf','=','active')->join('tr_pdf_project','tr_pdf_project.id_project_pdf','=','tr_sub_pdf.pdf_id')->get();
        $ses            = ses::all();
        $brand          = Brand::all();
        $kemas          = datakemas::all();
        $kemaspdf       = kemaspdf::where('id_pdf',$id_project_pdf)->where('turunan',$turunan)->where('revisi',$revisi)->get();
        $hitungkemaspdf = kemaspdf::where('id_pdf',$id_project_pdf)->where('turunan',$turunan)->where('revisi',$revisi)->count();
        $dataklaim      = DataKlaim::where('id_pdf',$id_project_pdf)->where('turunan',$turunan)->where('revisi',$revisi)->get();
        $datadetail     = DetailKlaim::where('id_pdf',$id_project_pdf)->where('turunan',$turunan)->where('revisi',$revisi)->get();
        $detail         = KlaimDetail::all();
        $klaim          = klaim::all();
        $eksis          = datakemas::count();
        $uom            = uom::where('note',NULL)->get();
        $uom_primer     = uom::where('note','!=',NULL)->get();
        $Ddetail        = DetailKlaim::max('id')+1;
        $komponen       = komponen::all();
        $id_pdf         = SubPDF::where([ ['pdf_id',$id_project_pdf], ['revisi',$revisi], ['turunan',$turunan] ])->first();
        $for            = Forecast::where('id_pdf',$id_project_pdf)->where('revisi',$revisi)->where('turunan',$turunan)->get();
        $for2           = Forecast::where('id_pdf',$id_project_pdf)->where('revisi',$revisi)->where('turunan',$turunan)->count();
        $user           = User::where('status','=','active')->get();
        return view('pdf.buatpdf1')->with([
            'ses'           => $ses,
            'project'       => $project,
            'brand'         => $brand,
            'kemas'         => $kemas,
            'Ddetail'       => $Ddetail,
            'kemaspdf'      => $kemaspdf,
            'eksis'         => $eksis,
            'hitungkemaspdf'=> $hitungkemaspdf,
            'uom'           => $uom,
            'uom_primer'    => $uom_primer,
            'komponen'      => $komponen,
            'klaim'         => $klaim,
            'detail'        => $detail,
            'datadetail'    => $datadetail,
            'dataklaim'     => $dataklaim,
            'for'           => $for,
            'for2'          => $for2,
            'user'          => $user,
            'datases'       => $datases,
            'pdf'           => $pdf
        ]);
    }

    public function CreatePdf(Request $request){
        $data = SubPDF::where('pdf_id',$request->id)->count();
        if($data>=1){
            $turunan = SubPDF::where('pdf_id',$request->id)->max('turunan');
            $revisi  = SubPDF::where('pdf_id',$request->id)->max('revisi');

            return redirect()->Route('datatambahanpdf',['pdf_id' => $request->id, 'revisi' => $revisi, 'turunan' => $turunan])->with('status', 'Data has been added up ');
        }
        elseif($data==0){
            $coba = new SubPDF;
            $coba->pdf_id        = $request->id;
                if($request->primer==''){
                    $coba->kemas_eksis  = $request->data_eksis;
                }elseif($request->primer!='NULL'){
                    $coba->kemas_eksis=$request->kemas;

                    $kemas = new datakemas;
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
            $coba->primery       = $request->primary;
            $coba->secondery     = $request->secondary;
            $coba->Tertiary      = $request->tertiary;
            $coba->last_update   = $request->last_up;
            $coba->dariusia      = $request->dariumur;
            $coba->perevisi      = Auth::user()->id;
            $coba->sampaiusia    = $request->sampaiumur;
            $coba->gender        = $request->gender;
            $coba->other         = $request->other;
            $coba->wight         = $request->weight;
            $coba->serving       = $request->serving;
            $coba->target_price  = $request->target_price;
            $coba->claim         = $request->claim;
            $coba->ingredient    = $request->ingredient;
            $coba->background    = $request->background;
            $coba->attractiveness= $request->attractive;
            $coba->rto           = $request->rto;
            $coba->turunan       = '0';
            $coba->revisi        = '0';
            $coba->name          = $request->name_competitors;
            $coba->retailer_price= $request->retailer_price;
            $coba->special       = $request->special;
            $coba->save();

            if($request->ses!=''){
                $rule = array(); 
                $validator = Validator::make($request->all(), $rule);  
                if ($validator->passes()) {
                    $idz = implode(',', $request->input('ses'));
                    $ids = explode(',', $idz);
                    for ($i = 0; $i < count($ids); $i++){
                        $pipeline = new DataSES;
                        $pipeline->id_project= $coba->id_project_pdf;
                        $pipeline->id_pdf    = $request->id;
                        $pipeline->turunan   = '0';
                        $pipeline->ses       = $ids[$i];
                        $pipeline->save();
                        $i = $i++;
                    }
                }
            } 

            if($request->klaim!=''){
                $dataklaim = array(); 
                $validator = Validator::make($request->all(), $dataklaim);  
                if ($validator->passes()) {
                    $idz  = implode(',', $request->input('klaim'));
                    $ids  = explode(',', $idz);
                    $ida  = implode(',', $request->input('komponen'));
                    $idb  = explode(',', $ida);
                    $note = implode(',', $request->input('ket'));
                    $data = explode(',', $note);
                    for ($i = 0; $i < count($ids); $i++) {
                        $pipeline = new DataKlaim;
                        $pipeline->id_project   = $coba->id_project_pdf;
                        $pipeline->id_pdf       = $request->id;
                        $pipeline->turunan      = '0';
                        $pipeline->revisi       = '0';
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
                $validator = Validator::make($request->all(), $detailklaim);  
                if ($validator->passes()) {
                    $idz = implode(',', $request->input('detail'));
                    $ids = explode(',', $idz);
                    for ($i = 0; $i < count($ids); $i++){
                        $detail = new DetailKlaim;
                        $detail->id_project = $coba->id_project_pdf;
                        $detail->id_pdf     = $request->id;
                        $detail->turunan    = '0';
                        $detail->revisi     = '0';
                        $detail->id_detail  = $ids[$i];
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
                    $idc = implode(',', $request->input('keterangan'));
                    $idd = explode(',', $idc);
                    for ($i = 0; $i < count($ids); $i++){
                        $pipeline = new Forecast;
                        $pipeline->id_project   = $coba->id_project_pdf;
                        $pipeline->id_pdf       = $request->id;
                        $pipeline->turunan      = '0';
                        $pipeline->forecast     = $ids[$i];
                        $pipeline->satuan       = $idb[$i];
                        $pipeline->keterangan   = $idd[$i];
                        $pipeline->save();
                        $i = $i++;
                    }
                }
            }

            if($request->oracle!=''){
                $data = array(); 
                $validator = Validator::make($request->all(), $data);  
                if ($validator->passes()) {
                    $idz = implode(',', $request->input('oracle'));
                    $ids = explode(',', $idz);
                    $ida = implode(',', $request->input('kk'));
                    $idb = explode(',', $ida);
                    $idc = implode(',', $request->input('information'));
                    $idd = explode(',', $idc);
                    for ($i = 0; $i < count($ids); $i++){
                        $pipeline = new kemaspdf;
                        $pipeline->id_pdf      = $request->id;
                        $pipeline->turunan     = '0';
                        $pipeline->revisi      = '0';
                        $pipeline->oracle      = $ids[$i];
                        $pipeline->kk          = $idb[$i];
                        $pipeline->information = $idd[$i];
                        $pipeline->save();
                        $i = $i++;
                    }
                }
            }
            return redirect()->Route('datatambahanpdf',['pdf_id' => $coba->pdf_id, 'revisi' => $coba->revisi, 'turunan' => $coba->turunan])->with('status', 'Data has been added up ');
        }
    }

    public function UpdatePdf2(Request $request,$pdf_id,$revisi,$turunan){ // update data PDF
        $project = ProjectPDF::where('id_project_pdf',$pdf_id)->first();
        $project->project_name  = $request->name;
        $project->id_brand      = $request->brand;
        $project->save();

        $coba = SubPDF::where([ ['pdf_id',$pdf_id], ['revisi',$revisi], ['turunan',$turunan] ])->first();
        $coba->pdf_id        = $request->id;
            if($request->primer==''){
                $coba->kemas_eksis  = $request->data_eksis;
            }elseif($request->primer!='NULL'){
                $coba->kemas_eksis  = $request->kemas;

                $kemas = new datakemas;
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
        $coba->primery       = $request->primary;
        $coba->secondery     = $request->secondary;
        $coba->Tertiary      = $request->tertiary;
        $coba->dariusia      = $request->dariumur;
        $coba->sampaiusia    = $request->sampaiumur;
        $coba->gender        = $request->gender;
        $coba->other         = $request->other;
        $coba->wight         = $request->weight;
        $coba->perevisi      = Auth::user()->id;
        $coba->last_update   = $request->last_up;
        $coba->serving       = $request->serving;
        $coba->target_price  = $request->target_price;
        $coba->claim         = $request->claim;
        $coba->revisi        = $revisi;
        $coba->turunan       = $turunan;
        $coba->ingredient    = $request->ingredient;
        $coba->background    = $request->background;
        $coba->attractiveness= $request->attractive;
        $coba->rto           = $request->rto;
        $coba->name          = $request->name_competitors;
        $coba->retailer_price= $request->retailer_price;
        $coba->special       = $request->special;
        $coba->save();

        if($request->ses!=''){
            $rule      = array(); 
            $ses       = DataSES::where([ ['id_pdf',$pdf_id], ['revisi',$revisi], ['turunan',$turunan] ])->delete();
            $validator = Validator::make($request->all(), $rule);  
            if ($validator->passes()) {
                $idz = implode(',', $request->input('ses'));
                $ids = explode(',', $idz);
                for ($i = 0; $i < count($ids); $i++){
                    $pipeline = new DataSES;
                    $pipeline->id_pdf   = $request->id;
                    $pipeline->turunan  = $turunan;
                    $pipeline->revisi   = $revisi;
                    $pipeline->ses      = $ids[$i];
                    $pipeline->save();
                    $i = $i++;
                }
            }
        }
        if($request->oracle!=''){
            $data      = array(); 
            $oracle    = kemaspdf::where([ ['id_pdf',$pdf_id], ['revisi',$revisi], ['turunan',$turunan] ])->delete();
            $validator = Validator::make($request->all(), $data);  
            if ($validator->passes()) {
                $idz = implode(',', $request->input('oracle'));
                $ids = explode(',', $idz);
                $ida = implode(',', $request->input('kk'));
                $idb = explode(',', $ida);
                $idc = implode(',', $request->input('information'));
                $idd = explode(',', $idc);
                for ($i = 0; $i < count($ids); $i++) {
                    $pipeline = new kemaspdf;
                    $pipeline->id_pdf       = $request->id;
                    $pipeline->turunan      = $turunan;
                    $pipeline->revisi       = $revisi;
                    $pipeline->oracle       = $ids[$i];
                    $pipeline->kk           = $idb[$i];
                    $pipeline->information  = $idd[$i];
                    $pipeline->save();
                    $i = $i++;
                }
            }
        }

        if($request->forecast!=''){
            $data       = array(); 
            $for        = Forecast::where('id_pdf',$pdf_id)->where('revisi',$revisi)->where('turunan',$turunan)->delete();
            $validator  = Validator::make($request->all(), $data);  
            if ($validator->passes()) {
                $idz = implode(',', $request->input('forecast'));
                $ids = explode(',', $idz);
                $ida = implode(',', $request->input('satuan'));
                $idb = explode(',', $ida);
                $idc = implode(',', $request->input('keterangan'));
                $idd = explode(',', $idc);
                for ($i = 0; $i < count($ids); $i++){
                    $pipeline = new Forecast;
                    $pipeline->id_pdf       = $request->id;
                    $pipeline->turunan      = $turunan;
                    $pipeline->revisi       = $revisi;
                    $pipeline->forecast     = $ids[$i];
                    $pipeline->satuan       = $idb[$i];
                    $pipeline->keterangan   = $idd[$i];
                    $pipeline->save();
                    $i = $i++;
                }
            }
        }

        if($request->klaim!=''){
            $dataklaim = array(); 
            $klaim     = DataKlaim::where('id_pdf',$pdf_id)->where('revisi',$revisi)->where('turunan',$turunan)->delete();
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
                    $pipeline->id_pdf       = $request->id;
                    $pipeline->turunan      = $turunan;
                    $pipeline->revisi       = $revisi;
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
            $detail      = DetailKlaim::where('id_pdf',$pdf_id)->where('revisi',$revisi)->where('turunan',$turunan)->delete();
            $validator   = Validator::make($request->all(), $detailklaim);  
            if ($validator->passes()) {
                $idz = implode(',', $request->input('detail'));
                $ids = explode(',', $idz);
                for ($i = 0; $i < count($ids); $i++){
                    $detail = new DetailKlaim;
                    $detail->id_pdf     = $request->id;
                    $detail->turunan    = $turunan;
                    $detail->revisi     = $revisi;
                    $detail->id_detail  = $ids[$i];
                    $detail->save();
                    $i = $i++;
                }
            }
        }
        return redirect()->Route('datatambahanpdf',['pdf_id' => $coba->pdf_id, 'revisi' => $coba->revisi, 'turunan' => $coba->turunan])->with('status', 'Revised Data ');
    }

    public function UpdatePdf(Request $request,$id_project_pdf,$revisi,$turunan){ // update PDF setelah dikirim ke RD || naik Versi
        $pdf = SubPDF::where('pdf_id',$id_project_pdf)->max('turunan');
        $naikversi = $pdf + 1;

        $project = ProjectPDF::where('id_project_pdf',$id_project_pdf)->first();
        $project->project_name  = $request->name;
        $project->id_brand      = $request->brand;
        $project->save();

        $datapdf = SubPDF::where('pdf_id',$id_project_pdf)->where('revisi',$revisi)->where('turunan',$turunan)->first();
        $datapdf->status_pdf = 'inactive';
        $datapdf->save();

            $clf = SubPDF::where('pdf_id',$id_project_pdf)->where('revisi',$revisi)->where('turunan',$turunan)->count();
            if($clf>0){
                $isipdf = SubPDF::where('pdf_id',$id_project_pdf)->where('revisi',$revisi)->where('turunan',$turunan)->get();
                foreach ($isipdf as $pdfp){
                $coba= new SubPDF;
                $coba->pdf_id = $request->id;
                    if($request->primer==''){
                        $coba->kemas_eksis  = $request->data_eksis;
                    }elseif($request->primer!='NULL'){
                        $coba->kemas_eksis  = $request->kemas;

                        $kemas = new datakemas;
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
                $coba->primery       = $request->primary;
                $coba->secondery     = $request->secondary;
                $coba->Tertiary      = $request->tertiary;
                $coba->perevisi      = Auth::user()->id;
                $coba->last_update   = $request->last_up;
                $coba->dariusia      = $request->dariumur;
                $coba->sampaiusia    = $request->sampaiumur;
                $coba->gender        = $request->gender;
                $coba->other         = $request->other;
                $coba->turunan       = $naikversi;
                $coba->revisi        = $pdfp->revisi;
                $coba->wight         = $request->weight;
                $coba->serving       = $request->serving;
                $coba->target_price  = $request->target_price;
                $coba->claim         = $request->claim;
                $coba->ingredient    = $request->ingredient;
                $coba->background    = $request->background;
                $coba->attractiveness= $request->attractive;
                $coba->rto           = $request->rto;
                $coba->status_pdf    = 'active';
                $coba->name          = $request->name_competitors;
                $coba->retailer_price= $request->retailer_price;
                $coba->special       = $request->special;
                $coba->save();
                }
            }
            
            if($request->ses!=''){
                $rule       = array(); 
                $validator  = Validator::make($request->all(), $rule);  
                if ($validator->passes()) {
                    $idz = implode(',', $request->input('ses'));
                    $ids = explode(',', $idz);
                    for ($i = 0; $i < count($ids); $i++){
                        $pipeline = new DataSES;
                        $pipeline->id_project   = $coba->id_project_pdf;
                        $pipeline->id_pdf       = $request->id;
                        $pipeline->turunan      = $naikversi;
                        $pipeline->revisi       = '0';
                        $pipeline->ses          = $ids[$i];
                        $pipeline->save();
                        $i = $i++;
                    }
                }
            } 

            if($request->forecast!='' && $request->satuan!=''){
                $data       = array(); 
                $validator  = Validator::make($request->all(), $data);  
                if ($validator->passes()) {
                    $idz = implode(',', $request->input('forecast'));
                    $ids = explode(',', $idz);
                    $ida = implode(',', $request->input('satuan'));
                    $idb = explode(',', $ida);
                    $idc = implode(',', $request->input('keterangan'));
                    $idd = explode(',', $idc);
                    for ($i = 0; $i < count($ids); $i++){
                        $pipeline = new Forecast;
                        $pipeline->id_project   = $coba->id_project_pdf;
                        $pipeline->id_pdf       = $request->id;
                        $pipeline->turunan      = $naikversi;
                        $pipeline->revisi       = '0';
                        $pipeline->forecast     = $ids[$i];
                        $pipeline->satuan       = $idb[$i];
                        $pipeline->keterangan   = $idd[$i];
                        $pipeline->save();
                        $i = $i++;
                    }
                }
            }

            if($request->klaim!=''){
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
                        $pipeline->id_project   = $coba->id_project_pdf;
                        $pipeline->id_pdf       = $request->id;
                        $pipeline->turunan      = $naikversi;
                        $pipeline->revisi       = '0';
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
                        $detail->id_project = $coba->id_project_pdf;
                        $detail->id_pdf     = $request->id;
                        $detail->turunan    = $naikversi;
                        $detail->revisi     = '0';
                        $detail->id_detail  = $ids[$i];
                        $detail->save();
                        $i = $i++;
                    }
                }
            }

            if($request->oracle!=''){
                $data      = array(); 
                $validator = Validator::make($request->all(), $data);  
                if ($validator->passes()) {
                    $idz = implode(',', $request->input('oracle'));
                    $ids = explode(',', $idz);
                    $ida = implode(',', $request->input('kk'));
                    $idb = explode(',', $ida);
                    $idc = implode(',', $request->input('information'));
                    $idd = explode(',', $idc);
                    for ($i = 0; $i < count($ids); $i++){
                        $pipeline = new kemaspdf;
                        $pipeline->id_pdf       = $request->id;
                        $pipeline->turunan      = $naikversi;
                        $pipeline->revisi       = '0';
                        $pipeline->oracle       = $ids[$i];
                        $pipeline->kk           = $idb[$i];
                        $pipeline->information  = $idd[$i];
                        $pipeline->save();
                        $i = $i++;
                    }
                }
            }
        return redirect()->Route('datatambahanpdf',['pdf_id' => $request->id, 'revisi' => $datapdf->revisi, 'turunan' => $naikversi])->with('status', 'Revised Data ');
    }

    public function uploadpdf($id_project_pdf,$revisi,$turunan){
        $coba   = FileProject::where('pdf_id',$id_project_pdf)->where('revisi','<=',$revisi)->where('turunan','<=',$turunan)->get();
        $coba1  = FileProject::where('pdf_id',$id_project_pdf)->where('turunan','<=',$turunan)->count();
        $turunan= SubPDF::where([ ['pdf_id',$id_project_pdf], ['revisi',$revisi], ['turunan',$turunan] ])->first();
        $id_pdf = ProjectPDF::find($id_project_pdf);
        return view('pdf.datatambahanpdf')->with([
            'coba'      => $coba,
            'turunan'   => $turunan,
            'coba1'     => $coba1,
            'id_pdf'    => $id_pdf
        ]);
    }

    public function infogambarpdf(Request $request){ // upload info data tambahan PDF
        $info = $request->input('informasi');
        foreach($info as $row){
            foreach($info as $row){
                $file = FileProject::where('id_pictures',$row['pic'])->update([
                    "informasi" => $row['info']
                ]);
            }
        }
        return redirect::route('rekappdf',$request->id);
    }

    public function uploaddatapdf(Request $request){ // upload data tambahan PDF
        $this->validate($request, [
            'filename'  => 'required',
            'filename.*'=> 'required|file|max:3072'
        ]);

        $files = [];
        foreach ($request->file('filename') as $file) {
            if ($file->isValid()) {
                $nama       = time();
                $nama_file  = time()."_".$file->getClientOriginalName();
                $path       = $file->move('data_file',$nama_file);
                $turunan    = $request->turunan;
                $form       = $request->id;
                $files[] = [
                    'filename'=> $nama_file,
                    'lokasi'  => $path,
                    'lokasi'  => $path,
                    'pdf_id'  => $form,
                    'turunan' => $turunan,
                ];
            }
        }
        FileProject::insert($files);
        return redirect()->back()->withSuccess(sprintf('%s file uploaded successfully.', count($files)));
    }

    public function destroydata($id_pictures){ // hapus data tambahan
        $data = FileProject::find($id_pictures);
        $data->delete();
        return redirect()->back()->with('status', 'Data berhasil dihapus!');
    }

    public function daftarpdf($id_project_pdf){
        $data1              = SubPDF::where('status_pdf','active')->join('tr_pdf_project','tr_pdf_project.id_project_pdf','tr_sub_pdf.pdf_id')->where('id_project_pdf',$id_project_pdf)->first();
        $data               = ProjectPDF::where('id_project_pdf',$id_project_pdf)->first();
        $hitung             = SubPDF::where('pdf_id',$id_project_pdf)->count();
        $cf                 = Formula::where('workbook_pdf_id',$id_project_pdf)->count();
        $id                 = ProjectPDF::where('id_project_pdf',$id_project_pdf)->first();
        $sample_project     = Formula::where('workbook_pdf_id', $id_project_pdf)->orderBy('versi','asc')->orderBy('turunan','asc')->get();
        $sample_project_PV  = Formula::where('workbook_pdf_id', $id_project_pdf)->where('vv','!=',NULL)->orderBy('versi','asc')->orderBy('turunan','asc')->get();
        $max2               = SubPDF::where('pdf_id',$id_project_pdf)->max('revisi');
        $max                = SubPDF::where('pdf_id',$id_project_pdf)->max('turunan');
        $pdf                = SubPDF::where('pdf_id',$id_project_pdf)->where('turunan',$max)->where('revisi',$max2)->where('status_pdf','active')->first();
        return view('pdf.daftarpdf')->with([
            'data'      => $data,
            'data1'     => $data1,
            'sample'    => $sample_project,
            'sample_pv' => $sample_project_PV,
            'cf'        => $cf,
            'id'        => $id,
            'hitung'    => $hitung,
            'pdf'       => $pdf
        ]);
    }
}