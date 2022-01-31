<?php

namespace App\Http\Controllers\RDkemas;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
class TempKemasController extends Controller
{
    public function download_template(){ // download template kemas
        $objPHPExcel = new Spreadsheet();
        $objPHPExcel->setActiveSheetIndex(0); 

        $objPHPExcel->getActiveSheet()->getColumnDimension('A')->setWidth(15.00);
        $objPHPExcel->getActiveSheet()->getColumnDimension('B')->setWidth(15.00);
        $objPHPExcel->getActiveSheet()->getColumnDimension('C')->setWidth(15.00);
        $objPHPExcel->getActiveSheet()->getColumnDimension('D')->setWidth(15.00);
        $objPHPExcel->getActiveSheet()->getColumnDimension('E')->setWidth(18.00);
        $objPHPExcel->getActiveSheet()->getColumnDimension('F')->setWidth(23.00);
        $objPHPExcel->getActiveSheet()->getColumnDimension('G')->setWidth(18.00);
        $objPHPExcel->getActiveSheet()->getColumnDimension('H')->setWidth(18.00);

        $objPHPExcel->getActiveSheet()->getColumnDimension('I')->setWidth(18.00);
        $objPHPExcel->getActiveSheet()->getColumnDimension('J')->setWidth(18.00);
        $objPHPExcel->getActiveSheet()->getColumnDimension('K')->setWidth(18.00);
        $objPHPExcel->getActiveSheet()->getColumnDimension('L')->setWidth(18.00);
        $objPHPExcel->getActiveSheet()->getColumnDimension('M')->setWidth(18.00);
        $objPHPExcel->getActiveSheet()->getColumnDimension('N')->setWidth(18.00);

        $objPHPExcel->getActiveSheet()->getColumnDimension('O')->setWidth(18.00);
        $objPHPExcel->getActiveSheet()->getColumnDimension('P')->setWidth(18.00);
        $objPHPExcel->getActiveSheet()->getColumnDimension('Q')->setWidth(18.00);
        $objPHPExcel->getActiveSheet()->getColumnDimension('R')->setWidth(18.00);
        $objPHPExcel->getActiveSheet()->getColumnDimension('S')->setWidth(18.00);
        $objPHPExcel->getActiveSheet()->getColumnDimension('T')->setWidth(18.00);

        $objPHPExcel->getActiveSheet()->getColumnDimension('U')->setWidth(18.00);
        $objPHPExcel->getActiveSheet()->getColumnDimension('V')->setWidth(18.00);
        $objPHPExcel->getActiveSheet()->getColumnDimension('W')->setWidth(18.00);
        $objPHPExcel->getActiveSheet()->getColumnDimension('X')->setWidth(18.00);
        $objPHPExcel->getActiveSheet()->getColumnDimension('Y')->setWidth(18.00);

        $objPHPExcel->getActiveSheet()->mergeCells('A1:Y1');
        $objPHPExcel->setActiveSheetIndex(0)
                    ->setCellValue('A1', 'Sebelum di upload harap baris 1 dan 2 di hapus terlebih dahulu!!');
        $objPHPExcel->getActiveSheet()->getStyle('A1:V1')->getAlignment()->setHorizontal('center');

        $objPHPExcel->setActiveSheetIndex(0)
                    ->setCellValue('A2', 'Status(New/Eksis)')
                    ->setCellValue('B2', 'Shelf life')
                    ->setCellValue('C2', 'Item Code')
                    ->setCellValue('D2', 'Kode Komputer')
                    ->setCellValue('E2', 'Description')
                    ->setCellValue('F2', 'Dimensi / Jml Pemakaian')
                    ->setCellValue('G2', 'Spek')
                    ->setCellValue('H2', 'supplier')
                    ->setCellValue('I2', 'Min.Order')
                    ->setCellValue('J2', 'Harga/UOM')
                    ->setCellValue('K2', 'Cost Kemas')
                    ->setCellValue('L2', 'Line Mesin')
                    ->setCellValue('M2', 'Dus Net')
                    ->setCellValue('N2', 'Box Net')
                    ->setCellValue('O2', 'Batch Net')
                    ->setCellValue('P2', 'Unit')
                    ->setCellValue('Q2', 'Dus Net UOM')
                    ->setCellValue('R2', 'Box Net UOM')
                    ->setCellValue('S2', 'Batch Net UOM')
                    ->setCellValue('T2', 'Unit')
                    ->setCellValue('U2', 'Waste')
                    ->setCellValue('V2', 'Cost kemas/box')
                    ->setCellValue('W2', 'Cost kemas/dus')
                    ->setCellValue('X2', 'Cost kemas/bag')
                    ->setCellValue('Y2', 'Cost kemas/UOM');
        $objPHPExcel->getActiveSheet()->getStyle('A2:W2')->getAlignment()->setHorizontal('center');

        $objPHPExcel->getActiveSheet()->setTitle('TEMPLATE KEMAS');
        $skrg = date('d m Y');
                header('Content-Type: application/vnd.ms-excel'); 
                header('Content-Disposition: attachment;filename="Template_Upload_Kemas'.$skrg.'.xls"'); 
                header('Cache-Control: max-age=0'); 
        $objWriter = \PhpOffice\PhpSpreadsheet\IOFactory::createWriter($objPHPExcel, "Xlsx");
        ob_end_clean();
        $objWriter->save('php://output');
    }
}