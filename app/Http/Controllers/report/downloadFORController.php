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
        $baris=1;

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
        $baris=1;

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

    public function nutfact_bayangan_pdf($formula){
        $objPHPExcel = new Spreadsheet();
        $objPHPExcel->setActiveSheetIndex(0); 

        $objPHPExcel->getActiveSheet()->getColumnDimension('A')->setWidth(23.00);
        $objPHPExcel->getActiveSheet()->getColumnDimension('B')->setWidth(18.00);
        $objPHPExcel->getActiveSheet()->getColumnDimension('C')->setWidth(15.00);
        $objPHPExcel->getActiveSheet()->getColumnDimension('D')->setWidth(15.00);

        $objPHPExcel->getActiveSheet()->getColumnDimension('E')->setWidth(18.00);
        $objPHPExcel->getActiveSheet()->getColumnDimension('F')->setWidth(15.00);
        $objPHPExcel->getActiveSheet()->getColumnDimension('G')->setWidth(20.00);

        $awal=1;
        $pertama=2;

        $akg = tb_akg::join('formulas','formulas.akg','tb_akg.id_tarkon')->join('tb_overage_inngradient','tb_overage_inngradient.id_formula','formulas.id')->where('id',$id)->get();
        $allergen_bb = allergen_formula::join('tb_bb_allergen','id_bb','tb_alergen_formula.id_bahan')->where('id_formula',$formula)->where('allergen_countain','!=','')->select(['allergen_countain'])->distinct()->get();
		$fortails = Fortail::where('formula_id',$formula)->get();
        
        $detail_formula     = collect();  
        $granulasi= 0; $jumlah_granulasi= 0; $premix= 0;
        $jumlah_premix= 0; $biasa= 0;
        foreach($fortails as $fortail){
			// Get Persen
			$one_persen = $fortail->per_batch / $formula->batch  ;
			$persen = $one_persen * 100;
			$persen = round($persen, 2);
            $detail_formula->push([

                'id' => $fortail->id,
                'kode_komputer' => $fortail->kode_komputer,
                'nama_sederhana' => $fortail->nama_sederhana,
                'alternatif1' => $fortail->alternatif1,
                'alternatif2' => $fortail->alternatif2,
                'alternatif3' => $fortail->alternatif3,
                'alternatif4' => $fortail->alternatif4,
                'alternatif5' => $fortail->alternatif5,
                'alternatif6' => $fortail->alternatif6,
                'alternatif7' => $fortail->alternatif7,
                'nama_bahan' => $fortail->nama_bahan,
                'nama_bahan1' => $fortail->nama_bahan1,
                'nama_bahan2' => $fortail->nama_bahan2,
                'nama_bahan3' => $fortail->nama_bahan3,
                'nama_bahan4' => $fortail->nama_bahan4,
                'nama_bahan5' => $fortail->nama_bahan5,
                'nama_bahan6' => $fortail->nama_bahan6,
				'nama_bahan7' => $fortail->nama_bahan7,
				'principle' => $fortail->principle,
				'principle1' => $fortail->principle1,
				'principle2' => $fortail->principle2,
				'principle3' => $fortail->principle3,
				'principle4' => $fortail->principle4,
				'principle5' => $fortail->principle5,
				'principle6' => $fortail->principle6,
				'principle7' => $fortail->principle7,
                'per_batch' => $fortail->per_batch,
                'per_serving' => $fortail->per_serving,
                'granulasi' => $fortail->granulasi,
                'premix' => $fortail->premix,
                'persen' => $persen,
			]);          
			
            if($fortail->granulasi == 'ya'){
                $granulasi = $granulasi + 1;
                $jumlah_granulasi = $jumlah_granulasi + $fortail->per_batch;
			}
			if($fortail->premix == 'ya'){
                $premix = $premix + 1;
                $jumlah_premix = $jumlah_premix + $fortail->per_batch;
            }
        }

        $biasa = $ada - $granulasi;
        $gp    = $jumlah_granulasi / $one_persen; $gp = round($gp , 2);
        $pr    = $jumlah_premix / $one_persen; $gp = round($gp , 2);

        // Tampil Harga Bahan Baku
        $detail_harga = collect();
        $satu_persen = $formula->serving / 100;
		// Inisialisasi Total
		// total makro
		$total_karbohidrat =0; $total_glukosa = 0; $total_serat = 0; $total_beta = 0;
		$total_sorbitol = 0; $total_maltitol = 0; $total_laktosa = 0; $total_sukrosa = 0;
		$total_gula = 0; $total_erythritol  = 0; $total_dha = 0; $total_epa = 0;
		$total_omega3 = 0; $total_mufa = 0; $total_lemak_trans = 0; $total_lemak_jenuh = 0;
		$total_sfa = 0; $total_omega6 = 0; $total_kolestrol = 0; $total_protein = 0;
		$total_air = 0;
		// total mineral
		$total_ca = 0; $total_mg = 0; $total_k = 0; $total_zink = 0;
		$total_p = 0; $total_na = 0; $total_naci = 0; $total_energi = 0;
		$total_fosfor = 0; $total_mn = 0; $total_cr = 0; $total_fe = 0;
		// total vitamin
		$total_vitA = 0; $total_vitB1 = 0; $total_vitB2 = 0; $total_vitB3 = 0;
		$total_vitB5 = 0; $total_vitB6 = 0; $total_vitB12 = 0; $total_vitC = 0;
		$total_vitD = 0; $total_vitE = 0; $total_vitK = 0; $total_folat = 0;
		$total_biotin = 0; $total_kolin = 0;
		// total asam amino
		$total_l_glutamine =0; $total_threonin =0;
		$total_methionin =0;  $total_phenilalanin =0;
		$total_histidin =0; $total_lisin =0;
		$total_BCAA =0; $total_valin =0;
		$total_leusin =0; $total_aspartat =0;
		$total_alanin =0; $total_sistein =0;
		$total_serin =0; $total_glisin =0;
		$total_glutamat =0; $total_tyrosin =0;
		$total_proline =0; $total_arginine =0;
		$total_Isoleusin =0;
		// berat
        $total_berat_per_serving = 0; $total_berat_per_batch = 0; $total_berat_per_kg = 0;
		// harga
        $total_harga_per_batch = 0; $total_harga_per_serving = 0; $total_harga_per_kg = 0; $total_harga_per_gram = 0;

        $no = 0;
        foreach($fortails as $fortail){
			//Get Needed
			$ingredients = DB::table('tb_nutfact')->first();
			$mineral =tr_mineral_bb::where('id_bahan',$fortail->bahan_id)->first();
			$makro = tr_makro_bb::where('id_bahan',$fortail->bahan_id)->first();
			$asam = tr_asam_amino_bb::where('id_bahan',$fortail->bahan_id)->first();
			$vitamin = tr_vitamin_bb::where('id_bahan',$fortail->bahan_id)->first();
            $bahan  = Bahan::where('id',$fortail->bahan_id)->first();
			$hitung_btp = tr_btp_bb::where('id_bahan',$fortail->bahan_id)->count();
			$curren = Curren::where('id',$bahan->curren_id)->first();

            //perhitungan nutfact bayangan
			if($fortail->nama_sederhana != 'NULL'){
				// makro
				$karbohidrat =($makro->karbohidrat/100)*($fortail->per_serving);
				$glukosa = ($makro->glukosa/100)*($fortail->per_serving);
				$serat = ($makro->serat_pangan/100)*($fortail->per_serving);
				$beta = ($makro->beta_glucan/100)*($fortail->per_serving);
				$sorbitol = ($makro->sorbitol/100)*($fortail->per_serving);
				$maltitol = ($makro->maltitol/100)*($fortail->per_serving);
				$laktosa = ($makro->laktosa/100)*($fortail->per_serving);
				$sukrosa = ($makro->sukrosa/100)*($fortail->per_serving);
				$gula = ($makro->gula/100)*($fortail->per_serving);
				$erythritol  = ($makro->erythritol /100)*($fortail->per_serving);
				$dha = ($makro->DHA/100)*($fortail->per_serving);
				$epa = ($makro->EPA/100)*($fortail->per_serving);
				$omega3 = ($makro->Omega3/100)*($fortail->per_serving);
				$mufa = ($makro->MUFA/100)*($fortail->per_serving);
				$lemak_trans = ($makro->lemak_trans/100)*($fortail->per_serving);
				$lemak_jenuh = ($makro->lemak_jenuh/100)*($fortail->per_serving);
				$sfa = ($makro->SFA/100)*($fortail->per_serving);
				$omega6 = ($makro->omega6/100)*($fortail->per_serving);
				$kolestrol = ($makro->kolesterol/100)*($fortail->per_serving);
				$protein = ($makro->protein/100)*($fortail->per_serving);
				$air = ($makro->air/100)*($fortail->per_serving);
				// mineral
				$ca = ($mineral->ca/100)*($fortail->per_serving);
				$mg = ($mineral->mg/100)*($fortail->per_serving);
				$k = ($mineral->k/100)*($fortail->per_serving);
				$zink = ($mineral->zink/100)*($fortail->per_serving);
				$p = ($mineral->p/100)*($fortail->per_serving);
				$na = ($mineral->na/100)*($fortail->per_serving);
				$naci = ($mineral->naci/100)*($fortail->per_serving);
				$energi = ($mineral->energi/100)*($fortail->per_serving);
				$fosfor = ($mineral->fosfor/100)*($fortail->per_serving);
				$mn = ($mineral->mn/100)*($fortail->per_serving);
				$cr = ($mineral->cr/100)*($fortail->per_serving);
				$fe = ($mineral->fe/100)*($fortail->per_serving);
				// vitamin
				$vitA = ($vitamin->vitA/100)*($fortail->per_serving);
				$vitB1 = ($vitamin->vitB1/100)*($fortail->per_serving);
				$vitB2 = ($vitamin->vitB2/100)*($fortail->per_serving);
				$vitB3 = ($vitamin->vitB3/100)*($fortail->per_serving);
				$vitB5 = ($vitamin->vitB5/100)*($fortail->per_serving);
				$vitB6 = ($vitamin->vitB6/100)*($fortail->per_serving);
				$vitB12 = ($vitamin->vitB12/100)*($fortail->per_serving);
				$vitC = ($vitamin->vitC/100)*($fortail->per_serving);
				$vitD = ($vitamin->vitD/100)*($fortail->per_serving);
				$vitE = ($vitamin->vitE/100)*($fortail->per_serving);
				$vitK = ($vitamin->vitK/100)*($fortail->per_serving);
				$folat = ($vitamin->folat/100)*($fortail->per_serving);
				$biotin = ($vitamin->biotin/100)*($fortail->per_serving);
				$kolin = ($vitamin->kolin/100)*($fortail->per_serving);
				//asam amino
				$l_glutamine = ($asam->l_glutamin/100)*($fortail->per_serving);      $threonin = ($asam->Threonin/100)*($fortail->per_serving);
				$methionin = ($asam->Methionin/100)*($fortail->per_serving);         $phenilalanin = ($asam->Phenilalanin/100)*($fortail->per_serving);
				$histidin = ($asam->Histidin/100)*($fortail->per_serving);           $lisin = ($asam->lisin/100)*($fortail->per_serving);
				$BCAA = ($asam->BCAA/100)*($fortail->per_serving);                   $valin = ($asam->Valin/100)*($fortail->per_serving);
				$leusin = ($asam->Leusin/100)*($fortail->per_serving);               $aspartat = ($asam->Aspartat/100)*($fortail->per_serving);           
				$alanin = ($asam->Alanine/100)*($fortail->per_serving);              $sistein = ($asam->Sistein/100)*($fortail->per_serving);
				$serin = ($asam->Serin/100)*($fortail->per_serving);                 $glisin = ($asam->Glisin/100)*($fortail->per_serving);
				$glutamat = ($asam->Glutamat/100)*($fortail->per_serving);           $tyrosin = ($asam->Tyrosin/100)*($fortail->per_serving);
				$proline = ($asam->Proline/100)*($fortail->per_serving);             $arginine = ($asam->Arginine/100)*($fortail->per_serving);
				$Isoleusin = ($asam->Isoleusin/100)*($fortail->per_serving);
				       
			}

            // Harga Pergram
            $hpg = ($bahan->harga_satuan * $curren->harga) / ($bahan->berat * 1000); $hpg = round($hpg,2);
            // PerServing
            $berat_per_serving = $fortail->per_serving; $berat_per_serving = round($berat_per_serving,5);
            $persen = $fortail->per_serving / $satu_persen; $persen = round($persen,2);
            $harga_per_serving = $berat_per_serving * $hpg; $harga_per_serving = round($harga_per_serving,2);
            // Per Batch
            $berat_per_batch = $fortail->per_batch; $berat_per_batch = round($berat_per_batch,5);
            $harga_per_batch = $berat_per_batch * $hpg; $harga_per_batch = round($harga_per_batch,2);
            // Per Kg
            $berat_per_kg = (1000 * $berat_per_serving) / $formula->serving; $berat_per_kg = round($berat_per_kg,5);
            $harga_per_kg = $berat_per_kg * $hpg; $harga_per_kg = round($harga_per_kg,2);       
            $detail_harga->push([
				// data
				'no' => ++$no,  
                'id' => $fortail->id,
                'kode_komputer' => $bahan->kode_komputer,
                'nama_sederhana' => $bahan->nama_sederhana,
				'bahan' => $bahan->id,
				'hitung_btp' => $hitung_btp,
				'id_ingeradient' => $bahan->id_ingeradient,
				'hpg' => $hpg,
				//makro
				'karbohidrat' => $karbohidrat, 		'glukosa' => $glukosa ,
				'serat' => $serat ,            		'beta' => $beta,
				'sorbitol' => $sorbitol ,      		'maltitol' => $maltitol ,
				'laktosa' => $laktosa ,      		'sukrosa' => $sukrosa,
				'gula' => $gula ,              		'erythritol' => $erythritol  ,
				'dha' => $dha ,                		'epa' => $epa,
				'omega3' => $omega3 ,          		'mufa' => $mufa ,
				'lemak_trans' => $lemak_trans ,		'lemak_jenuh' => $lemak_jenuh,
				'sfa' => $sfa ,                		'omega6' => $omega6 ,
				'kolestrol' => $kolestrol ,    		'protein' => $protein,
				'air' => $air,
				//mineral
				'ca' => $ca ,        				'mg' => $mg ,
				'k' => $k ,          				'zink' => $zink,
				'p' => $p ,          				'na' => $na ,
				'naci' => $naci ,    				'energi' => $energi,
				'fosfor' => $fosfor, 				'mn' => $mn ,
				'cr' => $cr ,        				'fe' => $fe,
				//vitamin
				'vitA' => $vitA ,    				'vitB1' => $vitB1 ,
				'vitB2' => $vitB2 ,  				'vitB3' => $vitB3,
				'vitB5' => $vitB5 ,  				'vitB6' => $vitB6 ,
				'vitB12' => $vitB12, 				'vitC' => $vitC,
				'vitD' => $vitD ,    				'vitE' => $vitE ,
				'vitK' => $vitK ,    				'folat' => $folat,
				'biotin' => $biotin, 				'kolin' => $kolin,
				//asam amino
				'l_glutamine' => $l_glutamine ,    'threonin' => $threonin ,
				'methionin' => $methionin ,        'phenilalanin' => $phenilalanin,
				'histidin' => $histidin ,          'lisin' => $lisin ,
				'BCAA' => $BCAA ,                  'valin' => $valin,
				'leusin' => $leusin ,              'sistein' => $sistein ,
				'aspartat' => $aspartat ,          'alanin' => $alanin,
				'serin' => $serin ,                'glisin' => $glisin,
				'glutamat' => $glutamat ,          'tyrosin' => $tyrosin ,
				'arginine' => $arginine ,          'proline' => $proline,
				'Isoleusin' => $Isoleusin ,   

				// data
                'persen' => $persen,               'per_serving' =>  $berat_per_serving,
                'per_batch' => $berat_per_batch,   'harga_per_serving' => $harga_per_serving,
                'per_kg' => $berat_per_kg,         'harga_per_batch' => $harga_per_batch,
                'harga_per_kg' => $harga_per_kg
			]);

			// total makro
			$total_karbohidrat = $total_karbohidrat+$karbohidrat; 
			$total_glukosa = $total_glukosa + $glukosa; 
			$total_serat = $total_serat + $serat; 
			$total_beta = $total_beta + $beta;
			$total_sorbitol = $total_sorbitol + $sorbitol; 
			$total_maltitol = $total_maltitol + $maltitol;
			$total_laktosa = $total_laktosa + $laktosa; 
			$total_sukrosa = $total_sukrosa + $sukrosa;
			$total_gula = $total_gula + $gula;
			$total_erythritol  = $total_erythritol + $erythritol;
			$total_dha = $total_dha + $dha; 
			$total_epa = $total_epa + $epa;
			$total_omega3 = $total_omega3 + $omega3; 
			$total_mufa = $total_mufa + $mufa; 
			$total_lemak_trans = $total_lemak_trans + $lemak_trans; 
			$total_lemak_jenuh = $total_lemak_jenuh + $lemak_jenuh;
			$total_sfa = $total_sfa + $sfa; 
			$total_omega6 = $total_omega6 + $omega6; 
			$total_kolestrol = $total_kolestrol + $kolestrol; 
			$total_protein = $total_protein + $protein;
			$total_air = $total_air + $air;
			// total mineral
			$total_ca = $total_ca + $ca; 
			$total_mg = $total_mg + $mg; 
			$total_k = $total_k + $k; 
			$total_zink = $total_zink + $zink;
			$total_p = $total_p + $p; 
			$total_na = $total_na + $na; 
			$total_naci = $total_naci + $naci; 
			$total_energi = $total_energi + $energi;
			$total_fosfor = $total_fosfor + $fosfor; 
			$total_mn = $total_mn + $mn; 
			$total_cr = $total_cr + $cr; 
			$total_fe = $total_fe + $fe;
			// total vitamin
			$total_vitA = $total_vitA + $vitA;
			$total_vitB1 = $total_vitB1 + $vitB1;
			$total_vitB2 = $total_vitB2 + $vitB2;
			$total_vitB3 = $total_vitB3 + $vitB3;
			$total_vitB5 = $total_vitB5 + $vitB5;
			$total_vitB6 = $total_vitB6 + $vitB6;
			$total_vitB12 = $total_vitB12 + $vitB12;
			$total_vitC = $total_vitC + $vitC;
			$total_vitD = $total_vitD + $vitD;
			$total_vitE = $total_vitE + $vitE;
			$total_vitK = $total_vitK + $vitK;
			$total_folat = $total_folat + $folat;
			$total_biotin = $total_biotin + $biotin;
			$total_kolin = $total_kolin + $kolin;
			// total asam amino
			$total_l_glutamine =$total_l_glutamine + $l_glutamine;
			$total_threonin = $total_threonin + $threonin;
			$total_methionin = $total_methionin + $methionin;
			$total_phenilalanin = $total_phenilalanin + $phenilalanin;
			$total_histidin = $total_histidin + $histidin;
			$total_lisin = $total_lisin + $lisin;
			$total_BCAA = $total_BCAA + $BCAA;
			$total_valin = $total_valin + $valin;
			$total_leusin = $total_leusin + $leusin;
			$total_aspartat = $total_aspartat + $aspartat;
			$total_alanin = $total_alanin + $alanin;
			$total_sistein = $total_sistein + $sistein;
			$total_serin = $total_serin + $serin;
			$total_glisin = $total_glisin + $glisin;
			$total_glutamat = $total_glutamat + $glutamat;
			$total_tyrosin = $total_tyrosin + $tyrosin;
			$total_proline = $total_proline + $proline;
			$total_arginine = $total_arginine + $arginine;
			$total_Isoleusin = $total_Isoleusin + $Isoleusin;

			// total harga
            $total_harga_per_gram = $total_harga_per_gram + $hpg;
            $total_harga_per_serving = $total_harga_per_serving + $harga_per_serving;
            $total_harga_per_batch = $total_harga_per_batch + $harga_per_batch;
            $total_harga_per_kg = $total_harga_per_kg + $harga_per_kg;
			// total berat
            $total_berat_per_serving = $total_berat_per_serving + $berat_per_serving;
            $total_berat_per_batch = $total_berat_per_batch + $berat_per_batch;
            $total_berat_per_kg = $total_berat_per_kg + $berat_per_kg;
        }

        $total_harga = collect([
			'total_karbohidrat' => $total_karbohidrat,
			'total_glukosa' => $total_glukosa, 
			'total_serat' => $total_serat,
			'total_beta' => $total_beta,
			'total_sorbitol' => $total_sorbitol, 
			'total_maltitol' => $total_maltitol,
			'total_laktosa' => $total_laktosa,
			'total_sukrosa' => $total_sukrosa,
			'total_gula' => $total_gula,
			'total_erythritol' => $total_erythritol,
			'total_dha' => $total_dha, 
			'total_epa' => $total_epa,
			'total_omega3' => $total_omega3, 
			'total_mufa' => $total_mufa, 
			'total_lemak_trans' => $total_lemak_trans,
			'total_lemak_jenuh' => $total_lemak_jenuh,
			'total_sfa' => $total_sfa, 
			'total_omega6' => $total_omega6,
			'total_kolestrol' => $total_kolestrol, 
			'total_protein' => $total_protein,
			'total_air' => $total_air,
			// total mineral
			'total_ca' => $total_ca, 
			'total_mg' => $total_mg, 
			'total_k' => $total_k, 
			'total_zink' => $total_zink,
			'total_p' => $total_p, 
			'total_na' => $total_na, 
			'total_naci' => $total_naci, 
			'total_energi' => $total_energi,
			'total_fosfor' => $total_fosfor, 
			'total_mn' => $total_mn, 
			'total_cr' => $total_cr, 
			'total_fe' => $total_fe,
			// total vitamin
			'total_vitA' => $total_vitA,
			'total_vitB1' => $total_vitB1,
			'total_vitB2' => $total_vitB2,
			'total_vitB3' => $total_vitB3,
			'total_vitB5' => $total_vitB5,
			'total_vitB6' => $total_vitB6,
			'total_vitB12' => $total_vitB12,
			'total_vitC' => $total_vitC,
			'total_vitD' => $total_vitD,
			'total_vitE' => $total_vitE,
			'total_vitK' => $total_vitK,
			'total_folat' => $total_folat,
			'total_biotin' => $total_biotin,
			'total_kolin' => $total_kolin,
			// total asam amino
			'total_l_glutamine' =>$total_l_glutamine,
			'total_threonin' => $total_threonin,
			'total_methionin' => $total_methionin,
			'total_phenilalanin' => $total_phenilalanin,
			'total_histidin' => $total_histidin,
			'total_lisin' => $total_lisin,
			'total_BCAA' => $total_BCAA,
			'total_valin' => $total_valin,
			'total_leusin' => $total_leusin,
			'total_aspartat' => $total_aspartat,
			'total_alanin' => $total_alanin,
			'total_sistein' => $total_sistein,
			'total_serin' => $total_serin,
			'total_glisin' => $total_glisin,
			'total_glutamat' => $total_glutamat,
			'total_tyrosin' => $total_tyrosin,
			'total_proline' => $total_proline,
			'total_arginine' => $total_arginine,
			'total_Isoleusin' => $total_Isoleusin,

            'total_harga_per_gram' => $total_harga_per_gram,
            'total_berat_per_serving' => $total_berat_per_serving,
            'total_persen' => 100,
            'total_harga_per_serving' => $total_harga_per_serving,
            'total_berat_per_batch' => $total_berat_per_batch,
            'total_harga_per_batch' => $total_harga_per_batch,
            'total_berat_per_kg' => $total_berat_per_kg,
            'total_harga_per_kg' => $total_harga_per_kg,         
            ]);
        $no=1;
        $pertama=8;
        
        $styleArray = array(
            'background'  => array(
            'color' => array('rgb' => 'FF0000'),
        ));

        //Bagian Isi
        $baris=1;

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

}