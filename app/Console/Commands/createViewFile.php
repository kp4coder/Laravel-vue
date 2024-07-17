<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use File;

class createViewFile extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'make:admintableview {view}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create a new view file';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $viewname = $this->argument('view');
        $viewname = $viewname.'.blade.php';
        $pathname = "resources/views/{$viewname}";

        if( File::exists($pathname) ) {
            $this->error("File {$viewname} is already exists");
            return;
        }

        $dir = dirname($pathname);
        if(!file_exists($dir)) {
            mkdir($dir, 0777, true);
        }

        $content = '@extends("admin/layout")
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
                        <li class="breadcrumb-item"><a href="{{ url(\'admin/dashboard\') }}"><i class="bx bx-home-alt"></i></a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">Home Banner</li>
                    </ol>
                </nav>
            </div>
            <div class="ms-auto">
                <div class="col">
                    <button type="button" onclick="saveData(\'\',\'\',\'\',\'\')" class="btn btn-outline-success" data-bs-toggle="modal" data-bs-target="#addModal"><i class="fadeIn animated bx bx-plus"></i>Add new</button>
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
                                <th>Text</th>
                                <th>Link</th>
                                <th>Image</th>
                                <th>Created At</th>
                                <th>Update At</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($data as $row)
                            <tr>
                                <td>{{ $row->id }}</td>
                                <td>{{ $row->text }}</td>
                                <td>{{ $row->link }}</td>
                                <td>{{ $row->image }}</td>
                                <td>{{ $row->created_at }}</td>
                                <td>{{ $row->updated_at }}</td>
                                <td>
                                    <button type="button" onclick="saveData(\'{{ $row->id }}\', \'{{ $row->text }}\', \'{{ $row->link }}\', \'{{ asset($row->image) }}\')" class="btn" data-bs-toggle="modal" data-bs-target="#addModal">
                                        <i class="fadeIn animated bx bx-edit"></i>
                                    </button>
                                    <button type="button" onclick="deleteData(\'{{ $row->id }}\', \'home_banners\' )" class="btn delete_{{ $row->id }}">
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
            <form action="{{ url(\'admin/updateHomeBanner\') }}" id="formSubmit" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="modal-header">
                    <h5 class="modal-title" id="addModalLabel">Add New</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="row mb-3">
                        <label for="Text" class="col-sm-3 col-form-label">Text</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" id="enter_text" name="text" placeholder="Enter Your Text" required>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="link" class="col-sm-3 col-form-label">Link</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" id="enter_link" name="link" placeholder="https://domain.com/" required>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="image" class="col-sm-3 col-form-label">Image</label>
                        <div class="col-sm-9">
                            <input type="file" class="form-control" id="enter_image" name="image" required>
                            <div id="showImage"> <img src="" height="100px" /></div>
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
    function saveData(id, text, link, image) {
        $("#enter_id").val(id);
        $("#enter_text").val(text);
        $("#enter_link").val(link);
        console.log("{{ URL::asset(\'images\') }}/"+image);
        if( image == \'\' ) {
            jQuery("#showImage").hide();
        } else {
            jQuery("#enter_image").removeAttr(\'required\');
            jQuery("#showImage img").attr(\'src\', image);
            jQuery("#showImage").show();
        }
    }
</script>
@endsection';

        File::put($pathname, $content);
        $this->info("File {$viewname} is created");
        // return Command::SUCCESS;
    }
}
