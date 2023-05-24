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
                        {{-- <ul class="nav nav-tabs-new">
                            <li class="nav-item"><a class="nav-link active show" data-toggle="tab" href="#All">All</a></li>
                            <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#USA">USA</a></li>
                            <li class="nav-item"><a class="nav-link" data-toggle="tab" href="#India">India</a></li>
                        </ul> --}}
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
                    <table class="table table-bordered table-striped table-hover dataTable js-exportable">
                        <thead>
                            <tr>                                       
                                <th>Media</th>
                                <th>Name</th>
                                <th>Phone</th>
                                <th>Shift</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($receptionists as $receptionist)
                            <tr>
                                <td><span class="list-icon"><img class="avatar" src="../assets/images/xs/avatar1.jpg" alt=""></span></td>
                                <td><span class="list-name">{{ $receptionist->user->f_name }}</span></td>
                                <td>{{ $receptionist->user->phone }}</td>
                                <td>{{ $receptionist->shift }}</td>
                            </tr>
                            @endforeach
                            
                        </tbody>
                    </table>   
                </div>
            </div>
        </div>
    </div>

</div>

@push('footer-scripts')


@endpush
@endsection