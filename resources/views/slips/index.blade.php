@extends('layouts.master')
@section('content')
<div class="container-fluid">
    <div class="block-header">
        <div class="row">
            <div class="col-lg-6 col-md-6 col-sm-12">
                <h2>All Slips</h2>
                <ul class="breadcrumb">
                    <li class="breadcrumb-item"><a href="index.html"><i class="fa fa-dashboard"></i></a></li>                            
                    <li class="breadcrumb-item">Slip</li>
                    <li class="breadcrumb-item active">All Slips</li>
                </ul>
            </div>
            <div class="col-lg-6 col-md-6 col-sm-12">
                <div class="d-flex flex-row-reverse">
                    <div class="page_action">
                        <!-- Nav tabs -->
                      
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
                    <h2>Slips List</h2>
                    <ul class="header-dropdown">
                    </ul>
                </div>
                <div class="body">
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped table-hover dataTable js-exportable">
                            <thead>
                                <tr>                                       
                                    <th>Slip No</th>
                                    <th>MR Number</th>
                                    <th>Patient Name</th>
                                    <th>Patient Phone</th>
                                    <th>Doctor Name</th>
                                    <th>Slip Type</th>
                                    <th>Amount</th>
                                    <th>Action</th>
                                    
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($slips as $key => $slip)
                                <tr>
                                    <td>{{ $slip->slip_number }}</td>
                                    <td>{{ $slip->patient->mr_number }}</td>
                                    <td>{{ $slip->patient->name }}</td>
                                    <td>{{ $slip->patient->phone }}</td>
                                    <td>{{ $slip->doctor ? $slip->doctor->user->f_name : '--' }}</td>
                                    <td><span class="badge {{ $slip->type == 'Emergency' ? 'badge-danger' : 'badge-primary' }}">{{ $slip->type }}</span></td>
                                    <td>Rs.{{ $slip->total_amount }}</td>
                                    <td>
                                        <a href="{{ route('slips.show', $slip->id) }}" target="_blank" class="btn btn-primary"><i class="fa fa-eye"></i></a>
                                        <a href="{{ route('slips.edit', $slip->id) }}" class="btn btn-primary edit-patient"><i class="fa fa-pencil"></i></a>
                                        
                                          </button>
                                          <a href="javascript:void(0)" class="delete btn btn-danger" 
                                          data-id="{{ $slip->id }}"
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
@endsection