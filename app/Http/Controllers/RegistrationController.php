<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Mail;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\model\users\Departement;
use App\model\users\Role;
use App\model\users\User;
use DB;

class RegistrationController extends Controller
{
    public function __construct(){
        $this->middleware('guest');
    }

    public function create(){
        $roles = Role::all();
        $depts = Departement::all();
        return view('register')->with([
            'depts' => $depts,
            'roles' => $roles]);
    }

    public function registrationPost(Request $request){
        $this->validate(request(), [
            'username'  => 'unique:tr_users',
            'email'     => 'unique:tr_users|regex:"@nutrifood.co.id"',
            'password'  => 'confirmed'
        ]);
        
        $user = new User;
        $user->name           = $request->name;
        $user->username       = $request->username;
        $user->email          = $request->email;
        $user->password       = $request->password;
        $user->departement_id = $request->departement;
        $user->role_id        = $request->role;
        $user->save();
        
        $role = Role::where('id',$request->role)->first();
        try{ // memberi informasi kepada admin jika terdapat pengajuan user barus
            Mail::send('email.user', [
                'nama'  => $request->name,
                'email'  => $request->email,
                'roles'  => $role,
            ], function ($message) use ($request) {
                $dept  = Departement::where('id',$request->departement)->first(); //manager dari dept terkait
                $user1 = $request->email; // user yang mengajuan
                $user2 = User::where('id',$dept->manager_id)->first();
                $user = DB::table('tr_users')->where('role_id','4')->get(); //mencaru user admin
                $message->subject('PRODEV | Pengajuan User Baru!');
                foreach($user as $user){
                    $data = $user->email;
                    $message->to($data);
                }
                $message->cc($user1,$user2->email);
            });
        }
        catch (Exception $e){
            return response (['status' => false,'errors' => $e->getMessage()]);
        }

        return redirect()->to('/signin')->with('status', 'Add Data Success ');
    }
}