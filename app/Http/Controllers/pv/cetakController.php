<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\IOFactory;

use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use Illuminate\Support\Facades\Validator;
use App\pkp\tipp;
use App\pkp\pkp_project;
use DB;

class cetakController extends Controller
{
    public function download_project(){

        $objPHPExcel = new Spreadsheet();

        $objPHPExcel->setActiveSheetIndex(0); 

        $objPHPExcel->getActiveSheet()->getColumnDimension('A')->setWidth(5.57);
        $objPHPExcel->getActiveSheet()->getColumnDimension('B')->setWidth(25.71);
        $objPHPExcel->getActiveSheet()->getColumnDimension('C')->setWidth(18.67);
        $objPHPExcel->getActiveSheet()->getColumnDimension('D')->setWidth(18.14);
        $objPHPExcel->getActiveSheet()->getColumnDimension('E')->setWidth(9.5);

        $objPHPExcel->getActiveSheet()->getColumnDimension('F')->setWidth(12.57);
        $objPHPExcel->getActiveSheet()->getColumnDimension('G')->setWidth(12.71);
        $objPHPExcel->getActiveSheet()->getColumnDimension('H')->setWidth(14.67);
        $objPHPExcel->getActiveSheet()->getColumnDimension('I')->setWidth(21.14);
        $objPHPExcel->getActiveSheet()->getColumnDimension('J')->setWidth(15.5);

        $objPHPExcel->getActiveSheet()->getColumnDimension('K')->setWidth(15.57);
        $objPHPExcel->getActiveSheet()->getColumnDimension('L')->setWidth(22.71);
        $objPHPExcel->getActiveSheet()->getColumnDimension('M')->setWidth(15.67);
        $objPHPExcel->getActiveSheet()->getColumnDimension('N')->setWidth(25.14);
        $objPHPExcel->getActiveSheet()->getColumnDimension('O')->setWidth(11.5);
        $objPHPExcel->getActiveSheet()->getColumnDimension('P')->setWidth(12.57);

        $awal=1;
        $pertama=2;

        $data=tipp::join('pkp_project','pkp_project.id_project','tippu.id_pkp')->get();
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
                            ->setCellValue('B'.$baris, 'Project Name')
                            ->setCellValue('C'.$baris, 'Brand')
                            ->setCellValue('D'.$baris, 'Jenis')
                            ->setCellValue('E'.$baris, 'Idea')
                            ->setCellValue('F'.$baris, 'Gender')
                            ->setCellValue('G'.$baris, 'Uniqueness')
                            ->setCellValue('H'.$baris, 'Reason')
                            ->setCellValue('I'.$baris, 'Estimated')
                            ->setCellValue('J'.$baris, 'Competitive')
                            ->setCellValue('K'.$baris, 'Selling Price')
                            ->setCellValue('L'.$baris, 'Competitor')
                            ->setCellValue('M'.$baris, 'Aisle')
                            ->setCellValue('N'.$baris, 'Product Form')
                            ->setCellValue('O'.$baris, 'AKG')
                            ->setCellValue('P'.$baris, 'Kemas')
                            ->setCellValue('Q'.$baris, 'Prefered Flavour')
                            ->setCellValue('R'.$baris, 'Product Benefits')
                            ->setCellValue('S'.$baris, 'Mandatory Ingredient')
                            ->setCellValue('T'.$baris, 'Price')
                            ->setCellValue('U'.$baris, 'UOM')
                            ->setCellValue('V'.$baris, 'Serving Suggestion');
                            
                $objPHPExcel->getActiveSheet()->getStyle("A".$baris)->getFill()
                            ->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)
                            ->getStartColor()->setARGB('13DFE4');
                $objPHPExcel->getActiveSheet()->getStyle("A".$baris)->getAlignment()->setHorizontal('center');

                $objPHPExcel->getActiveSheet()->getStyle("B".$baris)->getFill()
                            ->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)
                            ->getStartColor()->setARGB('13DFE4');
                $objPHPExcel->getActiveSheet()->getStyle("B".$baris)->getAlignment()->setHorizontal('center');
                
                $objPHPExcel->getActiveSheet()->getStyle("c".$baris)->getFill()
                            ->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)
                            ->getStartColor()->setARGB('13DFE4');
                $objPHPExcel->getActiveSheet()->getStyle("c".$baris)->getAlignment()->setHorizontal('center');
                
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
                
                $objPHPExcel->getActiveSheet()->getStyle("p".$baris)->getFill()
                            ->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)
                            ->getStartColor()->setARGB('13DFE4');
                $objPHPExcel->getActiveSheet()->getStyle("p".$baris)->getAlignment()->setHorizontal('center');
                
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
                            ->setCellValue('A'.$pertama, $_data['pkp_number'],$_data['ket_no'])
                            ->setCellValue('B'.$pertama, $_data['project_name'])
                            ->setCellValue('C'.$pertama, $_data['id_brand'])
                            ->setCellValue('D'.$pertama, $_data['jenis'])
                            ->setCellValue('E'.$pertama, $_data['idea'])
                            ->setCellValue('F'.$pertama, $_data['gender'])
                            ->setCellValue('G'.$pertama, $_data['Uniqueness'])
                            ->setCellValue('H'.$pertama, $_data['reason'])
                            ->setCellValue('I'.$pertama, $_data['Estimated'])
                            ->setCellValue('J'.$pertama, $_data['competitive'])
                            ->setCellValue('K'.$pertama, $_data['selling_price'])
                            ->setCellValue('L'.$pertama, $_data['competitor'])
                            ->setCellValue('M'.$pertama, $_data['aisle'])
                            ->setCellValue('N'.$pertama, $_data['product_form'])
                            ->setCellValue('O'.$pertama, $_data['akg'])
                            ->setCellValue('P'.$pertama, $_data['kemas_eksis'])
                            ->setCellValue('K'.$pertama, $_data['prefered_flavour'])
                            ->setCellValue('L'.$pertama, $_data['product_benefits'])
                            ->setCellValue('M'.$pertama, $_data['mandatory_ingredient'])
                            ->setCellValue('N'.$pertama, $_data['price'])
                            ->setCellValue('O'.$pertama, $_data['UOM'])
                            ->setCellValue('P'.$pertama, $_data['serving_suggestion']);
        
                            $pertama++;
                        }
        
            $no++;

        $objPHPExcel->getActiveSheet()->setTitle('Tabulasi PKP');

        $skrg=date('d m Y');

        header('Content-Type: application/vnd.ms-excel'); 
        header('Content-Disposition: attachment;filename="Data_Order'.$skrg.'.xls"'); 

        header('Cache-Control: max-age=0'); 
        $objWriter = \PhpOffice\PhpSpreadsheet\IOFactory::createWriter($objPHPExcel, "Xlsx");
        ob_end_clean();
        $objWriter->save('php://output');
    }
}