<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\CategoryAttribute;
use App\Models\Attribute;
use Illuminate\Http\Request;
use Validator;
use App\Traits\ApiResponse;
use App\Traits\SaveFile;
use PHPUnit\Framework\MockObject\Api;

class categoryController extends Controller
{
    use ApiResponse; 
    use SaveFile;

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Category::with('parentCategory')->get();
        return view('admin/Category/category', get_defined_vars());
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
                $image = Category::find( $request->id );
                $image_name = $this->saveImage($request->image, $image->image, 'images/category');
            } else {
                $image_name = $this->saveImage($request->image, '', 'images/category');
            }

            Category::updateOrCreate(
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



    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function indexCategoryAttribute()
    {
        $data = CategoryAttribute::with('category','attribute')->get();
        $category = Category::get();
        $attribute = Attribute::get();
        return view('admin/Category/categoryAttribute', get_defined_vars());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function storeCategoryAttribute(Request $request)
    {
        $validation = Validator::make( $request->all(), [
            'category_id' => 'required|string|max:255',
            'attribute_id' => 'required|string|max:255',
        ]);
        
        if($validation->fails()) {
            return $this->error([], $validation->errors()->first(), 400 );
        } else {

            CategoryAttribute::updateOrCreate(
                ['id' => $request->post('id') ],
                [
                    'category_id' => $request->category_id,
                    'attribute_id' => $request->attribute_id,
                ]
            );   

            return $this->success( ['reload' => true], 'Successfully saved.'); 
        }
    }
}
