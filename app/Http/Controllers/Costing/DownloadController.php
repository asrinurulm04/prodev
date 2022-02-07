<?php

namespace App\Http\Controllers\Costing;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\IOFactory;

use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use Illuminate\Support\Facades\Validator;
use App\model\nutfact\AllergenFormula;
use App\model\pkp\PkpProject;
use App\model\pdf\SubPDF;
use App\model\Modelkemas\datakemas;
use App\model\Modelkemas\KonsepKemas;
use App\model\Modelkemas\FormulaKemas;
use App\model\feasibility\FormPengajuanFS;
use App\model\feasibility\Feasibility;
use App\model\Modelmaklon\Maklon;
use App\model\Modellab\DataLab;
use App\model\Modelmesin\OH;
use App\model\Modelmesin\Mesin;
use App\model\formula\Formula;
use App\model\formula\Fortail;
use App\model\formula\Bahan;
use App\model\master\Curren;
use DB;

class DownloadController extends Controller
{
    public function CostingDownloadPKP($project,$formula,$fs){ // download FOR PKP
        $objPHPExcel = new Spreadsheet();
        // Sheet 1 /FOR PKP 
            $objPHPExcel->setActiveSheetIndex(0); 
            $objPHPExcel->getActiveSheet()->getColumnDimension('A')->setWidth(25.00);
            $objPHPExcel->getActiveSheet()->getColumnDimension('B')->setWidth(25.00);
            $objPHPExcel->getActiveSheet()->getColumnDimension('C')->setWidth(20.00);
            $objPHPExcel->getActiveSheet()->getColumnDimension('D')->setWidth(9.00);
            $objPHPExcel->getActiveSheet()->getColumnDimension('E')->setWidth(20.00);
            $objPHPExcel->getActiveSheet()->getColumnDimension('F')->setWidth(20.00);
            $objPHPExcel->getActiveSheet()->getColumnDimension('G')->setWidth(9.00);
            $objPHPExcel->getActiveSheet()->getColumnDimension('H')->setWidth(20.00);
            $objPHPExcel->getActiveSheet()->getColumnDimension('I')->setWidth(20.00);
            $objPHPExcel->getActiveSheet()->getColumnDimension('J')->setWidth(9.00);
            $objPHPExcel->getActiveSheet()->getColumnDimension('K')->setWidth(20.00);

            $for        = Formula::where('id',$formula)->first();
			$fortails 	= Fortail::where('formula_id',$formula)->get();

            $objPHPExcel->setActiveSheetIndex(0)
                        ->setCellValue('A1', 'HPP Bahan Baku')
                        ->setCellValue('A2', 'Bahan Baku')
                        ->setCellValue('E2', 'Per Serving')
                        ->setCellValue('H2', 'Per Batch')
                        ->setCellValue('K2', 'Per Serving');
            $objPHPExcel->getActiveSheet()->mergeCells('A1:K1');
            $objPHPExcel->getActiveSheet()->mergeCells('A2:C2');
            $objPHPExcel->getActiveSheet()->mergeCells('E2:F2');
            $objPHPExcel->getActiveSheet()->mergeCells('H2:I2');
            $objPHPExcel->getActiveSheet()->getStyle("A1:K1")->getAlignment()->setHorizontal('center');
            $objPHPExcel->getActiveSheet()->getStyle("A2:K2")->getAlignment()->setHorizontal('center');

            $objPHPExcel->setActiveSheetIndex(0)
                        ->setCellValue('A3', 'Kode Oracle')
                        ->setCellValue('B3', 'Nama Bahan')
                        ->setCellValue('C3', 'Harga PerGram')
                        ->setCellValue('E3', 'Berat')
                        ->setCellValue('F3', 'Harga PerGram')
                        ->setCellValue('H3', 'Berat')
                        ->setCellValue('I3', 'Harga')
                        ->setCellValue('K3', 'Harga');

            $objPHPExcel->getActiveSheet()->getStyle("A1:K1")->getFill()
                        ->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)
                        ->getStartColor()->setARGB('13DFE4');
            $objPHPExcel->getActiveSheet()->getStyle("A3:C3")->getFill()
                        ->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)
                        ->getStartColor()->setARGB('8c8888');
            $objPHPExcel->getActiveSheet()->getStyle("E3:F3")->getFill()
                        ->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)
                        ->getStartColor()->setARGB('8c8888');
            $objPHPExcel->getActiveSheet()->getStyle("H3:I3")->getFill()
                        ->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)
                        ->getStartColor()->setARGB('8c8888');
            $objPHPExcel->getActiveSheet()->getStyle("K3")->getFill()
                        ->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)
                        ->getStartColor()->setARGB('8c8888');
            $objPHPExcel->getActiveSheet()->getStyle("A3:K3")->getAlignment()->setHorizontal('center');

            $pertama = 4;
            foreach($fortails as $_data){
				$bahan      = Bahan::where('id',$_data->bahan_id)->first();
				$curren 	= Curren::where('id',$bahan->curren_id)->first();
				// Harga Pergram
				if($bahan->satuan=='Kg'){
					$hpg = ($bahan->harga_satuan * $curren->harga)/1000;  $hpg = round($hpg,2); 
				}elseif($bahan->satuan=='Mg'){
					$hpg = ($bahan->harga_satuan * $curren->harga)/0.001; $hpg = round($hpg,2); 
				}elseif($bahan->satuan=='G'){
					$hpg = ($bahan->harga_satuan * $curren->harga); 	  $hpg = round($hpg,2); 
				}
				// PerServing
				$berat_per_serving = $_data->per_serving;  			                    $berat_per_serving  = round($berat_per_serving,5);
				$harga_per_serving = $berat_per_serving * $hpg; 						$harga_per_serving  = round($harga_per_serving,2);
				// Per Batch
				$berat_per_batch   = $_data->per_batch;  								$berat_per_batch    = round($berat_per_batch,5);
				$harga_per_batch   = $berat_per_batch * $hpg;  							$harga_per_batch    = round($harga_per_batch,2);
				// Per Kg
				$berat_per_kg      = (1000 * $berat_per_serving)/$for->serving;      	$berat_per_kg 	    = round($berat_per_kg,5);
				$harga_per_kg      = $bahan->harga_satuan;  							$harga_per_kg 	    = round($harga_per_kg,2); 

                $objPHPExcel->setActiveSheetIndex(0)
                    ->setCellValue('A'.$pertama, $_data['kode_oracle'])
                    ->setCellValue('B'.$pertama, $_data['nama_sederhana'])
                    ->setCellValue('C'.$pertama, $hpg)
                    ->setCellValue('E'.$pertama, $_data['per_serving'])
                    ->setCellValue('F'.$pertama, $harga_per_serving)
                    ->setCellValue('H'.$pertama, $_data['per_batch'])
                    ->setCellValue('I'.$pertama, $harga_per_batch)
                    ->setCellValue('K'.$pertama, $harga_per_kg);
                $pertama++;
            }
            $objPHPExcel->getActiveSheet()->setTitle('HPP PKP');
        // Sheet 1 Selesai

        // Create a new worksheet2
            $objPHPExcel->createSheet();
            $objPHPExcel->setActiveSheetIndex(1); 
            $objPHPExcel->getActiveSheet(1)->getColumnDimension('A')->setWidth(25.00);
            $objPHPExcel->getActiveSheet(1)->getColumnDimension('B')->setWidth(25.00);
            $objPHPExcel->getActiveSheet(1)->getColumnDimension('C')->setWidth(25.00);
            $objPHPExcel->getActiveSheet(1)->getColumnDimension('D')->setWidth(25.00);
            $objPHPExcel->getActiveSheet(1)->getColumnDimension('E')->setWidth(25.00);
            $objPHPExcel->getActiveSheet(1)->getColumnDimension('F')->setWidth(25.00);
            $objPHPExcel->getActiveSheet(1)->getColumnDimension('G')->setWidth(25.00);
            $objPHPExcel->getActiveSheet(1)->getColumnDimension('H')->setWidth(25.00);
            $objPHPExcel->getActiveSheet(1)->getColumnDimension('I')->setWidth(25.00);
            $objPHPExcel->getActiveSheet(1)->getColumnDimension('J')->setWidth(25.00);
            $objPHPExcel->getActiveSheet(1)->getColumnDimension('K')->setWidth(25.00);
            $objPHPExcel->getActiveSheet(1)->getColumnDimension('L')->setWidth(25.00);
            $objPHPExcel->getActiveSheet(1)->getColumnDimension('M')->setWidth(25.00);
            $objPHPExcel->getActiveSheet(1)->getColumnDimension('N')->setWidth(25.00);
            $objPHPExcel->getActiveSheet(1)->getColumnDimension('O')->setWidth(25.00);
            $objPHPExcel->getActiveSheet(1)->getColumnDimension('P')->setWidth(25.00);
            $objPHPExcel->getActiveSheet(1)->getColumnDimension('Q')->setWidth(25.00);
            $objPHPExcel->getActiveSheet(1)->getColumnDimension('R')->setWidth(25.00);
            $objPHPExcel->getActiveSheet(1)->getColumnDimension('S')->setWidth(25.00);
            $objPHPExcel->getActiveSheet(1)->getColumnDimension('T')->setWidth(25.00);
            $objPHPExcel->getActiveSheet(1)->getColumnDimension('U')->setWidth(25.00);
            $objPHPExcel->getActiveSheet(1)->getColumnDimension('V')->setWidth(25.00);
            $objPHPExcel->getActiveSheet(1)->getColumnDimension('W')->setWidth(25.00);
            $objPHPExcel->getActiveSheet(1)->getColumnDimension('X')->setWidth(25.00);
            $objPHPExcel->getActiveSheet(1)->getColumnDimension('Y')->setWidth(25.00);
            $objPHPExcel->getActiveSheet(1)->getColumnDimension('Z')->setWidth(25.00);

            $iddesc = DataLab::where('id_fs',$fs)->join('ms_item_desc','ms_item_desc.id','tr_lab.id_item_desc')->first();
            $form   = FormPengajuanFS::where('id_feasibility',$fs)->first();

            $objPHPExcel->setActiveSheetIndex(1);
            $objPHPExcel->getActiveSheet()->setCellValue('A1', 'Item Desc');
            $objPHPExcel->getActiveSheet()->setCellValue('B1', 'PLANT');
            $objPHPExcel->getActiveSheet()->setCellValue('C1', 'Lokasi analisa');
            $objPHPExcel->getActiveSheet()->setCellValue('D1', 'Total batch');
            $objPHPExcel->getActiveSheet()->setCellValue('E1', 'para x spl (BB)/batch');
            $objPHPExcel->getActiveSheet()->setCellValue('F1', 'para x sampel (swab)/batch');
            $objPHPExcel->getActiveSheet()->setCellValue('G1', 'Parameter mikro rilis');
            $objPHPExcel->getActiveSheet()->setCellValue('H1', 'Para x sampel analisa rutin');
            $objPHPExcel->getActiveSheet()->setCellValue('I1', 'Jlh sampel mikro/batch');
            $objPHPExcel->getActiveSheet()->setCellValue('J1', 'Jlh sampel mikro analisa/thn');
            $objPHPExcel->getActiveSheet()->setCellValue('K1', 'Biaya analisa mikro rutin/sampel');
            $objPHPExcel->getActiveSheet()->setCellValue('L1', 'Biaya mikro rutin/batch');
            $objPHPExcel->getActiveSheet()->setCellValue('M1', 'Biaya mikro rutin/tahun');
            $objPHPExcel->getActiveSheet()->setCellValue('N1', 'Biaya analisa tahunan/sampel');
            $objPHPExcel->getActiveSheet()->setCellValue('O1', 'Biaya analisa tahunan/SKU');
            $objPHPExcel->getActiveSheet()->setCellValue('P1', 'Estimasi Biaya mikro analisa BB/batch');
            $objPHPExcel->getActiveSheet()->setCellValue('Q1', 'Estimasi Biaya mikro analisa BB/tahun');
            $objPHPExcel->getActiveSheet()->setCellValue('R1', 'Estimasi biaya analisa swab/batch');
            $objPHPExcel->getActiveSheet()->setCellValue('S1', 'Estimasi biaya analisa swab/tahun');
            $objPHPExcel->getActiveSheet()->setCellValue('T1', 'Estimasi biaya tahanan (resampling)/batch');
            $objPHPExcel->getActiveSheet()->setCellValue('U1', 'Estimasi biaya tahanan (resampling/tahun)');
            $objPHPExcel->getActiveSheet()->setCellValue('V1', 'Estimasi biaya kimia/batch');
            $objPHPExcel->getActiveSheet()->setCellValue('W1', 'Estimasi biaya analisa kimia/tahun');
            $objPHPExcel->getActiveSheet()->setCellValue('X1', 'Biaya total/SKU');
            $objPHPExcel->getActiveSheet()->setCellValue('Y1', 'Biaya total analisa/batch');
            $objPHPExcel->getActiveSheet()->setCellValue('Z1', 'Total Para x spl/batch');

            $objPHPExcel->getActiveSheet()->getStyle("A1:Z1")->getFill()
                        ->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)
                        ->getStartColor()->setARGB('13DFE4');
            $objPHPExcel->getActiveSheet()->getStyle("A1:Z1")->getAlignment()->setHorizontal('center');

            // Hitung rumus Analisa
            $biaya_mikro_rutin = $iddesc->biaya_analisa * $iddesc->jlh_sample_mikro;
            $biaya_mikro_tahun   = $biaya_mikro_rutin * $form->batch_size;
            $mikro_analisa_bb    = $iddesc->mikro_analisa * $form->batch_size;
            $swab_analisa_thn    = $iddesc->analisa_swab * $form->batch_size;
            $resampling_thn      = $iddesc->biaya_tahanan * $form->batch_size;
            $biaya_analisa_kimia = $iddesc->kimia_batch * $form->batch_size;
            $total_sku           = $biaya_analisa_kimia + $resampling_thn + $swab_analisa_thn + $mikro_analisa_bb + $biaya_mikro_tahun + $iddesc->biaya_analisa_tahun;
            $total_analisa       = $total_sku / $form->batch_size;
            $total_para          = $iddesc->sample_swab + $iddesc->sample_analisa;

            $objPHPExcel->setActiveSheetIndex(1)
                        ->setCellValue('A2', $iddesc['item_desc'])
                        ->setCellValue('B2', $iddesc['io'])
                        ->setCellValue('C2', $iddesc['lokasi'])
                        ->setCellValue('D2', $form['batch_size'])
                        ->setCellValue('E2', $iddesc['spl_batch'])
                        ->setCellValue('F2', $iddesc['sample_swab'])
                        ->setCellValue('G2', $iddesc['parameter_mikro'])
                        ->setCellValue('H2', $iddesc['sample_analisa'])
                        ->setCellValue('I2', $iddesc['jlh_sample_mikro'])
                        ->setCellValue('J2', $iddesc['jlh_mikro_tahunan'])
                        ->setCellValue('K2', $iddesc['biaya_analisa'])
                        ->setCellValue('L2', $biaya_mikro_rutin)
                        ->setCellValue('M2', $biaya_mikro_tahun)
                        ->setCellValue('N2', $iddesc['biaya_analisa_tahun'])
                        ->setCellValue('O2', $iddesc['biaya_analisa_tahun'])
                        ->setCellValue('P2', $iddesc['mikro_analisa'])
                        ->setCellValue('Q2', $mikro_analisa_bb)
                        ->setCellValue('R2', $iddesc['analisa_swab'])
                        ->setCellValue('S2', $swab_analisa_thn)
                        ->setCellValue('T2', $iddesc['biaya_tahanan'])
                        ->setCellValue('U2', $resampling_thn)
                        ->setCellValue('V2', $iddesc['kimia_batch'])
                        ->setCellValue('W2', $biaya_analisa_kimia)
                        ->setCellValue('X2', $total_sku)
                        ->setCellValue('Y2', $total_analisa)
                        ->setCellValue('Z2', $total_para);

            // Rename 2nd sheet
            $objPHPExcel->getActiveSheet()->setTitle('Form Biaya Analisa');
        // Sheet 2 Selesai

        // Create a new worksheet3 Maklon
            $objPHPExcel->createSheet();
            $objPHPExcel->setActiveSheetIndex(2); 
            $objPHPExcel->getActiveSheet(2)->getColumnDimension('A')->setWidth(20.00);
            $objPHPExcel->getActiveSheet(2)->getColumnDimension('B')->setWidth(20.00);
            $objPHPExcel->getActiveSheet(2)->getColumnDimension('C')->setWidth(35.00);
            $objPHPExcel->getActiveSheet(2)->getColumnDimension('D')->setWidth(20.00);
            $objPHPExcel->getActiveSheet(2)->getColumnDimension('E')->setWidth(35.00);

            $maklon = Maklon::where('id_fs',$fs)->first();

            $objPHPExcel->setActiveSheetIndex(2);
            $objPHPExcel->getActiveSheet()->setCellValue('A1', 'Biaya Maklon/UOM');
            $objPHPExcel->getActiveSheet()->setCellValue('B1', 'Satuan');
            $objPHPExcel->getActiveSheet()->setCellValue('C1', 'Remarks');
            $objPHPExcel->getActiveSheet()->setCellValue('D1', 'Biaya Transport/UOM');
            $objPHPExcel->getActiveSheet()->setCellValue('E1', 'NRemarks');

            $objPHPExcel->getActiveSheet()->getStyle("A1:E1")->getFill()
                        ->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)
                        ->getStartColor()->setARGB('13DFE4');
            $objPHPExcel->getActiveSheet()->getStyle("A1:E1")->getAlignment()->setHorizontal('center');
            $objPHPExcel->getActiveSheet()->getStyle("A2:E2")->getAlignment()->setHorizontal('center');

            $objPHPExcel->setActiveSheetIndex(2)
                        ->setCellValue('A2', $maklon['biaya_maklon'])
                        ->setCellValue('B2', $maklon['satuan'])
                        ->setCellValue('C2', $maklon['remarks_biaya'])
                        ->setCellValue('D2', $maklon['biaya_transport'])
                        ->setCellValue('E2', $maklon['remarks_transport']);

            // Rename sHEET3
            $objPHPExcel->getActiveSheet()->setTitle('Form Maklon');
        // Sheet 3 Selesai

        // Create a new worksheet 4 Mesin
            $objPHPExcel->createSheet();
            $objPHPExcel->setActiveSheetIndex(3); 
            $objPHPExcel->getActiveSheet(3)->getColumnDimension('A')->setWidth(35.00);
            $objPHPExcel->getActiveSheet(3)->getColumnDimension('B')->setWidth(20.00);
            $objPHPExcel->getActiveSheet(3)->getColumnDimension('C')->setWidth(20.00);
            $objPHPExcel->getActiveSheet(3)->getColumnDimension('D')->setWidth(20.00);
            $objPHPExcel->getActiveSheet(3)->getColumnDimension('F')->setWidth(35.00);
            $objPHPExcel->getActiveSheet(3)->getColumnDimension('G')->setWidth(20.00);
            $objPHPExcel->getActiveSheet(3)->getColumnDimension('H')->setWidth(20.00);
            $objPHPExcel->getActiveSheet(3)->getColumnDimension('I')->setWidth(20.00);

            $value=3;
            $nilai=3;
            $feasibility = Feasibility::where('id',$fs)->first();
            $Mdata       = DB::table('tr_mesin')->join('ms_mesin','tr_mesin.id_data_mesin','=','ms_mesin.id_data_mesin')
                        ->where('id_wb_fs',$feasibility->id_wb_proses)->where('kategori','!=','Filling')->where('kategori','!=','Packing')->get();
            $dataO       = OH::where('id_ws',$feasibility->id_wb_proses)->get();
            
            $objPHPExcel->setActiveSheetIndex(3);
            // Informasi Data Mesin
            $objPHPExcel->getActiveSheet()->setCellValue('A2', 'Mesin');
            $objPHPExcel->getActiveSheet()->setCellValue('B2', 'Runtime (menit/batch granulasi)');
            $objPHPExcel->getActiveSheet()->setCellValue('C2', 'Runtime (menit/batch)');
            $objPHPExcel->getActiveSheet()->setCellValue('D2', 'Note');
            // Informasi Data OH
            $objPHPExcel->getActiveSheet()->setCellValue('F2', 'Informasi Biaya Lain-Lain');
            $objPHPExcel->getActiveSheet()->setCellValue('G2', 'Curren');
            $objPHPExcel->getActiveSheet()->setCellValue('H2', 'Nominal');
            $objPHPExcel->getActiveSheet()->setCellValue('I2', 'Note');

            $objPHPExcel->getActiveSheet()->mergeCells('A1:D1');
            $objPHPExcel->setActiveSheetIndex(3)
                        ->setCellValue('A1', 'Data Mesin');

            $objPHPExcel->getActiveSheet()->mergeCells('F1:I1');
            $objPHPExcel->setActiveSheetIndex(3)
                        ->setCellValue('F1', 'Data OH');
            $objPHPExcel->getActiveSheet()->getStyle("A1:I1")->getAlignment()->setHorizontal('center');

            $objPHPExcel->getActiveSheet()->getStyle("A2:D2")->getFill()
                        ->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)
                        ->getStartColor()->setARGB('13DFE4');
            $objPHPExcel->getActiveSheet()->getStyle("F2:I2")->getFill()
                        ->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)
                        ->getStartColor()->setARGB('13DFE4');
            $objPHPExcel->getActiveSheet()->getStyle("A2:I2")->getAlignment()->setHorizontal('center');

            // Data Mesin
            foreach($Mdata as $mesin){
                $objPHPExcel->setActiveSheetIndex(3)
                            ->setCellValue('A'.$value, $mesin->nama_mesin)
                            ->setCellValue('B'.$value, $mesin->runtime_granulasi)
                            ->setCellValue('C'.$value, $mesin->runtime)
                            ->setCellValue('D'.$value, $mesin->note);
                $value++;
            }
            foreach($dataO as $oh){
                $objPHPExcel->setActiveSheetIndex(3)
                            ->setCellValue('F'.$nilai, $oh->mesin)
                            ->setCellValue('G'.$nilai, $oh->Curren)
                            ->setCellValue('H'.$nilai, $oh->nominal)
                            ->setCellValue('I'.$nilai, $oh->note);
                $nilai++;
            }
            // Rename Sheet 4
            $objPHPExcel->getActiveSheet()->setTitle('Data Mesin Dan OH');
        // Sheet 4 Selesai

        // Create a new worksheet 5 Filpack
            $objPHPExcel->createSheet();
            $objPHPExcel->setActiveSheetIndex(4); 
            $objPHPExcel->getActiveSheet(4)->getColumnDimension('A')->setWidth(35.00);
            $objPHPExcel->getActiveSheet(4)->getColumnDimension('B')->setWidth(20.00);
            $objPHPExcel->getActiveSheet(4)->getColumnDimension('C')->setWidth(20.00);
            $objPHPExcel->getActiveSheet(4)->getColumnDimension('D')->setWidth(20.00);
            $objPHPExcel->getActiveSheet(4)->getColumnDimension('E')->setWidth(35.00);
            // Data Manual
            $objPHPExcel->getActiveSheet(4)->getColumnDimension('G')->setWidth(20.00);
            $objPHPExcel->getActiveSheet(4)->getColumnDimension('H')->setWidth(20.00);
            $objPHPExcel->getActiveSheet(4)->getColumnDimension('I')->setWidth(35.00);
            $objPHPExcel->getActiveSheet(4)->getColumnDimension('J')->setWidth(35.00);

            $value=3;
            $nilai=3;
            $feasibility = Feasibility::where('id',$fs)->first();
            $dataM       = DB::table('tr_mesin')->join('ms_mesin','tr_mesin.id_data_mesin','=','ms_mesin.id_data_mesin')->where('id_wb_fs',$feasibility->id_wb_proses)->orwhere('kategori','Filling')->where('kategori','Packing')->get();
            $manual      = Mesin::where('manual','!=',NULL)->where('id_wb_fs',$feasibility->id_wb_proses)->get();
            
            $objPHPExcel->setActiveSheetIndex(4);
            // Informasi Data Mesin
            $objPHPExcel->getActiveSheet()->setCellValue('A2', 'Mesin');
            $objPHPExcel->getActiveSheet()->setCellValue('B2', 'kategori');
            $objPHPExcel->getActiveSheet()->setCellValue('C2', 'SDM (jika berbeda dengan eksis)');
            $objPHPExcel->getActiveSheet()->setCellValue('D2', 'Runtime (menit)');
            $objPHPExcel->getActiveSheet()->setCellValue('E2', 'Note');
            // Informasi Data OH
            $objPHPExcel->getActiveSheet()->setCellValue('G2', 'Manual');
            $objPHPExcel->getActiveSheet()->setCellValue('H2', 'SDM');
            $objPHPExcel->getActiveSheet()->setCellValue('I2', 'Runtime (menit)');
            $objPHPExcel->getActiveSheet()->setCellValue('J2', 'Note');

            $objPHPExcel->getActiveSheet()->mergeCells('A1:E1');
            $objPHPExcel->setActiveSheetIndex(4)
                        ->setCellValue('A1', 'Data Mesin');

            $objPHPExcel->getActiveSheet()->mergeCells('G1:J1');
            $objPHPExcel->setActiveSheetIndex(4)
                        ->setCellValue('G1', 'Data Manual');
            $objPHPExcel->getActiveSheet()->getStyle("A1:J1")->getAlignment()->setHorizontal('center');

            $objPHPExcel->getActiveSheet()->getStyle("A2:E2")->getFill()
                        ->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)
                        ->getStartColor()->setARGB('13DFE4');
            $objPHPExcel->getActiveSheet()->getStyle("G2:J2")->getFill()
                        ->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)
                        ->getStartColor()->setARGB('13DFE4');
            $objPHPExcel->getActiveSheet()->getStyle("A2:J2")->getAlignment()->setHorizontal('center');

            // Data Mesin
            foreach($dataM as $mesin){
                $objPHPExcel->setActiveSheetIndex(4)
                            ->setCellValue('A'.$value, $mesin->nama_mesin)
                            ->setCellValue('B'.$value, $mesin->kategori)
                            ->setCellValue('C'.$value, $mesin->sdm)
                            ->setCellValue('D'.$value, $mesin->runtime)
                            ->setCellValue('E'.$value, $mesin->note);
                $value++;
            }
            foreach($manual as $manual){
                $objPHPExcel->setActiveSheetIndex(4)
                            ->setCellValue('G'.$nilai, $manual->manual)
                            ->setCellValue('H'.$nilai, $manual->sdm)
                            ->setCellValue('I'.$nilai, $manual->runtime)
                            ->setCellValue('J'.$nilai, $manual->note);
                $nilai++;
            }
            // Rename Sheet 5
            $objPHPExcel->getActiveSheet()->setTitle('Data Mesin Fillpack');
        // Sheet 5 Selesai

        // Create a new worksheet 6 Filpack
            $objPHPExcel->createSheet();
            $objPHPExcel->setActiveSheetIndex(5); 
            $objPHPExcel->getActiveSheet(5)->getColumnDimension('A')->setWidth(20.00);
            $objPHPExcel->getActiveSheet(5)->getColumnDimension('B')->setWidth(20.00);
            $objPHPExcel->getActiveSheet(5)->getColumnDimension('C')->setWidth(25.00);
            $objPHPExcel->getActiveSheet(5)->getColumnDimension('D')->setWidth(20.00);
            $objPHPExcel->getActiveSheet(5)->getColumnDimension('E')->setWidth(15.00);
            $objPHPExcel->getActiveSheet(5)->getColumnDimension('F')->setWidth(20.00);
            $objPHPExcel->getActiveSheet(5)->getColumnDimension('G')->setWidth(20.00);
            $objPHPExcel->getActiveSheet(5)->getColumnDimension('H')->setWidth(15.00);
            $objPHPExcel->getActiveSheet(5)->getColumnDimension('I')->setWidth(25.00);
            $objPHPExcel->getActiveSheet(5)->getColumnDimension('J')->setWidth(15.00);
            $objPHPExcel->getActiveSheet(5)->getColumnDimension('K')->setWidth(15.00);
            $objPHPExcel->getActiveSheet(5)->getColumnDimension('L')->setWidth(15.00);
            $objPHPExcel->getActiveSheet(5)->getColumnDimension('M')->setWidth(12.00);
            $objPHPExcel->getActiveSheet(5)->getColumnDimension('N')->setWidth(15.00);
            $objPHPExcel->getActiveSheet(5)->getColumnDimension('O')->setWidth(15.00);
            $objPHPExcel->getActiveSheet(5)->getColumnDimension('P')->setWidth(15.00);
            $objPHPExcel->getActiveSheet(5)->getColumnDimension('Q')->setWidth(12.00);
            $objPHPExcel->getActiveSheet(5)->getColumnDimension('R')->setWidth(12.00);

            $pkp         = PkpProject::where('id_project',$project)->first();
            $eksis       = datakemas::where('id_kemas',$pkp->kemas_eksis)->first();
            $data        = Formula::where('id',$feasibility->id_formula)->first();
            $konsep      = KonsepKemas::where('id_ws',$feasibility->id_wb_kemas)->first();
            $kemas       = FormulaKemas::where('id_ws',$feasibility->id_wb_kemas)->get();
            $kemas2      = FormulaKemas::where('id_ws',$feasibility->id_wb_kemas)->where('cost_box','!=',NULL)->orwhere('cost_dus','!=',NULL)->first();
            $hitungkemas = FormulaKemas::where('id_ws',$feasibility->id_wb_kemas)->count();
            
            // Baris Pertama
            $objPHPExcel->setActiveSheetIndex(5)
                        ->setCellValue('A1', 'PT. NUTRIFOOD INDONESIA');
            $objPHPExcel->getActiveSheet()->mergeCells('A1:B1');
            $objPHPExcel->getActiveSheet()->getStyle("A1")->getAlignment()->setHorizontal('center');

            // Baris Kedua
            $objPHPExcel->setActiveSheetIndex(5)
                        ->setCellValue('A2', 'FORMULA BAHAN KEMAS');
            $objPHPExcel->getActiveSheet()->mergeCells('A2:R2');
            $objPHPExcel->getActiveSheet()->getStyle("A2")->getAlignment()->setHorizontal('center');

            // Baris ketiga
            $objPHPExcel->setActiveSheetIndex(5)
                        ->setCellValue('A3', '(FBK)');
            $objPHPExcel->getActiveSheet()->mergeCells('A3:R3');
            $objPHPExcel->getActiveSheet()->getStyle("A3")->getAlignment()->setHorizontal('center');

            $objPHPExcel->getActiveSheet()->getStyle("A4:D4")->getFill()
                        ->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)
                        ->getStartColor()->setARGB('13DFE4');
            $objPHPExcel->getActiveSheet()->getStyle("A4:d4")->getAlignment()->setHorizontal('center');

            $objPHPExcel->setActiveSheetIndex(5)
                        ->setCellValue('A4', 'Nama')
                        ->setCellValue('A5', $data['formula'])
                        ->setCellValue('B4', 'jumlah kemasan primer')
                        ->setCellValue('B5', $eksis['s_tersier'])
                        ->setCellValue('C4', 'jumlah kemasan sekunder')
                        ->setCellValue('C5', $eksis['s_sekunder1'])
                        ->setCellValue('D4', 'Gr')
                        ->setCellValue('D5', $eksis['s_primer'])
                        ->setCellValue('A7', 'keterangan')
                        ->setCellValue('B7', $konsep['keterangan'])
                        ->setCellValue('A8', 'Formula')
                        ->setCellValue('B8', $data['formula'])
                        ->setCellValue('A9', 'Tanggal ')
                        ->setCellValue('B9', $konsep['created_date'])
                        ->setCellValue('Q7', 'Batch/Yield')
                        ->setCellValue('R7', $konsep['batch_yield'])
                        ->setCellValue('Q8', 'Net Batch')
                        ->setCellValue('R8', $data['batch_size'])
                        ->setCellValue('Q9', 'jumlah Box/Batch ')
                        ->setCellValue('R9', $konsep['jumlah_box']);
            
            $objPHPExcel->getActiveSheet()->getStyle("A11:R11")->getFill()
                        ->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)
                        ->getStartColor()->setARGB('13DFE4');
            $objPHPExcel->getActiveSheet()->getStyle("A11:R11")->getAlignment()->setHorizontal('center');

            $objPHPExcel->setActiveSheetIndex(5);
            $objPHPExcel->getActiveSheet()->setCellValue('A11', 'kode item');
            $objPHPExcel->getActiveSheet()->setCellValue('B11', 'kode komputer');
            $objPHPExcel->getActiveSheet()->setCellValue('C11', 'Description');
            $objPHPExcel->getActiveSheet()->setCellValue('D11', 'Dimensi / Jml Pemakaian');
            $objPHPExcel->getActiveSheet()->setCellValue('E11', 'Spek');
            $objPHPExcel->getActiveSheet()->setCellValue('F11', 'Supplier');
            $objPHPExcel->getActiveSheet()->setCellValue('G11', 'Harga / UoM');
            $objPHPExcel->getActiveSheet()->setCellValue('H11', 'Min. Order');
            $objPHPExcel->getActiveSheet()->setCellValue('I11', 'Cost Kemas');
            $objPHPExcel->getActiveSheet()->setCellValue('J11', 'dus');
            $objPHPExcel->getActiveSheet()->setCellValue('K11', 'box');
            $objPHPExcel->getActiveSheet()->setCellValue('L11', 'batch');
            $objPHPExcel->getActiveSheet()->setCellValue('M11', 'unit');
            $objPHPExcel->getActiveSheet()->setCellValue('N11', 'dus (uom)');
            $objPHPExcel->getActiveSheet()->setCellValue('O11', 'box (uom)');
            $objPHPExcel->getActiveSheet()->setCellValue('P11', 'batch (uom)');
            $objPHPExcel->getActiveSheet()->setCellValue('Q11', 'unit');
            $objPHPExcel->getActiveSheet()->setCellValue('R11', 'waste');

            $number = 1;
            $fk = 12;
            foreach($kemas as $_data){
                $objPHPExcel->setActiveSheetIndex(5)
                    ->setCellValue('A'.$fk, $_data['item_code'])
                    ->setCellValue('B'.$fk, $_data['kode_komputer'])
                    ->setCellValue('C'.$fk, $_data['Description'])
                    ->setCellValue('D'.$fk, $_data['jlh_pemakaian'])
                    ->setCellValue('E'.$fk, $_data['spek'])
                    ->setCellValue('F'.$fk, $_data['supplier'])
                    ->setCellValue('G'.$fk, $_data['harga_uom'])
                    ->setCellValue('H'.$fk, $_data['min_order'])
                    ->setCellValue('I'.$fk, $_data['cost_kemas'])
                    ->setCellValue('J'.$fk, $_data['dus_ppa'])
                    ->setCellValue('K'.$fk, $_data['box_ppa'])
                    ->setCellValue('L'.$fk, $_data['batch_ppa'])
                    ->setCellValue('M'.$fk, $_data['unit_ppa'])
                    ->setCellValue('N'.$fk, $_data['dus_net'])
                    ->setCellValue('O'.$fk, $_data['box_net'])
                    ->setCellValue('P'.$fk, $_data['batch_net'])
                    ->setCellValue('Q'.$fk, $_data['unit_net'])
                    ->setCellValue('R'.$fk, $_data['waste']);

                $fk++;
            }
            $akhir   = $fk;
            $note    = $akhir+1;
            $contain = $note+1;
            $objPHPExcel->setActiveSheetIndex(5)
                        ->setCellValue('I'.$akhir, 'Cost Kemas/Box')
                        ->setCellValue('j'.$akhir, $kemas2['cost_box'])
                        ->setCellValue('I'.$note, 'Cost Kemas/Dus :')
                        ->setCellValue('J'.$note, $kemas2['cost_dus'])
                        ->setCellValue('I'.$contain, 'Cost Kemas/Sachet	 :')
                        ->setCellValue('J'.$contain, $kemas2['cost_sachet']);
            $objPHPExcel->getActiveSheet()->setTitle('Formula Kemas');
        // Sheet 5 Selesai

        $skrg=date('d m Y');
            header('Content-Type: application/vnd.ms-excel'); 
            header('Content-Disposition: attachment;filename="Download For Costing '.$skrg.'.xls"'); 
            header('Cache-Control: max-age=0'); 
        $objWriter = \PhpOffice\PhpSpreadsheet\IOFactory::createWriter($objPHPExcel, "Xlsx");
        ob_end_clean();
        $objWriter->save('php://output');
    }

    public function CostingDownloadPDP($project,$formula,$fs){ // download FOR PKP
        $objPHPExcel = new Spreadsheet();
        // Sheet 1 /FOR PKP 
            $objPHPExcel->setActiveSheetIndex(0); 
            $objPHPExcel->getActiveSheet()->getColumnDimension('A')->setWidth(25.00);
            $objPHPExcel->getActiveSheet()->getColumnDimension('B')->setWidth(25.00);
            $objPHPExcel->getActiveSheet()->getColumnDimension('C')->setWidth(20.00);
            $objPHPExcel->getActiveSheet()->getColumnDimension('D')->setWidth(9.00);
            $objPHPExcel->getActiveSheet()->getColumnDimension('E')->setWidth(20.00);
            $objPHPExcel->getActiveSheet()->getColumnDimension('F')->setWidth(20.00);
            $objPHPExcel->getActiveSheet()->getColumnDimension('G')->setWidth(9.00);
            $objPHPExcel->getActiveSheet()->getColumnDimension('H')->setWidth(20.00);
            $objPHPExcel->getActiveSheet()->getColumnDimension('I')->setWidth(20.00);
            $objPHPExcel->getActiveSheet()->getColumnDimension('J')->setWidth(9.00);
            $objPHPExcel->getActiveSheet()->getColumnDimension('K')->setWidth(20.00);

            $for        = Formula::where('id',$formula)->first();
			$fortails 	= Fortail::where('formula_id',$formula)->get();

            $objPHPExcel->setActiveSheetIndex(0)
                        ->setCellValue('A1', 'HPP Bahan Baku')
                        ->setCellValue('A2', 'Bahan Baku')
                        ->setCellValue('E2', 'Per Serving')
                        ->setCellValue('H2', 'Per Batch')
                        ->setCellValue('K2', 'Per Serving');
            $objPHPExcel->getActiveSheet()->mergeCells('A1:K1');
            $objPHPExcel->getActiveSheet()->mergeCells('A2:C2');
            $objPHPExcel->getActiveSheet()->mergeCells('E2:F2');
            $objPHPExcel->getActiveSheet()->mergeCells('H2:I2');
            $objPHPExcel->getActiveSheet()->getStyle("A1:K1")->getAlignment()->setHorizontal('center');
            $objPHPExcel->getActiveSheet()->getStyle("A2:K2")->getAlignment()->setHorizontal('center');

            $objPHPExcel->setActiveSheetIndex(0)
                        ->setCellValue('A3', 'Kode Oracle')
                        ->setCellValue('B3', 'Nama Bahan')
                        ->setCellValue('C3', 'Harga PerGram')
                        ->setCellValue('E3', 'Berat')
                        ->setCellValue('F3', 'Harga PerGram')
                        ->setCellValue('H3', 'Berat')
                        ->setCellValue('I3', 'Harga')
                        ->setCellValue('K3', 'Harga');

            $objPHPExcel->getActiveSheet()->getStyle("A1:K1")->getFill()
                        ->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)
                        ->getStartColor()->setARGB('13DFE4');
            $objPHPExcel->getActiveSheet()->getStyle("A3:C3")->getFill()
                        ->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)
                        ->getStartColor()->setARGB('8c8888');
            $objPHPExcel->getActiveSheet()->getStyle("E3:F3")->getFill()
                        ->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)
                        ->getStartColor()->setARGB('8c8888');
            $objPHPExcel->getActiveSheet()->getStyle("H3:I3")->getFill()
                        ->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)
                        ->getStartColor()->setARGB('8c8888');
            $objPHPExcel->getActiveSheet()->getStyle("K3")->getFill()
                        ->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)
                        ->getStartColor()->setARGB('8c8888');
            $objPHPExcel->getActiveSheet()->getStyle("A3:K3")->getAlignment()->setHorizontal('center');

            $pertama = 4;
            foreach($fortails as $_data){
				$bahan      = Bahan::where('id',$_data->bahan_id)->first();
				$curren 	= Curren::where('id',$bahan->curren_id)->first();
				// Harga Pergram
				if($bahan->satuan=='Kg'){
					$hpg = ($bahan->harga_satuan * $curren->harga)/1000;  $hpg = round($hpg,2); 
				}elseif($bahan->satuan=='Mg'){
					$hpg = ($bahan->harga_satuan * $curren->harga)/0.001; $hpg = round($hpg,2); 
				}elseif($bahan->satuan=='G'){
					$hpg = ($bahan->harga_satuan * $curren->harga); 	  $hpg = round($hpg,2); 
				}
				// PerServing
				$berat_per_serving = $_data->per_serving;  			                    $berat_per_serving  = round($berat_per_serving,5);
				$harga_per_serving = $berat_per_serving * $hpg; 						$harga_per_serving  = round($harga_per_serving,2);
				// Per Batch
				$berat_per_batch   = $_data->per_batch;  								$berat_per_batch    = round($berat_per_batch,5);
				$harga_per_batch   = $berat_per_batch * $hpg;  							$harga_per_batch    = round($harga_per_batch,2);
				// Per Kg
				$berat_per_kg      = (1000 * $berat_per_serving)/$for->serving;      	$berat_per_kg 	    = round($berat_per_kg,5);
				$harga_per_kg      = $bahan->harga_satuan;  							$harga_per_kg 	    = round($harga_per_kg,2); 

                $objPHPExcel->setActiveSheetIndex(0)
                    ->setCellValue('A'.$pertama, $_data['kode_oracle'])
                    ->setCellValue('B'.$pertama, $_data['nama_sederhana'])
                    ->setCellValue('C'.$pertama, $hpg)
                    ->setCellValue('E'.$pertama, $_data['per_serving'])
                    ->setCellValue('F'.$pertama, $harga_per_serving)
                    ->setCellValue('H'.$pertama, $_data['per_batch'])
                    ->setCellValue('I'.$pertama, $harga_per_batch)
                    ->setCellValue('K'.$pertama, $harga_per_kg);
                $pertama++;
            }
            $objPHPExcel->getActiveSheet()->setTitle('HPP PKP');
        // Sheet 1 Selesai

        // Create a new worksheet2
            $objPHPExcel->createSheet();
            $objPHPExcel->setActiveSheetIndex(1); 
            $objPHPExcel->getActiveSheet(1)->getColumnDimension('A')->setWidth(25.00);
            $objPHPExcel->getActiveSheet(1)->getColumnDimension('B')->setWidth(25.00);
            $objPHPExcel->getActiveSheet(1)->getColumnDimension('C')->setWidth(25.00);
            $objPHPExcel->getActiveSheet(1)->getColumnDimension('D')->setWidth(25.00);
            $objPHPExcel->getActiveSheet(1)->getColumnDimension('E')->setWidth(25.00);
            $objPHPExcel->getActiveSheet(1)->getColumnDimension('F')->setWidth(25.00);
            $objPHPExcel->getActiveSheet(1)->getColumnDimension('G')->setWidth(25.00);
            $objPHPExcel->getActiveSheet(1)->getColumnDimension('H')->setWidth(25.00);
            $objPHPExcel->getActiveSheet(1)->getColumnDimension('I')->setWidth(25.00);
            $objPHPExcel->getActiveSheet(1)->getColumnDimension('J')->setWidth(25.00);
            $objPHPExcel->getActiveSheet(1)->getColumnDimension('K')->setWidth(25.00);
            $objPHPExcel->getActiveSheet(1)->getColumnDimension('L')->setWidth(25.00);
            $objPHPExcel->getActiveSheet(1)->getColumnDimension('M')->setWidth(25.00);
            $objPHPExcel->getActiveSheet(1)->getColumnDimension('N')->setWidth(25.00);
            $objPHPExcel->getActiveSheet(1)->getColumnDimension('O')->setWidth(25.00);
            $objPHPExcel->getActiveSheet(1)->getColumnDimension('P')->setWidth(25.00);
            $objPHPExcel->getActiveSheet(1)->getColumnDimension('Q')->setWidth(25.00);
            $objPHPExcel->getActiveSheet(1)->getColumnDimension('R')->setWidth(25.00);
            $objPHPExcel->getActiveSheet(1)->getColumnDimension('S')->setWidth(25.00);
            $objPHPExcel->getActiveSheet(1)->getColumnDimension('T')->setWidth(25.00);
            $objPHPExcel->getActiveSheet(1)->getColumnDimension('U')->setWidth(25.00);
            $objPHPExcel->getActiveSheet(1)->getColumnDimension('V')->setWidth(25.00);
            $objPHPExcel->getActiveSheet(1)->getColumnDimension('W')->setWidth(25.00);
            $objPHPExcel->getActiveSheet(1)->getColumnDimension('X')->setWidth(25.00);
            $objPHPExcel->getActiveSheet(1)->getColumnDimension('Y')->setWidth(25.00);
            $objPHPExcel->getActiveSheet(1)->getColumnDimension('Z')->setWidth(25.00);

            $iddesc = DataLab::where('id_fs',$fs)->join('ms_item_desc','ms_item_desc.id','tr_lab.id_item_desc')->first();
            $form   = FormPengajuanFS::where('id_feasibility',$fs)->first();

            $objPHPExcel->setActiveSheetIndex(1);
            $objPHPExcel->getActiveSheet()->setCellValue('A1', 'Item Desc');
            $objPHPExcel->getActiveSheet()->setCellValue('B1', 'PLANT');
            $objPHPExcel->getActiveSheet()->setCellValue('C1', 'Lokasi analisa');
            $objPHPExcel->getActiveSheet()->setCellValue('D1', 'Total batch');
            $objPHPExcel->getActiveSheet()->setCellValue('E1', 'para x spl (BB)/batch');
            $objPHPExcel->getActiveSheet()->setCellValue('F1', 'para x sampel (swab)/batch');
            $objPHPExcel->getActiveSheet()->setCellValue('G1', 'Parameter mikro rilis');
            $objPHPExcel->getActiveSheet()->setCellValue('H1', 'Para x sampel analisa rutin');
            $objPHPExcel->getActiveSheet()->setCellValue('I1', 'Jlh sampel mikro/batch');
            $objPHPExcel->getActiveSheet()->setCellValue('J1', 'Jlh sampel mikro analisa/thn');
            $objPHPExcel->getActiveSheet()->setCellValue('K1', 'Biaya analisa mikro rutin/sampel');
            $objPHPExcel->getActiveSheet()->setCellValue('L1', 'Biaya mikro rutin/batch');
            $objPHPExcel->getActiveSheet()->setCellValue('M1', 'Biaya mikro rutin/tahun');
            $objPHPExcel->getActiveSheet()->setCellValue('N1', 'Biaya analisa tahunan/sampel');
            $objPHPExcel->getActiveSheet()->setCellValue('O1', 'Biaya analisa tahunan/SKU');
            $objPHPExcel->getActiveSheet()->setCellValue('P1', 'Estimasi Biaya mikro analisa BB/batch');
            $objPHPExcel->getActiveSheet()->setCellValue('Q1', 'Estimasi Biaya mikro analisa BB/tahun');
            $objPHPExcel->getActiveSheet()->setCellValue('R1', 'Estimasi biaya analisa swab/batch');
            $objPHPExcel->getActiveSheet()->setCellValue('S1', 'Estimasi biaya analisa swab/tahun');
            $objPHPExcel->getActiveSheet()->setCellValue('T1', 'Estimasi biaya tahanan (resampling)/batch');
            $objPHPExcel->getActiveSheet()->setCellValue('U1', 'Estimasi biaya tahanan (resampling/tahun)');
            $objPHPExcel->getActiveSheet()->setCellValue('V1', 'Estimasi biaya kimia/batch');
            $objPHPExcel->getActiveSheet()->setCellValue('W1', 'Estimasi biaya analisa kimia/tahun');
            $objPHPExcel->getActiveSheet()->setCellValue('X1', 'Biaya total/SKU');
            $objPHPExcel->getActiveSheet()->setCellValue('Y1', 'Biaya total analisa/batch');
            $objPHPExcel->getActiveSheet()->setCellValue('Z1', 'Total Para x spl/batch');

            $objPHPExcel->getActiveSheet()->getStyle("A1:Z1")->getFill()
                        ->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)
                        ->getStartColor()->setARGB('13DFE4');
            $objPHPExcel->getActiveSheet()->getStyle("A1:Z1")->getAlignment()->setHorizontal('center');

            // Hitung rumus Analisa
            $biaya_mikro_rutin = $iddesc->biaya_analisa * $iddesc->jlh_sample_mikro;
            $biaya_mikro_tahun   = $biaya_mikro_rutin * $form->batch_size;
            $mikro_analisa_bb    = $iddesc->mikro_analisa * $form->batch_size;
            $swab_analisa_thn    = $iddesc->analisa_swab * $form->batch_size;
            $resampling_thn      = $iddesc->biaya_tahanan * $form->batch_size;
            $biaya_analisa_kimia = $iddesc->kimia_batch * $form->batch_size;
            $total_sku           = $biaya_analisa_kimia + $resampling_thn + $swab_analisa_thn + $mikro_analisa_bb + $biaya_mikro_tahun + $iddesc->biaya_analisa_tahun;
            $total_analisa       = $total_sku / $form->batch_size;
            $total_para          = $iddesc->sample_swab + $iddesc->sample_analisa;

            $objPHPExcel->setActiveSheetIndex(1)
                        ->setCellValue('A2', $iddesc['item_desc'])
                        ->setCellValue('B2', $iddesc['io'])
                        ->setCellValue('C2', $iddesc['lokasi'])
                        ->setCellValue('D2', $form['batch_size'])
                        ->setCellValue('E2', $iddesc['spl_batch'])
                        ->setCellValue('F2', $iddesc['sample_swab'])
                        ->setCellValue('G2', $iddesc['parameter_mikro'])
                        ->setCellValue('H2', $iddesc['sample_analisa'])
                        ->setCellValue('I2', $iddesc['jlh_sample_mikro'])
                        ->setCellValue('J2', $iddesc['jlh_mikro_tahunan'])
                        ->setCellValue('K2', $iddesc['biaya_analisa'])
                        ->setCellValue('L2', $biaya_mikro_rutin)
                        ->setCellValue('M2', $biaya_mikro_tahun)
                        ->setCellValue('N2', $iddesc['biaya_analisa_tahun'])
                        ->setCellValue('O2', $iddesc['biaya_analisa_tahun'])
                        ->setCellValue('P2', $iddesc['mikro_analisa'])
                        ->setCellValue('Q2', $mikro_analisa_bb)
                        ->setCellValue('R2', $iddesc['analisa_swab'])
                        ->setCellValue('S2', $swab_analisa_thn)
                        ->setCellValue('T2', $iddesc['biaya_tahanan'])
                        ->setCellValue('U2', $resampling_thn)
                        ->setCellValue('V2', $iddesc['kimia_batch'])
                        ->setCellValue('W2', $biaya_analisa_kimia)
                        ->setCellValue('X2', $total_sku)
                        ->setCellValue('Y2', $total_analisa)
                        ->setCellValue('Z2', $total_para);

            // Rename 2nd sheet
            $objPHPExcel->getActiveSheet()->setTitle('Form Biaya Analisa');
        // Sheet 2 Selesai

        // Create a new worksheet3 Maklon
            $objPHPExcel->createSheet();
            $objPHPExcel->setActiveSheetIndex(2); 
            $objPHPExcel->getActiveSheet(2)->getColumnDimension('A')->setWidth(20.00);
            $objPHPExcel->getActiveSheet(2)->getColumnDimension('B')->setWidth(20.00);
            $objPHPExcel->getActiveSheet(2)->getColumnDimension('C')->setWidth(35.00);
            $objPHPExcel->getActiveSheet(2)->getColumnDimension('D')->setWidth(20.00);
            $objPHPExcel->getActiveSheet(2)->getColumnDimension('E')->setWidth(35.00);

            $maklon = Maklon::where('id_fs',$fs)->first();

            $objPHPExcel->setActiveSheetIndex(2);
            $objPHPExcel->getActiveSheet()->setCellValue('A1', 'Biaya Maklon/UOM');
            $objPHPExcel->getActiveSheet()->setCellValue('B1', 'Satuan');
            $objPHPExcel->getActiveSheet()->setCellValue('C1', 'Remarks');
            $objPHPExcel->getActiveSheet()->setCellValue('D1', 'Biaya Transport/UOM');
            $objPHPExcel->getActiveSheet()->setCellValue('E1', 'NRemarks');

            $objPHPExcel->getActiveSheet()->getStyle("A1:E1")->getFill()
                        ->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)
                        ->getStartColor()->setARGB('13DFE4');
            $objPHPExcel->getActiveSheet()->getStyle("A1:E1")->getAlignment()->setHorizontal('center');
            $objPHPExcel->getActiveSheet()->getStyle("A2:E2")->getAlignment()->setHorizontal('center');

            $objPHPExcel->setActiveSheetIndex(2)
                        ->setCellValue('A2', $maklon['biaya_maklon'])
                        ->setCellValue('B2', $maklon['satuan'])
                        ->setCellValue('C2', $maklon['remarks_biaya'])
                        ->setCellValue('D2', $maklon['biaya_transport'])
                        ->setCellValue('E2', $maklon['remarks_transport']);

            // Rename sHEET3
            $objPHPExcel->getActiveSheet()->setTitle('Form Maklon');
        // Sheet 3 Selesai

        // Create a new worksheet 4 Mesin
            $objPHPExcel->createSheet();
            $objPHPExcel->setActiveSheetIndex(3); 
            $objPHPExcel->getActiveSheet(3)->getColumnDimension('A')->setWidth(35.00);
            $objPHPExcel->getActiveSheet(3)->getColumnDimension('B')->setWidth(20.00);
            $objPHPExcel->getActiveSheet(3)->getColumnDimension('C')->setWidth(20.00);
            $objPHPExcel->getActiveSheet(3)->getColumnDimension('D')->setWidth(20.00);
            $objPHPExcel->getActiveSheet(3)->getColumnDimension('F')->setWidth(35.00);
            $objPHPExcel->getActiveSheet(3)->getColumnDimension('G')->setWidth(20.00);
            $objPHPExcel->getActiveSheet(3)->getColumnDimension('H')->setWidth(20.00);
            $objPHPExcel->getActiveSheet(3)->getColumnDimension('I')->setWidth(20.00);

            $value=3;
            $nilai=3;
            $feasibility = Feasibility::where('id',$fs)->first();
            $Mdata       = DB::table('tr_mesin')->join('ms_mesin','tr_mesin.id_data_mesin','=','ms_mesin.id_data_mesin')
                        ->where('id_wb_fs',$feasibility->id_wb_proses)->where('kategori','!=','Filling')->where('kategori','!=','Packing')->get();
            $dataO       = OH::where('id_ws',$feasibility->id_wb_proses)->get();
            
            $objPHPExcel->setActiveSheetIndex(3);
            // Informasi Data Mesin
            $objPHPExcel->getActiveSheet()->setCellValue('A2', 'Mesin');
            $objPHPExcel->getActiveSheet()->setCellValue('B2', 'Runtime (menit/batch granulasi)');
            $objPHPExcel->getActiveSheet()->setCellValue('C2', 'Runtime (menit/batch)');
            $objPHPExcel->getActiveSheet()->setCellValue('D2', 'Note');
            // Informasi Data OH
            $objPHPExcel->getActiveSheet()->setCellValue('F2', 'Informasi Biaya Lain-Lain');
            $objPHPExcel->getActiveSheet()->setCellValue('G2', 'Curren');
            $objPHPExcel->getActiveSheet()->setCellValue('H2', 'Nominal');
            $objPHPExcel->getActiveSheet()->setCellValue('I2', 'Note');

            $objPHPExcel->getActiveSheet()->mergeCells('A1:D1');
            $objPHPExcel->setActiveSheetIndex(3)
                        ->setCellValue('A1', 'Data Mesin');

            $objPHPExcel->getActiveSheet()->mergeCells('F1:I1');
            $objPHPExcel->setActiveSheetIndex(3)
                        ->setCellValue('F1', 'Data OH');
            $objPHPExcel->getActiveSheet()->getStyle("A1:I1")->getAlignment()->setHorizontal('center');

            $objPHPExcel->getActiveSheet()->getStyle("A2:D2")->getFill()
                        ->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)
                        ->getStartColor()->setARGB('13DFE4');
            $objPHPExcel->getActiveSheet()->getStyle("F2:I2")->getFill()
                        ->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)
                        ->getStartColor()->setARGB('13DFE4');
            $objPHPExcel->getActiveSheet()->getStyle("A2:I2")->getAlignment()->setHorizontal('center');

            // Data Mesin
            foreach($Mdata as $mesin){
                $objPHPExcel->setActiveSheetIndex(3)
                            ->setCellValue('A'.$value, $mesin->nama_mesin)
                            ->setCellValue('B'.$value, $mesin->runtime_granulasi)
                            ->setCellValue('C'.$value, $mesin->runtime)
                            ->setCellValue('D'.$value, $mesin->note);
                $value++;
            }
            foreach($dataO as $oh){
                $objPHPExcel->setActiveSheetIndex(3)
                            ->setCellValue('F'.$nilai, $oh->mesin)
                            ->setCellValue('G'.$nilai, $oh->Curren)
                            ->setCellValue('H'.$nilai, $oh->nominal)
                            ->setCellValue('I'.$nilai, $oh->note);
                $nilai++;
            }
            // Rename Sheet 4
            $objPHPExcel->getActiveSheet()->setTitle('Data Mesin Dan OH');
        // Sheet 4 Selesai

        // Create a new worksheet 5 Filpack
            $objPHPExcel->createSheet();
            $objPHPExcel->setActiveSheetIndex(4); 
            $objPHPExcel->getActiveSheet(4)->getColumnDimension('A')->setWidth(35.00);
            $objPHPExcel->getActiveSheet(4)->getColumnDimension('B')->setWidth(20.00);
            $objPHPExcel->getActiveSheet(4)->getColumnDimension('C')->setWidth(20.00);
            $objPHPExcel->getActiveSheet(4)->getColumnDimension('D')->setWidth(20.00);
            $objPHPExcel->getActiveSheet(4)->getColumnDimension('E')->setWidth(35.00);
            // Data Manual
            $objPHPExcel->getActiveSheet(4)->getColumnDimension('G')->setWidth(20.00);
            $objPHPExcel->getActiveSheet(4)->getColumnDimension('H')->setWidth(20.00);
            $objPHPExcel->getActiveSheet(4)->getColumnDimension('I')->setWidth(35.00);
            $objPHPExcel->getActiveSheet(4)->getColumnDimension('J')->setWidth(35.00);

            $value=3;
            $nilai=3;
            $feasibility = Feasibility::where('id',$fs)->first();
            $dataM       = DB::table('tr_mesin')->join('ms_mesin','tr_mesin.id_data_mesin','=','ms_mesin.id_data_mesin')->where('id_wb_fs',$feasibility->id_wb_proses)->orwhere('kategori','Filling')->where('kategori','Packing')->get();
            $manual      = Mesin::where('manual','!=',NULL)->where('id_wb_fs',$feasibility->id_wb_proses)->get();
            
            $objPHPExcel->setActiveSheetIndex(4);
            // Informasi Data Mesin
            $objPHPExcel->getActiveSheet()->setCellValue('A2', 'Mesin');
            $objPHPExcel->getActiveSheet()->setCellValue('B2', 'kategori');
            $objPHPExcel->getActiveSheet()->setCellValue('C2', 'SDM (jika berbeda dengan eksis)');
            $objPHPExcel->getActiveSheet()->setCellValue('D2', 'Runtime (menit)');
            $objPHPExcel->getActiveSheet()->setCellValue('E2', 'Note');
            // Informasi Data OH
            $objPHPExcel->getActiveSheet()->setCellValue('G2', 'Manual');
            $objPHPExcel->getActiveSheet()->setCellValue('H2', 'SDM');
            $objPHPExcel->getActiveSheet()->setCellValue('I2', 'Runtime (menit)');
            $objPHPExcel->getActiveSheet()->setCellValue('J2', 'Note');

            $objPHPExcel->getActiveSheet()->mergeCells('A1:E1');
            $objPHPExcel->setActiveSheetIndex(4)
                        ->setCellValue('A1', 'Data Mesin');

            $objPHPExcel->getActiveSheet()->mergeCells('G1:J1');
            $objPHPExcel->setActiveSheetIndex(4)
                        ->setCellValue('G1', 'Data Manual');
            $objPHPExcel->getActiveSheet()->getStyle("A1:J1")->getAlignment()->setHorizontal('center');

            $objPHPExcel->getActiveSheet()->getStyle("A2:E2")->getFill()
                        ->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)
                        ->getStartColor()->setARGB('13DFE4');
            $objPHPExcel->getActiveSheet()->getStyle("G2:J2")->getFill()
                        ->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)
                        ->getStartColor()->setARGB('13DFE4');
            $objPHPExcel->getActiveSheet()->getStyle("A2:J2")->getAlignment()->setHorizontal('center');

            // Data Mesin
            foreach($dataM as $mesin){
                $objPHPExcel->setActiveSheetIndex(4)
                            ->setCellValue('A'.$value, $mesin->nama_mesin)
                            ->setCellValue('B'.$value, $mesin->kategori)
                            ->setCellValue('C'.$value, $mesin->sdm)
                            ->setCellValue('D'.$value, $mesin->runtime)
                            ->setCellValue('E'.$value, $mesin->note);
                $value++;
            }
            foreach($manual as $manual){
                $objPHPExcel->setActiveSheetIndex(4)
                            ->setCellValue('G'.$nilai, $manual->manual)
                            ->setCellValue('H'.$nilai, $manual->sdm)
                            ->setCellValue('I'.$nilai, $manual->runtime)
                            ->setCellValue('J'.$nilai, $manual->note);
                $nilai++;
            }
            // Rename Sheet 5
            $objPHPExcel->getActiveSheet()->setTitle('Data Mesin Fillpack');
        // Sheet 5 Selesai

        // Create a new worksheet 6 Filpack
            $objPHPExcel->createSheet();
            $objPHPExcel->setActiveSheetIndex(5); 
            $objPHPExcel->getActiveSheet(5)->getColumnDimension('A')->setWidth(20.00);
            $objPHPExcel->getActiveSheet(5)->getColumnDimension('B')->setWidth(20.00);
            $objPHPExcel->getActiveSheet(5)->getColumnDimension('C')->setWidth(25.00);
            $objPHPExcel->getActiveSheet(5)->getColumnDimension('D')->setWidth(20.00);
            $objPHPExcel->getActiveSheet(5)->getColumnDimension('E')->setWidth(15.00);
            $objPHPExcel->getActiveSheet(5)->getColumnDimension('F')->setWidth(20.00);
            $objPHPExcel->getActiveSheet(5)->getColumnDimension('G')->setWidth(20.00);
            $objPHPExcel->getActiveSheet(5)->getColumnDimension('H')->setWidth(15.00);
            $objPHPExcel->getActiveSheet(5)->getColumnDimension('I')->setWidth(25.00);
            $objPHPExcel->getActiveSheet(5)->getColumnDimension('J')->setWidth(15.00);
            $objPHPExcel->getActiveSheet(5)->getColumnDimension('K')->setWidth(15.00);
            $objPHPExcel->getActiveSheet(5)->getColumnDimension('L')->setWidth(15.00);
            $objPHPExcel->getActiveSheet(5)->getColumnDimension('M')->setWidth(12.00);
            $objPHPExcel->getActiveSheet(5)->getColumnDimension('N')->setWidth(15.00);
            $objPHPExcel->getActiveSheet(5)->getColumnDimension('O')->setWidth(15.00);
            $objPHPExcel->getActiveSheet(5)->getColumnDimension('P')->setWidth(15.00);
            $objPHPExcel->getActiveSheet(5)->getColumnDimension('Q')->setWidth(12.00);
            $objPHPExcel->getActiveSheet(5)->getColumnDimension('R')->setWidth(12.00);

            $pdf         = SubPDF::where('pdf_id',$project)->first();
            $eksis       = datakemas::where('id_kemas',$pdf->kemas_eksis)->first();
            $data        = Formula::where('id',$feasibility->id_formula)->first();
            $konsep      = KonsepKemas::where('id_ws',$feasibility->id_wb_kemas)->first();
            $kemas       = FormulaKemas::where('id_ws',$feasibility->id_wb_kemas)->get();
            $kemas2      = FormulaKemas::where('id_ws',$feasibility->id_wb_kemas)->where('cost_box','!=',NULL)->orwhere('cost_dus','!=',NULL)->first();
            $hitungkemas = FormulaKemas::where('id_ws',$feasibility->id_wb_kemas)->count();
            
            // Baris Pertama
            $objPHPExcel->setActiveSheetIndex(5)
                        ->setCellValue('A1', 'PT. NUTRIFOOD INDONESIA');
            $objPHPExcel->getActiveSheet()->mergeCells('A1:B1');
            $objPHPExcel->getActiveSheet()->getStyle("A1")->getAlignment()->setHorizontal('center');

            // Baris Kedua
            $objPHPExcel->setActiveSheetIndex(5)
                        ->setCellValue('A2', 'FORMULA BAHAN KEMAS');
            $objPHPExcel->getActiveSheet()->mergeCells('A2:R2');
            $objPHPExcel->getActiveSheet()->getStyle("A2")->getAlignment()->setHorizontal('center');

            // Baris ketiga
            $objPHPExcel->setActiveSheetIndex(5)
                        ->setCellValue('A3', '(FBK)');
            $objPHPExcel->getActiveSheet()->mergeCells('A3:R3');
            $objPHPExcel->getActiveSheet()->getStyle("A3")->getAlignment()->setHorizontal('center');

            $objPHPExcel->getActiveSheet()->getStyle("A4:D4")->getFill()
                        ->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)
                        ->getStartColor()->setARGB('13DFE4');
            $objPHPExcel->getActiveSheet()->getStyle("A4:d4")->getAlignment()->setHorizontal('center');

            $objPHPExcel->setActiveSheetIndex(5)
                        ->setCellValue('A4', 'Nama')
                        ->setCellValue('A5', $data['formula'])
                        ->setCellValue('B4', 'jumlah kemasan primer')
                        ->setCellValue('B5', $eksis['s_tersier'])
                        ->setCellValue('C4', 'jumlah kemasan sekunder')
                        ->setCellValue('C5', $eksis['s_sekunder1'])
                        ->setCellValue('D4', 'Gr')
                        ->setCellValue('D5', $eksis['s_primer'])
                        ->setCellValue('A7', 'keterangan')
                        ->setCellValue('B7', $konsep['keterangan'])
                        ->setCellValue('A8', 'Formula')
                        ->setCellValue('B8', $data['formula'])
                        ->setCellValue('A9', 'Tanggal ')
                        ->setCellValue('B9', $konsep['created_date'])
                        ->setCellValue('Q7', 'Batch/Yield')
                        ->setCellValue('R7', $konsep['batch_yield'])
                        ->setCellValue('Q8', 'Net Batch')
                        ->setCellValue('R8', $data['batch_size'])
                        ->setCellValue('Q9', 'jumlah Box/Batch ')
                        ->setCellValue('R9', $konsep['jumlah_box']);
            
            $objPHPExcel->getActiveSheet()->getStyle("A11:R11")->getFill()
                        ->setFillType(\PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID)
                        ->getStartColor()->setARGB('13DFE4');
            $objPHPExcel->getActiveSheet()->getStyle("A11:R11")->getAlignment()->setHorizontal('center');

            $objPHPExcel->setActiveSheetIndex(5);
            $objPHPExcel->getActiveSheet()->setCellValue('A11', 'kode item');
            $objPHPExcel->getActiveSheet()->setCellValue('B11', 'kode komputer');
            $objPHPExcel->getActiveSheet()->setCellValue('C11', 'Description');
            $objPHPExcel->getActiveSheet()->setCellValue('D11', 'Dimensi / Jml Pemakaian');
            $objPHPExcel->getActiveSheet()->setCellValue('E11', 'Spek');
            $objPHPExcel->getActiveSheet()->setCellValue('F11', 'Supplier');
            $objPHPExcel->getActiveSheet()->setCellValue('G11', 'Harga / UoM');
            $objPHPExcel->getActiveSheet()->setCellValue('H11', 'Min. Order');
            $objPHPExcel->getActiveSheet()->setCellValue('I11', 'Cost Kemas');
            $objPHPExcel->getActiveSheet()->setCellValue('J11', 'dus');
            $objPHPExcel->getActiveSheet()->setCellValue('K11', 'box');
            $objPHPExcel->getActiveSheet()->setCellValue('L11', 'batch');
            $objPHPExcel->getActiveSheet()->setCellValue('M11', 'unit');
            $objPHPExcel->getActiveSheet()->setCellValue('N11', 'dus (uom)');
            $objPHPExcel->getActiveSheet()->setCellValue('O11', 'box (uom)');
            $objPHPExcel->getActiveSheet()->setCellValue('P11', 'batch (uom)');
            $objPHPExcel->getActiveSheet()->setCellValue('Q11', 'unit');
            $objPHPExcel->getActiveSheet()->setCellValue('R11', 'waste');

            $number = 1;
            $fk = 12;
            foreach($kemas as $_data){
                $objPHPExcel->setActiveSheetIndex(5)
                    ->setCellValue('A'.$fk, $_data['item_code'])
                    ->setCellValue('B'.$fk, $_data['kode_komputer'])
                    ->setCellValue('C'.$fk, $_data['Description'])
                    ->setCellValue('D'.$fk, $_data['jlh_pemakaian'])
                    ->setCellValue('E'.$fk, $_data['spek'])
                    ->setCellValue('F'.$fk, $_data['supplier'])
                    ->setCellValue('G'.$fk, $_data['harga_uom'])
                    ->setCellValue('H'.$fk, $_data['min_order'])
                    ->setCellValue('I'.$fk, $_data['cost_kemas'])
                    ->setCellValue('J'.$fk, $_data['dus_ppa'])
                    ->setCellValue('K'.$fk, $_data['box_ppa'])
                    ->setCellValue('L'.$fk, $_data['batch_ppa'])
                    ->setCellValue('M'.$fk, $_data['unit_ppa'])
                    ->setCellValue('N'.$fk, $_data['dus_net'])
                    ->setCellValue('O'.$fk, $_data['box_net'])
                    ->setCellValue('P'.$fk, $_data['batch_net'])
                    ->setCellValue('Q'.$fk, $_data['unit_net'])
                    ->setCellValue('R'.$fk, $_data['waste']);

                $fk++;
            }
            $akhir   = $fk;
            $note    = $akhir+1;
            $contain = $note+1;
            $objPHPExcel->setActiveSheetIndex(5)
                        ->setCellValue('I'.$akhir, 'Cost Kemas/Box')
                        ->setCellValue('j'.$akhir, $kemas2['cost_box'])
                        ->setCellValue('I'.$note, 'Cost Kemas/Dus :')
                        ->setCellValue('J'.$note, $kemas2['cost_dus'])
                        ->setCellValue('I'.$contain, 'Cost Kemas/Sachet	 :')
                        ->setCellValue('J'.$contain, $kemas2['cost_sachet']);
            $objPHPExcel->getActiveSheet()->setTitle('Formula Kemas');
        // Sheet 5 Selesai

        $skrg=date('d m Y');
            header('Content-Type: application/vnd.ms-excel'); 
            header('Content-Disposition: attachment;filename="Download For Costing '.$skrg.'.xls"'); 
            header('Cache-Control: max-age=0'); 
        $objWriter = \PhpOffice\PhpSpreadsheet\IOFactory::createWriter($objPHPExcel, "Xlsx");
        ob_end_clean();
        $objWriter->save('php://output');
    }
}