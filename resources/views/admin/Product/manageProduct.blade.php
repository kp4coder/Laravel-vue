@extends("admin/layout")
@section("content")

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
                        <select name="category_id" id="category_id" class="form-control" >
                            <option value="">Select Category</option>
                            @foreach($cat as $category) 
                                <option value="{{ $category->id }}">{{ $category->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-6">
                        <label for="brand" class="form-label">Brand</label>
                        <select name="brand_id" id="brand_id" class="form-control" >
                            <option value="">Select Brand</option>
                            @foreach($brand as $brandList) 
                                <option value="{{ $brandList->id }}">{{ $brandList->text }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-6">
                        <label for="inputAddress" class="form-label">Tax</label>
                        <select name="tax_id" id="tax_id" class="form-control" >
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
                    <div class="col-12">
                        <button type="submit" class="btn btn-primary px-5">Register</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!--end page wrapper -->
@endsection

@section('js')
<script>
$(document).on("change", "#category_id", function() {
    var category_id = $(this).val();
    console.log(category_id)
    $.ajax({
        url:"{{ url('admin/getAttributes') }}",
        headers: {
            'x-CSRF-TOKEN': '{{ csrf_token() }}'
        },
        data: {
            'category_id': category_id
        },
        type: 'post',
        success: function(result) {

        }
    });
});
</script>

@endsection