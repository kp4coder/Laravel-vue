<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Traits\ApiResponse;
use Illuminate\Http\Request;

use Validator;
use Auth;

class profileController extends Controller
{
    use ApiResponse;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin/profile');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validation = Validator::make( $request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|unique:users,email,'.Auth::User()->id,
            'phone' => 'required',
            'address' => 'required|string|max:255',
            'image' => 'mimes:jpeg,jpg,png,gif|max:5120',
            'website_link' => 'required|string|max:255',
            'github_link' => 'string|max:255',
            'twitter_link' => 'string|max:255',
            'instagram_link' => 'string|max:255',
            'facebook_link' => 'string|max:255',
        ]);

        if( $validation->fails() ) {
            return $this->error([], $validation->errors()->first());
        } else {
            if( $request->hasFile('image') ) {
                $image_name = 'image/'.$request->name.time() . '.' . $request->image->extension();
                $request->image->move( public_path('image/'), $image_name );
            } else {
                $image_name = Auth::User()->image;
            }

            $user = User::updateOrCreate(
                ['id' => Auth::User()->id],
                [
                    'name' => $request->name,
                    'email' => $request->email,
                    'phone' => $request->phone,
                    'address' => $request->address,
                    'image' => $image_name,
                    'website_link' => $request->website_link,
                    'github_link' => $request->github_link,
                    'twitter_link' => $request->twitter_link,
                    'instagram_link' => $request->instagram_link,
                    'facebook_link' => $request->facebook_link
                ]
            );

            return $this->success([], 'successfully updated.');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
