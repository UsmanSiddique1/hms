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
                                    <th>Name</th>
                                    <th>Specialization</th>
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
                                    <td>{{ $doctor->department ? $doctor->department->name : '--' }}</td>
                                    <td>Update</td>
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