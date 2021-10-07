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
use DB;
use Auth;

class cetakController extends Controller
{
    public function download_project(){
        $objPHPExcel = new Spreadsheet();
        $objPHPExcel->setActiveSheetIndex(0); 

        $objPHPExcel->getActiveSheet()->getColumnDimension('A')->setWidth(5.00);
        $objPHPExcel->getActiveSheet()->getColumnDimension('B')->setWidth(45.71);
        $objPHPExcel->getActiveSheet()->getColumnDimension('C')->setWidth(18.67);
        $objPHPExcel->getActiveSheet()->getColumnDimension('D')->setWidth(17.67);
        $objPHPExcel->getActiveSheet()->getColumnDimension('E')->setWidth(17.00);
        $objPHPExcel->getActiveSheet()->getColumnDimension('F')->setWidth(14.00);

        $objPHPExcel->getActiveSheet()->getColumnDimension('G')->setWidth(17.5);
        $objPHPExcel->getActiveSheet()->getColumnDimension('H')->setWidth(17.14);
        $objPHPExcel->getActiveSheet()->getColumnDimension('I')->setWidth(9.5);
        $objPHPExcel->getActiveSheet()->getColumnDimension('J')->setWidth(9.5);
        $objPHPExcel->getActiveSheet()->getColumnDimension('K')->setWidth(30.57);
        $objPHPExcel->getActiveSheet()->getColumnDimension('L')->setWidth(16.71);

        $objPHPExcel->getActiveSheet()->getColumnDimension('M')->setWidth(16.71);
        $objPHPExcel->getActiveSheet()->getColumnDimension('N')->setWidth(14.67);
        $objPHPExcel->getActiveSheet()->getColumnDimension('O')->setWidth(30.14);
        $objPHPExcel->getActiveSheet()->getColumnDimension('P')->setWidth(15.5);
        $objPHPExcel->getActiveSheet()->getColumnDimension('Q')->setWidth(20.57);
        $objPHPExcel->getActiveSheet()->getColumnDimension('R')->setWidth(15.71);

        $objPHPExcel->getActiveSheet()->getColumnDimension('S')->setWidth(14.67);
        $objPHPExcel->getActiveSheet()->getColumnDimension('T')->setWidth(25.14);
        $objPHPExcel->getActiveSheet()->getColumnDimension('U')->setWidth(22.5);
        $objPHPExcel->getActiveSheet()->getColumnDimension('V')->setWidth(12.57);
        $objPHPExcel->getActiveSheet()->getColumnDimension('W')->setWidth(12.57);
        $objPHPExcel->getActiveSheet()->getColumnDimension('X')->setWidth(4.71);

        $objPHPExcel->getActiveSheet()->getColumnDimension('Y')->setWidth(4.67);
        $objPHPExcel->getActiveSheet()->getColumnDimension('Z')->setWidth(4.14);
        $objPHPExcel->getActiveSheet()->getColumnDimension('AA')->setWidth(4.5);
        $objPHPExcel->getActiveSheet()->getColumnDimension('AB')->setWidth(4.57);
        $objPHPExcel->getActiveSheet()->getColumnDimension('AC')->setWidth(4.57);
        $objPHPExcel->getActiveSheet()->getColumnDimension('AD')->setWidth(4.71);

        $objPHPExcel->getActiveSheet()->getColumnDimension('AE')->setWidth(4.71);
        $objPHPExcel->getActiveSheet()->getColumnDimension('AF')->setWidth(25.14);
        $objPHPExcel->getActiveSheet()->getColumnDimension('AG')->setWidth(24.5);
        $objPHPExcel->getActiveSheet()->getColumnDimension('AH')->setWidth(22.57);
        $objPHPExcel->getActiveSheet()->getColumnDimension('AI')->setWidth(18.57);
        $objPHPExcel->getActiveSheet()->getColumnDimension('AJ')->setWidth(30.57);

        $awal=1;
        $pertama=2;

        $data=PkpProject::join('ms_tarkons','ms_tarkons.id_tarkon','tr_project_pkp.akg')
            ->join('tr_users','tr_users.id','tr_project_pkp.perevisi')
            ->join('tr_kemas','tr_kemas.id_kemas','tr_project_pkp.kemas_eksis')->where('status_project','=','active')
            ->where('status_freeze','inactive')->where('status_pkp','!=','revisi')
            ->where('status_pkp','!=','draf')->orderBy('pkp_number','asc')->get();
            $no=1;
        
        $baris=1;
        $objPHPExcel->setActiveSheetIndex(0)
                    ->setCellValue('A'.$baris, 'PKP Number')
                    ->setCellValue('C'.$baris, 'Project Name')
                    ->setCellValue('D'.$baris, 'Created Date')
                    ->setCellValue('E'.$baris, 'Sent To RND')
                    ->setCellValue('F'.$baris, 'PV')
                    ->setCellValue('G'.$baris, 'Type')
                    ->setCellValue('H'.$baris, 'Brand')
                    ->setCellValue('I'.$baris, 'Priority')
                    ->setCellValue('J'.$baris, 'Jenis')
                    ->setCellValue('K'.$baris, 'Idea')
                    ->setCellValue('L'.$baris, 'Target Launch')
                    ->setCellValue('M'.$baris, 'Gender')
                    ->setCellValue('N'.$baris, 'Uniqueness')
                    ->setCellValue('O'.$baris, 'Reason')
                    ->setCellValue('P'.$baris, 'Estimated')
                    ->setCellValue('Q'.$baris, 'Competitive')
                    ->setCellValue('R'.$baris, 'Selling Price')
                    ->setCellValue('S'.$baris, 'Price')
                    ->setCellValue('T'.$baris, 'Competitor')
                    ->setCellValue('U'.$baris, 'Aisle')
                    ->setCellValue('V'.$baris, 'Product Form')
                    ->setCellValue('W'.$baris, 'AKG')
                    ->setCellValue('X'.$baris, 'Kemas')
                    ->setCellValue('AF'.$baris, 'Prefered Flavour')
                    ->setCellValue('AG'.$baris, 'Product Benefits')
                    ->setCellValue('AH'.$baris, 'Mandatory Ingredient')
                    ->setCellValue('AI'.$baris, 'UOM')
                    ->setCellValue('AJ'.$baris, 'Serving Suggestion');
                            
        $objPHPExcel->getActiveSheet()->mergeCells('A'.$baris.':B'.$baris);
        $objPHPExcel->setActiveSheetIndex(0)
                    ->setCellValue('A'.$baris, 'PKP Number');

        $objPHPExcel->getActiveSheet()->getStyle('A'.$baris.':AJ'.$baris)->getFill()
                    ->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)
                    ->getStartColor()->setARGB('13DFE4');
        $objPHPExcel->getActiveSheet()->getStyle('A'.$baris.':AJ'.$baris)->getAlignment()->setHorizontal('center');

        $objPHPExcel->getActiveSheet()->mergeCells('X'.$baris.':AE'.$baris);
        $objPHPExcel->setActiveSheetIndex(0)
                    ->setCellValue('AE'.$baris, 'Kemas');
                
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
            
            $objPHPExcel->setActiveSheetIndex(0)
                    ->setCellValue('A'.$pertama, $_data['pkp_number'])
                    ->setCellValue('B'.$pertama, $_data['ket_no'])
                    ->setCellValue('C'.$pertama, $_data['project_name'])
                    ->setCellValue('D'.$pertama, $_data['created_date'])
                    ->setCellValue('E'.$pertama, $_data['tgl_kirim'])
                    ->setCellValue('F'.$pertama, $_data['name'])
                    ->setCellValue('G'.$pertama, $type)
                    ->setCellValue('H'.$pertama, $_data['id_brand'])
                    ->setCellValue('I'.$pertama, $_data['prioritas'])
                    ->setCellValue('J'.$pertama, $_data['jenis'])
                    ->setCellValue('K'.$pertama, $_data['idea'])
                    ->setCellValue('L'.$pertama, $ld)
                    ->setCellValue('M'.$pertama, $_data['gender'])
                    ->setCellValue('N'.$pertama, $_data['Uniqueness'])
                    ->setCellValue('O'.$pertama, $_data['reason'])
                    ->setCellValue('P'.$pertama, $_data['Estimated'])
                    ->setCellValue('Q'.$pertama, $_data['competitive'])
                    ->setCellValue('R'.$pertama, $_data['selling_price'])
                    ->setCellValue('S'.$pertama, $_data['price'])
                    ->setCellValue('T'.$pertama, $_data['competitor'])
                    ->setCellValue('U'.$pertama, $_data['aisle'])
                    ->setCellValue('V'.$pertama, $_data['product_form'])
                    ->setCellValue('W'.$pertama, $_data['tarkon'])
                    ->setCellValue('X'.$pertama, $_data['tersier'])
                    ->setCellValue('Y'.$pertama, $_data['s_tersier'])
                    ->setCellValue('Z'.$pertama, $_data['sekunder1'])
                    ->setCellValue('AA'.$pertama, $_data['s_sekunder1'])
                    ->setCellValue('AB'.$pertama, $_data['sekunder2'])
                    ->setCellValue('AC'.$pertama, $_data['s_sekunder2'])
                    ->setCellValue('AD'.$pertama, $_data['primer'])
                    ->setCellValue('AE'.$pertama, $_data['s_primer'])
                    ->setCellValue('AF'.$pertama, $_data['prefered_flavour'])
                    ->setCellValue('AG'.$pertama, $_data['product_benefits'])
                    ->setCellValue('AH'.$pertama, $_data['mandatory_ingredient'])
                    ->setCellValue('AI'.$pertama, $_data['UOM'])
                    ->setCellValue('AJ'.$pertama, $_data['serving_suggestion']);
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

    public function download_my_project(){
        $objPHPExcel = new Spreadsheet();
        $objPHPExcel->setActiveSheetIndex(0); 

        $objPHPExcel->getActiveSheet()->getColumnDimension('A')->setWidth(5.00);
        $objPHPExcel->getActiveSheet()->getColumnDimension('B')->setWidth(30.71);
        $objPHPExcel->getActiveSheet()->getColumnDimension('C')->setWidth(18.67);
        $objPHPExcel->getActiveSheet()->getColumnDimension('D')->setWidth(17.67);
        $objPHPExcel->getActiveSheet()->getColumnDimension('E')->setWidth(17.00);
        $objPHPExcel->getActiveSheet()->getColumnDimension('F')->setWidth(14.00);

        $objPHPExcel->getActiveSheet()->getColumnDimension('G')->setWidth(17.5);
        $objPHPExcel->getActiveSheet()->getColumnDimension('H')->setWidth(17.14);
        $objPHPExcel->getActiveSheet()->getColumnDimension('I')->setWidth(9.5);
        $objPHPExcel->getActiveSheet()->getColumnDimension('J')->setWidth(9.5);
        $objPHPExcel->getActiveSheet()->getColumnDimension('K')->setWidth(30.57);
        $objPHPExcel->getActiveSheet()->getColumnDimension('L')->setWidth(16.71);

        $objPHPExcel->getActiveSheet()->getColumnDimension('M')->setWidth(16.71);
        $objPHPExcel->getActiveSheet()->getColumnDimension('N')->setWidth(14.67);
        $objPHPExcel->getActiveSheet()->getColumnDimension('O')->setWidth(30.14);
        $objPHPExcel->getActiveSheet()->getColumnDimension('P')->setWidth(15.5);
        $objPHPExcel->getActiveSheet()->getColumnDimension('Q')->setWidth(20.57);
        $objPHPExcel->getActiveSheet()->getColumnDimension('R')->setWidth(15.71);

        $objPHPExcel->getActiveSheet()->getColumnDimension('S')->setWidth(14.67);
        $objPHPExcel->getActiveSheet()->getColumnDimension('T')->setWidth(25.14);
        $objPHPExcel->getActiveSheet()->getColumnDimension('U')->setWidth(22.5);
        $objPHPExcel->getActiveSheet()->getColumnDimension('V')->setWidth(12.57);
        $objPHPExcel->getActiveSheet()->getColumnDimension('W')->setWidth(12.57);
        $objPHPExcel->getActiveSheet()->getColumnDimension('X')->setWidth(4.71);

        $objPHPExcel->getActiveSheet()->getColumnDimension('Y')->setWidth(4.67);
        $objPHPExcel->getActiveSheet()->getColumnDimension('Z')->setWidth(4.14);
        $objPHPExcel->getActiveSheet()->getColumnDimension('AA')->setWidth(4.5);
        $objPHPExcel->getActiveSheet()->getColumnDimension('AB')->setWidth(4.57);
        $objPHPExcel->getActiveSheet()->getColumnDimension('AC')->setWidth(4.57);
        $objPHPExcel->getActiveSheet()->getColumnDimension('AD')->setWidth(4.71);

        $objPHPExcel->getActiveSheet()->getColumnDimension('AE')->setWidth(4.71);
        $objPHPExcel->getActiveSheet()->getColumnDimension('AF')->setWidth(25.14);
        $objPHPExcel->getActiveSheet()->getColumnDimension('AG')->setWidth(24.5);
        $objPHPExcel->getActiveSheet()->getColumnDimension('AH')->setWidth(22.57);
        $objPHPExcel->getActiveSheet()->getColumnDimension('AI')->setWidth(18.57);
        $objPHPExcel->getActiveSheet()->getColumnDimension('AJ')->setWidth(30.57);

        $pertama=2;

        if(Auth::user()->departement_id!='1'){
        $data=PkpProject::join('ms_tarkons','ms_tarkons.id_tarkon','tr_project_pkp.akg')
            ->join('tr_users','tr_users.id','tr_project_pkp.perevisi')
            ->join('tr_kemas','tr_kemas.id_kemas','tr_project_pkp.kemas_eksis')
            ->where('tujuankirim',Auth::user()->departement_id)
            ->where('status_freeze','inactive')->where('status_pkp','!=','revisi')
            ->where('status_project','=','active')
            ->where('status_pkp','!=','draf')->orderBy('pkp_number','asc')->get();
        $no=1;
        }elseif(Auth::user()->departement_id=='1'){
            $data=PkpProject::join('ms_tarkons','ms_tarkons.id_tarkon','tr_project_pkp.akg')
            ->join('tr_users','tr_users.id','tr_project_pkp.perevisi')
            ->join('tr_kemas','tr_kemas.id_kemas','tr_project_pkp.kemas_eksis')
            ->where('tujuankirim2',Auth::user()->departement_id)
            ->where('status_freeze','inactive')->where('status_pkp','!=','revisi')
            ->where('status_project','=','active')
            ->where('status_pkp','!=','draf')->orderBy('pkp_number','asc')->get();
        $no=1;   
        }

        $objPHPExcel->setActiveSheetIndex(0)
                    ->setCellValue('A1', 'PKP Number')
                    ->setCellValue('C1', 'Project Name')
                    ->setCellValue('D1', 'Created Date')
                    ->setCellValue('E1', 'Sent To RND')
                    ->setCellValue('F1', 'PV')
                    ->setCellValue('G1', 'Type')
                    ->setCellValue('H1', 'Brand')
                    ->setCellValue('I1', 'Priority')
                    ->setCellValue('J1', 'Jenis')
                    ->setCellValue('K1', 'Idea')
                    ->setCellValue('L1', 'Target Launch')
                    ->setCellValue('M1', 'Gender')
                    ->setCellValue('N1', 'Uniqueness')
                    ->setCellValue('O1', 'Reason')
                    ->setCellValue('P1', 'Estimated')
                    ->setCellValue('Q1', 'Competitive')
                    ->setCellValue('R1', 'Selling Price')
                    ->setCellValue('S1', 'Price')
                    ->setCellValue('T1', 'Competitor')
                    ->setCellValue('U1', 'Aisle')
                    ->setCellValue('V1', 'Product Form')
                    ->setCellValue('W1', 'AKG')
                    ->setCellValue('X1', 'Kemas')
                    ->setCellValue('AF1', 'Prefered Flavour')
                    ->setCellValue('AG1', 'Product Benefits')
                    ->setCellValue('AH1', 'Mandatory Ingredient')
                    ->setCellValue('AI1', 'UOM')
                    ->setCellValue('AJ1', 'Serving Suggestion');
                            
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
                $type= 'internal';
            }else{
                $type='Maklon & Internal';
            }

            $launch = $_data['tgl_launch'];
            if($launch==NULL){
                $ld=' '.$_data->launch.' '.$_data->launch_years;
            }
            
            $line=$pertama;
            $objPHPExcel->setActiveSheetIndex(0)
                    ->setCellValue('A'.$pertama, $_data['pkp_number'])
                    ->setCellValue('B'.$pertama, $_data['ket_no'])
                    ->setCellValue('C'.$pertama, $_data['project_name'])
                    ->setCellValue('D'.$pertama, $_data['created_date'])
                    ->setCellValue('E'.$pertama, $_data['tgl_kirim'])
                    ->setCellValue('F'.$pertama, $_data['name'])
                    ->setCellValue('G'.$pertama, $type)
                    ->setCellValue('H'.$pertama, $_data['id_brand'])
                    ->setCellValue('I'.$pertama, $_data['prioritas'])
                    ->setCellValue('J'.$pertama, $_data['jenis'])
                    ->setCellValue('K'.$pertama, $_data['idea'])
                    ->setCellValue('L'.$pertama, $ld)
                    ->setCellValue('M'.$pertama, $_data['gender'])
                    ->setCellValue('N'.$pertama, $_data['Uniqueness'])
                    ->setCellValue('O'.$pertama, $_data['reason'])
                    ->setCellValue('P'.$pertama, $_data['Estimated'])
                    ->setCellValue('Q'.$pertama, $_data['competitive'])
                    ->setCellValue('R'.$pertama, $_data['selling_price'])
                    ->setCellValue('S'.$pertama, $_data['price'])
                    ->setCellValue('T'.$pertama, $_data['competitor'])
                    ->setCellValue('U'.$pertama, $_data['aisle'])
                    ->setCellValue('V'.$pertama, $_data['product_form'])
                    ->setCellValue('W'.$pertama, $_data['tarkon'])
                    ->setCellValue('X'.$pertama, $_data['tersier'])
                    ->setCellValue('Y'.$pertama, $_data['s_tersier'])
                    ->setCellValue('Z'.$pertama, $_data['sekunder1'])
                    ->setCellValue('AA'.$pertama, $_data['s_sekunder1'])
                    ->setCellValue('AB'.$pertama, $_data['sekunder2'])
                    ->setCellValue('AC'.$pertama, $_data['s_sekunder2'])
                    ->setCellValue('AD'.$pertama, $_data['primer'])
                    ->setCellValue('AE'.$pertama, $_data['s_primer'])
                    ->setCellValue('AF'.$pertama, $_data['prefered_flavour'])
                    ->setCellValue('AG'.$pertama, $_data['product_benefits'])
                    ->setCellValue('AH'.$pertama, $_data['mandatory_ingredient'])
                    ->setCellValue('AI'.$pertama, $_data['UOM'])
                    ->setCellValue('AJ'.$pertama, $_data['serving_suggestion']);
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

    public function download_project_pdf(){
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

        $data=SubPDF::join('tr_pdf_project','tr_pdf_project.id_project_pdf','tr_sub_pdf.pdf_id')
            ->join('tr_users','tr_users.id','tr_sub_pdf.perevisi')
            ->join('tr_kemas','tr_kemas.id_kemas','tr_sub_pdf.kemas_eksis')
            ->join('ms_type','ms_type.id','tr_pdf_project.id_type')->where('status_pdf','=','active')
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

        $objPHPExcel->getActiveSheet()->mergeCells('M1:T');
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

    public function download_my_project_pdf(){
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
            $no=1;  
        }
        
        $baris=$awal;
        $objPHPExcel->setActiveSheetIndex(0)
                    ->setCellValue('A'.$baris, 'PDF Number')
                    ->setCellValue('C'.$baris, 'Project Name')
                    ->setCellValue('D'.$baris, 'Created Date')
                    ->setCellValue('E'.$baris, 'Sent To RND')
                    ->setCellValue('F'.$baris, 'PV')
                    ->setCellValue('G'.$baris, 'Type')
                    ->setCellValue('H'.$baris, 'Brand')
                    ->setCellValue('I'.$baris, 'Priority')
                    ->setCellValue('J'.$baris, 'Jenis')
                    ->setCellValue('K'.$baris, 'Reference')
                    ->setCellValue('L'.$baris, 'Country')
                    ->setCellValue('M'.$baris, 'Kemas')
                    ->setCellValue('U'.$baris, 'Gender')
                    ->setCellValue('V'.$baris, 'Other')
                    ->setCellValue('W'.$baris, 'Background')
                    ->setCellValue('X'.$baris, 'Attractiveness')
                    ->setCellValue('Y'.$baris, 'Weight')
                    ->setCellValue('Z'.$baris, 'Satuan')
                    ->setCellValue('AA'.$baris, 'Target Price')
                    ->setCellValue('AB'.$baris, 'Claim')
                    ->setCellValue('AC'.$baris, 'Inggredient')
                    ->setCellValue('AD'.$baris, 'RTO')
                    ->setCellValue('AE'.$baris, 'Retailer Price ')
                    ->setCellValue('AF'.$baris, 'Whats Special');
                            
        $objPHPExcel->getActiveSheet()->mergeCells('A'.$baris.':B'.$baris);
        $objPHPExcel->setActiveSheetIndex(0)
                    ->setCellValue('A'.$baris, 'PKP Number');

        $objPHPExcel->getActiveSheet()->getStyle('A'.$baris.':AJ'.$baris)->getFill()
                    ->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)
                    ->getStartColor()->setARGB('13DFE4');
        $objPHPExcel->getActiveSheet()->getStyle('A'.$baris.':AJ'.$baris)->getAlignment()->setHorizontal('center');

        $objPHPExcel->getActiveSheet()->mergeCells('M'.$baris.':T'.$baris);
        $objPHPExcel->setActiveSheetIndex(0)
                    ->setCellValue('T'.$baris, 'Kemas');

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
    
    public function notulenpkp(Request $Request){
        $objPHPExcel = new Spreadsheet();
        $objPHPExcel->setActiveSheetIndex(0); 
        $objPHPExcel->getActiveSheet()->getColumnDimension('A')->setWidth(5.00);
        $objPHPExcel->getActiveSheet()->getColumnDimension('B')->setWidth(50.00);
        $objPHPExcel->getActiveSheet()->getColumnDimension('C')->setWidth(30.00);
        $objPHPExcel->getActiveSheet()->getColumnDimension('D')->setWidth(8.00);
        $objPHPExcel->getActiveSheet()->getColumnDimension('E')->setWidth(18.00);

        $objPHPExcel->getActiveSheet()->getColumnDimension('F')->setWidth(20.00);
        $objPHPExcel->getActiveSheet()->getColumnDimension('G')->setWidth(30.00);
        $objPHPExcel->getActiveSheet()->getColumnDimension('H')->setWidth(8.00);
        $objPHPExcel->getActiveSheet()->getColumnDimension('I')->setWidth(18.00);
        $objPHPExcel->getActiveSheet()->getColumnDimension('J')->setWidth(20.00);

        $objPHPExcel->getActiveSheet()->getColumnDimension('K')->setWidth(30.00);
        $objPHPExcel->getActiveSheet()->getColumnDimension('L')->setWidth(8.00);
        $objPHPExcel->getActiveSheet()->getColumnDimension('M')->setWidth(18.00);
        $objPHPExcel->getActiveSheet()->getColumnDimension('N')->setWidth(20.00);
        $objPHPExcel->getActiveSheet()->getColumnDimension('O')->setWidth(30.00);

        $objPHPExcel->getActiveSheet()->getColumnDimension('P')->setWidth(8.00);
        $objPHPExcel->getActiveSheet()->getColumnDimension('Q')->setWidth(18.00);
        $objPHPExcel->getActiveSheet()->getColumnDimension('R')->setWidth(20.00);
        $objPHPExcel->getActiveSheet()->getColumnDimension('S')->setWidth(30.00);
        $objPHPExcel->getActiveSheet()->getColumnDimension('T')->setWidth(8.00);

        $objPHPExcel->getActiveSheet()->getColumnDimension('U')->setWidth(18.00);
        $objPHPExcel->getActiveSheet()->getColumnDimension('V')->setWidth(20.00);
        $objPHPExcel->getActiveSheet()->getColumnDimension('W')->setWidth(30.00);
        $objPHPExcel->getActiveSheet()->getColumnDimension('X')->setWidth(8.00);
        $objPHPExcel->getActiveSheet()->getColumnDimension('Y')->setWidth(18.00);

        $objPHPExcel->getActiveSheet()->getColumnDimension('Z')->setWidth(20.00);
        $objPHPExcel->getActiveSheet()->getColumnDimension('AA')->setWidth(30.00);
        $objPHPExcel->getActiveSheet()->getColumnDimension('AB')->setWidth(8.00);
        $objPHPExcel->getActiveSheet()->getColumnDimension('AC')->setWidth(18.00);
        $objPHPExcel->getActiveSheet()->getColumnDimension('AD')->setWidth(20.00);
        $objPHPExcel->getActiveSheet()->getColumnDimension('AE')->setWidth(30.00);

        $objPHPExcel->getActiveSheet()->getColumnDimension('AF')->setWidth(8.00);
        $objPHPExcel->getActiveSheet()->getColumnDimension('AG')->setWidth(18.00);
        $objPHPExcel->getActiveSheet()->getColumnDimension('AH')->setWidth(20.00);
        $objPHPExcel->getActiveSheet()->getColumnDimension('AI')->setWidth(30.00);
        $objPHPExcel->getActiveSheet()->getColumnDimension('AJ')->setWidth(8.00);

        $objPHPExcel->getActiveSheet()->getColumnDimension('AK')->setWidth(18.00);
        $objPHPExcel->getActiveSheet()->getColumnDimension('AL')->setWidth(20.00);
        $objPHPExcel->getActiveSheet()->getColumnDimension('AM')->setWidth(30.00);
        $objPHPExcel->getActiveSheet()->getColumnDimension('AN')->setWidth(8.00);
        $objPHPExcel->getActiveSheet()->getColumnDimension('AO')->setWidth(18.00);

        $objPHPExcel->getActiveSheet()->getColumnDimension('AP')->setWidth(20.00);
        $objPHPExcel->getActiveSheet()->getColumnDimension('AQ')->setWidth(30.00);
        $objPHPExcel->getActiveSheet()->getColumnDimension('AR')->setWidth(8.00);
        $objPHPExcel->getActiveSheet()->getColumnDimension('AS')->setWidth(18.00);
        $objPHPExcel->getActiveSheet()->getColumnDimension('AT')->setWidth(20.00);

        $objPHPExcel->getActiveSheet()->getColumnDimension('AU')->setWidth(30.00);
        $objPHPExcel->getActiveSheet()->getColumnDimension('AV')->setWidth(8.00);
        $objPHPExcel->getActiveSheet()->getColumnDimension('AW')->setWidth(18.00);
        $objPHPExcel->getActiveSheet()->getColumnDimension('AX')->setWidth(20.00);
        
        $objPHPExcel->getActiveSheet()->getColumnDimension('AY')->setWidth(30.00);
        $objPHPExcel->getActiveSheet()->getColumnDimension('AZ')->setWidth(8.00);
        $objPHPExcel->getActiveSheet()->getColumnDimension('BA')->setWidth(18.00);
        $objPHPExcel->getActiveSheet()->getColumnDimension('BB')->setWidth(20.00);
        $objPHPExcel->getActiveSheet()->getColumnDimension('BC')->setWidth(30.00);

        $objPHPExcel->getActiveSheet()->getColumnDimension('BD')->setWidth(8.00);
        $objPHPExcel->getActiveSheet()->getColumnDimension('BE')->setWidth(18.00);
        $objPHPExcel->getActiveSheet()->getColumnDimension('BF')->setWidth(20.00);
        $objPHPExcel->getActiveSheet()->getColumnDimension('BG')->setWidth(30.00);
        $objPHPExcel->getActiveSheet()->getColumnDimension('BH')->setWidth(8.00);

        $objPHPExcel->getActiveSheet()->getColumnDimension('BI')->setWidth(18.00);
        $objPHPExcel->getActiveSheet()->getColumnDimension('BJ')->setWidth(20.00);
        $objPHPExcel->getActiveSheet()->getColumnDimension('BK')->setWidth(30.00);
        $objPHPExcel->getActiveSheet()->getColumnDimension('BL')->setWidth(8.00);
        $objPHPExcel->getActiveSheet()->getColumnDimension('BM')->setWidth(18.00);

        $objPHPExcel->getActiveSheet()->getColumnDimension('BN')->setWidth(20.00);
        $objPHPExcel->getActiveSheet()->getColumnDimension('BO')->setWidth(30.00);
        $objPHPExcel->getActiveSheet()->getColumnDimension('BP')->setWidth(8.00);
        $objPHPExcel->getActiveSheet()->getColumnDimension('BQ')->setWidth(18.00);
        $objPHPExcel->getActiveSheet()->getColumnDimension('BR')->setWidth(20.00);

        $objPHPExcel->getActiveSheet()->getColumnDimension('BS')->setWidth(30.00);
        $objPHPExcel->getActiveSheet()->getColumnDimension('BT')->setWidth(8.00);
        $objPHPExcel->getActiveSheet()->getColumnDimension('BU')->setWidth(18.00);
        $objPHPExcel->getActiveSheet()->getColumnDimension('BV')->setWidth(20.00);
        $objPHPExcel->getActiveSheet()->getColumnDimension('BW')->setWidth(30.00);

        $objPHPExcel->getActiveSheet()->getColumnDimension('BX')->setWidth(8.00);
        $objPHPExcel->getActiveSheet()->getColumnDimension('BY')->setWidth(18.00);
        $objPHPExcel->getActiveSheet()->getColumnDimension('BZ')->setWidth(25.71);
        $objPHPExcel->getActiveSheet()->getColumnDimension('CA')->setWidth(30.00);
        $objPHPExcel->getActiveSheet()->getColumnDimension('CB')->setWidth(8.00);
        $objPHPExcel->getActiveSheet()->getColumnDimension('CC')->setWidth(18.00);

        $objPHPExcel->getActiveSheet()->getColumnDimension('CD')->setWidth(20.00);
        $objPHPExcel->getActiveSheet()->getColumnDimension('CE')->setWidth(30.00);
        $objPHPExcel->getActiveSheet()->getColumnDimension('CF')->setWidth(8.00);
        $objPHPExcel->getActiveSheet()->getColumnDimension('CG')->setWidth(18.00);
        $objPHPExcel->getActiveSheet()->getColumnDimension('CH')->setWidth(20.00);

        $objPHPExcel->getActiveSheet()->getColumnDimension('CI')->setWidth(30.00);
        $objPHPExcel->getActiveSheet()->getColumnDimension('CJ')->setWidth(8.00);
        $objPHPExcel->getActiveSheet()->getColumnDimension('CK')->setWidth(18.00);
        $objPHPExcel->getActiveSheet()->getColumnDimension('CL')->setWidth(20.00);
        $objPHPExcel->getActiveSheet()->getColumnDimension('CM')->setWidth(30.00);

        $objPHPExcel->getActiveSheet()->getColumnDimension('CN')->setWidth(8.00);
        $objPHPExcel->getActiveSheet()->getColumnDimension('CO')->setWidth(18.00);
        $objPHPExcel->getActiveSheet()->getColumnDimension('CP')->setWidth(20.00);
        $objPHPExcel->getActiveSheet()->getColumnDimension('CQ')->setWidth(30.00);
        $objPHPExcel->getActiveSheet()->getColumnDimension('CR')->setWidth(8.00);
        $objPHPExcel->getActiveSheet()->getColumnDimension('CS')->setWidth(18.00);
        $objPHPExcel->getActiveSheet()->getColumnDimension('CT')->setWidth(20.00);

        $pertama = 4;
        $DNpkp   = PkpProject::where('status_pkp','sent')->orwhere('status_pkp','proses')->orwhere('status_pkp','revisi')->where('status_project','=','active')->orderBy('pkp_number','asc')->get();
        $no      = 1; 
        $objPHPExcel->setActiveSheetIndex(0)
                    ->setCellValue('C1', 'January')
                    ->setCellValue('E1', 'February')
                    ->setCellValue('G1', 'March')
                    ->setCellValue('I1', 'April')
                    ->setCellValue('K1', 'May')
                    ->setCellValue('M1', 'June')
                    ->setCellValue('O1', 'July')
                    ->setCellValue('Q1', 'August')
                    ->setCellValue('S1', 'September')
                    ->setCellValue('U1', 'October')
                    ->setCellValue('W1', 'November')
                    ->setCellValue('Y1', 'December')
                    // Judul
                    ->setCellValue('C2', 'Meeting PV & Marketing')
                    ->setCellValue('E2', 'Meeting PV & Marketing')
                    ->setCellValue('C2', 'Meeting PV & Marketing')
                    ->setCellValue('E2', 'Meeting PV & Marketing')
                    ->setCellValue('C2', 'Meeting PV & Marketing')
                    ->setCellValue('E2', 'Meeting PV & Marketing')
                    ->setCellValue('C2', 'Meeting PV & Marketing')
                    ->setCellValue('E2', 'Meeting PV & Marketing')
                    ->setCellValue('C2', 'Meeting PV & Marketing')
                    ->setCellValue('E2', 'Meeting PV & Marketing')
                    ->setCellValue('C2', 'Meeting PV & Marketing')
                    ->setCellValue('E2', 'Meeting PV & Marketing')
                    ->setCellValue('C2', 'Meeting PV & Marketing')
                    ->setCellValue('E2', 'Meeting PV & Marketing')
                    ->setCellValue('C2', 'Meeting PV & Marketing')
                    ->setCellValue('E2', 'Meeting PV & Marketing')
                    ->setCellValue('C2', 'Meeting PV & Marketing')
                    ->setCellValue('E2', 'Meeting PV & Marketing')
                    ->setCellValue('C2', 'Meeting PV & Marketing')
                    ->setCellValue('E2', 'Meeting PV & Marketing')
                    ->setCellValue('C2', 'Meeting PV & Marketing')
                    ->setCellValue('E2', 'Meeting PV & Marketing')
                    ->setCellValue('C2', 'Meeting PV & Marketing')
                    ->setCellValue('E2', 'Meeting PV & Marketing')

                    ->setCellValue('C3', 'Notulen')
                    ->setCellValue('D3', 'Priority')
                    ->setCellValue('E3', 'Launch Deadline')
                    ->setCellValue('F3', 'Forecast')
                    ->setCellValue('G3', 'Notulen')
                    ->setCellValue('H3', 'Priority')
                    ->setCellValue('I3', 'Launch Deadline')
                    ->setCellValue('J3', 'Forecast')
                    
                    ->setCellValue('K3', 'Notulen')
                    ->setCellValue('L3', 'Priority')
                    ->setCellValue('M3', 'Launch Deadline')
                    ->setCellValue('N3', 'Forecast')
                    ->setCellValue('O3', 'Notulen')
                    ->setCellValue('P3', 'Priority')
                    ->setCellValue('Q3', 'Launch Deadline')
                    ->setCellValue('R3', 'Forecast')

                    ->setCellValue('S3', 'Notulen')
                    ->setCellValue('T3', 'Priority')
                    ->setCellValue('U3', 'Launch Deadline')
                    ->setCellValue('V3', 'Forecast')
                    ->setCellValue('W3', 'Notulen')
                    ->setCellValue('X3', 'Priority')
                    ->setCellValue('Y3', 'Launch Deadline')
                    ->setCellValue('Z3', 'Forecast')

                    ->setCellValue('AA3', 'Notulen')
                    ->setCellValue('AB3', 'Priority')
                    ->setCellValue('AC3', 'Launch Deadline')
                    ->setCellValue('AD3', 'Forecast')
                    ->setCellValue('AE3', 'Notulen')
                    ->setCellValue('AF3', 'Priority')
                    ->setCellValue('AG3', 'Launch Deadline')
                    ->setCellValue('AH3', 'Forecast')

                    ->setCellValue('AI3', 'Notulen')
                    ->setCellValue('AJ3', 'Priority')
                    ->setCellValue('AK3', 'Launch Deadline')
                    ->setCellValue('AL3', 'Forecast')
                    ->setCellValue('AM3', 'Notulen')
                    ->setCellValue('AN3', 'Priority')
                    ->setCellValue('AO3', 'Launch Deadline')
                    ->setCellValue('AP3', 'Forecast')

                    ->setCellValue('AQ3', 'Notulen')
                    ->setCellValue('AR3', 'Priority')
                    ->setCellValue('AS3', 'Launch Deadline')
                    ->setCellValue('AT3', 'Forecast')
                    ->setCellValue('AU3', 'Notulen')
                    ->setCellValue('AV3', 'Priority')
                    ->setCellValue('AW3', 'Launch Deadline')
                    ->setCellValue('AX3', 'Forecast')

                    ->setCellValue('AY3', 'Notulen')
                    ->setCellValue('AZ3', 'Priority')
                    ->setCellValue('BA3', 'Launch Deadline')
                    ->setCellValue('BB3', 'Forecast')
                    ->setCellValue('BC3', 'Notulen')
                    ->setCellValue('BD3', 'Priority')
                    ->setCellValue('BE3', 'Launch Deadline')
                    ->setCellValue('BF3', 'Forecast')

                    ->setCellValue('BG3', 'Notulen')
                    ->setCellValue('BH3', 'Priority')
                    ->setCellValue('BI3', 'Launch Deadline')
                    ->setCellValue('BJ3', 'Forecast')
                    ->setCellValue('BK3', 'Notulen')
                    ->setCellValue('BL3', 'Priority')
                    ->setCellValue('BM3', 'Launch Deadline')
                    ->setCellValue('BN3', 'Forecast')

                    ->setCellValue('BO3', 'Notulen')
                    ->setCellValue('BP3', 'Priority')
                    ->setCellValue('BQ3', 'Launch Deadline')
                    ->setCellValue('BR3', 'Forecast')
                    ->setCellValue('BS3', 'Notulen')
                    ->setCellValue('BT3', 'Priority')
                    ->setCellValue('BU3', 'Launch Deadline')
                    ->setCellValue('BV3', 'Forecast')

                    ->setCellValue('BW3', 'Notulen')
                    ->setCellValue('BX3', 'Priority')
                    ->setCellValue('BY3', 'Launch Deadline')
                    ->setCellValue('BZ3', 'Forecast')
                    ->setCellValue('CA3', 'Notulen')
                    ->setCellValue('CB3', 'Priority')
                    ->setCellValue('CC3', 'Launch Deadline')
                    ->setCellValue('CD3', 'Forecast')

                    ->setCellValue('CE3', 'Notulen')
                    ->setCellValue('CF3', 'Priority')
                    ->setCellValue('CG3', 'Launch Deadline')
                    ->setCellValue('CH3', 'Forecast')
                    ->setCellValue('CI3', 'Notulen')
                    ->setCellValue('CJ3', 'Priority')
                    ->setCellValue('CK3', 'Launch Deadline')
                    ->setCellValue('CL3', 'Forecast')

                    ->setCellValue('CM3', 'Notulen')
                    ->setCellValue('CN3', 'Priority')
                    ->setCellValue('CO3', 'Launch Deadline')
                    ->setCellValue('CP3', 'Forecast')
                    ->setCellValue('CQ3', 'Notulen')
                    ->setCellValue('CR3', 'Priority')
                    ->setCellValue('CS3', 'Launch Deadline')
                    ->setCellValue('CT3', 'Forecast');
                    
        $objPHPExcel->getActiveSheet()->getStyle('A1:CT1')->getFill()
                    ->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)
                    ->getStartColor()->setARGB('13DFE4');
        $objPHPExcel->getActiveSheet()->getStyle('A2:B2')->getFill()
                    ->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)
                    ->getStartColor()->setARGB('13DFE4');
        $objPHPExcel->getActiveSheet()->getStyle('A3:B3')->getFill()
                    ->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)
                    ->getStartColor()->setARGB('13DFE4');
        $objPHPExcel->getActiveSheet()->getStyle('A1:CT1')->getAlignment()->setHorizontal('center');
        $objPHPExcel->getActiveSheet()->getStyle('C2:CT2')->getFill()
                    ->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)
                    ->getStartColor()->setARGB('838383');
        $objPHPExcel->getActiveSheet()->getStyle('C2:CT2')->getAlignment()->setHorizontal('center');
        $objPHPExcel->getActiveSheet()->getStyle('C3:CT3')->getFill()
                    ->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)
                    ->getStartColor()->setARGB('838383');
        $objPHPExcel->getActiveSheet()->getStyle('C3:CT3')->getAlignment()->setHorizontal('center');
        // BARIS 2
        $objPHPExcel->getActiveSheet()->mergeCells('C2:F2');
        $objPHPExcel->setActiveSheetIndex(0)
                    ->setCellValue('C2', 'Meeting PV & Marketing');

        $objPHPExcel->getActiveSheet()->mergeCells('G2:J2');
        $objPHPExcel->setActiveSheetIndex(0)
                    ->setCellValue('G2', 'Meeting PV & RD');

        $objPHPExcel->getActiveSheet()->mergeCells('K2:N2');
        $objPHPExcel->setActiveSheetIndex(0)
                    ->setCellValue('K2', 'Meeting PV & Marketing');
                    
        $objPHPExcel->getActiveSheet()->mergeCells('O2:R2');
        $objPHPExcel->setActiveSheetIndex(0)
                    ->setCellValue('O2', 'Meeting PV & RD');
                    
        $objPHPExcel->getActiveSheet()->mergeCells('S2:V2');
        $objPHPExcel->setActiveSheetIndex(0)
                    ->setCellValue('S2', 'Meeting PV & Marketing');

        $objPHPExcel->getActiveSheet()->mergeCells('W2:Z2');
        $objPHPExcel->setActiveSheetIndex(0)
                    ->setCellValue('W2', 'Meeting PV & RD');

        $objPHPExcel->getActiveSheet()->mergeCells('AA2:AD2');
        $objPHPExcel->setActiveSheetIndex(0)
                    ->setCellValue('AA2', 'Meeting PV & Marketing');
                    
        $objPHPExcel->getActiveSheet()->mergeCells('AE2:AH2');
        $objPHPExcel->setActiveSheetIndex(0)
                    ->setCellValue('AE2', 'Meeting PV & RD');
                    
        $objPHPExcel->getActiveSheet()->mergeCells('AI2:AL2');
        $objPHPExcel->setActiveSheetIndex(0)
                    ->setCellValue('AI2', 'Meeting PV & Marketing');

        $objPHPExcel->getActiveSheet()->mergeCells('AM2:AP2');
        $objPHPExcel->setActiveSheetIndex(0)
                    ->setCellValue('AM2', 'Meeting PV & RD');

        $objPHPExcel->getActiveSheet()->mergeCells('AQ2:AT2');
        $objPHPExcel->setActiveSheetIndex(0)
                    ->setCellValue('AQ2', 'Meeting PV & Marketing');
                    
        $objPHPExcel->getActiveSheet()->mergeCells('AU2:AX2');
        $objPHPExcel->setActiveSheetIndex(0)
                    ->setCellValue('AU2', 'Meeting PV & RD');
                    
        $objPHPExcel->getActiveSheet()->mergeCells('AY2:BB2');
        $objPHPExcel->setActiveSheetIndex(0)
                    ->setCellValue('AY2', 'Meeting PV & Marketing');

        $objPHPExcel->getActiveSheet()->mergeCells('BC2:BF2');
        $objPHPExcel->setActiveSheetIndex(0)
                    ->setCellValue('BC2', 'Meeting PV & RD');

        $objPHPExcel->getActiveSheet()->mergeCells('BG2:BJ2');
        $objPHPExcel->setActiveSheetIndex(0)
                    ->setCellValue('BG2', 'Meeting PV & Marketing');
                    
        $objPHPExcel->getActiveSheet()->mergeCells('BK2:BN2');
        $objPHPExcel->setActiveSheetIndex(0)
                    ->setCellValue('BK2', 'Meeting PV & RD');
                    
        $objPHPExcel->getActiveSheet()->mergeCells('BO2:BR2');
        $objPHPExcel->setActiveSheetIndex(0)
                    ->setCellValue('BO2', 'Meeting PV & Marketing');

        $objPHPExcel->getActiveSheet()->mergeCells('BS2:BV2');
        $objPHPExcel->setActiveSheetIndex(0)
                    ->setCellValue('BS2', 'Meeting PV & RD');

        $objPHPExcel->getActiveSheet()->mergeCells('BW2:BZ2');
        $objPHPExcel->setActiveSheetIndex(0)
                    ->setCellValue('BW2', 'Meeting PV & Marketing');
                    
        $objPHPExcel->getActiveSheet()->mergeCells('CA2:CD2');
        $objPHPExcel->setActiveSheetIndex(0)
                    ->setCellValue('CA2', 'Meeting PV & RD');
                    
        $objPHPExcel->getActiveSheet()->mergeCells('CE2:CH2');
        $objPHPExcel->setActiveSheetIndex(0)
                    ->setCellValue('CE2', 'Meeting PV & Marketing');

        $objPHPExcel->getActiveSheet()->mergeCells('CI2:CL2');
        $objPHPExcel->setActiveSheetIndex(0)
                    ->setCellValue('CI2', 'Meeting PV & RD');

        $objPHPExcel->getActiveSheet()->mergeCells('CM2:CP2');
        $objPHPExcel->setActiveSheetIndex(0)
                    ->setCellValue('CM2', 'Meeting PV & Marketing');
                    
        $objPHPExcel->getActiveSheet()->mergeCells('CQ2:CT2');
        $objPHPExcel->setActiveSheetIndex(0)
                    ->setCellValue('CQ2', 'Meeting PV & RD');
        //BARIS3
        $objPHPExcel->getActiveSheet()->mergeCells('A2:B2');
        $objPHPExcel->setActiveSheetIndex(0)
                    ->setCellValue('A2', 'PKP Number');

        $objPHPExcel->getActiveSheet()->mergeCells('C1:J1');
        $objPHPExcel->setActiveSheetIndex(0)
                    ->setCellValue('C1', 'December');

        $objPHPExcel->getActiveSheet()->mergeCells('K1:R1');
        $objPHPExcel->setActiveSheetIndex(0)
                    ->setCellValue('K1', 'November');

        $objPHPExcel->getActiveSheet()->mergeCells('S1:Z1');
        $objPHPExcel->setActiveSheetIndex(0)
                    ->setCellValue('S1', 'October');
            
        $objPHPExcel->getActiveSheet()->mergeCells('AA1:AH1');
        $objPHPExcel->setActiveSheetIndex(0)
                    ->setCellValue('AA1', 'September');
            
        $objPHPExcel->getActiveSheet()->mergeCells('AI1:AP1');
        $objPHPExcel->setActiveSheetIndex(0)
                    ->setCellValue('AI1', 'August');
                    
        $objPHPExcel->getActiveSheet()->mergeCells('AQ1:AX1');
        $objPHPExcel->setActiveSheetIndex(0)
                    ->setCellValue('AQ1', 'July');

        $objPHPExcel->getActiveSheet()->mergeCells('AY1:BF1');
        $objPHPExcel->setActiveSheetIndex(0)
                    ->setCellValue('AY1', 'June');

        $objPHPExcel->getActiveSheet()->mergeCells('BG1:BN1');
        $objPHPExcel->setActiveSheetIndex(0)
                    ->setCellValue('BG1', 'May');

        $objPHPExcel->getActiveSheet()->mergeCells('BO1:BV1');
        $objPHPExcel->setActiveSheetIndex(0)
                    ->setCellValue('BO1', 'April');
            
        $objPHPExcel->getActiveSheet()->mergeCells('BW1:CD1');
        $objPHPExcel->setActiveSheetIndex(0)
                    ->setCellValue('BW1', 'March');
            
        $objPHPExcel->getActiveSheet()->mergeCells('CE1:CL1');
        $objPHPExcel->setActiveSheetIndex(0)
                    ->setCellValue('CE1', 'February');
            
        $objPHPExcel->getActiveSheet()->mergeCells('CM1:CT1');
        $objPHPExcel->setActiveSheetIndex(0)
                    ->setCellValue('CM1', 'January');
        
        foreach($DNpkp as $_data){
            $jan_pr = notulen::where('id_pkp',$_data->id_project)->where('Bulan','January')->where('note_rd_pv','!=','NULL')->first();
            if($jan_pr!=NULL){$jan_pr_hasil = $jan_pr->note_rd_pv;}else{$jan_pr_hasil="-";}
            $jan_pm = notulen::where('id_pkp',$_data->id_project)->where('Bulan','January')->where('note_pv_marketing','!=','NULL')->first();
            if($jan_pm!=NULL){$jan_pm_hasil = $jan_pm->note_pv_marketing;}else{$jan_pm_hasil="-";}
            $feb_pr = notulen::where('id_pkp',$_data->id_project)->where('Bulan','February')->where('note_rd_pv','!=','NULL')->first();
            if($feb_pr!=NULL){$feb_pr_hasil = $feb_pr->note_rd_pv;}else{$feb_pr_hasil="-";}
            $feb_pm = notulen::where('id_pkp',$_data->id_project)->where('Bulan','February')->where('note_pv_marketing','!=','NULL')->first();
            if($feb_pm!=NULL){$feb_pm_hasil = $feb_pm->note_pv_marketing;}else{$feb_pm_hasil="-";}
            $mar_pr = notulen::where('id_pkp',$_data->id_project)->where('Bulan','March')->where('note_rd_pv','!=','NULL')->first();
            if($mar_pr!=NULL){$mar_pr_hasil = $mar_pr->note_rd_pv;}else{$mar_pr_hasil="-";}
            $mar_pm = notulen::where('id_pkp',$_data->id_project)->where('Bulan','March')->where('note_pv_marketing','!=','NULL')->first();
            if($mar_pm!=NULL){$mar_pm_hasil = $mar_pm->note_pv_marketing;}else{$mar_pm_hasil="-";}
            $apr_pr = notulen::where('id_pkp',$_data->id_project)->where('Bulan','April')->where('note_rd_pv','!=','NULL')->first();
            if($apr_pr!=NULL){$apr_pr_hasil = $apr_pr->note_rd_pv;}else{$apr_pr_hasil="-";}
            $apr_pm = notulen::where('id_pkp',$_data->id_project)->where('Bulan','April')->where('note_pv_marketing','!=','NULL')->first();
            if($apr_pm!=NULL){$apr_pm_hasil = $apr_pm->note_pv_marketing;}else{$apr_pm_hasil="-";}
            $may_pr = notulen::where('id_pkp',$_data->id_project)->where('Bulan','May')->where('note_rd_pv','!=','NULL')->first();
            if($may_pr!=NULL){$may_pr_hasil = $may_pr->note_rd_pv;}else{$may_pr_hasil="-";}
            $may_pm = notulen::where('id_pkp',$_data->id_project)->where('Bulan','May')->where('note_pv_marketing','!=','NULL')->first();
            if($may_pm!=NULL){$may_pm_hasil = $may_pm->note_pv_marketing;}else{$may_pm_hasil="-";}
            $jun_pr = notulen::where('id_pkp',$_data->id_project)->where('Bulan','June')->where('note_rd_pv','!=','NULL')->first();
            if($jun_pr!=NULL){$jun_pr_hasil = $jun_pr->note_rd_pv;}else{$jun_pr_hasil="-";}
            $jun_pm = notulen::where('id_pkp',$_data->id_project)->where('Bulan','June')->where('note_pv_marketing','!=','NULL')->first();
            if($jun_pm!=NULL){$jun_pm_hasil = $jun_pm->note_pv_marketing;}else{$jun_pm_hasil="-";}
            $jul_pr = notulen::where('id_pkp',$_data->id_project)->where('Bulan','July')->where('note_rd_pv','!=','NULL')->first();
            if($jul_pr!=NULL){$jul_pr_hasil = $jul_pr->note_rd_pv;}else{$jul_pr_hasil="-";}
            $jul_pm = notulen::where('id_pkp',$_data->id_project)->where('Bulan','July')->where('note_pv_marketing','!=','NULL')->first();
            if($jul_pm!=NULL){$jul_pm_hasil = $jul_pm->note_pv_marketing;}else{$jul_pm_hasil="-";}
            $aug_pr = notulen::where('id_pkp',$_data->id_project)->where('Bulan','August')->where('note_rd_pv','!=','NULL')->first();
            if($aug_pr!=NULL){$aug_pr_hasil = $aug_pr->note_rd_pv;}else{$aug_pr_hasil="-";}
            $aug_pm = notulen::where('id_pkp',$_data->id_project)->where('Bulan','August')->where('note_pv_marketing','!=','NULL')->first();
            if($aug_pm!=NULL){$aug_pm_hasil = $aug_pm->note_pv_marketing;}else{$aug_pm_hasil="-";}
            $sep_pr = notulen::where('id_pkp',$_data->id_project)->where('Bulan','September')->where('note_rd_pv','!=','NULL')->first();
            if($sep_pr!=NULL){$sep_pr_hasil = $sep_pr->note_rd_pv;}else{$sep_pr_hasil="-";}
            $sep_pm = notulen::where('id_pkp',$_data->id_project)->where('Bulan','September')->where('note_pv_marketing','!=','NULL')->first();
            if($sep_pm!=NULL){$sep_pm_hasil = $sep_pm->note_pv_marketing;}else{$sep_pm_hasil="-";}
            $oct_pr = notulen::where('id_pkp',$_data->id_project)->where('Bulan','October')->where('note_rd_pv','!=','NULL')->first();
            if($oct_pr!=NULL){$oct_pr_hasil = $oct_pr->note_rd_pv;}else{$oct_pr_hasil="-";}
            $oct_pm = notulen::where('id_pkp',$_data->id_project)->where('Bulan','October')->where('note_pv_marketing','!=','NULL')->first();
            if($oct_pm!=NULL){$oct_pm_hasil = $oct_pm->note_pv_marketing;}else{$oct_pm_hasil="-";}
            $nov_pr = notulen::where('id_pkp',$_data->id_project)->where('Bulan','November')->where('note_rd_pv','!=','NULL')->first();
            if($nov_pr!=NULL){$nov_pr_hasil = $nov_pr->note_rd_pv;}else{$nov_pr_hasil="-";}
            $nov_pm = notulen::where('id_pkp',$_data->id_project)->where('Bulan','November')->where('note_pv_marketing','!=','NULL')->first();
            if($nov_pm!=NULL){$nov_pm_hasil = $nov_pm->note_pv_marketing;}else{$nov_pm_hasil="-";}
            $dec_pr = notulen::where('id_pkp',$_data->id_project)->where('Bulan','December')->where('note_rd_pv','!=','NULL')->first();
            if($dec_pr!=NULL){$dec_pr_hasil = $dec_pr->note_rd_pv;}else{$dec_pr_hasil="-";}
            $dec_pm = notulen::where('id_pkp',$_data->id_project)->where('Bulan','December')->where('note_pv_marketing','!=','NULL')->first();
            if($dec_pm!=NULL){$dec_pm_hasil = $dec_pm->note_pv_marketing;}else{$dec_pm_hasil="-";}

            // PRIORITAS, Forecast DAN LAUNCH
            // January
            $prioritas_jan_pr = notulen::where('id_pkp',$_data->id_project)->where('Bulan','January')->where('note_rd_pv','!=','NULL')->first();
            if($prioritas_jan_pr!=NULL){$prioritas_jan_pr_hasil = $prioritas_jan_pr->prioritas;}else{$prioritas_jan_pr_hasil="-";}
            $prioritas_jan_pm = notulen::where('id_pkp',$_data->id_project)->where('Bulan','January')->where('note_pv_marketing','!=','NULL')->first();
            if($prioritas_jan_pm!=NULL){$prioritas_jan_pm_hasil = $prioritas_jan_pm->prioritas;}else{$prioritas_jan_pm_hasil="-";}
            
            $pro_jan_pr = NoteForecast::where('id_pkp',$_data->id_project)->where('Bulan','January')->where('info','=','1')->first();
            if($pro_jan_pr!=NULL){$pro_jan_pr_hasil = ' '.$pro_jan_pr->satuan.'='.$pro_jan_pr->forecash;}else{$pro_jan_pr_hasil="-";}
            $pro_jan_pm = NoteForecast::where('id_pkp',$_data->id_project)->where('Bulan','January')->where('info','=','2')->first();
            if($pro_jan_pm!=NULL){$pro_jan_pm_hasil = ' '.$pro_jan_pm->satuan.'='.$pro_jan_pm->forecash;}else{$pro_jan_pm_hasil="-";}
            
            $launch_jan_pr = notulen::where('id_pkp',$_data->id_project)->where('Bulan','January')->where('note_rd_pv','!=','NULL')->first();
            if($launch_jan_pr!=NULL){$launch_jan_pr_hasil=' '.$launch_jan_pr->launch.' '.$launch_jan_pr->launch_years;}else{$launch_jan_pr_hasil="-";}
            $launch_jan_pm = notulen::where('id_pkp',$_data->id_project)->where('Bulan','January')->where('note_pv_marketing','!=','NULL')->first();
            if($launch_jan_pm!=NULL){$launch_jan_pm_hasil=' '.$launch_jan_pm->launch.' '.$launch_jan_pm->launch_years;}else{$launch_jan_pm_hasil="-";}
            // February
            $prioritas_feb_pr= notulen::where('id_pkp',$_data->id_project)->where('Bulan','February')->where('note_rd_pv','!=','NULL')->first();
            if($prioritas_feb_pr!=NULL){$prioritas_feb_pr_hasil = $prioritas_feb_pr->prioritas;}else{$prioritas_feb_pr_hasil="-";}
            $prioritas_feb_pm= notulen::where('id_pkp',$_data->id_project)->where('Bulan','February')->where('note_pv_marketing','!=','NULL')->first();
            if($prioritas_feb_pm!=NULL){$prioritas_feb_pm_hasil = $prioritas_feb_pm->prioritas;}else{$prioritas_feb_pm_hasil="-";}
            
            $pro_feb_pr = NoteForecast::where('id_pkp',$_data->id_project)->where('Bulan','February')->where('info','=','1')->first();
            if($pro_feb_pr!=NULL){$pro_feb_pr_hasil = ' '.$pro_feb_pr->satuan.'='.$pro_feb_pr->forecash;}else{$pro_feb_pr_hasil="-";}
            $pro_feb_pm = NoteForecast::where('id_pkp',$_data->id_project)->where('Bulan','February')->where('info','=','2')->first();
            if($pro_feb_pm!=NULL){$pro_feb_pm_hasil = ' '.$pro_feb_pm->satuan.'='.$pro_feb_pm->forecash;}else{$pro_feb_pm_hasil="-";}

            $launch_feb_pr = notulen::where('id_pkp',$_data->id_project)->where('Bulan','February')->where('note_rd_pv','!=','NULL')->first();
            if($launch_feb_pr!=NULL){$launch_feb_pr_hasil=' '.$launch_feb_pr->launch.' '.$launch_feb_pr->launch_years;}else{$launch_feb_pr_hasil="-";}
            $launch_feb_pm = notulen::where('id_pkp',$_data->id_project)->where('Bulan','February')->where('note_pv_marketing','!=','NULL')->first();
            if($launch_feb_pm!=NULL){$launch_feb_pm_hasil=' '.$launch_feb_pm->launch.' '.$launch_feb_pm->launch_years;}else{$launch_feb_pm_hasil="-";}
            // March
            $prioritas_mar_pr = notulen::where('id_pkp',$_data->id_project)->where('Bulan','March')->where('note_rd_pv','!=','NULL')->first();
            if($prioritas_mar_pr!=NULL){$prioritas_mar_pr_hasil = $prioritas_mar_pr->prioritas;}else{$prioritas_mar_pr_hasil="-";}
            $prioritas_mar_pm = notulen::where('id_pkp',$_data->id_project)->where('Bulan','March')->where('note_pv_marketing','!=','NULL')->first();
            if($prioritas_mar_pm!=NULL){$prioritas_mar_pm_hasil = $prioritas_mar_pm->prioritas;}else{$prioritas_mar_pm_hasil="-";}
            
            $pro_mar_pr = NoteForecast::where('id_pkp',$_data->id_project)->where('Bulan','March')->where('info','=','1')->first();
            if($pro_mar_pr!=NULL){$pro_mar_pr_hasil = ' '.$pro_mar_pr->satuan.'='.$pro_mar_pr->forecash;}else{$pro_mar_pr_hasil="-";}
            $pro_mar_pm = NoteForecast::where('id_pkp',$_data->id_project)->where('Bulan','March')->where('info','=','2')->first();
            if($pro_mar_pm!=NULL){$pro_mar_pm_hasil = ' '.$pro_mar_pm->satuan.'='.$pro_mar_pm->forecash;}else{$pro_mar_pm_hasil="-";}

            $launch_mar_pr = notulen::where('id_pkp',$_data->id_project)->where('Bulan','March')->where('note_rd_pv','!=','NULL')->first();
            if($launch_mar_pr!=NULL){$launch_mar_pr_hasil=' '.$launch_mar_pr->launch.' '.$launch_mar_pr->launch_years;}else{$launch_mar_pr_hasil="-";}
            $launch_mar_pm = notulen::where('id_pkp',$_data->id_project)->where('Bulan','March')->where('note_pv_marketing','!=','NULL')->first();
            if($launch_mar_pm!=NULL){$launch_mar_pm_hasil=' '.$launch_mar_pm->launch.' '.$launch_mar_pm->launch_years;}else{$launch_mar_pm_hasil="-";}
            // April
            $prioritas_apr_pr = notulen::where('id_pkp',$_data->id_project)->where('Bulan','April')->where('note_rd_pv','!=','NULL')->first();
            if($prioritas_apr_pr!=NULL){$prioritas_apr_pr_hasil = $prioritas_apr_pr->prioritas;}else{$prioritas_apr_pr_hasil="-";}
            $prioritas_apr_pm = notulen::where('id_pkp',$_data->id_project)->where('Bulan','April')->where('note_pv_marketing','!=','NULL')->first();
            if($prioritas_apr_pm!=NULL){$prioritas_apr_pm_hasil = $prioritas_apr_pm->prioritas;}else{$prioritas_apr_pm_hasil="-";}

            $pro_apr_pr = NoteForecast::where('id_pkp',$_data->id_project)->where('Bulan','April')->where('info','=','1')->first();
            if($pro_apr_pr!=NULL){$pro_apr_pr_hasil = ' '.$pro_apr_pr->satuan.'='.$pro_apr_pr->forecash;}else{$pro_apr_pr_hasil="-";}
            $pro_apr_pm = NoteForecast::where('id_pkp',$_data->id_project)->where('Bulan','April')->where('info','=','2')->first();
            if($pro_apr_pm!=NULL){$pro_apr_pm_hasil = ' '.$pro_apr_pm->satuan.'='.$pro_apr_pm->forecash;}else{$pro_apr_pm_hasil="-";}

            $launch_apr_pr = notulen::where('id_pkp',$_data->id_project)->where('Bulan','April')->where('note_rd_pv','!=','NULL')->first();
            if($launch_apr_pr!=NULL){$launch_apr_pr_hasil=' '.$launch_apr_pr->launch.' '.$launch_apr_pr->launch_years;}else{$launch_apr_pr_hasil="-";}
            $launch_apr_pm = notulen::where('id_pkp',$_data->id_project)->where('Bulan','April')->where('note_pv_marketing','!=','NULL')->first();
            if($launch_apr_pm!=NULL){$launch_apr_pm_hasil=' '.$launch_apr_pm->launch.' '.$launch_apr_pm->launch_years;}else{$launch_apr_pm_hasil="-";}
            // May
            $prioritas_may_pr = notulen::where('id_pkp',$_data->id_project)->where('Bulan','May')->where('note_rd_pv','!=','NULL')->first();
            if($prioritas_may_pr!=NULL){$prioritas_may_pr_hasil = $prioritas_may_pr->prioritas;}else{$prioritas_may_pr_hasil="-";}
            $prioritas_may_pm = notulen::where('id_pkp',$_data->id_project)->where('Bulan','May')->where('note_pv_marketing','!=','NULL')->first();
            if($prioritas_may_pm!=NULL){$prioritas_may_pm_hasil = $prioritas_may_pm->prioritas;}else{$prioritas_may_pm_hasil="-";}

            $pro_may_pr = NoteForecast::where('id_pkp',$_data->id_project)->where('Bulan','May')->where('info','=','1')->first();
            if($pro_may_pr!=NULL){$pro_may_pr_hasil = ' '.$pro_may_pr->satuan.'='.$pro_may_pr->forecash;}else{$pro_may_pr_hasil="-";}
            $pro_may_pm = NoteForecast::where('id_pkp',$_data->id_project)->where('Bulan','May')->where('info','=','2')->first();
            if($pro_may_pm!=NULL){$pro_may_pm_hasil = ' '.$pro_may_pm->satuan.'='.$pro_may_pm->forecash;}else{$pro_may_pm_hasil="-";}

            $launch_may_pr = notulen::where('id_pkp',$_data->id_project)->where('Bulan','May')->where('note_rd_pv','!=','NULL')->first();
            if($launch_may_pr!=NULL){$launch_may_pr_hasil=' '.$launch_may_pr->launch.' '.$launch_may_pr->launch_years;}else{$launch_may_pr_hasil="-";}
            $launch_may_pm = notulen::where('id_pkp',$_data->id_project)->where('Bulan','May')->where('note_pv_marketing','!=','NULL')->first();
            if($launch_may_pm!=NULL){$launch_may_pm_hasil=' '.$launch_may_pm->launch.' '.$launch_may_pm->launch_years;}else{$launch_may_pm_hasil="-";}
            // june
            $prioritas_jun_pr = notulen::where('id_pkp',$_data->id_project)->where('Bulan','June')->where('note_rd_pv','!=','NULL')->first();
            if($prioritas_jun_pr!=NULL){$prioritas_jun_pr_hasil = $prioritas_jun_pr->prioritas;}else{$prioritas_jun_pr_hasil="-";}
            $prioritas_jun_pm = notulen::where('id_pkp',$_data->id_project)->where('Bulan','June')->where('note_pv_marketing','!=','NULL')->first();
            if($prioritas_jun_pm!=NULL){$prioritas_jun_pm_hasil = $prioritas_jun_pm->prioritas;}else{$prioritas_jun_pm_hasil="-";}

            $pro_jun_pr = NoteForecast::where('id_pkp',$_data->id_project)->where('Bulan','June')->where('info','=','1')->first();
            if($pro_jun_pr!=NULL){$pro_jun_pr_hasil = ' '.$pro_jun_pr->satuan.'='.$pro_jun_pr->forecash;}else{$pro_jun_pr_hasil="-";}
            $pro_jun_pm = NoteForecast::where('id_pkp',$_data->id_project)->where('Bulan','June')->where('info','=','2')->first();
            if($pro_jun_pm!=NULL){$pro_jun_pm_hasil = ' '.$pro_jun_pm->satuan.'='.$pro_jun_pm->forecash;}else{$pro_jun_pm_hasil="-";}

            $launch_jun_pr = notulen::where('id_pkp',$_data->id_project)->where('Bulan','June')->where('note_rd_pv','!=','NULL')->first();
            if($launch_jun_pr!=NULL){$launch_jun_pr_hasil=' '.$launch_jun_pr->launch.' '.$launch_jun_pr->launch_years;}else{$launch_jun_pr_hasil="-";}
            $launch_jun_pm = notulen::where('id_pkp',$_data->id_project)->where('Bulan','June')->where('note_pv_marketing','!=','NULL')->first();
            if($launch_jun_pm!=NULL){$launch_jun_pm_hasil=' '.$launch_jun_pm->launch.' '.$launch_jun_pm->launch_years;}else{$launch_jun_pm_hasil="-";}
            // July
            $prioritas_jul_pr = notulen::where('id_pkp',$_data->id_project)->where('Bulan','July')->where('note_rd_pv','!=','NULL')->first();
            if($prioritas_jul_pr!=NULL){$prioritas_jul_pr_hasil = $prioritas_jul_pr->prioritas;}else{$prioritas_jul_pr_hasil="-";}
            $prioritas_jul_pm = notulen::where('id_pkp',$_data->id_project)->where('Bulan','July')->where('note_pv_marketing','!=','NULL')->first();
            if($prioritas_jul_pm!=NULL){$prioritas_jul_pm_hasil = $prioritas_jul_pm->prioritas;}else{$prioritas_jul_pm_hasil="-";}

            $pro_jul_pr = NoteForecast::where('id_pkp',$_data->id_project)->where('Bulan','July')->where('info','=','1')->first();
            if($pro_mar_pr!=NULL){$pro_jul_pr_hasil = ' '.$pro_jul_pr->satuan.'='.$pro_jul_pr->forecash;}else{$pro_jul_pr_hasil="-";}
            $pro_jul_pm = NoteForecast::where('id_pkp',$_data->id_project)->where('Bulan','July')->where('info','=','2')->first();
            if($pro_jul_pm!=NULL){$pro_jul_pm_hasil = ' '.$pro_jul_pm->satuan.'='.$pro_jul_pm->forecash;}else{$pro_jul_pm_hasil="-";}

            $launch_jul_pr = notulen::where('id_pkp',$_data->id_project)->where('Bulan','July')->where('note_rd_pv','!=','NULL')->first();
            if($launch_jul_pr!=NULL){$launch_jul_pr_hasil=' '.$launch_jul_pr->launch.' '.$launch_jul_pr->launch_years;}else{$launch_jul_pr_hasil="-";}
            $launch_jul_pm = notulen::where('id_pkp',$_data->id_project)->where('Bulan','July')->where('note_pv_marketing','!=','NULL')->first();
            if($launch_jul_pm!=NULL){$launch_jul_pm_hasil=' '.$launch_jul_pm->launch.' '.$launch_jul_pm->launch_years;}else{$launch_jul_pm_hasil="-";}
            // August
            $prioritas_aug_pr = notulen::where('id_pkp',$_data->id_project)->where('Bulan','August')->where('note_rd_pv','!=','NULL')->first();
            if($prioritas_aug_pr!=NULL){$prioritas_aug_pr_hasil = $prioritas_aug_pr->prioritas;}else{$prioritas_aug_pr_hasil="-";}
            $prioritas_aug_pm = notulen::where('id_pkp',$_data->id_project)->where('Bulan','August')->where('note_pv_marketing','!=','NULL')->first();
            if($prioritas_aug_pm!=NULL){$prioritas_aug_pm_hasil = $prioritas_aug_pm->prioritas;}else{$prioritas_aug_pm_hasil="-";}

            $pro_aug_pr = NoteForecast::where('id_pkp',$_data->id_project)->where('Bulan','August')->where('info','=','1')->first();
            if($pro_aug_pr!=NULL){$pro_aug_pr_hasil = ' '.$pro_aug_pr->satuan.'='.$pro_aug_pr->forecash;}else{$pro_aug_pr_hasil="-";}
            $pro_aug_pm = NoteForecast::where('id_pkp',$_data->id_project)->where('Bulan','August')->where('info','=','2')->first();
            if($pro_aug_pm!=NULL){$pro_aug_pm_hasil = ' '.$pro_aug_pm->satuan.'='.$pro_aug_pm->forecash;}else{$pro_aug_pm_hasil="-";}

            $launch_aug_pr = notulen::where('id_pkp',$_data->id_project)->where('Bulan','August')->where('note_rd_pv','!=','NULL')->first();
            if($launch_aug_pr!=NULL){$launch_aug_pr_hasil=' '.$launch_aug_pr->launch.' '.$launch_aug_pr->launch_years;}else{$launch_aug_pr_hasil="-";}
            $launch_aug_pm = notulen::where('id_pkp',$_data->id_project)->where('Bulan','August')->where('note_pv_marketing','!=','NULL')->first();
            if($launch_aug_pm!=NULL){$launch_aug_pm_hasil=' '.$launch_aug_pm->launch.' '.$launch_aug_pm->launch_years;}else{$launch_aug_pm_hasil="-";}
            // Sept
            $prioritas_sep_pr = notulen::where('id_pkp',$_data->id_project)->where('Bulan','September')->where('note_rd_pv','!=','NULL')->first();
            if($prioritas_sep_pr!=NULL){$prioritas_sep_pr_hasil = $prioritas_sep_pr->prioritas;}else{$prioritas_sep_pr_hasil="-";}
            $prioritas_sep_pm = notulen::where('id_pkp',$_data->id_project)->where('Bulan','September')->where('note_pv_marketing','!=','NULL')->first();
            if($prioritas_sep_pm!=NULL){$prioritas_sep_pm_hasil = $prioritas_sep_pm->prioritas;}else{$prioritas_sep_pm_hasil="-";}

            $pro_sep_pr = NoteForecast::where('id_pkp',$_data->id_project)->where('Bulan','September')->where('info','=','1')->first();
            if($pro_sep_pr!=NULL){$pro_sep_pr_hasil = ' '.$pro_sep_pr->satuan.'='.$pro_sep_pr->forecash;}else{$pro_sep_pr_hasil="-";}
            $pro_sep_pm = NoteForecast::where('id_pkp',$_data->id_project)->where('Bulan','September')->where('info','=','2')->first();
            if($pro_sep_pm!=NULL){$pro_sep_pm_hasil = ' '.$pro_sep_pm->satuan.'='.$pro_sep_pm->forecash;}else{$pro_sep_pm_hasil="-";}

            $launch_sep_pr = notulen::where('id_pkp',$_data->id_project)->where('Bulan','September')->where('note_rd_pv','!=','NULL')->first();
            if($launch_sep_pr!=NULL){$launch_sep_pr_hasil=' '.$launch_sep_pr->launch.' '.$launch_sep_pr->launch_years;}else{$launch_sep_pr_hasil="-";}
            $launch_sep_pm = notulen::where('id_pkp',$_data->id_project)->where('Bulan','September')->where('note_pv_marketing','!=','NULL')->first();
            if($launch_sep_pm!=NULL){$launch_sep_pm_hasil=' '.$launch_sep_pm->launch.' '.$launch_sep_pm->launch_years;}else{$launch_sep_pm_hasil="-";}
            // Oct
            $prioritas_oct_pr = notulen::where('id_pkp',$_data->id_project)->where('Bulan','October')->where('note_rd_pv','!=','NULL')->first();
            if($prioritas_oct_pr!=NULL){$prioritas_oct_pr_hasil = $prioritas_oct_pr->prioritas;}else{$prioritas_oct_pr_hasil="-";}
            $prioritas_oct_pm = notulen::where('id_pkp',$_data->id_project)->where('Bulan','October')->where('note_pv_marketing','!=','NULL')->first();
            if($prioritas_oct_pm!=NULL){$prioritas_oct_pm_hasil = $prioritas_oct_pm->prioritas;}else{$prioritas_oct_pm_hasil="-";}

            $pro_oct_pr = NoteForecast::where('id_pkp',$_data->id_project)->where('Bulan','October')->where('info','=','1')->first();
            if($pro_oct_pr!=NULL){$pro_oct_pr_hasil = ' '.$pro_oct_pr->satuan.'='.$pro_oct_pr->forecash;}else{$pro_oct_pr_hasil="-";}
            $pro_oct_pm = NoteForecast::where('id_pkp',$_data->id_project)->where('Bulan','October')->where('info','=','2')->first();
            if($pro_oct_pm!=NULL){$pro_oct_pm_hasil = ' '.$pro_oct_pm->satuan.'='.$pro_oct_pm->forecash;}else{$pro_oct_pm_hasil="-";}

            $launch_oct_pr = notulen::where('id_pkp',$_data->id_project)->where('Bulan','October')->where('note_rd_pv','!=','NULL')->first();
            if($launch_oct_pr!=NULL){$launch_oct_pr_hasil=' '.$launch_oct_pr->launch.' '.$launch_oct_pr->launch_years;}else{$launch_oct_pr_hasil="-";}
            $launch_oct_pm = notulen::where('id_pkp',$_data->id_project)->where('Bulan','October')->where('note_pv_marketing','!=','NULL')->first();
            if($launch_oct_pm!=NULL){$launch_oct_pm_hasil=' '.$launch_oct_pm->launch.' '.$launch_oct_pm->launch_years;}else{$launch_oct_pm_hasil="-";}
            // Nov
            $prioritas_nov_pr = notulen::where('id_pkp',$_data->id_project)->where('Bulan','November')->where('note_rd_pv','!=','NULL')->first();
            if($prioritas_nov_pr!=NULL){$prioritas_nov_pr_hasil = $prioritas_nov_pr->prioritas;}else{$prioritas_nov_pr_hasil="-";}
            $prioritas_nov_pm = notulen::where('id_pkp',$_data->id_project)->where('Bulan','November')->where('note_pv_marketing','!=','NULL')->first();
            if($prioritas_nov_pm!=NULL){$prioritas_nov_pm_hasil = $prioritas_nov_pm->prioritas;}else{$prioritas_nov_pm_hasil="-";}

            $pro_nov_pr = NoteForecast::where('id_pkp',$_data->id_project)->where('Bulan','November')->where('info','=','1')->first();
            if($pro_nov_pr!=NULL){$pro_nov_pr_hasil = ' '.$pro_nov_pr->satuan.'='.$pro_nov_pr->forecash;}else{$pro_nov_pr_hasil="-";}
            $pro_nov_pm = NoteForecast::where('id_pkp',$_data->id_project)->where('Bulan','November')->where('info','=','2')->first();
            if($pro_nov_pm!=NULL){$pro_nov_pm_hasil = ' '.$pro_nov_pm->satuan.'='.$pro_nov_pm->forecash;}else{$pro_nov_pm_hasil="-";}

            $launch_nov_pr = notulen::where('id_pkp',$_data->id_project)->where('Bulan','November')->where('note_rd_pv','!=','NULL')->first();
            if($launch_nov_pr!=NULL){$launch_nov_pr_hasil=' '.$launch_nov_pr->launch.' '.$launch_nov_pr->launch_years;}else{$launch_nov_pr_hasil="-";}
            $launch_nov_pm = notulen::where('id_pkp',$_data->id_project)->where('Bulan','November')->where('note_pv_marketing','!=','NULL')->first();
            if($launch_nov_pm!=NULL){$launch_nov_pm_hasil=' '.$launch_nov_pm->launch.' '.$launch_nov_pm->launch_years;}else{$launch_nov_pm_hasil="-";}
            // Dec
            $prioritas_dec_pr = notulen::where('id_pkp',$_data->id_project)->where('Bulan','December')->where('note_rd_pv','!=','NULL')->first();
            if($prioritas_dec_pr!=NULL){$prioritas_dec_pr_hasil = $prioritas_pr_dec->prioritas;}else{$prioritas_dec_pr_hasil="-";}
            $prioritas_dec_pm = notulen::where('id_pkp',$_data->id_project)->where('Bulan','December')->where('note_pv_marketing','!=','NULL')->first();
            if($prioritas_dec_pm!=NULL){$prioritas_dec_pm_hasil = $prioritas_dec_pm->prioritas;}else{$prioritas_dec_pm_hasil="-";}

            $pro_dec_pr = NoteForecast::where('id_pkp',$_data->id_project)->where('Bulan','December')->where('info','=','1')->first();
            if($pro_dec_pr!=NULL){$pro_dec_pr_hasil = ' '.$pro_dec_pr->satuan.'='.$pro_dec_pr->forecash;}else{$pro_dec_pr_hasil="-";}
            $pro_dec_pm = NoteForecast::where('id_pkp',$_data->id_project)->where('Bulan','December')->where('info','=','2')->first();
            if($pro_dec_pm!=NULL){$pro_dec_pm_hasil = ' '.$pro_dec_pm->satuan.'='.$pro_dec_pm->forecash;}else{$pro_dec_pm_hasil="-";}

            $launch_dec_pr = notulen::where('id_pkp',$_data->id_project)->where('Bulan','December')->where('note_rd_pv','!=','NULL')->first();
            if($launch_dec_pr!=NULL){$launch_dec_pr_hasil=' '.$launch_dec_pr->launch.' '.$launch_dec_pr->launch_years;}else{$launch_dec_pr_hasil="-";}
            $launch_dec_pm = notulen::where('id_pkp',$_data->id_project)->where('Bulan','December')->where('note_pv_marketing','!=','NULL')->first();
            if($launch_dec_pm!=NULL){$launch_dec_pm_hasil=' '.$launch_dec_pm->launch.' '.$launch_dec_pm->launch_years;}else{$launch_dec_pm_hasil="-";}

            $objPHPExcel->setActiveSheetIndex(0)
                        ->setCellValue('A'.$pertama, $_data['pkp_number'])
                        ->setCellValue('B'.$pertama, $_data['ket_no'])
                        ->setCellValue('C'.$pertama, $dec_pm_hasil)
                        ->setCellValue('D'.$pertama, $prioritas_dec_pm_hasil)
                        ->setCellValue('E'.$pertama, $launch_dec_pm_hasil)
                        ->setCellValue('F'.$pertama, $pro_dec_pm_hasil)
                        ->setCellValue('G'.$pertama, $dec_pr_hasil)
                        ->setCellValue('H'.$pertama, $prioritas_dec_pr_hasil)
                        ->setCellValue('I'.$pertama, $launch_dec_pr_hasil)
                        ->setCellValue('J'.$pertama, $pro_dec_pr_hasil)
                        ->setCellValue('K'.$pertama, $nov_pm_hasil)
                        ->setCellValue('L'.$pertama, $prioritas_nov_pm_hasil)
                        ->setCellValue('M'.$pertama, $launch_nov_pm_hasil)
                        ->setCellValue('N'.$pertama, $prioritas_nov_pm_hasil)
                        ->setCellValue('O'.$pertama, $nov_pr_hasil)
                        ->setCellValue('P'.$pertama, $prioritas_nov_pr_hasil)
                        ->setCellValue('Q'.$pertama, $launch_nov_pr_hasil)
                        ->setCellValue('R'.$pertama, $prioritas_nov_pr_hasil)
                        ->setCellValue('S'.$pertama, $oct_pm_hasil)
                        ->setCellValue('T'.$pertama, $prioritas_oct_pm_hasil)
                        ->setCellValue('U'.$pertama, $launch_oct_pm_hasil)
                        ->setCellValue('V'.$pertama, $pro_oct_pm_hasil)
                        ->setCellValue('W'.$pertama, $oct_pr_hasil)
                        ->setCellValue('X'.$pertama, $prioritas_oct_pr_hasil)
                        ->setCellValue('Y'.$pertama, $launch_oct_pr_hasil)
                        ->setCellValue('Z'.$pertama, $pro_oct_pr_hasil)
                        ->setCellValue('AA'.$pertama, $sep_pm_hasil)
                        ->setCellValue('AB'.$pertama, $prioritas_sep_pm_hasil)
                        ->setCellValue('AC'.$pertama, $launch_sep_pm_hasil)
                        ->setCellValue('AD'.$pertama, $pro_sep_pm_hasil)
                        ->setCellValue('AE'.$pertama, $sep_pr_hasil)
                        ->setCellValue('AF'.$pertama, $prioritas_sep_pr_hasil)
                        ->setCellValue('AG'.$pertama, $launch_sep_pr_hasil)
                        ->setCellValue('AH'.$pertama, $pro_sep_pr_hasil)
                        ->setCellValue('AI'.$pertama, $aug_pm_hasil)
                        ->setCellValue('AJ'.$pertama, $prioritas_aug_pm_hasil)
                        ->setCellValue('AK'.$pertama, $launch_aug_pm_hasil)
                        ->setCellValue('AL'.$pertama, $pro_aug_pm_hasil)
                        ->setCellValue('AM'.$pertama, $aug_pr_hasil)
                        ->setCellValue('AN'.$pertama, $prioritas_aug_pr_hasil)
                        ->setCellValue('AO'.$pertama, $launch_aug_pr_hasil)
                        ->setCellValue('AP'.$pertama, $pro_aug_pr_hasil)
                        ->setCellValue('AQ'.$pertama, $jul_pm_hasil)
                        ->setCellValue('AR'.$pertama, $prioritas_jul_pm_hasil)
                        ->setCellValue('AS'.$pertama, $launch_jul_pm_hasil)
                        ->setCellValue('AT'.$pertama, $pro_jul_pm_hasil)
                        ->setCellValue('AU'.$pertama, $jul_pr_hasil)
                        ->setCellValue('AV'.$pertama, $prioritas_jul_pr_hasil)
                        ->setCellValue('AW'.$pertama, $launch_jul_pr_hasil)
                        ->setCellValue('AX'.$pertama, $pro_jul_pr_hasil)
                        ->setCellValue('AY'.$pertama, $jun_pm_hasil)
                        ->setCellValue('AZ'.$pertama, $prioritas_jun_pm_hasil)
                        ->setCellValue('BA'.$pertama, $launch_jun_pm_hasil)
                        ->setCellValue('BB'.$pertama, $pro_jun_pm_hasil)
                        ->setCellValue('BC'.$pertama, $jun_pr_hasil)
                        ->setCellValue('BD'.$pertama, $prioritas_jun_pr_hasil)
                        ->setCellValue('BE'.$pertama, $launch_jun_pr_hasil)
                        ->setCellValue('BF'.$pertama, $pro_jun_pr_hasil)
                        ->setCellValue('BG'.$pertama, $may_pm_hasil)
                        ->setCellValue('BH'.$pertama, $prioritas_may_pm_hasil)
                        ->setCellValue('BI'.$pertama, $launch_may_pm_hasil)
                        ->setCellValue('BJ'.$pertama, $pro_may_pm_hasil)
                        ->setCellValue('BK'.$pertama, $may_pr_hasil)
                        ->setCellValue('BL'.$pertama, $prioritas_may_pr_hasil)
                        ->setCellValue('BM'.$pertama, $launch_may_pr_hasil)
                        ->setCellValue('BN'.$pertama, $pro_may_pr_hasil)
                        ->setCellValue('BO'.$pertama, $apr_pm_hasil)
                        ->setCellValue('BP'.$pertama, $prioritas_apr_pm_hasil)
                        ->setCellValue('BQ'.$pertama, $launch_apr_pm_hasil)
                        ->setCellValue('BR'.$pertama, $pro_apr_pm_hasil)
                        ->setCellValue('BS'.$pertama, $apr_pr_hasil)
                        ->setCellValue('BT'.$pertama, $prioritas_apr_pr_hasil)
                        ->setCellValue('BU'.$pertama, $launch_apr_pr_hasil)
                        ->setCellValue('BV'.$pertama, $pro_apr_pr_hasil)
                        ->setCellValue('BW'.$pertama, $mar_pm_hasil)
                        ->setCellValue('BX'.$pertama, $prioritas_mar_pm_hasil)
                        ->setCellValue('BY'.$pertama, $launch_mar_pm_hasil)
                        ->setCellValue('BZ'.$pertama, $pro_mar_pm_hasil)
                        ->setCellValue('CA'.$pertama, $mar_pr_hasil)
                        ->setCellValue('CB'.$pertama, $prioritas_mar_pr_hasil)
                        ->setCellValue('CC'.$pertama, $launch_mar_pr_hasil)
                        ->setCellValue('CD'.$pertama, $pro_mar_pr_hasil)
                        ->setCellValue('CE'.$pertama, $feb_pm_hasil)
                        ->setCellValue('CF'.$pertama, $prioritas_feb_pm_hasil)
                        ->setCellValue('CG'.$pertama, $launch_feb_pm_hasil)
                        ->setCellValue('CH'.$pertama, $pro_feb_pm_hasil)
                        ->setCellValue('CI'.$pertama, $feb_pr_hasil)
                        ->setCellValue('CJ'.$pertama, $prioritas_feb_pr_hasil)
                        ->setCellValue('CK'.$pertama, $launch_feb_pr_hasil)
                        ->setCellValue('CL'.$pertama, $pro_feb_pr_hasil)
                        ->setCellValue('CM'.$pertama, $jan_pm_hasil)
                        ->setCellValue('CN'.$pertama, $prioritas_jan_pm_hasil)
                        ->setCellValue('CO'.$pertama, $launch_jan_pm_hasil)
                        ->setCellValue('CP'.$pertama, $pro_jan_pm_hasil)
                        ->setCellValue('CQ'.$pertama, $jan_pr_hasil)
                        ->setCellValue('CR'.$pertama, $prioritas_jan_pr_hasil)
                        ->setCellValue('CS'.$pertama, $launch_jan_pr_hasil)
                        ->setCellValue('CT'.$pertama, $pro_jan_pr_hasil);
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