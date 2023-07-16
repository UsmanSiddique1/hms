@extends('layouts.master')
@section('content')
<div class="container-fluid">
    <div class="block-header">
        <div class="row">
            <div class="col-lg-6 col-md-6 col-sm-12">
                <h2>Add Doctor</h2>
                <ul class="breadcrumb">
                    <li class="breadcrumb-item"><a href="index.html"><i class="fa fa-dashboard"></i></a></li>                            
                    <li class="breadcrumb-item">Doctor</li>
                    <li class="breadcrumb-item active">Add new</li>
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
        <div class="col-lg-12 col-md-12 col-sm-12">
            <div class="card">
                <div class="header">
                    <h2>Basic Information <small>Description text here...</small> </h2>  
                    @if(Session::has('error'))
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            {{ Session::get('error') }}
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                          </div>
                          @endif                          
                </div>
                <form action="{{ route('doctors.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="body">
                        <div class="row clearfix">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <input type="text" class="form-control" name="f_name" placeholder="First Name" required>
                                </div>
                            </div>  
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <input type="text" class="form-control" name="l_name" placeholder="Last Name" required>
                                </div>
                            </div>                        
                        </div>
                        <div class="row clearfix">
                            <div class="col-sm-3">
                                <div class="form-group">
                                    <input type="date" data-provide="datepicker" name="dob" data-date-autoclose="true" class="form-control" placeholder="Date of Birth">
                                </div>
                            </div>
                            <div class="col-sm-3">
                                <div class="form-group">
                                    <select name="gender" class="form-control show-tick" required>
                                        <option value="">- Gender -</option>
                                        <option value="male">Male</option>
                                        <option value="female">Female</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-sm-3">
                                <div class="form-group">
                                    <input type="number" class="form-control" name="price" placeholder="Price" required>
                                </div>
                            </div>
                            <div class="col-sm-3">
                                <div class="form-group">
                                    <select name="department" class="form-control show-tick" required>
                                        <option value="">- Department -</option>
                                        @foreach($departments as $department)
                                            <option value="{{ $department->id }}">{{ $department->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-sm-3">
                                <div class="form-group">
                                    <input type="text" class="form-control" name="speciality" placeholder="Speciality" required>
                                </div>
                            </div>
                            <div class="col-sm-3">
                                <div class="form-group">
                                    <input type="text" class="form-control" name="phone" placeholder="Phone" required>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <input type="text" class="form-control" name="email" placeholder="Enter Your Email">
                                </div>
                            </div>
                            <div class="col-sm-3">
                                <div class="form-group">
                                    <div class="form-check">
                                      <input class="form-check-input" name="days[]" value="Monday" type="checkbox" id="mondayCheckbox">
                                      <label class="form-check-label" for="mondayCheckbox">Monday</label>
                                    </div>
                                    <div class="form-check">
                                      <input class="form-check-input" name="days[]" value="Tuesday" type="checkbox" id="tuesdayCheckbox">
                                      <label class="form-check-label" for="tuesdayCheckbox">Tuesday</label>
                                    </div>
                                    <div class="form-check">
                                      <input class="form-check-input" name="days[]" value="Wednesday" type="checkbox" id="wednesdayCheckbox">
                                      <label class="form-check-label" for="wednesdayCheckbox">Wednesday</label>
                                    </div>
                                    <div class="form-check">
                                      <input class="form-check-input" name="days[]" value="Thursday" type="checkbox" id="thursdayCheckbox">
                                      <label class="form-check-label" for="thursdayCheckbox">Thursday</label>
                                    </div>
                                    <div class="form-check">
                                      <input class="form-check-input" name="days[]" value="Friday" type="checkbox" id="fridayCheckbox">
                                      <label class="form-check-label" for="fridayCheckbox">Friday</label>
                                    </div>
                                    <div class="form-check">
                                      <input class="form-check-input" name="days[]" value="Saturday" type="checkbox" id="saturdayCheckbox">
                                      <label class="form-check-label" for="saturdayCheckbox">Saturday</label>
                                    </div>
                                    <div class="form-check">
                                      <input class="form-check-input" name="days[]" type="checkbox" value="Sunday" id="sundayCheckbox">
                                      <label class="form-check-label" for="sundayCheckbox">Sunday</label>
                                    </div>
                                  </div>
                            </div>
                            <div class="col-sm-3">
                                <div class="form-group">
                                    <label for="timeInput">From Time</label>
                                    <input type="time" id="timeInput" class="form-control" name="from">
                                </div>
                            </div>
                            <div class="col-sm-3">
                                <div class="form-group">
                                    <label for="timeInput">To Time</label>
                                    <input type="time" id="timeInput" class="form-control" name="to">
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <input type="file" name="image" class="dropify">
                                </div>
                            </div>
                            <div class="col-sm-12">
                                <div class="form-group mt-3">
                                    <textarea rows="4" name="description" class="form-control no-resize" placeholder="Please type what you want..."></textarea>
                                </div>
                            </div>
                            <div class="col-sm-12">
                                <button type="submit" class="btn btn-primary">Submit</button>
                                <button type="submit" class="btn btn-outline-secondary">Cancel</button>
                            </div>
                        </div>
                    </div>
                </form>                
            </div>
        </div>
    </div>
   

</div>
@endsection