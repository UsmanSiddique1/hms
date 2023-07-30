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
                    <h2><strong>Slip#{{ $new_slip }}</strong>  <small>{{ now()->format('d-M-Y h:i A') }}</small> </h2>                            
                </div>
                <form action="{{ route('slips.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="body">
                        @if(Session::has('error'))
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            {{ Session::get('error') }}
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                          </div>
                          @endif
                        <div class="row clearfix">
                            <div class="col-sm-4 {{ Auth::user()->role_name == 'Admin' ? '' : 'd-none'}}" id="employee_div" >
                                <div class="form-group">
                                    <label for="">Select Receptionist</label>
                                    <select name="receptionist_id" class="form-control show-tick select2" {{ Auth::user()->role_name == 'Admin' ? 'required' : '' }}>
                                        <option value="">Receptionist</option>
                                        @foreach($receptionists as $receptionist)
                                        <option value="{{ $receptionist->id }}">{{ $receptionist->user->full_name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div> 
                             
                            <div class="col-sm-4" id="select_patient_div">
                                <div class="form-group">
                                        <label for="">Patient Type</label>
                                        <select class="form-control show-tick" id="select_patient" required>
                                            <option value="">Select Patient</option>
                                            <option value="existing">Existing</option>
                                            <option value="new">New</option>
                                    </select>
                                </div>
                            </div> 
                            <div class="col-sm-4" id="search_patient_div">
                                <div class="form-group">
                                        <label for="">Patient Search By</label>
                                        <select class="form-control show-tick" id="search_patient">
                                            <option value="">Search By</option>
                                            <option value="mr">MR</option>
                                            <option value="phone">Phone</option>
                                    </select>
                                </div>
                            </div> 
                            <div class="col-sm-4" id="type_div">
                                <div class="form-group">
                                    <label for="">Slip Type</label>
                                    <select name="type" class="form-control show-tick" id="type" required>
                                        <option value="">Type</option>
                                        <option value="Emergency">Emergency</option>
                                        <option value="IPD">IPD</option>
                                        <option value="OPD">OPD</option>
                                    </select>
                                </div>
                            </div> 
                             
                            <div class="col-sm-4" id="mr_number_div">
                                
                            </div>
                            <div class="col-sm-3" id="phone_div">
                                
                            </div>
                            <div class="col-sm-4 patient_details" id="name_div">
                                <div class="form-group">
                                        <label for="">Patient Name *</label>
                                        <input type="text" class="form-control" id="patient_name" name="name" placeholder="Patient Name" value="{{ old('name') }}" required>
                                </div>
                            </div>
                            <div class="col-sm-6 patient_details" id="age_div">
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="">Age(Years)</label>
                                            <input type="number" class="form-control" id="patient_name" name="age_years" placeholder="Years">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="">Age(Months)</label>
                                            <input type="number" class="form-control" id="patient_name" name="age_months" placeholder="Months">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="">Age(Days)</label>
                                            <input type="number" class="form-control" id="patient_name" name="age_days" placeholder="Days">
                                        </div>
                                    </div>
                                </div>
                                
                                
                            </div> 
                            <div class="col-sm-2" id="gender_div">
                                <div class="form-group">
                                    <label for="">Gender</label>
                                    <select class="form-control show-tick" name="gender">
                                        <option value="">- Gender -</option>
                                        <option value="male">Male</option>
                                        <option value="female">Female</option>
                                    </select>
                                </div>
                            </div>

                            <div class="col-sm-4" id="cnic_div">
                                <div class="form-group">
                                    <label for="">CNIC</label>
                                    <input type="number" name="cnic" class="form-control" id="cnic">
                                </div>
                            </div>
                            
                            
                            
                            <div class="col-sm-6" id="address_div">
                                <div class="form-group">
                                    <label for="">Address</label>
                                    <input type="text" name="address" class="form-control">
                                </div>
                            </div>
                            <div class="col-sm-6" id="doctor_type_div">
                                <div class="form-group">
                                    <label for="">Doctor Type</label>
                                    <select name="doctor_type" class="form-control" id="">
                                        <option value="">Select Profession</option>
                                        <option value="Consultant">Consultant</option>
                                        <option value="Peads">Peads</option>
                                        <option value="WMO">WMO</option>
                                        <option value="MO">MO</option>
                                        <option value="MS">MS</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-sm-4" id="doctor_div">
                                <div class="form-group">
                                    <label for="">Add Doctor</label>
                                    <select name="doctor" onchange="calculateTotal()" class="form-control show-tick" id="doctor">
                                        <option value="">Doctor</option>
                                        @foreach($doctors as $doctor)
                                            <option data-price="{{ $doctor->price }}" value="{{ $doctor->id }}">{{ $doctor->user->full_name }} - ({{ $doctor->speciality }})</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div> 
                            <div class="col-sm-4" id="procedure_div">
                                <div class="form-group">
                                    <label for="">Add Procedure</label>
                                    <select name="procedures[]" class="form-control select2" onchange="calculateTotal()" id="procedure" multiple="multiple">
                                        <option value="" disabled>Select Procedure</option>
                                        @foreach($procedures as $procedure)
                                            <option data-price="{{ $procedure->price }}" value="{{ $procedure->id }}">{{ $procedure->name }} (Rs.{{ $procedure->price }})</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>  
                            <div class="col-sm-4" id="bed_div">
                                <div class="form-group">
                                    <label for="">Add Bed</label>
                                    <select name="bed" class="form-control select2" id="bed">
                                        <option value="">Select Bed</option>
                                        @foreach($beds as $bed)
                                            <option value="{{ $bed->id }}" data-price="{{ $bed->price }}">{{ $bed->number }} (Rs.{{ $bed->price }})</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>  
                            <div class="col-sm-4" id="bed_div">
                                <div class="form-group">    
                                    <label for="">No. of bed reserved days</label>
                                    <input type="number" name="bed_days" onkeyup="calculateTotal()" class="form-control" placeholder="Days" id="bed_days" value="0" min="0">                                
                                </div>
                            </div> 
                            <div class="col-sm-4 relative">
                                <div class="form-group">
                                    <input type="text" class="form-control" name="W_O" placeholder="W/O">
                                </div>
                            </div>
                            <div class="col-sm-4 relative">
                                <div class="form-group">
                                    <input type="text" class="form-control" name="S_O" placeholder="S/O">
                                </div>
                            </div>
                            <div class="col-sm-4 relative">
                                <div class="form-group">
                                    <input type="text" class="form-control" name="D_O" placeholder="D/O">
                                </div>
                            </div>                    
                        </div>
                        <div class="row clearfix">                            
                            
                            <div class="col-sm-12">
                                <div class="form-group mt-3">
                                    <textarea rows="4" name="description" class="form-control no-resize" placeholder="Please add patient history"></textarea>
                                </div>
                            </div>
                            <div class="col-sm-3">
                                <div class="form-group">
                                    <label for="">Total</label>
                                    <input class="form-control" name="total_amount" id="total_amount" placeholder="Total" readonly required min="1">
                                </div>
                            </div>                            
                            <div class="col-sm-3">
                                <div class="form-group">
                                    <label for="">Discount</label>
                                    <input class="form-control" onkeyup="calculateTotal()" name="discount" id="discount" value="0" placeholder="Discount" min="1">
                                </div>
                            </div><div class="col-sm-3">
                                <div class="form-group">
                                    <label for="">Grand Total</label>
                                    <input class="form-control" name="grand_total" id="grand_total" placeholder="Grand" readonly required min="1">
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
$('#doctor_div, #procedure_div, #bed_div,#bed_days_div, #gender_div, #image_div, #age_div,#search_patient_div, #name_div,#cnic_div, .relative').addClass('d-none');
$('#total_amount').val(0);
$('#type').change(function(){
    var type = $(this).val();
    $('#doctor').attr('onchange', 'calculateTotal()');
    if(type == 'Emergency')
    {
        $('#total_amount').val(0);
        $('#doctor').removeAttr('onchange');
        $('#procedure_div,#doctor_div').removeClass('d-none');
        $('#procedure').attr("required","required");
        $('#bed_div, #bed_days_div').addClass('d-none');
    }
    if(type == 'OPD')
    {
        $('#total_amount').val(0);
        $('#doctor_div').removeClass('d-none');
        $('#bed_div,#bed_days_div,#procedure_div').addClass('d-none');
        $('#procedure').removeAttr("required")

    }
    if(type == 'IPD')
    {
        $('#total_amount').val(0);
        $('#procedure_div').addClass('d-none');
        $('#doctor_div, #bed_div, #bed_days_div').removeClass('d-none');
        $('#procedure_div').removeAttr("required")

    }
});

function refreshSelect2()
{
    $(document).ready(function() {
        $('.select2').select2();
    });
}
$('#select_patient').change(function(){
    var patient = $(this).val();
    if(patient == 'existing')
    {
        $('#mr_number').val('');
        $('#mr_div_new, #mr_div_existing,#mr_div_existing_input,#phone_div_existing,#mr_div_new,#phone_div_new').remove();
        $('.relative').addClass('d-none');

        $('#search_patient_div').removeClass('d-none');       
        $('#search_patient').val('');
        
    }
    if(patient == 'new')
    {   

        $('#search_patient_div,#name_div').addClass('d-none');
        $('#phone_div_existing,#phone_div_new,#phone_div_new').remove();
        var new_patient = `<div class="form-group" id="phone_div_new">    
                <label for="">Phone *</label>
                <input type="number" name="phone" class="form-control" placeholder="Phone" required>                                
            </div>`
        
        $('#phone_div').append(new_patient);

        $('#mr_div_existing,#mr_div_existing_input,#mr_div_new').remove();
        $('#mr_number').val('');
        var new_mr = `<div class="form-group" id="mr_div_new">    
                <label for="">MR Number</label>
                <input type="text" class="form-control" name="mr_number" id="mr_number" data-new_mr="{{ $new_mr }}" value="{{ $new_mr }}" placeholder="MR#" readonly required="">                                
            </div>`
        
        $('#mr_number_div').append(new_mr);
        
        $('#gender_div, #image_div, #age_div,#name_div,#cnic_div,#address_div,.relative').removeClass('d-none');
        
    }
});

$('#search_patient').change(function(){
    if($(this).val() == 'mr')
    {
        $('#mr_div_new, #mr_div_existing,#mr_div_existing_input,#phone_div_existing,#mr_div_new').remove();
        var existing_mr = `<div class="form-group" id="mr_div_existing">
                                    <label for="">MR Number</label>
                                    <select name="mr_number" class="form-control select2" id="select_mr">
                                        <option value="">Select MR</option>
                                        @foreach($patients as $patient)
                                            <option value="{{ $patient->mr_number }}" 
                                                data-phone="{{ $patient->phone }}"
                                                data-name="{{ $patient->name }}"
                                                data-cnic="{{ $patient->cnic }}"
                                                >{{ $patient->mr_number }}</option>
                                        @endforeach
                                    </select>
                                </div>`
        $('#mr_number_div').append(existing_mr);

        var exiting_patient_phone = `<div class="form-group" id="phone_div_new">    
                <label for="">Phone *</label>
                <input type="number" name="phone" class="form-control" id="existing_phone" placeholder="Phone" required>                                
            </div>`
        
        $('#phone_div').append(exiting_patient_phone); 
        
        $('#name_div,#cnic_div').removeClass('d-none');
        refreshSelect2();
    }
    else if($(this).val() == 'phone')
    {
        $('#mr_div_existing,#mr_div_existing_input,#phone_div_new').remove();
        $('#gender_div, #image_div, #age_div, #phone_div_existing').addClass('d-none');
        var existing_patient =`<div class="form-group" id="phone_div_existing">
                                    <label for="">Phone</label>
                                    <select name="phone" class="form-control select2 select_phone_mr" id="select_phone">
                                        <option value="">Select Phone</option>
                                        @foreach($patients as $patient)
                                            <option value="{{ $patient->id }}" 
                                                data-mr_number="{{ $patient->mr_number }}"
                                                data-name="{{ $patient->name }}"
                                                data-cnic="{{ $patient->cnic }}"
                                                data-phone="{{ $patient->phone }}"
                                                >{{ $patient->phone }} - {{ $patient->name }}</option>
                                        @endforeach
                                    </select>
                                </div>`;
        $('#mr_number').val('');
        refreshSelect2();

        $('#phone_div').append(existing_patient);

        var existing_mr = `<div class="form-group" id="mr_div_existing_input">    
                <label for="">MR Number</label>
                <select name="mr_number" id="get_mr_numbers" class="form-control">

                </select>
            </div>`
        
        $('#mr_number_div').append(existing_mr);

        $('#name_div,#cnic_div').removeClass('d-none');


    }
});


// $('.select_phone_mr').change(function(){
//     var phone = $(this).val();
//     console.log(phone);
//     $.get('/get_mr_numers/'+phone, function(response){
//         console.log(response);
//     });
// });


$('#procedure').change(function(){
    var amount = 0;
    console.log($(this).find(':selected'));
    $(this).find(':selected').each(function(obj){
        console.log(obj);
        console.log($(this).find(':selected').data("price"));
        amount += parseInt($(this).find(':selected').data('price'));
    });
    // console.log(amount);
    // alert($(this).find(':selected').data('price'));
    // var procedures = [];

    // console.log($(this).data("price"));
});

// $('#procedure').find(':selected').each(function() {
//     alert($(this).text() + ' ' + $(this).val());
// });

// $('#procedure').change(function(){
//     console.log($(this).val());
// })
// $('#select_phone').change(function(){
//     alert("test");
//     $('#mr_number').val($(this).find(':selected').data("mr_number"));
//     console.log($(this).find(':selected').data("name"));
//     $('#patient_name').val($(this).find(':selected').data("name"));
// });

$(document).on('change', '#select_phone', function() {
    var existing_mr_number = $(this).find(':selected').data("mr_number");
    var name = $(this).find(':selected').data("name");
    var cnic = $(this).find(':selected').data("cnic");
    var phone = $(this).find(':selected').data("phone");
    console.log(phone);
    $.get('/get_mr_numers/'+phone, function(response){
        console.log(response);

        $('#get_mr_numbers').empty();
    
        $.each(response.data, function(index,patient){
            console.log(patient);
            $('#get_mr_numbers').append('<option value="' + patient.mr_number + '">' + patient.mr_number + '</option>');
        })
    });
    console.log(existing_mr_number,name);
    $('#patient_name').val(name);
    $('#cnic').val(cnic);
    $('#existing_mr_number').val(existing_mr_number);
});

$(document).on('change', '#select_mr', function() {
    var phone = $(this).find(':selected').data("phone");
    var name = $(this).find(':selected').data("name");
    var cnic = $(this).find(':selected').data("cnic");
    
    console.log(phone,name);
    $('#patient_name').val(name);
    $('#cnic').val(cnic);
    $('#existing_phone').val(phone);
});

    function calculateTotal() {

        
        console.log("start function");
        var total = 0;
        var doctor_price = bed_price = procedure_price = 0;
        // Get the price from the first single select option
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
        
        // Get the price from the second single select option
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
        
        // Get the discount value from the input field
        var discount = parseFloat(document.getElementById("discount").value) || 0;

        if(total < discount)
        {
            $('#discount').val() = 0;
        }
        // Calculate grand_total by subtracting discount from total
        var grand_total = total - discount;

        
        // Update the total_amount and grand_total input fields
        $('#total_amount').val(total.toFixed(2));
        $('#grand_total').val(grand_total.toFixed(2));

        // $('#total_amount').val(total);
        // document.getElementById("total_amount").textContent = total.toFixed(2);
    }
</script>
@endpush
@endsection