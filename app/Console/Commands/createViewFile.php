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
                        <li class="breadcrumb-item"><a href="{{ url("admin/dashboard") }}"><i class="bx bx-home-alt"></i></a>
                        </li>
                        <li class="breadcrumb-item active" aria-current="page">'. $viewname .'</li>
                    </ol>
                </nav>
            </div>
            <div class="ms-auto">
                <div class="col">
                    <button type="button" class="btn btn-outline-success "><i class="fadeIn animated bx bx-plus|"></i>Add new</button>
                </div>
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
@endsection';

        File::put($pathname, $content);
        $this->info("File {$viewname} is created");
        // return Command::SUCCESS;
    }
}
