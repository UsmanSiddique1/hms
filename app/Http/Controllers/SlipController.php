<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ReferenceCount;
use App\Models\Doctor;
use App\Models\Patient;
use App\Models\Procedure;
use App\Models\Department;
use App\Models\Bed;
use App\Models\Slip;
use App\Models\SlipProcedure;
use App\Models\Receptionist;
use App\Services\DonorService;
use App\Services\SlipService;
use App\Services\DoctorService;
use App\Services\ReceptionistService;
use App\Services\PatientService;
use Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\DB;
use DataTables;

class SlipController extends Controller
{
    const BASE_PATH = 'slips.';

    protected $donorService;
    protected $slipService;
    protected $patientService;
    protected $receptionistService;
    protected $doctorService;

    public function __construct(
        DonorService $donorService, 
        SlipService $slipService,
        ReceptionistService $receptionistService,
        DoctorService $doctorService,
        PatientService $patientService
        )
    {
        $this->donorService = $donorService;
        $this->slipService = $slipService;
        $this->patientService = $patientService;
        $this->receptionistService = $receptionistService;
        $this->doctorService = $doctorService;
    }

    public function index(Request $request)
    {
        if($request->ajax())
        {
            $slips = $this->slipService->getAll()->orderBy('id');
            $this->slipService->filters($request, $slips);
            return Datatables::of($slips)
                    ->addIndexColumn()
                    ->addColumn('action', function($row){
                        $btn = '<a href="' . route('slips.show', ['slip' => $row->id]) . '" class="edit btn btn-primary btn-sm"><i class="fa fa-eye"></i></a> '. 
                                '<a href="' . route('slips.edit', ['slip' => $row->id]) . '" class="editModal btn btn-primary btn-sm"><i class="fa fa-pencil"></i></a> '.
                                '<a href="javascript:void(0)" class="delete btn btn-danger btn-sm" onclick="deleteItem('.$row->id.')"><i class="fa fa-trash"></i></a>';
                        return $btn;
                 })
                 ->addColumn('date', function($row){
                    return $row->created_at->format('d-M-Y');
                 })
                 ->addColumn('time', function($row){
                    return $row->created_at->format('H:i A');
                 })
                 ->addColumn('doctor', function($row){
                    return $row->doctor ? $row->doctor->user->full_name : '--';
                 })
                 ->rawColumns(['action','date','time', 'doctor'])
                 ->make(true);
        }

        $slips = $this->slipService->getAll()->get();
        $patients = $this->patientService->getAll();
        $doctors = $this->doctorService->getAll()->get();
        $receptionists = $this->receptionistService->getAll();

        return view(self::BASE_PATH.'index', compact('slips','patients','doctors','doctors','receptionists'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $ref_mr_count = ReferenceCount::where('type', 'mr')->first();
        $new_mr = 'MR#'.$ref_mr_count->count + 1;        

        $ref_slip_count = ReferenceCount::where('type', 'slip')->first();
        $new_slip = $ref_slip_count->count + 1; 

        $patients = Patient::all();
        $doctors = Doctor::all();
        $departments = Department::all();
        $beds = Bed::all();
        $procedures = Procedure::all();
        $receptionists = Receptionist::all();
        return view('slips.create', compact('new_mr','patients','doctors','departments','beds','procedures', 'new_slip','receptionists'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {                
        try {

            Log::info("Start Creating Slip Request");
            Log::info($request->all());
            DB::beginTransaction();

            $donor = null;
            if($request->processing == 'cross_match')
            {
                Log::info("Start Creating Cross Match Slip");
                Log::info("Validating Cross Match Request");
                $request->validate([
                    'donor_cnic' => 'required',
                    'donor_name' => 'required'
                ]);        
                $donor = $this->donorService->updateOrCreate($request);
            }

            Log::info("Validating Request");
            $request->validate([
                'mr_number' => 'required',
                'type' => 'required'
            ]);

            Log::info("Request Validated: ");
            Log::info($request->all());
            
            $imageUrl = 'dummy-image.jpg';

            if (!empty($request->image)) {
                $file =$request->file('image');
                $extension = $file->getClientOriginalExtension(); 
                $filename = time().'.' . $extension;
                $file->move(public_path('uploads/patients'), $filename);
                $imageUrl = 'public/uploads/patients'.$filename;
            }           
            
            Log::info("MR Number: ".$request->mr_number);
            $patient = Patient::where('mr_number', $request->mr_number)->first();
            Log::info("Existing Patient: ".$patient);
            
            if(!$patient)
            {
                $patient = Patient::create([
                    'mr_number' => $request->mr_number,            
                    'name' => $request->name,
                    'phone' => $request->phone,
                    'cnic' => $request->cnic,
                    'address' => $request->address,
                    'age_years' => $request->age_years,
                    'age_months' => $request->age_months,
                    'age_weeks' => $request->age_weeks,
                    'gender' => $request->gender,
                    'image' => $imageUrl,
                    'W_O' => $request->get('W_O'),
                    'S_O' => $request->get('S_O'),
                    'D_O' => $request->get('D_O'),
                ]);

                $ref_count = ReferenceCount::where('type', 'mr')->first();
                $ref_count->count = $ref_count->count + 1;
                $ref_count->update();
                Log::info("New Patient: ".$patient);
            }     

            $slip_number_count = ReferenceCount::where('type', 'slip')->first();
            $slip_number_count->count = $slip_number_count->count + 1;
            $slip_number_count->update();
            Log::info("Slip Number Count: ".$slip_number_count->count);           
            
            $slip_number = 'Slip#'. $slip_number_count->count;
            Log::info("Slip Number: ".$slip_number);           

            $receptionist_id = $request->receptionist_id != '' ? $request->receptionist_id : Auth::user()->receptionist->id;
            $slip = Slip::create([
                'slip_number' => $slip_number,
                'patient_id' => $patient->id,
                'donor_id' => $donor != null ? $donor->id : null,
                'department_id' => $request->department,
                'receptionist_id' => $receptionist_id,
                'bed_id' => $request->bed,
                'doctor_id' => $request->doctor,
                'type' => $request->type,
                'description' => $request->description,
                'total_amount' => $request->total_amount,
                'grand_total' => $request->grand_total,
                'discount' => $request->discount ?? 0,
                'doctor_type' => $request->doctor_type,
                'remaining_amount' => 0    
            ]);

            Log::info("Slip Generated: ".$slip);
            
            if(isset($request->procedures) && count($request->procedures) > 0)
            {
                Log::info("Procedures IDs ");           
                Log::info($request->procedures);           

                $procedureIds = $request->procedures;
                $procedures = Procedure::whereIn('id', $procedureIds)->get();
    
                $syncData = [];
    
                foreach ($procedures as $procedure) {
                    $syncData[$procedure->id] = ['price' => $procedure->price];
                }

                Log::info("Syncing Procedures ID's");                
                $slip->procedures()->sync($syncData);
            }           

            DB::commit();
            Log::info("Function Closed");                


        } catch (\Throwable $e) {

            DB::rollBack();
            Log::info("Error in slip store: ".$e->getLine() . " ".$e->getMessage(). "Full Error Log: ".$e);
            return back()->with('error', $e);
            
        }      

        return $request->processing == 'cross_match' ? redirect('/slips/cross-match/'.$slip->id) : redirect('/slips/'.$slip->id) ;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Slip $slip)
    {
        if($slip->donor_id == null)
        {
            return view('slips.view', compact('slip'));
        }

        return view('slips.cross-match', compact('slip'));

    }


    // public function view(Slip $slip)
    // {
    //     return view('slips.view', compact('slip'));
    // }

    public function crossMatchSlip(Slip $slip)
    {
        return view('slips.cross-match', compact('slip'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Slip $slip)
    {
        $procedures = Procedure::all();
        $doctors = Doctor::all();
        return view('slips.edit', compact('slip', 'procedures', 'doctors'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Slip $slip)
    {
        try {      
            
            DB::beginTransaction();

            if($request->processing == 'cross_match')
            {
                Log::info("Start Creating Cross Match Slip");
                Log::info("Validating Cross Match Request");
                $request->validate([
                    'donor_cnic' => 'required',
                    'donor_name' => 'required'
                ]);        
                $donor = $this->donorService->updateOrCreate($request);
            }
            
            $slip->patient->update([
                'name' => $request->name,
                'phone' => $request->phone,
                'address' => $request->address,
                'age_years' => $request->age_years,
                'age_months' => $request->age_months,
                'age_weeks' => $request->age_weeks,
                'gender' => $request->gender,
                'W_O' => $request->get('W_O'),
                'S_O' => $request->get('S_O'),
                'D_O' => $request->get('D_O'),
            ]);

            $slip->update([
                'receptionist_id' => $request->receptionist_id,
                'bed_id' => $request->bed,
                'doctor_id' => $request->doctor,
                'description' => $request->description,
                'total_amount' => $request->total_amount,
                'grand_total' => $request->grand_total,
                'discount' => $request->discount,
                'doctor_type' => $request->doctor_type,
                'remaining_amount' => 0    
            ]);


            $procedureIds = $request->procedures;
            $procedures = Procedure::whereIn('id', $procedureIds)->get();

            $syncData = [];

            foreach ($procedures as $procedure) {
                $syncData[$procedure->id] = ['price' => $procedure->price];
            }

            $slip->procedures()->sync($syncData);
             
            DB::commit();

            return redirect('/slips/'.$slip->id);

        } catch (\Throwable $e) {

            DB::rollBack();
            return back()->with('error', $e->getFile(). "Line:" . $e->getLine().  $e->getMessage());
            
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Slip $slip)
    {
        $slip->delete();
        return response()->json(['status' => true]);
    }

    public function getMrNumbers($phone)
    {
        $data = Patient::where('phone', $phone)->select('mr_number', 'name')->get();
        return response()->json(['data' => $data]);
    }
}
