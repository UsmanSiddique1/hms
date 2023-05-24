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
                                    <th>Age</th>
                                    <th>Number</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($patients as $patient)
                                <tr>
                                    <td><span class="list-icon"><img class="avatar" src="../assets/images/xs/avatar1.jpg" alt=""></span></td>
                                    <td><span class="list-name">{{ $patient->mr_number }}</span></td>
                                    <td>{{ $patient->name }}</td>
                                    <td>{{ $patient->age_years }}y , {{ $patient->age_months }}m, {{ $patient->age_weeks }}w</td>
                                    <td>{{ $patient->phone }}</td>
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
@endsection