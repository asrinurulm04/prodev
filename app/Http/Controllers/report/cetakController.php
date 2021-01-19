<?php

namespace App\Http\Controllers\report;
use App\Http\Controllers\Controller;

use Illuminate\Http\Request;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\IOFactory;

use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use Illuminate\Support\Facades\Validator;
use App\model\pkp\tipp;
use App\model\pkp\coba;
use App\model\pkp\pdf_project;
use App\model\pkp\pkp_project;
use App\model\pkp\data_forecast;
use DB;
use Auth;

class cetakController extends Controller
{
    public function download_project(){
        $objPHPExcel = new Spreadsheet();

        // Sheet pertama
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
        $objPHPExcel->getActiveSheet()->getColumnDimension('R')->setWidth(25.14);

        $objPHPExcel->getActiveSheet()->getColumnDimension('S')->setWidth(22.5);
        $objPHPExcel->getActiveSheet()->getColumnDimension('T')->setWidth(12.57);
        $objPHPExcel->getActiveSheet()->getColumnDimension('U')->setWidth(12.57);
        $objPHPExcel->getActiveSheet()->getColumnDimension('V')->setWidth(25.14);
        $objPHPExcel->getActiveSheet()->getColumnDimension('W')->setWidth(24.5);
        $objPHPExcel->getActiveSheet()->getColumnDimension('X')->setWidth(22.57);
        $objPHPExcel->getActiveSheet()->getColumnDimension('Y')->setWidth(30.57);

        $baris=1;
        $pertama=2;

        $data=tipp::join('pkp_project','pkp_project.id_project','tippu.id_pkp')
            ->join('tarkons','tarkons.id_tarkon','tippu.akg')
            ->join('users','users.id','tippu.perevisi')->where('status_data','=','active')
            ->where('status_freeze','inactive')->where('status_project','!=','revisi')
            ->where('status_project','!=','draf')->orderBy('pkp_number','asc')->get();
        $no=1;
        
        $styleArray = array(
            'background'  => array(
            'color' => array('rgb' => 'FF0000'),
        ));

        //Bagian Header 
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
            ->setCellValue('R'.$baris, 'Competitor')
            ->setCellValue('S'.$baris, 'Aisle')
            ->setCellValue('T'.$baris, 'Product Form')
            ->setCellValue('U'.$baris, 'AKG')
            ->setCellValue('V'.$baris, 'Prefered Flavour')
            ->setCellValue('W'.$baris, 'Product Benefits')
            ->setCellValue('X'.$baris, 'Mandatory Ingredient')
            ->setCellValue('Y'.$baris, 'Serving Suggestion');
                            
        $objPHPExcel->getActiveSheet()->mergeCells('A'.$baris.':B'.$baris);
        $objPHPExcel->setActiveSheetIndex(0)
                    ->setCellValue('A'.$baris, 'PKP Number');
        $objPHPExcel->getActiveSheet()->getStyle("A".$baris)->getFill()
                    ->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)
                    ->getStartColor()->setARGB('13DFE4');
        $objPHPExcel->getActiveSheet()->getStyle("A".$baris)->getAlignment()->setHorizontal('center');
                
        $objPHPExcel->getActiveSheet()->getStyle("C".$baris)->getFill()
                    ->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)
                    ->getStartColor()->setARGB('13DFE4');
        $objPHPExcel->getActiveSheet()->getStyle("C".$baris)->getAlignment()->setHorizontal('center');
                
        $objPHPExcel->getActiveSheet()->getStyle("D".$baris)->getFill()
                    ->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)
                    ->getStartColor()->setARGB('13DFE4');
        $objPHPExcel->getActiveSheet()->getStyle("D".$baris)->getAlignment()->setHorizontal('center');

        $objPHPExcel->getActiveSheet()->getStyle("E".$baris)->getFill()
                    ->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)
                    ->getStartColor()->setARGB('13DFE4');
        $objPHPExcel->getActiveSheet()->getStyle("E".$baris)->getAlignment()->setHorizontal('center');
                
        $objPHPExcel->getActiveSheet()->getStyle("F".$baris)->getFill()
                    ->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)
                    ->getStartColor()->setARGB('13DFE4');
        $objPHPExcel->getActiveSheet()->getStyle("F".$baris)->getAlignment()->setHorizontal('center');

        $objPHPExcel->getActiveSheet()->getStyle("G".$baris)->getFill()
                    ->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)
                    ->getStartColor()->setARGB('13DFE4');
        $objPHPExcel->getActiveSheet()->getStyle("G".$baris)->getAlignment()->setHorizontal('center');
                
        $objPHPExcel->getActiveSheet()->getStyle("H".$baris)->getFill()
                    ->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)
                    ->getStartColor()->setARGB('13DFE4');
        $objPHPExcel->getActiveSheet()->getStyle("H".$baris)->getAlignment()->setHorizontal('center');
                
        $objPHPExcel->getActiveSheet()->getStyle("I".$baris)->getFill()
                    ->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)
                    ->getStartColor()->setARGB('13DFE4');
        $objPHPExcel->getActiveSheet()->getStyle("I".$baris)->getAlignment()->setHorizontal('center');
                
        $objPHPExcel->getActiveSheet()->getStyle("J".$baris)->getFill()
                    ->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)
                    ->getStartColor()->setARGB('13DFE4');
        $objPHPExcel->getActiveSheet()->getStyle("J".$baris)->getAlignment()->setHorizontal('center');
                
        $objPHPExcel->getActiveSheet()->getStyle("K".$baris)->getFill()
                    ->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)
                    ->getStartColor()->setARGB('13DFE4');
        $objPHPExcel->getActiveSheet()->getStyle("K".$baris)->getAlignment()->setHorizontal('center');
                
        $objPHPExcel->getActiveSheet()->getStyle("L".$baris)->getFill()
                    ->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)
                    ->getStartColor()->setARGB('13DFE4');
        $objPHPExcel->getActiveSheet()->getStyle("L".$baris)->getAlignment()->setHorizontal('center');
                
        $objPHPExcel->getActiveSheet()->getStyle("M".$baris)->getFill()
                    ->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)
                    ->getStartColor()->setARGB('13DFE4');
        $objPHPExcel->getActiveSheet()->getStyle("M".$baris)->getAlignment()->setHorizontal('center');
                
        $objPHPExcel->getActiveSheet()->getStyle("N".$baris)->getFill()
                    ->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)
                    ->getStartColor()->setARGB('13DFE4');
        $objPHPExcel->getActiveSheet()->getStyle("N".$baris)->getAlignment()->setHorizontal('center');
                
        $objPHPExcel->getActiveSheet()->getStyle("O".$baris)->getFill()
                    ->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)
                    ->getStartColor()->setARGB('13DFE4');
        $objPHPExcel->getActiveSheet()->getStyle("O".$baris)->getAlignment()->setHorizontal('center');
                
        $objPHPExcel->getActiveSheet()->getStyle("P".$baris)->getFill()
                    ->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)
                    ->getStartColor()->setARGB('13DFE4');
        $objPHPExcel->getActiveSheet()->getStyle("P".$baris)->getAlignment()->setHorizontal('center');
                
        $objPHPExcel->getActiveSheet()->getStyle("Q".$baris)->getFill()
                    ->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)
                    ->getStartColor()->setARGB('13DFE4');
        $objPHPExcel->getActiveSheet()->getStyle("Q".$baris)->getAlignment()->setHorizontal('center');
                
        $objPHPExcel->getActiveSheet()->getStyle("R".$baris)->getFill()
                    ->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)
                    ->getStartColor()->setARGB('13DFE4');
        $objPHPExcel->getActiveSheet()->getStyle("R".$baris)->getAlignment()->setHorizontal('center');
                
        $objPHPExcel->getActiveSheet()->getStyle("S".$baris)->getFill()
                    ->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)
                    ->getStartColor()->setARGB('13DFE4');
        $objPHPExcel->getActiveSheet()->getStyle("S".$baris)->getAlignment()->setHorizontal('center');
                
        $objPHPExcel->getActiveSheet()->getStyle("T".$baris)->getFill()
                    ->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)
                    ->getStartColor()->setARGB('13DFE4');
        $objPHPExcel->getActiveSheet()->getStyle("T".$baris)->getAlignment()->setHorizontal('center');
                
        $objPHPExcel->getActiveSheet()->getStyle("U".$baris)->getFill()
                    ->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)
                    ->getStartColor()->setARGB('13DFE4');
        $objPHPExcel->getActiveSheet()->getStyle("U".$baris)->getAlignment()->setHorizontal('center');
                
        $objPHPExcel->getActiveSheet()->getStyle("V".$baris)->getFill()
                    ->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)
                    ->getStartColor()->setARGB('13DFE4');
        $objPHPExcel->getActiveSheet()->getStyle("V".$baris)->getAlignment()->setHorizontal('center');

        $objPHPExcel->getActiveSheet()->getStyle("W".$baris)->getFill()
                    ->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)
                    ->getStartColor()->setARGB('13DFE4');
        $objPHPExcel->getActiveSheet()->getStyle("W".$baris)->getAlignment()->setHorizontal('center');
                
        $objPHPExcel->getActiveSheet()->getStyle("X".$baris)->getFill()
                    ->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)
                    ->getStartColor()->setARGB('13DFE4');
        $objPHPExcel->getActiveSheet()->getStyle("X".$baris)->getAlignment()->setHorizontal('center');
                
        $objPHPExcel->getActiveSheet()->getStyle("Y".$baris)->getFill()
                    ->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)
                    ->getStartColor()->setARGB('13DFE4');
        $objPHPExcel->getActiveSheet()->getStyle("Y".$baris)->getAlignment()->setHorizontal('center');
        
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
                $ld = $_data->launch;
                $ld2 = $_data->years;
            }elseif($launch!=NULL){
                $ld=$_data['tgl_launch'];
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
                ->setCellValue('R'.$pertama, $_data['competitor'])
                ->setCellValue('S'.$pertama, $_data['aisle'])
                ->setCellValue('T'.$pertama, $_data['product_form'])
                ->setCellValue('U'.$pertama, $_data['tarkon'])
                ->setCellValue('V'.$pertama, $_data['prefered_flavour'])
                ->setCellValue('W'.$pertama, $_data['product_benefits'])
                ->setCellValue('X'.$pertama, $_data['mandatory_ingredient'])
                ->setCellValue('Y'.$pertama, $_data['serving_suggestion']);
            $pertama++;
        }
        $no++;
        $objPHPExcel->getActiveSheet()->setTitle('Tabulasi PKP');

        // Create a new worksheet2
        $objPHPExcel->createSheet();
        $objPHPExcel->setActiveSheetIndex(1); 
        $objPHPExcel->getActiveSheet(1)->getColumnDimension('A')->setWidth(5.00);
        $objPHPExcel->getActiveSheet(1)->getColumnDimension('B')->setWidth(30.71);
        $objPHPExcel->getActiveSheet(1)->getColumnDimension('C')->setWidth(10.67);
        $objPHPExcel->getActiveSheet(1)->getColumnDimension('D')->setWidth(10.67);
        $objPHPExcel->getActiveSheet(1)->getColumnDimension('E')->setWidth(4.00);
        $objPHPExcel->getActiveSheet(1)->getColumnDimension('F')->setWidth(4.00);

        $objPHPExcel->getActiveSheet(1)->getColumnDimension('G')->setWidth(4.5);
        $objPHPExcel->getActiveSheet(1)->getColumnDimension('H')->setWidth(4.14);
        $objPHPExcel->getActiveSheet(1)->getColumnDimension('I')->setWidth(4.5);
        $objPHPExcel->getActiveSheet(1)->getColumnDimension('J')->setWidth(4.5);
        $objPHPExcel->getActiveSheet(1)->getColumnDimension('K')->setWidth(4.57);
        $objPHPExcel->getActiveSheet(1)->getColumnDimension('L')->setWidth(4.71);

        $objPHPExcel->getActiveSheet(1)->getColumnDimension('M')->setWidth(4.71);
        $objPHPExcel->getActiveSheet(1)->getColumnDimension('N')->setWidth(4.67);
        $objPHPExcel->getActiveSheet(1)->getColumnDimension('O')->setWidth(15.14);
        $objPHPExcel->getActiveSheet(1)->getColumnDimension('P')->setWidth(15.5);

        $satu=1;
        $value=2;

        $for=data_forecast::join('tippu','tippu.id','data_forecash.id_pkp')->where('status_data','=','active')
            ->join('pkp_project','tippu.id_pkp','pkp_project.id_project')
            ->join('data_kemas','data_kemas.id_kemas','data_forecash.kemas_eksis')
            ->where('status_freeze','inactive')->where('status_project','!=','revisi')
            ->where('status_project','!=','draf')->get();
        $number=1;

        // Add some data to the second sheet, resembling some different data types
        $objPHPExcel->setActiveSheetIndex(1);
        $objPHPExcel->getActiveSheet()->setCellValue('A1', 'PKP Number');
        $objPHPExcel->getActiveSheet()->setCellValue('C1', 'Forecash');
        $objPHPExcel->getActiveSheet()->setCellValue('E1', 'UOM');
        $objPHPExcel->getActiveSheet()->setCellValue('G1', 'Kemas');
        $objPHPExcel->getActiveSheet()->setCellValue('O1', 'NFI Price');
        $objPHPExcel->getActiveSheet()->setCellValue('P1', 'Costumer Price');

        // pkp number
        $objPHPExcel->getActiveSheet()->mergeCells('A1:B1');
        $objPHPExcel->setActiveSheetIndex(1)
                    ->setCellValue('A1', 'PKP Number');
        $objPHPExcel->getActiveSheet()->getStyle("A1")->getFill()
                    ->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)
                    ->getStartColor()->setARGB('13DFE4');
        $objPHPExcel->getActiveSheet()->getStyle("A1")->getAlignment()->setHorizontal('center');

        // FORECASH
        $objPHPExcel->getActiveSheet()->mergeCells('C1:D1');
        $objPHPExcel->setActiveSheetIndex(1)
                    ->setCellValue('C1', 'FORECASH');
        $objPHPExcel->getActiveSheet()->getStyle("C1")->getFill()
                    ->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)
                    ->getStartColor()->setARGB('13DFE4');
        $objPHPExcel->getActiveSheet()->getStyle("C1")->getAlignment()->setHorizontal('center');
                
        // uom
        $objPHPExcel->getActiveSheet()->mergeCells('E1:F1');
        $objPHPExcel->setActiveSheetIndex(1)
                    ->setCellValue('E1', 'UOM');
        $objPHPExcel->getActiveSheet()->getStyle("E1")->getFill()
                    ->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)
                    ->getStartColor()->setARGB('13DFE4');
        $objPHPExcel->getActiveSheet()->getStyle("E1")->getAlignment()->setHorizontal('center');

        // Kemas
        $objPHPExcel->getActiveSheet()->mergeCells('G1:N1');
        $objPHPExcel->setActiveSheetIndex(1)
                    ->setCellValue('G1', 'Konfigurasi Kemas');
        $objPHPExcel->getActiveSheet()->getStyle("G1")->getFill()
                    ->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)
                    ->getStartColor()->setARGB('13DFE4');
        $objPHPExcel->getActiveSheet()->getStyle("G1")->getAlignment()->setHorizontal('center');

        // NFI price
        $objPHPExcel->getActiveSheet()->getStyle("O1")->getFill()
                    ->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)
                    ->getStartColor()->setARGB('13DFE4');
        $objPHPExcel->getActiveSheet()->getStyle("O1")->getAlignment()->setHorizontal('center');
                
        // Costumer Price
        $objPHPExcel->getActiveSheet()->getStyle("P1")->getFill()
                    ->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)
                    ->getStartColor()->setARGB('13DFE4');
        $objPHPExcel->getActiveSheet()->getStyle("P1")->getAlignment()->setHorizontal('center');

        foreach($for as $_for){
            $objPHPExcel->setActiveSheetIndex(1)
                        ->setCellValue('A'.$value, $_for['pkp_number'])
                        ->setCellValue('B'.$value, $_for['ket_no'])
                        ->setCellValue('C'.$value, $_for['forecast'])
                        ->setCellValue('D'.$value, $_for['satuan'])
                        ->setCellValue('E'.$value, $_for['jlh_uom'])
                        ->setCellValue('F'.$value, $_for['uom'])
                        ->setCellValue('G'.$value, $_for['tersier'])
                        ->setCellValue('H'.$value, $_for['s_tersier'])
                        ->setCellValue('I'.$value, $_for['sekunder1'])
                        ->setCellValue('J'.$value, $_for['s_sekunder1'])
                        ->setCellValue('K'.$value, $_for['sekunder2'])
                        ->setCellValue('L'.$value, $_for['s_sekunder2'])
                        ->setCellValue('M'.$value, $_for['primer'])
                        ->setCellValue('N'.$value, $_for['s_primer'])
                        ->setCellValue('O'.$value, $_for['nfi_price'])
                        ->setCellValue('P'.$value, $_for['costumer']);
                         $value++;
        }
        // Rename 2nd sheet
        $objPHPExcel->getActiveSheet()->setTitle('Forecash');

        $skrg=date('d m Y');
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
        $objPHPExcel->getActiveSheet()->getColumnDimension('R')->setWidth(25.14);

        $objPHPExcel->getActiveSheet()->getColumnDimension('S')->setWidth(22.5);
        $objPHPExcel->getActiveSheet()->getColumnDimension('T')->setWidth(12.57);
        $objPHPExcel->getActiveSheet()->getColumnDimension('U')->setWidth(12.57);
        $objPHPExcel->getActiveSheet()->getColumnDimension('V')->setWidth(25.14);
        $objPHPExcel->getActiveSheet()->getColumnDimension('X')->setWidth(24.5);
        $objPHPExcel->getActiveSheet()->getColumnDimension('X')->setWidth(22.57);
        $objPHPExcel->getActiveSheet()->getColumnDimension('Y')->setWidth(30.57);

        $baris=1;
        $pertama=2;

        if(Auth::user()->departement_id!='1'){
        $data=pkp_project::join('tippu','pkp_project.id_project','tippu.id_pkp')
            ->join('tarkons','tarkons.id_tarkon','tippu.akg')
            ->join('users','users.id','tippu.perevisi')
            ->where('tujuankirim',Auth::user()->departement_id)
            ->where('status_freeze','inactive')->where('status_project','!=','revisi')
            ->where('status_data','=','active')
            ->where('status_project','!=','draf')->orderBy('pkp_number','asc')->get();
        $no=1;
        }elseif(Auth::user()->departement_id=='1'){
            $data=pkp_project::join('tippu','pkp_project.id_project','tippu.id_pkp')
            ->join('tarkons','tarkons.id_tarkon','tippu.akg')
            ->join('users','users.id','tippu.perevisi')
            ->where('tujuankirim2',Auth::user()->departement_id)
            ->where('status_freeze','inactive')->where('status_project','!=','revisi')
            ->where('status_data','=','active')
            ->where('status_project','!=','draf')->orderBy('pkp_number','asc')->get();
        $no=1;   
        }

        $styleArray = array(
            'background'  => array(
            'color' => array('rgb' => 'FF0000'),
        ));

        //Bagian Header
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
            ->setCellValue('R'.$baris, 'Competitor')
            ->setCellValue('S'.$baris, 'Aisle')
            ->setCellValue('T'.$baris, 'Product Form')
            ->setCellValue('U'.$baris, 'AKG')
            ->setCellValue('V'.$baris, 'Prefered Flavour')
            ->setCellValue('W'.$baris, 'Product Benefits')
            ->setCellValue('X'.$baris, 'Mandatory Ingredient')
            ->setCellValue('Y'.$baris, 'Serving Suggestion');
                            
        $objPHPExcel->getActiveSheet()->mergeCells('A'.$baris.':B'.$baris);
        $objPHPExcel->setActiveSheetIndex(0)
                    ->setCellValue('A'.$baris, 'PKP Number');
        $objPHPExcel->getActiveSheet()->getStyle("A".$baris)->getFill()
                    ->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)
                    ->getStartColor()->setARGB('13DFE4');
        $objPHPExcel->getActiveSheet()->getStyle("A".$baris)->getAlignment()->setHorizontal('center');
                
        $objPHPExcel->getActiveSheet()->getStyle("C".$baris)->getFill()
                    ->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)
                    ->getStartColor()->setARGB('13DFE4');
        $objPHPExcel->getActiveSheet()->getStyle("C".$baris)->getAlignment()->setHorizontal('center');
                
        $objPHPExcel->getActiveSheet()->getStyle("D".$baris)->getFill()
                    ->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)
                    ->getStartColor()->setARGB('13DFE4');
        $objPHPExcel->getActiveSheet()->getStyle("D".$baris)->getAlignment()->setHorizontal('center');

        $objPHPExcel->getActiveSheet()->getStyle("E".$baris)->getFill()
                    ->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)
                    ->getStartColor()->setARGB('13DFE4');
        $objPHPExcel->getActiveSheet()->getStyle("E".$baris)->getAlignment()->setHorizontal('center');
                
        $objPHPExcel->getActiveSheet()->getStyle("F".$baris)->getFill()
                    ->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)
                    ->getStartColor()->setARGB('13DFE4');
        $objPHPExcel->getActiveSheet()->getStyle("F".$baris)->getAlignment()->setHorizontal('center');

        $objPHPExcel->getActiveSheet()->getStyle("G".$baris)->getFill()
                    ->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)
                    ->getStartColor()->setARGB('13DFE4');
        $objPHPExcel->getActiveSheet()->getStyle("G".$baris)->getAlignment()->setHorizontal('center');
                
        $objPHPExcel->getActiveSheet()->getStyle("H".$baris)->getFill()
                    ->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)
                    ->getStartColor()->setARGB('13DFE4');
        $objPHPExcel->getActiveSheet()->getStyle("H".$baris)->getAlignment()->setHorizontal('center');
                
        $objPHPExcel->getActiveSheet()->getStyle("I".$baris)->getFill()
                    ->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)
                    ->getStartColor()->setARGB('13DFE4');
        $objPHPExcel->getActiveSheet()->getStyle("I".$baris)->getAlignment()->setHorizontal('center');
                
        $objPHPExcel->getActiveSheet()->getStyle("J".$baris)->getFill()
                    ->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)
                    ->getStartColor()->setARGB('13DFE4');
        $objPHPExcel->getActiveSheet()->getStyle("J".$baris)->getAlignment()->setHorizontal('center');
                
        $objPHPExcel->getActiveSheet()->getStyle("K".$baris)->getFill()
                    ->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)
                    ->getStartColor()->setARGB('13DFE4');
        $objPHPExcel->getActiveSheet()->getStyle("K".$baris)->getAlignment()->setHorizontal('center');
                
        $objPHPExcel->getActiveSheet()->getStyle("L".$baris)->getFill()
                    ->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)
                    ->getStartColor()->setARGB('13DFE4');
        $objPHPExcel->getActiveSheet()->getStyle("L".$baris)->getAlignment()->setHorizontal('center');
                
        $objPHPExcel->getActiveSheet()->getStyle("M".$baris)->getFill()
                    ->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)
                    ->getStartColor()->setARGB('13DFE4');
        $objPHPExcel->getActiveSheet()->getStyle("M".$baris)->getAlignment()->setHorizontal('center');
                
        $objPHPExcel->getActiveSheet()->getStyle("N".$baris)->getFill()
                    ->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)
                    ->getStartColor()->setARGB('13DFE4');
        $objPHPExcel->getActiveSheet()->getStyle("N".$baris)->getAlignment()->setHorizontal('center');
                
        $objPHPExcel->getActiveSheet()->getStyle("O".$baris)->getFill()
                    ->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)
                    ->getStartColor()->setARGB('13DFE4');
        $objPHPExcel->getActiveSheet()->getStyle("O".$baris)->getAlignment()->setHorizontal('center');
                
        $objPHPExcel->getActiveSheet()->getStyle("P".$baris)->getFill()
                    ->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)
                    ->getStartColor()->setARGB('13DFE4');
        $objPHPExcel->getActiveSheet()->getStyle("P".$baris)->getAlignment()->setHorizontal('center');
                
        $objPHPExcel->getActiveSheet()->getStyle("Q".$baris)->getFill()
                    ->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)
                    ->getStartColor()->setARGB('13DFE4');
        $objPHPExcel->getActiveSheet()->getStyle("Q".$baris)->getAlignment()->setHorizontal('center');
                
        $objPHPExcel->getActiveSheet()->getStyle("R".$baris)->getFill()
                    ->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)
                    ->getStartColor()->setARGB('13DFE4');
        $objPHPExcel->getActiveSheet()->getStyle("R".$baris)->getAlignment()->setHorizontal('center');
                
        $objPHPExcel->getActiveSheet()->getStyle("S".$baris)->getFill()
                    ->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)
                    ->getStartColor()->setARGB('13DFE4');
        $objPHPExcel->getActiveSheet()->getStyle("S".$baris)->getAlignment()->setHorizontal('center');
                
        $objPHPExcel->getActiveSheet()->getStyle("T".$baris)->getFill()
                    ->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)
                    ->getStartColor()->setARGB('13DFE4');
        $objPHPExcel->getActiveSheet()->getStyle("T".$baris)->getAlignment()->setHorizontal('center');
                
        $objPHPExcel->getActiveSheet()->getStyle("U".$baris)->getFill()
                    ->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)
                    ->getStartColor()->setARGB('13DFE4');
        $objPHPExcel->getActiveSheet()->getStyle("U".$baris)->getAlignment()->setHorizontal('center');
                
        $objPHPExcel->getActiveSheet()->getStyle("V".$baris)->getFill()
                    ->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)
                    ->getStartColor()->setARGB('13DFE4');
        $objPHPExcel->getActiveSheet()->getStyle("V".$baris)->getAlignment()->setHorizontal('center');

        $objPHPExcel->getActiveSheet()->getStyle("W".$baris)->getFill()
                    ->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)
                    ->getStartColor()->setARGB('13DFE4');
        $objPHPExcel->getActiveSheet()->getStyle("W".$baris)->getAlignment()->setHorizontal('center');
                
        $objPHPExcel->getActiveSheet()->getStyle("X".$baris)->getFill()
                    ->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)
                    ->getStartColor()->setARGB('13DFE4');
        $objPHPExcel->getActiveSheet()->getStyle("X".$baris)->getAlignment()->setHorizontal('center');
                
        $objPHPExcel->getActiveSheet()->getStyle("Y".$baris)->getFill()
                    ->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)
                    ->getStartColor()->setARGB('13DFE4');
        $objPHPExcel->getActiveSheet()->getStyle("Y".$baris)->getAlignment()->setHorizontal('center');
        
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
                $ld = $_data->launch;
                $ld2 = $_data->years;
            }elseif($launch!=NULL){
                $ld=$_data['tgl_launch'];
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
                ->setCellValue('R'.$pertama, $_data['competitor'])
                ->setCellValue('S'.$pertama, $_data['aisle'])
                ->setCellValue('T'.$pertama, $_data['product_form'])
                ->setCellValue('U'.$pertama, $_data['tarkon'])
                ->setCellValue('V'.$pertama, $_data['prefered_flavour'])
                ->setCellValue('W'.$pertama, $_data['product_benefits'])
                ->setCellValue('X'.$pertama, $_data['mandatory_ingredient'])
                ->setCellValue('Y'.$pertama, $_data['serving_suggestion']);
            $pertama++;
        }
        $no++;
        $objPHPExcel->getActiveSheet()->setTitle('Tabulasi My Project PKP');

        // Create a new worksheet2
        $objPHPExcel->createSheet();
        $objPHPExcel->setActiveSheetIndex(1); 
        $objPHPExcel->getActiveSheet(1)->getColumnDimension('A')->setWidth(5.00);
        $objPHPExcel->getActiveSheet(1)->getColumnDimension('B')->setWidth(30.71);
        $objPHPExcel->getActiveSheet(1)->getColumnDimension('C')->setWidth(10.67);
        $objPHPExcel->getActiveSheet(1)->getColumnDimension('D')->setWidth(10.67);
        $objPHPExcel->getActiveSheet(1)->getColumnDimension('E')->setWidth(4.00);
        $objPHPExcel->getActiveSheet(1)->getColumnDimension('F')->setWidth(4.00);

        $objPHPExcel->getActiveSheet(1)->getColumnDimension('G')->setWidth(4.5);
        $objPHPExcel->getActiveSheet(1)->getColumnDimension('H')->setWidth(4.14);
        $objPHPExcel->getActiveSheet(1)->getColumnDimension('I')->setWidth(4.5);
        $objPHPExcel->getActiveSheet(1)->getColumnDimension('J')->setWidth(4.5);
        $objPHPExcel->getActiveSheet(1)->getColumnDimension('K')->setWidth(4.57);
        $objPHPExcel->getActiveSheet(1)->getColumnDimension('L')->setWidth(4.71);

        $objPHPExcel->getActiveSheet(1)->getColumnDimension('M')->setWidth(4.71);
        $objPHPExcel->getActiveSheet(1)->getColumnDimension('N')->setWidth(4.67);
        $objPHPExcel->getActiveSheet(1)->getColumnDimension('O')->setWidth(15.14);
        $objPHPExcel->getActiveSheet(1)->getColumnDimension('P')->setWidth(15.5);

        $satu=1;
        $value=2;

        if(Auth::user()->departement_id!='1'){
            $for=data_forecast::join('tippu','tippu.id','data_forecash.id_pkp')
                ->join('pkp_project','tippu.id_pkp','pkp_project.id_project')
                ->join('data_kemas','data_kemas.id_kemas','data_forecash.kemas_eksis')
                ->where('tujuankirim',Auth::user()->departement_id)
                ->where('status_freeze','inactive')->where('status_project','!=','revisi')
                ->where('status_data','=','active')
                ->where('status_project','!=','draf')->orderBy('pkp_number','asc')->get();
        }elseif(Auth::user()->departement_id=='1'){
            $for=data_forecast::join('tippu','tippu.id','data_forecash.id_pkp')
                ->join('pkp_project','tippu.id_pkp','pkp_project.id_project')
                ->join('data_kemas','data_kemas.id_kemas','data_forecash.kemas_eksis')
                ->where('tujuankirim2',Auth::user()->departement_id)
                ->where('status_freeze','inactive')->where('status_project','!=','revisi')
                ->where('status_data','=','active')
                ->where('status_project','!=','draf')->orderBy('pkp_number','asc')->get(); 
        }
        $number=1;

        // Add some data to the second sheet, resembling some different data types
        $objPHPExcel->setActiveSheetIndex(1);
        $objPHPExcel->getActiveSheet()->setCellValue('A1', 'PKP Number');
        $objPHPExcel->getActiveSheet()->setCellValue('C1', 'Forecash');
        $objPHPExcel->getActiveSheet()->setCellValue('E1', 'UOM');
        $objPHPExcel->getActiveSheet()->setCellValue('G1', 'Kemas');
        $objPHPExcel->getActiveSheet()->setCellValue('O1', 'NFI Price');
        $objPHPExcel->getActiveSheet()->setCellValue('P1', 'Costumer Price');

        // pkp number
        $objPHPExcel->getActiveSheet()->mergeCells('A1:B1');
        $objPHPExcel->setActiveSheetIndex(1)
                    ->setCellValue('A1', 'PKP Number');
        $objPHPExcel->getActiveSheet()->getStyle("A1")->getFill()
                    ->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)
                    ->getStartColor()->setARGB('13DFE4');
        $objPHPExcel->getActiveSheet()->getStyle("A1")->getAlignment()->setHorizontal('center');

        // FORECASH
        $objPHPExcel->getActiveSheet()->mergeCells('C1:D1');
        $objPHPExcel->setActiveSheetIndex(1)
                    ->setCellValue('C1', 'FORECASH');
        $objPHPExcel->getActiveSheet()->getStyle("C1")->getFill()
                    ->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)
                    ->getStartColor()->setARGB('13DFE4');
        $objPHPExcel->getActiveSheet()->getStyle("C1")->getAlignment()->setHorizontal('center');
                
        // uom
        $objPHPExcel->getActiveSheet()->mergeCells('E1:F1');
        $objPHPExcel->setActiveSheetIndex(1)
                    ->setCellValue('E1', 'UOM');
        $objPHPExcel->getActiveSheet()->getStyle("E1")->getFill()
                    ->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)
                    ->getStartColor()->setARGB('13DFE4');
        $objPHPExcel->getActiveSheet()->getStyle("E1")->getAlignment()->setHorizontal('center');

        // Kemas
        $objPHPExcel->getActiveSheet()->mergeCells('G1:N1');
        $objPHPExcel->setActiveSheetIndex(1)
                    ->setCellValue('G1', 'Konfigurasi Kemas');
        $objPHPExcel->getActiveSheet()->getStyle("G1")->getFill()
                    ->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)
                    ->getStartColor()->setARGB('13DFE4');
        $objPHPExcel->getActiveSheet()->getStyle("G1")->getAlignment()->setHorizontal('center');

        // NFI price
        $objPHPExcel->getActiveSheet()->getStyle("O1")->getFill()
                    ->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)
                    ->getStartColor()->setARGB('13DFE4');
        $objPHPExcel->getActiveSheet()->getStyle("O1")->getAlignment()->setHorizontal('center');
                
        // Costumer Price
        $objPHPExcel->getActiveSheet()->getStyle("P1")->getFill()
                    ->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)
                    ->getStartColor()->setARGB('13DFE4');
        $objPHPExcel->getActiveSheet()->getStyle("P1")->getAlignment()->setHorizontal('center');

        foreach($for as $_for){
            $objPHPExcel->setActiveSheetIndex(1)
                        ->setCellValue('A'.$value, $_for['pkp_number'])
                        ->setCellValue('B'.$value, $_for['ket_no'])
                        ->setCellValue('C'.$value, $_for['forecast'])
                        ->setCellValue('D'.$value, $_for['satuan'])
                        ->setCellValue('E'.$value, $_for['jlh_uom'])
                        ->setCellValue('F'.$value, $_for['uom'])
                        ->setCellValue('G'.$value, $_for['tersier'])
                        ->setCellValue('H'.$value, $_for['s_tersier'])
                        ->setCellValue('I'.$value, $_for['sekunder1'])
                        ->setCellValue('J'.$value, $_for['s_sekunder1'])
                        ->setCellValue('K'.$value, $_for['sekunder2'])
                        ->setCellValue('L'.$value, $_for['s_sekunder2'])
                        ->setCellValue('M'.$value, $_for['primer'])
                        ->setCellValue('N'.$value, $_for['s_primer'])
                        ->setCellValue('O'.$value, $_for['nfi_price'])
                        ->setCellValue('P'.$value, $_for['costumer']);
                         $value++;
        }
        // Rename 2nd sheet
        $objPHPExcel->getActiveSheet()->setTitle('Forecash');

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
        $objPHPExcel->getActiveSheet()->getColumnDimension('F')->setWidth(10.00);

        $objPHPExcel->getActiveSheet()->getColumnDimension('G')->setWidth(15.5);
        $objPHPExcel->getActiveSheet()->getColumnDimension('H')->setWidth(18.14);
        $objPHPExcel->getActiveSheet()->getColumnDimension('I')->setWidth(9.5);
        $objPHPExcel->getActiveSheet()->getColumnDimension('J')->setWidth(26.5);
        $objPHPExcel->getActiveSheet()->getColumnDimension('K')->setWidth(14.57);
        $objPHPExcel->getActiveSheet()->getColumnDimension('L')->setWidth(14.71);

        $objPHPExcel->getActiveSheet()->getColumnDimension('M')->setWidth(14.57);
        $objPHPExcel->getActiveSheet()->getColumnDimension('N')->setWidth(30.57);
        $objPHPExcel->getActiveSheet()->getColumnDimension('O')->setWidth(25.71);
        $objPHPExcel->getActiveSheet()->getColumnDimension('P')->setWidth(30.67);
        $objPHPExcel->getActiveSheet()->getColumnDimension('Q')->setWidth(12.14);

        $objPHPExcel->getActiveSheet()->getColumnDimension('R')->setWidth(12.5);
        $objPHPExcel->getActiveSheet()->getColumnDimension('S')->setWidth(10.57);
        $objPHPExcel->getActiveSheet()->getColumnDimension('T')->setWidth(10.57);
        $objPHPExcel->getActiveSheet()->getColumnDimension('U')->setWidth(24.71);
        $objPHPExcel->getActiveSheet()->getColumnDimension('V')->setWidth(14.67);

        $pertama=2;

        $data=coba::join('pdf_project','pdf_project.id_project_pdf','tipu.pdf_id')
            ->join('users','users.id','tipu.perevisi')->where('status_pdf','=','active')
            ->where('status_freeze','inactive')->where('status_project','!=','revisi')
            ->where('status_project','!=','draf')->orderBy('pdf_number','asc')->get();
        $no=1;
        
        $styleArray = array(
            'background'  => array(
            'color' => array('rgb' => 'FF0000'),
         ));

        //Bagian Isi
        $baris=1;
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
            ->setCellValue('M'.$baris, 'Gender')
            ->setCellValue('N'.$baris, 'Other')
            ->setCellValue('O'.$baris, 'Background')
            ->setCellValue('P'.$baris, 'Attractiveness')
            ->setCellValue('Q'.$baris, 'Weight')
            ->setCellValue('R'.$baris, 'Satuan')
            ->setCellValue('S'.$baris, 'Claim')
            ->setCellValue('T'.$baris, 'Inggredient')
            ->setCellValue('U'.$baris, 'RTO')
            ->setCellValue('V'.$baris, 'Whats Special');
                            
            $objPHPExcel->getActiveSheet()->mergeCells('A'.$baris.':B'.$baris);
            $objPHPExcel->setActiveSheetIndex(0)
                        ->setCellValue('A'.$baris, 'PKP Number');

            $objPHPExcel->getActiveSheet()->getStyle("A".$baris)->getFill()
            ->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)
            ->getStartColor()->setARGB('13DFE4');

            $objPHPExcel->getActiveSheet()->getStyle("A".$baris)->getAlignment()->setHorizontal('center');
            
            $objPHPExcel->getActiveSheet()->getStyle("C".$baris)->getFill()
                        ->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)
                        ->getStartColor()->setARGB('13DFE4');
            $objPHPExcel->getActiveSheet()->getStyle("C".$baris)->getAlignment()->setHorizontal('center');
            
            $objPHPExcel->getActiveSheet()->getStyle("D".$baris)->getFill()
                        ->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)
                        ->getStartColor()->setARGB('13DFE4');
            $objPHPExcel->getActiveSheet()->getStyle("D".$baris)->getAlignment()->setHorizontal('center');

            $objPHPExcel->getActiveSheet()->getStyle("E".$baris)->getFill()
                        ->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)
                        ->getStartColor()->setARGB('13DFE4');
            $objPHPExcel->getActiveSheet()->getStyle("E".$baris)->getAlignment()->setHorizontal('center');
            
            $objPHPExcel->getActiveSheet()->getStyle("F".$baris)->getFill()
                        ->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)
                        ->getStartColor()->setARGB('13DFE4');
            $objPHPExcel->getActiveSheet()->getStyle("F".$baris)->getAlignment()->setHorizontal('center');

            $objPHPExcel->getActiveSheet()->getStyle("G".$baris)->getFill()
                        ->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)
                        ->getStartColor()->setARGB('13DFE4');
            $objPHPExcel->getActiveSheet()->getStyle("G".$baris)->getAlignment()->setHorizontal('center');
            
            $objPHPExcel->getActiveSheet()->getStyle("H".$baris)->getFill()
                        ->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)
                        ->getStartColor()->setARGB('13DFE4');
            $objPHPExcel->getActiveSheet()->getStyle("H".$baris)->getAlignment()->setHorizontal('center');
            
            $objPHPExcel->getActiveSheet()->getStyle("I".$baris)->getFill()
                        ->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)
                        ->getStartColor()->setARGB('13DFE4');
            $objPHPExcel->getActiveSheet()->getStyle("I".$baris)->getAlignment()->setHorizontal('center');
            
            $objPHPExcel->getActiveSheet()->getStyle("J".$baris)->getFill()
                        ->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)
                        ->getStartColor()->setARGB('13DFE4');
            $objPHPExcel->getActiveSheet()->getStyle("J".$baris)->getAlignment()->setHorizontal('center');
            
            $objPHPExcel->getActiveSheet()->getStyle("K".$baris)->getFill()
                        ->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)
                        ->getStartColor()->setARGB('13DFE4');
            $objPHPExcel->getActiveSheet()->getStyle("K".$baris)->getAlignment()->setHorizontal('center');
            
            $objPHPExcel->getActiveSheet()->getStyle("L".$baris)->getFill()
                        ->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)
                        ->getStartColor()->setARGB('13DFE4');
            $objPHPExcel->getActiveSheet()->getStyle("L".$baris)->getAlignment()->setHorizontal('center');
            
            $objPHPExcel->getActiveSheet()->getStyle("M".$baris)->getFill()
                        ->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)
                        ->getStartColor()->setARGB('13DFE4');
            $objPHPExcel->getActiveSheet()->getStyle("M".$baris)->getAlignment()->setHorizontal('center');
            
            $objPHPExcel->getActiveSheet()->getStyle("N".$baris)->getFill()
                        ->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)
                        ->getStartColor()->setARGB('13DFE4');
            $objPHPExcel->getActiveSheet()->getStyle("N".$baris)->getAlignment()->setHorizontal('center');
                
            $objPHPExcel->getActiveSheet()->getStyle("O".$baris)->getFill()
                        ->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)
                        ->getStartColor()->setARGB('13DFE4');
            $objPHPExcel->getActiveSheet()->getStyle("O".$baris)->getAlignment()->setHorizontal('center');
            
            $objPHPExcel->getActiveSheet()->getStyle("P".$baris)->getFill()
                        ->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)
                        ->getStartColor()->setARGB('13DFE4');
            $objPHPExcel->getActiveSheet()->getStyle("P".$baris)->getAlignment()->setHorizontal('center');
            
            $objPHPExcel->getActiveSheet()->getStyle("Q".$baris)->getFill()
                        ->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)
                        ->getStartColor()->setARGB('13DFE4');
            $objPHPExcel->getActiveSheet()->getStyle("Q".$baris)->getAlignment()->setHorizontal('center');
            
            $objPHPExcel->getActiveSheet()->getStyle("R".$baris)->getFill()
                        ->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)
                        ->getStartColor()->setARGB('13DFE4');
            $objPHPExcel->getActiveSheet()->getStyle("R".$baris)->getAlignment()->setHorizontal('center');
            
            $objPHPExcel->getActiveSheet()->getStyle("S".$baris)->getFill()
                        ->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)
                        ->getStartColor()->setARGB('13DFE4');
            $objPHPExcel->getActiveSheet()->getStyle("S".$baris)->getAlignment()->setHorizontal('center');
            
            $objPHPExcel->getActiveSheet()->getStyle("T".$baris)->getFill()
                        ->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)
                        ->getStartColor()->setARGB('13DFE4');
            $objPHPExcel->getActiveSheet()->getStyle("T".$baris)->getAlignment()->setHorizontal('center');
            
            $objPHPExcel->getActiveSheet()->getStyle("U".$baris)->getFill()
                        ->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)
                        ->getStartColor()->setARGB('13DFE4');
            $objPHPExcel->getActiveSheet()->getStyle("U".$baris)->getAlignment()->setHorizontal('center');
            
            $objPHPExcel->getActiveSheet()->getStyle("V".$baris)->getFill()
                        ->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)
                        ->getStartColor()->setARGB('13DFE4');
            $objPHPExcel->getActiveSheet()->getStyle("V".$baris)->getAlignment()->setHorizontal('center');
            
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
                ->setCellValue('M'.$pertama, $_data['gender'])
                ->setCellValue('N'.$pertama, $_data['other'])
                ->setCellValue('O'.$pertama, $_data['background'])
                ->setCellValue('P'.$pertama, $_data['attractiveness'])
                ->setCellValue('Q'.$pertama, $_data['wight'])
                ->setCellValue('R'.$pertama, $_data['serving'])
                ->setCellValue('S'.$pertama, $_data['claim'])
                ->setCellValue('T'.$pertama, $_data['ingredient'])
                ->setCellValue('U'.$pertama, $_data['rto'])
                ->setCellValue('V'.$pertama, $_data['special']);
            $pertama++;
        }
        $no++;
        $objPHPExcel->getActiveSheet()->setTitle('Tabulasi PDF');

        // Create a new worksheet2
        $objPHPExcel->createSheet();
        $objPHPExcel->setActiveSheetIndex(1); 
        $objPHPExcel->getActiveSheet(1)->getColumnDimension('A')->setWidth(5.00);
        $objPHPExcel->getActiveSheet(1)->getColumnDimension('B')->setWidth(30.71);
        $objPHPExcel->getActiveSheet(1)->getColumnDimension('C')->setWidth(10.67);
        $objPHPExcel->getActiveSheet(1)->getColumnDimension('D')->setWidth(10.67);
        $objPHPExcel->getActiveSheet(1)->getColumnDimension('E')->setWidth(4.00);
        $objPHPExcel->getActiveSheet(1)->getColumnDimension('F')->setWidth(4.00);

        $objPHPExcel->getActiveSheet(1)->getColumnDimension('G')->setWidth(4.5);
        $objPHPExcel->getActiveSheet(1)->getColumnDimension('H')->setWidth(4.14);
        $objPHPExcel->getActiveSheet(1)->getColumnDimension('I')->setWidth(4.5);
        $objPHPExcel->getActiveSheet(1)->getColumnDimension('J')->setWidth(4.5);
        $objPHPExcel->getActiveSheet(1)->getColumnDimension('K')->setWidth(4.57);
        $objPHPExcel->getActiveSheet(1)->getColumnDimension('L')->setWidth(4.71);

        $objPHPExcel->getActiveSheet(1)->getColumnDimension('M')->setWidth(4.71);
        $objPHPExcel->getActiveSheet(1)->getColumnDimension('N')->setWidth(4.67);
        $objPHPExcel->getActiveSheet(1)->getColumnDimension('O')->setWidth(15.14);
        $objPHPExcel->getActiveSheet(1)->getColumnDimension('P')->setWidth(15.5);

        $satu=1;
        $value=2;
        
        $for=data_forecast::join('tipu','tipu.id','data_forecash.id_pdf')
            ->join('pdf_project','tipu.pdf_id','pdf_project.id_project_pdf')
            ->join('data_kemas','data_kemas.id_kemas','data_forecash.kemas_eksis')
            ->where('status_freeze','inactive')->where('status_project','!=','revisi')
            ->where('status_pdf','active')->where('status_project','!=','draf')->get();
        $number=1;

        // Add some data to the second sheet, resembling some different data types
        $objPHPExcel->setActiveSheetIndex(1);
        $objPHPExcel->getActiveSheet()->setCellValue('A1', 'PDF Number');
        $objPHPExcel->getActiveSheet()->setCellValue('C1', 'Forecash');
        $objPHPExcel->getActiveSheet()->setCellValue('E1', 'UOM');
        $objPHPExcel->getActiveSheet()->setCellValue('G1', 'Kemas');
        $objPHPExcel->getActiveSheet()->setCellValue('O1', 'NFI Price');
        $objPHPExcel->getActiveSheet()->setCellValue('P1', 'Costumer Price');

        // pkp number
        $objPHPExcel->getActiveSheet()->mergeCells('A1:B1');
        $objPHPExcel->setActiveSheetIndex(1)
                    ->setCellValue('A1', 'PDF Number');
        $objPHPExcel->getActiveSheet()->getStyle("A1")->getFill()
                    ->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)
                    ->getStartColor()->setARGB('13DFE4');
        $objPHPExcel->getActiveSheet()->getStyle("A1")->getAlignment()->setHorizontal('center');

        // FORECASH
        $objPHPExcel->getActiveSheet()->mergeCells('C1:D1');
        $objPHPExcel->setActiveSheetIndex(1)
                    ->setCellValue('C1', 'FORECASH');
        $objPHPExcel->getActiveSheet()->getStyle("C1")->getFill()
                    ->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)
                    ->getStartColor()->setARGB('13DFE4');
        $objPHPExcel->getActiveSheet()->getStyle("C1")->getAlignment()->setHorizontal('center');
                
        // uom
        $objPHPExcel->getActiveSheet()->mergeCells('E1:F1');
        $objPHPExcel->setActiveSheetIndex(1)
                    ->setCellValue('E1', 'UOM');
        $objPHPExcel->getActiveSheet()->getStyle("E1")->getFill()
                    ->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)
                    ->getStartColor()->setARGB('13DFE4');
        $objPHPExcel->getActiveSheet()->getStyle("E1")->getAlignment()->setHorizontal('center');

        // Kemas
        $objPHPExcel->getActiveSheet()->mergeCells('G1:N1');
        $objPHPExcel->setActiveSheetIndex(1)
                    ->setCellValue('G1', 'Konfigurasi Kemas');
        $objPHPExcel->getActiveSheet()->getStyle("G1")->getFill()
                    ->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)
                    ->getStartColor()->setARGB('13DFE4');
        $objPHPExcel->getActiveSheet()->getStyle("G1")->getAlignment()->setHorizontal('center');

        // NFI price
        $objPHPExcel->getActiveSheet()->getStyle("O1")->getFill()
                    ->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)
                    ->getStartColor()->setARGB('13DFE4');
        $objPHPExcel->getActiveSheet()->getStyle("O1")->getAlignment()->setHorizontal('center');
                
        // Costumer Price
        $objPHPExcel->getActiveSheet()->getStyle("P1")->getFill()
                    ->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)
                    ->getStartColor()->setARGB('13DFE4');
        $objPHPExcel->getActiveSheet()->getStyle("P1")->getAlignment()->setHorizontal('center');

        foreach($for as $_for){
            $objPHPExcel->setActiveSheetIndex(1)
                        ->setCellValue('A'.$value, $_for['pdf_number'])
                        ->setCellValue('B'.$value, $_for['ket_no'])
                        ->setCellValue('C'.$value, $_for['forecast'])
                        ->setCellValue('D'.$value, $_for['satuan'])
                        ->setCellValue('E'.$value, $_for['jlh_uom'])
                        ->setCellValue('F'.$value, $_for['uom'])
                        ->setCellValue('G'.$value, $_for['tersier'])
                        ->setCellValue('H'.$value, $_for['s_tersier'])
                        ->setCellValue('I'.$value, $_for['sekunder1'])
                        ->setCellValue('J'.$value, $_for['s_sekunder1'])
                        ->setCellValue('K'.$value, $_for['sekunder2'])
                        ->setCellValue('L'.$value, $_for['s_sekunder2'])
                        ->setCellValue('M'.$value, $_for['primer'])
                        ->setCellValue('N'.$value, $_for['s_primer'])
                        ->setCellValue('O'.$value, $_for['nfi_price'])
                        ->setCellValue('P'.$value, $_for['costumer']);
                         $value++;
        }
        // Rename 2nd sheet
        $objPHPExcel->getActiveSheet()->setTitle('Forecash');

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
        $objPHPExcel->getActiveSheet()->getColumnDimension('F')->setWidth(10.00);

        $objPHPExcel->getActiveSheet()->getColumnDimension('G')->setWidth(15.5);
        $objPHPExcel->getActiveSheet()->getColumnDimension('H')->setWidth(18.14);
        $objPHPExcel->getActiveSheet()->getColumnDimension('I')->setWidth(9.5);
        $objPHPExcel->getActiveSheet()->getColumnDimension('J')->setWidth(26.5);
        $objPHPExcel->getActiveSheet()->getColumnDimension('K')->setWidth(14.57);
        $objPHPExcel->getActiveSheet()->getColumnDimension('L')->setWidth(14.71);

        $objPHPExcel->getActiveSheet()->getColumnDimension('M')->setWidth(14.57);
        $objPHPExcel->getActiveSheet()->getColumnDimension('N')->setWidth(30.57);
        $objPHPExcel->getActiveSheet()->getColumnDimension('O')->setWidth(25.71);
        $objPHPExcel->getActiveSheet()->getColumnDimension('P')->setWidth(30.67);
        $objPHPExcel->getActiveSheet()->getColumnDimension('Q')->setWidth(12.14);

        $objPHPExcel->getActiveSheet()->getColumnDimension('R')->setWidth(12.5);
        $objPHPExcel->getActiveSheet()->getColumnDimension('S')->setWidth(10.57);
        $objPHPExcel->getActiveSheet()->getColumnDimension('T')->setWidth(10.57);
        $objPHPExcel->getActiveSheet()->getColumnDimension('U')->setWidth(24.71);
        $objPHPExcel->getActiveSheet()->getColumnDimension('V')->setWidth(14.67);

        $pertama=2;

        if(Auth::user()->departement_id!='1'){
            $data=coba::join('pdf_project','pdf_project.id_project_pdf','tipu.pdf_id')
            ->join('users','users.id','tipu.perevisi')->where('status_pdf','=','active')
            ->where('tujuankirim',Auth::user()->departement_id)
            ->where('status_freeze','inactive')->where('status_project','!=','revisi')
            ->where('status_project','!=','draf')->orderBy('pdf_number','asc')->get();
            $no=1;
        }elseif(Auth::user()->departement_id=='1'){
            $data=coba::join('pdf_project','pdf_project.id_project_pdf','tipu.pdf_id')
            ->join('users','users.id','tipu.perevisi')->where('status_pdf','=','active')
            ->where('tujuankirim2',Auth::user()->departement_id)
            ->where('status_freeze','inactive')->where('status_project','!=','revisi')
            ->where('status_project','!=','draf')->orderBy('pdf_number','asc')->get();
            $no=1;  
        }
        
        $styleArray = array(
            'background'  => array(
            'color' => array('rgb' => 'FF0000'),
        ));

        //Bagian Isi
        $baris=1;
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
            ->setCellValue('M'.$baris, 'Gender')
            ->setCellValue('N'.$baris, 'Other')
            ->setCellValue('O'.$baris, 'Background')
            ->setCellValue('P'.$baris, 'Attractiveness')
            ->setCellValue('Q'.$baris, 'Weight')
            ->setCellValue('R'.$baris, 'Satuan')
            ->setCellValue('S'.$baris, 'Claim')
            ->setCellValue('T'.$baris, 'Inggredient')
            ->setCellValue('U'.$baris, 'RTO')
            ->setCellValue('V'.$baris, 'Whats Special');
                            
        $objPHPExcel->getActiveSheet()->mergeCells('A'.$baris.':B'.$baris);
        $objPHPExcel->setActiveSheetIndex(0)
                    ->setCellValue('A'.$baris, 'PDF Number');

        $objPHPExcel->getActiveSheet()->getStyle("A".$baris)->getFill()
        ->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)
        ->getStartColor()->setARGB('13DFE4');

        $objPHPExcel->getActiveSheet()->getStyle("A".$baris)->getAlignment()->setHorizontal('center');
            
        $objPHPExcel->getActiveSheet()->getStyle("C".$baris)->getFill()
                    ->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)
                    ->getStartColor()->setARGB('13DFE4');
        $objPHPExcel->getActiveSheet()->getStyle("C".$baris)->getAlignment()->setHorizontal('center');
            
        $objPHPExcel->getActiveSheet()->getStyle("D".$baris)->getFill()
                    ->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)
                    ->getStartColor()->setARGB('13DFE4');
        $objPHPExcel->getActiveSheet()->getStyle("D".$baris)->getAlignment()->setHorizontal('center');

        $objPHPExcel->getActiveSheet()->getStyle("E".$baris)->getFill()
                    ->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)
                    ->getStartColor()->setARGB('13DFE4');
        $objPHPExcel->getActiveSheet()->getStyle("E".$baris)->getAlignment()->setHorizontal('center');
                
        $objPHPExcel->getActiveSheet()->getStyle("F".$baris)->getFill()
                    ->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)
                    ->getStartColor()->setARGB('13DFE4');
        $objPHPExcel->getActiveSheet()->getStyle("F".$baris)->getAlignment()->setHorizontal('center');

        $objPHPExcel->getActiveSheet()->getStyle("G".$baris)->getFill()
                    ->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)
                    ->getStartColor()->setARGB('13DFE4');
        $objPHPExcel->getActiveSheet()->getStyle("G".$baris)->getAlignment()->setHorizontal('center');
        
        $objPHPExcel->getActiveSheet()->getStyle("H".$baris)->getFill()
                    ->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)
                    ->getStartColor()->setARGB('13DFE4');
        $objPHPExcel->getActiveSheet()->getStyle("H".$baris)->getAlignment()->setHorizontal('center');
        
        $objPHPExcel->getActiveSheet()->getStyle("I".$baris)->getFill()
                    ->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)
                    ->getStartColor()->setARGB('13DFE4');
        $objPHPExcel->getActiveSheet()->getStyle("I".$baris)->getAlignment()->setHorizontal('center');
            
        $objPHPExcel->getActiveSheet()->getStyle("J".$baris)->getFill()
                    ->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)
                    ->getStartColor()->setARGB('13DFE4');
        $objPHPExcel->getActiveSheet()->getStyle("J".$baris)->getAlignment()->setHorizontal('center');
            
        $objPHPExcel->getActiveSheet()->getStyle("K".$baris)->getFill()
                    ->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)
                    ->getStartColor()->setARGB('13DFE4');
        $objPHPExcel->getActiveSheet()->getStyle("K".$baris)->getAlignment()->setHorizontal('center');
        
        $objPHPExcel->getActiveSheet()->getStyle("L".$baris)->getFill()
                    ->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)
                    ->getStartColor()->setARGB('13DFE4');
        $objPHPExcel->getActiveSheet()->getStyle("L".$baris)->getAlignment()->setHorizontal('center');
            
        $objPHPExcel->getActiveSheet()->getStyle("M".$baris)->getFill()
                    ->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)
                    ->getStartColor()->setARGB('13DFE4');
        $objPHPExcel->getActiveSheet()->getStyle("M".$baris)->getAlignment()->setHorizontal('center');
        
        $objPHPExcel->getActiveSheet()->getStyle("N".$baris)->getFill()
                    ->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)
                    ->getStartColor()->setARGB('13DFE4');
        $objPHPExcel->getActiveSheet()->getStyle("N".$baris)->getAlignment()->setHorizontal('center');
        
        $objPHPExcel->getActiveSheet()->getStyle("O".$baris)->getFill()
                    ->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)
                    ->getStartColor()->setARGB('13DFE4');
        $objPHPExcel->getActiveSheet()->getStyle("O".$baris)->getAlignment()->setHorizontal('center');
            
        $objPHPExcel->getActiveSheet()->getStyle("P".$baris)->getFill()
                    ->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)
                    ->getStartColor()->setARGB('13DFE4');
        $objPHPExcel->getActiveSheet()->getStyle("P".$baris)->getAlignment()->setHorizontal('center');
        
        $objPHPExcel->getActiveSheet()->getStyle("Q".$baris)->getFill()
                    ->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)
                    ->getStartColor()->setARGB('13DFE4');
        $objPHPExcel->getActiveSheet()->getStyle("Q".$baris)->getAlignment()->setHorizontal('center');
        
        $objPHPExcel->getActiveSheet()->getStyle("R".$baris)->getFill()
                    ->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)
                    ->getStartColor()->setARGB('13DFE4');
        $objPHPExcel->getActiveSheet()->getStyle("R".$baris)->getAlignment()->setHorizontal('center');
            
        $objPHPExcel->getActiveSheet()->getStyle("S".$baris)->getFill()
                    ->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)
                    ->getStartColor()->setARGB('13DFE4');
        $objPHPExcel->getActiveSheet()->getStyle("S".$baris)->getAlignment()->setHorizontal('center');
        
        $objPHPExcel->getActiveSheet()->getStyle("T".$baris)->getFill()
                    ->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)
                    ->getStartColor()->setARGB('13DFE4');
        $objPHPExcel->getActiveSheet()->getStyle("T".$baris)->getAlignment()->setHorizontal('center');
            
        $objPHPExcel->getActiveSheet()->getStyle("U".$baris)->getFill()
                    ->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)
                    ->getStartColor()->setARGB('13DFE4');
        $objPHPExcel->getActiveSheet()->getStyle("U".$baris)->getAlignment()->setHorizontal('center');
        
        $objPHPExcel->getActiveSheet()->getStyle("V".$baris)->getFill()
                    ->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)
                    ->getStartColor()->setARGB('13DFE4');
        $objPHPExcel->getActiveSheet()->getStyle("V".$baris)->getAlignment()->setHorizontal('center');
        
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
            ->setCellValue('M'.$pertama, $_data['gender'])
            ->setCellValue('N'.$pertama, $_data['other'])
            ->setCellValue('O'.$pertama, $_data['background'])
            ->setCellValue('P'.$pertama, $_data['attractiveness'])
            ->setCellValue('Q'.$pertama, $_data['wight'])
            ->setCellValue('R'.$pertama, $_data['serving'])
            ->setCellValue('S'.$pertama, $_data['claim'])
            ->setCellValue('T'.$pertama, $_data['ingredient'])
            ->setCellValue('U'.$pertama, $_data['rto'])
            ->setCellValue('V'.$pertama, $_data['special']);
            $pertama++;
        }
        $no++;

        $objPHPExcel->getActiveSheet()->setTitle('Tabulasi My PDF');

        // Create a new worksheet2
        $objPHPExcel->createSheet();
        $objPHPExcel->setActiveSheetIndex(1); 
        $objPHPExcel->getActiveSheet(1)->getColumnDimension('A')->setWidth(5.00);
        $objPHPExcel->getActiveSheet(1)->getColumnDimension('B')->setWidth(30.71);
        $objPHPExcel->getActiveSheet(1)->getColumnDimension('C')->setWidth(10.67);
        $objPHPExcel->getActiveSheet(1)->getColumnDimension('D')->setWidth(10.67);
        $objPHPExcel->getActiveSheet(1)->getColumnDimension('E')->setWidth(4.00);
        $objPHPExcel->getActiveSheet(1)->getColumnDimension('F')->setWidth(4.00);

        $objPHPExcel->getActiveSheet(1)->getColumnDimension('G')->setWidth(4.5);
        $objPHPExcel->getActiveSheet(1)->getColumnDimension('H')->setWidth(4.14);
        $objPHPExcel->getActiveSheet(1)->getColumnDimension('I')->setWidth(4.5);
        $objPHPExcel->getActiveSheet(1)->getColumnDimension('J')->setWidth(4.5);
        $objPHPExcel->getActiveSheet(1)->getColumnDimension('K')->setWidth(4.57);
        $objPHPExcel->getActiveSheet(1)->getColumnDimension('L')->setWidth(4.71);

        $objPHPExcel->getActiveSheet(1)->getColumnDimension('M')->setWidth(4.71);
        $objPHPExcel->getActiveSheet(1)->getColumnDimension('N')->setWidth(4.67);
        $objPHPExcel->getActiveSheet(1)->getColumnDimension('O')->setWidth(15.14);
        $objPHPExcel->getActiveSheet(1)->getColumnDimension('P')->setWidth(15.5);

        $satu=1;
        $value=2;

        if(Auth::user()->departement_id!='1'){
            $for=data_forecast::join('tipu','tipu.id','data_forecash.id_pdf')
                ->join('pdf_project','tipu.pdf_id','pdf_project.id_project_pdf')
                ->join('data_kemas','data_kemas.id_kemas','data_forecash.kemas_eksis')
                ->where('tujuankirim',Auth::user()->departement_id)
                ->where('status_freeze','inactive')->where('status_project','!=','revisi')
                ->where('status_project','!=','draf')->where('status_pdf','active')->orderBy('pdf_number','asc')->get();
        }elseif(Auth::user()->departement_id=='1'){
            $for=data_forecast::join('tipu','tipu.id','data_forecash.id_pdf')
                ->join('pdf_project','tipu.pdf_id','pdf_project.id_project_pdf')
                ->join('data_kemas','data_kemas.id_kemas','data_forecash.kemas_eksis')
                ->where('tujuankirim2',Auth::user()->departement_id)
                ->where('status_freeze','inactive')->where('status_project','!=','revisi')
                ->where('status_project','!=','draf')->where('status_pdf','active')->orderBy('pdf_number','asc')->get();
        }
        $number=1;

        // Add some data to the second sheet, resembling some different data types
        $objPHPExcel->setActiveSheetIndex(1);
        $objPHPExcel->getActiveSheet()->setCellValue('A1', 'PDF Number');
            $objPHPExcel->getActiveSheet()->setCellValue('C1', 'Forecash');
        $objPHPExcel->getActiveSheet()->setCellValue('E1', 'UOM');
        $objPHPExcel->getActiveSheet()->setCellValue('G1', 'Kemas');
        $objPHPExcel->getActiveSheet()->setCellValue('O1', 'NFI Price');
        $objPHPExcel->getActiveSheet()->setCellValue('P1', 'Costumer Price');

        // pkp number
        $objPHPExcel->getActiveSheet()->mergeCells('A1:B1');
        $objPHPExcel->setActiveSheetIndex(1)
                    ->setCellValue('A1', 'PKP Number');
        $objPHPExcel->getActiveSheet()->getStyle("A1")->getFill()
                    ->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)
                    ->getStartColor()->setARGB('13DFE4');
        $objPHPExcel->getActiveSheet()->getStyle("A1")->getAlignment()->setHorizontal('center');

        // FORECASH
        $objPHPExcel->getActiveSheet()->mergeCells('C1:D1');
        $objPHPExcel->setActiveSheetIndex(1)
                    ->setCellValue('C1', 'FORECASH');
        $objPHPExcel->getActiveSheet()->getStyle("C1")->getFill()
                    ->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)
                    ->getStartColor()->setARGB('13DFE4');
        $objPHPExcel->getActiveSheet()->getStyle("C1")->getAlignment()->setHorizontal('center');
                    
        // uom
        $objPHPExcel->getActiveSheet()->mergeCells('E1:F1');
        $objPHPExcel->setActiveSheetIndex(1)
                    ->setCellValue('E1', 'UOM');
        $objPHPExcel->getActiveSheet()->getStyle("E1")->getFill()
                    ->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)
                    ->getStartColor()->setARGB('13DFE4');
        $objPHPExcel->getActiveSheet()->getStyle("E1")->getAlignment()->setHorizontal('center');

        // Kemas
        $objPHPExcel->getActiveSheet()->mergeCells('G1:N1');
        $objPHPExcel->setActiveSheetIndex(1)
                    ->setCellValue('G1', 'Konfigurasi Kemas');
        $objPHPExcel->getActiveSheet()->getStyle("G1")->getFill()
                    ->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)
                    ->getStartColor()->setARGB('13DFE4');
        $objPHPExcel->getActiveSheet()->getStyle("G1")->getAlignment()->setHorizontal('center');

        // NFI price
        $objPHPExcel->getActiveSheet()->getStyle("O1")->getFill()
                    ->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)
                    ->getStartColor()->setARGB('13DFE4');
        $objPHPExcel->getActiveSheet()->getStyle("O1")->getAlignment()->setHorizontal('center');
                
        // Costumer Price
        $objPHPExcel->getActiveSheet()->getStyle("P1")->getFill()
                    ->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)
                    ->getStartColor()->setARGB('13DFE4');
        $objPHPExcel->getActiveSheet()->getStyle("P1")->getAlignment()->setHorizontal('center');

        foreach($for as $_for){
            $objPHPExcel->setActiveSheetIndex(1)
                        ->setCellValue('A'.$value, $_for['pdf_number'])
                        ->setCellValue('B'.$value, $_for['ket_no'])
                        ->setCellValue('C'.$value, $_for['forecast'])
                        ->setCellValue('D'.$value, $_for['satuan'])
                        ->setCellValue('E'.$value, $_for['jlh_uom'])
                        ->setCellValue('F'.$value, $_for['uom'])
                        ->setCellValue('G'.$value, $_for['tersier'])
                        ->setCellValue('H'.$value, $_for['s_tersier'])
                        ->setCellValue('I'.$value, $_for['sekunder1'])
                        ->setCellValue('J'.$value, $_for['s_sekunder1'])
                        ->setCellValue('K'.$value, $_for['sekunder2'])
                        ->setCellValue('L'.$value, $_for['s_sekunder2'])
                        ->setCellValue('M'.$value, $_for['primer'])
                        ->setCellValue('N'.$value, $_for['s_primer'])
                        ->setCellValue('O'.$value, $_for['nfi_price'])
                        ->setCellValue('P'.$value, $_for['costumer']);
            $value++;
        }
        // Rename 2nd sheet
        $objPHPExcel->getActiveSheet()->setTitle('Forecash');
        $skrg=date('d m Y');

        header('Content-Type: application/vnd.ms-excel'); 
        header('Content-Disposition: attachment;filename="Tabulasi_My_PDF '.$skrg.'.xls"'); 

        header('Cache-Control: max-age=0'); 
        $objWriter = \PhpOffice\PhpSpreadsheet\IOFactory::createWriter($objPHPExcel, "Xlsx");
        ob_end_clean();
        $objWriter->save('php://output');
    }
}