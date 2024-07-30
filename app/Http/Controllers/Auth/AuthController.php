<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Role;
use Illuminate\Http\Request;
use App\Traits\ApiResponse;
use Validator;
use Auth;

class AuthController extends Controller
{
    use ApiResponse;

    public function register(Request $request) {
        $validation = Validator::make( $request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|unique:users,email',
            'password' => 'required|string|min:6'
        ]);

        if($validation->fails()) {
            return $this->error([], $validation->errors()->first(), 400);
        } else {
            $user = User::create([
                'name' => $request->name,
                'email' => $request->email,
                'password' => bcrypt( $request->password )
            ]);

            $customer = Role::where('slug', 'customer')->first();
            $user->roles()->attach($customer);
            
            return $this->success( ['Token' => $user->createToken('API Token')->plainTextToken] );
        }
    }

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
                    $user = user::where('id', Auth::user()->id)->first();
                    $user['token'] = $user->createToken('API Token')->plainTextToken;
                    return $this->success( [ 'user' => $user ], 'Customer login success' );
                }
            } else {
                return response()->json(['status' => 404, 'message'=> 'wrong details']);
            }
        }
    }

    public function updateUser(Request $request) {
        $validation = Validator::make( $request->all(), [
            'name' => 'required|string|max:255'
        ]);

        if( $validation->fails() ) {
            return $this->error( [], $validation->errors()->first(), 400 );
        } else {
            // Auth::User()->update(['name' => $request->name ]);

            User::updateOrCreate(
                ['id' => Auth::user()->id],
                ['name' => $request->name]
            );

            return $this->success( ['user' => $request->user()], 'successfully update');
        }
    }
}
