@extends('layouts.master')
@section('content')
<div class="container-fluid">
    <div class="block-header">
        <div class="row">
            <div class="col-lg-6 col-md-6 col-sm-12">
                <h2>Analytical</h2>
                <ul class="breadcrumb">
                    <li class="breadcrumb-item"><a href="index.html"><i class="fa fa-dashboard"></i></a></li>                            
                    <li class="breadcrumb-item">Dashboard</li>
                    <li class="breadcrumb-item active">Analytical</li>
                </ul>
            </div>
            <div class="col-lg-6 col-md-6 col-sm-12">
                <div class="d-flex flex-row-reverse">
                    <div class="page_action">
                        <a href="{{ route('slips.create') }}" type="button" class="btn btn-secondary"><i class="fa fa-send"></i> Create Slip</a>
                    </div>
                    <div class="p-2 d-flex">
                        
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row clearfix row-deck">
        <div class="col-xl-3 col-lg-4 col-md-12">
            <div class="row clearfix">
                <div class="col-lg-12 col-md-6">
                    <div class="card top_widget">
                        <div id="top_counter1" class="carousel slide" data-ride="carousel" data-interval="2500">
                            <div class="carousel-inner">
                                <div class="carousel-item active">
                                    <div class="body">
                                        <div class="icon"><i class="fa fa-user"></i></div>
                                        <div class="content">
                                            <div class="text mb-2 text-uppercase">Total Patient</div>
                                            <h4 class="number mb-0">{{ $patients }} <span class="font-12 text-muted"><i class="fa fa-level-up"></i> 13%</span></h4>
                                            <small class="text-muted">Analytics for all time</small>
                                        </div>
                                    </div>
                                </div>
                                <div class="carousel-item">
                                    <div class="body">
                                        <div class="icon"><i class="fa fa-user"></i></div>
                                        <div class="content">
                                            <div class="text mb-2 text-uppercase">New Patient</div>
                                            <h4 class="number mb-0">{{ $today_new_patients }} <span class="font-12 text-muted"><i class="fa fa-level-up"></i> 8.2%</span></h4>
                                            <small class="text-muted">Analytics for today</small>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-12 col-md-6">
                    <div class="card top_widget">
                        <div id="top_counter2" class="carousel slide" data-ride="carousel" data-interval="2000">
                            <div class="carousel-inner">
                                <div class="carousel-item active">
                                    <div class="body">
                                        <div class="icon"><i class="fa fa-user-md"></i></div>
                                        <div class="content">
                                            <div class="text mb-2 text-uppercase">Today Emergency</div>
                                            <h4 class="number mb-0">{{ $today_emergency_slips }}<span class="font-12 text-muted"><i class="fa fa-level-up"></i></span></h4>
                                            <small class="text-muted">Analytics for today</small>
                                        </div>
                                    </div>
                                </div>
                                <div class="carousel-item">
                                    <div class="body">
                                        <div class="icon"><i class="fa fa-user-md"></i></div>
                                        <div class="content">
                                            <div class="text mb-2 text-uppercase">Today IPD</div>
                                            <h4 class="number mb-0">{{ $today_ipd_slips }} <span class="font-12 text-muted"><i class="fa fa-level-up"></i></span></h4>
                                            <small class="text-muted">Analytics for today</small>
                                        </div>
                                    </div>
                                </div>
                                <div class="carousel-item">
                                    <div class="body">
                                        <div class="icon"><i class="fa fa-user-md"></i></div>
                                        <div class="content">
                                            <div class="text mb-2 text-uppercase">Today OPD</div>
                                            <h4 class="number mb-0">{{ $today_ipd_slips }} <span class="font-12 text-muted"><i class="fa fa-level-up"></i></span></h4>
                                            <small class="text-muted">Analytics for today</small>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-12 col-md-6">
                    <div class="card top_widget">
                        <div id="top_counter3" class="carousel slide" data-ride="carousel" data-interval="2300">
                            <div class="carousel-inner">
                                <div class="carousel-item active">
                                    <div class="body">
                                        <div class="icon"><i class="fa fa-eye"></i></div>
                                        <div class="content">
                                            <div class="text mb-2 text-uppercase">Today Visitors</div>
                                            <h4 class="number mb-0">{{ $today_visits }} <span class="font-12 text-muted"><i class="fa fa-level-up"></i> 13%</span></h4>
                                            <small class="text-muted">Analytics for today</small>
                                        </div>
                                    </div>
                                </div>
                                <div class="carousel-item">
                                    <div class="body">
                                        <div class="icon"><i class="fa fa-eye"></i></div>
                                        <div class="content">
                                            <div class="text mb-2 text-uppercase">{{ now()->format('M') }} Visitors</div>
                                            <h4 class="number mb-0">{{ $current_month_visits }} <span class="font-12 text-muted"><i class="fa fa-level-up"></i> 8.2%</span></h4>
                                            <small class="text-muted">Analytics for current month</small>
                                        </div>
                                    </div>
                                </div>
                                <div class="carousel-item">
                                    <div class="body">
                                        <div class="icon"><i class="fa fa-eye"></i></div>
                                        <div class="content">
                                            <div class="text mb-2 text-uppercase">{{ now()->format('Y') }} Visitors</div>
                                            <h4 class="number mb-0">{{ $current_month_visits }} <span class="font-12 text-muted"><i class="fa fa-level-up"></i> 8.2%</span></h4>
                                            <small class="text-muted">Analytics for current year</small>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
               
            </div>
        </div>
        <div class="col-xl-9 col-lg-8 col-md-12">
            <div class="card">
                <div class="header">
                    <h2>Total Revenue</h2>
                    
                </div>
                <div class="body">
                    <div class="row clearfix">
                        <div class="col-md-4">
                            <div class="body primary-bg text-light">
                                <h4>Rs. {{ $today_income }}</h4>
                                <span>Today's Income</span>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="body secondary-bg text-light">
                                <h4> Rs. {{ $current_month_income }}</h4>
                                <span>{{ now()->format('M') }} Income</span>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="body bg-danger text-light">
                                <h4>Rs. {{ $current_year_income }}</h4>
                                <span>{{ now()->format('Y')}} Income</span>
                            </div>
                        </div>
                    </div>
                   
                </div>
            </div>
        </div>
    </div>

  

</div>
@endsection
