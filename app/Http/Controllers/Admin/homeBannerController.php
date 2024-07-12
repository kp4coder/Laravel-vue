<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\HomeBanner;
use App\Traits\ApiResponse;
use Illuminate\Http\Request;

use Validator;

class homeBannerController extends Controller
{
    use ApiResponse;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = HomeBanner::get();
        return view('admin//HomeBanner/homeBanners', get_defined_vars());
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
            'text' => 'required|string|max:255',
            'link' => 'required|string|max:255',
            'image' => 'mimes: jpeg,png,jpg,gif|max:5120' // max 5 mb
        ]);
        
        if($validation->fails()) {
            return $this->error([], $validation->errors()->first(), 400 );
        } else {
            if( $request->hasfile('image') ) {
                if( $request->id > 0 ) {
                    $image = HomeBanner::where('id', $request->id)->first();
                    $image_path = 'images/'.$image->image;
                    if( File::exists($image_path) ) {
                        File::delete($image_path);
                    }
                }
                $image_name = time() . '.' . $request->image->extension();
                $request->image->move( public_path('images/'), $image_name );
            } else if( $request->id > 0 ) {
                $image_name = HomeBanner::where('id', $request->id)->pluck('image')->first();
            }

            HomeBanner::updateOrCreate(
                ['id' => $request->post('id') ],
                [
                    'text' => $request->text,
                    'link' => $request->link,
                    'image' => $image_name
                ]
            );   

            return $this->success( ['reload' => true], 'Successfully saved.'); 
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
