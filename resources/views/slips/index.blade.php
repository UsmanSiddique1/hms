@extends('layouts.master')
@push('header-scripts')
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

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
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped table-hover dataTable js-exportable">
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
                                @foreach($slips as $key => $slip)
                                <tr>
                                    <td>{{ $slip->slip_number }}</td>
                                    <td>{{ $slip->patient->mr_number }}</td>
                                    <td>{{ $slip->patient->name }}</td>
                                    <td>{{ $slip->patient->phone }}</td>
                                    <td>{{ $slip->doctor ? $slip->doctor->user->f_name : '--' }}</td>
                                    <td><span class="badge {{ $slip->type == 'Emergency' ? 'badge-danger' : 'badge-primary' }}">{{ $slip->type }}</span></td>
                                    <td>Rs.{{ $slip->total_amount }}</td>
                                    <td>{{ $slip->created_at->format('d-M-Y') }}</td>
                                    <td>{{ $slip->created_at->format('h:i a') }}</td>
                                    <td>
                                        <a href="{{ route('slips.show', $slip->id) }}" target="_blank" class="btn btn-primary"><i class="fa fa-eye"></i></a>
                                        <a href="{{ route('slips.edit', $slip->id) }}" class="btn btn-primary edit-patient"><i class="fa fa-pencil"></i></a>
                                        
                                        <a href="javascript:void(0)" class="delete btn btn-danger" 
                                          data-id="{{ $slip->id }}"
                                          data-slip_number="{{ $slip->slip_number }}"
                                            ><i class="fa fa-trash"></i></a>
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
@push('footer-scripts')
<script>
    $('.delete').click(function(){
        var id = $(this).data('id');
        $('#slip_number').text($(this).data('slip_number'));
        $('#deleteForm').attr('action',"{{ url('slips') }}/"+id);
        $('#deleteModel').modal().show();
    });
</script>

@endpush
@endsection