<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use Illuminate\Http\Request;

use App\Traits\ApiResponse;
use App\Traits\SaveFile;
use Validator;

class brandController extends Controller
{
    //
    use ApiResponse;
    use SaveFile;

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        $data = Brand::get();
        return view('admin/Brand/brand', get_defined_vars());
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
            'image' => 'mimes:jpeg,png,jpg,gif|max:5120'
        ]);
        
        if($validation->fails()) {
            return $this->error([], $validation->errors()->first(), 400 );
        } else {
            if( $request->id ) {
                $image = Brand::find( $request->id );
                $image_name = $this->saveImage($request->image, $image->image, 'images/brand');
            } else {
                $image_name = $this->saveImage($request->image, '', 'images/brand');
            }

            Brand::updateOrCreate(
                ['id' => $request->post('id') ],
                [
                    'text' => $request->text,
                    'image' => $image_name
                ]
            );   

            return $this->success( ['reload' => true], 'Successfully saved.'); 
        }
    }

}
