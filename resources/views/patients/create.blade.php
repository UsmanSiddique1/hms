@extends('layouts.master')
@section('content')
<div class="container-fluid">
    <div class="block-header">
        <div class="row">
            <div class="col-lg-6 col-md-6 col-sm-12">
                <h2>Add Patient</h2>
                <ul class="breadcrumb">
                    <li class="breadcrumb-item"><a href="index.html"><i class="fa fa-dashboard"></i></a></li>                            
                    <li class="breadcrumb-item">Patient</li>
                    <li class="breadcrumb-item active">Add Patient</li>
                </ul>
            </div>
            <div class="col-lg-6 col-md-6 col-sm-12">
                <div class="d-flex flex-row-reverse">
                    <div class="page_action">
                        {{-- <button type="button" class="btn btn-primary"><i class="fa fa-download"></i> Download report</button>
                        <button type="button" class="btn btn-secondary"><i class="fa fa-send"></i> Send report</button> --}}
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
                    <h2>Basic Information <small>{{ $mr_number }}</small> </h2>                            
                </div>
                <form action="{{ route('patients.store') }}" method="POST">
                    @csrf
                    <input type="text" name="mr_number" value="{{ $mr_number }}" hidden>
                    <div class="body">
                        <div class="row clearfix">
                            <div class="col-sm-4">
                                <div class="form-group">
                                    <input type="text" class="form-control" name="name" placeholder="Name" required>
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="form-group">
                                    <input type="number" class="form-control" name="phone" placeholder="Phone No." required>
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="form-group">
                                    <input type="number" class="form-control" name="cnic" placeholder="Phone No." required>
                                </div>
                            </div>
                        </div>
                        <div class="row clearfix">       
                            
                            <div class="col-sm-4">
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <input type="number" class="form-control" id="patient_name" name="age_years" placeholder="Years">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <input type="number" class="form-control" id="patient_name" name="age_months" placeholder="Months">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <input type="number" class="form-control" id="patient_name" name="age_weeks" placeholder="Weeks">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="form-group">
                                    <select class="form-control show-tick" name="gender">
                                        <option value="">- Gender -</option>
                                        <option value="male">Male</option>
                                        <option value="female">Female</option>
                                    </select>
                                </div>
                            </div>                            
                            <div class="col-sm-4">
                                <div class="form-group">
                                    <input type="text" class="form-control" name="email" placeholder="Enter Your Email">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-12">
                                <input type="file" name="image" class="dropify">
                            </div>
                            <div class="col-sm-12 mt-5">
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
@endsection