<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Patient;
use App\Models\Doctor;
use App\Models\Bed;
use App\Models\Procedure;
use App\Models\Slip;

class AdminController extends Controller
{
   public function dashboard()
   {
      // Total Counts
      $patients = Patient::all()->count();
      $doctors = Doctor::all()->count();
      $beds = Bed::all()->count();
      $procedures = Procedure::all();

      // Today Visits
      $today_visits = Slip::whereDay('created_at', now()->today())->groupBy('patient_id')->count();
      $current_month_visits = Slip::whereMonth('created_at', now()->month)->groupBy('patient_id')->count();
      $current_year_visits = Slip::whereYear('created_at', now()->year)->groupBy('patient_id')->count();

      // Today New Patients
      $today_new_patients = Patient::whereDay('created_at', now()->today())->count();

      // Income
      $today_slips = Slip::whereDay('created_at', now()->today())->count();      
      $today_income = Slip::whereDay('created_at', now()->today())->sum('total_amount');
      $current_month_income = Slip::whereMonth('created_at', now()->month)->sum('total_amount');
      $current_year_income = Slip::whereYear('created_at', now()->year)->sum('total_amount');

      // Slips Types for Today
      $today_emergency_slips = Slip::whereDay('created_at', now()->today())->where('type', 'Emergency')->count();
      $today_ipd_slips = Slip::whereMonth('created_at', now()->today())->where('type', 'IPD')->count();
      $today_opd_slips = Slip::whereYear('created_at', now()->today())->where('type', 'OPD')->count();

      return view('dashboards.admin', 
      compact('patients',
         'doctors',
         'beds',
         'procedures',
         'today_slips',
         'today_income',
         'current_month_income',
         'current_year_income',
         'today_new_patients',
         'today_visits',
         'today_emergency_slips',
         'today_ipd_slips',
         'today_opd_slips',
         'current_month_visits',
         'current_year_visits'
      ));
   }
}
