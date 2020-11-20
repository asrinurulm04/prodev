<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\IOFactory;

use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use Illuminate\Support\Facades\Validator;
use App\pkp\tipp;
use App\pkp\coba;
use App\pkp\pdf_project;
use App\pkp\pkp_project;
use DB;
use Auth;

class cetakController extends Controller
{
    public function download_project(){

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


        $awal=1;
        $pertama=2;

        $data=tipp::join('pkp_project','pkp_project.id_project','tippu.id_pkp')
            ->join('tarkons','tarkons.id_tarkon','tippu.akg')
            ->join('users','users.id','tippu.perevisi')
            ->join('data_kemas','data_kemas.id_kemas','tippu.kemas_eksis')->where('status_data','=','active')
            ->where('status_freeze','inactive')->where('status_project','!=','revisi')
            ->where('status_project','!=','draf')->orderBy('pkp_number','asc')->get();
        $no=1;
        
        
            //Inisialisasi tanggal kosong
        
            $styleArray = array(
                'background'  => array(
                    'color' => array('rgb' => 'FF0000'),
                ));


                //Bagian Isi
        
                $baris=$awal;
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

                $objPHPExcel->getActiveSheet()->mergeCells('X'.$baris.':AE'.$baris);
                $objPHPExcel->setActiveSheetIndex(0)
                            ->setCellValue('AE'.$baris, 'Kemas');

                $objPHPExcel->getActiveSheet()->getStyle("X".$baris)->getFill()
                ->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)
                ->getStartColor()->setARGB('13DFE4');

                $objPHPExcel->getActiveSheet()->getStyle("X".$baris)->getAlignment()->setHorizontal('center');
                
                $objPHPExcel->getActiveSheet()->getStyle("AF".$baris)->getFill()
                            ->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)
                            ->getStartColor()->setARGB('13DFE4');
                $objPHPExcel->getActiveSheet()->getStyle("AF".$baris)->getAlignment()->setHorizontal('center');
                
                $objPHPExcel->getActiveSheet()->getStyle("AG".$baris)->getFill()
                            ->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)
                            ->getStartColor()->setARGB('13DFE4');
                $objPHPExcel->getActiveSheet()->getStyle("AG".$baris)->getAlignment()->setHorizontal('center');
                
                $objPHPExcel->getActiveSheet()->getStyle("AH".$baris)->getFill()
                            ->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)
                            ->getStartColor()->setARGB('13DFE4');
                $objPHPExcel->getActiveSheet()->getStyle("AH".$baris)->getAlignment()->setHorizontal('center');
                
                $objPHPExcel->getActiveSheet()->getStyle("AI".$baris)->getFill()
                            ->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)
                            ->getStartColor()->setARGB('13DFE4');
                $objPHPExcel->getActiveSheet()->getStyle("AI".$baris)->getAlignment()->setHorizontal('center');
                
                $objPHPExcel->getActiveSheet()->getStyle("AJ".$baris)->getFill()
                            ->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)
                            ->getStartColor()->setARGB('13DFE4');
                $objPHPExcel->getActiveSheet()->getStyle("AJ".$baris)->getAlignment()->setHorizontal('center');
                
        
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


        $awal=1;
        $pertama=2;

        if(Auth::user()->departement_id!='1'){
        $data=pkp_project::join('tippu','pkp_project.id_project','tippu.id_pkp')
            ->join('tarkons','tarkons.id_tarkon','tippu.akg')
            ->join('users','users.id','tippu.perevisi')
            ->join('data_kemas','data_kemas.id_kemas','tippu.kemas_eksis')
            ->where('tujuankirim',Auth::user()->departement_id)
            ->where('status_freeze','inactive')->where('status_project','!=','revisi')
            ->where('status_data','=','active')
            ->where('status_project','!=','draf')->orderBy('pkp_number','asc')->get();
        $no=1;
        }elseif(Auth::user()->departement_id=='1'){
            $data=pkp_project::join('tippu','pkp_project.id_project','tippu.id_pkp')
            ->join('tarkons','tarkons.id_tarkon','tippu.akg')
            ->join('users','users.id','tippu.perevisi')
            ->join('data_kemas','data_kemas.id_kemas','tippu.kemas_eksis')
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


                //Bagian Isi
        
                $baris=$awal;
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

                $objPHPExcel->getActiveSheet()->mergeCells('X'.$baris.':AE'.$baris);
                $objPHPExcel->setActiveSheetIndex(0)
                            ->setCellValue('AE'.$baris, 'Kemas');

                $objPHPExcel->getActiveSheet()->getStyle("X".$baris)->getFill()
                ->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)
                ->getStartColor()->setARGB('13DFE4');

                $objPHPExcel->getActiveSheet()->getStyle("X".$baris)->getAlignment()->setHorizontal('center');
                
                $objPHPExcel->getActiveSheet()->getStyle("AF".$baris)->getFill()
                            ->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)
                            ->getStartColor()->setARGB('13DFE4');
                $objPHPExcel->getActiveSheet()->getStyle("AF".$baris)->getAlignment()->setHorizontal('center');
                
                $objPHPExcel->getActiveSheet()->getStyle("AG".$baris)->getFill()
                            ->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)
                            ->getStartColor()->setARGB('13DFE4');
                $objPHPExcel->getActiveSheet()->getStyle("AG".$baris)->getAlignment()->setHorizontal('center');
                
                $objPHPExcel->getActiveSheet()->getStyle("AH".$baris)->getFill()
                            ->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)
                            ->getStartColor()->setARGB('13DFE4');
                $objPHPExcel->getActiveSheet()->getStyle("AH".$baris)->getAlignment()->setHorizontal('center');
                
                $objPHPExcel->getActiveSheet()->getStyle("AI".$baris)->getFill()
                            ->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)
                            ->getStartColor()->setARGB('13DFE4');
                $objPHPExcel->getActiveSheet()->getStyle("AI".$baris)->getAlignment()->setHorizontal('center');
                
                $objPHPExcel->getActiveSheet()->getStyle("AJ".$baris)->getFill()
                            ->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)
                            ->getStartColor()->setARGB('13DFE4');
                $objPHPExcel->getActiveSheet()->getStyle("AJ".$baris)->getAlignment()->setHorizontal('center');
                
        
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
        $objPHPExcel->getActiveSheet()->getColumnDimension('F')->setWidth(10.00);

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

        $data=coba::join('pdf_project','pdf_project.id_project_pdf','tipu.pdf_id')
            ->join('users','users.id','tipu.perevisi')
            ->join('data_kemas','data_kemas.id_kemas','tipu.kemas_eksis')
            ->join('pkp_type','pkp_type.id','pdf_project.id_type')->where('status_pdf','=','active')
            ->where('status_freeze','inactive')->where('status_project','!=','revisi')
            ->where('status_project','!=','draf')->orderBy('pdf_number','asc')->get();
        $no=1;
        
        
            //Inisialisasi tanggal kosong
        
            $styleArray = array(
                'background'  => array(
                    'color' => array('rgb' => 'FF0000'),
                ));


                //Bagian Isi
        
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

                $objPHPExcel->getActiveSheet()->mergeCells('M'.$baris.':T'.$baris);
                $objPHPExcel->setActiveSheetIndex(0)
                            ->setCellValue('T'.$baris, 'Kemas');

                $objPHPExcel->getActiveSheet()->getStyle("M".$baris)->getFill()
                ->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)
                ->getStartColor()->setARGB('13DFE4');

                $objPHPExcel->getActiveSheet()->getStyle("M".$baris)->getAlignment()->setHorizontal('center');
                
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
                
                $objPHPExcel->getActiveSheet()->getStyle("Z".$baris)->getFill()
                            ->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)
                            ->getStartColor()->setARGB('13DFE4');
                $objPHPExcel->getActiveSheet()->getStyle("Z".$baris)->getAlignment()->setHorizontal('center');
                
                $objPHPExcel->getActiveSheet()->getStyle("AA".$baris)->getFill()
                            ->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)
                            ->getStartColor()->setARGB('13DFE4');
                $objPHPExcel->getActiveSheet()->getStyle("AA".$baris)->getAlignment()->setHorizontal('center');
                
                $objPHPExcel->getActiveSheet()->getStyle("AB".$baris)->getFill()
                            ->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)
                            ->getStartColor()->setARGB('13DFE4');
                $objPHPExcel->getActiveSheet()->getStyle("AB".$baris)->getAlignment()->setHorizontal('center');
                
                $objPHPExcel->getActiveSheet()->getStyle("AC".$baris)->getFill()
                            ->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)
                            ->getStartColor()->setARGB('13DFE4');
                $objPHPExcel->getActiveSheet()->getStyle("AC".$baris)->getAlignment()->setHorizontal('center');
                
                $objPHPExcel->getActiveSheet()->getStyle("AD".$baris)->getFill()
                            ->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)
                            ->getStartColor()->setARGB('13DFE4');
                $objPHPExcel->getActiveSheet()->getStyle("AD".$baris)->getAlignment()->setHorizontal('center');
                
                $objPHPExcel->getActiveSheet()->getStyle("AE".$baris)->getFill()
                            ->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)
                            ->getStartColor()->setARGB('13DFE4');
                $objPHPExcel->getActiveSheet()->getStyle("AE".$baris)->getAlignment()->setHorizontal('center');
                
                $objPHPExcel->getActiveSheet()->getStyle("AF".$baris)->getFill()
                            ->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)
                            ->getStartColor()->setARGB('13DFE4');
                $objPHPExcel->getActiveSheet()->getStyle("AF".$baris)->getAlignment()->setHorizontal('center');
                
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
        $objPHPExcel->getActiveSheet()->getColumnDimension('F')->setWidth(10.00);

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
            $data=coba::join('pdf_project','pdf_project.id_project_pdf','tipu.pdf_id')
            ->join('users','users.id','tipu.perevisi')
            ->join('data_kemas','data_kemas.id_kemas','tipu.kemas_eksis')
            ->join('pkp_type','pkp_type.id','pdf_project.id_type')->where('status_pdf','=','active')
            ->where('tujuankirim',Auth::user()->departement_id)
            ->where('status_freeze','inactive')->where('status_project','!=','revisi')
            ->where('status_project','!=','draf')->orderBy('pdf_number','asc')->get();
            $no=1;
        }elseif(Auth::user()->departement_id=='1'){
            $data=coba::join('pdf_project','pdf_project.id_project_pdf','tipu.pdf_id')
            ->join('users','users.id','tipu.perevisi')
            ->join('data_kemas','data_kemas.id_kemas','tipu.kemas_eksis')
            ->join('pkp_type','pkp_type.id','pdf_project.id_type')->where('status_pdf','=','active')
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

                $objPHPExcel->getActiveSheet()->mergeCells('M'.$baris.':T'.$baris);
                $objPHPExcel->setActiveSheetIndex(0)
                            ->setCellValue('T'.$baris, 'Kemas');

                $objPHPExcel->getActiveSheet()->getStyle("M".$baris)->getFill()
                ->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)
                ->getStartColor()->setARGB('13DFE4');

                $objPHPExcel->getActiveSheet()->getStyle("M".$baris)->getAlignment()->setHorizontal('center');
                
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
                
                $objPHPExcel->getActiveSheet()->getStyle("Z".$baris)->getFill()
                            ->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)
                            ->getStartColor()->setARGB('13DFE4');
                $objPHPExcel->getActiveSheet()->getStyle("Z".$baris)->getAlignment()->setHorizontal('center');
                
                $objPHPExcel->getActiveSheet()->getStyle("AA".$baris)->getFill()
                            ->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)
                            ->getStartColor()->setARGB('13DFE4');
                $objPHPExcel->getActiveSheet()->getStyle("AA".$baris)->getAlignment()->setHorizontal('center');
                
                $objPHPExcel->getActiveSheet()->getStyle("AB".$baris)->getFill()
                            ->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)
                            ->getStartColor()->setARGB('13DFE4');
                $objPHPExcel->getActiveSheet()->getStyle("AB".$baris)->getAlignment()->setHorizontal('center');
                
                $objPHPExcel->getActiveSheet()->getStyle("AC".$baris)->getFill()
                            ->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)
                            ->getStartColor()->setARGB('13DFE4');
                $objPHPExcel->getActiveSheet()->getStyle("AC".$baris)->getAlignment()->setHorizontal('center');
                
                $objPHPExcel->getActiveSheet()->getStyle("AD".$baris)->getFill()
                            ->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)
                            ->getStartColor()->setARGB('13DFE4');
                $objPHPExcel->getActiveSheet()->getStyle("AD".$baris)->getAlignment()->setHorizontal('center');
                
                $objPHPExcel->getActiveSheet()->getStyle("AE".$baris)->getFill()
                            ->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)
                            ->getStartColor()->setARGB('13DFE4');
                $objPHPExcel->getActiveSheet()->getStyle("AE".$baris)->getAlignment()->setHorizontal('center');
                
                $objPHPExcel->getActiveSheet()->getStyle("AF".$baris)->getFill()
                            ->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)
                            ->getStartColor()->setARGB('13DFE4');
                $objPHPExcel->getActiveSheet()->getStyle("AF".$baris)->getAlignment()->setHorizontal('center');
                
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

        $objPHPExcel->getActiveSheet()->setTitle('Tabulasi My PDF');

        $skrg=date('d m Y');

        header('Content-Type: application/vnd.ms-excel'); 
        header('Content-Disposition: attachment;filename="Tabulasi_My_PDF '.$skrg.'.xls"'); 

        header('Cache-Control: max-age=0'); 
        $objWriter = \PhpOffice\PhpSpreadsheet\IOFactory::createWriter($objPHPExcel, "Xlsx");
        ob_end_clean();
        $objWriter->save('php://output');
    }
}