<?php
namespace App\Http\Controllers\report;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\IOFactory;

use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use Illuminate\Support\Facades\Validator;
use App\model\pkp\tipp;
use App\model\pkp\pkp_project;
use App\model\dev\Formula;
use App\model\dev\Fortail;
use App\model\devnf\allergen_formula;
use DB;

class downloadFORController extends Controller
{
    public function FOR_pkp($formula){

        $objPHPExcel = new Spreadsheet();

        $objPHPExcel->setActiveSheetIndex(0); 

        $objPHPExcel->getActiveSheet()->getColumnDimension('A')->setWidth(6.00);
        $objPHPExcel->getActiveSheet()->getColumnDimension('B')->setWidth(23.00);
        $objPHPExcel->getActiveSheet()->getColumnDimension('C')->setWidth(23.00);
        $objPHPExcel->getActiveSheet()->getColumnDimension('D')->setWidth(23.00);

        $objPHPExcel->getActiveSheet()->getColumnDimension('E')->setWidth(14.00);
        $objPHPExcel->getActiveSheet()->getColumnDimension('F')->setWidth(14.00);
        $objPHPExcel->getActiveSheet()->getColumnDimension('G')->setWidth(9.00);

        $awal=1;
        $pertama=2;

        $data = Formula::where('id',$formula)->join('pkp_project','pkp_project.id_project','=','formulas.workbook_id')->first();
        $allergen_bb = allergen_formula::join('tb_bb_allergen','id_bb','tb_alergen_formula.id_bahan')->where('id_formula',$formula)->where('allergen_countain','!=','')->select(['allergen_countain'])->distinct()->get();
		$fortails = Fortail::where('formula_id',$formula)->get();
        
        $no=1;
        $pertama=8;
        
            $styleArray = array(
                'background'  => array(
                    'color' => array('rgb' => 'FF0000'),
                ));


                //Bagian Isi
        
                $baris=$awal;

                // Baris Pertama
                $objPHPExcel->setActiveSheetIndex(0)
                    ->setCellValue('A1', 'PT. NUTRIFOOD INDONESIA');
                $objPHPExcel->getActiveSheet()->mergeCells('A1:B1');
                $objPHPExcel->setActiveSheetIndex(0)
                            ->setCellValue('A1', 'PT. NUTRIFOOD INDONESIA');
                $objPHPExcel->getActiveSheet()->getStyle("A1")->getAlignment()->setHorizontal('center');

                // Baris Kedua
                $objPHPExcel->setActiveSheetIndex(0)
                    ->setCellValue('A2', 'FORMULA PRODUK');
                $objPHPExcel->getActiveSheet()->mergeCells('A2:G2');
                $objPHPExcel->setActiveSheetIndex(0)
                            ->setCellValue('A2', 'FORMULA PRODUK');
                $objPHPExcel->getActiveSheet()->getStyle("A2")->getAlignment()->setHorizontal('center');

                // Baris ketiga
                $objPHPExcel->setActiveSheetIndex(0)
                    ->setCellValue('A3', '(FOR)');
                $objPHPExcel->getActiveSheet()->mergeCells('A3:G3');
                $objPHPExcel->setActiveSheetIndex(0)
                            ->setCellValue('A3', '(FOR)');
                $objPHPExcel->getActiveSheet()->getStyle("A3")->getAlignment()->setHorizontal('center');
        
                $objPHPExcel->setActiveSheetIndex(0)
                    ->setCellValue('B5', 'Product Name :')
                    ->setCellValue('C5', $data['project_name'])
                    ->setCellValue('E5', 'Created Date :')
                    ->setCellValue('F5', $data['created_at'])
                    ->setCellValue('E6', 'jumlah/batch :')
                    ->setCellValue('F6', $data['batch'])
                    ->setCellValue('G6', 'gr');

                $objPHPExcel->setActiveSheetIndex(0)
                    ->setCellValue('A7', 'No')
                    ->setCellValue('B7', 'Nama Sederhana')
                    ->setCellValue('C7', 'Nama Bahan')
                    ->setCellValue('D7', 'Principal')
                    ->setCellValue('E7', 'PerServing (gr)')
                    ->setCellValue('F7', 'PerBatch (gr)')
                    ->setCellValue('G7', 'Persen');

                
                    $objPHPExcel->getActiveSheet()->getStyle("A7")->getFill()
                                ->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)
                                ->getStartColor()->setARGB('13DFE4');
                    $objPHPExcel->getActiveSheet()->getStyle("A7")->getAlignment()->setHorizontal('center');
                    $objPHPExcel->getActiveSheet()->getStyle("B7")->getFill()
                                ->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)
                                ->getStartColor()->setARGB('13DFE4');
                    $objPHPExcel->getActiveSheet()->getStyle("B7")->getAlignment()->setHorizontal('center');
                    $objPHPExcel->getActiveSheet()->getStyle("C7")->getFill()
                                ->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)
                                ->getStartColor()->setARGB('13DFE4');
                    $objPHPExcel->getActiveSheet()->getStyle("C7")->getAlignment()->setHorizontal('center');
                    $objPHPExcel->getActiveSheet()->getStyle("D7")->getFill()
                                ->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)
                                ->getStartColor()->setARGB('13DFE4');
                    $objPHPExcel->getActiveSheet()->getStyle("D7")->getAlignment()->setHorizontal('center');
                    $objPHPExcel->getActiveSheet()->getStyle("E7")->getFill()
                                ->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)
                                ->getStartColor()->setARGB('13DFE4');
                    $objPHPExcel->getActiveSheet()->getStyle("E7")->getAlignment()->setHorizontal('center');
                    $objPHPExcel->getActiveSheet()->getStyle("F7")->getFill()
                                ->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)
                                ->getStartColor()->setARGB('13DFE4');
                    $objPHPExcel->getActiveSheet()->getStyle("F7")->getAlignment()->setHorizontal('center');
                    $objPHPExcel->getActiveSheet()->getStyle("G7")->getFill()
                                ->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)
                                ->getStartColor()->setARGB('13DFE4');
                    $objPHPExcel->getActiveSheet()->getStyle("G7")->getAlignment()->setHorizontal('center');

                $number = 1;

                foreach($fortails as $_data){
                    $one_persen = $_data->per_batch / $data->batch  ;
                    $persen = $one_persen * 100;
                    $persen = round($persen, 2);

                $line=$pertama;
                $objPHPExcel->setActiveSheetIndex(0)
                    ->setCellValue('A'.$pertama, $number)
                    ->setCellValue('B'.$pertama, $_data['nama_sederhana'])
                    ->setCellValue('C'.$pertama, $_data['nama_bahan'])
                    ->setCellValue('D'.$pertama, $_data['principle'])
                    ->setCellValue('E'.$pertama, $_data['per_serving'])
                    ->setCellValue('F'.$pertama, $_data['per_batch'])
                    ->setCellValue('G'.$pertama, $persen);

                    $count_bahan = 8;
                    for($i = 2;$i<=8;$i++){
                        $ask = 'alternatif'.$i;
                        $ii=$i-1;
                        if($_data->$ask == null){
                            $count_bahan--;
                        }
                    }
                    $count_alternatif = $count_bahan;

                    $kedua = $pertama+1;
                    $n = 1;
                        for($n = 1;$n<=$count_alternatif;$n++){

                            $objPHPExcel->setActiveSheetIndex(0)
                            ->setCellValue('B'.$kedua, $_data['alternatif'.$n])
                            ->setCellValue('C'.$kedua, $_data['nama_bahan'.$n])
                            ->setCellValue('D'.$kedua, $_data['principle'.$n]);
                            $kedua++;
                        }
                    
                $number++;
                $pertama = $pertama+$count_alternatif;
                $pertama++;

                }
                $akhir = $pertama;
                $objPHPExcel->setActiveSheetIndex(0)
                    ->setCellValue('A'.$akhir, 'Jumlah')
                    ->setCellValue('E'.$akhir, $data['serving'])
                    ->setCellValue('F'.$akhir, $data['batch'])
                    ->setCellValue('G'.$akhir, '100 %');

                
                $objPHPExcel->getActiveSheet()->getStyle("A".$akhir)->getFill()
                            ->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)
                            ->getStartColor()->setARGB('aca6a6');
                $objPHPExcel->getActiveSheet()->getStyle("A".$akhir)->getAlignment()->setHorizontal('center');

                $objPHPExcel->getActiveSheet()->getStyle("B".$akhir)->getFill()
                            ->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)
                            ->getStartColor()->setARGB('aca6a6');
                $objPHPExcel->getActiveSheet()->getStyle("B".$akhir)->getAlignment()->setHorizontal('center');
                
                $objPHPExcel->getActiveSheet()->getStyle("C".$akhir)->getFill()
                            ->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)
                            ->getStartColor()->setARGB('aca6a6');
                $objPHPExcel->getActiveSheet()->getStyle("C".$akhir)->getAlignment()->setHorizontal('center');
                
                $objPHPExcel->getActiveSheet()->getStyle("D".$akhir)->getFill()
                            ->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)
                            ->getStartColor()->setARGB('aca6a6');
                $objPHPExcel->getActiveSheet()->getStyle("D".$akhir)->getAlignment()->setHorizontal('center');
                
                $objPHPExcel->getActiveSheet()->getStyle("E".$akhir)->getFill()
                            ->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)
                            ->getStartColor()->setARGB('aca6a6');
                $objPHPExcel->getActiveSheet()->getStyle("E".$akhir)->getAlignment()->setHorizontal('center');

                
                $objPHPExcel->getActiveSheet()->getStyle("F".$akhir)->getFill()
                            ->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)
                            ->getStartColor()->setARGB('aca6a6');
                $objPHPExcel->getActiveSheet()->getStyle("F".$akhir)->getAlignment()->setHorizontal('center');

                
                $objPHPExcel->getActiveSheet()->getStyle("G".$akhir)->getFill()
                            ->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)
                            ->getStartColor()->setARGB('aca6a6');
                $objPHPExcel->getActiveSheet()->getStyle("G".$akhir)->getAlignment()->setHorizontal('center');
                
                $note = $akhir+1;
                $contain = $note+1;
                $objPHPExcel->setActiveSheetIndex(0)
                    ->setCellValue('B'.$note, 'Note Formula :')
                    ->setCellValue('B'.$contain, 'Mengandung Allergen')
                    ->setCellValue('C'.$contain, 'Contain :')
                    ->setCellValue('E'.$contain, 'May Contain :');

                $isi_contain = $contain;
                foreach($allergen_bb as $contain){
                    $objPHPExcel->setActiveSheetIndex(0)
                    ->setCellValue('D'.$isi_contain, $contain['allergen_countain']);
                }

                // Note Formula
                $objPHPExcel->setActiveSheetIndex(0)
                    ->setCellValue('C'.$note, $data['note_formula']);
                $objPHPExcel->getActiveSheet()->mergeCells('C'.$note.':G'.$note);
                $objPHPExcel->setActiveSheetIndex(0)
                            ->setCellValue('C'.$note, $data['note_formula']);
        $objPHPExcel->getActiveSheet()->setTitle('FOR PKP');

        $skrg=date('d m Y');

        header('Content-Type: application/vnd.ms-excel'); 
        header('Content-Disposition: attachment;filename="FOR_PKP '.$skrg.'.xls"'); 

        header('Cache-Control: max-age=0'); 
        $objWriter = \PhpOffice\PhpSpreadsheet\IOFactory::createWriter($objPHPExcel, "Xlsx");
        ob_end_clean();
        $objWriter->save('php://output');
    }

    
    public function FOR_pdf($formula){

        $objPHPExcel = new Spreadsheet();

        $objPHPExcel->setActiveSheetIndex(0); 

        $objPHPExcel->getActiveSheet()->getColumnDimension('A')->setWidth(6.00);
        $objPHPExcel->getActiveSheet()->getColumnDimension('B')->setWidth(23.00);
        $objPHPExcel->getActiveSheet()->getColumnDimension('C')->setWidth(23.00);
        $objPHPExcel->getActiveSheet()->getColumnDimension('D')->setWidth(23.00);

        $objPHPExcel->getActiveSheet()->getColumnDimension('E')->setWidth(14.00);
        $objPHPExcel->getActiveSheet()->getColumnDimension('F')->setWidth(14.00);
        $objPHPExcel->getActiveSheet()->getColumnDimension('G')->setWidth(9.00);

        $awal=1;
        $pertama=2;

        $data = Formula::where('id',$formula)->join('pdf_project','pdf_project.id_project_pdf','=','formulas.workbook_pdf_id')->first();
        $allergen_bb = allergen_formula::join('tb_bb_allergen','id_bb','tb_alergen_formula.id_bahan')->where('id_formula',$formula)->where('allergen_countain','!=','')->select(['allergen_countain'])->distinct()->get();
		$fortails = Fortail::where('formula_id',$formula)->get();
        
        $no=1;
        $pertama=8;
        
            $styleArray = array(
                'background'  => array(
                    'color' => array('rgb' => 'FF0000'),
                ));


                //Bagian Isi
        
                $baris=$awal;

                // Baris Pertama
                $objPHPExcel->setActiveSheetIndex(0)
                    ->setCellValue('A1', 'PT. NUTRIFOOD INDONESIA');
                $objPHPExcel->getActiveSheet()->mergeCells('A1:B1');
                $objPHPExcel->setActiveSheetIndex(0)
                            ->setCellValue('A1', 'PT. NUTRIFOOD INDONESIA');
                $objPHPExcel->getActiveSheet()->getStyle("A1")->getAlignment()->setHorizontal('center');

                // Baris Kedua
                $objPHPExcel->setActiveSheetIndex(0)
                    ->setCellValue('A2', 'FORMULA PRODUK');
                $objPHPExcel->getActiveSheet()->mergeCells('A2:G2');
                $objPHPExcel->setActiveSheetIndex(0)
                            ->setCellValue('A2', 'FORMULA PRODUK');
                $objPHPExcel->getActiveSheet()->getStyle("A2")->getAlignment()->setHorizontal('center');

                // Baris ketiga
                $objPHPExcel->setActiveSheetIndex(0)
                    ->setCellValue('A3', '(FOR)');
                $objPHPExcel->getActiveSheet()->mergeCells('A3:G3');
                $objPHPExcel->setActiveSheetIndex(0)
                            ->setCellValue('A3', '(FOR)');
                $objPHPExcel->getActiveSheet()->getStyle("A3")->getAlignment()->setHorizontal('center');
        
                $objPHPExcel->setActiveSheetIndex(0)
                    ->setCellValue('B5', 'Product Name :')
                    ->setCellValue('C5', $data['project_name'])
                    ->setCellValue('E5', 'Created Date :')
                    ->setCellValue('F5', $data['created_at'])
                    ->setCellValue('E6', 'jumlah/batch :')
                    ->setCellValue('F6', $data['batch'])
                    ->setCellValue('G6', 'gr');

                $objPHPExcel->setActiveSheetIndex(0)
                    ->setCellValue('A7', 'No')
                    ->setCellValue('B7', 'Nama Sederhana')
                    ->setCellValue('C7', 'Nama Bahan')
                    ->setCellValue('D7', 'Principal')
                    ->setCellValue('E7', 'PerServing (gr)')
                    ->setCellValue('F7', 'PerBatch (gr)')
                    ->setCellValue('G7', 'Persen');

                
                    $objPHPExcel->getActiveSheet()->getStyle("A7")->getFill()
                                ->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)
                                ->getStartColor()->setARGB('13DFE4');
                    $objPHPExcel->getActiveSheet()->getStyle("A7")->getAlignment()->setHorizontal('center');
                    $objPHPExcel->getActiveSheet()->getStyle("B7")->getFill()
                                ->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)
                                ->getStartColor()->setARGB('13DFE4');
                    $objPHPExcel->getActiveSheet()->getStyle("B7")->getAlignment()->setHorizontal('center');
                    $objPHPExcel->getActiveSheet()->getStyle("C7")->getFill()
                                ->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)
                                ->getStartColor()->setARGB('13DFE4');
                    $objPHPExcel->getActiveSheet()->getStyle("C7")->getAlignment()->setHorizontal('center');
                    $objPHPExcel->getActiveSheet()->getStyle("D7")->getFill()
                                ->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)
                                ->getStartColor()->setARGB('13DFE4');
                    $objPHPExcel->getActiveSheet()->getStyle("D7")->getAlignment()->setHorizontal('center');
                    $objPHPExcel->getActiveSheet()->getStyle("E7")->getFill()
                                ->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)
                                ->getStartColor()->setARGB('13DFE4');
                    $objPHPExcel->getActiveSheet()->getStyle("E7")->getAlignment()->setHorizontal('center');
                    $objPHPExcel->getActiveSheet()->getStyle("F7")->getFill()
                                ->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)
                                ->getStartColor()->setARGB('13DFE4');
                    $objPHPExcel->getActiveSheet()->getStyle("F7")->getAlignment()->setHorizontal('center');
                    $objPHPExcel->getActiveSheet()->getStyle("G7")->getFill()
                                ->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)
                                ->getStartColor()->setARGB('13DFE4');
                    $objPHPExcel->getActiveSheet()->getStyle("G7")->getAlignment()->setHorizontal('center');

                $number = 1;

                foreach($fortails as $_data){
                    $one_persen = $_data->per_batch / $data->batch  ;
                    $persen = $one_persen * 100;
                    $persen = round($persen, 2);

                $line=$pertama;
                $objPHPExcel->setActiveSheetIndex(0)
                    ->setCellValue('A'.$pertama, $number)
                    ->setCellValue('B'.$pertama, $_data['nama_sederhana'])
                    ->setCellValue('C'.$pertama, $_data['nama_bahan'])
                    ->setCellValue('D'.$pertama, $_data['principle'])
                    ->setCellValue('E'.$pertama, $_data['per_serving'])
                    ->setCellValue('F'.$pertama, $_data['per_batch'])
                    ->setCellValue('G'.$pertama, $persen);

                    $count_bahan = 8;
                    for($i = 2;$i<=8;$i++){
                        $ask = 'alternatif'.$i;
                        $ii=$i-1;
                        if($_data->$ask == null){
                            $count_bahan--;
                        }
                    }
                    $count_alternatif = $count_bahan;

                    $kedua = $pertama+1;
                    $n = 1;
                        for($n = 1;$n<=$count_alternatif;$n++){

                            $objPHPExcel->setActiveSheetIndex(0)
                            ->setCellValue('B'.$kedua, $_data['alternatif'.$n])
                            ->setCellValue('C'.$kedua, $_data['nama_bahan'.$n])
                            ->setCellValue('D'.$kedua, $_data['principle'.$n]);
                            $kedua++;
                        }
                    
                $number++;
                $pertama = $pertama+$count_alternatif;
                $pertama++;

                }
                $akhir = $pertama;
                $objPHPExcel->setActiveSheetIndex(0)
                    ->setCellValue('A'.$akhir, 'Jumlah')
                    ->setCellValue('E'.$akhir, $data['serving'])
                    ->setCellValue('F'.$akhir, $data['batch'])
                    ->setCellValue('G'.$akhir, '100 %');

                
                $objPHPExcel->getActiveSheet()->getStyle("A".$akhir)->getFill()
                            ->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)
                            ->getStartColor()->setARGB('aca6a6');
                $objPHPExcel->getActiveSheet()->getStyle("A".$akhir)->getAlignment()->setHorizontal('center');

                $objPHPExcel->getActiveSheet()->getStyle("B".$akhir)->getFill()
                            ->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)
                            ->getStartColor()->setARGB('aca6a6');
                $objPHPExcel->getActiveSheet()->getStyle("B".$akhir)->getAlignment()->setHorizontal('center');
                
                $objPHPExcel->getActiveSheet()->getStyle("C".$akhir)->getFill()
                            ->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)
                            ->getStartColor()->setARGB('aca6a6');
                $objPHPExcel->getActiveSheet()->getStyle("C".$akhir)->getAlignment()->setHorizontal('center');
                
                $objPHPExcel->getActiveSheet()->getStyle("D".$akhir)->getFill()
                            ->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)
                            ->getStartColor()->setARGB('aca6a6');
                $objPHPExcel->getActiveSheet()->getStyle("D".$akhir)->getAlignment()->setHorizontal('center');
                
                $objPHPExcel->getActiveSheet()->getStyle("E".$akhir)->getFill()
                            ->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)
                            ->getStartColor()->setARGB('aca6a6');
                $objPHPExcel->getActiveSheet()->getStyle("E".$akhir)->getAlignment()->setHorizontal('center');

                
                $objPHPExcel->getActiveSheet()->getStyle("F".$akhir)->getFill()
                            ->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)
                            ->getStartColor()->setARGB('aca6a6');
                $objPHPExcel->getActiveSheet()->getStyle("F".$akhir)->getAlignment()->setHorizontal('center');

                
                $objPHPExcel->getActiveSheet()->getStyle("G".$akhir)->getFill()
                            ->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)
                            ->getStartColor()->setARGB('aca6a6');
                $objPHPExcel->getActiveSheet()->getStyle("G".$akhir)->getAlignment()->setHorizontal('center');
                
                $note = $akhir+1;
                $contain = $note+1;
                $objPHPExcel->setActiveSheetIndex(0)
                    ->setCellValue('B'.$note, 'Note Formula :')
                    ->setCellValue('B'.$contain, 'Mengandung Allergen')
                    ->setCellValue('C'.$contain, 'Contain :')
                    ->setCellValue('E'.$contain, 'May Contain :');

                $isi_contain = $contain;
                foreach($allergen_bb as $contain){
                    $objPHPExcel->setActiveSheetIndex(0)
                    ->setCellValue('D'.$isi_contain, $contain['allergen_countain']);
                }

                // Note Formula
                $objPHPExcel->setActiveSheetIndex(0)
                    ->setCellValue('C'.$note, $data['note_formula']);
                $objPHPExcel->getActiveSheet()->mergeCells('C'.$note.':G'.$note);
                $objPHPExcel->setActiveSheetIndex(0)
                            ->setCellValue('C'.$note, $data['note_formula']);
        $objPHPExcel->getActiveSheet()->setTitle('FOR PDF');

        $skrg=date('d m Y');

        header('Content-Type: application/vnd.ms-excel'); 
        header('Content-Disposition: attachment;filename="FOR_PDF '.$skrg.'.xls"'); 

        header('Cache-Control: max-age=0'); 
        $objWriter = \PhpOffice\PhpSpreadsheet\IOFactory::createWriter($objPHPExcel, "Xlsx");
        ob_end_clean();
        $objWriter->save('php://output');
    }
}
