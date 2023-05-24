@extends('layouts.master')
@section('content')
<div class="container-fluid">
    <div class="block-header">
        <div class="row">
            <div class="col-lg-6 col-md-6 col-sm-12">
                <h2>All Departments</h2>
                <ul class="breadcrumb">
                    <li class="breadcrumb-item"><a href="index.html"><i class="fa fa-dashboard"></i></a></li>                            
                    <li class="breadcrumb-item">Department</li>
                    <li class="breadcrumb-item active">All Departments</li>
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
                    <h2>Departments List</h2>
                    <ul class="header-dropdown">
                    </ul>
                </div>
                <div class="body">
                    <div class="table-responsive">
                        <table class="table table-bordered table-striped table-hover dataTable js-exportable">
                            <thead>
                                <tr>                                       
                                    <th>ID</th>
                                    <th>name</th>
                                    
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($departments as $key => $department)
                                <tr>
                                    <td>{{ ++$key }}</td>
                                    <td><span class="list-name">{{ $department->name }}</span></td>
                                    
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