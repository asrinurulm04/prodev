<?php

namespace App\Http\Controllers\pv;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\model\pkp\PkpProject;
use App\model\pdf\ProjectPDF;
use App\model\promo\promo;
use App\model\manager\pengajuan;
use Charts;
use Auth;

class dasboardController extends Controller
{
    public function dasboardnr(){
        $pkp1       = PkpProject::where('status_project','active')->count();
        $promo1     = promo::all()->count();
        $pdf1       = ProjectPDF::all()->count();
        $pengajuan  = pengajuan::count();
        $hitungpkp  = PkpProject::where('status_pkp','=','draf')->where('status_project','active')->count();
        $hitungpromo= promo::where('status_project','=','draf')->count();
        $promo1     = promo::all()->count();
        $hitungpdf  = ProjectPDF::where('status_project','=','draf')->count();
        $revisi     = PkpProject::where('status_pkp','=','revisi')->where('status_project','active')->count();
        $proses     = PkpProject::where('status_pkp','=','proses')->where('status_project','active')->count();
        $sent       = PkpProject::where('status_pkp','=','sent')->where('status_project','active')->count();
        $close      = PkpProject::where('status_pkp','=','close')->where('status_project','active')->count();
        $pie        = Charts::create('bar', 'highcharts')->title('Data PKP')->colors(['#ff0000', '#ff9000', '#1384fb', '#2afb13', '#d5fb13'])->labels(['draf', 'sent', 'revisi', 'proses', 'close'])
                    ->values([$hitungpkp,$sent,$revisi,$proses,$close])->responsive(false);
        $revisipdf  = ProjectPDF::where('status_project','=','revisi')->count();
        $prosespdf  = ProjectPDF::where('status_project','=','proses')->count();
        $sentpdf    = ProjectPDF::where('status_project','=','sent')->count();
        $closepdf   = ProjectPDF::where('status_project','=','close')->count();
        $pie2       = Charts::create('pie', 'highcharts')->title('Data PDF')->colors(['#ff0000', '#ff9000', '#1384fb', '#2afb13', '#d5fb13'])->labels(['draf', 'sent', 'revisi', 'proses', 'close'])
                    ->values([$hitungpdf,$sentpdf,$revisipdf,$prosespdf,$closepdf])->responsive(false);
        $revisipromo= promo::where('status_project','=','revisi')->count();
        $prosespromo= promo::where('status_project','=','proses')->count();
        $sentpromo  = promo::where('status_project','=','sent')->count();
        $closepromo = promo::where('status_project','=','close')->count();
        $pie3       = Charts::create('area', 'highcharts')->title('Data PKP Promo')->labels(['draf', 'sent', 'revisi', 'proses', 'close'])
			->values([$hitungpromo,$sentpromo,$revisipromo,$prosespromo,$closepromo])->responsive(false);
        return view('RDproduct.dasboard')->with([
            'pkp1'        => $pkp1,
            'promo1'      => $promo1,
            'pie'         => $pie,
            'pie2'        => $pie2,
            'hitungpkp'   => $hitungpkp,
            'hitungpromo' => $hitungpromo,
            'hitungpdf'   => $hitungpdf,
            'pengajuan'   => $pengajuan,
            'pie3'        => $pie3,
            'pdf1'        => $pdf1
        ]);
    }

    public function dasboardpv(){
        $hitungpkp  = PkpProject::where('status_pkp','=','draf')->where('status_project','active')->count();
        $pkp1       = PkpProject::where('status_project','active')->count();
        $hitungpromo= promo::where('status_project','=','draf')->count();
        $promo1     = promo::all()->count();
        $hitungpdf  = ProjectPDF::where('status_project','=','draf')->count();
        $pdf1       = ProjectPDF::all()->count();
        $pengajuan  = pengajuan::count();
        $revisi     = PkpProject::where('status_pkp','=','revisi')->where('status_project','active')->count();
        $proses     = PkpProject::where('status_pkp','=','proses')->where('status_project','active')->count();
        $sent       = PkpProject::where('status_pkp','=','sent')->where('status_project','active')->count();
        $close      = PkpProject::where('status_pkp','=','close')->where('status_project','active')->count();
        $pie        = Charts::create('bar', 'highcharts')->title('Data PKP')->elementlabel("Data PKP")->colors(['#ff0000', '#ff9000', '#1384fb', '#2afb13', '#d5fb13'])->labels(['draf', 'sent', 'revisi', 'proses', 'close'])
                    ->values([$hitungpkp,$sent,$revisi,$proses,$close])->responsive(false);
        $revisipdf  = ProjectPDF::where('status_project','=','revisi')->count();
        $prosespdf  = ProjectPDF::where('status_project','=','proses')->count();
        $sentpdf    = ProjectPDF::where('status_project','=','sent')->count();
        $closepdf   = ProjectPDF::where('status_project','=','close')->count();
        $pie2       = Charts::create('pie', 'highcharts')->title('Data PDF')->elementlabel("Data PDF")->colors(['#ff0000', '#ff9000', '#1384fb', '#2afb13', '#d5fb13'])->labels(['draf', 'sent', 'revisi', 'proses', 'close'])
                    ->values([$hitungpdf,$sentpdf,$revisipdf,$prosespdf,$closepdf])->responsive(false);
        $revisipromo= promo::where('status_project','=','revisi')->count();
        $prosespromo= promo::where('status_project','=','proses')->count();
        $sentpromo  = promo::where('status_project','=','sent')->count();
        $closepromo = promo::where('status_project','=','close')->count();
        $pie3       = Charts::create('area', 'highcharts')->title('Data PKP Promo')->elementlabel("Data PROMO")->labels(['draf', 'sent', 'revisi', 'proses', 'close'])
			        ->values([$hitungpromo,$sentpromo,$revisipromo,$prosespromo,$closepromo])->responsive(false);
        return view('pv.dasboard')->with([
            'hitungpkp'  => $hitungpkp,
            'pkp1'       => $pkp1,
            'hitungpromo'=> $hitungpromo,
            'promo1'     => $promo1,
            'hitungpdf'  => $hitungpdf,
            'pdf1'       => $pdf1,
            'pie'        => $pie,
            'pie2'       => $pie2,
            'pie3'       => $pie3,
            'pengajuan'  => $pengajuan
        ]);
    }
    
    public function dasboardmanager(){
        $hitungpkpselesai2   = PkpProject::where([['status_terima2','=','proses'],['status_project','active'],['status_freeze','inactive'],['tujuankirim2',Auth::user()->Departement->id]])->count();
        $hitungpkpselesai    = PkpProject::where([['status_terima','=','proses'],['status_project','active'],['status_freeze','inactive'],['tujuankirim',Auth::user()->Departement->id]])->count();
        $hitungpdfselesai2   = ProjectPDF::where('status_terima2','=','proses')->where('tujuankirim2',Auth::user()->Departement->id)->count();
        $hitungpdfselesai    = ProjectPDF::where('status_terima','=','proses')->where('tujuankirim',Auth::user()->Departement->id)->count();
        $hitungpromoselesai2 = promo::where('status_terima2','=','proses')->where('tujuankirim2',Auth::user()->Departement->id)->count();
        $hitungpromoselesai  = promo::where('status_terima','=','proses')->where('tujuankirim',Auth::user()->Departement->id)->count();
        $hitungnotif2        = $hitungpkpselesai2 + $hitungpdfselesai2 + $hitungpromoselesai2 ;$hitungnotif = $hitungpkpselesai + $hitungpdfselesai + $hitungpromoselesai;
        // chart PKP
        $revisi              = PkpProject::where('status_pkp','=','revisi')->where('status_project','active')->where('tujuankirim',Auth::user()->Departement->id)->count();
        $proses              = PkpProject::where('status_pkp','=','proses')->where('status_project','active')->where('tujuankirim',Auth::user()->Departement->id)->count();
        $sent                = PkpProject::where('status_pkp','=','sent')->where('status_project','active')->where('tujuankirim',Auth::user()->Departement->id)->count();
        $close               = PkpProject::where('status_pkp','=','close')->where('status_project','active')->where('tujuankirim',Auth::user()->Departement->id)->count();
        $pie                 = Charts::create('bar', 'highcharts')->title('Data PKP')->elementlabel("Data PKP")->colors(['#ff9000', '#1384fb', '#2afb13', '#d5fb13'])->labels(['sent', 'revisi', 'proses', 'close'])->values([$sent,$revisi,$proses,$close])->responsive(false);
        // chart PDF
        $revisipdf           = ProjectPDF::where('status_project','=','revisi')->where('tujuankirim',Auth::user()->Departement->id)->count();
        $prosespdf           = ProjectPDF::where('status_project','=','proses')->where('tujuankirim',Auth::user()->Departement->id)->count();
        $sentpdf             = ProjectPDF::where('status_project','=','sent')->where('tujuankirim',Auth::user()->Departement->id)->count();
        $closepdf            = ProjectPDF::where('status_project','=','close')->where('tujuankirim',Auth::user()->Departement->id)->count();
        $pie2                = Charts::create('pie', 'highcharts')->title('Data PDF')->elementlabel("Data PDF")->colors(['#ff9000', '#1384fb', '#2afb13', '#d5fb13'])->labels(['sent', 'revisi', 'proses', 'close'])->values([$sentpdf,$revisipdf,$prosespdf,$closepdf])->responsive(false);
        // chart promo
        $revisipromo         = promo::where('status_project','=','revisi')->where('tujuankirim',Auth::user()->Departement->id)->count();
        $prosespromo         = promo::where('status_project','=','proses')->where('tujuankirim',Auth::user()->Departement->id)->count();
        $sentpromo           = promo::where('status_project','=','sent')->where('tujuankirim',Auth::user()->Departement->id)->count();
        $closepromo          = promo::where('status_project','=','close')->where('tujuankirim',Auth::user()->Departement->id)->count();
        $pie3                = Charts::create('area', 'highcharts')->title('Data PKP Promo')->elementlabel("Data PROMO")->labels(['sent', 'revisi', 'proses', 'close'])->values([$sentpromo,$revisipromo,$prosespromo,$closepromo])->responsive(false);
        // chart PKP
        $revisi2             = PkpProject::where('status_pkp','=','revisi')->where('status_project','active')->where('tujuankirim2',Auth::user()->Departement->id)->count();
        $proses2             = PkpProject::where('status_pkp','=','proses')->where('status_project','active')->where('tujuankirim2',Auth::user()->Departement->id)->count();
        $sent2               = PkpProject::where('status_pkp','=','sent')->where('status_project','active')->where('tujuankirim2',Auth::user()->Departement->id)->count();
        $close2              = PkpProject::where('status_pkp','=','close')->where('status_project','active')->where('tujuankirim2',Auth::user()->Departement->id)->count();
        $chart1              = Charts::create('bar', 'highcharts')->title('Data PKP')->elementlabel("Data PKP")->colors(['#ff9000', '#1384fb', '#2afb13', '#d5fb13'])->labels(['sent', 'revisi', 'proses', 'close'])->values([$sent2,$revisi2,$proses2,$close2])->responsive(false);
        // chart PDF
        $revisipdf2          = ProjectPDF::where('status_project','=','revisi')->where('tujuankirim2',Auth::user()->Departement->id)->count();
        $prosespdf2          = ProjectPDF::where('status_project','=','proses')->where('tujuankirim2',Auth::user()->Departement->id)->count();
        $sentpdf2            = ProjectPDF::where('status_project','=','sent')->where('tujuankirim2',Auth::user()->Departement->id)->count();
        $closepdf2           = ProjectPDF::where('status_project','=','close')->where('tujuankirim2',Auth::user()->Departement->id)->count();
        $chart2              = Charts::create('pie', 'highcharts')->title('Data PDF')->elementlabel("Data PDF")->colors(['#ff9000', '#1384fb', '#2afb13', '#d5fb13'])->labels(['sent', 'revisi', 'proses', 'close'])->values([$sentpdf2,$revisipdf2,$prosespdf2,$closepdf2])->responsive(false);
        // chart promo
        $revisipromo2        = promo::where('status_project','=','revisi')->where('tujuankirim2',Auth::user()->Departement->id)->count();
        $prosespromo2        = promo::where('status_project','=','proses')->where('tujuankirim2',Auth::user()->Departement->id)->count();
        $sentpromo2          = promo::where('status_project','=','sent')->where('tujuankirim2',Auth::user()->Departement->id)->count();
        $closepromo2         = promo::where('status_project','=','close')->where('tujuankirim2',Auth::user()->Departement->id)->count();
        $chart3              = Charts::create('area', 'highcharts')->title('Data PKP Promo')->elementlabel("Data PROMO")->labels(['sent', 'revisi', 'proses', 'close'])->values([$sentpromo2,$revisipromo2,$prosespromo2,$closepromo2])->responsive(false);
        return view('manager.dasboard')->with([
            'chart1'              => $chart1,
            'chart2'              => $chart2,
            'chart3'              => $chart3,
            'pie'                 => $pie,
            'pie2'                => $pie2,
            'pie3'                => $pie3,
            'hitungnotif'         => $hitungnotif,
            'hitungnotif2'        => $hitungnotif2,
            'hitungpkpselesai'    => $hitungpkpselesai,
            'hitungpkpselesai2'   => $hitungpkpselesai2,
            'hitungpdfselesai'    => $hitungpdfselesai,
            'hitungpdfselesai2'   => $hitungpdfselesai2,
            'hitungpromoselesai'  => $hitungpromoselesai,
            'hitungpromoselesai2' => $hitungpromoselesai2
        ]);
    }

    public function dasboard(){
        $pkp        = PkpProject::where('userpenerima',Auth::user()->id)->where('status_pkp','=','proses')->where('status_project','active')->count();
        $pkp1       = PkpProject::where('userpenerima2',Auth::user()->id)->where('status_pkp','=','proses')->where('status_project','active')->count();
        $datapkp    = $pkp + $pkp1;
        $pdf        = ProjectPDF::where('userpenerima',Auth::user()->id)->where('status_project','=','proses')->count();
        $pdf1       = ProjectPDF::where('userpenerima2',Auth::user()->id)->where('status_project','=','proses')->count();
        $datapdf    = $pdf + $pdf1;
        $promo      = promo::where('userpenerima',Auth::user()->id)->where('status_project','=','proses')->count();
        $promo1     = promo::where('userpenerima2',Auth::user()->id)->where('status_project','=','proses')->count();
        $datapromo  = $promo + $promo1;
        return view('formula.dasboard')->with([
            'pkp'   => $datapkp,
            'pdf'   => $datapdf,
            'promo' => $datapromo
        ]);
    }
}
