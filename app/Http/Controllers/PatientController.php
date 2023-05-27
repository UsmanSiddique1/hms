<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Patient;
use App\Models\ReferenceCount;
use App\Http\Requests\PatientStoreRequest;

class PatientController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {     
        $patients = Patient::all();
        return view('patients.index', compact('patients'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $ref_mr_count = ReferenceCount::where('type', 'mr')->first();
        $mr_number = 'MR#'.$ref_mr_count->count + 1;   

        return view('patients.create', compact('mr_number'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PatientStoreRequest $request)
    {

        $imageUrl = 'dummy-user.jpg';
        
        if (!empty($request->image)) {
            $file =$request->file('image');
            $extension = $file->getClientOriginalExtension(); 
            $filename = time().'.' . $extension;
            $file->move(public_path('uploads/patients'), $filename);
            $imageUrl = 'public/uploads/patients'.$filename;
        }

        Patient::create([
            'mr_number' => $request->mr_number,            
            'name' => $request->name,
            'phone' => $request->phone,
            'age_years' => $request->age_years,
            'age_months' => $request->age_months,
            'age_weeks' => $request->age_weeks,
            'gender' => $request->gender,
            'image' => $imageUrl,
        ]);

        return redirect('/patients')->with('success', 'Patient has been added');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Patient $patient)
    {
                
        $imageUrl = $patient->image;
        if (!empty($request->image)) {
            $file =$request->file('image');
            $extension = $file->getClientOriginalExtension(); 
            $filename = time().'.' . $extension;
            $file->move(public_path('uploads/patients'), $filename);
            $imageUrl = 'public/uploads/patients'.$filename;
        }

        $patient->update([
            'name' => $request->name,
            'age_years' => $request->age_years,
            'age_months' => $request->age_months,
            'age_weeks' => $request->age_weeks,
            'gender' => $request->gender,
            'image' => $imageUrl,
        ]);

        return redirect('/patients')->with('success', 'Patient has been added');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
