<?php

namespace App\Http\Controllers\devwb;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Mail;

use App\model\users\User;
use App\model\modelfn\finance;
use App\model\dev\Formula;
use App\model\pkp\project_pdf;
use App\model\pkp\pkp_project;
use App\model\pkp\data_forecast;
use App\model\pkp\tipp;
use App\model\pkp\coba;
use App\model\dev\Fortail;
use Auth;
use Redirect;
use DB;

class pengajuansampleController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
        $this->middleware('rule:pv_lokal' || 'rule:pv_global' );
    }

    public function approvesample(Request $request,$id_sample){
        $for = Formula::where('id',$id_sample)->first();
        $for->vv='approve';
        $for->catatan_pv=$request->note;
        $for->save();

        if($for->workbook_id!=NULL){
            $data = $for->workbook_id;
            $turunan = tipp::where('id_pkp',$data)->max('turunan');
            $revisi =tipp::where('id_pkp',$data)->max('revisi');
            // kirim email sample (pengirim, Manager, PV)
            $isipkp = tipp::where('id_pkp',$for->workbook_id)->where('status_data','=','active')->get();
            $for = data_forecast::where('id_pkp',$for->workbook_id)->where('revisi',$revisi)->where('turunan',$turunan)->get();
            try{
                Mail::send('manager.infoemailpkp', [
                    'info' => 'Sample yang anda ajukan disetujui dengan catatan "'.$request->note.'"',
                    'for' => $for,
                    'app'=>$isipkp,],function($message)use($data)
                {
                    $message->subject('Approve PKP sample');
                    $datapkp = pkp_project::where('id_project',$data)->get();
                    foreach($datapkp as $data){
                        $dept = DB::table('ms_departements')->where('id',$data->tujuankirim)->get();
                        foreach($dept as $dept){
                            $user = user::where('id',$dept->manager_id)->get();
                            foreach($user as $user){
                                $to = $user->email;
                                $message->to($to);
                            }
                        }
                        $user1 = user::where('id',$data->userpenerima)->get();
                        foreach($user1 as $user1){
                            $cc = [$user1->email,Auth::user()->email];
                            $message->cc($cc);
                        }
                    }
                });
                return back()->with('status','E-mail Successfully');
            }
            catch (Exception $e){
                return response (['status' => false,'errors' => $e->getMessage()]);
            }
        }if($for->workbook_pdf_id!=NULL){
            $data = $for->workbook_pdf_id;
            $turunan = coba::where('pdf_id',$data)->max('turunan');
            $revisi =coba::where('pdf_id',$data)->max('revisi');
            // kirim email sample (pengirim, Manager, PV)
            $isipdf = coba::where('pdf_id',$for->workbook_pdf_id)->where('status_pdf','=','active')->get();
            $for = data_forecast::where('id_pdf',$for->workbook_pdf_id)->where('revisi',$revisi)->where('turunan',$turunan)->get();
            try{
                Mail::send('manager.infoemailpdf', [
                    'info' => 'Sample yang anda ajukan disetujui dengan catatan "'.$request->note.'"',
                    'for' => $for,
                    'app'=>$isipdf,],function($message)use($data)
                {
                    $message->subject('Approve PDF sample');
                    $datapdf = project_pdf::where('id_project_pdf',$data)->get();
                    foreach($datapdf as $data){
                        $dept = DB::table('ms_departements')->where('id',$data->tujuankirim)->get();
                        foreach($dept as $dept){
                            $user = user::where('id',$dept->manager_id)->get();
                            foreach($user as $user){
                                $to = $user->email;
                                $message->to($to);
                            }
                        }
                        $user1 = user::where('id',$data->userpenerima)->get();
                        foreach($user1 as $user1){
                            $cc = [$user1->email,Auth::user()->email];
                            $message->cc($cc);
                        }
                    }
                });
                return back()->with('status','E-mail Successfully');
            }
            catch (Exception $e){
            return response (['status' => false,'errors' => $e->getMessage()]);
            }
        }
        
        return redirect::back();
    }

    public function unfinalsample($for){
        $pkp = Formula::where('id',$for)->first();
        $pkp->vv='approve';
        $pkp->save();

        return redirect::back();
    }

    public function finalsample($id_sample){
        $pkp = Formula::where('id',$id_sample)->first();
        $pkp->vv='final';
        $pkp->save();

        return redirect::back();
    }

    public function rejectsample(Request $request,$id_sample){
        $for = Formula::where('id',$id_sample)->first();
        $for->vv='reject';
        $for->catatan_pv=$request->note;
        $for->save();

        if($for->workbook_id!=NULL){
            $data = $for->workbook_id;
            $turunan = tipp::where('id_pkp',$for->workbook_id)->max('turunan');
            $revisi =tipp::where('id_pkp',$for->workbook_id)->max('revisi');
            // kirim email sample (pengirim, Manager, PV)
            $isipkp = tipp::where('id_pkp',$for->workbook_id)->where('status_data','=','active')->get();
            $for = data_forecast::where('id_pkp',$for->workbook_id)->where('revisi',$revisi)->where('turunan',$turunan)->get();
            try{
                Mail::send('manager.infoemailpkp', [
                    'info' => 'Sample yang anda ajukan ditolah dengan catatan "'.$request->note.'"',
                    'for' => $for,
                    'app'=>$isipkp,],function($message)use($data)
                {
                    $message->subject('Reject PKP sample');
                    $datapkp = pkp_project::where('id_project',$data)->get();
                    foreach($datapkp as $data){
                        $dept = DB::table('ms_departements')->where('id',$data->tujuankirim)->get();
                        foreach($dept as $dept){
                            $user = user::where('id',$dept->manager_id)->get();
                            foreach($user as $user){
                                $to = $user->email;
                                $message->to($to);
                            }
                        }
                        $user1 = user::where('id',$data->userpenerima)->get();
                        foreach($user1 as $user1){
                            $cc = [$user1->email,Auth::user()->email];
                            $message->cc($cc);
                        }
                    }
                });
                return back()->with('status','E-mail Successfully');
            }
            catch (Exception $e){
                return response (['status' => false,'errors' => $e->getMessage()]);
            }
        }if($for->workbook_pdf_id!=NULL){
            $data = $for->workbook_pdf_id;
            $turunan = coba::where('pdf_id',$for->workbook_pdf_id)->max('turunan');
            $revisi =coba::where('pdf_id',$for->workbook_pdf_id)->max('revisi');
            // kirim email sample (pengirim, Manager, PV)
            $isipdf = coba::where('pdf_id',$for->workbook_pdf_id)->where('status_pdf','=','active')->get();
            $for = data_forecast::where('id_pdf',$for->workbook_pdf_id)->where('revisi',$revisi)->where('turunan',$turunan)->get();
            try{
                Mail::send('manager.infoemailpdf', [
                    'info' => 'Sample yang anda ajukan ditolah dengan catatan "'.$request->note.'"',
                    'for' => $for,
                    'app'=>$isipdf,],function($message)use($data)
                {
                    $message->subject('Reject PDF sample');
                    $datapdf = project_pdf::where('id_project_pdf',$data)->get();
                    foreach($datapdf as $data){
                        $dept = DB::table('ms_departements')->where('id',$data->tujuankirim)->get();
                        foreach($dept as $dept){
                            $user = user::where('id',$dept->manager_id)->get();
                            foreach($user as $user){
                                $to = $user->email;
                                $message->to($to);
                            }
                        }
                        $user1 = user::where('id',$data->userpenerima)->get();
                        foreach($user1 as $user1){
                            $cc = [$user1->email,Auth::user()->email];
                            $message->cc($cc);
                        }
                    }
                });
                return back()->with('status','E-mail Successfully');
            }
            catch (Exception $e){
            return response (['status' => false,'errors' => $e->getMessage()]);
            }
        }

        return redirect::back();
    }

    public function approvefs($id_sample){
        $for = ormula::where('id',$id_sample)->first();
        $for->status_fisibility='approve';
        $for->save();

        $fs = feasibility::where('id_formula',$id_project)->first();
        $fs->status_feasibility='approve';
        $fs->save();

        return redirect::back();
    }

    public function vp(Request $request,$wb,$id){
        $formula = Formula::where('id',$id)->first();

        $ada = Fortail::where('formula_id',$formula->id)->count();
        if($ada < 1){
            return Redirect::back()->with('error','Data Bahan Formula Versi '.$formula->versi.' Masih Kosong');
        }elseif($formula->batch < 1){
            return Redirect::back()->with('error','Data Bahan Formula Versi '.$formula->versi.'.'.$formula->turunan.' Belum Memliki Batch');
        }elseif($formula->note_formula == Null){
            return Redirect::back()->with('error','Note Formula untuk versi '.$formula->versi.'.'.$formula->turunan.' Masih Kosong');
        }

        $formula->vv = 'proses';
        $formula->status = 'proses';
        $formula->save();

        if($formula->workbook_id!=NULL){
            $data = pkp_project::where('id_project',$wb)->first();
            $data->pengajuan_sample='sent';
            $data->save();
        }if($formula->workbook_pdf_id!=NULL){
            $data = project_pdf::where('id_project_pdf',$wb)->first();
            $data->pengajuan_sample='sent';
            $data->save();
        }

        if($formula->workbook_id!=NULL){
            $data = $formula->workbook_id;
            $turunan = tipp::where('id_pkp',$wb)->max('turunan');
            $revisi =tipp::where('id_pkp',$wb)->max('revisi');
            // kirim email sample (pengirim, Manager, PV)
            $isipkp = tipp::where('id_pkp',$formula->workbook_id)->where('status_data','=','active')->get();
            $for = data_forecast::where('id_pkp',$formula->workbook_id)->where('revisi',$revisi)->where('turunan',$turunan)->get();
            try{
                Mail::send('manager.infoemailpkp', [
                    'info' => 'R&D telah mengajukan sample untuk Project PKP berikut',
                    'for' => $for,
                    'app'=>$isipkp,],function($message)use($data)
                {
                    $message->subject('pengajuan sample PKP');
                    $datapkp = pkp_project::where('id_project',$data)->get();
                    foreach($datapkp as $data){
                        $dept = DB::table('ms_departements')->where('id',$data->tujuankirim)->get();
                        foreach($dept as $dept){
                            $user = user::where('id',$dept->manager_id)->get();
                            foreach($user as $user){
                                $to = $user->email;
                                $message->to($to);
                            }
                        }
                        $user1 = user::where('id',$data->userpenerima)->get();
                        foreach($user1 as $user1){
                            $cc = [$user1->email,Auth::user()->email];
                            $message->cc($cc);
                        }
                    }
                });
                return back()->with('status','E-mail Successfully');
            }
            catch (Exception $e){
                return response (['status' => false,'errors' => $e->getMessage()]);
            }
        }if($formula->workbook_pdf_id!=NULL){
            $data = $formula->workbook_pdf_id;
            $turunan = coba::where('pdf_id',$wb)->max('turunan');
            $revisi =coba::where('pdf_id',$wb)->max('revisi');
            // kirim email sample (pengirim, Manager, PV)
            $isipdf = coba::where('pdf_id',$formula->workbook_pdf_id)->where('status_pdf','=','active')->get();
            $for = data_forecast::where('id_pdf',$formula->workbook_pdf_id)->where('revisi',$revisi)->where('turunan',$turunan)->get();
            try{
                Mail::send('manager.infoemailpdf', [
                    'info' => 'R&D telah mengajukan sample untuk Project PDF berikut',
                    'for' => $for,
                    'app'=>$isipdf,],function($message)use($data)
                {
                    $message->subject('Pengajuan PDF sample');
                    $datapdf = project_pdf::where('id_project_pdf',$data)->get();
                    foreach($datapdf as $data){
                        $dept = DB::table('ms_departements')->where('id',$data->tujuankirim)->get();
                        foreach($dept as $dept){
                            $user = user::where('id',$dept->manager_id)->get();
                            foreach($user as $user){
                                $to = $user->email;
                                $message->to($to);
                            }
                        }
                        $user1 = user::where('id',$data->userpenerima)->get();
                        foreach($user1 as $user1){
                            $cc = [$user1->email,Auth::user()->email];
                            $message->cc($cc);
                        }
                    }
                });
                return back()->with('status','E-mail Successfully');
            }
            catch (Exception $e){
            return response (['status' => false,'errors' => $e->getMessage()]);
            }
        }
        return Redirect::back()->with('status', 'Formula '.$formula->versi.'.'.$formula->turunan.' Telah Di Ajukan VP');
    }
}