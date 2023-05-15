@extends('layouts.master')
@section('content')
<div class="container-fluid">
    <div class="block-header">
        <div class="row">
            <div class="col-lg-6 col-md-6 col-sm-12">
                <h2>All Doctor</h2>
                <ul class="breadcrumb">
                    <li class="breadcrumb-item"><a href="index.html"><i class="fa fa-dashboard"></i></a></li>                            
                    <li class="breadcrumb-item">Doctor</li>
                    <li class="breadcrumb-item active">All Doctor</li>
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
        @foreach($doctors as $doctor)
        <div class="col-lg-3 col-md-6 col-sm-12">
            <div class="card">
                <div class="body text-center">
                    <div class="chart easy-pie-chart-1" data-percent="75">
                        <span><img src="../assets/images/sm/avatar1.jpg" data-toggle="tooltip" data-placement="top" title="Dr. Avatar" alt="user" class="rounded-circle"/></span>
                    </div>
                    <h6 class="mb-0"><a href="#" title="" >{{ $doctor->user->f_name }}</a> </h6>
                    <span>{{ $doctor->speciality }}</span>
                    <ul class="social-links list-unstyled d-flex justify-content-center mt-3">
                        <li class="ml-2 mr-2"><a title="facebook" href="javascript:void(0);"><i class="fa fa-facebook"></i></a></li>
                        <li class="ml-2 mr-2"><a title="twitter" href="javascript:void(0);"><i class="fa fa-twitter"></i></a></li>
                        <li class="ml-2 mr-2"><a title="instagram" href="javascript:void(0);"><i class="fa fa-instagram"></i></a></li>
                    </ul>
                    <span>{{ $doctor->description }}</span>
                </div>
            </div>
        </div>
        @endforeach
        
        <div class="col-lg-3 col-md-6 col-sm-12">
            <div class="card">
                <div class="body text-center">
                    <div class="p-t-80 p-b-80">
                        <h6>Add New <br> Docter</h6>                                
                        <a href="{{ route('doctors.create') }}" type="button" class="btn btn-outline-primary m-t-10"><i class="fa fa-plus-circle"></i></a>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>

@endsection