@extends('layouts.admin')

@section('content-header')
<section class="content-header">
  <h1>
    Users | All Users
    <small>Control panel</small>
  </h1>
  <ol class="breadcrumb">
    <li><a href="{{ route('admin.dashboard') }}"><i class="fa fa-dashboard"></i> Home</a></li>
    <li>Users</li>
    <li class="active">All Users</li>
  </ol>
</section>
@endsection

@section('content')
<div class="row">
    <div class="col-xs-12">
        <div class="box box-primary">
            <div class="box-header with-border">
                <h3 class="box-title">All Users</h3>
            </div>
            <div class="box-body">
                <div class="table-responsive">
                    <table class="table table-bordered table-hover" id="pageDataTable">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>CNIC</th>
                                <th>Role</th>
                                <th>Blocked</th>
                                <th>Registered On</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>
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
                    <h4 class="modal-title">Delete User</h4>
                </div>
                <div class="modal-body">
                    Are you sure? You want to delete this User.
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
@push('styles')
<link rel="stylesheet" href="{{ asset('backend/css/datatables.min.css') }}">
<style>.table{min-width:966px!important;width:100%!important;margin-bottom:14px;margin-top:5px;}
        .table-responsive {
            border: none !important;
        }  
        .no-gutters {
            margin: 0;
        }

        .no-gutters>[class*=col-] {
            padding-right: 0;
            padding-left: 0;
        }

        .edit_del {
            font-size: 1.3em
        }
        
        .actions {
            display: flex;
            justify-content: space-around
        }
</style>
@endpush

@push('scripts')
<script src="{{ asset('backend/js/datatables.min.js') }}"></script>
<script src="{{ asset('backend/js/bootstrap-notify.min.js') }}"></script>
<script type="text/javascript">
    $(function() {
        var t = $('#pageDataTable').DataTable({
            serverSide: true,
            processing: true,
            responsive: true,
            ajax: "{{ route('admin.users.datatable') }}",
            "order": [[ 0, "desc" ]],
            "pageLength": 10,
            columns: [
                { name: 'id'},
                { name: 'username'},
                { name:  'email'},
                { name:  'cnic' }, 
                { name:  'role' },
                { name:  'blocked'},
                { name: 'created_at' },
                { name: 'action', orderable: false, searchable: false },
            ]
        });

        $(document).on('click', '.clickDeleteFunction', function() {
            var action = $(this).data('action');
            var modal = $(this).data('modal');
            $('#' + modal + ' form').attr('action', action);
            $('#' + modal).modal('show');
        });
    });
</script>
@endpush