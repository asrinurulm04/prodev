<?php

namespace App\Http\Controllers\formula;
use Illuminate\Support\Facades\Mail;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\model\pkp\PkpProject;
use App\model\pdf\ProjectPDF;
use App\model\master\Teams;
use App\model\formula\Formula;
use App\model\formula\panel;
use App\model\formula\hasilpanel;
use Auth;
use Redirect;
use DB;

class panelController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
        $this->middleware('rule:user_rd_proses' || 'rule:user_produk');
    }

    public function hasil(Request $request){ // menambahkan data hasil panel
        $add_panel = new hasilpanel;
        $add_panel->id_formula  = $request->idf;
        $add_panel->id_wb       = $request->wb;
        $add_panel->id_wb_pdf   = $request->wb_pdf;
        $add_panel->panel       = $request->panel;
        $add_panel->tgl_panel   = $request->date;
        $add_panel->hus         = $request->hus;
        $add_panel->status      = 'proses';
        $add_panel->kesimpulan  = $request->kesimpulan;
        $add_panel->save();

        return redirect()->back()->with('status', 'panel '.' Telah Ditambahkan!');
    }

    public function panel($formula,$pkp,$id){ // halaman panel
        $idfor     = $formula;
        $myFormula = Formula::where('id',$formula)->first();
        $panel     = panel::all();
        $pn        = hasilpanel::where('id_formula',$formula)->get();
        $cek_panel = hasilpanel::where('id_formula',$formula)->count();
        return view('formula.panel')->with([
            'myFormula' => $myFormula,
            'id'        => $id,
            'idfor'     => $idfor,
            'pkp'       => $pkp,
            'pn'        => $pn,
            'panel'     => $panel,
            'cek_panel' => $cek_panel
            ]);
    }

    public function hapuspanel($id){ // hapus data panels
        $panel = hasilpanel::where('id',$id)->delete();
        return redirect::back()->with('status', 'panel '.' Telah Dihapus!');
    }

    public function editpanel(Request $request,$id){ // edit data panel
        $panel = hasilpanel::where('id',$id)->first();
        $panel->panel      = $request->panel;
        $panel->tgl_panel  = $request->date;
        $panel->hus        = $request->hus;
        $panel->kesimpulan = $request->kesimpulan;
        $panel->save();

        return redirect()->back()->with('status', 'panel '.' Telah Ditambahkan!');
    }

    public function ajukanpanel(Request $request,$id_formula,$id_panel){ // mengajuan hasil panel yang telah di buat ke PV
        $formula = Formula::where('id',$id_formula)->first();
        $formula->status_panel='sent';
        $formula->save();
        
        $panel = hasilpanel::where('id',$id_panel)->first();
        $panel->status='done';
        $panel->save();

        $isipanel = hasilpanel::where('id',$id_panel)->first();
        try{ // mengirim email pemberitahuan untuk PV jika user telah mengirimkan data panel untuk formula
            Mail::send('email.emailpanel', [
                'app'     => $isipanel,
                'formula' => $formula,
                'info'    => 'RD telah selesai membuat data panel untuk project ini',
            ],function($message)use($request,$id_formula){
                $message->subject('INFO PANEL PRODEV');
                $for = Formula::where('id',$id_formula)->first();
                if($for->id_wb!=NULL){ // ketika workbook yang di ajukan adalah project PKP
                    $project = PkpProject::where('id_project',$for->workbook_id)->first();
                    $teams   = Teams::where('brand',$project->id_brand)->get();
                    foreach($teams as $teams){
                        $user = DB::table('tr_users')->where('id',$teams->id_user)->get();
                        foreach($user as $user){
                            $data = $user->email;
                            $message->to($data);
                        }
                    }
                    $dept = DB::table('ms_departements')->where('id',$project->tujuankirim)->get();
                    foreach($dept as $dept){
                        $user = DB::table('tr_users')->where('id',$dept->manager_id)->get();
                        foreach($user as $user){
                            $data = $user->email;
                            $cc   = [$data,Auth::user()->email,'asrinurul4238@gmail.com'];
                            $message->cc($cc);
                        }
                    }
                }elseif($for->id_wb_pdf!=NULL){ // ketika workbook yang di ajukan adalah project PDF
                    $user = DB::table('tr_users')->where('role_id','5')->get();
                    foreach($user as $user){
                        $data = $user->email;
                        $message->to($data);
                    }
                    $project = ProjectPDF::where('id_project_pdf',$for->workbook_pdf_id)->first();
                    $dept    = DB::table('ms_departements')->where('id',$project->tujuankirim)->get();
                    foreach($dept as $dept){
                        $user = DB::table('tr_users')->where('id',$dept->manager_id)->get();
                        foreach($user as $user){
                            $data = $user->email;
                            $cc   = [$data,Auth::user()->email,'asrinurul4238@gmail.com'];
                            $message->cc($cc);
                        }
                    }
                }
            });
        }
        catch (Exception $e){
        return response (['status' => false,'errors' => $e->getMessage()]);
        }
        return redirect()->back();
    }
}