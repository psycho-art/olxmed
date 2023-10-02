@extends('layouts.admin')

@section('content-header')
<section class="content-header">
  <h1>
    Files | Your Files
    <small>Control panel</small>
  </h1>
  <ol class="breadcrumb">
    <li><a href="{{ route('admin.dashboard') }}"><i class="fa fa-dashboard"></i> Home</a></li>
    <li>Files</li>
    <li class="active">Your Uploads</li>
  </ol>
</section>
@endsection

@inject('uploadController', 'App\Http\Controllers\Backend\Admin\UploadFilesController')

@section('content')
<div class="col-12">
    <div class="box box-primary">
        <div class="box-header with-border">
            <h3 class="box-title">Your Uploads</h3>
        </div>
        <div class="box-body">
            <div class="table-responsive">  
                <table class="table table-bordered">
                    <thead>
                    <tr>
                        <th>#</th>
                        <th>Title</th>
                        <th>Uploaded For</th>
                        <th>Category</th>
                        <th>File Name</th>
                        <th style="text-align: center" >File</th>
                        <th>Download File</th>
                        <th>Uploaded On</th>
                        <th>Options</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php $i = 1; ?>
                    @foreach ($uploads as $upload)
                    <tr>
                        <td><?php echo $i; ?></td>
                        <td>{{ $upload->title }}</td>
                        <?php $name = \App\User::where('id', $upload->uploaded_for)->pluck('username')->first(); ?>
                        <td> {{ $name }} </td>
                        <td>{{ $uploadController::getCatName($upload->cat_id) }}</td>
                        <td> {{ $upload->image_name }} </td>
                        <td style="text-align: center" >
                            <div>
                                <a href="{{ asset('storage/'.$upload->image_name) }}" target="_blank">
                                    <i class="fa fa-file-pdf-o" aria-hidden="true" style="font-size: 26px"></i>
                                </a>
                            </div>
                        </td>
                        <td style="text-align: center; font-size: 20px;"><a href="{{ asset('storage/'.$upload->image_name) }}" download ><i class="fa fa-download" aria-hidden="true"></i></a></td>
                        <td>{{ date('d M Y', strtotime($upload->created_at))}}</td>
                        <td style="text-align: center; vertical-align: middle;"> <a class="clickDeleteFunction" style="cursor: pointer;" data-modal="deleteEventModal" data-action="{{ route('admin.deleteUploadFiles', ['id' => $upload->id]) }}"><span class="glyphicon glyphicon-trash"></span></a></td>
                    </tr>

                    <?php $i++; ?>
                    @endforeach
                    </tbody>
                </table>
            </div>
            {{ $uploads->links() }}
        </div>
    </div>  
</div> 
<div id="deleteEventModal" class="modal modal-danger fade" role="dialog">
    <div class="modal-dialog modal-sm">
        <form name="deleteDoctorForm" action="" method="POST">
            @csrf
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Delete Upload</h4>
                </div>
                <div class="modal-body">
                    Are you sure? You want to delete this Upload.
                </div>
                <div class="modal-footer">
                    <input class="btn btn-outline pull-left" type="button" value="Cancel" data-dismiss="modal">
                    <input class="btn btn-outline" type="submit" value="Confirm">
                </div>
            </div>
        </form>
    </div>
</div>

@endsection

@push('scripts')
    <script>
        $(document).on('click', '.clickDeleteFunction', function() {
            var action = $(this).data('action');
            var modal = $(this).data('modal');
            $('#' + modal + ' form').attr('action', action);
            $('#' + modal).modal('show');
        });
    </script>
@endpush


