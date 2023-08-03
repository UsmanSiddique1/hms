<div class="row">
    <div class="col-md-3">
      <div class="form-group">
        <label for="">Slip No</label>
        <select name="slip" id="slip" class="form-control select2">
          <option value="">Select Slip</option>
          @foreach($slips as $slip)
            <option value="{{$slip->id}}">Slip#{{$slip->slip_number}}</option>
          @endforeach
        </select>
      </div>
    </div>
    <div class="col-md-3">
      <div class="form-group">
        <label for="">Patient</label>
        <select name="patient" id="patient" class="form-control select2">
          <option value="">Select Patient</option>
          @foreach($patients as $patient)
            <option value="{{$patient->id}}">{{$patient->name}}</option>
          @endforeach
        </select>
      </div>
    </div>
    <div class="col-md-3">
      <div class="form-group">
        <label for="">Doctors</label>
        <select name="doctor" id="doctor" class="form-control select2">
          <option value="">Select Doctor</option>
          @foreach($doctors as $doctor)
            <option value="{{$doctor->id}}">{{$doctor->user->full_name}}</option>
          @endforeach
        </select>
      </div>
    </div>
    <div class="col-md-3">
      <div class="form-group">
        <label for="">Receptionist</label>
        <select name="receptionist" id="receptionist" class="form-control select2">
          <option value="">Select Receptionist</option>
          @foreach($receptionists as $receptionist)
            <option value="{{$receptionist->id}}">{{$receptionist->user->full_name}}</option>
          @endforeach
        </select>
      </div>
    </div>
    <div class="col-md-3">
      <div class="form-group">
        <label for="">From Date</label>
        <input type="date" name="from_date" id="from_date" class="form-control">
      </div>
    </div>
    <div class="col-md-3">
      <div class="form-group">
        <label for="">To Date</label>
        <input type="date" name="to_date" id="to_date" class="form-control">
      </div>
    </div>
    <div class="col-md-2">
      <div class="form-group">
        <label for="">Reset</label>
        <button id="clear-filter" class="btn btn-primary form-control">Clear Filter</button>
      </div>
    </div>
</div>