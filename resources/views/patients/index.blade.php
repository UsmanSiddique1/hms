@extends('layouts.master')
@section('content')
<div class="container-fluid">
    <div class="block-header">
        <div class="row">
            <div class="col-lg-6 col-md-6 col-sm-12">
                <h2>All Patient</h2>
                <ul class="breadcrumb">
                    <li class="breadcrumb-item"><a href="index.html"><i class="fa fa-dashboard"></i></a></li>
                    <li class="breadcrumb-item">Patient</li>
                    <li class="breadcrumb-item active">All Patient</li>
                </ul>
            </div>
            <div class="col-lg-6 col-md-6 col-sm-12">
                <div class="d-flex flex-row-reverse">
                    <div class="page_action">
                        <a href="{{ route('patients.create') }}" class="btn btn-secondary">Add Patient</a>

                    </div>
                    <div class="p-2 d-flex">

                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row clearfix">
        <div class="col-md-12">
            <div class="card patients-list">
                <div class="header">
                    <h2>Patients List</h2>

                </div>
                <div class="body">
                    <div class="table-responsive">
                        <table id="data-table" class="table table-bordered table-striped table-hover">
                            <thead>
                                <tr>
                                    <th>MR Number</th>
                                    <th>Name</th>
                                    <th>CNIC</th>
                                    <th>Age</th>
                                    <th>Number</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>

                            </tbody>
                        </table>
                    </div>

                </div>
            </div>
        </div>
    </div>

</div>

<!-- Modal -->
<div class="modal fade" id="updateModel" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="updateForm" method="POST">
                @csrf
                @method('PUT')
                <div class="modal-body">
                    <div class="form-group">
                        <label for="">Name</label>
                        <input type="text" class="form-control" name="name" id="name" placeholder="Name">
                    </div>
                    <div class="form-group">
                        <label for="">Phone</label>
                        <input type="text" class="form-control" name="phone" id="phone" disabled placeholder="phone">
                    </div>
                    <div class="form-group">
                        <label for="">Cnic</label>
                        <input type="text" class="form-control" name="cnic" id="phone" disabled placeholder="phone">
                    </div>
                    <div class="form-group">
                        <label for="">Age Years</label>
                        <input type="text" class="form-control" name="age_years" id="age_years" placeholder="Age Years">
                    </div>
                    <div class="form-group">
                        <label for="">Age Months</label>
                        <input type="text" class="form-control" name="age_months" id="age_months" placeholder="Age Months">
                    </div>
                    <div class="form-group">
                        <label for="">Age Weeks</label>
                        <input type="text" class="form-control" name="age_weeks" id="age_weeks" placeholder="Age Weeks">
                    </div>
                    <div class="form-group">
                        <label for="">Gender</label>
                        <select name="gender" id="gender" class="form-control">
                            <option value="">Select Gender</option>
                            <option value="male">Male</option>
                            <option value="female">Female</option>
                        </select>
                    </div>


                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">Save changes</button>
                </div>
            </form>
        </div>
    </div>
</div>
<div class="modal fade" id="deleteModel" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Delete Patient <strong>"<span id="patient_name"></span>"</strong> </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form id="deleteForm" method="POST" enctype="multipart/form-data">
                @csrf
                @method('DELETE')
                <div class="modal-body">
                    <strong>Alert!</strong> This Action will not be UNDO.

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-primary">DELETE NOW</button>
                </div>
            </form>
        </div>
    </div>
</div>
@push('footer-scripts')
<script>
    var table = $('#data-table').DataTable({
        processing: true,
        serverSide: true,
        ajax: {
            url: "{{ url('/patients/datatable') }}",
            method: "GET",
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            data: function(d) {

            }
        },
        columns: [{
                data: 'mr_number',
                name: 'mr_number'
            },
            {
                data: 'name',
                name: 'name'
            },
            {
                data: 'cnic',
                name: 'cnic'
            },
            {
                data: 'phone',
                name: 'phone'
            },
            {
                data: 'age',
                name: 'age'
            },
            {
                data: 'action',
                name: 'action',
                orderable: false,
                searchable: false
            },
        ]
    });
    $("#doctor").change(function() {
        $('#data-table').data('doctor_id', $(this).val());
        table.ajax.reload(null, false);
    });
    $("#patient").change(function() {
        $('#data-table').data('patient_id', $(this).val());
        table.ajax.reload(null, false);
    });
    $("#slip").change(function() {
        $('#data-table').data('slip_id', $(this).val());
        table.ajax.reload(null, false);
    });
    $("#receptionist").change(function() {
        $('#data-table').data('receptionist_id', $(this).val());
        table.ajax.reload(null, false);
    });
    $("#type").change(function() {
        $('#data-table').data('type', $(this).val());
        table.ajax.reload(null, false);
    });
    $("#from_date").change(function() {
        $('#data-table').data('from_date', $(this).val());
        table.ajax.reload(null, false);
    });
    $("#to_date").change(function() {
        $('#data-table').data('to_date', $(this).val());
        table.ajax.reload(null, false);
    });
    $('#clear-filter').click(function() {
        $('#doctor').val('').trigger('change');
        $('#patient').val('').trigger('change');
        $('#slip').val('').trigger('change');
        $('#receptionist').val('').trigger('change');
        $('#from_date').val('');
        $('#to_date').val('');
        table.ajax.reload(null, false);
    });

    $('.edit-patient').click(function() {
        console.log("delete " + $(this).data("mr_number"));
        $('.modal-title').text($(this).data("mr_number"));
        $('#name').val($(this).data("name"));
        $('#phone').val($(this).data("phone"));
        $('#gender').val($(this).data("gender"));
        $('#age_years').val($(this).data("age_years"));
        $('#age_months').val($(this).data("age_months"));
        $('#age_weeks').val($(this).data("age_weeks"));
        var patient_id = $(this).data('id');
        $('#updateForm').attr('action', "{{ url('patients') }}/" + patient_id);
        $('#updateModel').modal().show();
    });

    function editItem(itemId) {
        $.get('/patients/' + itemId, function(response) {
            $('.modal-title').text(response.mr_number);
            $('#name').val(response.name);
            $('#phone').val(response.phone);
            $('#gender').val(response.gender);
            $('#age_years').val(response.age_years);
            $('#age_months').val(response.age_months);
            $('#age_weeks').val(response.age_weeks);
            $('#updateForm').attr('action', "{{ url('patients') }}/" + itemId);
            $('#updateModel').modal().show();
        });
    }

    // Sweet Alert on delete
    function deleteItem(itemId) {
        console.log("delete: " + itemId);
        Swal.fire({
            title: 'Are you sure?',
            text: 'You will not be able to recover this item!',
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#3085d6',
            confirmButtonText: 'Yes, delete it!',
        }).then((result) => {
            if (result.isConfirmed) {
                console.log(itemId);
                $.ajax({
                    url: 'slips/' + itemId,
                    type: 'DELETE',
                    data: {
                        _token: '{{ csrf_token() }}',
                    },
                    success: function(data) {
                        table.ajax.reload(null, false);
                        Swal.fire('Success', 'Slip has been deleted successfully!', 'success')
                    },
                    error: function(xhr) {
                        Swal.fire('Error', 'Error in deleting slip !', 'success')

                    }
                });
            }
        });
    }

    $(".select2").select2();
</script>
@endpush
@endsection