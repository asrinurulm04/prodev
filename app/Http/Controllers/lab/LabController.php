<?php

namespace App\Http\Controllers\lab;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

use App\model\Modellab\Dlab;
use App\model\Modellab\analisa;
use App\model\Modellab\ItemDesc;
use App\model\pkp\PkpProject;
use App\model\formula\Formula;
use redirect;

class LabController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
        $this->middleware('rule:lab');
    }

    public function index($id){
        $desc   = ItemDesc::all();
        $pkp    = PkpProject::where('id_project',$id)->first();
        return view('lab.datalab')->with([
            'pkp'       => $pkp,
            'desc'      => $desc
        ]);
    }

    public function AddItem($id){
        $pkp    = PkpProject::where('id_project',$id)->first();
        return view('lab.add_item')->with([
            'pkp'       => $pkp
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
            $add_lab->id_feasibility    =$request->finance;
            $add_lab->jlh_analisatahunan=$jlhAT[$i];
            $add_lab->jlh_analisaharian =$jlhAH[$i];
            $add_lab->tahunan           = $tahun[$i];
            $add_lab->harian            = $hari[$i];
            $add_lab->kode_analisa      = $kode[$i];
            $add_lab->jenis_mikroba     = $mikro[$i];
            $add_lab->rate              = $rate[$i];
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
				$add_lab->id_feasibility    =$request->finance;
				$add_lab->jlh_analisatahunan=$jlhAT[$i];
				$add_lab->jlh_analisaharian =$jlhAH[$i];
				$add_lab->tahunan           = $tahun[$i];
				$add_lab->harian            = $hari[$i];
				$add_lab->kode_analisa      = $kode[$i];
				$add_lab->jenis_mikroba     = $mikro[$i];
				$add_lab->rate              = $rate[$i];
				$add_lab->save();
			}
			
			$change_status  = finance::where('id_feasibility',$request->finance)->first();
			$change_status->status_lab='selesai';
			$change_status->save();

			return redirect()->back();
        }
        elseif($cek_lab>=1){
            $finances = finance::where('id_formula',$formula_id)->get();
            $fid      = collect();
            foreach ($finances as $finance) {
                $idf = $finance->id_feasibility;
                $fid->push(['id' => $idf]);
            }

            foreach($fid as $key){
                $lab    = Dlab::where('id_feasibility',$key['id'])->first();
                $there  = Dlab::where('id_feasibility',$key['id'])->count();

                if($there == 0){
                    $ms    = new Dlab;
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
                        $add_lab->id_feasibility    =$request->finance;
                        $add_lab->jlh_analisatahunan=$jlhAT[$i];
                        $add_lab->jlh_analisaharian =$jlhAH[$i];
                        $add_lab->tahunan           = $tahun[$i];
                        $add_lab->harian            = $hari[$i];
                        $add_lab->kode_analisa      = $kode[$i];
                        $add_lab->jenis_mikroba     = $mikro[$i];
                        $add_lab->rate              = $rate[$i];
                        $add_lab->save();
					}
					
                    $change_status  = Finance::where('id_feasibility',$request->finance)->first();
                    $change_status->status_lab='selesai';
                    $change_status->save();
            
                    return redirect()->back();
                }

                elseif($there == 1 ){
                    $ms    = new Dlab;
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
                        $add_lab->id_feasibility    =$request->finance;
                        $add_lab->jlh_analisatahunan=$jlhAT[$i];
                        $add_lab->jlh_analisaharian =$jlhAH[$i];
                        $add_lab->tahunan           = $tahun[$i];
                        $add_lab->harian            = $hari[$i];
                        $add_lab->kode_analisa      = $kode[$i];
                        $add_lab->jenis_mikroba     = $mikro[$i];
                        $add_lab->rate              = $rate[$i];
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