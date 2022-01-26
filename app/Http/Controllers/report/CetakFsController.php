<?php

namespace App\Http\Controllers\report;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use Illuminate\Support\Facades\Validator;

use App\model\pkp\PkpProject;
use App\model\pkp\DataPangan;
use App\model\pdf\SubPDF;
use App\model\pdf\ProjectPDF;
use App\model\Modelmaklon\Maklon;
use App\model\feasibility\Feasibility;
use App\model\feasibility\FormPengajuanFS;
use App\model\Modelmesin\Mesin;
use App\model\Modelmesin\LiniTerdampak;
use App\model\Modelkemas\KonsepKemas;
use App\model\formula\Formula;

class CetakFsController extends Controller
{
    public function download_fs($id,$fs){ // download data Overview FS
        $objPHPExcel = new Spreadsheet();
        $objPHPExcel->setActiveSheetIndex(0); 

        $objPHPExcel->getActiveSheet()->getColumnDimension('A')->setWidth(51.00);
        $objPHPExcel->getActiveSheet()->getColumnDimension('B')->setWidth(38.00);

        $pkp        = PkpProject::where('id_project',$id)->join('tr_kemas','tr_kemas.id_kemas','tr_project_pkp.kemas_eksis')->first();
        $pangan     = DataPangan::where('id_pangan',$pkp->bpom)->first();
        $data       = Feasibility::where('id',$fs)->first();
        $maklon     = Maklon::where('id_fs',$fs)->first();
        $form       = FormPengajuanFS::where('id_feasibility',$fs)->first();
        $for        = Formula::where('id',$data->id_formula)->first();
        $mesin      = Mesin::join('ms_mesin','ms_mesin.id_data_mesin','tr_mesin.id_data_mesin')->where('kategori','Filling')
                    ->join('tr_workbook_fs','tr_workbook_fs.id','tr_mesin.id_wb_fs')->where('tr_workbook_fs.status','Sent')->where('id_feasibility',$fs)
                    ->join('tr_feasibility','tr_feasibility.id','tr_workbook_fs.id_feasibility')->select('nama_mesin')->distinct()->get();
        $all        = LiniTerdampak::join('tr_workbook_fs','tr_workbook_fs.id','tr_lini_allergen.id_ws')->where('tr_workbook_fs.status','Sent')
                    ->join('tr_feasibility','tr_feasibility.id','tr_workbook_fs.id_feasibility')->where('id_feasibility',$fs)->first();
        $referensi  = KonsepKemas::join('tr_workbook_fs','tr_workbook_fs.id','tr_datakemas.id_ws')->where('tr_workbook_fs.status','Sent')->where('id_feasibility',$fs)
                    ->join('tr_feasibility','tr_feasibility.id','tr_workbook_fs.id_feasibility')->join('ms_sku','tr_datakemas.referensi','ms_sku.id')->select('nama_sku')->first();
        $lokasi     = Mesin::join('ms_mesin','ms_mesin.id_data_mesin','tr_mesin.id_data_mesin')->where('kategori','!=','Filling')->where('kategori','!=','Packing')
                    ->join('tr_workbook_fs','tr_workbook_fs.id','tr_mesin.id_wb_fs')->join('tr_feasibility','tr_feasibility.id','tr_workbook_fs.id_feasibility')->select('IO')->distinct()->first();
        $lokasi2    = Mesin::join('ms_mesin','ms_mesin.id_data_mesin','tr_mesin.id_data_mesin')->where('kategori','Filling')->orwhere('kategori','Packing')
                    ->join('tr_workbook_fs','tr_workbook_fs.id','tr_mesin.id_wb_fs')->join('tr_feasibility','tr_feasibility.id','tr_workbook_fs.id_feasibility')->select('IO')->distinct()->first();
        $dataLab    = DataLab::where('id_fs',$fs->id)->join('ms_item_desc','ms_item_desc.id','tr_lab.id_item_desc')->first();
        $lab        = ($dataLab->kimia_batch * $formula->batch) + ($dataLab->biaya_tahanan * $formula->batch) + ($dataLab->analisa_swab * $formula->batch) + ($dataLab->mikro_analisa * $formula->batch) + (($dataLab->biaya_analisa * $dataLab->jlh_sample_mikro)* $formula->batch) + $dataLab->biaya_analisa_tahun;
        $analisa    = $lab/$formula->batch;
        $forKemas   = FormulaKemas::join('tr_feasibility','tr_feasibility.id_wb_kemas','tr_formula_kemas.id_ws')->where('id',$fs->id)->where('cost_uom','!=',NULL)->select('cost_uom')->first();
        

        $objPHPExcel->setActiveSheetIndex(0)
                    ->setCellValue('A1', 'Project Overview');
        
        $objPHPExcel->setActiveSheetIndex(0)
                    ->setCellValue('A2', 'Information')
                    ->setCellValue('B2', 'Option');
                            
        $objPHPExcel->getActiveSheet()->mergeCells('A1:B1');
        $objPHPExcel->setActiveSheetIndex(0)
                    ->setCellValue('A1', 'Project Overview');

        $objPHPExcel->getActiveSheet()->getStyle('A1:B1')->getFill()
                    ->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)
                    ->getStartColor()->setARGB('13DFE4');
        $objPHPExcel->getActiveSheet()->getStyle('A1:B1')->getAlignment()->setHorizontal('center');

        $objPHPExcel->getActiveSheet()->getStyle('A2:B2')->getFill()
                    ->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)
                    ->getStartColor()->setARGB('13DFE4');
        $objPHPExcel->getActiveSheet()->getStyle('A2:B2')->getAlignment()->setHorizontal('center');
        $objPHPExcel->getActiveSheet()->getStyle('B3:B40')->getAlignment()->setHorizontal('left');
                
        $launch = $pkp['launch'];
        if($launch!=NULL){
            $ld=' '.$pkp->launch.' '.$pkp->years;
        }
        $kemas = $pkp['kemas_eksis'];
        if($kemas!=NULL){
            $km=' '.$pkp->tersier.' '.$pkp->s_tersier.'X'.$pkp->sekunder1.' '.$pkp->s_sekunder1.'X'.$pkp->sekunder2.' '.$pkp->s_sekunder2.'X'.$pkp->primer.' '.$pkp->s_primer;
        }elseif($kemas==NULL){
            $km='-';
        }
        if($pkp->bpom!=NULL){
            $dp = ' '.$pangan->no_kategori.' '.$pangan->pangan;
        }elseif($pkp->bpom==NULL){
            $dp = '-';
        }
        $objPHPExcel->setActiveSheetIndex(0)
                ->setCellValue('A3', 'Target Launching')
                ->setCellValue('B3', $ld)
                ->setCellValue('A4', 'Project Name')
                ->setCellValue('B4', $pkp['project_name'])
                ->setCellValue('A5', 'Product Name/Desc')
                ->setCellValue('B5', $pkp['idea'])
                ->setCellValue('A6', 'Formula Code')
                ->setCellValue('B6', $for['formula'])
                ->setCellValue('A7', 'Product type (BPOM Category)')
                ->setCellValue('B7', $dp)
                ->setCellValue('A8', 'Packaging configuration')
                ->setCellValue('B8', $km)
                ->setCellValue('A9', 'Product reference :product characteristic')
                ->setCellValue('B9', $form['product_reference'])
                ->setCellValue('A10', 'Product reference :packaging')
                ->setCellValue('B10', $referensi['nama_sku'])
                ->setCellValue('A11', 'Forecast (Rp/ month)')
                ->setCellValue('B11', $form['forecast'])
                ->setCellValue('A12', 'Pricelist (Rp/ UOM)')
                ->setCellValue('B12', $pkp['selling_price'])
                ->setCellValue('A13', 'UoM')
                ->setCellValue('B13', $form['uom'])
                ->setCellValue('A14', 'UoM per BOX')
                ->setCellValue('B14', $pkp['tersier'])
                ->setCellValue('A15', 'Gramasi per UOM (g)')
                ->setCellValue('B15', $form['gramasi_uom'])
                ->setCellValue('A16', 'serving size (g)')
                ->setCellValue('B16', $form['serving_size'])
                ->setCellValue('A17', 'serving/ UOM')
                ->setCellValue('B17', $form['serving_uom'])
                ->setCellValue('A18', 'Batch size (g)')
                ->setCellValue('B18', $form['batch_size'])
                ->setCellValue('A19', 'Batch size granulation (kg)')
                ->setCellValue('B19', $form['batch_granulation'])
                ->setCellValue('A20', 'Yield (%)')
                ->setCellValue('B20', $form['Yield'])
                ->setCellValue('A21', 'BOX per BATCH')
                ->setCellValue('B21', $form['box_batch'])
                ->setCellValue('A22', 'UOM / month')
                ->setCellValue('B22', $form['uom_month'])
                ->setCellValue('A23', 'Batches/month')
                ->setCellValue('B23', $form['Batch_month'])
                ->setCellValue('A24', 'Production Location')
                ->setCellValue('B24', $lokasi['IO'])
                ->setCellValue('A25', 'Fillpack Location')
                ->setCellValue('B25', $lokasi2['IO'])
                ->setCellValue('A26', 'Filling Machine');

            foreach($mesin as $_mesin){   
            $objPHPExcel->setActiveSheetIndex(0)
                        ->setCellValue('B6', $_mesin['nama_mesin']);
                        $pertama++;
            }

            $objPHPExcel->setActiveSheetIndex(0)
                ->setCellValue('A27', 'Cost of Packaging (Rp/UOM)')
                ->setCellValue('B27', $analisa)
                ->setCellValue('A28', 'Cost of Lab/Analysis (Rp/UOM)')
                ->setCellValue('B28', $forKemas->cost_uom)
                ->setCellValue('A29', 'Maklon Fee (Rp/UOM)')
                ->setCellValue('B29', $maklon['biaya_maklon'])
                ->setCellValue('A30', 'Transportation Fee (Rp/UOM)')
                ->setCellValue('B30', $maklon['biaya_transport'])
                ->setCellValue('A31', 'Allergen information | contain')
                ->setCellValue('B31', $all['allergen_baru'])
                ->setCellValue('A32', 'Allergen information | may contain (from the production line)')
                ->setCellValue('B32', $all['my_contain'])
                ->setCellValue('A33', 'Allergen impact to production line')
                ->setCellValue('B33', $all['lini_terdampak'])
                ->setCellValue('A34', 'New Raw Material?')
                ->setCellValue('B34', $form['new_raw_material'])
                ->setCellValue('A35', 'Value of Unprocessed Raw Material per year')
                ->setCellValue('B35', '-')
                ->setCellValue('A36', 'New Packaging Material?')
                ->setCellValue('B36', $form['new_packaging_material'])
                ->setCellValue('A37', 'Value of Unprocessed Packaging Material')
                ->setCellValue('B37', '-')
                ->setCellValue('A38', 'New Machine?')
                ->setCellValue('B38', $form['new_machine'])
                ->setCellValue('A39', 'Need Trial before real packaging?')
                ->setCellValue('B39', $form['trial'])
                ->setCellValue('A40', 'Reff EKP')
                ->setCellValue('B40', $form['ref_ekp']);

        $objPHPExcel->getActiveSheet()->setTitle('Overview');
        $skrg = date('d m Y');
                header('Content-Type: application/vnd.ms-excel'); 
                header('Content-Disposition: attachment;filename="Overview '.$skrg.'.xls"'); 
                header('Cache-Control: max-age=0'); 
        $objWriter = \PhpOffice\PhpSpreadsheet\IOFactory::createWriter($objPHPExcel, "Xlsx");
        ob_end_clean();
        $objWriter->save('php://output');
    }
    
    public function download_fs_pdf($id,$fs){ // download data Overview FS
        $objPHPExcel = new Spreadsheet();
        $objPHPExcel->setActiveSheetIndex(0); 

        $objPHPExcel->getActiveSheet()->getColumnDimension('A')->setWidth(51.00);
        $objPHPExcel->getActiveSheet()->getColumnDimension('B')->setWidth(38.00);

        $pdf        = SubPDF::where('pdf_id',$id)->where('status_pdf','active')->join('tr_pdf_project','tr_pdf_project.id_project_pdf','tr_sub_pdf.pdf_id')
                    ->join('tr_kemas','tr_kemas.id_kemas','tr_sub_pdf.kemas_eksis')->first();
        $data       = Feasibility::where('id',$fs)->first();
        $maklon     = Maklon::where('id_fs',$fs)->first();
        $form       = FormPengajuanFS::where('id_feasibility',$fs)->first();
        $for        = Formula::where('id',$data->id_formula)->first();
        $mesin      = Mesin::join('ms_mesin','ms_mesin.id_data_mesin','tr_mesin.id_data_mesin')->where('kategori','Filling')
                    ->join('tr_workbook_fs','tr_workbook_fs.id','tr_mesin.id_wb_fs')->where('tr_workbook_fs.status','Sent')->where('id_feasibility',$fs)
                    ->join('tr_feasibility','tr_feasibility.id','tr_workbook_fs.id_feasibility')->select('nama_mesin')->distinct()->get();
        $all        = LiniTerdampak::join('tr_workbook_fs','tr_workbook_fs.id','tr_lini_allergen.id_ws')->where('tr_workbook_fs.status','Sent')
                    ->join('tr_feasibility','tr_feasibility.id','tr_workbook_fs.id_feasibility')->where('id_feasibility',$fs)->first();
        $referensi  = KonsepKemas::join('tr_workbook_fs','tr_workbook_fs.id','tr_datakemas.id_ws')->where('tr_workbook_fs.status','Sent')->where('id_feasibility',$fs)
                    ->join('tr_feasibility','tr_feasibility.id','tr_workbook_fs.id_feasibility')->join('ms_sku','tr_datakemas.referensi','ms_sku.id')->select('nama_sku')->first();
        $lokasi     = Mesin::join('ms_mesin','ms_mesin.id_data_mesin','tr_mesin.id_data_mesin')->where('kategori','!=','Filling')->where('kategori','!=','Packing')
                    ->join('tr_workbook_fs','tr_workbook_fs.id','tr_mesin.id_wb_fs')->join('tr_feasibility','tr_feasibility.id','tr_workbook_fs.id_feasibility')->select('IO')->distinct()->first();
        $lokasi2    = Mesin::join('ms_mesin','ms_mesin.id_data_mesin','tr_mesin.id_data_mesin')->where('kategori','Filling')->orwhere('kategori','Packing')
                    ->join('tr_workbook_fs','tr_workbook_fs.id','tr_mesin.id_wb_fs')->join('tr_feasibility','tr_feasibility.id','tr_workbook_fs.id_feasibility')->select('IO')->distinct()->first();
        $dataLab    = DataLab::where('id_fs',$fs->id)->join('ms_item_desc','ms_item_desc.id','tr_lab.id_item_desc')->first();
        $lab        = ($dataLab->kimia_batch * $formula->batch) + ($dataLab->biaya_tahanan * $formula->batch) + ($dataLab->analisa_swab * $formula->batch) + ($dataLab->mikro_analisa * $formula->batch) + (($dataLab->biaya_analisa * $dataLab->jlh_sample_mikro)* $formula->batch) + $dataLab->biaya_analisa_tahun;
        $analisa    = $lab/$formula->batch;
        $forKemas   = FormulaKemas::join('tr_feasibility','tr_feasibility.id_wb_kemas','tr_formula_kemas.id_ws')->where('id',$fs->id)->where('cost_uom','!=',NULL)->select('cost_uom')->first();
        
        $objPHPExcel->setActiveSheetIndex(0)
                    ->setCellValue('A1', 'Project Overview');
        
        $objPHPExcel->setActiveSheetIndex(0)
                    ->setCellValue('A2', 'Information')
                    ->setCellValue('A2', 'Option');
                            
        $objPHPExcel->getActiveSheet()->mergeCells('A1:B1');
        $objPHPExcel->setActiveSheetIndex(0)
                    ->setCellValue('A1', 'Project Overview');

        $objPHPExcel->getActiveSheet()->getStyle('A1:B1')->getFill()
                    ->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)
                    ->getStartColor()->setARGB('13DFE4');
        $objPHPExcel->getActiveSheet()->getStyle('A1:B1')->getAlignment()->setHorizontal('center');

        $objPHPExcel->getActiveSheet()->getStyle('A2:B2')->getFill()
                    ->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)
                    ->getStartColor()->setARGB('13DFE4');
        $objPHPExcel->getActiveSheet()->getStyle('A2:B2')->getAlignment()->setHorizontal('center');
        $objPHPExcel->getActiveSheet()->getStyle('B3:B39')->getAlignment()->setHorizontal('left');
                
        $kemas = $pdf['kemas_eksis'];
        if($kemas!=NULL){
            $km=' '.$pdf->tersier.' '.$pdf->s_tersier.'X'.$pdf->sekunder1.' '.$pdf->s_sekunder1.'X'.$pdf->sekunder2.' '.$pdf->s_sekunder2.'X'.$pdf->primer.' '.$pdf->s_primer;
        }elseif($kemas==NULL){
            $km='-';
        }
        $objPHPExcel->setActiveSheetIndex(0)
                ->setCellValue('A3', 'RTO')
                ->setCellValue('B3', $pdf['rto'])
                ->setCellValue('A4', 'Project Name')
                ->setCellValue('B4', $pdf['project_name'])
                ->setCellValue('A5', 'Product Name/Desc')
                ->setCellValue('B5', $pdf['background'])
                ->setCellValue('A6', 'Formula Code')
                ->setCellValue('B6', $for['formula'])
                ->setCellValue('A7', 'Packaging configuration')
                ->setCellValue('B7', $km)
                ->setCellValue('A8', 'Product reference :product characteristic')
                ->setCellValue('B8', $form['product_reference'])
                ->setCellValue('A9', 'Product reference :packaging')
                ->setCellValue('B9', $referensi['nama_sku'])
                ->setCellValue('A10', 'Forecast (Rp/ month)')
                ->setCellValue('B10', $form['forecast'])
                ->setCellValue('A11', 'Pricelist (Rp/ UOM)')
                ->setCellValue('B11', $pdf['target_price'])
                ->setCellValue('A12', 'UoM')
                ->setCellValue('B12', $form['uom'])
                ->setCellValue('A13', 'UoM per BOX')
                ->setCellValue('B13', $pdf['tersier'])
                ->setCellValue('A14', 'Gramasi per UOM (g)')
                ->setCellValue('B14', $form['gramasi_uom'])
                ->setCellValue('A15', 'serving size (g)')
                ->setCellValue('B15', $form['serving_size'])
                ->setCellValue('A16', 'serving/ UOM')
                ->setCellValue('B16', $form['serving_uom'])
                ->setCellValue('A17', 'Batch size (g)')
                ->setCellValue('B17', $form['batch_size'])
                ->setCellValue('A18', 'Batch size granulation (kg)')
                ->setCellValue('B18', $form['batch_granulation'])
                ->setCellValue('A19', 'Yield (%)')
                ->setCellValue('B19', $form['Yield'])
                ->setCellValue('A20', 'BOX per BATCH')
                ->setCellValue('B20', $form['box_batch'])
                ->setCellValue('A21', 'UOM / month')
                ->setCellValue('B21', $form['uom_month'])
                ->setCellValue('A22', 'Batches/month')
                ->setCellValue('B22', $form['Batch_month'])
                ->setCellValue('A23', 'Production Location')
                ->setCellValue('B23', $lokasi['IO'])
                ->setCellValue('A24', 'Fillpack Location')
                ->setCellValue('B24', $lokasi2['IO'])
                ->setCellValue('A25', 'Filling Machine');

            foreach($mesin as $_mesin){   
            $objPHPExcel->setActiveSheetIndex(0)
                        ->setCellValue('B25', $_mesin['nama_mesin']);
            }

            $objPHPExcel->setActiveSheetIndex(0)
                ->setCellValue('A26', 'Cost of Packaging (Rp/UOM)')
                ->setCellValue('B26', $forKemas->cost_uom)
                ->setCellValue('A27', 'Cost of Lab/Analysis (Rp/UOM)')
                ->setCellValue('B27', $analisa)
                ->setCellValue('A28', 'Maklon Fee (Rp/UOM)')
                ->setCellValue('B28', $maklon['biaya_maklon'])
                ->setCellValue('A29', 'Transportation Fee (Rp/UOM)')
                ->setCellValue('B29', $maklon['biaya_transport'])
                ->setCellValue('A30', 'Allergen information | contain')
                ->setCellValue('B30', $all['allergen_baru'])
                ->setCellValue('A31', 'Allergen information | may contain (from the production line)')
                ->setCellValue('B31', $all['my_contain'])
                ->setCellValue('A32', 'Allergen impact to production line')
                ->setCellValue('B32', $all['lini_terdampak'])
                ->setCellValue('A33', 'New Raw Material?')
                ->setCellValue('B33', $form['new_raw_material'])
                ->setCellValue('A34', 'Value of Unprocessed Raw Material per year')
                ->setCellValue('B34', '-')
                ->setCellValue('A35', 'New Packaging Material?')
                ->setCellValue('B35', $form['new_packaging_material'])
                ->setCellValue('A36', 'Value of Unprocessed Packaging Material')
                ->setCellValue('B36', '-')
                ->setCellValue('A37', 'New Machine?')
                ->setCellValue('B37', $form['new_machine'])
                ->setCellValue('A38', 'Need Trial before real packaging?')
                ->setCellValue('B38', $form['trial'])
                ->setCellValue('A39', 'Reff EKP')
                ->setCellValue('B39', $form['ref_ekp']);

        $objPHPExcel->getActiveSheet()->setTitle('Overview');
        $skrg = date('d m Y');
                header('Content-Type: application/vnd.ms-excel'); 
                header('Content-Disposition: attachment;filename="Overview '.$skrg.'.xls"'); 
                header('Cache-Control: max-age=0'); 
        $objWriter = \PhpOffice\PhpSpreadsheet\IOFactory::createWriter($objPHPExcel, "Xlsx");
        ob_end_clean();
        $objWriter->save('php://output');
    }
}