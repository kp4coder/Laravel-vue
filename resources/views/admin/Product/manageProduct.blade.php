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
                <form class="row g-3">
                    <div class="col-md-6">
                        <label for="name" class="form-label">Product Name</label>
                        <input type="email" class="form-control" id="name" name="name" value="{{ $data->name }}">
                    </div>
                    <div class="col-md-6">
                        <label for="slug" class="form-label">Product Slug</label>
                        <input type="password" class="form-control" id="inputLastName" name="slug" value="{{ $data->slug }}">
                    </div>
                    <div class="col-md-6">
                        <label for="image" class="form-label">Product Image</label>
                        <input type="file" class="form-control" id="image" name="image" value="{{ $data->image }}">
                        @if( !empty($data->image) )
                        <img src="{{ asset($data->image) }}" height="100" />
                        @endif
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
                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-md-6">
                        <label for="attribute" class="form-label">Attribute </label>
                        <span class="attribute_container">
                            <select name="attribute_id" id="attribute_id" class="form-control multiSelect" multiple>
                                <option value=''>Select</option>
                            </select>
                        </span>
                    </div>

                    <div class="col-md-6">
                        <label for="brand" class="form-label">Brand</label>
                        <select name="brand_id" id="brand_id" class="form-control">
                            <option value="">Select Brand</option>
                            @foreach($brand as $brandList)
                            <option value="{{ $brandList->id }}">{{ $brandList->text }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-6">
                        <label for="inputAddress" class="form-label">Tax</label>
                        <select name="tax_id" id="tax_id" class="form-control">
                            <option value="">Select Tax</option>
                            @foreach($tax as $taxList)
                            <option value="{{ $taxList->id }}">{{ $taxList->text }}%</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-12">
                        <label for="description" class="form-label">Description</label>
                        <textarea class="form-control" id="description" name="description" placeholder="Description" rows="3"></textarea>
                    </div>
                    <div class="col-12 mb-3">
                        <label for="description" class="form-label">Attribute</label>
                        <button type="button" class="btn btn-primary px-5" id="addAttributeBtn">Add Attribute</button>
                        <div class="addAttributes">
                            <div class="col-12 mt-3 border p-3 rounded position-relative">
                                <span class="position-absolute top-0 start-0 translate-middle badge rounded-pill bg-secondary attr_count">1</span>
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
                                    <div class="col-sm-2 mb-3"><button class="form-control btn-danger" type="button">Remove Attribute</button></div>
                                    <div class="col-sm-2 mb-3"><input class="form-control" type="text" name="qty[]" id="qty" value="" placeholder="Quantity" /></div>
                                    <div class="col-sm-2 mb-3"><input class="form-control" type="text" name="len[]" id="len" value="" placeholder="length" /></div>
                                    <div class="col-sm-2 mb-3"><input class="form-control" type="text" name="breadth[]" id="breadth" value="" placeholder="Breadth" /></div>
                                    <div class="col-sm-2 mb-3"><input class="form-control" type="text" name="height[]" id="height" value="" placeholder="Height" /></div>
                                    <div class="col-sm-2 mb-3"><input class="form-control" type="text" name="weight[]" id="weight" value="" placeholder="Weight" /></div>
                                    <div class="row addImages">
                                        <div class="col-sm-2 mt-3">
                                            <input type="file" name="attr_image[]" class="form-control" id="attr_image" />
                                        </div>
                                    </div>
                                    <div class="col-12 mb-3 right">
                                        <button type="button" class="btn btn-primary px-5 addImagesBtn">Add Image</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-12">
                        <button type="submit" class="btn btn-primary px-5">Register</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!--end page wrapper -->

<script id="attribute_table" type="text/html">
    <div class="col-12 mt-3 border p-3 rounded position-relative">
        <span class="position-absolute top-0 start-0 translate-middle badge rounded-pill bg-secondary attr_count">{_attr_count_}</span>
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
            <div class="col-sm-2 mb-3"><button class="form-control btn-danger" type="button">Remove Attribute</button></div>
            <div class="col-sm-2 mb-3"><input class="form-control" type="text" name="qty[]" id="qty" value="" placeholder="Quantity" /></div>
            <div class="col-sm-2 mb-3"><input class="form-control" type="text" name="len[]" id="len" value="" placeholder="length" /></div>
            <div class="col-sm-2 mb-3"><input class="form-control" type="text" name="breadth[]" id="breadth" value="" placeholder="Breadth" /></div>
            <div class="col-sm-2 mb-3"><input class="form-control" type="text" name="height[]" id="height" value="" placeholder="Height" /></div>
            <div class="col-sm-2 mb-3"><input class="form-control" type="text" name="weight[]" id="weight" value="" placeholder="Weight" /></div>
            <div class="row addImages">
                <div class="col-sm-2 mt-3">
                    <input type="file" name="attr_image[]" class="form-control" id="attr_image" />
                </div>
            </div>
            <div class="col-12 mb-3 right">
                <button type="button" class="btn btn-primary px-5 addImagesBtn">Add Image</button>
            </div>
        </div>
    </div>
</script>

<script id="image_html" type="text/html">
    <div class="col-sm-2 mt-3">
        <input type="file" name="attr_image[]" class="form-control" id="attr_image" />
    </div>
</script>
@endsection

@section('js')
<script>
    $(document).on("click", ".addImagesBtn", function() {
        var $clone_html = jQuery("#image_html").html();
        $(this).parents('.addAttributes').find(".addImages").append($clone_html);
    });

    $(document).on("click", "#addAttributeBtn", function() {
        var $clone_html = jQuery("#attribute_table").html();
        var $clone_html_new = $clone_html.replace(/{_attr_count_}/g, 5);
        $(".addAttributes").append($clone_html);
    });

    var editor = CKEDITOR.replace('description');
    CKFinder.setupCKEditor(editor);

    $(document).on("change", "#category_id", function() {
        var category_id = $(this).val();
        $.ajax({
            url: "{{ url('admin/getAttributes') }}",
            headers: {
                'x-CSRF-TOKEN': '{{ csrf_token() }}'
            },
            data: {
                'category_id': category_id
            },
            type: 'post',
            success: function(result) {
                console.log(result);
                let HTML = '<select name="attribute_id" id="attribute_id" class="form-control multiSelect" multiple >';
                jQuery.each(result.data, function(key, val) {
                    jQuery.each(val.values, function(attrKey, attrVal) {
                        HTML += '<option value="' + attrVal.id + '">' + val.attribute.name + ' - ' + attrVal.value + '</option>';
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