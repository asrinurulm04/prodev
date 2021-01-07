<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Modelmesin\Dmesin;
use App\model\pkp\jenis;
use App\model\pkp\tipp;
use App\model\pkp\pkp_project;

class DataController extends Controller
{
    public function runtime($id_feasibility){
        $Mdata = Dmesin::with('meesin')->get()->where('id_feasibility', $id_feasibility);
        return response()->json($Mdata);
    }

    public function updateView($id_mesin){
        $res = Dmesin::where('id_mesin', $id_mesin)->first();
        return response()->json($res);
    }

    public function delete($id){
        $mesin = Dmesin::find($id);
        
        if($mesin->delete()){
            $res = [
                'status' => 200
            ];
        } else {
            $res = [
                'status' => 403
            ];
        }

        return response()->json($res);
    }
    
    public function index(){
        $pkp = tipp::join('pkp_project','pkp_project.id_project','=','tippu.id_pkp')->where('type','=','1')->where('status_project','!=','draf')->get();
        return response()->json($pkp);
    }
}