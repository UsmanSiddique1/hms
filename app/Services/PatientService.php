<?php

namespace App\Services;

use App\Models\Patient;
use Illuminate\Support\Facades\Log;
use Illuminate\Http\Request;

class PatientService{

    public function getAll()
    {
        return $this->queryBuilder()->get();
    }

    public function queryBuilder()
    {
        return Patient::query();
    }

    public function store($request)
    {
        return Patient::create($request);
    }

    public function update($request, $brand)
    {
        return $brand->update($request);
    }

    public function showOne($brand)
    {
        return $brand;
    }

    public function edit($brand)
    {
        return $brand;
    }

    public function delete($brand)
    {
        return $brand->delete();
    }

    public function filters($request)
    {
        $patients = $this->queryBuilder();
        isset($request->mr_number) && $request->mr_number != '' ? $patients->where('mr_number', $request->mr_number) : '';
        isset($request->cnic) && $request->cnic != '' ? $patients->where('cnic', $request->cnic) : '';
        isset($request->phone) && $request->phone != '' ? $patients->where('phone', $request->phone) : '';
        isset($request->name) && $request->name != '' ? $patients->where('name', $request->name) : '';
        isset($request->address) && $request->address != '' ? $patients->where('address', $request->address) : '';
        return $patients;
    }

}
