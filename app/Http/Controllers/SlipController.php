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
use Auth;

use Illuminate\Support\Facades\DB;


class SlipController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $slips = Slip::all();
        return view('slips.index', compact('slips'));
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

            DB::beginTransaction();

            $request->validate([
                'mr_number' => 'required',
                'type' => 'required'
            ]);
            
            $imageUrl = 'dummy-image.jpg';

            if (!empty($request->image)) {
                $file =$request->file('image');
                $extension = $file->getClientOriginalExtension(); 
                $filename = time().'.' . $extension;
                $file->move(public_path('uploads/patients'), $filename);
                $imageUrl = 'public/uploads/patients'.$filename;
            }           

            $patient = Patient::where('mr_number', $request->mr_number)->first();
            
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
            }      
            
           
            $slip_number_count = ReferenceCount::where('type', 'slip')->first();
            $slip_number_count->count = $slip_number_count->count + 1;
            $slip_number_count->update();
            
            $slip_number = 'Slip#'. $slip_number_count->count;
            $receptionist_id = $request->receptionist_id != '' ? $request->receptionist_id : Auth::user()->receptionist->id;
            $slip = Slip::create([
                'slip_number' => $slip_number,
                'patient_id' => $patient->id,
                'department_id' => $request->department,
                'receptionist_id' => $receptionist_id,
                'bed_id' => $request->bed,
                'doctor_id' => $request->doctor,
                'type' => $request->type,
                'description' => $request->description,
                'total_amount' => $request->total_amount,
                'doctor_type' => $request->doctor_type,
                'remaining_amount' => 0    
            ]);

            // if(isset($request->procedure) && count($request->procedure) > 0)
            // {
            //     foreach($request->procedure as $item => $v)
            //     {
            //         $procedure = Procedure::find($request->procedure[$item]);
            //         SlipProcedure::create([
            //             'slip_id' => $slip->id,
            //             'procedure_id' => $procedure->id,
            //             'price' => $procedure->price
            //         ]);
            //     }
            // }
            
            if(isset($request->procedures) && count($request->procedures) > 0)
            {
                $procedureIds = $request->procedures;
                $procedures = Procedure::whereIn('id', $procedureIds)->get();
    
                $syncData = [];
    
                foreach ($procedures as $procedure) {
                    $syncData[$procedure->id] = ['price' => $procedure->price];
                }
    
                $slip->procedures()->sync($syncData);
            }
            
    
            $ref_count = ReferenceCount::where('type', 'mr')->first();
            $ref_count->count = $ref_count->count + 1;
            $ref_count->update();

            DB::commit();


        } catch (\Throwable $e) {

            DB::rollBack();

            return back()->with('error', $e);
            
        }      

        return redirect('/slips/'.$slip->id);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Slip $slip)
    {
        return view('slips.view', compact('slip'));
    }


    public function view(Slip $slip)
    {
        return view('slips.view', compact('slip'));
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
        return back()->with('success', 'Slip has been deleted');
    }

    public function getMrNumbers($phone)
    {
        $data = Patient::where('phone', $phone)->select('mr_number', 'name')->get();
        return response()->json(['data' => $data]);
    }
}
