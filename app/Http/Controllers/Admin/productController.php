<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use App\Models\Category;
use App\Models\CategoryAttribute;
use App\Models\Color;
use App\Models\Product;
use App\Models\ProductAttr;
use App\Models\productAttrImages;
use App\Models\Size;
use App\Models\Tax;
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

    public function viewProduct( $id=0 ) {
        if( $id == 0 ) {
            $data = new Product();
            $product_attr = new ProductAttr();
            $product_attr_image = new productAttrImages();

            $cat = Category::get();
            $brand = Brand::get();
            $color = Color::get();
            $size = Size::get();
            $tax = Tax::get();
        } else {
            $validation = Validator::make(['id' => $id], [
                'id' => 'required|exists:products,id',
            ]);

            if( $validation->fails() ) {
                return redirect()->back();
            } else {
                $data = Product::where('id', $id)->first();
            }
        }

        return view('admin/Product/manageProduct', get_defined_vars());
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

    public function getAttributes(Request $request) {
        $category_id = $request->category_id;
        $data = CategoryAttribute::where('category_id', $category_id)->with('attribute', 'values')->get();

        return $this->success( $data, 'successfully');
        prx($data);
    }
}
