@extends('layouts.master')
@push('header-scripts')
{{-- <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script> --}}

@endpush
@section('content')
<div class="container-fluid">
    <div class="block-header">
        <div class="row">
            <div class="col-lg-6 col-md-6 col-sm-12">
                <h2>All Slips</h2>
                <ul class="breadcrumb">
                    <li class="breadcrumb-item"><a href="index.html"><i class="fa fa-dashboard"></i></a></li>                            
                    <li class="breadcrumb-item">Slip</li>
                    <li class="breadcrumb-item active">All Slips</li>
                </ul>
            </div>
            <div class="col-lg-6 col-md-6 col-sm-12">
                <div class="d-flex flex-row-reverse">
                    <div class="page_action">
                        <!-- Nav tabs -->
                      
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
                    <h2>Slips List</h2>
                    <ul class="header-dropdown">
                    </ul>
                </div>
                <div class="body">
                    <div class="row">
                        @include('slips.includes.filters')
                    </div>
                    <div class="table-responsive">
                        <table id="data-table" class="table table-bordered table-striped table-hover">
                            <thead>
                                <tr>                                       
                                    <th>Slip No</th>
                                    <th>MR Number</th>
                                    <th>Patient Name</th>
                                    <th>Patient Phone</th>
                                    <th>Doctor Name</th>
                                    <th>Slip Type</th>
                                    <th>Amount</th>
                                    <th>Date</th>
                                    <th>Time</th>
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
<div class="modal fade" id="deleteModel" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Delete Slip <strong>"<span id="slip_number"></span>"</strong> </h5>
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
@endsection

@push('footer-scripts')
<script>
  
  var table = $('#data-table').DataTable({
      processing: true,
      serverSide: true,
      ajax: {
              url: "{{ route('slips.index') }}",
              method: "GET",
              headers: {
                  'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
              },
              data: function(d) {
                  d.doctor_id = $('#data-table').data('doctor_id');
                  d.patient_id = $('#data-table').data('patient_id');
                  d.receptionist_id = $('#data-table').data('receptionist_id');
                  d.slip_id = $('#data-table').data('slip_id');
                  d.from_date = $('#data-table').data('from_date');
                  d.to_date = $('#data-table').data('to_date');
                  d.type = $('#data-table').data('type');
              }
            },
      columns: [
          {data: 'slip_number', name: 'slip_number'},
          {data: 'patient.mr_number', name: 'patient.mr_number'},
          {data: 'patient.name', name: 'patient.name'},
          {data: 'patient.phone', name: 'patient.phone'},
          {data: 'doctor', name: 'doctor'},
          {data: 'type', name: 'type'},
          {data: 'total_amount', name: 'total_amount'},
          {data: 'date', name: 'date'},
          {data: 'time', name: 'time'},
          {data: 'action', name: 'action', orderable: false, searchable: false},
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
  $('#clear-filter').click(function(){
      $('#doctor').val('').trigger('change');
      $('#patient').val('').trigger('change');
      $('#slip').val('').trigger('change');
      $('#receptionist').val('').trigger('change');
      $('#from_date').val('');
      $('#to_date').val('');
      table.ajax.reload(null, false);
  });     

  // Sweet Alert on delete
  function deleteItem(itemId) {
    console.log("delete: "+itemId);
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
                success: function (data) {
                    table.ajax.reload(null, false);
                    Swal.fire('Success', 'Slip has been deleted successfully!', 'success')
                },
                error: function (xhr) {
                    Swal.fire('Error', 'Error in deleting slip !', 'success')
                    
                }
            });
        }
    });
  }
  
  $(".select2").select2();
</script>
@endpush