<?php

namespace App\Http\Controllers\formula;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Mail;

use App\model\pkp\PkpProject;
use App\model\pkp\Forecast;
use App\model\pdf\SubPDF;
use App\model\pdf\ProjectPDF;
use App\model\formula\Formula;
use App\model\formula\Fortail;
use App\model\users\User;
use Auth;
use Redirect;
use DB;

class SampleController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
        $this->middleware('rule:pv_lokal' || 'rule:pv_global' );
    }

    public function approvesample(Request $request,$id_sample){ // PV approve formula
        $for = Formula::where('id',$id_sample)->first();
        $for->vv         = 'approve';
        $for->catatan_pv = $request->note;
        $for->save();

        if($for->workbook_id!=NULL){ // jika project yang dikirimkan adalah project PKP
            $data    = $for->workbook_id;
            $turunan = PkpProject::where('id_project',$data)->max('turunan');
            $revisi  = PkpProject::where('id_project',$data)->max('revisi');
            $isipkp  = PkpProject::where('id_project',$for->workbook_id)->get();
            $for     = Forecast::where('id_project',$for->workbook_id)->where('revisi',$revisi)->where('turunan',$turunan)->get();
            try{ // kirim email sample (pengirim, Manager, PV)
                Mail::send('email.infoemailpkp', [
                    'info' => 'Sample yang anda ajukan disetujui dengan catatan "'.$request->note.'"',
                    'for'  => $for,
                    'app'  => $isipkp,
                ],function($message)use($data){
                    $message->subject('Approve PKP sample');
                    $datapkp = PkpProject::where('id_project',$data)->get();
                    foreach($datapkp as $data){
                        $dept = DB::table('ms_departements')->where('id',$data->tujuankirim)->get();
                        foreach($dept as $dept){ // dikirim ke manager terkait
                            $user = User::where('id',$dept->manager_id)->get();
                            foreach($user as $user){
                                $to = $user->email;
                                $message->to($to);
                            }
                        }
                        $user1 = User::where('id',$data->userpenerima)->get();
                        foreach($user1 as $user1){
                            $cc = [$user1->email,Auth::user()->email];
                            $message->cc($cc);
                        }
                    }
                });
            }
            catch (Exception $e){
                return response (['status' => false,'errors' => $e->getMessage()]);
            }
        }elseif($for->workbook_pdf_id!=NULL){ // jika project yang dikirim adalah project PDFs
            $data    = $for->workbook_pdf_id;
            $turunan = SubPDF::where('pdf_id',$data)->max('turunan');
            $revisi  = SubPDF::where('pdf_id',$data)->max('revisi');
            
            $isipdf  = SubPDF::where('pdf_id',$for->workbook_pdf_id)->where('status_pdf','=','active')->get();
            $for     = Forecast::where('id_pdf',$for->workbook_pdf_id)->where('revisi',$revisi)->where('turunan',$turunan)->get();
            try{ // kirim email sample (pengirim, Manager, PV)
                Mail::send('email.infoemailpdf', [
                    'info' => 'Sample yang anda ajukan disetujui dengan catatan "'.$request->note.'"',
                    'for'  => $for,
                    'app'  => $isipdf,
                ],function($message)use($data){
                    $message->subject('Approve PDF sample');
                    $datapdf = ProjectPDF::where('id_project_pdf',$data)->get();
                    foreach($datapdf as $data){
                        $dept = DB::table('ms_departements')->where('id',$data->tujuankirim)->get();
                        foreach($dept as $dept){
                            $user = User::where('id',$dept->manager_id)->get();
                            foreach($user as $user){
                                $to = $user->email;
                                $message->to($to);
                            }
                        }
                        $user1 = User::where('id',$data->userpenerima)->get();
                        foreach($user1 as $user1){
                            $cc = [$user1->email,Auth::user()->email];
                            $message->cc($cc);
                        }
                    }
                });
            }
            catch (Exception $e){
            return response (['status' => false,'errors' => $e->getMessage()]);
            }
        }
        return redirect::back()->with('status','E-mail Successfully');
    }

    public function unfinalsample($for){
        $pkp     = Formula::where('id',$for)->first();
        $pkp->vv = 'approve';
        $pkp->save();

        return redirect::back();
    }

    public function finalsample($id_sample){
        $pkp     = Formula::where('id',$id_sample)->first();
        $pkp->vv = 'final';
        $pkp->save();

        return redirect::back();
    }

    public function rejectsample(Request $request,$id_sample){
        $for     = Formula::where('id',$id_sample)->first();
        $for->vv = 'reject';
        $for->catatan_pv=$request->note;
        $for->save();

        if($for->workbook_id!=NULL){ // jika project yang dikirim adalah project PKP
            $data    = $for->workbook_id;
            $turunan = PkpProject::where('id_project',$for->workbook_id)->max('turunan');
            $revisi  = PkpProject::where('id_project',$for->workbook_id)->max('revisi');
            $isipkp  = PkpProject::where('id_project',$for->workbook_id)->get();
            $for     = Forecast::where('id_project',$for->workbook_id)->where('revisi',$revisi)->where('turunan',$turunan)->get();
            try{ // kirim email sample (pengirim, Manager, PV)
                Mail::send('email.infoemailpkp', [
                    'info' => 'Sample yang anda ajukan ditolah dengan catatan "'.$request->note.'"',
                    'for'  => $for,
                    'app'  => $isipkp,
                ],function($message)use($data){
                    $message->subject('Reject PKP sample');
                    $datapkp = PkpProject::where('id_project',$data)->get();
                    foreach($datapkp as $data){
                        $dept = DB::table('ms_departements')->where('id',$data->tujuankirim)->get();
                        foreach($dept as $dept){
                            $user = User::where('id',$dept->manager_id)->get();
                            foreach($user as $user){
                                $to = $user->email;
                                $message->to($to);
                            }
                        }
                        $user1 = User::where('id',$data->userpenerima)->get();
                        foreach($user1 as $user1){
                            $cc = [$user1->email,Auth::user()->email];
                            $message->cc($cc);
                        }
                    }
                });
            }
            catch (Exception $e){
                return response (['status' => false,'errors' => $e->getMessage()]);
            }
        }elseif($for->workbook_pdf_id!=NULL){ //jika project yang di kirim adalah roject PDF
            $data    = $for->workbook_pdf_id;
            $turunan = SubPDF::where('pdf_id',$for->workbook_pdf_id)->max('turunan');
            $revisi  = SubPDF::where('pdf_id',$for->workbook_pdf_id)->max('revisi');
            $isipdf  = SubPDF::where('pdf_id',$for->workbook_pdf_id)->where('status_pdf','=','active')->get();
            $for     = Forecast::where('id_pdf',$for->workbook_pdf_id)->where('revisi',$revisi)->where('turunan',$turunan)->get();
            try{// kirim email sample (pengirim, Manager, PV)
                Mail::send('email.infoemailpdf', [
                    'info' => 'Sample yang anda ajukan ditolak dengan catatan "'.$request->note.'"',
                    'for'  => $for,
                    'app'  => $isipdf,
                ],function($message)use($data){
                    $message->subject('Reject PDF sample');
                    $datapdf = ProjectPDF::where('id_project_pdf',$data)->get();
                    foreach($datapdf as $data){
                        $dept = DB::table('ms_departements')->where('id',$data->tujuankirim)->get();
                        foreach($dept as $dept){
                            $user = User::where('id',$dept->manager_id)->get();
                            foreach($user as $user){
                                $to = $user->email;
                                $message->to($to);
                            }
                        }
                        $user1 = User::where('id',$data->userpenerima)->get();
                        foreach($user1 as $user1){
                            $cc = [$user1->email,Auth::user()->email];
                            $message->cc($cc);
                        }
                    }
                });
            }
            catch (Exception $e){
            return response (['status' => false,'errors' => $e->getMessage()]);
            }
        }
        return redirect::back()->with('status','E-mail Successfully');
    }

    public function vp(Request $request,$wb,$id){ // project di kirimkan ke pv
        $formula = Formula::where('id',$wb)->first();
        $ada     = Fortail::where('formula_id',$formula->id)->count();
        if($ada < 1){ // jika data fortail kurang dari 1 maka akan menampilkan informasi error
            return Redirect::back()->with('error','Data Bahan Formula Versi '.$formula->versi.' Masih Kosong');
        }elseif($formula->batch < 1){ // jika formula data kurang dari 1 maka akan menampilkan informasi error
            return Redirect::back()->with('error','Data Bahan Formula Versi '.$formula->versi.'.'.$formula->turunan.' Belum Memliki Batch');
        }elseif($formula->note_formula == Null){ // jika note formula kosong maka akan menampilkan informasi error
            return Redirect::back()->with('error','Note Formula untuk versi '.$formula->versi.'.'.$formula->turunan.' Masih Kosong');
        }
        $formula->vv     = 'proses';
        $formula->status = 'proses';
        $formula->save();

        if($formula->workbook_id!=NULL){ // jika project yang didkirim adalah project PKP
            $pkp = PkpProject::where('id_pkp',$formula->workbook_id)->get();
			foreach($pkp as $wb){
			    $data ='1';
			    $wb   = PkpProject::where('id_pkp',$wb->id_pkp)->update([
                    'pengajuan_sample' => 'sent',
                ]);
		    }

            $data  = $formula->workbook_id;
            $isipkp = PkpProject::where('id_pkp',$formula->workbook_id)->where('status_project','=','active')->get();
            $for    = Forecast::where('id_project',$formula->workbook_id)->get();
            try{// kirim email sample (pengirim, Manager, PV)
                Mail::send('email.infoemailpkp', [
                    'info' => 'R&D telah mengajukan sample untuk Project PKP berikut',
                    'for'  => $for,
                    'app'  => $isipkp,
                ],function($message)use($data){
                    $message->subject('pengajuan sample PKP');
                    $datapkp = PkpProject::where('id_pkp',$data)->where('status_project','=','active')->get();
                    $pkp     = PkpProject::where('id_pkp',$data)->where('status_project','=','active')->first();
                    foreach($datapkp as $data){
                        $dept = DB::table('ms_departements')->where('id',$pkp->tujuankirim)->get();
                        foreach($dept as $dept){
                            $user = User::where('id',$dept->manager_id)->get();
                            $pv   = User::where('id',$pkp->perevisi)->first();
                            foreach($user as $user){
                                $to = [$user->email,$pv->email];
                                $message->to($to);
                            }
                        }
                        $user1 = User::where('id',$data->userpenerima)->get();
                        foreach($user1 as $user1){
                            $cc = [$user1->email,Auth::user()->email];
                            $message->cc($cc);
                        }
                    }
                });
            }
            catch (Exception $e){
                return response (['status' => false,'errors' => $e->getMessage()]);
            }
        }elseif($formula->workbook_pdf_id!=NULL){// jika project yang didkirim adalah project PDF
            $data = ProjectPDF::where('id_project_pdf',$formula->workbook_pdf_id)->first();
            $data->pengajuan_sample = 'sent';
            $data->save();
            
            $data    = $formula->workbook_pdf_id;
            $turunan = SubPDF::where('pdf_id',$wb)->max('turunan');
            $revisi  = SubPDF::where('pdf_id',$wb)->max('revisi');
            $isipdf  = SubPDF::where('pdf_id',$formula->workbook_pdf_id)->where('status_pdf','=','active')->get();
            $for     = Forecast::where('id_pdf',$formula->workbook_pdf_id)->where('revisi',$revisi)->where('turunan',$turunan)->get();
            try{// kirim email sample (pengirim, Manager, PV)
                Mail::send('email.infoemailpdf', [
                    'info' => 'R&D telah mengajukan sample untuk Project PDF berikut',
                    'for'  => $for,
                    'app'  => $isipdf,
                ],function($message)use($data) {
                    $message->subject('Pengajuan PDF sample');
                    $datapdf = ProjectPDF::where('id_project_pdf',$data)->get();
                    $pdf     = SubPDF::where('pdf_id',$data)->where('status_pdf','=','active')->first();
                    foreach($datapdf as $data){
                        $dept = DB::table('ms_departements')->where('id',$data->tujuankirim)->get();
                        foreach($dept as $dept){
                            $user = User::where('id',$dept->manager_id)->get();
                            $pv   = User::where('id',$pdf->perevisi)->first();
                            foreach($user as $user){
                                $to = [$user->email,$pv->email];
                                $message->to($to);
                            }
                        }
                        $user1 = User::where('id',$data->userpenerima)->get();
                        foreach($user1 as $user1){
                            $cc = [$user1->email,Auth::user()->email];
                            $message->cc($cc);
                        }
                    }
                });
            }
            catch (Exception $e){
            return response (['status' => false,'errors' => $e->getMessage()]);
            }
        }
        return Redirect::back()->with('status', 'Formula '.$formula->versi.'.'.$formula->turunan.' Telah Di Ajukan');
    }
}