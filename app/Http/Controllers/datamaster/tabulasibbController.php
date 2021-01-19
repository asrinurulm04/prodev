<?php

namespace App\Http\Controllers\datamaster;
use Illuminate\Support\Facades\Validator;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\model\dev\Bahan;
use App\model\dev\tr_makro_bb;
use App\model\dev\tr_mineral_bb;
use App\model\dev\tr_vitamin_bb;
use App\model\dev\tr_asam_amino_bb;
use App\model\dev\tr_logamberat_bb;
use App\model\master\tr_tabulasi_bahan;
use App\model\pkp\tb_edit;
use DB;
use Auth;
use Redirect;

class tabulasibbController extends Controller
{
    public function tabulasi(){
        $bahan = Bahan::join('tr_makro_bb','tr_makro_bb.id_bahan','bahans.id')
        ->join('tr_vitamin_bb','tr_vitamin_bb.id_bahan','bahans.id')
        ->join('tr_mineral_bb','tr_mineral_bb.id_bahan','bahans.id')
        ->join('tr_asam_amino_bb','tr_asam_amino_bb.id_bahan','bahans.id')->get();
        return view('datamaster.tabulasibb')->with([
            'bahan' => $bahan,
        ]);
    }

    public function edittabulasi(){
        $form = tr_tabulasi_bahan::where('user',Auth::user()->id)->limit('1')->first();
        $bahan = Bahan::join('tr_makro_bb','tr_makro_bb.id_bahan','bahans.id')
        ->join('tr_vitamin_bb','tr_vitamin_bb.id_bahan','bahans.id')
        ->join('tr_mineral_bb','tr_mineral_bb.id_bahan','bahans.id')
        ->join('tr_asam_amino_bb','tr_asam_amino_bb.id_bahan','bahans.id')
        ->join('tr_tabulasi_bahan','tr_tabulasi_bahan.id_bahan','bahans.id')->get();
        return view('datamaster.edit_tabulasi')->with([
            'bahan' => $bahan,
            'form' => $form
        ]);
    }

    public function hapustabulasibb(){
        $check = tb_edit::where('id_bahan','!=','NULL')->where('id_user',Auth::user()->id)->delete();
        $bahan = tr_tabulasi_bahan::where('user',Auth::user()->id)->delete();
        return redirect::route('tabulasibb');
    }

    public function pilih(Request $request){
        $rules = array();
        if($request->id!=''){
            $validator = Validator::make($request->all(), $rules);
            if ($validator->passes()) {
                $idz = implode(",", $request->input('id'));
                $ids = explode(",", $idz);
                for ($i = 0; $i < count($ids); $i++){
                    $pipeline = new tb_edit;
                    $pipeline->id_user=Auth::user()->id;
                    $pipeline->id_bahan = $ids[$i];
                    $pipeline->save();
                    $i = $i++;

                }
            }

            $form=tb_edit::where('id_user',$pipeline->id_user)->count();
            if($form>0){
                $data=tb_edit::where('id_user',$pipeline->id_user)->get();
                foreach ($data as $data){
                    $par= new tr_tabulasi_bahan;
                    $par->id_bahan=$data->id_bahan;
                    $par->user=Auth::user()->id;
                    $par->form1=$request->form1;
                    $par->form2=$request->form2;
                    $par->form3=$request->form3;
                    $par->form4=$request->form4;
                    $par->form5=$request->form5;
                    $par->form6=$request->form6;
                    $par->form7=$request->form7;
                    $par->form8=$request->form8;
                    $par->form9=$request->form9;
                    $par->form10=$request->form10;
                    $par->form11=$request->form11;
                    $par->form12=$request->form12;
                    $par->form13=$request->form13;
                    $par->form14=$request->form14;
                    $par->form15=$request->form15;
                    $par->form16=$request->form16;
                    $par->form17=$request->form17;
                    $par->form18=$request->form18;
                    $par->form19=$request->form19;
                    $par->form20=$request->form20;
                    $par->form21=$request->form21;
                    $par->form22=$request->form22;
                    $par->form23=$request->form23;
                    $par->form24=$request->form24;
                    $par->form25=$request->form25;
                    $par->form26=$request->form26;
                    $par->form27=$request->form27;
                    $par->form28=$request->form28;
                    $par->form29=$request->form29;
                    $par->form30=$request->form30;
                    $par->form31=$request->form31;
                    $par->form32=$request->form32;
                    $par->form33=$request->form33;
                    $par->form34=$request->form34;
                    $par->form35=$request->form35;
                    $par->form36=$request->form36;
                    $par->form37=$request->form37;
                    $par->form38=$request->form38;
                    $par->form39=$request->form39;
                    $par->form40=$request->form40;
                    $par->form41=$request->form41;
                    $par->form42=$request->form42;
                    $par->form43=$request->form43;
                    $par->form44=$request->form44;
                    $par->form45=$request->form45;
                    $par->form46=$request->form46;
                    $par->form47=$request->form47;
                    $par->form48=$request->form48;
                    $par->form49=$request->form49;
                    $par->form50=$request->form50;
                    $par->form51=$request->form51;
                    $par->form52=$request->form52;
                    $par->form53=$request->form53;
                    $par->form54=$request->form54;
                    $par->form55=$request->form55;
                    $par->form56=$request->form56;
                    $par->form57=$request->form57;
                    $par->form58=$request->form58;
                    $par->form59=$request->form59;
                    $par->form60=$request->form60;
                    $par->form61=$request->form61;
                    $par->form62=$request->form62;
                    $par->form63=$request->form63;
                    $par->form64=$request->form64;
                    $par->form65=$request->form65;
                    $par->form66=$request->form66;
                    $par->form67=$request->form67;
                    $par->form68=$request->form68;
                    $par->form69=$request->form69;
                    $par->save();
                }
            }
        }
        return redirect::Route('edittabulasi');
    }

    public function update_bahan(Request $request) {
        $scores = $request->input('scores');
        foreach($scores as $row){
            $makro = tr_makro_bb::where('id_bahan',$row['id'])->update([
                "id_bahan" => $row['id'],
                "karbohidrat" => $row['karbohidrat'],
                "glukosa" => $row['glukosa'],
                "serat_pangan" => $row['serat_pangan'],
                "beta_glucan" => $row['beta_glucan'],
                "sorbitol" => $row['sorbitol'],
                "maltitol" => $row['maltitol'],
                "laktosa" => $row['laktosa'],
                "sukrosa" => $row['sukrosa'],
                "gula" => $row['gula'],
                "erythritol" => $row['erythritol'],
                "DHA" => $row['DHA'],
                "EPA" => $row['EPA'],
                "Omega3" => $row['Omega3'],
                "mufa" => $row['mufa'],
                "lemak_trans" => $row['lemak_trans'],
                "lemak_jenuh" => $row['lemak_jenuh'],
                "sfa" => $row['sfa'],
                "omega6" => $row['omega6'],
                "kolesterol" => $row['kolesterol'],
                "protein" => $row['protein'],
                "kadar_air" => $row['kadar_air']
            ]);

            $mineral = tr_mineral_bb::where('id_bahan',$row['id'])->update([
                "id_bahan" => $row['id'],
                "ca" => $row['ca'],
                "mg" => $row['mg'],
                "k" => $row['k'],
                "zink" => $row['zink'],
                "p" => $row['p'],
                "na" => $row['na'],
                "naci" => $row['naci'],
                "energi" => $row['energi'],
                "fosfor" => $row['fosfor'],
                "mn" => $row['mn'],
                "cr" => $row['cr'],
                "fe" => $row['fe']
            ]);

            $vitamin = tr_vitamin_bb::where('id_bahan',$row['id'])->update([
                "id_bahan" => $row['id'],
                "vitA" => $row['vitA'],
                "vitB1" => $row['vitB1'],
                "vitB2" => $row['vitB2'],
                "vitB3" => $row['vitB3'],
                "vitB5" => $row['vitB5'],
                "vitB6" => $row['vitB6'],
                "vitB12" => $row['vitB12'],
                "vitC" => $row['vitC'],
                "vitD" => $row['vitD'],
                "vitE" => $row['vitE'],
                "vitK" => $row['vitK'],
                "folat" => $row['folat'],
                "biotin" => $row['biotin'],
                "kolin" => $row['kolin']
            ]);

            $makro = tr_asam_amino_bb::where('id_bahan',$row['id'])->update([
                "id_bahan" => $row['id'],
                "l_glutamin" => $row['l_glutamin'],
                "Threonin" => $row['Threonin'],
                "Methionin" => $row['Methionin'],
                "Phenilalanin" => $row['Phenilalanin'],
                "Histidin" => $row['Histidin'],
                "lisin" => $row['lisin'],
                "BCAA" => $row['BCAA'],
                "Valin" => $row['Valin'],
                "Leusin" => $row['Leusin'],
                "Aspartat" => $row['Aspartat'],
                "Alanin" => $row['Alanin'],
                "Sistein" => $row['Sistein'],
                "Serin" => $row['Serin'],
                "Glisin" => $row['Glisin'],
                "Glutamat" => $row['Glutamat'],
                "Tyrosin" => $row['Tyrosin'],
                "Proline" => $row['Proline'],
                "Arginine" => $row['Arginine'],
                "Isoleusin" => $row['Isoleusin']
            ]);
        }
        return redirect::back()->with('status', 'Revised data ');
    }
}
