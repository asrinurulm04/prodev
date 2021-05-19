<?php

namespace App\Http\Controllers\lab;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

use App\model\Modellab\Dlab;
use App\model\Modellab\analisa;
use App\model\Modelfn\finance;
use App\model\pkp\SubPKP;
use App\model\pkp\PkpProject;
use App\model\dev\Formula;
use redirect;

class LabController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
        $this->middleware('rule:lab');
    }

    public function index($id,$id_feasibility){
        $formulas = SubPKP::where('id',$id)->get();
        $analisa = analisa::all();
        $fe=finance::where('id_feasibility',$id_feasibility)->first();
        $formula_id = $fe->id_formula;
        $mikroba = DB::table('fs_jenismikroba')->select(['jenis_mikroba'])->distinct()->get();
        $dataL =Dlab::where('id_feasibility',$id_feasibility)->get();
        $count_lab = Dlab::where('id_feasibility',$id_feasibility)->count();
        $Jlab = Dlab::where('id_feasibility',$id_feasibility)->sum('rate');
        $lab2 = DB::table('formulas')
            ->join('tr_sub_pkp','tr_sub_pkp.id','=','tr_formulas.workbook_id')
            ->join('ms_kategori_pangan','ms_kategori_pangan.id_pangan','=','tr_sub_pkp.bpom')
            ->join('ms_jenis_mikroba','ms_jenis_mikroba.no_kategori','=','ms_kategori_pangan.no_kategori')
            ->where('formulas.id',$id)->get();
        $cek_lab =Dlab::where('id_feasibility',$id_feasibility)->count();
        return view('lab.datalab',['fe'=>$fe])->with([
            'formula_id' => $formula_id,
            'cek_lab' => $cek_lab,
            'mikroba' => $mikroba,
            'analisa' => $analisa,
            'formulas' => $formulas,
            'lab2' => $lab2,
            'dataL' => $dataL,
            'count_lab' => $count_lab,
            'id' => $id,
            'jlab' =>$Jlab,
            'id_feasibility' => $id_feasibility
        ]);
    }

    public function data(Request $request){
        $ms= new Dlab;
        $tahun = [];
        for($i = 0; $i < $request->cek_lab; $i++){
          	$tahun += array(
            	$i => $request->input('tahun_' . $i) ?? 'Tidak',
           	);
        }

        $hari = [];
        for($i = 0; $i < $request->cek_lab; $i++){
          	$hari += array(
            	$i => $request->input('hari_' . $i) ?? 'Tidak',
           	);
        }

        $kode = [];
        for($i = 0; $i < $request->cek_lab; $i++){
			$kode += array(
				$i => $request->input('kode_' . $i),
			);
        }

        $mikro = [];
        for($i = 0; $i < $request->cek_lab; $i++){
			$mikro += array(
				$i => $request->input('mikro_' . $i),
			);
        }

        $jlhAH = [];
        for($i = 0; $i < $request->cek_lab; $i++){
			$jlhAH += array(
				$i => $request->input('jlhAH_' . $i),
			);
        }

        $jlhAT = [];
        for($i = 0; $i < $request->cek_lab; $i++){
			$jlhAT += array(
				$i => $request->input('jlhAT_' . $i),
			);
        }

        $rate = [];
        for($i = 0; $i < $request->cek_lab; $i++){
			$rate += array(
				$i => $request->input('rate_' . $i),
			);
        }

        for($i = 0; $i < $request->cek_lab; $i++){
            $add_lab = new Dlab;
            $add_lab->id_feasibility=$request->finance;
            $add_lab->jlh_analisatahunan=$jlhAT[$i];
            $add_lab->jlh_analisaharian=$jlhAH[$i];
            $add_lab->tahunan = $tahun[$i];
            $add_lab->harian = $hari[$i];
            $add_lab->kode_analisa = $kode[$i];
            $add_lab->jenis_mikroba = $mikro[$i];
            $add_lab->rate = $rate[$i];
            $add_lab->save();
		}
		
        $change_status  = finance::where('id_feasibility',$request->finance)->first();
        $change_status->status_lab='selesai';
        $change_status->save();

        return redirect()->back();
    }

    public function create($formula_id,$cek_lab,Request $request,$id_feasibility){
        if($cek_lab==0){
			$ms= new Dlab;
			$tahun = [];
			for($i = 0; $i < $request->cek_lab; $i++){
				$tahun += array(
					$i => $request->input('tahun_' . $i) ?? 'Tidak',
				);
			}

			$hari = [];
			for($i = 0; $i < $request->cek_lab; $i++){
				$hari += array(
					$i => $request->input('hari_' . $i) ?? 'Tidak',
				);
			}

			$kode = [];
			for($i = 0; $i < $request->cek_lab; $i++){
				$kode += array(
					$i => $request->input('kode_' . $i),
				);
			}

			$mikro = [];
			for($i = 0; $i < $request->cek_lab; $i++){
				$mikro += array(
					$i => $request->input('mikro_' . $i),
				);
			}

			$jlhAH = [];
			for($i = 0; $i < $request->cek_lab; $i++){
				$jlhAH += array(
					$i => $request->input('jlhAH_' . $i),
				);
			}

			$jlhAT = [];
			for($i = 0; $i < $request->cek_lab; $i++){
				$jlhAT += array(
					$i => $request->input('jlhAT_' . $i),
				);
			}

			$rate = [];
			for($i = 0; $i < $request->cek_lab; $i++){
				$rate += array(
					$i => $request->input('rate_' . $i),
				);
			}

			for($i = 0; $i < $request->cek_lab; $i++){
				$add_lab = new Dlab;
				$add_lab->id_feasibility=$request->finance;
				$add_lab->jlh_analisatahunan=$jlhAT[$i];
				$add_lab->jlh_analisaharian=$jlhAH[$i];
				$add_lab->tahunan = $tahun[$i];
				$add_lab->harian = $hari[$i];
				$add_lab->kode_analisa = $kode[$i];
				$add_lab->jenis_mikroba = $mikro[$i];
				$add_lab->rate = $rate[$i];
				$add_lab->save();
			}
			
			$change_status  = finance::where('id_feasibility',$request->finance)->first();
			$change_status->status_lab='selesai';
			$change_status->save();

			return redirect()->back();
        }
        elseif($cek_lab>=1){
            $finances = finance::where('id_formula',$formula_id)->get();
            $fid = collect();
            foreach ($finances as $finance) {
                $idf = $finance->id_feasibility;
                $fid->push(['id' => $idf]);
            }

            foreach($fid as $key){
                $lab= Dlab::where('id_feasibility',$key['id'])->first();
                $there= Dlab::where('id_feasibility',$key['id'])->count();

                if($there == 0){
                    $ms= new Dlab;
                    $tahun = [];
                    for($i = 0; $i < $request->cek_lab; $i++){
						$tahun += array(
							$i => $request->input('tahun_' . $i) ?? 'Tidak',
						);
                    }
            
                    $hari = [];
                    for($i = 0; $i < $request->cek_lab; $i++){
						$hari += array(
							$i => $request->input('hari_' . $i) ?? 'Tidak',
						);
                    }
            
                    $kode = [];
                    for($i = 0; $i < $request->cek_lab; $i++){
						$kode += array(
							$i => $request->input('kode_' . $i),
						);
                    }
            
                    $mikro = [];
                    for($i = 0; $i < $request->cek_lab; $i++){
						$mikro += array(
							$i => $request->input('mikro_' . $i),
						);
                    }
            
                    $jlhAH = [];
                    for($i = 0; $i < $request->cek_lab; $i++){
						$jlhAH += array(
							$i => $request->input('jlhAH_' . $i),
						);
                    }
            
                    $jlhAT = [];
                    for($i = 0; $i < $request->cek_lab; $i++){
						$jlhAT += array(
							$i => $request->input('jlhAT_' . $i),
						);
                    }

                    $rate = [];
                    for($i = 0; $i < $request->cek_lab; $i++){
						$rate += array(
							$i => $request->input('rate_' . $i),
						);
                    }
            
                    for($i = 0; $i < $request->cek_lab; $i++){
                        $add_lab = new Dlab;
                        $add_lab->id_feasibility=$request->finance;
                        $add_lab->jlh_analisatahunan=$jlhAT[$i];
                        $add_lab->jlh_analisaharian=$jlhAH[$i];
                        $add_lab->tahunan = $tahun[$i];
                        $add_lab->harian = $hari[$i];
                        $add_lab->kode_analisa = $kode[$i];
                        $add_lab->jenis_mikroba = $mikro[$i];
                        $add_lab->rate = $rate[$i];
                        $add_lab->save();
					}
					
                    $change_status  = Finance::where('id_feasibility',$request->finance)->first();
                    $change_status->status_lab='selesai';
                    $change_status->save();
            
                    return redirect()->back();
                }

                elseif($there == 1 ){
                    $ms= new Dlab;
                    $tahun = [];
                    for($i = 0; $i < $request->cek_lab; $i++){
						$tahun += array(
							$i => $request->input('tahun_' . $i) ?? 'Tidak',
						);
                    }
            
                    $hari = [];
                    for($i = 0; $i < $request->cek_lab; $i++){
						$hari += array(
							$i => $request->input('hari_' . $i) ?? 'Tidak',
						);
                    }
            
                    $kode = [];
                    for($i = 0; $i < $request->cek_lab; $i++){
						$kode += array(
							$i => $request->input('kode_' . $i),
						);
                    }
            
                    $mikro = [];
                    for($i = 0; $i < $request->cek_lab; $i++){
						$mikro += array(
							$i => $request->input('mikro_' . $i),
						);
                    }
            
                    $jlhAH = [];
                    for($i = 0; $i < $request->cek_lab; $i++){
						$jlhAH += array(
							$i => $request->input('jlhAH_' . $i),
						);
                    }
            
                    $jlhAT = [];
                    for($i = 0; $i < $request->cek_lab; $i++){
						$jlhAT += array(
							$i => $request->input('jlhAT_' . $i),
						);
                    }
            
                    $rate = [];
                    for($i = 0; $i < $request->cek_lab; $i++){
						$rate += array(
							$i => $request->input('rate_' . $i),
						);
                    }
            
                    for($i = 0; $i < $request->cek_lab; $i++){
                        $add_lab = new Dlab;
                        $add_lab->id_feasibility=$request->finance;
                        $add_lab->jlh_analisatahunan=$jlhAT[$i];
                        $add_lab->jlh_analisaharian=$jlhAH[$i];
                        $add_lab->tahunan = $tahun[$i];
                        $add_lab->harian = $hari[$i];
                        $add_lab->kode_analisa = $kode[$i];
                        $add_lab->jenis_mikroba = $mikro[$i];
                        $add_lab->rate = $rate[$i];
                        $add_lab->save();
					}
					
                    $change_status  = finance::where('id_feasibility',$request->finance)->first();
                    $change_status->status_lab='selesai';
                    $change_status->save();
            
                    return redirect()->back();
                }
            }
            return redirect()->route('myFeasibility',$formula_id);
        }
    }
}