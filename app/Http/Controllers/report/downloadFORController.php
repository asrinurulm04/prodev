<?php

namespace App\Http\Controllers\report;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\IOFactory;

use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use Illuminate\Support\Facades\Validator;
use App\model\pkp\PkpProject;
use App\model\dev\Formula;
use App\model\dev\Fortail;
use App\model\dev\Bahan;
use App\model\dev\MakroBB;
use App\model\dev\MineralBB;
use App\model\dev\VitaminBB;
use App\model\dev\AsamAminoBB;
use App\model\devnf\AllergenFormula;
use App\model\devnf\Akg;
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

        $data = Formula::where('id',$formula)->join('tr_project_pkp','tr_project_pkp.id_project','=','tr_formulas.workbook_id')->first();
        $allergen_bb = AllergenFormula::join('tr_bb_allergen','id_bb','tr_allergen_formula.id_bahan')->where('id_formula',$formula)->where('allergen_countain','!=','')->select(['allergen_countain'])->distinct()->get();
		$fortails = Fortail::where('formula_id',$formula)->orderBy('per_serving','dsc')->get();
        
        $no=1;
        $pertama=8;
        
        $styleArray = array(
            'background'  => array(
            'color' => array('rgb' => 'FF0000'),
        ));

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
            ->setCellValue('F5', 'Created Date :')
            ->setCellValue('G5', $data['created_at'])
            ->setCellValue('F6', 'jumlah/batch :')
            ->setCellValue('G6', $data['batch'])
            ->setCellValue('H6', 'gr');

        $objPHPExcel->setActiveSheetIndex(0)
            ->setCellValue('A7', 'No')
            ->setCellValue('B7', 'Kode Oracle')
            ->setCellValue('C7', 'Nama Sederhana')
            ->setCellValue('D7', 'Nama Bahan')
            ->setCellValue('E7', 'Principal')
            ->setCellValue('F7', 'PerServing (gr)')
            ->setCellValue('G7', 'PerBatch (gr)')
            ->setCellValue('H7', 'Persen');

                
        $objPHPExcel->getActiveSheet()->getStyle("A7:H7")->getFill()
                    ->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)
                    ->getStartColor()->setARGB('13DFE4');
        $objPHPExcel->getActiveSheet()->getStyle("A7:H7")->getAlignment()->setHorizontal('center');

        $number = 1;
        foreach($fortails as $_data){
            $one_persen = $_data->per_batch / $data->batch  ;
            $persen = $one_persen * 100;
            $persen = round($persen, 2);

            $line=$pertama;
            $objPHPExcel->setActiveSheetIndex(0)
                ->setCellValue('A'.$pertama, $number)
                ->setCellValue('B'.$pertama, $_data['kode_oracle'])
                ->setCellValue('C'.$pertama, $_data['nama_sederhana'])
                ->setCellValue('D'.$pertama, $_data['nama_bahan'])
                ->setCellValue('E'.$pertama, $_data['principle'])
                ->setCellValue('F'.$pertama, $_data['per_serving'])
                ->setCellValue('G'.$pertama, $_data['per_batch'])
                ->setCellValue('H'.$pertama, $persen);

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
                    ->setCellValue('F'.$akhir, $data['serving'])
                    ->setCellValue('G'.$akhir, $data['batch'])
                    ->setCellValue('H'.$akhir, '100 %');
                
        $objPHPExcel->getActiveSheet()->getStyle("A".$akhir.":H".$akhir)->getFill()
                    ->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)
                    ->getStartColor()->setARGB('aca6a6');
        $objPHPExcel->getActiveSheet()->getStyle("A".$akhir.":H".$akhir)->getAlignment()->setHorizontal('center');
                
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


        $data = Formula::where('id',$formula)->join('tr_pdf_project','tr_pdf_project.id_project_pdf','=','tr_formulas.workbook_pdf_id')->first();
        $allergen_bb = AllergenFormula::join('tr_bb_allergen','id_bb','tr_allergen_formula.id_bahan')->where('id_formula',$formula)->where('allergen_countain','!=','')->select(['allergen_countain'])->distinct()->get();
		$fortails = Fortail::where('formula_id',$formula)->get();
        
        $no=1;
        $pertama=8;
        
        $styleArray = array(
            'background'  => array(
            'color' => array('rgb' => 'FF0000'),
        ));

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

                
        $objPHPExcel->getActiveSheet()->getStyle("A7:G7")->getFill()
                    ->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)
                    ->getStartColor()->setARGB('13DFE4');
        $objPHPExcel->getActiveSheet()->getStyle("A7:G7")->getAlignment()->setHorizontal('center');
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

        $objPHPExcel->getActiveSheet()->getStyle('A'.$akhir.':G'.$akhir)->getFill()
                    ->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)
                    ->getStartColor()->setARGB('aca6a6');
        $objPHPExcel->getActiveSheet()->getStyle('A'.$akhir.':G'.$akhir)->getAlignment()->setHorizontal('center');
                
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

    public function nutfact_bayangan_pkp($formulas){
        $objPHPExcel = new Spreadsheet();
        $objPHPExcel->setActiveSheetIndex(0); 

        $objPHPExcel->getActiveSheet()->getColumnDimension('A')->setWidth(18.00);
        $objPHPExcel->getActiveSheet()->getColumnDimension('B')->setWidth(13.00);
        $objPHPExcel->getActiveSheet()->getColumnDimension('C')->setWidth(8.00);
        $objPHPExcel->getActiveSheet()->getColumnDimension('D')->setWidth(10.00);

        $objPHPExcel->getActiveSheet()->getColumnDimension('E')->setWidth(10.00);
        $objPHPExcel->getActiveSheet()->getColumnDimension('F')->setWidth(8.00);
        $objPHPExcel->getActiveSheet()->getColumnDimension('G')->setWidth(12.00);

        $awal=1;
        $pertama=2;

		$ada = Fortail::where('formula_id',$formulas)->count();
		$formula = Formula::where('id',$formulas)->join('tr_overage_inngradient','tr_overage_inngradient.id_formula','tr_formulas.id')->first();
        $akg = Akg::join('tr_formulas','tr_formulas.akg','ms_akg.id_tarkon')->join('tr_overage_inngradient','tr_overage_inngradient.id_formula','tr_formulas.id')->where('id',$formulas)->get();
        $allergen_bb = AllergenFormula::join('tr_bb_allergen','id_bb','tr_allergen_formula.id_bahan')->where('id_formula',$formulas)->where('allergen_countain','!=','')->select(['allergen_countain'])->distinct()->get();
		$fortails = Fortail::where('formula_id',$formulas)->get();
        
        $detail_formula     = collect();  
        $granulasi= 0; $jumlah_granulasi= 0; $premix= 0;
        $jumlah_premix= 0; $biasa= 0;

        $biasa = $ada - $granulasi;

        // Tampil Harga Bahan Baku
        $detail_harga = collect();
        $satu_persen = $formula->serving / 100;
		// Inisialisasi Total
		// total makro
		$total_karbohidrat =0;  $total_glukosa = 0;         $total_serat = 0;           $total_beta = 0;
		$total_sorbitol = 0;    $total_maltitol = 0;        $total_laktosa = 0;         $total_sukrosa = 0;
		$total_gula = 0;        $total_erythritol  = 0;     $total_dha = 0;             $total_epa = 0;
		$total_omega3 = 0;      $total_mufa = 0;            $total_lemak_total = 0;     $total_lemak_jenuh = 0;
		$total_sfa = 0;         $total_omega6 = 0;          $total_kolestrol = 0;       $total_protein = 0;
		$total_air = 0;
		// total mineral
		$total_ca = 0;          $total_mg = 0;              $total_k = 0;               $total_zink = 0;
		$total_p = 0;           $total_na = 0;              $total_naci = 0;            $total_energi = 0;
		$total_fosfor = 0;      $total_mn = 0;              $total_cr = 0;              $total_fe = 0;
		// total vitamin
		$total_vitA = 0;        $total_vitB1 = 0;           $total_vitB2 = 0;           $total_vitB3 = 0;
		$total_vitB5 = 0;       $total_vitB6 = 0;           $total_vitB12 = 0;          $total_vitC = 0;
		$total_vitD = 0;        $total_vitE = 0;            $total_vitK = 0;            $total_folat = 0;
		$total_biotin = 0;      $total_kolin = 0;
		// total asam amino
		$total_l_glutamine =0;  $total_threonin =0;         $total_methionin =0;        $total_phenilalanin =0;
		$total_histidin =0;     $total_lisin =0;            $total_BCAA =0;             $total_valin =0;
		$total_leusin =0;       $total_aspartat =0;         $total_alanin =0;           $total_sistein =0;
		$total_serin =0;        $total_glisin =0;           $total_glutamat =0;         $total_tyrosin =0;
		$total_proline =0;      $total_arginine =0;         $total_Isoleusin =0;
		// berat
        $total_berat_per_serving = 0;   $total_berat_per_batch = 0;     $total_berat_per_kg = 0;
		// harga
        $total_harga_per_batch = 0;     $total_harga_per_serving = 0;   $total_harga_per_kg = 0;    $total_harga_per_gram = 0;

        $no = 0;
        foreach($fortails as $fortail){
			//Get Needed
			$mineral =MineralBB::where('id_bahan',$fortail->bahan_id)->first();
			$makro = MakroBB::where('id_bahan',$fortail->bahan_id)->first();
			$asam = AsamAminoBB::where('id_bahan',$fortail->bahan_id)->first();
			$vitamin = VitaminBB::where('id_bahan',$fortail->bahan_id)->first();
            $bahan  = Bahan::where('id',$fortail->bahan_id)->first();

            //perhitungan nutfact bayangan
			if($fortail->nama_sederhana != 'NULL'){
				// makro
				$karbohidrat =($makro->karbohidrat/100)*($fortail->per_serving);    $glukosa = ($makro->glukosa/100)*($fortail->per_serving);
				$serat = ($makro->serat_pangan/100)*($fortail->per_serving);        $beta = ($makro->beta_glucan/100)*($fortail->per_serving);
				$sorbitol = ($makro->sorbitol/100)*($fortail->per_serving);         $maltitol = ($makro->maltitol/100)*($fortail->per_serving);
				$laktosa = ($makro->laktosa/100)*($fortail->per_serving);           $sukrosa = ($makro->sukrosa/100)*($fortail->per_serving);
				$gula = ($makro->gula/100)*($fortail->per_serving);                 $erythritol  = ($makro->erythritol /100)*($fortail->per_serving);
				$dha = ($makro->DHA/100)*($fortail->per_serving);                   $epa = ($makro->EPA/100)*($fortail->per_serving);
				$omega3 = ($makro->Omega3/100)*($fortail->per_serving);             $mufa = ($makro->MUFA/100)*($fortail->per_serving);
				$lemak_trans = ($makro->lemak_trans/100)*($fortail->per_serving);   $lemak_jenuh = ($makro->lemak_jenuh/100)*($fortail->per_serving);
				$sfa = ($makro->SFA/100)*($fortail->per_serving);                   $omega6 = ($makro->omega6/100)*($fortail->per_serving);
				$kolestrol = ($makro->kolesterol/100)*($fortail->per_serving);      $protein = ($makro->protein/100)*($fortail->per_serving);
				$air = ($makro->air/100)*($fortail->per_serving);
				// mineral
				$ca = ($mineral->ca/100)*($fortail->per_serving);                   $mg = ($mineral->mg/100)*($fortail->per_serving);
				$k = ($mineral->k/100)*($fortail->per_serving);                     $zink = ($mineral->zink/100)*($fortail->per_serving);
				$p = ($mineral->p/100)*($fortail->per_serving);                     $na = ($mineral->na/100)*($fortail->per_serving);
				$naci = ($mineral->naci/100)*($fortail->per_serving);               $energi = ($mineral->energi/100)*($fortail->per_serving);
				$fosfor = ($mineral->fosfor/100)*($fortail->per_serving);           $mn = ($mineral->mn/100)*($fortail->per_serving);
				$cr = ($mineral->cr/100)*($fortail->per_serving);                   $fe = ($mineral->fe/100)*($fortail->per_serving);
				// vitamin
				$vitA = ($vitamin->vitA/100)*($fortail->per_serving);               $vitB1 = ($vitamin->vitB1/100)*($fortail->per_serving);
				$vitB2 = ($vitamin->vitB2/100)*($fortail->per_serving);             $vitB3 = ($vitamin->vitB3/100)*($fortail->per_serving);
				$vitB5 = ($vitamin->vitB5/100)*($fortail->per_serving);             $vitB6 = ($vitamin->vitB6/100)*($fortail->per_serving);
				$vitB12 = ($vitamin->vitB12/100)*($fortail->per_serving);           $vitC = ($vitamin->vitC/100)*($fortail->per_serving);
				$vitD = ($vitamin->vitD/100)*($fortail->per_serving);               $vitE = ($vitamin->vitE/100)*($fortail->per_serving);
				$vitK = ($vitamin->vitK/100)*($fortail->per_serving);               $folat = ($vitamin->folat/100)*($fortail->per_serving);
				$biotin = ($vitamin->biotin/100)*($fortail->per_serving);           $kolin = ($vitamin->kolin/100)*($fortail->per_serving);
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

			// total makro
			$total_karbohidrat = $total_karbohidrat+$karbohidrat;                   $total_glukosa = $total_glukosa + $glukosa; 
			$total_serat = $total_serat + $serat;                                   $total_beta = $total_beta + $beta;
			$total_sorbitol = $total_sorbitol + $sorbitol;                          $total_maltitol = $total_maltitol + $maltitol;
			$total_laktosa = $total_laktosa + $laktosa;                             $total_sukrosa = $total_sukrosa + $sukrosa;
			$total_gula = $total_gula + $gula;                                      $total_erythritol  = $total_erythritol + $erythritol;
			$total_dha = $total_dha + $dha;                                         $total_epa = $total_epa + $epa;
			$total_omega3 = $total_omega3 + $omega3;                                $total_mufa = $total_mufa + $mufa; 
			$total_lemak_total = $total_lemak_total + $lemak_trans;                 $total_lemak_jenuh = $total_lemak_jenuh + $lemak_jenuh;
			$total_sfa = $total_sfa + $sfa;                                         $total_omega6 = $total_omega6 + $omega6; 
			$total_kolestrol = $total_kolestrol + $kolestrol;                       $total_protein = $total_protein + $protein;
			$total_air = $total_air + $air;
			// total mineral
			$total_ca = $total_ca + $ca;                                            $total_mg = $total_mg + $mg; 
			$total_k = $total_k + $k;                                               $total_zink = $total_zink + $zink;
			$total_p = $total_p + $p;                                               $total_na = $total_na + $na; 
			$total_naci = $total_naci + $naci;                                      $total_energi = $total_energi + $energi;
			$total_fosfor = $total_fosfor + $fosfor;                                $total_mn = $total_mn + $mn; 
			$total_cr = $total_cr + $cr;                                            $total_fe = $total_fe + $fe;
			// total vitamin
			$total_vitA = $total_vitA + $vitA;                                      $total_vitB1 = $total_vitB1 + $vitB1;
			$total_vitB2 = $total_vitB2 + $vitB2;                                   $total_vitB3 = $total_vitB3 + $vitB3;
			$total_vitB5 = $total_vitB5 + $vitB5;                                   $total_vitB6 = $total_vitB6 + $vitB6;
			$total_vitB12 = $total_vitB12 + $vitB12;                                $total_vitC = $total_vitC + $vitC;
			$total_vitD = $total_vitD + $vitD;                                      $total_vitE = $total_vitE + $vitE;
			$total_vitK = $total_vitK + $vitK;                                      $total_folat = $total_folat + $folat;
			$total_biotin = $total_biotin + $biotin;                                $total_kolin = $total_kolin + $kolin;
			// total asam amino
			$total_l_glutamine =$total_l_glutamine + $l_glutamine;                  $total_threonin = $total_threonin + $threonin;
			$total_methionin = $total_methionin + $methionin;                       $total_phenilalanin = $total_phenilalanin + $phenilalanin;
			$total_histidin = $total_histidin + $histidin;                          $total_lisin = $total_lisin + $lisin;
			$total_BCAA = $total_BCAA + $BCAA;                                      $total_valin = $total_valin + $valin;
			$total_leusin = $total_leusin + $leusin;                                $total_aspartat = $total_aspartat + $aspartat;
			$total_alanin = $total_alanin + $alanin;                                $total_sistein = $total_sistein + $sistein;
			$total_serin = $total_serin + $serin;                                   $total_glisin = $total_glisin + $glisin;
			$total_glutamat = $total_glutamat + $glutamat;                          $total_tyrosin = $total_tyrosin + $tyrosin;
			$total_proline = $total_proline + $proline;                             $total_arginine = $total_arginine + $arginine;
			$total_Isoleusin = $total_Isoleusin + $Isoleusin;
        }
        $total_harga = collect([
			'total_karbohidrat' => $total_karbohidrat,                              'total_glukosa' => $total_glukosa, 
			'total_serat' => $total_serat,                                          'total_beta' => $total_beta,
			'total_sorbitol' => $total_sorbitol,                                    'total_maltitol' => $total_maltitol,
			'total_laktosa' => $total_laktosa,                                      'total_sukrosa' => $total_sukrosa,
			'total_gula' => $total_gula,                                            'total_erythritol' => $total_erythritol,
			'total_dha' => $total_dha,                                              'total_epa' => $total_epa,
			'total_omega3' => $total_omega3,                                        'total_mufa' => $total_mufa, 
			'total_lemak_total' => $total_lemak_total,                              'total_lemak_jenuh' => $total_lemak_jenuh,
			'total_sfa' => $total_sfa,                                              'total_omega6' => $total_omega6,
			'total_kolestrol' => $total_kolestrol,                                  'total_protein' => $total_protein,
			'total_air' => $total_air,
			// total mineral
			'total_ca' => $total_ca,                                                'total_mg' => $total_mg, 
			'total_k' => $total_k,                                                  'total_zink' => $total_zink,
			'total_p' => $total_p,                                                  'total_na' => $total_na, 
			'total_naci' => $total_naci,                                            'total_energi' => $total_energi,
			'total_fosfor' => $total_fosfor,                                        'total_mn' => $total_mn, 
			'total_cr' => $total_cr,                                                'total_fe' => $total_fe,
			// total vitamin
			'total_vitA' => $total_vitA,                                            'total_vitB1' => $total_vitB1,
			'total_vitB2' => $total_vitB2,                                          'total_vitB3' => $total_vitB3,
			'total_vitB5' => $total_vitB5,                                          'total_vitB6' => $total_vitB6,
			'total_vitB12' => $total_vitB12,                                        'total_vitC' => $total_vitC,
			'total_vitD' => $total_vitD,                                            'total_vitE' => $total_vitE,
			'total_vitK' => $total_vitK,                                            'total_folat' => $total_folat,
			'total_biotin' => $total_biotin,                                        'total_kolin' => $total_kolin,
			// total asam amino
			'total_l_glutamine' =>$total_l_glutamine,                               'total_threonin' => $total_threonin,
			'total_methionin' => $total_methionin,                                  'total_phenilalanin' => $total_phenilalanin,
			'total_histidin' => $total_histidin,                                    'total_lisin' => $total_lisin,
			'total_BCAA' => $total_BCAA,                                            'total_valin' => $total_valin,
			'total_leusin' => $total_leusin,                                        'total_aspartat' => $total_aspartat,
			'total_alanin' => $total_alanin,                                        'total_sistein' => $total_sistein,
			'total_serin' => $total_serin,                                          'total_glisin' => $total_glisin,
			'total_glutamat' => $total_glutamat,                                    'total_tyrosin' => $total_tyrosin,
			'total_proline' => $total_proline,                                      'total_arginine' => $total_arginine,
			'total_Isoleusin' => $total_Isoleusin,    
        ]);
        $no=1;
        $pertama=8;
        
        $styleArray = array(
            'background'  => array(
            'color' => array('rgb' => 'FF0000'),
        ));

        //Bagian Header 
        $objPHPExcel->setActiveSheetIndex(0)
            ->setCellValue('A1', 'Parameter')
            ->setCellValue('B1', 'Gramasi')
            ->setCellValue('C1', 'Unit')
            ->setCellValue('D1', '%AKG')
            ->setCellValue('E1', 'AKG')
            ->setCellValue('F1', 'Unit')
            ->setCellValue('G1', 'Overage');
                
        $objPHPExcel->getActiveSheet()->getStyle("A1")->getFill()
                    ->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)
                    ->getStartColor()->setARGB('7dabea');
        $objPHPExcel->getActiveSheet()->getStyle("A1")->getAlignment()->setHorizontal('center');
        $objPHPExcel->getActiveSheet()->getStyle("A2:A84")->getFill()
                    ->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)
                    ->getStartColor()->setARGB('9df3ff');
                
        $objPHPExcel->getActiveSheet()->getStyle("B1")->getFill()
                    ->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)
                    ->getStartColor()->setARGB('7dabea');
        $objPHPExcel->getActiveSheet()->getStyle("B1")->getAlignment()->setHorizontal('center');
        $objPHPExcel->getActiveSheet()->getStyle("B2:B84")->getFill()
                    ->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)
                    ->getStartColor()->setARGB('9df3ff');
        $objPHPExcel->getActiveSheet()->getStyle("B2:B84")->getAlignment()->setHorizontal('right');

        $objPHPExcel->getActiveSheet()->getStyle("C1")->getFill()
                    ->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)
                    ->getStartColor()->setARGB('7dabea');
        $objPHPExcel->getActiveSheet()->getStyle("C1")->getAlignment()->setHorizontal('center');
        $objPHPExcel->getActiveSheet()->getStyle("C2:C84")->getFill()
                    ->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)
                    ->getStartColor()->setARGB('9df3ff');
        $objPHPExcel->getActiveSheet()->getStyle("C2:C84")->getAlignment()->setHorizontal('center');
                
        $objPHPExcel->getActiveSheet()->getStyle("D1")->getFill()
                    ->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)
                    ->getStartColor()->setARGB('7dabea');
        $objPHPExcel->getActiveSheet()->getStyle("D1")->getAlignment()->setHorizontal('center');
        $objPHPExcel->getActiveSheet()->getStyle("D2:D84")->getFill()
                    ->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)
                    ->getStartColor()->setARGB('9df3ff');
        $objPHPExcel->getActiveSheet()->getStyle("D2:D84")->getAlignment()->setHorizontal('right');

        $objPHPExcel->getActiveSheet()->getStyle("E1")->getFill()
                    ->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)
                    ->getStartColor()->setARGB('7dabea');
        $objPHPExcel->getActiveSheet()->getStyle("E1")->getAlignment()->setHorizontal('center');
        $objPHPExcel->getActiveSheet()->getStyle("E2:E84")->getFill()
                    ->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)
                    ->getStartColor()->setARGB('9df3ff');
        $objPHPExcel->getActiveSheet()->getStyle("E2:E84")->getAlignment()->setHorizontal('right');
                
        $objPHPExcel->getActiveSheet()->getStyle("F1")->getFill()
                    ->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)
                    ->getStartColor()->setARGB('7dabea');
        $objPHPExcel->getActiveSheet()->getStyle("F1")->getAlignment()->setHorizontal('center');
        $objPHPExcel->getActiveSheet()->getStyle("F2:F84")->getFill()
                    ->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)
                    ->getStartColor()->setARGB('9df3ff');
        $objPHPExcel->getActiveSheet()->getStyle("F2:F84")->getAlignment()->setHorizontal('center');

        $objPHPExcel->getActiveSheet()->getStyle("G1")->getFill()
                    ->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)
                    ->getStartColor()->setARGB('7dabea');
        $objPHPExcel->getActiveSheet()->getStyle("G1")->getAlignment()->setHorizontal('center');
        $objPHPExcel->getActiveSheet()->getStyle("G2:G84")->getFill()
                    ->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)
                    ->getStartColor()->setARGB('d1d1d1');
        $objPHPExcel->getActiveSheet()->getStyle("G2:G84")->getAlignment()->setHorizontal('right');

        foreach($akg as $akg){     
                $akg_karbo = $total_harga['total_karbohidrat']*($akg->karbohidrat_total/100);
                $akg_protein = $total_harga['total_protein']*($akg->protein/100);
                $akg_jenuh = $total_harga['total_sfa']*($akg->lemak_jenuh/100);
                $akg_pangan =$total_harga['total_serat']*($akg->serat_pangan/100);
                $na = $total_harga['total_na']*($akg->natrium/100);
                $k = $total_harga['total_k']* ($akg->kalium/100);
                $ca = $total_harga['total_ca']*($akg->kalsium/100);
                $p = $total_harga['total_p']*($akg->fosfor/100);
                $mg = $total_harga['total_mg']*($akg->magnesium*100);
                $vitA = $total_harga['total_vitA'] * ($akg->vitamin_a/100);
                $vitB1 = $total_harga['total_vitB1'] * ($akg->vitamin_b1/100);
                $vitB2 = $total_harga['total_vitB2'] * ($akg->vitamin_b2/100);
                $vitB3 = $total_harga['total_vitB3'] * ($akg->vitamin_b3/100);
                $vitB5 = $total_harga['total_vitB5'] * ($akg->vitamin_b5/100);
                $vitB6 = $total_harga['total_vitB6'] * ($akg->vitamin_b6/100);
                $vitB12 = $total_harga['total_vitB12'] * ($akg->vitamin_b12/100);
                $vitC = $total_harga['total_vitC'] * ($akg->vitamin_c/100);
                $vitD = $total_harga['total_vitD'] * ($akg->vitamin_d/100);
                $vitE = $total_harga['total_vitE'] * ($akg->vitamin_e/100);
                $vitK =  $total_harga['total_vitK'] * ($akg->vitamin_k/100);
                $kolin = $total_harga['total_kolin']*($akg->kolin*100);
                $biotin = $total_harga['total_biotin'] * ($akg->biotin/100);
                $cr = $total_harga['total_cr']*($akg->kromium*100);

            $objPHPExcel->setActiveSheetIndex(0)
                ->setCellValue('A2', 'Energi Total')              ->setCellValue('B2', $total_harga['total_energi'])       ->setCellValue('C2', 'kkal') ->setCellValue('D2', 'NA')        ->setCellValue('E2', $akg['energi'])           ->setCellValue('F2', 'kkal') ->setCellValue('G2', $total_harga['total_energi'] * ($formula->overage/100))
                ->setCellValue('A3', 'Energi Dari Lemak')         ->setCellValue('B3', $total_harga['total_lemak_total']*9)->setCellValue('C3', 'kkal') ->setCellValue('D3', 'NA')        ->setCellValue('E3', 'NA')                     ->setCellValue('F3', 'kkal') ->setCellValue('G3', ($total_harga['total_lemak_total']*9) * ($formula->overage/100))
                ->setCellValue('A4', 'Energi Lemak Jenuh')        ->setCellValue('B4', $total_harga['total_lemak_jenuh']*9)->setCellValue('C4', 'kkal') ->setCellValue('D4', 'NA')        ->setCellValue('E4', 'NA')                     ->setCellValue('F4', 'kkal') ->setCellValue('G4', ($total_harga['total_lemak_jenuh']*9) * ($formula->overage/100))
                ->setCellValue('A5', 'Karbohidrat Total')         ->setCellValue('B5', $total_harga['total_karbohidrat'])  ->setCellValue('C5', 'g')    ->setCellValue('D5', $akg_karbo)  ->setCellValue('E5', $akg['karbohidrat_total'])->setCellValue('F5', 'g')    ->setCellValue('G5', $total_harga['total_karbohidrat'] * ($formula->overage/100))
                ->setCellValue('A6', 'Protein')                   ->setCellValue('B6', $total_harga['total_protein'])      ->setCellValue('C6', 'g')    ->setCellValue('D6', $akg_protein)->setCellValue('E6', $akg['protein'])          ->setCellValue('F6', 'g')    ->setCellValue('G6', $total_harga['total_protein'] * ($formula->overage/100))
                ->setCellValue('A7', 'Lemak Total')               ->setCellValue('B7', $total_harga['total_lemak_total'])  ->setCellValue('C7', 'g')    ->setCellValue('D7', 'NA')        ->setCellValue('E7', $akg['lemak_total'])      ->setCellValue('F7', 'g')    ->setCellValue('G7', $total_harga['total_lemak_total'] * ($formula->overage/100))
                ->setCellValue('A8', 'Lemak Trans')               ->setCellValue('B8', 'NA')                               ->setCellValue('C8', 'g')    ->setCellValue('D8', 'NA')        ->setCellValue('E8', 'NA')                     ->setCellValue('F8', 'g')    ->setCellValue('G8', 'NA')
                ->setCellValue('A9', 'Lemak Jenuh')               ->setCellValue('B9', $total_harga['total_sfa'])          ->setCellValue('C9', 'g')    ->setCellValue('D9', $akg_jenuh)  ->setCellValue('E9', $akg['lemak_jenuh'])      ->setCellValue('F9', 'g')    ->setCellValue('G9', $total_harga['total_sfa'] * ($formula->overage/100))
                ->setCellValue('A10', 'Lemak Tidak Jenuh Tunggal')->setCellValue('B10', 'NA')                              ->setCellValue('C10', 'g')   ->setCellValue('D10', 'NA')       ->setCellValue('E10', 'NA')                    ->setCellValue('F10', 'g')   ->setCellValue('G10', 'NA')
                ->setCellValue('A11', 'Lemak Tidak Jenuh Ganda')  ->setCellValue('B11', 'NA')                              ->setCellValue('C11', 'g')   ->setCellValue('D11', 'NA')       ->setCellValue('E11', 'NA')                    ->setCellValue('F11', 'g')   ->setCellValue('G11', 'NA')
                ->setCellValue('A12', 'Kolestrol')                ->setCellValue('B12', $total_harga['total_kolestrol'])   ->setCellValue('C12', 'mg')  ->setCellValue('D12', 'NA')       ->setCellValue('E12', $akg['kolesterol'])      ->setCellValue('F12', 'mg')  ->setCellValue('G12', $total_harga['total_kolestrol'] * ($formula->overage/100))
                ->setCellValue('A13', 'Gula')                     ->setCellValue('B13', $total_harga['total_gula'])        ->setCellValue('C13', 'g')   ->setCellValue('D13', 'NA')       ->setCellValue('E13', 'NA')                    ->setCellValue('F13', 'g')   ->setCellValue('G13', $total_harga['total_gula'] * ($formula->overage/100))
                ->setCellValue('A14', 'Serat Pangan')             ->setCellValue('B14', $total_harga['total_serat'])       ->setCellValue('C14', 'g')   ->setCellValue('D14', $akg_pangan)->setCellValue('E14', $akg['serat_pangan'])    ->setCellValue('F14', 'g')   ->setCellValue('G14', $total_harga['total_serat'] * ($formula->overage/100))
                ->setCellValue('A15', 'Serat Pangan Larut')       ->setCellValue('B15', $total_harga['total_serat'])       ->setCellValue('C15', 'g')   ->setCellValue('D15', 'NA')       ->setCellValue('E15', 'NA')                    ->setCellValue('F15', 'g')   ->setCellValue('G15', $total_harga['total_serat'] * ($formula->overage/100))
                ->setCellValue('A16', 'Serat Pangan Tidak Larut') ->setCellValue('B16', 'NA')                              ->setCellValue('C16', 'g')   ->setCellValue('D16', 'NA')       ->setCellValue('E16', 'NA')                    ->setCellValue('F16', 'g')   ->setCellValue('G16', 'NA')
                ->setCellValue('A17', 'Sukrosa')                  ->setCellValue('B17', $total_harga['total_sukrosa'])     ->setCellValue('C17', 'g')   ->setCellValue('D17', 'NA')       ->setCellValue('E17', 'NA')                    ->setCellValue('F17', 'g')   ->setCellValue('G17', $total_harga['total_sukrosa'] * ($formula->overage/100))
                ->setCellValue('A18', 'Laktosa')                  ->setCellValue('B18', $total_harga['total_laktosa'])     ->setCellValue('C18', 'g')   ->setCellValue('D18', 'NA')       ->setCellValue('E18', 'NA')                    ->setCellValue('F18', 'g')   ->setCellValue('G18', $total_harga['total_laktosa'] * ($formula->overage/100))
                ->setCellValue('A19', 'Gula Alkohol')             ->setCellValue('B19', 'NA')                              ->setCellValue('C19', 'g')   ->setCellValue('D19', 'NA')       ->setCellValue('E19', 'NA')                    ->setCellValue('F19', 'g')   ->setCellValue('G19', 'NA')
                ->setCellValue('A20', 'Natrium')                  ->setCellValue('B20', $total_harga['total_na'])          ->setCellValue('C20', 'mg')  ->setCellValue('D20', $na)        ->setCellValue('E20', $akg['natrium'])         ->setCellValue('F20', 'mg')  ->setCellValue('G20', $total_harga['total_na'] * ($formula->overage/100))
                ->setCellValue('A21', 'Kalium')                   ->setCellValue('B21', $total_harga['total_k'])           ->setCellValue('C21', 'mg')  ->setCellValue('D21', $k)         ->setCellValue('E21', $akg['kalium'])          ->setCellValue('F21', 'mg')  ->setCellValue('G21', $total_harga['total_k'] * ($formula->overage/100))
                ->setCellValue('A22', 'Kalsium')                  ->setCellValue('B22', $total_harga['total_ca'])          ->setCellValue('C22', 'mg')  ->setCellValue('D22', $ca)        ->setCellValue('E22', $akg['kalsium'])         ->setCellValue('F22', 'mg')  ->setCellValue('G22', $total_harga['total_ca'] * ($formula->overage/100))
                ->setCellValue('A23', 'Zat Besi')                 ->setCellValue('B23', 'NA')                              ->setCellValue('C23', 'mg')  ->setCellValue('D23', 'NA')       ->setCellValue('E23', $akg['besi'])            ->setCellValue('F23', 'mg')  ->setCellValue('G23', 'NA')
                ->setCellValue('A24', 'Fosfor')                   ->setCellValue('B24', $total_harga['total_p'])           ->setCellValue('C24', 'mg')  ->setCellValue('D24', $p)         ->setCellValue('E24', $akg['fosfor'])          ->setCellValue('F24', 'mg')  ->setCellValue('G24', $total_harga['total_p'] * ($formula->overage/100))
                ->setCellValue('A25', 'Magnesium')                ->setCellValue('B25', $total_harga['total_mg'])          ->setCellValue('C25', 'mg')  ->setCellValue('D25', $mg)        ->setCellValue('E25', $akg['magnesium'])       ->setCellValue('F25', 'mg')  ->setCellValue('G25', $total_harga['total_mg'] * ($formula->overage/100))
                ->setCellValue('A26', 'Seng')                     ->setCellValue('B26', 'NA')                              ->setCellValue('C26', 'mg')  ->setCellValue('D26', 'NA')       ->setCellValue('E26', $akg['seng'])            ->setCellValue('F26', 'mg')  ->setCellValue('G26', 'NA')
                ->setCellValue('A27', 'Selenium')                 ->setCellValue('B27', 'NA')                              ->setCellValue('C27', 'mcg') ->setCellValue('D27', 'NA')       ->setCellValue('E27', $akg['selenium'])        ->setCellValue('F27', 'mcg') ->setCellValue('G27', 'NA')
                ->setCellValue('A28', 'Lodium')                   ->setCellValue('B28', 'NA')                              ->setCellValue('C28', 'mcg') ->setCellValue('D28', 'NA')       ->setCellValue('E28', $akg['lodium'])          ->setCellValue('F28', 'mcg') ->setCellValue('G28', 'NA')
                ->setCellValue('A29', 'Mangan')                   ->setCellValue('B29', 'NA')                              ->setCellValue('C29', 'mg')  ->setCellValue('D29', 'NA')       ->setCellValue('E29', $akg['mangan'])          ->setCellValue('F29', 'mg')  ->setCellValue('G29', 'NA')
                ->setCellValue('A30', 'Flour')                    ->setCellValue('B30', 'NA')                              ->setCellValue('C30', 'mg')  ->setCellValue('D30', 'NA')       ->setCellValue('E30', $akg['fluor'])           ->setCellValue('F30', 'mg')  ->setCellValue('G30', 'NA')
                ->setCellValue('A31', 'Tembaga')                  ->setCellValue('B31', 'NA')                              ->setCellValue('C31', '')    ->setCellValue('D31', 'NA')       ->setCellValue('E31', 'NA')                    ->setCellValue('F31', '')    ->setCellValue('G31', 'NA')
                ->setCellValue('A32', 'Vitamin A')                ->setCellValue('B32', $total_harga['total_vitA'])        ->setCellValue('C32', 'IU')  ->setCellValue('D32', $vitA)      ->setCellValue('E32', $akg['vitamin_a'])       ->setCellValue('F32', 'IU')  ->setCellValue('G32', $total_harga['total_vitA'] * ($formula->overage/100))
                ->setCellValue('A33', 'Vitamin B1')               ->setCellValue('B33', $total_harga['total_vitB1'])       ->setCellValue('C33', 'mg')  ->setCellValue('D33', $vitB1)     ->setCellValue('E33', $akg['vitamin_b1'])      ->setCellValue('F33', 'mg')  ->setCellValue('G33', $total_harga['total_vitB1'] * ($formula->overage/100))
                ->setCellValue('A34', 'Vitamin B2')               ->setCellValue('B34', $total_harga['total_vitB2'])       ->setCellValue('C34', 'mg')  ->setCellValue('D34', $vitB2)     ->setCellValue('E34', $akg['vitamin_b2'])      ->setCellValue('F34', 'mg')  ->setCellValue('G34', $total_harga['total_vitB2'] * ($formula->overage/100))
                ->setCellValue('A35', 'Vitamin B3')               ->setCellValue('B35', $total_harga['total_vitB3'])       ->setCellValue('C35', 'mg')  ->setCellValue('D35', $vitB3)     ->setCellValue('E35', $akg['vitamin_b3'])      ->setCellValue('F35', 'mg')  ->setCellValue('G35', $total_harga['total_vitB3'] * ($formula->overage/100))
                ->setCellValue('A36', 'Vitamin B5')               ->setCellValue('B36', $total_harga['total_vitB5'])       ->setCellValue('C36', 'mg')  ->setCellValue('D36', $vitB5)     ->setCellValue('E36', $akg['vitamin_b5'])      ->setCellValue('F36', 'mg')  ->setCellValue('G36', $total_harga['total_vitB5'] * ($formula->overage/100))
                ->setCellValue('A37', 'Vitamin B6')               ->setCellValue('B37', $total_harga['total_vitB6'])       ->setCellValue('C37', 'mg')  ->setCellValue('D37', $vitB6)     ->setCellValue('E37', $akg['vitamin_b6'])      ->setCellValue('F37', 'mg')  ->setCellValue('G37', $total_harga['total_vitB6'] * ($formula->overage/100))
                ->setCellValue('A38', 'Vitamin B12')              ->setCellValue('B38', $total_harga['total_vitB12'])      ->setCellValue('C38', 'mcg') ->setCellValue('D38', $vitB12)    ->setCellValue('E38', $akg['vitamin_b12'])     ->setCellValue('F38', 'mcg') ->setCellValue('G38', $total_harga['total_vitB12'] * ($formula->overage/100))
                ->setCellValue('A39', 'Vitamin C')                ->setCellValue('B39', $total_harga['total_vitC'])        ->setCellValue('C39', 'mg')  ->setCellValue('D39', $vitC)      ->setCellValue('E39', $akg['vitamin_c'])       ->setCellValue('F39', 'mg')  ->setCellValue('G39', $total_harga['total_vitC'] * ($formula->overage/100))
                ->setCellValue('A40', 'Vitamin D3')               ->setCellValue('B40', $total_harga['total_vitD'])        ->setCellValue('C40', 'IU')  ->setCellValue('D40', $vitD)      ->setCellValue('E40', $akg['vitamin_d'])       ->setCellValue('F40', 'IU')  ->setCellValue('G40', $total_harga['total_vitD'] * ($formula->overage/100))
                ->setCellValue('A41', 'Vitamin E')                ->setCellValue('B41', $total_harga['total_vitE'])        ->setCellValue('C41', 'mg')  ->setCellValue('D41', $vitE)      ->setCellValue('E41', $akg['vitamin_e'])       ->setCellValue('F41', 'mg')  ->setCellValue('G41', $total_harga['total_vitE'] * ($formula->overage/100))
                ->setCellValue('A42', 'Asam Folat')               ->setCellValue('B42', $total_harga['total_folat'])       ->setCellValue('C42', 'mcg') ->setCellValue('D42', 'NA')       ->setCellValue('E42', 'NA')                    ->setCellValue('F42', 'mcg') ->setCellValue('G42', $total_harga['total_folat'] * ($formula->overage/100))
                ->setCellValue('A43', 'Magnesium Aspartat')       ->setCellValue('B43', $total_harga['total_aspartat'])    ->setCellValue('C43', 'mg')  ->setCellValue('D43', 'NA')       ->setCellValue('E43', 'NA')                    ->setCellValue('F43', 'mg')  ->setCellValue('G43', $total_harga['total_aspartat'] * ($formula->overage/100))
                ->setCellValue('A44', 'Kolin')                    ->setCellValue('B44', $total_harga['total_kolin'])       ->setCellValue('C44', 'mg')  ->setCellValue('D44', $kolin)     ->setCellValue('E44', $akg['kolin'])           ->setCellValue('F44', 'mg')  ->setCellValue('G44', $total_harga['total_kolin'] * ($formula->overage/100))
                ->setCellValue('A45', 'Biotin')                   ->setCellValue('B45', $total_harga['total_biotin'])      ->setCellValue('C45', 'mcg') ->setCellValue('D45', $biotin)    ->setCellValue('E45', $akg['biotin'])          ->setCellValue('F45', 'mcg') ->setCellValue('G45', $total_harga['total_biotin'] * ($formula->overage/100))
                ->setCellValue('A46', 'Inositol')                 ->setCellValue('B46', 'NA')                              ->setCellValue('C46', 'mg')  ->setCellValue('D46', 'NA')       ->setCellValue('E46', 'NA')                    ->setCellValue('F46', 'mg')  ->setCellValue('G46', 'NA')
                ->setCellValue('A47', 'Molibdenum')               ->setCellValue('B47', 'NA')                              ->setCellValue('C47', 'mcg') ->setCellValue('D47', 'NA')       ->setCellValue('E47', 'NA')                    ->setCellValue('F47', 'mcg') ->setCellValue('G47', 'NA')
                ->setCellValue('A48', 'Kromium')                  ->setCellValue('B48', $total_harga['total_cr'])          ->setCellValue('C48', 'mcg') ->setCellValue('D48', $cr)        ->setCellValue('E48', $akg['kromium'])         ->setCellValue('F48', 'mcg') ->setCellValue('G48', $total_harga['total_cr'] * ($formula->overage/100))
                ->setCellValue('A49', 'EPA')                      ->setCellValue('B49', $total_harga['total_epa'])         ->setCellValue('C49', 'mg')  ->setCellValue('D49', 'NA')       ->setCellValue('E49', 'NA')                    ->setCellValue('F49', 'mg')  ->setCellValue('G49', $total_harga['total_epa'] * ($formula->overage/100))
                ->setCellValue('A50', 'DHA')                      ->setCellValue('B50', $total_harga['total_dha'])         ->setCellValue('C50', 'mg')  ->setCellValue('D50', 'NA')       ->setCellValue('E50', 'NA')                    ->setCellValue('F50', 'mg')  ->setCellValue('G50', $total_harga['total_dha'] * ($formula->overage/100))
                ->setCellValue('A51', 'Glukosamin')               ->setCellValue('B51', $total_harga['total_glukosa'])     ->setCellValue('C51', 'mg')  ->setCellValue('D51', 'NA')       ->setCellValue('E51', 'NA')                    ->setCellValue('F51', 'mg')  ->setCellValue('G51', $total_harga['total_glukosa'] * ($formula->overage/100))
                ->setCellValue('A52', 'Kondroitin')               ->setCellValue('B52', '')                                ->setCellValue('C52', 'mg')  ->setCellValue('D52', 'NA')       ->setCellValue('E52', 'NA')                    ->setCellValue('F52', 'mg')  ->setCellValue('G52', 'NA')
                ->setCellValue('A53', 'Kolagen')                  ->setCellValue('B53', 'NA')                              ->setCellValue('C53', 'mg')  ->setCellValue('D53', 'NA')       ->setCellValue('E53', 'NA')                    ->setCellValue('F53', 'mg')  ->setCellValue('G53', 'NA')
                ->setCellValue('A54', 'EGCG')                     ->setCellValue('B54', 'NA')                              ->setCellValue('C54', 'mg')  ->setCellValue('D54', 'NA')       ->setCellValue('E54', 'NA')                    ->setCellValue('F54', 'mg')  ->setCellValue('G54', 'NA')
                ->setCellValue('A55', 'Kreatina')                 ->setCellValue('B55', '')                                ->setCellValue('C55', 'mg')  ->setCellValue('D55', 'NA')       ->setCellValue('E55', 'NA')                    ->setCellValue('F55', 'mg')  ->setCellValue('G55', 'NA')
                ->setCellValue('A56', 'MCT')                      ->setCellValue('B56', 'NA')                              ->setCellValue('C56', 'g')   ->setCellValue('D56', 'NA')       ->setCellValue('E56', 'NA')                    ->setCellValue('F56', 'g')   ->setCellValue('G56', 'NA')
                ->setCellValue('A57', 'CLA')                      ->setCellValue('B57', '')                                ->setCellValue('C57', 'mg')  ->setCellValue('D57', 'NA')       ->setCellValue('E57', 'NA')                    ->setCellValue('F57', 'mg')  ->setCellValue('G57', 'NA')
                ->setCellValue('A58', 'Omega 3')                  ->setCellValue('B58', $total_harga['total_omega3'])      ->setCellValue('C58', 'g')   ->setCellValue('D58', 'NA')       ->setCellValue('E58', 'NA')                    ->setCellValue('F58', 'g')   ->setCellValue('G58', $total_harga['total_omega3'] * ($formula->overage/100))
                ->setCellValue('A59', 'Omega 6')                  ->setCellValue('B59', $total_harga['total_omega6'])      ->setCellValue('C59', 'g')   ->setCellValue('D59', 'NA')       ->setCellValue('E59', 'NA')                    ->setCellValue('F59', 'g')   ->setCellValue('G59', $total_harga['total_omega6'] * ($formula->overage/100))
                ->setCellValue('A60', 'Omega 9')                  ->setCellValue('B60', 'NA')                              ->setCellValue('C60', 'g')   ->setCellValue('D60', 'NA')       ->setCellValue('E60', 'NA')                    ->setCellValue('F60', 'g')   ->setCellValue('G60', 'NA')
                ->setCellValue('A61', 'Klorida')                  ->setCellValue('B61', 'NA')                              ->setCellValue('C61', 'mg')  ->setCellValue('D61', 'NA')       ->setCellValue('E61', 'NA')                    ->setCellValue('F61', 'mg')  ->setCellValue('G61', 'NA')
                ->setCellValue('A62', 'Asam Linoleat')            ->setCellValue('B62', $total_harga['total_omega6'])      ->setCellValue('C62', 'g')   ->setCellValue('D62', 'NA')       ->setCellValue('E62', 'NA')                    ->setCellValue('F62', 'g')   ->setCellValue('G62', $total_harga['total_omega6'] * ($formula->overage/100))
                ->setCellValue('A63', 'Energi Dari Asam Linoleat')->setCellValue('B63', 'NA')                              ->setCellValue('C63', 'kkal')->setCellValue('D63', 'NA')       ->setCellValue('E63', 'NA')                    ->setCellValue('F63', 'kkal')->setCellValue('G63', 'NA')
                ->setCellValue('A64', 'Energi dari Protein')      ->setCellValue('B64', $total_harga['total_protein']*4)   ->setCellValue('C64', 'kkal')->setCellValue('D64', 'NA')       ->setCellValue('E64', 'NA')                    ->setCellValue('F64', 'kkal')->setCellValue('G64', ($total_harga['total_protein']*4) * ($formula->overage/100))
                ->setCellValue('A65', 'L-Karnitin')               ->setCellValue('B65', '')                                ->setCellValue('C65', 'mg')  ->setCellValue('D65', 'NA')       ->setCellValue('E65', 'NA')                    ->setCellValue('F65', 'mg')  ->setCellValue('G65', 'NA')
                ->setCellValue('A66', 'L-Glutamin')               ->setCellValue('B66', $total_harga['total_l_glutamine']) ->setCellValue('C66', 'mg')  ->setCellValue('D66', 'NA')       ->setCellValue('E66', 'NA')                    ->setCellValue('F66', 'mg')  ->setCellValue('G66', $total_harga['total_l_glutamine'] * ($formula->overage/100))
                ->setCellValue('A67', '**Thereonin')              ->setCellValue('B67', $total_harga['total_threonin'])    ->setCellValue('C67', 'mg')  ->setCellValue('D67', 'NA')       ->setCellValue('E67', 'NA')                    ->setCellValue('F67', 'mg')  ->setCellValue('G67', $total_harga['total_threonin'] * ($formula->overage/100))
                ->setCellValue('A68', '**Methionin')              ->setCellValue('B68', $total_harga['total_methionin'])   ->setCellValue('C68', 'mg')  ->setCellValue('D68', '')         ->setCellValue('E68', '')                      ->setCellValue('F68', 'mg')  ->setCellValue('G68', $total_harga['total_methionin'] * ($formula->overage/100))
                ->setCellValue('A69', '**Phenilalanin')           ->setCellValue('B69', $total_harga['total_phenilalanin'])->setCellValue('C69', 'mg')  ->setCellValue('D69', '')         ->setCellValue('E69', '')                      ->setCellValue('F69', 'mg')  ->setCellValue('G69', $total_harga['total_phenilalanin'] * ($formula->overage/100))
                ->setCellValue('A70', '**Histidin')               ->setCellValue('B70', $total_harga['total_histidin'])    ->setCellValue('C70', 'mg')  ->setCellValue('D70', '')         ->setCellValue('E70', '')                      ->setCellValue('F70', 'mg')  ->setCellValue('G70', $total_harga['total_histidin'] * ($formula->overage/100))
                ->setCellValue('A71', '**Lisin')                  ->setCellValue('B71', $total_harga['total_lisin'])       ->setCellValue('C71', 'mg')  ->setCellValue('D71', '')         ->setCellValue('E71', '')                      ->setCellValue('F71', 'mg')  ->setCellValue('G71', $total_harga['total_lisin'] * ($formula->overage/100))
                ->setCellValue('A72', '**BCAA')                   ->setCellValue('B72', $total_harga['total_BCAA'])        ->setCellValue('C72', 'mg')  ->setCellValue('D72', '')         ->setCellValue('E72', '')                      ->setCellValue('F72', 'mg')  ->setCellValue('G72', $total_harga['total_BCAA'] * ($formula->overage/100))
                ->setCellValue('A73', '**Valin')                  ->setCellValue('B73', $total_harga['total_valin'])       ->setCellValue('C73', 'mg')  ->setCellValue('D73', '')         ->setCellValue('E73', '')                      ->setCellValue('F73', 'mg')  ->setCellValue('G73', $total_harga['total_valin'] * ($formula->overage/100))
                ->setCellValue('A74', '**Isoleusin')              ->setCellValue('B74', $total_harga['total_Isoleusin'])   ->setCellValue('C74', 'mg')  ->setCellValue('D74', '')         ->setCellValue('E74', '')                      ->setCellValue('F74', 'mg')  ->setCellValue('G74', $total_harga['total_Isoleusin'] * ($formula->overage/100))
                ->setCellValue('A75', '**Leusin')                 ->setCellValue('B75', $total_harga['total_leusin'])      ->setCellValue('C75', 'mg')  ->setCellValue('D75', '')         ->setCellValue('E75', '')                      ->setCellValue('F75', 'mg')  ->setCellValue('G75', $total_harga['total_leusin'] * ($formula->overage/100))
                ->setCellValue('A76', 'Alanin')                   ->setCellValue('B76', $total_harga['total_alanin'])      ->setCellValue('C76', 'mg')  ->setCellValue('D76', '')         ->setCellValue('E76', '')                      ->setCellValue('F76', 'mg')  ->setCellValue('G76', $total_harga['total_alanin'] * ($formula->overage/100))
                ->setCellValue('A77', 'Asam Aspartat')            ->setCellValue('B77', $total_harga['total_aspartat'])    ->setCellValue('C77', 'mg')  ->setCellValue('D77', '')         ->setCellValue('E77', '')                      ->setCellValue('F77', 'mg')  ->setCellValue('G77', $total_harga['total_aspartat'] * ($formula->overage/100))
                ->setCellValue('A78', 'Asam Glutamat')            ->setCellValue('B78', $total_harga['total_glutamat'])    ->setCellValue('C78', 'mg')  ->setCellValue('D78', '')         ->setCellValue('E78', '')                      ->setCellValue('F78', 'mg')  ->setCellValue('G78', $total_harga['total_glutamat'] * ($formula->overage/100))
                ->setCellValue('A79', 'Sistein')                  ->setCellValue('B79', $total_harga['total_sistein'])     ->setCellValue('C79', 'mg')  ->setCellValue('D79', '')         ->setCellValue('E79', '')                      ->setCellValue('F79', 'mg')  ->setCellValue('G79', $total_harga['total_sistein'] * ($formula->overage/100))
                ->setCellValue('A80', 'Serin')                    ->setCellValue('B80', $total_harga['total_serin'])       ->setCellValue('C80', 'mg')  ->setCellValue('D80', '')         ->setCellValue('E80', '')                      ->setCellValue('F80', 'mg')  ->setCellValue('G80', $total_harga['total_serin'] * ($formula->overage/100))
                ->setCellValue('A81', 'Glisin')                   ->setCellValue('B81', $total_harga['total_glisin'])      ->setCellValue('C81', 'mg')  ->setCellValue('D81', '')         ->setCellValue('E81', '')                      ->setCellValue('F81', 'mg')  ->setCellValue('G81', $total_harga['total_glisin'] * ($formula->overage/100))
                ->setCellValue('A82', 'Tyrosin')                  ->setCellValue('B82', $total_harga['total_tyrosin'])     ->setCellValue('C82', 'mg')  ->setCellValue('D82', '')         ->setCellValue('E82', '')                      ->setCellValue('F82', 'mg')  ->setCellValue('G82', $total_harga['total_tyrosin'] * ($formula->overage/100))
                ->setCellValue('A83', 'Proline')                  ->setCellValue('B83', $total_harga['total_proline'])     ->setCellValue('C83', 'mg')  ->setCellValue('D83', '')         ->setCellValue('E83', '')                      ->setCellValue('F83', 'mg')  ->setCellValue('G83', $total_harga['total_proline'] * ($formula->overage/100))
                ->setCellValue('A84', 'Arginine')                 ->setCellValue('B84', $total_harga['total_arginine'])    ->setCellValue('C84', 'mg')  ->setCellValue('D84', '')         ->setCellValue('E84', '')                      ->setCellValue('F84', 'mg')  ->setCellValue('G84', $total_harga['total_arginine'] * ($formula->overage/100));
        }          
        $objPHPExcel->getActiveSheet()->setTitle('Nutfact Bayangan');
        $skrg=date('d m Y');
        header('Content-Type: application/vnd.ms-excel'); 
        header('Content-Disposition: attachment;filename="Nutfact_Bayangan '.$skrg.'.xls"'); 
        header('Cache-Control: max-age=0'); 
        $objWriter = \PhpOffice\PhpSpreadsheet\IOFactory::createWriter($objPHPExcel, "Xlsx");
        ob_end_clean();
        $objWriter->save('php://output');
    }
}
