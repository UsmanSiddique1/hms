@extends('layouts.master')
@push('header-scripts')

@endpush
@section('content')
<div class="container-fluid">
    <div class="block-header">
        <div class="row">
            <div class="col-lg-6 col-md-6 col-sm-12">
                <h2>All Receptionists</h2>
                <ul class="breadcrumb">
                    <li class="breadcrumb-item"><a href="index.html"><i class="fa fa-dashboard"></i></a></li>                            
                    <li class="breadcrumb-item">Receptionist</li>
                    <li class="breadcrumb-item active">All Receptionists</li>
                </ul>
            </div>
            <div class="col-lg-6 col-md-6 col-sm-12">
                <div class="d-flex flex-row-reverse">
                    <div class="page_action">
                        <!-- Nav tabs -->
                        <a href="{{ route('receptionists.create') }}" class="btn btn-secondary">Add Receptionist</a>

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
                    <h2>Receptionists List</h2>
                   
                </div>
                <div class="body">
                    @if(Session::has('error'))
                        <div class="alert alert-danger" role="alert">
                            {{ Session::get('error') }}
                          </div>
                          @endif
                    <table class="table table-bordered table-striped table-hover dataTable js-exportable">
                        <thead>
                            <tr>                                       
                                <th>Media</th>
                                <th>Name</th>
                                <th>Phone</th>
                                <th>Shift</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($receptionists as $receptionist)
                            <tr>
                                <td><span class="list-icon"><img class="avatar" src="../assets/images/xs/avatar1.jpg" alt=""></span></td>
                                <td><span class="list-name">{{ $receptionist->user->f_name }}</span></td>
                                <td>{{ $receptionist->user->phone }}</td>
                                <td>{{ $receptionist->shift }}</td>
                                <td>
                                    <button type="button" class="btn btn-primary edit-patient"
                                        data-id="{{ $receptionist->id }}" 
                                        data-f_name="{{ $receptionist->user->f_name }}" 
                                        data-l_name="{{ $receptionist->user->l_name }}" 
                                        data-gender="{{ $receptionist->user->gender }}" 
                                        data-phone="{{ $receptionist->user->phone }}" 
                                        data-dob="{{ $receptionist->user->dob }}" 
                                        data-speciality="{{ $receptionist->speciality }}" 
                                        data-status="{{ $receptionist->status }}" 
                                        data-description="{{ $receptionist->description }}"
                                        >
                                        Update
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
                    <label for="">First Name</label>
                    <input type="text" class="form-control" name="f_name" id="f_name" placeholder="Name" required>
                </div>
                <div class="form-group">
                    <label for="">Last Name</label>
                    <input type="text" class="form-control" name="l_name" id="l_name" placeholder="Name" required>
                </div>
                <div class="form-group">
                    <label for="">Phone</label>
                    <input type="text" class="form-control" name="phone" id="phone" disabled placeholder="phone">
                </div>
                <div class="form-group">
                    <label for="">Gender</label>
                    <select name="gender" id="gender" class="form-control">
                        <option value="">Select Gender</option>
                        <option value="male">Male</option>
                        <option value="female">Female</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="">Shift</label>
                    <select name="shift" id="shift" class="form-control">
                        <option value="">- Shifts -</option>
                        <option value="morning">Morning</option>
                        <option value="evening">Evening</option>
                        <option value="night">Night</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="">Status</label>
                    <select name="status" id="status" class="form-control">
                        <option value="">- Shifts -</option>
                        <option value="closed">Close</option>
                        <option value="on">ON</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="">Description</label>
                    <textarea rows="4" name="description" class="form-control no-resize" placeholder="Please type what you want..."></textarea>
                </div>
                <div class="form-group">
                    <label for="">Password</label>
                    <input type="text" class="form-control" name="password" placeholder="Password">
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

@push('footer-scripts')
<script>
    $('.edit-patient').click(function(){
        $('.modal-title').text($(this).data("mr_number"));
        $('#f_name').val($(this).data("f_name"));
        $('#l_name').val($(this).data("l_name"));
        $('#phone').val($(this).data("phone"));
        $('#gender').val($(this).data("gender"));
        $('#description').val($(this).data("shift"));
        $('#status').val($(this).data("status"));
        var receptionist_id = $(this).data('id');
        $('#updateForm').attr('action',"{{ url('receptionists') }}/"+receptionist_id);
        $('#updateModel').modal().show();
    });
</script>
@endpush
@endsection