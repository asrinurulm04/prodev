<?php

namespace App\Http\Controllers\kemas;

use Illuminate\Http\Request;
use App\Http\Requests\CsvImportRequest;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use App\model\Imports\Import;
use App\model\Imports\KemasImport;
use App\model\Modelkemas\FormulaKemas;
use App\model\Modelkemas\KonsepKemas;
use App\model\Modelfn\Finance;
use App\model\dev\Formula;
use App\model\pkp\SubPKP;
use Excel;

class KemasController extends Controller
{
	public function __construct(){
		$this->middleware('auth');
		$this->middleware('rule:kemas');
	}

	public function index(Request $request,$id, $id_feasibility){
		$formulas = SubPKP::where('id_pkp',$id)->where('status_data','=','active')->get();
		$request->session()->get('id_feasibility');
		$request->session()->put('id_feasibility', $id_feasibility);
		$fe=Finance::find($id_feasibility);
		$kemas =FormulaKemas::where('id_feasibility', $id_feasibility)->get();
		$konsep = KonsepKemas::where('id_feasibility', $id_feasibility)->get();
		$dataF = Finance::where('id_feasibility', $id_feasibility)->get();
		return view('kemas.uploadkemas', compact('toImport'))->with([
				'formulas' => $formulas,
				'dataF' => $dataF,
				'kemas' => $kemas,
				'id' => $id,
				'konsep' => $konsep,
				'fe'=>$fe,
				'id_feasibility' => $id_feasibility
			]);
	}

	public function storeData(Request $request, $id_feasibility){
		$id = $request->session()->get('id_feasibility');
		$this->validate($request, [
			'file' => 'required|mimes:csv,txt',
			'filename.*' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048'
		]);

		if ($request->hasFile('file')) {
			$file = $request->file('file');
			$data = new FormulaKemas;
            $data->id_feasibility=$request->finance;
             //GET FILE
            Excel::import(new KemasImport, $file, $data);
            $lastkemas = DB::table('fs_formula_kemas')->max('id_fk');
            $hapus = FormulaKemas::where('id_feasibility',$id)->delete();
            $changekemas = FormulaKemas::where('id_feasibility', '0')->update(['id_feasibility'=>$id]);
            // $changekemas->save();
			$change_status  = Finance::where('id_feasibility',$id_feasibility)->first();
			$change_status->status_kemas='sending';
			$change_status->save();

            return redirect()->back()->with(['success' => 'Upload success']);
        }
        return redirect()->back()->with(['error' => 'Please choose file before']);
    }
}