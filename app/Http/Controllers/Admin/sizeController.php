<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Size;
use Illuminate\Http\Request;
use App\Traits\ApiResponse;
use Validator;


class sizeController extends Controller
{
    //
    use ApiResponse;

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Size::get();
        return view('admin/Size/size', get_defined_vars());
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
        ]);
        
        if($validation->fails()) {
            return $this->error([], $validation->errors()->first(), 400 );
        } else {
            Size::updateOrCreate(
                ['id' => $request->post('id') ],
                ['text' => $request->text ]
            );   

            return $this->success( ['reload' => true], 'Successfully saved.'); 
        }
    }
}
