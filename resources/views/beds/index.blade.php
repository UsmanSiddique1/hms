@extends('layouts.master')
@section('content')
<div class="container-fluid">
    <div class="block-header">
        <div class="row">
            <div class="col-lg-6 col-md-6 col-sm-12">
                <h2>All Beds</h2>
                <ul class="breadcrumb">
                    <li class="breadcrumb-item"><a href="index.html"><i class="fa fa-dashboard"></i></a></li>                            
                    <li class="breadcrumb-item">Beds</li>
                    <li class="breadcrumb-item active">All Bed</li>
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
                    <h2>Beds List</h2>
                    <ul class="header-dropdown">
                        {{-- <li><a class="tab_btn" href="javascript:void(0);" data-toggle="tooltip" data-placement="top" title="Weekly">W</a></li>
                        <li><a class="tab_btn" href="javascript:void(0);" data-toggle="tooltip" data-placement="top" title="Monthly">M</a></li>
                        <li><a class="tab_btn active" href="javascript:void(0);" data-toggle="tooltip" data-placement="top" title="Yearly">Y</a></li>
                        <li class="dropdown">
                            <a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"></a>
                            <ul class="dropdown-menu dropdown-menu-right">
                                <li><a href="javascript:void(0);">Action</a></li>
                                <li><a href="javascript:void(0);">Another Action</a></li>
                                <li><a href="javascript:void(0);">Something else</a></li>
                            </ul>
                        </li> --}}
                    </ul>
                </div>
                <div class="body">
                    <div class="input-group">
                        <div class="input-group-prepend">
                            <span class="input-group-text"><i class="icon-magnifier"></i></span>
                        </div>
                        <input type="text" class="form-control" placeholder="Search...">
                    </div>
                    <!-- Tab panes -->
                    <div class="tab-content padding-0">
                        <div class="tab-pane table-responsive active show" id="All">
                            <table class="table mb-0 table-hover">
                                <thead>
                                    <tr>                                       
                                        <th>ID</th>
                                        <th>Number</th>
                                        <th>Price</th>
                                        
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($beds as $key => $bed)
                                    <tr>
                                        <td>{{ ++$key }}</td>
                                        <td><span class="list-name">{{ $bed->number }}</span></td>
                                        <td>Rs.{{ $bed->price }}</td>                                        
                                        
                                    </tr>
                                    @endforeach
                                    
                                </tbody>
                            </table>                            
                        </div>
                        <div class="tab-pane table-responsive" id="USA">
                            <table class="table mb-0 table-hover">
                                <thead>
                                    <tr>                                       
                                        <th>ID</th>
                                        <th>Number</th>
                                        <th>Price</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td><span class="list-icon"><img class="avatar" src="../assets/images/xs/avatar1.jpg" alt=""></span></td>
                                        <td><span class="list-name">KU 00598</span></td>
                                        <td>Daniel</td>
                                        <td>32</td>
                                        <td>71 Pilgrim Avenue Chevy Chase, MD 20815</td>
                                        <td>404-447-6013</td>
                                        <td>11 Jan 2018</td>
                                        <td><span class="badge badge-success">Approved</span></td>
                                    </tr>
                                    <tr>
                                        <td><span class="list-icon"><img class="avatar" src="../assets/images/xs/avatar2.jpg" alt=""></span></td>
                                        <td><span class="list-name">KU 00258</span></td>
                                        <td>Alexander</td>
                                        <td>22</td>
                                        <td>123 6th St. Melbourne, FL 32904</td>
                                        <td>404-447-6013</td>
                                        <td>15 Jan 2018</td>
                                        <td><span class="badge badge-success">Approved</span></td>
                                    </tr>                                       
                                    <tr>
                                        <td><span class="list-icon"><img class="avatar" src="../assets/images/xs/avatar1.jpg" alt=""></span></td>
                                        <td><span class="list-name">KU 00456</span></td>
                                        <td>Joseph</td>
                                        <td>27</td>
                                        <td>70 Bowman St. South Windsor, CT 06074</td>
                                        <td>404-447-6013</td>
                                        <td>19 Jan 2018</td>
                                        <td><span class="badge badge-success">Approved</span></td>
                                    </tr>
                                    <tr>
                                        <td><span class="list-icon"><img class="avatar" src="../assets/images/xs/avatar2.jpg" alt=""></span></td>
                                        <td><span class="list-name">KU 00789</span></td>
                                        <td>Cameron</td>
                                        <td>38</td>
                                        <td>123 6th St. Melbourne, FL 32904</td>
                                        <td>404-447-6013</td>
                                        <td>19 Jan 2018</td>
                                        <td><span class="badge badge-warning">Pending</span></td>
                                    </tr>
                                    <tr>
                                        <td><span class="list-icon"><img class="avatar" src="../assets/images/xs/avatar3.jpg" alt=""></span></td>
                                        <td><span class="list-name">KU 00987</span></td>
                                        <td>Alex</td>
                                        <td>39</td>
                                        <td>123 6th St. Melbourne, FL 32904</td>
                                        <td>404-447-6013</td>
                                        <td>20 Jan 2018</td>
                                        <td><span class="badge badge-success">Approved</span></td>
                                    </tr>
                                    <tr>
                                        <td><span class="list-icon"><img class="avatar" src="../assets/images/xs/avatar4.jpg" alt=""></span></td>
                                        <td><span class="list-name">KU 00951</span></td>
                                        <td>James</td>
                                        <td>32</td>
                                        <td>44 Shirley Ave. West Chicago, IL 60185</td>
                                        <td>404-447-6013</td>
                                        <td>22 Jan 2018</td>
                                        <td><span class="badge badge-warning">Pending</span></td>
                                    </tr>
                                    <tr>
                                        <td><span class="list-icon"><img class="avatar" src="../assets/images/xs/avatar1.jpg" alt=""></span></td>
                                        <td><span class="list-name">KU 00953</span></td>
                                        <td>charlie</td>
                                        <td>51</td>
                                        <td>123 6th St. Melbourne, FL 32904</td>
                                        <td>404-447-6013</td>
                                        <td>22 Jan 2018</td>
                                        <td><span class="badge badge-warning">Pending</span></td>
                                    </tr>
                                    <tr>
                                        <td><span class="list-icon"><img class="avatar" src="../assets/images/xs/avatar2.jpg" alt=""></span></td>
                                        <td><span class="list-name">KU 00934</span></td>
                                        <td>Bing</td>
                                        <td>26</td>
                                        <td>123 6th St. Melbourne, FL 32904</td>
                                        <td>404-447-6013</td>
                                        <td>29 Jan 2018</td>
                                        <td><span class="badge badge-warning">Pending</span></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <div class="tab-pane table-responsive" id="India">
                            <table class="table mb-0 table-hover">
                                <thead>
                                    <tr>
                                        <th>Media</th>
                                        <th>ID</th>
                                        <th>Name</th>
                                        <th>Age</th>
                                        <th>Address</th>
                                        <th>Number</th>
                                        <th>Last Visit</th>
                                        <th>Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td><span class="list-icon"><img class="avatar" src="../assets/images/xs/avatar4.jpg" alt=""></span></td>
                                        <td><span class="list-name">KU 00951</span></td>
                                        <td>James</td>
                                        <td>32</td>
                                        <td>44 Shirley Ave. West Chicago, IL 60185</td>
                                        <td>404-447-6013</td>
                                        <td>22 Jan 2018</td>
                                        <td><span class="badge badge-warning">Pending</span></td>
                                    </tr>
                                    <tr>
                                        <td><span class="list-icon"><img class="avatar" src="../assets/images/xs/avatar1.jpg" alt=""></span></td>
                                        <td><span class="list-name">KU 00953</span></td>
                                        <td>charlie</td>
                                        <td>51</td>
                                        <td>123 6th St. Melbourne, FL 32904</td>
                                        <td>404-447-6013</td>
                                        <td>22 Jan 2018</td>
                                        <td><span class="badge badge-warning">Pending</span></td>
                                    </tr>
                                    <tr>
                                        <td><span class="list-icon"><img class="avatar" src="../assets/images/xs/avatar2.jpg" alt=""></span></td>
                                        <td><span class="list-name">KU 00934</span></td>
                                        <td>Bing</td>
                                        <td>26</td>
                                        <td>123 6th St. Melbourne, FL 32904</td>
                                        <td>404-447-6013</td>
                                        <td>29 Jan 2018</td>
                                        <td><span class="badge badge-warning">Pending</span></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>
@endsection