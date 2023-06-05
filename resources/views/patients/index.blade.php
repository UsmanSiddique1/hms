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
                        <table class="table table-bordered table-striped table-hover dataTable js-exportable">
                            <thead>
                                <tr>                                       
                                    <th>Media</th>
                                    <th>MR Number</th>
                                    <th>Name</th>
                                    <th>CNIC</th>
                                    <th>Age</th>
                                    <th>Number</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($patients as $patient)
                                <tr>
                                    <td><span class="list-icon"><img class="avatar" src="../assets/images/xs/avatar1.jpg" alt=""></span></td>
                                    <td><span class="list-name">{{ $patient->mr_number }}</span></td>
                                    <td>{{ $patient->name }}</td>
                                    <td>{{ $patient->cnic }}</td>
                                    <td>{{ $patient->age_years }}y , {{ $patient->age_months }}m, {{ $patient->age_weeks }}w</td>
                                    <td>{{ $patient->phone }}</td>
                                    <td>
                                        <button type="button" class="btn btn-primary edit-patient"
                                        data-id="{{ $patient->id }}" 
                                        data-mr_number="{{ $patient->mr_number }}" 
                                        data-name="{{ $patient->name }}" 
                                        data-age_years="{{ $patient->age_years }}" 
                                        data-age_months="{{ $patient->age_months }}" 
                                        data-age_weeks="{{ $patient->age_weeks }}" 
                                        data-gender="{{ $patient->gender }}" 
                                        data-phone="{{ $patient->phone }}" 
                                        >
                                        <i class="fa fa-pencil"></i>
                                          </button>
                                          <a href="javascript:void(0)" class="delete btn btn-danger" 
                                          data-id="{{ $patient->id }}"
                                          data-name="{{ $patient->name }}"
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
                    <input type="text" class="form-control" name="age_years" id="age_years" placeholder="Name">
                </div>
                <div class="form-group">
                    <label for="">Age Months</label>
                    <input type="text" class="form-control" name="age_months" id="age_months" placeholder="Name">
                </div>
                <div class="form-group">
                    <label for="">Age Weeks</label>
                    <input type="text" class="form-control" name="age_weeks" id="age_weeks" placeholder="Name">
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
    $('.edit-patient').click(function(){
        $('.modal-title').text($(this).data("mr_number"));
        $('#name').val($(this).data("name"));
        $('#phone').val($(this).data("phone"));
        $('#gender').val($(this).data("gender"));
        $('#age_years').val($(this).data("age_years"));
        $('#age_months').val($(this).data("age_months"));
        $('#age_weeks').val($(this).data("age_weeks"));
        var patient_id = $(this).data('id');
        $('#updateForm').attr('action',"{{ url('patients') }}/"+patient_id);
        $('#updateModel').modal().show();
    });

    $('.delete').click(function(){
        var id = $(this).data('id');
        var name = $(this).data('name');
        $('#patient_name').text(name);
        $('#deleteForm').attr('action',"{{ url('patients') }}/"+id);
        $('#deleteModel').modal().show();
    });
</script>
@endpush
@endsection