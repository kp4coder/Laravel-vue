@extends("admin/layout")
@section("content")

<script src="{{ asset('assets/plugins/ckeditor4/ckeditor.js') }}"></script>
<script src="{{ asset('assets/plugins/ckfinder/ckfinder.js') }}"></script>

<!--start page wrapper -->
<div class="page-wrapper">
    <div class="page-content">
        <!--breadcrumb-->
        <div class="page-breadcrumb d-none d-sm-flex align-items-center mb-3">
            <div class="breadcrumb-title pe-3">Dashboard</div>
            <div class="ps-3">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb mb-0 p-0">
                        <li class="breadcrumb-item"><a href="{{ url('admin/dashboard') }}"><i class="bx bx-home-alt"></i></a>
                        </li>
                        <li class="breadcrumb-item"><a href="{{ url('admin/product') }}">Manage Product</a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">{{ ($data->id == 0) ? 'Add' : 'Edit' }} Product</li>
                    </ol>
                </nav>
            </div>
        </div>
        <!--end breadcrumb-->

        <div class="card border-top border-0 border-4 border-primary">
            <div class="card-body p-5">
                <div class="card-title d-flex align-items-center">
                    <div><i class="bx bxs-user me-1 font-22 text-primary"></i>
                    </div>
                    <h5 class="mb-0 text-primary">{{ ($data->id == 0) ? 'Add' : 'Edit' }} Product</h5>
                </div>
                <hr>
                <form id="formSubmit" action="{{ url('admin/updateProduct') }}" method="post" class="row g-3" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="id" id="productId" value="{{ ($data->id == 0) ? '' : $data->id }}" />
                    <div class="col-md-6">
                        <label for="name" class="form-label">Product Name</label>
                        <input type="text" class="form-control" id="name" name="name" value="{{ $data->name }}">
                    </div>
                    <div class="col-md-6">
                        <label for="slug" class="form-label">Product Slug</label>
                        <input type="text" class="form-control" id="inputLastName" name="slug" value="{{ $data->slug }}">
                    </div>
                    <div class="col-md-6">
                        <label for="item_code" class="form-label">Item Code</label>
                        <input type="text" class="form-control" id="item_code" name="item_code" value="{{ $data->item_code }}">
                    </div>
                    <div class="col-md-6">
                        <label for="keywords" class="form-label">Keywords</label>
                        <input type="text" class="form-control" id="keywords" name="keywords" value="{{ $data->keywords }}">
                    </div>
                    <div class="col-md-6">
                        <label for="inputAddress" class="form-label">Category</label>
                        <select name="category_id" id="category_id" class="form-control">
                            <option value="">Select Category</option>
                            @foreach($cat as $category)
                            <option value="{{ $category->id }}" {{ ( $category->id == $data->category_id ) ? 'selected' : '' }}>{{ $category->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-md-6">
                        <label for="attribute" class="form-label">Attribute </label>
                        <span class="attribute_container">
                            <select name="attribute_id[]" id="attribute_id" class="form-control multiSelect" multiple>
                                @if( isset($data['attribute'][0]->id) )
                                    @foreach( $data->attribute as $attributeList)
                                        <option selected value='{{ $attributeList->attribute_values[0]->id }}'>{{ $attributeList->attribute_values[0]->singleAttribute->name }} - {{ $attributeList->attribute_values[0]->value }}</option>
                                    @endforeach
                                @else
                                    <option value=''>Select</option>
                                @endif
                            </select>
                        </span>
                    </div>

                    <div class="col-md-6">
                        <label for="brand" class="form-label">Brand</label>
                        <select name="brand_id" id="brand_id" class="form-control">
                            <option value="">Select Brand</option>
                            @foreach($brand as $brandList)
                            <option value="{{ $brandList->id }}" {{ ( $brandList->id == $data->brand_id ) ? 'selected' : '' }}>{{ $brandList->text }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-md-6">
                        <label for="image" class="form-label">Product Image</label>
                        <input type="file" class="form-control" id="image" name="image" value="{{ $data->image }}">
                    </div>

                    <div class="col-md-6">
                        <label for="inputAddress" class="form-label">Tax</label>
                        <select name="tax_id" id="tax_id" class="form-control">
                            <option value="">Select Tax</option>
                            @foreach($tax as $taxList)
                            <option value="{{ $taxList->id }}" {{ ( $taxList->id == $data->tax_id ) ? 'selected' : '' }}>{{ $taxList->text }}%</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-md-6">
                        @if( !empty($data->image) )
                        <img src="{{ asset($data->image) }}" height="100" />
                        @endif
                    </div>

                    <div class="col-12">
                        <label for="description" class="form-label">Description</label>
                        <textarea class="form-control" id="description" name="description" placeholder="Description" rows="3">{{ $data->description }}</textarea>
                    </div>
                    <div class="col-12 mb-3">
                        @php $count = 0; @endphp
                        <label for="description" class="form-label">Attribute</label>
                        <button type="button" class="btn btn-primary px-5" id="addAttributeBtn">Add Attribute</button>
                        <div class="addAttributes">
                            @foreach( $data->productAttributes as $productAttr ) 
                            @php $count++; @endphp
                            <div class="col-12 mt-3 border p-3 rounded position-relative attributeBox">
                                <span class="position-absolute top-0 start-0 translate-middle badge rounded-pill bg-secondary attr_count">{{$count}}</span>
                                <input type="hidden" name="paid[]" value="{{ $productAttr->id }}" />
                                <div class="row">
                                    <div class="col-sm-2 mb-2">
                                        <select name="color_id[]" class="form-control">
                                            @foreach($color as $row)
                                            <option value="{{ $row->id }}" {{ ($productAttr->color_id == $row->id) ? 'selected' : '' }}>{{ $row->text }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-sm-2 mb-2">
                                        <select name="size_id[]" class="form-control">
                                            @foreach($size as $row)
                                            <option value="{{ $row->id }}" {{ ($productAttr->size_id == $row->id) ? 'selected' : '' }}>{{ $row->text }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="col-sm-2 mb-3"><input class="form-control" type="text" name="sku[]" id="sku" value="{{ $productAttr->sku }}" placeholder="SKU" /></div>
                                    <div class="col-sm-2 mb-3"><input class="form-control" type="text" name="mrp[]" id="mrp" value="{{ $productAttr->mrp }}" placeholder="MRP" /></div>
                                    <div class="col-sm-2 mb-3"><input class="form-control" type="text" name="price[]" id="price" value="{{ $productAttr->price }}" placeholder="Price" /></div>
                                    <div class="col-sm-2 mb-3"><button class="form-control btn-danger removeAttr" type="button">Remove Attribute</button></div>
                                    <div class="col-sm-2 mb-3"><input class="form-control" type="text" name="qty[]" id="qty" value="{{ $productAttr->qty }}" placeholder="Quantity" /></div>
                                    <div class="col-sm-2 mb-3"><input class="form-control" type="text" name="len[]" id="len" value="{{ $productAttr->len }}" placeholder="length" /></div>
                                    <div class="col-sm-2 mb-3"><input class="form-control" type="text" name="breadth[]" id="breadth" value="{{ $productAttr->breadth }}" placeholder="Breadth" /></div>
                                    <div class="col-sm-2 mb-3"><input class="form-control" type="text" name="height[]" id="height" value="{{ $productAttr->height }}" placeholder="Height" /></div>
                                    <div class="col-sm-2 mb-3"><input class="form-control" type="text" name="weight[]" id="weight" value="{{ $productAttr->weight }}" placeholder="Weight" /></div>
                                    <div class="col-sm-2 mb-3"><button type="button" class="btn btn-primary px-5 addImagesBtn">Add Image</button></div>
                                    <div class="row addImages">
                                        @php $countImg = 0; @endphp
                                        @foreach( $productAttr->images as $image )
                                        @php $countImg++; @endphp
                                        <div class="col-sm-2 mt-3">
                                            <input type="file" name="attr_image_0[]" class="form-control" id="attr_image" />
                                            <img src="{{ asset($image->image) }}" width="100%" class="mt-3"/>
                                            @if( $countImg > 1 ) <button class="removeImage form-control btn-danger" type="button" onclick="deleteData('{{ $image->id }}', 'product_attr_images' )" >Remove</button> @endif
                                        </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>

                    <div class="col-12">
                        <button type="submit" class="btn btn-primary px-5">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<input type="hidden" id="auto_increment" value="{{ $count }}" />
<!--end page wrapper -->

<script id="attribute_table" type="text/html">
    <div class="col-12 mt-3 border p-3 rounded position-relative attributeBox">
        <span class="position-absolute top-0 start-0 translate-middle badge rounded-pill bg-secondary attr_count">{_attr_count_}</span>
        <input type="hidden" name="paid[]" value="0" />
        <div class="row">
            <div class="col-sm-2 mb-2">
                <select name="color_id[]" class="form-control">
                    @foreach($color as $row)
                    <option value="{{ $row->id }}">{{ $row->text }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-sm-2 mb-2">
                <select name="size_id[]" class="form-control">
                    @foreach($size as $row)
                    <option value="{{ $row->id }}">{{ $row->text }}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-sm-2 mb-3"><input class="form-control" type="text" name="sku[]" id="sku" value="" placeholder="SKU" /></div>
            <div class="col-sm-2 mb-3"><input class="form-control" type="text" name="mrp[]" id="mrp" value="" placeholder="MRP" /></div>
            <div class="col-sm-2 mb-3"><input class="form-control" type="text" name="price[]" id="price" value="" placeholder="Price" /></div>
            <div class="col-sm-2 mb-3"><button class="form-control btn-danger removeAttr" type="button">Remove Attribute</button></div>
            <div class="col-sm-2 mb-3"><input class="form-control" type="text" name="qty[]" id="qty" value="" placeholder="Quantity" /></div>
            <div class="col-sm-2 mb-3"><input class="form-control" type="text" name="len[]" id="len" value="" placeholder="length" /></div>
            <div class="col-sm-2 mb-3"><input class="form-control" type="text" name="breadth[]" id="breadth" value="" placeholder="Breadth" /></div>
            <div class="col-sm-2 mb-3"><input class="form-control" type="text" name="height[]" id="height" value="" placeholder="Height" /></div>
            <div class="col-sm-2 mb-3"><input class="form-control" type="text" name="weight[]" id="weight" value="" placeholder="Weight" /></div>
            <div class="col-sm-2 mb-3"><button type="button" class="btn btn-primary px-5 addImagesBtn">Add Image</button></div>
            <div class="row addImages">

                <div class="col-sm-2 mt-3">
                    <input type="file" name="attr_image_{_attr_image_}[]" class="form-control" id="attr_image" />
                </div>
            </div>
        </div>
    </div>
</script>

<script id="image_html" type="text/html">
    <div class="col-sm-2 mt-3">
        <input type="file" name="attr_image_{_attr_image_}[]" class="form-control" id="attr_image" />
    </div>
</script>
@endsection

@section('js')
<script>
    $(document).ready( function() {
        var editor = CKEDITOR.replace('description');
        CKFinder.setupCKEditor(editor);

        $("#category_id").trigger('change');
    });

    $(document).on("click", ".addImagesBtn", function() {
        var count = parseInt( $(this).parents('.attributeBox').find(".attr_count").text() ) - 1;
        var $clone_html = jQuery("#image_html").html();
        var $clone_html = $clone_html.replace(/{_attr_image_}/g, count);
        $(this).parents('.attributeBox').find(".addImages").append($clone_html);
    });

    $(document).on("click", "#addAttributeBtn", function() {
        var pre_squ = jQuery("#auto_increment").val();
        var boxCount = parseInt(pre_squ) + parseInt(1);
        jQuery("#auto_increment").val(boxCount);
        var $clone_html = jQuery("#attribute_table").html();
        var $clone_html = $clone_html.replace(/{_attr_image_}/g, parseInt(pre_squ) );
        var $clone_html = $clone_html.replace(/{_attr_count_}/g, boxCount);
        $(".addAttributes").append($clone_html);
    });

    $(document).on("click", ".removeAttr", function() {
        jQuery(this).parents(".attributeBox").remove();
    });

    $(document).on("click", ".removeImage", function() {
        jQuery(this).parent().remove();
    }); 

    $(document).on("change", "#category_id", function() {
        var category_id = $(this).val();
        var product_id = $("#productId").val();
        $.ajax({
            url: "{{ url('admin/getAttributes') }}",
            headers: {
                'x-CSRF-TOKEN': '{{ csrf_token() }}'
            },
            data: {
                'category_id': category_id,
                'product_id' : product_id
            },
            type: 'post',
            success: function(result) {
                let HTML = '<select name="attribute_id[]" id="attribute_id" class="form-control multiSelect" multiple >';
                jQuery.each(result.data.opt, function(key, val) {
                    jQuery.each(val.values, function(attrKey, attrVal) {
                        if (result.data.selected.includes(attrVal.id)) { 
                            HTML += '<option value="' + attrVal.id + '" selected>' + val.attribute.name + ' - ' + attrVal.value + '</option>';
                        } else {
                            HTML += '<option value="' + attrVal.id + '">' + val.attribute.name + ' - ' + attrVal.value + '</option>';
                        }
                    });
                });
                HTML += '</select>';
                $(".attribute_container").html(HTML);
                $('#attribute_id').multiSelect();
            },
            error: function(result) {
                SnackBar({
                    status: result.status,
                    message: result.message,
                    position: "br"
                });
                $("#submitButton").html(btn);
            }
        });
    });
</script>

@endsection