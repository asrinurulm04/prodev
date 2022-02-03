<?php

namespace App\Http\Controllers\PengajuanFS;

use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Mail;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\model\pkp\uom;
use App\model\pkp\Forecast;
use App\model\pkp\PkpProject;
use App\model\pdf\ProjectPDF;
use App\model\pdf\SubPDF;
use App\model\users\User;
use App\model\users\Departement;
use App\model\formula\Formula;
use App\model\formula\Fortail;
use App\model\Modellab\DataLab;
use App\model\Modelmesin\Mesin;
use App\model\Modelmesin\IO;
use App\model\Modelmesin\LiniTerdampak;
use App\model\Modelkemas\KonsepKemas;
use App\model\Modelkemas\FormulaKemas;
use App\model\Modelmaklon\Maklon;
use App\model\Modelkemas\datakemas;
use App\model\feasibility\Feasibility;
use App\model\feasibility\WorkbookFs;
use App\model\feasibility\FormPengajuanFS;
use Redirect;
use Auth;
use DB;

class PengajuanFsController extends Controller
{
    public function formPengajuanFS($id_project,$for){ // halaman pengajuan FS dari PV
        $pkp        = PkpProject::where('id_project',$id_project)->first();
        $formula    = Formula::where('id',$for)->select('id','formula','status_feasibility')->first();
        $hitung     = Feasibility::where('id_project',$id_project)->where('id_formula',$for)->count();
        $note       = Feasibility::where('id_project',$id_project)->where('id_formula',$for)->select('note')->first();
        $fs         = Feasibility::where('id_project',$id_project)->where('id_formula',$for)->where('status_feasibility','selesai')->get();
        $for        = Forecast::where('id_project',$id_project)->select('forecast','satuan')->get();
        $uom        = uom::where('note',NULL)->get();
        $uom_primer = uom::where('note','!=',NULL)->get();
        return view('pengajuanFS.pengajuanFS_PKP')->with([
            'pkp'        => $pkp,
            'for'        => $formula,
            'uom'        => $uom,
            'hitung'     => $hitung,
            'uom_primer' => $uom_primer,
            'fs'         => $fs,
            'note'       => $note,
            'fch'        => $for
        ]);
    }

    public function formPengajuanFS_pdf($id_project,$for){ // halaman pengajuan FS dari PV
        $pdf        = SubPDF::where('pdf_id',$id_project)->join('tr_pdf_project','tr_pdf_project.id_project_pdf','tr_sub_pdf.pdf_id')->where('status_pdf','active')->first();
        $formula    = Formula::where('id',$for)->select('id','formula','status_feasibility')->first();
        $hitung     = Feasibility::where('id_project_pdf',$id_project)->where('id_formula',$for)->count();
        $note       = Feasibility::where('id_project_pdf',$id_project)->where('id_formula',$for)->select('note')->first();
        $fs         = Feasibility::where('id_project_pdf',$id_project)->where('id_formula',$for)->where('status_feasibility','selesai')->get();
        $for        = Forecast::where('id_pdf',$id_project)->select('forecast','satuan')->get();
        $uom        = uom::where('note',NULL)->get();
        $uom_primer = uom::where('note','!=',NULL)->get();
        return view('pengajuanFS.pengajuanFS_PDF')->with([
            'pdf'        => $pdf,
            'for'        => $formula,
            'uom'        => $uom,
            'hitung'     => $hitung,
            'uom_primer' => $uom_primer,
            'fs'         => $fs,
            'note'       => $note,
            'fch'        => $for
        ]);
    }

    public function ajukanPKP(Request $request,$id_project,$for){
        $wf     = Feasibility::where('id_project',$id_project)->max('revisi');
        $hasil  = $wf+1;
        // Edit PKP sebelum di ajukan
        $pkp                    = PkpProject::where('id_project',$id_project)->first();
        $pkp->idea              = $request->idea;
        $pkp->UOM               = $request->uom;
        $pkp->selling_price     = $request->selling;
        $pkp->price             = $request->price;
            $kemas              = new datakemas;
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
        $pkp->kemas_eksis       = $kemas->id_kemas;
        $pkp->primery           = $request->primary;
        $pkp->secondary         = $request->secondary;
        $pkp->tertiary          = $request->tertiary;
        $pkp->pengajuan_fs      = 'ajukan';
        $pkp->tgl_pengajuan_fs  = $request->create;
        $pkp->feasibility       = $pkp->feasibility +1 ;
        $pkp->save();
        
        $fs                     = new Feasibility; // menambah data FS
        $fs->id_formula         = $for;
            if($wf=='0'){
                $fs->revisi     = '1';
            }elseif($wf!='0'){
                $fs->revisi     = $hasil;
            }
        $fs->id_project         = $id_project;
        $fs->tgl_pengajuan      = $request->create;
        $fs->status_feasibility = 'pengajuan';
        $fs->note               = $request->note;
        $fs->save();

        $formula                     = Formula::where('id',$for)->first();
        $formula->status_feasibility = 'proses';
        $formula->save();

        if($request->satuan!=''){
            $for       = Forecast::where('id_project',$id_project)->delete();
            $data      = array(); 
            $validator = Validator::make($request->all(), $data);  
            if ($validator->passes()) {
				$idz = implode(',', $request->input('forecast'));
				$ids = explode(',', $idz);
				$ida = implode(',', $request->input('satuan'));
				$idb = explode(',', $ida);
				for ($i = 0; $i < count($ids); $i++){
					$pipeline = new Forecast;
                    $pipeline->id_project   = $pkp->id_project;
                    $pipeline->id_pkp       = $pkp->id_pkp;
                    $pipeline->revisi       = $pkp->revisi;
                    $pipeline->turunan      = $pkp->turunan;
                    $pipeline->revisi_kemas = $pkp->revisi_kemas;
					$pipeline->forecast     = $ids[$i];
					$pipeline->satuan       = $idb[$i];
					$pipeline->save();
					$i = $i++;
				}
			}
		}

        $isipkp = PkpProject::where('id_project',$id_project)->get();
        $for    = Forecast::where('id_project',$id_project)->get();
        try{ // mengirim email pengajuan FS ke manager REA
            Mail::send('email.infoemailpkp', [
                'app'  => $isipkp,
                'for'  => $for,
                'info' => 'Terdapat Pengajuan Feasibility Untuk Project PKP Berikut! ',
            ], function ($message) use ($request,$id_project) {
                $data  = PkpProject::where('id_project',$id_project)->first();
                $dept  = Departement::where('dept','REA')->first();
                $user1 = User::where('id',$dept->manager_id)->first();
                $user2 = User::where('id',$data->perevisi)->first();
                $message->subject('PRODEV | Pengajuan Feasibility-PKP');
                $message->to($user1->email);
                $message->cc($user2->email);
            });
        }
        catch (Exception $e){
        return response (['status' => false,'errors' => $e->getMessage()]);
        }
        return redirect::route('rekappkp',[$pkp->id_project,$pkp->id_pkp])->with('status','E-mail Successfully');
    }

    public function BatalAjukanFS(Request $request,$id_project,$for){ // pembatalan pengajuan FS
        $formula = Formula::where('id',$for)->first();
        $formula->status_feasibility='reject';
        $formula->save();

        $fs = Feasibility::where('id_project',$id_project)->where('id_formula',$for)->update([
            'status_feasibility' => 'batal'
        ]);

        $pkp = PkpProject::where('id_project',$id_project)->first();
        $pkp->feasibility=$pkp->feasibility - 1;
        $pkp->save();

        $isi = PkpProject::where('id_project',$id_project)->get();
        $for = Forecast::where('id_project',$id_project)->get();
        try{ // mengirimkan informasi via email juka terdapat pembatalan pengajuan
            Mail::send('email.infoemailpkp', [
                'app'  => $isi,
                'for'  => $for,
                'info' => 'Pengajuan Feasibility Untuk Project PKP Ini Dibatalkan Oleh PV! ',
            ], function ($message) use ($request,$id_project) {
                $data  = PkpProject::where('id_project',$id_project)->first();
                $dept  = Departement::where('dept','REA')->first();
                $user1 = User::where('id',$dept->manager_id)->first();
                $user2 = User::where('id',$data->perevisi)->first();
                $message->subject('PRODEV | Pengajuan Feasibility-PKP');
                $message->to($user1->email);
                $message->cc($user2->email);
            });
        }
        catch (Exception $e){
            return response (['status' => false,'errors' => $e->getMessage()]);
        }
        return redirect::route('rekappkp',[$id_project,$formula->workbook_id])->with('status', 'Project canceled!');
    }

    public function ajukanPDF(Request $request,$id,$for){
        $wf     = Feasibility::where('id_project_pdf',$id)->count();
        $hasil  = $wf+1;
        // Edit PDF sebelum di ajukan
        $pdf                    = SubPDF::where('pdf_id',$id)->where('status_pdf','active')->first();
        $pdf->background        = $request->idea;
        $pdf->target_price      = $request->target_price;
        $pdf->retailer_price    = $request->retailer_price;
            $kemas              = new datakemas;
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
        $pdf->kemas_eksis       = $kemas->id_kemas;
        $pdf->primery           = $request->primary;
        $pdf->secondery         = $request->secondary;
        $pdf->Tertiary          = $request->tertiary;
        $pdf->save();

        $data = ProjectPDF::where('id_project_pdf',$id)->first();
        $data->pengajuan_fs      = 'ajukan';
        $data->tgl_pengajuan_fs  = $request->create;
        $data->feasibility       = $pdf->feasibility +1 ;
        $data->save();
        
        $fs                     = new Feasibility;
        $fs->id_formula         = $for;
            if($wf=='0'){
                $fs->revisi     = '1';
            }elseif($wf!='0'){
                $fs->revisi     = $hasil;
            }
        $fs->id_project_pdf     = $id;
        $fs->tgl_pengajuan      = $request->create;
        $fs->status_feasibility = 'pengajuan';
        $fs->note               = $request->note;
        $fs->save();

        $formula                     = Formula::where('id',$for)->first();
        $formula->status_feasibility = 'proses';
        $formula->save();

        if($request->satuan!=''){
            $for       = Forecast::where('id_pdf',$id)->delete();
            $data      = array(); 
            $validator = Validator::make($request->all(), $data);  
            if ($validator->passes()) {
				$idz = implode(',', $request->input('forecast'));
				$ids = explode(',', $idz);
				$ida = implode(',', $request->input('satuan'));
				$idb = explode(',', $ida);
				for ($i = 0; $i < count($ids); $i++){
					$pipeline = new Forecast;
                    $pipeline->id_pdf       = $pdf->pdf_id;
                    $pipeline->revisi       = $pdf->revisi;
                    $pipeline->turunan      = $pdf->turunan;
					$pipeline->forecast     = $ids[$i];
					$pipeline->satuan       = $idb[$i];
					$pipeline->save();
					$i = $i++;
				}
			}
		}

        $isipdf = SubPDF::where('pdf_id',$id)->where('status_pdf','=','active')->get();
        try{ // mengirim pengajuan FS PDF ke manager proses
            Mail::send('email.infoemailpdf', [
                'app'  => $isipdf,
                'info' => 'Terdapat Pengajuan Feasibility Untuk Project PDF Berikut! ',
            ], function ($message) use ($request,$id) {
                $data  = ProjectPDF::where('id_project_pdf',$id)->first();
                $dept  = Departement::where('dept','REA')->first();
                $user1 = User::where('id',$dept->manager_id)->first();
                $user2 = User::where('id',$data->author)->first();
                $message->subject('PRODEV | Pengajuan Feasibility-PDF');
                $message->to($user1->email);
                $message->cc($user2->email);
            });
        }
        catch (Exception $e){
        return response (['status' => false,'errors' => $e->getMessage()]);
        }
        return redirect::route('rekappdf',$pdf->pdf_id)->with('status','E-mail Successfully');
    }

    public function BatalAjukanFS_PDF(Request $request,$id_project,$for){ // pembatalan FS pdf
        $formula = Formula::where('id',$for)->first();
        $formula->status_feasibility='reject';
        $formula->save();

        $fs = Feasibility::where('id_project_pdf',$id_project)->where('id_formula',$for)->first();
        $fs->status_feasibility='batal';
        $fs->save();

        $pkp = ProjectPDF::where('id_project_pdf',$id_project)->first();
        $pkp->feasibility=$pkp->feasibility - 1;
        $pkp->save();

        $isipdf = SubPDF::where('pdf_id',$id_project)->where('status_pdf','=','active')->get();
        try{ // mengirim email pembatalan project
            Mail::send('email.infoemailpdf', [
                'app'  => $isipdf,
                'info' => 'Pengajuan Feasibility Untuk Project PDF Ini Dibatalkan Oleh PV! ',
            ], function ($message) use ($request,$id_project) {
                $data  = ProjectPDF::where('id_project_pdf',$id_project)->first();
                $dept  = Departement::where('dept','REA')->first();
                $user1 = User::where('id',$dept->manager_id)->first();
                $user2 = User::where('id',$data->author)->first();
                $message->subject('PRODEV | Pengajuan Feasibility-PDF');
                $message->to($user1->email);
                $message->cc($user2->email);
            });
        }
        catch (Exception $e){
            return response (['status' => false,'errors' => $e->getMessage()]);
        }
        return redirect::route('rekappdf',$id_project)->with('status', 'Project Canceled!');
    }

    public function DetailPengajuanFsPKP($id_project,$for,$fs){ // halaman detail pengajuan FS project PKP
        $io         = IO::select('io')->get();
        $pkp        = PkpProject::where('id_project',$id_project)->first();
        $feasibility= Feasibility::where('id',$fs)->first();
        $formula    = Formula::where('id',$for)->select('id','workbook_id','formula','serving_size','batch')->first();
        $for        = Forecast::where('id_project',$id_project)->where('forecast','!=','0')->min('forecast');
        $count      = FormPengajuanFS::where('id_feasibility',$fs)->count();
        $form       = FormPengajuanFS::where('id_feasibility',$fs)->first();
        return view('pengajuanFS.DetailPengajuanFS_PKP')->with([
            'formula'   => $formula,
            'pkp'       => $pkp,
            'fs'        => $fs,
            'fs2'       => $feasibility,
            'io'        => $io,
            'count'     => $count,
            'form'      => $form,
            'fch'       => $for
        ]);
    }

    public function DetailPengajuanFsPDF($id_project,$for,$fs){// halaman detail pengajuan FS project PDF
        $io         = IO::select('io')->get();
        $pdf        = SubPDF::where('pdf_id',$id_project)->where('status_pdf','active')->first();
        $feasibility= Feasibility::where('id',$fs)->first();
        $formula    = Formula::where('id',$for)->select('id','workbook_id','formula','serving_size','batch')->first();
        $for        = Forecast::where('id_project',$id_project)->where('forecast','!=','0')->min('forecast');
        $count      = FormPengajuanFS::where('id_feasibility',$fs)->count();
        $form       = FormPengajuanFS::where('id_feasibility',$fs)->first();
        return view('pengajuanFS.DetailPengajuanFS_PDF')->with([
            'formula'   => $formula,
            'pdf'       => $pdf,
            'fs'        => $fs,
            'fs2'       => $feasibility,
            'io'        => $io,
            'count'     => $count,
            'form'      => $form,
            'fch'       => $for
        ]);
    }

    public function overview(Request $request){
        $fs = FormPengajuanFS::where('id_feasibility',$request->id_fs)->count();
        if($fs=='0'){ // jika jumlah form pengajuan FS adalah "0" maka sistem akan membuatkan data baru
            $form = new FormPengajuanFS;
            $form->id_feasibility           = $request->id_fs;
            $form->forecast                 = $request->forecast;
            $form->product_reference        = $request->product_reference;
            $form->Pricelist                = $request->pricelist;
            $form->uom                      = $request->uom;
            $form->location                 = $request->location;
            $form->gramasi_uom              = $request->gramasi_uom;
            $form->uom_box                  = $request->uom_box;
            $form->box_batch                = $request->box_batch;
            $form->uom_month                = $request->uom_month;
            $form->serving_uom              = $request->serving_uom;
            $form->serving_size             = $request->serving_size;
            $form->Batch_month              = $request->batch_month;
            $form->batch_size               = $request->batch_size;
            $form->batch_granulation        = $request->batch_granulation;
            $form->Yield                    = $request->yield;
            $form->ref_ekp                  = $request->ref_ekp;
            $form->new_raw_material         = $request->new_material;
            $form->new_packaging_material   = $request->new_pk_material;
            $form->new_machine              = $request->new_Machine;
            $form->trial                    = $request->trial;
            $form->notes                    = $request->note;
            $form->user_id                  = Auth::user()->id;
            $form->created_date             = $request->create;
            $form->save();
        }elseif($fs>='0'){ // jika pada table form jumlah FS tidak sama dengan "0" maka sistem akan meng-update dta yang telah ada dengan data yang terbaru.
            $form = FormPengajuanFS::where('id_feasibility',$request->id_fs)->first();
            $form->id_feasibility           = $request->id_fs;
            $form->forecast                 = $request->forecast;
            $form->product_reference        = $request->product_reference;
            $form->Pricelist                = $request->pricelist;
            $form->uom                      = $request->uom;
            $form->location                 = $request->location;
            $form->gramasi_uom              = $request->gramasi_uom;
            $form->uom_box                  = $request->uom_box;
            $form->box_batch                = $request->box_batch;
            $form->serving_uom              = $request->serving_uom;
            $form->serving_size             = $request->serving_size;
            $form->Batch_month              = $request->batch_month;
            $form->batch_size               = $request->batch_size;
            $form->batch_granulation        = $request->batch_granulation;
            $form->Yield                    = $request->yield;
            $form->ref_ekp                  = $request->ref_ekp;
            $form->new_raw_material         = $request->new_material;
            $form->new_packaging_material   = $request->new_pk_material;
            $form->new_machine              = $request->new_Machine;
            $form->trial                    = $request->trial;
            $form->notes                    = $request->note;
            $form->user_id                  = Auth::user()->id;
            $form->created_date             = $request->create;
            $form->save();
        }

        if($request->info=='sent'){ // jika project akan di kirim ke PIC FS maka sistem akan mengirimkan informasi via email ke user.
            $fs = Feasibility::where('id',$request->id_fs)->first();
            $fs->status_maklon      = 'ajukan';
            $fs->status_kemas       = 'ajukan';
            $fs->status_lab         = 'ajukan';
            $fs->status_proses      = 'ajukan';
            $fs->status_feasibility = 'proses';
            $fs->save();
            
            if($request->type=='PKP'){ // jika type project yang dikirimkan adalah PKP maka bagian ini yang akna di jalankan
                $pkp = PkpProject::where('id_project',$fs->id_project)->first();
                $pkp->pengajuan_fs='proses';
                $pkp->save();

                $isipkp = PkpProject::where('id_project',$fs->id_project)->get();
                $for    = Forecast::where('id_project',$fs->id_project)->get();
                $id     = $fs->id_project;
                try{
                    Mail::send('email.infoemailpkp', [
                        'app'  => $isipkp,
                        'for'  => $for,
                        'info' => 'Terdapat Pengajuan Feasibility Untuk Project PKP Berikut! ',
                    ], function ($message) use ($request,$id) {
                        $data       = PkpProject::where('id_project',$id)->first();
                        $dept       = Departement::where('dept','RKA')->first();
                        $user1      = User::where('id',$dept->manager_id)->first();
                        $userLab    = User::where('role_id','11')->first();
                        $user2      = User::where('id',$data->user_fs)->first();

                        $message->subject('PRODEV | Pengajuan Feasibility-PKP');
                        $message->to([$user1->email,$userLab->email]);
                        if($user2!=NULL){
                            $message->cc($user2->email);
                        }
                    });
                }
                catch (Exception $e){
                    return response (['status' => false,'errors' => $e->getMessage()]);
                }
            }elseif($request->type=='PDF'){ // jika type project yang dikirmkan adalah PDF maka bagian ini yang akna di jalankan
                $pdf = ProjectPDF::where('id_project_pdf',$fs->id_project_pdf)->first();
                $pdf->pengajuan_fs='proses';
                $pdf->save();

                $data = $fs->id_project_pdf;
                $isipdf = SubPDF::where('pdf_id',$fs->id_project_pdf)->where('status_pdf','=','active')->get();
                try{
                    Mail::send('email.infoemailpdf', [
                        'app'  => $isipdf,
                        'info' => 'Terdapat Pengajuan Feasibility Untuk Project PDF Berikut! ',
                    ], function ($message) use ($request,$data) {
                        $data    = ProjectPDF::where('id_project_pdf',$data)->first();
                        $dept    = Departement::where('dept','RKA')->first();
                        $user1   = User::where('id',$dept->manager_id)->first();
                        $userLab = User::where('role_id','11')->first();
                        $user2   = User::where('id',$data->user_fs)->first();
                        $message->subject('PRODEV | Pengajuan Feasibility-PDF');
                        $message->to([$user1->email,$userLab->email]);
                        if($user2!=NULL){
                            $message->cc($user2->email);
                        }
                    });
                }
                catch (Exception $e){
                return response (['status' => false,'errors' => $e->getMessage()]);
                }
            }
        }
        if($request->type=='PKP'){
            return redirect::route('listPkpFs',$request->id_project)->with('status','E-mail Successfully');
        }elseif($request->type=='PDF'){
            return redirect::route('listPdfFs',$request->id_project)->with('status','E-mail Successfully');
        }
    }

    public function user_fs(Request $request,$id_project){ // manager REA akan mengirimkan project FS ke usernya. 
        if($request->info=='PKP'){
            $pkp = PkpProject::where('id_project',$id_project)->first();
            $pkp->user_fs = $request->user;
            $pkp->save();

            $isipkp = PkpProject::where('id_project',$id_project)->get();
            $for    = Forecast::where('id_project',$id_project)->get();
            $id     = $id_project;
            try{
                Mail::send('email.infoemailpkp', [
                    'app'  => $isipkp,
                    'for'  => $for,
                    'info' => 'Terdapat Pengajuan Feasibility Untuk Project PKP Berikut! ',
                ], function ($message) use ($request,$id) {
                    $user1   = User::where('id',$request->user)->first();
                    $message->subject('PRODEV | Pengajuan Feasibility-PKP');
                    $message->to($user1->email);
                });
            }
            catch (Exception $e){
                return response (['status' => false,'errors' => $e->getMessage()]);
            }
        }elseif($request->info=='PDF'){
            $pdf = ProjectPDF::where('id_project_pdf',$id_project)->first();
            $pdf->user_fs = $request->user;
            $pdf->save();

            $isipdf = SubPDF::where('pdf_id',$id_project)->where('status_pdf','=','active')->get();
            try{
                Mail::send('email.infoemailpdf', [
                    'app'  => $isipdf,
                    'info' => 'Terdapat Pengajuan Feasibility Untuk Project PDF Berikut! ',
                ], function ($message) use ($request,$id_project) {
                    $data  = ProjectPDF::where('id_project_pdf',$id_project)->first();
                    $dept  = Departement::where('dept','REA')->first();
                    $user1 = User::where('id',$dept->manager_id)->first();
                    $user2 = User::where('id',$data->author)->first();
                    $message->subject('PRODEV | Pengajuan Feasibility-PDF');
                    $message->to($user1->email);
                    $message->cc($user2->email);

                });
            }
            catch (Exception $e){
            return response (['status' => false,'errors' => $e->getMessage()]);
            }
        }
        return redirect::back()->with('status','E-mail Successfully');
    }

    public function final(Request $request, $fs,$wbProses,$wbKemas){ // mengirimkan project FS yang telah selesaike PV
        $fs = Feasibility::where('id',$fs)->first();
        $fs->status_proses       = 'selesai';
        $fs->status_maklon       = 'selesai';
        $fs->status_kemas        = 'selesai';
        $fs->status_lab          = 'selesai';
        $fs->status_product      = 'selesai';
        $fs->status_feasibility  = 'selesai';
        $fs->tgl_kirim           = $request->tgl;
        $fs->note_proses         = $request->note;
        $fs->save();

        $for = Formula::where('id',$fs->id_formula)->first();
        $for->status_feasibility = 'sent';
        $for->save();

        if($request->type=="PKP"){
            $data   = PkpProject::where('id_project',$fs->id_project)->first();
            $data->pengajuan_fs = 'done';
            $data->save();

            $for    = Forecast::where('id_project',$fs->id_project)->where('forecast','!=','0')->min('forecast');
            $id     = $data->id_project;
        }elseif($request->type=='PDF'){
            $pdf    = ProjectPDF::where('id_project_pdf',$fs->id_project_pdf)->first();
            $pdf->pengajuan_fs = 'done';
            $pdf->save();

            $data   = SubPDF::where('pdf_id',$fs->id_project_pdf)->where('status_pdf','active')->first(); 
            $for    = Forecast::where('id_pdf',$fs->id_project)->where('forecast','!=','0')->min('forecast');
            $id     = $data->id_project_pdf;
        }
        
        $formula    = Formula::where('id',$fs->id_formula)->first();
        $for        = Forecast::where('id_project',$fs->id_project)->where('forecast','!=','0')->min('forecast');
        $form       = FormPengajuanFS::where('id_feasibility',$fs->id)->first();
        $maklon     = Maklon::where('id_fs',$fs->id)->first();
        $mesin      = Mesin::join('ms_mesin','ms_mesin.id_data_mesin','tr_mesin.id_data_mesin')->where('kategori','Filling')->where('id_wb_fs',$wbKemas)->select('nama_mesin')->distinct()->get();
        $kemas      = KonsepKemas::where('id_ws',$wbKemas)->select('id_ws','referensi')->first();
        $lokasi     = Mesin::join('ms_mesin','ms_mesin.id_data_mesin','tr_mesin.id_data_mesin')->where('kategori','!=','Filling')->where('kategori','!=','Packing')->where('id_wb_fs',$wbProses)->select('IO')->distinct()->get();
        $lokasi2    = Mesin::join('ms_mesin','ms_mesin.id_data_mesin','tr_mesin.id_data_mesin')->where('kategori','Filling')->orwhere('kategori','Packing')->where('id_wb_fs',$wbKemas)->select('IO')->distinct()->get();
        $all        = LiniTerdampak::where('id_ws',$wbProses)->first();
        $dataLab    = DataLab::where('id_fs',$fs->id)->join('ms_item_desc','ms_item_desc.id','tr_lab.id_item_desc')->first();
        $konsep     = KonsepKemas::where('id_ws',$wbKemas)->first();
        $Mdata      = DB::table('tr_mesin')->join('ms_mesin','tr_mesin.id_data_mesin','=','ms_mesin.id_data_mesin')->where('id_wb_fs',$wbKemas)->orwhere('kategori','Filling')->where('kategori','Packing')->get();
        $lab        = ($dataLab->kimia_batch * $formula->batch) + ($dataLab->biaya_tahanan * $formula->batch) + ($dataLab->analisa_swab * $formula->batch) + ($dataLab->mikro_analisa * $formula->batch) + (($dataLab->biaya_analisa * $dataLab->jlh_sample_mikro)* $formula->batch) + $dataLab->biaya_analisa_tahun;
        $analisa    = $lab/$formula->batch;
        $forKemas   = FormulaKemas::join('tr_feasibility','tr_feasibility.id_wb_kemas','tr_formula_kemas.id_ws')->where('id',$fs->id)->where('cost_uom','!=',NULL)->select('cost_uom')->first();
        $fortail    = Fortail::where('formula_id',$fs->id)->join('ms_bahans','ms_bahans.id','tr_fortails.bahan_id')->where('status_bb','baru')->get();
        $manual     = Mesin::where('manual','!=',NULL)->where('id_wb_fs',$wbKemas)->get();
        $mesin2     = Mesin::join('tr_workbook_fs','tr_workbook_fs.id','tr_mesin.id_wb_fs')->where('id_wb_fs',$wbProses)->get();
        $kemasNew   = FormulaKemas::where('id_ws', $wbKemas)->get();
        $iddesc     = DataLab::where('id_fs',$fs->id)->join('ms_item_desc','ms_item_desc.id','tr_lab.id_item_desc')->first();
        try{ // mengirim email FS ke costing
            Mail::send('email.EmailOverview', [
                'data'      => $data,
                'fs'        => $fs,
                'for'       => $for,
                'formula'   => $formula,
                'form'      => $form,
                'maklon'    => $maklon,
                'lokasi'    => $lokasi,
                'lokasi2'   => $lokasi2,
                'forKemas'  => $forKemas,
                'analisa'   => $analisa,
                'all'       => $all,
                'kemas'     => $kemas,
                'mesin'     => $mesin
            ], function ($message) use ($request,$id) {
                $message->subject('PRODEV | INFORMASI PENGAJUAN FS');
                $message->to($request->email);
                $message->cc(Auth::user()->email);
            });
        }
        catch (Exception $e){
            return response (['status' => false,'errors' => $e->getMessage()]);
        }
        return redirect::back()->with('status','E-mail Successfully');
    }
}