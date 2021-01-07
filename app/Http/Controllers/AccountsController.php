<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

use App\model\users\User;
use DB;
use Mail;
use Redirect;
use Carbon\Carbon;

class AccountsController extends Controller
{
    public function validatePasswordRequest(Request $request){
        $user = DB::table('users')->where('email', '=', $request->email)->where('username',$request->username)->first();
        $user1 = DB::table('users')->where('email', '=', $request->email)->where('username',$request->username)->count();

        //Check if the user exists
        if ($user1 < 1) {
            return redirect()->back()->withErrors(['email' => trans('User does not exist, please check your email or username')]);
        }

        //Create Password Reset Token
        DB::table('password_resets')->insert([
            'email' => $request->email,
            'token' => str_random(60),
            'created_at' => Carbon::now()
        ]);
        //Get the token just created above
        $tokenData = DB::table('password_resets') ->where('email', $request->email)->first();
        if ($this->sendResetEmail($request->email, $tokenData->token)) {
            return redirect()->route('reset',$user->id);
        } else {
            return redirect()->back()->withErrors(['error' => trans('A Network Error occurred. Please try again.')]);
        }
    }

    public function update(Request $request){
        $user = User::find($request->id);
        $this->validate(request(), [
            'username' => 'unique:users,username,'.$user->id,
            'email' => 'unique:users,email,'.$user->id,
            'password' => 'confirmed'
        ]);
        
        $user->name = $request->name;
        $user->username = $request->username;
        $user->email = $request->email;
        $user->password = $request->password;
        $user->save();
        
        return Redirect::route('signin')->with('status','Profil Anda Telah Dirubah !');
    }

    private function sendResetEmail($email, $token){
        //Retrieve the user from the database
        $user = DB::table('users')->where('email', $email)->select('username', 'email')->first();
        //Generate, the password reset link. The token generated is embedded in the link
        $link = config('base_url') . 'password/reset/' . $token . '?email=' . urlencode($user->email);
        return view('resetpass')->with([
            'user' => $user,
            'token' => $token
        ]);
    }
}