@extends('layouts.master')
@section('content')
<div class="container-fluid">
    <div class="block-header">
        <div class="row">
            <div class="col-lg-6 col-md-6 col-sm-12">
                <h2>All Doctors</h2>
                <ul class="breadcrumb">
                    <li class="breadcrumb-item"><a href="index.html"><i class="fa fa-dashboard"></i></a></li>                            
                    <li class="breadcrumb-item">Doctors</li>
                    <li class="breadcrumb-item active">All Doctors</li>
                </ul>
            </div>
            <div class="col-lg-6 col-md-6 col-sm-12">
                <div class="d-flex flex-row-reverse">
                    <div class="page_action">
                        <a href="{{ route('doctors.create') }}" class="btn btn-secondary">Add Doctor</a>
                        
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
                    <h2>Doctors List</h2>                    
                </div>
                <div class="body">
                    @if(Session::has('error'))
                        <div class="alert alert-danger" role="alert">
                            {{ Session::get('error') }}
                          </div>
                          @endif
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped table-hover dataTable js-exportable">
                            <thead>
                                <tr>                                       
                                    <th>Media</th>
                                    <th>Name</th>
                                    <th>Specialization</th>
                                    <th>Price</th>
                                    <th>Department</th>                                    
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($doctors as $doctor)
                                <tr>
                                    <td><span class="list-icon"><img class="avatar" src="../assets/images/xs/avatar1.jpg" alt=""></span></td>
                                    <td><span class="list-name">{{ $doctor->user->f_name }}</span></td>
                                    <td>{{ $doctor->speciality }}</td>
                                    <td>Rs. {{ $doctor->price ? $doctor->price : '0' }}</td>
                                    <td>{{ $doctor->department ? $doctor->department->name : '--' }}</td>
                                    <td>
                                        <button type="button" class="btn btn-primary edit-patient"
                                            data-id="{{ $doctor->id }}" 
                                            data-f_name="{{ $doctor->user->f_name }}" 
                                            data-l_name="{{ $doctor->user->l_name }}" 
                                            data-gender="{{ $doctor->user->gender }}" 
                                            data-phone="{{ $doctor->user->phone }}" 
                                            data-dob="{{ $doctor->user->dob }}" 
                                            data-department_id="{{ $doctor->department_id }}" 
                                            data-speciality="{{ $doctor->speciality }}"
                                            data-price="{{ $doctor->price }}"
                                            data-description="{{ $doctor->description }}"
                                            >
                                            <i class="fa fa-pencil"></i>
                                          </button>
                                          <a href="javascript:void(0)" class="delete btn btn-danger" 
                                          data-id="{{ $doctor->id }}"
                                          data-name="{{ $doctor->user->full_name }}"
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
<!-- Modal -->
<div class="modal fade" id="updateModel" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Update Doctor</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form id="updateForm" method="POST" enctype="multipart/form-data">
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
                    <label for="">Department</label>
                    <select name="department_id" id="department_id" class="form-control">
                        <option value="">Select Department</option>
                        @foreach($departments as $department)
                            <option value="{{ $department->id }}">{{ $department->name }}</option>
                        @endforeach
                    </select>
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
                    <label for="">Specialities</label>
                    <input type="text" class="form-control" name="speciality" id="speciality" placeholder="Password">
                </div>
                <div class="form-group">
                    <label for="">Price</label>
                    <input type="text" class="form-control" name="price" id="price" placeholder="Price">
                </div>
                <div class="form-group">
                    <label for="">Image</label>
                    <input type="file" class="form-control" name="image">
                </div>
                <div class="form-group">
                    <label for="">Description</label>
                    <textarea rows="4" id="description" name="description" class="form-control no-resize" placeholder="Please type what you want..."></textarea>
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
          <h5 class="modal-title" id="exampleModalLabel">Delete Doctor <strong>"<span id="doctor_name"></span>"</strong> </h5>
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
    $('.edit-patient').click(function(){
        $('.modal-title').text($(this).data("mr_number"));
        $('#f_name').val($(this).data("f_name"));
        $('#l_name').val($(this).data("l_name"));
        $('#phone').val($(this).data("phone"));
        $('#gender').val($(this).data("gender"));
        $('#speciality').val($(this).data("speciality"));
        $('#price').val($(this).data("price"));
        $('#department_id').val($(this).data("department_id"));
        $('#description').val($(this).data("description"));
        var doctor_id = $(this).data('id');
        $('#updateForm').attr('action',"{{ url('doctors') }}/"+doctor_id);
        $('#updateModel').modal().show();
    });

    $('.delete').click(function(){
        var id = $(this).data('id');
        var name = $(this).data('name');
        $('#doctor_name').text(name);
        $('#deleteForm').attr('action',"{{ url('doctors') }}/"+id);
        $('#deleteModel').modal().show();
    });

</script>
@endpush
@endsection