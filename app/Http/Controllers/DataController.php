<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\model\Modelmesin\Dmesin;

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

    public function loadData(Request $request)
    {
    	if ($request->has('q')) {
    		$cari = $request->q;
    		$data = DB::table('tr_project_pkp')->select('project_name')->where('project_name', 'LIKE', '%$cari%')->get();
    		return response()->json($data);
    	}
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
}