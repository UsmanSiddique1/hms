<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Doctor;
use App\Models\User;
use App\Models\Department;
use Illuminate\Support\Facades\DB;

class DoctorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $doctors = Doctor::all();
        $departments = Department::all();
        return view('doctors.index', compact('doctors','departments'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $departments = Department::all();
        return view('doctors.create', compact('departments'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // return $request;
        $request->validate([
            'f_name' => 'required',
            'l_name' => 'required',
            'phone' => 'required',
            'email' => 'required',
            'speciality' => 'required',
        ]);

        $imageUrl = 'dummy-image.jpg';

        if (!empty($request->image)) {
            $file =$request->file('image');
            $extension = $file->getClientOriginalExtension(); 
            $filename = time().'.' . $extension;
            $file->move(public_path('uploads/doctors'), $filename);
            $imageUrl = 'public/uploads/doctors'.$filename;
        }

        $user = User::create([
            'f_name' => $request->f_name,
            'l_name' => $request->l_name,
            'phone' => $request->phone,
            'email' => $request->email,
            'dob' => $request->dob,
            'image' => $imageUrl,
            'gender' => $request->gender,
            'role_id' => 2,
            'password' => bcrypt('password')
        ]);
        $days = json_encode($request->days);

        Doctor::create([
            'user_id' => $user->id,
            'department_id' => $request->department,
            'description' => $request->description,
            'speciality' => $request->speciality,
            'price' => $request->price,
            'days' => $days,
            'from' => $request->from,
            'to' => $request->to
        ]);

        return redirect('/doctors')->with('success', 'Doctor has been added');
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
    public function update(Request $request, Doctor $doctor)
    {
        try {
        $request->validate([
            'f_name' => 'required',
            'l_name' => 'required',
            'speciality' => 'required',
        ]);

        $imageUrl = 'dummy-image.jpg';

        if (!empty($request->image)) {
            $file =$request->file('image');
            $extension = $file->getClientOriginalExtension(); 
            $filename = time().'.' . $extension;
            $file->move(public_path('uploads/doctors'), $filename);
            $imageUrl = 'public/uploads/doctors'.$filename;
        }
        
        DB::beginTransaction();

        $doctor->user->update([
            'f_name' => $request->f_name,
            'l_name' => $request->l_name,
            'dob' => $request->dob,
            'image' => $imageUrl,
            'gender' => $request->gender,            
        ]);

        // $days = json_encode($request->days);
        $doctor->update([
            'department_id' => $request->department_id,
            'description' => $request->description,
            'speciality' => $request->speciality,
            'price' => $request->price,
            // 'days' => $days,
            // 'from' => $request->from,
            // 'to' => $request->to
        ]);





        DB::commit();

        return redirect('/doctors')->with('success', 'Doctor has been updated');

        } catch (\Throwable $th) {
            DB::rollBack();

            return redirect('/doctors')->with('error', 'Something went wrong'. $th);

        }
        
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
