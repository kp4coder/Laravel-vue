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
                        <li class="breadcrumb-item active" aria-current="page">Attribute Value</li>
                    </ol>
                </nav>
            </div>
            <div class="ms-auto">
                <div class="col">
                    <button type="button" onclick="saveData('','','')" class="btn btn-outline-success" data-bs-toggle="modal" data-bs-target="#addModal"><i class="fadeIn animated bx bx-plus"></i>Add new</button>
                </div>
                {{--
                <div class="btn-group">
                    <button type="button" class="btn btn-primary">Settings</button>
                    <button type="button" class="btn btn-primary split-bg-primary dropdown-toggle dropdown-toggle-split" data-bs-toggle="dropdown">	<span class="visually-hidden">Toggle Dropdown</span>
                    </button>
                    <div class="dropdown-menu dropdown-menu-right dropdown-menu-lg-end">	<a class="dropdown-item" href="javascript:;">Action</a>
                        <a class="dropdown-item" href="javascript:;">Another action</a>
                        <a class="dropdown-item" href="javascript:;">Something else here</a>
                        <div class="dropdown-divider"></div>	<a class="dropdown-item" href="javascript:;">Separated link</a>
                    </div>
                </div>
                --}}
            </div>
        </div>
        <!--end breadcrumb-->
        <div class="card">
            <div class="card-body">
                <div class="table-responsive">
                    <table id="example2" class="table table-striped table-bordered">
                        <thead>
                            <tr>
                                <th>Id</th>
                                <th>Attribute</th>
                                <th>Value</th>
                                <th>Created At</th>
                                <th>Update At</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($data as $row)
                            <tr>
                                <td>{{ $row->id }}</td>
                                <td>{{ $row->singleAttribute->name }}</td>
                                <td>{{ $row->value }}</td>
                                <td>{{ $row->created_at }}</td>
                                <td>{{ $row->updated_at }}</td>
                                <td>
                                    <button type="button" onclick="saveData('{{ $row->id }}', '{{ $row->attributes_id }}', '{{ $row->value }}')" class="btn" data-bs-toggle="modal" data-bs-target="#addModal">
                                        <i class="fadeIn animated bx bx-edit"></i>
                                    </button>
                                    <button type="button" onclick="deleteData('{{ $row->id }}', 'attribute_values' )" class="btn delete_{{ $row->id }}">
                                        <i class="fadeIn animated bx bx-trash"></i>
                                    </button>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<!--end page wrapper -->

<!-- Modal -->
<div class="modal fade" id="addModal" tabindex="-1" aria-labelledby="addModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <form action="{{ url('admin/updateAttributeValue') }}" id="formSubmit" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title" id="addModalLabel">Add New</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row mb-3">
                        <label for="attribute" class="col-sm-3 col-form-label">Attribute</label>
                        <div class="col-sm-9">
                            <select class="form-control" id="enter_attributes_id" name="attributes_id" required>
                                @foreach( $attribute as $row )
                                    <option value="{{ $row->id }}">{{ $row->name }}</option>
                                @endforeach
                            </select> 
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="value" class="col-sm-3 col-form-label">Value</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" id="enter_value" name="value" placeholder="Attribute Value" required>
                        </div>
                    </div>
                    <input type="hidden" name="id" id="enter_id" value="0" />
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <div id="submitButton"><input type="submit" class="btn btn-primary px-4" value="Save Changes" /></div>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    function saveData(id, attributes_id, value) {
        $("#enter_id").val(id);
        $("#enter_attributes_id").val(attributes_id);
        $("#enter_value").val(value);
    }
</script>
@endsection