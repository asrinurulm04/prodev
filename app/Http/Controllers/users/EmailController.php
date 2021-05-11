<?php

namespace App\Http\Controllers\users;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Mail;

use App\model\pkp\PkpProject;
use App\model\pkp\ProjectPDF;
use App\model\pkp\DataSES;
use App\model\pkp\SES;
use App\model\pkp\PromoIdea;
use App\model\pkp\Promo;
use App\model\pkp\Allocation;
use App\model\pkp\DataPromo;
use App\model\pkp\SubPDF;
use App\model\pkp\kemaspdf;
use App\model\pkp\klaim;
use App\model\pkp\DataKlaim;
use App\model\pkp\DetailKlaim;
use App\model\pkp\SubPKP;
use App\model\pkp\FileProject;
use App\model\pkp\Forecast;
use App\model\users\User;
use Redirect;
use DB;

class EmailController extends Controller
{
    public function sendEmail(Request $request,$id)
    {
        $active = user::where('id',$id)->first();
        $active->status=$request->status;
        $active->save();
        try{
            Mail::send('email', ['nama'=>$request->nama,'role'=>$request->role,'pesan'=>$request->pesan,'email'=>$request->email,'username'=>$request->username,'dept'=>$request->dept,],function($message)use($request)
            {
                $message->subject($request->judul);
                $message->to($request->email);
            });
            return back()->with('status','Berhasil Kirim Email');
        }
        catch (Exception $e){
        return response (['status' => false,'errors' => $e->getMessage()]);
        }
    }

    public function sendEmailreject(Request $request,$id)
    {
        $active = user::where('id',$id)->first();
        $active->delete();
        try{
            Mail::send('email', ['nama'=>$request->nama,'role'=>$request->role,'pesan'=>$request->pesan,'email'=>$request->email,'username'=>$request->username,'dept'=>$request->dept,],function($message)use($request)
            {
                $message->subject($request->judul);
                $message->to($request->email);
            });
            return back()->with('status','Berhasil Kirim Email');
        }
        catch (Exception $e){
        return response (['status' => false,'errors' => $e->getMessage()]);
        }
    }

    public function emailpdf(Request $request,$id_project_pdf,$revisi, $turunan){
        $datapdf = SubPDF::where('pdf_id',$id_project_pdf)->count();
        $pdf1 = SubPDF::where('pdf_id',$id_project_pdf)->where('revisi',$revisi)->where('turunan',$turunan)->get();
        $pdf = ProjectPDF::join('tr_sub_pdf','tr_sub_pdf.pdf_id','=','tr_pdf_project.id_project_pdf')->where('id_project_pdf',$id_project_pdf)->where('revisi',$revisi)->where('turunan',$turunan)->get();
        $id_pdf = SubPDF::where([ ['pdf_id',$id_project_pdf], ['revisi',$revisi], ['turunan',$turunan] ])->first();
        $for = Forecast::where('id_pdf',$id_project_pdf)->where('revisi',$revisi)->where('turunan',$turunan)->get();
        $ses = DataSES::where([ ['id_pdf',$id_project_pdf], ['revisi',$revisi], ['turunan',$turunan] ])->get();
        $picture = FileProject::where('pdf_id',$id_project_pdf)->where('revisi','<=',$revisi)->where('turunan','<=',$turunan)->get();
        $kemaspdf = kemaspdf::where('id_pdf',$id_project_pdf)->where('revisi','=',$revisi)->where('turunan','=',$turunan)->get();
        $dataklaim = DataKlaim::where('id_pdf',$id_project_pdf)->join('ms_klaim','ms_klaim.id','=','id_klaim')->where('revisi',$revisi)->where('turunan',$turunan)->get();
        $datadetail = DetailKlaim::where('id_pdf',$id_project_pdf)->where('revisi',$revisi)->where('turunan',$turunan)->get();
        $hitungkemaspdf = kemaspdf::where('id_pdf',$id_project_pdf)->where('revisi','=',$revisi)->where('turunan','=',$turunan)->count();
        try{
            Mail::send('pv.pdfemail', [
                'pdf' => $pdf,
                'pdf1' => $pdf1,
                'datadetail' => $datadetail,
                'dataklaim' => $dataklaim,
                'datases' => $ses,
                'for' => $for,
                'datapdf' => $datapdf,
                'kemaspdf' => $kemaspdf,
                'hitungkemaspdf' => $hitungkemaspdf,
                'picture' => $picture,], function ($message) use ($request)
                {
                    $data = [$request->pengirim,$request->pengirim1,$request->pengirim2];
                    $message->subject($request->judul);
                    $message->to($request->email);
                    $message->cc($data);

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
                }}
                });
            return back()->with('status','E-mail Successfully');
        }
        catch (Exception $e){
            return response (['status' => false,'errors' => $e->getMessage()]);
        }
    }

    public function emailpromo(Request $request,$id_pkp_promo,$revisi, $turunan){
        $promo1 = DataPromo::where('id_pkp_promoo',$id_pkp_promo)->where('revisi',$revisi)->where('turunan',$turunan)->first();
        $app = Allocation::where('id_pkp_promo',$id_pkp_promo)->where('revisi',$revisi)->where('turunan',$turunan)->get();
        $idea = PromoIdea::where('id_promo',$id_pkp_promo)->where('turunan',$turunan)->where('revisi',$revisi)->get();
        $allocation = Allocation::where([ ['id_pkp_promo',$id_pkp_promo], ['revisi',$revisi], ['turunan',$turunan]])->get();
        $picture = FileProject::where('promo',$id_pkp_promo)->where('revisi',$revisi)->where('turunan',$turunan)->get();
        try{
            Mail::send('pv.promoemail', [
                'promo' => $promo1,
                'app' => $app,
                'idea' => $idea,
                'picture' => $picture,
                'allocation' => $allocation,], function ($message) use ($request)
            {
                $data = [$request->pengirim,$request->pengirim1,$request->pengirim2];
                $message->subject($request->judul);
                $message->to($request->email);
                $message->cc($data);

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
                 } }
            });
            return back()->with('status','E-mail Successfully');
        }
        catch (Exception $e){
        return response (['status' => false,'errors' => $e->getMessage()]);
        }
    }

    public function emailpkp(Request $request,$id_project,$revisi, $turunan){
        $id_pkp = SubPKP::where([ ['id_pkp',$id_project], ['revisi',$revisi], ['turunan',$turunan] ])->first();
        $for = Forecast::where([ ['id_pkp',$id_project], ['revisi',$revisi], ['turunan',$turunan] ])->get();
        $dataklaim = DataKlaim::where('id_pkp',$id_project)->join('ms_klaim','ms_klaim.id','=','id_klaim')->where('revisi',$revisi)->where('turunan',$turunan)->get();
        $pkpp = SubPKP::join('tr_project_pkp','tr_sub_pkp.id_pkp','=','tr_project_pkp.id_project')->where([ ['id_pkp',$id_project], ['revisi',$revisi], ['turunan',$turunan] ])->first();
        $ses= DataSES::where([ ['id_pkp',$id_project], ['revisi',$revisi], ['turunan',$turunan] ])->orderBy('revisi','desc')->orderBy('turunan','desc')->get();
        $datadetail = DetailKlaim::where('id_pkp',$id_project)->where('revisi',$revisi)->where('turunan',$turunan)->get();
        $picture = FileProject::where('pkp_id',$id_project)->where('revisi',$revisi)->where('turunan',$turunan)->get();
        try{
            Mail::send('pv.emailpkp', [
            'pkp' => $pkpp,
            'datases' => $ses,
            'for' => $for,
            'datadetail' => $datadetail,
            'dataklaim' => $dataklaim,
            'picture' => $picture,], function ($message) use ($request)
            {
                $data = [$request->pengirim,$request->pengirim1,$request->pengirim2];
                $message->subject($request->judul);
                $message->to($request->email);
                $message->cc($data);

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
                }}
            });
            return back()->with('status','E-mail Successfully');
        }
        catch (Exception $e){
        return response (['status' => false,'errors' => $e->getMessage()]);
        }
    }

    public function approveemailpkp(Request $request,$id_project){
        $turunan = SubPKP::where('id_pkp',$id_project)->max('turunan');
        $revisi =SubPKP::where('id_pkp',$id_project)->max('revisi');
        $data = SubPKP::where('id_pkp',$id_project)->where('status_data','active')->first();

        $app1 = PkpProject::where('id_project',$id_project)->first();
        $app1->approval='approve';
        $app1->save();

        $for = Forecast::where('id_pkp',$data->id)->get();
        $isipkp = SubPKP::where('id_pkp',$id_project)->where('status_data','=','active')->get();
        try{
            Mail::send('manager.infoemailpkp', [
                'info'=>'selamat project anda telah disetujui.',
                'for' => $for,
                'app'=>$isipkp,
            ],function($message)use($request,$id_project)
            {
                $message->subject('INFO PRODEV');
                $pkp = SubPKP::where('id_pkp',$id_project)->where('status_data','=','active')->get();
                foreach($pkp as $pkp){
                    $user = DB::table('tr_users')->where('id',$pkp->perevisi)->get();
                    foreach($user as $user){
                        $data = $user->email;
                        $message->to($data);
                    }
                }
            });
            return redirect::route('REmail');
        }
        catch (Exception $e){
        return response (['status' => false,'errors' => $e->getMessage()]);
        }

        return redirect::route('REmail');
    }

    public function rejectemailpkp(Request $request,$id_project){
        $turunan = SubPKP::where('id_pkp',$id_project)->max('turunan');
        $revisi =SubPKP::where('id_pkp',$id_project)->max('revisi');
        $data = SubPKP::where('id_pkp',$id_project)->where('status_data','active')->first();

        $app = PkpProject::where('id_project',$id_project)->first();
        $app->approval='reject';
        $app->save();

        $for = Forecast::where('id_pkp',$data->id)->get();
        $isipkp = SubPKP::where('id_pkp',$id_project)->where('status_data','=','active')->get();
        try{
            Mail::send('manager.infoemailpkp', [
                'info'=>'Project anda di tolak, silahkan hubungi pihak yang bersangkutan.',
                'for' => $for,
                'app'=>$isipkp,
            ],function($message)use($request,$id_project)
            {
                $message->subject('INFO PRODEV');
                $pkp = SubPKP::where('id_pkp',$id_project)->where('status_data','=','active')->get();
                foreach($pkp as $pkp){
                    $user = DB::table('tr_users')->where('id',$pkp->perevisi)->get();
                    foreach($user as $user){
                        $data = $user->email;
                        $message->to($data);
                    }
                }
            });
            return redirect::route('REmail');
        }
        catch (Exception $e){
        return response (['status' => false,'errors' => $e->getMessage()]);
        }

    }

    public function approveemailpdf(Request $request,$id_project_pdf){
        $app = ProjectPDF::where('id_project_pdf',$id_project_pdf)->first();
        $app->approval='approve';
        $app->save();

        $isipdf = SubPDF::where('pdf_id',$id_project_pdf)->where('status_pdf','=','active')->get();
        try{
            Mail::send('manager.infoemailpdf', [
                'info'=>'selamat project anda telah disetujui.',
                'app'=>$isipdf,
            ],function($message)use($request,$id_project_pdf)
            {
                $message->subject('INFO PRODEV');
                $pdf = SubPDF::where('pdf_id',$id_project_pdf)->where('status_pdf','=','active')->get();
                foreach($pdf as $pdf){
                    $user = DB::table('tr_users')->where('id',$pdf->perevisi)->get();
                    foreach($user as $user){
                        $data = $user->email;
                        $message->to($data);
                    }
                }
            });
            return redirect::route('REmail');
        }
        catch (Exception $e){
        return response (['status' => false,'errors' => $e->getMessage()]);
        }

        return redirect::route('REmail');
    }

    public function rejectemailpdf($id_project_pdf){
        $app = ProjectPDF::where('id_project_pdf',$id_project_pdf)->first();
        $app->approval='reject';
        $app->save();

        $notif = notification::where('id_pdf',$id_project_pdf)->first();
        $notif->id_pdf=$id_project_pdf;
        $notif->title="The PDF Project is rejected";
        $notif->status='active';
        $notif->save();

        $isipdf = SubPDF::where('pdf_id',$id_project_pdf)->where('status_pdf','=','active')->get();
        try{
            Mail::send('manager.infoemailpdf', [
                'info'=>'selamat project anda telah disetujui!',
                'app'=>$isipdf,
            ],function($message)use($request,$id_project_pdf)
            {
                $message->subject('INFO PRODEV');
                $pdf = SubPDF::where('pdf_id',$id_project_pdf)->where('status_pdf','=','active')->get();
                foreach($pdf as $pdf){
                    $user = DB::table('tr_users')->where('id',$pdf->perevisi)->get();
                    foreach($user as $user){
                        $data = $user->email;
                        $message->to($data);
                    }
                }
            });
            return redirect::route('REmail');
        }
        catch (Exception $e){
        return response (['status' => false,'errors' => $e->getMessage()]);
        }
    }

    public function approveemailpromo(Request $request,$id_pkp_promo){
        $app = Promo::where('id_pkp_promo',$id_pkp_promo)->first();
        $app->approval='approve';
        $app->save();

        $isipromo = DataPromo::where('id_pkp_promoo',$id_pkp_promo)->where('status_data','=','active')->get();
        try{
            Mail::send('manager.infoemailpromo', [
                'info'=>'selamat project anda telah disetujui.',
                'app'=>$isipromo,
            ],function($message)use($request,$id_pkp_promo)
            {
                $message->subject('INFO PRODEV');
                $promo = DataPromo::where('id_pkp_promoo',$id_pkp_promo)->where('status_data','=','active')->get();
                foreach($promo as $promo){
                    $user = DB::table('tr_users')->where('id',$promo->perevisi)->get();
                    foreach($user as $user){
                        $data = $user->email;
                        $message->to($data);
                    }
                }
            });
            return redirect::route('REmail');
        }
        catch (Exception $e){
        return response (['status' => false,'errors' => $e->getMessage()]);
        }

        return redirect::route('REmail');
    }

    public function rejectemailpromo($id_pkp_promo){
        $app = Promo::where('id_pkp_promo',$id_pkp_promo)->first();
        $app->approval='reject';
        $app->save();

        $notif = notification::where('id_promo',$id_pkp_promo)->first();
        $notif->id_PROMO=$id_pkp_promo;
        $notif->title="The PROMO Project is rejected";
        $notif->status='active';
        $notif->save();
    }

    public function REmail(){
        return view('pkp.REmail');
    }
}