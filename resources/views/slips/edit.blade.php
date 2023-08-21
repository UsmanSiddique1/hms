@extends('layouts.master')
@push('header-scripts')
<style>
    .select2.select2-container{
        width: 100% !important;
    }
</style>
@endpush
@section('content')
<div class="container-fluid">
    <div class="block-header">
        <div class="row">
            <div class="col-lg-6 col-md-6 col-sm-12">
                <h2>Add Slip</h2>
                <ul class="breadcrumb">
                    <li class="breadcrumb-item"><a href="index.html"><i class="fa fa-dashboard"></i></a></li>                            
                    <li class="breadcrumb-item">Slip</li>
                    <li class="breadcrumb-item active">Show</li>
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
                    <h2><strong>Slip# {{ $slip->slip_number }}</strong>  <small>{{ now()->format('d-M-Y h:i A') }}</small> @if($slip->donor_id != null)
                        <strong class="badge badge-secondary">CROSS MATCH SLIP</strong>
                        @endif </h2>                            
                </div>
                <form action="{{ route('slips.update', $slip->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="body">
                        @if(Session::has('error'))
                        <div class="alert alert-danger" role="alert">
                            {{ Session::get('error') }}
                          </div>
                          @endif
                          @if($slip->donor_id != null)
                            <input type="hidden" name="processing" value="cross_match">
                            @endif
                        <div class="row clearfix">
                            
                            <div class="col-sm-4 {{ Auth::user()->role_name == 'Admin' ? '' : 'd-none'}}" id="employee_div" >
                                <div class="form-group">
                                    <label for="">Select Receptionist</label>
                                    <select name="receptionist_id" class="form-control show-tick select2" {{ Auth::user()->role_name == 'Admin' ? 'required' : '' }}>
                                       {{-- @foreach($receptionists as $receptionist) --}}
                                        <option value="{{ $slip->receptionist->id }}">{{ $slip->receptionist->user->full_name }}</option>
                                       {{-- @endforeach --}}
                                    </select>
                                </div>
                            </div>
                            <div class="col-sm-4" id="type_div">
                                <div class="form-group">
                                    <label for="">Slip Type</label>
                                    <select name="type" class="form-control show-tick" id="type" required>
                                        <option value="Emergency" {{ $slip->type == 'Emergency' ? 'selected' : 'disabled' }}>Emergency</option>
                                        <option value="IPD" {{ $slip->type == 'IPD' ? 'selected' : 'disabled' }}>IPD</option>
                                        <option value="OPD" {{ $slip->type == 'OPD' ? 'selected' : 'disabled' }}>OPD</option>
                                    </select>
                                </div>
                            </div> 
                             
                            <div class="col-sm-4" id="mr_number_div">
                                <div class="form-group" id="mr_div_new">    
                                    <label for="">MR Number</label>
                                    <input type="text" class="form-control" name="mr_number" id="mr_number" value="{{ $slip->patient->mr_number }}" disabled required="">                                
                                </div>
                            </div>
                            <div class="col-sm-4" id="phone_div">
                                <div class="form-group" id="phone_div_new">    
                                    <label for="">Phone</label>
                                    <input type="number" name="phone" value="{{ $slip->patient->phone }}" class="form-control" placeholder="Phone">                                
                                </div>
                            </div>
                            <div class="col-sm-4 patient_details" id="name_div">
                                <div class="form-group">
                                        <label for="">Patient Name *</label>
                                        <input type="text" class="form-control" id="patient_name" name="name" placeholder="Patient Name" value="{{ $slip->patient->name }}" required>
                                </div>
                            </div>
                            <div class="col-sm-4" id="gender_div">
                                <div class="form-group">
                                    <label for="">Gender</label>
                                    <select class="form-control show-tick" name="gender">
                                        <option value="">- Gender -</option>
                                        <option value="male" {{ $slip->patient->gender  == 'male' ? 'selected' : '' }}>Male</option>
                                        <option value="female" {{ $slip->patient->gender  == 'female' ? 'selected' : '' }}>Female</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-sm-6 patient_details" id="age_div">
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="">Age(Years)</label>
                                            <input type="number" class="form-control" id="patient_name" name="age_years" value="{{ $slip->patient->age_years }}" placeholder="Years">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="">Age(Months)</label>
                                            <input type="number" class="form-control" id="patient_name" name="age_months" value="{{ $slip->patient->age_months }}" placeholder="Months">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="">Age(Weeks)</label>
                                            <input type="number" class="form-control" id="patient_name" name="age_weeks" value="{{ $slip->patient->age_weeks }}" placeholder="Weeks">
                                        </div>
                                    </div>
                                </div>
                                
                                
                            </div> 
                            

                            <div class="col-sm-6" id="cnic_div">
                                <div class="form-group">
                                    <label for="">CNIC</label>
                                    <input type="number" name="cnic" class="form-control" id="cnic" value="{{$slip->patient->cnic}}" readonly>
                                </div>
                            </div>
                            
                            
                            
                            <div class="col-sm-6" id="address_div">
                                <div class="form-group">
                                    <label for="">Address</label>
                                    <input type="text" name="address" value="{{$slip->patient->address}}" class="form-control">
                                </div>
                            </div>
                            <div class="col-sm-6" id="doctor_type_div">
                                <div class="form-group">
                                    <label for="">Doctor Type</label>
                                    <select name="doctor_type" class="form-control" id="">
                                        <option value="">Select Profession</option>
                                        <option value="Consultant" {{ $slip->doctor_type  == 'Consultant' ? 'selected' : '' }}>Consultant</option>
                                        <option value="Peads" {{ $slip->doctor_type  == 'Peads' ? 'selected' : '' }}>Peads</option>
                                        <option value="WMO" {{ $slip->doctor_type  == 'WMO' ? 'selected' : '' }}>WMO</option>
                                        <option value="MO" {{ $slip->doctor_type  == 'MO' ? 'selected' : '' }}>MO</option>
                                        <option value="MS" {{ $slip->doctor_type  == 'MS' ? 'selected' : '' }}>MS</option>
                                    </select>
                                </div>
                            </div>
                            @if($slip->doctor)
                            <div class="col-sm-4" id="doctor_div">
                                <div class="form-group">
                                    <label for="">Add Doctor</label>
                                    <select name="doctor" onchange="calculateTotal()" class="form-control show-tick select2" id="doctor">
                                        @foreach($doctors as $doctor)
                                            <option {{$doctor->id == $slip->doctor_id ? 'selected' : ''}} data-price="{{ $doctor->price }}" value="{{ $doctor->id }}">{{ $doctor->user->full_name }} - ({{ $doctor->speciality }})</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div> 
                            @endif
                        
                            <div class="col-sm-4" id="procedure_div">
                                <div class="form-group">
                                    <label for="">Add Procedure</label>
                                    <select name="procedures[]" class="form-control select2" onchange="calculateTotal()" id="procedure" multiple="multiple">
                                        <option value="" disabled>Select Procedure</option>
                                        @foreach($procedures as $procedure)
                                            @php
                                                $selected = $slip->procedures->contains('id', $procedure->id);
                                            @endphp
                                            <option data-price="{{ $procedure->price }}" value="{{ $procedure->id }}" {{ $selected ? 'selected' : '' }}>
                                                {{ $procedure->name }} (Rs.{{ $procedure->price }})
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>  
                            @if($slip->bed)
                            <div class="col-sm-4" id="bed_div">
                                <div class="form-group">
                                    <label for="">Add Bed</label>
                                    <select name="bed" class="form-control select2" id="bed">
                                        <option value="">Select Bed</option>
                                        @foreach($beds as $bed)
                                            <option {{$bed->id == $slip->bed_id ? 'selected' : ''}} value="{{ bed->id }}" data-price="{{ $bed->price }}">{{ $bed->number }} (Rs.{{ $bed->price }})</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>  
                            <div class="col-sm-4" id="bed_div">
                                <div class="form-group">    
                                    <label for="">No. of bed reserved days</label>
                                    <input type="number" name="bed_days" onkeyup="calculateTotal()" class="form-control" placeholder="Days" id="bed_days" disabled value="{{$slip->bed->price}}" min="0">                                
                                </div>
                            </div> 
                            @endif

                            <div class="col-sm-4 relative">
                                <div class="form-group">
                                    <input type="text" class="form-control" name="W_O" placeholder="W/O" value="{{$slip->patient->W_O}}">
                                </div>
                            </div>
                            <div class="col-sm-4 relative">
                                <div class="form-group">
                                    <input type="text" class="form-control" name="S_O" placeholder="S/O" value="{{$slip->patient->S_O}}">
                                </div>
                            </div>
                            <div class="col-sm-4 relative">
                                <div class="form-group">
                                    <input type="text" class="form-control" name="D_O" placeholder="D/O" value="{{$slip->patient->D_O}}">
                                </div>
                            </div>                    
                        </div>
                        @if($slip->donor_id != null )
                        <div class="row" id="doner_row">
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="">Donor Name *</label>
                                    <input type="text" class="form-control" id="donor_name" name="donor_name" placeholder="Patient Name" value="{{ $slip->donor->name }}">
                                </div>
                            </div>
                            <div class="col-sm-3" id="donor_cnic_div">
                                <div class="form-group">
                                    <label for="">Donor cnic</label>
                                    <input type="number" name="donor_cnic" class="form-control" value="{{ $slip->donor->cnic }}" id="donor_cnic">
                                </div>
                            </div>                     
                            <div class="col-sm-3" id="donor_address_div">
                                <div class="form-group">
                                    <label for="">Donor address</label>
                                    <input type="text" name="donor_address" class="form-control" value="{{ $slip->donor->address }}">
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label for="">Donor Age(Years)</label>
                                    <input type="number" class="form-control" id="donor_age" name="donor_age" value="{{ $slip->donor->age }}" placeholder="Donor Age">
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group" id="donor_phone">    
                                    <label for="">Donor Phone *</label>
                                    <input type="number" name="donor_phone" class="form-control" value="{{ $slip->donor->phone }}" placeholder="Doner Phone">                                
                                </div>
                            </div>
                            <div class="col-sm-3">
                                <div class="form-group">
                                    <label for="">Relation *</label>
                                    <input type="text" class="form-control" name="donor_S_O" value="{{ $slip->donor->S_O }}" placeholder="Doner S/O">
                                </div>
                            </div>
                        </div>
                        @endif
                        <div class="row clearfix">                            
                            
                            <div class="col-sm-12">
                                <div class="form-group mt-3">
                                    <textarea rows="4" name="description" class="form-control no-resize" placeholder="Please add patient history">{{$slip->description}}</textarea>
                                </div>
                            </div>
                            <div class="col-sm-3">
                                <div class="form-group">
                                    <label for="">Sub Total</label>
                                    <input class="form-control" name="total_amount" id="total_amount" placeholder="Total" readonly value="{{ $slip->total_amount }}" required min="1">
                                </div>
                            </div>
                            <div class="col-sm-3">
                                <div class="form-group">
                                    <label for="">Discount</label>
                                    <input class="form-control" onkeyup="calculateTotal()" name="discount" id="discount" value="{{ $slip->discount }}" placeholder="Discount" min="1" max="{{ $slip->total_amount }}">
                                </div>
                            </div><div class="col-sm-3">
                                <div class="form-group">
                                    <label for="">Grand Total</label>
                                    <input class="form-control" name="grand_total" id="grand_total" value="{{ $slip->grand_total ?: $slip->total_amount }}" placeholder="Grand" readonly required min="1">
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
function calculateTotal() {

        
console.log("start function");
var total = 0;
var doctor_price = bed_price = procedure_price = 0;
// Get the price from the first single select option
@if($slip->doctor)
var selectElement1 = document.getElementById("doctor");
var selectedOption1 = selectElement1.options[selectElement1.selectedIndex];
console.log("doctor select: "+selectedOption1);
if(selectedOption1.value != '')
{
    console.log("doctor price: "+selectedOption1.dataset.price);
    var doctor_price = parseFloat(selectedOption1.dataset.price);
    total += doctor_price;
    console.log(total);

}
@endif


// Get the price from the second single select option
@if($slip->bed)

var selectElement2 = document.getElementById("bed");
var selectedOption2 = selectElement2.options[selectElement2.selectedIndex];
console.log("Bed select: "+selectedOption1);
if(selectedOption2.value != '')
{
    $('#bed_days').attr("required","required");
    var bed_days = $('#bed_days').val()
    if(bed_days != 0)
    {
        console.log("bed price: "+selectedOption2.dataset.price);
        var bed_price = parseFloat(selectedOption2.dataset.price);
        var res_total_fee = bed_price * parseFloat(bed_days);          
        total += res_total_fee;
        console.log(total);

    }
    
}

@endif

@if($slip->procedures)

var selectElement = document.getElementById("procedure");
var selectedOptions = selectElement.selectedOptions;
if(selectedOptions.length > 0)
{
    console.log("start loop");        
    for (var i = 0; i < selectedOptions.length; i++) {
        console.log("iteration: "+ i);
        var option = selectedOptions[i];
        var procedure_price = parseFloat(option.dataset.price);
        total += procedure_price;
    }
    console.log(total);
}
@endif
// Get the discount value from the input field
var discount = parseFloat(document.getElementById("discount").value) || 0;

if(total < discount)
{
    $('#discount').val(0);
    $('#grand_total').val($('#total_amount').val());

}
else
{
    var grand_total = total - discount;   
}


// Update the total_amount and grand_total input fields
$('#total_amount').val(total.toFixed(2));
$('#grand_total').val(grand_total.toFixed(2));
// $('#total_amount').val(total);
// document.getElementById("total_amount").textContent = total.toFixed(2);
}
</script>

@endpush
@endsection