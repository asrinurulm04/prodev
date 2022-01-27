<?php

namespace App\Http\Controllers\manager;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Mail;

use App\model\pkp\DataSES;
use App\model\pkp\FileProject;
use App\model\pkp\Forecast;
use App\model\pdf\SubPDF;
use App\model\pdf\kemaspdf;
use App\model\pdf\ProjectPDF;
use App\model\users\User;
use App\model\users\Departement;
use App\model\manager\pengajuan;
use App\model\master\Brand;
use App\model\formula\Formula;
use Redirect;
use DB;
use Auth;

class PdfManagerController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
        $this->middleware('rule:manager' || 'rule:user_produk' );
    }
    
    public function listpdf(){ // halaman list PDF
        $pdf       = ProjectPDF::where('status_project','!=','draf')->join('tr_sub_pdf','tr_sub_pdf.pdf_id','tr_pdf_project.id_project_pdf')->where('status_pdf','=','active')->where('status_data','!=','draf')->orderBy('pdf_number','desc')->get();
        $brand     = Brand::all();
        return view('manager.listpdf')->with([
            'pdf'        => $pdf,
            'brand'      => $brand
        ]);
    }
    
    public function pengajuanpdf(Request $request){ // mengajukan request revisi dari manager RD ke PV
        $pengajuan = new pengajuan;
        $pengajuan->prioritas_pengajuan = $request->prioritas;
        $pengajuan->penerima            = $request->penerima;
        $pengajuan->id_pdf              = $request->pdf;
        $pengajuan->alasan_pengajuan    = $request->catatan;
        $pengajuan->jangka              = $request->jangka;
        $pengajuan->waktu               = $request->waktu;
        $pengajuan->revisi              = $request->revisi;
        $pengajuan->turunan             = $request->turunan;
        $pengajuan->save();

        $pdf = ProjectPDF::where('id_project_pdf',$request->pdf)->first(); // merubah status project
        $pdf->status_project='revisi';
        $pdf->save();

        $turunan = SubPDF::where('pdf_id',$request->pdf)->max('turunan');
        $revisi  = SubPDF::where('pdf_id',$request->pdf)->max('revisi');

        $isipdf  = SubPDF::where('pdf_id',$request->pdf)->where('status_pdf','=','active')->get();
        try{ // mengirim email ke PV
            Mail::send('email.infoemailpdf', [
                'app'   => $isipdf,
                'info'  => 'Manager RD mengajukan revisi pada project PDF berikut',
                'jangka'=> $request->jangka,
                'waktu' => $request->waktu,],function($message)use($request){
                    $message->subject('Revision Request PROJECT PDF');
                    $user = DB::table('tr_users')->where('id',$request->perevisi)->get();
                    foreach($user as $user){
                        $data = $user->email;
                        $message->to($data);
                    }
                });
            }
            catch (Exception $e){
            return response (['status' => false,'errors' => $e->getMessage()]);
        }
        return Redirect::Route('listpdfrka')->with('status','E-mail Successfully');
    }
    
    public function daftarpdf($id_project_pdf){ // halaman draf PDF
        $data       = SubPDF::where('pdf_id',$id_project_pdf)->join('tr_pdf_project','tr_pdf_project.id_project_pdf','tr_sub_pdf.pdf_id')->where('status_pdf','active')->get();
        $dept       = Departement::all();
        $cf         = Formula::where('workbook_pdf_id',$id_project_pdf)->count();
        $sample     = Formula::where('workbook_pdf_id', $id_project_pdf)->orderBy('versi','asc')->orderBy('turunan','asc')->get();
        $max        = SubPDF::where('pdf_id',$id_project_pdf)->max('turunan');
        $id         = ProjectPDF::where('id_project_pdf',$id_project_pdf)->first();
        $max2       = SubPDF::where('pdf_id',$id_project_pdf)->max('revisi');
        $pdf        = ProjectPDF::where('id_project_pdf',$id_project_pdf)->join('tr_sub_pdf','tr_pdf_project.id_project_pdf','tr_sub_pdf.pdf_id')->where('revisi',$max2)->where('turunan',$max)->get();
        return view('manager.daftarpdf')->with([
            'data'        => $data,
            'dept'        => $dept,
            'pdf'         => $pdf,
            'cf'          => $cf,
            'id'          => $id,
            'sample'      => $sample
        ]);
    }
    
    public function lihatpdf($id_project_pdf,$revisi,$turunan){ // halaman detail project PDF
        $ses             = DataSES::where([ ['id_pdf',$id_project_pdf], ['revisi',$revisi], ['turunan',$turunan] ])->get();
        $pdf1            = SubPDF::where('pdf_id',$id_project_pdf)->where('revisi','<=',$revisi)->where('turunan','<=',$turunan)->orderBy('revisi','desc')->get();
        $pdf             = SubPDF::join('tr_pdf_project','tr_sub_pdf.pdf_id','=','tr_pdf_project.id_project_pdf')->where('id_project_pdf',$id_project_pdf)->where('revisi',$revisi)->where('turunan',$turunan)->get();
        $id_pdf          = SubPDF::where([ ['pdf_id',$id_project_pdf], ['revisi',$revisi], ['turunan',$turunan] ])->first();
        $for             = Forecast::where('id_pdf',$id_project_pdf)->where('revisi','=',$revisi)->where('turunan','=',$turunan)->get();
        $kemaspdf        = kemaspdf::where('id_pdf',$id_project_pdf)->where('revisi','=',$revisi)->where('turunan','=',$turunan)->get();
        $dept            = Departement::all();
        $user            = DB::table('tr_users') ->where('departement_id',Auth::user()->departement->id)->get();
        $picture         = FileProject::where('pdf_id',$id_project_pdf)->get();
        $hitung          = pengajuan::where([ ['id_pdf',$id_project_pdf],['revisi',$revisi], ['turunan',$turunan] ])->count();
        $hitungkemaspdf  = kemaspdf::where('id_pdf',$id_project_pdf)->where('revisi','=',$revisi)->where('turunan','=',$turunan)->count();
        return view('manager.lihatpdf')->with([
            'pdf'               => $pdf,
            'pdf1'              => $pdf1,
            'dept'              => $dept,
            'for'               => $for,
            'kemaspdf'          => $kemaspdf,
            'hitungkemaspdf'    => $hitungkemaspdf,
            'hitung'            => $hitung,
            'datases'           => $ses,
            'user'              => $user,
            'picture'           => $picture
        ]); 
    }
    
    public function alihkanpdf(Request $request,$id_project_pdf){ // mengalihkan projet PDF ke manager dept berbeda
        $pdf = ProjectPDF::where('id_project_pdf',$id_project_pdf)->first();
        $pdf->tujuankirim       = $request->tujuankirim;
        $pdf->tujuankirim2      = $request->tujuankirim2;
        $pdf->userpenerima2     = null;
        $pdf->userpenerima      = null;
        $pdf->pengajuan_sample  = 'proses';
        $pdf->status_terima     = 'proses';
        $pdf->status_project    = 'sent';
        $pdf->status_terima2    = 'proses';
        $pdf->save();

        return redirect::Route('listpdfrka');
    }
    
    public function approve2(Request $request,$id_project_pdf){ //approve project dari manager product
        $pdf = ProjectPDF::where('id_project_pdf',$id_project_pdf)->first();
        $pdf->status_terima2='terima';
        $pdf->save();

        return redirect::back();
    }
    
    public function approve1(Request $request,$id_project_pdf){ // approve project dari manager kemass
        $pdf = ProjectPDF::where('id_project_pdf',$id_project_pdf)->first();
        $pdf->status_terima = 'terima';
        $pdf->save();

        return redirect::back();
    }
}