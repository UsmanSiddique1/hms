<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Receptionist;
use Illuminate\Support\Facades\Hash;


use Illuminate\Support\Facades\DB;

class ReceptionistController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $receptionists = Receptionist::all();
        return view('receptionists.index', compact('receptionists'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('receptionists.create');
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
            
            $request->validate([
                'f_name' => 'required',
                'l_name' => 'required',
                'phone' => 'required',
                'email' => 'required',   
                'shift' => 'required'         
            ]);
            
            $imageUrl = 'dummy-user.png';
            if (!empty($request->image)) {
                $file =$request->file('image');
                $extension = $file->getClientOriginalExtension(); 
                $filename = time().'.' . $extension;
                $file->move(public_path('uploads/doctors'), $filename);
                $imageUrl = 'public/uploads/doctors'.$filename;
            }
            
            DB::beginTransaction();

            $user = User::create([
                'f_name' => $request->f_name,
                'l_name' => $request->l_name,
                'phone' => $request->phone,
                'dob' => $request->dob,
                'email' => $request->email,
                'image' => $imageUrl,
                'role_id' => 2,
                'gender' => $request->gender,
                'password' => Hash::make($request->password)
            ]);
    
            Receptionist::create([
                'user_id' => $user->id,
                'shift' => $request->shift,
                'status' => 'closed',
                'description' => $request->description
            ]);

            DB::commit();

            return redirect('/receptionists')->with('success', 'Patient has been added');


        } catch (\Throwable $th) {
            DB::rollBack();
            return back()->with('success', 'Something went wrong'. $th);
        }
        

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
    public function update(Request $request, Receptionist $receptionist)
    {
        try {
            
            $request->validate([
                'f_name' => 'required',
                'l_name' => 'required',
            ]);
            
            $imageUrl = 'dummy-user.png';
            if (!empty($request->image)) {
                $file =$request->file('image');
                $extension = $file->getClientOriginalExtension(); 
                $filename = time().'.' . $extension;
                $file->move(public_path('uploads/doctors'), $filename);
                $imageUrl = 'public/uploads/doctors'.$filename;
            }

            $password = $request->password != '' ? bcrypt($request->password) : $receptionist->user->password;
            
            DB::beginTransaction();

            $receptionist->user->update([
                'f_name' => $request->f_name,
                'l_name' => $request->l_name,                
                'dob' => $request->dob,
                'image' => $imageUrl,
                'gender' => $request->gender,
                'gender' => $request->gender,
                'password' => $password
                
            ]);
    
            $receptionist->update([
                'shift' => $request->shift,
                'status' => $request->status,
                'description' => $request->description
            ]);

            DB::commit();

            return redirect('/receptionists')->with('success', 'Patient has been added');


        } catch (\Throwable $th) {
            DB::rollBack();
            return back()->with('error', 'Something went wrong'. $th);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Receptionist $receptionist)
    {
        $receptionist->delete();
        return back()->with('success', 'Receptionist has been deleted');
    }
}
