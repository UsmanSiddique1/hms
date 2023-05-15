@extends('layouts.master')
@section('content')
<div class="container-fluid">
    <div class="block-header">
        <div class="row">
            <div class="col-lg-6 col-md-6 col-sm-12">
                <h2>Add Slip</h2>
                <ul class="breadcrumb">
                    <li class="breadcrumb-item"><a href="index.html"><i class="fa fa-dashboard"></i></a></li>                            
                    <li class="breadcrumb-item">Slip</li>
                    <li class="breadcrumb-item active">Add new</li>
                </ul>
            </div>
            <div class="col-lg-6 col-md-6 col-sm-12">
                <div class="d-flex flex-row-reverse">
                    <div class="page_action">
                        {{-- <button type="button" class="btn btn-primary"><i class="fa fa-download"></i> Download report</button>
                        <button type="button" class="btn btn-secondary" data-toggle="modal" data-target="#addevent">Add New Event</button> --}}
                    </div>
                    <div class="p-2 d-flex">
                        
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row clearfix">
        <div class="col-lg-12 col-md-12 col-sm-12">
            <div class="card">
                <div class="header">
                    <h2>Basic Information <small>Description text here...</small> </h2>                            
                </div>
                <form action="{{ route('slips.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="body">
                        <div class="row clearfix">
                            <div class="col-sm-4" id="type_div">
                                <div class="form-group">
                                    <select name="type" class="form-control show-tick" id="type">
                                        <option value="">Type</option>
                                        <option value="emergency">Emergency</option>
                                        <option value="ipd">IPD</option>
                                        <option value="opd">OPD</option>
                                    </select>
                                </div>
                            </div> 
                            <div class="col-sm-4" id="select_patient_div">
                                <div class="form-group">
                                    <select class="form-control show-tick" id="select_patient">
                                        <option value="">Select Patient</option>
                                        <option value="existing">Existing</option>
                                        <option value="new">New</option>
                                    </select>
                                </div>
                            </div>  
                            <div class="col-sm-4" id="mr_number_div">
                                <div class="form-group">
                                    <input type="text" class="form-control" name="mr_number" data-new_mr="{{ $new_mr }}" id="mr_number" placeholder="MR#">
                                </div>
                            </div>
                            <div class="col-sm-4 patient_details" id="name_div">
                                <div class="form-group">
                                    <input type="text" class="form-control" id="patient_name" name="name" placeholder="Patient Name">
                                </div>
                            </div>
                            <div class="col-sm-4 patient_details" id="age_div">
                                <div class="form-group">
                                    <input type="number" class="form-control" id="patient_name" name="age" placeholder="Patient Age">
                                </div>
                            </div> 
                            <div class="col-sm-3" id="gender_div">
                                <div class="form-group">
                                    <select class="form-control show-tick" name="gender">
                                        <option value="">- Gender -</option>
                                        <option value="male">Male</option>
                                        <option value="female">Female</option>
                                    </select>
                                </div>
                            </div>
                            
                            <div class="col-sm-3" id="phone_div">
                                <div class="form-group">
                                    <input type="text" class="form-control" name="phone" placeholder="Phone">
                                </div>
                            </div>
                            
                            <div class="col-sm-6" id="image_div">
                                <div class="form-group">
                                    <input type="file" name="image" class="dropify">
                                </div>
                            </div> 
                            <div class="col-sm-4" id="doctor_div">
                                <div class="form-group">
                                    <select name="doctor" class="form-control show-tick" id="doctor">
                                        <option value="">Doctor</option>
                                        @foreach($doctors as $doctor)
                                            <option value="{{ $doctor->id }}">{{ $doctor->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div> 
                            <div class="col-sm-4" id="procedure_div">
                                <div class="form-group">
                                    <select name="procedure[]" class="form-control show-tick" id="procedure" multiple>
                                        <option value="" readonly>Select Procedure</option>
                                        @foreach($procedures as $procedure)
                                            <option value="{{ $procedure->id }}">{{ $procedure->name }} (Rs.{{ $procedure->price }})</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>  
                            <div class="col-sm-4" id="bed_div">
                                <div class="form-group">
                                    <select name="bed" class="form-control show-tick" id="bed">
                                        <option value="">Select Bed</option>
                                        @foreach($beds as $bed)
                                            <option value="{{ $bed->id }}">{{ $bed->number }} (Rs.{{ $procedure->price }})</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>                     
                        </div>
                        <div class="row clearfix">                            
                            
                            <div class="col-sm-12">
                                <div class="form-group mt-3">
                                    <textarea rows="4" name="description" class="form-control no-resize" placeholder="Please type what you want..."></textarea>
                                </div>
                            </div>
                            <div class="col-sm-3">
                                <div class="form-group">
                                    <input readonly class="form-control" name="total_amount" id="total_amount" placeholder="Total">
                                </div>
                            </div>
                            <div class="col-sm-12">
                                <button type="submit" class="btn btn-primary">Submit</button>
                                <button type="submit" class="btn btn-outline-secondary">Cancel</button>
                            </div>
                        </div>
                    </div>
                </form>                
            </div>
        </div>
    </div>
   

</div>

@push('footer-scripts')

<script>
$('#doctor_div, #procedure_div, #bed_div, #gender_div, #image_div, #age_div').addClass('d-none');
$('#total_amount').val(0);
$('#type').change(function(){
    var type = $(this).val();
    if(type == 'emergency')
    {
        $('#total_amount').val(300);
        $('#doctor_div, #procedure_div, #bed_div').addClass('d-none');
    }
    if(type == 'opd')
    {
        $('#total_amount').val(0);
        $('#doctor_div, #procedure_div').removeClass('d-none');
        $('#bed_div').addClass('d-none');

    }
    if(type == 'ipd')
    {
        $('#total_amount').val(0);
        $('#doctor_div, #procedure_div, #bed_div').removeClass('d-none');
    }
});

$('#select_patient').change(function(){
    var patient = $(this).val();
    if(patient == 'existing')
    {
        $('#gender_div, #image_div, #age_div').addClass('d-none');
        $('#mr_number').val('');

    }
    if(patient == 'new')
    {
        $('#gender_div, #image_div, #age_div').removeClass('d-none');
        var new_mr = 'MR-'+$('#mr_number').data('new_mr');
        
        $('#mr_number').val(new_mr);
    }
});
</script>
@endpush
@endsection