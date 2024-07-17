<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Color;
use Illuminate\Http\Request;
use App\Traits\ApiResponse;
use Validator;

class colorController extends Controller
{
    use ApiResponse;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Color::get();
        return view('admin/Color/color', get_defined_vars());
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
            'value' => 'required|string|max:255',
        ]);
        
        if($validation->fails()) {
            return $this->error([], $validation->errors()->first(), 400 );
        } else {
            Color::updateOrCreate(
                ['id' => $request->post('id') ],
                [
                    'text' => $request->text,
                    'value' => $request->value,
                ]
            );   

            return $this->success( ['reload' => true], 'Successfully saved.'); 
        }
    }
}
