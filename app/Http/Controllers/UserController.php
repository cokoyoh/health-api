<?php

namespace App\Http\Controllers;

use App\Mail\ForgotPassword;
use App\Project;
use App\Role;
use App\Token;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;


class UserController extends Controller
{
    /**
     * @param Request $request
     * handling forgot password
     */
    public function forgotPassword(Request $request)
    {
        $user = User::where('email', $request->input('email'))->first();
        if(!$user){
            return response(['message' => 'Check if the email is correct!'],403);
        }

        $token = Token::create([
            'user_id' => $user->id,
            'token' => uniqid(),
            'expire_at' => Carbon::now()->addHour()
        ]);

        Mail::to($user)->send(new ForgotPassword($token, $request));

        return response(['message' => 'Email has been sent. Please check your inbox'],200);
    }



    /**
     * @param Request $request
     * Handles Reset Password
     */
    public function resetPassword(Request $request)
    {
       $request->validate([
            'password' => 'required|min:6',
            'confirmation' => 'required|same:password',
        ]);

        $token = $request->input('token');
        $db_token = DB::table('tokens')
                        ->where('token',$token)
                        ->where('expire_at', '>', Carbon::now())
                        ->first();

        if(!$db_token){
            return response(['message' => 'Sorry, you cannot change the password!'],403);
        }

        $user = User::where('id', $db_token->user_id)->first();
        $user->password = bcrypt($request->input('password'));
        $user->save();

        DB::table('tokens')->where('id', $db_token->id)->delete();

        return response(['message' => 'Password changed successfully'],200);
    }
    
    public function getUserList()
    {
        $users =  User::with('roles')->get();
        return response(['data' => $users],200);
    }

    public function createUser()
    {
        $this->validate(request(),[
            'email' => 'unique:users',
        ]);

        $user = User::create([
            'name' => request('name'),
            'email' => request('email'),
            'password' => bcrypt(request('password')),
            'remember_token' => str_random(10),
        ]);
        $roleId = Role::where('name', 'client')->first()->id;
        $user->roles()->attach($roleId,['created_at'=>Carbon::now(),'updated_at'=>Carbon::now()]);

        return response(['message' => 'User registered successfully!'],200);
    }
}
