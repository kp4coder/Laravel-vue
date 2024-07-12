<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Validator;
use Auth;

class AuthController extends Controller
{
    public function loginUser(Request $request) {
        $validation = Validator::make( $request->all(), [
            'email' => 'required|string|email|exists:users,email',
            'password' => 'required|string'
        ]);

        if( $validation->fails() ) {
            return response()->json(['status'=>400, 'message' => $validation->errors()->first()]);
        } else {
            $cred = array('email'=>$request->email, 'password'=>$request->password);
            if( Auth::attempt($cred, false) ) {
                if( Auth::User()->hasRole('admin')) {
                    return response()->json(['status' => 200, 'message'=> 'admin login success', 'url' => 'admin/dashboard']);
                } else {
                    return response()->json(['status' => 200, 'message'=> 'not admin login success']);
                }
            } else {
                return response()->json(['status' => 404, 'message'=> 'wrong details']);
            }
        }
    }
}