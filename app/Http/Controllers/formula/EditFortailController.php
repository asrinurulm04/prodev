<?php

namespace App\Http\Controllers\formula;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\dev\Fortail;
use App\dev\Bahan;
use App\dev\Premix;
use App\dev\Formula;
use App\dev\Pretail;
use Auth;

class EditFortailController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
        $this->middleware('rule:user_rd_proses' || 'rule:user_produk');
    }
        
    public function index($id)
    {    
        $fortail = Fortail::where('id',$id)->get();
        $edit = Fortail::where('id',$id)->get();
        $fortails = Fortail::where('id',$id)->first();
        $for = formula::where('id',$fortails->formula_id)->get();
        $idf = $fortails->formula_id;
        $myprioritas = Bahan::where('id',$fortails->bahan_id)->first();
        $bahans = Bahan::where('status','active')->orWhere('user_id',Auth::id())->get();
        $alternatifs = Bahan::where('subkategori_id',$myprioritas->subkategori_id)->get();
        $count_bahan = 8;
        for($i = 2;$i<=8;$i++){
            $ask = 'alternatif'.$i;
            $ii=$i-1;
            if($fortails->$ask == null){
                $count_bahan--;
            }
        }
        $count_alternatif = $count_bahan;

        return view('formula.editfortail')->with([
            'idf' => $idf,
            'fortail' => $fortail,
            'for' => $for,
            'edit' => $edit,
            'bahans' => $bahans,
            'alternatifs' => $alternatifs,
            'count_bahan' => $count_bahan,
            'count_alternatif' => $count_alternatif
        ]);
    }

    public function update($idf,$id,Request $request)
    {
        $delpremix = Premix::where('fortail_id',$id)->get();
        foreach($delpremix as $px){
            $delpretail = Pretail::where('premix_id')->get();
            foreach($delpretail as $pt){
                $pt->delete();
            }
            $px->delete();
        }
        $bp = Bahan::where('id', $request->prioritas)->first();
        $pin = $bp->id_ingredient;
        $pkk = $bp->kode_komputer;
        $pns = $bp->nama_sederhana;
        $pko = $bp->kode_oracle;
        $pnb = $bp->nama_bahan;

        $fortails = Fortail::where('id',$id)->first();

        $c = $request->c;
        if($c>0){
            for($d = 1;$d<=$c;$d++){
                $ba[$d] =  Bahan::where('id',$request->alternatif[$d])->first();
                // $pkk = $pkk.' / '.$ba[$d]->kode_komputer;
                // $pns = $pns.' / '.$ba[$d]->nama_sederhana;
                // $pko = $pko.' / '.$ba[$d]->kode_oracle;
                $e=$d+1;
                
                // $nk = 'kode_komputer'.$e;
                // $fortails->$nk = $ba[$d]->id;
            }
        }
        
        $fortails->formula_id = $idf;
        $fortails->kode_komputer = $bp->kode_komputer;
        $fortails->id_ingredient = $pin;
        $fortails->kode_oracle = $bp->kode_oracle;
        $fortails->nama_sederhana = $bp->nama_sederhana;
        $fortails->principle = $bp->principle;
        $fortails->kode_oracle = $pko;
        $fortails->bahan_id = $bp->id;
        $fortails->nama_bahan = $bp->nama_bahan;
            if($c=1){
            $fortails->alternatif1= $ba[1]->nama_sederhana;
            $fortails->nama_bahan1= $ba[1]->nama_bahan;
            $fortails->principle1= $ba[1]->principle;
            }
            if($c>=2){
            $fortails->alternatif2= $ba[2]->nama_sederhana;
            $fortails->nama_bahan2= $ba[2]->nama_bahan;
            $fortails->principle2= $ba[2]->principle;
            }
            if($c>=3){
            $fortails->alternatif3= $ba[3]->nama_sederhana;
            $fortails->nama_bahan3= $ba[3]->nama_bahan;
            $fortails->principle3= $ba[3]->principle;
            }
            if($c>=4){
            $fortails->alternatif4= $ba[4]->nama_sederhana;
            $fortails->nama_bahan4= $ba[4]->nama_bahan;
            $fortails->principle4= $ba[4]->principle;
            }
            if($c>=5){
            $fortails->alternatif5= $ba[5]->nama_sederhana;
            $fortails->nama_bahan5= $ba[5]->nama_bahan;
            $fortails->principle5= $ba[5]->principle;
            }
            if($c>=6){
            $fortails->alternatif6= $ba[6]->nama_sederhana;
            $fortails->nama_bahan6= $ba[6]->nama_bahan;
            $fortails->principle6= $ba[6]->principle;
            }
            if($c>=7){
            $fortails->alternatif7= $ba[7]->nama_sederhana;
            $fortails->nama_bahan7= $ba[7]->nama_bahan;
            $fortails->principle7= $ba[7]->principle;
            }
        if($request->per_batch >= 3000){
            $fortails->jenis_timbangan='B';
        }elseif($request->per_batch < 3000){
            $fortails->jenis_timbangan='A';
        }

        $fortails->save();

        $jumlah_bahan = $c + 1;

        // // Premix(Bahan Ada Satu)------------------------------------
        // if($jumlah_bahan == 1){
        //     $kgbatch = $fortails->per_batch / 1000;
        //     $persiapan_utuh = intdiv($kgbatch,$bp->berat);
        //     $persiapan_koma = round(fmod($kgbatch,$bp->berat),5);
            
        //     $premix = new Premix;
        //     $premix->fortail_id = $fortails->id;
        //     $premix->utuh = $persiapan_utuh;
        //     $premix->koma = $persiapan_koma;
        //     $premix->utuh_cpb = $persiapan_utuh;
        //     $premix->koma_cpb = $persiapan_koma;
        //     $premix->satuan = $bp->satuan->satuan;
        //     $premix->berat = $bp->berat;
        //     $premix->save();
        // }

        // Premix(Bahan Ada Lebih Dari Satu)-----------------
        // if($jumlah_bahan > 1){

        //     $kgbatch = $fortails->per_batch / 1000;
        //     for($i=1;$i<=$jumlah_bahan;$i++){
        //         if($i==1){
        //             $persiapan_utuh[1] = intdiv($kgbatch,$bp->berat);
        //             $persiapan_koma[1] = round(fmod($kgbatch,$bp->berat),5);
        //             $persiapan_keterangan[1] = $bp->nama_sederhana;
        //             $persiapan_satuan[1] = $bp->satuan->satuan;
        //             $persiapan_berat[1] = $bp->berat;
        //             $myCollection = collect([
        //                 ['utuh' => $persiapan_utuh[1],
        //                  'koma' => $persiapan_koma[1], 
        //                  'keterangan' => $persiapan_keterangan[1], 
        //                  'satuan'=> $persiapan_satuan[1], 
        //                  'berat' => $persiapan_berat[1]]
        //             ]);       
        //         }
        //         else{
        //             $ii = $i - 1;
        //             $persiapan_utuh[$i] = intdiv($kgbatch,$ba[$ii]->berat);
        //             $persiapan_koma[$i] = round(fmod($kgbatch,$ba[$ii]->berat),5);
        //             $persiapan_keterangan[$i] = $ba[$ii]->nama_sederhana;
        //             $persiapan_satuan[$i] = $ba[$ii]->satuan->satuan;
        //             $persiapan_berat[$i] = $ba[$ii]->berat;
        //             $myCollection->push([
        //                 'utuh' => $persiapan_utuh[$i], 
        //                 'koma' => $persiapan_koma[$i], 
        //                 'keterangan' => $persiapan_keterangan[$i],
        //                 'satuan' => $persiapan_satuan[$i],
        //                 'berat' => $persiapan_berat[$i]
        //             ]);
        //         }
        //     }
           
        //     $groupMyCollection = $myCollection->groupBy('utuh');
        //     // $groupMyCollection->toArray();

        // foreach($groupMyCollection as $eachRow){
        //     $premix = new Premix;
        //     $premix->fortail_id = $fortails->id;
        //         $hiji = 1;
        //         foreach($eachRow as $each){
        //             if($hiji == 1){
        //                 $persiapan_keterangan = 'Jika '.$each['keterangan'];
        //                 $premix->utuh = $each['utuh'];
        //                 $premix->koma = $each['koma'];
        //                 $premix->utuh_cpb = $each['utuh'];
        //                 $premix->koma_cpb = $each['koma'];
        //                 $premix->satuan = $each['satuan'];
        //                 $premix->berat = $each['berat'];
        //             }
        //             else{
        //                 $persiapan_keterangan = $persiapan_keterangan.' / '.$each['keterangan'];
        //             }
        //             $hiji = 0;
        //         }
        //     $premix->keterangan = $persiapan_keterangan;
        //     $premix->save();
        // }

        // }
        

        return Redirect()->back()->with('status','Bahan Baku Telah Di Update');
    }
}
