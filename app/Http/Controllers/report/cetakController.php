<?php

namespace App\Http\Controllers\report;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use Illuminate\Support\Facades\Validator;
use App\model\pdf\SubPDF;
use App\model\pdf\ProjectPDF;
use App\model\pkp\notulen;
use App\model\pkp\PkpProject;
use App\model\pkp\NoteForecast;
use App\model\users\Departement;
use App\model\users\User;
use DB;
use Auth;

class cetakController extends Controller
{
    public function download_project(){ // mencetak data project PKP dalam bentuk tabulasi
        $objPHPExcel = new Spreadsheet();
        $objPHPExcel->setActiveSheetIndex(0); 

        $objPHPExcel->getActiveSheet()->getColumnDimension('A')->setWidth(5.00);
        $objPHPExcel->getActiveSheet()->getColumnDimension('B')->setWidth(45.71);
        $objPHPExcel->getActiveSheet()->getColumnDimension('C')->setWidth(18.67);
        $objPHPExcel->getActiveSheet()->getColumnDimension('D')->setWidth(17.67);
        $objPHPExcel->getActiveSheet()->getColumnDimension('E')->setWidth(17.00);
        $objPHPExcel->getActiveSheet()->getColumnDimension('F')->setWidth(14.00);

        $objPHPExcel->getActiveSheet()->getColumnDimension('G')->setWidth(17.5);
        $objPHPExcel->getActiveSheet()->getColumnDimension('H')->setWidth(17.5);
        $objPHPExcel->getActiveSheet()->getColumnDimension('I')->setWidth(17.5);
        $objPHPExcel->getActiveSheet()->getColumnDimension('J')->setWidth(17.14);
        $objPHPExcel->getActiveSheet()->getColumnDimension('K')->setWidth(9.5);
        $objPHPExcel->getActiveSheet()->getColumnDimension('L')->setWidth(9.5);

        $objPHPExcel->getActiveSheet()->getColumnDimension('M')->setWidth(30.57);
        $objPHPExcel->getActiveSheet()->getColumnDimension('N')->setWidth(16.71);
        $objPHPExcel->getActiveSheet()->getColumnDimension('O')->setWidth(16.71);
        $objPHPExcel->getActiveSheet()->getColumnDimension('P')->setWidth(16.71);
        $objPHPExcel->getActiveSheet()->getColumnDimension('Q')->setWidth(14.67);
        $objPHPExcel->getActiveSheet()->getColumnDimension('R')->setWidth(30.14);

        $objPHPExcel->getActiveSheet()->getColumnDimension('S')->setWidth(15.5);
        $objPHPExcel->getActiveSheet()->getColumnDimension('T')->setWidth(20.57);
        $objPHPExcel->getActiveSheet()->getColumnDimension('U')->setWidth(15.71);
        $objPHPExcel->getActiveSheet()->getColumnDimension('V')->setWidth(14.67);
        $objPHPExcel->getActiveSheet()->getColumnDimension('W')->setWidth(25.14);
        $objPHPExcel->getActiveSheet()->getColumnDimension('X')->setWidth(22.5);

        $objPHPExcel->getActiveSheet()->getColumnDimension('Y')->setWidth(12.57);
        $objPHPExcel->getActiveSheet()->getColumnDimension('Z')->setWidth(12.57);
        $objPHPExcel->getActiveSheet()->getColumnDimension('AA')->setWidth(4.71);
        $objPHPExcel->getActiveSheet()->getColumnDimension('AB')->setWidth(4.67);
        $objPHPExcel->getActiveSheet()->getColumnDimension('AC')->setWidth(4.14);
        $objPHPExcel->getActiveSheet()->getColumnDimension('AD')->setWidth(4.5);

        $objPHPExcel->getActiveSheet()->getColumnDimension('AE')->setWidth(4.57);
        $objPHPExcel->getActiveSheet()->getColumnDimension('AF')->setWidth(4.57);
        $objPHPExcel->getActiveSheet()->getColumnDimension('AG')->setWidth(4.71);
        $objPHPExcel->getActiveSheet()->getColumnDimension('AH')->setWidth(4.71);
        $objPHPExcel->getActiveSheet()->getColumnDimension('AI')->setWidth(25.14);
        $objPHPExcel->getActiveSheet()->getColumnDimension('AJ')->setWidth(24.5);

        $objPHPExcel->getActiveSheet()->getColumnDimension('AK')->setWidth(22.57);
        $objPHPExcel->getActiveSheet()->getColumnDimension('AL')->setWidth(18.57);
        $objPHPExcel->getActiveSheet()->getColumnDimension('AM')->setWidth(30.57);

        $data=PkpProject::join('ms_tarkons','ms_tarkons.id_tarkon','tr_project_pkp.akg')->join('tr_users','tr_users.id','tr_project_pkp.perevisi')
            ->join('tr_kemas','tr_kemas.id_kemas','tr_project_pkp.kemas_eksis')->where('status_project','=','active')
            ->where('status_freeze','inactive')->where('status_pkp','!=','revisi')->where('status_pkp','!=','draf')->orderBy('pkp_number','asc')->get();
        $no      = 1;
        $pertama = 2;

        $objPHPExcel->setActiveSheetIndex(0)
                    ->setCellValue('A1', 'PKP Number')
                    ->setCellValue('C1', 'Project Name')
                    ->setCellValue('D1', 'Created Date')
                    ->setCellValue('E1', 'Sent To RND')
                    ->setCellValue('F1', 'RD Product')
                    ->setCellValue('G1', 'RD Kemas')
                    ->setCellValue('H1', 'PV')
                    ->setCellValue('I1', 'Type')
                    ->setCellValue('J1', 'Brand')
                    ->setCellValue('K1', 'Priority')
                    ->setCellValue('L1', 'Jenis')
                    ->setCellValue('M1', 'Idea')
                    ->setCellValue('N1', 'Target Launch')
                    ->setCellValue('O1', 'Tanggal Launch')
                    ->setCellValue('P1', 'Gender')
                    ->setCellValue('Q1', 'Uniqueness')
                    ->setCellValue('R1', 'Reason')
                    ->setCellValue('S1', 'Estimated')
                    ->setCellValue('T1', 'Competitive')
                    ->setCellValue('U1', 'Selling Price')
                    ->setCellValue('V1', 'Price')
                    ->setCellValue('W1', 'Competitor')
                    ->setCellValue('X1', 'Aisle')
                    ->setCellValue('Y1', 'Product Form')
                    ->setCellValue('Z1', 'AKG')
                    ->setCellValue('AA1', 'Kemas')
                    ->setCellValue('AI1', 'Prefered Flavour')
                    ->setCellValue('AJ1', 'Product Benefits')
                    ->setCellValue('AK1', 'Mandatory Ingredient')
                    ->setCellValue('AL1', 'UOM')
                    ->setCellValue('AM1', 'Serving Suggestion');
                            
        $objPHPExcel->getActiveSheet()->mergeCells('A1:B1');
        $objPHPExcel->setActiveSheetIndex(0)
                    ->setCellValue('A1', 'PKP Number');

        $objPHPExcel->getActiveSheet()->getStyle('A1:AJ1')->getFill()
                    ->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)
                    ->getStartColor()->setARGB('13DFE4');
        $objPHPExcel->getActiveSheet()->getStyle('A1:AJ1')->getAlignment()->setHorizontal('center');

        $objPHPExcel->getActiveSheet()->mergeCells('X1:AE1');
        $objPHPExcel->setActiveSheetIndex(0)
                    ->setCellValue('AE1', 'Kemas');
                
        foreach($data as $_data){
            $Ty = $_data['type'];
            if($Ty=='1'){
                $type= 'maklon';               
            }elseif($Ty=='2'){
                $type = 'internal';
            }else{
                $type = 'Maklon & Internal';
            }

            $launch = $_data['tgl_launch'];
            if($launch==NULL){
                $ld=' '.$_data->launch.' '.$_data->years;
            }elseif($launch!=NULL){
                $ld  = $_data['tgl_launch'];
            }

            if($_data->tujuankirim!='1'){
                $dept = Departement::where('id',$_data->tujuankirim)->first();
                $user = User::where('id',$dept->manager_id)->first();
                $name = $user->name;
            }elseif($_data->tujuankirim=='1'){
                $name = '-';
            }
            
            if($_data->tujuankirim2=='1'){
                $dept2 = Departement::where('id',$_data->tujuankirim2)->first();
                $user2 = User::where('id',$dept2->manager_id)->first();
                $name2 = $user2->name;
            }elseif($_data->tujuankirim2!='1'){
                $name2 = '-';
            }
            
            $objPHPExcel->setActiveSheetIndex(0)
                    ->setCellValue('A'.$pertama, $_data['pkp_number'])
                    ->setCellValue('B'.$pertama, $_data['ket_no'])
                    ->setCellValue('C'.$pertama, $_data['project_name'])
                    ->setCellValue('D'.$pertama, $_data['created_date'])
                    ->setCellValue('E'.$pertama, $_data['tgl_kirim'])
                    ->setCellValue('F'.$pertama, $name)
                    ->setCellValue('G'.$pertama, $name2)
                    ->setCellValue('H'.$pertama, $_data['name'])
                    ->setCellValue('I'.$pertama, $type)
                    ->setCellValue('J'.$pertama, $_data['id_brand'])
                    ->setCellValue('K'.$pertama, $_data['prioritas'])
                    ->setCellValue('L'.$pertama, $_data['jenis'])
                    ->setCellValue('M'.$pertama, $_data['idea'])
                    ->setCellValue('N'.$pertama, $ld)
                    ->setCellValue('O'.$pertama, $_data['tgl_launch'])
                    ->setCellValue('P'.$pertama, $_data['gender'])
                    ->setCellValue('Q'.$pertama, $_data['Uniqueness'])
                    ->setCellValue('R'.$pertama, $_data['reason'])
                    ->setCellValue('S'.$pertama, $_data['Estimated'])
                    ->setCellValue('T'.$pertama, $_data['competitive'])
                    ->setCellValue('U'.$pertama, $_data['selling_price'])
                    ->setCellValue('V'.$pertama, $_data['price'])
                    ->setCellValue('W'.$pertama, $_data['competitor'])
                    ->setCellValue('X'.$pertama, $_data['aisle'])
                    ->setCellValue('Y'.$pertama, $_data['product_form'])
                    ->setCellValue('Z'.$pertama, $_data['tarkon'])
                    ->setCellValue('AA'.$pertama, $_data['tersier'])
                    ->setCellValue('AB'.$pertama, $_data['s_tersier'])
                    ->setCellValue('AC'.$pertama, $_data['sekunder1'])
                    ->setCellValue('AD'.$pertama, $_data['s_sekunder1'])
                    ->setCellValue('AE'.$pertama, $_data['sekunder2'])
                    ->setCellValue('AF'.$pertama, $_data['s_sekunder2'])
                    ->setCellValue('AG'.$pertama, $_data['primer'])
                    ->setCellValue('AH'.$pertama, $_data['s_primer'])
                    ->setCellValue('AI'.$pertama, $_data['prefered_flavour'])
                    ->setCellValue('AJ'.$pertama, $_data['product_benefits'])
                    ->setCellValue('AK'.$pertama, $_data['mandatory_ingredient'])
                    ->setCellValue('AL'.$pertama, $_data['UOM'])
                    ->setCellValue('AM'.$pertama, $_data['serving_suggestion']);
                $pertama++;
        }
        $no++;

        $objPHPExcel->getActiveSheet()->setTitle('Tabulasi PKP');
        $skrg = date('d m Y');
                header('Content-Type: application/vnd.ms-excel'); 
                header('Content-Disposition: attachment;filename="Tabulasi_PKP '.$skrg.'.xls"'); 
                header('Cache-Control: max-age=0'); 
        $objWriter = \PhpOffice\PhpSpreadsheet\IOFactory::createWriter($objPHPExcel, "Xlsx");
        ob_end_clean();
        $objWriter->save('php://output');
    }

    public function download_my_project(){ // download project PKP yang hanya dimiliki oleh user tersebut
        $objPHPExcel = new Spreadsheet();
        $objPHPExcel->setActiveSheetIndex(0); 

        $objPHPExcel->getActiveSheet()->getColumnDimension('A')->setWidth(5.00);
        $objPHPExcel->getActiveSheet()->getColumnDimension('B')->setWidth(45.71);
        $objPHPExcel->getActiveSheet()->getColumnDimension('C')->setWidth(18.67);
        $objPHPExcel->getActiveSheet()->getColumnDimension('D')->setWidth(17.67);
        $objPHPExcel->getActiveSheet()->getColumnDimension('E')->setWidth(17.00);
        $objPHPExcel->getActiveSheet()->getColumnDimension('F')->setWidth(14.00);

        $objPHPExcel->getActiveSheet()->getColumnDimension('G')->setWidth(17.5);
        $objPHPExcel->getActiveSheet()->getColumnDimension('H')->setWidth(17.5);
        $objPHPExcel->getActiveSheet()->getColumnDimension('I')->setWidth(17.5);
        $objPHPExcel->getActiveSheet()->getColumnDimension('J')->setWidth(17.14);
        $objPHPExcel->getActiveSheet()->getColumnDimension('K')->setWidth(9.5);
        $objPHPExcel->getActiveSheet()->getColumnDimension('L')->setWidth(9.5);

        $objPHPExcel->getActiveSheet()->getColumnDimension('M')->setWidth(30.57);
        $objPHPExcel->getActiveSheet()->getColumnDimension('N')->setWidth(16.71);
        $objPHPExcel->getActiveSheet()->getColumnDimension('O')->setWidth(16.71);
        $objPHPExcel->getActiveSheet()->getColumnDimension('P')->setWidth(16.71);
        $objPHPExcel->getActiveSheet()->getColumnDimension('Q')->setWidth(14.67);
        $objPHPExcel->getActiveSheet()->getColumnDimension('R')->setWidth(30.14);

        $objPHPExcel->getActiveSheet()->getColumnDimension('S')->setWidth(15.5);
        $objPHPExcel->getActiveSheet()->getColumnDimension('T')->setWidth(20.57);
        $objPHPExcel->getActiveSheet()->getColumnDimension('U')->setWidth(15.71);
        $objPHPExcel->getActiveSheet()->getColumnDimension('V')->setWidth(14.67);
        $objPHPExcel->getActiveSheet()->getColumnDimension('W')->setWidth(25.14);
        $objPHPExcel->getActiveSheet()->getColumnDimension('X')->setWidth(22.5);

        $objPHPExcel->getActiveSheet()->getColumnDimension('Y')->setWidth(12.57);
        $objPHPExcel->getActiveSheet()->getColumnDimension('Z')->setWidth(12.57);
        $objPHPExcel->getActiveSheet()->getColumnDimension('AA')->setWidth(4.71);
        $objPHPExcel->getActiveSheet()->getColumnDimension('AB')->setWidth(4.67);
        $objPHPExcel->getActiveSheet()->getColumnDimension('AC')->setWidth(4.14);
        $objPHPExcel->getActiveSheet()->getColumnDimension('AD')->setWidth(4.5);

        $objPHPExcel->getActiveSheet()->getColumnDimension('AE')->setWidth(4.57);
        $objPHPExcel->getActiveSheet()->getColumnDimension('AF')->setWidth(4.57);
        $objPHPExcel->getActiveSheet()->getColumnDimension('AG')->setWidth(4.71);
        $objPHPExcel->getActiveSheet()->getColumnDimension('AH')->setWidth(4.71);
        $objPHPExcel->getActiveSheet()->getColumnDimension('AI')->setWidth(25.14);
        $objPHPExcel->getActiveSheet()->getColumnDimension('AJ')->setWidth(24.5);

        $objPHPExcel->getActiveSheet()->getColumnDimension('AK')->setWidth(22.57);
        $objPHPExcel->getActiveSheet()->getColumnDimension('AL')->setWidth(18.57);
        $objPHPExcel->getActiveSheet()->getColumnDimension('AM')->setWidth(30.57);

        if(Auth::user()->departement_id!='1'){ // jika user yang meng akses bukan lah manager kemas, maka bagian ini yang akan dui jalankan
            $data=PkpProject::join('ms_tarkons','ms_tarkons.id_tarkon','tr_project_pkp.akg')->join('tr_users','tr_users.id','tr_project_pkp.perevisi')
                ->join('tr_kemas','tr_kemas.id_kemas','tr_project_pkp.kemas_eksis')->where('tujuankirim',Auth::user()->departement_id)
                ->where('status_freeze','inactive')->where('status_pkp','!=','revisi')->where('status_project','=','active')
                ->where('status_pkp','!=','draf')->orderBy('pkp_number','asc')->get();
        }elseif(Auth::user()->departement_id=='1'){ // jika user yang meng-akses adalah manager kemas, maka bagian ini yang akan di akses
            $data=PkpProject::join('ms_tarkons','ms_tarkons.id_tarkon','tr_project_pkp.akg')->join('tr_users','tr_users.id','tr_project_pkp.perevisi')
                ->join('tr_kemas','tr_kemas.id_kemas','tr_project_pkp.kemas_eksis')->where('tujuankirim2',Auth::user()->departement_id)
                ->where('status_freeze','inactive')->where('status_pkp','!=','revisi')->where('status_project','=','active')
                ->where('status_pkp','!=','draf')->orderBy('pkp_number','asc')->get();
        }
        $no         = 1;   
        $pertama    = 2;

        $objPHPExcel->setActiveSheetIndex(0)
                    ->setCellValue('A1', 'PKP Number')
                    ->setCellValue('C1', 'Project Name')
                    ->setCellValue('D1', 'Created Date')
                    ->setCellValue('E1', 'Sent To RND')
                    ->setCellValue('F1', 'RD Product')
                    ->setCellValue('G1', 'RD Kemas')
                    ->setCellValue('H1', 'PV')
                    ->setCellValue('I1', 'Type')
                    ->setCellValue('J1', 'Brand')
                    ->setCellValue('K1', 'Priority')
                    ->setCellValue('L1', 'Jenis')
                    ->setCellValue('M1', 'Idea')
                    ->setCellValue('N1', 'Target Launch')
                    ->setCellValue('O1', 'Tanggal Launch')
                    ->setCellValue('P1', 'Gender')
                    ->setCellValue('Q1', 'Uniqueness')
                    ->setCellValue('R1', 'Reason')
                    ->setCellValue('S1', 'Estimated')
                    ->setCellValue('T1', 'Competitive')
                    ->setCellValue('U1', 'Selling Price')
                    ->setCellValue('V1', 'Price')
                    ->setCellValue('W1', 'Competitor')
                    ->setCellValue('X1', 'Aisle')
                    ->setCellValue('Y1', 'Product Form')
                    ->setCellValue('Z1', 'AKG')
                    ->setCellValue('AA1', 'Kemas')
                    ->setCellValue('AI1', 'Prefered Flavour')
                    ->setCellValue('AJ1', 'Product Benefits')
                    ->setCellValue('AK1', 'Mandatory Ingredient')
                    ->setCellValue('AL1', 'UOM')
                    ->setCellValue('AM1', 'Serving Suggestion');
                            
        $objPHPExcel->getActiveSheet()->mergeCells('A1:B1');
        $objPHPExcel->setActiveSheetIndex(0)->setCellValue('A1', 'PKP Number');

        $objPHPExcel->getActiveSheet()->getStyle('A1:AJ1')->getFill()
                    ->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)
                    ->getStartColor()->setARGB('13DFE4');
        $objPHPExcel->getActiveSheet()->getStyle('A1:AJ1')->getAlignment()->setHorizontal('center');

        $objPHPExcel->getActiveSheet()->mergeCells('X1:AE1');
        $objPHPExcel->setActiveSheetIndex(0)->setCellValue('AE1', 'Kemas');
                
        foreach($data as $_data){
            $Ty = $_data['type'];
            if($Ty=='1'){
                $type= 'maklon';               
            }elseif($Ty=='2'){
                $type= 'internal';
            }else{
                $type='Maklon & Internal';
            }

            $launch = $_data['tgl_launch'];
            if($launch==NULL){
                $ld=' '.$_data->launch.' '.$_data->years;
            }elseif($launch!=NULL){
                $ld  = $_data['tgl_launch'];
            }

            if($_data->tujuankirim!='1'){
                $dept = Departement::where('id',$_data->tujuankirim)->first();
                $user = User::where('id',$dept->manager_id)->first();
                $name = $user->name;
            }elseif($_data->tujuankirim=='1'){
                $name = '-';
            }
            
            if($_data->tujuankirim2=='1'){
                $dept2 = Departement::where('id',$_data->tujuankirim2)->first();
                $user2 = User::where('id',$dept2->manager_id)->first();
                $name2 = $user2->name;
            }elseif($_data->tujuankirim2!='1'){
                $name2 = '-';
            }
            
            $line=$pertama;
            $objPHPExcel->setActiveSheetIndex(0)
                    ->setCellValue('A'.$pertama, $_data['pkp_number'])
                    ->setCellValue('B'.$pertama, $_data['ket_no'])
                    ->setCellValue('C'.$pertama, $_data['project_name'])
                    ->setCellValue('D'.$pertama, $_data['created_date'])
                    ->setCellValue('E'.$pertama, $_data['tgl_kirim'])
                    ->setCellValue('F'.$pertama, $name)
                    ->setCellValue('G'.$pertama, $name2)
                    ->setCellValue('H'.$pertama, $_data['name'])
                    ->setCellValue('I'.$pertama, $type)
                    ->setCellValue('J'.$pertama, $_data['id_brand'])
                    ->setCellValue('K'.$pertama, $_data['prioritas'])
                    ->setCellValue('L'.$pertama, $_data['jenis'])
                    ->setCellValue('M'.$pertama, $_data['idea'])
                    ->setCellValue('N'.$pertama, $ld)
                    ->setCellValue('O'.$pertama, $_data['tgl_launch'])
                    ->setCellValue('P'.$pertama, $_data['gender'])
                    ->setCellValue('Q'.$pertama, $_data['Uniqueness'])
                    ->setCellValue('R'.$pertama, $_data['reason'])
                    ->setCellValue('S'.$pertama, $_data['Estimated'])
                    ->setCellValue('T'.$pertama, $_data['competitive'])
                    ->setCellValue('U'.$pertama, $_data['selling_price'])
                    ->setCellValue('V'.$pertama, $_data['price'])
                    ->setCellValue('W'.$pertama, $_data['competitor'])
                    ->setCellValue('X'.$pertama, $_data['aisle'])
                    ->setCellValue('Y'.$pertama, $_data['product_form'])
                    ->setCellValue('Z'.$pertama, $_data['tarkon'])
                    ->setCellValue('AA'.$pertama, $_data['tersier'])
                    ->setCellValue('AB'.$pertama, $_data['s_tersier'])
                    ->setCellValue('AC'.$pertama, $_data['sekunder1'])
                    ->setCellValue('AD'.$pertama, $_data['s_sekunder1'])
                    ->setCellValue('AE'.$pertama, $_data['sekunder2'])
                    ->setCellValue('AF'.$pertama, $_data['s_sekunder2'])
                    ->setCellValue('AG'.$pertama, $_data['primer'])
                    ->setCellValue('AH'.$pertama, $_data['s_primer'])
                    ->setCellValue('AI'.$pertama, $_data['prefered_flavour'])
                    ->setCellValue('AJ'.$pertama, $_data['product_benefits'])
                    ->setCellValue('AK'.$pertama, $_data['mandatory_ingredient'])
                    ->setCellValue('AL'.$pertama, $_data['UOM'])
                    ->setCellValue('AM'.$pertama, $_data['serving_suggestion']);
                $pertama++;
            }
            $no++;

        $objPHPExcel->getActiveSheet()->setTitle('Tabulasi PKP');
        $skrg=date('d m Y');
            header('Content-Type: application/vnd.ms-excel'); 
            header('Content-Disposition: attachment;filename="Tabulasi_My_Project_PKP '.$skrg.'.xls"'); 
            header('Cache-Control: max-age=0'); 
        $objWriter = \PhpOffice\PhpSpreadsheet\IOFactory::createWriter($objPHPExcel, "Xlsx");
            ob_end_clean();
        $objWriter->save('php://output');
    }

    public function download_project_pdf(){ // download seluruh project PDF dalam bentuk tabulasi
        $objPHPExcel = new Spreadsheet();
        $objPHPExcel->setActiveSheetIndex(0); 

        $objPHPExcel->getActiveSheet()->getColumnDimension('A')->setWidth(5.00);
        $objPHPExcel->getActiveSheet()->getColumnDimension('B')->setWidth(50.71);
        $objPHPExcel->getActiveSheet()->getColumnDimension('C')->setWidth(30.67);
        $objPHPExcel->getActiveSheet()->getColumnDimension('D')->setWidth(18.67);
        $objPHPExcel->getActiveSheet()->getColumnDimension('E')->setWidth(18.67);
        $objPHPExcel->getActiveSheet()->getColumnDimension('F')->setWidth(8.00);

        $objPHPExcel->getActiveSheet()->getColumnDimension('G')->setWidth(15.5);
        $objPHPExcel->getActiveSheet()->getColumnDimension('H')->setWidth(18.14);
        $objPHPExcel->getActiveSheet()->getColumnDimension('I')->setWidth(9.5);
        $objPHPExcel->getActiveSheet()->getColumnDimension('J')->setWidth(26.5);
        $objPHPExcel->getActiveSheet()->getColumnDimension('K')->setWidth(14.57);
        $objPHPExcel->getActiveSheet()->getColumnDimension('L')->setWidth(14.71);

        $objPHPExcel->getActiveSheet()->getColumnDimension('M')->setWidth(4.00);
        $objPHPExcel->getActiveSheet()->getColumnDimension('N')->setWidth(4.00);
        $objPHPExcel->getActiveSheet()->getColumnDimension('O')->setWidth(4.00);
        $objPHPExcel->getActiveSheet()->getColumnDimension('P')->setWidth(4.00);
        $objPHPExcel->getActiveSheet()->getColumnDimension('Q')->setWidth(4.00);
        $objPHPExcel->getActiveSheet()->getColumnDimension('R')->setWidth(4.00);

        $objPHPExcel->getActiveSheet()->getColumnDimension('S')->setWidth(4.00);
        $objPHPExcel->getActiveSheet()->getColumnDimension('T')->setWidth(4.00);
        $objPHPExcel->getActiveSheet()->getColumnDimension('U')->setWidth(14.57);
        $objPHPExcel->getActiveSheet()->getColumnDimension('V')->setWidth(30.57);
        $objPHPExcel->getActiveSheet()->getColumnDimension('W')->setWidth(25.71);

        $objPHPExcel->getActiveSheet()->getColumnDimension('X')->setWidth(30.67);
        $objPHPExcel->getActiveSheet()->getColumnDimension('Y')->setWidth(12.14);
        $objPHPExcel->getActiveSheet()->getColumnDimension('Z')->setWidth(12.5);
        $objPHPExcel->getActiveSheet()->getColumnDimension('AA')->setWidth(10.57);
        $objPHPExcel->getActiveSheet()->getColumnDimension('AB')->setWidth(10.57);

        $objPHPExcel->getActiveSheet()->getColumnDimension('AC')->setWidth(24.71);
        $objPHPExcel->getActiveSheet()->getColumnDimension('AD')->setWidth(14.67);
        $objPHPExcel->getActiveSheet()->getColumnDimension('AE')->setWidth(12.5);
        $objPHPExcel->getActiveSheet()->getColumnDimension('AF')->setWidth(18.57);

        $pertama=2;

        $data=SubPDF::join('tr_pdf_project','tr_pdf_project.id_project_pdf','tr_sub_pdf.pdf_id')->join('tr_users','tr_users.id','tr_sub_pdf.perevisi')
            ->join('tr_kemas','tr_kemas.id_kemas','tr_sub_pdf.kemas_eksis')->join('ms_type','ms_type.id','tr_pdf_project.id_type')->where('status_pdf','=','active')
            ->where('status_freeze','inactive')->where('status_project','!=','revisi')
            ->where('status_project','!=','draf')->orderBy('pdf_number','asc')->get();
        $no=1;
                
        $objPHPExcel->setActiveSheetIndex(0)
                    ->setCellValue('A1', 'PDF Number')
                    ->setCellValue('C1', 'Project Name')
                    ->setCellValue('D1', 'Created Date')
                    ->setCellValue('E1', 'Sent To RND')
                    ->setCellValue('F1', 'PV')
                    ->setCellValue('G1', 'Type')
                    ->setCellValue('H1', 'Brand')
                    ->setCellValue('I1', 'Priority')
                    ->setCellValue('J1', 'Jenis')
                    ->setCellValue('K1', 'Reference')
                    ->setCellValue('L1', 'Country')
                    ->setCellValue('M1', 'Kemas')
                    ->setCellValue('U1', 'Gender')
                    ->setCellValue('V1', 'Other')
                    ->setCellValue('W1', 'Background')
                    ->setCellValue('X1', 'Attractiveness')
                    ->setCellValue('Y1', 'Weight')
                    ->setCellValue('Z1', 'Satuan')
                    ->setCellValue('AA1', 'Target Price')
                    ->setCellValue('AB1', 'Claim')
                    ->setCellValue('AC1', 'Inggredient')
                    ->setCellValue('AD1', 'RTO')
                    ->setCellValue('AE1', 'Retailer Price ')
                    ->setCellValue('AF1', 'Whats Special');
                            
        $objPHPExcel->getActiveSheet()->mergeCells('A1:B1');
        $objPHPExcel->setActiveSheetIndex(0)
                    ->setCellValue('A1', 'PKP Number');

        $objPHPExcel->getActiveSheet()->getStyle('A1:AJ1')->getFill()
                    ->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)
                    ->getStartColor()->setARGB('13DFE4');
        $objPHPExcel->getActiveSheet()->getStyle('A1:AJ1')->getAlignment()->setHorizontal('center');

        $objPHPExcel->getActiveSheet()->mergeCells('M1:T1');
        $objPHPExcel->setActiveSheetIndex(0)
                    ->setCellValue('T1', 'Kemas');
                
        foreach($data as $_data){
            $line=$pertama;
            $objPHPExcel->setActiveSheetIndex(0)
                    ->setCellValue('A'.$pertama, $_data['pdf_number'])
                    ->setCellValue('B'.$pertama, $_data['ket_no'])
                    ->setCellValue('C'.$pertama, $_data['project_name'])
                    ->setCellValue('D'.$pertama, $_data['created_date'])
                    ->setCellValue('E'.$pertama, $_data['tgl_kirim'])
                    ->setCellValue('F'.$pertama, $_data['name'])
                    ->setCellValue('G'.$pertama, $_data['product_type'])
                    ->setCellValue('H'.$pertama, $_data['id_brand'])
                    ->setCellValue('I'.$pertama, $_data['prioritas'])
                    ->setCellValue('J'.$pertama, $_data['type'])
                    ->setCellValue('K'.$pertama, $_data['reference'])
                    ->setCellValue('L'.$pertama, $_data['country'])
                    ->setCellValue('M'.$pertama, $_data['tersier'])
                    ->setCellValue('N'.$pertama, $_data['s_tersier'])
                    ->setCellValue('O'.$pertama, $_data['sekunder1'])
                    ->setCellValue('P'.$pertama, $_data['s_sekunder1'])
                    ->setCellValue('Q'.$pertama, $_data['sekunder2'])
                    ->setCellValue('R'.$pertama, $_data['s_sekunder2'])
                    ->setCellValue('S'.$pertama, $_data['primer'])
                    ->setCellValue('T'.$pertama, $_data['s_primer'])
                    ->setCellValue('U'.$pertama, $_data['gender'])
                    ->setCellValue('V'.$pertama, $_data['other'])
                    ->setCellValue('V'.$pertama, $_data['background'])
                    ->setCellValue('X'.$pertama, $_data['attractiveness'])
                    ->setCellValue('Y'.$pertama, $_data['wight'])
                    ->setCellValue('Z'.$pertama, $_data['serving'])
                    ->setCellValue('AA'.$pertama, $_data['target_price'])
                    ->setCellValue('AB'.$pertama, $_data['claim'])
                    ->setCellValue('AC'.$pertama, $_data['ingredient'])
                    ->setCellValue('AD'.$pertama, $_data['rto'])
                    ->setCellValue('AE'.$pertama, $_data['retailer_price'])
                    ->setCellValue('AF'.$pertama, $_data['special']);
                $pertama++;
            }
        
        $no++;
        $objPHPExcel->getActiveSheet()->setTitle('Tabulasi PDF');
        $skrg=date('d m Y');
        header('Content-Type: application/vnd.ms-excel'); 
        header('Content-Disposition: attachment;filename="Tabulasi_PDF '.$skrg.'.xls"'); 
        header('Cache-Control: max-age=0'); 
        $objWriter = \PhpOffice\PhpSpreadsheet\IOFactory::createWriter($objPHPExcel, "Xlsx");
        ob_end_clean();
        $objWriter->save('php://output');
    }

    public function download_my_project_pdf(){ // download project PDF yang hanya di miliki oleh user tersebut
        $objPHPExcel = new Spreadsheet();
        $objPHPExcel->setActiveSheetIndex(0); 

        $objPHPExcel->getActiveSheet()->getColumnDimension('A')->setWidth(5.00);
        $objPHPExcel->getActiveSheet()->getColumnDimension('B')->setWidth(50.71);
        $objPHPExcel->getActiveSheet()->getColumnDimension('C')->setWidth(30.67);
        $objPHPExcel->getActiveSheet()->getColumnDimension('D')->setWidth(18.67);
        $objPHPExcel->getActiveSheet()->getColumnDimension('E')->setWidth(18.67);
        $objPHPExcel->getActiveSheet()->getColumnDimension('F')->setWidth(8.00);

        $objPHPExcel->getActiveSheet()->getColumnDimension('G')->setWidth(15.5);
        $objPHPExcel->getActiveSheet()->getColumnDimension('H')->setWidth(18.14);
        $objPHPExcel->getActiveSheet()->getColumnDimension('I')->setWidth(9.5);
        $objPHPExcel->getActiveSheet()->getColumnDimension('J')->setWidth(26.5);
        $objPHPExcel->getActiveSheet()->getColumnDimension('K')->setWidth(14.57);
        $objPHPExcel->getActiveSheet()->getColumnDimension('L')->setWidth(14.71);

        $objPHPExcel->getActiveSheet()->getColumnDimension('M')->setWidth(4.00);
        $objPHPExcel->getActiveSheet()->getColumnDimension('N')->setWidth(4.00);
        $objPHPExcel->getActiveSheet()->getColumnDimension('O')->setWidth(4.00);
        $objPHPExcel->getActiveSheet()->getColumnDimension('P')->setWidth(4.00);
        $objPHPExcel->getActiveSheet()->getColumnDimension('Q')->setWidth(4.00);
        $objPHPExcel->getActiveSheet()->getColumnDimension('R')->setWidth(4.00);

        $objPHPExcel->getActiveSheet()->getColumnDimension('S')->setWidth(4.00);
        $objPHPExcel->getActiveSheet()->getColumnDimension('T')->setWidth(4.00);
        $objPHPExcel->getActiveSheet()->getColumnDimension('U')->setWidth(14.57);
        $objPHPExcel->getActiveSheet()->getColumnDimension('V')->setWidth(30.57);
        $objPHPExcel->getActiveSheet()->getColumnDimension('W')->setWidth(25.71);

        $objPHPExcel->getActiveSheet()->getColumnDimension('X')->setWidth(30.67);
        $objPHPExcel->getActiveSheet()->getColumnDimension('Y')->setWidth(12.14);
        $objPHPExcel->getActiveSheet()->getColumnDimension('Z')->setWidth(12.5);
        $objPHPExcel->getActiveSheet()->getColumnDimension('AA')->setWidth(10.57);
        $objPHPExcel->getActiveSheet()->getColumnDimension('AB')->setWidth(10.57);

        $objPHPExcel->getActiveSheet()->getColumnDimension('AC')->setWidth(24.71);
        $objPHPExcel->getActiveSheet()->getColumnDimension('AD')->setWidth(14.67);
        $objPHPExcel->getActiveSheet()->getColumnDimension('AE')->setWidth(12.5);
        $objPHPExcel->getActiveSheet()->getColumnDimension('AF')->setWidth(18.57);

        $awal=1;
        $pertama=2;

        if(Auth::user()->departement_id!='1'){
            $data=SubPDF::join('tr_pdf_project','tr_pdf_project.id_project_pdf','tr_sub_pdf.pdf_id')
                ->join('tr_users','tr_users.id','tr_sub_pdf.perevisi')
                ->join('tr_kemas','tr_kemas.id_kemas','tr_sub_pdf.kemas_eksis')
                ->join('ms_type','ms_type.id','tr_pdf_project.id_type')->where('status_pdf','=','active')
                ->where('tujuankirim',Auth::user()->departement_id)
                ->where('status_freeze','inactive')->where('status_project','!=','revisi')
                ->where('status_project','!=','draf')->orderBy('pdf_number','asc')->get();
            $no=1;
        }elseif(Auth::user()->departement_id=='1'){
            $data=SubPDF::join('tr_pdf_project','tr_pdf_project.id_project_pdf','tr_sub_pdf.pdf_id')
                ->join('tr_users','tr_users.id','tr_sub_pdf.perevisi')
                ->join('tr_kemas','tr_kemas.id_kemas','tr_sub_pdf.kemas_eksis')
                ->join('ms_type','ms_type.id','tr_pdf_project.id_type')->where('status_pdf','=','active')
                ->where('tujuankirim2',Auth::user()->departement_id)
                ->where('status_freeze','inactive')->where('status_project','!=','revisi')
                ->where('status_project','!=','draf')->orderBy('pdf_number','asc')->get();
        }
        $no     = 1;  

        $objPHPExcel->setActiveSheetIndex(0)
                    ->setCellValue('A1', 'PDF Number')
                    ->setCellValue('C1', 'Project Name')
                    ->setCellValue('D1', 'Created Date')
                    ->setCellValue('E1', 'Sent To RND')
                    ->setCellValue('F1', 'PV')
                    ->setCellValue('G1', 'Type')
                    ->setCellValue('H1', 'Brand')
                    ->setCellValue('I1', 'Priority')
                    ->setCellValue('J1', 'Jenis')
                    ->setCellValue('K1', 'Reference')
                    ->setCellValue('L1', 'Country')
                    ->setCellValue('M1', 'Kemas')
                    ->setCellValue('U1', 'Gender')
                    ->setCellValue('V1', 'Other')
                    ->setCellValue('W1', 'Background')
                    ->setCellValue('X1', 'Attractiveness')
                    ->setCellValue('Y1', 'Weight')
                    ->setCellValue('Z1', 'Satuan')
                    ->setCellValue('AA1', 'Target Price')
                    ->setCellValue('AB1', 'Claim')
                    ->setCellValue('AC1', 'Inggredient')
                    ->setCellValue('AD1', 'RTO')
                    ->setCellValue('AE1', 'Retailer Price ')
                    ->setCellValue('AF1', 'Whats Special');
                            
        $objPHPExcel->getActiveSheet()->mergeCells('A1:B1');
        $objPHPExcel->setActiveSheetIndex(0)
                    ->setCellValue('A1', 'PKP Number');

        $objPHPExcel->getActiveSheet()->getStyle('A1:AJ1')->getFill()
                    ->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)
                    ->getStartColor()->setARGB('13DFE4');
        $objPHPExcel->getActiveSheet()->getStyle('A1:AJ1')->getAlignment()->setHorizontal('center');

        $objPHPExcel->getActiveSheet()->mergeCells('M1:T1');
        $objPHPExcel->setActiveSheetIndex(0)
                    ->setCellValue('T1', 'Kemas');

        foreach($data as $_data){      
            $objPHPExcel->setActiveSheetIndex(0)
                    ->setCellValue('A'.$pertama, $_data['pdf_number'])
                    ->setCellValue('B'.$pertama, $_data['ket_no'])
                    ->setCellValue('C'.$pertama, $_data['project_name'])
                    ->setCellValue('D'.$pertama, $_data['created_date'])
                    ->setCellValue('E'.$pertama, $_data['tgl_kirim'])
                    ->setCellValue('F'.$pertama, $_data['name'])
                    ->setCellValue('G'.$pertama, $_data['product_type'])
                    ->setCellValue('H'.$pertama, $_data['id_brand'])
                    ->setCellValue('I'.$pertama, $_data['prioritas'])
                    ->setCellValue('J'.$pertama, $_data['type'])
                    ->setCellValue('K'.$pertama, $_data['reference'])
                    ->setCellValue('L'.$pertama, $_data['country'])
                    ->setCellValue('M'.$pertama, $_data['tersier'])
                    ->setCellValue('N'.$pertama, $_data['s_tersier'])
                    ->setCellValue('O'.$pertama, $_data['sekunder1'])
                    ->setCellValue('P'.$pertama, $_data['s_sekunder1'])
                    ->setCellValue('Q'.$pertama, $_data['sekunder2'])
                    ->setCellValue('R'.$pertama, $_data['s_sekunder2'])
                    ->setCellValue('S'.$pertama, $_data['primer'])
                    ->setCellValue('T'.$pertama, $_data['s_primer'])
                    ->setCellValue('U'.$pertama, $_data['gender'])
                    ->setCellValue('V'.$pertama, $_data['other'])
                    ->setCellValue('V'.$pertama, $_data['background'])
                    ->setCellValue('X'.$pertama, $_data['attractiveness'])
                    ->setCellValue('Y'.$pertama, $_data['wight'])
                    ->setCellValue('Z'.$pertama, $_data['serving'])
                    ->setCellValue('AA'.$pertama, $_data['target_price'])
                    ->setCellValue('AB'.$pertama, $_data['claim'])
                    ->setCellValue('AC'.$pertama, $_data['ingredient'])
                    ->setCellValue('AD'.$pertama, $_data['rto'])
                    ->setCellValue('AE'.$pertama, $_data['retailer_price'])
                    ->setCellValue('AF'.$pertama, $_data['special']);
                $pertama++;
            }
        
        $no++;
        $objPHPExcel->getActiveSheet()->setTitle('Tabulasi My PDF');
        $skrg=date('d m Y');
            header('Content-Type: application/vnd.ms-excel'); 
            header('Content-Disposition: attachment;filename="Tabulasi_My_PDF '.$skrg.'.xls"'); 
            header('Cache-Control: max-age=0'); 
        $objWriter = \PhpOffice\PhpSpreadsheet\IOFactory::createWriter($objPHPExcel, "Xlsx");
            ob_end_clean();
        $objWriter->save('php://output');
    }
    
    public function notulenpkp(Request $request){
        $objPHPExcel = new Spreadsheet();
        $objPHPExcel->setActiveSheetIndex(0); 
        $objPHPExcel->getActiveSheet()->getColumnDimension('A')->setWidth(5.00);
        $objPHPExcel->getActiveSheet()->getColumnDimension('B')->setWidth(50.00);
        $objPHPExcel->getActiveSheet()->getColumnDimension('C')->setWidth(20.00);
        $objPHPExcel->getActiveSheet()->getColumnDimension('D')->setWidth(20.00);
        $objPHPExcel->getActiveSheet()->getColumnDimension('E')->setWidth(20.00);

        $objPHPExcel->getActiveSheet()->getColumnDimension('F')->setWidth(8.00);
        $objPHPExcel->getActiveSheet()->getColumnDimension('G')->setWidth(18.00);
        $objPHPExcel->getActiveSheet()->getColumnDimension('H')->setWidth(30.00);
        $objPHPExcel->getActiveSheet()->getColumnDimension('I')->setWidth(20.00);

        $objPHPExcel->getActiveSheet()->getColumnDimension('J')->setWidth(8.00);
        $objPHPExcel->getActiveSheet()->getColumnDimension('K')->setWidth(18.00);
        $objPHPExcel->getActiveSheet()->getColumnDimension('L')->setWidth(30.00);
        $objPHPExcel->getActiveSheet()->getColumnDimension('M')->setWidth(20.00);

        $objPHPExcel->getActiveSheet()->getColumnDimension('N')->setWidth(8.00);
        $objPHPExcel->getActiveSheet()->getColumnDimension('O')->setWidth(18.00);
        $objPHPExcel->getActiveSheet()->getColumnDimension('P')->setWidth(30.00);
        $objPHPExcel->getActiveSheet()->getColumnDimension('Q')->setWidth(20.00);

        $objPHPExcel->getActiveSheet()->getColumnDimension('R')->setWidth(8.00);
        $objPHPExcel->getActiveSheet()->getColumnDimension('S')->setWidth(18.00);
        $objPHPExcel->getActiveSheet()->getColumnDimension('T')->setWidth(30.00);
        $objPHPExcel->getActiveSheet()->getColumnDimension('U')->setWidth(20.00);

        $objPHPExcel->getActiveSheet()->getColumnDimension('V')->setWidth(8.00);
        $objPHPExcel->getActiveSheet()->getColumnDimension('W')->setWidth(18.00);
        $objPHPExcel->getActiveSheet()->getColumnDimension('X')->setWidth(30.00);
        $objPHPExcel->getActiveSheet()->getColumnDimension('Y')->setWidth(20.00);

        $objPHPExcel->getActiveSheet()->getColumnDimension('Z')->setWidth(8.00);
        $objPHPExcel->getActiveSheet()->getColumnDimension('AA')->setWidth(18.00);
        $objPHPExcel->getActiveSheet()->getColumnDimension('AB')->setWidth(30.00);
        $objPHPExcel->getActiveSheet()->getColumnDimension('AC')->setWidth(20.00);

        $objPHPExcel->getActiveSheet()->getColumnDimension('AD')->setWidth(8.00);
        $objPHPExcel->getActiveSheet()->getColumnDimension('AE')->setWidth(18.00);
        $objPHPExcel->getActiveSheet()->getColumnDimension('AF')->setWidth(30.00);
        $objPHPExcel->getActiveSheet()->getColumnDimension('AG')->setWidth(20.00);

        $objPHPExcel->getActiveSheet()->getColumnDimension('AH')->setWidth(8.00);
        $objPHPExcel->getActiveSheet()->getColumnDimension('AI')->setWidth(18.00);
        $objPHPExcel->getActiveSheet()->getColumnDimension('AJ')->setWidth(30.00);
        $objPHPExcel->getActiveSheet()->getColumnDimension('AK')->setWidth(20.00);

        $objPHPExcel->getActiveSheet()->getColumnDimension('AL')->setWidth(8.00);
        $objPHPExcel->getActiveSheet()->getColumnDimension('AM')->setWidth(18.00);
        $objPHPExcel->getActiveSheet()->getColumnDimension('AN')->setWidth(30.00);
        $objPHPExcel->getActiveSheet()->getColumnDimension('AO')->setWidth(20.00);

        $objPHPExcel->getActiveSheet()->getColumnDimension('AP')->setWidth(8.00);
        $objPHPExcel->getActiveSheet()->getColumnDimension('AQ')->setWidth(18.00);
        $objPHPExcel->getActiveSheet()->getColumnDimension('AR')->setWidth(30.00);
        $objPHPExcel->getActiveSheet()->getColumnDimension('AS')->setWidth(20.00);

        $objPHPExcel->getActiveSheet()->getColumnDimension('AT')->setWidth(8.00);
        $objPHPExcel->getActiveSheet()->getColumnDimension('AU')->setWidth(18.00);
        $objPHPExcel->getActiveSheet()->getColumnDimension('AV')->setWidth(30.00);
        $objPHPExcel->getActiveSheet()->getColumnDimension('AW')->setWidth(20.00);

        $objPHPExcel->getActiveSheet()->getColumnDimension('AX')->setWidth(8.00);
        $objPHPExcel->getActiveSheet()->getColumnDimension('AY')->setWidth(18.00);
        $objPHPExcel->getActiveSheet()->getColumnDimension('AZ')->setWidth(30.00);
        $objPHPExcel->getActiveSheet()->getColumnDimension('BA')->setWidth(20.00);

        $objPHPExcel->getActiveSheet()->getColumnDimension('BB')->setWidth(8.00);
        $objPHPExcel->getActiveSheet()->getColumnDimension('BC')->setWidth(18.00);
        $objPHPExcel->getActiveSheet()->getColumnDimension('BD')->setWidth(30.00);
        $objPHPExcel->getActiveSheet()->getColumnDimension('BE')->setWidth(20.00);

        $objPHPExcel->getActiveSheet()->getColumnDimension('BF')->setWidth(8.00);
        $objPHPExcel->getActiveSheet()->getColumnDimension('BG')->setWidth(18.00);
        $objPHPExcel->getActiveSheet()->getColumnDimension('BH')->setWidth(30.00);
        $objPHPExcel->getActiveSheet()->getColumnDimension('BI')->setWidth(20.00);

        $objPHPExcel->getActiveSheet()->getColumnDimension('BJ')->setWidth(8.00);
        $objPHPExcel->getActiveSheet()->getColumnDimension('BK')->setWidth(18.00);
        $objPHPExcel->getActiveSheet()->getColumnDimension('BL')->setWidth(30.00);
        $objPHPExcel->getActiveSheet()->getColumnDimension('BM')->setWidth(20.00);

        $objPHPExcel->getActiveSheet()->getColumnDimension('BN')->setWidth(8.00);
        $objPHPExcel->getActiveSheet()->getColumnDimension('BO')->setWidth(18.00);
        $objPHPExcel->getActiveSheet()->getColumnDimension('BP')->setWidth(30.00);
        $objPHPExcel->getActiveSheet()->getColumnDimension('BQ')->setWidth(20.00);

        $objPHPExcel->getActiveSheet()->getColumnDimension('BR')->setWidth(8.00);
        $objPHPExcel->getActiveSheet()->getColumnDimension('BS')->setWidth(18.00);
        $objPHPExcel->getActiveSheet()->getColumnDimension('BT')->setWidth(30.00);
        $objPHPExcel->getActiveSheet()->getColumnDimension('BU')->setWidth(20.00);

        $objPHPExcel->getActiveSheet()->getColumnDimension('BV')->setWidth(8.00);
        $objPHPExcel->getActiveSheet()->getColumnDimension('BW')->setWidth(18.00);
        $objPHPExcel->getActiveSheet()->getColumnDimension('BX')->setWidth(30.00);
        $objPHPExcel->getActiveSheet()->getColumnDimension('BY')->setWidth(20.00);

        $objPHPExcel->getActiveSheet()->getColumnDimension('BZ')->setWidth(8.00);
        $objPHPExcel->getActiveSheet()->getColumnDimension('CA')->setWidth(18.00);
        $objPHPExcel->getActiveSheet()->getColumnDimension('CB')->setWidth(30.00);
        $objPHPExcel->getActiveSheet()->getColumnDimension('CC')->setWidth(25.71);

        $objPHPExcel->getActiveSheet()->getColumnDimension('CD')->setWidth(8.00);
        $objPHPExcel->getActiveSheet()->getColumnDimension('CE')->setWidth(18.00);
        $objPHPExcel->getActiveSheet()->getColumnDimension('CF')->setWidth(30.00);
        $objPHPExcel->getActiveSheet()->getColumnDimension('CG')->setWidth(20.00);

        $objPHPExcel->getActiveSheet()->getColumnDimension('CH')->setWidth(8.00);
        $objPHPExcel->getActiveSheet()->getColumnDimension('CI')->setWidth(18.00);
        $objPHPExcel->getActiveSheet()->getColumnDimension('CJ')->setWidth(30.00);
        $objPHPExcel->getActiveSheet()->getColumnDimension('CK')->setWidth(20.00);

        $objPHPExcel->getActiveSheet()->getColumnDimension('CL')->setWidth(8.00);
        $objPHPExcel->getActiveSheet()->getColumnDimension('CM')->setWidth(18.00);
        $objPHPExcel->getActiveSheet()->getColumnDimension('CN')->setWidth(30.00);
        $objPHPExcel->getActiveSheet()->getColumnDimension('CO')->setWidth(20.00);

        $objPHPExcel->getActiveSheet()->getColumnDimension('CP')->setWidth(8.00);
        $objPHPExcel->getActiveSheet()->getColumnDimension('CQ')->setWidth(18.00);
        $objPHPExcel->getActiveSheet()->getColumnDimension('CR')->setWidth(30.00);
        $objPHPExcel->getActiveSheet()->getColumnDimension('CS')->setWidth(20.00);

        $objPHPExcel->getActiveSheet()->getColumnDimension('CT')->setWidth(8.00);
        $objPHPExcel->getActiveSheet()->getColumnDimension('CU')->setWidth(18.00);
        $objPHPExcel->getActiveSheet()->getColumnDimension('CV')->setWidth(30.00);
        $objPHPExcel->getActiveSheet()->getColumnDimension('CW')->setWidth(20.00);

        $pertama = 4;
        $DNpkp   = PkpProject::where('status_pkp','sent')->orwhere('status_pkp','proses')->orwhere('status_pkp','revisi')
                    ->where('status_project','=','active')->orderBy('prioritas','asc')->get();
        $no      = 1; 
        $objPHPExcel->setActiveSheetIndex(0)
                    ->setCellValue('C2', 'RD Kemas')
                    ->setCellValue('D2', 'RD Product')
                    ->setCellValue('E2', 'PV')

                    ->setCellValue('F3', 'Priority')
                    ->setCellValue('G3', 'Launch Deadline')
                    ->setCellValue('H3', 'Notulen')
                    ->setCellValue('I3', 'Forecast')
                    ->setCellValue('J3', 'Priority')
                    ->setCellValue('K3', 'Launch Deadline')
                    ->setCellValue('L3', 'Notulen')
                    ->setCellValue('M3', 'Forecast')
                    
                    ->setCellValue('N3', 'Priority')
                    ->setCellValue('O3', 'Launch Deadline')
                    ->setCellValue('P3', 'Notulen')
                    ->setCellValue('Q3', 'Forecast')
                    ->setCellValue('R3', 'Priority')
                    ->setCellValue('S3', 'Launch Deadline')
                    ->setCellValue('T3', 'Notulen')
                    ->setCellValue('U3', 'Forecast')

                    ->setCellValue('V3', 'Priority')
                    ->setCellValue('W3', 'Launch Deadline')
                    ->setCellValue('X3', 'Notulen')
                    ->setCellValue('Y3', 'Forecast')
                    ->setCellValue('Z3', 'Priority')
                    ->setCellValue('AA3', 'Launch Deadline')
                    ->setCellValue('AB3', 'Notulen')
                    ->setCellValue('AC3', 'Forecast')

                    ->setCellValue('AD3', 'Priority')
                    ->setCellValue('AE3', 'Launch Deadline')
                    ->setCellValue('AF3', 'Notulen')
                    ->setCellValue('AG3', 'Forecast')
                    ->setCellValue('AH3', 'Priority')
                    ->setCellValue('AI3', 'Launch Deadline')
                    ->setCellValue('AJ3', 'Notulen')
                    ->setCellValue('AK3', 'Forecast')

                    ->setCellValue('AL3', 'Priority')
                    ->setCellValue('AM3', 'Launch Deadline')
                    ->setCellValue('AN3', 'Notulen')
                    ->setCellValue('AO3', 'Forecast')
                    ->setCellValue('AP3', 'Priority')
                    ->setCellValue('AQ3', 'Launch Deadline')
                    ->setCellValue('AR3', 'Notulen')
                    ->setCellValue('AS3', 'Forecast')

                    ->setCellValue('AT3', 'Priority')
                    ->setCellValue('AU3', 'Launch Deadline')
                    ->setCellValue('AV3', 'Notulen')
                    ->setCellValue('AW3', 'Forecast')
                    ->setCellValue('AX3', 'Priority')
                    ->setCellValue('AY3', 'Launch Deadline')
                    ->setCellValue('AZ3', 'Notulen')
                    ->setCellValue('BA3', 'Forecast')

                    ->setCellValue('BB3', 'Priority')
                    ->setCellValue('BC3', 'Launch Deadline')
                    ->setCellValue('BD3', 'Notulen')
                    ->setCellValue('BE3', 'Forecast')
                    ->setCellValue('BF3', 'Priority')
                    ->setCellValue('BG3', 'Launch Deadline')
                    ->setCellValue('BH3', 'Notulen')
                    ->setCellValue('BI3', 'Forecast')

                    ->setCellValue('BJ3', 'Priority')
                    ->setCellValue('BK3', 'Launch Deadline')
                    ->setCellValue('BL3', 'Notulen')
                    ->setCellValue('BM3', 'Forecast')
                    ->setCellValue('BN3', 'Priority')
                    ->setCellValue('BO3', 'Launch Deadline')
                    ->setCellValue('BP3', 'Notulen')
                    ->setCellValue('BQ3', 'Forecast')

                    ->setCellValue('BR3', 'Priority')
                    ->setCellValue('BS3', 'Launch Deadline')
                    ->setCellValue('BT3', 'Notulen')
                    ->setCellValue('BU3', 'Forecast')
                    ->setCellValue('BV3', 'Priority')
                    ->setCellValue('BW3', 'Launch Deadline')
                    ->setCellValue('BX3', 'Notulen')
                    ->setCellValue('BY3', 'Forecast')

                    ->setCellValue('BZ3', 'Priority')
                    ->setCellValue('CA3', 'Launch Deadline')
                    ->setCellValue('CB3', 'Notulen')
                    ->setCellValue('CC3', 'Forecast')
                    ->setCellValue('CD3', 'Priority')
                    ->setCellValue('CE3', 'Launch Deadline')
                    ->setCellValue('CF3', 'Notulen')
                    ->setCellValue('CG3', 'Forecast')

                    ->setCellValue('CH3', 'Priority')
                    ->setCellValue('CI3', 'Launch Deadline')
                    ->setCellValue('CJ3', 'Notulen')
                    ->setCellValue('CK3', 'Forecast')
                    ->setCellValue('CL3', 'Priority')
                    ->setCellValue('CM3', 'Launch Deadline')
                    ->setCellValue('CN3', 'Notulen')
                    ->setCellValue('CO3', 'Forecast')

                    ->setCellValue('CP3', 'Priority')
                    ->setCellValue('CQ3', 'Launch Deadline')
                    ->setCellValue('CR3', 'Notulen')
                    ->setCellValue('CS3', 'Forecast')
                    ->setCellValue('GCT3', 'Priority')
                    ->setCellValue('CU3', 'Launch Deadline')
                    ->setCellValue('CV3', 'Notulen')
                    ->setCellValue('CW3', 'Forecast');
                    
        $objPHPExcel->getActiveSheet()->getStyle('A1:CW1')->getFill()
                    ->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)
                    ->getStartColor()->setARGB('13DFE4');
        $objPHPExcel->getActiveSheet()->getStyle('A2:B2')->getFill()
                    ->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)
                    ->getStartColor()->setARGB('13DFE4');
        $objPHPExcel->getActiveSheet()->getStyle('A2:B2')->getAlignment()->setHorizontal('center');
        $objPHPExcel->getActiveSheet()->getStyle('A3:B3')->getFill()
                    ->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)
                    ->getStartColor()->setARGB('13DFE4');
        $objPHPExcel->getActiveSheet()->getStyle('A1:CW1')->getAlignment()->setHorizontal('center');
        $objPHPExcel->getActiveSheet()->getStyle('C2:E2')->getFill()
                    ->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)
                    ->getStartColor()->setARGB('87aacc');
        $objPHPExcel->getActiveSheet()->getStyle('C2:E2')->getAlignment()->setHorizontal('center');
        $objPHPExcel->getActiveSheet()->getStyle('C3:E3')->getFill()
                    ->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)
                    ->getStartColor()->setARGB('87aacc');
        $objPHPExcel->getActiveSheet()->getStyle('F2:CW2')->getFill()
                    ->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)
                    ->getStartColor()->setARGB('838383');
        $objPHPExcel->getActiveSheet()->getStyle('C2:CW2')->getAlignment()->setHorizontal('center');
        $objPHPExcel->getActiveSheet()->getStyle('F3:CW3')->getFill()
                    ->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)
                    ->getStartColor()->setARGB('838383');
        $objPHPExcel->getActiveSheet()->getStyle('C3:CW3')->getAlignment()->setHorizontal('center');
        // BARIS 2
        $objPHPExcel->getActiveSheet()->mergeCells('F2:I2');
        $objPHPExcel->setActiveSheetIndex(0)
                    ->setCellValue('F2', 'Meeting PV & Marketing');

        $objPHPExcel->getActiveSheet()->mergeCells('J2:M2');
        $objPHPExcel->setActiveSheetIndex(0)
                    ->setCellValue('J2', 'Meeting PV & RD');

        $objPHPExcel->getActiveSheet()->mergeCells('N2:Q2');
        $objPHPExcel->setActiveSheetIndex(0)
                    ->setCellValue('N2', 'Meeting PV & Marketing');
                    
        $objPHPExcel->getActiveSheet()->mergeCells('R2:U2');
        $objPHPExcel->setActiveSheetIndex(0)
                    ->setCellValue('R2', 'Meeting PV & RD');
                    
        $objPHPExcel->getActiveSheet()->mergeCells('V2:Y2');
        $objPHPExcel->setActiveSheetIndex(0)
                    ->setCellValue('V2', 'Meeting PV & Marketing');

        $objPHPExcel->getActiveSheet()->mergeCells('Z2:AC2');
        $objPHPExcel->setActiveSheetIndex(0)
                    ->setCellValue('Z2', 'Meeting PV & RD');

        $objPHPExcel->getActiveSheet()->mergeCells('AD2:AG2');
        $objPHPExcel->setActiveSheetIndex(0)
                    ->setCellValue('AD2', 'Meeting PV & Marketing');
                    
        $objPHPExcel->getActiveSheet()->mergeCells('AH2:AK2');
        $objPHPExcel->setActiveSheetIndex(0)
                    ->setCellValue('AH2', 'Meeting PV & RD');
                    
        $objPHPExcel->getActiveSheet()->mergeCells('AL2:AO2');
        $objPHPExcel->setActiveSheetIndex(0)
                    ->setCellValue('AL2', 'Meeting PV & Marketing');

        $objPHPExcel->getActiveSheet()->mergeCells('AP2:AS2');
        $objPHPExcel->setActiveSheetIndex(0)
                    ->setCellValue('AP2', 'Meeting PV & RD');

        $objPHPExcel->getActiveSheet()->mergeCells('AT2:AW2');
        $objPHPExcel->setActiveSheetIndex(0)
                    ->setCellValue('AT2', 'Meeting PV & Marketing');
                    
        $objPHPExcel->getActiveSheet()->mergeCells('AX2:BA2');
        $objPHPExcel->setActiveSheetIndex(0)
                    ->setCellValue('AX2', 'Meeting PV & RD');
                    
        $objPHPExcel->getActiveSheet()->mergeCells('BB2:BE2');
        $objPHPExcel->setActiveSheetIndex(0)
                    ->setCellValue('BB2', 'Meeting PV & Marketing');

        $objPHPExcel->getActiveSheet()->mergeCells('BF2:BI2');
        $objPHPExcel->setActiveSheetIndex(0)
                    ->setCellValue('BF2', 'Meeting PV & RD');

        $objPHPExcel->getActiveSheet()->mergeCells('BJ2:BM2');
        $objPHPExcel->setActiveSheetIndex(0)
                    ->setCellValue('BJ2', 'Meeting PV & Marketing');

        $objPHPExcel->getActiveSheet()->mergeCells('BN2:BQ2');
        $objPHPExcel->setActiveSheetIndex(0)
                    ->setCellValue('BN2', 'Meeting PV & RD');
                    
        $objPHPExcel->getActiveSheet()->mergeCells('BR2:BU2');
        $objPHPExcel->setActiveSheetIndex(0)
                    ->setCellValue('BR2', 'Meeting PV & Marketing');
                    
        $objPHPExcel->getActiveSheet()->mergeCells('BV2:BY2');
        $objPHPExcel->setActiveSheetIndex(0)
                    ->setCellValue('BV2', 'Meeting PV & RD');

        $objPHPExcel->getActiveSheet()->mergeCells('BZ2:CC2');
        $objPHPExcel->setActiveSheetIndex(0)
                    ->setCellValue('BZ2', 'Meeting PV & Marketing');

        $objPHPExcel->getActiveSheet()->mergeCells('CD2:CG2');
        $objPHPExcel->setActiveSheetIndex(0)
                    ->setCellValue('CD2', 'Meeting PV & RD');
                    
        $objPHPExcel->getActiveSheet()->mergeCells('CH2:CK2');
        $objPHPExcel->setActiveSheetIndex(0)
                    ->setCellValue('CH2', 'Meeting PV & Marketing');
                    
        $objPHPExcel->getActiveSheet()->mergeCells('CL2:CO2');
        $objPHPExcel->setActiveSheetIndex(0)
                    ->setCellValue('CL2', 'Meeting PV & RD');

        $objPHPExcel->getActiveSheet()->mergeCells('CP2:CS2');
        $objPHPExcel->setActiveSheetIndex(0)
                    ->setCellValue('CP2', 'Meeting PV & Marketing');

        $objPHPExcel->getActiveSheet()->mergeCells('CT2:CW2');
        $objPHPExcel->setActiveSheetIndex(0)
                    ->setCellValue('CT2', 'Meeting PV & RD');

        //BARIS3
        $objPHPExcel->getActiveSheet()->mergeCells('A2:B2');
        $objPHPExcel->setActiveSheetIndex(0)
                    ->setCellValue('A2', 'PKP Number');

        $objPHPExcel->getActiveSheet()->mergeCells('F1:M1');
        $objPHPExcel->setActiveSheetIndex(0)
                    ->setCellValue('F1', 'December');

        $objPHPExcel->getActiveSheet()->mergeCells('N1:U1');
        $objPHPExcel->setActiveSheetIndex(0)
                    ->setCellValue('N1', 'November');

        $objPHPExcel->getActiveSheet()->mergeCells('V1:AC1');
        $objPHPExcel->setActiveSheetIndex(0)
                    ->setCellValue('V1', 'October');
            
        $objPHPExcel->getActiveSheet()->mergeCells('AD1:AK1');
        $objPHPExcel->setActiveSheetIndex(0)
                    ->setCellValue('AD1', 'September');
            
        $objPHPExcel->getActiveSheet()->mergeCells('AL1:AS1');
        $objPHPExcel->setActiveSheetIndex(0)
                    ->setCellValue('AL1', 'August');
                    
        $objPHPExcel->getActiveSheet()->mergeCells('AT1:BA1');
        $objPHPExcel->setActiveSheetIndex(0)
                    ->setCellValue('AT1', 'July');

        $objPHPExcel->getActiveSheet()->mergeCells('BB1:BI1');
        $objPHPExcel->setActiveSheetIndex(0)
                    ->setCellValue('BB1', 'June');

        $objPHPExcel->getActiveSheet()->mergeCells('BJ1:BQ1');
        $objPHPExcel->setActiveSheetIndex(0)
                    ->setCellValue('BJ1', 'May');

        $objPHPExcel->getActiveSheet()->mergeCells('BR1:BY1');
        $objPHPExcel->setActiveSheetIndex(0)
                    ->setCellValue('BR1', 'April');
            
        $objPHPExcel->getActiveSheet()->mergeCells('BZ1:CG1');
        $objPHPExcel->setActiveSheetIndex(0)
                    ->setCellValue('BZ1', 'March');
            
        $objPHPExcel->getActiveSheet()->mergeCells('CH1:CO1');
        $objPHPExcel->setActiveSheetIndex(0)
                    ->setCellValue('CH1', 'February');
            
        $objPHPExcel->getActiveSheet()->mergeCells('CP1:CW1');
        $objPHPExcel->setActiveSheetIndex(0)
                    ->setCellValue('CP1', 'January');
        
        foreach($DNpkp as $_data){
            $tahun      = $request->tahun;
            $jan_pr = notulen::where('id_pkp',$_data->id_project)->where('Bulan','January')->where('tahun',$tahun)->where('note_rd_pv','!=','NULL')->first();
            if($jan_pr!=NULL){$jan_pr_hasil = $jan_pr->note_rd_pv;}else{$jan_pr_hasil="-";}
            $jan_pm = notulen::where('id_pkp',$_data->id_project)->where('Bulan','January')->where('tahun',$tahun)->where('note_pv_marketing','!=','NULL')->first();
            if($jan_pm!=NULL){$jan_pm_hasil = $jan_pm->note_pv_marketing;}else{$jan_pm_hasil="-";}
            $feb_pr = notulen::where('id_pkp',$_data->id_project)->where('Bulan','February')->where('tahun',$tahun)->where('note_rd_pv','!=','NULL')->first();
            if($feb_pr!=NULL){$feb_pr_hasil = $feb_pr->note_rd_pv;}else{$feb_pr_hasil="-";}
            $feb_pm = notulen::where('id_pkp',$_data->id_project)->where('Bulan','February')->where('tahun',$tahun)->where('note_pv_marketing','!=','NULL')->first();
            if($feb_pm!=NULL){$feb_pm_hasil = $feb_pm->note_pv_marketing;}else{$feb_pm_hasil="-";}
            $mar_pr = notulen::where('id_pkp',$_data->id_project)->where('Bulan','March')->where('tahun',$tahun)->where('note_rd_pv','!=','NULL')->first();
            if($mar_pr!=NULL){$mar_pr_hasil = $mar_pr->note_rd_pv;}else{$mar_pr_hasil="-";}
            $mar_pm = notulen::where('id_pkp',$_data->id_project)->where('Bulan','March')->where('tahun',$tahun)->where('note_pv_marketing','!=','NULL')->first();
            if($mar_pm!=NULL){$mar_pm_hasil = $mar_pm->note_pv_marketing;}else{$mar_pm_hasil="-";}
            $apr_pr = notulen::where('id_pkp',$_data->id_project)->where('Bulan','April')->where('tahun',$tahun)->where('note_rd_pv','!=','NULL')->first();
            if($apr_pr!=NULL){$apr_pr_hasil = $apr_pr->note_rd_pv;}else{$apr_pr_hasil="-";}
            $apr_pm = notulen::where('id_pkp',$_data->id_project)->where('Bulan','April')->where('tahun',$tahun)->where('note_pv_marketing','!=','NULL')->first();
            if($apr_pm!=NULL){$apr_pm_hasil = $apr_pm->note_pv_marketing;}else{$apr_pm_hasil="-";}
            $may_pr = notulen::where('id_pkp',$_data->id_project)->where('Bulan','May')->where('tahun',$tahun)->where('note_rd_pv','!=','NULL')->first();
            if($may_pr!=NULL){$may_pr_hasil = $may_pr->note_rd_pv;}else{$may_pr_hasil="-";}
            $may_pm = notulen::where('id_pkp',$_data->id_project)->where('Bulan','May')->where('tahun',$tahun)->where('note_pv_marketing','!=','NULL')->first();
            if($may_pm!=NULL){$may_pm_hasil = $may_pm->note_pv_marketing;}else{$may_pm_hasil="-";}
            $jun_pr = notulen::where('id_pkp',$_data->id_project)->where('Bulan','June')->where('tahun',$tahun)->where('note_rd_pv','!=','NULL')->first();
            if($jun_pr!=NULL){$jun_pr_hasil = $jun_pr->note_rd_pv;}else{$jun_pr_hasil="-";}
            $jun_pm = notulen::where('id_pkp',$_data->id_project)->where('Bulan','June')->where('tahun',$tahun)->where('note_pv_marketing','!=','NULL')->first();
            if($jun_pm!=NULL){$jun_pm_hasil = $jun_pm->note_pv_marketing;}else{$jun_pm_hasil="-";}
            $jul_pr = notulen::where('id_pkp',$_data->id_project)->where('Bulan','July')->where('tahun',$tahun)->where('note_rd_pv','!=','NULL')->first();
            if($jul_pr!=NULL){$jul_pr_hasil = $jul_pr->note_rd_pv;}else{$jul_pr_hasil="-";}
            $jul_pm = notulen::where('id_pkp',$_data->id_project)->where('Bulan','July')->where('tahun',$tahun)->where('note_pv_marketing','!=','NULL')->first();
            if($jul_pm!=NULL){$jul_pm_hasil = $jul_pm->note_pv_marketing;}else{$jul_pm_hasil="-";}
            $aug_pr = notulen::where('id_pkp',$_data->id_project)->where('Bulan','August')->where('tahun',$tahun)->where('note_rd_pv','!=','NULL')->first();
            if($aug_pr!=NULL){$aug_pr_hasil = $aug_pr->note_rd_pv;}else{$aug_pr_hasil="-";}
            $aug_pm = notulen::where('id_pkp',$_data->id_project)->where('Bulan','August')->where('tahun',$tahun)->where('note_pv_marketing','!=','NULL')->first();
            if($aug_pm!=NULL){$aug_pm_hasil = $aug_pm->note_pv_marketing;}else{$aug_pm_hasil="-";}
            $sep_pr = notulen::where('id_pkp',$_data->id_project)->where('Bulan','September')->where('tahun',$tahun)->where('note_rd_pv','!=','NULL')->first();
            if($sep_pr!=NULL){$sep_pr_hasil = $sep_pr->note_rd_pv;}else{$sep_pr_hasil="-";}
            $sep_pm = notulen::where('id_pkp',$_data->id_project)->where('Bulan','September')->where('tahun',$tahun)->where('note_pv_marketing','!=','NULL')->first();
            if($sep_pm!=NULL){$sep_pm_hasil = $sep_pm->note_pv_marketing;}else{$sep_pm_hasil="-";}
            $oct_pr = notulen::where('id_pkp',$_data->id_project)->where('Bulan','October')->where('tahun',$tahun)->where('note_rd_pv','!=','NULL')->first();
            if($oct_pr!=NULL){$oct_pr_hasil = $oct_pr->note_rd_pv;}else{$oct_pr_hasil="-";}
            $oct_pm = notulen::where('id_pkp',$_data->id_project)->where('Bulan','October')->where('tahun',$tahun)->where('note_pv_marketing','!=','NULL')->first();
            if($oct_pm!=NULL){$oct_pm_hasil = $oct_pm->note_pv_marketing;}else{$oct_pm_hasil="-";}
            $nov_pr = notulen::where('id_pkp',$_data->id_project)->where('Bulan','November')->where('tahun',$tahun)->where('note_rd_pv','!=','NULL')->first();
            if($nov_pr!=NULL){$nov_pr_hasil = $nov_pr->note_rd_pv;}else{$nov_pr_hasil="-";}
            $nov_pm = notulen::where('id_pkp',$_data->id_project)->where('Bulan','November')->where('tahun',$tahun)->where('note_pv_marketing','!=','NULL')->first();
            if($nov_pm!=NULL){$nov_pm_hasil = $nov_pm->note_pv_marketing;}else{$nov_pm_hasil="-";}
            $dec_pr = notulen::where('id_pkp',$_data->id_project)->where('Bulan','December')->where('tahun',$tahun)->where('note_rd_pv','!=','NULL')->first();
            if($dec_pr!=NULL){$dec_pr_hasil = $dec_pr->note_rd_pv;}else{$dec_pr_hasil="-";}
            $dec_pm = notulen::where('id_pkp',$_data->id_project)->where('Bulan','December')->where('tahun',$tahun)->where('note_pv_marketing','!=','NULL')->first();
            if($dec_pm!=NULL){$dec_pm_hasil = $dec_pm->note_pv_marketing;}else{$dec_pm_hasil="-";}

            // PRIORITAS, Forecast DAN LAUNCH
            // January
            $prioritas_jan_pr = notulen::where('id_pkp',$_data->id_project)->where('Bulan','January')->where('tahun',$tahun)->where('note_rd_pv','!=','NULL')->first();
            if($prioritas_jan_pr!=NULL){$prioritas_jan_pr_hasil = $prioritas_jan_pr->prioritas;}else{$prioritas_jan_pr_hasil="-";}
            $prioritas_jan_pm = notulen::where('id_pkp',$_data->id_project)->where('Bulan','January')->where('tahun',$tahun)->where('note_pv_marketing','!=','NULL')->first();
            if($prioritas_jan_pm!=NULL){$prioritas_jan_pm_hasil = $prioritas_jan_pm->prioritas;}else{$prioritas_jan_pm_hasil="-";}
            
            $pro_jan_pr = NoteForecast::where('id_pkp',$_data->id_project)->where('Bulan','January')->where('tahun',$tahun)->where('info','=','1')->first();
            if($pro_jan_pr!=NULL){$pro_jan_pr_hasil = ' '.$pro_jan_pr->satuan.'='.$pro_jan_pr->forecash;}else{$pro_jan_pr_hasil="-";}
            $pro_jan_pm = NoteForecast::where('id_pkp',$_data->id_project)->where('Bulan','January')->where('tahun',$tahun)->where('info','=','2')->first();
            if($pro_jan_pm!=NULL){$pro_jan_pm_hasil = ' '.$pro_jan_pm->satuan.'='.$pro_jan_pm->forecash;}else{$pro_jan_pm_hasil="-";}
            
            $launch_jan_pr = notulen::where('id_pkp',$_data->id_project)->where('Bulan','January')->where('tahun',$tahun)->where('note_rd_pv','!=','NULL')->first();
            if($launch_jan_pr!=NULL){$launch_jan_pr_hasil=' '.$launch_jan_pr->launch.' '.$launch_jan_pr->launch_years;}else{$launch_jan_pr_hasil="-";}
            $launch_jan_pm = notulen::where('id_pkp',$_data->id_project)->where('Bulan','January')->where('tahun',$tahun)->where('note_pv_marketing','!=','NULL')->first();
            if($launch_jan_pm!=NULL){$launch_jan_pm_hasil=' '.$launch_jan_pm->launch.' '.$launch_jan_pm->launch_years;}else{$launch_jan_pm_hasil="-";}
            // February
            $prioritas_feb_pr= notulen::where('id_pkp',$_data->id_project)->where('Bulan','February')->where('tahun',$tahun)->where('note_rd_pv','!=','NULL')->first();
            if($prioritas_feb_pr!=NULL){$prioritas_feb_pr_hasil = $prioritas_feb_pr->prioritas;}else{$prioritas_feb_pr_hasil="-";}
            $prioritas_feb_pm= notulen::where('id_pkp',$_data->id_project)->where('Bulan','February')->where('tahun',$tahun)->where('note_pv_marketing','!=','NULL')->first();
            if($prioritas_feb_pm!=NULL){$prioritas_feb_pm_hasil = $prioritas_feb_pm->prioritas;}else{$prioritas_feb_pm_hasil="-";}
            
            $pro_feb_pr = NoteForecast::where('id_pkp',$_data->id_project)->where('Bulan','February')->where('tahun',$tahun)->where('info','=','1')->first();
            if($pro_feb_pr!=NULL){$pro_feb_pr_hasil = ' '.$pro_feb_pr->satuan.'='.$pro_feb_pr->forecash;}else{$pro_feb_pr_hasil="-";}
            $pro_feb_pm = NoteForecast::where('id_pkp',$_data->id_project)->where('Bulan','February')->where('tahun',$tahun)->where('info','=','2')->first();
            if($pro_feb_pm!=NULL){$pro_feb_pm_hasil = ' '.$pro_feb_pm->satuan.'='.$pro_feb_pm->forecash;}else{$pro_feb_pm_hasil="-";}

            $launch_feb_pr = notulen::where('id_pkp',$_data->id_project)->where('Bulan','February')->where('tahun',$tahun)->where('note_rd_pv','!=','NULL')->first();
            if($launch_feb_pr!=NULL){$launch_feb_pr_hasil=' '.$launch_feb_pr->launch.' '.$launch_feb_pr->launch_years;}else{$launch_feb_pr_hasil="-";}
            $launch_feb_pm = notulen::where('id_pkp',$_data->id_project)->where('Bulan','February')->where('tahun',$tahun)->where('note_pv_marketing','!=','NULL')->first();
            if($launch_feb_pm!=NULL){$launch_feb_pm_hasil=' '.$launch_feb_pm->launch.' '.$launch_feb_pm->launch_years;}else{$launch_feb_pm_hasil="-";}
            // March
            $prioritas_mar_pr = notulen::where('id_pkp',$_data->id_project)->where('Bulan','March')->where('tahun',$tahun)->where('note_rd_pv','!=','NULL')->first();
            if($prioritas_mar_pr!=NULL){$prioritas_mar_pr_hasil = $prioritas_mar_pr->prioritas;}else{$prioritas_mar_pr_hasil="-";}
            $prioritas_mar_pm = notulen::where('id_pkp',$_data->id_project)->where('Bulan','March')->where('tahun',$tahun)->where('note_pv_marketing','!=','NULL')->first();
            if($prioritas_mar_pm!=NULL){$prioritas_mar_pm_hasil = $prioritas_mar_pm->prioritas;}else{$prioritas_mar_pm_hasil="-";}
            
            $pro_mar_pr = NoteForecast::where('id_pkp',$_data->id_project)->where('Bulan','March')->where('tahun',$tahun)->where('info','=','1')->first();
            if($pro_mar_pr!=NULL){$pro_mar_pr_hasil = ' '.$pro_mar_pr->satuan.'='.$pro_mar_pr->forecash;}else{$pro_mar_pr_hasil="-";}
            $pro_mar_pm = NoteForecast::where('id_pkp',$_data->id_project)->where('Bulan','March')->where('tahun',$tahun)->where('info','=','2')->first();
            if($pro_mar_pm!=NULL){$pro_mar_pm_hasil = ' '.$pro_mar_pm->satuan.'='.$pro_mar_pm->forecash;}else{$pro_mar_pm_hasil="-";}

            $launch_mar_pr = notulen::where('id_pkp',$_data->id_project)->where('Bulan','March')->where('tahun',$tahun)->where('note_rd_pv','!=','NULL')->first();
            if($launch_mar_pr!=NULL){$launch_mar_pr_hasil=' '.$launch_mar_pr->launch.' '.$launch_mar_pr->launch_years;}else{$launch_mar_pr_hasil="-";}
            $launch_mar_pm = notulen::where('id_pkp',$_data->id_project)->where('Bulan','March')->where('tahun',$tahun)->where('note_pv_marketing','!=','NULL')->first();
            if($launch_mar_pm!=NULL){$launch_mar_pm_hasil=' '.$launch_mar_pm->launch.' '.$launch_mar_pm->launch_years;}else{$launch_mar_pm_hasil="-";}
            // April
            $prioritas_apr_pr = notulen::where('id_pkp',$_data->id_project)->where('Bulan','April')->where('tahun',$tahun)->where('note_rd_pv','!=','NULL')->first();
            if($prioritas_apr_pr!=NULL){$prioritas_apr_pr_hasil = $prioritas_apr_pr->prioritas;}else{$prioritas_apr_pr_hasil="-";}
            $prioritas_apr_pm = notulen::where('id_pkp',$_data->id_project)->where('Bulan','April')->where('tahun',$tahun)->where('note_pv_marketing','!=','NULL')->first();
            if($prioritas_apr_pm!=NULL){$prioritas_apr_pm_hasil = $prioritas_apr_pm->prioritas;}else{$prioritas_apr_pm_hasil="-";}

            $pro_apr_pr = NoteForecast::where('id_pkp',$_data->id_project)->where('Bulan','April')->where('tahun',$tahun)->where('info','=','1')->first();
            if($pro_apr_pr!=NULL){$pro_apr_pr_hasil = ' '.$pro_apr_pr->satuan.'='.$pro_apr_pr->forecash;}else{$pro_apr_pr_hasil="-";}
            $pro_apr_pm = NoteForecast::where('id_pkp',$_data->id_project)->where('Bulan','April')->where('tahun',$tahun)->where('info','=','2')->first();
            if($pro_apr_pm!=NULL){$pro_apr_pm_hasil = ' '.$pro_apr_pm->satuan.'='.$pro_apr_pm->forecash;}else{$pro_apr_pm_hasil="-";}

            $launch_apr_pr = notulen::where('id_pkp',$_data->id_project)->where('Bulan','April')->where('tahun',$tahun)->where('note_rd_pv','!=','NULL')->first();
            if($launch_apr_pr!=NULL){$launch_apr_pr_hasil=' '.$launch_apr_pr->launch.' '.$launch_apr_pr->launch_years;}else{$launch_apr_pr_hasil="-";}
            $launch_apr_pm = notulen::where('id_pkp',$_data->id_project)->where('Bulan','April')->where('tahun',$tahun)->where('note_pv_marketing','!=','NULL')->first();
            if($launch_apr_pm!=NULL){$launch_apr_pm_hasil=' '.$launch_apr_pm->launch.' '.$launch_apr_pm->launch_years;}else{$launch_apr_pm_hasil="-";}
            // May
            $prioritas_may_pr = notulen::where('id_pkp',$_data->id_project)->where('Bulan','May')->where('tahun',$tahun)->where('note_rd_pv','!=','NULL')->first();
            if($prioritas_may_pr!=NULL){$prioritas_may_pr_hasil = $prioritas_may_pr->prioritas;}else{$prioritas_may_pr_hasil="-";}
            $prioritas_may_pm = notulen::where('id_pkp',$_data->id_project)->where('Bulan','May')->where('tahun',$tahun)->where('note_pv_marketing','!=','NULL')->first();
            if($prioritas_may_pm!=NULL){$prioritas_may_pm_hasil = $prioritas_may_pm->prioritas;}else{$prioritas_may_pm_hasil="-";}

            $pro_may_pr = NoteForecast::where('id_pkp',$_data->id_project)->where('Bulan','May')->where('tahun',$tahun)->where('info','=','1')->first();
            if($pro_may_pr!=NULL){$pro_may_pr_hasil = ' '.$pro_may_pr->satuan.'='.$pro_may_pr->forecash;}else{$pro_may_pr_hasil="-";}
            $pro_may_pm = NoteForecast::where('id_pkp',$_data->id_project)->where('Bulan','May')->where('tahun',$tahun)->where('info','=','2')->first();
            if($pro_may_pm!=NULL){$pro_may_pm_hasil = ' '.$pro_may_pm->satuan.'='.$pro_may_pm->forecash;}else{$pro_may_pm_hasil="-";}

            $launch_may_pr = notulen::where('id_pkp',$_data->id_project)->where('Bulan','May')->where('tahun',$tahun)->where('note_rd_pv','!=','NULL')->first();
            if($launch_may_pr!=NULL){$launch_may_pr_hasil=' '.$launch_may_pr->launch.' '.$launch_may_pr->launch_years;}else{$launch_may_pr_hasil="-";}
            $launch_may_pm = notulen::where('id_pkp',$_data->id_project)->where('Bulan','May')->where('tahun',$tahun)->where('note_pv_marketing','!=','NULL')->first();
            if($launch_may_pm!=NULL){$launch_may_pm_hasil=' '.$launch_may_pm->launch.' '.$launch_may_pm->launch_years;}else{$launch_may_pm_hasil="-";}
            // june
            $prioritas_jun_pr = notulen::where('id_pkp',$_data->id_project)->where('Bulan','June')->where('tahun',$tahun)->where('note_rd_pv','!=','NULL')->first();
            if($prioritas_jun_pr!=NULL){$prioritas_jun_pr_hasil = $prioritas_jun_pr->prioritas;}else{$prioritas_jun_pr_hasil="-";}
            $prioritas_jun_pm = notulen::where('id_pkp',$_data->id_project)->where('Bulan','June')->where('tahun',$tahun)->where('note_pv_marketing','!=','NULL')->first();
            if($prioritas_jun_pm!=NULL){$prioritas_jun_pm_hasil = $prioritas_jun_pm->prioritas;}else{$prioritas_jun_pm_hasil="-";}

            $pro_jun_pr = NoteForecast::where('id_pkp',$_data->id_project)->where('Bulan','June')->where('tahun',$tahun)->where('info','=','1')->first();
            if($pro_jun_pr!=NULL){$pro_jun_pr_hasil = ' '.$pro_jun_pr->satuan.'='.$pro_jun_pr->forecash;}else{$pro_jun_pr_hasil="-";}
            $pro_jun_pm = NoteForecast::where('id_pkp',$_data->id_project)->where('Bulan','June')->where('tahun',$tahun)->where('info','=','2')->first();
            if($pro_jun_pm!=NULL){$pro_jun_pm_hasil = ' '.$pro_jun_pm->satuan.'='.$pro_jun_pm->forecash;}else{$pro_jun_pm_hasil="-";}

            $launch_jun_pr = notulen::where('id_pkp',$_data->id_project)->where('Bulan','June')->where('tahun',$tahun)->where('note_rd_pv','!=','NULL')->first();
            if($launch_jun_pr!=NULL){$launch_jun_pr_hasil=' '.$launch_jun_pr->launch.' '.$launch_jun_pr->launch_years;}else{$launch_jun_pr_hasil="-";}
            $launch_jun_pm = notulen::where('id_pkp',$_data->id_project)->where('Bulan','June')->where('tahun',$tahun)->where('note_pv_marketing','!=','NULL')->first();
            if($launch_jun_pm!=NULL){$launch_jun_pm_hasil=' '.$launch_jun_pm->launch.' '.$launch_jun_pm->launch_years;}else{$launch_jun_pm_hasil="-";}
            // July
            $prioritas_jul_pr = notulen::where('id_pkp',$_data->id_project)->where('Bulan','July')->where('tahun',$tahun)->where('note_rd_pv','!=','NULL')->first();
            if($prioritas_jul_pr!=NULL){$prioritas_jul_pr_hasil = $prioritas_jul_pr->prioritas;}else{$prioritas_jul_pr_hasil="-";}
            $prioritas_jul_pm = notulen::where('id_pkp',$_data->id_project)->where('Bulan','July')->where('tahun',$tahun)->where('note_pv_marketing','!=','NULL')->first();
            if($prioritas_jul_pm!=NULL){$prioritas_jul_pm_hasil = $prioritas_jul_pm->prioritas;}else{$prioritas_jul_pm_hasil="-";}

            $pro_jul_pr = NoteForecast::where('id_pkp',$_data->id_project)->where('Bulan','July')->where('tahun',$tahun)->where('info','=','1')->first();
            if($pro_mar_pr!=NULL){$pro_jul_pr_hasil = ' '.$pro_jul_pr->satuan.'='.$pro_jul_pr->forecash;}else{$pro_jul_pr_hasil="-";}
            $pro_jul_pm = NoteForecast::where('id_pkp',$_data->id_project)->where('Bulan','July')->where('tahun',$tahun)->where('info','=','2')->first();
            if($pro_jul_pm!=NULL){$pro_jul_pm_hasil = ' '.$pro_jul_pm->satuan.'='.$pro_jul_pm->forecash;}else{$pro_jul_pm_hasil="-";}

            $launch_jul_pr = notulen::where('id_pkp',$_data->id_project)->where('Bulan','July')->where('tahun',$tahun)->where('note_rd_pv','!=','NULL')->first();
            if($launch_jul_pr!=NULL){$launch_jul_pr_hasil=' '.$launch_jul_pr->launch.' '.$launch_jul_pr->launch_years;}else{$launch_jul_pr_hasil="-";}
            $launch_jul_pm = notulen::where('id_pkp',$_data->id_project)->where('Bulan','July')->where('tahun',$tahun)->where('note_pv_marketing','!=','NULL')->first();
            if($launch_jul_pm!=NULL){$launch_jul_pm_hasil=' '.$launch_jul_pm->launch.' '.$launch_jul_pm->launch_years;}else{$launch_jul_pm_hasil="-";}
            // August
            $prioritas_aug_pr = notulen::where('id_pkp',$_data->id_project)->where('Bulan','August')->where('tahun',$tahun)->where('note_rd_pv','!=','NULL')->first();
            if($prioritas_aug_pr!=NULL){$prioritas_aug_pr_hasil = $prioritas_aug_pr->prioritas;}else{$prioritas_aug_pr_hasil="-";}
            $prioritas_aug_pm = notulen::where('id_pkp',$_data->id_project)->where('Bulan','August')->where('tahun',$tahun)->where('note_pv_marketing','!=','NULL')->first();
            if($prioritas_aug_pm!=NULL){$prioritas_aug_pm_hasil = $prioritas_aug_pm->prioritas;}else{$prioritas_aug_pm_hasil="-";}

            $pro_aug_pr = NoteForecast::where('id_pkp',$_data->id_project)->where('Bulan','August')->where('tahun',$tahun)->where('info','=','1')->first();
            if($pro_aug_pr!=NULL){$pro_aug_pr_hasil = ' '.$pro_aug_pr->satuan.'='.$pro_aug_pr->forecash;}else{$pro_aug_pr_hasil="-";}
            $pro_aug_pm = NoteForecast::where('id_pkp',$_data->id_project)->where('Bulan','August')->where('tahun',$tahun)->where('info','=','2')->first();
            if($pro_aug_pm!=NULL){$pro_aug_pm_hasil = ' '.$pro_aug_pm->satuan.'='.$pro_aug_pm->forecash;}else{$pro_aug_pm_hasil="-";}

            $launch_aug_pr = notulen::where('id_pkp',$_data->id_project)->where('Bulan','August')->where('tahun',$tahun)->where('note_rd_pv','!=','NULL')->first();
            if($launch_aug_pr!=NULL){$launch_aug_pr_hasil=' '.$launch_aug_pr->launch.' '.$launch_aug_pr->launch_years;}else{$launch_aug_pr_hasil="-";}
            $launch_aug_pm = notulen::where('id_pkp',$_data->id_project)->where('Bulan','August')->where('tahun',$tahun)->where('note_pv_marketing','!=','NULL')->first();
            if($launch_aug_pm!=NULL){$launch_aug_pm_hasil=' '.$launch_aug_pm->launch.' '.$launch_aug_pm->launch_years;}else{$launch_aug_pm_hasil="-";}
            // Sept
            $prioritas_sep_pr = notulen::where('id_pkp',$_data->id_project)->where('Bulan','September')->where('tahun',$tahun)->where('note_rd_pv','!=','NULL')->first();
            if($prioritas_sep_pr!=NULL){$prioritas_sep_pr_hasil = $prioritas_sep_pr->prioritas;}else{$prioritas_sep_pr_hasil="-";}
            $prioritas_sep_pm = notulen::where('id_pkp',$_data->id_project)->where('Bulan','September')->where('tahun',$tahun)->where('note_pv_marketing','!=','NULL')->first();
            if($prioritas_sep_pm!=NULL){$prioritas_sep_pm_hasil = $prioritas_sep_pm->prioritas;}else{$prioritas_sep_pm_hasil="-";}

            $pro_sep_pr = NoteForecast::where('id_pkp',$_data->id_project)->where('Bulan','September')->where('tahun',$tahun)->where('info','=','1')->first();
            if($pro_sep_pr!=NULL){$pro_sep_pr_hasil = ' '.$pro_sep_pr->satuan.'='.$pro_sep_pr->forecash;}else{$pro_sep_pr_hasil="-";}
            $pro_sep_pm = NoteForecast::where('id_pkp',$_data->id_project)->where('Bulan','September')->where('tahun',$tahun)->where('info','=','2')->first();
            if($pro_sep_pm!=NULL){$pro_sep_pm_hasil = ' '.$pro_sep_pm->satuan.'='.$pro_sep_pm->forecash;}else{$pro_sep_pm_hasil="-";}

            $launch_sep_pr = notulen::where('id_pkp',$_data->id_project)->where('Bulan','September')->where('tahun',$tahun)->where('note_rd_pv','!=','NULL')->first();
            if($launch_sep_pr!=NULL){$launch_sep_pr_hasil=' '.$launch_sep_pr->launch.' '.$launch_sep_pr->launch_years;}else{$launch_sep_pr_hasil="-";}
            $launch_sep_pm = notulen::where('id_pkp',$_data->id_project)->where('Bulan','September')->where('tahun',$tahun)->where('note_pv_marketing','!=','NULL')->first();
            if($launch_sep_pm!=NULL){$launch_sep_pm_hasil=' '.$launch_sep_pm->launch.' '.$launch_sep_pm->launch_years;}else{$launch_sep_pm_hasil="-";}
            // Oct
            $prioritas_oct_pr = notulen::where('id_pkp',$_data->id_project)->where('Bulan','October')->where('tahun',$tahun)->where('note_rd_pv','!=','NULL')->first();
            if($prioritas_oct_pr!=NULL){$prioritas_oct_pr_hasil = $prioritas_oct_pr->prioritas;}else{$prioritas_oct_pr_hasil="-";}
            $prioritas_oct_pm = notulen::where('id_pkp',$_data->id_project)->where('Bulan','October')->where('tahun',$tahun)->where('note_pv_marketing','!=','NULL')->first();
            if($prioritas_oct_pm!=NULL){$prioritas_oct_pm_hasil = $prioritas_oct_pm->prioritas;}else{$prioritas_oct_pm_hasil="-";}

            $pro_oct_pr = NoteForecast::where('id_pkp',$_data->id_project)->where('Bulan','October')->where('tahun',$tahun)->where('info','=','1')->first();
            if($pro_oct_pr!=NULL){$pro_oct_pr_hasil = ' '.$pro_oct_pr->satuan.'='.$pro_oct_pr->forecash;}else{$pro_oct_pr_hasil="-";}
            $pro_oct_pm = NoteForecast::where('id_pkp',$_data->id_project)->where('Bulan','October')->where('tahun',$tahun)->where('info','=','2')->first();
            if($pro_oct_pm!=NULL){$pro_oct_pm_hasil = ' '.$pro_oct_pm->satuan.'='.$pro_oct_pm->forecash;}else{$pro_oct_pm_hasil="-";}

            $launch_oct_pr = notulen::where('id_pkp',$_data->id_project)->where('Bulan','October')->where('tahun',$tahun)->where('note_rd_pv','!=','NULL')->first();
            if($launch_oct_pr!=NULL){$launch_oct_pr_hasil=' '.$launch_oct_pr->launch.' '.$launch_oct_pr->launch_years;}else{$launch_oct_pr_hasil="-";}
            $launch_oct_pm = notulen::where('id_pkp',$_data->id_project)->where('Bulan','October')->where('tahun',$tahun)->where('note_pv_marketing','!=','NULL')->first();
            if($launch_oct_pm!=NULL){$launch_oct_pm_hasil=' '.$launch_oct_pm->launch.' '.$launch_oct_pm->launch_years;}else{$launch_oct_pm_hasil="-";}
            // Nov
            $prioritas_nov_pr = notulen::where('id_pkp',$_data->id_project)->where('Bulan','November')->where('tahun',$tahun)->where('note_rd_pv','!=','NULL')->first();
            if($prioritas_nov_pr!=NULL){$prioritas_nov_pr_hasil = $prioritas_nov_pr->prioritas;}else{$prioritas_nov_pr_hasil="-";}
            $prioritas_nov_pm = notulen::where('id_pkp',$_data->id_project)->where('Bulan','November')->where('tahun',$tahun)->where('note_pv_marketing','!=','NULL')->first();
            if($prioritas_nov_pm!=NULL){$prioritas_nov_pm_hasil = $prioritas_nov_pm->prioritas;}else{$prioritas_nov_pm_hasil="-";}

            $pro_nov_pr = NoteForecast::where('id_pkp',$_data->id_project)->where('Bulan','November')->where('tahun',$tahun)->where('info','=','1')->first();
            if($pro_nov_pr!=NULL){$pro_nov_pr_hasil = ' '.$pro_nov_pr->satuan.'='.$pro_nov_pr->forecash;}else{$pro_nov_pr_hasil="-";}
            $pro_nov_pm = NoteForecast::where('id_pkp',$_data->id_project)->where('Bulan','November')->where('tahun',$tahun)->where('info','=','2')->first();
            if($pro_nov_pm!=NULL){$pro_nov_pm_hasil = ' '.$pro_nov_pm->satuan.'='.$pro_nov_pm->forecash;}else{$pro_nov_pm_hasil="-";}

            $launch_nov_pr = notulen::where('id_pkp',$_data->id_project)->where('Bulan','November')->where('tahun',$tahun)->where('note_rd_pv','!=','NULL')->first();
            if($launch_nov_pr!=NULL){$launch_nov_pr_hasil=' '.$launch_nov_pr->launch.' '.$launch_nov_pr->launch_years;}else{$launch_nov_pr_hasil="-";}
            $launch_nov_pm = notulen::where('id_pkp',$_data->id_project)->where('Bulan','November')->where('tahun',$tahun)->where('note_pv_marketing','!=','NULL')->first();
            if($launch_nov_pm!=NULL){$launch_nov_pm_hasil=' '.$launch_nov_pm->launch.' '.$launch_nov_pm->launch_years;}else{$launch_nov_pm_hasil="-";}
            // Dec
            $prioritas_dec_pr = notulen::where('id_pkp',$_data->id_project)->where('Bulan','December')->where('tahun',$tahun)->where('note_rd_pv','!=','NULL')->first();
            if($prioritas_dec_pr!=NULL){$prioritas_dec_pr_hasil = $prioritas_pr_dec->prioritas;}else{$prioritas_dec_pr_hasil="-";}
            $prioritas_dec_pm = notulen::where('id_pkp',$_data->id_project)->where('Bulan','December')->where('tahun',$tahun)->where('note_pv_marketing','!=','NULL')->first();
            if($prioritas_dec_pm!=NULL){$prioritas_dec_pm_hasil = $prioritas_dec_pm->prioritas;}else{$prioritas_dec_pm_hasil="-";}

            $pro_dec_pr = NoteForecast::where('id_pkp',$_data->id_project)->where('Bulan','December')->where('tahun',$tahun)->where('info','=','1')->first();
            if($pro_dec_pr!=NULL){$pro_dec_pr_hasil = ' '.$pro_dec_pr->satuan.'='.$pro_dec_pr->forecash;}else{$pro_dec_pr_hasil="-";}
            $pro_dec_pm = NoteForecast::where('id_pkp',$_data->id_project)->where('Bulan','December')->where('tahun',$tahun)->where('info','=','2')->first();
            if($pro_dec_pm!=NULL){$pro_dec_pm_hasil = ' '.$pro_dec_pm->satuan.'='.$pro_dec_pm->forecash;}else{$pro_dec_pm_hasil="-";}

            $launch_dec_pr = notulen::where('id_pkp',$_data->id_project)->where('Bulan','December')->where('tahun',$tahun)->where('note_rd_pv','!=','NULL')->first();
            if($launch_dec_pr!=NULL){$launch_dec_pr_hasil=' '.$launch_dec_pr->launch.' '.$launch_dec_pr->launch_years;}else{$launch_dec_pr_hasil="-";}
            $launch_dec_pm = notulen::where('id_pkp',$_data->id_project)->where('Bulan','December')->where('tahun',$tahun)->where('note_pv_marketing','!=','NULL')->first();
            if($launch_dec_pm!=NULL){$launch_dec_pm_hasil=' '.$launch_dec_pm->launch.' '.$launch_dec_pm->launch_years;}else{$launch_dec_pm_hasil="-";}

            $user2 = User::where('id',$_data->userpenerima2)->first();
            $user1 = User::where('id',$_data->userpenerima)->first();
            $pv = User::where('id',$_data->perevisi)->first();

            $objPHPExcel->setActiveSheetIndex(0)
                        ->setCellValue('A'.$pertama, $_data['pkp_number'])
                        ->setCellValue('B'.$pertama, $_data['ket_no'])
                        ->setCellValue('C'.$pertama, $user2['name'])
                        ->setCellValue('D'.$pertama, $user1['name'])
                        ->setCellValue('E'.$pertama, $pv['name'])

                        ->setCellValue('F'.$pertama, $prioritas_dec_pm_hasil)
                        ->setCellValue('G'.$pertama, $launch_dec_pm_hasil)
                        ->setCellValue('H'.$pertama, $dec_pm_hasil)
                        ->setCellValue('I'.$pertama, $pro_dec_pm_hasil)

                        ->setCellValue('J'.$pertama, $prioritas_dec_pr_hasil)
                        ->setCellValue('K'.$pertama, $launch_dec_pr_hasil)
                        ->setCellValue('L'.$pertama, $dec_pr_hasil)
                        ->setCellValue('M'.$pertama, $pro_dec_pr_hasil)

                        ->setCellValue('N'.$pertama, $prioritas_nov_pm_hasil)
                        ->setCellValue('O'.$pertama, $launch_nov_pm_hasil)
                        ->setCellValue('P'.$pertama, $nov_pm_hasil)
                        ->setCellValue('Q'.$pertama, $pro_nov_pm_hasil)
                        
                        ->setCellValue('R'.$pertama, $prioritas_nov_pr_hasil)
                        ->setCellValue('S'.$pertama, $launch_nov_pr_hasil)
                        ->setCellValue('T'.$pertama, $nov_pr_hasil)
                        ->setCellValue('U'.$pertama, $pro_nov_pr_hasil)

                        ->setCellValue('V'.$pertama, $prioritas_oct_pm_hasil)
                        ->setCellValue('W'.$pertama, $launch_oct_pm_hasil)
                        ->setCellValue('X'.$pertama, $oct_pm_hasil)
                        ->setCellValue('Y'.$pertama, $pro_oct_pm_hasil)

                        ->setCellValue('Z'.$pertama, $prioritas_oct_pr_hasil)
                        ->setCellValue('AA'.$pertama, $launch_oct_pr_hasil)
                        ->setCellValue('AB'.$pertama, $oct_pr_hasil)
                        ->setCellValue('AC'.$pertama, $pro_oct_pr_hasil)

                        ->setCellValue('AD'.$pertama, $prioritas_sep_pm_hasil)
                        ->setCellValue('AE'.$pertama, $launch_sep_pm_hasil)
                        ->setCellValue('AF'.$pertama, $sep_pm_hasil)
                        ->setCellValue('AG'.$pertama, $pro_sep_pm_hasil)

                        ->setCellValue('AH'.$pertama, $prioritas_sep_pr_hasil)
                        ->setCellValue('AI'.$pertama, $launch_sep_pr_hasil)
                        ->setCellValue('AJ'.$pertama, $sep_pr_hasil)
                        ->setCellValue('AK'.$pertama, $pro_sep_pr_hasil)

                        ->setCellValue('AL'.$pertama, $prioritas_aug_pm_hasil)
                        ->setCellValue('AM'.$pertama, $launch_aug_pm_hasil)
                        ->setCellValue('AN'.$pertama, $aug_pm_hasil)
                        ->setCellValue('AO'.$pertama, $pro_aug_pm_hasil)

                        ->setCellValue('AP'.$pertama, $prioritas_aug_pr_hasil)
                        ->setCellValue('AQ'.$pertama, $launch_aug_pr_hasil)
                        ->setCellValue('AR'.$pertama, $aug_pr_hasil)
                        ->setCellValue('AS'.$pertama, $pro_aug_pr_hasil)

                        ->setCellValue('AT'.$pertama, $prioritas_jul_pm_hasil)
                        ->setCellValue('AU'.$pertama, $launch_jul_pm_hasil)
                        ->setCellValue('AV'.$pertama, $jul_pm_hasil)
                        ->setCellValue('AW'.$pertama, $pro_jul_pm_hasil)

                        ->setCellValue('AX'.$pertama, $prioritas_jul_pr_hasil)
                        ->setCellValue('AY'.$pertama, $launch_jul_pr_hasil)
                        ->setCellValue('AZ'.$pertama, $jul_pr_hasil)
                        ->setCellValue('BA'.$pertama, $pro_jul_pr_hasil)

                        ->setCellValue('BB'.$pertama, $prioritas_jun_pm_hasil)
                        ->setCellValue('BC'.$pertama, $launch_jun_pm_hasil)
                        ->setCellValue('BD'.$pertama, $jun_pm_hasil)
                        ->setCellValue('BE'.$pertama, $pro_jun_pm_hasil)

                        ->setCellValue('BF'.$pertama, $prioritas_jun_pr_hasil)
                        ->setCellValue('BG'.$pertama, $launch_jun_pr_hasil)
                        ->setCellValue('BH'.$pertama, $jun_pr_hasil)
                        ->setCellValue('BI'.$pertama, $pro_jun_pr_hasil)

                        ->setCellValue('BJ'.$pertama, $prioritas_may_pm_hasil)
                        ->setCellValue('BK'.$pertama, $launch_may_pm_hasil)
                        ->setCellValue('BL'.$pertama, $may_pm_hasil)
                        ->setCellValue('BM'.$pertama, $pro_may_pm_hasil)

                        ->setCellValue('BN'.$pertama, $prioritas_may_pr_hasil)
                        ->setCellValue('BO'.$pertama, $launch_may_pr_hasil)
                        ->setCellValue('BP'.$pertama, $may_pr_hasil)
                        ->setCellValue('BQ'.$pertama, $pro_may_pr_hasil)

                        ->setCellValue('BR'.$pertama, $prioritas_apr_pm_hasil)
                        ->setCellValue('BS'.$pertama, $launch_apr_pm_hasil)
                        ->setCellValue('BT'.$pertama, $apr_pm_hasil)
                        ->setCellValue('BU'.$pertama, $pro_apr_pm_hasil)

                        ->setCellValue('BV'.$pertama, $prioritas_apr_pr_hasil)
                        ->setCellValue('BW'.$pertama, $launch_apr_pr_hasil)
                        ->setCellValue('BX'.$pertama, $apr_pr_hasil)
                        ->setCellValue('BY'.$pertama, $pro_apr_pr_hasil)

                        ->setCellValue('BZ'.$pertama, $prioritas_mar_pm_hasil)
                        ->setCellValue('CA'.$pertama, $launch_mar_pm_hasil)
                        ->setCellValue('CB'.$pertama, $mar_pm_hasil)
                        ->setCellValue('CC'.$pertama, $pro_mar_pm_hasil)

                        ->setCellValue('CD'.$pertama, $prioritas_mar_pr_hasil)
                        ->setCellValue('CE'.$pertama, $launch_mar_pr_hasil)
                        ->setCellValue('CF'.$pertama, $mar_pr_hasil)
                        ->setCellValue('CG'.$pertama, $pro_mar_pr_hasil)

                        ->setCellValue('CH'.$pertama, $prioritas_feb_pm_hasil)
                        ->setCellValue('CI'.$pertama, $launch_feb_pm_hasil)
                        ->setCellValue('CJ'.$pertama, $feb_pm_hasil)
                        ->setCellValue('CK'.$pertama, $pro_feb_pm_hasil)

                        ->setCellValue('CL'.$pertama, $prioritas_feb_pr_hasil)
                        ->setCellValue('CM'.$pertama, $launch_feb_pr_hasil)
                        ->setCellValue('CN'.$pertama, $feb_pr_hasil)
                        ->setCellValue('CO'.$pertama, $pro_feb_pr_hasil)

                        ->setCellValue('CP'.$pertama, $prioritas_jan_pm_hasil)
                        ->setCellValue('CQ'.$pertama, $launch_jan_pm_hasil)
                        ->setCellValue('CR'.$pertama, $jan_pm_hasil)
                        ->setCellValue('CS'.$pertama, $pro_jan_pm_hasil)

                        ->setCellValue('CT'.$pertama, $prioritas_jan_pr_hasil)
                        ->setCellValue('CU'.$pertama, $launch_jan_pr_hasil)
                        ->setCellValue('CV'.$pertama, $jan_pr_hasil)
                        ->setCellValue('CW'.$pertama, $pro_jan_pr_hasil);
            $pertama++;
        }
        
        $no++;
        $objPHPExcel->getActiveSheet()->setTitle('Tabulasi Notulen');
        $skrg=date('d m Y');
            header('Content-Type: application/vnd.ms-excel'); 
            header('Content-Disposition: attachment;filename="Tabulasi_Notulen_ '.$skrg.'.xls"'); 
            header('Cache-Control: max-age=0'); 
        $objWriter = \PhpOffice\PhpSpreadsheet\IOFactory::createWriter($objPHPExcel, "Xlsx");
        ob_end_clean();
        $objWriter->save('php://output');
    }
}