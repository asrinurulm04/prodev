<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Auth\User;
use DB;

class LoginController extends Controller
{
    public function __construct(){
        $this->middleware('guest');
    }
    
    public function getLogin(){
        return view('login');
    }

    public function reset($id_user){
        $user = DB::table('tr_users')->where('id',$id_user)->get();
        return view('resetpass')->with([
            'user' => $user
        ]);
    }

    public function postLogin(Request $request){
        //MARKETING==========================================================================================
        if(Auth::attempt([
            'email' =>$request->inputEmailUser,
            'password' => $request->password,
            'status' => 'active',
            'role_id' => 1
        ])){
            return redirect('dasboardnr');
        }
        elseif(Auth::attempt([
            'username' =>$request->inputEmailUser,
            'password' => $request->password,
            'status' => 'active',
            'role_id' => 1
        ])){
            return redirect('dasboardnr');
        }

        //USER PRODUK==========================================================================================
        if(Auth::attempt([
            'email' =>$request->inputEmailUser,
            'password' => $request->password,
            'status' => 'active',
            'role_id' => 2
        ])){
            return redirect('dasboardawal');
        }
        elseif(Auth::attempt([
            'username' =>$request->inputEmailUser,
            'password' => $request->password,
            'status' => 'active',
            'role_id' => 2
        ])){
            return redirect('dasboardawal');
        }

        //RD PROSES==========================================================================================
        if(Auth::attempt([
            'email' =>$request->inputEmailUser,
            'password' => $request->password,
            'status' => 'active',
            'role_id' => 3
        ])){
            return redirect('dasboardawal');
        }
        elseif(Auth::attempt([
            'username' =>$request->inputEmailUser,
            'password' => $request->password,
            'status' => 'active',
            'role_id' => 3
        ])){
            return redirect('dasboardawal');
        }
        
        //ADMIN==========================================================================================
        if(Auth::attempt([
            'email' =>$request->inputEmailUser,
            'password' => $request->password,
            'status' => 'active',
            'role_id' => 4
        ])){
            return redirect('/userapproval');
        }
        elseif(Auth::attempt([
            'username' =>$request->inputEmailUser,
            'password' => $request->password,
            'status' => 'active',
            'role_id' => 4
        ])){
            return redirect('/userapproval');
        }

        //PV GLOBAL============================================================================================
        if(Auth::attempt([
            'email' =>$request->inputEmailUser,
            'password' => $request->password,
            'status' => 'active',
            'role_id' => 5
        ])){
            return redirect()->route('dasboardpv');
        }
        elseif(Auth::attempt([
            'username' =>$request->inputEmailUser,
            'password' => $request->password,
            'status' => 'active',
            'role_id' => 5
        ])){
            return redirect()->route('dasboardpv');
        }
 
        //Produksi============================================================================================
        if(Auth::attempt([
            'email' =>$request->inputEmailUser,
            'password' => $request->password,
            'status' => 'active',
            'role_id' => 6
        ])){
            return redirect()->route('formula.feasibility');
        }
        elseif(Auth::attempt([
            'username' =>$request->inputEmailUser,
            'password' => $request->password,
            'status' => 'active',
            'role_id' => 6
        ])){
            return redirect()->route('formula.feasibility');        }

        //KEMAS============================================================================================
        if(Auth::attempt([
            'email' =>$request->inputEmailUser,
            'password' => $request->password,
            'status' => 'active',
            'role_id' => 7
        ])){
            return redirect()->route('dasboardawal');        }
        elseif(Auth::attempt([
            'username' =>$request->inputEmailUser,
            'password' => $request->password,
            'status' => 'active',
            'role_id' => 7
        ])){
            return redirect()->route('dasboardawal');        }

        //Evaluator============================================================================================
        if(Auth::attempt([
            'email' =>$request->inputEmailUser,
            'password' => $request->password,
            'status' => 'active',
            'role_id' => 8
        ])){
            return redirect()->route('formula.feasibility');
        }
        elseif(Auth::attempt([
            'username' =>$request->inputEmailUser,
            'password' => $request->password,
            'status' => 'active',
            'role_id' => 8
        ])){
            return redirect()->route('formula.feasibility');
        }

        //Finance============================================================================================
        if(Auth::attempt([
            'email' =>$request->inputEmailUser,
            'password' => $request->password,
            'status' => 'active',
            'role_id' => 9
        ])){
            return redirect()->route('listFsConting');        }
        elseif(Auth::attempt([
            'username' =>$request->inputEmailUser,
            'password' => $request->password,
            'status' => 'active',
            'role_id' => 9
        ])){
            return redirect()->route('listFsConting');        }

        //Lab============================================================================================
        if(Auth::attempt([
            'email' =>$request->inputEmailUser,
            'password' => $request->password,
            'status' => 'active',
            'role_id' => 11
        ])){
            return redirect()->route('dasboardawal');        }
        elseif(Auth::attempt([
            'username' =>$request->inputEmailUser,
            'password' => $request->password,
            'status' => 'active',
            'role_id' => 11
        ])){
            return redirect()->route('dasboardawal');        }

        //MANAGER============================================================================================
        if(Auth::attempt([
            'email' =>$request->inputEmailUser,
            'password' => $request->password,
            'status' => 'active',
            'role_id' => 12
        ])){
            return redirect()->route('dasboardmanager');        }
        elseif(Auth::attempt([
            'username' =>$request->inputEmailUser,
            'password' => $request->password,
            'status' => 'active',
            'role_id' => 12
        ])){
            return redirect()->route('dasboardmanager');        }
            
        //PV LOKAL============================================================================================
        if(Auth::attempt([
            'email' =>$request->inputEmailUser,
            'password' => $request->password,
            'status' => 'active',
            'role_id' => 14
        ])){
            return redirect()->route('dasboardpv');        }
        elseif(Auth::attempt([
            'username' =>$request->inputEmailUser,
            'password' => $request->password,
            'status' => 'active',
            'role_id' => 14
        ])){
            return redirect()->route('dasboardpv');        }
        
         //Maklon============================================================================================
         if(Auth::attempt([
            'email' =>$request->inputEmailUser,
            'password' => $request->password,
            'status' => 'active',
            'role_id' => 15
        ])){
            return redirect()->route('dasboardawal');        }
        elseif(Auth::attempt([
            'username' =>$request->inputEmailUser,
            'password' => $request->password,
            'status' => 'active',
            'role_id' => 15
        ])){
            return redirect()->route('dasboardawal');        }

        //Gagal==========================================================================================
        else{
            return back()->withErrors([
                'message' => 'The email Username or password is incorrect, or maybe your Account have not approve'
            ]);
        }
    }
}