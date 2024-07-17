<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Attribute;
use App\Models\AttributeValue;
use Illuminate\Http\Request;
use App\Traits\ApiResponse;
use Validator;

class attributeController extends Controller
{
    use ApiResponse;

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function indexAttributeName()
    {
        $data = Attribute::get();
        return view('admin/Attribute/attribute', get_defined_vars());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function storeAttributeName(Request $request)
    {
        $validation = Validator::make( $request->all(), [
            'name' => 'required|string|max:255',
            'slug' => 'required|string|max:255',
        ]);
        
        if($validation->fails()) {
            return $this->error([], $validation->errors()->first(), 400 );
        } else {
            Attribute::updateOrCreate(
                ['id' => $request->post('id') ],
                [
                    'name' => $request->name,
                    'slug' => $request->slug,
                ]
            );   

            return $this->success( ['reload' => true], 'Successfully saved.'); 
        }
    }

    

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function indexAttributeValue()
    {
        $data = AttributeValue::with('singleAttribute')->get();
        $attribute = Attribute::get();
        return view('admin/Attribute/attributeValue', get_defined_vars());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function storeAttributeValue(Request $request)
    {
        $validation = Validator::make( $request->all(), [
            'attributes_id' => 'required|exists:attributes,id',
            'value' => 'required|string|max:255',
        ]);
        
        if($validation->fails()) {
            return $this->error([], $validation->errors()->first(), 400 );
        } else {
            AttributeValue::updateOrCreate(
                ['id' => $request->post('id') ],
                [
                    'attributes_id' => $request->attributes_id,
                    'value' => $request->value,
                ]
            );   

            return $this->success( ['reload' => true], 'Successfully saved.'); 
        }
    }
}
