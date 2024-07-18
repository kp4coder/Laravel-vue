<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;

use App\Traits\ApiResponse;
use App\Traits\SaveFile;
use Validator;

class productController extends Controller
{
    //
    use ApiResponse, SaveFile;

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Product::get();
        return view('admin/Product/product', get_defined_vars());
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
            'slug' => 'required|string|max:255',
            // 'parent_category_id' => 'exists:categories,id',
            'image' => 'mimes:jpeg,png,jpg,gif|max:5120'
        ]);
        
        if($validation->fails()) {
            return $this->error([], $validation->errors()->first(), 400 );
        } else {
            if( $request->id ) {
                $image = Product::find( $request->id );
                $image_name = $this->saveImage($request->image, $image->image, 'images/category');
            } else {
                $image_name = $this->saveImage($request->image, '', 'images/category');
            }

            Product::updateOrCreate(
                ['id' => $request->post('id') ],
                [
                    'name' => $request->name,
                    'slug' => $request->slug,
                    'parent_category_id' => $request->parent_category_id,
                    'image' => $image_name
                ]
            );   

            return $this->success( ['reload' => true], 'Successfully saved.'); 
        }
    }
}
