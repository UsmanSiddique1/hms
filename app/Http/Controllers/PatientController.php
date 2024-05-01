<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Patient;
use App\Models\ReferenceCount;
use App\Http\Requests\PatientStoreRequest;
use App\Services\PatientService;
use DB;
use DataTables;

class PatientController extends Controller
{

    protected $patientService;

    public function __construct(PatientService $patientService)
    {
        $this->patientService = $patientService;
    }

    public function index()
    {
        return view('patients.index');
    }

    public function datatable(Request $request)
    {
        $patients = $this->patientService->filters($request);
        return Datatables::of($patients)
            ->addIndexColumn()
            ->addColumn('action', function ($row) {
                return '<a href="javascript:void(0)" data-id="' . $row->id . '" data-mr_number="' . $row->mr_number . '" data-name="' . $row->name . '" data-age_years="' . $row->age_years . '" data-age_months="' . $row->age_months . '" data-age_weeks="' . $row->age_weeks . '" data-gender="' . $row->gender . '" data-phone="' . $row->phone . '" class="edit-patient btn btn-primary btn-sm"><i class="fa fa-pencil"></i></a> ' .
                    '<a href="javascript:void(0)" class="delete btn btn-danger btn-sm" onclick="deleteItem(' . $row->id . ')"><i class="fa fa-trash"></i></a>';
            })
            ->addColumn('age', function ($row) {
                return $row->age_years . "y, " . $row->age_months . "m, " . $row->age_weeks . "w";
            })
            ->rawColumns(['action', 'age'])
            ->make(true);
    }

    public function create()
    {
        $ref_mr_count = ReferenceCount::where('type', 'mr')->first();
        $mr_number = 'MR#' . $ref_mr_count->count + 1;

        return view('patients.create', compact('mr_number'));
    }

    public function store(PatientStoreRequest $request)
    {
        try {

            $imageUrl = 'dummy-user.jpg';

            if (!empty($request->image)) {
                $file = $request->file('image');
                $extension = $file->getClientOriginalExtension();
                $filename = time() . '.' . $extension;
                $file->move(public_path('uploads/patients'), $filename);
                $imageUrl = 'public/uploads/patients' . $filename;
            }

            DB::beginTransaction();

            Patient::create([
                'mr_number' => $request->mr_number,
                'name' => $request->name,
                'W_O' => $request->get('W_O'),
                'S_O' => $request->get('S_O'),
                'D_O' => $request->get('D_O'),
                'phone' => $request->phone,
                'cnic' => $request->cnic,
                'age_years' => $request->age_years,
                'age_months' => $request->age_months,
                'age_weeks' => $request->age_weeks,
                'gender' => $request->gender,
                'image' => $imageUrl,
            ]);

            ReferenceCount::where('type', 'mr')->increment('count', 1);


            DB::commit();
            return redirect('/patients')->with('success', 'Patient has been added');
        } catch (\Throwable $th) {
            DB::rollBack();
            return back()->with('error', 'Something went wrong ' . $th->getLine() . $th->getMessage());
        }
    }


    public function show(Patient $patient)
    {
        return $patient;
    }

    public function edit($id)
    {
        //
    }

    public function update(Request $request, Patient $patient)
    {
        $imageUrl = $patient->image;
        if (!empty($request->image)) {
            $file = $request->file('image');
            $extension = $file->getClientOriginalExtension();
            $filename = time() . '.' . $extension;
            $file->move(public_path('uploads/patients'), $filename);
            $imageUrl = 'public/uploads/patients' . $filename;
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

    public function destroy(Patient $patient)
    {
        $patient->delete();
        return back()->with('success', 'Patient has been deleted');
    }

    public function ajaxFilter(Request $request)
    {
        $field = $request->field;

        $patients = Patient::where($field, 'LIKE', '%' . $request->q . '%')->get();

        $formattedResults = [];
        foreach ($patients as $patient) {
            $formattedResults[] = [
                'id' => $patient->id,
                'text' => $field == 'phone' ? $patient->phone : $patient->mr_number,
            ];
        }

        return response()->json(['items' => $formattedResults]);
    }
}
