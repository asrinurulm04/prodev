<?php

namespace App\Http\Controllers\PengajuanFS;

use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Mail;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use App\model\users\User;
use App\model\users\Departement;
use App\model\pkp\uom;
use App\model\pkp\Forecast;
use App\model\pkp\PkpProject;
use App\model\formula\Formula;
use App\model\Modelkemas\datakemas;
use App\model\feasibility\Feasibility;
use App\model\feasibility\WorkbookFs;
use App\model\feasibility\FormPengajuanFS;
use Redirect;

class PengajuanFsController extends Controller
{
    public function formPengajuanFS($id_project,$for){
        $pkp = PkpProject::where('id_project',$id_project)->first();
        $formula = Formula::where('id',$for)->first();
        $for = Forecast::where('id_project',$id_project)->get();
        $uom = uom::where('note',NULL)->get();
        $uom_primer = uom::where('note','!=',NULL)->get();
        return view('pengajuanFS.pengajuanFS_PKP')->with([
            'pkp' => $pkp,
            'for' => $formula,
            'uom' => $uom,
            'uom_primer' => $uom_primer,
            'fch' => $for
        ]);
    }

    public function ajukanPKP(Request $request,$id_project,$for){
        $wf = Feasibility::where('id_project',$id_project)->count();
        $hasil = $wf+1;
        // Edit PKP sebelum di ajukan
        $pkp = PkpProject::where('id_project',$id_project)->first();
        $pkp->idea=$request->idea;
        $pkp->UOM=$request->uom;
        $pkp->selling_price=$request->selling;
        $pkp->price=$request->price;
            $kemas = new datakemas;
            $kemas->nama        = '-';
            $kemas->tersier     = $request->tersier;
            $kemas->s_tersier   = $request->s_tersier;
            $kemas->primer      = $request->primer;
            $kemas->s_primer    = $request->s_primer;
            $kemas->sekunder1   = $request->sekunder1;
            $kemas->s_sekunder1 = $request->s_sekunder1;
            $kemas->sekunder2   = $request->sekunder2;
            $kemas->s_sekunder2 = $request->s_sekunder2;
            $kemas->save();
        $pkp->kemas_eksis=$kemas->id_kemas;
        $pkp->primery=$request->primary;
        $pkp->secondary=$request->secondary;
        $pkp->tertiary=$request->tertiary;
        $pkp->pengajuan_fs='sent';
        $pkp->feasibility=$pkp->feasibility +1 ;
        $pkp->save();
        
        $fs = new Feasibility;
        $fs->id_formula=$for;
            if($wf=='0'){
                $fs->revisi='1';
            }elseif($wf!='0'){
                $fs->revisi=$hasil;
            }
        $fs->id_project=$id_project;
        $fs->tgl_pengajuan=$request->create;
        $fs->status_feasibility='pengajuan';
        $fs->save();

        $formula = Formula::where('id',$for)->first();
        $formula->status_feasibility='proses';
        $formula->save();

        if($request->satuan!=''){
            $for = Forecast::where('id_project',$id_project)->delete();
            $data      = array(); 
            $validator = Validator::make($request->all(), $data);  
            if ($validator->passes()) {
				$idz = implode(',', $request->input('forecast'));
				$ids = explode(',', $idz);
				$ida = implode(',', $request->input('satuan'));
				$idb = explode(',', $ida);
				for ($i = 0; $i < count($ids); $i++){
					$pipeline = new Forecast;
                    $pipeline->id_project   = $pkp->id_project;
                    $pipeline->id_pkp       = $pkp->id_pkp;
                    $pipeline->revisi       = $pkp->revisi;
                    $pipeline->turunan      = $pkp->turunan;
                    $pipeline->revisi_kemas = $pkp->revisi_kemas;
					$pipeline->forecast     = $ids[$i];
					$pipeline->satuan       = $idb[$i];
					$pipeline->save();
					$i = $i++;
				}
			}
		}

        $isipkp = PkpProject::where('id_project',$id_project)->get();
        $for    = Forecast::where('id_project',$id_project)->get();
        try{
            Mail::send('email.infoemailpkp', [
                'app'  => $isipkp,
                'for'    => $for,
                'info' => 'Terdapat Pengajuan Feasibility Untuk Project PKP Berikut! ',
            ], function ($message) use ($request,$id_project) {
                $data  = PkpProject::where('id_project',$id_project)->first();
                $dept  = Departement::where('dept','REA')->first();
                $user1 = User::where('id',$dept->manager_id)->first();
                $user2 = User::where('id',$data->perevisi)->first();
                $message->subject('PRODEV | Pengajuan Feasibility-PKP');
                $message->to($user1->email);
                $message->cc($user2->email);

            });
            return back()->with('status','E-mail Successfully');
        }
        catch (Exception $e){
        return response (['status' => false,'errors' => $e->getMessage()]);
        }

        return redirect::route('rekappkp',[$pkp->id_project,$pkp->id_pkp]);
    }

    public function BatalAjukanFS(Request $request,$id_project,$for){
        $formula = Formula::where('id',$for)->first();
        $formula->status_feasibility='reject';
        $formula->save();

        $fs = Feasibility::where('id_project',$id_project)->where('id_formula',$for)->first();
        $fs->status_feasibility='batal';
        $fs->save();

        $pkp = PkpProject::where('id_project',$id_project)->first();
        $pkp->feasibility=$pkp->feasibility - 1;
        $pkp->save();

        $isipkp = PkpProject::where('id_project',$id_project)->get();
        $for    = Forecast::where('id_project',$id_project)->get();
        try{
            Mail::send('email.infoemailpkp', [
                'app'  => $isipkp,
                'for'    => $for,
                'info' => 'Pengajuan Feasibility Untuk Project PKP Ini Dibatalkan Oleh PV! ',
            ], function ($message) use ($request,$id_project) {
                $data  = PkpProject::where('id_project',$id_project)->first();
                $dept  = Departement::where('dept','REA')->first();
                $user1 = User::where('id',$dept->manager_id)->first();
                $user2 = User::where('id',$data->perevisi)->first();
                $message->subject('PRODEV | Pengajuan Feasibility-PKP');
                $message->to($user1->email);
                $message->cc($user2->email);

            });
            return back()->with('status','E-mail Successfully');
        }
        catch (Exception $e){
        return response (['status' => false,'errors' => $e->getMessage()]);
        }

        return redirect::route('rekappkp',[$id_project,$formula->workbook_id])->with('status', 'Project canceled!');
    }

    public function DetailPengajuanFsPKP($id_project,$for,$fs){
        $pkp = PkpProject::where('id_project',$id_project)->first();
        $formula = Formula::where('id',$for)->first();
        $for = Forecast::where('id_project',$id_project)->where('forecast','!=','0')->min('forecast');
        return view('pengajuanFS.DetailPengajuanFS_PKP')->with([
            'formula' => $formula,
            'pkp' => $pkp,
            'fs' => $fs,
            'fch' => $for
        ]);
    }

    public function overview(Request $request){
        $fs = FormPengajuanFS::where('id_feasibility',$request->id_fs)->count();
        if($fs=='0'){
            $form = new FormPengajuanFS;
            $form->id_feasibility=$request->id_fs;
            $form->forecast=$request->forecast;
            $form->uom=$request->uom;
            $form->location=$request->location;
            $form->Pricelist=$request->uom;
            $form->uon_box=$request->uom_box;
            $form->box_batch=$request->box_batch;
            $form->mass_uom=$request->mass_uom;
            $form->serving_size=$request->serving_size;
            $form->serving_uom=$request->serving_uom;
            $form->servings_month=$request->serving_month;
            $form->Batch_month=$request->batch_month;
            $form->batch_size=$request->batch_size;
            $form->batch_granulation=$request->batch_granulation;
            $form->Yield=$request->yiels;
            $form->new_material=$request->new_material;
            $form->new_machine=$request->new_Machine;
            $form->trial=$request->trial;
            $form->notes=$request->note;
            $form->user_id=$request->forecast;
            $form->created_date=$request->create;
            $form->save();
        }elseif($fs>='0'){
            $form = FormPengajuanFS::where('id_feasibility',$request->id_fs)->first();
            $form->forecast=$request->forecast;
            $form->uom=$request->uom;
            $form->location=$request->location;
            $form->Pricelist=$request->uom;
            $form->uon_box=$request->uom_box;
            $form->box_batch=$request->box_batch;
            $form->mass_uom=$request->mass_uom;
            $form->serving_size=$request->serving_size;
            $form->serving_uom=$request->serving_uom;
            $form->servings_month=$request->serving_month;
            $form->Batch_month=$request->batch_month;
            $form->batch_size=$request->batch_size;
            $form->batch_granulation=$request->batch_granulation;
            $form->Yield=$request->yiels;
            $form->new_material=$request->new_material;
            $form->new_machine=$request->new_Machine;
            $form->trial=$request->trial;
            $form->notes=$request->note;
            $form->created_date=$request->create;
            $form->save();
        }

        if($request->info=='sent'){
            $fs = Feasibility::where('id',$request->id_fs)->first();
            $fs->status_maklon='proses';
            $fs->status_kemas='proses';
            $fs->status_lab='proses';
            $fs->status_feasibility='proses';
            $fs->lokasi=$request->location;
            $fs->batch_size=$request->batch_size;
            $fs->save();

            $pkp = PkpProject::where('id_project',$fs->id_project)->first();
            $pkp->pengajuan_fs='proses';
            $pkp->save();

            $isipkp = PkpProject::where('id_project',$fs->id_project)->get();
            $for    = Forecast::where('id_project',$fs->id_project)->get();
            $id     = $fs->id_project;
            try{
                Mail::send('email.infoemailpkp', [
                    'app'  => $isipkp,
                    'for'    => $for,
                    'info' => 'Terdapat Pengajuan Feasibility Untuk Project PKP Berikut! ',
                ], function ($message) use ($request,$id) {
                    $data       = PkpProject::where('id_project',$id)->first();
                    $dept       = Departement::where('dept','RKA')->first();
                    $user1      = User::where('id',$dept->manager_id)->first();
                    $userLab    = User::where('role_id','11')->first();
                    $user2      = User::where('id',$data->user_fs)->first();
                    $message->subject('PRODEV | Pengajuan Feasibility-PKP');
                    $message->to([$user1->email,$userLab->email]);
                    $message->cc($user2->email);

                });
            }
            catch (Exception $e){
            return response (['status' => false,'errors' => $e->getMessage()]);
            }
        }

        return redirect::route('listPkpFs',$request->id_project);
    }

    public function user_fs(Request $request,$id_project){
        $pkp = PkpProject::where('id_project',$id_project)->first();
        $pkp->user_fs=$request->user;
        $pkp->save();

        return redirect::back();
    }
}
