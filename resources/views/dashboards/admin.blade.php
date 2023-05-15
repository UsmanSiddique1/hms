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
                        <button type="button" class="btn btn-primary"><i class="fa fa-download"></i> Download report</button>
                        <button type="button" class="btn btn-secondary"><i class="fa fa-send"></i> Send report</button>
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
                                            <h4 class="number mb-0">3,251 <span class="font-12 text-muted"><i class="fa fa-level-up"></i> 13%</span></h4>
                                            <small class="text-muted">Analytics for last week</small>
                                        </div>
                                    </div>
                                </div>
                                <div class="carousel-item">
                                    <div class="body">
                                        <div class="icon"><i class="fa fa-user"></i></div>
                                        <div class="content">
                                            <div class="text mb-2 text-uppercase">New Patient</div>
                                            <h4 class="number mb-0">351 <span class="font-12 text-muted"><i class="fa fa-level-up"></i> 8.2%</span></h4>
                                            <small class="text-muted">Analytics for last week</small>
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
                                            <div class="text mb-2 text-uppercase">Operations</div>
                                            <h4 class="number mb-0">32 <span class="font-12 text-muted"><i class="fa fa-level-up"></i> 13%</span></h4>
                                            <small class="text-muted">Analytics for last week</small>
                                        </div>
                                    </div>
                                </div>
                                <div class="carousel-item">
                                    <div class="body">
                                        <div class="icon"><i class="fa fa-user-md"></i></div>
                                        <div class="content">
                                            <div class="text mb-2 text-uppercase">Surgery</div>
                                            <h4 class="number mb-0">24 <span class="font-12 text-muted"><i class="fa fa-level-up"></i> 8.2%</span></h4>
                                            <small class="text-muted">Analytics for last week</small>
                                        </div>
                                    </div>
                                </div>
                                <div class="carousel-item">
                                    <div class="body">
                                        <div class="icon"><i class="fa fa-user-md"></i></div>
                                        <div class="content">
                                            <div class="text mb-2 text-uppercase">Treatment</div>
                                            <h4 class="number mb-0">45 <span class="font-12 text-muted"><i class="fa fa-level-up"></i> 8.2%</span></h4>
                                            <small class="text-muted">Analytics for last week</small>
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
                                            <div class="text mb-2 text-uppercase">Total Visitors</div>
                                            <h4 class="number mb-0">32k <span class="font-12 text-muted"><i class="fa fa-level-up"></i> 13%</span></h4>
                                            <small class="text-muted">Analytics for last week</small>
                                        </div>
                                    </div>
                                </div>
                                <div class="carousel-item">
                                    <div class="body">
                                        <div class="icon"><i class="fa fa-eye"></i></div>
                                        <div class="content">
                                            <div class="text mb-2 text-uppercase">Today Visitors</div>
                                            <h4 class="number mb-0">351 <span class="font-12 text-muted"><i class="fa fa-level-up"></i> 8.2%</span></h4>
                                            <small class="text-muted">Analytics for last week</small>
                                        </div>
                                    </div>
                                </div>
                                <div class="carousel-item">
                                    <div class="body">
                                        <div class="icon"><i class="fa fa-eye"></i></div>
                                        <div class="content">
                                            <div class="text mb-2 text-uppercase">Month Visitors</div>
                                            <h4 class="number mb-0">1,351 <span class="font-12 text-muted"><i class="fa fa-level-up"></i> 8.2%</span></h4>
                                            <small class="text-muted">Analytics for last week</small>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-12 col-md-6">
                    <div class="card top_widget">
                        <div id="top_counter4" class="carousel slide" data-ride="carousel" data-interval="2300">
                            <div class="carousel-inner">
                                <div class="carousel-item active">
                                    <div class="body">
                                        <div class="icon"><i class="fa fa-thumbs-o-up"></i></div>
                                        <div class="content">
                                            <div class="text mb-2 text-uppercase">Happy Clients</div>
                                            <h4 class="number mb-0">780</h4>
                                            <small class="text-muted">Analytics for last week</small>
                                        </div>
                                    </div>
                                </div>
                                <div class="carousel-item">
                                    <div class="body">
                                        <div class="icon"><i class="fa fa-smile-o"></i></div>
                                        <div class="content">
                                            <div class="text mb-2 text-uppercase">Smiley Faces</div>
                                            <h4 class="number mb-0">2,351</h4>
                                            <small class="text-muted">Analytics for last week</small>
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
                    <ul class="header-dropdown">
                        <li><a class="tab_btn" href="javascript:void(0);" title="Weekly">W</a></li>
                        <li><a class="tab_btn" href="javascript:void(0);" title="Monthly">M</a></li>
                        <li><a class="tab_btn active" href="javascript:void(0);" title="Yearly">Y</a></li>
                        <li class="dropdown">
                            <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"></a>
                            <ul class="dropdown-menu dropdown-menu-right">
                                <li><a href="javascript:void(0);">Action</a></li>
                                <li><a href="javascript:void(0);">Another Action</a></li>
                                <li><a href="javascript:void(0);">Something else</a></li>
                            </ul>
                        </li>
                    </ul>
                </div>
                <div class="body">
                    <div class="row clearfix">
                        <div class="col-md-4">
                            <div class="body primary-bg text-light">
                                <h4><i class="icon-wallet"></i> 7,12,326$</h4>
                                <span>Operation Income</span>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="body secondary-bg text-light">
                                <h4><i class="icon-wallet"></i> 25,965$</h4>
                                <span>Pharmacy Income</span>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="body bg-danger text-light">
                                <h4><i class="icon-wallet"></i> 14,965$</h4>
                                <span>Hospital Expenses</span>
                            </div>
                        </div>
                    </div>
                    <div id="apex-chart-line-column"></div>
                </div>
            </div>
        </div>
    </div>

    <div class="row clearfix">
        <div class="col-xl-3 col-lg-5 col-md-12">
            <div class="card">
                <div class="header">
                    <h2>Social Counter</h2>
                </div>
                <div class="body social_counter">                        
                    <ul class=" list-unstyled basic-list">
                        <li><i class="fa fa-facebook-square mr-1"></i> FaceBook <span class="badge badge-primary">16,785</span></li>
                        <li><i class="fa fa-twitter-square mr-1"></i> Twitter <span class="badge badge-default">2,365</span></li>
                        <li><i class="fa fa-linkedin-square mr-1"></i> Linkedin<span class="badge badge-success">9,021</span></li>
                        <li><i class="fa fa-google-plus-square mr-1"></i> Google Plus<span class="badge badge-info">725</span></li>
                        <li><i class="fa fa-behance-square mr-1"></i> Behance<span class="badge badge-info">1,725</span></li>
                        <li><i class="fa fa-dribbble mr-1"></i> Dribbble<span class="badge badge-info">11,725</span></li>
                    </ul>
                </div>
            </div>
            <div class="card">
                <div class="carousel slide twitter w_feed" data-ride="carousel">
                    <div class="carousel-inner" role="listbox">
                        <div class="carousel-item">
                            <i class="fa fa-twitter fa-2x"></i>
                            <p>23th Feb</p>
                            <h4>Now Get <span>Up to 70% Off</span><br>on buy</h4>
                            <div class="m-t-20"><i>- post form ThemeMakker</i></div>
                        </div>
                        <div class="carousel-item active">
                            <i class="fa fa-twitter fa-2x"></i>
                            <p>25th Jan</p>
                            <h4>Now Get <span>50% Off</span><br>on buy</h4>
                            <div class="m-t-20"><i>- post form WrapTheme</i></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-9 col-lg-7 col-md-12">
            <div class="card">
                <div class="header">
                    <h2>Visitors Statistics</h2>
                    <ul class="header-dropdown">
                        <li><a class="tab_btn" href="javascript:void(0);" data-toggle="tooltip" data-placement="top" title="Weekly">W</a></li>
                        <li><a class="tab_btn" href="javascript:void(0);" data-toggle="tooltip" data-placement="top" title="Monthly">M</a></li>
                        <li><a class="tab_btn active" href="javascript:void(0);" data-toggle="tooltip" data-placement="top" title="Yearly">Y</a></li>
                        <li class="dropdown">
                            <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"></a>
                            <ul class="dropdown-menu dropdown-menu-right">
                                <li><a href="javascript:void(0);">Action</a></li>
                                <li><a href="javascript:void(0);">Another Action</a></li>
                                <li><a href="javascript:void(0);">Something else</a></li>
                            </ul>
                        </li>
                    </ul>
                </div>
                <div class="body">
                    <div class="row text-center">
                        <div class="col-lg-3 col-md-3 col-6">
                            <div id="Visitors_chart1" class="carousel slide" data-ride="carousel" data-interval="2000">
                                <div class="card carousel-inner mb-1">
                                    <div class="body carousel-item active">
                                        <h4>2,025</h4>
                                        <span>America</span>
                                    </div>
                                    <div class="body carousel-item">
                                        <h4>1,100</h4>
                                        <span>Canada</span>
                                    </div>
                                    <div class="body carousel-item">
                                        <h4>680</h4>
                                        <span>Brazil</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-3 col-6">
                            <div id="Visitors_chart2" class="carousel slide" data-ride="carousel" data-interval="2200">
                                <div class="card carousel-inner mb-1">
                                    <div class="body carousel-item active">
                                        <h4>1,025</h4>
                                        <span>UK</span>
                                    </div>
                                    <div class="body carousel-item">
                                        <h4>582</h4>
                                        <span>France</span>
                                    </div>
                                    <div class="body carousel-item">
                                        <h4>128</h4>
                                        <span>Georgia</span>
                                    </div>
                                </div>
                            </div>                                    
                        </div>
                        <div class="col-lg-3 col-md-3 col-6">
                            <div class="card mb-1">
                                <div class="body">
                                    <h4>3,845</h4>
                                    <span>India</span>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-3 col-md-3 col-6">
                            <div class="card mb-1">
                                <div class="body">
                                    <h4>863</h4>
                                    <span>Other</span>
                                </div>
                            </div>
                        </div>                      
                    </div>
                    <div id="apex-simple-bubble"></div>
                </div>
            </div>
        </div>
    </div>

    <div class="row clearfix">
        <div class="col-lg-12">
            <div class="card">
                <div class="header">
                    <h2>Patients Status</h2>
                    <ul class="header-dropdown">
                        <li class="dropdown">
                            <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"></a>
                            <ul class="dropdown-menu dropdown-menu-right">
                                <li><a href="javascript:void(0);">Action</a></li>
                                <li><a href="javascript:void(0);">Another Action</a></li>
                                <li><a href="javascript:void(0);">Something else</a></li>
                            </ul>
                        </li>
                    </ul>
                </div>
                <div class="body">
                    <p class="float-md-right">
                        <span class="badge badge-success">3 Admit</span>
                        <span class="badge badge-default">2 Discharge</span>
                    </p>
                    <div class="table-responsive table_middel">
                        <table class="table m-b-0">
                            <thead class="thead-dark">
                                <tr>
                                    <th>#</th>
                                    <th>Patients</th>
                                    <th>Adress</th>
                                    <th>START Date</th>
                                    <th>END Date</th>
                                    <th>Priority</th>
                                    <th>Progress</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>1</td>
                                    <td><img src="../assets/images/xs/avatar3.jpg" class="rounded-circle avatar mr-2" alt="profile-image"><span>John</span></td>
                                    <td><span class="text-info">70 Bowman St. South Windsor, CT 06074</span></td>
                                    <td>Sept 13, 2017</td>
                                    <td>Sept 16, 2017</td>
                                    <td><span class="badge badge-warning">MEDIUM</span></td>
                                    <td><div class="progress progress-xs">
                                            <div class="progress-bar progress-bar-warning" role="progressbar" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100" style="width: 40%;"> <span class="sr-only">40% Complete</span> </div>
                                        </div>
                                    </td>
                                    <td><span class="badge badge-success">Admit</span></td>
                                </tr>
                                <tr>
                                    <td>2</td>
                                    <td><img src="../assets/images/xs/avatar1.jpg" class="rounded-circle avatar mr-2" alt="profile-image"><span>Jack Bird</span></td>
                                    <td><span class="text-info">123 6th St. Melbourne, FL 32904</span></td>
                                    <td>Sept 13, 2017</td>
                                    <td>Sept 22, 2017</td>
                                    <td><span class="badge badge-warning">MEDIUM</span></td>
                                    <td><div class="progress progress-xs">
                                            <div class="progress-bar" role="progressbar" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100" style="width: 100%;"> <span class="sr-only">100% Complete</span> </div>
                                        </div>
                                    </td>
                                    <td><span class="badge badge-default">Discharge</span></td>
                                </tr>
                                <tr>
                                    <td>3</td>
                                    <td><img src="../assets/images/xs/avatar4.jpg" class="rounded-circle avatar mr-2" alt="profile-image"><span>Dean Otto</span></td>
                                    <td><span class="text-info">123 6th St. Melbourne, FL 32904</span></td>
                                    <td>Sept 13, 2017</td>
                                    <td>Sept 23, 2017</td>
                                    <td><span class="badge badge-warning">MEDIUM</span></td>
                                    <td><div class="progress progress-xs">
                                            <div class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="15" aria-valuemin="0" aria-valuemax="100" style="width: 15%;"> <span class="sr-only">15% Complete</span> </div>
                                        </div>
                                    </td>
                                    <td><span class="badge badge-success">Admit</span></td>
                                </tr>
                                <tr>
                                    <td>4</td>
                                    <td><img src="../assets/images/xs/avatar2.jpg" class="rounded-circle avatar mr-2" alt="profile-image"><span>Jack Bird</span></td>
                                    <td><span class="text-info">4 Shirley Ave. West Chicago, IL 60185</span></td>
                                    <td>Sept 17, 2017</td>
                                    <td>Sept 16, 2017</td>
                                    <td><span class="badge badge-success">LOW</span></td>
                                    <td><div class="progress progress-xs">
                                            <div class="progress-bar" role="progressbar" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100" style="width: 100%;"> <span class="sr-only">100% Complete</span> </div>
                                        </div>
                                    </td>
                                    <td><span class="badge badge-default">Discharge</span></td>
                                </tr>
                                <tr>
                                    <td>5</td>
                                    <td><img src="../assets/images/xs/avatar5.jpg" class="rounded-circle avatar mr-2" alt="profile-image"><span>Hughe L.</span></td>
                                    <td><span class="text-info">4 Shirley Ave. West Chicago, IL 60185</span></td>
                                    <td>Sept 18, 2017</td>
                                    <td>Sept 18, 2017</td>
                                    <td><span class="badge badge-danger">HIGH</span></td>
                                    <td><div class="progress progress-xs">
                                            <div class="progress-bar progress-bar-danger" role="progressbar" aria-valuenow="85" aria-valuemin="0" aria-valuemax="100" style="width: 85%;"> <span class="sr-only">85% Complete</span> </div>
                                        </div>
                                    </td>
                                    <td><span class="badge badge-success">Admit</span></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>                
    </div>
</div>
@endsection
