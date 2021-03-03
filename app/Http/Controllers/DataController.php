<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\model\Modelmesin\Dmesin;
use App\model\pkp\jenis;
use App\model\pkp\tipp;
use App\model\pkp\pkp_project;
use App\model\pkp\data_forecast;

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
    
    // public function index(){
    //     $pkp = tipp::join('pkp_project','pkp_project.id_project','=','tippu.id_pkp')->where('type','=','1')->where('status_project','!=','draf')->get();
    //     return response()->json($pkp);
    // }

    // public function add(Request $request){
    //     $post = Dmesin::create($request->all());
    //     $post->save();

    //     return response()->json($request);
    // }

    // public function update(Request $request){
    //     $post = Dmesin::where('id_data_mesin',$request->id_data_mesin)->update($request->all());
    //     $post->save();

    //     return response()->json($request);
    // }

    // public function for(){
    //     $for = data_forecast::all();
    //     return response()->json($for);
    // }
}