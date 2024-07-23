<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use App\Models\Category;
use App\Models\CategoryAttribute;
use App\Models\Color;
use App\Models\Product;
use App\Models\ProductAttr;
use App\Models\ProductAttribute;
use App\Models\productAttrImages;
use App\Models\Size;
use App\Models\Tax;
use Illuminate\Http\Request;

use App\Traits\ApiResponse;
use App\Traits\SaveFile;
use Validator;
use DB;

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
        $cat = Category::get();
        $brand = Brand::get();
        $color = Color::get();
        $size = Size::get();
        $tax = Tax::get();

        if( $id == 0 ) {
            $data = new Product();
            $product_attr = new ProductAttr();
            $product_attr_image = new productAttrImages();
        } else {
            $validation = Validator::make(['id' => $id], [
                'id' => 'required|exists:products,id',
            ]);

            if( $validation->fails() ) {
                return redirect()->back();
            } else {
                $data = Product::where('id', $id)->with('attribute', 'productAttributes')->first();

                // dd($data);
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
        try{
            DB::beginTransaction(); 
            $validation = Validator::make( $request->all(), [
                'name' => 'required|string|max:255',
                'slug' => 'required|string|max:255',
                'image' => 'mimes:jpeg,png,jpg,gif|max:5120',
                'category_id' => 'required|exists:categories,id',
            ]);
            
            if($validation->fails()) {
                return $this->error([], $validation->errors()->first(), 400 );
            } else {
                if( $request->id ) {
                    $image = Product::find( $request->id );
                    $image_name = $this->saveImage($request->image, $image->image, 'images/products');
                } else {
                    $image_name = $this->saveImage($request->image, '', 'images/products');
                }

                $product = Product::updateOrCreate(
                    ['id' => $request->post('id') ],
                    [
                        'name' => $request->name,
                        'slug' => $request->slug,
                        'item_code' => $request->item_code,
                        'keywords' => $request->keywords,
                        'category_id' => $request->category_id,
                        'brand_id' => $request->brand_id,
                        'tax_id' => $request->tax_id,
                        'description' => $request->description,
                        'image' => $image_name
                    ]
                );  
                $productId = $product->id;

                // Product Category Attribute
                ProductAttribute::where( 'product_id', $productId )->delete();
                if( !empty($request->attribute_id) ) {
                    foreach( $request->attribute_id as $key => $val ) {
                        ProductAttribute::updateOrCreate(
                            [
                                'product_id' => $productId, 
                                'category_id' => $request->category_id, 
                                'attribute_value_id' => $val
                            ], [
                                'product_id' => $productId, 
                                'category_id' => $request->category_id, 
                                'attribute_value_id' => $val
                            ]
                        );
                    }
                }

                // Product Attribute
                if( !empty($request->sku) ) {
                    $productAttrIds = array();
                    foreach( $request->sku as $key => $val ) {

                        $productAttr = ProductAttr::updateOrCreate(
                            [
                                'id' => $request->paid[$key]
                            ], [
                                'product_id' => $productId, 
                                'color_id' => $request->color_id[$key], 
                                'size_id' => $request->size_id[$key], 
                                'sku' => $request->sku[$key], 
                                'mrp' => $request->mrp[$key], 
                                'price' => $request->price[$key], 
                                'qty' => $request->qty[$key], 
                                'len' => $request->len[$key], 
                                'breadth' => $request->breadth[$key], 
                                'height' => $request->height[$key], 
                                'weight' =>	$request->weight[$key], 
                            ]
                        );
                        $productAttrId = $productAttr->id;
                        array_push( $productAttrIds, $productAttrId);

                        // Product Attrs Images
                        $imgkey = 'attr_image_'.$key;
                        productAttrImages::where( [ 'product_id' => $productId, 'product_attr_id' => $productAttrId ] ) ->delete();
                        if( !empty($request->$imgkey) ) {
                            foreach( $request->$imgkey as $image) {
                                $image_name = $this->saveImage($image, '', 'images/productsAttr');
                                productAttrImages::create(
                                    [
                                        'product_id' => $productId, 
                                        'product_attr_id' => $productAttrId,
                                        'image' => $image_name
                                    ]
                                );
                            }
                        }
                    }

                    // remove product attribute
                    ProductAttr::where('product_id', $productId)->whereNotIn('id', $productAttrIds)->delete();
                    productAttrImages::where('product_id', $productId)->whereNotIn('product_attr_id', $productAttrIds)->delete();
                }

                DB::commit();
                return $this->success( ['reload' => false, 'product_id' => $productId], 'Successfully saved.'); 
            }

        } catch (\Throwable $th) {
            DB::rollBack();
            echo $th;
        }
    }

    public function getAttributes(Request $request) {
        $category_id = $request->category_id;
        $product_id = $request->product_id;
        $product = Product::where('id', $product_id)->with('attribute')->first();
        $data['opt'] = CategoryAttribute::where('category_id', $category_id)->with('attribute', 'values')->get();
        $data['selected'] = ($product && $product->attribute) ? $product->attribute->pluck('attribute_value_id') : '';
        return $this->success( $data, 'successfully');
        prx($data);
    }
}
