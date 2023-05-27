<div id="left-sidebar" class="sidebar">
    <button type="button" class="btn-toggle-offcanvas"><i class="fa fa-arrow-left"></i></button>
    <div class="sidebar-scroll">
        <div class="user-account">
            <img src="../assets/images/user.png" class="rounded-circle user-photo" alt="User Profile Picture">
            <div class="dropdown">
                <span>Welcome,</span>
                <a href="javascript:void(0);" class="dropdown-toggle user-name" data-toggle="dropdown"><strong>{{ Auth::user()->full_name }} <span class="badge badge-primary"> {{ Auth::user()->role_name }}</span></strong></a>
                <ul class="dropdown-menu dropdown-menu-right account">
                    {{-- <li><a href="doctor-profile.html"><i class="icon-user"></i>My Profile</a></li>                     --}}
                    {{-- <li class="divider"></li> --}}
                    <li>
                        <a class="" href="{{ route('logout') }}"
                            onclick="event.preventDefault();
                                            document.getElementById('logout-form').submit();">
                                            <i class="fa fa-sign-out"></i>
                            {{ __('Logout') }}
                        </a>

                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                            @csrf
                        </form>
                    </li>
                </ul>
            </div>                
            <hr>
        </div>
            
        <!-- Tab panes -->
        <div class="tab-content padding-0">
            <div class="tab-pane active" id="menu">
                <nav id="left-sidebar-nav" class="sidebar-nav">
                    <ul class="metismenu li_animation_delay">
                        <li class=""><a href="{{ url('/') }}" class=""><i class="fa fa-dashboard"></i><span>Dashboard</span></a>                           
                        
                        </li>
                        <li><a href="{{ url('slips/create') }}" class=""><i class="fa fa-users"></i><span>Create Slip</span></a></li> 

                        <li><a href="javascript:void(0);" class="has-arrow"><i class="fa fa-user-md"></i><span>Slips</span></a>
                            <ul>
                                <li><a href="{{ url('slips') }}">All Slips</a></li>
                                <li><a href="{{ url('slips/create') }}">Add Slip</a></li>
                                
                            </ul>
                        </li>
                        <li><a href="javascript:void(0);" class="has-arrow"><i class="fa fa-user-md"></i><span>Doctors</span></a>
                            <ul>
                                <li><a href="{{ url('doctors') }}">All Doctors</a></li>
                                @if(Auth::user()->role->name == 'Admin')
                                <li><a href="{{ url('doctors/create') }}">Add Doctor</a></li>
                                @endif
                                
                            </ul>
                        </li>
                        @if(Auth::user()->role->name == 'Admin')
                        <li><a href="javascript:void(0);" class="has-arrow"><i class="fa fa-user-md"></i><span>Receptionist</span></a>
                            <ul>
                                <li><a href="{{ url('receptionists') }}">All Receptionists</a></li>
                                <li><a href="{{ url('receptionists/create') }}">Add Receptionist</a></li>
                                
                            </ul>
                        </li>
                        <li><a href="javascript:void(0);" class="has-arrow"><i class="fa fa-user"></i><span>Patients</span></a>
                            <ul>
                                <li><a href="{{ url('patients') }}">All Patients</a></li>
                                <li><a href="{{ url('patients/create') }}">Add Patient</a></li>                               
                            </ul>
                        </li>                       
                        <li><a href="javascript:void(0);" class="has-arrow"><i class="fa fa-building"></i><span>Bed Allotment</span></a>
                            <ul>
                                <li><a href="{{ url('beds') }}">View Beds</a></li>
                                <li><a href="{{ url('beds/create') }}">Add Bed</a></li>
                            </ul>
                        </li>
                        <li><a href="javascript:void(0);" class="has-arrow"><i class="fa fa-users"></i><span>Departments</span></a>
                            <ul>
                                <li><a href="{{ url('departments') }}">All Departments</a></li>
                                <li><a href="{{ url('departments/create') }}">Add Departments</a></li>
                            </ul>
                        </li> 
                        <li><a href="javascript:void(0);" class="has-arrow"><i class="fa fa-users"></i><span>Procedures</span></a>
                            <ul>
                                <li><a href="{{ url('procedures') }}">All Procedures</a></li>
                                <li><a href="{{ url('procedures/create') }}">Add Procedures</a></li>
                            </ul>
                        </li> 
                        @endif
                        
                        
                    </ul>
                </nav>
            </div>
        </div>          
    </div>
</div>